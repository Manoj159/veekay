<div class="row">

<?php
    if(isset($_GET["edit_coupon"])){
        $coupon_id = $_GET["edit_coupon"];
        $coup = $this->db->get_where("coupon", ["id"=>$coupon_id])->row();
?>
  <div class="col-md-6">
		<div class="main-card mb-12 card  ">


			<div class="card">

				<div class="card-header">
                	
                	<h5 class="card-title"><?= ucwords('update coupon'); ?></h5>

                </div>
           		
           		<form  method="post" action="<?= base_url().'admin/coupons/update'; ?>" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?= $coup->id; ?>"/>
<div class="card-body">
            
            <div class="form-group row">
                <div class="col-md-6 mb-12">
                   <label><?= ucwords('coupon image'); ?></label>
                   <input type="file" class="form-control" name="image"/>
                </div>
                <div class="col-md-6 mb-12">
                   <img src="<?= base_url($coup->image); ?>" width="100%"/>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-12 mb-12">
                   <label><?= ucwords('enter coupon name'); ?></label>
                   <input type="text" class="form-control" value="<?= $coup->name; ?>" placeholder="Ex: FLAT10" required name="name"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12 mb-12">
                   <label><?= ucwords('discount in percent %'); ?></label>
                   <input type="number" value="<?= $coup->percent; ?>" class="form-control" placeholder="Ex: 10" required name="percent"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12 mb-12">
                   <label><?= ucwords('coupon expiry date'); ?></label>
                   <input type="date" class="form-control" min="<?= date("Y-m-d", strtotime("+1 day")); ?>" value="<?= $coup->expiry; ?>" required name="expiry"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12 mb-12">
                   <label><?= ucwords('Minimum car booking days'); ?></label>
                   <input type="number" value="<?= $coup->min_days; ?>" class="form-control" min="1" placeholder="Ex: 10" required name="min_days"/>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-12 mb-12">
                   <label>Secret/Public Coupon</label>
                   <select class="form-control" name="secret">
                       <option <?= ($coup->secret==0)?"selected":""; ?> value="0">Public (Anyone can apply)</option>
                       <option <?= ($coup->secret==1)?"selected":""; ?> value="1">Secret (Only People with code can apply)</option>
                   </select>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-12 mb-12">
                   <label><?= ucwords('Terms and Conditions'); ?></label>
                   <textarea class="form-control" name="terms"><?= $coup->terms; ?></textarea>
                </div>
            </div>
			    
                    

</div>
			    

                <div class="card-footer">

		            <button class="btn btn-warning btn-block" type="submit">Update Coupon</button>

                </div>

             </form>
                


            </div>

        </div>

		</div>
   <?php        
    }
    else{
    ?>
	<div class="col-md-6">
		<div class="main-card mb-12 card  ">


			<div class="card">

				<div class="card-header">
                	
                	<h5 class="card-title"><?= ucwords('add coupons'); ?></h5>

                </div>
           		
           		<form  method="post" action="<?= base_url().'admin/coupons/insert'; ?>" enctype="multipart/form-data">

<div class="card-body">
            
            <div class="form-group">
                <div class="col-md-12 mb-12">
                   <label><?= ucwords('coupon image'); ?></label>
                   <input type="file" class="form-control" required name="image"/>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-12 mb-12">
                   <label><?= ucwords('enter coupon name'); ?></label>
                   <input type="text" class="form-control" placeholder="Ex: FLAT10" required name="name"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12 mb-12">
                   <label><?= ucwords('discount in percent %'); ?></label>
                   <input type="number" class="form-control" placeholder="Ex: 10" required name="percent"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12 mb-12">
                   <label><?= ucwords('coupon expiry date'); ?></label>
                   <input type="date" class="form-control" min="<?= date("Y-m-d", strtotime("+1 day")); ?>" value="<?= date("Y-m-d", strtotime("+5 days")); ?>" required name="expiry"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12 mb-12">
                   <label><?= ucwords('Minimum car booking days'); ?></label>
                   <input type="number" class="form-control" min="1" placeholder="Ex: 10" required name="min_days"/>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-12 mb-12">
                   <label>Secret/Public Coupon</label>
                   <select class="form-control" name="secret">
                       <option value="0">Public (Anyone can apply)</option>
                       <option value="1">Secret (Only People with code can apply)</option>
                   </select>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-12 mb-12">
                   <label><?= ucwords('Terms and Conditions'); ?></label>
                   <textarea class="form-control" name="terms"><ul><li>Applicable on bookings with minimum duration of 10 days</li><!--<li>Not applicable on bookings where fuel is included</li>--><li>Applicable on Rental bookings only</li></ul></textarea>
                </div>
            </div>
			    
                    

</div>
			    

                <div class="card-footer">

		            <button class="btn btn-primary btn-block" type="submit">Add Coupon</button>

                </div>

             </form>
                


            </div>

        </div>

		</div>
<?php
    }
        ?>



 <div class="col-md-6">

        <div class="main-card mb-12 card  ">
            <div class="card-header card-success">
                <h5 class="card-title"><?= ucwords('list of all coupons'); ?></h5>
            </div>

            <div class="card-body">
                     
                <table  id="example" class="table table-hover table-striped table-bordered">
            		<thead>
                      <tr>
                            <td>Sr. No</td>
                            <td>Image</td>
                            <td>Coupons Name</td>
                            <td>Percent</td>
                            <td>Expiry</td>
                            <td>Action</td>
                        </tr>      
                    </thead>
            		<tbody>
                      <?php $a = 1; foreach($coupon as $c): ?>
                        <tr>
                            <td><?= $a++; ?></td>
                            <td>
                                <img src="<?= base_url($c["image"]); ?>" width="100%"/>
                            </td>
                            <td><?= $c['name']; ?> <br/> 
                            <small>(min <?= $c['min_days']; ?> days)</small>
                            </td>
                            <td ><?= $c['percent']; ?></td>
                            <td ><?= $c['expiry']; ?></td>
                            <td>
                            
                            <a href="<?=  base_url(); ?>admin/coupons?edit_coupon=<?= $c['id'] ?>" class="btn btn-warning btn-sm">    <i class="fa fa-pencil"></i>
                            </a>
                            
                            <a href="<?=  base_url(); ?>admin/coupons/delete/<?= $c['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this?');"><i class="fa fa-trash"></i></a>
                            
                            </td>
                        </tr>
                    <?php endforeach; ?>      
                    </tbody>

            	</table>
            </div>
                

        </div>

    </div>

</div>




</div>
<script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace( 'terms' );
</script>


