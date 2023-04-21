<nav class="navbar navbar-expand-lg bg-body-tertiary navbar-light" style="background-color: #e3f2fd;">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <!-- <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li> -->
<?php if (!isset($_SESSION["id"])) { ?>
        <li class="nav-item active">
          <a class="nav-link" href="registration.php">Registration</a>
        </li>
<?php } else { ?>
        <li class="nav-item">
          <a class="nav-link" href="profile.php">Profile</a>
        </li>
<?php } ?>
      </ul>
    </div>
    <ul class="nav justify-content-end">
<?php if (isset($_SESSION["id"])) { ?>
      <form class="d-flex" action="includes/action/user_logout.php" method="post">
        <button class="btn btn-outline-success" type="submit" name="logout">Logout</button>
      </form>
<?php } ?>
    </ul>
  </div>
</nav>
