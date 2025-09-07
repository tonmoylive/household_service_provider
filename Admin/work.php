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
<div class="col-sm-9 col-md-10 mt-5">
  <?php 
  $sql = "SELECT * FROM assignwork_tb ORDER BY request_id DESC";
  $result = $conn->query($sql);
  if($result->num_rows > 0){
    echo '<table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Request Info</th>
        <th scope="col">Name</th>
        <th scope="col">Address</th>
        <th scope="col">Thana/PS</th>
        <th scope="col">Mobile</th>
        <th scope="col">Representator</th>
        <th scope="col">Assigned Date</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>';
    while($row = $result->fetch_assoc()){
      echo '<tr>
      <th scope="row">'.$row["request_id"].'</th>
      <td>'.$row["request_info"].'</td>
      <td>'.$row["requester_name"].'</td>
      <td>'.$row["requester_add2"].'</td>
      <td>'.$row["requester_city"].'</td>
      <td>'.$row["requester_mobile"].'</td>
      <td>'.$row["assign_tech"].'</td>
      <td>'.$row["assign_date"].'</td>
		<td>
		  <div class="d-flex gap-1"> <!-- Bootstrap flex container -->
			<form action="viewassignwork.php" method="POST"> 
			  <input type="hidden" name="id" value='. $row["request_id"] .'>
			  <button type="submit" class="btn btn-warning" name="view" value="View">
				<i class="far fa-eye"></i>
			  </button>
			</form>
			<form action="" method="POST" onsubmit="return confirmDelete()">
			  <input type="hidden" name="id" value='. $row["request_id"] .'>
			  <button type="submit" class="btn btn-secondary" name="delete" value="Delete">
				<i class="far fa-trash-alt"></i>
			  </button>
			</form>
		  </div>
		</td>
      </tr>';
    }
    echo '</tbody> </table>';
  } else {
    echo "0 Result";
  }

  if(isset($_REQUEST['delete'])){
    $sql = "DELETE FROM assignwork_tb WHERE request_id = {$_REQUEST['id']}";
    if($conn->query($sql) === TRUE){
      echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';
    } else {
      echo "Unable to Delete Data";
    }
  }
  ?>
</div>
</div>
</div>

<script>
  // JavaScript function for delete confirmation
  function confirmDelete() {
    return confirm("Are you sure you want to delete this record?");
  }
</script>

<?php
include('includes/footer.php'); 
?>
