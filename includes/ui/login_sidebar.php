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
            <button type="submit" class="btn primary-button-color" name="login">Login</button>
        </form>
    </div>
<?php } ?>
</div>
