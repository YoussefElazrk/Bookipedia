<?php
require_once 'connect.php';
session_start();


if (isset($_GET['action']) && $_GET['action'] === 'checkout') {
    $uid = $_SESSION['user_id'];
    
   
    $conn->query("DELETE FROM cart WHERE user_id = $uid");
    
   
    header("Location: index.php?ordered=true");
    exit();
}

$response = ['success' => false, 'cart_count' => 0];


if (isset($_SESSION['user_id']) && isset($_POST['book_id'])) {
    $uid = $_SESSION['user_id'];
    $bid = (int)$_POST['book_id'];
    $qty = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

    
    $check = $conn->query("SELECT quantity FROM cart WHERE user_id = $uid AND book_id = $bid");

    if ($check->num_rows > 0) {
       
        $conn->query("UPDATE cart SET quantity = quantity + $qty WHERE user_id = $uid AND book_id = $bid");
    } else {
        
        $conn->query("INSERT INTO cart (user_id, book_id, quantity) VALUES ($uid, $bid, $qty)");
    }

    
    $count_res = $conn->query("SELECT SUM(quantity) as total FROM cart WHERE user_id = $uid");
    $count_data = $count_res->fetch_assoc();
    
    $response['success'] = true;
    $response['cart_count'] = $count_data['total'] ?? 0;
    
}


header('Content-Type: application/json');
echo json_encode($response);