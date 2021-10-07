<h1>Welcome, <?= $user['firstname']." ".$user['lastname']; ?></h1> <hr> <br> <br>

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