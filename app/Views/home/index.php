<?php echo view('partials/header', array('is_logged_in' => $is_logged_in)) ?>

    <div class="jumbotron mx-3 mt-2 text-center">
        <h1 class="display-3">Welcome to this app</h1>
        <p class="lead">We are going to create a cool app using MVC framework.</p>
        <a class="btn btn-outline-danger px-4" href="/signin">Start</a>
    </div>

    <div class="row mx-1 text-center">
        <div class="col-sm-12 col-md-4 mb-2">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Manage Users</h5>
                    <p class="card-text">Using this application. Add, Remove and Edit Users</p>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 mb-2">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Leave Messages</h5>
                    <p class="card-text">Users will be able to leave a message to other users.</p>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 mb-2">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Edit User Information</h5>
                    <p class="card-text">Admins will be able to edit another user's information (Email address, First name, Last name, etc. )</p>
                </div>
            </div>
        </div>
    </div>

<?php echo view('partials/footer') ?>