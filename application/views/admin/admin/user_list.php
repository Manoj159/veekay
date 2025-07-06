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
                List Of Users
            </div>

            <div class="card-body table-reponsive">
        
                <table class="table table-hover table-bordered" id="example">
                    
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>User</th>
                            <th>Mobile Number</th>
                            <th>Email</th>
                            <th>Mobile Sysnc</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php $a = 1; foreach($users as $data): ?>
                           
                        <tr>
                            <td><?= $a++; ?></td>
                            
                            <td> <?php  echo $data['name']; ?></td>

                            <td> <?php  echo $data['contact']; ?></td>

                            <td><?php  echo $data['email']; ?>  </td>

                            <td> <?= $this->db->get_where('user_contact', array('user_id'=>$data['user_id']))->row()->contact_no ?>
                            
                         

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