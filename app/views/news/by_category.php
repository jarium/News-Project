<h1> <?= $viewTitle ?> News </h1>

 <form>
     <div class="input-group mb-3">
         <input type="text" class="form-control"
                placeholder="Search for <?= $viewTitle ?> News"
                name="search" value="<?= $search ?>">
         <div class="input-group-append">
             <button class="btn btn-outline-secondary" type="submit">Search</button>
         </div>
     </div>
 </form>

 <table class="table">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Image</th>
        <th scope="col">Title</th>
        <th scope="col">Category</th>
        <th scope="col">Create Date</th>
        <th scope="col">Action</th>
    </tr>
    <tbody>

    <?php if ($news): foreach ($news as $i => $new): ?>
       <tr>
           <th scope="row"><?php echo $i + 1 ?> </th>
           <td>
                <img src="../<?= $new['image'];?>" class="thumb-img">
           </td>
           <td><?php echo $new['title'] ?></td>
           <td><?php echo $new['category'] ?></td>
           <td><?php echo $new['create_date'] ?></td>
           <td>
               <a href="/news/spesific?_id=<?php echo $new['_id'] ?>" button type="button" class="btn btn-primary">Show</a>
           </td>
       </tr>
    <?php endforeach; 
    else: ?> <p>No news found according to your criteria</p>
    <?php endif;?>
    </tbody>
 </table>