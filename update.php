<?php
require_once 'database.php';

if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];
    $conn = Database::connect();

    $stmt = $conn->prepare('SELECT * FROM users WHERE matric = :matric');
    $stmt->bindParam(':matric', $matric);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo '<script>alert("No such user found!"); window.location.href = "users.php";</script>';
        exit();
    }
} else {
    echo '<script>alert("Matric number is required!"); window.location.href = "users.php";</script>';
    exit();
}

if (isset($_POST['update_button'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (!empty($name) && !empty($password) && !empty($role)) {
        $result = Database::update($matric, $name, $password, $role);

        if ($result) {
            echo '<script>alert("Record updated successfully."); window.location.href = "users.php";</script>';
        } else {
            echo '<script>alert("Error updating record.");</script>';
        }
    } else {
        echo '<script>alert("All fields are required!");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="form-container">
        <h2>Update User Information</h2>
        <form action="" method="post">
            <input type="text" name="name" placeholder="Name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            <input type="password" name="password" placeholder="Password" value="<?php echo htmlspecialchars($user['password']); ?>" required>
            <input type="text" name="role" placeholder="Role (Lecturer/Student)" value="<?php echo htmlspecialchars($user['role']); ?>" required>
            <input type="submit" name="update_button" value="Update">
            <a href="users.php">Back to Users</a>
        </form>
    </div>
</body>
</html>
