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

    <div class="form-group">
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
      <select id="inputState" name="category" value="<?= $news['category']?>" class="form-control">
        <option selected>Category...</option>
        <option>Science</option>
        <option>Technology</option>
        <option>Health</option>
        <option>Political</option>
        <option>World</option>
        <option>Economy</option>
        <option>Sports</option>
        <option>Art</option>
        <option>Education</option>
        <option>Social</option>

      </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
