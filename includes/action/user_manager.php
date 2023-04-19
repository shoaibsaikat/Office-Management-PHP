<?php include "../db/db.php"; ?>
<?php include "../db/functions.php"; ?>
<?php session_start(); ?>

<?php
    if (isset($_SESSION["id"]) && isset($_POST["set_manager"])) {
        $supervisor = mysqli_real_escape_string($connection, $_POST["supervisor"]);
        if (setSupervisor($_SESSION["id"], $supervisor)) {
            $_SESSION["manager"] = $supervisor;
        }
        header("Location: ../../index.php");
    }
?>
