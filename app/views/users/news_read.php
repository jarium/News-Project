<p>
    <a href="/users" class="btn btn-info">Go back to Account</a>
</p>

<?php if ($warning): ?>
 <div style= "font-size:large;"class = "alert alert-warning">
   You haven't read any news yet.
 </div>
<?php else: ?>
    <h2><a href = "/users/newsread" >Your Read News (<?=$newsCount;?>) </a></h2> <hr>
    <form>
     <div class="input-group mb-3">
         <input type="text" class="form-control"
                placeholder="Search from read news with News Title"
                name="search" value="<?= $search ?>">
         <div class="input-group-append">
             <button class="btn btn-outline-secondary" type="submit">Search</button>
         </div>
     </div>
 </form>

 <table class="table">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Read Date</th>
    </tr>
    <tbody>
  <?php if ($news): ?>
    <?php foreach ($news as $i=>$new): ?>
       <tr>
           <th scope="row"><?php echo $i + 1 ?> </th>
           <td><strong><a href="/news/spesific?_id=<?= $new['_id'];?>"><?= $new['title'];?></a></strong></td>
           <td><?= $new['read_date']?></td>
       </tr>
    </tbody>
    <?php endforeach;?>
 </table>
 <?php else: ?><p>No read news found according to your criteria</p>
    <?php endif ?>
<?php endif; ?>