<?php
// Enable error reporting (for debugging)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Session check
if (session_id() == '') {
  session_start();
}
if (!isset($_SESSION['is_adminlogin'])) {
  echo "<script> location.href='login.php'; </script>";
  exit;
}
$aEmail = $_SESSION['aEmail'];

// Load PHPMailer (once, at top)
require '../src/PHPMailer/PHPMailer.php';
require '../src/PHPMailer/SMTP.php';
require '../src/PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Get request data if viewing
if (isset($_REQUEST['view'])) {
  $sql = "SELECT * FROM submitrequest_tb WHERE request_id = {$_REQUEST['id']}";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
}

// Assign logic
if (isset($_REQUEST['assign'])) {
  if (
    empty($_REQUEST['request_id']) || empty($_REQUEST['request_info']) || empty($_REQUEST['requestdesc']) ||
    empty($_REQUEST['requestername']) || empty($_REQUEST['address1']) || empty($_REQUEST['address2']) ||
    empty($_REQUEST['requestercity']) || empty($_REQUEST['requesterstate']) || empty($_REQUEST['requesterzip']) ||
    empty($_REQUEST['requesteremail']) || empty($_REQUEST['requestermobile']) || empty($_REQUEST['assigntech']) ||
    empty($_REQUEST['inputdate'])
  ) {
    $msg = '<div class="alert alert-warning col-sm-6 mt-2" role="alert"> Fill All Fields </div>';
  } else {
    // Extract request data
    $rid = $_REQUEST['request_id'];
    $rinfo = $_REQUEST['request_info'];
    $rdesc = $_REQUEST['requestdesc'];
    $rname = $_REQUEST['requestername'];
    $radd1 = $_REQUEST['address1'];
    $radd2 = $_REQUEST['address2'];
    $rcity = $_REQUEST['requestercity'];
    $rstate = $_REQUEST['requesterstate'];
    $rzip = $_REQUEST['requesterzip'];
    $remail = $_REQUEST['requesteremail'];
    $rmobile = $_REQUEST['requestermobile'];
    $rassigntech = $_REQUEST['assigntech'];
    $rawDate = $_REQUEST['inputdate'];
    $rawTime = $_REQUEST['inputtime'];
    $datetime = DateTime::createFromFormat('Y-m-d H:i', "$rawDate $rawTime");
    $rdate = $datetime->format('Y-m-d h:i A');

    // Insert into database
    $sql = "INSERT INTO assignwork_tb 
      (request_id, request_info, request_desc, requester_name, requester_add1, requester_add2, requester_city, requester_state, requester_zip, requester_email, requester_mobile, assign_tech, assign_date) 
      VALUES 
      ('$rid', '$rinfo','$rdesc', '$rname', '$radd1', '$radd2', '$rcity', '$rstate', '$rzip', '$remail', '$rmobile', '$rassigntech', '$rdate')";

    if ($conn->query($sql) === TRUE) {
      $msg = '<div class="alert alert-success col-sm-6 mt-2" role="alert"> Work Assigned Successfully </div>';

      // Send confirmation email
      $mail = new PHPMailer(true);
      try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'info.shebaservices@gmail.com';           // 🔁 replace with your Gmail
        $mail->Password = 'vqkm siqr loke uzgo';       // 🔁 replace with App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('info.shebaservices@gmail.com', 'Service Desk');
        $mail->addAddress($remail, $rname);

        $mail->isHTML(true);
        $mail->Subject = 'Service Assignment Confirmation - Request ID: ' . $rid;
        $mail->Body = "
          <h3>Dear $rname,</h3>
          <p>Your service request (ID: <strong>$rid</strong>) has been successfully assigned.</p>
          <p><strong>Representor:</strong> $rassigntech<br>
          <strong>Scheduled Date & Time:</strong> $rdate</p>
          <p>Thank you for using our service.</p>
          <br><small>This is an automated message. Please do not reply.</small>
        ";

        $mail->send();
        $msg .= '<div class="alert alert-info col-sm-6 mt-2" role="alert"> Confirmation Email Sent </div>';
      } catch (Exception $e) {
        $msg .= '<div class="alert alert-warning col-sm-6 mt-2" role="alert"> Email not sent. Mailer Error: ' . $mail->ErrorInfo . '</div>';
      }
    } else {
      $msg = '<div class="alert alert-danger col-sm-6 mt-2" role="alert"> Unable to Assign Work </div>';
    }
  }
}
?>


<head>
  <style>
    .form-container {
      height: auto;
      overflow-y: visible;
    }
    @media (min-width: 900px) {
      .form-container {
        height: 950px;
        overflow-y: auto;
      }
    }
    @media (max-width: 768px) {
      .form-container {
        padding-bottom: 100px;
      }
      .float-right {
        float: none !important;
        text-align: center;
        display: block;
        margin-top: 15px;
      }
    }
  </style>
</head>

<div class="col-sm-5 mt-5 jumbotron form-container">
  <form action="" method="POST">
    <h5 class="text-center">Assign Service Order Request</h5>
    <div class="form-group">
      <label for="request_id">Request ID</label>
      <input type="text" class="form-control" id="request_id" name="request_id" value="<?php if(isset($row['request_id'])) {echo $row['request_id']; }?>" readonly>
    </div>
    <div class="form-group">
      <label for="request_info">Service Types</label>
      <input type="text" class="form-control" id="request_info" name="request_info" value="<?php if(isset($row['request_info'])) {echo $row['request_info']; }?>" readonly>
    </div>
    <div class="form-group">
      <label for="requestdesc">Service Description</label>
      <input type="text" class="form-control" id="requestdesc" name="requestdesc" value="<?php if(isset($row['request_desc'])) { echo $row['request_desc']; } ?>" readonly>
    </div>
    <div class="form-group">
      <label for="requestername">Name</label>
      <input type="text" class="form-control" id="requestername" name="requestername" value="<?php if(isset($row['requester_name'])) { echo $row['requester_name']; } ?>" readonly>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="address1">Address Line 1</label>
        <input type="text" class="form-control" id="address1" name="address1" value="<?php if(isset($row['requester_add1'])) { echo $row['requester_add1']; } ?>" readonly>
      </div>
      <div class="form-group col-md-6">
        <label for="address2">Address Line 2</label>
        <input type="text" class="form-control" id="address2" name="address2" value="<?php if(isset($row['requester_add2'])) {echo $row['requester_add2']; }?>" readonly>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="requestercity">Thana/PS</label>
        <input type="text" class="form-control" id="requestercity" name="requestercity" value="<?php if(isset($row['requester_city'])) {echo $row['requester_city']; }?>" readonly>
      </div>
      <div class="form-group col-md-4">
        <label for="requesterstate">City</label>
        <input type="text" class="form-control" id="requesterstate" name="requesterstate" value="<?php if(isset($row['requester_state'])) { echo $row['requester_state']; } ?>" readonly>
      </div>
      <div class="form-group col-md-4">
        <label for="requesterzip">Zip</label>
        <input type="text" class="form-control" id="requesterzip" name="requesterzip" value="<?php if(isset($row['requester_zip'])) { echo $row['requester_zip']; } ?>" onkeypress="isInputNumber(event)" readonly>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-8">
        <label for="requesteremail">Email</label>
        <input type="email" class="form-control" id="requesteremail" name="requesteremail" value="<?php if(isset($row['requester_email'])) {echo $row['requester_email']; }?>" readonly>
      </div>
      <div class="form-group col-md-4">
        <label for="requestermobile">Mobile</label>
        <input type="text" class="form-control" id="requestermobile" name="requestermobile" value="<?php if(isset($row['requester_mobile'])) {echo $row['requester_mobile']; }?>" onkeypress="isInputNumber(event)" readonly>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-5">
        <label for="assigntech">Assign to Worker</label>
        <select class="form-control" id="assigntech" name="assigntech">
          <option value="">Select Worker</option>
          <?php
            $techSql = "SELECT empEmail, empName, empID FROM technician_tb";
            $techResult = $conn->query($techSql);
            $groupedTechs = [];

            if ($techResult->num_rows > 0) {
              while ($techRow = $techResult->fetch_assoc()) {
                $groupedTechs[$techRow['empEmail']][] = [
                  'name' => $techRow['empName'],
                  'id' => $techRow['empID']
                ];
              }

              foreach ($groupedTechs as $email => $techs) {
                echo "<optgroup label='$email'>";
                foreach ($techs as $tech) {
                  $display = $tech['name'] . " (" . $tech['id'] . ")";
                  echo "<option value='{$tech['name']}'>$display</option>";
                }
                echo "</optgroup>";
              }
            }
          ?>
        </select>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputDate">Date</label>
          <input type="date" class="form-control" id="inputDate" name="inputdate">
        </div>
        <div class="form-group col-md-6">
          <label for="inputTime">Time</label>
          <input type="time" class="form-control" id="inputTime" name="inputtime">
        </div>
      </div>
    </div>

    <!-- Show message here, above the buttons -->
    <?php if(isset($msg)) { echo '<div class="clearfix"></div>' . $msg; } ?>

    <div class="float-right mt-3">
      <button type="submit" class="btn btn-success" name="assign">Assign</button>
      <button type="reset" class="btn btn-secondary">Reset</button>
    </div>
  </form>
</div>

<script>
  function isInputNumber(evt) {
    var ch = String.fromCharCode(evt.which);
    if (!(/[0-9]/.test(ch))) {
      evt.preventDefault();
    }
  }
</script>
