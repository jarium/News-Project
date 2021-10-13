<p>
    <a href="/editor" class="btn btn-info">Go back to Editor Panel</a>
</p>

<p>
    <a href="/editor/mynews" class="btn btn-info">Go back to My News</a>
</p>

<h1> Update My News </h1> <br>
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
<?php if ($success): ?>
  <div class="alert alert-success">Successfully Updated News</div>
<?php endif; ?>

<?php if ($news): ?>
    <?php if (!$timeout): ?>
    <div class="alert alert-warning">Reminder: You can only update your news for the first 24 hours after you create them</div>
    <?php else: ?>
        <div class="alert alert-danger">Reminder: More than 24 hours past since this news created, you cannot update it. </div>
    <?php endif ?>

    <h4>News Id: <?= $news['_id'] ?></h4>
    <h4>Create Date: <?= $news['create_date'] ?></h4>
    <h5>You can update News with the catogires of: <?php foreach ($categories as $category): echo $category." "; endforeach;?></h3>
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
</form>

<?php elseif ($warning): ?>
  <div style="font-size:large"class="alert alert-warning">Enter a News Id of yours above. You Can Check the Id of your News <a href ="/editor/mynews">Here </a></div>
<?php elseif (!$warning): ?>
  <div style="font-size:large"class="alert alert-warning">No News Found Matching The Id, You Can Check the Id of Your News <a href ="/editor/mynews">Here </a></div>
<?php endif; ?>
</body>
</html>