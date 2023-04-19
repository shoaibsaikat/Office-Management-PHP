<?php include "includes/ui/header.php"; ?>

    <div class="row">
        <!-- Home Column -->
        <div class="col-md-8">
        <h1 class="page-header">
            Welcome 
<?php
                if (isset($_SESSION["firstname"])) {
                    echo $_SESSION["firstname"];
                }
?>
             to Office Management System
        </h1>
        </div>
        <!-- Sidebar Widgets Column -->
        <?php include "includes/ui/sidebar.php"; ?>
    </div>
    <!-- /.row -->

<?php include "includes/ui/footer.php"; ?>
