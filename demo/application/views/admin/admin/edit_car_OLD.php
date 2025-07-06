<?php foreach($car as $c){ ?>

<div class="row">
	
	<div class="col-md-12">
		 
		 <div class="card">
		 	
		 	<div class="card-header">
		 		Manage Car
		 	</div>

		 	<form method="post" action="<?= base_url(); ?>Admin/car/update/<?= $c->car_id; ?>" enctype="multipart/form-data">
	
				<div class="card-body">
			 		
			 		<div class="row">
			 			
			 			<div class="col-md-4 form-group">
			 				
			 				<label>Car Name</label>
			 				<input type="text" class="form-control" name="name" value="<?= $c->name; ?>">

			 			</div>
			 			
			 			<div class="col-md-4 form-group">
			 				
			 				<label>Vehicle Number <font color="red">*</font></label>
			 				<input type="text" required value="<?= $c->vehicle_number; ?>" class="form-control" name="vehicle_number" autocomplete="off" />

			 			</div>
			 			
			 			<div class="col-md-4 form-group">
			 				
			 				<label>City</label>
			 				<select class="form-control" name="city">
			 					<option value="" selected disabled> Select City</option>
			 					<?php foreach($city as $p){ ?>
			 						<option value="<?= $p->city_id ?>" <?php if($p->city_id == $c->city) echo 'selected'; ?> ><?= $p->name ?></option>
			 					<?php } ?>
			 				</select>

			 			</div>
			 			
			 			<div class="col-md-4 form-group">
			 				
			 				<label>Place Name</label>
			 				<input type="text" class="form-control" name="place" value="<?= $c->place; ?>">

			 			</div>
			 			
			 			<div class="col-md-4 form-group">
			 				
			 				<label>Fuel Type</label>
			 				<select class="form-control" name="fuel">
			 					<option value="" disabled> Select Fuel Type</option>
			 					<option value="Petrol" <?= ($c->fuel == 'Petrol') ? 'selected':''; ?> >Petrol</option>
			 					<option value="Diesel" <?= ($c->fuel == 'Diesel') ? 'selected':''; ?>>Diesel</option>
			 					<option value="CNG" <?= ($c->fuel == 'CNG') ? 'selected':''; ?>>CNG</option>
			 				</select>

			 			</div>
			 			
			 			<div class="col-md-4 form-group">
			 				
			 				<label>Select Seats</label>
			 				<select class="form-control" name="seats">
			 					<option value="" selected disabled> Select Number of Seats</option>
			 					<option value="5" <?= ($c->seats == '5') ? 'selected':''; ?>>5</option>
			 					<option value="6" <?= ($c->seats == '6') ? 'selected':''; ?>>6</option>
			 					<option value="7" <?= ($c->seats == '7') ? 'selected':''; ?>>7</option>
			 				</select>

			 			</div>
			 			
			 			<div class="col-md-4 form-group">
			 				
			 				<label>Select Car Type</label>
			 				<select class="form-control" name="car_type">
			 					<option value="" selected disabled> Select Car Type</option>
			 					<option value="SUV" <?= ($c->car_type == 'SUV') ? 'selected':''; ?>>SUV</option>
			 					<option value="Hatch Back" <?= ($c->car_type == 'Hatch Back') ? 'selected':''; ?>>Hatch Back</option>
			 					<option value="Sedan" <?= ($c->car_type == 'Sedan') ? 'selected':''; ?>>Sedan</option>
			 				</select>

			 			</div>
			 			
			 			<div class="col-md-4 form-group">
			 				
			 				<label>Select Transmission</label>
			 				<select class="form-control" name="transmission">
			 					<option value="" selected disabled> Select Transmission</option>
			 					<option value="Manual" <?= ($c->transmission == 'Manual') ? 'selected':''; ?>>Manual</option>
			 					<option value="Automatic" <?= ($c->transmission == 'Automatic') ? 'selected':''; ?>>Automatic</option>
			 				</select>

			 			</div>
			 			
			 			<div class="col-md-4 form-group">
			 				
			 				<label>Enter Price Per Hour</label>
			 				<input type="number" class="form-control" name="price" value="<?= $c->price; ?>" />

			 			</div>
			 			
			 			<div class="col-md-4 form-group">
			 				
			 				<label>Enter Weekend Price Per Hour</label>
			 				<input type="number" class="form-control" name="weekend_price" value="<?= $c->weekend_price; ?>" />

			 			</div>
			 			
			 			<div class="col-md-4 form-group">
			 				
			 				<label>Enter Short Description</label>
			 				<textarea class="form-control" rows="3" name="description"><?= $c->description; ?></textarea>

			 			</div>
			 					
	 					<div class="col-md-4 form-group">
	 						
	 						<label>Select Car Image</label>
	 						<input type="file" accept=".jpeg, .jpg, .png" class="form-control" name="image" onchange="readURL(this);" >
                            <br/>
                            <img src="<?= base_url().$c->image; ?>" id="blah" alt="" width="auto" height="100px">
	 					</div>
	 					
	 					
	 					<div class="col-md-4 form-group">
	 						<label>Disable From</label>
	 						<?php 
                                $hf_date = date("Y-m-d", strtotime($c->hide_from)); 
                                $hf_time = date("H:i", strtotime($c->hide_from)); 
                          
                                $ht_date = date("Y-m-d", strtotime($c->hide_to)); 
                                $ht_time = date("H:i", strtotime($c->hide_to)); 
                            ?>
	 						<input type="datetime-local" class="form-control" name="hide_from" value="<?= $hf_date."T".$hf_time; ?>" />
	 					</div>
	 					<div class="col-md-4 form-group">
	 						<label>Disable To</label>
	 						<input type="datetime-local" class="form-control" name="hide_to" value="<?= $ht_date."T".$ht_time; ?>"/>
	 					</div>
	 					<div class="col-md-4 form-group">
	 						<label>Disable Reason</label>
                            <textarea class="form-control" name="hide_reason"><?= $c->hide_reason; ?></textarea>
	 					</div>
	 					
	 					<?php 
                            $sf_date = date("Y-m-d", strtotime($c->sold_from)); 
                            $sf_time = date("H:i", strtotime($c->sold_from)); 

                            $st_date = date("Y-m-d", strtotime($c->sold_to)); 
                            $st_time = date("H:i", strtotime($c->sold_to)); 
                        ?>
	 					<div class="col-md-4 form-group">
	 						<label>Sold From</label>
	 						<input type="datetime-local" class="form-control" name="sold_from" value="<?= $sf_date."T".$sf_time; ?>" />
	 					</div>
	 					<div class="col-md-4 form-group">
	 						<label>Sold To</label>
	 						<input type="datetime-local" class="form-control" name="sold_to"  value="<?= $st_date."T".$st_time; ?>"/>
	 					</div>
	 					<div class="col-md-4 form-group">
	 						<label>Sold Remark</label>
                            <textarea class="form-control" name="sold_remark"><?= $c->sold_remark; ?></textarea>
	 					</div>
	 					
	 					<div class="col-md-6 form-group">
	 						<label>Refundable Deposit</label>
	 						<input type="number" value="<?= $c->refund_deposit; ?>" class="form-control" name="refund_deposit" />
	 					</div>
	 					<div class="col-md-6 form-group">
	 						<label>Home Delivery Charge</label>
	 						<input type="number" value="<?= $c->home_delivery_charge; ?>" class="form-control" name="home_delivery_charge" />
	 					</div>
	 					
	 					
	 					<div class="col-md-5 mt-2">
	 						
	 						<label>
	 							<input type="checkbox" value="1" name="show_top" <?php if($c->show_top == 1) echo 'checked'; ?> /> Check this box to show car on top.
	 						</label>

	 					</div>

	 					<div class="col-md-5 mt-2">
	 						
	 						<label>
	 							<input type="checkbox" value="1" name="delivery" <?php if($c->home_delivery == 1) echo 'checked'; ?>  /> Home Delivery is available
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


<?php } ?>

</div>