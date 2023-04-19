<div class="col-md-4">
<?php if (!isset($_SESSION["id"])) { ?>
    <div>
        <h4>Login</h4>
        <form action="includes/action/user_login.php" method="post">
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Enter Username">
            </div>
            <div class="input-group">
                <input type="password" name="password" class="form-control" placeholder="Enter Password">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="login">Login</button>
                </span>
            </div>
        </form>
    </div>
<?php } else {  ?>
    <div>
        <h4>My Manager</h4>
        <form action="includes/action/user_manager.php" method="post">
            <div class="form-group">
                <label class="form-label">Choose your manager</label>
                <select class="form-control" name="supervisor">
<?php
                if ($result = getAllUsers()) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row["id"] != $_SESSION["id"]) {
?>
                            <option value="<?php echo $row["id"]; ?>">
                                <?php echo $row["first_name"]." ".$row["last_name"]; ?>
                            </option>
<?php
                        }
                    }
                }
?>
                </select>
            </div>
            <button type="submit" class="btn btn-default" name="set_manager">Set</button>
        </form>
    </div>
<?php } ?>
</div>
