<p>
    <a href="/mod" class="btn btn-info">Go back to Mod Panel</a>
</p>

<p>
    <a href="/mod/showusers" class="btn btn-info">Go back to Search Users/Editors</a>
</p>

<h1> Update Editor's Categories</h1> <br>

<form>
     <div class="input-group mb-3">
         <input type="text" class="form-control"
                placeholder="Enter Editor Id"
                name="_id" value="<?= $id ?>">
         <div class="input-group-append">
             <button class="btn btn-outline-secondary" type="submit">Search</button>
         </div>
     </div>
 </form>

<?php if ($editor): ?>

<?php if($success): ?>
  <div class="alert alert-success">Editor's Categories Updated</div>
<?php endif; ?>

<h3> Editor: <?= $editor['username'] ?></h3> <hr>

 <form action="" method="post" enctype = "multipart/form-data">
  <div class="form-group">
  <div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name= "science" value="" id="flexCheckDefault" <?php if (in_array('science',$categories)): ?> checked <?php endif; ?> >
  <label class="form-check-label" for="flexCheckDefault">
    Science
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "health" value="" id="flexCheckDefault" <?php if (in_array('health',$categories)): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="flexCheckDefault">
    Health
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "political" value="" id="flexCheckDefault" <?php if (in_array('political',$categories)): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="flexCheckDefault">
    Political
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "technology" value="" id="flexCheckDefault" <?php if (in_array('technology',$categories)): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="flexCheckDefault">
    Technology
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "world" value="" id="flexCheckDefault" <?php if (in_array('world',$categories)): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="flexCheckDefault">
    World
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "economy" value="" id="flexCheckDefault" <?php if (in_array('economy',$categories)): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="flexCheckDefault">
    Economy
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "sports" value="" id="flexCheckDefault" <?php if (in_array('sports',$categories)): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="flexCheckDefault">
    Sports
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "art" value="" id="flexCheckDefault" <?php if (in_array('art',$categories)): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="flexCheckDefault">
    Art
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "education" value="" id="flexCheckDefault" <?php if (in_array('education',$categories)): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="flexCheckDefault">
    Education
   </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name= "social" value="" id="flexCheckDefault" <?php if (in_array('social',$categories)): ?> checked <?php endif; ?>>
  <label class="form-check-label" for="flexCheckDefault">
    Social
   </label>
  </div><br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php elseif (!$warning): ?>
  <div style="font-size:large"class="alert alert-warning">No Editors Found Matching The Id, You can check the Id of Users/Editors <a href ="/mod/showusers">Here </a></div>
<?php endif; ?>
</body>
</html>