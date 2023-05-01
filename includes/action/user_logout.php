<?php include "../db/db.php"; ?>
<?php include "../db/functions.php"; ?>
<?php session_start(); ?>

<?php
if (isset($_SESSION["id"]) && isset($_POST["logout"])) {
    logout($_SESSION["id"]);
    $_SESSION["id"] = null;
    $_SESSION["token"] = null;
    $_SESSION["username"] = null;
    $_SESSION["firstname"] = null;
    $_SESSION["lastname"] = null;
    $_SESSION["email"] = null;
    $_SESSION["manager"] = null;
    $_SESSION["is_active"] = null;
    $_SESSION["is_superuser"] = null;
    $_SESSION["is_superuser"] = null;
    $_SESSION["can_approve_leave"] = null;
    $_SESSION["manager_name"] = null;

    header("Location: ../../index.php");
}
?>