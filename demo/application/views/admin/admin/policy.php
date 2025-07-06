

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


        <form class="needs-validation"  method="post" action="<?= base_url().'admin/policy/update'; ?>" >

            <div class="card-body">
            
                <h5 class="card-title"><?= ucwords('Manage Policies'); ?></h5>
                <hr/>
      <?php
            $content = "";
                $page = "";
if(isset($_GET["page"])){
$page = $_GET["page"];
$content = $this->db->get_where("policy", ["page"=>$page])->row()->content;
}
            ?>
                <div class="form-group">
            
                    <div class="col-md-12 mb-12">

                    <label>Select Page</label>
                        <select name="page" id="page" required class="form-control">
<option value="">- Select Page</option>
<option <?= ($page=="terms")?"selected":""; ?> value="terms">Terms & Conditions</option>
<option <?= ($page=="privacy")?"selected":""; ?> value="privacy">Privacy Policy</option>
<option <?= ($page=="refund")?"selected":""; ?> value="refund">Cancellation & Refund Policy</option>
                        </select>
                    </div>
            
                </div>
                
                
                <div class="form-group">
            
                    <div class="col-md-12 mb-12">
          
<textarea class="textarea" id="content" placeholder="Enter your About Us" name="content"><?= $content; ?></textarea>
            
                    </div>
            
                </div>
                
                
                </div>

                    <div class="card-footer ">

                        <button class="btn btn-primary btn-block" type="submit">Update Privacy Policy</button>

                    </div>

                    </form>



                </div>


        </div>



</div><br/><br/>


</div>
<script>
    $("#page").change(function(){
        const page = $(this).val(); 
        if(page.length > 0){
            window.location.href = "<?= base_url("admin/policy?page="); ?>"+page;
        }
        
        /*$.ajax({
            url: "<?= base_url("admin/policy_data"); ?>",
            data: {page: page},
            type: "POST",
            success: function(res){
                console.log(res);
                $('#content').summernote({
                  placeholder: res
                });
            }
        })*/
    });
</script>