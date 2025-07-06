

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent A Self Drive Car -VeekayCabs </title>
    <!-- BOOTSTRAP CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- BOOSTRAP ICON CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Boxicon link -->
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- Material Icons-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- Google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- CSS Code Starts here -->
    <style>
        body , html 
{
    
    font-family: "Roboto", sans-serif !important;
    background-color: #fff;
    height: 100%;
    box-sizing: border-box;
}
.logo-Container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-left: 70px !important;
}
.logo-Container .Booking-details {
    color: #fff;
    border-radius: 50px 0px 0px 50px;
    font-size: 13px;
    background-image: linear-gradient(to right, rgba(22, 206, 146, 1) , rgba(0, 119, 172, 1));
}
/* ============================= */
.Greeting-box {
    background-color: #F4F5FC;
    border-radius: 10px;
}
.Greeting-box .dear {
    color: #262626;
    font-weight: 700;
}
.Greeting-box .text {
    font-weight: 400;
    font-size: 14px;
}
/* ============================== */
.Booking-Details-section h5 {
    font-size: 20px;
    font-weight: 700;
    color: #0032A1;
}
.Booking-details .text {
    font-weight: 700;
}
.Booking-form {
    border: 2px solid #EBEEFC;
}
.Booking-Details-section .Booking-form {
    border-radius: 10px;
}
.Booking-form .Form-top-details {
   /*display: flex;*/
   /*align-items: center;*/
   /*justify-content: space-between;*/
   border-bottom: 2px solid #EBEEFC;
}

.Booking-form .Form-top-details .Field-1 .field-title {
    font-size: 14px;
    color: #999999;
}
/* Bottom Details */
.Booking-form .Form-middle-details {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 2px solid #EBEEFC;
 }
.Booking-form .Form-middle-details .second-Field .field-title {
    font-size: 14px;
    color: #999999;
}
.Field-line {
    height: 40px;
    width: 2px;
    background-color: #EBEEFC;
}
/* =============== */
.Booking-form .form-bottom-details {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 2px solid #EBEEFC;
 }
.Booking-form .form-bottom-details .third-Field .field-title {
    font-size: 14px;
    color: #999999;
}
/* ================================== */
.Booking-form .form-total {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.Booking-form .form-total .field-title {
    font-size: 14px;
    color: #999999;
}
.Booking-form .form-total .time-left {
    position: relative;
}
.Booking-form .form-total .time-left span {
    color: #999999;
}
.Booking-form .form-total .time-left .time {
    font-size: 14px;
    margin-bottom: 10px;
}
.Booking-form .form-total .time-left .calender-icon {
    position: absolute;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    border: 1px solid rgb(192, 200, 240);
   text-align: center;
   top: 24px;
   left: 60px;
}
.Booking-form .form-total .time-left i {
    color: rgb(91, 116, 245) !important;
    font-size: 20px;
}
.Booking-form .form-total .grand-total {
    width: 400px;
    border: 1px dashed rgb(145, 162, 240);
    border-radius: 10px;
}
.Booking-form .form-total .grand-total .TR {
    margin-top: 10px;
}
.Booking-form .form-total .grand-total .Delviery {
    margin-bottom: 10px;
}
.Booking-form .form-total .grand-total .TR , .RFD , .Delviery , .total-amount {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 2px 15px;
}
.grand-total .TR .TR-price , .RFD-pric , .D-charge {
    font-size: 15px !important;
}
.grand-total .total-amount {
    background-color: #17D490;
    color: #fff;
    padding: 5px 15px;
    margin-bottom: 0 !important;
}
.grand-total .total-amount .total {
    font-size: 14px;
    font-weight: 500;
}
.grand-total .total-amount .GT-price {
    font-size: 15px;
    font-weight: 500;
}
/* ========================================== */
.Guidlines-section {
    background-color: #F4F5FC;
    border-radius: 10px;
}
.Guidlines-section h5 {
    font-size: 20px;
    font-weight: 600;
    color: #0032A1;
}
.Guidlines-section .Point  {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px !important;
    margin-bottom: 5px;
    color: #414141;
}
.Guidlines-section .Point span {
    color:#1F2869 ;
    font-weight: 400;
}
.field-value {
    font-weight: 700;
    color: #262626;
}
    </style>
</head>
<body>
    <?php // echo '<pre>'; print_r($book); die; ?>
    
    
    
    <!--[booking_id] => 76-->
    <!--[is_modified] => 0-->
    <!--[details_order_id] => DL_Baleno_JAIWANT_1306_76-->
    <!--[user_id] => 82-->
    <!--[car_id] => 27-->
    <!--[city] => 4-->
    <!--[start] => 2022-06-13 08:00:00-->
    <!--[end] => 2022-06-17 22:00:00-->
    <!--[availability] => 2022-06-18 00:00:00-->
    <!--[final_car_price] => 11550-->
    <!--[gst] => 0-->
    <!--[refund] => 5000-->
    <!--[total_payable] => 16550-->
    <!--[remaining] => -->
    <!--[remark] => -->
    <!--[home_delivery] => -->
    <!--[home_delivery_charges] => 1000-->
    <!--[address] => -->
    <!--[payment_status] => 1-->
    <!--[cancel_remark_admin] => -->
    <!--[cancel_percentage] => -->
    <!--[created] => 2022-06-10 22:23:56-->
    <!--[status] => 1-->
    
    
<!--    Booking ID- DL_Baleno_Mandeep_0404_5246-->
<!--Mobile No- 7300555126-->
<!--Vehicle- Baleno-->
<!--Pick-up- Apr 04, 2024 | 03:00 PM-->
<!--Drop-off- Apr 07, 2024 | 08:00 PM-->
<!--Total Duration - 3 Days, 5 Hours-->

<!--Address- Self Pickup-->
<!----------------------------------------------------------->

<!--Total Rental - INR 7612/--->
<!--Refundable Security deposit - INR 5000/--->
<!--Delivery - INR 0-->
<!--Total - INR 12612/--->


    
    <!-- Top logo Container -->
    <div class="logo-Container mt-5 mb-4">
        <div class="happy-easy-logo">
            <img src="<?= base_url(); ?>assets/img/logo.png" alt="" style=" width: 250px;">
        </div>
        <!--<div class="Booking-details p-3 px-5">-->
        <!--    <div class="booking">BOOKING ID:- </div>-->
        <!--    <div class="text"><?= $book->details_order_id; ?></div>-->
            <!--<div class="Booking-date">"(Booked on 01 February)”</div>-->
        <!--</div>-->
    </div>
    <!-- Top logo container Ends -->
    <!-- Main Content Area Starts Here-->
    <div class="container-fluid">
        <div class="row justify-content-evenly mb-4">
            <div class="col-md-11">
                <!-- Greeting Box Starts -->
                <div class="Greeting-box p-4">
                    <div class="dear">Dear <?= $user->name; ?></div>
                    <div class="text">
                        Thank you for choosing VeekayCabs as your self-drive partner. We are pleased to confirm your booking.Below are the Payment details
                    </div>
                </div>
            </div>
        </div>
        <!-- Greeting Section Ends -->
        <div class="row justify-content-evenly">
            <div class="col-md-11">
                <div class="Booking-Details-section">
                    <h5>BOOKING DETAILS :-</h5>
                    <div class="Booking-form ">
                        <!--  Car Confirmation Form -->
                     
    <p class="mb-2">
        <div class="Form-top-details p-2 px-4">
            <strong>Booking ID-</strong> <?= $book->details_order_id; ?><br/>
        </div>
         <div class="Form-top-details p-2 px-4">
             <strong>Mobile No-</strong> <?= $user->contact; ?>
          </div>
            <div class="Form-top-details p-2 px-4">
               <strong>Vehicle-</strong> <?= $car->name; ?>
          </div>
          <div class="Form-top-details p-2 px-4">
        <strong>Pick-up-</strong> <?= date("M d, Y | h:i A", strtotime($book->start)); ?>
          </div>
          <div class="Form-top-details p-2 px-4">
        <strong>Drop-off-</strong> <?= date("M d, Y | h:i A", strtotime($book->end)); ?>
          </div>
          <div class="Form-top-details p-2 px-4">
        
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
        
              <strong>Total Duration -</strong> <?= $main_date; ?>
      </div>
       <div class="Form-top-details p-2 px-4">
        <strong>Address-</strong> <?= ($book->home_delivery==null)?"Self Pickup":$book->address; ?>
       </div>
    
             <div class="Form-top-details p-2 px-4">
            <strong>Total Rental -</strong> INR <?= $book->final_car_price+$book->gst; ?>/-</div>
            
             <div class="Form-top-details p-2 px-4">
            <strong>Refundable Security deposit -</strong> INR <?= $book->refund; ?>/- </div>
            
             <div class="Form-top-details p-2 px-4">
               <strong>Delivery Charges -</strong> <?php 
                $home_delivery_charge = 0;
                $home_delivery = $book->home_delivery; 
                if($home_delivery > 0){
                    $home_delivery_charge = $book->home_delivery_charges;
                }
                echo "INR ".$home_delivery_charge;
            ?>
            </div>
             <div class="Form-top-details p-2 px-4">
            <strong>Total -</strong> INR <?= $book->total_payable; ?>/-</div>
            
            <!--<strong>Advance paid -</strong> INR <?= $book->final_car_price+$book->gst; ?>/-<br/>
            <strong>Net Payable -</strong> INR <?= $book->refund; ?>/-<br/>-->
        </p>

                        <!-- =========================================== -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Greeting Section Ends -->

        <!-- HAPPYEASY RIDES GUIDELINES starts here :- -->
        <div class="row justify-content-evenly mt-5">
            <div class="col-md-11">
                <div class="Guidlines-section p-4">
                    <h5 class="mb-3">VEEKAY CABS GUIDELINES :-</h5>
                    <!-- Guideline 1 -->
                    <div class="Point">
                        <span class="material-symbols-outlined"> expand_circle_right </span>
                        <div>The confirmation of booking is subject to complete payment.</div>
                    </div>
                    <div class="Point">
                        <span class="material-symbols-outlined"> expand_circle_right </span>
                        <div>Valid adhaar and DL is required to do a booking</div>
                    </div>
                    <div class="Point">
                        <span class="material-symbols-outlined"> expand_circle_right </span>
                        <div>You need to show your original driving licence for taking the delivery of the car.</div>
                    </div>
                    <div class="Point">
                        <span class="material-symbols-outlined">expand_circle_right</span>
                        <div>Inspect the car & take videos and photos for dents and damages before you start your journey.</div>
                    </div>
                    <div class="Point">
                        <span class="material-symbols-outlined">expand_circle_right</span>
                        <div>Please read carefully the User responsibilities page for all the rules and related penalties.</div>
                    </div>
                    <div class="Point">
                        <span class="material-symbols-outlined">expand_circle_right</span>
                        <div>Refundable deposit is refundable within 2 working days, not instant</div>
                    </div>
                    <div class="Point">
                        <span class="material-symbols-outlined">expand_circle_right</span>
                        <div>NHAI speed limit to be abided under all circumstances</div>
                    </div>
                    <div class="Point">
                        <span class="material-symbols-outlined">expand_circle_right</span>
                        <div>Extension is not adjustable from security deposits, you need to pay upfront</div>
                    </div>
                    <div class="Point">
                        <span class="material-symbols-outlined">expand_circle_right</span>
                        <div>Fuel to be returned at the same level at which car was handed over, extra fuel left in car is non refundable</div>
                    </div>
                    <div class="Point mb-3">
                        <span class="material-symbols-outlined"> expand_circle_right</span>
                        <div>Excess fastag recharged is non refundable</div>
                    </div>
                    <strong>Please read detailed refunds and cancellation policy at veekaycabs.com</strong>
                </div>
                <!-- Guidelines end here -->
            </div>
        </div>
        <!-- Footer Banner Starts here -->
        <div class="row">
            <div class="col-md-12 mt-1 p-0">
                <img src="<?= base_url(); ?>assets/img/footer-banner.jpeg" alt="" style="width: 100%;">
            </div>
        </div>
    </div>


    <!-- Boxicon CDN -->
    <script src="https://unpkg.com/boxicons@2.1.3/dist/boxicons.js"></script>
    <!-- BOOTSTRAP JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>