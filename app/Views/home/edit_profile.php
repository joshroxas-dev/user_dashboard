<?php   
$session = session(); 
echo view('partials/header', array('is_logged_in' => $is_logged_in)) ?>

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
                <h1 class="h1">Edit your information</h1>
                <a class="btn btn-outline-danger" href="/dashboard/admin">Back to Dashboard</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-4 mx-sm-3 mx-md-auto mt-4">
                <form action="/users/update/<?= $user['id'] ?>" method="post">
                <?= csrf_field() ?>
                    <input type="hidden" name="user_level" value="<?= $user['user_level'] ?>">
                    <input type="hidden" name="description" value="<?= $user['description'] ?>">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" value="<?= $user['email'] ?>">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" class="form-control" placeholder="Enter first name" value="<?= $user['first_name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" class="form-control" placeholder="Enter last name" value="<?= $user['last_name'] ?>">
                    </div>
                    <input class="btn btn-outline-danger mb-3" type="submit" value="Save">
                </form>
            </div>
            <div class="col-sm-12 col-md-4 mx-sm-3 mx-md-auto mt-4">
                <form action="/users/update_password/<?= $user['id'] ?>" method="post">
                <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" aria-describedby="passwordHelp" placeholder="Enter password">
                        <small id="passwordHelp" class="form-text text-muted">Password must be longer than 8 characters.</small>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" aria-describedby="passwordHelp" placeholder="Confirm password">
                        <small id="passwordHelp" class="form-text text-muted">Never share your password with someone else.</small>
                    </div>
                    <input class="btn btn-outline-danger mb-3" type="submit" value="Update Password">
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-8 mx-auto">
                <form action="/users/update_description" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="Description">Description</label>
                        <input type="description" name="description" class="form-control" placeholder="Enter description" value="<?= $user['description'] ?>">
                    </div>
                    <input class="btn btn-outline-danger mb-3" type="submit" value="Save">
                </form>
            </div>
        </div>

<?php echo view('partials/footer') ?>