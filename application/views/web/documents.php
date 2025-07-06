<style>
     .upload_doc{
        background: linear-gradient(25deg, rgba(20,201,148,0.8),rgb(6,135,167)) !important;
        color: white !important;
        border: none !important;
        border-radius: 20px !important;
    }
</style>

<style>
    .section-title h2::after{
        display: none !important;
    }
    .section-title h2{
        position: inherit;
    }
</style>

<?php $user = $this->db->get_where('user', array('user_id'=>$this->session->userdata('user_id')))->result();

  foreach($user as $u){ ?>

<section></section>
<main id="contact" class="py-5 my-account-page">
	
	<section id="contact" class="contact">
      <div class="container">

<nav aria-label="breadcrumb" class="">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= base_url("Account"); ?>">My Account</a></li>
    <li class="breadcrumb-item active" aria-current="page">Manage Documents</li>
  </ol>
</nav>
       
        <div class="section-title">
          <h2 class="text-white">My Account</h2>
        </div>

        <div class="row my-acount-inner">
          
          <div class="col-md-3">
            
            <div class="card sidebar">
              
              <div class="card-body text-center btn_profile_edit">
                
               <div class="row profile_view">
                 
                 <div class="col-sm-12 hlaf_view1">
                    <?php if($u->image == null){ ?>
                    <img alt="happyeasyrides" src="<?= base_url(); ?>uploads/user/default.png" class="img img-thumbnail" width="100" />
                  <?php } else { ?>
                    <img src="<?= base_url().$u->image; ?>" class="img img-thumbnail" alt="happyeasyrides" width="100"  />
                  <?php } ?>
                 </div>

                 <div class="col-sm-12 hlaf_view2">
                  <p><?= $u->name; ?></p>
                  <p><?= $u->contact; ?></p>
                  <p><?= $u->email; ?></p>
                 </div>

               </div>

                <hr/>

                <a href="<?= base_url(); ?>Account" class="btn btn-block btn-outline-dark py-2 mb-3">Edit Profile</a>

                <a href="<?= base_url(); ?>Account/history" class="btn btn-block btn-outline-dark py-2 mb-3">Booking History</a>

                <a href="<?= base_url(); ?>Account/documents" class="btn btn-block btn-outline-dark py-2 mb-3">Manage Documents</a>

                <a href="<?= base_url(); ?>Account/verification" class="btn btn-block btn-outline-dark py-2 mb-3">Profile Verification</a>

              </div>

            </div>

          </div>
          
          <div class="col-md-9">
            
            <div class="card right-content" >
              
              <div class="card-header">
                
                <h3 class="text-center">Upload your documents</h3>

              </div>

                <?php $doc = "Account/upload_documents";
                      foreach($documents as $d){ 

                    $doc = "Account/update_documents"; ?>

                  <div class="row m-3">
                    
                    <?php if($d->doc1 != ''){ ?>
                    
                    <div class="col-md-6">
                      <a href="<?= base_url().$d->doc1; ?>" target="_blank" class="btn btn-outline-primary">View Adhar Card (Front) / Passport</a>
                    </div>

                    <?php }if($d->doc2 != ''){
                    ?>
                    <div class="col-md-6">
                      <a href="<?= base_url().$d->doc2; ?>" target="_blank" class="btn btn-outline-primary">View Adhar Card (Back)</a>
                    </div>
                    <?php    
                    } if($d->license != ''){ ?>

                    <div class="col-md-6">
                      <a href="<?= base_url().$d->license; ?>" target="_blank" class="btn btn-outline-primary">View License</a>
                    </div>

                    <?php } ?>
                  
                  </div>

                <?php  } ?>

                <?php if(@$doc->doc_status != 'Accept'){ ?>

                  <form action="<?= base_url().$doc; ?>" method="post" enctype="multipart/form-data" >
                    
                    <div class="card-body">

                      <div class="row">
                        
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Adhar Card (Front) / Passport</label>
                            <input type="file" class="form-control" name="doc1" autocomplete="off">
                          </div>
                        </div>
                        
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Adhar Card (Back)</label>
                            <input type="file" class="form-control" name="doc2" autocomplete="off">
                          </div>
                        </div><br/>
                        
                        <div class="col-md-6">
                          <label>Driving License</label>
                          <div class="form-group">
                            <input type="file" class="form-control" name="license" autocomplete="off">
                          </div>
                        </div>

                        <input type="hidden" class="form-control" name="user_id" value="<?= base64_encode($u->user_id); ?>" />

                      </div>
                      
                    </div>

                    <div class="card-footer text-center">
                      
                      <button type="submit" class="btn btn-outline-dark upload_doc btn-lg my-3">Upload Documents</button>

                    </div>

                  </form>

                <?php } ?>

            </div>

          </div>

        </div>


      </div>
    </section>

</main>

<?php } ?>