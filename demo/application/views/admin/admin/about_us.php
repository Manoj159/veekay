
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/admin/texteditor/texteditor.css">

<script src="<?= base_url(); ?>assets/admin/texteditor/bootstrap.bundle.js"></script>

<script src="<?= base_url(); ?>assets/admin/plugins/jquery/jquery.min.js"></script>

<script src="<?= base_url(); ?>assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="<?= base_url(); ?>assets/admin/plugins/summernote/summernote-bs4.min.js"></script>


<script>
  $(function () {
    $('.textarea').summernote()
  })
</script>


<div class="row">
    
    <div class="col-md-12">
    
        <div class="main-card mb-12 card">
            
            <div class="card-header">
                <h5 class="card-title"><?= ucwords('Manage About Us'); ?></h5>
            </div>

            <form class="needs-validation"  method="post" action="<?= base_url().'admin/about_us/update/1'; ?>" >

                <div class="card-body">
                    
                    <div class="form-group">
                
                
                        <textarea class="textarea" placeholder="Enter your About Us" name="about_us"style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $this->db->get_where('about_us', array('aid'=>1))->row()->about_us; ?></textarea>
                
                
                    </div>
                    
                </div>

                <div class="card-footer">

                    <button class="btn btn-primary btn-block" type="submit">Update About Us</button>

                </div>

            </form>

        </div>

    </div>

</div><br/>

</div>