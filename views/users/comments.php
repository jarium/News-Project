<p>
    <a href="/users" class="btn btn-info">Go back to Account</a>
</p>

<h2><a href = "/users/comments" >Your Comments (<?=$comments_count;?>) </a></h2> <hr>
<?php if ($warning): ?>
 <div style= "font-size:large;"class = "alert alert-warning">
   You don't have any comments yet.
 </div>
<?php else: ?>
    <form>
     <div class="input-group mb-3">
         <input type="text" class="form-control"
                placeholder="Search for comments"
                name="search" value="">
         <div class="input-group-append">
             <button class="btn btn-outline-secondary" type="submit">Search</button>
         </div>
     </div>
 </form>

 <table class="table">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Commented News</th>
        <th scope="col">Anonymous?</th>
        <th scope="col">Create Date</th>
        <th scope="col">Comment</th>
    </tr>
    <tbody>
    <?php if ($comments): ?>
    <?php foreach ($comments as $i=>$comment): ?>
       <tr>
           <th scope="row"><?php echo $i + 1 ?> </th>
           <td><strong><a href="/news/spesific?_id=<?= $comment['news_id'];?>"><?= $comment['title'];?></a></strong></td>
           <td><?= $comment['isAnon'] ? "Yes" : "No";?></td>
           <td><?= $comment['create_date'];?></td>
           <td><?= $comment['comment'];?></td>
       </tr>
    </tbody>
    <?php endforeach;?>
    <?php else: ?>
        <p>No comments found according to your criteria</p>
        <?php endif; ?>
 </table>
<?php endif; ?>