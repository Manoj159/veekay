<?//= $this->session->userdata('otp'); ?>
<style type="text/css">
   .bi
   {
      font-size: 30px;
   }
   .login-container .heading {
    font-size: 20px;
    font-weight: 600;
    line-height: 28px;
    color: #1f1f1f;
    padding: 16px 0 24px;
 }
   .option{
       font-size: 20px;
       font-weight: 500;
       line-height: 16px;
       padding: 16px 0;
       color: #10a310;
  }
</style>

<style>
    .card{
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        border-radius: 20px;
    }
    
    .img-fluid{
        border-radius: 20px 20px 0 0 !important;
    }
    .btn{
        background: linear-gradient(25deg, rgba(20,201,148,0.8),rgb(6,135,167)) !important;
    }
</style>

<main id="singup">

    <div class="container mt-5 pb-5">
   
      <div class="row d-flex align-items-center">
        
         <div class="col-lg-4 col-md-8 offset-4">
            
            <div class="card  mt-5">
               
               <img alt="happyeasyrides" src="<?=base_url();?>assets/img/icons/bg.png" class="img-fluid" width="100%" >

               <div class="row mt-3 mx-2">
                  
                  <div class="col-lg-12">
                     
                     <h5 class="login-container heading">Enter Contact Number</h5>

                  </div>

                  <form method="post" action="<?= base_url(); ?>Signup/check_otp">

                     <div class="col-lg-12">
                       <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><img alt="happyeasyrides" src="<?=  base_url(); ?>assets/img/india.png" width="30px">&nbsp; + 91</span>
                          </div>
                          <input type="text" class="form-control" placeholder="Enter Mobile Number" aria-label="Username" aria-describedby="basic-addon1" name="contact" id="contacts" value="<?= ($this->session->userdata('contact') != '') ? $this->session->userdata('contact') : ''; ?>" >
                          <label class="text-danger" id="message"></label>
                        </div>
                     </div>
                         

                  <!-- <div class="login_type ">
                      
                        <div class="col-lg-12">
                       
                          <h4 class="text-danger font-weight-bold option">Continue With Email Id</h4>

                        </div><hr/>

                        <div class="col-lg-12">
                          
                          <h5><label class="text-danger font-weight-bold option">Continue via social</label> <label class="mx-3"><img src="<?= base_url(); ?>assets/img/facebook.svg" /> <img src="<?= base_url(); ?>assets/img/google.svg" /></label></h5>

                        </div>

                  </div> -->

                     <div class="col-lg-12" id="otp">
                       <div class="input-group mb-1">
                          <input type="text" class="form-control" placeholder="Enter OTP" aria-label="otp" aria-describedby="basic-addon1" minlength="6" required name="otp" >
                        </div>
                          <small><a href="<?= base_url(); ?>Signup/resend_otp" class="text-center">Otp Not Recived? <label class="text-danger">Re-Send</label></a></small>
                     </div>

                      <div class="col-lg-12">

                        <button class="btn btn-block btn-primary" type="button" style="width:100%; color:#fff; border: 1px solid #8cbaff ;" id="send_otp" >
                           Send OTP
                        </button>
                        <button class="btn btn-block btn-primary d-none" type="submit" style="width:100%; color:#fff; border: 1px solid #8cbaff ;" id="verify_otp" >
                           Verify OTP
                        </button>

                     </div>
                     <div class="col-lg-12 mt-3" id="resend">
                        <a href="<?= base_url(); ?>Signup/change_number" class="text-center">Something Went Wrong? <label class="text-danger">Change Number</label></a>
                     </div>

                  </form>

               </div>

            </div>

         </div>

      </div>
    </div>


</main>


<script type="text/javascript">

   var otp = '<?= $this->session->userdata('otp') ?>'

   if(otp != ''){

      $('#send_otp').show();
      $('#otp').show();
      $('.login_type').hide();
      $('#send_otp').removeAttr('type');
      $('#send_otp').attr('type','submit');
      $('#contacts').attr('readonly',true);
      $('#send_otp').html('Verify OTP');
      $('#resend').show();
       
      $('#send_otp').remove();
      $('#verify_otp').removeClass('d-none');
   }
   else{

      $('#resend').hide();
      $('#send_otp').hide();
      $('#otp').hide();

       $('#contacts').keyup(function(e){

         var contact = $('#contacts').val();

         if(contact.length == 10)
         {
           $('#send_otp').show();
           $('.login_type').hide();
           $('#message').hide();
         }else{
           $('#otp').hide();
           $('#message').show();
           $('#message').html('Please Enter only 10 digits mobile number');
           $('#send_otp').hide();
           $('.login_type').show();
         }
       });

       $('#send_otp').click(function(){

         var contact = $('#contacts').val();

          $.ajax({
                  url: '<?= base_url(); ?>Signup/send_otp',
                  method: 'post',
                  data: {contact: contact},
                  success:function(response){
                      console.log(response);
                     alert('Otp Sent Successfully');
                     //window.location.href='';
                     $('#otp').show();
                     $('#resend').show();    
                     $('#contacts').attr('readonly',true);
                     /*$('#send_otp').removeAttr('type');
                     $('#send_otp').attr('type','submit');
                     $('#send_otp').html('Verify OTP');*/
                     $('#send_otp').remove();
                     $('#verify_otp').removeClass('d-none');
                  }
              });
       });
    }


</script>