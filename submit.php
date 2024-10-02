<?php
include 'dbconnect.php';


$firstName = $conn->real_escape_string($_POST['firstname']);
$lastName = $conn->real_escape_string($_POST['lastname']);
$username = $conn->real_escape_string($_POST['username']);
$email = $conn->real_escape_string($_POST['email']);
$state = $conn->real_escape_string($_POST['emotion']);


$sql = "INSERT INTO users (firstname, lastname, username, email, emotion) VALUES ('$firstName', '$lastName', '$username', '$email', '$emotion')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();