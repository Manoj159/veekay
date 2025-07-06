
<div class="d-flex flex-column-fluid">

    <div class="container">
        
        <div class="row">
            
            <div class="col-md-12">
                
                <div class="card">
                    
                    <div class="card-header bg-primary text-white">
                        
                        <i class="fa fa-share-square-o text-white"></i> Social Link

                    </div>

                    <div class="card-body">

                        <div class="col-md-12 form-group">
                            
                            <form action="<?= base_url(); ?>Admin/social_link/facebook" method="post">

                                <div class="row">
                                    
                                    <div class="col-md-9">
                                    
                                        <div class="input-group">
                                           
                                          <div class="input-group mb-3">
                                           
                                            <div class="input-group-prepend">
                                           
                                              <span class="input-group-text"><i class="fa fa-facebook"></i></span>
                                           
                                            </div>
                                           
                                            <input type="text" class="form-control" name="link" placeholder="Facebook Link" value="<?= $facebook; ?>">
                                          
                                          </div>
                                           
                                        </div>

                                    </div>

                                    <div class="col-md-3">
                                        
                                        <button type="submit" class="btn btn-primary btn-md btn-block"> Save</button>

                                    </div>

                                </div>

                            </form>

                        </div>

                        <div class="col-md-12 form-group">
                            
                            <form action="<?= base_url(); ?>Admin/social_link/instagram" method="post">

                                <div class="row">
                                    
                                    <div class="col-md-9">
                                    
                                        <div class="input-group">
                                           
                                          <div class="input-group mb-3">
                                           
                                            <div class="input-group-prepend">
                                           
                                              <span class="input-group-text"><i class="fa fa-instagram"></i></span>
                                           
                                            </div>
                                           
                                            <input type="text" class="form-control" name="link" placeholder="Instagram Link" value="<?= $instagram; ?>" />
                                          
                                          </div>
                                           
                                        </div>

                                    </div>

                                    <div class="col-md-3">
                                        
                                        <button type="submit" class="btn btn-primary btn-md btn-block"> Save</button>

                                    </div>

                                </div>

                            </form>

                        </div>

                        <div class="col-md-12 form-group">
                            
                            <form action="<?= base_url(); ?>Admin/social_link/linkedin" method="post">

                                <div class="row">
                                    
                                    <div class="col-md-9">
                                    
                                        <div class="input-group">
                                           
                                          <div class="input-group mb-3">
                                           
                                            <div class="input-group-prepend">
                                           
                                              <span class="input-group-text"><i class="fa fa-linkedin"></i></span>
                                           
                                            </div>
                                           
                                            <input type="text" class="form-control" name="link" placeholder="Linkedin Link" value="<?= $linkedin; ?>" />
                                          
                                          </div>
                                           
                                        </div>

                                    </div>

                                    <div class="col-md-3">
                                        
                                        <button type="submit" class="btn btn-primary btn-md btn-block"> Save</button>

                                    </div>

                                </div>

                            </form>

                        </div>

                        <div class="col-md-12 form-group">
                            
                            <form action="<?= base_url(); ?>Admin/social_link/youtube" method="post">

                                <div class="row">
                                    
                                    <div class="col-md-9">
                                    
                                        <div class="input-group">
                                           
                                          <div class="input-group mb-3">
                                           
                                            <div class="input-group-prepend">
                                           
                                              <span class="input-group-text"><i class="fa fa-youtube"></i></span>
                                           
                                            </div>
                                           
                                            <input type="text" class="form-control" name="link" placeholder="YouTube Link" value="<?= $youtube; ?>" />
                                          
                                          </div>
                                           
                                        </div>

                                    </div>

                                    <div class="col-md-3">
                                        
                                        <button type="submit" class="btn btn-primary btn-md btn-block"> Save</button>

                                    </div>

                                </div>

                            </form>

                        </div>

                        <div class="col-md-12 form-group">
                            
                            <form action="<?= base_url(); ?>Admin/social_link/twitter" method="post">

                                <div class="row">
                                    
                                    <div class="col-md-9">
                                    
                                        <div class="input-group">
                                           
                                          <div class="input-group mb-3">
                                           
                                            <div class="input-group-prepend">
                                           
                                              <span class="input-group-text"><i class="fa fa-twitter"></i></span>
                                           
                                            </div>
                                           
                                            <input type="text" class="form-control" name="link" placeholder="Twitter Link"  value="<?= $twitter; ?>" />
                                          
                                          </div>
                                           
                                        </div>

                                    </div>

                                    <div class="col-md-3">
                                        
                                        <button type="submit" class="btn btn-primary btn-md btn-block"> Save</button>

                                    </div>

                                </div>

                            </form>

                        </div>
                          
                    </div>

                </div>

            </div>

        </div>

    </div>

</div><br/>

</div>
