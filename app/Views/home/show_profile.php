<?php   
$session = session(); 
echo view('partials/header', array('is_logged_in' => $is_logged_in)) ?>

        <div class="row mt-4">
            <div class="col-sm-12 col-md-6 p-4 ml-5">
                <h1><?= $user['first_name'] ?> <?= $user['last_name'] ?></h1>
                <p>Registered at: <?= $user['created_at'] ?></p>
                <p>User ID: #<?= $user['id'] ?></p>
                <p>Email: <?= $user['email'] ?></p>
                <p>Description: <?= $user['description'] ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6 mx-auto">
                <h3>Leave a message for <?= $user['first_name'] ?></h3>
                <form class="text-center" action="/messages/create/<?= $user['id'] ?>" method="post">
                <?= csrf_field() ?>
                    <div class="form-group">
                        <input type="text" name="content" class="form-control" aria-describedby="messageHelp" placeholder="Enter message">
                        <small id="messageHelp" class="form-text text-muted">Please post only kind messages.</small>
                    </div>
                    <input class="btn btn-outline-danger mb-3 mx-auto" type="submit" value="Post Message">
                </form>
            </div>
        </div>
<?php   foreach ($messages as $message)
        {   ?>
        <div class="row">
            <div class="col mb-4 mx-5">
                <div class="card">
                    <div class="col d-flex justify-content-between mx-4">
                        <h3 class="h3"><?= $message['name'] ?></h3>
                        <p class="pr-5"><?= $message['updated_at'] ?></p>
                    </div>
                    <p class="card-description p-4 ml-5"><?= $message['content'] ?></p>
                    <h5 class="text-center text-danger">comments</h5>
                    

<?php               foreach ($comments as $comment)
                    {   
                        if ($message['id'] == $comment['message_id'])
                        {    ?>
                    <div class="row">
                        <div class="col-sm-12 col-md-10 text-center mx-auto">
<?php                       if ($comment['writer_id'] == $session->get('user_id'))
                            {   ?>
                            <h5 class="h5">You</h5>
<?php                       }
                            else
                            {   ?>
                            <h5 class="h5"><?= $comment['name'] ?></h5>
<?php                       }   ?>
                            <p><?= $comment['updated_at'] ?></p>
                            <p><?= $comment['content'] ?></p>
                        </div>
                    </div>       
<?php                   } 
                    }       ?>
                    <div class="row">
                        <div class="col-sm-12 col-md-10 text-right mx-auto">
                            <form action="/comments/create/<?= $message['id'] ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="id" value="<?= $user['id'] ?>"
                                <div class="form-group">
                                    <input type="text" name="content" class="form-control" placeholder="Enter a comment.">
                                </div>
                                <input class="btn btn-outline-danger mb-1 mt-sm-3 mt-md-0 mx-auto" type="submit" value="Post Comment">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php   }   ?>

<?php echo view('partials/footer') ?>