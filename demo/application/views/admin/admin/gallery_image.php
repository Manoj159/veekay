<div class="row">
	<div class="col-md-5">
		<div class="main-card mb-12 card  ">
            <form  method="post" action="<?= base_url().'Admin/gallery_image/add'; ?>" enctype="multipart/form-data">

			     <div class="card-body">
            
                    <h5 class="card-title"><?= ucwords('Upload Gallery Image'); ?></h5>
                    <hr/>

			    
                    <div class="form-group">
			    
                        <div class="col-md-12 mb-12">
			    
                            <label for="example"><?= ucwords('upload image'); ?></label>
                            
                            <input type="file" name="gallery" required class="form-control" onchange="readURL(this);" /><br/>
                            
                            <img src="<?= base_url(); ?>" id="blah" alt="" width="auto" height="200px">

                        </div>
                    </div>
			    
                </div>

                <div class="card-footer">

			        <button class="btn btn-primary btn-block" type="submit">Upload Image</button>

                </div>

            </form>
		</div>
	</div>

    <div class="col-sm-7">
        <div class="row" >

            <?php $img = $this->db->order_by('result_id','desc')->get('results')->result_array();
                    foreach($img as $img): ?>
            
            <div class="col-sm-4" style="margin-bottom: 20px;">
                 <a data-fancybox="gallery" href="<?= base_url().$img['images']; ?>"><img src="<?= base_url().$img['images']; ?>" class="img img-thumbnail" style="width: 100%; height: 150px;"></a>

                <a href="<?= base_url(); ?>admin/gallery_image/delete/<?= $img['result_id']; ?>?image_path=<?= $img['images']; ?>" class="text-white">
                    <button class="btn btn-danger btn-block">Delete</button>
                </a>

            </div>

            <?php endforeach; ?>

        </div><br/>

    </div>

</div>




</div>



