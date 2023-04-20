<div class="col-md-4">
<?php if (!isset($_SESSION["id"])) { ?>
    <div>
        <h4>Login</h4>
        <form action="includes/action/user_login.php" method="post">
            <div class="mb-3">
                <input type="text" class="form-control" name="username" placeholder="Enter Username">
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Enter Password">
            </div>
            <button type="submit" class="btn btn-primary" name="login">Login</button>
        </form>
    </div>
<?php } else {  ?>
    <div>
        <h4>My Password</h4>
        <form action="includes/action/user_password.php" method="post">
            <div class="mb-3">
                <label for="password" class="form-label">Enter current password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Current password">
            </div>
            <div class="mb-3">
                <label for="password2" class="form-label">Enter new password</label>
                <input type="password2" class="form-control" name="password2" id="password2" placeholder="New password">
            </div>
            <div class="mb-3">
                <label for="password3" class="form-label">Enter password again</label>
                <input type="password3" class="form-control" name="password3" id="password3" placeholder="New password">
            </div>
            <button type="submit" class="btn btn-primary" name="set_password">Change</button>
        </form>
    </div>
    <hr>
    <div>
        <h4>My Manager</h4>
        
        <form action="includes/action/user_manager.php" method="post">
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
            <button type="submit" class="btn btn-primary" name="set_manager">Set</button>
        </form>
    </div>
<?php } ?>
</div>
