<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enteredCode = $_POST['code'];
    
    if (isset($_SESSION['2fa_code']) && $enteredCode === $_SESSION['2fa_code']) {
        // Successful verification
        echo "2FA verified successfully! Welcome, " . $_SESSION['username'] . "!";
       header("Location: welcome.php");
       exit();
    } else {
        echo "Invalid code. Please try again.";
         header("Location: verify.php");
         exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>

