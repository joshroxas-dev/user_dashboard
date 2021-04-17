<?php
$session= session(); 
echo view('partials/header') ?>

<?php   if ($session->get('access_level') == 'admin')
        {   ?>
<?php   if ($is_logged_in)
        {   ?>
        <div class="row mt-5">
            <div class="col d-flex justify-content-between mx-4">
                <h1 class="h1">Add a new user</h1>
                <a class="btn btn-outline-danger" href="/dashboard/admin">Back to Dashboard</a>
            </div>
        </div>
<?php   }   ?>
        <div class="row">
            <div class="col-sm-12 col-md-4 mx-sm-3 mx-md-auto mt-4">
            <?= \Config\Services::validation()->listErrors() ?>
<?php          if ($session->has('success'))
                {   ?>
                <p><?= $session->get('success') ?></p>
<?php           }   ?>
                <form action="/users/register" method="post">
                <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" class="form-control" placeholder="Enter first name">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" class="form-control" placeholder="Enter last name">
                    </div>
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
<?php               if (!$is_logged_in)
                    {   ?>
                    <input class="btn btn-outline-danger mb-3" type="submit" value="Register">
<?php               }
                    else
                    {   ?>
                    <input class="btn btn-outline-danger mb-3" type="submit" value="Create">
<?php               }   ?>
                </form>
<?php           if (!$is_logged_in)
                {   ?>
                <a class="text-primary" href="/signin">Already have an account? Sign in here.</a>
<?php           }   ?>
            </div>
        </div>
<?php   }   
        else    
        {   ?>
        <p class="text-center">Only admin users can create a new user.</p>
<?php   }   ?>

<?php echo view('partials/footer') ?>