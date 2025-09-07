<?php
include '../dbConnection.php';

$conn->query("SET time_zone = '+00:00'");

$message = '';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $stmt = $conn->prepare("SELECT r_email FROM requesterlogin_tb WHERE reset_token=? AND token_expiry > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $newpass = $_POST['new_password'];
            $stmt = $conn->prepare("UPDATE requesterlogin_tb SET r_password=?, reset_token=NULL, token_expiry=NULL WHERE reset_token=?");
            $stmt->bind_param("ss", $newpass, $token);
            $stmt->execute();

            $message = "<p class='success'>Your password has been successfully reset.<br><a href='../Requester/RequesterLogin.php'>Login Now</a></p>";
        }
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>Reset Password</title>
			<link rel="icon" type="icon" href="../images/icon.png">
            <link rel="stylesheet" href="../css/pass-recover.css?v=3.1" />

        </head>
        <body>
            <div class="container">
                <div class="card1">
                    <h2>Reset password?</h2>
                    <br>
                    <form method="POST">
                        <input type="text" name="new_password" required placeholder="Enter new password">
                        <button type="submit">Reset Password</button>
                        <?= $message ?>
                    </form>
                </div>
            </div>
        </body>
        </html>
        <?php
    } else {
        // expired or invalid token
        echo "<!DOCTYPE html><html><head><title>Invalid</title>
        <style>
          body { font-family: sans-serif; text-align: center; margin-top: 50px; }
          .error { color: red; }
        </style></head><body>
        <p class='error'>This reset link is invalid or expired.</p>
        </body></html>";
    }
} else {
    // no token at all
    echo "<!DOCTYPE html><html><head><title>Invalid</title>
    <style>
      body { font-family: sans-serif; text-align: center; margin-top: 50px; }
      .error { color: red; }
    </style></head><body>
    <p class='error'>No token provided.</p>
    </body></html>";
}
?>
