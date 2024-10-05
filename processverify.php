<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enteredCode = $_POST['code'];
    
    if (isset($_SESSION['2fa_code']) && $enteredCode === $_SESSION['2fa_code']) {
        // Successful verification
        echo "2FA verified successfully! Welcome, " . $_SESSION['username'] . "!";
        // Here you can redirect to the user's dashboard or another page
        // header("Location: dashboard.php");
        // exit();
    } else {
        echo "Invalid code. Please try again.";
        // Optionally, redirect back to the verification page with an error message
        // header("Location: verify.php");
        // exit();
    }
} else {
    // Handle the case where the script was accessed directly
    header("Location: index.php");
    exit();
}
?>
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
    // Handle the case where the script was accessed directly
    header("Location: index.php");
    exit();
}
?>
