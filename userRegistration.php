<?php
include('dbConnection.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/PHPMailer/PHPMailer.php';
require 'src/PHPMailer/SMTP.php';
require 'src/PHPMailer/Exception.php';

if (isset($_REQUEST['rSignup'])) {
  if (($_REQUEST['rName'] == "") || ($_REQUEST['rEmail'] == "") || ($_REQUEST['rPassword'] == "")) {
    $regmsg = '<div class="alert alert-warning mt-2 text-center" role="alert" style="font-size: 14px;"> All Fields are Required </div>';
  } else {
    $sql = "SELECT r_email FROM requesterlogin_tb WHERE r_email='" . $_REQUEST['rEmail'] . "'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
      $regmsg = '<div class="alert alert-warning mt-2 text-center" role="alert" style="font-size: 14px;"> Email ID Already Registered </div>';
    } else {
      $rName = $_REQUEST['rName'];
      $rEmail = $_REQUEST['rEmail'];
      $rPassword = $_REQUEST['rPassword'];
      $token = md5(rand());

      $sql = "INSERT INTO requesterlogin_tb(r_name, r_email, r_password, r_token, r_status)
              VALUES ('$rName','$rEmail', '$rPassword', '$token', 'pending')";
      if ($conn->query($sql) == TRUE) {
        // Send Verification Email
        $mail = new PHPMailer(true);
        try {
          $mail->isSMTP();
          $mail->Host = 'smtp.gmail.com';
          $mail->SMTPAuth = true;
          $mail->Username = 'abc@gmail.com'; // your Gmail
          $mail->Password = '';   // your Gmail App Password
          $mail->SMTPSecure = 'tls';
          $mail->Port = 587;

          $mail->setFrom('abc@gmail.com', 'SHEBA');
          $mail->addAddress($rEmail, $rName);
          $mail->isHTML(true);
          $mail->Subject = 'Email Verification - SHEBA';
          $mail->Body = "
            <div style='font-family: Arial, sans-serif; padding: 20px; color: #333; line-height: 1.6;'>
                <h2 style='color: #2c3e50;'>Hello $rName,</h2>
                <p>Thank you for registering with <strong>SHEBA</strong>.</p>
                <p>To complete your registration, please verify your email address by clicking the button below:</p>
                <p style='text-align: center;'>
                <a href='https://sheba.infy.uk/verify.php?email=$rEmail&token=$token'
                    style='background-color: #28a745; color: #fff; padding: 12px 20px; text-decoration: none; border-radius: 5px; display: inline-block; font-weight: bold;'>
                    Verify Email
                </a>
                </p>
                <hr style='margin-top: 30px;'>
                <p style='font-size: 12px; color: #888;'>If you did not sign up for SHEBA, you can safely ignore this email.</p>
            </div>
            ";

          $mail->send();
          $regmsg = '<div class="alert alert-success mt-2 text-center" role="alert" style="font-size: 14px;">Account Created! Please verify your email.</div>';
        } catch (Exception $e) {
          $regmsg = '<div class="alert alert-danger mt-2 text-center" role="alert" style="font-size: 14px;">Account created but failed to send verification email.</div>';
        }
      } else {
        $regmsg = '<div class="alert alert-danger mt-2 text-center" role="alert" style="font-size: 14px;"> Unable to Create Account </div>';
      }
    }
  }
}
?>


<html>
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <style>
      .links {
      margin-top: 20px;
      font-size: 14px;
	  text-align: center;
      color: #888;
    }

    .links span {
      color: #45a049;
    }

    .links a {
      color: inherit;
      text-decoration: none;
    }
	</style>
</head>
<body>
<div class="container pt-5" id="registration">
  <h2 class="text-center">Create an Account</h2>
  <div class="row mt-4 mb-4">
    <div class="col-md-6 offset-md-3">
      <form action="#registration" class="shadow-lg p-4" method="POST" id="registrationForm">
        <div class="form-group">
          <i class="fas fa-user"></i><label for="name" class="pl-2 font-weight-bold">Name</label>
          <input type="text" class="form-control" placeholder="Name" name="rName">
        </div>
        <div class="form-group">
          <i class="fas fa-envelope"></i><label for="email" class="pl-2 font-weight-bold">Email</label>
          <input type="email" class="form-control" placeholder="Email" name="rEmail">
          <small class="form-text">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
          <i class="fas fa-key"></i><label for="pass" class="pl-2 font-weight-bold">New Password</label>
          <div class="input-group">
            <input type="password" class="form-control" placeholder="Password" name="rPassword" id="password">
            <div class="input-group-append">
              <button type="button" class="btn " id="togglePassword">
                <i class="fa-solid fa-eye" id="eyeIcon"></i>
              </button>
            </div>
          </div>
          <small id="passwordStrength" class="form-text text-muted"></small>
          <small id="passwordWarning" class="form-text text-danger" style="display:none;"></small> <!-- Warning message -->
        </div>
        <button type="submit" class="btn btn-danger mt-5 btn-block shadow-sm font-weight-bold" name="rSignup">Sign Up</button>
        <em style="font-size:10px;">Note - By clicking Sign Up, you agree to our Terms, Data Policy and Cookie Policy.</em>
		<div class="links">
			<p>Already have an account? <a href="Requester/RequesterLogin.php"><span>Sign In</span></a></p>
		</div>
        <?php if(isset($regmsg)) { echo $regmsg; } ?>
      </form>

    </div>
  </div>
</div>

<script>
// Password Strength Function
const passwordInput = document.getElementById('password');
const strengthMessage = document.getElementById('passwordStrength');
const passwordWarning = document.getElementById('passwordWarning'); // Select the warning message element

// Password visibility toggle
const togglePasswordButton = document.getElementById('togglePassword');
const eyeIcon = document.getElementById('eyeIcon');

togglePasswordButton.addEventListener('click', function () {
    // Toggle the type attribute for password visibility
    const type = passwordInput.type === 'password' ? 'text' : 'password';
    passwordInput.type = type;

    // Toggle the eye icon to show/hide
    if (passwordInput.type === 'password') {
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
    } else {
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
    }
});

// Password Strength check
passwordInput.addEventListener('input', function () {
    const password = passwordInput.value;
    const strength = checkPasswordStrength(password);

    // Display the strength message
    strengthMessage.textContent = strength.message;
    strengthMessage.style.color = strength.color;

    // Show the warning message if password doesn't meet criteria
    if (strength.color === 'red') {
        passwordWarning.textContent = 'Password must be at least 8 Characters with Uppercase, Lowercase, Number and Special Character.';
        passwordWarning.style.display = 'block';
    } else {
        passwordWarning.style.display = 'none'; // Hide the warning if password is valid
    }
});

// Password strength check function
function checkPasswordStrength(password) {
    const lengthRequirement = password.length >= 8;
    const hasUppercase = /[A-Z]/.test(password);
    const hasLowercase = /[a-z]/.test(password);
    const hasNumber = /\d/.test(password);
    const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(password);

    let strength = {
        message: '',
        color: 'red'
    };

    // Check if the password meets all the requirements
    if (lengthRequirement && hasUppercase && hasLowercase && hasNumber && hasSpecial) {
        strength.message = 'Strong';
        strength.color = 'green';
    } else if (lengthRequirement && hasUppercase && hasLowercase && (hasNumber || hasSpecial)) {
        strength.message = 'Medium';
        strength.color = 'orange';
    } else {
        strength.message = 'Weak';
        strength.color = 'red';
    }

    return strength;
}

// Form submission validation
document.getElementById('registrationForm').addEventListener('submit', function (event) {
    const password = passwordInput.value;
    const strength = checkPasswordStrength(password);

    // If the password does not meet the required strength, prevent form submission
    if (strength.color === 'red') {
        event.preventDefault();  // Prevent form submission
        passwordWarning.textContent = 'All fields are required';
        passwordWarning.style.display = 'block'; // Show warning
    }
});
</script>

</body>
</html>
