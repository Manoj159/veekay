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

  <?php
                $page = "";
                if(isset($_GET["page"])){
                    $page = $_GET["page"];
                    $sql = $this->db->get_where("tbl_pages", ["id"=>$page])->row();
                    $pageId = $sql->id;
                }
            ?>


<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-12 card  ">


        <form class="needs-validation"  method="post" action="<?= base_url().'admin/update_page/update?page='.$pageId?>" >
            <div class="card-body">
            
                <h5 class="card-title"><?= ucwords('Manage Page'); ?></h5>
                <hr/>
            
                <div class="form-group">
            
                    <div class="col-md-12 mb-12">

                    <label>Select Page</label>
                        <select name="parent" id="parent"  class="form-control">
                            <option value="0">Select Page</option>
                            
                            <?php foreach($meta_pages as $key => $value) {?>
                                <option value="<?= $value->id?>"  <?= ($pageId==$value->id)?"selected":""; ?>  ><?= $value->page_title?></option>
                            <?php } ?>
                        </select>
                    </div>
            
                </div>
                
                
                <div class="form-group">
            
                    <div class="col-md-12 mb-12">
                        <div class="form-group">
                            <label>Page Title (Name)</label>
                            <input type="text" value="<?=  $sql->page_title;?>" required class="form-control" placeholder="Page Name" name="page_title"/>
                        </div>
                        
                        <div class="form-group">
                            <label>Meta Title</label>
                            <input type="text" value="<?=  $sql->meta_title;?>" required class="form-control" placeholder="Meta Title" name="meta_title"/>
                        </div>
                        <div class="form-group">
                           <label>Meta Keywords</label>
                           <textarea class="form-control" required placeholder="Enter Keywords" name="meta_keyword"><?=  $sql->meta_keyword;?></textarea>
                        </div>          
                        <div class="form-group">
                            <label>Meta Description</label>
                            <textarea class="form-control" required placeholder="Enter meta description" name="meta_description"><?=  $sql->meta_description;?></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label>Page H1 Tag </label>
                            <textarea class="form-control" placeholder="Enter h1 tag" name="h1_tag" maxlength="60" ><?=  $sql->h1_tag;?></textarea>
                        </div>
                         <div class="form-group">
                            <label>Author</label>
                            <textarea class="form-control" placeholder="Enter  author" name="author" maxlength="60" ><?=  $sql->author;?></textarea>
                        </div>
                         <div class="form-group">
                            <label>Robots</label>
                            <textarea class="form-control" placeholder="Enter  robos" name="robots" maxlength="60" ><?=  $sql->robots;?></textarea>
                        </div>
                          <div class="form-group">
                            <label>Sort Content</label>
                            <textarea class="form-control" placeholder="Enter  sort content" name="short_content" maxlength="500" ><?=  $sql->short_content;?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <textarea class="form-control" placeholder="Enter Page content" name="content"><?=  $sql->content;?></textarea>
                        </div>
                         <div class="form-group">
                           <input type="file"  name="gallery" class="form-control"  style=" display: none;"  /><br/>
                        
                        </div>
   
                        
                    </div>
            
                </div>
                
                
                </div>

                    <div class="card-footer ">

                        <button class="btn btn-primary btn-block" type="submit">Update Page</button>

                    </div>

                    </form>



                </div>


        </div>



</div><br/><br/>


</div>
<script>
    $("#page").change(function(){
       
    });
</script>


<script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace( 'content' );
</script>
