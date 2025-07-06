<style type="text/css">
    body{
        width: 100%;
        overflow-x: hidden;
    }
</style>

<div class="row">
    <div class="col-md-12">

        <div class="main-card mb-12 card">

            <div class="card-header">
                List Of Contact Request
            </div>

            <div class="card-body table-reponsive">
        
                <table class="table table-hover table-bordered" id="example">
                    
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Message</th>
                            <th>Option</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php $a = 1; foreach($request as $data): ?>

                        <tr>
                            <td><?= $a++; ?></td>
                            <td><?= $data['fname']." ".$data['lname']; ?></td>
                            <td><?= $data['email']; ?></td>
                            <td><?= $data['contact']; ?></td>
                            <td><?= $data['message']; ?></td>
                            
                            <td>
                                <a href="<?= base_url(); ?>admin/contact_request/delete/<?= $data['contact_id']; ?>" onclick="return confirm('Are you sure you want to delete this ?');" class="text-white">
                                    <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </a>
                                

                                <a href="javascript:void(0)" data-toggle="modal" data-target="#modalunit<?= $data['contact_id']; ?>"  class="btn btn-primary">Send Reply</a>

                                <?php include 'send_reply.php'; ?>
                            </td>

                        </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>



</div>

</div>


</div>
