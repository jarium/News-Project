<p>
    <a href="/news" class="btn btn-info">Go back to News</a>
</p>
<img src="../<?= $news['image'];?>" alt="">
<h1> <?= $news['title']; ?> </h1>
 <p>
     <?= $news['content']; ?>
 </p>

 <p> Author: <?= $news['author_username']?></p>
 <p> Category: <?= $news['category']?></p>
 <p> Created: <?= $news['create_date']?></p>

<!--Comments Section Start-->
<h2 style="margin-top: 25px;">Comments</h2> <hr>
<?php
if ($comments): 
    foreach ($comments as $i => $comment): ?>
    <h4> 
        <?php if ($comment['isAnon']): echo 'Anonymous';
        else: echo $comment['commenter_username']; endif; ?>
        </h4> 
        <p><?= $comment['comment'] ?></p>
        <p><?= $comment['create_date'] ?></p>
        <?php endforeach; endif; 

if (!$comments): ?> 
    <p> No comments </p>     
    <?php endif;?>
<!--Comments Section End-->

<!--Add Comment Section Start-->
<h2 style="margin-top: 20px;">New Comment</h2>
<form action="" method="post" enctype = "multipart/form-data">
  <div class="form-group">
    <input type="text" class="form-control" name="comment" value= "<?= $add_comments['comment']?>" placeholder="Your comment" required>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "isAnon" value="" id="flexCheckDefault">
  <label class="form-check-label" for="flexCheckDefault">
    Anonymous
   </label>
  </div><br>
  <button type="submit" class="btn btn-info">Submit</button>
  </form>

<!--Add Comment Section End-->

