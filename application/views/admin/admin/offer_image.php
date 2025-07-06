<div class="row">
	<div class="col-md-6">
		<div class="main-card mb-12 card  ">
            <form  method="post" action="<?= base_url().'Admin/offer_image/add'; ?>" enctype="multipart/form-data">

			     <div class="card-body">
            
                    <h5 class="card-title"><?= ucwords('Upload Offer Image'); ?></h5>
                    <hr/>

			    
                    <div class="form-group row">
			    
                        <div class="col-md-6 mb-12">
			    
                            <label for="example"><?= ucwords('upload desktop image'); ?> (1280 x 133)</label>
                            <input type="file" name="desktop_banner" required class="form-control" onchange="readURL(this);" /><br/>
                            
                            <img src="" id="blah" alt="" style="width:100%;">

                        </div>
                        
                        <div class="col-md-6 mb-12">
			    
                            <label for="example"><?= ucwords('upload mobile image'); ?> (1024 x 512)</label>
                            <input type="file" name="mobile_banner" required class="form-control" onchange="readURL2(this);" /><br/>
                            
                            <img src="" id="blah2" alt="" width="200" >

                        </div>
                        
                    </div>
			    
                </div>

                <div class="card-footer">

			        <button class="btn btn-primary btn-block" type="submit">Update Images</button>

                </div>

            </form>
		</div>
	</div>


    <div class="col-md-6">
        
        <div class="card">
            
            <div class="card-header">
                Offer Image's
            </div>

            <?php if($this->session->flashdata('success') != ''){ ?>

                <label class="alert alert-success">
                    <?= $this->session->flashdata('success'); ?>
                </label>

            <?php } ?>

            <div class="card-body">
                
                <div class="table-responsive">
                    
                    <table class="table table-bordered" id="example">
                        
                        <thead>
                            <tr>
                                <th>Sr.</th>
                                <th>Desktop</th>
                                <th>Mobile</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php  $a = 1; $offer = $this->db->order_by('id','desc')->get('offer_banner')->result();

                            foreach($offer as $o){ ?>

                                <tr>
                                    <td><?= $a++; ?></td>
                                    <td>
                                        <img src="<?= base_url().$o->mobile_banner; ?>" width="100" />
                                    </td>
                                     <td>
                                        <img src="<?= base_url().$o->desktop_banner; ?>" width="100" />
                                    </td>
                                    <td>
                                        <a href="<?= base_url(); ?>Admin/offer_image/delete?banner_id=<?= $o->id; ?>" onclick="return confirm('Are you to delete this!')" class="btn btn-danger btn-sm text-white" ><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>

                            <?php } ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>




</div>



<br/>