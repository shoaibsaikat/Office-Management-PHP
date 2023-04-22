<?php include "includes/ui/header.php"; ?>

<!-- page variables -->
<?php
if (!isset($_GET['ml'])) {
	$currentPageMyLeave = 1;
} else {
	$currentPageMyLeave = $_GET['ml'];
}

$myLeaveCount = getAllLeaveCountByUserInCurrentYear($_SESSION["id"]);
$totalPageMyLeave = ceil($myLeaveCount / ENV_PAGE_LIMIT);

if (!isset($_GET['la'])) {
	$currentPageLeaveApproval = 1;
} else {
	$currentPageLeaveApproval = $_GET['la'];
}

$myLeaveApprovalCount = getAllPendingLeaveCountByApproverInCurrentYear($_SESSION["id"]);
$totalPageLeaveApproval = ceil($myLeaveApprovalCount / ENV_PAGE_LIMIT);
?>

<div class="row">
    <!-- Own Leave Column -->
    <div class="col-md-8">
        <h2>Your leave in <?php echo date("Y"); ?></h2>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Days</th>
                    </tr>
                </thead>
                <tbody>
<?php
if ($result = getAllLeaveByUserInCurrentYear($_SESSION["id"], $currentPageMyLeave)) {
    $count = 0;
    $total = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $total += $row["day_count"];
?>
                    <tr>
                        <th scope="row"><?php echo ++$count; ?></th>
                        <td><?php echo getPrintableDate($row["start_date"]); ?></td>
                        <td>
<?php
                            if ($row["approved"] == null) {
                                echo "Waiting for approval";
                            } else if ($row["approved"] == 0) {
                                echo "Not approved";
                            } else {
                                echo "Approved";
                            }
?>
                        </td>
                        <td><?php echo $row["day_count"]; ?></td>
                    </tr>
<?php } ?>
                    <!-- <tr class="primary-color">
                        <th scope="row">Total</th>
                        <td colspan="2"></td>
                        <td><?php echo $total; ?></td>
                    </tr> -->
<?php } ?>
                </tbody>
            </table>
        </div>
        <nav>
            <ul class="pagination">
<?php
                // only three or less page number will be shown
                $maxViewPageMyLeave = $totalPageMyLeave > $currentPageMyLeave + 1 ? $currentPageMyLeave + 1 : $totalPageMyLeave;
                if ($currentPageMyLeave > 1) {
                    $i = $currentPageMyLeave - 1;
                } else {
                    $i = $currentPageMyLeave;
                }
                for (; $i <= $maxViewPageMyLeave; $i++) {
                    if ($currentPageMyLeave == $i) {
                        echo "<li class='page-item active'><a class='page-link' href='leave.php?ml={$i}&la={$currentPageLeaveApproval}'>{$i}</a></li>";
                    } else {
                        echo "<li class='page-item'><a class='page-link' href='leave.php?ml={$i}&la={$currentPageLeaveApproval}'>{$i}</a></li>";
                    }
                }
?>
            </ul>
        </nav>
    </div>
    <!-- Sidebar Widgets Column -->
    <?php include "includes/ui/leave_sidebar.php"; ?>
    <div class="col-md-12"><br></div>
    <div class="col-md-12"><br></div>
    <!-- Leave Approval Column -->
<?php if (isset($_SESSION["can_approve_leave"]) && $_SESSION["can_approve_leave"]) { ?>
    <hr>
    <div class="col-md-12"><br></div>
    <div class="col-md-12">
        <h2>Leave Approval for <?php echo date("Y"); ?></h2>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th>User</th>
                    <th scope="col">Date</th>
                    <th scope="col">Days</th>
                    <th scope="col">Reason</th>
                    <th scope="col">Approve</th>
                    <th scope="col">Decline</th>
                </tr>
                </thead>
                <tbody>
<?php
if ($result = getAllPendingLeaveByApproverInCurrentYear($_SESSION["id"], $currentPageLeaveApproval)) {
    $count = 0;
    while ($row = mysqli_fetch_assoc($result)) {
?>
                    <tr>
                        <th scope="row"><?php echo ++$count; ?></th>
                        <td><?php echo $row["first_name"]." ".$row["last_name"]; ?></td>
                        <td><?php echo getPrintableDate($row["start_date"]); ?></td>
                        <td><?php echo $row["day_count"]; ?></td>
                        <td><?php echo $row["comment"]; ?></td>
                        <td><form action="includes/action/leave_approval.php" method="post">
                            <input type="text" name="leave" hidden value="<?php echo $row["id"]; ?>">
                            <button type="submit" class="btn primary-color" name="leave_approve">Approve</button>
                        </form></td>
                        <td><form action="includes/action/leave_approval.php" method="post">
                            <input type="text" name="leave" hidden value="<?php echo $row["id"]; ?>">
                            <button type="submit" class="btn secondary-color" name="leave_decline">Decline</button>
                        </form></td>
                    </tr>
<?php
        }
    } 
?>
                </tbody>
            </table>
        </div>
        <nav>
            <ul class="pagination">
<?php
                // only three or less page number will be shown
                $maxViewPageLeaveApproval = $totalPageLeaveApproval > $currentPageLeaveApproval + 1 ? $currentPageLeaveApproval + 1 : $totalPageLeaveApproval;
                if ($currentPageLeaveApproval > 1) {
                    $i = $currentPageLeaveApproval - 1;
                } else {
                    $i = $currentPageLeaveApproval;
                }
                for (; $i <= $maxViewPageLeaveApproval; $i++) {
                    if ($currentPageLeaveApproval == $i) {
                        echo "<li class='page-item active'><a class='page-link' href='leave.php?ml={$currentPageMyLeave}&la={$i}'>{$i}</a></li>";
                    } else {
                        echo "<li class='page-item'><a class='page-link' href='leave.php?ml={$currentPageMyLeave}&la={$i}'>{$i}</a></li>";
                    }
                }
?>
            </ul>
        </nav>
    </div>
<?php } ?>
</div>
<!-- /.row -->
<?php include "includes/ui/footer.php"; ?>
