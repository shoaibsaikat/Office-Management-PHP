<?php include "includes/header.php"; ?>

    <div class="row">
        <!-- Home Column -->
        <div class="col-md-8">
        <h1 class="page-header">
            Welcome <?php echo $_SESSION["firstname"]; ?> to Office Management System
        </h1>
        </div>
        <!-- Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>
    </div>
    <!-- /.row -->

<?php include "includes/footer.php"; ?>
