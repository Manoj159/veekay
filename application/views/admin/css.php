<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
   
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   
    <meta http-equiv="Content-Language" content="en">
   
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
   
    <title><?= $page_title; ?></title>
   
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
   
    <meta name="msapplication-tap-highlight" content="no">
   
   <!-- <link rel="icon" href="<?= base_url('assets/'); ?>logo.png"> -->

    <link href="<?= base_url(); ?>assets/admin/css/main.css" rel="stylesheet">
    
    <script src="https://code.jquery.com/jquery-3.5.1.js" ></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

    <style type="text/css">
        @media (min-width:  767px)
        {
            .btn-primary
            {
                max-width: 300px;
            }
        }

        .modal-backdrop.show
        {
            opacity: 0;
        }
        
        .modal-backdrop
        {
            position: relative;
        }

        #example_filter, #example_paginate{
            float: right !important;
        }
        .app-page-title{
            padding: 15px !important;
        }
        .card-header:first-child{
            border-radius: none ;
        }
    </style>

</head>

<body>

<?php if($this->session->userdata('admin_id') == '') redirect(base_url().'Login'); ?>