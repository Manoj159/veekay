<?php 
   //  error_reporting(0);
   
     $title = "Contact Veekay Cabs for Self Drive Cars Rides ";
   
     $h1Tag = isset($h1_tag)?$h1_tag:'VeekayCabs - Your favourite self drive car';
   
     $description = "Explore Veekay Cabs for premium self-drive car rentals in Delhi NCR Affordable, reliable, and flexible car rental services tailored to your needs. Book your ride today!";
   
     $keywords = "Self drive car rental, self drive car rental noida, Car rental delhi, Rent a self drive car in Noida, noida to rishikesh car rental, Delhi to haridwar car hire, Self drive car leasing, Self drive car rental rates ";
   
     if(isset($meta)){ 
   
          $title = $meta->title;
   
          $keywords = $meta->keyword;
   
          $description = $meta->description;
   
          $h1Tag = $meta->h1_tag;
   
     }
     header("Access-Control-Allow-Origin: *");
   ?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <title><?= $title; ?></title>
      <meta name="description" content="<?= $description; ?> | Explore Veekay Cabs for premium self-drive car rentals in Delhi NCR, Amritsar, and Bangalore. Affordable, reliable, and flexible car rental services tailored to your needs. Book your ride today!" >
      <meta name="keywords" content="<?= $keywords; ?> , Self drive car on rent,Near by self drive car rental,Car rental New Delhi,Self drive cars in Delhi NCR,Rent car greater noida,Car rental delhi airport,Car hire delhi,Car rental in Lucknow,Self drive car rental lucknow
            Self drive car rental lucknow airpot,Rent a car lucknow,Lucknow,rental car for wedding,Lucknow car rental self drive,Lucknow tourist car rental,Lucknow monthly car rental" >
        <link href="<?= base_url(); ?>/assets/img/favicons2.png" rel="icon">  
        <meta name="h1_tag" content="<?= $h1Tag; ?>| Self drive car on rent " > 
        <meta name="author" content="https://veekaycabs.com/">
        <meta name="content-language" content="english">
        <meta name="audience" content="all">
        <meta name="publisher" content="veekaycabs">
        <meta name="copyright" content="Copyright 2023">
        <link rel="canonical" href="https://veekaycabs.com/">
        
        <meta name="zipcode" content="201301">
        <meta name="abstract" content="veekaycabs Provides Self Drive car rental services in Delhi NCR. Our Top Services Includes Car on rent in delhincr">
        <meta name="contact" content="+91-9999926867 ">
        <meta name="city" content="Delhincr">
        <meta name="country" content="India">
        <meta name="web_content_type" content="Our Top Services Includes Car on rent in delhincr" />
        <meta name="classification" content="Travel Company" />
        <meta name="contactOrganization" content="Our Top Services Includes Car on rent in delhincr" />
        <meta name="contactPhoneNumber" content="+91-9999926867" />
        <meta name="contactNetworkAddress" content="India" />
        <meta property="og:locale" content="en_IN" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="<?= $title; ?>" />
        <meta property="og:description" content="<?= $description; ?>" />
        <meta property="og:url" content="https://veekaycabs.com/" />
        <meta property="og:site_name" content="veekaycabs" />
        <meta property="og:image" content="<?= base_url(); ?>assets/img/logo.png" />
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:description" content="<?= $description; ?>" />
        <meta name="twitter:title" content="Rent A Self Drive Car In Delhi" />
        <meta name="robots" content="index, follow" />
  
      
      <script src="<?= base_url(); ?>/assets/js/jquery-3.7.0.min.js" ></script>
     <link type="text/css" href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
      <link type="text/css" href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet">
      <link type="text/css" href="<?= base_url(); ?>assets/css/responsive.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/slick.css"/>
      <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/bootstrap-datetimepicker.css"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
      <script>
         function setCookie(name,value,days) {
             var expires = "";
             if (days) {
                 var date = new Date();
                 date.setTime(date.getTime() + (days*24*60*60*1000));
                 expires = "; expires=" + date.toUTCString();
             }
             document.cookie = name + "=" + (value || "")  + expires + "; path=/";
         }
         function getCookie(name) {
             var nameEQ = name + "=";
             var ca = document.cookie.split(';');
             for(var i=0;i < ca.length;i++) {
                 var c = ca[i];
                 while (c.charAt(0)==' ') c = c.substring(1,c.length);
                 if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
             }
             return null;
         }
      </script>
      <meta name="google-site-verification" content="2IN6m_g6qsunbcJfEDroMrreYBNAHcMopYEXdezFSkM" />
      <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-EBZ83NWNF4"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'G-EBZ83NWNF4');
        </script>
   </head>
   <body class="inner-page">
      <!-- header section -->
          <a href="https://api.whatsapp.com/send?phone=+919999926867&text=Hello, Veekay Cabs!!!!" class="whatsapp-connect bounce2"> <img src="<?= base_url(); ?>/assets/img/whatsapp.png" alt="veekaycabs Self drive car rental" > </a>
      <section class="header inner d-md-block">
         <div class="container">
            <div class="d-flex header-inner justify-content-between align-items-center">
               <button type="button" class="btn desktop-none p-0" data-bs-toggle="modal" data-bs-target="#menu-left-modal"> <img src="<?= base_url(); ?>assets/img/menu-toggle.svg" class="w-40"  alt="veekaycabs Self drive car rental" > </button>
               <div class="logo mobile-none">
                  <a href="<?= base_url(); ?>">
                  <img width="175px" src="<?= base_url(); ?>assets/img/VeekayCabs-logo1.png" class="img-fluid" alt="veekaycabs">
                  </a>
               </div>
               <div class="logo desktop-none mobile-block">
                  <img src="<?= base_url(); ?>assets/img/mobile-logo.png" class="img-fluid"  alt="veekaycabs" >
               </div>
               <div class="menu-header mobile-none">
                  <ul class="menu d-flex">
                     <li><a href="<?= base_url(); ?>" class="active">Home</a></li>
                     <!-- <li><a href="<?= base_url(); ?>assets/monthly.html">Monthly</a></li>
                        <li><a href="<?= base_url("about"); ?>">About us</a></li> -->
                     <li><a href="<?= base_url("blogs"); ?>">Blogs</a></li>
                     <li><a href="<?= base_url("contact"); ?>">Contact Us</a></li>
                     <li><a href="<?= base_url("add-car"); ?>">Add your car</a></li>
                  </ul>
               </div>
               <?php ?>
               <div class="header-right d-flex">
                  <a href="#" class="me-3 mobile-none"> <img src="<?= base_url(); ?>assets/img/support.svg" alt="veekaycabs Self drive car rental"  alt="9999926867" > +91 9999926867 </a>
                  <?php if($this->session->userdata('user_id') == ''){ ?>
                  <button type="button" class="btn btn-login mobile-none" data-bs-toggle="modal" data-bs-target="#login-modal"> <img src="<?= base_url(); ?>assets/img/user-head.svg" alt="veekaycabs" > Login/Signup  </button>
                  <?php } ?>
                  <?php if($this->session->userdata('user_id') != ''){ ?>
                  <li><a class="btn btn-login" href="<?= base_url(); ?>account">My Account</a></li>
                  <li><a class="btn btn-login" href="<?= base_url(); ?>signup/logout">Logout</a></li>
                  <?php } ?>
               </div>
            </div>
         </div>
      </section>