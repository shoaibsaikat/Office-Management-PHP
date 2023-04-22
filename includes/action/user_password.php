<?php include "../db/db.php"; ?>
<?php include "../db/functions.php"; ?>
<?php session_start(); ?>

<?php
    if (isset($_POST["set_password"])) {
        $u_pass = mysqli_real_escape_string($connection, $_POST["password"]);
        $u_pass2 = mysqli_real_escape_string($connection, $_POST["password2"]);
        $u_pass2 = mysqli_real_escape_string($connection, $_POST["password3"]);

        if ($result = getUserByUsername($u_name)) {
            while ($row = mysqli_fetch_assoc($result)) {
                if (password_verify($u_pass, $row["password"])) {
                    $token = generateToken($row["id"]);
                    if ($token) {
                        $_SESSION["id"] = $row["id"];
                        $_SESSION["token"] = $token;
                        $_SESSION["username"] = $row["username"];
                        $_SESSION["firstname"] = $row["first_name"];
                        $_SESSION["lastname"] = $row["last_name"];
                        $_SESSION["manager"] = $row["supervisor_id"];
                    }
                    break;
                }
            }
        }
        header("Location: ../../index.php");
    }
?>
