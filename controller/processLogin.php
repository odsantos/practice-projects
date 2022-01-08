<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../model/db_connection.php';

if (isset($_POST['login']) && $_POST['login'] === 'login') {
    $email = (isset($_POST['email']) ? strip_tags($_POST['email']) : null);
    $stmt = $dbh->prepare('SELECT * FROM users where email = ?');
    $stmt->execute([$email]);
    
    $count = $stmt->rowCount(); 
    if ($count) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $pwd = (isset($_POST['pwd']) ? password_hash($_POST['pwd'], PASSWORD_DEFAULT) : null);
        
        if ($pwd !== $user['password']) {
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['err'] = 'password';
            header('Location: ../view/login.php');
        }
        
        if (isset($_SESSION['err'])) {
            unset($_SESSION['email']);
            unset($_SESSION['err']);
        }
        
        header('Location: resources.php');
    } else {
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['err'] = 'email address';
        header('Location: ../view/login.php');
    }
} else {
    header('Location: ../view/login.php');
}
