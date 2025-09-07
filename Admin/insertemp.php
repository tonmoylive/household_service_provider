<?php
define('TITLE', 'Add New Technician');
define('PAGE', 'technician');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='login.php'; </script>";
 }
if(isset($_REQUEST['empsubmit'])){
 // Checking for Empty Fields
 if(($_REQUEST['empName'] == "") || ($_REQUEST['empCity'] == "") || ($_REQUEST['empMobile'] == "") || ($_REQUEST['empEmail'] == "")){
  // msg displayed if required field missing
  $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
} else if (!preg_match('/^01[0-9]{9}$/', $_REQUEST['empMobile'])) {
  $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Mobile number must be 11 digits and start with "01" </div>'; 
 } else {
   // Assigning User Values to Variable
   $eName = $_REQUEST['empName'];
   $eCity = $_REQUEST['empCity'];
   $eMobile = $_REQUEST['empMobile'];
   $eEmail = $_REQUEST['empEmail'];
   $sql = "INSERT INTO technician_tb (empName, empCity, empMobile, empEmail) VALUES ('$eName', '$eCity','$eMobile', '$eEmail')";
   if($conn->query($sql) == TRUE){
    // below msg display on form submit success
    $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Added Successfully </div>';
   } else {
    // below msg display on form submit failed
    $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Add </div>';
   }
 }
 }
?>
<div class="col-sm-6 mt-5  mx-3 jumbotron">
  <h3 class="text-center">Add New Worker</h3>
  <form action="" method="POST" onsubmit="return validateForm()">
    <div class="form-group">
      <label for="empName">Name</label>
      <input type="text" class="form-control" id="empName" name="empName">
    </div>
    <div class="form-group">
      <label for="empCity">Address</label>
      <input type="text" class="form-control" id="empCity" name="empCity">
    </div>
    <div class="form-group">
      <label for="empMobile">Mobile</label>
      <input type="text" class="form-control" id="empMobile" name="empMobile" maxlength="11" onkeypress="isInputNumber(event)">
    </div>
    
		<div class="form-group">
			<label for="empEmail">Occupation</label>
				<select class="form-control" id="empEmail" name="empEmail">
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
	

    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="empsubmit" name="empsubmit">Submit</button>
      <a href="technician.php" class="btn btn-secondary">Close</a>
    </div>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
</div>
<!-- Only Number for input fields -->
<script>
  function isInputNumber(evt) {
    var ch = String.fromCharCode(evt.which);
    if (!(/[0-9]/.test(ch))) {
      evt.preventDefault();
    }
  }

  function validateForm() {
    const mobile = document.getElementById("empMobile").value.trim();
    const mobilePattern = /^01\d{9}$/;

    if (!mobilePattern.test(mobile)) {
      alert("Mobile number must be 11 digits and start with '01'");
      return false;
    }
    return true;
  }

  function isInputNumber(evt) {
    var ch = String.fromCharCode(evt.which);
    if (!(/[0-9]/.test(ch))) {
      evt.preventDefault();
    }
  }

</script>
<?php
include('includes/footer.php'); 
?>