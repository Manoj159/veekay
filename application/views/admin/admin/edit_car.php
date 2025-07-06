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
			 				<label>Location Of Car</label>
			 				<input type="text" class="form-control place" id="place" required name="place" value="<?= $c->place; ?>">
			 			</div>
			 			
			 			<div class="col-md-4 form-group">
			 				<label>Latitude Of Car</label>
			 				<input type="text" class="form-control lat" id="lat" required readonly name="lat" value="<?= $c->car_lat; ?>">
			 			</div>
			 			
			 			<div class="col-md-4 form-group">
			 				<label>Longitude Of Car</label>
			 				<input type="text" class="form-control long" id="long" required readonly name="long" value="<?= $c->car_long; ?>">
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
	 					</div>
			 					
	 					 
	 					
	 					
                        <!----------------------------------------------------------------------------------------------------------------------------------------------->
	 						<?php 
                                $hf_date = date("Y-m-d", strtotime($c->hide_from)); 
                                $hf_time = date("H:i", strtotime($c->hide_from)); 
                          
                                $ht_date = date("Y-m-d", strtotime($c->hide_to)); 
                                $ht_time = date("H:i", strtotime($c->hide_to)); 
                            ?>
    	 					<!--<div class="col-md-4 form-group">-->
    	 					<!--	<label>Disable From</label>-->
    	 					<!--	<input type="datetime-local" class="form-control" name="hide_from" value="<?= $hf_date."T".$hf_time; ?>" />-->
    	 					<!--</div>-->
	 					
    	 					<!--<div class="col-md-4 form-group">-->
    	 					<!--	<label>Disable To</label>-->
    	 					<!--	<input type="datetime-local" class="form-control" name="hide_to" value="<?= $ht_date."T".$ht_time; ?>"/>-->
    	 					<!--</div>-->
    	 					<!--<div class="col-md-4 form-group">-->
    	 					<!--	<label>Disable Reason</label>-->
           <!--                     <textarea class="form-control" name="hide_reason"><?= $c->hide_reason; ?></textarea>-->
    	 					<!--</div>-->
	 					<!----------------------------------------------------------------------------------------------------------------------------------------------->
	 					    
	 					<!-- <div class="row w-100">
	 					    
	 					    
	 					    <?php  $hf_date = date("Y-m-d", strtotime($c->hide_from)); 
                                $hf_time = date("H:i", strtotime($c->hide_from)); 
                          
                                $ht_date = date("Y-m-d", strtotime($c->hide_to)); 
                                $ht_time = date("H:i", strtotime($c->hide_to));
                                
                                ?>
        	 					<div class="col-md-4 form-group">
        	 						<label>Disable From</label>
        	 						<input type="datetime-local" class="form-control" name="hide_from" value="<?= $hf_date."T".$hf_time; ?>"/>
        	 					</div>
        	 					<div class="col-md-4 form-group">
        	 						<label>Disable To</label>
        	 						<input type="datetime-local" class="form-control" name="hide_to" value="<?= $ht_date."T".$ht_time; ?>"/>
        	 					</div>
        	 					<div class="col-md-4 form-group">
        	 						<label>Disable Reason</label>
                                    <textarea class="form-control" name="hide_reason"><?= $value->hide_reason ?></textarea>
        	 					</div>
	 					</div> -->
	 					
	 					</br>
	 					
	 					  <div class="row sold_fields w-100">
    	 					<?php if(!empty($car_hide_history)){ foreach($car_hide_history as $key => $value) { 
                                $sf_date = date("Y-m-d", strtotime($value->hide_from)); 
                                $sf_time = date("H:i", strtotime($value->hide_from)); 
    
                                $st_date = date("Y-m-d", strtotime($value->hide_to)); 
                                $st_time = date("H:i", strtotime($value->hide_to)); 
                            ?>
    	 					<div class="col-md-3 form-group">
    	 						<label>Sold From</label>
    	 						<input type="datetime-local" class="form-control" name="sold_from[]" value="<?= $sf_date."T".$sf_time; ?>" />
    	 					</div>
    	 					<div class="col-md-3 form-group">
    	 						<label>Sold To</label>
    	 						<input type="datetime-local" class="form-control" name="sold_to[]"  value="<?= $st_date."T".$st_time; ?>"/>
    	 					</div>
    	 					<div class="col-md-5 form-group">
    	 						<label>Sold Remark</label>
                                <textarea class="form-control" name="sold_remark[]"><?= $value->hide_reason; ?></textarea>
    	 					</div>
	 					
    	 					<div class="col-md-1 form-group">
    	 					    <label class="mt-5"> </label>
    	 					    <button type="button" class="btn-success add_more"> Add+</button>
     					    </div>
     					   <?php } } else { ?>
    	 					<?php 
                                $sf_date = date("Y-m-d", strtotime($c->sold_from)); 
                                $sf_time = date("H:i", strtotime($c->sold_from)); 
    
                                $st_date = date("Y-m-d", strtotime($c->sold_to)); 
                                $st_time = date("H:i", strtotime($c->sold_to)); 
                            ?>
    	 					<div class="col-md-3 form-group">
    	 						<label>Sold From</label>
    	 						<input type="datetime-local" class="form-control" name="sold_from[]" value="<?= $sf_date."T".$sf_time; ?>" />
    	 					</div>
    	 					<div class="col-md-3 form-group">
    	 						<label>Sold To</label>
    	 						<input type="datetime-local" class="form-control" name="sold_to[]"  value="<?= $st_date."T".$st_time; ?>"/>
    	 					</div>
    	 					<div class="col-md-5 form-group">
    	 						<label>Sold Remark</label>
                                <textarea class="form-control" name="sold_remark[]"><?= $c->sold_remark; ?></textarea>
    	 					</div>
	 					
    	 					<div class="col-md-1 form-group">
    	 					    <label class="mt-5"> </label>
    	 					    <button type="button" class="btn-success add_more"> Add+</button>
     					    </div>
     					   
     					   <?php } ?>
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
			 			Update Car
			 		</button>

			 	</div> 		

		 	</form>

		 </div>

	</div>

</div>
<br/>


<?php } ?>

</div>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjWvgyaXwhdSTSLXhFlQSIgpy8u2m4bZ8&callback=initMap&libraries=places&v=weekly"></script>


<script>
    
    $('.add_more').on('click', function(){
        
        
        html = `<div class="col-md-4 form-group">
 			<label>Sold From</label>
 			<input type="datetime-local" class="form-control" name="sold_from[]" />
 		</div>
 		<div class="col-md-4 form-group">
 			<label>Sold To</label>
 			<input type="datetime-local" class="form-control" name="sold_to[]" />
 		</div>
 		<div class="col-md-4 form-group">
 			<label>Sold Reason</label>
            <textarea class="form-control" name="sold_remark[]"></textarea>
 		</div>`;
 		
 		$('.sold_fields').append(html);
    })
    
    
    function initMap() {
        var input = document.getElementById('place');
        
        var autocomplete = new google.maps.places.Autocomplete(input);
        
        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            
            // console.log('place', place.geometry);
            // console.log(place.geometry.location.lat())
            // console.log(place.geometry.location.lng())
            // return false;
            
            var address_components = place.address_components
            // console.log(address_components);
            
            city = '';
            state = '';
            state_code = '';
            country = '';
            country_code = '';
            lat = place.geometry.location.lat();
            long = place.geometry.location.lng();
            
            for(x in address_components){
                var type = address_components[x].types[0];
    
                if( type == 'locality'){
                    city = address_components[x].long_name;
                }
    
                if( type == 'administrative_area_level_1'){
                    state = address_components[x].long_name;
                    state_code = address_components[x].short_name;
                }
    
                if( type == 'country'){
                    country = address_components[x].long_name;
                    country_code = address_components[x].short_name;
                }
    
            }
        
            console.log('country',country);
            console.log('country_code',country_code);
            console.log('state',state);
            console.log('state_code',state_code);
            console.log('city',city);
            console.log('lat', lat);
            console.log('long', long);
            
            $('.lat').val(lat);
            $('.long').val(long);
            
        });
    }
    
    initMap();


</script>