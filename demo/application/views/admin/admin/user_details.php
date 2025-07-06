<style type="text/css">
	body{
		width: 100%;
	}
	.mt-5{
		margin-top: 20px !important;
	}
</style>

<?php  foreach($user as $u){

	$documents = $this->db->get_where('documents', array('user_id'=>$u->user_id)); ?>

<div class="row">
	
	<div class="col-md-12">
		
		<div class="card">
			
			<div class="card-header">
				User Details
			</div>
		 	
			<div class="card-body table-reponsive">
				
				<div class="row">

					<div class="col-md-6">
						
						<p>User Details: </p>

						<p><span class="ml-4"><b>Name:</b>  <?= $u->name; ?></span></p>

						<p><span class="ml-4"><b>Email:</b>  <?= $u->email; ?></span></p>

						<p><span class="ml-4 mt-5"><b>Contact:</b> <?= $u->contact; ?></span></p>

					</div>

					<div class="col-md-6 py-5 text-center text-danger">

						<?php if($documents->num_rows() > 0){ ?>

	                    	<?php if($documents->row()->doc1 != ''){ ?>

								<a data-fancybox="gallery" href="<?= base_url().$documents->row()->doc1; ?>" class="btn btn-primary mx-3" >View Document</a>

	                    	<?php } if($documents->row()->license != ''){ ?>

								<a data-fancybox="gallery" href="<?= base_url().$documents->row()->license; ?>" class="btn btn-info mx-3">View License</a>

							<?php } ?>

						<?php } else{ ?>

							<h2>Documents Not Uploaded!</h2>

						<?php } ?>

					</div>

					<div class="col-md-12 mt-3">

						<h5>Booking List</h5><hr/>

						<table class="table table-reponsive table-bordered" id="example">
							
							<thead>
								<tr>
									<th>Sr.</th>
									<th>Booking Id</th>
									<th>Car</th>
									<th>City</th>
									<th>Amount</th>
									<th>Start</th>
									<th>End</th>
									<th>Duration</th>
									<th>Payment</th>
								</tr>
							</thead>
							
							<tbody>

							<?php $booking = $this->db->order_by('booking_id','desc')->get_where('booking', array('user_id'=>$u->user_id))->result();
								$a = 1;
								foreach($booking as $b){	

								$start_date = new DateTime($b->start);
								$since_start = $start_date->diff(new DateTime($b->end));


								 ?>

									<tr>
										<td><?= $a++; ?></td>
										<td>
											<a href="<?= base_url(); ?>Admin/booking_details?booking_id=<?= base64_encode($b->booking_id); ?>" class="text-dark">
												<?= $b->details_order_id; ?>
											</a>
										</td>
										<td><?= $this->db->get_where('car', array('car_id'=>$b->car_id))->row()->name; ?></td>
										<td><?= $this->db->get_where('city', array('city_id'=>$b->city))->row()->name; ?></td>
										<td><i class="fa fa-inr"></i> <?= $b->total_payable; ?></td>
										<td><?= date('d-m-Y @ H:i A', strtotime($b->start)); ?></td>
										<td><?= date('d-m-Y @ H:i A', strtotime($b->end)); ?></td>
										<td><?= ($since_start->d != '') ? $since_start->d." Day" : ''; ?> <?= ($since_start->h != '') ? "& ".$since_start->h." Hours" : ''; ?></td>
										<td>
											<?php if($b->payment_status == 1){ ?>
											<button type="button" class="btn btn-success btn-sm">Paid</button>
											<?php } else { ?>
											<button type="button" class="btn btn-danger btn-sm">Failed</button>
											<?php } ?>
										</td>
									</tr>

								<?php } ?>

							</tbody>

						</table>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>

<?php } ?>

<br/>
</div>