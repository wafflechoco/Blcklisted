<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blcklisted - User Registration</title>
    <link rel="stylesheet" href="RegisterUser.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="logo">
                <img src="img/newlogo-white-complete.png" class="logo_img">
            </div>
            <form action="" method="POST">

                <div class="input-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="input-group">
                    <label for="confirm-password">Confirm Password:</label>
                    <input type="password" id="confirm-password" name="confirm-password" required>
                </div>

                <div class="input-group-row">
                    <div class="input-field">
                        <label for="last_name">Last Name:</label>
                        <input type="text" id="last_name" name="last_name" required>
                    </div>
                    <div class="input-field">
                        <label for="first_name">First Name:</label>
                        <input type="text" id="first_name" name="first_name" required>
                    </div>
                    <div class="input-field">
                        <label for="middle_name">Middle Name:</label>
                        <input type="text" id="middle_name" name="middle_name">
                    </div>
                </div>

                <div class="input-group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" required>
                </div>
                <div class="input-group">
                    <label for="contact_number">Contact Number:</label>
                    <input type="text" id="contact_number" name="contact_number" required>
                </div>

                <div class="input-group">
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender" required>
                        <option value="" disabled selected>Select your gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <button type="submit" class="login-button">Register</button>
            </form>

            <p style="margin-top: 15px; font-size: 14px;">
                Already have an account? <a href="UserLogin.php" style="color: #fff; text-decoration: underline;">Login</a>
            </p>
            <img src="img/bgdarken.png" id="bg-image">
        </div>
    </div>

    <?php
    // Database connection
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

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm-password'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $middle_name = $_POST['middle_name'];
        $address = $_POST['address'];
        $contact_number = $_POST['contact_number'];
        $gender = $_POST['gender'];

        if ($password !== $confirm_password) {
            die("Passwords do not match!");
        }

        $sql = "INSERT INTO client (username, email, password, firstName, lastName, middleName, address, contactNumber, gender)
                VALUES ('$username', '$email', '$password', '$first_name', '$last_name', '$middle_name', '$address', '$contact_number', '$gender')";

        if ($conn->query($sql) === TRUE) {
            header("Location: UserLogIn.php"); // Corrected the redirection
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>
</body>
</html>
