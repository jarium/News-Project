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
  <input class="form-check-input" type="checkbox" name= "science" value="" id="science" <?php if (in_array('science',$user)): ?> checked <?php endif; ?> >
  <label class="form-check-label" for="science">
    Science
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "health" value="" id="health" <?php if (in_array('health',$user)): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="health">
    Health
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "political" value="" id="political" <?php if (in_array('political',$user)): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="political">
    Political
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "technology" value="" id="technology" <?php if (in_array('technology',$user)): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="technology">
    Technology
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "world" value="" id="world" <?php if (in_array('world',$user)): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="world">
    World
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "economy" value="" id="economy" <?php if (in_array('economy',$user)): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="economy">
    Economy
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "sports" value="" id="sports" <?php if (in_array('sports',$user)): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="sports">
    Sports
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "art" value="" id="art" <?php if (in_array('art',$user)): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="art">
    Art
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "education" value="" id="education" <?php if (in_array('education',$user)): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="education">
    Education
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "social" value="" id="social" <?php if (in_array('social',$user)): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="social">
    Social
   </label>
  </div><br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>