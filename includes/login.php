<?php include "db.php"; ?>
<?php include "functions.php"; ?>
<?php session_start(); ?>

<?php
    if (isset($_POST["login"])) {
        $u_name = mysqli_real_escape_string($connection, $_POST["username"]);
        $u_pass = mysqli_real_escape_string($connection, $_POST["password"]);

        if ($result = getUserByUsername($u_name)) {
            while ($row = mysqli_fetch_assoc($result)) {
                if (password_verify($u_pass, $row["password"])) {
                    $_SESSION["id"] = $row["id"];
                    $_SESSION["username"] = $row["username"];
                    $_SESSION["firstname"] = $row["first_name"];
                    $_SESSION["lastname"] = $row["last_name"];
                    echo '<script>console.log("logged in");</script>';
                    break;
                } else {
                    echo '<script>console.log("login failed");</script>';
                }
            }
        }
        header("Location: ../index.php");
    }
?>
