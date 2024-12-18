<?php
session_start();
include('config.php');

// Function to fetch the last 10 messages between the visitor and staff
function fetchMessages($visitorMsgId) {
    global $conn;
    
    $query = "SELECT * FROM message WHERE incoming_msg_id = ? OR outgoing_msg_id = ? ORDER BY msg_id DESC"; 
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $visitorMsgId, $visitorMsgId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $messages = [];
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
    return $messages;
}

// Fetch messages for the visitor
$staffMsgId = 87654;  // Use the staff ID
$visitorMsgId = isset($_SESSION['visitor_msg_id']) ? $_SESSION['visitor_msg_id'] : null;
if (!$visitorMsgId) {
    $_SESSION['visitor_msg_id'] = rand(100000, 999999);  // Generate a random visitor ID
    $visitorMsgId = $_SESSION['visitor_msg_id'];
}

$messages = fetchMessages($visitorMsgId);

// Generate the message HTML for injection
foreach ($messages as $message):
    if ($message['incoming_msg_id'] == 87654): ?>
        <div class="messages__item messages__item--visitor"><?= htmlspecialchars($message['msg']) ?></div>
    <?php else: ?>

        <div class="messages__item messages__item--operator"><?= htmlspecialchars($message['msg']) ?></div>
    <?php endif; endforeach; ?>
