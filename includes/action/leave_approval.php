<?php include "../db/db.php"; ?>
<?php include "../db/functions.php"; ?>
<?php session_start(); ?>

<?php
    if (isset($_SESSION["id"]) && isset($_POST["leave_approve"])) {
        leaveApprove($_POST["leave"]);
    } else if (isset($_SESSION["id"]) && isset($_POST["leave_decline"])) {
        leaveDecline($_POST["leave"]);
    }
    header("Location: ../../leave.php");
?>
