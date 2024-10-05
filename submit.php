<?php
include 'dbconnect.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

if ($conn === null) {
    echo 'Connection failed';
    exit();
}

$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$username = $_POST['username'];
$email = $_POST['email'];
$emotion = $_POST['emotion'];

session_start(); // Start the session here

$sql = "INSERT INTO UserDetails (firstname, lastname, username, email, emotion) VALUES (:firstName, :lastName, :username, :email, :emotion)";

try {
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':emotion', $emotion);

    if ($stmt->execute()) {
        $_SESSION['username'] = $username; // Store the username in the session
        
        // Generate the 2FA code
        $twofa_code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $_SESSION['2fa_code'] = $twofa_code;

        // Send the 2FA code via email
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; 
            $mail->SMTPAuth   = true;
            $mail->Username   = 'ritararin@gmail.com'; // Your SMTP username
            $mail->Password   = 'rqbq bdjt ysop bvkh'; // Your correct app-specific password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use TLS
            $mail->Port       = 587; // TCP port to connect to
            $mail->SMTPDebug = 2; // Enable verbose debug output

            // Recipients
            $mail->setFrom('your_email@gmail.com', 'Your Name'); // Sender info
            $mail->addAddress($email); // Add the user's email

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Your 2FA Code';
            $mail->Body    = "Your verification code is: <strong>$twofa_code</strong>";
            $mail->AltBody = "Your verification code is: $twofa_code";

            // Send the email
            $mail->send();

            // Redirect to verification page
            header("Location: verify.php");
            exit();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

$conn = null;
?>
