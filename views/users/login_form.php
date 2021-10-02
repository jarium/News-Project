<?php if (!empty($errors)): ?>
 <div class = "alert alert-danger">
    <?php foreach ($errors as $error): ?>
      <div><?php echo $error ?> </div>
    <?php endforeach; ?>
  </div>
 <?php endif; ?>

 <form action="" method="post" enctype = "multipart/form-data">
  <div class="form-group">
    <label>Username</label>
    <input type="text" class="form-control" name="username" value= "<?= $user['username']?>" placeholder="Your username" required >
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control" name="password" placeholder="Your password" required>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>