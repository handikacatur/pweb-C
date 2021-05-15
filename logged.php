<?php

session_start();

require 'db.php';

if (isset($_POST['username']) && !isset($_GET['logout']) && !isset($_SESSION['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = 'INSERT INTO user (username, password) VALUE (:username, :password)';
    $statement = $connection ->prepare($query);
    $statement->execute([':username' => $username, 'password' => $password]);

    setcookie('username', $username, time() + (86400 * 30), "/");

    $_SESSION['username'] = $username;
} elseif ( !isset($_GET['logout']) && isset($_SESSION['username'])) {
    var_dump($_SESSION['username']);
    $username =  $_COOKIE['username'];
} elseif (isset($_GET['logout']) && $_GET['logout'] == true) {
    setcookie($username, '', time() - 3600);
    
    session_unset();
    session_destroy();

    header('location:index.php');
    exit;
} elseif (!isset($_SESSION['username']) && !isset($_POST['username'])) {
    header('location:index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Tugas</title>
</head>
<body>
    <div class="container" style="margin-top: 100px;">
        <div class="card shadow" style="padding: 50px; border-radius: 10px; max-width: 400px; margin: auto;">
            <h3>Hello! <?= $username ?></h3>
            <a href="/uts/logged.php?logout=true">Logout</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>