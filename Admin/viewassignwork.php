<?php
define('TITLE', 'Work Order');
define('PAGE', 'work');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
} else {
  echo "<script> location.href='login.php'; </script>";
}

?>
<!-- Stamp & Logo watermark CSS -->
<style>
    .stamp-watermark {
        position: fixed;
        bottom: 20%;
        right: 20%;
        opacity: 0.9;
        z-index: 9999;
        display: none;
    }
    .stamp-watermark img {
        width: 200px;
        height: auto;
    }
    @media print {
        .stamp-watermark {
            display: block !important;
        }
        table {
            width: 100% !important;
            margin: 20px 0;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    }
	
	.center-image-watermark {
		position: fixed;
		top: 40%;
		left: 50%;
		transform: translate(-50%, -50%);
		opacity: 0.2;
		z-index: 999;
		display: none;
		pointer-events: none;
	}

	.center-image-watermark img {
		width: 500px; /* adjust size as needed */
		height: auto;
	}

	@media print {
		.center-image-watermark {
			display: block !important;
		}
	}
	
	.print-note {
		display: none;
		margin-top: 30px;
		font-size: 14px;
		color: #333;
	}

	@media print {
		.print-note {
			display: block;
		}
	}


</style>

<div class="col-sm-7 mt-5  mx-3">
	<h3 class="text-center">
		Assigned Service Details By SHEBA
	</h3>
	<h5 class="text-center">
		Service Approval Sheet
	</h5>
 <?php
 if(isset($_REQUEST['view'])){
  $sql = "SELECT * FROM assignwork_tb WHERE request_id = {$_REQUEST['id']}";
 $result = $conn->query($sql);
 $row = $result->fetch_assoc();
 }
  $repID = '';
	if(isset($row['assign_tech'])) {
		$techName = $row['assign_tech'];
		$sqlTech = "SELECT empid, empMobile FROM technician_tb WHERE empName = '$techName'";
		$resultTech = $conn->query($sqlTech);

	if($resultTech && $resultTech->num_rows > 0) {
		$techRow = $resultTech->fetch_assoc();
		$repID = $techRow['empid'];
		$repMobile = $techRow['empMobile'];
	} else {
		$repID = 'No ID found';
		$repMobile = 'Not available';
	}
}

 ?>
 <table class="table table-bordered">
  <tbody>
   <tr>
    <td>Request ID</td>
    <td>
     <?php if(isset($row['request_id'])) {echo $row['request_id']; }?>
    </td>
   </tr>
   <tr>
    <td>Types of Service</td>
    <td>
     <?php if(isset($row['request_info'])) {echo $row['request_info']; }?>
    </td>
   </tr>
   <tr>
    <td>Request Description</td>
    <td>
     <?php if(isset($row['request_desc'])) {echo $row['request_desc']; }?>
    </td>
   </tr>
   <tr>
    <td>Customer Name</td>
    <td>
     <?php if(isset($row['requester_name'])) {echo $row['requester_name']; }?>
    </td>
   </tr>
   <tr>
    <td>Address Line 1</td>
    <td>
     <?php if(isset($row['requester_add1'])) {echo $row['requester_add1']; }?>
    </td>
   </tr>
   <tr>
    <td>Address Line 2</td>
    <td>
     <?php if(isset($row['requester_add2'])) {echo $row['requester_add2']; }?>
    </td>
   </tr>
   <tr>
    <td>Thana/PS</td>
    <td>
     <?php if(isset($row['requester_city'])) {echo $row['requester_city']; }?>
    </td>
   </tr>
   <tr>
    <td>City</td>
    <td>
     <?php if(isset($row['requester_state'])) {echo $row['requester_state']; }?>
    </td>
   </tr>
   <tr>
    <td>Pin Code</td>
    <td>
     <?php if(isset($row['requester_zip'])) {echo $row['requester_zip']; }?>
    </td>
   </tr>
   <tr>
    <td>Email</td>
    <td>
     <?php if(isset($row['requester_email'])) {echo $row['requester_email']; }?>
    </td>
   </tr>
   <tr>
    <td>Mobile</td>
    <td>
     <?php if(isset($row['requester_mobile'])) {echo $row['requester_mobile']; }?>
    </td>
   </tr>
   <tr>
    <td>Assigned Date</td>
    <td>
     <?php if(isset($row['assign_date'])) {echo $row['assign_date']; }?>
    </td>
   </tr>
   <tr>
    <td>Representator Name (ID)</td>
    <td>
         <?php 
      if(isset($row['assign_tech'])) {
        echo $row['assign_tech'];
        if(!empty($repID)) {
          echo " (" . $repID . ")";
        }
      }
    ?>
    </td>
   </tr>
	<tr>
		<td>Representator Contact Number</td>
		<td>
			<?php if(isset($repMobile)) { echo $repMobile; } ?>
		</td>
	</tr>
	<tr>
		<td>Charges (Based on Service Criteria):&nbsp &#2547; </td>
		<td></td>
   </tr>
   <tr>
    <td>Customer Sign</td>
    <td></td>
   </tr>
   <tr>
    <td>Authority Sign</td>
    <td></td>
   </tr>
  </tbody>
 </table>
 
  <div class="print-note">
    <p><strong>***Note:</strong> <i> Before starting the service, please have a detailed discussion with 
	our representative regarding the service. Make sure you are informed about the charges based on your service criteria. 
	If you agree with all the terms, kindly authorize the service by signing the service appproval sheet.</i> </br>Thank You!</p>
  </div>

 
 <!-- Stamp watermark -->
 <div class="stamp-watermark">
    <img src="../images/stamp.png" alt="Official Stamp">
 </div>
 <!-- Print watermark -->
 <div class="center-image-watermark">
    <img src="../images/print-watermark.png" alt="Watermark">
</div>


 <div class="text-center">
  <form class='d-print-none d-inline mr-3'><input class='btn btn-danger' type='submit' value='Print' onClick='window.print()'></form>
  <form class='d-print-none d-inline' action="work.php"><input class='btn btn-secondary' type='submit' value='Close'></form>
 </div>
</div>

<?php
include('includes/footer.php'); 
?>