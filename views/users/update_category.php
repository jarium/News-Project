<p>
    <a href="/users" class="btn btn-info">Go back to Account</a>
</p>

<?php if ($success): ?>
<div class = "alert alert-success">
  Your categories have been changed
</div>
<?php endif; ?>

<h1> Update Your News Categories </h1>

 <form action="" method="post" enctype = "multipart/form-data">
  <div class="form-group">
  <label>The News Categories You Are Interested In (Optional, you can change this later)</label><hr>
  <div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name= "science" value="" id="flexCheckDefault" <?php if (in_array('science',$user)): ?> checked <?php endif; ?> >
  <label class="form-check-label" for="flexCheckDefault">
    Science
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "health" value="" id="flexCheckDefault" <?php if (in_array('health',$user)): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="flexCheckDefault">
    Health
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "political" value="" id="flexCheckDefault" <?php if (in_array('political',$user)): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="flexCheckDefault">
    Political
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "technology" value="" id="flexCheckDefault" <?php if (in_array('technology',$user)): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="flexCheckDefault">
    Technology
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "world" value="" id="flexCheckDefault" <?php if (in_array('world',$user)): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="flexCheckDefault">
    World
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "economy" value="" id="flexCheckDefault" <?php if (in_array('economy',$user)): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="flexCheckDefault">
    Economy
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "sports" value="" id="flexCheckDefault" <?php if (in_array('sports',$user)): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="flexCheckDefault">
    Sports
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "art" value="" id="flexCheckDefault" <?php if (in_array('art',$user)): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="flexCheckDefault">
    Art
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "education" value="" id="flexCheckDefault" <?php if (in_array('education',$user)): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="flexCheckDefault">
    Education
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "social" value="" id="flexCheckDefault" <?php if (in_array('social',$user)): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="flexCheckDefault">
    Social
   </label>
  </div><br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>