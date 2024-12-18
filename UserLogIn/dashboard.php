<?php
//code to dashboard need to input on html


session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to login if not logged in
    header("Location: UserLogIn.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];




?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blcklisted Services</title>
  <link rel="stylesheet" href="MainPageStyle.css">
  <link rel="stylesheet" href="logout_modal.css">
  <link rel="stylesheet" href="assets/css/chat.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="assets/css/typing.css">
  <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans:wght@300&family=Didact+Gothic&display=swap" rel="stylesheet">

  <style>
    /* Profile menu container */
/* Profile menu container */
.profile-menu {
    position: relative;
    display: inline-block;
}

/* Profile header (icon + name) */
.profile-header {
    display: flex;
    align-items: center;
    cursor: pointer;
}

.profile-header img {
    width: 25px;
    height: 25px;
    margin: 0;
    padding-left: 50px;
}

.profile-header span {
    color: white;
    margin: 0;
    padding-left: 10px;
    font-size: 16px;
    text-decoration: none;
}

/* Dropdown menu */
.dropdown-content {
    display: block;
    position: absolute;
    left: 0;
    background-color: #333;
    color: white;
    border-radius: 4px;
    padding: 10px;
    margin-left: 50px;
    margin-top: 15px;
    z-index: 100;
    width: 200px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    opacity: 0; /* Start with invisible dropdown */
    transform: translateY(-10px); /* Start with dropdown slightly above */
    visibility: hidden; /* Make sure it's hidden initially */
    transition: opacity 0.3s ease, transform 0.3s ease, visibility 0s 0.3s; /* Transition for opacity, position, and visibility */
}

/* Show dropdown with transition */
.dropdown-content.show {
    opacity: 1;
    transform: translateY(0); /* Move the dropdown into place */
    visibility: visible; /* Make it visible */
    transition: opacity 0.3s ease, transform 0.3s ease;
}

/* Dropdown menu links */
.dropdown-content a, #home-link {
    display: block;
    color: white;
    text-decoration: none;
    margin: 5px 0;
    padding: 8px 12px;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.dropdown-content a:hover {
    background-color: #555;
}

.modal-content {
    color: black;
}





</style>


</head>
<body>

<header class="header">
<div class="profile-menu">
    <div class="profile-header" onclick="toggleDropdown()">
        <img src="img/circle-user(white).png" alt="User Icon">
        <span><?php echo htmlspecialchars($username); ?></span>
    </div>
    <div id="dropdown" class="dropdown-content">
        <a href='userprofile.php'>Account Information</a>
        <a href="appointment_history.php">Appointment History</a>
        <span id="home-link">Log Out</span>
    </div>
</div>


  <nav>
    <ul class="nav-links">
      <li><a href="#about">About Us</a></li>
      <li><a href="#services">Services</a></li>
      <li><a href="#findus">Find Us</a></li>
    </ul>
  </nav>
  <a href="ServiceRequest_logged.html" class="request-service">
    <img src="img/request icon.png" class="req-icon" alt="Request Icon">Request a Service
  </a>
</header>

  <div id="overlay" class="overlay"></div>

      <div id="modal" class="modal-overlay">
          <div class="modal-content">
              <div class="modal-title">Are you sure you want to log out?</div>
              <div class="modal-text">Are you sure you want to leave this page? You will be redirected to the log in page.</div>
                <div class="modal-buttons">
                    <button class="modal-button yes" id="confirm-leave">YES</button>
                    <button class="modal-button no" id="cancel-leave">NO</button>
                </div>
          </div>
      </div>

<!------------------------------Chat System------------------------------>
<div class="container">
    <div class="chatbox">
        <div class="chatbox__support">
            <div class="chatbox__header">
                <div class="chatbox__image--header">
                    <img src="images/logo 1.png" alt="image">
                </div>
                <div class="chatbox__content--header">
                    <h4 class="chatbox__heading--header">Blcklisted Motorsports</h4>
                    <p class="chatbox__description--header">There are many variations of passages of Lorem Ipsum available</p>
                </div>
            </div>

            <!-- Display Chat Messages -->
            <div class="chatbox__messages">
                <?php foreach ($messages as $message): ?>
                    <?php if ($message['incoming_msg_id'] == 87654): ?>
                        <div class="messages__item messages__item--operator">
                            <?= htmlspecialchars($message['msg']) ?>
                        </div>
                    <?php else: ?>
                        <div class="messages__item messages__item--visitor">
                            
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <!-- Chatbox Footer with input -->
            <div class="chatbox__footer">
                <input type="text" id="visitor-message" placeholder="Write a message...">
                <p class="chatbox__send--footer" id="send-message">Send</p>
            </div>
        </div>
        <div class="chatbox__button">
            <button>button</button>
        </div>
    </div>
</div>
<script src="assets/js/Chat.js"></script>
<script src="app.js"></script>
<!------------------------------End of Chat System------------------------------>

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

    function toggleDropdown() {
        const dropdown = document.getElementById('dropdown');
        dropdown.classList.toggle('show');
    }

    // Close the dropdown if clicked outside
    window.onclick = function(event) {
        const dropdown = document.getElementById('dropdown');
        const profileHeader = document.querySelector('.profile-header');

        if (!profileHeader.contains(event.target)) {
            dropdown.classList.remove('show');
        }
    }


    const homeLink = document.getElementById('home-link');
    const warningModal = document.getElementById('modal');  // Renamed for clarity
    const confirmLeaveButton = document.getElementById('confirm-leave');
    const cancelLeaveButton = document.getElementById('cancel-leave');

    // Show warning modal on link click
    homeLink.addEventListener('click', (event) => {
        console.log("Home link clicked");
        event.preventDefault(); // Prevent the default navigation
        warningModal.style.display = 'flex';
    });

    // Confirm navigation
    confirmLeaveButton.addEventListener('click', () => {
        window.location.href = 'UserLogIn.php'; // Replace with your actual URL
    });

    // Cancel navigation
    cancelLeaveButton.addEventListener('click', () => {
        warningModal.style.display = 'none';
    });


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
