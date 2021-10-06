<?php if (!empty($errors)): ?>
    <div class = "alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <div><?php echo $error ?> </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form action="" method="post" enctype = "multipart/form-data">

    <?php if ($news['image']): ?>
        <img src="../<?php echo $news['image']?>" class="update-image">
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
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
