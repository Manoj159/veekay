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
                Page List
            </div>
          
            <div class="card-body table-reponsive">
                  <a type="button" class="btn btn-md btn-info" href="<?= base_url('/admin/add_page')?>" style=" height: 41px; width: 151px; padding: 7px;">Add SEO Page</a>
        
                <table class="table table-hover table-bordered" id="example">
                    
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Page Name</th>
                            <th>Meta Title</th>
                           
                            <th>Keyword</th>
                            <th>Description</th>
                            <th>H1 Tag</th>
                             <th>Link</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <?php //print_r($meta_data); ?>
                    <tbody>

                        <?php 
                            $a = 1; 
                        foreach($meta_data as $data): ?>

                                <tr>
                                    <td><?= $a++; ?></td>
                                    <td><?= $data->page_title?></td>
                                    <td><?= $data->meta_title?></td>
                                  
                                    <td><?= $data->meta_keyword?></td>
                                    <td><?= $data->meta_description?></td>
                                    <td><?= $data->h1_tag?></td>
                                     <td><a  class="btn btn-info" href="<?= base_url('car')?>/<?= $data->slug?>" target="_blank" >Page Link</a</td>
                                    <td><?= date('d-m-Y h:i:s A', strtotime($data->created_on)) ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/update_page?page='.$data->id); ?>" class="btn btn-warning btn-sm text-white">
										    <i class="fa fa-edit"></i>
									    </a>
									    
									    <a href="<?= base_url('admin/delete_page'); ?>?meta_id=<?= base64_encode($data->id); ?>" onclick="return confirm('Are you sure?');" class="btn btn-danger btn-sm text-white">
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