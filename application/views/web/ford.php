<link rel="stylesheet" href="/ford-css.css">
<style>
    .elli{
           overflow: hidden;
           text-overflow: ellipsis;
           display: -webkit-box;
           -webkit-line-clamp: 2; /* number of lines to show */
                   line-clamp: 2;
           -webkit-box-orient: vertical;
         }
</style>
<?php



//echo "<pre>"; print_r($this->session->userdata()); exit;

$car = @$this->db->get_where('car', array('car_id'=>$_GET['car_id']))->row();

$pick_data = $this->db->get_where('settings', "settings_id=12 OR settings_id=13 OR settings_id=14 OR settings_id=15 OR settings_id=16 OR settings_id=17")->result();
      $pick_start_time = $pick_end_time = $price_increase_percentage = "";
      foreach($pick_data as $p)
      { 
         if($p->settings_id == 12){
            $pick_start_time = $p->description;
         }
         elseif($p->settings_id == 13){
            $pick_end_time = $p->description;
         }
         elseif($p->settings_id == 14){
            $price_increase_percentage = $p->description;
         }
         
          elseif($p->settings_id == 15){
            $price_decrease_percentage = $p->description;
         }
          elseif($p->settings_id == 16){
            $down_start_time = $p->description;
         }
          elseif($p->settings_id == 17){
            $down_end_time = $p->description;
         }
     } 

	

	



								$price = $car->price;

								$start_date = $this->session->userdata('start');

								$day = date("l", strtotime($start_date));

							
								if($day=="Saturday" || $day=="Sunday"){

								    $price = $car->weekend_price;    

								}

                                    $start = new DateTime($this->session->userdata('start'));

									$end = new DateTime($this->session->userdata('end'));

									$main = $start->diff($end); 

									if($main->h > 0){

									  if($main->d != 0){

									     $main_date = $main->d. " Days & ".$main->h." Hours";

									  }else{

									    $main_date = $main->h." Hours";

									  }

									}else{

									  $main_date = $main->d. " Days";

									}

									$price_per_hour =  round($price / 24);

									$mdate = $main->d*24 +$main->h ; 

									

									  // print($price);

									@$final_car_price = round($price*$mdate);

									  $interval = DateInterval::createFromDateString('1 hour');

									  $period = new DatePeriod($start, $interval, $end);

									  $overall_fare = 0;

									  foreach ($period as $dt) {

									    //note:- looping through every one hour from start to end datetime

									    //echo $dt->format("l Y-m-d H:i:s\n")."<br/>";

									    $date_day = $dt->format("l"); //checking for the weekend day in current loop hour.

									    if($date_day=="Saturday" || $date_day=="Sunday"){

									        $overall_fare = $overall_fare+$car->weekend_price;

									    }else{

									        $overall_fare = $overall_fare+$car->price;

									    }

									

									    $dateDiff2 = $dt->format("Y-m-d H:i:s"); // 13,14,15,16

									

									    // for price up and down setting 
                                             $dateDiff2 = $dt->format("Y-m-d H:i:s");
                                            $percentToApply = $percentAddon = 0;
                                           $percentToApply1  = $percentDecrease = 0;
                                            if($dateDiff2 >= $pick_start_time && $dateDiff2 <= $pick_end_time){
                                                $percentToApply = $price_increase_percentage;
                                            }
                                            if($percentToApply > 0){
                                             $percentAddon = (($overall_fare*$percentToApply)/100);
                                            }
                                            
                                            
                                            if($dateDiff2 >= $down_start_time && $dateDiff2 <= $down_end_time){
                                                $percentToApply1 = $price_decrease_percentage;
                                            }
                                            if($percentToApply1 > 0){
                                             $percentDecrease = (($overall_fare*$percentToApply1)/100);
                                            }

									  }
									  
									  
									  
								     if($percentAddon > 0){
                                            $overall_fare = ($overall_fare+$percentAddon);
                                        }
                                        
                                         if($percentDecrease > 0){
                                            $overall_fare = ($overall_fare-$percentDecrease);
                                       }

									

									if($this->session->userdata("coupon_discount")){

									    $percent = $this->session->userdata("coupon_discount");

									    $coupon_discount = ($overall_fare*$percent)/100;

									    $old_overall_fare = $overall_fare;

									    $overall_fare = $overall_fare-$coupon_discount;

									}  

									@$final_car_price = round($overall_fare);



									$gst_per = $this->db->get_where('settings', array('type'=>'gst'))->row()->description;

									

									$gst = @round($final_car_price/ 100 * $gst_per);

									$this->session->set_userdata('gst',$gst);

									

									$gst = 0;

									

	// get user first name

$user_id = $_SESSION['user_id'];

$user_name = $this->db->get_where("user", ["user_id"=>$user_id])->row()->name;

$user_name_array = explode(" ", $user_name);

$user_first_name = $user_name_array[0];



$car_name = str_replace(' ', '',$this->db->get_where('car',array('car_id'=>$this->session->userdata('car_id')))->row()->name);

// end.. get user first name



@$details_order_id = @str_replace(' ', '_',$this->db->get_where('city',array('city_id'=>$this->session->userdata('city')))->row()->short_name)."_".$car_name."_".$user_first_name."_".date('dm', strtotime($this->session->userdata('start')));



 $refund = $car->refund_deposit;

if($refund == 0){

//echo $refund = $this->db->get_where('settings', array('type'=>'refund'))->row()->description;

}



$home_delivery = $car->home_delivery_charge;



if($home_delivery == 0){  

$home_delivery = $this->db->get_where('settings', array('type'=>'home_delivery'))->row()->description;

}



$this->session->set_userdata('details_order_id',$details_order_id);

$this->session->set_userdata('gst',$gst);

$this->session->set_userdata('refund',$refund);

$this->session->set_userdata('home_delivery_charges',$home_delivery);

$this->session->set_userdata('final_car_price',$final_car_price);



if($this->session->userdata('home_delivery') != ''){

$total_payable = $final_car_price+$gst+$refund+$home_delivery;

$this->session->set_userdata('total_payable',$total_payable);

}else{

$total_payable = $final_car_price+$gst+$refund;

$this->session->set_userdata('total_payable',$total_payable);


}













//echo"<pre>"; print_r($this->session->userdata()); exit;

?> 
<style>
    p.designe {
    font-size: 18px;
    font-weight: 500;
    padding: 0 0 0 23px;
}
</style>
<div class="header-inner-sumary pt-3">

        <div class="container">

            <div class="row">

                <div class="col-lg-12">

                    <h2>Booking Summary</h2>

                    <nav aria-label="breadcrumb">

                        <ol class="breadcrumb">

                          <li class="breadcrumb-item"><a href="#">Home</a></li>

                          <!-- <li class="breadcrumb-item"><a href="#">Library</a></li>120 

                          <li class="breadcrumb-item active" aria-current="page">Data</li> -->

                        </ol>

                      </nav>

                </div>

            </div>

        </div>

    </div>

    



    <section class="content-wrapper checkout-page">

        <div class="container">

            <div class="row">

                <div class="col-lg-8">

                    <div class="card car-details ">

                        <div class="d-flex justify-content-between align-items-center">

                            <div class="">

                                <h5 class="mb-0"><?= $c->name; ?></h5>

                                <p> <?php echo $c->car_type ?></p>

                                <p>   </p>


                            </div>

                            <!--<div class="rating"> <span><img src="<?= base_url(); ?>assets/img/star.svg" alt=rating-star> 4.2</span></div>-->

                        </div>

                        <div class="row">

                            <div class="col-lg-5 col-md-5">

                                <div class="car-side d-flex h-100 justify-content-center">

    

                                    <div class="car-image d-flex justify-content-center align-items-center" style="">

                                        <img src="<?= base_url().$c->image; ?>" alt="img" class="">

                                    </div>

                                   

                                </div>

                            </div>

                            <div class="col-lg-7 col-md-7">

                                <div class="booking-detail-car">

                                    <div class="d-flex justify-content-between align-items-start">

                                       <div> 

                                        <h4>Location</h4>

                                        <p class="mb-0"><?= $this->db->get_where('city', array('city_id'=>$c->city))->row()->name; ?></p>

                                    </div>

                                        <!-- <a href="#"  class="btn" id="edit-booking-detail"> Edit </a> -->

                                    </div>



                                    <div class="time-slection">

                                        <div class="time-inner start"><?= @date('d M, Y H:i', strtotime($_GET['start'])); ?></div>

                                        <div class="time-inner end"><?= @date('d M, Y H:i', strtotime($_GET['end'])); ?></div>

                                        <!-- <p class="total-days">7 Days</p> -->

                                    </div>

                                    <?php $start = new DateTime($this->session->userdata('start'));

                                          $end = new DateTime($this->session->userdata('end'));



                                          $main = $start->diff($end); 

                                                   

                                          $total_days = 0;

                                                   

                                          // if booking is less than 24 Hrs.

                                          $isLessThan_24Hrs = 0;

                                          if($main->d == 0 && $main->h < 24){

                                             $isLessThan_24Hrs = 1;    

                                          }

                                          // end..

                                                   

                                          if($main->h > 0){

                                             $total_days = $main->d;

                                             $main_date = $main->d. " Days & ".$main->h." Hours";

                                          }else{

                                             $total_days = $main->d;

                                             $main_date = $main->d. " Days";

                                          } 

                                          

                                          

                                          if($this->session->userdata("coupon_total_days")){

                                                $coupon_total_days = $this->session->userdata("coupon_total_days");

                                                if($total_days < $coupon_total_days){

                                                   $this->session->unset_userdata("coupon_discount");

                                                   $this->session->unset_userdata("coupon_name");   

                                                }

                                          }

                                          

                                          $mdate = $main->d*24 +$main->h;

                                       

                                             $interval = DateInterval::createFromDateString('1 hour');

                                             $period = new DatePeriod($start, $interval, $end);

                                             $overall_fare = 0;

                                             

                                             $reg_hrs = 0;

                                             $week_hrs = 0;

                                                   

                                             foreach ($period as $dt) {

                                                //note:- looping through every one hour from start to end datetime

                                                //echo $dt->format("l Y-m-d H:i:s\n")."<br/>";

                                                $date_day = $dt->format("l"); //checking for the weekend day in current loop hour.

                                                if($date_day=="Saturday" || $date_day=="Sunday"){

                                                   $overall_fare = $overall_fare+$c->weekend_price;

                                                   $week_hrs++;

                                                }else{

                                                   $overall_fare = $overall_fare+$c->price;

                                                   $reg_hrs++;

                                                }



                                            // for price up and down setting 
                                            $dateDiff2 = $dt->format("Y-m-d H:i:s");
                                            $percentToApply = $percentAddon = 0;
                                            $percentToApply1  = $percentDecrease = 0;
                                            if($dateDiff2 >= $pick_start_time && $dateDiff2 <= $pick_end_time){
                                                $percentToApply = $price_increase_percentage;
                                            }
                                            if($percentToApply > 0){
                                             $percentAddon = (($overall_fare*$percentToApply)/100);
                                            }
                                            
                                            
                                            if($dateDiff2 >= $down_start_time && $dateDiff2 <= $down_end_time){
                                                $percentToApply1 = $price_decrease_percentage;
                                            }
                                            if($percentToApply1 > 0){
                                             $percentDecrease = (($overall_fare*$percentToApply1)/100);
                                            }

									  }
									  
									  
									  
								     if($percentAddon > 0){
                                            $overall_fare = ($overall_fare+$percentAddon);
                                        }
                                        
                                         if($percentDecrease > 0){
                                            $overall_fare = ($overall_fare-$percentDecrease);
                                       }


                                       ?>

                                     <p class="d-block text-center mb-2">Duration: <?= $main_date; ?></p> 



                                </div>

                            </div>

                            <div class="d-flex justify-content-between w-100 pt-4">

                                <p class="mb-0">Package Type : 250 kms/day</p>

                                <!-- <p class="mb-0">Package Type : 120 kms/day</p>

                                <p class="mb-0">Package Type : 120 kms/day</p> -->

                            </div>

                        </div>

                    </div>



                



                    <div class="card car-details location">

                        <div class="location-head d-flex">

                            <div class="w-75">

                                <h6>Car Details</h6>

                            </div>

                           

                        </div>

                        <div class="car-info d-flex justify-content-between">

                            <div class="car-item"> <img src="<?= base_url(); ?>assets/img/fuel.svg" alt="icon-img"> <?= $c->fuel; ?></div>

                            <div class="car-item"> <img src="<?= base_url(); ?>assets/img/transmission.svg" alt="icon-img"> <?= $c->transmission; ?></div>

                            <div class="car-item"> <img src="<?= base_url(); ?>assets/img/seat.svg" alt="icon-img"><?= $c->seats; ?>  Seater</div>

                        </div>

                    

                    </div>



                



                    <div class="card car-details location cancellation">

                        <div class="location-head ">

                            <h6>Important info</h6>

                            <ul>

                                <li class="mb-2">Minimum permissible age for renting out a VeekayCabs car is 21 years and the driving license of the renter should be minimum one year old as on the rental start date</li>

                                <!-- <li class="mb-2">Minimum permissible age for renting out a MyChoize car is 21 years and the driving license of the renter should be minimum one year old as on the rental start date</li>

                                <li class="mb-2">Minimum permissible age for renting out a MyChoize car is 21 years and the driving license of the renter should be minimum one year old as on the rental start date</li>

                                <li class="mb-2">Minimum permissible age for renting out a MyChoize car is 21 years and the driving license of the renter should be minimum one year old as on the rental start date</li> -->



                            </ul>

                        </div>

                    </div>




                </div>

                <div class="col-lg-4">

                    <!-- car-pickup-location -->

                    

                    <div class="card delivery-info mb-3">

                        <div class="card-header">

                            Car pickup location

                        </div>

                        <div class="card-body">

                            <div class="d-flex justify-content-between">

                                <p class="bold">Choose car pickup location</p>
                              

                                <a href="#"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>

                            </div>

                            <!--<p id="addbox"></p>-->
                           
                             <div class="radio-group">
                                <div class="d-flex align-items-start">
                                    <input class="me-2 mt-1" type="radio" name="offer" id="option1" value="option1" checked>
                                    <label class="form-check-label">
                                        A 13 PANDAV NAGAR COMPLEX DELHI EAST , Pin 110092 
                                    </label>
                                </div>
                                <p class="small  ms-4 mt-3 ">Doorstep delivery is available on this location, If you want doorstep delivery of the car you can opt in the facility</p>
                                                                <p class="add-contents">Get this car home delivered and picked up from your door step at just INR 1000</p>
                                <div class="d-flex align-items-start">
                                    <label class="form-check-label" >
                                    <input type="radio" id="homedelivery" class="form-check-input me-2 mt-1" name="offer" value="option2">
                                        Choose doorstep delivery
                                    </label>
                                </div>
                             
                            </div>
    <p id="addbox" style="margin-top: 10px;"></p>
                            <div  class="add-box border border-1 mt-3 rounded-3 d-flex flex-column justify-content-center align-items-center py-2 d-none" >

                                <p class="mb-2">No saved addes found</p>

                                <input class="m-3" type="text" name="address" id="address" >

                                <button type="button" class="btn btn-themed" onclick="save_address()">

                                    Save

                                  </button>

                            </div>

                        </div>

                    </div>



                    <div class="card fare-details delivery-info">

                        <div class="card-header">

                            Booking summary

                        </div>



                        <div class="card-body">

                            <div class="d-flex justify-content-between">

                                <h5>Booking Fair</h5>

                                <h6>₹

                            <?php    $starttimestamp = strtotime($_GET["start"]);

                                      $endtimestamp = strtotime($_GET["end"]);

	                                  $difference = abs($endtimestamp - $starttimestamp)/3600;

	                                  if($difference < 24 && $_GET['city']==6){

	           

	                                        echo  number_format($c->price*24);

	                                  }else{

                           

                                   if(isset($_GET['city']) && $_GET['city']==6){

                                             

                                                $end = $_GET["end"];

                                               $endTime =date("H", strtotime($end));

                                           if( $endTime > 9){

                                              $timeMinus= ($endTime-9);

                                              echo $totalmoney =   number_format(($overall_fare)+($c->price*24)-$timeMinus*$c->price); 

                                           }else{

                                              

                                                  echo $totalmoney =number_format($overall_fare);

                                           }

                                             

                                         }else{ 

                                               echo $totalmoney =number_format($overall_fare );

                                         }

	                                  }

                                 ?>

                                </h6>

                            </div>

                            <div class="d-flex justify-content-between">

                                <h5>Discount</h5>

                                <?php

                                   $discount = 0;

                                   $totmny = str_replace(",","",$totalmoney);

                                   if($this->session->userdata("coupon_discount"))

                                   {

                                       

                                       $discount = ($totmny*($this->session->userdata("coupon_discount")))/100;

                                   }

                                

                                ?>

                                <h6>₹ <?=$discount;?></h6>

                            </div>

                            <div class="d-flex justify-content-between">

                                <h5>Security Deposite</h5>

                                <h6>₹ <?=$c->refund_deposit?></h6>

                            </div>
                            
                           
                            
                            
                            
                            
                            <?php
                                if($this->session->userdata("coupon_name")){
                            ?>
                            <div class="d-flex justify-content-between">

                                <h5>Applied Coupon</h5>

                                <h6><?=$this->session->userdata("coupon_name");?></h6>

                            </div>
                            <?php } ?>

                            

                            

        

                            <div class="form-check d-flex d-none">

                                <input type="checkbox" class="form-check-input me-2">

                                <label class="form-check-label ">Trip Protection Plan <a href="#">View Details</a></label>

                            </div>

                            

                            <hr />
                            
                            <div class="d-flex justify-content-between home_delivery_tab d-none ">

                                <h5>Home  Delivery Charge</h5>

                                <h6><b>₹ <?=$home_delivery?></b></h6>
                                

                            </div>
                            
                            <hr />
                            
                            <?php
                                if($this->session->userdata("coupon_name")){
                            ?>
                            <div class="coupan d-flex justify-content-between align-items-center">
                                <p class="d-flex"><i class="fa fa-gift me-2" style="font-size: 22px;" aria-hidden="true"></i><?=$this->session->userdata("coupon_name");?></p>
                                <button type="button" class="btn apply-btn btn-primary" onclick="removeCope();">Remove Coupon</button>
                            </div>
                            <?php }else{ ?>
                                <div class="coupan d-flex justify-content-between align-items-center">
                                    <p class="d-flex"><i class="fa fa-gift me-2" style="font-size: 22px;" aria-hidden="true"></i> Promo codes</p>
                                    <button type="button" class="btn apply-btn btn-primary" data-bs-toggle="modal" data-bs-target="#coupan-modal">Apply here</button>
                                </div>
                            <?php } ?>

                            <hr />

                            <div class="d-flex justify-content-between final">

                                <h5 class="fw-bold">Total Amount</h5>

                                <?php

                                

                                $payable = ($totmny+$c->refund_deposit)-$discount;;

                                

                                ?>

                                <h6 class="fw-bold text-dark ">₹ <span class="final_paycls"><?=intval($payable)?></span></h6>
                                
                                <input type='hidden' class="final_payvls" value="<?=$payable?>">
                                  <input type='hidden' class="hod" value="<?=$home_delivery?>">
                                

                            </div>

                            <hr/>

                            <div class="d-flex justify-content-between final">

                                <h5 class="fw-bold">Pay Token Amount</h5>

                                <h6 class="fw-bold text-dark ">₹ <span class="token_text"><?=$token =intval( ($payable*25)/100);?></span></h6>

                            </div>

                            <div class="d-flex justify-content-between">

                                <h5>Pay rest amount after car pickup</h5>


                                <h6 >₹ <span class="remeain_amount"><?=$payable-$token;?></span> </h6>

                            </div>

                            <p class="small">Get any car with ₹<?=$c->refund_deposit?> security deposit <a href="/terms/refund">Read More</a></p>
                            
                              

                            <div class="form-check d-flex">

                                <input type="checkbox" class="form-check-input me-2"  data-token='<?=$token;?>'  data-full='<?=intval($payable);?>' id="fullpay">

                                <label class="form-check-label" for="fullpay">Pay full amount now </label>

                            </div>

                            

                            <div class="action">

                            <?php if($this->session->userdata('user_id') != ''){ ?>

                                  <a id='btnpayss' href="javascript:void(0)" onclick="makeMeVoid2()" class="btn action-btn-primary">Pay Now  ₹ <?=intval($token);?></a>

                                  <!--<a id='btnpayss' href="javascript:void(0)" onclick="makeMeVoid()" class="btn action-btn-primary">Pay Now  ₹ <?=$token;?></a>-->

                                <?php }else{?>

                                  <a id='btnpays' data-bs-toggle="modal" data-bs-target="#login-modal" class="btn action-btn-primary">Pay Now ₹  <?=intval($token);?></a>

                                <?php } ?>

                            </div>

                            <hr>

                            <div class="action">
                                
                            <?php if($this->session->userdata('user_id') != ''){ ?>
                                <a class="btn action-btn-secondary w-100 d-none" href="/checkout/makeCOD">COD</a>
                            <?php }else{?>
                                <a id='btnpays' data-bs-toggle="modal" data-bs-target="#login-modal" class="btn action-btn-secondary w-100  d-none">COD</a>
                            <?php } ?>

                            </div>

                            

                            <p class="tag-text mt-3 justify-content-center d-flex">By paying you will be agree to our <a href="/terms">Terms & Condition</a></p>

                        </div>

                    </div>



                </div>

            </div>

        </div>

    </section>

    

     <!-- coupan Modal -->

    <!--<div class="modal fade" id="coupan-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apply a Coupan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" placeholder="Enter Coupan" id="coupan" name="coupan">
                        <button onclick="apply()" class="btn btn-themed">Apply</button>
                    </div>
                </div>
                <div class="col-md-12">
                  <?php  
                     $images = $this->db->get_where('coupon')->result();
                       foreach($images as $i){ 
                    ?>
                      <div class="col-md-3">
                         <p class="designe"><?= $i->name ?></p>
                      </div>
                    <?php   }  ?> 
                </div>
            </div>
        </div>
    </div>-->

    

     <!-- coupan Modal -->

    <div class="modal fade fade" id="coupan-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true" role="dialog" >
        <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="focusMe" />
              <span id="cpErrHere" class="fw-bold text-danger"></span>
              <div class="inputSearch d-flex justify-content-center align-items-center">
                <input type="text" placeholder="Enter coupon code"  id="coupan" name="coupan">
                <button type="button" class="modelBtn" id="applyButton" onclick="apply()">Apply</button>
              </div>
              <div class="coupen-card-section P-3 pt-1">
                <h5 class="heading my-3">AVAILABLE COUPONS</h5>
                <?php 
                  $images = $this->db->get_where('coupon', ['secret'=>0])->result();
                        
                    foreach($images as $i){ 
                        
                   $image_path = base_url($i->image); ?> 
                
                   <div class="card mb-2">
                    <div class="coupen-head p-2 d-flex align-items-center">
                        <h4 class="">Flat <?= $i->percent ?>% OFF</h4>
                    </div>
                    <p class="elli"><?= strip_tags($i->terms); ?></p>
                    <button type="button" class="btn ms-2 btn-outline-primary apply-coupon" onclick="$('#coupan').val('<?=$i->name;?>'), $('#applyButton').click();">Apply coupon</button>
                  </div>
            <?php   }  ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      
      <div class="modal fade fade" id="coupan-sucess-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true" role="dialog" >
        <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="btn-close" onclick="coupan_sucess_close()" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="focusMe" />
              <span id="cpErrHere" class="fw-bold text-danger"></span>
             
              <div class="coupen-card-section P-3 pt-1">
                 <img id="myImg" src="<?= base_url(); ?>assets/img/123.gif" alt="Snow" style="width:100%;max-width:600px">
              </div>
            </div>
          </div>
        </div>
      </div>

    

    

    <!-------------------DO NOT REMOVE THIS FORM :: END---------------------------->

    

    <form  method="post" action="<?= base_url(); ?>Checkout/do_payment" id="lastForm">

        <input type="hidden" name="only_security_amount" value="" id="lastFormHere" />

    </form>

    

    <!-------------------DO NOT REMOVE THIS FORM :: END---------------------------->





    <script>

    var chk = 0;

     var total_days = <?=$total_days;?>;

    

     var pickadd = getCookie('pickup');

     if(pickadd)

     {

         $("#addbox").html(pickadd);

        // $("#homedelivery").prop('checked',true);

     }else{

         $("#addbox").html('');

     }

     $("#homedelivery").change(function(){ 
        
         if($(this).is(":checked"))

         {

            $(".add-box").removeClass("d-none");
            $(".home_delivery_tab").removeClass("d-none");
              
            var pay = $(".final_payvls").val();
            var hod = $(".hod").val();
            var final  =  parseInt(pay)+parseInt(hod);
            var token = parseInt((final*25)/100);
            
            
            $(".final_paycls").text(final);
            $(".token_text").text(token);
            
            $(".remeain_amount").text(final-token);
              $("#btnpays").html("Pay Now  ₹"+token);

              $("#btnpayss").html("Pay Now  ₹"+token);
              
            addSesstion(final,token,1);


             console.log('0000----',parseInt(pay)+parseInt(hod));
              
         }
     });  
     
     $("#option1").click(function(){ 
        
        $(".add-box").addClass("d-none");
        $(".home_delivery_tab").addClass("d-none");
        
            var pay = $(".final_payvls").val();
            var final  =  parseInt(pay);
            var token = parseInt((final*25)/100);
            
            
            $(".final_paycls").text(final);
            $(".token_text").text(token);
            
            $(".remeain_amount").text(final-token);
            
              $("#btnpays").html("Pay Now  ₹"+token);

              $("#btnpayss").html("Pay Now  ₹"+token);
              
               addSesstion(final,token,0);

        
     });
     
     
     

    function addSesstion(final,token,honedelevary)
    {
             $.ajax({
    
                url: "<?php echo base_url(); ?>/ajax/save_session",
    
                type: "post",
    
                data: {final,token,honedelevary},
    
                dataType:'json',
    
                success: function(d) {
    
                }
    
            });
    
     }
     

     $("#fullpay").change(function(){ 

        //  var tkn =$(this).attr("data-token");

        //  var full =$(this).attr("data-full");

       var  full  = $(".final_paycls").text();
       var  tkn =  $(".token_text").text();

         if($(this).is(":checked"))

         {

             chk = 1;

             $("#btnpays").html("Pay Now  ₹"+full);

             $("#btnpayss").html("Pay Now  ₹"+full);

         }else{

             chk = 0;

              $("#btnpays").html("Pay Now  ₹"+tkn);

              $("#btnpayss").html("Pay Now  ₹"+tkn);

         }

     });

     

     

     function makeMeVoid(){

         $("#lastFormHere").val(chk);

         $("#lastForm").submit();

     }

     

     

     

     function save_address()

     {

         var address = $("#address").val();

         if(address)

         {   

             $("#addbox").html(address);

             $("#address").val('');

             $(".add-box").addClass("d-none");

             setCookie('pickup',address,3);
             
             $.ajax({

                url: "<?php echo base_url(); ?>/ajax/save_address",

                type: "post",

                data: {address},

                dataType:'json',

                success: function(d) {

                }

            });

         }else{

             alert("please enter car pickup location");

         }

     }

     

     
     function coupan_sucess_close()
     {
           // alert('jat');
                        // $('#coupan-modal').modal('hide');
                         $('#coupan-su  cess-modal').modal('hide'); 

                        window.location.href='';
     }

     function apply()

     {
        $("#cpErrHere").text("");
         var coupan = $("#coupan").val();

         if(coupan)

         {   

             $.ajax({

                url: "<?php echo base_url(); ?>/ajax/check_coupon",

                type: "post",

                data: {coupan,total_days},

                dataType:'json',

                success: function(d) {

                     if(d.status=='success'){
                         //alert('bhu');
                         $('#coupan-modal').modal('hide');
                         $('#coupan-sucess-modal').modal('show'); 
                         
                         setTimeout(() => {
                         $('#coupan-sucess-modal').modal('hide'); 

                        window.location.href='';
                        }, 3000)


                       //  window.location.href='';
                     }else{
                        $("#cpErrHere").html(d.mgs);
                        $("#coupan").focus();
                     }

                }

            });

            

         }else{

             alert("please enter coupan");

         }

     }
     

     function removeCope(){
         $.ajax({
            url: "<?php echo base_url(); ?>/ajax/removeCoupon",
            type: "post",
            data: {},
            dataType:'json',
            success: function(d) {
                window.location.href='';
            }
        });
     }


    </script>



    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>



    <script>

        function makeMeVoid2(){
        
            
           var finll= $(".final_paycls").text();
           var tokenn = $(".token_text").text();
           
           
         var fare = chk == 1 ? finll:tokenn;
         //window.location.href="/checkout/pay_razor?is_full="+chk;
            const rzp_options = {
                key: "rzp_live_sXpBhpkf76P5V4",

                amount: fare * 100,
                //amount: 1 * 100,

                name: "VeekayCabs",

                description: "VeekayCabs Car Rental Services",

                handler: function(response) {

                    console.log(response);

                    $.ajax({

                        url: "<?php echo base_url(); ?>/checkout/pay_razor_success?only_security="+chk,
 
                        type: "post",

                        data: {id : response.razorpay_payment_id},

                        dataType:'json',

                        success: function(d
                        ) {
                             if(d.status=='success')
                             {
                                window.location.href="/account/thankyou?order="+'<?=$this->session->userdata("unique_order_id");?>';
                             }else{
                                 alert(d.message);
                                 location.reload();

                             }

                        }

                    });

                },

                modal: {

                    ondismiss: function() {

                        alert(`Payment Failed or Dismissed`);

                    }

                },

                prefill: {

                    email: 'test@email.com',

                    contact: '+914455667788'

                },

                notes: {

                    name: "Customer Name",

                    item: "Null",

                },

                theme: {

                    color: "#FF6224"

                },

                payment_capture: '1',

                image: 'https://veekaycabs.com/assets/img/logo.png',

                currency: 'INR',

                methods: {

                    netbanking: true,

                    card: true,

                    wallet: true,

                    upi: true,

                },

                razorpay_payment_id: function(response) {

                    console.log("Payment ID: ", response);

                },

                razorpay_error: function(error) {

                    console.log("Payment Error: ", error);

                },

                razorpay_cancel: function() {

                    alert("Payment Cancelled");

                }

            };

            const rzp1 = new Razorpay(rzp_options);

            rzp1.open();

        }


    
    </script>

    <style>
        .add-contents{
            font-size: 15px;
            font-weight: 600;
            width: 83%;
            margin: 10px auto;
        }
    </style>






               

  