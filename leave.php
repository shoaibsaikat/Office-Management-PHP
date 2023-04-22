<?php include "includes/ui/header.php"; ?>

<div class="row">
    <!-- Home Column -->
    <div class="col-md-8 body-height">
        <h1 class="page-header">Your leave this year</h1>
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
if ($result = getAllLeaveByUserInCurrentYear($_SESSION["id"])) {
    $count = 0;
    $total = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $total += $row["day_count"];
?>
                    <tr>
                        <th scope="row"><?php echo ++$count; ?></th>
                        <td><?php echo getPrintableDate($row["start_date"]); ?></td>
                        <td><?php echo $row["approved"] == null ? "Waiting for approval" : "Approved"; ?></td>
                        <td><?php echo $row["day_count"]; ?></td>
                    </tr>
<?php } ?>
                    <tr class="primary-color">
                        <th scope="row">Total</th>
                        <td colspan="2"></td>
                        <td><?php echo $total; ?></td>
                    </tr>
<?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Sidebar Widgets Column -->
    <?php include "includes/ui/leave_sidebar.php"; ?>
</div>
<!-- /.row -->
<?php include "includes/ui/footer.php"; ?>
