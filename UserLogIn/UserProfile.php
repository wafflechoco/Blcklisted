<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="UserProfile.css">
    <title>Blacklisted Page - Account Information</title>
</head>

<body>
    <?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        // Redirect to login if not logged in
        header("Location: UserLogIn.html");
        exit();
    }

    $user_id = $_SESSION['user_id'];

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

    $user_id = $_SESSION['user_id'] ?? $user_id; 

    $sql = "SELECT * FROM client WHERE customerID = $user_id";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Update profile logic
        $last_name = $conn->real_escape_string($_POST['lastName']);
        $first_name = $conn->real_escape_string($_POST['firstName']);
        $middle_name = $conn->real_escape_string($_POST['middleName']);
        $username = $conn->real_escape_string($_POST['username']);
        $contact_number = $conn->real_escape_string($_POST['contactNumber']);
        $gender = $conn->real_escape_string($_POST['gender']);
        $address = $conn->real_escape_string($_POST['address']);
        $email = $conn->real_escape_string($_POST['email']);

        $update_sql = "UPDATE client SET 
            lastName = '$last_name', 
            firstName = '$first_name', 
            middleName = '$middle_name',
            username = '$username', 
            contactNumber = '$contact_number', 
            gender = '$gender',
            address = '$address', 
            email = '$email' 
            WHERE customerID = $user_id";

        if ($conn->query($update_sql) === TRUE) {
            echo "<p style='color: green; text-align: center; '>Profile updated successfully!</p>";
            $result = $conn->query($sql);
            $user = $result->fetch_assoc();
        } else {
            echo "<p style='color: red; text-align: center;'>Error updating profile: " . $conn->error . "</p>";
        }
    }
    ?>

    <div class="blacklisted-background">
        <div class="account-info-container">
            <div class="header">
                <h1>Account Information</h1>
                <a href="dashboard.php" class="return-home">Return to Home Page</a>
            </div>
            <div class="profile">
                <img src="profile-placeholder.png" alt="Profile Image" class="profile-img">
                <div class="profile-details">
                    <p><?php echo htmlspecialchars($user['firstName'] . ' ' . $user['lastName']); ?></p>
                    <p><?php echo htmlspecialchars($user['email']); ?></p>
                </div>
            </div>
            <form class="account-form" method="POST">
                <div class="form-row">
                    <div class="form-column">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="lastName" name="lastName" placeholder="Last Name" value="<?php echo htmlspecialchars($user['lastName']); ?>" required>
                    </div>
                    <div class="form-column">
                        <label for="first_name">First Name</label>
                        <input type="text" id="firstName" name="firstName" placeholder="First Name" value="<?php echo htmlspecialchars($user['firstName']); ?>" required>
                    </div>
                    <div class="form-column">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" id="middleName" name="middleName" placeholder="Middle Name" value="<?php echo htmlspecialchars($user['middleName']); ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-column">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                    </div>
                    <div class="form-column">
                        <label for="contact_number">Contact Number</label>
                        <input type="text" id="contactNumber" name="contactNumber" placeholder="Contact Number" value="<?php echo htmlspecialchars($user['contactNumber']); ?>" required>
                    </div>
                    <div class="form-column">
                        <label for="gender">Gender</label>
                        <input type="text" id="gender" name="gender" placeholder="Gender" value="<?php echo htmlspecialchars($user['gender']); ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-column">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" placeholder="Address" value="<?php echo htmlspecialchars($user['address']); ?>" required>
                    </div>
                    <div class="form-column">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                    </div>
                </div>
                <button type="submit" class="save-btn">Save Profile</button>
            </form>
        </div>

        <img src="img/bgdarken.png" id="bg-image">

    </div>

    <?php $conn->close(); ?>
</body>
</html>
