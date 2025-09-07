<?php
define('TITLE', 'Status');
define('PAGE', 'CheckStatus');
include('includes/header.php');
include('../dbConnection.php');
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

if ($_SESSION['is_login']) {
    $rEmail = $_SESSION['rEmail'];
} else {
    echo "<script> location.href='RequesterLogin.php'; </script>";
    exit();
}
?>

<div class="col-sm-8 mt-5 mx-auto">
    <h4 class="text-center mb-5">Your Service Requests</h4>

    <?php
    $hasData = false;

    // ✅ Start the table once
    echo '<table class="table table-bordered text-center">';
    echo '<thead><tr>
            <th>Service ID</th>
            <th>Service Type</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
          </tr></thead><tbody>';

    // ✅ 1. Get services from submitrequest_tb (may or may not be assigned)
    $sql = "SELECT sr.request_id, sr.request_info, sr.request_date,
                   aw.request_id AS assigned_id
            FROM submitrequest_tb sr
            LEFT JOIN assignwork_tb aw 
            ON sr.request_id = aw.request_id AND sr.requester_email = aw.requester_email
            WHERE sr.requester_email = ?
            ORDER BY sr.request_id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $rEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $hasData = true;
        while ($row = $result->fetch_assoc()) {
            $status = $row['assigned_id'] ? "Assigned" : "Pending";
            echo "<tr>
                    <td>{$row['request_id']}</td>
                    <td>{$row['request_info']}</td>
                    <td>{$row['request_date']}</td>
                    <td>{$status}</td>
                    <td>";

            if ($status == "Assigned") {
                echo "<button 
                        class='btn btn-success btn-sm viewAssignedBtn' 
                        data-id='{$row['request_id']}' 
                        data-toggle='modal' 
                        data-target='#assignedModal'>
                        👁️‍🗨️​
                      </button>";
            } else {
                echo "<button class='btn btn-secondary btn-sm' disabled>⏱️​</button>";
            }

            echo "</td></tr>";
        }
    }

    // ✅ 2. Get services ONLY in assignwork_tb (not in submitrequest_tb)
    $sql2 = "SELECT aw.request_id, aw.request_info, aw.assign_date AS request_date
             FROM assignwork_tb aw
             WHERE aw.requester_email = ?
             AND aw.request_id NOT IN (
                 SELECT request_id FROM submitrequest_tb WHERE requester_email = ?
             )
             ORDER BY aw.request_id DESC";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("ss", $rEmail, $rEmail);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    if ($result2->num_rows > 0) {
        $hasData = true;
        while ($row2 = $result2->fetch_assoc()) {
            echo "<tr>
                    <td>{$row2['request_id']}</td>
                    <td>{$row2['request_info']}</td>
                    <td>{$row2['request_date']}</td>
                    <td>Assigned</td>
                    <td>
                        <button 
                            class='btn btn-success btn-sm viewAssignedBtn' 
                            data-id='{$row2['request_id']}' 
                            data-toggle='modal' 
                            data-target='#assignedModal'>
                            👁️‍🗨️​
                        </button>
                    </td>
                  </tr>";
        }
    }

    echo '</tbody></table>';

    if (!$hasData) {
        echo '<div class="alert alert-warning text-center">No service requests found.</div>';
    }
    ?>
</div>

<!-- ✅ Assigned Service Modal -->
<div class="modal fade" id="assignedModal" tabindex="-1" role="dialog" aria-labelledby="assignedModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><strong>Assigned Service Details</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="assignedDetailsContent">
        <p class="text-center">Loading...</p>
      </div>
    </div>
  </div>
</div>

<!-- ✅ JavaScript to load details via AJAX -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".viewAssignedBtn");

    buttons.forEach(btn => {
      btn.addEventListener("click", function () {
        const requestId = this.getAttribute("data-id");
        const modalBody = document.getElementById("assignedDetailsContent");

        modalBody.innerHTML = "<p class='text-center'>Loading...</p>";

        fetch("get_assigned_details.php", {
          method: "POST",
          headers: { "Content-Type": "application/x-www-form-urlencoded" },
          body: "request_id=" + requestId
        })
        .then(res => res.text())
        .then(html => {
          modalBody.innerHTML = html;
        })
        .catch(err => {
          modalBody.innerHTML = "<div class='alert alert-danger'>Error loading details.</div>";
        });
      });
    });
  });
</script>

<?php include('includes/footer.php'); ?>
