<h1> News List </h1>

 <form>
     <div class="input-group mb-3">
         <input type="text" class="form-control"
                placeholder="Search for news"
                name="search" value="">
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
        <th scope="col">Content</th>
        <th scope="col">Create Date</th>
    </tr>
    <tbody>

    <?php if ($news): foreach ($news as $i => $new): ?>
       <tr>
           <th scope="row"><?php echo $i + 1 ?> </th>
           <td>
               <?php if ($new['image']): ?>
                 <img src="../<?php echo $new['image'] ?>" class="thumb-image">
                 <?php endif ?>
           </td>
           <td><?php echo $new['title'] ?></td>
           <td><?php echo $new['content'] ?></td>
           <td><?php echo $new['create_date'] ?></td>
           <td>
               <a href="/news?_id=<?php echo $new['_id'] ?>" button type="button" class="btn btn-primary">Show</a>
               <form style="display: inline-block" method="post" action="/news/delete">
                   <input type="hidden" name="_id" value="<?php echo $new['_id'] ?>">
                   <button type="submit" class="btn btn-danger">Delete</button>
               </form>
           </td>
       </tr>
    <?php endforeach; endif;?>
    </tbody>
 </table>

 <?php var_dump($_SESSION);