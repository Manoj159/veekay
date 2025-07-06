

<style type="text/css">
    .closed-sidebar:not(.closed-sidebar-mobile) .app-header .app-header__logo #div
    {
        display: none;
    }
</style>

 <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow <?= $headerColor; ?>">
            <div class="app-header__logo">
               <div id="div" style="color: white; font-size: 20px;"><?= $this->db->get_where('settings', array('type'=>'system_title'))->row()->description; ?></div>
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
            </div>    <div class="app-header__content">
                <div class="app-header-left">
                   <!--  <div class="search-wrapper">
                        <div class="input-holder">
                            <input type="text" class="search-input" placeholder="Type to search">
                            <button class="search-icon"><span></span></button>
                        </div>
                        <button class="close"></button>
                    </div> -->
                    <!-- <ul class="header-menu nav">
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-database"> </i>
                                Statistics
                            </a>
                        </li>
                        <li class="btn-group nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-edit"></i>
                                Projects
                            </a>
                        </li>
                        <li class="dropdown nav-item">
                            <a href="<?= base_url(); ?>admin/system_setting" class="nav-link">
                                <i class="nav-link-icon fa fa-cog"></i>
                                Settings
                            </a>
                        </li>
                    </ul>    -->     </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">

                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">

                                            <img width="42" class="rounded-circle" src="<?= base_url().$this->db->get_where('admin', array('id'=>$this->session->userdata('admin_id')))->row()->image; ?>" alt="">


			                                 <strong style="font-size: 120%"> <?= $this->db->get_where('admin', array('id'=>$this->session->userdata('admin_id')))->row()->name; ?> </strong>
                                             
                                        </a>
                                            
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            <a href="<?= base_url(); ?>admin/edit_profile"> <button type="button" tabindex="0" class="dropdown-item">Edit User Account</button>

                                            
                                           <!--  <h6 tabindex="-1" class="dropdown-header">Header</h6> -->
                                            <a href="<?= base_url(); ?>Admin_login/logout"> <button type="button" tabindex="0" class="dropdown-item">Logout</button></a>

                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            
                                        </div>
                                    </div>
                                </div>
                               
                               
                            </div>
                        </div>
                    </div>        
                </div>
            </div>
        </div>     