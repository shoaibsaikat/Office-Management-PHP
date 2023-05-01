<?php
$msg = "";

if (isset($_POST["set_password"])) {
    $u_pass = mysqli_real_escape_string($connection, $_POST["password"]);
    $u_pass2 = mysqli_real_escape_string($connection, $_POST["password2"]);
    $u_pass3 = mysqli_real_escape_string($connection, $_POST["password3"]);

    if (strcmp($u_pass2, $u_pass3) == 0) {
        if ($result = getUserById($_SESSION["id"])) {
            while ($row = mysqli_fetch_assoc($result)) {
                if (password_verify($u_pass, $row["password"])) {
                    $u_pass2 = password_hash($u_pass2, PASSWORD_BCRYPT, ["cost" => 12]);
                    $_SESSION["token"] = updatePassword($_SESSION["id"], $_SESSION["token"], $u_pass2);
                    header("Location: index.php");
                } else {
                    $msg = "Wrong current passowrd!";
                }
                break;
            }
        }
    } else {
        $msg = "Passowrds do not match!";
    }
} else if (isset($_POST["set_manager"])) {
    if (isset($_SESSION["id"]) && isset($_POST["supervisor"])) {
        $supervisor = mysqli_real_escape_string($connection, $_POST["supervisor"]);
        if (setSupervisor($_SESSION["id"], $supervisor)) {
            $_SESSION["manager"] = $supervisor;
        }
    }
    header("Location: index.php");
}
?>

<div class="col-md-4">
<?php if (isset($_SESSION["id"])) {  ?>
    <div>
        <h4>My Manager</h4>
        <form action="profile.php" method="post">
            <select class="form-select mb-3" aria-label=".form-select" name="supervisor">
                <option selected disabled hidden>Select manager</option>
<?php
    if ($result = getAllUsers($_SESSION["id"], $_SESSION["token"])) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row["id"] != $_SESSION["id"] && $_SESSION["manager"] != $row["id"]) {
?>
                <option value="<?php echo $row["id"]; ?>" >
                    <?php echo $row["first_name"]." ".$row["last_name"]; ?>
                </option>
<?php
            }
        }
    }
?>
            </select>
            <button type="submit" class="btn primary-button-color" name="set_manager">Set</button>
        </form>
    </div>
    <hr>
    <div>
        <h4>My Password</h4>
        <!-- Error message -->
        <div class="text-danger"><?php echo $msg; ?></div><br>

        <form action="profile.php" method="post">
            <div class="mb-3">
                <input type="password" class="form-control" name="password" id="password" placeholder="Current password">
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="password2" id="password2" placeholder="New password">
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="password3" id="password3" placeholder="Enter new password again">
            </div>
            <button type="submit" class="btn primary-button-color" name="set_password">Change</button>
        </form>
    </div>
<?php } ?>
</div>
