<?php
$action="Account/upload_documents";
if($doc->documents_id != ''){
    $action="Account/update_documents"; 
}

?>
<section class="user-dashboard-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 p-0">
                    <div class="user-sidebar">
                        <div class="align-items-center d-flex flex-column gap-1 justify-content-center pt-4 user-profile">
                            <div class="user-photo">
                                <img src="<?= base_url(); ?>/assets/img/user-avtar.png" alt="user-img" class="img-fluid">
                            </div>
                            <h4>user name here</h4>
                            <p><?=$bookingCount;?> Bookings till date</p>
                        </div>
                        <div class="side-nav-user">
                            <ul>
                                <li><a href="/account" class="menu-link">  User Profile</a></li>
                                <li><a href="/account/history" class="menu-link">  Booking History</a></li>
                                <li><a href="/account/documents" class="menu-link active">  Manage Documents</a></li>
                                <li><a href="/account/verification" class="menu-link">  Profile Verification</a></li>
                                <li><a href="<?= base_url(); ?>signup/logout" class="menu-link">  Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                
                <div class="col-lg-9">
                    <div class="user-content-area">
                        <div class="row">
                            <div class="page-title-inner">Documents Uploaded</div>
                        </div>
                        <form action="<?= base_url().$action; ?>" method="post" enctype="multipart/form-data" >
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card user-content-card">
                                        <div class="card-header">
                                            <div class="user-page-title">
                                                <h1> Aadhar card Front</h1>
                                                <button type="button" class="btn-themed" onclick="$('#doc1').click();"> <i class="fa fa-upload"></i> Upload</button>
                                                <input type="file" class="form-control d-none" name="doc1" id="doc1" autocomplete="off">
                                            </div>
                                        </div>
                                        <?php
                                            if($doc->doc1 != ''){
                                        ?>
                                        <div class="card-body">
                                            <div class="user-inner-content document">
                                                <img style="height: 200px; width: 250px;" src="<?= base_url().$doc->doc1; ?>" alt=img>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card user-content-card">
                                        <div class="card-header">
                                            <div class="user-page-title">
                                                <h1> Aadhar card Back</h1>
                                                <button type="button" class="btn-themed" onclick="$('#doc2').click();"> <i class="fa fa-upload"></i> Upload</button>
                                                <input type="file" class="form-control d-none" name="doc2" id="doc2" autocomplete="off">
                                            </div>
                                        </div>
                                        <?php
                                            if($doc->doc2 != ''){
                                        ?>
                                        <div class="card-body">
                                            <div class="user-inner-content document">
                                                <img style="height: 200px; width: 250px;" src="<?= base_url().$doc->doc2; ?>" alt="img">
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    
                                    <div class="card user-content-card">
                                        <div class="card-header">
                                            <div class="user-page-title">
                                                <h1> License</h1>
                                                <button type="button" class="btn-themed" onclick="$('#license').click();"> <i class="fa fa-upload"></i> Upload</button>
                                                <input type="file" class="form-control d-none" name="license" id="license" autocomplete="off">
                                                <input type="hidden" class="form-control d-none" name="user_id" id="user_id" value="<?= base64_encode($this->session->userdata('user_id')); ?>" autocomplete="off">
                                            </div>
                                        </div>
                                        <?php
                                            if($doc->license != ''){
                                        ?>
                                        <div class="card-body">
                                            <div class="user-inner-content document">
                                                <img style="height: 200px; width: 250px;" src="<?= base_url().$doc->license; ?>" alt="licence-img">
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                  <button type="submit" class="btn btn-outline-primary upload_doc btn-lg my-3">Upload Documents</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                
            </div>
        </div>        
    </section>