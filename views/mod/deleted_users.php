<p>
    <a href="/mod" class="btn btn-info">Go back to Mod Panel</a>
</p>

<h1> Deleted Users/Editors List </h1>

 <form>
     <div class="input-group mb-3">
         <input type="text" class="form-control"
                placeholder="Search for Deleted Users with Username"
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
        <th scope="col">Delete Date</th>
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
           <td><?php echo $user['delete_date'] ?></td>
        </tr>
    <?php endforeach; 
    else: ?> <p>No users found according to your criteria</p>
    <?php endif;?>
    </tbody>
 </table>