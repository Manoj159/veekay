
<?php if(isset($_GET['city_id'])){

$city = $this->db->get_where('city', array('city_id'=>base64_decode($_GET['city_id'])))->result();

foreach($city as $c){ ?>


<div class="row">
    <div class="col-md-6">
        
        <div class="main-card mb-12 card  ">

            <form method="post" action="<?= base_url().'admin/city/update/'.$c->city_id; ?>" enctype="multipart/form-data">

                <div class="card-header">
                    <h5 class="card-title"><?= ucwords('Manage city'); ?></h5>
                </div>

                <div class="card-body">

                    <div class="col-md-12">


                        <div class="row">
                            
                            <div class="col-md-12">
                                <label>City Short Name</label>
                                <input type="text" name="short_name" class="form-control" value="<?= $c->short_name; ?>" required>
                            </div>

                            <div class="col-md-12">
                                <label>City Name</label>
                                <input type="text" name="name" class="form-control" value="<?= $c->name; ?>" required>
                            </div>

                            <div class="col-md-12 form-group">
                                <label>Address</label>
                                <textarea class="form-control" name="address" required><?= $c->address; ?></textarea>
                            </div>

                            <div class="col-md-12 form-group">
                                <label>City Name</label>
                                <input type="file" name="image" class="form-control"  onchange="readURL(this);" />
                                <img src="<?= base_url().$c->image; ?>" id="blah" alt="" width="auto" height="100px">
                            </div>

                        </div><br/>

                            

                        </div>
                    </div>

                <div class="card-footer">

                    <button class="btn btn-primary btn-block" type="submit">Update City</button>

                </div>


            </form>

        </div>

    </div>

</div>
</div>


<?php } } else{ ?>

<div class="row">
    <div class="col-md-6">
        
        <div class="main-card mb-12 card  ">

            <form method="post" action="<?= base_url().'admin/city/add/'; ?>" enctype="multipart/form-data">

                <div class="card-header">
                    <h5 class="card-title"><?= ucwords('Manage city'); ?></h5>
                </div>

                <div class="card-body">

                    <div class="col-md-12">

                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>City Short Name</label>
                                <input type="text" name="short_name" class="form-control" required>
                            </div>

                            <div class="col-md-12 form-group">
                                <label>City Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="col-md-12 form-group">
                                <label>Address</label>
                                <textarea class="form-control" name="address" required></textarea>
                            </div>

                            <div class="col-md-12 form-group">
                                <label>City Name</label>
                                <input type="file" name="image" class="form-control" required onchange="readURL(this);" />
                                <img src="<?= base_url(); ?>uploads/city/default.jfif" id="blah" alt="" width="auto" height="100px">
                            </div>

                        </div>

                    </div>

                </div>

                <div class="card-footer">

                    <button class="btn btn-primary btn-block" type="submit">Add City</button>

                </div>


            </form>

        </div>

    </div>


      <div class="col-lg-6">
     
           <div class="card">
                   
               <div class="card-body table-responsive">
                     
                    <table  id="example" class="table table-hover table-striped table-bordered">
                    
                        <thead>
                          <tr>
                          <th>Sr. No.</th>
                          <th>Name</th>
                          <th>Image</th>
                          <th>Action</th>
                          </tr>
                        </thead>
                    
                        <tbody>
                            
                            <?php  $count = 1; 

                            foreach($city as $data):   ?>

                            <tr>
                              <td><?php echo $count++; ?></td>
                              <td><?= $data['name']; ?></td>
                              <td><img src="<?= base_url().$data['image']; ?>" width="100px" class="img img-thumbnail" ></td>

                              <td>
                                    <a href="<?= base_url(); ?>admin/city?city_id=<?= base64_encode($data['city_id']); ?>" class="text-white btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a href="<?= base_url(); ?>admin/city/delete?city_id=<?= base64_encode($data['city_id']); ?>" onclick="return confirm('Are you sure you want to delete this ?');" class="text-white btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                              </td>
                            </tr>
                        
                        <?php endforeach; ?>
                      
                        </tbody>

                  </table>
                
               </div>

           </div>
     
       
      </div>

</div>
<br/>

</div>


<?php } ?>