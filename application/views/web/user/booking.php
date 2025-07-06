<section class="user-dashboard-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 p-0">
                    <div class="user-sidebar">
                        <div class="align-items-center d-flex flex-column gap-1 justify-content-center pt-4 user-profile">
                            <div class="user-photo">
                                <img src="<?= base_url(); ?>/assets/img/user-avtar.png" alt="user-img" class="img-fluid">
                            </div>
                            <h4>user name here</h4>
                            <p><?=$bookingCount;?> Bookings till date</p>
                        </div>
                        <div class="side-nav-user">
                            <ul>
                                <li><a href="/account" class="menu-link">  User Profile</a></li>
                                <li><a href="/account/history" class="menu-link active">  Booking History</a></li>
                                <li><a href="/account/documents" class="menu-link">  Manage Documents</a></li>
                                <li><a href="/account/verification" class="menu-link">  Profile Verification</a></li>
                                <li><a href="<?= base_url(); ?>signup/logout" class="menu-link">  Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="user-content-area">
                        <div class="row mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="page-title-inner">Booking History</div>
                                <div class="booking-type">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item">
                                          <a class="nav-link active" href="/">All Booking</a>
                                        </li>
                                        <li class="nav-item">
                                          <a class="nav-link" href="/">Rental Booking</a>
                                        </li>
                                        <li class="nav-item">
                                          <a class="nav-link">Monthly Booking</a>
                                        </li>
                                      </ul>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        <?php
                            foreach($history as $his){
                                $carData = $this->db->get_where("car", ["car_id" => $his->car_id])->first_row();
                                
                                $seconds = strtotime(date("Y-m-d H:i:s", strtotime($his->end))) - strtotime(date("Y-m-d H:i:s", strtotime($his->start)));
                                $hours = abs($seconds / 60 / 60);
                                $days = intval($seconds / 60 / 60 / 24);
                                
                                $leftHour = $hours - ($days* 24);
                                 $str = $days." Days ";
                                if($leftHour == 0){
                                	$leftHour = "";
                                }else{
                                    $str.=" & ".$leftHour." Hours";
                                	$leftHour = ceil($leftHour)." Hours";
                                }
                               
                        ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card user-content-card">
                                        <div class="card-header">
                                            <div class="user-page-title booking">
                                                <h1>
                                                    <img src="/<?=$carData->image;?>" alt="car-img" style="height: 50px; width:85px;"> Booking Id : <span><?=$his->details_order_id;?></span>
                                                    <!--<span class="badge bg-warning text-dark">On-Going</span>-->
                                                </h1>
                                                <div class="head-right">
                                                    <button class="btn btn-themed" data-bs-toggle="modal" data-bs-target="#extend-bill-modal" >Extend Booking</button>
                                                    <button class="btn btn-themed d-none">Download Bill</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="user-inner-content bookings">
                                                <div class="row">
                                                    <div class="col-lg-6 col-sm-12">
                                                        <h2>Car details</h4>
                                                        <h4>Car <span><?=$carData->name;?></span> </h4>
                                                        <h4>Regular Price <span><?=$carData->price;?> Per Hour</span> </h4>
                                                        <h4>Weekend Price <span><?=$carData->weekend_price;?> Per Hour</span> </h4>
                                                        <?php if($his->home_delivery == 1 && $his->address != '' ){ ?>
                                                        <h4>Home Delivery Address <span><?=$his->address;?></span> </h4>
                                                        <?php }else{ ?>
                                                        <h4>Self pickup from <span><?=$carData->place;?></span> </h4>
                                                        <?php } ?>
                                                        
                                                        <h4>Fuel <span><?=$carData->fuel;?></span> </h4>
                                                        <h4>Car Type <span><?=$carData->car_type;?></span> </h4>
                                                        <h4>Transmission <span><?=$carData->transmission;?></span> </h4>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-12">
                                                        <h2>Other  details</h4>
                                                        <h4>Start Date <span><?=date("d M, Y H:i A", strtotime($his->start));?></span> </h4>
                                                        <h4>End Date <span><?=date("d M, Y H:i A", strtotime($his->end));?></span> </h4>
                                                        <h4>Amount Payable <span>₹ <?=$his->total_payable;?> </span>   </h4>
                                                        <h4>Pay Amount <span>₹ <?=$his->total_payable-$his->remaining;?></span> </h4>
                                                           <h4>Remaining Amount <span>₹ <?=$his->remaining;?></span> </h4>
                                                        <h4>Time Duration <span><?=$str;?></span> </h4>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="total-fare-card">
                                                            <h4>Total Fair <span>₹ <?=$his->final_car_price;?></span></h4>
                                                            <h4>GST <span>0</span></h4>
                                                            <h4>Refundable Deposit <span>₹ <?=$his->refund?></span> <span class="badge bg-success text-white">Paid</span></h4>
                                                            <h4>Payment Type <?=$his->type == "cod" ? '<span class="badge bg-info text-white">COD</span>':'<span class="badge bg-success text-white">Online</span>'; ?></h4>
                                                            <h4>Net <span>₹ <?=$his->total_payable;?></span></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                            }
                        ?>
                        
                       
                    </div>
                </div>
            </div>
        </div>        
    </section>