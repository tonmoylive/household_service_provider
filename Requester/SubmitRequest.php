<?php
define('TITLE', 'Submit Request');
define('PAGE', 'SubmitRequest');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();

// ===== AUTO LOGOUT CODE START =====
$timeout_duration = 3600; // 1 hour

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset();
    session_destroy();
    echo "<script>alert('Session expired. Please login again.'); location.href='RequesterLogin.php';</script>";
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time();
// ===== AUTO LOGOUT CODE END =====

if($_SESSION['is_login']){
    $rEmail = $_SESSION['rEmail'];

    // ===== Corrected: Fetch r_name from DB based on r_email =====
    $sql = "SELECT r_name FROM requesterlogin_tb WHERE r_email = '$rEmail'";
    $result = $conn->query($sql);
    if($result->num_rows == 1){
        $row = $result->fetch_assoc();
        $rName = $row['r_name'];
    } else {
        $rName = '';
    }

} else {
    echo "<script> location.href='RequesterLogin.php'; </script>";
}

if(isset($_REQUEST['submitrequest'])){
    // Checking for Empty Fields
    if(($_REQUEST['requestinfo'] == "") || ($_REQUEST['requestdesc'] == "") || ($_REQUEST['requestername'] == "") || ($_REQUEST['requesteradd1'] == "") || ($_REQUEST['requesteradd2'] == "") || ($_REQUEST['requestercity'] == "") || ($_REQUEST['requesterstate'] == "") || ($_REQUEST['requesterzip'] == "") || ($_REQUEST['requesteremail'] == "") || ($_REQUEST['requestermobile'] == "") || ($_REQUEST['requestdate'] == "")){
        
        if (!preg_match('/^01[0-9]{9}$/', $_REQUEST['requestermobile'])) {
            $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Mobile number must be 11 digits and start with 01 </div>';
        }

        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
    } else {
        // Assigning User Values to Variable
        $rinfo = $_REQUEST['requestinfo'];
        $rdesc = $_REQUEST['requestdesc'];
        $rname = $_REQUEST['requestername'];
        $radd1 = $_REQUEST['requesteradd1'];
        $radd2 = $_REQUEST['requesteradd2'];
        $rcity = $_REQUEST['requestercity'];
        $rstate = $_REQUEST['requesterstate'];
        $rzip = $_REQUEST['requesterzip'];
        $remail = $_REQUEST['requesteremail'];
        $rmobile = $_REQUEST['requestermobile'];
        $rdate = $_REQUEST['requestdate'];

        $sql = "INSERT INTO submitrequest_tb(request_info, request_desc, requester_name, requester_add1, requester_add2, requester_city, requester_state, requester_zip, requester_email, requester_mobile, request_date) VALUES ('$rinfo','$rdesc', '$rname', '$radd1', '$radd2', '$rcity', '$rstate', '$rzip', '$remail', '$rmobile', '$rdate')";

        if($conn->query($sql) == TRUE){
            $genid = mysqli_insert_id($conn);
            $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Request Submitted Successfully. Your Request ID is ' . $genid . ' </div>';
            $_SESSION['myid'] = $genid;
            echo "<script> location.href='submitrequestsuccess.php'; </script>";
        } else {
            $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Submit Your Request </div>';
        }
    }
}
?>
<div class="col-sm-9 col-md-10 mt-5">
  <form class="mx-5" action="" method="POST">
    
    <div class="form-group">
        <label for="inputRequestInfo">Service Types<span style="color: red;">*</span></label>
        <select class="form-control" id="inputRequestInfo" name="requestinfo">
            <option value="">Select One</option>
            <option value="Electrician">Electrician</option>
            <option value="Plumber">Plumber</option>
            <option value="Home Cleaning Services">Home Cleaning Services</option>
            <option value="Carpenter">Carpenter</option>
            <option value="Painter">Painter</option>
            <option value="AC/Appliance Technician">AC/Appliance Technician</option>
            <option value="Water Tank Cleaning">Water Tank Cleaning</option>
            <option value="Internet Service Providers (ISP)">Internet Service Providers (ISP)</option>
            <option value="Cable/DTH Services">Cable/DTH Services</option>
            <option value="CCTV Installation and Maintenance">CCTV Installation and Maintenance</option>
            <option value="Waste Collection & Disposal">Waste Collection & Disposal</option>
        </select>
    </div>

    <div class="form-group">
        <label for="inputRequestDescription">Service Description<span style="color: red;">*</span></label>
        <input type="text" class="form-control" id="inputRequestDescription" placeholder="Write Description" name="requestdesc">
    </div>
    <div class="form-group">
        <label for="inputName">Name<span style="color: red;">*</span></label>
        <input type="text" class="form-control" id="inputName" placeholder="Your Name" name="requestername" value="<?php echo isset($rName) ? $rName : ''; ?>">
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputAddress">Address Line 1<span style="color: red;">*</span></label>
            <input type="text" class="form-control" id="inputAddress" placeholder="House No. 123" name="requesteradd1">
        </div>
        <div class="form-group col-md-6">
            <label for="inputAddress2">Address Line 2<span style="color: red;">*</span></label>
            <input type="text" class="form-control" id="inputAddress2" placeholder="Railway Colony" name="requesteradd2">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputCity">Thana/PS<span style="color: red;">*</span></label>
            <select class="form-control" id="inputCity" name="requestercity">
                <option value="">Select Thana/PS</option>
                <option value="Boalia">Boalia</option>
                <option value="Rajpara">Rajpara</option>
                <option value="Shah Makhdum">Shah Makhdum</option>
                <option value="Motihar">Motihar</option>
                <option value="Paba">Paba</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="inputState">City</label>
            <input type="text" class="form-control" id="inputState" name="requesterstate" value="Rajshahi" readonly>
        </div>
        <div class="form-group col-md-2">
            <label for="inputZip">Zip<span style="color: red;">*</span></label>
            <input type="text" class="form-control" id="inputZip" name="requesterzip" onkeypress="isInputNumber(event)">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control" id="inputEmail" name="requesteremail" value="<?php echo $rEmail; ?>" readonly>
        </div>
        <div class="form-group col-md-2">
            <label for="inputMobile">Mobile<span style="color: red;">*</span></label>
            <input type="text" class="form-control" id="inputMobile" placeholder="e.g., 017xxxxxxxx" name="requestermobile"
            onkeypress="isInputNumber(event)" maxlength="11" pattern="01[0-9]{9}"
            title="Mobile number must be 11 digits and start with 01 (e.g., 017xxxxxxxx)" required>
        </div>
        <div class="form-group col-md-2">
            <label for="inputDate">Service Date<span style="color: red;">*</span></label>
            <input type="date" class="form-control" id="inputDate" name="requestdate">
        </div>
    </div>

    <button type="submit" class="btn btn-danger" name="submitrequest">Submit</button>
    <button type="reset" class="btn btn-secondary">Reset</button>
  </form>

  <?php if(isset($msg)) {echo $msg; } ?>
</div>
</div>
</div>

<script>
  function isInputNumber(evt) {
    var ch = String.fromCharCode(evt.which);
    if (!(/[0-9]/.test(ch))) {
      evt.preventDefault();
    }
  }

  document.querySelector("form").addEventListener("submit", function(e) {
    const mobile = document.getElementById("inputMobile").value;
    const pattern = /^01[0-9]{9}$/;
    if (!pattern.test(mobile)) {
      e.preventDefault();
      alert("Mobile number must be 11 digits and start with 01 (e.g., 017xxxxxxxx)");
    }
  });
</script>

<?php
include('includes/footer.php'); 
$conn->close();
?>
