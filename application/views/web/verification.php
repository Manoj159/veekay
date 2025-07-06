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
    <li class="breadcrumb-item active" aria-current="page">Profile Verification</li>
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
                
                <h3 class="text-center">Profile Verification</h3>

              </div>

              <?php if(count($documents) > 0){ foreach($documents as $d){ ?>

                  <?php if($d->doc_status == 'Pending'){ ?>

                    <div class="row text-center p-4">
                      
                      <div class="col-md-12">

                        <img alt="happyeasyrides" src="<?= base_url(); ?>assets/img/pending.gif" width='200' >
                        
                        <h4 class="mt-5">Dear User Please Wait, your Profile Under Approval!</h4>

                      </div>

                    </div>

                  <?php } else if($d->doc_status == 'Accept'){ ?>

                    <div class="row text-center p-4">
                      
                      <div class="col-md-12">

                        <img alt="happyeasyrides" src="<?= base_url(); ?>assets/img/accept.gif" width='200' >
                        
                        <h4 class="mt-5">Dear User, your Profile Approved!</h4>

                      </div>

                    </div>

                  <?php } else if($d->doc_status == 'Reject'){ ?>

                    <div class="row text-center p-4">
                      
                      <div class="col-md-12">

                        <img alt="happyeasyrides" src="<?= base_url(); ?>assets/img/reject.png" width='200' >
                        
                        <h4 class="mt-5">Dear User your Profile are rejected, Please re-upload your Documents!</h4>

                      </div>

                    </div>

                  <?php }  ?>

              <?php } }else { ?>

                    <div class="row text-center p-4">
                      
                      <div class="col-md-12">

                        <img alt="happyeasyrides" src="<?= base_url(); ?>assets/img/pending.gif" width='200' >
                        
                        <h4 class="mt-5">Please Upload your Documents!</h4>

                      </div>

                    </div>

                  <?php } ?>

            </div>

          </div>

        </div>


      </div>
    </section>

</main>

<?php } ?>