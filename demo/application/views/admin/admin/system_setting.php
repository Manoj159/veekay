<div class="row">
	<div class="col-md-5">
		<div class="main-card mb-12 card  ">
			

			<div class="card-body">

                <form class="needs-validation" novalidate method="post" action="<?= base_url().'admin/system_setting/update'; ?>">

			    
                    <div class="form-row">
			    
                        <div class="col-md-12 mb-12">
			    
                            <label for="validationTooltip02">System Title</label>
			    
                            <input type="text" class="form-control" id="validationTooltip02" placeholder="System Title" value="<?= $this->db->get_where('settings', array('type'=>'system_title'))->row()->description; ?>" required name="system_title">
			    
                            <div class="valid-tooltip">
			                    Looks good!
			                </div>
			    
                        </div>
			    
                    </div>
			        
			    
                    <div class="form-row">
			    
                        <div class="col-md-12 mb-12">
			    
                            <label for="validationTooltipUsername">Email-id</label>
			    
                            <div class="input-group">
			    
                                <div class="input-group-prepend">
			    
                                    <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
			    
                                </div>
			    
                                <input type="text" class="form-control" id="validationTooltipUsername" placeholder="Username" aria-describedby="validationTooltipUsernamePrepend" value="<?= $this->db->get_where('settings', array('type'=>'email'))->row()->description; ?>" required name="email">
			    
                                <div class="invalid-tooltip">
			                        Please Enter a unique and valid Email-id.
			                    </div>
			    
                            </div>
			    
                        </div>
			    
                    </div>
                    
                    <div class="form-row">
                
                        <div class="col-md-12 mb-12">
                
                            <label for="validationTooltip06">Contact Number</label>
                
                            <div class="input-group">
                
                            <div class="input-group-prepend">
                
                                <span class="input-group-text" id="validationTooltipUsernamePrepend">
                                    <i class="fa fa-phone"> </i>
                                </span>
                
                            </div>
                
                            <input type="number" class="form-control" id="validationTooltipUsername"  required  placeholder="Contact Number" aria-describedby="validationTooltipUsernamePrepend"  value="<?= $this->db->get_where('settings', array('type'=>'phone'))->row()->description; ?>" name="phone">
                          
                            <div class="invalid-tooltip">
                                Please Enter a valid Contact Number.
                            </div>
                       
                            </div>
                        
                        </div>
                    
                    </div>
			        
			            <div class="form-row">
			        
                            <div class="col-md-12 mb-12">
			        
                                <label for="validationTooltip03">Address</label>
			        
                                <textarea  class="form-control" id="validationTooltip03" required name="address"><?= $this->db->get_where('settings', array('type'=>'address'))->row()->description; ?></textarea>
			        
                                <div class="invalid-tooltip">
			                        Please provide a valid Address
			                    </div>
			        
                            </div>
			        
                    	</div>

			        	<div class="form-row">
			             
                            <div class="col-md-12 mb-12">
			             
                                <label for="validationTooltip012">Refund Amount</label>
			             
                                <input type="text" class="form-control" id="validationTooltip012" placeholder="Refund Amount" required value="<?= $this->db->get_where('settings', array('type'=>'refund'))->row()->description; ?>" name="refund" >
			             
                                <div class="invalid-tooltip">
			                        Please provide a valid state.
			                    </div>
			             
                            </div>
			            
                        </div>

                        <div class="form-row">
                         
                            <div class="col-md-12 mb-12">
                         
                                <label for="validationTooltip012">Home Delivery Charges</label>
                         
                                <input type="text" class="form-control" id="validationTooltip012" placeholder="home delivery" required value="<?= $this->db->get_where('settings', array('type'=>'home_delivery'))->row()->description; ?>" name="home_delivery" >
                         
                                <div class="invalid-tooltip">
                                    Please provide a valid state.
                                </div>
                         
                            </div>
                        
                        </div>

                        <div class="form-row">
                         
                            <div class="col-md-12 mb-12">
                         
                                <label for="validationTooltip012">GST %</label>
                         
                                <input type="text" class="form-control" id="validationTooltip012" placeholder="gst" required value="<?= $this->db->get_where('settings', array('type'=>'gst'))->row()->description; ?>" name="gst" >
                         
                                <div class="invalid-tooltip">
                                    Please provide a valid state.
                                </div>
                         
                            </div>
                        
                        </div>


                        <br>
                        
                            <p><b>Increase Car Price</b></p>

                       


                        <div class="form-row row">
                         
                            <div class="col-md-6 mb-12">
                         
                                <label for="validationTooltip012">Peak time Start</label>
                         
                                <input type="date" class="form-control" id="validationTooltip012" required value="<?= $this->db->get_where('settings', array('type'=>'pick_start_time'))->row()->description; ?>" name="pick_start_time" />
                         
                            </div>

                            <div class="col-md-6 mb-12">
                         
                                <label for="validationTooltip012">Peak time End</label>
                         
                                <input type="date" class="form-control" id="validationTooltip012" required value="<?= $this->db->get_where('settings', array('type'=>'pick_end_time'))->row()->description; ?>" name="pick_end_time" />
                         
                             </div>
                        
                        </div>

                        <div class="form-row">
                         
                            <div class="col-md-12 mb-12">
                         
                                <label for="validationTooltip012">Price Increase Percentage %</label>
                         
                                <input type="text" class="form-control" id="validationTooltip012" placeholder="gst" required value="<?= $this->db->get_where('settings', array('type'=>'price_increase_percentage'))->row()->description; ?>" name="price_increase_percentage" >
                         
                                <div class="invalid-tooltip">
                                    Please provide a valid state.
                                </div>
                         
                            </div>
                        
                        </div>
                        <br>
                        
                            <p><b>Decrease Car Price</b></p>

                           <div class="form-row row">
                         
                            <div class="col-md-6 mb-12">
                         
                                <label for="validationTooltip012">Down time Start</label>
                         
                                <input type="date" class="form-control" id="validationTooltip012" required value="<?= $this->db->get_where('settings', array('type'=>'down_start_time'))->row()->description; ?>" name="down_start_time" />
                         
                            </div>

                            <div class="col-md-6 mb-12">
                         
                                <label for="validationTooltip012">Down time End</label>
                         
                                <input type="date" class="form-control" id="validationTooltip012" required value="<?= $this->db->get_where('settings', array('type'=>'down_end_time'))->row()->description; ?>" name="down_end_time" />
                         
                             </div>
                        
                        </div>

                        <div class="form-row">
                         
                            <div class="col-md-12 mb-12">
                         
                                <label for="validationTooltip012">Price Decrease Percentage %</label>
                         
                                <input type="text" class="form-control" id="validationTooltip012" placeholder="gst" required value="<?= $this->db->get_where('settings', array('type'=>'price_decrease_percentage'))->row()->description; ?>" name="price_decrease_percentage" >
                         
                                <div class="invalid-tooltip">
                                    Please provide a valid state.
                                </div>
                         
                            </div>
                        
                        </div>
                        <br>

			            <button class="btn btn-primary btn-block" type="submit">Update Data</button>

			        </form>

			        <script>
                        (function() {
			                'use strict';
			                window.addEventListener('load', function() {
			                    var forms = document.getElementsByClassName('needs-validation');
			                    var validation = Array.prototype.filter.call(forms, function(form) {
			                        form.addEventListener('submit', function(event) {
			                            if (form.checkValidity() === false) {
			                                event.preventDefault();
			                                event.stopPropagation();
			                            }
			                            form.classList.add('was-validated');
			                        }, false);
			                    });
			                }, false);
			            })();

			        </script>



			    </div>

			</div>

		</div>



	<div class="col-md-7">
		<div class="main-card mb-12 card">

			<div class="card-body">

            <form id="changeHeaderColor">
        
            <h3 class="themeoptions-heading">
               
                <div> Header Options </div>

                <button type="button" class="btn-pill btn-shadow btn-wide ml-auto btn btn-focus btn-sm switch-header-cs-class" id="abcd">
                
                <input type="hidden" value="app-theme-white" name="chnageHeader">
                   
                    Restore Default

                </button>

            </h3>

            <div class="p-3">
                <ul class="list-group">
                    <li class="list-group-item">
                        <h5 class="pb-2"> Choose Color Scheme </h5>

                <div class="theme-settings-swatches">
                   

                   <div class="swatch-holder bg-primary switch-header-cs-class" data-class="bg-primary header-text-light" id="abcd">
                        <input type="hidden" value="bg-primary header-text-light" name="chnageHeader">
                    </div>

                    <div class="swatch-holder bg-secondary switch-header-cs-class" data-class="bg-secondary header-text-light" id="abcd">
                        <input type="hidden" value="bg-secondary header-text-light" name="chnageHeader">
                    </div>

                    <div class="swatch-holder bg-success switch-header-cs-class" data-class="bg-success header-text-dark" id="abcd">
                        <input type="hidden" value="bg-success header-text-dark" name="chnageHeader">
                    </div>

                    <div class="swatch-holder bg-info switch-header-cs-class" data-class="bg-info header-text-dark" id="abcd">
                        <input type="hidden" value="bg-info header-text-dark" name="chnageHeader">
                    </div>

                    <div class="swatch-holder bg-warning switch-header-cs-class" data-class="bg-warning header-text-dark" id="abcd">
                        <input type="hidden" value="bg-warning header-text-dark" name="chnageHeader">
                    </div>

                    <div class="swatch-holder bg-danger switch-header-cs-class" data-class="bg-danger header-text-light" id="abcd">
                        <input type="hidden" value="bg-danger header-text-dark" name="chnageHeader">
                    </div>

                    <div class="swatch-holder bg-light switch-header-cs-class" data-class="bg-light header-text-dark" id="abcd">
                        <input type="hidden" value="bg-light header-text-dark" name="chnageHeader">
                    </div>

                    <div class="swatch-holder bg-dark switch-header-cs-class" data-class="bg-dark header-text-light" id="abcd">
                        <input type="hidden" value="bg-dark header-text-light" name="chnageHeader">
                    </div>

                    <div class="swatch-holder bg-focus switch-header-cs-class" data-class="bg-focus header-text-light" id="abcd">
                        <input type="hidden" value="bg-focus header-text-light" name="chnageHeader">
                    </div>

                    <div class="swatch-holder bg-alternate switch-header-cs-class" data-class="bg-alternate header-text-light" id="abcd">
                        <input type="hidden" value="bg-alternate header-text-light" name="chnageHeader">
                    </div>


                    <div class="divider"></div>


                    <div class="swatch-holder bg-vicious-stance switch-header-cs-class" data-class="bg-vicious-stance header-text-light" id="abcd">
                        <input type="hidden" value="bg-vicious-stance header-text-light" name="chnageHeader">
                    </div>

                    <div class="swatch-holder bg-midnight-bloom switch-header-cs-class" data-class="bg-midnight-bloom header-text-light" id="abcd">
                        <input type="hidden" value="bg-midnight-bloom header-text-light" name="chnageHeader">
                    </div>

                    <div class="swatch-holder bg-night-sky switch-header-cs-class" data-class="bg-night-sky header-text-light" id="abcd">
                        <input type="hidden" value="bg-night-sky header-text-light" name="chnageHeader">
                    </div>

                    <div class="swatch-holder bg-slick-carbon switch-header-cs-class" data-class="bg-slick-carbon header-text-light" id="abcd">
                        <input type="hidden" value="bg-slick-carbon header-text-light" name="chnageHeader">
                    </div>

                    <div class="swatch-holder bg-asteroid switch-header-cs-class" data-class="bg-asteroid header-text-light" id="abcd">
                        <input type="hidden" value="bg-asteroid header-text-light" name="chnageHeader">
                    </div>

                    <div class="swatch-holder bg-royal switch-header-cs-class" data-class="bg-royal header-text-light" id="abcd">
                        <input type="hidden" value="bg-royal header-text-light" name="chnageHeader">
                    </div>

                    <div class="swatch-holder bg-warm-flame switch-header-cs-class" data-class="bg-warm-flame header-text-dark" id="abcd">
                        <input type="hidden" value="bg-warm-flame header-text-dark" name="chnageHeader">
                    </div>

                    <div class="swatch-holder bg-night-fade switch-header-cs-class" data-class="bg-night-fade header-text-dark" id="abcd">
                        <input type="hidden" value="bg-night-fade header-text-dark" name="chnageHeader">
                    </div>

                    <div class="swatch-holder bg-sunny-morning switch-header-cs-class" data-class="bg-sunny-morning header-text-dark" id="abcd">
                        <input type="hidden" value="bg-sunny-morning header-text-dark" name="chnageHeader">
                    </div>

                    <div class="swatch-holder bg-tempting-azure switch-header-cs-class" data-class="bg-tempting-azure header-text-dark" id="abcd">
                        <input type="hidden" value="bg-tempting-azure header-text-dark" name="chnageHeader">
                    </div>

                    <div class="swatch-holder bg-amy-crisp switch-header-cs-class" data-class="bg-amy-crisp header-text-dark" id="abcd">
                        <input type="hidden" value="bg-amy-crisp header-text-dark" name="chnageHeader">
                    </div>

                    <div class="swatch-holder bg-heavy-rain switch-header-cs-class" data-class="bg-heavy-rain header-text-dark" id="abcd">
                        <input type="hidden" value="bg-heavy-rain header-text-dark" name="chnageHeader">
                    </div>

                    <div class="swatch-holder bg-mean-fruit switch-header-cs-class" data-class="bg-mean-fruit header-text-dark" id="abcd">
                        <input type="hidden" value="bg-mean-fruit header-text-dark" name="chnageHeader">
                    </div>

                    <div class="swatch-holder bg-malibu-beach switch-header-cs-class" data-class="bg-malibu-beach header-text-light" id="abcd">
                        <input type="hidden" value="bg-malibu-beach header-text-light" name="chnageHeader">
                    </div>

                    <div class="swatch-holder bg-deep-blue switch-header-cs-class" data-class="bg-deep-blue header-text-dark" id="abcd">
                        <input type="hidden" value="bg-deep-blue header-text-dark" name="chnageHeader">
                    </div>

                   <div class="swatch-holder bg-ripe-malin switch-header-cs-class" data-class="bg-ripe-malin header-text-light" id="abcd">
                        <input type="hidden" value="bg-ripe-malin header-text-light" name="chnageHeader">
                    </div>

                    <div class="swatch-holder bg-arielle-smile switch-header-cs-class" data-class="bg-arielle-smile header-text-light" id="abcd">
                        <input type="hidden" value="bg-arielle-smile header-text-light" name="chnageHeader">
                    </div>

                   <div class="swatch-holder bg-plum-plate switch-header-cs-class" data-class="bg-plum-plate header-text-light" id="abcd">
                        <input type="hidden" value="bg-plum-plate header-text-light" name="chnageHeader">
                    </div>

                    <div class="swatch-holder bg-happy-fisher switch-header-cs-class" data-class="bg-happy-fisher header-text-dark" id="abcd">
                        <input type="hidden" value="bg-happy-fisher header-text-dark" name="chnageHeader">
                    </div>

                    <div class="swatch-holder bg-happy-itmeo switch-header-cs-class" data-class="bg-happy-itmeo header-text-light" id="abcd">
                        <input type="hidden" value="bg-happy-itmeo header-text-light" name="chnageHeader">
                    </div>

                    <div class="swatch-holder bg-mixed-hopes switch-header-cs-class" data-class="bg-mixed-hopes header-text-light" id="abcd">
                        <input type="hidden" value="bg-mixed-hopes header-text-light" name="chnageHeader">
                    </div>

                    <div class="swatch-holder bg-strong-bliss switch-header-cs-class" data-class="bg-strong-bliss header-text-light" id="abcd">
                        <input type="hidden" value="bg-strong-bliss header-text-light" name="chnageHeader">
                    </div>

                   <div class="swatch-holder bg-grow-early switch-header-cs-class" data-class="bg-grow-early header-text-light" id="abcd">
                        <input type="hidden" value="bg-grow-early header-text-light" name="chnageHeader">
                    </div>

                    <div class="swatch-holder bg-love-kiss switch-header-cs-class" data-class="bg-love-kiss header-text-light" id="abcd">
                        <input type="hidden" value="bg-love-kiss header-text-light" name="chnageHeader">
                    </div>

                    <div class="swatch-holder bg-premium-dark switch-header-cs-class" data-class="bg-premium-dark header-text-light" id="abcd">
                        <input type="hidden" value="bg-premium-dark header-text-light" name="chnageHeader">
                    </div>

                    <div class="swatch-holder bg-happy-green switch-header-cs-class" data-class="bg-happy-green header-text-light" id="abcd">
                        <input type="hidden" value="bg-happy-green header-text-light" name="chnageHeader"> 
                    </div>

                </div>
                </li>
            </ul>
        </div>

        </form>



    <form id="changeMenuColor" method="post">
        
        <h3 class="themeoptions-heading">
           
            <div>Sidebar Options</div>
           
            <button type="button" class="btn-pill btn-shadow btn-wide ml-auto btn btn-focus btn-sm switch-sidebar-cs-class" data-class="" id="abcde">

                <input type="hidden" value="app-theme-white" name="chnageHeader">

                Restore Default
            
            </button>
        
        </h3>
        
        <div class="p-3">

            <ul class="list-group">

                <li class="list-group-item">
                    <h5 class="pb-2"> Choose Color Scheme </h5>

                    <div class="theme-settings-swatches">
                        <div class="swatch-holder bg-primary switch-sidebar-cs-class" data-class="bg-primary sidebar-text-light" id="abcde">
                            <input type="hidden" value="bg-primary sidebar-text-light" name="chnagemenu">
                        </div>
                        
                        <div class="swatch-holder bg-secondary switch-sidebar-cs-class" data-class="bg-secondary sidebar-text-light" id="abcde">
                            <input type="hidden" value="bg-secondary sidebar-text-light" name="chnagemenu">
                        </div>
                        
                        <div class="swatch-holder bg-success switch-sidebar-cs-class" data-class="bg-success sidebar-text-dark" id="abcde">
                            <input type="hidden" value="bg-success sidebar-text-dark" name="chnagemenu">
                        </div>
                        
                        <div class="swatch-holder bg-info switch-sidebar-cs-class" data-class="bg-info sidebar-text-dark" id="abcde">
                            <input type="hidden" value="bg-love-kiss sidebar-text-dark" name="chnagemenu">
                        </div>
                        
                        <div class="swatch-holder bg-warning switch-sidebar-cs-class" data-class="bg-warning sidebar-text-dark" id="abcde">
                            <input type="hidden" value="bg-warning sidebar-text-dark" name="chnagemenu">
                        </div>
                       
                        <div class="swatch-holder bg-danger switch-sidebar-cs-class" data-class="bg-danger sidebar-text-light" id="abcde">
                            <input type="hidden" value="bg-danger sidebar-text-light" name="chnagemenu">
                        </div>
                        
                        <div class="swatch-holder bg-light switch-sidebar-cs-class" data-class="bg-light sidebar-text-dark" id="abcde">
                            <input type="hidden" value="bg-light" name="chnagemenu">
                        </div>

                       <div class="swatch-holder bg-dark switch-sidebar-cs-class" data-class="bg-dark sidebar-text-light" id="abcde">
                            <input type="hidden" value="bg-dark sidebar-text-light" name="chnagemenu">
                        </div>
                       
                        <div class="swatch-holder bg-focus switch-sidebar-cs-class" data-class="bg-focus sidebar-text-light" id="abcde">
                            <input type="hidden" value="bg-focus sidebar-text-light" name="chnagemenu">
                        </div>
                       
                        <div class="swatch-holder bg-alternate switch-sidebar-cs-class" data-class="bg-alternate sidebar-text-light" id="abcde">
                            <input type="hidden" value="bg-alternate sidebar-text-light" name="chnagemenu">
                        </div>

                        <div class="divider"></div>

                        <div class="swatch-holder bg-vicious-stance switch-sidebar-cs-class" data-class="bg-vicious-stance sidebar-text-light" id="abcde">
                            <input type="hidden" value="bg-vicious-stance sidebar-text-light" name="chnagemenu">
                        </div>

                        <div class="swatch-holder bg-midnight-bloom switch-sidebar-cs-class" data-class="bg-midnight-bloom sidebar-text-light" id="abcde">
                            <input type="hidden" value="bg-midnight-bloom sidebar-text-light" name="chnagemenu">
                        </div>

                        <div class="swatch-holder bg-night-sky switch-sidebar-cs-class" data-class="bg-night-sky sidebar-text-light" id="abcde">
                            <input type="hidden" value="bg-night-sky sidebar-text-light" name="chnagemenu">
                        </div>

                        <div class="swatch-holder bg-slick-carbon switch-sidebar-cs-class" data-class="bg-slick-carbon sidebar-text-light" id="abcde">
                            <input type="hidden" value="bg-slick-carbon sidebar-text-light" name="chnagemenu">
                        </div>
                        
                        <div class="swatch-holder bg-asteroid switch-sidebar-cs-class" data-class="bg-asteroid sidebar-text-light" id="abcde">
                            <input type="hidden" value="bg-asteroid sidebar-text-light" name="chnagemenu">
                        </div>
                        
                        <div class="swatch-holder bg-royal switch-sidebar-cs-class" data-class="bg-royal sidebar-text-light" id="abcde">
                            <input type="hidden" value="bg-royal sidebar-text-light" name="chnagemenu">
                        </div>
                        
                        <div class="swatch-holder bg-warm-flame switch-sidebar-cs-class" data-class="bg-warm-flame sidebar-text-dark" id="abcde">
                            <input type="hidden" value="bg-warm-flame sidebar-text-dark" name="chnagemenu">
                        </div>
                        
                        <div class="swatch-holder bg-night-fade switch-sidebar-cs-class" data-class="bg-night-fade sidebar-text-dark" id="abcde">
                            <input type="hidden" value="bg-night-fade sidebar-text-dark" name="chnagemenu">
                        </div>
                        
                        <div class="swatch-holder bg-sunny-morning switch-sidebar-cs-class" data-class="bg-sunny-morning sidebar-text-dark" id="abcde">
                            <input type="hidden" value="bg-sunny-morning sidebar-text-dark" name="chnagemenu">
                        </div>
                        
                        <div class="swatch-holder bg-tempting-azure switch-sidebar-cs-class" data-class="bg-tempting-azure sidebar-text-dark" id="abcde">
                            <input type="hidden" value="bg-tempting-azure sidebar-text-dark" name="chnagemenu">
                        </div>
                        
                        <div class="swatch-holder bg-amy-crisp switch-sidebar-cs-class" data-class="bg-amy-crisp sidebar-text-dark" id="abcde">
                            <input type="hidden" value="bg-amy-crisp sidebar-text-dark" name="chnagemenu">
                        </div>
                        
                        <div class="swatch-holder bg-heavy-rain switch-sidebar-cs-class" data-class="bg-heavy-rain sidebar-text-dark" id="abcde">
                            <input type="hidden" value="bg-heavy-rain sidebar-text-dark" name="chnagemenu">
                        </div>
                        
                        <div class="swatch-holder bg-mean-fruit switch-sidebar-cs-class" data-class="bg-mean-fruit sidebar-text-dark" id="abcde">
                            <input type="hidden" value="bg-mean-fruit sidebar-text-dark" name="chnagemenu">
                        </div>
                        
                        <div class="swatch-holder bg-malibu-beach switch-sidebar-cs-class" data-class="bg-malibu-beach sidebar-text-light" id="abcde">
                            <input type="hidden" value="bg-malibu-beach sidebar-text-light" name="chnagemenu">
                        </div>
                        
                        <div class="swatch-holder bg-deep-blue switch-sidebar-cs-class" data-class="bg-deep-blue sidebar-text-dark" id="abcde">
                            <input type="hidden" value="bg-deep-blue sidebar-text-dark" name="chnagemenu">
                        </div>
                        
                        <div class="swatch-holder bg-ripe-malin switch-sidebar-cs-class" data-class="bg-ripe-malin sidebar-text-light" id="abcde">
                            <input type="hidden" value="bg-ripe-malin sidebar-text-light" name="chnagemenu">
                        </div>
                        
                        <div class="swatch-holder bg-arielle-smile switch-sidebar-cs-class" data-class="bg-arielle-smile sidebar-text-light" id="abcde">
                            <input type="hidden" value="bg-arielle-smile sidebar-text-light" name="chnagemenu">
                        </div>
                        
                        <div class="swatch-holder bg-plum-plate switch-sidebar-cs-class" data-class="bg-plum-plate sidebar-text-light" id="abcde">
                            <input type="hidden" value="bg-plum-plate sidebar-text-light" name="chnagemenu">
                        </div>
                        
                        <div class="swatch-holder bg-happy-fisher switch-sidebar-cs-class" data-class="bg-happy-fisher sidebar-text-dark" id="abcde">
                            <input type="hidden" value="bg-happy-fisher sidebar-text-dark" name="chnagemenu">
                        </div>
                        
                        <div class="swatch-holder bg-happy-itmeo switch-sidebar-cs-class" data-class="bg-happy-itmeo sidebar-text-light" id="abcde">
                            <input type="hidden" value="bg-happy-itmeo sidebar-text-light" name="chnagemenu">
                        </div>
                        
                        <div class="swatch-holder bg-mixed-hopes switch-sidebar-cs-class" data-class="bg-mixed-hopes sidebar-text-light" id="abcde">
                            <input type="hidden" value="bg-mixed-hopes sidebar-text-light" name="chnagemenu">
                        </div>
                        
                        <div class="swatch-holder bg-strong-bliss switch-sidebar-cs-class" data-class="bg-strong-bliss sidebar-text-light" id="abcde">
                            <input type="hidden" value="bg-strong-bliss sidebar-text-light" name="chnagemenu">
                        </div>
                        
                        <div class="swatch-holder bg-grow-early switch-sidebar-cs-class" data-class="bg-grow-early sidebar-text-light" id="abcde">
                            <input type="hidden" value="bg-grow-early sidebar-text-light" name="chnagemenu">
                        </div>
                        
                        <div class="swatch-holder bg-love-kiss switch-sidebar-cs-class" data-class="bg-love-kiss sidebar-text-light" id="abcde">
                            <input type="hidden" value="bg-love-kiss sidebar-text-light" name="chnagemenu">
                        </div>
                        
                        <div class="swatch-holder bg-premium-dark switch-sidebar-cs-class" data-class="bg-premium-dark sidebar-text-light" id="abcde">
                            <input type="hidden" value="bg-premium-dark sidebar-text-light" name="chnagemenu">
                        </div>
                        
                        <div class="swatch-holder bg-happy-green switch-sidebar-cs-class" data-class="bg-happy-green sidebar-text-light" id="abcde">
                            <input type="hidden" value="bg-happy-green sidebar-text-light" name="chnagemenu">
                        </div>
                        


                    </div>
                </li>
            </ul>
           </div>

       </form>

         </div>
	   </div>
	</div>
  </div>
</div>





<br/>










<script type="text/javascript">

$(document).on("click","#changeHeaderColor #abcd", function(event) { 

    var color = $(this).children().val();

        event.preventDefault();

        $.ajax({

            url: "<?= base_url(); ?>admin/changeHeaderColortheme",
            method: 'post',
            data: {'chnageHeader':color},
            dataType: 'json',
            success: function(response)
            {
                console.log("color", color);
                $('#abcd').val();
            },
            error: function()
            {
                alert("error");
            }

        });

    });

</script>






<script type="text/javascript">

$(document).on("click","#abcde", function(event) { 

    var Menucolor = $(this).children().val();
    var parentForm = $(this).parents('form#changeMenuColor');
    
    event.preventDefault();

    $.ajax({

        url: "<?= base_url(); ?>admin/changeMenuColortheme",
        type: 'post',
        data: {'chnagemenu' : Menucolor},
        success: function(response)
        {
            console.log("Menucolor", Menucolor);
        },
        error: function()
        {
            alert("error");
        }

    });

    });

</script>


