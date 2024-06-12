<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./signup.css">
    <title>Sign Up</title>
    <style>
        /* Center the message */
        .center {
            text-align: center;
            margin-top: 20px;
        }
        .pink-button {
            background-color: pink;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .pink-button:hover {
            background-color: #ff69b4;
        }
    </style>
</head>
<body>
<?php
require_once 'database.php'; // Ensure the correct file path

if (isset($_POST['signUp_button'])) {
    $name = $_POST['name'];
    $matric = $_POST['matric'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    
    if (!empty($name) && !empty($matric) && !empty($password) && !empty($role)) {
        $conn = Database::connect();
        $p = $conn->prepare('INSERT INTO users (name, matric, password, role) VALUES (:n, :m, :p, :r)');
        $p->bindValue(':n', $name);
        $p->bindValue(':m', $matric);
        $p->bindValue(':p', $password);
        $p->bindValue(':r', $role);
        $p->execute();
        echo '<script>alert("Added successfully!");</script>';
    } else {
        echo '<script>alert("You have registered!");</script>';
    }
}
?>

    <div class="form">
        <div class="title">
            <p>Register Form</p>
        </div>
        <form action="" method="post">
            <input type="text" name="matric" placeholder="Matric" required>
            <input type="text" name="name" placeholder="Name" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="role" placeholder="Role (Lecturer/Student)" required>
            <input type="submit" value="Sign Up" name="signUp_button" class="pink-button"> 
            <a href="./login.php">Do you have an account? Sign in</a>
        </form>
    </div>
</body>
</html>