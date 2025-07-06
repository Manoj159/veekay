<div class="app-main">
    <div class="app-sidebar sidebar-shadow <?= $menubarColor; ?>">
        <div class="app-header__logo">
            <div class="logo-src"></div>
            <div class="header__pane ml-auto">
                <div>
                    <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="app-header__mobile-menu">
            <div>
                <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
        <div class="app-header__menu">
            <span>
                <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                    <span class="btn-icon-wrapper">
                        <i class="fa fa-ellipsis-v fa-w-6"></i>
                    </span>
                </button>
            </span>
        </div>    




                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                            <li class="app-sidebar__heading"> </li>

                            <li>
                                <a href="<?= base_url(); ?>admin/" class="<?php if($page_name == "dashboard") { echo 'mm-active'; } ?>" >

                                    <i class="metismenu-icon pe-7s-rocket"></i>
                                    <?= ucwords("dashboard"); ?> 
                                </a>
                            </li>

                            <li class="sub-menu <?php if($page_name == 'edit_profile' || $page_name == 'system_setting' || $page_name == 'about_us' || $page_name == 'privacy' || $page_name == 'refund_policy' || $page_name == 'terms') echo 'mm-active'; ?>">
                                
                                <a href="javascript:void(0)"><i class="metismenu-icon pe-7s-config"></i> Basic Details</a>

                                <ul>

                                    <li>
                                        <a href="<?= base_url(); ?>admin/edit_profile" class="<?php if($page_name == "edit_profile") { echo 'mm-active'; } ?>" >

                                            <i class="metismenu-icon pe-7s-user"></i>
                                            <?= ucwords("Manage profile"); ?> 
                                        </a>
                                    </li>

                                    <li>
                                        <a href="<?= base_url(); ?>admin/system_setting"  class="<?php if($page_name == "system_setting") { echo 'mm-active'; } ?>" >

                                            <i class="metismenu-icon pe-7s-config"></i>

                                            <?= ucwords("system setting"); ?> 
                                        </a>
                                    </li>
                                </ul>

                            </li>

                            <li>
                                <a href="<?= base_url(); ?>admin/city" class="<?php if($page_name == "city") { echo 'mm-active'; } ?>" >

                                    <i class="metismenu-icon fa fa-th"></i>
                                    <?= ucwords("Manage city"); ?> 
                                </a>
                            </li>


                            <li>
                                <a href="<?= base_url(); ?>admin/car" class="<?php if($page_name == "car") { echo 'mm-active'; } ?>" >

                                    <i class="metismenu-icon fa fa-car"></i>
                                    <?= ucwords("Add car"); ?> 
                                </a>
                            </li>

                            <li>
                                <a href="<?= base_url(); ?>admin/list_car" class="<?php if($page_name == "list_car") { echo 'mm-active'; } ?>" >

                                    <i class="metismenu-icon fa fa-list"></i>
                                    <?= ucwords("Car Listing"); ?> 
                                </a>
                            </li>

                            <li>
                                <a href="<?= base_url(); ?>admin/booking_list" class="<?php if($page_name == "booking_list") { echo 'mm-active'; } ?>" >

                                    <i class="metismenu-icon fa fa-list"></i>
                                    <?= ucwords("Booking Listing"); ?> 
                                    
                                    <?php
                                        $booking_count = $this->session->userdata("booking_count");
                                        $booking_count_new = $this->db->get_where("booking", ['status'=>1,'payment_status'=>1])->num_rows();
                                        
                                        $booking_diff = $booking_count_new-$booking_count;
                                    
                                        if($booking_diff > 0){
                                    ?>
                                    <label class="badge badge-success">
                                        <?= $booking_diff; ?>
                                    </label>
                                    <?php        
                                        }
                                    ?>
                                </a>
                            </li>

                            <li>
                                <a href="<?= base_url(); ?>admin/cancel_request" class="<?php if($page_name == "cancel_request") { echo 'mm-active'; } ?>" >

                                    <i class="metismenu-icon fa fa-list"></i>
                                    <?= ucwords("cancel request"); ?> 
                                </a>
                            </li>

                            <li>
                                <a href="<?= base_url(); ?>admin/gallery_image" class="<?php if($page_name == "gallery_image") { echo 'mm-active'; } ?>" >

                                    <i class="metismenu-icon fa fa-image"></i>
                                    <?= ucwords("Gallery Image"); ?> 
                                </a>
                            </li>
                            
                            <li>
                                <a href="<?= base_url(); ?>admin/offer_image" class="<?php if($page_name == "offer_image") { echo 'mm-active'; } ?>" >

                                    <i class="metismenu-icon fa fa-image"></i>
                                    <?= ucwords("Offer Image"); ?> 
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url(); ?>admin/slider_image" class="<?php if($page_name == "slider_image") { echo 'mm-active'; } ?>" >

                                    <i class="metismenu-icon fa fa-image"></i>
                                    <?= ucwords("Slider Image"); ?> 
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url(); ?>admin/testimonial" class="<?php if($page_name == "testimonial") { echo 'mm-active'; } ?>" >

                                    <i class="metismenu-icon fa fa-star"></i>
                                    <?= ucwords("Testimonials"); ?> 
                                </a>
                            </li>
                            

                            <li>
                                <a href="<?= base_url(); ?>admin/contact_request" class="<?php if($page_name == "contact_request") { echo 'mm-active'; } ?>" >

                                    <i class="metismenu-icon pe-7s-phone"></i>
                                    <?= ucwords("contact request"); ?> 
                                </a>
                            </li>

                          <li>
                                <a href="<?= base_url(); ?>admin/coupons" class="<?php if($page_name == "coupons") { echo 'mm-active'; } ?>" >

                                    <i class="metismenu-icon fa fa-ticket"></i>
                                    <?= ucwords("coupons"); ?> 
                                </a>
                            </li>
                           

                            <li>
                                <a href="<?= base_url(); ?>admin/social_link" class="<?php if($page_name == "social_link") { echo 'mm-active'; } ?>" >

                                    <i class="metismenu-icon fa fa-sticky-note-o"></i>
                                    <?= ucwords("Social Media"); ?> 
                                </a>
                            </li>


                            <li>
                                <a href="<?= base_url(); ?>admin/user" class="<?php if($page_name == "user") { echo 'mm-active'; } ?>" >

                                    <i class="metismenu-icon fa fa-user"></i>
                                    <?= ucwords("User documents"); ?> 
                                </a>
                            </li>
                            
                            <li>
                                <a href="<?= base_url(); ?>admin/policy" class="<?php if($page_name == "policy") { echo 'mm-active'; } ?>" >

                                    <i class="metismenu-icon fa fa-file"></i>
                                    <?= ucwords("Manage Policies"); ?> 
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url(); ?>admin/meta" class="<?php if($page_name == "meta") { echo 'mm-active'; } ?>" >

                                    <i class="metismenu-icon fa fa-file"></i>
                                    <?= ucwords("Manage Meta"); ?> 
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url(); ?>admin/blog" class="<?php if($page_name == "blog") { echo 'mm-active'; } ?>" >

                                    <i class="metismenu-icon fa fa-comments"></i>
                                    <?= ucwords("Blogs"); ?> 
                                </a>
                            </li>
                            
                            <li>
                                <a href="<?= base_url(); ?>admin/arrival_departure" class="<?php if($page_name == "arrival_departure") { echo 'mm-active'; } ?>" >

                                    <i class="metismenu-icon fa fa-car"></i>
                                    <?= ucwords("Arrival Departure Cars"); ?> 
                                </a>
                            </li>

                            <li>
                                <a href="<?= base_url(); ?>Admin_login/logout" >

                                    <i class="metismenu-icon pe-7s-door-lock"></i>
                                    <?= ucwords("Logout"); ?> 
                                </a>
                            </li>

                            
                        </ul>
                    </div>
                </div>
            </div>   