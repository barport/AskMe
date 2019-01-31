<?php

require_once 'app/helpers.php';
start_session('boris');
$title = 'AskMe | Blog';

$sql = "SELECT u.name,p.id,p.user_id,p.title,p.article,up.avatar,DATE_FORMAT(p.date,'%d/%m/%Y %H:%i:%s') pdate FROM posts p 
        JOIN users u ON u.id = p.user_id /*posts to users */
        JOIN user_profile up ON u.id = up.user_id /*profile to users(to posts) */
        ORDER BY p.date DESC";

$posts = db_query_all($sql);
$uid = $_SESSION['user_id'] ?? false ;


?>

<?php include 'tpl/header.php';?>



<main>
  <div class="container">
    <div class="row">
      <div class="col-12 pt-3">
        <div class="text-white col-md-5 m-auto">
          <h1 class="display-2 animated slideInDown border-bottom">
            <i class="fas fa-blog fa-1x"></i> AskMe
          </h1>
        </div>
        <?php if(verify_user()):?>
        <p><a class="btn btn-primary btn-lg" href="add_post.php"><i class="fas fa-plus-circle"></i> Add Post</a></p>
        <?php else : ?>
        <p><a class="btn btn-success" href="signin.php"><i class="fas fa-sign-in-alt"></i> Log In To Post</a></p>
        <?php endif;?>
      </div>
    </div>
    <div class="row ">
      <?php foreach($posts as $post) : ?>
      <div class="col-md-12 mt-3">
        <div class="card ">
          <div class="card-header">
            <span class="h4">
              <img class="rounded-circle" src="images/<?= $post['avatar'];?>" alt="defaultAvatar" width="80">
              <?= $post['name']?>
            </span>
            <span class="float-right">
              <?= $post['pdate']?></span>
          </div>
          <div class="card-body">
            <h4 class="font-weight-bold border-bottom pb-4">
              <?= display_output($post['title']);?>
            </h4>
            <p class="mt-4">
              &nbsp;
              <?= display_output($post['article']);?>
            </p>
            <?php if ($uid == $post['user_id']): ?>
            <p>
              <div class="btn-group float-right">
                <button class=" btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                  aria-expanded="false">
                  <i class="fas fa-ellipsis-h"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item text-dark" href="edit_post.php?pid=<?=$post['id'];?>"><i
                      class="fas fa-pen"></i>
                    Edit</a>
                  <a class="dropdown-item text-dark confirm-ms-link" href="delete_post.php?pid=<?=$post['id'];?>"><i
                      class="fas fa-trash-alt"></i>
                    Delete</a>
                </div>
              </div>
            </p>
            <?php endif;?>
          </div>
        </div>
      </div>
      <?php endforeach;?>
    </div>
  </div>
</main>
<br>
<br>
<br>

<?php include 'tpl/footer.php';?>