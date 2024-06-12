<?php
session_start();
require_once './Database.php';

if (isset($_POST['login_button'])) {
    $_SESSION['validate'] = false;
    $matric = $_POST['matric'];
    $password = $_POST['password'];

    if (!empty($matric) && !empty($password)) {
        $conn = Database::connect();

        if ($conn) {
            $p = $conn->prepare('SELECT * FROM users WHERE matric = :m AND password = :p');
            $p->bindValue(':m', $matric);
            $p->bindValue(':p', $password);
            $p->execute();

            if ($p->rowCount() > 0) {
                $_SESSION['matric'] = $matric;
                $_SESSION['password'] = $password;
                $_SESSION['validate'] = true;
                echo '<script>alert("Successful!");</script>';
                header('Location: users.php');
                exit();
            } else {
                echo '<script>alert("No matching user found!");</script>';
            }
        } else {
            echo '<script>alert("Connection to database failed!");</script>';
        }
    } else {
        echo '<script>alert("Matric number and password are required!");</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./signIn.css">
    <title>Login</title>
    <style>
        .form {
            width: 230px;
            height: 280px;
            margin: 0 auto;
        }
        .form .title {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="form">
        <div class="title">
            <p>Login</p>
        </div>
        <form action="" method="post">
            <input type="text" name="matric" placeholder="Matric" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login" name="login_button">
            <a href="./register.php" style="display: block; text-align: center; font-size: 14px; margin-top: 10px;">Click here to sign up</a>
        </form>
    </div>
</body>
</html>