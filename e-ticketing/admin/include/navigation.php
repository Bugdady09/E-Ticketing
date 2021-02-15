<nav class="navbar navbar-expand-lg navbar-fixed-top navbar-light bg-light fixed-top">
      <a class="navbar-brand" href="#">
        <img src="images/headerlogo/logo.png" height="60" width="60">
        Bangladesh Inland Water Transport
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">


        <?php 
            if (isset($_SESSION['user_email'])) {
        ?>
        <ul class="navbar-nav ml-auto ">
          <li class="nav-item active">
            <a class="nav-link" href="create.php">Add New Launch<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="trashed.php">Trashed Item<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="dashboard.php">Launch Info<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="logout.php">Logout<span class="sr-only">(current)</span></a>
          </li>
        </ul>
        <?php  }
        ?>

      </nav>