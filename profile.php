<?php include "includes/ui/header.php"; ?>

<div class="row">
    <!-- Home Column -->
    <div class="col-md-8 body-height">
    <h1 class="page-header">
        Welcome 
<?php
        if (isset($_SESSION["firstname"])) {
            echo $_SESSION["firstname"];
        }
?>
    </h1>
        <p><?php echo $_SESSION["email"]; ?></p>
    </div>
    <!-- Sidebar Widgets Column -->
    <?php include "includes/ui/profile_sidebar.php"; ?>
</div>
<!-- /.row -->
<?php include "includes/ui/footer.php"; ?>
