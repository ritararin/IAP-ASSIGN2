<?php
include 'dbconnect.php';

if ($conn === null) {
    echo 'Connection failed';
    exit();
}

$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$username = $_POST['username'];
$email = $_POST['email'];
$emotion = $_POST['emotion'];

$sql = "INSERT INTO UserDetails (firstname, lastname, username, email, emotion) VALUES (:firstName, :lastName, :username, :email, :emotion)";

try {
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':emotion', $emotion);

    if ($stmt->execute()) {
        // Redirect to the homepage after successful insertion
        header("Location: index.php"); // Change 'index.php' to your actual homepage file
        exit();
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

$conn = null;
