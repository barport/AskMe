<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
    integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
    integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/animate.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <link rel="icon" type="image/x-icon" href="favicon.ico">
  <title>
    <?=$title;?>
  </title>
</head>

<body>

  <header>
    <nav class="navbar navbar-expand-lg navbar-light">
      <a class="navbar-brand secondary font-weight-bold text-white h1" href="./"><i
          class="fas fa-question-circle fa-3x"></i></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="text-white"><i class="fas fa-align-justify"></i></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link text-white h3" href="blog.php"><i class="fas fa-blog"></i> AskMe</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link text-white h3" href="about.php"><i class="fas fa-info"></i> About</a>
          </li>
        </ul>
        <?php if(! isset($_SESSION['user_id'])): ?>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item ">
            <a class="nav-link text-white" href="signin.php"><i class="fas fa-sign-in-alt"></i> Log In</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link text-white" href="signup.php"><i class="fas fa-user-plus"></i> Register</a>
          </li>
        </ul>
        <?php else :?>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item ">
            <a class="nav-link text-white" href="#">

              <i class="fas fa-user"></i>
              <?=htmlspecialchars($_SESSION['user_name']);?>
          </li>
          <li class="nav-item ">
            <a class="nav-link text-white" href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
          </li>

        </ul>
        <?php endif;?>

      </div>
    </nav>

  </header>
  <?php if (isset($_GET['sm'])): ?>
  <div id="sm-box" class="container fixed-top mt-3">
    <div class="col-8 m-auto">
      <div class="alert alert-success text-center" role="alert">
        <?=$_GET['sm'];?>
      </div>
    </div>
  </div>
  <?php endif;?>