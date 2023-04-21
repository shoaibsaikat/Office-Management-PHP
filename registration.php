<?php include "includes/ui/header.php"; ?>

<?php
    $msg = "";
    if (isset($_POST["submit"])) {
        if ($_POST["username"] != "" && $_POST["email"] != "" && $_POST["password"] != "" && $_POST["password2"] != "" && $_POST["firstname"] != "") {
            $u_pass = mysqli_real_escape_string($connection, $_POST["password"]);
            $u_pass2 = mysqli_real_escape_string($connection, $_POST["password2"]);
            if (strcmp($u_pass,$u_pass2) != 0) {
                $msg = "Passwords doesn't match!";
            } else {
                $u_name = mysqli_real_escape_string($connection, $_POST["username"]);
                $u_first_name = mysqli_real_escape_string($connection, $_POST["firstname"]);
                $u_last_name = mysqli_real_escape_string($connection, $_POST["lastname"]);
                $u_email = mysqli_real_escape_string($connection, $_POST["email"]);
                $u_pass = password_hash($u_pass, PASSWORD_BCRYPT, ["cost" => 12]);
                registerUser($u_name, $u_first_name, $u_last_name, $u_email, $u_pass);
                header("Location: index.php");
            }
        } else {
            $msg = "Fields can't be empty!";
        }
    }
?>


<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 body-height">
            <div class="form-wrap">
            <h1>Register</h1>
                <!-- Error message -->
                <div class="text-danger"><?php echo $msg; ?></div>

                <form action="registration.php" method="post" id="login-form" autocomplete="off">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Enter desired username">
                    </div>
                    <div class="mb-3">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter first name">
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter last name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="somebody@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>
                    <div class="mb-3">
                        <label for="password2" class="form-label">Enter password again</label>
                        <input type="password2" class="form-control" name="password2" id="password2" placeholder="Enter password again">
                    </div>
                    <input type="submit" class="btn primary-color" name="submit" id="btn-login" value="Register">
                </form>
            </div>
        </div> <!-- /.col-xs-12 -->
    </div> <!-- /.row -->
</div> <!-- /.container -->


<?php include "includes/ui/footer.php";?>
