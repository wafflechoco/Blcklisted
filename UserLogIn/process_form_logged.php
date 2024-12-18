<?php
// Start the session to access the customerID
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Clean the output buffer to avoid any accidental HTML output before JSON
ob_clean();

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
    echo json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

// Check if the user is logged in by checking the session
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit;
}

// Get the customerID from the session
$customerID = $_SESSION['user_id'];

// Check if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $plateNumber = trim($_POST['plateNumber'] ?? '');
    $VIN = trim($_POST['VIN'] ?? '');
    $instruction = trim($_POST['instruction'] ?? '');
    $carModel = trim($_POST['model'] ?? '');
    $date = trim($_POST['date'] ?? '');
    $time = trim($_POST['time'] ?? '');
    $services = $_POST['services'] ?? [];

    // Validate required fields
    $errors = [];
    if (empty($plateNumber)) $errors[] = "Plate Number is required.";
    if (empty($VIN)) $errors[] = "VIN is required.";
    if (empty($instruction)) $errors[] = "Instruction is required.";
    if (empty($carModel)) $errors[] = "Car model is required.";
    if (empty($date)) $errors[] = "Preferred date is required.";
    if (empty($time)) $errors[] = "Preferred time is required.";
    if (empty($services)) $errors[] = "At least one service must be selected.";

    // If there are validation errors, return them as JSON
    if (!empty($errors)) {
        echo json_encode(['status' => 'error', 'errors' => $errors]);
        exit;
    }

    // Insert booking data into the `booking` table
    $stmt = $conn->prepare("INSERT INTO booking (appointmentDate, appointmentTime, customerID, plateNumber, VIN, instruction, carModel) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssissss', $date, $time, $customerID, $plateNumber, $VIN, $instruction, $carModel);
    if (!$stmt->execute()) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to save booking data.']);
        exit;
    }

    $bookingID = $conn->insert_id;

    // Insert services into the `booking service` table
    foreach ($services as $serviceID) {
        $stmt = $conn->prepare("INSERT INTO `booking service` (bookingID, serviceID) VALUES (?, ?)");
        $stmt->bind_param('is', $bookingID, $serviceID);
        if (!$stmt->execute()) {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save service data.']);
            exit;
        }
    }

    // Return a success response as JSON
    echo json_encode(['status' => 'success', 'message' => 'Form submitted successfully!']);
    exit;
}

// Close connection
$conn->close();
?>
