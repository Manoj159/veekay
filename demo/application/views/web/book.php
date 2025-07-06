<?php
$pick_data = $this->db->get_where('settings', "settings_id=12 OR settings_id=13 OR settings_id=14 OR settings_id=15 OR settings_id=16 OR settings_id=17")->result();
      $pick_start_time = $pick_end_time = $price_increase_percentage = "";
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
  ?>

<section class="header-bottom d-md-block">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-9 col-md-9">
                    <p class="tag-text">Modify Search</p>
                    <div class="d-flex">
                    <form action="<?= base_url(); ?>Book" method="get" id="searchCarForm">
                        <div class="filter-box-top d-flex">
                            <div class="filter-item location">
                                <select class="form-control p-2 city_name" name="city" id="get_city">
                                <option value="">Pick up City, Airport, Address or Hotel </option>
                                <?php foreach($city as $p){ ?>
                                    <option value="<?= $p->city_id; ?>" <?php if($_GET['city'] == $p->city_id){ echo "selected"; } ?> > <?= $p->name; ?></option>
                                <?php } ?>
                                </select>
                            </div>   
                            <div class="filter-item">
                                <input type="text" onchange="$('#startDateHere').val($(this).val());" name="start" id="start-date" minlength="<?= date('Y-m-d'); ?>"  class="start-timepicker" placeholder="2023-08-10 10:00"  required  value="<?= date('d-m-Y H:i', strtotime($_GET['start'])); ?>" readonly  />
                            </div>
                            <div class="filter-item">
                                <input type="text" onchange="$('#endDateHere').val($(this).val());" name="end" id="end-date"   class="end-timepicker cal_date" placeholder="2023-08-14 10:00" value="<?= date('d-m-Y H:i', strtotime($_GET['end'])); ?>" readonly required />
                            </div>
                       
                        <div class="filter-action">
                          <button type="submit" id="find-cars" class="btn btn-login action-btn">Modify Search</button> 
                            <!-- <a href="<?= base_url(); ?>assets/listing.html" class="btn btn-themed action-btn">Modify Search</a> -->
                        </div>
                        
                        <!-- <h6 class="days-selected">Total days selected <span>7 Days</span></h6> -->
                    </div>
                   </from>
                </div>
                
                <!-- <div class="col-lg-3">
                    <p class="tag-text">Km Plan</p>
                    <div class="plan-wrapper d-inline-flex">
                        <div class="km-item active">250 kms</div>
                        <div class="km-item">400 kms</div>
                        <div class="km-item">600 kms</div>
                    </div>
                </div> -->
            </div>
        </div>
    </section>

   

  
    
    <section class="content-wrapper"> 
        <div class="container">
            <div class="row">
            <form action="<?= base_url(); ?>Book" method="get" id="searchCarForm">
             <input type="hidden" name="city"  value="<?= $_GET['city']; ?>"   />
             <input type="hidden" name="start" id="startDateHere" value="<?= date('d-m-Y H:i', strtotime($_GET['start'])); ?>" readonly  />
             <input type="hidden" name="end"  id="endDateHere" value="<?= date('d-m-Y H:i', strtotime($_GET['end'])); ?>" readonly  />
                <div class="col-lg-3">
                    <div class="filter-sidebar">
                        <div class="head d-flex justify-content-between align-items-center">
                            <h5 style="color: #FF6224;">Filter</h5>
                        </div>
                        <div class="filter-box">
                            <h6>Car Segment</h6>
                            <div class="filter-items">
                                <div class="form-check">
                                    <input class="form-check-input" name="car_type" id="Sedan"  type="radio" value="Sedan" <?= (isset($_GET['car_type']) && $_GET['car_type'] == 'Sedan') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="Sedan"> Sedan </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="Hatchback" name="car_type" type="radio" value="Hatch Back" <?= (isset($_GET['car_type']) && $_GET['car_type'] == 'Hatch Back') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="Hatchback"> Hatch Back </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="car_type" id="suv" type="radio" value="SUV" <?= (isset($_GET['car_type']) && $_GET['car_type'] == 'SUV') ? 'checked' : '' ?> >
                                    <label class="form-check-label" for="suv"> SUV </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="car_type" id="muv" type="radio" value="MUV" <?= (isset($_GET['car_type']) && $_GET['car_type'] == 'MUV') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="muv"> MUV </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="luxury" name="car_type" type="radio" value="Luxury" <?= (isset($_GET['car_type']) && $_GET['car_type'] == 'Luxury') ? 'checked' : '' ?> >
                                    <label class="form-check-label" for="luxury"> Luxury </label>
                                </div>
                            </div>
                        </div>
                          <!-- 
                        <div class="filter-box">
                            <h6>Brand</h6>
                            <div class="filter-items">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="">
                                    <label class="form-check-label"> Maruti </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="">
                                    <label class="form-check-label"> Hyundai </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="">
                                    <label class="form-check-label"> Honda </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="">
                                    <label class="form-check-label"> Mahindra </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="">
                                    <label class="form-check-label"> Toyota </label>
                                </div>
                            </div>
                        </div> -->

                        <div class="filter-box">
                            <h6>Fuel Type</h6>
                            <div class="filter-items">
                                <div class="form-check">
                                    <input class="form-check-input" id="petrol" name="fuel" <?= (isset($_GET['fuel']) && $_GET['fuel'] == 'Petrol') ? 'checked' : '' ?> type="radio" value="Petrol">
                                    <label class="form-check-label" for="petrol"> Petrol </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="diesel" name="fuel"  <?= (isset($_GET['fuel']) && $_GET['fuel'] == 'Diesel') ? 'checked' : '' ?> type="radio" value="Diesel">
                                    <label class="form-check-label" for="diesel"> Diesel </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="cng" name="fuel"   <?= (isset($_GET['fuel']) && $_GET['fuel'] == 'CNG') ? 'checked' : '' ?> type="radio" value="CNG">
                                    <label class="form-check-label" for="cng"> CNG </label>
                                </div>
                            </div>
                        </div>

                        <div class="filter-box">
                            <h6>Transmission Type</h6>
                            <div class="filter-items">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="manual" value="Manual" name="transmission" <?= (isset($_GET['transmission']) && $_GET['transmission'] == 'Manual') ? 'checked' : '' ?> > 
                                    <label class="form-check-label" for="manual"> Manual </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="automatic" type="radio" value="Automatic"  name="transmission" <?= (isset($_GET['transmission']) && $_GET['transmission'] == 'Automatic') ? 'checked' : '' ?> >
                                    <label class="form-check-label" for="automatic"> Automatic </label>
                                </div>
                            </div>
                        </div>

                        <div class="filter-box">
                            <h6>Seating Capacity</h6>
                            <div class="filter-items">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="5Seater" name="seats" value="5" <?= (isset($_GET['seats']) && $_GET['seats'] == '5') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="5Seater"> 5 Seater </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="6Seater" type="radio" name="seats" value="6" <?= (isset($_GET['seats']) && $_GET['seats'] == '6') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="6Seater"> 6 Seater </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="7Seater" name="seats" value="7" <?= (isset($_GET['seats']) && $_GET['seats'] == '7') ? 'checked' : '' ?> >
                                    <label class="form-check-label" for="7Seater"> 7 Seater </label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="find-cars" class="btn btn-themed action-btn"> Search</button>
                    </div>
                </div>
                </form>
                <div class="col-lg-9">
                    <div class="content-area">  
                        <div class="content-head d-flex justify-content-between align-items-center d-block">
                            <h6 class="text-dark"> <?php  echo count($car) ;?> Cars available for rental</h6>
                            <div class="d-flex head-right">
                                <!-- <div class="item d-flex align-items-center">
                                    <p>Sort By</p> 
                                    <div class="dropdown sort-drop">
                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                      Last Added
                                    </a>
                                  
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                      <li><a class="dropdown-item" href="#">Action</a></li>
                                      <li><a class="dropdown-item" href="#">Another action</a></li>
                                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                  </div> 
                                </div> -->

                                <!-- <div class="item d-flex align-items-center">
                                    <p>Cars on page</p> 
                                    <div class="dropdown sort-drop">
                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                      12
                                    </a>
                                  
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                      <li><a class="dropdown-item" href="#">21</a></li>
                                      <li><a class="dropdown-item" href="#">24</a></li>
                                      <li><a class="dropdown-item" href="#">27</a></li>
                                    </ul>
                                  </div> 
                                </div> -->

                            </div>
                        </div>
                        <div class="row">
                            <div class="car-listing">
                               <?php  if(!empty($car)){ 
                                     $priceshow = 1;
                                        foreach($car as $c){  
                                     
                                            $start = new DateTime($_GET["start"]);
                                            $end = new DateTime($_GET["end"]);
                                            $interval = DateInterval::createFromDateString('1 hour');
                                            $period = new DatePeriod($start, $interval, $end);
                                            $overall_fare = 0;
                                            $booking = 0;
            
            
                                            foreach ($period as $dt) {
                                                $date_day = $dt->format("l"); 
                                                if($date_day=="Saturday" || $date_day=="Sunday"){
                                                    $overall_fare = $overall_fare+$c->weekend_price;
                                                }else{
                                                    $overall_fare = $overall_fare+$c->price;
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
                                                  $priceshow = 0;
                                                
                                            }
                                            
                                              $overallWithAnydiscount =  $overall_fare;
                                            
                                             if($percentDecrease > 0){
                                                
                                                $overall_fare = ($overall_fare-$percentDecrease);
                                              }else{
                                                   $priceshow = 0;
                                              }
                                            
                                            
                                        //     $bookings =  $this->db->get_where('booking', array('car_id'=>$c->car_id,'start >= '=>$_GET["start"],'payment_status'=>1,'status=1'))->result();
                                        //   // print_r($bookings );
                                        //      $booking = check_booking($bookings,$_GET["start"],$_GET["end"]);
                                          
                                        //      if($booking == 0){
                                        //          $s = date('Y-m-d H:i:s',strtotime($_GET["start"]));
                                        //          $e = date('Y-m-d H:i:s',strtotime($_GET["end"]));
                                                   
                                        //          $data = $this->db->query( "SELECT * 
                                        //             FROM car_hide_history 
                                        //             WHERE hide_from <= '$e' and car_id = '$c->car_id'  ")->result();
                                        //         if($data)
                                        //         {    foreach($data as $cd){
                                        //             if($cd->hide_to > $s)
                                        //             {
                                                       
                                        //                 $booking = 1;
                                        //                 break;
                                        //             }
                                        //         }
                                        //         }
                                        //      }
                                          ?>
                                          
                                          
                                        <?php 
                                        $postData=[];
                                         $url = 'https://happyeasyrides.com/book/checkBookCar?'.$_SERVER['QUERY_STRING'].'&vehicle_number='.$c->vehicle_number;
                                  
                                        $curl = curl_init();
                                        curl_setopt($curl, CURLOPT_URL, $url);
                                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                        curl_setopt($curl, CURLOPT_POST, true);
                                        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postData));
                                        $response = curl_exec($curl);
                                        if(curl_errno($curl)) {
                                          //  echo 'Error: ' . curl_error($curl);
                                        }
                                        
                                          $extraCars = json_decode($response, true);
                                          if(!empty($extraCars) > 0){
                                              if($extraCars["status"] == "success")
                                              {
                                                  
                                                 if($extraCars["data"]==1){
                                                      $booking=1;
                                                 }
                                           
                                              }
                                          }
                                     
                                    ?>
                                          
                                          
                                        <div class="car-card card"> 
                                            <div class="d-flex card-info-area">
                                                <div class="photo"> <img src="<?= base_url().$c->image; ?>"  alt="veekaycabs Self drive car rental" > </div>
                                                <div class="car-detail w-100">
                                                    <div class="title d-flex justify-content-between w-100">
                                                        <div class="car-name">
                                                            <h2><?php echo $c->name ; ?>  </h2>
                                                           
                                                            <p><?php echo $c->car_type ?><span class="viik_model"> (<?php echo $c->description ?>)</span></p>
                                                        </div>
                                                        <!--<div class="rating"> <span><img src="<?= base_url(); ?>assets/img/star.svg"  alt="veekaycabs Self drive car rental"  > 4.2</div>-->
                                                    </div>
                                                    <div class="km-price-info d-flex">
                                                        <p><?php echo $c->description ?></p>
                                                     <?php  if($priceshow==1){  ?>
                                                        
                                                          <h3 class="text-decoration-line-through">₹  <?= $overallWithAnydiscount; ?></h3>
                                        
                                                      <?php } ?>  
                                                        <h3>₹  <?= $overall_fare; ?></h3>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="car-info d-flex justify-content-between">
                                                <div class="car-item"> <img src="<?= base_url(); ?>assets/img/fuel.svg" alt="icon">   <?= $c->fuel; ?></div>
                                                <div class="car-item"> <img src="<?= base_url(); ?>assets/img/transmission.svg" alt="icon">  <?= $c->transmission; ?>, </div>
                                                <div class="car-item"> <img src="<?= base_url(); ?>assets/img/seat.svg" alt="icon">  <?= $c->seats; ?> Seater</div>
                                            </div>
                                            <div class="align-items-center d-flex footer justify-content-between mt-3">
                                                <div>
                                                <?php  if($priceshow==1){  ?>
                                                        
                                                          <h4 class="text-decoration-line-through">₹  <?= $overallWithAnydiscount; ?></h4>
                                        
                                                      <?php } ?>  
                                                            
                                                    <h4 class="price">₹ <?= $overall_fare; ?></h4>
                                                </div>
                                                
                                                
                                                <?php
                                                    if($booking == 1 || $c->booking_status==1){
                                                 ?>
                                                    <a class="btn book mt-2 car_book" style="color:red;background:#fff !important;">
                                                        Sold Out
                                                    </a>
                                                 <?php  }else{ ?>
                                                     <a href="<?= base_url(); ?>Ford?car_id=<?= $c->car_id.'&&'.$_SERVER['QUERY_STRING']; ?>" class="btn btn-themed">Book</a>
                                                 <?php }  ?>
                                                 
                                
                                                
                                            </div>
                                            
                                        </div>
                                 <?php } }else{ ?>
                                    <div class="row">
                                        <div class="car-listing">
                                            <div class="alert alert-info">
                                                <strong>Sorry!</strong> no any car available 
                                            </div>
                                        </div>
                                    </div>

                                  <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>