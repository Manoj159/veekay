<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HappyEasy WebMailer</title>
</head>
<style>
    *, *::after, *::before{
        margin: 0;
        box-sizing: border-box;
    }
</style>
<body>
<div style="width: 700px; left: 1%; position: relative; line-height: 25px;">
    <img alt="happyeasyrides" src="<?= base_url("assets/mailer/"); ?>1.jpg" alt="banner" width="100%" loading="lazy"/>
    <br/>
    <p>Dear Admin,</p>
    <p>
       This email is to confirm your upcoming booking please check admin for new booking. 
       <br> Login -https://happyeasyrides.com/Admin_login <br/>
       Please check below payment details and booking details:
    </p>
    
    <p>
        <strong>Booking Details</strong><br/>
        <strong>-------------------------------------------------------</strong><br/>
        <strong>Booking ID-</strong> <?= $book->details_order_id; ?><br/>
        <strong>Mobile No-</strong> <?= $user->contact; ?><br/>
        <strong>Vehicle-</strong> <?= $car->name; ?><br/>
        <strong>Pick-up-</strong> <?= date("M d, Y | h:i A", strtotime($book->start)); ?><br/>
        <strong>Drop-off-</strong> <?= date("M d, Y | h:i A", strtotime($book->end)); ?><br/>
        
        <?php
             $start = new DateTime($book->start);
             $end = new DateTime($book->end);
        
             $main = $start->diff($end); 
        
             if($main->h > 0){
               $total_days = $main->d;
               $main_date = $main->d. " Days, ".$main->h." Hours";
             }else{
               $total_days = $main->d;
               $main_date = $main->d. " Days";
             } 
        ?>
        
        <strong>Total Duration -</strong> <?= $main_date; ?><br/>
        <br/>
        <strong>Address-</strong> <?= ($book->home_delivery==null)?"Self Pickup":$book->address; ?> <br/>

        <strong>-------------------------------------------------------</strong><br/>

        <p>
            <strong>Total Rental -</strong> INR <?= $book->final_car_price+$book->gst; ?>/-<br/>
            <strong>Refundable Security deposit -</strong> INR <?= $book->refund; ?>/-<br/>
            <strong>Delivery -</strong> <?php 
                $home_delivery_charge = 0;
                $home_delivery = $book->home_delivery; 
                if($home_delivery > 0){
                    $home_delivery_charge = $book->home_delivery_charges;
                }
                echo "INR ".$home_delivery_charge;
            ?><br/>
            <strong>Total -</strong> INR <?= $book->total_payable; ?>/-<br/>
            <!--<strong>Advance paid -</strong> INR <?= $book->final_car_price+$book->gst; ?>/-<br/>
            <strong>Net Payable -</strong> INR <?= $book->refund; ?>/-<br/>-->
        </p>

        <strong>-------------------------------------------------------</strong><br/>
        <strong>-------------------------------------------------------</strong><br/>

        Happyeasy rides guidelines - <br/>

        <ol>
            <li>The confirmation of booking is subject to complete payment.</li>
            <li> You need to show your original driving licence for taking the delivery of the car.</li>
            <li>The confirmation of your booking is subject to your successful payment of security deposit.</li>
            <li>Inspect the car & enter the checklist for dents and damages before you start your journey.</li>
            <li>Please read carefully the User responsibilities page for all the rules and related penalties.</li>
        </ol>

        <br/>

        Thanks & Regards, <br/>
        Team Happyeasy Rides<br/>
        <!--Amit Kumar <br/>
        +91 9310744723 <br/>-->

        <img alt="happyeasyrides" src="<?= base_url("assets/mailer/"); ?>4.jpg" alt="mailer-icon" loading="lazy" style="width: 150px !important;"/>
    </p>
    <br/>
    <img alt="happyeasyrides" src="<?= base_url("assets/mailer/"); ?>3.jpg" alt="mailer-icon" width="100%" loading="lazy"/>
</div>
</body>
</html>