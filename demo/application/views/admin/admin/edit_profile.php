<div class="row">
	<div class="col-md-6">
		<div class="main-card mb-12 card  ">



            <?php $data = $this->db->get_where('admin', array('id'=>$this->session->userdata('admin_id')))->result_array(); 

                    foreach($data as $data): ?>


            <form class="needs-validation" novalidate method="post" action="<?= base_url().'admin/edit_profile/update_profile'; ?>" enctype="multipart/form-data">

			<div class="card-body">
            
                <h5 class="card-title"><?= ucwords('Update User data'); ?></h5>
                <hr/>
			    


                    <div class="form-group">
			    
                        <div class="col-md-12 mb-12">
			    
                            <label ><?= ucwords('user name'); ?></label>
			    
                            <input type="text" class="form-control"  placeholder="Enter your Name" value="<?= $data['name']; ?>" required name="name">
                
			    
                        </div>
			    
                    </div>
                    
                
                    <div class="form-group">
                
                        <div class="col-md-12 mb-12">
                
                            <label for="validationTooltipUsername">User Email-id</label>
                
                            <div class="input-group">
                
                                <div class="input-group-prepend">
                
                                    <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                
                                </div>
                
                                <input type="email" class="form-control" id="validationTooltipUsername" placeholder="<?= ucwords('user email') ?>" aria-describedby="validationTooltipUsernamePrepend" value="<?= $data['email']; ?>" required name="email">
                
                                <div class="invalid-tooltip">
                                    Please Enter a unique and valid Email-id.
                                </div>
                
                            </div>
                
                        </div>
                
                    </div>

			    
                    <div class="form-group">
			    
                        <div class="col-md-12 mb-12">
			    
                        <label for="example"><?= ucwords('upload image'); ?></label>
                        
                        <input type="file" name="userimage" class="form-control" onchange="readURL(this);" /><br/>
                        
                        <img src="<?= base_url().$this->db->get_where('admin', array('id'=>$this->session->userdata('admin_id')))->row()->image; ?>" id="blah" alt="" width="250px" height="200px">

                        </div>
                    </div>
			    
                </div>

                    <div class="card-footer">

			            <button class="btn btn-primary btn-block" type="submit">Update Profile</button>

                    </div>

                    </form>



                <?php endforeach; ?>

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




 <div class="col-md-6">

        <div class="main-card mb-12 card  ">
            <div class="card-header card-success">
                <h5 class="card-title"><?= ucwords('change your password'); ?></h5>
            </div>


            <form class="needs-validation" novalidate method="post" action="<?= base_url().'admin/edit_profile/changepassword/'; ?>">

                <div class="card-body">
                
                    <div class="form-group">
                
                        <div class="col-md-12 mb-12">
                
                            <label ><?= ucwords('Enter your old Password'); ?></label>
                
                            <input type="text" class="form-control"  placeholder="Enter your old Password" value="" required name="old_password">
                
                            <input type="hidden" class="form-control" value="<?= $data['password']; ?>" required name="current_old_password">
                
                        </div>
                
                    </div> 

                    <div class="form-group">
                
                        <div class="col-md-12 mb-12">
                
                            <label ><?= ucwords('Enter your new Password'); ?></label>
                
                            <input type="text" class="form-control"  placeholder="Enter your New Password" value="" required name="new_password">
                
                        </div>
                
                    </div> 

                    <div class="form-group">
                
                        <div class="col-md-12 mb-12">
                
                            <label ><?= ucwords('Enter your confirm new password'); ?></label>
                
                            <input type="text" class="form-control"  placeholder="Enter your Confirm New Password" value="" required name="confirm_new_password">
                
                        </div>
                
                    </div>


                </div>
                    
                <div class="card-footer">

                    <button class="btn btn-primary btn-block" type="submit">Change Password</button>

                </div>

            </form>

                

        </div>

    </div>

</div>




</div>



