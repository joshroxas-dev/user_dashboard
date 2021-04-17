<?php
$session = session(); 
echo view('partials/header', array('is_logged_in' => $is_logged_in)) ?>

<div class="row mt-4">
    <div class="col text-center">
        <h1 class="h1">
            Are you sure you want to delete this user?
        </h1>
        <a class="h3 text-danger px-4" href="/users/destroy/<?= $user_id ?>">Yes</a>
        <a class="h3" href="/dashboard/admin">No</a>
    </div>
</div>

<?php echo view('partials/footer') ?>