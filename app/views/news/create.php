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
<?php if ($success): ?>
    <div class="alert alert-success">
        Successfully Added News
    </div>
<?php endif; ?>
<?php if ($_SESSION['role'] == 'editor'):?>
<h3>You can create News with the catogires of: <?php foreach ($categories as $category): echo $category." "; endforeach;?></h3>
<?php endif; ?> 
<?php include_once "news_form.php" ?>