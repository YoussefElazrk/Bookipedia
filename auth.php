<?php
session_start();
require_once 'connect.php'; 
// 1.(Register)
if (isset($_POST['action']) && $_POST['action'] == 'register') {
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email     = mysqli_real_escape_string($conn, $_POST['email']);
    $phone     = mysqli_real_escape_string($conn, $_POST['phone']);
    $address   = mysqli_real_escape_string($conn, $_POST['address']);
    $password  = $_POST['password'];

   
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

   
    $check_email = "SELECT id FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $check_email);

    if (mysqli_num_rows($result) > 0) {
        header("Location: login.php?view=register&error=Email already exists");
        exit();
    } else {
        $sql = "INSERT INTO users (full_name, email, phone, address, password) 
                VALUES ('$full_name', '$email', '$phone', '$address', '$hashed_password')";
        
        if (mysqli_query($conn, $sql)) {
            header("Location: login.php?view=login&success=Account created! Please login.");
            exit();
        } else {
            header("Location: login.php?view=register&error=Registration failed");
            exit();
        }
    }
}

// 2. منطق تسجيل الدخول (Login)
if (isset($_POST['action']) && $_POST['action'] == 'login') {
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        
        // التحقق من كلمة المرور المشفرة
        if (password_verify($password, $user['password'])) {
            // تخزين بيانات المستخدم في الجلسة (Session)
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            $_SESSION['user_email'] = $user['email'];

            header("Location: index.php"); // التوجه للرئيسية بعد النجاح
            exit();
        } else {
            header("Location: login.php?view=login&error=Invalid password");
            exit();
        }
    } else {
        header("Location: login.php?view=login&error=User not found");
        exit();
    }
}
?>