<div class="row">
	<div class="col-md-4">
		<div class="main-card mb-12 card  ">
            <form  method="post" action="<?= base_url().'Admin/testimonial/add_image'; ?>" enctype="multipart/form-data">

			     <div class="card-body">
            
                    <h5 class="card-title"><?= ucwords('Upload testimonial Image'); ?></h5>
                    <hr/>

			    
                    <div class="form-group">
			    
                        <div class="col-md-12 mb-12">
			    
                            <label for="example"><?= ucwords('upload background image'); ?></label>
                            
                            <input type="file" name="bg_image" required class="form-control" onchange="readURL(this);" /> <br/>
                            
                            <?php
                                $this->db->order_by("id", "desc");
                                $this->db->limit(1);
                                $testimonial_bg = $this->db->get("testimonial_bg")->row()->images;
                            ?>
                            
                            <img src="<?= base_url($testimonial_bg); ?>" id="blah" style="width: 100%;" />

                        </div>
                    </div>
			    
                </div>

                <div class="card-footer">

			        <button class="btn btn-primary btn-block" type="submit">Upload Image</button>

                </div>

            </form>
		</div>
	</div>
    
    
    <div class="col-md-4">
		<div class="main-card mb-12 card  ">
            <form  method="post" action="<?= base_url().'Admin/testimonial/add'; ?>" enctype="multipart/form-data">

			     <div class="card-body">
            
                    <h5 class="card-title"><?= ucwords('Add testimonials'); ?></h5>
                    <hr/>

			    
                    <div class="form-group">
			    
                        <div class="col-md-12 mb-12">
                            <label for="example"><?= ucwords('Name'); ?></label>
                            <input type="text" name="name" required class="form-control" />
                        </div>
                        
                        <div class="col-md-12 mb-12">
                            <label for="example"><?= ucwords('Review'); ?></label>
                            <textarea name="review" required class="form-control"></textarea>
                        </div>
                        
                          <div class="col-md-12 mb-12">
                            <label for="example">Image</label>
                            <input type="file" name="b_image" required class="form-control" />
                        </div>
                        
                          
                        
                    </div>
			    
                </div>

                <div class="card-footer">

			        <button class="btn btn-primary btn-block" type="submit">Upload Review</button>

                </div>

            </form>
		</div>
	</div>

    <div class="col-md-4">
		<div class="main-card mb-12 card  ">
            <table class="table table-bordered">
                <tr>
                    <th>Review</th>
                    <th>Action</th>
                </tr>
                <?php
                    $this->db->order_by("id", "desc");
                    $testimonial = $this->db->get("testimonial")->result();
                    foreach($testimonial as $t){
                ?>
                <tr>
                    <td>
                        <b><?= $t->name ?></b><br/>
                        <?= $t->review ?><br/>
                         <img src="<?= base_url($t->image); ?>" id="blah" style="width: 60px;height: 50%;" />
                    </td>
                    <td>
                        <a href="<?= base_url(); ?>admin/testimonial/delete/<?= $t->id; ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </table>
		</div>
	</div>

</div>




</div>



