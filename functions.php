<?php
require_once 'config.php';

function registerUser($email, $password, $full_name, $role, $age = null, $gender = null, $specialization = null) {
    global $pdo;
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;
    if (strlen($password) < 6) return false;
    
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) return false;
    
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    
    $stmt = $pdo->prepare("INSERT INTO users (email, password, full_name, role, age, gender, specialization) VALUES (?, ?, ?, ?, ?, ?, ?)");
    return $stmt->execute([$email, $hashed_password, $full_name, $role, $age, $gender, $specialization]);
}

function loginUser($email, $password) {
    global $pdo;
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['full_name'];
        $_SESSION['user_role'] = $user['role'];
        return true;
    }
    return false;
}

function getPatientDiagnoses($user_id, $limit = 50) {
    global $pdo;
    
    // FIXED: Use string concatenation for LIMIT (works on all MySQL/MariaDB versions)
    $limit = (int)$limit;
    $stmt = $pdo->prepare("
        SELECT d.*, i.image_path, i.file_name 
        FROM diagnoses d 
        JOIN images i ON d.image_id = i.id 
        WHERE i.user_id = ? 
        ORDER BY d.created_at DESC
        LIMIT $limit
    ");
    $stmt->execute([$user_id]);
    return $stmt->fetchAll();
}

function getAllDiagnoses($filters = []) {
    global $pdo;
    
    $sql = "
        SELECT d.*, i.image_path, i.file_name, u.full_name as patient_name, u.email as patient_email, u.id as patient_id
        FROM diagnoses d 
        JOIN images i ON d.image_id = i.id 
        JOIN users u ON i.user_id = u.id 
        WHERE 1=1
    ";
    
    $params = [];
    
    if (!empty($filters['disease'])) {
        $sql .= " AND d.disease = ?";
        $params[] = $filters['disease'];
    }
    
    if (!empty($filters['severity'])) {
        $sql .= " AND d.severity = ?";
        $params[] = $filters['severity'];
    }
    
    $sql .= " ORDER BY d.created_at DESC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function updateRemarks($diagnosis_id, $remarks) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE diagnoses SET doctor_remarks = ? WHERE id = ?");
    return $stmt->execute([$remarks, $diagnosis_id]);
}

function getDiagnosisById($diagnosis_id, $user_id, $is_doctor = false) {
    global $pdo;
    
    if ($is_doctor) {
        $stmt = $pdo->prepare("
            SELECT d.*, i.image_path, i.file_name, u.full_name, u.email, u.age, u.gender
            FROM diagnoses d
            JOIN images i ON d.image_id = i.id
            JOIN users u ON i.user_id = u.id
            WHERE d.id = ?
        ");
        $stmt->execute([$diagnosis_id]);
    } else {
        $stmt = $pdo->prepare("
            SELECT d.*, i.image_path, i.file_name, u.full_name, u.email, u.age, u.gender
            FROM diagnoses d
            JOIN images i ON d.image_id = i.id
            JOIN users u ON i.user_id = u.id
            WHERE d.id = ? AND i.user_id = ?
        ");
        $stmt->execute([$diagnosis_id, $user_id]);
    }
    
    return $stmt->fetch();
}

function getDiagnosisStats() {
    global $pdo;
    
    $stats = [];
    $stmt = $pdo->query("SELECT COUNT(*) FROM diagnoses");
    $stats['total'] = $stmt->fetchColumn();
    
    $stmt = $pdo->query("SELECT severity, COUNT(*) FROM diagnoses GROUP BY severity");
    $stats['by_severity'] = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    
    $stmt = $pdo->query("SELECT disease, COUNT(*) FROM diagnoses GROUP BY disease");
    $stats['by_disease'] = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    
    $stmt = $pdo->query("SELECT AVG(confidence) FROM diagnoses");
    $stats['avg_confidence'] = round($stmt->fetchColumn(), 2);
    
    return $stats;
}
?>