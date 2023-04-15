<?php include "includes/header.php" ?>

    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>

<?php
    if (isset($_SESSION["id"])) {
        $id = $_SESSION["id"];
        if ($result = getUserById($id)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $firstname = $row["firstname"];
                $lastname = $row["lastname"];
                $username = $row["username"];
                $email = $row["email"];
                $image = $row["image"];
                $password = $row["password"];
            }
        }
    }

    if (isset($_POST["update_profile"])) {
        $firstname = mysqli_real_escape_string($connection, $_POST["firstname"]);
        $lastname = mysqli_real_escape_string($connection, $_POST["lastname"]);
        $username = mysqli_real_escape_string($connection, $_POST["username"]);
        $role = mysqli_real_escape_string($connection, $_POST["role"]);
        $email = mysqli_real_escape_string($connection, $_POST["email"]);

        if (strlen(mysqli_real_escape_string($connection, $_POST["password"]))) {
            $password = mysqli_real_escape_string($connection, $_POST["password"]);
        }

        /*
            if image file is empty then keep old value
        */
        if (!empty($_FILES["image"]["name"])) {
            echo $_FILES["image"]["name"];
            $image = $_FILES["image"]["name"];
            $image_tmp = $_FILES["image"]["tmp_name"];
        }

        updateUser($id, $firstname, $lastname, $username, $image, $role, $email, $password);

        /*
            update file only if valid image is selected
        */
        if (!empty($image_tmp)) {
            move_uploaded_file($image_tmp, "../images/$image");
        }
    }
?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <?php include "includes/greetings.php"; ?>

                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="firstname">Firstname</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $firstname ?>">
                        </div>
                        <div class="form-group">
                            <label for="lastname">Lastname</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $lastname ?>">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $username ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email ?>">
                        </div>
                        <div class="form-group">
                            <label for="image">User Image</label>
                            <br>
                            <img src="../images/<?php echo $image; ?>" alt="">
                            <br>
                            <br>
                            <input type="file" id="image" name="image">
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="role">
<?php
                                echo "<option value='{$role}'>" . ucfirst($role) ."</option>";

                                if ($role == "admin") {
                                    echo "<option value='subscriber'>Subscriber</option>";
                                } else {
                                    echo "<option value='admin'>Admin</option>";
                                }
?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" value="">
                        </div>
                        <button type="submit" name="update_profile" class="btn btn-primary">Update profile</button>
                    </form>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->


<?php include "includes/footer.php" ?>
