
<div class="modal fade bd-example-modal-lg" role="dialog" id="modalunit<?= $data['contact_id']; ?>"  aria-hidden="true" style="margin-top: 60px;">
    
    <div class="modal-dialog modal-md">
        <div class="modal-content">
         
            <div class="modal-body">
     

            <div class="card-header">
            
                <h5 class="card-title"><?= ucwords('Send Reply'); ?></h5>
            
            </div>
    
        <form method="post" action="<?= base_url(); ?>Admin/contact_request/send_reply"> 
    
            <div class="card-body">

                    <div class="form-group">
                
                        <label><?= ucwords('Email Address'); ?></label>
             
                        <input type="text" name="email" class="form-control" value="<?= $data['email']; ?>" readonly >
                    
                    </div>

                    <div class="form-group">
                
                        <label><?= ucwords('Message'); ?></label>
             
                        <textarea type="text" name="message" class="form-control" rows="5" placeholder="Enter your Message"></textarea>
                    
                    </div>

                    <div class="card-footer">

                      <button class="btn btn-primary btn-block" type="submit">
                        <i class="fa fa-envelope"></i>&nbsp;&nbsp; Send Mail</button>

                    </div>

           
            </div>

    </form>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>

</div>
</div>
