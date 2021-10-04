<h1>Welcome, <?= $user['firstname']." ".$user['lastname']; ?></h1> <hr> <br>

<h2><a href = "/users" >Your Comments (<?=$comments_count;?>) </a></h2> <hr>

<?php if ($comments): ?>
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

    <?php foreach ($comments as $i=>$comment): ?>
       <tr>
           <th scope="row"><?php echo $i + 1 ?> </th>
           <td><strong><a href="/news/spesific?_id=<?= $comment['news_id'];?>"><?= $comment['newsTitle'];?></a></strong></td>
           <td><?= $comment['isAnon'] ? "Yes" : "No";?></td>
           <td><?= $comment['create_date'];?></td>
           <td><?= $comment['comment'];?></td>
       </tr>
    </tbody>
    <?php endforeach;?>
 </table>

<?php else: ?><p>You haven't commented on any news yet</p>
    <?php endif;?>
<?php






//<a href="/news/spesific?_id=<?php echo $comment['news_id'] " button type="button" class="btn btn-primary">Show</a>