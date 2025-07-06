<?php 

 $car = $this->db->get_where('booking', array('booking_id'=>$param))->result();   
        
foreach($car as $b){ ?>


<div class="card">
	
	<form action="<?= base_url(); ?>Account/" method="post">
	  <div class="card-body">
	    <label>Enter Booking Cancellation Reject Reason</label>
	    <input type="hidden" name="booking_id" value="<?= $b->booking_id; ?>">
	    <textarea class="form-control" name="note" required rows="3"></textarea>
	  </div>
	  <div class="card-footer">
	    <button type="submit" class="btn btn-dark">Reject Request</button>
	  </div>
	</form>

</div>

<?php } ?>