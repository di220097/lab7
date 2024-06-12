<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./users.css">
    <title>Users Page</title>
</head>
<body>
    <br><br><br><br>
    <h1 style="text-align: center;">Hello! Welcome to Users Database.</h1><br>
    <table>
        <thead>
            <tr>
                <th>NAME</th>
                <th>MATRIC</th>
                <th>PASSWORD</th>
                <th>ROLE</th>
                <th>DELETE</th>
                <th>UPDATE</th>
            </tr>
        </thead>
        <tbody>
        <?php
            require('database.php');
            $data = Database::selectData();
            if (isset($_GET['delete'])) {
                $matric = $_GET['delete'];
                $result = Database::delete($matric);
                if ($result) {
                    echo "<script>alert('Record deleted successfully.'); window.location.href = 'users.php';</script>";
                } else {
                    echo "<script>alert('Error deleting record.');</script>";
                }
            }

            if (count($data) > 0) {
                foreach ($data as $row) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['matric']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['password']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['role']) . '</td>';
                    echo '<td><a href="?delete=' . urlencode($row['matric']) . '">Delete</a></td>';
                    echo '<td><a href="update.php?matric=' . urlencode($row['matric']) . '">Update</a></td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="6">No users found.</td></tr>';
            }
        ?>
        </tbody>
    </table>
    <br>
    <br>
    <br>
    <a href="./login.php" 
            class="center-logout">Log Out</a>
</body>
</html>
