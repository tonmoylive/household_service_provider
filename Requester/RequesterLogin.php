<?php
include('../dbConnection.php');
session_start();

if (!isset($_SESSION['is_login'])) {
  if (isset($_REQUEST['rEmail'])) {
    $rEmail = mysqli_real_escape_string($conn, trim($_REQUEST['rEmail']));
    $rPassword = mysqli_real_escape_string($conn, trim($_REQUEST['rPassword']));

    $sql = "SELECT r_email, r_password, r_status FROM requesterlogin_tb 
            WHERE r_email='$rEmail' AND r_password='$rPassword' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();

      if ($row['r_status'] === 'blocked') {
        $msg = '<div class="alert alert-danger mt-2" role="alert">Your account has been blocked by the authority.</div>';
      } elseif ($row['r_status'] === 'verified') {
        $_SESSION['is_login'] = true;
        $_SESSION['rEmail'] = $rEmail;
        echo "<script> location.href='RequesterProfile.php'; </script>";
        exit;
      } elseif ($row['r_status'] === 'pending') {
        $msg = '<div class="alert alert-warning mt-2" role="alert">Please verify your email before logging in.</div>';
      } else {
        $msg = '<div class="alert alert-warning mt-2" role="alert">Account status unknown.</div>';
      }
    } else {
      $msg = '<div class="alert alert-warning mt-2" role="alert">Enter Valid Email and Password</div>';
    }
  }
} else {
  echo "<script> location.href='RequesterProfile.php'; </script>";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SHEBA - User Portal</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css?v=1.1" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../css/custom.css?v=4.5">
  <link rel="stylesheet" href="../css/login.css?v=1.9" />
  <link rel="icon" href="../images/icon.png" />
</head>
<body>
 <nav class="navbar navbar-dark fixed-top bg-danger flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="../index.php">SHEBA</a>
 </nav>
<div class="login-container">
  <div class="avatar">
	<a href="../Requester/RequesterLogin.php" title="Login Portal">
		<img src="../images/avatar.png" alt="Avatar" />
	</a>
  </div>

  <h2><small>Access Next-Gen Household Services with <strong>SHEBA</strong></small></h2>

  <form method="POST" action="">
    <label for="rEmail"><strong>Email</strong></label>
    <input type="email" id="rEmail" name="rEmail" placeholder="Your Email" required />
	<small style="font-size: 12px; color: #777; text-align: left; display: block;">We'll never share your email with anyone else.</small>

    <label for="rPassword"><strong>Password</strong></label>
    <div class="input-group">
      <input type="password" id="rPassword" name="rPassword" placeholder="Password" required />
      <div class="input-group-append">
        <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
          <i class="fa-solid fa-eye" id="toggleIcon"></i>
        </span>
      </div>
    </div>

    <button type="submit" class="login-btn">LOGIN</button>
	<div class="links1">
		<a href="../Requester/forgot_password.php"><span>Forgot Password?</span></a>
	</div>
    <?php if (isset($msg)) { echo $msg; } ?>
  </form>

  <div class="links">
    <p>Don’t have an account? <a href="../index.php#registration"><span>Sign Up</span></a></p>
  </div>
	<div class="home-btn">
	  <a class="btn shadow-sm font-weight-bold" href="../index.php">
		<i class="fas fa-home"style="color: #588157;"></i>
	  </a>
	</div>
</div>

  <script src="../js/jquery.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/all.min.js"></script>
  <script src="../js/eye-toggle/eyeRequesterLogin.js"></script>
 
</body>
</html>
