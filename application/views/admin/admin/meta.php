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


        <form class="needs-validation"  method="post" action="<?= base_url().'admin/meta/update'; ?>" >

            <div class="card-body">
            
                <h5 class="card-title"><?= ucwords('Manage Meta'); ?></h5>
                <hr/>
      <?php
            $description = $title = $keyword = "";
                $page = "";
if(isset($_GET["page"])){
$page = $_GET["page"];
$sql = $this->db->get_where("meta", ["pages"=>$page])->row();
    $title = $sql->title;
    $keyword = $sql->keyword;
    $description = $sql->description;
}
            ?>
                <div class="form-group">
            
                    <div class="col-md-12 mb-12">

                    <label>Select Page</label>
                        <select name="page" id="page" required class="form-control">
<option value="">- Select Page</option>
<option <?= ($page=="Home")?"selected":""; ?> >Home</option>
<option <?= ($page=="Book")?"selected":""; ?> >Book</option>
<option <?= ($page=="Contact Us")?"selected":""; ?> >Contact Us</option>
<option <?= ($page=="Login")?"selected":""; ?> >Login</option>
<option <?= ($page=="Terms and Conditions")?"selected":""; ?> >Terms and Conditions</option>
<option <?= ($page=="Privacy Policy")?"selected":""; ?> >Privacy Policy</option>
<option <?= ($page=="Cancellation and Refund Policy")?"selected":""; ?> >Cancellation and Refund Policy</option>
<option <?= ($page=="Blog")?"selected":""; ?> >Blog</option>
                        </select>
                    </div>
            
                </div>
                
                
                <div class="form-group">
            
                    <div class="col-md-12 mb-12">
<div class="form-group">
    <label>Meta Title</label>
    <input type="text" value="<?= $title; ?>" required class="form-control" placeholder="Meta Title" name="title"/>
</div>
<div class="form-group">
   <label>Meta Keywords</label>
   <textarea class="form-control" required placeholder="Enter Keywords" name="keyword"><?= $keyword; ?></textarea>
</div>          
<div class="form-group">
    <label>Meta Description</label>
    <textarea class="form-control" required placeholder="Enter Description" name="description"><?= $description; ?></textarea>
</div>
                    </div>
            
                </div>
                
                
                </div>

                    <div class="card-footer ">

                        <button class="btn btn-primary btn-block" type="submit">Update Meta</button>

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
            window.location.href = "<?= base_url("admin/meta?page="); ?>"+page;
        }
    });
</script>