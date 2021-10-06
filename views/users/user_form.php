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
  <div class="form-group">
  <label>The News Categories You Are Interested In (Optional)</label><hr>
  <div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name= "science" value="" id="flexCheckDefault" <?php if (in_array('science',$user['categories'])): ?> checked <?php endif; ?> >
  <label class="form-check-label" for="flexCheckDefault">
    Science
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "health" value="" id="flexCheckDefault" <?php if (in_array('health',$user['categories'])): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="flexCheckDefault">
    Health
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "political" value="" id="flexCheckDefault" <?php if (in_array('political',$user['categories'])): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="flexCheckDefault">
    Political
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "technology" value="" id="flexCheckDefault" <?php if (in_array('technology',$user['categories'])): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="flexCheckDefault">
    Technology
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "world" value="" id="flexCheckDefault" <?php if (in_array('world',$user['categories'])): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="flexCheckDefault">
    World
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "economy" value="" id="flexCheckDefault" <?php if (in_array('economy',$user['categories'])): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="flexCheckDefault">
    Economy
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "sports" value="" id="flexCheckDefault" <?php if (in_array('sports',$user['categories'])): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="flexCheckDefault">
    Sports
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "art" value="" id="flexCheckDefault" <?php if (in_array('art',$user['categories'])): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="flexCheckDefault">
    Art
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "education" value="" id="flexCheckDefault" <?php if (in_array('education',$user['categories'])): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="flexCheckDefault">
    Education
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "social" value="" id="flexCheckDefault" <?php if (in_array('social',$user['categories'])): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="flexCheckDefault">
    Social
   </label>
  </div>
</div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>