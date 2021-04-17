<?php
$session = session(); 
echo view('partials/header', array('is_logged_in' => $session->get('is_logged_in'))) ?>

    <div class="row mt-4">
        <div class="col">
<?php       if ($session->has('success'))
            {   ?>
                <p class="text-center"><?= $session->get('success') ?></p>
<?php       }   ?>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col d-flex justify-content-between mx-4">
<?php       if ($session->get('access_level') == 'admin')
            {   ?>
            <h1 class="h1">Manage Users</h1>
            <a class="btn btn-outline-danger" href="/users/new">Add New</a>
<?php       } 
            else
            {   ?>  
            <h1 class="h1">All Users</h1>
<?php       }   ?>
        </div>
    </div>
    <div class="row mt-5 mx-4">
        <table class="table table-bordered table-danger text-center">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>User Level</th>
<?php       if ($session->get('access_level') == 'admin')
            {   ?>
                <th>Actions</th>
<?php       }   ?>  
            </tr>
<?php       foreach ($users as $user)
            {   ?>
            <tr class="table-secondary">
                <td><?= $user['id'] ?></td>
                <td><a href="/users/show/<?= $user['id'] ?>"><?= $user['first_name'] ?> <?= $user['last_name'] ?></a></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['created_at'] ?></td>
                <td><?= $user['user_level'] ?></td>
<?php       if ($session->get('access_level') == 'admin')
            {   ?>
                <td>
                    <a class="text-success px-4" href="/users/edit/<?= $user['id'] ?>">Edit</a>
                    <a class="text-danger px-4" href="/users/delete/<?= $user['id'] ?>">Remove</a>
                </td>
<?php       }   ?>    
            </tr>
<?php       }   ?>
        </table>
    </div>

<?php echo view('partials/footer') ?>