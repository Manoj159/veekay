<style type="text/css">
	body{
		width: 100%;
		overflow-x: hidden;
	}
	.mt-5{
		margin-top: 20px !important;
	}
</style>

<?php  foreach($booking as $b){

	$user = $this->db->get_where('user', array('user_id'=>$b->user_id))->row();

	$car = $this->db->get_where('car', array('car_id'=>$b->car_id))->row();

	$documents = $this->db->get_where('documents', array('user_id'=>$b->user_id)); ?>

<div class="row">
	
	<div class="col-md-12">
		
		<div class="card">
			
			<div class="card-header p-2" style="display: inline-block;">
				Edit Booking Details

                <?php 
                    // echo $b->start ;
                    // echo date('Y-m-d H:i:s');
                    
                    // echo $b->start > date('Y-m-d H:i:s'); 
                ?>
                
                <?php if( $b->start > date('Y-m-d H:i:s') && $b->payment_status ){ ?>
    				<div  style="float: right;">
    					<button type="button" class="btn btn-primary modify_car">Modify Booking</button>
    				</div>
    			<?php } ?>
			</div>

		 	
			<div class="card-body table-reponsive">
				<?php if($this->session->flashdata('message') != ''){ ?>

		 		<label class="alert alert-success">
		 			<?= $this->session->flashdata('message'); ?>
		 		</label>

		 	<?php } ?>
				<div class="row">
					
					<div class="col-md-4 border">

						<table class="table table-striped">
							<tr>
								<th>Payment Status</th>
								<td>
									 <?php if($b->payment_status == 1){ ?>
										<button type="button" class="btn btn-success btn-sm">Payment Paid</button>
									<?php } else { ?>
										<button type="button" class="btn btn-danger btn-sm">Payment Failed</button>
									<?php } ?>
								</td>
							</tr>
							
							<tr>
								<th>Is Booking Modified </th>
								<td>
									 <?php if($b->is_modified == 1){ ?>
										<button type="button" class="btn btn-info btn-sm">Yes</button>
									<?php } else { ?>
										<button type="button" class="btn btn-danger btn-sm">No</button>
									<?php } ?>
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
								<td> <?= date('d F, Y @ h:i A', strtotime($b->end)); ?></td>
							</tr>
							<tr>
								<th>Availability</th>
								<td> 
								    <!--<?= date('d F, Y @ h:i A', strtotime($b->availability)); ?>-->
                                
								    <form action="<?= base_url("Admin/change_booking_availability"); ?>" method="post">
                                        <input type="hidden" value="<?= $b->booking_id ?>" name="booking_id"/>
								        <div class="form-group input-group">
        				                    <input type="text" class="form-control" name="availability" value="<?= date('d-m-Y H:i', strtotime($b->availability)); ?>" />
								            <div class="input-group-append">
								                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i></button>
								            </div>
								        </div>
								    </form>
								    
								</td>
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
								<th>Price</th>
								<td><i class="fa fa-inr"></i> <?= $car->price; ?> Per Hour</td>
							</tr>
							<tr>
								<th>Total Fair </th>
								<td><i class="fa fa-inr"></i> <?= $b->final_car_price; ?></td>
							</tr>

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
							<?php if($b->home_delivery == 1){ ?>
							<tr>
								<th>Home Delivery</th>
								<td><i class="fa fa-inr"></i> <?= $b->home_delivery_charges; ?></td>
							</tr>
							<?php } ?>
						</table>

					</div>


				</div>

                <div class='col-md-12 p-0'>
                    <h4>Booking Modify History</h4>
                   <div class="row">
                        <table class="table table-bordered">
                            <tr>
                                <th>Sr.</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Availability</th>
                                <th>Car</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Refund</th>
                                <th>Remaining</th>
                            </tr>
                                <?php $count = 1; $modi = $this->db->get_where('booking_modify', array('booking_id'=>base64_decode($_GET['booking_id'])))->result();
                                    foreach($modi as $m){ ?>
                                    <tr>
                                        <td><?= $count++; ?></td>
                                        <td><?= date('d M, Y @ H:i', strtotime($m->start)); ?></td>
                                        <td><?= date('d M, Y @ H:i', strtotime($m->end)); ?></td>
                                        <td><?= date('d M, Y @ H:i', strtotime($m->availability)); ?></td>
                                        <td><?= $this->db->get_where('car', array('car_id'=>$m->car_id))->row()->name; ?></td>
                                        <td><?= $this->db->get_where('car', array('car_id'=>$m->car_id))->row()->price; ?></td>
                                        <td><?= $m->total_payable; ?></td>
                                        <td><?= $m->refund; ?></td>
                                        <td><?= $m->remaining; ?></td>
                                    </tr>
                                <?php } ?>
                        </table>
                   </div>
                </div>

			</div>	

		 </div>

	</div>

</div>
<br/>

<?php } ?>

    <div class="row">
        <div class="col-md-12">
            <div class="edit_booking_admin" style="display:none;">
                <div class="card">
        		
        			<div class="card-header p-2" style="display: inline-block;">
        				Edit Booking Details
        				
        				<?php 
        				    $start = date('d F, Y @ h:i A', strtotime($booking[0]->start));
        				    // print_r($start);
        				?>
        			</div>
        			    
        			<form action="<?= base_url("Admin/update_booking"); ?>" method="post">
        			    <div class="card-body row">
        			
        			        <div class="col-md-4">
            			
                    			<input type="hidden" value="<?= $booking[0]->booking_id ?>" name="booking_id"/>
                    			
                    			<div class="form-group">
             						<label>Start</label>
             						<input type="text" readonly class="form-control" value="<?php echo date('d-m-Y H:i', strtotime($booking[0]->start)); ?>" id="start-date" name="start" />
             					</div>
             					
             					<div class="form-group">
             						<label>End</label>
             						<input type="text" readonly class="form-control" value="<?php echo date('d-m-Y H:i', strtotime($booking[0]->end)); ?>" id="end-date" name="end" />
             					</div>
             					
             					<div class="form-group">
             					    <label>Availability</label>
        				            <input type="datetime-local" class="form-control" name="availability" value="<?= $booking[0]->availability; ?>" />
        				        </div>
             					
             					<!-- <div class="form-group">
             						<label>Select Car</label>
             						<select class="form-control display_car" name="car" required>
        			 					
        			 					<?php foreach($car_list as $key => $value){ ?>
        			 					
        			 					    <option value="<?php echo $value->car_id ?>" <?php if($booking[0]->car_id == $value->car_id) echo "selected";?>><?php echo $value->name .'('.$value->place .')'.'('.$value->fuel .')'.'('.$value->seats .'Seater)'.'('.$value->car_type .')'.'('.$value->transmission .')'.'('.$value->price .'Rs/Hr)'?> </img></option>
        			 				
        			 					<?php } ?>
        			 					
        			 				</select>
             					</div> -->
             					
                         		<div class="form-group input-group-append">
        			                <button type="submit" class="btn btn-success">Update Booking</button>
        			            </div>
                     		
        			    </div>
        			    
        			    <div class="col-md-8" id="my_new_car">
        			        
        			 		<div class='row'>
        			 		    <?php foreach($car_list as $key => $value){ ?>
        			        
                			        <div class='col-md-4 my_book_car'>
                			            <label> 
                    			            <input type="radio" name="car" class="d-none" required value="<?= $value->car_id; ?>" />
                    			            <img src="<?= base_url().$value->image; ?>" class="img img-thumbnail" style="height: 100px; width: 150px" />
                    			        
                    			            <p class='mt-2 text-center'><?= ucwords($value->name." - ".$value->fuel); ?></p>
                			            </label>
                			        </div>
                			        
                			     <?php } ?>
                			     
        			 		</div>
        			        
        			    </div>
        			    
        			</div>
        			
                    </form>
             		
        		</div>
            </div>
        </div>
    </div>
</div>

<script>
    
    $('.my_book_car').click(function(e){
       
       var my_book_car = $(this).children().children().val();
       
       $('#my_new_car .col-md-4 label').css('background','white');
       $(this).children().css('background','#3AC47D');
        
    });
    
</script>

<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/jquery.datetimepicker.min.css"/>

<script src="<?= base_url(); ?>assets/js/jquery.datetimepicker.full.js"></script>

<script>
  $('#start-date').datetimepicker({
    datepicker:true,
    defaultDate: '<?php echo date('d-m-Y', strtotime($booking[0]->start)); ?>',
    defaultTime:'<?php echo date('H:i', strtotime($booking[0]->start)); ?>',
    format:'d-m-Y H:i',
    formatDate:'d-m-Y H:i',
  });

  $('#end-date').datetimepicker({
    datepicker:true,
    defaultDate: '<?php echo date('d-m-Y', strtotime($booking[0]->end)); ?>',
    defaultTime:'<?php echo date('H:i', strtotime($booking[0]->end)); ?>',
    format:'d-m-Y H:i',
    formatDate:'d-m-Y H:i',
  });


  $('#end-date').change(function(e) {

  	e.preventDefault();

  	var start = $('#start-date').val();
  	var end = $(this).val();
  	var car_id = $('#car_id').val();
  	var booking_id = $('#booking_id').val();

  	$.ajax({
  		url: '<?= base_url(); ?>admin/get_payment_calculation',
  		method: 'POST',
  		dataType: 'json',
  		data: {'start':start,'end':end,'car_id':car_id,'booking_id':booking_id},
  		success:function(response){
  			$('#final_amount').val(response.total_new);
  			$('#remaining').val(response.remaining);
  			$('#new_gst').val(response.gst);
  			$('#total').val(response.total);
  		}
  	})

  });


/*  $('.availability').datetimepicker({
    datepicker:true,
    defaultDate: '<?php echo date('d-m-Y', strtotime($booking[0]->availability)); ?>',
    defaultTime:'<?php echo date('H:i', strtotime($booking[0]->availability)); ?>',
    format:'d-m-Y H:i',
    formatDate:'d-m-Y H:i',
  }); */
  
  $('.modify_car').on('click', function(){
      $(this).attr('disabled',true);
      $('.edit_booking_admin').show();
  })

    $('.display_car').change(function(){
       
       var display_car = $(this).val();
        
      $.ajax({
  		url: '<?= base_url(); ?>admin/get_admin_change_car_details',
  		method: 'POST',
  		dataType: 'json',
  		data: {'display_car':display_car},
  		success:function(response){
      		  $('#my_new_car').css('display','block');
      		  $('#my_image').attr('src','<?= base_url(); ?>'+response.image);
      		  $('#my_car').text(response.name);
      		  $('#my_price').text(response.price);
      		  $('#my_weekend_price').text(response.weekend_price);
      		  $('#my_place').text(response.place);
      		  $('#my_car_type').text(response.car_type);
      		  $('#my_transmission').text(response.transmission);
      		  $('#my_description').text(response.description);
  		    }
  	   });
    });
</script>

