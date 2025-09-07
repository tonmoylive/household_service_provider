<?php
include('dbConnection.php');

$verificationSuccess = false;
$message = '';

if (isset($_GET['email']) && isset($_GET['token'])) {
  $email = $_GET['email'];
  $token = $_GET['token'];

  $sql = "SELECT * FROM requesterlogin_tb WHERE r_email='$email' AND r_token='$token' AND r_status='pending'";
  $result = $conn->query($sql);

  if ($result->num_rows == 1) {
    $update = "UPDATE requesterlogin_tb SET r_status='verified', r_token='' WHERE r_email='$email'";
    if ($conn->query($update)) {
      $verificationSuccess = true;
      $message = "User verification successful!";
    } else {
      $message = "Error during verification.";
    }
  } else {
    $message = "Invalid or already verified link.";
  }
} else {
  $message = "Invalid request.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Email Verification</title>
  <meta http-equiv="refresh" content="3;url=Requester/RequesterLogin.php">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .message-box {
      text-align: center;
      background: #ffffff;
      padding: 40px;
      border: 1px solid #ddd;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .message-box h2 {
      color: <?= $verificationSuccess ? '#28a745' : '#dc3545' ?>;
    }
    .redirect-note {
      margin-top: 20px;
      font-size: 14px;
      color: #666;
    }
  </style>
</head>
<body>
  <div class="message-box">
    <h2><?= htmlspecialchars($message) ?></h2>
    <p class="redirect-note">Redirecting to login page...</p>
  </div>
</body>
</html>
