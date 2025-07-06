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
				Manage Booking Listing
			</div>
			<div class="form-group col-2">
			<a href="<?php echo base_url('admin/add_booking'); ?>" class="btn btn btn-success mt-0">Add Booking</a>
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
				<?php
                    $start_date = $end_date = $type = "";
                    if(isset($_GET["start_date"])){
                        extract($_GET);
                    }
                ?>
                <form class="row" method="get">
                    <div class="form-group col-3">
                        <label>Start Date</label>
                        <input type="date" value="<?= $start_date; ?>" name="start_date" class="form-control"/>
                    </div>
                    <div class="form-group col-3">
                        <label>End Date</label>
                        <input type="date" value="<?= $end_date; ?>" name="end_date" class="form-control"/>
                    </div>
                    <div class="form-group col-3">
                        <label>Type</label>
                        <select name="type" class="form-control">
                            <option <?= ($type=="All")?"selected":""; ?>>All</option>
                            <option <?= ($type=="Arrivals")?"selected":""; ?>>Arrivals</option>
                            <option <?= ($type=="Departures")?"selected":""; ?>>Departures</option>
                            <!--<option <?= ($type=="Cancelled")?"selected":""; ?>>Cancelled</option>-->
                            <option <?= ($type=="Documents Pending")?"selected":""; ?>>Documents Pending</option>
                            <option <?= ($type=="Documents Rejected")?"selected":""; ?>>Documents Rejected</option>
                            <option <?= ($type=="Documents Approved")?"selected":""; ?>>Documents Approved</option>
                        </select>
                    </div>
                    <div class="form-group col-2">
                        <label><br/></label>
                        <div style="display: flex; gap: 10px; padding: 10px;">
                        <button type="submit" class="btn btn-primary btn-block mt-0">Filter Bookings</button>
						<button type="button" class="btn btn-success" onclick="downloadExcel()">Download</button>
						</div>
                    </div>
                </form>
				
				<table class="table table-bordered" id="example">
					
					<thead>
						<tr>
							<th>Sr.</th>
							<th width="10%">Id</th>
							<th>User</th>
							<th>Car</th>
							<th>Start</th>
							<th>End</th>
							<th>Price</th>
							<th>Payment</th>
					     	<th>Booking Type</th>
							<th>Car Received</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody>

						<?php $a = 1; foreach($booking as $b){ 
    
                            $user_id = $b->user_id;
                            if(isset($_GET["type"])){
                                $doc_status = "";
                                $checkForSql = 0;
                                if($type == "Documents Pending"){
                                    $doc_status = "Pending";
                                    $checkForSql = 1;
                                }
                                elseif($type == "Documents Rejected"){
                                    $doc_status = "Reject";
                                    $checkForSql = 1;
                                }
                                elseif($type == "Documents Approved"){
                                    $doc_status = "Accept";
                                    $checkForSql = 1;
                                }
                        
                                if($checkForSql == 1){
                                    $checkSql = $this->db->get_where("documents", ["user_id"=>$user_id, "doc_status"=>$doc_status])->num_rows();
                                    if($checkSql == 0){
                                        continue;
                                    }
                                }
                            }
    
                        $car = $this->db->get_where('car', array('car_id'=>$b->car_id))->row();
                        ?>

							<tr>
								<td><?= $a++; ?></td>
								<td width="10%">
									<a href="<?= base_url(); ?>Admin/booking_details?booking_id=<?= base64_encode($b->booking_id); ?>" class="text-dark">
										<small><?= $b->details_order_id; ?></small>
									</a>
								</td>
								<td>
									<a href="<?= base_url(); ?>Admin/user_details?user_id=<?= base64_encode($b->user_id); ?>" class="text-dark">
									<?= $this->db->get_where('user', array('user_id'=>$b->user_id))->row()->name."<br/>".$this->db->get_where('user', array('user_id'=>$b->user_id))->row()->contact; ?>
									</a>
								</td>
								<td><?= $car->name."<br><b>".$car->vehicle_number."</b>"; ?></td>
								<td><?= date('d-m-Y @H:i', strtotime($b->start)); ?></td>
								<td><?= date('d-m-Y @H:i', strtotime($b->end)); ?></td>
								<td><i class="fa fa-inr"></i><?= $b->total_payable; ?></td>
								
								<td>
									<?php if($b->payment_status == 3){ ?>
										<button class="btn btn-sm btn-warning">Cancelled </button>
									<?php } else if($b->payment_status == 1){ ?>
										<button class="btn btn-sm btn-success">Success</button>
									<?php }else{ ?>
										<button class="btn btn-sm btn-danger">Failed</button>
										<?php }?>
								</td>
									<td>
									<?php if($b->booking_via == 1){ ?>
                                        <span style="color:red">Mobile App</span> 
                                      <?php } else if($b->booking_via == 2){ ?>
							             <span style="color:black">Online</span> 
									<?php }else{ ?>
									  <span style="color:green">Offline <br/><?php echo  $b->admin_name ?></span> 
										<?php }?>
								</td>
								<td>
									<?php if($b->car_received == 0){ ?>
                                        <span style="color:red">Not Received</span> 
								
									<?php }else{ ?>
									  <span style="color:green">Received</span> 
										<?php }?>
								</td>
								<td width="15%">
									<a href="<?= base_url(); ?>Admin/booking_details?booking_id=<?= base64_encode($b->booking_id); ?>" class="btn btn-info btn-sm text-white">
										<i class="fa fa-eye"></i>	View
									</a>


									<a href="<?= base_url(); ?>Admin/booking_edit?booking_id=<?= base64_encode($b->booking_id); ?>" class="btn btn-warning btn-sm text-white">
										<i class="fa fa-edit"></i>
									</a>

									<!--<?php if($b->remaining != null || $b->remaining != 0){ ?>-->
								
									<!--<a href="<?= base_url(); ?>Admin_payment/do_payment?booking_id=<?= base64_encode($b->booking_id); ?>" class="btn btn-primary btn-sm text-white">-->
									<!--	Pay-->
									<!--</a>-->

									<!--<?php } ?>-->

									<a href="<?= base_url(); ?>Admin/booking/delete?booking_id=<?= base64_encode($b->booking_id); ?>" onclick="return confirm('Are you to Delete this Car!');" class="btn btn-danger btn-sm text-white">
										<i class="fa fa-trash"></i>
									</a>
									
									
									<!--<a href="#" title="cancel booking" booking-id="<?= base64_encode($b->booking_id); ?>" class="btn btn-warning cancel_booking btn-sm text-white">-->
									<!--	<i class="fa fa-cog"></i>-->
									<!--</a>-->
										<?php if($b->car_received == 0){ ?>
								    	<a href="<?= base_url(); ?>Admin/carreceived?booking_id=<?=$b->booking_id; ?>" class="btn btn- btn-sm btn-success text-white">	<i class="fa fa-car"></i> Received </a>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<script>


function downloadExcel() {
    // Parse PHP array as JSON
    const data = JSON.parse('<?= json_encode($booking) ?>');

    if (!Array.isArray(data) || data.length === 0) {
        console.error("Invalid data format.");
        return;
    }

    // Exclude unwanted columns
    const excludeColumns = [
        "booking_id", "is_modified", "user_id", "car_id", "home_delivery",
        "cancel_remark_admin", "cancel_percentage", "status", "city","gst","refund","remaining","final_car_price",
        "availability","home_delivery_charges","address","created","type","details_order_id","total_payable","payment_status"
    ];

    // Extract headers dynamically and exclude unwanted columns
    const headers = Object.keys(data[0]).filter(key => !excludeColumns.includes(key));

    // Convert array of objects to an array of arrays (excluding unwanted columns)
    const excelData = [
        headers, // First row as headers
        ...data.map(obj => headers.map(header => {
            let value = obj[header] || "";

            // Format fields based on conditions
            if (header === "payment_status") {
                value = (value == 3) ? "Cancelled" : (value == 1) ? "Success" : "Failed";
            } else if (header === "booking_via") {
                value = (value == 1) ? "Mobile App" : (value == 2) ? "Online" : "Offline";
            } else if (header === "car_received") {
                value = (value == 0) ? "Not Received" : "Received";
            }

            return value;
        }))
    ];

    // Create a new workbook and worksheet
    const workbook = XLSX.utils.book_new();
    const worksheet = XLSX.utils.aoa_to_sheet(excelData);
    
    // Append worksheet to workbook
    XLSX.utils.book_append_sheet(workbook, worksheet, "Bookings");

    // Generate Excel file and trigger download
    XLSX.writeFile(workbook, "Bookings.xlsx");
}

    
    $('.cancel_booking').on('click', function(){
        
        let isConfirm = confirm('Are you to Cancel this Booking!');
        
        if( !isConfirm) return false;
        
        let per = prompt('Enter Cancellation Percentage.');
        if( per.trim().length == 0) return false;
        
        let remark = prompt('Enter Remark');
        if( remark.trim().length == 0) return false;
        
        
        let bookingId = $(this).attr('booking-id');
        
        if( per.trim().length && remark.trim().length ){

            let request = $.ajax({
                "url": "<?php echo base_url(); ?>Admin/booking/cancel_booking_admin?>",
                method: 'POST',
                data : {
                    "bookingId" : bookingId,
                    "remark" : remark,
                    'per' : per
                }
            });
            
            request.done(function(result){
                let data = JSON.parse(result);
                if( data.status == '200' || data.status == 200)
                {
                    window.location.reload();
                }
            })
        }else{
            return false;
        }

    })
</script>

