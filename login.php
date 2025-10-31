<?php
session_start();
include 'db-test.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            header("Location: view.php");
            exit;
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found.";
    }

    $stmt->close();
}
$conn->close();
?>
<!------
<?php
//$password = "arun"; // Replace this with the actual plain-text password
//$hashed_password = password_hash($password, PASSWORD_DEFAULT);

//echo $hashed_password;
?>
------->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 400px; margin: 50px auto; background-image: url('assets/img/hero-img.jpg'); background-repeat: no-repeat;background-position: center center;background-size: cover;background-attachment: fixed;background-color: #f0f0f0;}
        .error { color: red; }
        input { width: 100%; padding: 8px; margin: 10px 0; }
        button { padding: 10px; background-color: #4CAF50; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #45a049; }       
    </style>    
</head>
<body>
</br></br></br></br></br></br></br></br></br></br></br></br>
    <h2>ArunCloudWhiz Login Portal</h2>
    <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
    <form method="post" action="">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>

