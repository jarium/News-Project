<p>
    <a href="/mod" class="btn btn-info">Go back to Mod Panel</a>
</p>

<h1> <a href="/mod/news"> News List (<?= $count ?? 0 ?>) </a></h1>

 <form>
     <div class="input-group mb-3">
         <input type="text" class="form-control"
                placeholder="Search for News with Title, Author Username or Category"
                name="search" value="<?= $search ?>">
         <div class="input-group-append">
             <button class="btn btn-outline-secondary" type="submit">Search</button>
         </div>
     </div>
 </form>

 <table class="table">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Id</th>
        <th scope="col">Title</th>
        <th scope="col">Category</th>
        <th scope="col">Create Date</th>
        <th scope="col">Update Date</th>
        <th scope="col">Author</th>
        <th scope="col">Author Id</th>
        <th scope="col">Deleted?</th>
        <th scope="col">Delete Date</th>
        <th scope="col">Action</th>
    </tr>
    <tbody>

    <?php if ($news): foreach ($news as $i => $new): ?>
       <tr>
           <th scope="row"><?= $i + 1 ?> </th>
           <td><?= $new['_id'] ?></td>
           <td><a href="/news/spesific?_id=<?= $new['_id'];?>"><?= $new['title'] ?></a></td>
           <td><?= $new['category'] ?></td>
           <td><?= $new['create_date'] ?></td>
           <td><?= $new['update_date'] ?></td>
           <td><?= $new['author_username'] ?></td>
           <td><?= $new['author_id'] ?></td>
           <td><?= $new['isDeleted'] ? "Yes" : "No";?></td>
           <td><?= $new['delete_date'] ?></td>
           <td>
               <a href="/mod/editnews?_id=<?php echo $new['_id'] ?>" button type="button" class="btn btn-primary">Update/Delete</a>
           </td>
       </tr>
    <?php endforeach; 
    else: ?> <p>No news found according to your criteria</p>
    <?php endif;?>
    </tbody>
 </table>