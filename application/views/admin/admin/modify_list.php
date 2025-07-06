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
				Manage Modify Listing
			</div>
            
			<div class="card-body table-reponsive">
				
				<table class="table table-bordered" id="example">
					
					<thead>
						<tr>
							<th>Sr.</th>
							<th>Order Id</th>
							<th>Car</th>
							<th>Start</th>
							<th>End</th>
							<th>New Car</th>
							<th>New Start</th>
							<th>New End</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody>

						<?php $a = 1; foreach($car as $c){ 
						    $details = $this->db->get_where('car', array('car_id'=>$c->car_id))->row(); 
						    $booking = $this->db->get_where('booking', array('booking_id'=>$c->booking_id))->row();
						    $new_car = $this->db->get_where('car', array('car_id'=>$booking->car_id))->row(); ?>

							<tr>
								<td><?= $a++; ?></td>
								<td><?= $c->details_order_id; ?></td>
								<td><?= $details->name. " - ".$details->fuel; ?></td>
								<td><?= date('d M, Y @ H:i', strtotime($c->start)); ?></td>
								<td><?= date('d M, Y @ H:i', strtotime($c->end)); ?></td>
								<td><?= $new_car->name. " - ".$new_car->fuel; ?></td>
								<td><?= date('d M, Y @ H:i', strtotime($booking->start)); ?></td>
								<td><?= date('d M, Y @ H:i', strtotime($booking->end)); ?></td>
								<td>
								    <a href="" class="btn btn-primary">
								        View
								    </a>
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