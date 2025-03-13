<?php include 'db.php'; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = $_POST['customer_id'];
    $order_date = $_POST['order_date'];
    $stmt = $pdo->prepare("INSERT INTO orders (customer_id, order_date) VALUES (?, ?)");
    $stmt->execute([$customer_id, $order_date]);
    header("Location: index.php");
}