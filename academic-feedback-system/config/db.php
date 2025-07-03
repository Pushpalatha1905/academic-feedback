<?php
$host = "localhost";
$username = "root";
$password = "manibharathy@2012";
$dbname = "feedback_system"; // Or your DB name

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>