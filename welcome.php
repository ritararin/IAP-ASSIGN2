<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="welcomemain">
    <div class="welcomecontainer">
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
      <p>Thank you for signing up with us. We are excited to have you on board. You can now login to your account and start using our services.</p>
        <a href="index.php" class="btn btn-primary">Go back to Home</a>
    </div>
</body>
</html>