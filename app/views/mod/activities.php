<p>
    <a href="/mod" class="btn btn-info">Go back to Mod Panel</a>
</p>

<h1> Watch Activities of Users/Editors</h1> <br>
<form>
     <div class="input-group mb-3">
         <input type="text" class="form-control"
                placeholder="Enter Date (Example: 2021-10-24)"
                name="date" value="<?= $date ?>">
         <div class="input-group-append">
             <button class="btn btn-outline-secondary" type="submit">Search</button>
         </div>
     </div>
 </form>
<?php if ($date == $dateNow): ?>
<h3>Showing Today's Activities, You can enter a date above to see the past ones, if there are any. Example: 2021-10-24 </h3> <hr>
<?php endif; ?>

<?php if ($log): ?>
<pre>
<?= htmlspecialchars($log) ?>
</pre>
<?php else: ?>
<div style="font-size:large;" class="alert alert-warning">No activities found for the date you specified</div>
<?php endif; ?>