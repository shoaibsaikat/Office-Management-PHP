<?php session_start(); ?>

<?php
    $_SESSION["id"] = null;
    $_SESSION["username"] = null;
    $_SESSION["firstname"] = null;
    $_SESSION["lastname"] = null;

    header("Location: ../");
?>