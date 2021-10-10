<p>
    <a href="/mod" class="btn btn-info">Go back to Mod Panel</a>
</p>

<h2><a href = "/users/comments" >Total Comments (<?=$comments_count;?>) </a></h2> <hr>

    <form>
     <div class="input-group mb-3">
         <input type="text" class="form-control"
                placeholder="Search for comments by Commenter Username or Comment or News Title"
                name="search" value="<?= $search ?>">
         <div class="input-group-append">
             <button class="btn btn-outline-secondary" type="submit">Search</button>
         </div>
     </div>
 </form>

 <table class="table">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Comment Id</th>
        <th scope="col">Commented News</th>
        <th scope="col">Anonymous?</th>
        <th scope="col">Commenter Id</th>
        <th scope="col">Commenter</th>
        <th scope="col">Comment Date</th>
        <th scope="col">Deleted?</th>
        <th scope="col">Delete Date</th>
        <th scope="col">Comment</th>
        <th scope="col">Action</th>
    </tr>
    <tbody>
    <?php if ($comments): ?>
        <?php foreach ($comments as $i=>$comment): ?>
            <tr>
            <th scope="row"><?php echo $i + 1 ?> </th>
            <td><?= $comment['_id'];?></td>
            <td><strong><a href="/news/spesific?_id=<?= $comment['news_id'];?>"><?= $comment['title'];?></a></strong></td>
            <td><?= $comment['isAnon'] ? "Yes" : "No";?></td>
            <td><?= $comment['commenter_id'];?></td>
            <td><?= $comment['commenter_username'];?></td>
            <td><?= $comment['create_date'];?></td>
            <td><?= $comment['isDeleted'] ? "Yes" : "No";?></td>
            <td><?= $comment['delete_date'];?></td>
            <td><?php $com =($comment['comment']); $len = strlen($com); if ($len < 40): echo $comment['comment']; else: echo mb_substr($com,0,40).("...")?><a href="">more</a><?php endif;?></td>
            <td>
               <a href="/mod/editcomment?_id=<?php echo $comment['_id'] ?>" button type="button" class="btn btn-primary">View</a>
           </td>
            </tr>
    </tbody>
    <?php endforeach;?>
    <?php else: ?>
        <p>No comments found according to your criteria</p>
        <?php endif; ?>
 </table>