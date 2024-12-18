<?php
session_start(); // Start session to manage user session and chat

include('config.php'); // Include the database connection file

// Function to fetch the last 10 messages between the visitor and staff
function fetchMessages($visitorMsgId) {
    global $conn;
    
    $query = "SELECT * FROM message WHERE incoming_msg_id = ? OR outgoing_msg_id = ? ORDER BY msg_id ASC";
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

// Set the visitor's message ID in the session if not already set
$visitorMsgId = isset($_SESSION['visitor_msg_id']) ? $_SESSION['visitor_msg_id'] : null;
if (!$visitorMsgId) {
    $_SESSION['visitor_msg_id'] = rand(100000, 999999);
    $visitorMsgId = $_SESSION['visitor_msg_id'];
}

// Fetch messages from the database
$messages = fetchMessages($visitorMsgId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blcklisted Services</title>
  <link rel="stylesheet" href="MainPageStyle.css">
  <link rel="stylesheet" href="assets/css/chat.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="assets/css/typing.css">
  <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans:wght@300&family=Didact+Gothic&display=swap" rel="stylesheet">
</head>
<body>

<header class="header">
  <img src="img/newlogo-white.png" class="logo" alt="Logo">
  <nav>
    <ul class="nav-links">
      <li><a href="#about">About Us</a></li>
      <li><a href="#services">Services</a></li>
      <li><a href="#findus">Find Us</a></li>
    </ul>
  </nav>
  <a href="UserLogIn/UserLogIn.php" class="request-service">
    <img src="img/login.png" class="req-icon" alt="Request Icon">Log In/ Sign Up
  </a>
</header>


<!-- Start of ChatBot (www.chatbot.com) code -->
<script>
  window.__ow = window.__ow || {};
  window.__ow.organizationId = "6da4a6a0-ec8a-4e8c-bf00-e7a264964c04";
  window.__ow.template_id = "776dbb8b-0973-464d-8d89-c6a718422597";
  window.__ow.integration_name = "manual_settings";
  window.__ow.product_name = "chatbot";   
  ;(function(n,t,c){function i(n){return e._h?e._h.apply(null,n):e._q.push(n)}var e={_q:[],_h:null,_v:"2.0",on:function(){i(["on",c.call(arguments)])},once:function(){i(["once",c.call(arguments)])},off:function(){i(["off",c.call(arguments)])},get:function(){if(!e._h)throw new Error("[OpenWidget] You can't use getters before load.");return i(["get",c.call(arguments)])},call:function(){i(["call",c.call(arguments)])},init:function(){var n=t.createElement("script");n.async=!0,n.type="text/javascript",n.src="https://cdn.openwidget.com/openwidget.js",t.head.appendChild(n)}};!n.__ow.asyncInit&&e.init(),n.OpenWidget=n.OpenWidget||e}(window,document,[].slice))
</script>
<noscript>You need to <a href="https://www.chatbot.com/help/chat-widget/enable-javascript-in-your-browser/" rel="noopener nofollow">enable JavaScript</a> in order to use the AI chatbot tool powered by <a href="https://www.chatbot.com/" rel="noopener nofollow" target="_blank">ChatBot</a></noscript>
<!-- End of ChatBot code -->


<!-----------------------------Main Content (About Us, Services, etc.)---------------------------->

<!-- About Us Section -->
<div class="mainpage-container" id="about">
  <div class="text-content">
    <div class="logo1">
      <img src="img/newlogo-white-complete.png" alt="Customized logo">
    </div>
    <p>Blcklisted Auto Accessories provides high-quality automotive accessories and customizations to elevate your vehicle's style and performance. Explore our selection to make your car one-of-a-kind.</p>
    <a href="#services" class="get-started">Get Started</a>
  </div>
  <div class="car-image">
    <img src="img/Blcklisted (1).png" alt="Customized Car">
  </div>
</div>

<!-- Services Section -->
<div class="services-container" id="services">
  <img src="img/services bg.jpg" id="bg-image" alt="Services Background">
  <section class="services">
    <button class="nav-arrow left-arrow">&#10094;</button>
    <div class="service-card">
      <img src="img/accessories.png" alt="Accessories Installation">
      <h2>Accessories<br>Installation</h2>
      <p>Our accessories installation service enhances your vehicle's performance and appearance. With skilled technicians, we ensure seamless integration of your chosen accessories, tailored to your needs for a customized ride. Experience quality upgrades that prioritize safety and performance.</p>
    </div>
    <div class="service-card">
      <img src="img/2.png" alt="Customization Services">
      <h2>Customization<br>Services</h2>
      <p>Our customization services enhance your vehicle to match your unique style. Our expert team collaborates with you to create personalized modifications while ensuring quality and safety. Transform your ride with custom features that truly stand out.</p>
    </div>
    <div class="service-card">
      <img src="img/3.png" alt="Maintenance Services">
      <h2>Maintenance<br>Services</h2>
      <p>Our maintenance services ensure your vehicle runs smoothly and efficiently. Our skilled technicians conduct thorough inspections and routine upkeep, focusing on quality and safety to prevent issues before they arise, giving you peace of mind on the road.</p>
    </div>
    <button class="nav-arrow right-arrow">&#10095;</button>
  </section>
</div>

<!-- Find Us Section -->
<div class="find-us-container" id="findus">
  <div class="info-section">
    <h1>Get In Touch With Us</h1>
    <p>We’d love to connect with you! Visit us at our store to explore our services firsthand or reach out for any questions. Our team is here to provide details, answer inquiries, and help you make the best decisions for your vehicle. Feel free to reach us through phone, email, and our social medias. We’re excited to assist you!</p>
    <div class="contact-details">
      <div class="contact-card-1">
        <img src="img/loc icon.png" class="find-us-icons" alt="Location Icon">
        <p class="head">Our Location</p>
        <p class="sub-info"><a href="https://tinyurl.com/33pvxerb" target="_blank" style="color: #fff; text-decoration: none;">tinyurl.com/33pvxerb</a></p>
      </div>
      <div class="contact-card-2">
        <img src="img/clock icon.png" class="find-us-icons" alt="Clock Icon">
        <p class="head">Working Hours</p>
        <p class="sub-info">Mon-Sat 9:00AM-5:00PM</p>
      </div>
      <div class="contact-card-1">
        <img src="img/phone icon.png" class="find-us-icons" alt="Phone Icon">
        <p class="head">Phone Number</p>
        <p class="sub-info">+631234567890</p>
      </div>
      <div class="contact-card-2">
        <img src="img/envelope.png" class="find-us-icons" alt="Envelope Icon">
        <p class="head">Email Us</p>
        <p class="sub-info">blcklisted@gmail.com</p>
      </div>
    </div>
    <div class="social-links">
        <div class="social-item">
            <img src="img/facebook.png" class="find-us-icons">
            <a href="https://www.facebook.com/blcklistedmotorsports" target="_blank">Facebook: /blcklistedmotorsports</a>
        </div>
        <div class="social-item">
            <img src="img/instagram.png" class="find-us-icons">
            <a href="https://www.instagram.com" target="_blank">Instagram: /blcklistedmotorsports</a>
        </div>
        <div class="social-item">
          <img src="img/youtube.png" class="find-us-icons">
          <a href="https://www.youtube.com/@blcklistedmotorsports" target="_blank">Youtube: /Blcklisted Motorsports</a>
        </div>
        <div class="social-item">
          <img src="img/tik-tok.png" class="find-us-icons">
          <a href="https://www.tiktok.com/@blcklisted0001" target="_blank">Tiktok: /Blcklisted Motorsports</a>
        </div>
    </div>
  </div>
  <div class="map-section">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3854.8243544465813!2d120.8455011756509!3d14.946875985581636!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x339655da545b4aed%3A0x14d175c569e7903!2sBlcklisted%20Auto%20Accessories%20Trading%20(RLN%20Car%20Accessories)!5e0!3m2!1sen!2sph!4v1731827642124!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>

<footer>
  <p>© 2024 Blcklisted Motorsports. All rights reserved.</p>
</footer>

<script>
// JavaScript to send and fetch messages dynamically


// Function to load chat messages
function loadMessages() {
        fetch('message.php')
            .then(response => response.text())
            .then(data => {
                const chatMessages = document.querySelector('.chatbox__messages');
                chatMessages.innerHTML = data;
                scrollToBottom(); // Ensure new messages are visible
            })
            .catch(error => {
                console.error('Error fetching messages:', error);
            });
    }

    // Automatically fetch messages every 3 seconds
    setInterval(loadMessages, 3000); // Fetch new messages every 3 seconds

    // Function to scroll chat to the bottom
    function scrollToBottom() {
        const chatMessages = document.querySelector('.chatbox__messages');
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Initial load of messages when the page loads
    loadMessages();

// Handle message sending
document.querySelector('#send-message').addEventListener('click', function() {
    const messageInput = document.querySelector('#visitor-message');
    const message = messageInput.value;
    const sendButton = document.querySelector('#send-message');

    if (message.trim() !== '') {
        // Disable the button to prevent multiple clicks
        sendButton.disabled = true;
        
        // Send the message using AJAX (fetch API)
        fetch('sendMessage.php', {
            method: 'POST',
            body: new URLSearchParams({ 'message': message })
        }).then(response => response.text())
          .then(data => {
              console.log(data); // Log the response from the server
              messageInput.value = ''; // Clear the input field
              sendButton.disabled = false; // Enable the button again
              loadMessages(); // Reload the chatbox messages (optional)
          }).catch(error => {
              console.error('Error sending message:', error);
              sendButton.disabled = false; // Enable the button again if there's an error
          });
    }
});

// Initial load of messages when the page loads
loadMessages();

fetch('message.php')
    .then(response => response.text())
    .then(data => {
        console.log(data); // Check the data being fetched
        document.querySelector('.chatbox__messages').innerHTML = data;
    })
    .catch(error => {
        console.error('Error fetching messages:', error);
    });



    fetch('message.php')
    .then(response => response.text())
    .then(data => {
        console.log(data); // Check what the server sends
        document.querySelector('.chatbox__messages').innerHTML = data;
    })
    .catch(error => {
        console.error('Error fetching messages:', error);
    });


</script>

</body>
</html>
