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
                List Of Document
            </div>

            <div class="card-body table-reponsive">
        
                <table class="table table-hover table-bordered" id="example">
                    
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>User</th>
                            <th>Document</th>
                            <th>License</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php $a = 1; foreach($documents as $data): ?>

                        <tr>
                            <td><?= $a++; ?></td>
                            
                            <td><?= $this->db->get_where('user', array('user_id'=>$data['user_id']))->row()->name." - ".$this->db->get_where('user', array('user_id'=>$data['user_id']))->row()->contact." <br/>".$this->db->get_where('user', array('user_id'=>$data['user_id']))->row()->email; ?></td>

                            <td>
                                <a data-fancybox="gallery" href="<?= base_url().$data['doc1']; ?>"><img src="<?= base_url().$data['doc1']; ?>" width="50px" class="img img-thumbnail" ></a>
                                 <?php
                                    if($data['doc2']!=""){
                                ?>
                                <a data-fancybox="gallery" href="<?= base_url().$data['doc2']; ?>"><img src="<?= base_url().$data['doc2']; ?>" width="50px" class="img img-thumbnail" ></a>
                                <?php        
                                    }
                                ?>    
                            </td>

                            <td><a data-fancybox="gallery" href="<?= base_url().$data['license']; ?>"><img src="<?= base_url().$data['license']; ?>" width="50px" class="img img-thumbnail" ></a></td>

                            <td>
                                <?php if($data['doc_status'] == 'Pending'){ ?>

                                    <a href="<?= base_url(); ?>admin/user/action?documents_id=<?= $data['documents_id']; ?>&doc_status=Accept" class="text-white btn btn-success btn-sm">
                                        Accept
                                    </a>

                                    <?php /*<a href="<?= base_url(); ?>admin/user/action?documents_id=<?= $data['documents_id']; ?>&doc_status=Reject" class="text-white btn btn-danger btn-sm">
                                        Reject
                                    </a> */ ?>

                                    <span class="text-white btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal<?php echo $data['documents_id']; ?>" class="">
                                        Reject
                                    </span>


                                    <!-- Modal -->
                                    <div id="myModal<?php echo $data['documents_id']; ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                        <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Remark</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="post" action="<?= base_url(); ?>Admin/addDocRemark" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="message-text" class="col-form-label">Remark Message:</label>
                                                            <textarea class="form-control" name="remark" id="message-text" required></textarea>
                                                        </div>
                                                        <input type="hidden" name="documents_id" value="<?php echo $data['documents_id'] ?>">
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Add Remark</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>

                                <?php } else if($data['doc_status'] == 'Accept'){ ?>

                                    <a href="javascript:void(0)" class="text-white btn btn-success btn-sm">
                                        Accepted
                                    </a>

                                <?php } else if($data['doc_status'] == 'Reject'){ ?>

                                    <a href="javascript:void(0)" class="text-white btn btn-danger btn-sm">
                                        Rejected
                                    </a>

                                <?php } ?>

                            </td>

                        </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>



</div>

</div><br/>
</div>






<script>
    $(document).ready(function(){
        
        $("#rejectDoc").click(function(){
            alert($(this).attr('data-attr-id'));

            swal({
                text: 'Reject Remark',
                content: "input",
                button: {
                    text: "Add Remark!",
                    closeModal: false,
                },
            }).then(value=>{
                alert(value);
            });

        });
    });
</script>