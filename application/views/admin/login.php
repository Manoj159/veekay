<!doctype html>
<html lang="en">

    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Language" content="en">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>VeekayCabs</title>
    
        <meta name="viewport"
            content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />

     
        <meta name="msapplication-tap-highlight" content="no">
        
   <link rel="icon" href="<?= base_url('assets/'); ?>logo.png">

    <link href="<?= base_url(); ?>assets/admin/css/main.d810cf0ae7f39f28f336.css" rel="stylesheet">

    <script type="text/javascript" src="<?= base_url(); ?>assets/admin/scripts/main.d810cf0ae7f39f28f336.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" ></script>

    <style type="text/css">
        .slick-next, .slick-arrow
        {
            visibility: hidden;
        }
    </style>

</head>

<div class="app-container app-theme-white body-tabs-shadow" style="background: #4a86aee5;">
        <div class="app-container">
            <div class="h-100">
                <div class="no-gutters row">
                   
                    <div class="h-100 d-flex justify-content-center align-items-center col-md-12 col-lg-12">
                        <div class="mx-auto app-login-box  bg-white col-sm-6 col-md-4 col-lg-3">
                            <div class="">
                             <a href="https://veekaycabs.com/">
                     <img src="https://veekaycabs.com//assets/img/logo.png" class="img-fluid">
                     </a></div>
                            <h4 class="mb-0 text-center font-weight-bold">
                                <span class="d-block">Welcome to Admin Dashboard</span>
                            </h4>

                            <div class="divider row"></div>
                            <div>
                              
                                <form  method="post" action="<?= base_url(); ?>Admin_login/checkUserLogin" id="loginForm">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleEmail" class="">Enter your Email address</label>
                                                <input name="email" id="exampleEmail" placeholder="Email here..." type="email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="examplePassword" class="">Enter your password</label>
                                                <input name="password" id="examplePassword" placeholder="Password here..." type="password" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                   

                                    <div class="divider row"></div>
                                    <div class="d-flex justify-content-center align-items-center mb-3">
                                        <button class="btn btn-primary btn-lg">Login to Dashboard</button>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php include 'alert.php'; ?>

