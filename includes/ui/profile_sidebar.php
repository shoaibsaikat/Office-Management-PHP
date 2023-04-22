<div class="col-md-4">
<?php if (isset($_SESSION["id"])) {  ?>
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
            <button type="submit" class="btn primary-button-color" name="set_manager">Set</button>
        </form>
    </div>
    <hr>
    <div>
        <h4>My Password</h4>
        <form action="includes/action/user_password.php" method="post">
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
