<?php
session_start();
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin WHERE username='$username'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    // Şifreyi doğrula
    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            header('Location: page2.php');
        } else {
            $error = "Wrong Password!";
        }
    } else {
        $error = "The user not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Admin</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Video Admin</h1>
    </div>
    <hr class="header-line">
    <form method="post">
        <h1>Login</h1>
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Log in</button>
    </form>
</body>
</html>
