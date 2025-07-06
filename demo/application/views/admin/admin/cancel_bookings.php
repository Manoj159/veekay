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
				Cancelled Booking List
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
							<th>Total Amount</th>
							<th>Refund</th>
							<th>Cancel Percentage</th>
							<th>Deduction Amount</th>
							<th>Payable Amount</th>
							<th>Remark</th>
							<!--<th>Action</th>-->
						</tr>
					</thead>

					<tbody>

						<?php $a = 1; foreach($booking as $b){ ?>

							<tr>
								<td><?= $a++; ?></td>
								<td width="10%">
									
									<a href="<?= base_url(); ?>Admin/booking_details?booking_id=<?= base64_encode($b->booking_id); ?>" class="text-dark">
									
									<small><?= $b->details_order_id; ?></small>
																			
									</a>
								</td>
								<td><?= $b->name."<br/>".$b->contact; ?></td>
								<td><?= $b->total_payable ?? 0; ?></td>
								<td><?= $b->refund ?? 0; ?></td>
								<td><?= $b->cancel_percentage ?? 0; ?>%</td>
								
								
								<?php if($b->cancel_percentage){ ?>
    								<td><?php 
    								
    								    $amount = $b->total_payable - $b->refund;
    								    
    								    $peAmont = ($amount * $b->cancel_percentage ) / 100; 
    								    
    								    echo $peAmont;
    							    ?></td>
    							<?php }else{ ?>
    							
    							    <td>0</td>
    							<?php } ?>
    							
    							
								<?php if($b->cancel_percentage){ ?>
    								<td><?php 
    								
    								    $amount = $b->total_payable - $b->refund;
    								    
    								    $peAmont = ($amount * $b->cancel_percentage ) / 100; 
    								    
    								    echo $amount - $peAmont;
    							    ?></td>
    							<?php }else{ ?>
    							
    							    <td>0</td>
    							<?php } ?>
								
								<td><?= $b->note; ?></td>
								
								<!--<td>-->
    				<!--				<a href="#" title="Cancellation Detail"  booking-id="<?= base64_encode($b->booking_id); ?>" class="btn btn-info cancel_booking btn-sm text-white">-->
    				<!--					<i class="fa fa-address-book"></i>-->
    				<!--				</a>-->
								<!--</td>-->
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