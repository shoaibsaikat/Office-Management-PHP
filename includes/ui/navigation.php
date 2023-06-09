<nav class="navbar navbar-expand-lg navbar-light border-top border-bottom primary-color rounded-2">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarToggler">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
<?php if (!isset($_SESSION["id"])) { ?>
        <li class="nav-item">
          <a class="nav-link" href="registration.php">Registration</a>
        </li>
<?php } else { ?>
        <li class="nav-item">
          <a class="nav-link" href="profile.php">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="leave.php">Leave</a>
        </li>
<?php } ?>
      </ul>
<?php if (isset($_SESSION["id"])) { ?>
      <form class="d-flex" action="includes/action/user_logout.php" method="post">
        <button class="btn secondary-button-color" type="submit" name="logout">Logout</button>
      </form>
<?php } ?>
    </div>
  </div>
</nav>
