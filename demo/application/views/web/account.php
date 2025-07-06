<section class="user-dashboard-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 p-0">
                    <div class="user-sidebar">
                        <div class="align-items-center d-flex flex-column gap-1 justify-content-center pt-4 user-profile">
                            <div class="user-photo">
                                <img src="<?= base_url(); ?>/assets/img/user-avtar.png" alt="avatarImg" class="img-fluid">
                            </div>
                            <h4><?= $u->name; ?></h4>
                            <p><?=$bookingCount;?> Bookings till date</p>
                        </div>
                        <div class="side-nav-user">
                            <ul>
                                <li><a href="<?= base_url(); ?>account" class="menu-link active">  User Profile</a></li>
                                <li><a href="<?= base_url(); ?>account/history" class="menu-link">  Booking History</a></li>
                                <li><a href="<?= base_url(); ?>account/documents" class="menu-link">  Manage Documents</a></li>
                                <li><a href="<?= base_url(); ?>account/verification" class="menu-link">  Profile Verification</a></li>
                                <li><a href="<?= base_url(); ?>/signup/logout" class="menu-link">  Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="user-content-area">
                        <div class="row">
                            <div class="page-title-inner">User Dashboard</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card user-content-card">
                                    <div class="card-header">
                                        <div class="user-page-title">
                                            <h1><img src="<?= base_url(); ?>assets/img/user-info.svg" alt="userInfo"> User Profile</h1>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="user-inner-content">
                                        <form action="<?= base_url(); ?>Account/update_profile" method="post" enctype="multipart/form-data" >
                                            <div class="row">
                                                <div class="mb-3 col-lg-6">
                                                    <label class="form-label"> Name</label>
                                                    <input type="text" class="form-control" name="name" value="<?= $u->name; ?>" autocomplete="off">
                                                </div>
                                                <div class="mb-3 col-lg-6">
                                                    <label class="form-label">Mobile</label>
                                                    <input type="number" class="form-control" name="contact" readonly value="<?= $u->contact; ?>" autocomplete="off" />
                                                </div>
                                                <div class="mb-3 col-lg-12">
                                                    <label class="form-label">Email</label>
                                                    <input type="text" class="form-control" name="email" value="<?= $u->email; ?>" autocomplete="off" />
                                                </div>
                                                <input type="hidden" class="form-control" name="user_id" value="<?= base64_encode($u->user_id); ?>" />

                                                <div class="mb-3 col-lg-12">
                                                    <label class="form-label">Address</label>
                                                    <textarea class="form-control" rows="5" name="address"><?= $u->address; ?></textarea>
                                                </div>
                                                <div class="col-lg-12">
                                                    <button type="submit" class=" btn-themed upload_doc my-3">Update Profile</button>
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                
                                <div class="card user-content-card">
                                    <div class="card-header">
                                        <div class="user-page-title">
                                            <h1> <img src="<?= base_url(); ?>assets/img/book-3.png" alt="icon" style="height: 20px;width: 20px;"> Social Links</h1>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="user-inner-content">
                                            <form action="<?= base_url(); ?>Account/update_social_links" method="post">
                                                <div class="row">
                                                    <div class="mb-3 col-lg-12">
                                                        <label class="form-label">Facebook</label>
                                                        <input type="text" name="facebook" class="form-control" value="<?= $u->facebook; ?>" placeholder="Enter Facebook Link.....">
                                                        <input type="hidden" class="form-control" name="user_id" value="<?= $u->user_id; ?>" />
                                                    </div>
                                                    <div class="mb-3 col-lg-12">
                                                        <label class="form-label">Instagram</label>
                                                        <input type="text" name="instagram" class="form-control" value="<?= $u->instagram; ?>" placeholder="Enter Instagram Link.....">
                                                    </div>
                                                    <div class="mb-3 col-lg-12">
                                                        <label class="form-label">Twitter</label>
                                                        <input type="text" name="twitter" class="form-control" value="<?= $u->twitter; ?>" placeholder="Enter Twitter Link.....">
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <button type="submit" class=" btn-themed upload_doc my-3">Save Changes</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-lg-6">
                                   <div class="card-header">
                                        <div class="user-page-title">
                                            <h1> <img src="<?= base_url(); ?>/assets/img/lock.svg"> Change Password</h1>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="user-inner-content">
                                            <div class="row">
                                                <div class="mb-3 col-lg-12">
                                                    <label class="form-label">Current Password</label>
                                                    <input type="text" class="form-control" placeholder="First name">
                                                </div>
                                                <div class="mb-3 col-lg-12">
                                                    <label class="form-label">News Password</label>
                                                    <input type="text" class="form-control" placeholder="Last name">
                                                </div>
                                                <div class="mb-3 col-lg-12">
                                                    <label class="form-label">Confirm Password</label>
                                                    <input type="text" class="form-control" placeholder="Mobile">
                                                </div>
                                                <div class="col-lg-12">
                                                    <a href="#" class="btn-themed">Save Changes</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                              </div> -->
                               
                           </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>        
    </section>




