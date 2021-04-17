<?php
$session = session(); 
echo view('partials/header', array('is_logged_in' => $is_logged_in)) ?>

    <div class="row">
        <div class="col-sm-12 col-md-4 mx-sm-3 mx-md-auto mt-4">
        <?= \Config\Services::validation()->listErrors() ?>
<?php       if ($session->has('error'))
            {   ?>
            <p><?= $session->get('error') ?></p>
<?php       }   ?>
            <form action="/users/login" method="post">
            <?= csrf_field() ?>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" aria-describedby="passwordHelp" placeholder="Enter password">
                    <small id="passwordHelp" class="form-text text-muted">Never share your password with someone else.</small>
                </div>
                <input class="btn btn-outline-danger mb-3" type="submit" value="Sign In">
            </form>
            <a class="text-primary" href="/register">Don't have an account yet? Register here.</a>
        </div>
    </div>

<?php echo view('partials/footer') ?>