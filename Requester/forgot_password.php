<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../src/PHPMailer/PHPMailer.php';
require '../src/PHPMailer/SMTP.php';
require '../src/PHPMailer/Exception.php';

include '../dbConnection.php';

$conn->query("SET time_zone = '+00:00'");

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $token = bin2hex(openssl_random_pseudo_bytes(16));
    $dt = new DateTime("now", new DateTimeZone("UTC"));
    $dt->modify("+10 minutes");
    $expiry = $dt->format("Y-m-d H:i:s");


    $stmt = $conn->prepare("UPDATE requesterlogin_tb SET reset_token=?, token_expiry=? WHERE r_email=?");
    $stmt->bind_param("sss", $token, $expiry, $email);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'abc@gmail.com';
            $mail->Password = ''; // App password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('abc@gmail.com', 'SHEBA');
            $mail->addAddress($email);
            $mail->Subject = 'Password Reset Request';
            $mail->isHTML(true);

            $resetLink = "https://sheba.infy.uk/Requester/reset_password.php?token=$token";
            $mail->Body = '
            <!DOCTYPE html>
            <html lang="en">
            <head>
              <meta charset="UTF-8">
              <title>Reset Your Password</title>
            </head>
            <body style="margin: 0; font-family: \'Segoe UI\', sans-serif; background-color: #fff6f0;">
              <div style="max-width: 600px; margin: auto; padding: 20px; background-color: white; border-radius: 10px; text-align: center;">
                
                <!-- Logo -->
                <h1 style="font-size: 32px; font-family: \'Comic Sans MS\', cursive, sans-serif; letter-spacing: 2px;">S H E B A</h1>

                <!-- Illustration -->
                <img src="https://sheba.infy.uk/images/mail_banner.png" alt="Reset Password Image" 
                style="width: 100%; max-height: 300px; object-fit: contain; pointer-events: none;">

                <!-- Title -->
                <h2 style="color: #333;">Forgot Your Password?</h2>

                <!-- Text -->
                <p style="color: #777; line-height: 1.5;">
                  Click the button below to reset your password. If you didn’t request a password reset, you can safely ignore this email. This link will expire in 10 minutes.
                </p>

                <!-- Button -->
                <a href="' . $resetLink . '" 
                   style="display: inline-block; margin-top: 20px; padding: 12px 25px; background-color: #588157; color: white; text-decoration: none; border-radius: 6px; font-size: 16px;">
                  Reset Password
                </a>
              </div>
            </body>
            </html>
            ';

            $mail->send();
            $message = "<p class='success'>A password reset link has been sent to your email.</p>";
        } catch (Exception $e) {
            $message = "<p class='error'>Message could not be sent. Mailer Error: {$mail->ErrorInfo}</p>";
        }
    } else {
        $message = "<p class='error'>No account found with that email.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Forgot Password</title>
  <link rel="icon" type="icon" href="../images/icon.png">
  <link rel="stylesheet" href="../css/pass-recover.css?v=3.1" />
  <link rel="stylesheet" href="../css/bootstrap.min.css?v=2.1" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="../css/custom.css?v=4.5">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark fixed-top bg-danger flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="../index.php" >SHEBA</a>
</nav>

<!-- Main Content -->
<div class="container-box">
  <div class="card1">
    <h2>Forgot your password?</h2>
    <form method="POST">
      <input type="email" name="email" required placeholder="Enter your registered email">
      <button type="submit">Send Reset Link</button>

	  <div class="links1">
		<a  href="../Requester/RequesterLogin.php"><span>Back to <strong>SignIn</strong></span></a>
	  </div>
      <br>
      <?= $message ?>
    </form>
  </div>
</div>

<!-- Home Button -->
<div class="home-btn">
  <a class="btn shadow-sm font-weight-bold" href="../index.php" title="Back to Home">
    <i class="fas fa-home" style="color: #588157;"></i>
  </a>
</div>

</body>
</html>
