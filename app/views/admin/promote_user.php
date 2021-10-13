<p>
    <a href="/admin" class="btn btn-info">Go back to Admin Panel</a>
</p>

<p>
    <a href="/admin/users" class="btn btn-info">Go back to Search Users</a>
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
<h3> User: <?= $user['username'] ?></h3><hr>

    <?php if ($user['role'] == 'user'): ?>
    <form method="post">
    <h3> Role: User <br></h3>
    <button style="margin-top:15px;" type="submit" name="editor" class="btn btn-info" onclick="return confirm('Promote <?= $user['username'] ?> to Editor?');">Promote to Editor</button> <br>
    <button style="margin-top:15px;" type="submit" name="mod" class="btn btn-warning" onclick="return confirm('Promote <?= $user['username'] ?> to Mod?');">Promote to Mod</button></h3> <br>
    <button style="margin-top:15px;" type="submit" name="admin" class="btn btn-danger" onclick="return confirm('Promote <?= $user['username'] ?> to Admin?');">Promote to Admin</button></h3> <br>
    </form>
    <?php elseif ($user['role'] == 'editor'): ?>
    <form method="post">
    <h3> Role: Editor <br></h3>
    <button style="margin-top:15px;" type="submit" name="user" class="btn btn-info" onclick="return confirm('Demote <?= $user['username'] ?> to User?');">Demote to User</button> <br>
    <button style="margin-top:15px;" type="submit" name="mod" class="btn btn-warning" onclick="return confirm('Promote <?= $user['username'] ?> to Mod?');">Promote to Mod</button></h3> <br>
    <button style="margin-top:15px;" type="submit" name="admin" class="btn btn-danger" onclick="return confirm('Promote <?= $user['username'] ?> to Admin?');">Promote to Admin</button></h3> <br>
    </form>
    <?php elseif ($user['role'] == 'mod'): ?>
    <form method="post">
    <h3> Role: Mod <br></h3>
    <button style="margin-top:15px;" type="submit" name="user" class="btn btn-info" onclick="return confirm('Demote <?= $user['username'] ?> to User?');">Demote to User</button> <br>
    <button style="margin-top:15px;" type="submit" name="editor" class="btn btn-warning" onclick="return confirm('Demote <?= $user['username'] ?> to Editor?');">Demote to Editor</button></h3> <br>
    <button style="margin-top:15px;" type="submit" name="admin" class="btn btn-danger" onclick="return confirm('Promote <?= $user['username'] ?> to Admin?');">Promote to Admin</button></h3> <br>
    </form>
    <?php elseif ($user['role'] == 'admin'): ?>
    <h3> Role: Admin <br></h3>
    <div class="alert alert-danger">You cannot promote or demote an Admin</div>
    <?php endif; ?>

<?php elseif ($warning): ?>
  <div style="font-size:large"class="alert alert-warning">Enter a User Id above. You Can Check the Id of Users <a href ="/admin/users">Here </a></div>
<?php elseif (!$warning): ?>
  <div style="font-size:large"class="alert alert-warning">No Users Found Matching The Id, You Can Check the Id of Users <a href ="/admin/users">Here </a></div>
<?php endif; ?>
</body>
</html>