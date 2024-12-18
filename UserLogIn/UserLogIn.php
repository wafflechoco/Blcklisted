<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blcklisted - User Login</title>
    <link rel="stylesheet" href="UserLogIn.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div>
                <p style="margin-top: 15px; font-size: 14px; color: #fff;">
                    <a href="MainPage.php" style="color: #fff; text-decoration: underline;">Return to Home Page</a>
                </p>
            </div>
            <div class="logo">
                <img src="img/newlogo-white-complete.png" class="logo_img">
            </div>

            <form action="" method="POST">
                <div class="input-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="login-button">Login</button>
            </form>

            <p style="margin-top: 15px; font-size: 14px; color: #fff;">
                Don't have an account? <a href="RegisterUser.php" style="color: #fff; text-decoration: underline;">Register here</a>
            </p>
            <img src="img/bgdarken.png" id="bg-image">
        </div>
    </div>

    <?php
    session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection details
    $host = '127.0.0.1';
    $port = '3307';
    $username = 'root';
    $password = '';
    $dbname = 'blcklisted';

    // Create connection
    $conn = new mysqli($host, $username, $password, $dbname, $port);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM client WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if ($password === $user['password']) {
            $_SESSION['user_id'] = $user['customerID'];
            $_SESSION['username'] = $user['username'];

            header("Location: dashboard.php");
            exit();
        } else {
            echo "<p style='color: red; text-align: center;'>Invalid credentials!</p>";
        }
    } else {
        echo "<p style='color: red; text-align: center;'>User not found!</p>";
    }

    $conn->close();
}
?>

</body>
</html>
