<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/lux/bootstrap.min.css" integrity="sha384-9+PGKSqjRdkeAU7Eu4nkJU8RFaH8ace8HGXnkiKMP9I9Te0GJ4/km3L1Z8tXigpG" crossorigin="anonymous">
    <style>
        .bg-danger {
            background-color: #000 !important;
        }
    
    </style>
    <title>User Dasboard</title>
  </head>
  <body>
    <div class="container-fluid px-0">
        <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
            <a class="navbar-brand" href="/">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
<?php           if ($is_logged_in)
                {   ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/users/edit/">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/admin">Dashboard</a>
                    </li>
<?php           }   ?>
                </ul>
                <ul class="navbar-nav ml-auto">
<?php           if (!$is_logged_in)
                {   ?>
                    <li class="nav-item">
                        <a class="nav-link ml-auto text-light" href="/signin">Sign In</a>
                    </li>
<?php           }
                else
                {   ?>
                     <li class="nav-item">
                        <a class="nav-link ml-auto text-light" href="/logoff">Log Off</a>
                    </li>
<?php           }   ?>
                </ul>          
            </div>
        </nav>

