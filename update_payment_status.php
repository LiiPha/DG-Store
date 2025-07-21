<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}

$host = "localhost";
$user = "root";
$pass = "";
$db = "product";
$conn = new mysqli($host, $user, $pass, $db);

// Only handle POST when the "Mark as Paid" button is clicked
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mark_paid'])) {
    $orderId = intval($_POST['order_id']);

    $stmt = $conn->prepare("UPDATE orders SET pay = 'Paid' WHERE id = ?");
    $stmt->bind_param("i", $orderId);

    if ($stmt->execute()) {
        header("Location: admin_dashboard.php");
        exit;
    } else {
        echo "❌ Error updating status: " . $stmt->error;
    }
} else {
    echo "❌ Invalid request.";
}
?>
