<?php
// notifications.php - Handle real-time notifications
require_once 'config.php';
require_once 'functions.php';

requireLogin();

$user_id = $_SESSION['user_id'];

// Mark as read
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['notification_id'])) {
    $stmt = $pdo->prepare("UPDATE notifications SET is_read = 1 WHERE id = ? AND user_id = ?");
    $stmt->execute([$_POST['notification_id'], $user_id]);
    exit(json_encode(['success' => true]));
}

// Get unread count
if (isset($_GET['count'])) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM notifications WHERE user_id = ? AND is_read = 0");
    $stmt->execute([$user_id]);
    echo json_encode(['count' => $stmt->fetchColumn()]);
    exit();
}

// Get notifications
$stmt = $pdo->prepare("
    SELECT * FROM notifications 
    WHERE user_id = ? 
    ORDER BY created_at DESC 
    LIMIT 20
");
$stmt->execute([$user_id]);
$notifications = $stmt->fetchAll();

header('Content-Type: application/json');
echo json_encode($notifications);
?>