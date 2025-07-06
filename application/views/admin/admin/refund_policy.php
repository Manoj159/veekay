

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


        <form class="needs-validation"  method="post" action="<?= base_url().'admin/refund_policy/update/1'; ?>" >

            <div class="card-body">
            
                <h5 class="card-title"><?= ucwords('Update FAQ'); ?></h5>
                <hr/>
                
                <div class="form-group">
            
                    <div class="col-md-12 mb-12">

                    <label>Enter your heading</label>
            
                         <input type="text" name="heading" class="form-control" placeholder="Enter your privacy heading" 
                            value="<?= $this->db->get_where('refund_policy', array('rid'=>1))->row()->heading; ?>">
            
                    </div>
            
                </div>
                
                <div class="form-group">
            
                    <div class="col-md-12 mb-12">
            
                         <textarea class="textarea" placeholder="Enter your Refund Policy" name="refund_policy" 
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $this->db->get_where('refund_policy', array('rid'=>1))->row()->refund_policy; ?></textarea>
            
                    </div>
            
                </div>
                
                
                </div>

                    <div class="card-footer">

                        <button class="btn btn-primary btn-block" type="submit">Update FAQ</button>

                    </div>

                    </form>



                </div>


        </div>



</div><br/><br/>


</div>
