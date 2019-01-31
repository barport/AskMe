<?php

require_once 'app/helpers.php';
start_session('boris');
$title = 'AskMe | About Us';

?>

<?php include 'tpl/header.php';?>



<main>
  <div class="container">
    <div class="row">
      <div class="col-8 pt-4 text-white bgc3 m-auto">
        <h1 class="disply-2 text-center pt-5 animated pulse pb-3">About Us</h1>
        <div class="text-white bold para col-md-8 m-auto">
          <p>

            This website contains another way of communicating , without
            getting enterupted by Social media availability around you.
            <br>
            <br>
            How many times have you tried to prepare yourself for something, <br>
            Having a question -> Going on Whatsapp, Or calling your friend. <br>
            And then suddenly become aware of all the other notificaitons ,<br>
            suddenly your friend is asking you to go grab a bite ? <br>
            and You ? yeah sure iv'e studdied all day.
            <span id="dots">..</span>
            <br>
            <br>
            <span id="more">
              On AskMe You can post a question , and your class will immedietly
              recieve notification.
              close Classroom communication platform.
              You can share your Code with your Classmates, and in their free time
              they will be able to view it from any device, And from anywhere they are.</span>
          </p>
          <button onclick="myFunction()" id="myBtn">Read more</button>
          <p>
            <h2>Mobile App coming soon</h2>
        </div>
        </p>
      </div>
    </div>
  </div>
  <div class="col-5 m-auto">

    <img src="images/cover4.png" alt="Cover picture" width="100%">
  </div>

</main>



<?php include 'tpl/footer.php';?>