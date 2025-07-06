
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

<?php
    if(isset($_GET["edit_blog"])){
        $blog_id = $_GET["edit_blog"];
        $coup = $this->db->get_where("blog", ["id"=>$blog_id])->row();
?>
  <div class="col-md-12">
		<div class="main-card mb-12 card  ">


			<div class="card">

				<div class="card-header">
                	
                	<h5 class="card-title"><?= ucwords('update blog'); ?></h5>

                </div>
           		
           		<form  method="post" action="<?= base_url().'admin/blog/update'; ?>" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?= $coup->id; ?>"/>
<div class="card-body">
            
            <div class="form-group row">
                <div class="col-md-6 mb-12">
                   <label><?= ucwords('Blog image'); ?></label>
                   <input type="file" class="form-control" name="image"/>
                </div>
                <div class="col-md-6 mb-12">
                   <img src="<?= base_url($coup->image); ?>" width="100%"/>
                </div>
            </div>
            
           <div class="form-group">
                <div class="col-md-12 mb-12">
                   <label><?= ucwords('title'); ?></label>
                   <input type="text" class="form-control" value="<?= $coup->title; ?>" required name="title"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12 mb-12">
                   <label><?= ucwords('Description'); ?></label>
                   <textarea class="form-control textarea" required name="description"><?= $coup->description; ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12 mb-12">
                   <label><?= ucwords('meta title'); ?></label>
                   <input type="text" class="form-control" required value="<?= $coup->meta_title; ?>" name="meta_title"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12 mb-12">
                   <label><?= ucwords('Meta Keywords'); ?></label>
                   <textarea class="form-control" name="meta_key"><?= $coup->meta_key; ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12 mb-12">
                   <label><?= ucwords('Meta Description'); ?></label>
                   <textarea class="form-control" rows="5" name="meta_des"><?= $coup->meta_description; ?></textarea>
                </div>
            </div>
			    
                    

</div>
			    

                <div class="card-footer">

		            <button class="btn btn-warning btn-block" type="submit">Update Blog</button>

                </div>

             </form>
                


            </div>

        </div>

		</div>
   <?php        
    }
    else{
    ?>
	<div class="col-md-12">
		<div class="main-card mb-12 card  ">


			<div class="card">

				<div class="card-header">
                	
                	<h5 class="card-title"><?= ucwords('add blog'); ?></h5>

                </div>
           		
           		<form  method="post" action="<?= base_url().'admin/blog/insert'; ?>" enctype="multipart/form-data">

<div class="card-body">
            
            <div class="form-group">
                <div class="col-md-12 mb-12">
                   <label><?= ucwords('image'); ?></label>
                   <input type="file" class="form-control" name="image"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12 mb-12">
                   <label><?= ucwords('title'); ?></label>
                   <input type="text" class="form-control" required name="title"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12 mb-12">
                   <label><?= ucwords('Description'); ?></label>
                   <textarea class="form-control textarea" required name="description"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12 mb-12">
                   <label><?= ucwords('meta title'); ?></label>
                   <input type="text" class="form-control" required name="meta_title"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12 mb-12">
                   <label><?= ucwords('Meta Keywords'); ?></label>
                   <textarea class="form-control" name="meta_key"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12 mb-12">
                   <label><?= ucwords('Meta Description'); ?></label>
                   <textarea class="form-control " rows="5" name="meta_des"></textarea>
                </div>
            </div>
			    
                    

</div>
			    

                <div class="card-footer">

		            <button class="btn btn-primary btn-block" type="submit">Add Blog</button>

                </div>

             </form>
                


            </div>

        </div>

		</div>
<?php
    }
        ?>



 <div class="col-md-12">

        <div class="main-card mb-12 card  ">
            <div class="card-header card-success">
                <h5 class="card-title"><?= ucwords('list of all blogs'); ?></h5>
            </div>

            <div class="card-body">
                     
                <table  id="example" class="table table-hover table-striped table-bordered">
            		<thead>
                      <tr>
                            <td width="1%">#</td>
                            <td width="10%">Image</td>
                            <td>Title</td>
                            <td>Action</td>
                        </tr>      
                    </thead>
            		<tbody>
                      <?php $a = 1; foreach($blog as $c): ?>
                        <tr>
                            <td><?= $a++; ?></td>
                            <td>
                                <img src="<?= base_url($c["image"]); ?>" width="100%"/>
                            </td>
                            <td><?= $c['title']; ?></td>
                            <td>
                            
                            <a href="<?=  base_url(); ?>admin/blog?edit_blog=<?= $c['id'] ?>" class="btn btn-warning btn-sm">    <i class="fa fa-pencil"></i>
                            </a>
                            
                            <a href="<?=  base_url(); ?>admin/blog/delete/<?= $c['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this?');"><i class="fa fa-trash"></i></a>
                            
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


