<p>
    <a href="/admin" class="btn btn-info">Go back to Admin Panel</a>
</p>

<h1> Users List (<?= $count ?>) </h1>

 <form>
     <div class="input-group mb-3">
         <input type="text" class="form-control"
                placeholder="Search for Users with Username"
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
        <th scope="col">Username</th>
        <th scope="col">Role</th>
        <th scope="col">Register Date</th>
        <th scope="col">Action</th>
    </tr>
    <tbody>

    <?php if ($users): 
        foreach ($users as $i => $user): ?>
       <tr>
           <th scope="row"><?php echo $i + 1 ?> </th>
           <td><?php echo $user['_id'] ?></td>
           <td><?php echo $user['username'] ?></td>
           <td><?php echo $user['role'] ?></td>
           <td><?php echo $user['create_date'] ?></td>
           <td>
               <a href="/admin/promote?_id=<?php echo $user['_id'] ?>" button type="button" class="btn btn-primary">Promote/Demote</a>
           </td>
        
        </tr>
    <?php endforeach; 
    else: ?> <p>No users found according to your criteria</p>
    <?php endif;?>
    </tbody>
 </table>