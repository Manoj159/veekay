<div class="row">
	
	<div class="col-md-12">
		 
		 <div class="card">
		 	
		 	<div class="card-header">
		 		Manage Car
		 	</div>

		 	<?php if($this->session->flashdata('message') != ''){ ?>

		 		<label class="alert alert-success">
		 			<?= $this->session->flashdata('message'); ?>
		 		</label>

		 	<?php } ?>

		 	<form method="post" action="<?= base_url(); ?>Admin/car/add" enctype="multipart/form-data">
	
				<div class="card-body">
			 		
			 		<div class="row">
			 			
			 			<div class="col-md-4 form-group">
			 				
			 				<label>Car Name</label>
			 				<input type="text" class="form-control" name="name" autocomplete="off">

			 			</div>
			 			
			 			<div class="col-md-4 form-group">
			 				
			 				<label>Vehicle Number <font color="red">*</font></label>
			 				<input type="text" required class="form-control" name="vehicle_number" autocomplete="off" />

			 			</div>
			 			
			 			<div class="col-md-4 form-group">
			 				
			 				<label>City</label>
			 				<select class="form-control" name="city">
			 					<option value="" selected disabled> Select City</option>
			 					<?php foreach($city as $c){ ?>
			 						<option value="<?= $c->city_id ?>"><?= $c->name ?></option>
			 					<?php } ?>
			 				</select>

			 			</div>
			 			
			 			<div class="col-md-4 form-group">
			 				
			 				<label>Place Name</label>
			 				<input type="text" class="form-control" name="place">

			 			</div>
			 			
			 			<div class="col-md-4 form-group">
			 				
			 				<label>Fuel Type</label>
			 				<select class="form-control" name="fuel">
			 					<option value="" selected disabled> Select Fuel Type</option>
			 					<option value="Petrol">Petrol</option>
			 					<option value="Diesel">Diesel</option>
			 					<option value="CNG">CNG</option>
			 				</select>

			 			</div>
			 			
			 			<div class="col-md-4 form-group">
			 				
			 				<label>Select Seats</label>
			 				<select class="form-control" name="seats">
			 					<option value="" selected disabled> Select Number of Seats</option>
			 					<option value="5">5</option>
			 					<option value="6">6</option>
			 					<option value="7">7</option>
			 				</select>

			 			</div>
			 			
			 			<div class="col-md-4 form-group">
			 				
			 				<label>Select Car Type</label>
			 				<select class="form-control" name="car_type">
			 					<option value="" selected disabled> Select Car Type</option>
			 					<option value="SUV">SUV</option>
			 					<option value="Hatch Back">Hatch Back</option>
			 					<option value="Sedan">Sedan</option>
			 				</select>

			 			</div>
			 			
			 			<div class="col-md-4 form-group">
			 				
			 				<label>Select Transmission</label>
			 				<select class="form-control" name="transmission">
			 					<option value="" selected disabled> Select Transmission</option>
			 					<option value="Manual">Manual</option>
			 					<option value="Automatic">Automatic</option>
			 				</select>

			 			</div>
			 			
			 			<div class="col-md-4 form-group">
			 				
			 				<label>Enter Price Per Hour</label>
			 				<input type="number" class="form-control" name="price" autocomplete="off" />

			 			</div>
			 			
			 			<div class="col-md-4 form-group">
			 				
			 				<label>Enter Weekend Price Per Hour</label>
			 				<input type="number" class="form-control" name="weekend_price" autocomplete="off" />

			 			</div>
			 			
			 			<div class="col-md-4 form-group">
			 				
			 				<label>Enter Short Description</label>
			 				<textarea class="form-control" rows="3" name="description"></textarea>

			 			</div>
			 					
	 					<div class="col-md-4 form-group">
	 						
	 						<label>Select Car Image</label>
	 						<input type="file" accept=".jpeg, .jpg, .png" class="form-control" name="image" onchange="readURL(this);" >
	 						<br/>
	 						<img src="<?= base_url(); ?>assets/img/icons/o3.png" id="blah" alt="" width="auto" height="100px">

	 					</div>
	 					
	 					<div class="col-md-4 form-group">
	 						<label>Disable From</label>
	 						<input type="datetime-local" class="form-control" name="hide_from" />
	 					</div>
	 					<div class="col-md-4 form-group">
	 						<label>Disable To</label>
	 						<input type="datetime-local" class="form-control" name="hide_to" />
	 					</div>
	 					<div class="col-md-4 form-group">
	 						<label>Disable Reason</label>
                            <textarea class="form-control" name="hide_reason"></textarea>
	 					</div>
	 					
	 					<div class="col-md-4 form-group">
	 						<label>Sold From</label>
	 						<input type="datetime-local" class="form-control" name="sold_from" />
	 					</div>
	 					<div class="col-md-4 form-group">
	 						<label>Sold To</label>
	 						<input type="datetime-local" class="form-control" name="sold_to" />
	 					</div>
	 					<div class="col-md-4 form-group">
	 						<label>Sold Remark</label>
                            <textarea class="form-control" name="sold_remark"></textarea>
	 					</div>
	 					
	 					<?php
                            $refund = $this->db->get_where("settings", ["type"=>"refund"])->row()->description;
                            $home_delivery = $this->db->get_where("settings", ["type"=>"home_delivery"])->row()->description;
                        ?>
	 					<div class="col-md-6 form-group">
	 						<label>Refundable Deposit</label>
	 						<input type="number" value="<?= $refund; ?>" class="form-control" name="refund_deposit" />
	 					</div>
	 					<div class="col-md-6 form-group">
	 						<label>Home Delivery Charge</label>
	 						<input type="number" value="<?= $home_delivery; ?>" class="form-control" name="home_delivery_charge" />
	 					</div>
	 					

	 					<div class="col-md-5 mt-2">
	 						
	 						<label>
	 							<input type="checkbox" value="1" name="show_top" /> If this Car are Show on Top please check the Box
	 						</label>

	 					</div>

	 					<div class="col-md-5 mt-2">
	 						
	 						<label>
	 							<input type="checkbox" value="1" name="home_delivery" /> Home Delivery is available
	 						</label>

	 					</div>

			 		</div>
			 		
			 	</div>		

			 	<div class="card-footer col-md-6">
			 		
			 		<button class="btn btn-primary btn-block btn-lg" type="submit">
			 			Add Car
			 		</button>

			 	</div> 		

		 	</form>

		 </div>

	</div>

</div>
<br/>

</div>