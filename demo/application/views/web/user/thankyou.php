<?php
    if($this->input->get("order") == null){
        redirect("/account/thankyou?order=".$this->session->userdata("unique_order_id"));
    }
    $booking = $this->db->get_where("booking", ["booking_id"=>$this->input->get("order")])->first_row();
    $car = $this->db->get_where("car", ["car_id"=>$booking->car_id])->first_row();
    $user = $this->db->get_where("user", ["user_id"=>$booking->user_id])->first_row();
?>

<!-- thankyou card -->
        <div class="container pt-5">
            <div class="row"> 
                <div class="col-lg-8 offset-lg-2">
                    <div class="card thankyou-card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4> <img src="<?=base_url(); ?>/assets/img/check.png" class="img-fluid" style="width: 50px;"> Thankyou for your booking <span class="badge bg-warning text-dark">document pending</span></h4> 
                            <button class="btn btn-themed" onclick="window.location.href='/account/history'"> Go to bookings </button>
                        </div>
                        <div class="card-body">
                            <div class="car-details d-flex justify-content-between">
                                <div class="content w-50">
                                    <h5>Car details</h5>
                                    <h6><?=$car->description;?></h6>
                                    <p><?=$car->name;?></p>
                                    <div class="car-info d-flex justify-content-between">
                                        <div class="car-item"> <img src="<?=base_url(); ?>/assets/img/fuel.svg" alt="icon"> <?=$car->fuel;?></div>
                                        <div class="car-item"> <img src="<?=base_url(); ?>/assets/img/transmission.svg" alt="icon"> <?=$car->transmission;?></div>
                                        <div class="car-item"> <img src="<?=base_url(); ?>/assets/img/seat.svg" alt="icon"> <?=$car->seats;?> Seater</div>
                                    </div>
                                </div>
                                <div class="img">
                                    <img src="/<?=$car->image;?>"  alt="icon" class="img-fluid" style="max-height: 235px; max-width:405px;">
                                </div>
                            </div>
                            <hr />
                            <div class="customer-detail">
                                <h5>
                                    Customer Details
                                    <button type="button" class="btn ms-2 btn-themed d-none" data-bs-toggle="modal" data-bs-target="#update-profile">
                                    Customer details
                                    </button>
                                    <button type="button" class="btn ms-2 btn-themed">
                                    Customer details
                                    </button>
                                </h5>
                                <h6>Your Name - <span><?=$user->name;?></span></h6>
                                <h6>Your Mobile - <span><?=$user->contact;?></span></h6>
                                <h6>Your EmaiL - <span><?=$user->email;?></span></h6>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5>Booking Details</h5>
                                    <p>Booking from <span><?=date("D, d M H:i", strtotime($booking->start));?></span> to <span><?=date("D, d M H:i", strtotime($booking->end));?></span></p>
                                    <p>Km Plan - <span>250km</span></p>
                                    <p class="d-none">Location - <span>Mumbai</span></p>
                                    <p class="d-none">limit 1200 km running limit (fuel not included)</p>
                                </div>
                                <div class="col-lg-6">
                                    <h5 class="update-status-doc">Documents Update <span class="bg-warning text-dark badge ">pending</span></h5>
                                    <form class="d-none">
                                        <div class="form-group">
                                            <label>Upload License</label>
                                            <input type="file" placeholder="upload license" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Aadhare front</label>
                                            <input type="file" placeholder="upload aadhar front" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Aadhare back</label>
                                            <input type="file" placeholder="upload aadhar back" class="form-control">
                                        </div>
                                        <button class="btn btn-themed mt-3" class="" type="button">update</button>
                                    </form>
                                    <button class="btn btn-themed mt-3" class="" type="button mb-0"><a class="nav-link" href="/account/documents">Update Document</a></button>
                                </div>
                            </div>
                            
                            <hr />
                            <h5>Payment Details</h5>
                            <p>Booking Fair <span>₹ <?=$booking->total_payable;?></span></p>
                            <hr />
                            <p>For further process <a href="#"> Please download our Mobile Application from Play store &nbsp; <img src="/assets/img/play-store.png" style="width: 20px;" alt="icon"> </a></p>
                        </div>
                    </div>
                </div>

               
                
                <!-- Modal -->
                <div class="modal fade" id="update-profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                  <label for="exampleInputEmail1" class="form-label">Your name</label>
                                  <input type="text" class="form-control">
                                </div>
                                <div class="mb-3">
                                  <label for="exampleInputPassword1" class="form-label">Your Mobile</label>
                                  <input type="mobile" class="form-control" >
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Your email</label>
                                    <input type="email" class="form-control" >
                                  </div>
                              </form>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">skip</button>
                        <button type="button" class="btn btn-primary">Save Details</button>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>