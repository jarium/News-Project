<p>
    <a href="/mod" class="btn btn-info">Go back to Mod Panel</a>
</p>

<h1> Update/Delete Comments </h1> <br>
<form>
     <div class="input-group mb-3">
         <input type="text" class="form-control"
                placeholder="Enter Comment Id"
                name="_id" value="<?= $id ?>">
         <div class="input-group-append">
             <button class="btn btn-outline-secondary" type="submit">Search</button>
         </div>
     </div>
 </form>

<?php if ($comment): ?>
<h3> News Title:<a href="/news/spesific?_id=<?= $comment['news_id']; ?>" ><?= $comment['title'] ?></a></h3>
<h3> Commenter: <?= $comment['commenter_username'] ?></h3>
<h3> Commenter Id: <?= $comment['commenter_id'] ?></h3> <hr> <br>
<h3> Comment <?php if ($comment['isDeleted']): echo "(Deleted)"; endif; ?> </h3><hr> 
<p style="font-size:large;"> <?=$comment['comment'] ?></p><hr>

<?php if (!empty($errors)): ?>
    <div class = "alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <div><?php echo $error ?> </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<h3> Update Comment </h3> <br>
<form action="" method="post" enctype = "multipart/form-data">
  <div class="form-group">
    <input type="text" class="form-control" name="comment" value= "<?= $comment['comment']?>" placeholder="Your comment" required>
  </div>
  <button type="submit" class="btn btn-primary">Update</button>
  <?php if ($comment['isDeleted']): ?>
    <button style="margin-left: 7px;" type="submit" onclick="return confirm('Are you sure?');" name= "restore" class="btn btn-info">Restore</button>
  <?php elseif (!$comment['isDeleted']): ?> 
  <button style="margin-left: 7px;" type="submit" onclick="return confirm('Are you sure?');" name= "delete" class="btn btn-danger">Delete</button>
  <?php endif; ?>
  </form>

<?php elseif (!$warning): ?>
  <div style="font-size:large"class="alert alert-warning">No Comments Found Matching The Id, You Can Check the Id of Comments <a href ="/mod/comments">Here </a></div>
<?php endif; ?>
</body>
</html>