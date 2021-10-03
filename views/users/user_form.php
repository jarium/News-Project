<?php if (!empty($errors)): ?>
 <div class = "alert alert-danger">
    <?php foreach ($errors as $error): ?>
      <div><?php echo $error ?> </div>
    <?php endforeach; ?>
  </div>
 <?php endif; ?>

 <form action="" method="post" enctype = "multipart/form-data">
  <div class="form-group">
    <label>First Name</label>
    <input type="text" class="form-control" name="firstname" value= "<?= $user['firstname']?>" placeholder="Your name" required>
  </div>
  <div class="form-group">
    <label>Last Name</label>
    <input type="text" class="form-control" name="lastname" value= "<?= $user['lastname']?>" placeholder="Your surname" required>
  </div>
  <div class="form-group">
    <label>Username</label>
    <input type="text" class="form-control" name="username" value= "<?= $user['username']?>" placeholder="Enter username" required>
  </div>
  <div class="form-group">
    <label>Email Address</label>
    <input type="email" class="form-control" name="email" value= "<?= $user['email']?>" aria-describedby="emailHelp" placeholder="Enter email" required>
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control" name="password" placeholder="Password" required>
  </div>
  <div class="form-group">
  <label>Retype Password</label>
    <input type="password" class="form-control" name="password_confirm" placeholder="Password" required>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>