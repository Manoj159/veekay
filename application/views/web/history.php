<style type="text/css">
  .btn{
    float: left;
  }
  .mr-5{
    margin-right: 20px;
  }
  .given_some_space{
    background-color: rgba(128, 128, 128, 0.6);
    height: 10px;
  }
</style>

<style>
    .section-title h2::after{
        display: none !important;
    }
    .section-title h2{
        position: inherit;
    }
</style>

<?php $user = $this->db->get_where('user', array('user_id'=>$this->session->userdata('user_id')))->result();

  foreach($user as $u){ ?>

<section></section>
<main id="contact" class="py-5 my-account-page account-history-page">
	
	<section id="contact" class="contact history_section">
      <div class="container">

<nav aria-label="breadcrumb" class="">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= base_url("Account"); ?>">My Account</a></li>
    <li class="breadcrumb-item active" aria-current="page">Booking History</li>
  </ol>
</nav>
       
        <div class="section-title">
          <h2 class="text-white">My Account</h2>
        </div>

        <div class="row my-acount-inner">
          
          <div class="col-md-3">
            
            <div class="card sidebar">
              
              <div class="card-body text-center btn_profile_edit">
                
               <div class="row profile_view">
                 
                 <div class="col-sm-12 hlaf_view1">
                    <?php if($u->image == null){ ?>
                    <img src="<?= base_url(); ?>uploads/user/default.png" class="img img-thumbnail" alt="happyeasyrides" width="100" />
                  <?php } else { ?>
                    <img src="<?= base_url().$u->image; ?>" class="img img-thumbnail" alt="happyeasyrides" width="100"  />
                  <?php } ?>
                 </div>

                 <div class="col-sm-12 hlaf_view2">
                  <p><?= $u->name; ?></p>
                  <p><?= $u->contact; ?></p>
                  <p><?= $u->email; ?></p>
                 </div>

               </div>

                <hr/>

                <a href="<?= base_url(); ?>Account" class="btn btn-block btn-outline-dark py-2 mb-3">Edit Profile</a>

                <a href="<?= base_url(); ?>Account/history" class="btn btn-block btn-outline-dark py-2 mb-3">Booking History</a>

                <a href="<?= base_url(); ?>Account/documents" class="btn btn-block btn-outline-dark py-2 mb-3">Manage Documents</a>

                <a href="<?= base_url(); ?>Account/verification" class="btn btn-block btn-outline-dark py-2 mb-3">Profile Verification</a>

              </div>

            </div>

          </div>
          
          <div class="col-md-9">
            
            <div class="card right-content" >
              
              <div class="card-header">
                
                <h3 class="text-center">Booking History</h3>

              </div>
                

                  <?php foreach($history as $h){ ?>

                    <div class="card-body">
                    
                      <div class="row">

                        <div class="col-md-12 py-md-3">

                          <?php if($h->payment_status == 0){ ?>
                            <!-- <button type="button" class="btn btn-danger btn-sm">Payment Failed</button> -->
                          <?php } else { ?>
                            
                          <?php $cancel = $this->db->get_where('booking_cancell', array('booking_id'=>$h->booking_id));

                          if($cancel->num_rows() == 0){ ?>

                            <?php
                             $date_now = new DateTime();
                             $date2    = new DateTime($h->start); ?>
                           
                           <?php if ($date_now < $date2) { ?>

                              <a href="javascript:void(0);" onclick="return confirm('Are you Sure to Cancel Order!');" class="btn btn-danger text-white btn-sm mr-5"  data-bs-toggle="modal" data-bs-target="#example<?= $h->booking_id; ?>">Cancel Booking</a><br/>

                            <?php } ?>

                            <div class="modal fade" id="example<?= $h->booking_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                  <form action="<?= base_url(); ?>Account/cancell_booking" method="post">
                                    <div class="modal-body">
                                      <label>Enter Booking Cancellation Reason</label>
                                      <input type="hidden" name="booking_id" value="<?= $h->booking_id; ?>">
                                      <textarea class="form-control" name="note" required minlength="30" rows="3"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="submit" class="btn btn-dark">Cancel Booking</button>
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>

                          <?php } else if($cancel->row()->order_status == 'pending'){ ?> 
                            
                            <button type="button" class="btn btn-outline-dark btn-sm mr-5">Cancel Requested</button>
                            <br/>
                          <?php } else if($cancel->row()->order_status == 'cancelled'){ ?> 
                            
                            <button type="button" class="btn btn-outline-dark btn-sm mr-5">Cancelled</button>
                            <br/>
                          <?php }  } ?>

                        </div><br/>
                            
                        <div class="col-md-6 border">

                            <table class="table table-striped">
                              <tr>
                                <th>Payment Status</th>
                                <td>
                                   <?php if($h->payment_status == 1){ ?>
                                    <b><a href="javascript:void(0)" class="text-success"> Paid</a></b>
                                  <?php } else { 
                                        $cancelCheck = $this->db->get_where("booking_cancell", ["booking_id"=>$h->booking_id, "order_status"=>"accept", "status"=>1])->num_rows();
                                        if($cancelCheck > 0){
                                    ?>
                                    <b> <a href="javascript:void(0)" class="text-danger"> Booking Cancelled</a></b>  
                                   <?php        
                                        }else{
                                    ?>
                                    <b> <a href="javascript:void(0)" class="text-danger"> Failed</a></b>
                                  <?php }} ?>
                                </td>
                              </tr>
                              <tr>
                                <th>Booking Id </th>
                                <td><?= $h->details_order_id; ?></td>
                              </tr>
                              <tr>
                                <th>Start</th>
                                <td><?= date('d F, Y @ h:i A', strtotime($h->start)); ?></td>
                              </tr>
                              <tr>
                                <th>End</th>
                                <td> <?= date('d F, Y @ h:i A', strtotime($h->end)); ?></td>
                              </tr>
                              <tr>
                                <th>Total Amount</th>
                                <td><i class='bx bx-rupee'></i><?= $h->total_payable; ?></td>
                              </tr>

                            <?php $start = new DateTime($h->start);
                                       $end = new DateTime($h->end);

                                       $main = $start->diff($end); 

                                       if($main->h > 0){
                                         $main_date = $main->d. " Days & ".$main->h." Hours";
                                       }else{
                                         $main_date = $main->d. " Days";
                                       }  ?>
                              <tr>
                                <th>Time Duration </th>
                                <td> <?= $main_date; ?></td>
                              </tr>
                              <?php if($h->home_delivery == 1){ ?>
                              <tr>
                                <th>Delivery Address </th>
                                <td> <?= $h->address; ?></td>
                              </tr>
                              <?php }?>
                            </table>

                          
                          </div>

                            <?php $car = $this->db->get_where('car', array('car_id'=>$h->car_id))->row(); ?>

                          <div class="col-md-6 border">

                            <table class="table table-striped">
                              <tr>
                                <th>Car</th>
                                <td><?= $car->name; ?></td>
                              </tr>
                              <tr>
                                <th>Regular Price</th>
                                <td><i class='bx bx-rupee'></i> <?= $car->price; ?> Per Hour</td>
                              </tr>
                              <tr>
                                <th>Weekend Price</th>
                                <td><i class='bx bx-rupee'></i> <?= $car->weekend_price; ?> Per Hour</td>
                              </tr>
                              <tr>
                                <th>Self pickup from</th>
                                <td><?= $car->place; ?></td>
                              </tr>
                              <tr>
                                <th>Fuel</th>
                                <td><?= $car->fuel; ?></td>
                              </tr>
                              <tr>
                                <th>Car Type</th>
                                <td><?= $car->car_type; ?></td>
                              </tr>
                              <tr>
                                <th>Transmission</th>
                                <td><?= $car->transmission; ?></td>
                              </tr>
                            </table>

                          </div>

                          <div class="col-md-12">
                            
                            <table class="table table-reponsive table-striped">
                              <tr>
                                <th>Total Fair </th>
                                <th>GST</th>
                                <th>Refundable Deposit </th>
                                <?php if($h->home_delivery == 1){ ?>
                                  <th>Home Delivery Charges</th>
                                <?php } ?>
                                <th>Net</th>
                              </tr>

                              <tr>
                                <td><i class='bx bx-rupee'></i> <?= $h->final_car_price; ?></td>
                                <td><i class='bx bx-rupee'></i> <?= $h->gst; ?></td>
                                <td><i class='bx bx-rupee'></i> <?= $h->refund; ?></td>
                                 <?php if($h->home_delivery == 1){ ?>
                                <td><i class='bx bx-rupee'></i> <?= $h->home_delivery_charges; ?></td>
                                <?php } ?>
                                <td><i class='bx bx-rupee'></i> <?= $h->total_payable; ?></td>
                              </tr>
                            </table>

                        </div>

                     </div>

                    </div>
                  
                  <div class="given_some_space"></div>
                <?php } ?>

            </div>

          </div>

        </div>


      </div>
    </section>

</main>

<?php } ?>

<style type="text/css">
  .modal-backdrop{
    position: relative !important;
  }
  .modal-backdrop.show{
    opacity: 0;
  }
</style>