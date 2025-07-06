<style type="text/css">
	body{
		width: 100%;
		overflow-x: hidden;
	}
	.mt-5{
		margin-top: 20px !important;
	}
</style>

 <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
    </script>
 
    <!-- CSS CDN -->
    <link rel="stylesheet"
          href=
"https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" />
 
    <!-- datetimepicker jQuery CDN -->
    <script src=
"https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
    </script>
  <?php  foreach($booking as $b){

	$user = $this->db->get_where('user', array('user_id'=>$b->user_id))->row();

	$car = $this->db->get_where('car', array('car_id'=>$b->car_id))->row();

	$documents = $this->db->get_where('documents', array('user_id'=>$b->user_id)); ?>

<div class="row">
	
	<div class="col-md-12">
		
		<div class="card">
			
			<div class="card-header">
				Booking Details
			
				<!-- <a href="<?= base_url(); ?>Admin/edit_booking?booking_id=<?= base64_encode($b->booking_id); ?>" class="btn btn-primary" style="position: absolute; right: 20px;">Booking Modify</a> -->
			</div>

		 	
			<div class="card-body table-reponsive">
				
				<div class="row">
					
					<div class="col-md-4 border">

						<table class="table table-striped">
							<tr>
								<th>Payment Status</th>
								<td>
								    
								    	<?php if($b->payment_status == 3){ ?>
										<button class="btn btn-sm btn-warning">Cancelled </button>
									<?php } else if($b->payment_status == 1){ ?>
										<button class="btn btn-sm btn-success">Success</button>
									<?php }else{ ?>
										<button class="btn btn-sm btn-danger">Failed</button>
										<?php }?>
									
								</td>
							</tr>
							<tr>
								<th>Booking Id </th>
								<td><?= $b->details_order_id; ?></td>
							</tr>
							<tr>
								<th>Start</th>
								<td><?= date('d F, Y @ h:i A', strtotime($b->start)); ?></td>
							</tr>
							<tr>
								<th>End</th>
								<td> <?= date('d F, Y @ h:i A', strtotime($b->end)); ?> 
								<button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#myModal">Date Extend</button>
								
								</td>
							</tr>
							<tr>
								<th>Availability</th>
								<td> <?= date('d F, Y @ h:i A', strtotime($b->availability)); ?></td>
							</tr>
							
							
							<!-- Trigger the modal with a button -->


                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                        
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                   <h4 class="modal-title">Date  Extend</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                               
                              </div>
                              <div class="modal-body">
                                  <form action="<?php echo base_url('Admin/extendBooking'); ?>" method="post">
                                    <p>Update End Date </p>
                                    
                                   
                                     <input type="text" name="enddate" class="datetimepicker"  value="<?=$b->end;?>" />
                                     <input type="hidden" name="bookingId" value="<?= $b->booking_id;?>" /></br>
                                     <button type="submilt" class="btn btn-sm btn-success m-4 " >Update Date</button>
                                 </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                        
                          </div>
                        </div>
                            <script type="text/javascript">
                                $(".datetimepicker").each(function () {
                                    $(this).datetimepicker();
                                });
                            </script>
							
							
							<tr>
								<th>Created On</th>
								<td> <?= date('d F, Y @ h:i A', strtotime($b->created)); ?></td>
							</tr>
							<tr>
								<th>Total Amount</th>
								<td><i class="fa fa-inr"></i> <?= $b->total_payable; ?></td>
							</tr>

						<?php $start = new DateTime($b->start);
                       $end = new DateTime($b->end);

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
						</table>

					
					</div>

					<div class="col-md-4 border">

						<table class="table table-striped">
							<tr>
								<th>Car</th>
								<td><?= $car->name; ?></td>
							</tr>
							<tr>
								<th>Vehicle Number</th>
								<td><?= $car->vehicle_number; ?></td>
							</tr>
							<tr>
								<th>Price</th>
								<td><i class="fa fa-inr"></i> <?= $car->price; ?> Per Hour</td>
							</tr>
							<tr>
								<th>Place</th>
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

					<div class="col-md-4 border">
						
						<table class="table table-striped table-reponsive">
							<tr>
								<th>Total Fair </th>
								<td><i class="fa fa-inr"></i> <?= $b->final_car_price; ?></td>
							</tr>
                            
       <!--                     <tr>-->
							<!--	<th>Remaining Amount </th>-->
							<!--	<td><i class="fa fa-inr"></i> <?= $b->remaining; ?></td>-->
							<!--</tr>-->
							
							<tr>
								<th>GST</th>
								<td><i class="fa fa-inr"></i> <?= $b->gst; ?></td>
							</tr>
							<tr>
								<th>Refunded</th>
								<td><i class="fa fa-inr"></i> <?= $b->refund; ?></td>
							</tr>
							<tr>
								<th>Net</th>
								<td><i class="fa fa-inr"></i> <?= $b->total_payable; ?></td>
							</tr>
							<!--<?php if($b->home_delivery == 1){ ?>-->
							<!--<tr>-->
							<!--	<th>Home Delivery</th>-->
							<!--	<td><i class="fa fa-inr"></i> <?= $b->home_delivery_charges; ?></td>-->
							<!--</tr>-->
							<!--<?php } ?>-->
						</table>
    
                        <?php if($b->remaining) {?>
					        
					       <span><b>Paid Amount : </b></span> <span style="color:green;font-size: 27px;"><?= $b->total_payable-$b->remaining; ?></span> </br>
					        <span><b>Remaining Amount : </b></span> <span style="color:red;font-size: 27px;"><?= $b->remaining; ?></span> </br>
					        
					        <!--<a type="button" class="accept_complete" href="<?php echo base_url('Admin/mark_payement_complete?booking_id='.base64_encode($b->booking_id))?>">Accept Complete Payment</button>-->
					        
					        <button type="button" class="btn btn-warning accept_complete" href="#">Accept Complete Payment</button>
					        
					    <?php }else{ ?>
					        
					        <b>Remark:</b> <?php echo $b->remark ?>
					    <?php } ?>
					</div>
					

					<div class="col-md-6 border">
						
						<p>User Details: </p>

						<p><span class="ml-4"><b>Name:</b>  <a href="<?= base_url(); ?>Admin/user_details?user_id=<?= base64_encode($b->user_id); ?>" class="text-dark"><?= $user->name; ?></a></span></p>
						
						<p><span class="ml-4"><b>Email:</b>  <a href="<?= base_url(); ?>Admin/user_details?user_id=<?= base64_encode($b->user_id); ?>" class="text-dark"><?= $user->email; ?></a></span></p>
						
						<p><span class="ml-4 mt-5"><b>Contact:</b> <a href="<?= base_url(); ?>Admin/user_details?user_id=<?= base64_encode($b->user_id); ?>" class="text-dark"><?= $user->contact; ?></a></span></p>
						

						<?php if($b->home_delivery == 1){ ?>

							<p><b>Delivery Address :</b> <?= $b->address; ?></p>

						<?php } ?>

					</div>

					<div class="col-md-6 border py-5 text-center text-danger">

						<?php if($documents->num_rows() > 0){ ?>

                    		<?php if($documents->row()->doc1 != ''){ ?>

								<a data-fancybox="gallery" href="<?= base_url().$documents->row()->doc1; ?>" class="btn btn-primary mx-3" >View Document</a>

                    		<?php } if($documents->row()->license != ''){ ?>

								<a data-fancybox="gallery" href="<?= base_url().$documents->row()->license; ?>" class="btn btn-info mx-3">View License</a>

							<?php } ?><br/><br/>

						 <h5 class="text-dark">	Documents Status: <?= $documents->row()->doc_status; ?> </h5>

						<?php } else{ ?>

							<h2>Documents Not Uploaded!</h2>

						<?php } ?>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>

<?php } ?>

<br/>
</div>


<script>
  jQuery('#datetimepicker3').datetimepicker({
  format:'d.m.Y H:i',
  inline:true,
});
   
    
    $('.accept_complete').on('click', function(){
            
        let remark = prompt('Enter Remark');
        
        if( remark.length ){
            console.log('remark', remark);    
            let request = $.ajax({
                "url": "<?php echo base_url('Admin/mark_payement_complete?booking_id='.base64_encode($b->booking_id) ) ?>",
                method: 'GET',
                data : {
                    "remark" : remark,
                }
            });
            
            
            request.done(function(result){
                console.log(result);
                let data = JSON.parse(result);
                
                console.log(data.data)
                if( data.data )
                {
                    window.location.reload();
                }
            })
        }else{
            return false;
        }

    })
</script>