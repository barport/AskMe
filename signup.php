<?php

require_once 'app/helpers.php';
start_session('boris');


if (isset($_SESSION['user_id'])) {
    header('location: blog.php');
    exit;
}


$title = 'AskMe | Registration';
$error = '';

if (isset($_POST['submit'])) {

  if (isset($_POST['token']) && isset($_SESSION['token']) && $_POST['token'] === $_SESSION['token']) {

      db_connect();
      $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
      $name = mysqli_real_escape_string($mysql_link, $name);
      $email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
      $email = mysqli_real_escape_string($mysql_link, $email);
      $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
      $password = mysqli_real_escape_string($mysql_link, $password);
      $form_valid = true;
      $query_email = "SELECT email FROM users WHERE email = '$email'";

      if (!$name || mb_strlen($name) < 2) {
          $error = '* Name is required at least 2 chars.';
          $form_valid = false;
      }

      if (!$email) {
          $error = '* A valid email is required.';
          $form_valid = false;
      } elseif (db_query_row($query_email)) {
          $error = '* Email is taken.';
          $form_valid = false;
      }

      if (!$password || mb_strlen($password) < 6 || mb_strlen($password) > 20) {
          $error = '* Password is required between 6 - 20 chars';
          $form_valid = false;
      }

      if ($form_valid) {

          $image_name = 'default.png';
          $max_size = 1024 * 1024 * 5;
          $ex = ['png', 'jpg', 'jpeg', 'gif', 'bmp'];

          if (isset($_FILES['image']['error']) && $_FILES['image']['error'] == 0) {

              if (isset($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])) {

                  if (isset($_FILES['image']['size']) && $_FILES['image']['size'] <= $max_size) {

                      $file_info = pathinfo($_FILES['image']['name']);

                      if (in_array(strtolower($file_info['extension']), $ex)) {

                          $image_name = date('Y.m.d.H.i.s') . '-' . $_FILES['image']['name'];
                          move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $image_name);
                    }
                  }

              }

          }

          $password = password_hash($password, PASSWORD_BCRYPT);
          $sql = "INSERT INTO users VALUES(null, '".$name."', '".$email."', '".$password."', NOW())";
          $uid = db_insert($sql, true);
          db_insert("INSERT INTO user_profile VALUES(null, '".$uid."', '".$image_name."')");
          $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
          $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
          $_SESSION['user_id'] = $uid;
          $_SESSION['user_name'] = $name;
          header('location:blog.php?sm=You are now registered, Welcome ' . $name);
          exit;

      }

  }

  $token = csrf_token();

} else {

  $token = csrf_token();

}

?>

<?php include 'tpl/header.php';?>
<main>

  <div class="container">
    <div class="row">
      <div class="col-12 pt-5">
        <h2 class=" text-center text-white">REGISTERATION
        </h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mt-5 m-auto">
        <div class="card mt-5 bgc2 font">
          <div class="card-header">
            <span class="h5 text-white animated fadeInDown">SIGN UP USING YOUR EMAIL ADDRESS</span>
          </div>
          <div class="card-body bgc2">
            <form action="" method="POST" novalidate="novalidte" autocomplete="off" enctype="multipart/form-data">
              <input type="hidden" name="token" value="<?=$token;?>">
              <div class="form-group">
                <label for="name" class="animated fadeInDown"><span class="text-danger">*</span> Your Full name :
                </label>
                <input class="form-control" type="name" name="name" id="name">
                <span class="text-danger mt-1">
                </span>
              </div>
              <div class="form-group">
                <label for="email" class="animated fadeInDown"><span class="text-danger">*</span> Email : </label>
                <input class="form-control" type="email" name="email" id="email">
                <span class="text-danger mt-1">
                </span>
              </div>
              <div class="form-group">
                <label for="password" class="animated fadeInDown"><span class="text-danger">*</span> Password : </label>
                <input class="form-control" type="password" name="password" id="password">
                <span class="text-danger mt-1">
                </span>
              </div>
              <div class="form-group">
                <label for="image">Profile Image:</label>
              </div>
              <div class="input-group mb-3 ">
                <div class="input-group-prepend bgc3">
                  <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                </div>
                <div class="custom-file">
                  <input name="image" type="file" class="custom-file-input" id="image">
                  <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
              </div>
              <span class="text-danger">
                <?php if ($error) : ?>
                <?= $error; ?>
                <?php endif ;?>
                <input class="btn btn-success btn-lg btn-block text-white mt-5" type="submit" value="Sign Up"
                  name="submit">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</main>




<?php include 'tpl/footer.php';?>