<?php include "../db/db.php"; ?>
<?php include "../db/functions.php"; ?>
<?php session_start(); ?>

<?php
    if (isset($_POST["set_password"])) {
        $u_pass = mysqli_real_escape_string($connection, $_POST["password"]);
        $u_pass2 = mysqli_real_escape_string($connection, $_POST["password2"]);
        $u_pass3 = mysqli_real_escape_string($connection, $_POST["password3"]);

        if ($u_pass2 == $u_pass3) {
            $u_pass = password_hash($u_pass, PASSWORD_BCRYPT, ["cost" => 12]);
            $u_pass2 = password_hash($u_pass2, PASSWORD_BCRYPT, ["cost" => 12]);
            $token = updatePassword($_SESSION["id"], $_SESSION["token"], $u_pass, $u_pass2);
            if ($token) {
                $_SESSION["token"] = $token;
            }
        }
        header("Location: ../../index.php");
    }
?>
