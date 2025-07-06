

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
        <div class="main-card mb-12 card  ">


        <form class="needs-validation"  method="post" action="<?= base_url().'admin/terms/update/1'; ?>" >

            <div class="card-body">
            
                <h5 class="card-title"><?= ucwords('manage terms & Condition'); ?></h5>
                <hr/>
                
                
                <div class="form-group">
            
                    <div class="col-md-12 mb-12">
            
                         <textarea class="textarea" placeholder="Enter your Terms & Condition" name="terms" 
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $this->db->get_where('terms', array('tid'=>1))->row()->terms; ?></textarea>
            
                    </div>
            
                </div>
                
                
                </div>


                    <div class="card-footer ">

                        <button class="btn btn-primary" style="width: 40%;" type="submit">Update Terms & Contions</button>

                    </div>

                    </form>



                </div>


        </div>



</div><br/><br/>


</div>
