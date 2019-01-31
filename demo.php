<?php 
$query = "SELECT * FROM comments c 
JOIN posts p ON '".$post['id']."' = c.post_id
JOIN user_profile up ON up.user_id = c.user_id
JOIN users u ON u.id = c.user_id "  ;           
$comments = db_query_all($query);  


?>

<?php if(isset($comments)):?>
<?php foreach($comments as $comment) : ?>
<div class="col-6 bgc4 mt-1 float-right mb-3">
  <div>
    <span class="text-dark font-weight-bold border-bottom ">
      <img class="rounded float-left" src="images/<?= $comment['avatar'];?>" alt="defaultAvatar" width="80">
      <?= $comment['name']?>
    </span>
    <span class="float-right">
      <?= $comment['date']?></span>
  </div>
  <div class="row">
    <?= $comment['comment'] ?>
  </div>
</div>
<?php endforeach;?>
<?php endif;?>