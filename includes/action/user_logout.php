<?php include "../db/db.php"; ?>
<?php include "../db/functions.php"; ?>
<?php session_start(); ?>

<?php
    logout($_SESSION["id"]);
    $_SESSION["id"] = null;
    $_SESSION["username"] = null;
    $_SESSION["firstname"] = null;
    $_SESSION["lastname"] = null;

    header("Location: ../../index.php");
?>