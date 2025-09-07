<?php
session_start();
// ===== AUTO LOGOUT CODE START =====
$timeout_duration = 3600;

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset();
    session_destroy();
    echo "<script>alert('Session expired. Please login again.'); location.href='RequesterLogin.php';</script>";
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time();
// ===== AUTO LOGOUT CODE END =====

if (!isset($_SESSION['is_login'])) {
    echo "<script> location.href='RequesterLogin.php'; </script>";
    exit;
}

$rEmail = $_SESSION['rEmail'];
define('TITLE', 'Success');
define('PAGE', 'SubmitRequest');

include('../dbConnection.php');
include('includes/header.php');

$request_id = isset($_SESSION['myid']) ? (int)$_SESSION['myid'] : 0;

$sql = "SELECT * FROM submitrequest_tb WHERE request_id = $request_id";
$result = $conn->query($sql);

if ($result && $result->num_rows == 1) {
    $row = $result->fetch_assoc();
    echo "<div class='ml-5 mt-5'>
    <table class='table'>
        <tbody>
            <tr>
                <th>Request ID</th>
                <td>{$row['request_id']}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{$row['requester_name']}</td>
            </tr>
            <tr>
                <th>Email ID</th>
                <td>{$row['requester_email']}</td>
            </tr>
            <tr>
                <th>Service Info</th>
                <td>{$row['request_info']}</td>
            </tr>
            <tr>
                <th>Service Description</th>
                <td>{$row['request_desc']}</td>
            </tr>
            <tr>
                <td colspan='2' style='font-size:14px;'>
                    <strong>Note:</strong>
                    <i>Your request has been successfully submitted.</br>
                        To confirm the service, please proceed with the payment of BDT 50 by clicking the 'Make Payment' button.</br>
                        Kindly note your Request ID for future reference, as it will be required to check the status of your service.</i>
                </td>
            </tr>
            <tr>
                <td colspan='2'>
                    <form class='d-print-none' action='p.php' method='get' onsubmit='return checkTerms();'>
                        <input type='hidden' name='request_id' value='{$row['request_id']}'>
                        <div class='form-check mb-3'>
                            <input class='form-check-input' type='checkbox' id='termsCheck' onchange='togglePaymentButton()'>
                            <label class='form-check-label' for='termsCheck'>
                                I agree to the <a href='terms-and-conditions.html' target='_blank'>Terms and Conditions</a>
                            </label>
                        </div>
                        <input class='btn btn-danger' type='submit' value='Make Payment' id='makePaymentBtn' disabled>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<script>
function togglePaymentButton() {
    document.getElementById('makePaymentBtn').disabled = !document.getElementById('termsCheck').checked;
}

function checkTerms() {
    if (!document.getElementById('termsCheck').checked) {
        alert('Please agree to the Terms and Conditions before proceeding.');
        return false;
    }
    return true;
}
</script>";
} else {
    echo "<div class='alert alert-danger mt-4 ml-5'>Failed to retrieve request details.</div>";
}

include('includes/footer.php'); 
$conn->close();
?>
