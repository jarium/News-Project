<h1>Mod Panel</h1> <hr>

<?php if ($_SESSION['role'] == 'admin'): ?>
<p>
    <a href="/admin" class="btn btn-danger">Go back to Admin Panel</a>
</p> <hr> <br>
<?php endif; ?> 

<h2> Search Users/Editors <a href="mod/showusers"><div class="btn btn-info">Show</div> </a></h2>
<p style="font-size:large;">You can search users for informations like user id, or to promote/demote.</p> <hr> <br> <br>

<h2> Promote/Demote <a href="mod/promote"><div class="btn btn-info">Promote</div> </a></h2>
<p style="font-size:large;">You can promote users to editors or demote editors to users.</p> <hr> <br> <br>

<h2> Update Editor Categories <a href="mod/editorcategory"><div class="btn btn-info">Update</div> </a></h2>
<p style="font-size:large;">You can check and update editor's news categories which they are responsible of.</p> <hr> <br> <br>

<h2> Deleted Users <a href="mod/deletedusers"><div class="btn btn-info">Check</div> </a></h2>
<p style="font-size:large;">You can check users that deleted their account.</p> <hr> <br> <br>

<h2> Watch Activities <a href="mod/activities"><div class="btn btn-info">Check</div> </a></h2>
<p style="font-size:large;">You can watch activities of users and editors.</p> <hr> <br> <br>

<h2> Search/Manage Comments <a href="mod/comments"><div class="btn btn-info">Check</div> </a></h2>
<p style="font-size:large;">You can review comments info to delete/update comments.</p> <hr> <br> <br>

<h2> Update/Delete Comments <a href="mod/editcomment"><div class="btn btn-info">Update</div> </a></h2>
<p style="font-size:large;">You can update/delete/restore comments.</p> <hr> <br> <br>

<h2> Search/Manage News <a href="/mod/news"><div class="btn btn-info">Check</div> </a></h2>
<p style="font-size:large;">You can review news info to delete/update news.</p> <hr> <br> <br>

<h2> Update/Delete News <a href="/mod/editnews"><div class="btn btn-info">Check</div> </a></h2>
<p style="font-size:large;">You can update/delete/restore news.</p> <hr> <br> <br>

<h2> Create News <a href="/mod/createnews"><div class="btn btn-info">Create</div> </a></h2>
<p style="font-size:large;">You can create news from any category.</p> <hr> <br> <br>

<h2> More... <a href="/editor"><div class="btn btn-danger">Editor Panel</div> </a></h2>
<p style="font-size:large;">You can check Editor Panel for more.</p> <hr> <br> <br>