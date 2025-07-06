<style type="text/css">
	body{
		width: 100%;
		overflow-x: hidden;
	}
</style>

<div class="row">
	
	<div class="col-md-12">
		
		<div class="card">
			
			<div class="card-header">
				Manage Cancel Booking Request
			</div>

		 	<?php if($this->session->flashdata('message') != ''){ ?>

		 		<label class="alert alert-success">
		 			<?= $this->session->flashdata('message'); ?>
		 		</label>

		 	<?php } ?>
			
		 	<?php if($this->session->flashdata('delete') != ''){ ?>

		 		<label class="alert alert-danger">
		 			<?= $this->session->flashdata('delete'); ?>
		 		</label>

		 	<?php } ?>

			<div class="card-body table-reponsive">
				
				<table class="table table-bordered" id="example">
					
					<thead>
						<tr>
							<th>Sr.</th>
							<th width="10%">Id</th>
							<th>User</th>
							<th>Car</th>
							<th>Response</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody>

						<?php $a = 1; foreach($booking as $b){ ?>

							<tr>
								<td><?= $a++; ?></td>
								<td width="10%">
									
									<a href="<?= base_url(); ?>Admin/booking_details?booking_id=<?= base64_encode($b->booking_id); ?>" class="text-dark">
									
									<small><?= $this->db->get_where('booking', array('booking_id'=>$b->booking_id))->row()->details_order_id; ?></small>
																			
									</a>
								</td>
								<td><?= $this->db->get_where('user', array('user_id'=>$b->user_id))->row()->name."<br/>".$this->db->get_where('user', array('user_id'=>$b->user_id))->row()->contact; ?></td>
								<td><?= $b->note; ?></td>
								<td>
									<?php if($b->order_status == 'pending'){ ?>
										<a class="btn btn-sm btn-outline-warning text-white">Pending</a>
									<?php } else if($b->order_status == "reject"){ ?>
										<a class="btn btn-sm btn-danger text-white">Cancellation Request Rejected</a>
									<?php }else if($b->order_status == "accept"){ ?>
										<a class="btn btn-sm btn-success text-white">Cancellation Request Accepted</a>
									<?php } ?> 
								</td>
								<td width="15%">
								<?php if($b->order_status == 'pending'){ ?>
									<a href="<?= base_url("admin/cancel_request_res/$b->booking_id/accept"); ?>" onclick="return confirm('Are you Sure to Accept Cancel Request!');" class="btn btn-success btn-sm">Accept</a>

			                         <a href="<?= base_url("admin/cancel_request_res/$b->booking_id/reject"); ?>" onclick="return confirm('Are you Sure to Reject Cancel Request!');" class="btn btn-danger btn-sm">Reject</a><br/><br/>
			                         
			                         <?php
                                                                       }
                                                                        ?>

								</td>
							</tr>

						<?php } ?>

					</tbody>

				</table>

			</div>

		</div>

	</div>

</div>
<br/>
</div>