<?php
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