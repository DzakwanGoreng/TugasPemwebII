<?php include 'db.php'; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $order_date = $_POST['order_date'];
    $stmt = $pdo->prepare("UPDATE orders SET order_date = ? WHERE id = ?");
    $stmt->execute([$order_date, $id]);
    header("Location: index.php");
}