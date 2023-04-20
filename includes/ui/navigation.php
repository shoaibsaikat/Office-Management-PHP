<nav class="navbar navbar-expand-lg bg-body-tertiary">
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
          <a class="nav-link" href="includes/action/user_logout.php">Logout</a>
        </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>
