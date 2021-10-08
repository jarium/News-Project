<?php if($user['role'] == 'admin'):?>
    <h1>Welcome Admin, <?= $user['firstname']." ".$user['lastname']; ?></h1> <hr> <br> <br>
    <h2> Admin Panel <a href="admin"><div class="btn btn-danger">Panel</div> </a></h2> <hr> <br> <br>

<?php elseif($user['role'] == 'mod'): ?>
    <h1>Welcome Mod,<?= $user['firstname']." ".$user['lastname']; ?></h1> <hr> <br> <br>
    <h2> Mod Panel <a href="mod"><div class="btn btn-danger">Panel</div> </a></h2> <hr> <br> <br>
<?php elseif($user['role'] == 'editor'): ?>
    <h1>Welcome Editor, <?= $user['firstname']." ".$user['lastname']; ?></h1> <hr> <br> <br>
    <h2> Admin Panel <a href="editor"><div class="btn btn-danger">Panel</div> </a></h2> <hr> <br> <br>
<?php else: ?>
    <h1>Welcome, <?= $user['firstname']." ".$user['lastname']; ?></h1> <hr> <br> <br>
<?php endif; ?>

<h2> Comments <a href="users/comments"><div class="btn btn-info">Check</div> </a></h2>
<p style="font-size:large;">You can view your comments on news and see their create date.</p> <hr> <br> <br>

<h2> News Categories <a href="users/category"><div class="btn btn-info">Update</div> </a></h2>
<p style="font-size:large;">You can check and update your news categories choice, which is used to create a special news feed for you.</p> <hr> <br> <br>


<h2> Your Read News <a href="users/newsread"><div class="btn btn-info">Check</div> </a></h2>
<p style="font-size:large;">You can check the news you read.</p> <hr> <br> <br>

<form method="post">
<h2> Delete Account  <button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</button></h2>
<p style="font-size:large;">You can delete your account and all of the comments written by you.</p> <hr>
</form>