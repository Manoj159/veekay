<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php if($this->session->flashdata('success_register') != ""): ?>

<script type="text/javascript">
	
	swal({
		  title: "Good job!",
		  text: "<?= $this->session->flashdata('success_register'); ?>!",
		  icon: "success",
		  button: "Go Back!",
		});

</script>

<?php 
$this->session->set_flashdata('success_register', '');
endif; ?>


<?php if($this->session->flashdata('login_falied') != ""): ?>

<script type="text/javascript">
	
	swal({
		  title: "Error!",
		  text: "<?= $this->session->flashdata('login_falied'); ?>!",
		  icon: "error",
		  button: "Go Back!",
		});

</script>

<?php
$this->session->set_flashdata('login_falied', '');


endif; ?>





<script type="text/javascript">
$(document).ready(function () {
 
      $('#loginForm').validate({
        rules: {
          email: {
            required: true,
            email: true,
          },
          password: {
            required: true,
            minlength: 5
          }
        },
        messages: {
          email: {
            required: "Please enter a email address",
            email: "Please enter a vaild email address"
          },
          password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 5 characters long"
          }
        },

        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },

        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },

        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
});
</script>


