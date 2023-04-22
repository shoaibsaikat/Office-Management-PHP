<?php include "includes/ui/header.php"; ?>

<div class="row">
    <!-- Home Column -->
    <div class="col-md-8 body-height">
    <h1 class="page-header">
        Welcome 
<?php
        if (isset($_SESSION["firstname"])) {
            echo $_SESSION["firstname"]." ".$_SESSION["lastname"];
        }
?>
    </h1>
    <table>
        <tbody>
            <tr>
                <td><strong>Username:&emsp;</td>
                <td><?php echo $_SESSION["username"]; ?></td>
            </tr>
            <tr>
                <td><strong>Email:&emsp;</td>
                <td><?php echo $_SESSION["email"]; ?></td>
            </tr>

        </tbody>
    </table>
    </div>
    <!-- Sidebar Widgets Column -->
    <?php include "includes/ui/profile_sidebar.php"; ?>
</div>
<!-- /.row -->
<?php include "includes/ui/footer.php"; ?>
