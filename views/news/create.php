<?php if ($_SESSION['role'] == 'editor'):?>
<p>
    <a href="/editor" class="btn btn-info">Go back to Editor Panel</a>
</p>
<?php elseif ($_SESSION['role'] == 'mod'):?>
 <p>
    <a href="/mod" class="btn btn-info">Go back to Mod Panel</a>
</p>
<?php elseif ($_SESSION['role'] == 'admin'):?>
 <p>
    <a href="/admin" class="btn btn-info">Go back to Admin Panel</a>
</p>
<?php endif; ?>      
<h1> Create News </h1>
<?php include_once "news_form.php" ?>