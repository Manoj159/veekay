<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#blah2').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script> 



<?php if($this->session->flashdata('flash_message') != ""): ?>

<script type="text/javascript">
    
swal({
      title: "Good job!",
      text: "<?= $this->session->flashdata('flash_message'); ?>",
      icon: "success",
      button: "Go Back!",
    });

</script>

<?php
$this->session->set_flashdata('flash_message', '');
endif; ?>




<?php if($this->session->flashdata('error_message') != ""): ?>

<script type="text/javascript">
   
swal({
      title: "Error !",
      text: "<?= $this->session->flashdata('error_message'); ?>",
      icon: "error",
      button: "Go Back!",
    });

</script>

<?php 
$this->session->set_flashdata('error_message', '');

endif; ?>



<!-- <div class="modal fade bd-example-modal-lg" role="dialog" id="myModal"  aria-hidden="true" style="margin-top: 20%;">
    
    <div class="modal-dialog modal-md">
        <div class="modal-content">
         
            <div class="modal-body">

            </div>

        </div>

    </div>
</div> -->