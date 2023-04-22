<?php include "../db/db.php"; ?>
<?php include "../db/functions.php"; ?>
<?php session_start(); ?>

<?php
    if (isset($_POST["login"])) {
        $u_name = mysqli_real_escape_string($connection, $_POST["username"]);
        $u_pass = mysqli_real_escape_string($connection, $_POST["password"]);

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
                        $_SESSION["email"] = $row["email"];
                        $_SESSION["manager"] = $row["supervisor_id"];
                        $_SESSION["is_active"] = $row["is_active"];
                        $_SESSION["is_superuser"] = $row["is_superuser"];
                        $_SESSION["can_approve_leave"] = $row["can_approve_leave"];
                    }
                    // echo "<script>console.log('{$token}');</script>";
                    break;
                }
            }
        }
        header("Location: ../../index.php");
    }
?>
