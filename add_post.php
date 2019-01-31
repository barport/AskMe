<?php

require_once 'app/helpers.php';

start_session('boris');
$error = '';


if(!verify_user()){

  header('location:blog.php');
  exit;
}

if(isset($_POST['submit'])) {

  db_connect();
  $title = trim(filter_input(INPUT_POST,'title',FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES));
  $title = mysqli_real_escape_string($mysql_link,$title);
  $article = trim(filter_input(INPUT_POST,'article',FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES));
  $article = mysqli_real_escape_string($mysql_link,$article);
  
  if(!$title|| mb_strlen($title) < 3) {

    $error = '* Title is not valid,At least 3 chars ';

  }else if(!$article || mb_strlen($article)< 3) {

    $error = '* Text is required ,at least 3 chars';
    
  }else {

    $uid = $_SESSION['user_id'];
    $sql = "INSERT INTO posts VALUES(null,$uid,'$title','$article',NOW())";
    $result = db_insert($sql);
    
    if($result) {
      header('location:blog.php?sm=Post saved');
      exit;
      
    }else {

      $error = '* OOPS, Something went wrong';
    }
  }

}

$title = 'AskMe | Add Post';
?>

<?php include 'tpl/header.php';?>



<main>
  <div class="container">
    <div class="row">
      <div class="col-12 pt-3">
        <h3 class="text-white">Hey,
          <?= $_SESSION['user_name']?>
        </h3>
        <h1 class="display-2 text-white">Ask A Question</h1>
      </div>
    </div>
    <div class="row font">
      <div class="col-md-8">
        <form action="" method="POST" novalidate="novalidate" autocomplete="off">
          <div class="form-group">
            <label for="title" class="text-white"> * Title : </label>
            <input class="form-control" type="text" name="title" id="title" value="<?=old('title');?>"
              placeholder="Subject">
          </div>
          <div class="form-group text-white">
            <label for="article">* Text : </label>
            <textarea rows="10" name="article" id="article" class="form-control"
              placeholder="Write text here.."></textarea>
          </div>
          <input type="submit" name="submit" value="Post" class="btn btn-block btn-primary btn-lg">
          <?php if($error) : ?>
          <div class="alert alert-danger mt-3" role="alert">
            <?= $error ;?>
          </div>
          <?php endif ;?>
        </form>
      </div>

    </div>
  </div>
</main>



<?php include 'tpl/footer.php';?>