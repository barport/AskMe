<?php

require_once 'app/helpers.php';
start_session('boris');
$title = 'AskMe | Home page';?>

<?php include 'tpl/header.php'; ?>



<main>
  <div class="container text-white fadeInLeft m-auto">
    <div class="row">
      <div class="col-6 pt-2 m-auto text-white">
        <h1 class="display-2 animated slideInDown border-bottom">
          <i class="fas fa-blog fa-1x"></i> AskMe
        </h1>
        <div class="para mt-5">
          <p class="mt-5">
            Science discoveries reveild that having access
            to social media while learning can be very disturbing
            for your focus,<br>
          </p>
          <p>
            Leave the phone in another room and
          </p>
        </div>
        <p>
          <h1><a href="blog.php" class="button5 rounded font-weight-bold text-white animated fadeInUp" style="
            background-color:#42cc8c;">Start
              Now</a></h1>
        </p>
      </div>
    </div>
  </div>
</main>

<?php include 'tpl/footer.php'; ?>