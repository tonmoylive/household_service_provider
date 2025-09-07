<?php
include('../dbConnection.php');
session_start();

if (!isset($_SESSION['is_login'])) {
    exit("Unauthorized access");
}

$rEmail = $_SESSION['rEmail'];

if (isset($_POST['request_id'])) {
    $request_id = $_POST['request_id'];

    $sql = "SELECT * FROM assignwork_tb WHERE request_id = ? AND requester_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $request_id, $rEmail);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();

        $techMobile = 'Not available';
        if (!empty($row['assign_tech'])) {
            $sqlTech = "SELECT empMobile FROM technician_tb WHERE empName = ?";
            $stmtTech = $conn->prepare($sqlTech);
            $stmtTech->bind_param("s", $row['assign_tech']);
            $stmtTech->execute();
            $resTech = $stmtTech->get_result();
            if ($resTech->num_rows > 0) {
                $techMobile = $resTech->fetch_assoc()['empMobile'];
            }
        }

        echo '
        <div class="table-responsive">
        <table class="table table-bordered table-sm">
            <tr><td><strong>Request ID</strong></td><td>' . $row['request_id'] . '</td></tr>
            <tr><td><strong>Types of Service</strong></td><td>' . $row['request_info'] . '</td></tr>
            <tr><td><strong>Request Description</strong></td><td>' . $row['request_desc'] . '</td></tr>
            <tr><td><strong>Name</strong></td><td>' . $row['requester_name'] . '</td></tr>
            <tr><td><strong>Address Line 1</strong></td><td>' . $row['requester_add1'] . '</td></tr>
            <tr><td><strong>Address Line 2</strong></td><td>' . $row['requester_add2'] . '</td></tr>
            <tr><td><strong>Thana/PS</strong></td><td>' . $row['requester_city'] . '</td></tr>
            <tr><td><strong>City</strong></td><td>' . $row['requester_state'] . '</td></tr>
            <tr><td><strong>Zip Code</strong></td><td>' . $row['requester_zip'] . '</td></tr>
            <tr><td><strong>Email</strong></td><td>' . $row['requester_email'] . '</td></tr>
            <tr><td><strong>Mobile</strong></td><td>' . ($row['requester_mobile']) . '</td></tr>
            <tr><td><strong>Assigned Date</strong></td><td>' . $row['assign_date'] . '</td></tr>
            <tr><td><strong>Representator Name</strong></td><td>' . $row['assign_tech'] . '</td></tr>
            <tr><td><strong>Representator Contact Number</strong></td><td>' . $techMobile . '</td></tr>
        </table>
        </div>';
    } else {
        echo "<div class='alert alert-danger'>No assigned details found.</div>";
    }
}
?>
