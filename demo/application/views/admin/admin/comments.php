<div class="row">
	<div class="col-md-6">
		<div class="main-card mb-12 card  ">


			<div class="card">

				<div class="card-header">
                	
                	<h5 class="card-title"><?= ucwords('add comments'); ?></h5>

                </div>
           		
           		<form  method="post" action="<?= base_url().'admin/comments/insert'; ?>" >

			<div class="card-body">
            
                    <div class="form-group">
			    
                        <div class="col-md-12 mb-12">
			    
                            <label ><?= ucwords('user name'); ?></label>
			    
                           <input type="text" class="form-control"  placeholder="Enter user Name" required name="name">
                
                        </div>
			    
                    </div>
			    
                    <div class="form-group">
			    
                        <div class="col-md-12 mb-12">
			    
                            <label ><?= ucwords('user Message'); ?></label>
			    
                            <textarea name="message" placeholder="Enter user Message" class="form-control" rows="5"></textarea>
                
			    
                        </div>
			    
                    </div>

                </div>
			    

                <div class="card-footer">

		            <button class="btn btn-primary btn-block" type="submit">Add Review</button>

                </div>

             </form>
                


            </div>

        </div>

		</div>




 <div class="col-md-6">

        <div class="main-card mb-12 card  ">
            <div class="card-header card-success">
                <h5 class="card-title"><?= ucwords('list of all comments'); ?></h5>
            </div>

            <div class="card-body">
                     
                <table  id="example" class="table table-hover table-striped table-bordered">
            		<thead>
                      <tr>
                            <td>Sr. No</td>
                            <td>Name</td>
                            <td>Message</td>
                            <td>Action</td>
                        </tr>      
                    </thead>
            		<tbody>
                      <?php $a = 1; foreach($comments as $comments): ?>
                        <tr>
                            <td><?= $a++; ?></td>
                            <td><?= $comments['name']; ?></td>
                            <td ><?= $comments['message']; ?></td>
                            <td><a href="<?=  base_url(); ?>admin/comments/delete/<?= $comments['comments_id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this?');"><i class="fa fa-trash"></i></a></td>
                        </tr>
                    <?php endforeach; ?>      
                    </tbody>

            	</table>
            </div>
                

        </div>

    </div>

</div>




</div>



