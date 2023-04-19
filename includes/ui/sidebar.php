<div class="col-md-4">
<?php if (!isset($_SESSION["id"])) { ?>
    <div>
        <h4>Login</h4>
        <form action="includes/ui/login.php" method="post">
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
<?php }  ?>
</div>
