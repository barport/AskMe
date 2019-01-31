<?php

require_once 'app/helpers.php';
start_session('boris');

if( isset($_SESSION['user_id'])){

  header('location:blog.php');
  exit;

}
$title = 'AskMe | Sign In';
$error = '';


if(isset($_POST['submit'])) {

  if(isset($_POST['token']) && isset($_SESSION['token']) && $_POST['token'] === $_SESSION['token']){

    db_connect();
    $email = trim(filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL));
    $email = mysqli_real_escape_string($mysql_link,$email);
    $password = trim(filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING));
    $password = mysqli_real_escape_string($mysql_link,$password);

    if(!$email){

  
    $error = '* A valid email is required';

  }elseif(!$password){

  
  $error = '* Password is required';

}else {

  $sql = "SELECT * FROM users WHERE email = '$email'";
  $user = db_query_row($sql);
  
  if($user) {

    if(password_verify($password,$user['password'])){
      $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
      $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];

      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_name'] = $user['name'];
      header('location: blog.php?sm=Welcome Back, ' . $user['name']);
      exit;
    }else {

      $error = ' * Wrong email or password.';
  

    }
  }
  else {

    $error = ' * Wrong email or password.';
  }
  }
}
$token = csrf_token();

}else{

  $token = csrf_token();

}


?>


<?php include 'tpl/header.php'; ?>
<main>

  <div class="container">
    <div class="row">
      <div class="col-12 pt-5">
        <h1 class="disply-4 text-center text-white">LOG IN
        </h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 m-auto">
        <div class="card mt-5 bgc2">
          <div class="card-header">
            <span class="h5 animated fadeInDown text-white">
              SIGN IN WITH EMAIL</span>
          </div>
          <div class="card-body bgc2">
            <form action="" method="POST" novalidate="novalidte" autocomplete="off">
              <input type="hidden" name="token" value="<?= $token ?>">
              <div class="form-group">
                <label for="email" class="animated fadeInDown"><span class="text-danger">*</span> Email : </label>
                <input class="form-control" type="email" name="email" id="email">
              </div>
              <div class="form-group">
                <label for="password" class="animated fadeInDown"><span class="text-danger">*</span> Password : </label>
                <input class="form-control" type="password" name="password" id="password">
                <label class="checkbox-inline"><input type="checkbox" value="">Remember Me</label>
              </div>
              <span class="text-danger">
                <?php if ($error) : ?>
                <?= $error; ?>
                <?php endif ;?>
                <input class="btn btn-lg btn-primary btn-block mt-5" type="submit" value="Log-In" name="submit">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include 'tpl/footer.php'; ?>