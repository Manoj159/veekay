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
				Manage Car Listing
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
            
            <a href="<?= base_url('admin/car')?>" class="btn btn-primary" style="margin-left:700px;">Add Car</a>
			<div class="card-body table-reponsive">
				
				<table class="table table-bordered" id="example">
					
					<thead>
						<tr>
							<th>Sr.</th>
							<th>Name</th>
							<th>Fuel</th>
							<th>Car Type</th>
							<th>Seats</th>
							<th>Transmission</th>
							<th>Price</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody>

						<?php $a = 1; foreach($car as $c){ ?>

							<tr>
								<td><?= $a++; ?></td>
								<td><?= $c->name."<br><b>".$c->vehicle_number."</b>"; ?></td>
								<td><?= $c->fuel; ?></td>
								<td><?= $c->car_type; ?></td>
								<td><?= $c->seats; ?></td>
								<td><?= $c->transmission; ?></td>
								<td><i class="fa fa-inr"></i> <?= $c->price; ?></td>
								<td>
									<a href="<?= base_url(); ?>Admin/edit_car?car_id=<?= base64_encode($c->car_id); ?>" class="btn btn-warning btn-sm text-white">
										<i class="fa fa-edit"></i>
									</a>

									<a href="<?= base_url(); ?>Admin/car/delete?car_id=<?= base64_encode($c->car_id); ?>" onclick="return confirm('Are you to Delete this Car!');" class="btn btn-danger btn-sm text-white">
										<i class="fa fa-trash"></i>
									</a>

									<?php if($c->show_hide == 1){ ?>

									<a href="<?= base_url(); ?>Admin/car/show_hide?car_id=<?= base64_encode($c->car_id); ?>&&show_hide=0" onclick="return confirm('Confirm to hide this car?')" class="btn btn-info btn-sm text-white">
										Hide
									</a>

								<?php } else{ ?>

									<a href="<?= base_url(); ?>Admin/car/show_hide?car_id=<?= base64_encode($c->car_id); ?>&&show_hide=1" onclick="return confirm('Confirm to show this car?')" class="btn btn-success btn-sm text-white">
										Show
									</a>

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
<br/>
</div>