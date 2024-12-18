<?php

session_start();

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

header('Content-Type: application/json'); // Ensure JSON response

$response = [];

// Database connection
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

try {
    if (isset($_SESSION['user_id'])) {
        $customerID = $_SESSION['user_id'];

        // Fetch client details from the database
        $stmt = $conn->prepare("SELECT lastName, middleName, firstName, email, contactNumber, address FROM client WHERE customerID = ?");
        $stmt->bind_param("i", $customerID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $clientData = $result->fetch_assoc();

            // Store data in session variables
            $lastName = $clientData['lastName'];
            $middleName = $clientData['middleName'];
            $firstName = $clientData['firstName'];
            $email = $clientData['email'];
            $phone = $clientData['contactNumber'];
            $address = $clientData['address'];

        } else {
            throw new Exception("Client data not found.");
        }

        $stmt->close();
    } else {
        throw new Exception("User ID not found in session.");
    }

    // Handle the POST request for sending the email
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['plateNumber']) && !empty($_POST['plateNumber'])) {
            // Collect form inputs (sanitization as in your original code)
            $plateNumber = htmlspecialchars($_POST['plateNumber']);
            $VIN = htmlspecialchars($_POST['VIN']);
            $instruction = htmlspecialchars($_POST['instruction']);
            $carModel = htmlspecialchars($_POST['model']);
            $preferredDate = htmlspecialchars($_POST['date']);
            $preferredTime = htmlspecialchars($_POST['time']);
            $services = isset($_POST['services']) ? implode(", ", $_POST['services']) : 'No services selected';

            // Email sending logic (same as in your original code)

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'shantinasuruiz@gmail.com';
            $mail->Password = 'lryq zybi wwwe xnbc';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('shantinasuruiz@gmail.com', 'Blcklisted Motorsports');
            $mail->addAddress('suruizshantina@gmail.com');
            $mail->addReplyTo('shantinasuruiz@gmail.com', 'Blcklisted Motorsports');

            $mail->isHTML(true);
            $mail->Subject = 'Your Service Appointment Confirmation';
            $mail->Body = "
            <div style='font-family: Arial, sans-serif; background-color: #f4f4f4; color: #333; padding: 20px; line-height: 1.6;'>
                <div style='max-width: 600px; margin: auto; background-color: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1);'>
                    <div style='background: linear-gradient(to bottom, #000000, #333333); padding: 20px; color: #fff; text-align: center;'>
                        <img src='https://i.postimg.cc/rFKCzcmk/newlogo-white-complete.png' alt='Blcklisted Motorsports' style='width: 50%; max-width: 600px; border-radius: 10px;'>
                        <p style='margin: 0; font-size: 16px;'>Your Trusted Auto Accessory Partner</p>
                    </div>
                    <div style='padding: 30px;'>
                        <h2 style='color: #212121; font-size: 22px;'>Appointment Confirmation</h2>
                        <p style='color: #666;'>Hi <strong>$firstName $lastName</strong>,</p>
                        <p style='color: #666;'>Thank you for booking your service with Blcklisted Motorsports! Please review your appointment details below:</p>
                        <table style='width: 100%; border-collapse: collapse; color: #444;'>
                            <tr style='background-color: #f9f9f9;'>
                                <td style='padding: 10px; border: 1px solid #ddd;'><strong>Full Name:</strong></td>
                                <td style='padding: 10px; border: 1px solid #ddd;'>$lastName, $firstName $middleName</td>
                            </tr>
                            <tr>
                                <td style='padding: 10px; border: 1px solid #ddd;'><strong>Email:</strong></td>
                                <td style='padding: 10px; border: 1px solid #ddd;'>$email</td>
                            </tr>
                            <tr style='background-color: #f9f9f9;'>
                                <td style='padding: 10px; border: 1px solid #ddd;'><strong>Phone:</strong></td>
                                <td style='padding: 10px; border: 1px solid #ddd;'>$phone</td>
                            </tr>
                            <tr>
                                <td style='padding: 10px; border: 1px solid #ddd;'><strong>Address:</strong></td>
                                <td style='padding: 10px; border: 1px solid #ddd;'>$address</td>
                            </tr>
                            <tr style='background-color: #f9f9f9;'>
                                <td style='padding: 10px; border: 1px solid #ddd;'><strong>Car Model:</strong></td>
                                <td style='padding: 10px; border: 1px solid #ddd;'>$carModel</td>
                            </tr>
                            <tr style='background-color: #f9f9f9;'>
                                <td style='padding: 10px; border: 1px solid #ddd;'><strong>Plate Number:</strong></td>
                                <td style='padding: 10px; border: 1px solid #ddd;'>$plateNumber</td>
                            </tr>
                            <tr style='background-color: #f9f9f9;'>
                                <td style='padding: 10px; border: 1px solid #ddd;'><strong>Vehicle Identification Number:</strong></td>
                                <td style='padding: 10px; border: 1px solid #ddd;'>$VIN</td>
                            </tr>
                            <tr>
                                <td style='padding: 10px; border: 1px solid #ddd;'><strong>Preferred Date:</strong></td>
                                <td style='padding: 10px; border: 1px solid #ddd;'>$preferredDate</td>
                            </tr>
                            <tr style='background-color: #f9f9f9;'>
                                <td style='padding: 10px; border: 1px solid #ddd;'><strong>Preferred Time:</strong></td>
                                <td style='padding: 10px; border: 1px solid #ddd;'>$preferredTime</td>
                            </tr>
                            <tr>
                                <td style='padding: 10px; border: 1px solid #ddd;'><strong>Services Selected:</strong></td>
                                <td style='padding: 10px; border: 1px solid #ddd;'>$services</td>
                            </tr>
                            <tr>
                                <td style='padding: 10px; border: 1px solid #ddd;'><strong>Instructions/ Preferences:</strong></td>
                                <td style='padding: 10px; border: 1px solid #ddd;'>$instruction</td>
                            </tr>
                        </table>
                        <p style='color: #666; margin-top: 20px;'>If you need to modify your appointment or have any questions, feel free to contact us.</p>
                    </div>
            
                    <div style='background: linear-gradient(to bottom, #333333, #000000); padding: 20px; text-align: center; color: #fff;'>
                        <p style='margin: 0; font-size: 14px;'>Blcklisted Motorsports - All Rights Reserved</p>
                        <p style='margin: 0; font-size: 14px;'>Contact us:</p>
                        <p style='margin: 10px 0;'>
                            <img src='https://img.icons8.com/ios-filled/16/ffffff/filled-message.png' alt='Email Icon' style='margin-right: 8px;'> 
                            <span style='color: #fff; text-decoration: none;'>blcklisted@gmail.com</span>

                            <img src='https://img.icons8.com/ios-filled/16/ffffff/phone.png' alt='Phone Icon' style='margin-right: 8px;'>
                            <span style='color: #fff;'>tel:+631234567890</span>

                            <img src='https://img.icons8.com/ios-filled/16/ffffff/marker.png' alt='Location Icon' style='margin-right: 8px;'>
                            <a href='https://maps.app.goo.gl/jb9gPPh1na1bcm2LA' style='color: #fff; text-decoration: none;'>View Location</a>
                        </p>
                    </div>

                </div>
            </div>
            "; // Your existing email body

            $mail->send();

            $response['status'] = 'success';
            $response['message'] = 'Email sent successfully!';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Missing plate number.';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Invalid request method.';
    }
} catch (Exception $e) {
    $response['status'] = 'error';
    $response['message'] = $e->getMessage();
} finally {
    $conn->close();
}

// Return JSON response
echo json_encode($response);
?>
