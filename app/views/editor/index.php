<h1>Editor Panel</h1> <hr>

<?php if ($_SESSION['role'] == 'admin'): ?>
<p>
    <a href="/admin" class="btn btn-danger">Go back to Admin Panel</a>
</p> <hr> <br>
<?php elseif ($_SESSION['role'] == 'mod'): ?>
<p>
    <a href="/mod" class="btn btn-danger">Go back to Mod Panel</a>
</p> <hr> <br>   
<?php endif; ?> 

<h2> Create News <a href="editor/createnews"><div class="btn btn-info">Create</div> </a></h2>
<p style="font-size:large;">You can create news with the categories that you are allowed.</p> <hr> <br> <br>

<h2> Search My News <a href="editor/mynews"><div class="btn btn-info">Search</div> </a></h2>
<p style="font-size:large;">You can review and get info from the news you created.</p> <hr> <br> <br>

<h2> Update My News <a href="editor/updatenews"><div class="btn btn-info">Update</div> </a></h2>
<p style="font-size:large;">You can update your news for the first 24 hours after you create them.</p> <hr> <br> <br>