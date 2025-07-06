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
                        <button type="submit" class="btn btn-primary btn-block mt-0">Filter Bookings</button>
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
									<?php if($b->payment_status != 1){ ?>
										<button class="btn btn-sm btn-danger">Failed</button>
									<?php } else if($b->payment_status == 1){ ?>
										<button class="btn btn-sm btn-success">Success</button>
									<?php } ?>
								</td>
								<td>
									<a href="<?= base_url(); ?>Admin/booking_details?booking_id=<?= base64_encode($b->booking_id); ?>" class="btn btn-info btn-sm text-white">
										View
									</a>


									<a href="<?= base_url(); ?>Admin/edit_booking?booking_id=<?= base64_encode($b->booking_id); ?>" class="btn btn-warning btn-sm text-white">
										<i class="fa fa-edit"></i>
									</a>

									<?php if($b->remaining != null){ ?>
								
									<a href="<?= base_url(); ?>Admin_payment/do_payment?booking_id=<?= base64_encode($b->booking_id); ?>" class="btn btn-info btn-sm text-white">
										Pay Request
									</a>

									<?php } ?>

									<a href="<?= base_url(); ?>Admin/booking/delete?booking_id=<?= base64_encode($b->booking_id); ?>" onclick="return confirm('Are you to Delete this Car!');" class="btn btn-danger btn-sm text-white">
										<i class="fa fa-trash"></i>
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