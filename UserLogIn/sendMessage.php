<?php
include('config.php'); // Make sure your DB connection is correct

// Ensure session is started
session_start();

// Check if session variables are set
if (!isset($_SESSION['visitor_msg_id'])) {
    $_SESSION['visitor_msg_id'] = rand(100000, 999999); // Initialize the session ID for the visitor if not set
}

// Check if the form has been submitted (or message has been sent)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message'])) {
    $message = trim($_POST['message']);
    $visitorMsgId = $_SESSION['visitor_msg_id']; // Make sure the session variable is set

    if (!empty($message)) {
        // Prevent multiple submissions by checking if the message already exists
        $stmt = $conn->prepare("SELECT * FROM message WHERE msg = ? AND incoming_msg_id = ?");
        $stmt->bind_param("si", $message, $visitorMsgId);
        $stmt->execute();
        $result = $stmt->get_result();

        // If the message already exists in the database, don't insert it again
        if ($result->num_rows == 0) {
            // Insert the new message into the database
            $stmt = $conn->prepare("INSERT INTO message (msg, incoming_msg_id, outgoing_msg_id) VALUES (?, ?, ?)");
            $staffMsgId = 87654; // Use your actual staff message ID
            $stmt->bind_param("sii", $message, $visitorMsgId, $staffMsgId);
            if ($stmt->execute()) {
                echo "Message sent successfully.";
            } else {
                echo "Error: " . $stmt->error;
            }
        } else {
            echo "Message is already in the database.";
        }
    }
} else {
    echo "No message sent.";
}
?>
