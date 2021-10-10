<p>
    <a href="/mod" class="btn btn-info">Go back to Mod Panel</a>
</p>

<h1> Promote/Demote</h1> <br>
<form>
     <div class="input-group mb-3">
         <input type="text" class="form-control"
                placeholder="Enter Editor/User Id"
                name="_id" value="<?= $id ?>">
         <div class="input-group-append">
             <button class="btn btn-outline-secondary" type="submit">Search</button>
         </div>
     </div>
 </form>

<?php if ($user): ?>
<h3> User: <?= $user['username'] ?></h3> <hr>

    <?php if ($user['role'] == 'user'): ?>
    <form method="post">
    <h3> Role: User  <button type="submit" name="editor" class="btn btn-info" onclick="return confirm('Promote <?= $user['username'] ?> to Editor?');">Promote</button></h3>
    </form>
    <?php elseif ($user['role'] == 'editor'): ?>
    <form method="post">
    <h3> Role: Editor  <button type="submit" name="user" class="btn btn-danger" onclick="return confirm('Demote <?= $user['username'] ?> to User?');">Demote</button></h3> <br>
    </form>
    <h3> Categories <a href="/mod/editorcategory?_id=<?= $user['_id']; ?>"><button class="btn btn-primary">Update</button></a> </h3>
    <?php endif; ?>

<?php elseif (!$warning): ?>
  <div style="font-size:large"class="alert alert-warning">No Users/Editors Found Matching The Id, You Can Check the Id of Users/Editors <a href ="/mod/showusers">Here </a></div>
<?php endif; ?>
</body>
</html>