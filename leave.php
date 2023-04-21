<?php include "includes/ui/header.php"; ?>

<div class="row">
    <!-- Home Column -->
    <div class="col-md-8 body-height">
    <h1 class="page-header">
<?php
            if (isset($_SESSION["firstname"])) {
                echo $_SESSION["firstname"]."'s leave this year";
            }
?>
    </h1>
    </div>
    <!-- Sidebar Widgets Column -->
    <?php include "includes/ui/leave_sidebar.php"; ?>
</div>
<!-- /.row -->
<?php include "includes/ui/footer.php"; ?>
