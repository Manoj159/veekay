<section class="user-dashboard-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 p-0">
                    <div class="user-sidebar">
                        <div class="align-items-center d-flex flex-column gap-1 justify-content-center pt-4 user-profile">
                            <div class="user-photo">
                                <img src="<?= base_url(); ?>/assets/img/user-avtar.png" alt="avatar-icon" class="img-fluid">
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
                        <div class="row mb-3">
                            <div class="page-title-inner">Profile Verification</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card user-content-card verification">
                                    <div class="card-header">
                                        <div class="user-page-title">
                                            <h1>Profile Verification</h1>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="user-inner-content">
                                            <img src="<?= base_url(); ?>assets/img/pending-veri.png" alt="verification-icon" style="width: 110px;" class="mb-3">
                                            <h6>Dear User Please Wait, your Profile Under Approval!</h6>
                                            <a href='mailto:varun@veekaycranes.com' class="btn btn-themed"> <i class="fa fa-phone"></i> Contact Admin </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         
                        </div>
                       
                    </div>
                </div>
                
                
            </div>
        </div>        
    </section>