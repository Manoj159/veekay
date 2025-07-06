<?php  $pick_data = $this->db->get_where('settings', "settings_id=12 OR settings_id=13 OR settings_id=14")->result();
         
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

    }  ?>

<main id="contact" class="py-5 login checkout-summary-before">
  
  <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="row mt-3">

          <div class="col-md-6 offset-3 mt-5 mt-lg-0">
              
              <div class="card">

                <form action="<?= base_url(); ?>Checkout/do_payment" method="post">
                
                  <div class="card-header text-center">
                    
                    <h5 class="text-uppercase"><?= @$this->db->get_where('city', array('city_id'=>$this->session->userdata('city')))->row()->name; ?></h5>

                    <p>
                      <label><?= date('d M, Y | H:i', strtotime($this->session->userdata('start'))); ?></label>
                          - 
                      <label><?= date('d M, Y | H:i', strtotime($this->session->userdata('end'))); ?></label>
                    </p>

                  </div>

               <?php
                    $price = $car->price;
                    $start_date = $this->session->userdata('start');
                    $day = date("l", strtotime($start_date));
                    // $day = "Saturday";

                    if($day=="Saturday" || $day=="Sunday"){
                        $price = $car->weekend_price;    
                    }
                 ?>
                 
                  <div class="card-body" id="fares">
                    
                    <p>
                        Regular Days Trip Fare <label class="float-right"><i class='bx bx-rupee'></i><?= $car->price; ?> / Hour</label>
                    </p>
                    <p>
                        Weekend Days Trip Fare <label class="float-right"><i class='bx bx-rupee'></i><?= $car->weekend_price; ?> / Hour</label>
                    </p>
                    <p>
                        Peak Time Price <label class="float-right"><i class='bx bx-rupee'></i><?= $car->price + number_format(($car->price*$price_increase_percentage/100)); ?> / Hour</label>
                    </p>
                    
                    <?php $start = new DateTime($this->session->userdata('start'));
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

                          @$final_car_price = round($price*$mdate);
                      
                        // sanjay added 31-03-2022
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

                              $percentToApply = $percentAddon = 0;
                              
                              if($dateDiff2 >= $pick_start_time && $dateDiff2 <= $pick_end_time){ // 15,16
                                  $percentToApply = $price_increase_percentage;
                              }
                              
                              if($percentToApply > 0){
                               $percentAddon = (($overall_fare*$percentToApply)/100);
                              }
                          }
                          if($this->session->userdata("coupon_discount")){
                              $percent = $this->session->userdata("coupon_discount");
                              $coupon_discount = ($overall_fare*$percent)/100;
                              $old_overall_fare = $overall_fare;
                              $overall_fare = $overall_fare-$coupon_discount;
                          }  

                          $fpric_abd = $overall_fare + $percentAddon;

                          @$final_car_price = round($fpric_abd);
                        // end.. sanjay added 31-03-2022
                      
                      

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
                        $refund = $this->db->get_where('settings', array('type'=>'refund'))->row()->description;
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

                        if($this->session->userdata('check') != ''){

                          $total_payable = $final_car_price+$gst+$refund+$home_delivery;
                          $this->session->set_userdata('total_payable',$total_payable);

                        }else{

                          $total_payable = $final_car_price+$gst+$refund;
                          $this->session->set_userdata('total_payable',$total_payable);

                        }

                      ?>

                    <p>Number Of Days <label class="float-right"><?= @$main_date; ?></label></p>
                    
                    <?php
                        if($this->session->userdata("coupon_discount")){
                    ?>
                    <p>Trip Fare <label class="float-right"><i class='bx bx-rupee'></i><?= $old_overall_fare; ?></label></p>
                    <p>Discount ( <?= $this->session->userdata("coupon_name"); ?> ) <label class="float-right" style="color:green;"> -<i class='bx bx-rupee'></i><?= $coupon_discount; ?></label></p>
                    <?php       
                        }          
                    ?>
                    
                    <p>Total (Trip Fare)<br/><small>Inclusive GST</small> <label class="float-right"><i class='bx bx-rupee'></i><?= @$final_car_price; ?></label></p>
                    
                    <p>Refundable Deposit <label class="float-right"><i class='bx bx-rupee'></i><?= $refund; ?></label><br/>
                      <!--<small style="font-size: 12px;" class="text-muted">Has been waived off the this booking</small>-->
                      </p>

                    <?php if($this->session->userdata('check') != ''){ ?>

                      <p>Home Delivery Charge  <label class="float-right"><i class='bx bx-rupee'></i><?= $home_delivery; ?></label></p>
                    
                    <?php } ?>

                    <!--<p>GST (<?= $gst_per; ?>%)  <label class="float-right"><i class='bx bx-rupee'></i><?= $gst; ?></label></p>-->
                    
                    
                    <p>
                      <b>Net Payable</b> <label class="float-right"><i class='bx bx-rupee'></i><?= $total_payable; ?></label>
                    </p>

                  </div>

                    <div class="card-footer" id="submit_fares">
                      <button type="submit" class="btn book_distributes">PROCEED TO PAY</button>
                    </div>


                </form>

              </div>            

          </div>

        </div>

      </div>
    </section>

</main>