<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/admin/texteditor/texteditor.css">

<script src="<?= base_url(); ?>assets/admin/texteditor/bootstrap.bundle.js"></script>

<script src="<?= base_url(); ?>assets/admin/plugins/jquery/jquery.min.js"></script>

<script src="<?= base_url(); ?>assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="<?= base_url(); ?>assets/admin/plugins/summernote/summernote-bs4.min.js"></script>


<script>
  $(function () {
    $('.textarea').summernote(
  {
  height: 400,
  focus: true
}
  );
  })
</script>


    <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-12 card  ">

                    <form class="needs-validation"  method="post" action="<?= base_url().'admin/add_booking/add'; ?>" >

                    <div class="card-body">
                            <h5 class="card-title"><?= ucwords('Add  BOOKING'); ?></h5>
                            <hr/>
                            <div class="form-group">
                                <label>Select City</label>
                                <select class="form-control" name="city" id="city"  required onchange="carFunction()"  >
                                        <option value="0">Select City</option>
                                    <?php 
                                        foreach($city as $c){ ?>   
                                    <option value="<?= $c->city_id; ?>"><?= $c->name; ?></option>
                                    <?php } ?> 
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Booking Start Date</label>
                                <input type="datetime-local" required class="form-control" id="start"   name="start" onchange="carFunction()"  >
                            </div>	
                            <div class="form-group">
                                <label>Booking End Date</label>
                                <input type="datetime-local"  required class="form-control" id="end"  name="end" onchange="carFunction()"  >
                            </div>
                            
                            <div class="form-group">
                                <label>Select Car</label>
                                <select name="car_id" id="car_list"  class="form-control" required>
                                    <option value="0">Select Car</option>
                                    
                                    <?php foreach($car_list as $key => $value) {?>
                                        <option value="<?= $value->car_id?>" ><?= $value->name . ' / '. $value->vehicle_number  ?></option>
                                    <?php } ?>
                                </select>
                        
                
                            </div>
                          
                            <div class="form-group">
                                <label>Booking Fair</label>
                                <input type="text" value="" required class="form-control" placeholder="booking fair" name="final_car_price"/>
                            </div>
                            <div class="form-group">
                                <label>Security Deposite</label>
                                <input type="text" value="" required class="form-control" placeholder="Refund amount" name="refund"/>
                            </div>
                            
                             <div class="form-group">
                                <label>Home Delivery Amount </label>
                                <input type="text" value="0" required class="form-control" placeholder="home delivery charges" name="home_delivery_charges"/>
                            </div>
                            <div class="form-group">
                                <label>Total Amount </label>
                                <input type="text" value="" required class="form-control" placeholder="Total Amount" name="total_payable"/>
                            </div>
                            <div class="form-group">
                                <label>Receved  Amount </label>
                                <input type="text" value="" required class="form-control" placeholder="Receved  Amount " name="receved_amount"/>
                            </div>
                            <div class="form-group">
                                <label>Booking Remark</label>
                                <input type="text" value=""  class="form-control" placeholder="Remark " name="remark"/>
                            </div>
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" value="" required class="form-control" placeholder=" Name" name="name"/>
                            </div>
                            <div class="form-group">
                                <label>User Mobile Number </label>
                                <input type="text" value="" required class="form-control" placeholder="Mobile no " name="contact"/>
                            </div>
                            <div class="form-group">
                                <label>User Email </label>
                                <input type="text" value=""  class="form-control" placeholder="Email" name="email"/>
                            </div>

                            <div class="form-group">
                                <label>User Address  </label>
                                <input type="text" value=""  class="form-control" placeholder="Address" name="address"/>
                            </div>
                            
                              <div class="form-group">
                                <label>Admin Name   </label>
                                <input type="text" value=""  class="form-control" placeholder="Enter your name " name="admin_name"/>
                            </div>
        
                            <button class="btn btn-primary btn-block" type="submit">Create  Booking</button>
                        </div>
                    </form>

                </div>            
            </div>


    </div>
    </div>

</div><br/><br/>


</div>
<script>
   var base_url='<?php echo base_url(); ?>';

    function carFunction() 
    {
       // alert('okoko');
        var city =  $('#city').val()
        var start =  $('#start').val()
        var end =  $('#end').val()
     //   if(city!='' &&  start!='' && end!=''){
        console.log(city)  ;  
            $.ajax({
                type: "POST",
                url: base_url + "admin/data_list",
                data: {
                    city : city,
                    start : start,
                    end : end
                },
                success: function (msg) {
                    msg = JSON.parse(msg);
                    console.log( msg.data);
                    $('#car_list').html( msg.data);
                    asngFunction() ;
                
                },
                error: function () { 
                //   window.location.reload();
                }
            });
     //   }

    }
</script>


