<?php
include('../dbConnection.php');
session_start();
if(!isset($_SESSION['is_adminlogin'])){
  if(isset($_REQUEST['aEmail'])){
    $aEmail = mysqli_real_escape_string($conn,trim($_REQUEST['aEmail']));
    $aPassword = mysqli_real_escape_string($conn,trim($_REQUEST['aPassword']));
    $sql = "SELECT a_email, a_password FROM adminlogin_tb WHERE a_email='".$aEmail."' AND a_password='".$aPassword."' limit 1";
    $result = $conn->query($sql);
    if($result->num_rows == 1){
      $_SESSION['is_adminlogin'] = true;
      $_SESSION['aEmail'] = $aEmail;
      // Redirecting to RequesterProfile page on Correct Email and Pass
      echo "<script> location.href='dashboard.php'; </script>";
      exit;
    } else {
      $msg = '<div class="alert alert-warning mt-2" role="alert"> Enter Valid Email and Password </div>';
    }
  }
} else {
  echo "<script> location.href='dashboard.php'; </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SHEBA - Admin Portal</title>
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

  <h2><small>SHEBA Admin Portal</small></h2>

  <form method="POST" action="">
    <label for="aEmail"><strong>Email</strong></label>
    <input type="email" id="aEmail" name="aEmail" placeholder="Your Email" required />

    <label for="aPassword"><strong>Password</strong></label>
    <div class="input-group">
      <input type="password" id="aPassword" name="aPassword" placeholder="Password" required />
      <div class="input-group-append">
        <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
          <i class="fa-solid fa-eye" id="toggleIcon"></i>
        </span>
      </div>
    </div>

    <button type="submit" class="login-btn">LOGIN</button>
    <?php if (isset($msg)) { echo $msg; } ?>
  </form>

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
  <script src="../js/eye-toggle/eyeAdminLogin.js"></script>
 
</body>
</html>
