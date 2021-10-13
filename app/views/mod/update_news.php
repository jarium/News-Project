<p>
    <a href="/mod" class="btn btn-info">Go back to Mod Panel</a>
</p>

<p>
    <a href="/mod/news" class="btn btn-info">Go back to Search News</a>
</p>

<h1> Update/Delete News </h1> <br>
<form>
     <div class="input-group mb-3">
         <input type="text" class="form-control"
                placeholder="Enter News Id"
                name="_id" value="<?= $id ?>">
         <div class="input-group-append">
             <button class="btn btn-outline-secondary" type="submit">Search</button>
         </div>
     </div>
 </form>

<?php if ($news): ?>
    <h3>News Id: <?= $news['_id']?> <?php if ($news['isDeleted']):?> (Deleted) <?php endif; ?></h3>
    <h3>Author: <?= $news['author_username']?></h3>

    <?php if (!empty($errors)): ?>
    <div class = "alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <div><?php echo $error ?> </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form action="" method="post" enctype = "multipart/form-data">

    <?php if ($news['image']): ?>
        <img src="../<?php echo $news['image']?>" class="img">
    <?php endif; ?>

    <div style= "margin-top:10px;" class="form-group">
        <label>News Image</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label>News Title</label>
        <input type="text" name="title" class="form-control" value="<?php echo $news['title'] ?>">
    </div>
    <div class="form-group">
        <label">News Content</label>
        <textarea class="form-control" name="content"><?php echo $news['content'] ?></textarea>
    </div>
    <div class="form-group">
      <label for="inputState">News Category</label>
      <select id="inputState" name="category" class="form-control">
        <option <?php if (!$news['category']):?>selected <?php endif ?>>Category...</option>
        <option <?php if ($news['category'] == 'Science'):?>selected <?php endif ?>>Science</option>
        <option <?php if ($news['category'] == 'Technology'):?>selected <?php endif ?>>Technology</option>
        <option <?php if ($news['category'] == 'Health'):?>selected <?php endif ?>>Health</option>
        <option <?php if ($news['category'] == 'Political'):?>selected <?php endif ?>>Political</option>
        <option <?php if ($news['category'] == 'World'):?>selected <?php endif ?>>World</option>
        <option <?php if ($news['category'] == 'Economy'):?>selected <?php endif ?>>Economy</option>
        <option <?php if ($news['category'] == 'Sports'):?>selected <?php endif ?>>Sports</option>
        <option <?php if ($news['category'] == 'Art'):?>selected <?php endif ?>>Art</option>
        <option <?php if ($news['category'] == 'Education'):?>selected <?php endif ?>>Education</option>
        <option <?php if ($news['category'] == 'Social'):?>selected <?php endif ?>>Social</option>

      </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
  <?php if ($news['isDeleted']): ?>
    <button style="margin-left: 7px;" type="submit" onclick="return confirm('Are you sure?');" name= "restore" class="btn btn-info">Restore</button>
  <?php elseif (!$news['isDeleted']): ?> 
    <button style="margin-left: 7px;" type="submit" onclick="return confirm('Are you sure?');" name= "delete" class="btn btn-danger">Delete</button>
  <?php endif; ?>
</form>

<?php elseif ($warning): ?>
  <div style="font-size:large"class="alert alert-warning">Enter a News Id above. You Can Check the Id of News <a href ="/mod/news">Here </a></div>
<?php elseif (!$warning): ?>
  <div style="font-size:large"class="alert alert-warning">No News Found Matching The Id, You Can Check the Id of News <a href ="/mod/news">Here </a></div>
<?php endif; ?>
</body>
</html>