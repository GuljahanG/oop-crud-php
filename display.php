<?php    
    include 'database.php';
    $display = new Database;
    $allUsers = $display->read('users');
?>
<?php include 'layout.php' ?>
    <div class="container mt-5">
        <a class="btn btn-primary" href="user.php">Add user</a>
        <table class="table table-striped mt-5">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($allUsers) > 0):
                    foreach($allUsers as $key => $user): ?>
                    <tr>
                        <th scope="row"><?= $key+1 ?></th>
                        <td><?= $user['name'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td>
                            <span>
                                <a class="btn btn-primary" href="./update.php?id=<?= $user['id'] ?>">Edit</a> 
                                <a class="btn btn-danger" href="./delete.php?id=<?= $user['id'] ?>" class="del">Delete</a>
                            </span>
                        </td>
                    </tr>
                <?php
                    endforeach;
                else: ?>
                <?php endif; ?> 
            </tbody>
        </table>
    </div>
<?php include 'footer.php' ?>   
    