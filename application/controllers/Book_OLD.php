<?php 
    // print('ji00');die;
    $pick_data = $this->db->get_where('settings', "settings_id=12 OR settings_id=13 OR settings_id=14")->result();
    // print_r($pick_data);die;
      $pick_start_time = $pick_end_time = $price_increase_percentage = "";
    //   print_r($pick_start_time);die;
      foreach($pick_data as $p){ 
         if($p->settings_id == 12){
            $pick_start_time = $p->description;
         }
         elseif($p->settings_id == 13){
            $pick_end_time = $p->description;
         }
         elseif($p->settings_id == 14){
            $price_increase_percentage = $p->description;
         }

  }  ?>

  <style>
   
   h5{
      color: #1f1f1f;
      padding: 0;
      font-weight: 500;
      font-size: 16px;
   }
   
   .ellipsis{
      font-size: 13px;
      color: #000;
      border-radius: 2px;
      padding: 2px 4px;
   }

   .text {
      font-size: 12px;
   }
   
   .price-bar{
      white-space: nowrap;
      font-size: 18px;
      font-weight: 500;
      color: #1f1f1f;
   }

   .img-fluid{
      width: 70%;
   }
   #car_category .col-md-2{
      margin: 2px 10px !important;
   }
   
   .btn{
       background: linear-gradient(145deg, rgba(20,201,148,0.8),rgb(6,135,167)) !important;
   }
   .book{
       border: none !important;
       background: linear-gradient(145deg, rgba(20,201,148,0.8),rgb(6,135,167)) !important;
   }
   
   .card{
       box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px !important;
   }
   
   #filterModal .form-control {
        /* background: rgba(220,220,220,0.5); */
        background: linear-gradient(145deg, rgba(20,201,148,0.8),rgb(6,135,167)) !important;
        color: white !important;
        border-radius: 20px !important;
        padding: 3.5% 10% !important;
    }

@media (max-width:  500px)
{
  
  #filterModal .form-control {
    width: 100% !important;
  }

}
</style>
          
<main id="main" class="book_car">
   <div class="container">

     
      <div class="row">
   
   <div class="col-md-12 mt-2" id="search">
             
<nav aria-label="breadcrumb" class="">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Book Cars</li>
  </ol>
</nav>
      <form action="<?= base_url(); ?>Book" method="get" id="searchCarForm">

         <?php if(isset($_GET['city'])){ ?>
        <div class="booking-filter">
         <div class="input-group ">
        
            <div class="input-group-prepend">
               <span class="input-group-text p-3"><i class='bx bxs-map'></i></span>
            </div>
            <select class="form-control p-2 city_name" name="city" id="get_city">
               <option value="" disabled>Pick up City, Airport, Address or Hotel </option>
               <?php foreach($city as $p){ ?>
                  <option value="<?= $p->city_id; ?>" <?php if($_GET['city'] == $p->city_id){ echo "selected"; } ?> >
                     <?= $p->name; ?>
                  </option>
               <?php } ?>
            </select>
         </div>

         <div class="input-group mt-3" id="phone_date" style="overflow:hidden;">
            <div class="input-group-prepend">
               <span class="input-group-text p-3"><i class='bx bx-calendar-check'></i></span>
            </div>
            
            <div class="row" id="dates_hai">
               
               <div class="col-md-6">

                  <input type="text" name="start" id="start-date" minlength="<?= date('Y-m-d'); ?>" autocomplete="off" autosave="off" class="form-control date-input cal_date" required  style="border: none !important; background-color:#fff;" value="<?= date('d-m-Y H:i', strtotime($_GET['start'])); ?>" readonly  />

               </div>

               <div class="col-md-6">

                  <input type="text" name="end" id="end-date" class="form-control date-input cal_date"  autocomplete="off" autosave="off" required style="border: none !important;background-color:#fff;" value="<?= date('d-m-Y H:i', strtotime($_GET['end'])); ?>" readonly  />
                 
               </div>
                
            </div>
            
         </div>
         <button type="submit" class="mobile-go-btn">GO</button> 
         <?php } else { ?>
         <div class="input-group mb-3">
            <div class="input-group-prepend">
               <span class="input-group-text p-3"><i class='bx bxs-map'></i></span>
            </div>
            <select class="form-control pr-3 city_name" required name="city" id="get_city">
               <option value="" selected disabled>Select City</option>
               
               <?php foreach($city as $p){ ?>

                  <option value="<?= $p->city_id; ?>" >
                     <?= $p->name; ?>
                   </option>
                  
               <?php } ?>
            
            </select>
         </div>
        
         <div class="input-group" id="phone_date">
            <div class="input-group-prepend">
               <span class="input-group-text p-3"><i class='bx bx-calendar-check'></i></span>
            </div>
            <div class="row" id="dates">
               
               <div class="col-md-6">

                  <input type="text" name="start" id="start-date" minlength="<?= date('Y-m-d'); ?>" autocomplete="off" autosave="off" class="form-control date-input" required readonly  style="border: none !important;" value="<?= date('d-m-Y H:i', time()+7200); ?>"  />

               </div>

               <div class="col-md-6">

                  <input type="text" name="end" id="end-date" class="form-control date-input"  autocomplete="off" autosave="off" required style="border: none !important;" readonly value="<?= date('d-m-Y H:i', time()+18000); ?>" />

               </div>
            </div>
         </div>
         <?php } ?>
          </div>

         <div class="col-md-12" id="car_category">
            
            <div class="card">
                <input type="hidden" name="latitude" class="latitude">
                <input type="hidden" name="longitude" class="longitude">
               <div class="card-body row">
                  <div class="col-md-2 ">

                     <select class="form-control radius" name="fuel">
                        <option value="">Select Fuel Type </option>
                        <option value="Petrol" <?= (isset($_GET['fuel']) && $_GET['fuel'] == 'Petrol') ? 'selected' : '' ?> >Petrol</option>
                        <option value="Diesel" <?= (isset($_GET['fuel']) && $_GET['fuel'] == 'Diesel') ? 'selected' : '' ?> >Diesel</option>
                        <option value="CNG" <?= (isset($_GET['fuel']) && $_GET['fuel'] == 'CNG') ? 'selected' : '' ?> >CNG</option>
                     </select>
                  </div>

                  <div class="col-md-2 ">

                     <select class="form-control radius" name="seats">
                        <option value="">Select Seats </option>
                        <option value="5" <?= (isset($_GET['seats']) && $_GET['seats'] == '5') ? 'selected' : '' ?> >5</option>
                        <option value="6" <?= (isset($_GET['seats']) && $_GET['seats'] == '6') ? 'selected' : '' ?> >6</option>
                        <option value="7" <?= (isset($_GET['seats']) && $_GET['seats'] == '7') ? 'selected' : '' ?> >7</option>
                     </select>
                  </div>

                  <div class="col-md-2 ">
                     <select class="form-control radius" name="car_type">
                        <option value="">Select Car Type </option>
                        <option value="SUV" <?= (isset($_GET['car_type']) && $_GET['car_type'] == 'SUV') ? 'selected' : '' ?> >SUV</option>
                        <option value="Hatch Back" <?= (isset($_GET['car_type']) && $_GET['car_type'] == 'Hatch Back') ? 'selected' : '' ?> >Hatch Back</option>
                        <option value="Sedan" <?= (isset($_GET['car_type']) && $_GET['car_type'] == 'Sedan') ? 'selected' : '' ?> >Sedan</option>
                     </select>
                  </div>

                  <div class="col-md-2 ">
                     <select class="form-control radius" name="transmission">
                        <option value="">Select Transmission </option>
                        <option value="Manual" <?= (isset($_GET['transmission']) && $_GET['transmission'] == 'Manual') ? 'selected' : '' ?> >Manual</option>
                        <option value="Automatic" <?= (isset($_GET['transmission']) && $_GET['transmission'] == 'Automatic') ? 'selected' : '' ?> >Automatic</option>
                     </select>
                  </div>

                  <div class="col-md-4">
                     <button type="submit" id="find-cars" class="btn btn-block text-white" >Search Car</button>
                  </div>

               </div>
               
            </div>
         </div>

      </form>
      
      <?php
            @$this->db->order_by("id", "desc"); $offer = @$this->db->get("offer_banner")->result();

            foreach($offer as $offer){ ?>

          <div class="col-12 mobile_banner">
              <img alt="happyeasyrides"  class="lozad" data-src="<?= base_url($offer->mobile_banner); ?>" style="width: 100%;border-radius: 20px;" loading="lazy"/>
          </div>
          <div class="col-12 desktop_banner" style="display: none"> 
              <img alt="happyeasyrides"  class="lozad" data-src="<?= base_url($offer->desktop_banner); ?>" style="width: 100%;border-radius: 20px;" loading="lazy"/>
          </div>
      
      <?php } ?>

      <div class="col-md-12 mt-4 car-listing-view">

        <?php  if(isset($_GET['city'])){
               
            $date_now = new DateTime($_GET['start']);
            
            $date_convert = new DateTime($_GET['end']);

            if ($date_convert > $date_now) {

                if(!empty($car)){ 
                    
                    if(isset($_GET['start']) && $_GET['end']){
                       $getStart = date("Y-m-d H:i:s", strtotime($_GET['start']));
                       $getEnd = date("Y-m-d H:i:s", strtotime($_GET['end']));
                    }
                          
                    $car_array = [];
                   
                    // echo"<pre>";print_r($car);die;
                    
                    foreach($car as $c){  
                        $availability = "available";
                        $card_opacity = 1.0;
                        $checkIfCarBooked = 0;
                        $car_id = $c->car_id;
                        
                        $diff_begin = new DateTime($getStart);
                        $diff_end = new DateTime($getEnd);
                        $interval = DateInterval::createFromDateString('1 hour');
                        $period_diff = new DatePeriod($diff_begin, $interval, $diff_end);
                        
                        $dateDiff = null;
                        $i = 0;
                        
                        foreach ($period_diff as $k => $dt) 
                        {
                            $dateDiff = $dt->format("Y-m-d H:i:s");
                        }
                        
                        
                       
                        $wher = [
                            "availability >=" => $diff_begin->format("Y-m-d H:i:s"), 
                            "car_id" => $car_id, 
                            "payment_status" => 1,
                            "start <" => $diff_end->format("Y-m-d H:i:s"), //start datetime of booked car is less than end datetime
                        ];
                           
                           
                        if( $car_id == 280 ){
                            // print_r('iiijiji');
                            // print_r($dateDiff);
                            // print_r($wher);
                            // print_r($diff_begin);
                            // print_r($diff_end);
                            // die;
                        }
                        
                        $checkSql = $this->db->get_where("booking", $wher)->num_rows();
                        // print_r($checkSql);die;
                        
                        if($checkSql > 0){
                           $checkIfCarBooked = 1;
                        }
                       
                        // print_r('$checkIfCarBooked'.$checkIfCarBooked);die;
                       
                       if($checkIfCarBooked > 0){
                           continue; 
                       }
                      
                       if(($c->sold_from!="0000-00-00 00:00:00")&&($c->sold_to!="0000-00-00 00:00:00")) {
                           foreach ($period_diff as $dt) {
                               $dateDiff = $dt->format("Y-m-d H:i:s");
                               if( ($dateDiff >= $c->sold_from) && ($dateDiff <= $c->sold_to) ){
                                   $availability = "booked";
                               }
                           }
                       }
    
                       $isHide = 0;
                       
                       $car_hide_detail = $this->db->where('car_id', $c->car_id)->get('car_hide_history')->result();
                       
                    //   print_r($car_hide_detail);die;
                       
                       
                       $hideArr = [];
                       
                        foreach($car_hide_detail as $ch_key => $ch_value)
                        {
                           if(($ch_value->hide_from!="0000-00-00 00:00:00")&&($ch_value->hide_to!="0000-00-00 00:00:00")) 
                           {
                            //   print_r($period_diff);die;
                               
                            //   print('in');die;
                                foreach ($period_diff as $dt) {
                                   $dateDiff = $dt->format("Y-m-d H:i:s");
                                //   print_r($dateDiff);die;
                                   
                                // print($ch_value->hide_from);die;
                                     // todo
                                        //   if( ($dateDiff >= $ch_value->hide_from) && ($dateDiff <= $ch_value->hide_to) ){
                                        //       $isHide=1;
                                               
                                        //       array_push($hideArr, $isHide);
                                        //   }
                                }
                               
                           }
                           
                        }
                       
                        // print_r($hideArr);die;
                        
                        // print('out');die;
                        
                        /*if(($c->hide_from!="0000-00-00 00:00:00")&&($c->hide_to!="0000-00-00 00:00:00")) {
                           foreach ($period_diff as $dt) {
                               $dateDiff = $dt->format("Y-m-d H:i:s");
                               if( ($dateDiff >= $c->hide_from) && ($dateDiff <= $c->hide_to) ){
                                   $isHide=1;
                               }
                           }
                        }*/
                       
                       
                        // print( in_array(1, $hideArr) );die;
                       
                        /*if($isHide > 0){
                           continue;
                        }*/
                        
                        if( in_array(1, $hideArr) )
                        {
                            continue;
                        }
                       
                        $arr = [
                           "name"=>str_replace(' ', '', $c->name), 
                           "place"=>str_replace(' ', '', $c->place), 
                           "transmission"=>$c->transmission, 
                           "fuel"=>$c->fuel, 
                           "seats"=>$c->seats, 
                           "availability"=>$availability
                        ];
                       
                       if(in_array($arr, $car_array)) {
                           continue;
                       }
    
                        array_push($car_array, $arr); 
                   ?>
        
                <?php //print_r($car_array);die; ?>
    
                <div class="card" style="opacity: <?= $card_opacity; ?>;">
                   <div class="card-body">
                      <div class="image">
                         <img alt="happyeasyrides" data-src="<?= base_url().$c->image; ?>" class="img-fluid lozad" >
                      </div>
                       <h5 class="mt-2"><?= $c->name; ?></h5>
                      <div class="detail">
                        
                         <div class="car-details1">
                         <small class="text-dark desc"><?= $c->description; ?></small>
                         <p class="text-muted seater car-details-inner" >
                            <img alt="happyeasyrides" data-src="<?= base_url("assets/manual.svg"); ?>"  class="lozad" /> 
                            <?= $c->transmission; ?>, 
                            
                            <img alt="happyeasyrides" data-src="<?= base_url("assets/fuel.svg"); ?>"  class="lozad" /> 
                            <?= $c->fuel; ?>. 
                            
                            <img alt="happyeasyrides" data-src="<?= base_url("assets/seat.svg"); ?>"  class="lozad" /> 
                            <?= $c->seats; ?> Seats
                         </p>
                         </div>
                         <hr/>
                         <p class="text-muted text car-infos1">
                            <i class="fas fa-car"></i> 
                             <b>Self pickup from :</b>
                            <span><?= $c->place ?></span>
                            
                           
                         </p>
                      </div>
                      <div class="booking-button">
                         <div id="price">
                            <h4 class="mt-4 price-bar">
                                <i class='bx bx-rupee'></i> 
                                <?php
                                      $start = new DateTime($_GET["start"]);
                                      $end = new DateTime($_GET["end"]);
                                      $interval = DateInterval::createFromDateString('1 hour');
                                      $period = new DatePeriod($start, $interval, $end);
                                      $overall_fare = 0;
    
                                      foreach ($period as $dt) {
                                          
                                          $date_day = $dt->format("l"); 
                                          
                                          if($date_day=="Saturday" || $date_day=="Sunday"){
                                              $overall_fare = $overall_fare+$c->weekend_price;
                                          }else{
                                              $overall_fare = $overall_fare+$c->price;
                                          }
                                          
                                          $dateDiff2 = $dt->format("Y-m-d H:i:s");
    
                                          $percentToApply = $percentAddon = 0;
                                          
                                          if($dateDiff2 >= $pick_start_time && $dateDiff2 <= $pick_end_time){
                                              $percentToApply = $price_increase_percentage;
                                          }
                                          
                                          if($percentToApply > 0){
                                           $percentAddon = (($overall_fare*$percentToApply)/100);
                                          }
                                      }
                                ?>
                                <?= number_format($overall_fare+$percentAddon); ?>
                            </h4>
                         </div>
                         <?php //echo $availability?>
                         <?php
                            if($availability == "booked"){
                         ?>
                            <a class="btn book mt-5 car_book" style="color:red;background:#fff !important;">
                                Sold Out <?php //echo $c->sold_from;  ?>
                            </a>
                         <?php  }else{ ?>
    
                         <a href="<?= base_url(); ?>Ford?car_id=<?= $c->car_id.'&&'.$_SERVER['QUERY_STRING']; ?>" class="btn book mt-5 car_book book_now_bnt">book now</a>
                         <?php }  ?>
                      </div>
                   </div>
                </div>
    
              <?php }  
                    
                    // print_r($car);die;
                    
                    foreach($car as $c) {  
                    
                    $availability = "booked";  
                    $card_opacity = 0.8;  
                    $checkIfCarBooked = 0;  
                    $car_id = $c->car_id;
                    
                    $diff_begin = new DateTime($getStart);
                    $diff_end = new DateTime($getEnd);
                    $interval = DateInterval::createFromDateString('1 hour');
                    $period_diff = new DatePeriod($diff_begin, $interval, $diff_end);
                    
                    
                    
                    foreach ($period_diff as $dt) {
                        $dateDiff = $dt->format("Y-m-d H:i:s");
                        break;
                        // $wher = ["start <="=>$dateDiff, "availability >="=>$dateDiff, "car_id"=>$car_id, "payment_status"=>1];
                        // $checkSql = $this->db->get_where("booking", $wher)->num_rows();
                        // if($checkSql > 0){
                        //     $checkIfCarBooked = 1;
                        // }
                    }
                    
                    
                    
                    
                    $wher = [
                        //   "start <="=>$dateDiff, 
                        //   "availability >="=>$dateDiff, 
                        "availability >="=>$diff_begin->format("Y-m-d H:i:s"),
                       "car_id"=>$car_id, 
                       "payment_status"=>1
                    ];
                    
                    
                       
                    $checkSql = $this->db->get_where("booking", $wher)->num_rows();

                    
                    
                    
                    if($checkSql > 0){
                        $checkIfCarBooked = 1;
                    }
                   
                    if($checkIfCarBooked == 0){
                        continue;
                    }
                    
                    
                    
                    
                    if(($c->sold_from!="0000-00-00 00:00:00")&&($c->sold_to!="0000-00-00 00:00:00")) {
                       foreach ($period_diff as $dt) {
                           $dateDiff = $dt->format("Y-m-d H:i:s");
                           if( ($dateDiff >= $c->sold_from) && ($dateDiff <= $c->sold_to) ){
                               $availability = "booked";
                           }
                       }
                    }else{
                        // $availability = "available";
                    }
                    
                    if($car_id == 280){
                        // print_r('hauaa');
                        // print_r($diff_begin);
                        // print_r($diff_end);
                        // print_r($interval);
                        // print_r($dateDiff);
                        // print_r($wher);
                        // print_r($c->sold_from);
                        // print_r($c->sold_to);
                        // print_r($availability);
                        // print_r($c->sold_from!="0000-00-00 00:00:00");
                        // die;
                    }
    
                   $isHide = 0;
                   if(($c->hide_from!="0000-00-00 00:00:00")&&($c->hide_to!="0000-00-00 00:00:00")) {
                       foreach ($period_diff as $dt) {
                           $dateDiff = $dt->format("Y-m-d H:i:s");
                           if( ($dateDiff >= $c->hide_from) && ($dateDiff <= $c->hide_to) ){
                               $isHide=1;
                           }
                       }
                   }
                   
                   if($isHide > 0){
                       continue;
                   }
                    
                    
                    $arr = ["name"=>str_replace(' ', '', $c->name), "place"=>str_replace(' ', '', $c->place), "transmission"=>$c->transmission, "fuel"=>$c->fuel, "seats"=>$c->seats];
                    
                    if(in_array($arr, $car_array)) { continue;  }
                      
                   array_push($car_array, $arr); ?>
    
                <div class="card" style="opacity: <?= $card_opacity; ?>;">
                   <div class="card-body">
                      <div class="image">
                         <img alt="happyeasyrides" data-src="<?= base_url().$c->image; ?>" class="img-fluid lozad" >
                      </div>
                       <h5 class="mt-2"><?= $c->name; ?></h5>
                      <div class="detail">
                         <div class="car-details1">
                         <small class="text-dark desc"><?= $c->description; ?></small>
                         <p class="text-muted seater car-details-inner">
                            <img alt="happyeasyrides" data-src="<?= base_url("assets/manual.svg"); ?>" class="lozad"/> 
                            <?= $c->transmission; ?>, 
                            
                            <img alt="happyeasyrides" data-src="<?= base_url("assets/fuel.svg"); ?>" class="lozad"/> 
                            <?= $c->fuel; ?>. 
                            
                            <img alt="happyeasyrides" data-src="<?= base_url("assets/seat.svg"); ?>" class="lozad"/> 
                            <?= $c->seats; ?> Seats
                         </p>
                          </div>
                         <hr/>
                         <p class="text-muted text car-infos1">
                            <i class="fas fa-car"></i> 
                             <!--<b>Self pickup from :</b>-->
                             <span><?= $c->place ?></span>
                            
                            <!--<?php if($c->distance > 0){ ?>-->
                            <!--    (<span><b><?= $c->distance ?? 0 ?> KM</b></span>)-->
                            <!--<?php }?>-->
                         </p>
                      </div>
                      <div class="booking-button">
                         <div id="price">
                            <h4 class="mt-4 price-bar">
                                <i class='bx bx-rupee'></i> 
                                <?php
                                      $start = new DateTime($_GET["start"]);
                                      $end = new DateTime($_GET["end"]);
                                      $interval = DateInterval::createFromDateString('1 hour');
                                      $period = new DatePeriod($start, $interval, $end);
                                      $overall_fare = 0;
    
    
                                      foreach ($period as $dt) {
                                          $date_day = $dt->format("l"); 
                                          if($date_day=="Saturday" || $date_day=="Sunday"){
                                              $overall_fare = $overall_fare+$c->weekend_price;
                                          }else{
                                              $overall_fare = $overall_fare+$c->price;
                                          }
                                      }
                                ?>
                                <?= $overall_fare; ?>
                            </h4>
                         </div>
                         <?php
                            if($availability == "booked"){
                         ?>
                            <a class="btn book mt-5 car_book" style="color:red;background:#fff !important;">
                                Sold Out <?php //echo $c->sold_from;  ?>
                            </a>
                         <?php  }else{ ?>
    
                         <a href="<?= base_url(); ?>Ford?car_id=<?= $c->car_id.'&&'.$_SERVER['QUERY_STRING']; ?>" class="btn book mt-5 car_book book_now_bnt">book now</a>
                         <?php }  ?>
                         
                      </div>
                   </div>
                </div>
    
              <?php }
              
                
                }else { ?>
                    <div class="col-md-12 my-5"> 
                        <h2 class="text-white text-center">Sorry, but Car Not Available!</h2>
                    </div>
    
              <?php }
            } else { ?>

                <div class="col-md-12 my-5"> 
                   <h2 class="text-white text-center">Please Select Correct Date Range</h2>
                </div>
                
            <?php  }  
        }else { ?> 

            <div class="col-md-12 my-5"> 
               <h2 class="text-white text-center">Please Select Destination </h2>
                </div>
        <?php } ?>
      
      </div>
   </div>
   
   </div>
   </div>
</main>

<style>
    .bottom_fix{
        display: none;
        position: fixed;
        bottom: 0;
        /*left: 10;*/
        text-align: center;
        padding: 10px 10px;
        width: 100%;
        background: linear-gradient(rgba(20,201,148,1),rgba(6,135,167,1)) !important;
        font-size: 16px;
        border: 1px solid #ccc;
        color: #fff;
        text-transform: uppercase;
        /*border-radius: 20px 20px 0px 0px;
        opacity: 0.9;*/
    }
    @media only screen and (max-width: 600px) {
        .bottom_fix{
            display: block; 
        }
    }
</style>
<div class="bottom_fix" data-bs-toggle="modal" data-bs-target="#filterModal">
    <i class="fa fa-filter"></i> Filter Cars
</div>
<!-- Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Filter Cars</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <form class="car-listing-page" action="<?= base_url(); ?>Book" method="get" id="book-form">

        
         <input type="hidden" name="city" value="<?= $_GET["city"] ?>"/>
         <input type="hidden" name="start" value="<?= $_GET["start"] ?>"/>
         <input type="hidden" name="end" value="<?= $_GET["end"] ?>"/>
        
         <div class="col-md-12">
            
            
               <div class="card-body row">
                  <div class="col-md-2 ">

                     <select class="w-100 p-2 mb-2 form-control" name="fuel">
                        <option value="">Select Fuel Type </option>
                        <option value="Petrol" <?= (isset($_GET['fuel']) && $_GET['fuel'] == 'Petrol') ? 'selected' : '' ?> >Petrol</option>
                        <option value="Diesel" <?= (isset($_GET['fuel']) && $_GET['fuel'] == 'Diesel') ? 'selected' : '' ?> >Diesel</option>
                        <option value="CNG" <?= (isset($_GET['fuel']) && $_GET['fuel'] == 'CNG') ? 'selected' : '' ?> >CNG</option>
                     </select>
                  </div>

                  <div class="col-md-2 ">

                     <select class="w-100 p-2 mb-2 form-control" name="seats">
                        <option value="">Select Seats </option>
                        <option value="5" <?= (isset($_GET['seats']) && $_GET['seats'] == '5') ? 'selected' : '' ?> >5</option>
                        <option value="6" <?= (isset($_GET['seats']) && $_GET['seats'] == '6') ? 'selected' : '' ?> >6</option>
                        <option value="7" <?= (isset($_GET['seats']) && $_GET['seats'] == '7') ? 'selected' : '' ?> >7</option>
                     </select>
                  </div>

                  <div class="col-md-2 ">
                     <select class="w-100 p-2 mb-2 form-control" name="car_type">
                        <option value="">Select Car Type </option>
                        <option value="SUV" <?= (isset($_GET['car_type']) && $_GET['car_type'] == 'SUV') ? 'selected' : '' ?> >SUV</option>
                        <option value="Hatch Back" <?= (isset($_GET['car_type']) && $_GET['car_type'] == 'Hatch Back') ? 'selected' : '' ?> >Hatch Back</option>
                        <option value="Sedan" <?= (isset($_GET['car_type']) && $_GET['car_type'] == 'Sedan') ? 'selected' : '' ?> >Sedan</option>
                     </select>
                  </div>

                  <div class="col-md-2 ">
                     <select class="w-100 p-2 mb-2 form-control" name="transmission">
                        <option value="">Select Transmission </option>
                        <option value="Manual" <?= (isset($_GET['transmission']) && $_GET['transmission'] == 'Manual') ? 'selected' : '' ?> >Manual</option>
                        <option value="Automatic" <?= (isset($_GET['transmission']) && $_GET['transmission'] == 'Automatic') ? 'selected' : '' ?> >Automatic</option>
                     </select>
                  </div>

                  <div class="col-12 mt-4">
                     <button type="submit" id="find-cars2" class="btn book btn-block" >Search Car</button>
                  </div>

               </div>
               
            </div>
         </div>

      </form>
        
      
    </div>
  </div>
</div>


<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjWvgyaXwhdSTSLXhFlQSIgpy8u2m4bZ8&callback=initMap&libraries=places&v=weekly"></script>


<script>
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        $("#car_category").remove();   
        $(".desktop_banner").remove();
        
        $(document).on("change", ".cal_date", function(){
            // window.setTimeout( searchCarForm, 3000 ); //3 seconds
        });
        function searchCarForm(){
          checkForHours();
        };
        
    }else{
        $(".mobile_banner").remove();
        $("#mob_search_btn").remove();
    }

   
   lozad('.lozad', {
        load: function(el){
            el.src = el.dataset.src;
            el.onload=function(){
            }
        }
   }).observe()


    if (navigator.geolocation){
        navigator.geolocation.getCurrentPosition(function(position) {
            $('.latitude').val(position.coords.latitude);
            $('.longitude').val(position.coords.longitude);
        });
    }

</script>



