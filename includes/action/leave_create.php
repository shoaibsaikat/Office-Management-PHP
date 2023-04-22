<?php include "../db/db.php"; ?>
<?php include "../db/functions.php"; ?>
<?php session_start(); ?>

<?php
    if (isset($_SESSION["id"]) && isset($_POST["apply_leave"]) && isset($_POST["date"]) && isset($_POST["days"]) && isset($_POST["reason"])) {
        $date = mysqli_real_escape_string($connection, $_POST["date"]);
        $days = mysqli_real_escape_string($connection, $_POST["days"]);
        $reason = mysqli_real_escape_string($connection, $_POST["reason"]);
        createLeave($_SESSION["id"], $_SESSION["manager"], $date, $days, $reason);

        header("Location: ../../leave.php");
    }
?>
