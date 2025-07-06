<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
       <link href="<?= base_url(); ?>assets/sec.css" rel="stylesheet">
             <script src="<?= base_url(); ?>/assets/sec.js" ></script>
             
             
<div  class="footer pt-5 pb-2">
   <div class="container">
      <div class="row">
         <div class="col-md-3">
            <img src="<?= base_url(); ?>/assets/img/VeekayCabs-logo1.png" style="max-width: 150px; height:38px" alt="veekaycabs Provides Self Drive car rental services in Delhi NCR" >
            <p class="description-text mt-3">Veekaycabs allows up to 120 km/hr. However it is 80 km/hr in a few cities where some cars might be equip with speed governors as per government directives.</p>
            <a href="https://www.facebook.com/veekaycabs/"><img src="<?= base_url(); ?>/assets/img/fb.png"  alt="veekaycabs Provides Self Drive car rental services in Delhi NCR" ></a>
            <a href="https://www.instagram.com/veekay_cabs"> <img src="<?= base_url(); ?>/assets/img/insta.png"  alt="veekaycabs Provides Self Drive car rental services in Delhi NCR" ></a>
           <!-- X (Twitter) -->
            <a href="https://x.com/veekaycabs" target="_blank">
              <img src="<?= base_url(); ?>/assets/img/X.jpg" alt="Veekaycabs X (Twitter)">
            </a>
            
            <!-- LinkedIn -->
            <a href="https://www.linkedin.com/company/veekaycabs/" target="_blank">
              <img src="<?= base_url(); ?>/assets/img/links.png" alt="Veekaycabs LinkedIn">
            </a>
            
            <!-- Pinterest -->
            <a href="https://in.pinterest.com/veekay_cabs/" target="_blank">
              <img src="<?= base_url(); ?>/assets/img/pinterest.webp" alt="Veekaycabs Pinterest" style="height: 21px;">
            </a>
         </div>
         <div class="col-md-3">
            <h2 class="footer-head">Useful Links</h2>
            <ul class="footer-menu">
               <li><a href="/">Self Drive Car Rental</a></li>
               <li><a href="/terms">Terms & Conditions</a></li>
               <li><a href="/terms/privacy">Privacy policy</a></li>
               <li><a href="/terms/refund">Cancellation & Refund policy</a></li>
                <li><a href="<?php echo base_url().'sitemap.html'; ?>">Site map</a></li>
            </ul>
         </div>
         <div class="col-md-6">
            <h2 class="footer-head">Contact Us</h2>
            <p><img class="me-1" src="<?= base_url(); ?>/assets/img/place.png"  alt="veekaycabs Provides Self Drive car rental services in Delhi NCR">DELHI OFFICE :  A 13, 1st floor, Ganesh Nagar, New Delhi, Delhi 110092 </p>
              <p><img class="me-1" src="<?= base_url(); ?>/assets/img/place.png" alt="veekaycabs Provides Self Drive car rental services in Delhi NCR" >LUCKNOW OFFICE : Flat No. 1007, 10th Floor, Skyline Plaza-3, Sushant Golf City, Lucknow.</p>
            <p><img class="me-1" src="<?= base_url(); ?>/assets/img/local_phone.png"  alt="veekaycabs Provides Self Drive car rental services in Delhi NCR" >+91 99999 26867 , +91 9311826201 , +91 8448586825 </p>
            <p><img class="me-1" src="<?= base_url(); ?>/assets/img/mail.png"  alt="veekaycabs Provides Self Drive car rental services in Delhi NCR" >sales@veekaycabs.com </p>
         </div>
         <div class="col-md-3">
            <!--  <h2 class="footer-head">Subscribe Our News Letter</h2>
               <p>Keep up on our always evolving products features and technology. 
               
                Subscribe to our newsletter.</p> -->
            <!-- <form action="" class="newsletter">
               <input class="form-control" placeholder="enter email">
               
               <button class="btn btn-block btn-primary btn-themed-color w-100 mt-3">Subscribe</button>
               
               </form> -->
         </div>
      </div>
    
      <div class="row footer-content mt-3">
        
                           <?php $seores= $this->db->order_by('id','asc')->get_where('tbl_pages', array('status'=>1))->result();
                              foreach($seores as $seo){ ?>   
                              <h2 class="mt-3" style="font-size: 20px;" ><a href="<?= base_url('car').'/'.$seo->slug; ?>" title="<?= $seo->page_title; ?>" style="color: #cccccc87;text-decoration: none;" ><?= $seo->page_title; ?> </a></h2>
                             <p><?= $seo->short_content; ?></p>
                        <?php } ?> 
                          <h2 class="mt-4" style="font-size: 20px;" ><a href="<?= base_url('about-us') ?>" title="" style="color: #cccccc87;text-decoration: none;" >  About Company  </a></h2>
                         <p>Veekay Cabs is a premier self-drive car rental service that offers customers the freedom to journey at their own pace. Whether for a weekend getaway, a business trip, or simply exploring new destinations, our diverse fleet caters to all needs and preferences. From compact cars for city travel to spacious SUVs for family trips, we ensure that our vehicles are well-maintained and equipped with modern amenities for a seamless driving experience.
At Veekay Cabs, customer satisfaction is our priority. We provide easy online booking, transparent pricing, and flexible rental periods to enhance convenience and ensure a smooth rental experience. Our 24/7 customer support team is always ready to assist with any queries or concerns.
Choose Veekay Cabs for a reliable, hassle-free, and enjoyable driving experience. Drive your adventure with us!<br/> Enquiry 9999926867 |Email Us: sales@veekaycabs.com  </p>
          </div>
          
          
        
   </div>
</div>
<div class="copyright text-center">
   <p class="m-0">© veekaycabs <?php echo date('Y') ?>    </p>
</div>
<section class="mobile-bottom-bar desktop-none">
   <a href="" class="active"> <img src="<?= base_url(); ?>/assets/img/home-2.svg" alt="icons"> Home</a>
   <a href=""> <img src="<?= base_url(); ?>/assets/img/booking.svg" alt="icons"> Booking</a>
   <a href="tel:91-847-555-5555" class="middle"> <img src="<?= base_url(); ?>/assets/img/call-white.svg" alt="icons"></a>
   <a href=""> <img src="<?= base_url(); ?>/assets/img/car.svg" alt="icons"> Search car</a>
   <a href=""> <img src="<?= base_url(); ?>/assets/img/call.svg" alt="icons"> Call</a>
</section>
<!-- location modal -->
<!-- Modal -->
<div class="modal fade" id="location-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Select Location</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <h2>Servicable Cities</h2>
            <ul>
               <li>Delhi</li>
               <li>Noida</li>
               <li>Gurugram</li>
               <li>Kolkata</li>
               <li>Pune</li>
               <li>Ahmedabad</li>
               <li>Jaipur</li>
            </ul>
         </div>
      </div>
   </div>
</div>
<!-- login sidebar Right -->
<div class="modal" id="login-modal" tabindex="-1" aria-labelledby="rightModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm w-100">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="btn-close login-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <h5 class="modal-title" id="rightModalLabel">Login/Register</h5>
         </div>
         <div class="modal-body">
            <form method="post" action="<?= base_url(); ?>Signup/check_otp" id="otpChecker">
               <div class="form-group">
                  <label for="" class="form-label">Enter Mobile number</label>
                  <p class="desc">Please login for Better Experience, Order tracking & Regular updates</p>
                  <label class="text-success" id="smessage"></label>
                  <div class="input-group-prepend mobile-input">
                     <span class="input-group-text" id="basic-addon1"><img  alt="veekaycabs Provides Self Drive car rental services in Delhi NCR" src="<?=  base_url(); ?>assets/img/india.png" width="30px">&nbsp; + 91</span>
                     <input type="text" class="form-control" placeholder="Enter Mobile Number" minlength="9" maxlength="10" aria-label="Username" aria-describedby="basic-addon1" name="contact" id="contacts" value="<?= ($this->session->userdata('contact') != '') ? $this->session->userdata('contact') : ''; ?>" ></br>
                  </div>
                  <label class="text-danger" id="message"></label>
               </div>
               <div class="col-lg-12" id="otp">
                    <p  class="text-danger" onclick="changenumber()">Change Number</p>
                  <div class="input-group mb-1">
                     <input type="text" class="form-control otp-input" placeholder="Enter OTP" aria-label="otp" aria-describedby="basic-addon1" minlength="6" required name="otp" >
                  </div>
                  <small style="cursor: pointer;" id="resendBtnHere"><span style="cursor: pointer;" onclick="resend_otp()" class="d-block py-2 text-capitalize text-center text-dark"  class="text-center">Otp Not Recived? <span class="text-danger">Re-Send</span></span></small>
               </div>
               <div class="col-lg-12">
                  <button class="btn btn-block btn-primary border-0" type="button" style="width:100%; color:#fff; border: 1px solid #8cbaff ;" id="send_otp" >
                  Send OTP
                  </button>
                  <button class="btn btn-block btn-primary d-none border-0" type="submit" style="width:100%; color:#fff; border: 1px solid #8cbaff ;" id="verify_otp" >
                  Verify OTP
                  </button>
               </div>
               <!-- <div class="col-lg-12 mt-3" id="resend">
                  <a href="<?= base_url(); ?>Signup/change_number" class="text-center">Something Went Wrong? <label class="text-danger">Change Number</label></a>
                  
                  </div> -->
               <hr class="mt-4" />
               <!-- <div class="social-login">
                  <p>Social Login</p>
                  
                  <a href="#"> Login with Google <img src="./img/google.png"></a>
                  
                  <a href="#"> Login with Facebook <img src="./img/fb.png"></a>
                  
                  </div> -->
               <p class="desc privacy-text">
                  By continuing I agree with the <a href="#">Privacy Policy</a>, <a href="#">Terms & Conditions</a>
               </p>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- login sidebar Right end -->
<!-- login sidebar Right -->
<!-- <div class="modal right" id="login-modal" tabindex="-1" aria-labelledby="rightModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm w-100">
   
       <div class="modal-content">
   
           <div class="modal-header">
   
           <button type="button" class="btn-close login-close" data-bs-dismiss="modal" aria-label="Close"></button>
   
           <h5 class="modal-title" id="rightModalLabel">Login/Register</h5>
   
           </div>
   
           <div class="modal-body">
   
               <div class="input-field d-none">
   
                   <div class="form-group">
   
                       <label for="" class="form-label">Enter Mobile number</label>
   
                       <p class="desc">Please login for Better Experience, Order tracking & Regular updates</p>
   
                       <input type="number" placeholder="Enter Mobile Number">
   
                   </div> 
   
   
   
                   <form>
   
                   <div class="action">
   
                       <button class="login-btn">Get OTP</button>
   
                   </div>
   
                   </form>
   
   
   
                   <hr class="mt-4"/>
   
                   <div class="social-login">
   
                   <p>Social Login</p>
   
                   <a href="#"> Login with Google <img src="<?= base_url(); ?>/assets/img/google.png"></a>
   
                   <a href="#"> Login with Facebook <img src="<?= base_url(); ?>/assets/img/fb.png"></a>
   
                   </div>
   
               </div>
   
               <div class="otp-field d-block">
   
   
   
                   <div class="form-group">
   
                       <label for="" class="form-label">Enter OTP</label>
   
                       <p class="desc">Please enter OTP to verify your account.</p>
   
                   </div> 
   
                   <div class="otp-items">
   
                       <input type="number">
   
                       <input type="number">
   
                       <input type="number">
   
                       <input type="number">
   
                       <input type="number">
   
                       <input type="number">
   
                   </div>
   
                   <div class="action">
   
                       <button class="login-btn">Verify OTP</button>
   
                   </div>
   
   
   
               </div>
   
   
   
               <p class="desc privacy-text">
   
                   By continuing I agree with the <a href="#">Privacy Policy</a>, <a href="#">Terms & Conditions</a>
   
               </p>
   
   
   
           </div>
   
           
   
       </div>
   
   </div>
   
   </div> -->
<!-- login sidebar Right end -->
<!-- mene sidebar left -->
<div class="modal left" id="menu-left-modal" tabindex="-1" aria-labelledby="rightModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm w-100">
      <div class="modal-content">
         <div class="modal-header">
            <div class="left d-flex">
               <button type="button" class="btn-close login-close" data-bs-dismiss="modal" aria-label="Close"></button>
               <h5 class="modal-title" id="rightModalLabel">Menu</h5>
            </div>
            <?php if($this->session->userdata('user_id') == ''){ ?>
            <button class="login-btn" data-bs-toggle="modal" data-bs-target="#login-modal" >Login</button>
            <?php } ?>
            <?php if($this->session->userdata('user_id') != ''){ ?>
            <a  class="login-btn"  href="/account" >Account</a>
            <a  class="login-btn"  href="/logout" >Logout</a>
            <?php } ?>
         </div>
         <div class="modal-body">
            <ul class="menu d-flex">
               <li><a href="<?= base_url(); ?>" class="active">Home</a></li>
               <!-- <li><a href="<?= base_url(); ?>assets/monthly.html">Monthly</a></li> -->
               <li><a href="<?= base_url("about-us"); ?>">Add Car</a></li>
               <li><a href="<?= base_url("blogs"); ?>">Blogs</a></li>
               <li><a href="<?= base_url("contact"); ?>">Contact Us</a></li>
            </ul>
         </div>
      </div>
   </div>
</div>
<!-- login sidebar Right end -->
<script src="<?= base_url(); ?>/assets/js/bootstrap.bundle.min.js" ></script>
<script src="<?= base_url(); ?>/assets/js/slick.min.js" ></script>
<script type="text/javascript" src="<?= base_url(); ?>/assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script src="<?= base_url(); ?>/assets/js/site.js"> </script>
<script type="text/javascript">
   $("#resendBtnHere").on("click", function(){
       $("#resendBtnHere").addClass("d-none");
       setTimeout(() => {
           $("#resendBtnHere").removeClass("d-none");
       }, 30000);
   });
   
   var otp = '<?= $this->session->userdata('otp') ?>'
   
   
   
   if(otp != ''){
   $('#send_otp').show();
   
   $('#otp').show();
   
   $('.login_type').hide();
   
   $('#send_otp').removeAttr('type');
   
   $('#send_otp').attr('type','submit');
   
   //  $('#contacts').attr('readonly',true);
   
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
       $('#send_otp').removeClass('d-none');
   
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
    $("#smessage").html("");
   
   
      $.ajax({
   
              url: '<?= base_url(); ?>Signup/send_otp',
   
              method: 'post',
   
              data: {contact: contact},
   
              success:function(response){
   
                 $("#smessage").html('Otp Sent Successfully');
                
                 $('#otp').show();
   
                 $('#resend').show();    
   
                 //$('#contacts').attr('readonly',true);
   
                 /*$('#send_otp').removeAttr('type');
   
                 $('#send_otp').attr('type','submit');
   
                 $('#send_otp').html('Verify OTP');*/
   
                 $('#send_otp').addClass('d-none');
   
                 $('#verify_otp').removeClass('d-none');
   
              }
   
          });
   
   });
   
   }
    
   
   function resend_otp()
   {
   var contacts = $("#contacts").val();
    $("#message").html("");
    $("#smessage").html("");
   if(contacts.length<10)
   {
       $("#message").html("Please enter valid number");
   
       return false;
   }
   $.ajax({
   
              url: '<?= base_url(); ?>Signup/resend_otp',
              method: 'post',
              data: {contacts},
              success:function(response){
                  $("#smessage").html('Otp Sent Successfully');
                 
              }
   
   });
   }
   
   function changenumber (){
   
    $.ajax({
       
                  url: '<?= base_url(); ?>Signup/unset',
                  method: 'GET',
                  data: {},
                  success:function(response){
                       
                        $('#contacts').val('');
                        $('#otp').show();
                        $('#otp').hide();
                        $('#otp').removeClass('d-none');
                         $('#verify_otp').addClass('d-none');
                       
                  }
       
       });
       
   }
   
   
</script>
<script type="text/javascript">
   // ******************************************************************************************************
   
   //                  Code for showing pop-up if booking days is less then 4 days ////////////////////
   
   // ******************************************************************************************************
   
       $('.book_now_bnt').on('click', function(e){
   
           try{
   
               let startDate = formatDate($('#start-date').val());
   
               let endDate = formatDate($('#end-date').val());
   
               const differenceInDays = getDaysDifference(new Date(startDate), new Date(endDate));
   
               let link = $(this).attr('href');
   
               if( differenceInDays < 4){
   
                   e.preventDefault();
   
                   let message = "Kindly note that your booking includes an allowance of 250 kilometers per 24 hours. Any additional distance beyond this limit will incur a per-kilometer charge, which will be adjusted against your security deposit. ";
   
                   swal(message, {
   
                       hideOnOverlayClick: false,
   
                       allowOutsideClick: false,
   
                       closeOnClickOutside: false,
   
                       closeOnEsc: false,
   
                       allowEscapeKey: false,
   
               
   
                       buttons: {
   
                           cancel: "Cancel",
   
                           confirm: "Ok",
   
                       },
   
                   })
   
                   .then((value) => {
   
                     if(value){
   
                         window.location.href = link;
   
                     }
   
                   });
   
               }
   
           }catch(err){
   
               console.log('error', err);
   
               e.preventDefault();
   
           }
   
       });
   
       
   
       function formatDate(dateString)
   
       {
   
           const [day, month, year, time] = dateString.split(/\s|[-:]/); // Split the string
   
           
   
           // Create a Date object using the components
   
           const inputDate = new Date(`${year}-${month}-${day}T${time}:00`);
   
           
   
           // Extract components
   
           const formattedYear = inputDate.getFullYear();
   
           const formattedMonth = String(inputDate.getMonth() + 1).padStart(2, '0');
   
           const formattedDay = String(inputDate.getDate()).padStart(2, '0');
   
           const formattedHour = String(inputDate.getHours()).padStart(2, '0');
   
           const formattedMinute = String(inputDate.getMinutes()).padStart(2, '0');
   
           
   
           // Format the result
   
           const formattedDate = `${formattedYear}-${formattedMonth}-${formattedDay}`;
   
           return formattedDate;
   
       }
   
       
   
       function getDaysDifference(date1, date2) {
   
           // Convert dates to milliseconds
   
           const time1 = date1.getTime();
   
           const time2 = date2.getTime();
   
       
   
           // Calculate the difference in milliseconds
   
           const timeDiff = Math.abs(time2 - time1);
   
       
   
           // Convert milliseconds to days
   
           const daysDiff = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
   
       
   
           return daysDiff;
   
       }
   
   // ******************************************************************************************************
   
   //                  Code for showing pop-up if booking days is less then 4 days
   
   // ******************************************************************************************************
   
   
   
   
   
   
   
   
   
   
   
   
   
     
   
   $("#find-cars").click(function(e){
   
       e.preventDefault();
   
       checkForHours("searchCarForm");
   
   });
   
   $("#find-cars").click(function(e){
     //  e.preventDefault();
       checkForHours("searchCarForm");
   });
   $("#find-cars2").click(function(e){
     //  e.preventDefault();
       checkForHours("book-form");
   });
   function checkForHours(form_name){
       const start = $("#start-date").val();
       const end = $("#end-date").val();
       const city = $("#get_city").val();
        
        if(city=='' && end=="" && start  ){
           swal({
                     title: "Sorry !!",
                     text: "Please fill all filed .",
                     icon: "warning",
                     timer: 3000
                   });      
           
       }else{
       $.ajax({
           url: "<?= base_url("Welcome/getHrs/"); ?>",
           data: {end: end, start: start},
           type: "GET",
           success: function(res){
               if(res < 24){
                   swal({
                     title: "Sorry !!",
                     text: "Please select minimum 24 hours of booking duration.",
                     icon: "warning",
                     timer: 5000
                   });    
                   return false  ;
               }
                else{
                   $("#"+form_name).submit();
               }
            }
       });
       }
   }
   
   /* $('#dates').hide(); */
   
   
   
   // $('#get_city').change(function(e){
   
   //     $('.search_btn').show();
   
   //     $('#dates').show();
   
   // });
   
   
   
   
   
   //  $('.search_btn').hide();
   
   
   
   $('#start-date').change(async function(e){
   
       
   
       let start_date = $(this).val();
   
       
   
       await $.ajax({
   
           url: "<?= base_url("Welcome/format_change") ?>",
   
           data: {start_date: start_date},
   
           type: "POST",
   
           success: function(res){
   
               start_date = res;
   
           }
   
       });
   
       
   
       const today_date = "<?= date("m-d-Y") ?>";
   
       
   
       var stt = new Date(start_date);
   
       //var stt = Date.parse(start_date);
   
       var stt_month = stt.getMonth();
   
       
   
       stt = stt.getDate();
   
       //let stt_m = stt.getMonth();
   
       
   
       
   
       var endt = new Date(today_date);
   
       var endt_month = endt.getMonth();
   
       endt = endt.getDate();
   
       
   
       //alert(stt+" "+endt);
   
       // || stt_month > endt_month
   
       if(stt > endt || stt_month > endt_month){
   
           removeTimeLimitFromStart();
   
       }
   
       else if(start_date!=today_date){
   
           // isNaN(stt) &&
   
           removeTimeLimitFromStart();
   
       }
   
       else{
   
           addTimeLimitToStart();
   
       }
   
       
   
       changeEndDate(start_date);
   
       $('.search_btn').show();
   
   });
   
   function removeTimeLimitFromStart(){
   
       $('#start-date').datetimepicker({
   
           datepicker:true,
   
           defaultTime:'<?= date('H:i', time()+4800); ?>',
   
           format:'d-m-Y H:i',
   
           formatDate:'d-m-Y H:i',
   
           minDate:'<?= date('Y-m-d'); ?>',
   
           minTime: '00:00'
   
       });
   
   }
   
   function addTimeLimitToStart(){
   
       $('#start-date').datetimepicker({
   
           datepicker:true,
   
           defaultTime:'<?= date('H:i', time()+4800); ?>',
   
           format:'d-m-Y H:i',
   
           formatDate:'d-m-Y H:i',
   
           minDate:'<?= date('Y-m-d'); ?>',
   
           minTime: '<?= date('H:i'); ?>'
   
       });
   
       
   
   }
   
   
   
   $('#end-date').change(function(e){
   
   
   
       $('.search_btn').show();
   
   
   
   });
   
</script>
<script>
   /*  jQuery(document).ready(function () {
   
       jQuery('#start-date').datetimepicker();
   
       jQuery('#end-date').datetimepicker();
   
     }); */
   
   
   
   
   
     // $('#start-date').datetimepicker({
   
     //   datepicker:true,
   
     //   defaultTime:'<?= date('H:i', time()+4800); ?>',
   
     //   format:'d-m-Y H:i',
   
     //   formatDate:'d-m-Y H:i',
   
     //   minDate:'<?= date('Y-m-d'); ?>',
   
     //   minTime: '<?= date('H:i'); ?>'
   
     // });
   
     
   
     // $('#end-date').datetimepicker({
   
     //   datepicker:true,
   
     //   defaultTime:'<?= date('H:i', time()+4800); ?>',
   
     //   format:'d-m-Y H:i',
   
     //   formatDate:'d-m-Y H:i',
   
     //   minDate:'<?= date('Y-m-d', strtotime("+1 day")); ?>',
   
     // });
   
     
   
     function changeEndDate(start_date){
   
         $.ajax({
   
             url: "<?= base_url("Welcome/addHours/"); ?>",
   
             data: {date: start_date},
   
             type: "GET",
   
             success: function(resDate){
   
                 
   
                   $('#end-date').datetimepicker({
   
                      datepicker:true,
   
                      defaultTime:resDate,
   
                      format:'d-m-Y H:i',
   
                      formatDate:'d-m-Y H:i',
   
                      minDate:'<?= date('Y-m-d', strtotime("+1 day")); ?>',
   
                      //minTime:resDate
   
                   });     
   
             }
   
         });
   
     }
   
     
   
     /*
   
     $('#end-date').datetimepicker({
   
       datepicker:true,
   
       defaultTime:'<?= date('H:i', time()+18000); ?>',
   
       format:'d-m-Y H:i',
   
       formatDate:'d-m-Y H:i',
   
       minDate: moment().add(1, "days").toDate(),
   
       minTime: '<?= date('H:i', time()+18000); ?>'
   
     });
   
     */
   
   
   
</script>
<script type="text/javascript">
   $('#carousel-example').on('slide.bs.carousel', function (e) {
   
     var $e = $(e.relatedTarget);
   
     var idx = $e.index();
   
     var itemsPerSlide = 5;
   
     var totalItems = $('.carousel-item').length;
   
     if (idx >= totalItems-(itemsPerSlide-1)) {
   
       var it = itemsPerSlide - (totalItems - idx);
   
       for (var i=0; i<it; i++) {
   
         if (e.direction=="left") {
   
           $('.carousel-item').eq(i).appendTo('.carousel-inner');
   
         }
   
         else {
   
           $('.carousel-item').eq(0).appendTo('.carousel-inner');
   
         }
   
       }
   
     }
   
   });
   
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
   $(document).on("click", ".copy", function(){
   
      const a  =  $(this).attr("row");
   
      const coupon = $("#coupon"+a).val();
   
      navigator.clipboard.writeText(coupon);
   
       
   
       swal({
   
         title: "Copied",
   
         text: `${coupon} coupon copied successfully !!`,
   
         icon: "success",
   
         timer: 1000
   
       });
   
   });
   
</script>
<?php if($this->session->flashdata('coupon_error') != ""): ?>
<script type="text/javascript">
   swal({
   
     title: "Oops!",
   
     text: "<?= $this->session->flashdata('coupon_error'); ?>",
   
     icon: "error",
   
     button: "Go Back!",
   
   });
   
</script>
<?php endif; ?>
<?php
   if(isset($_GET["dter"]) && $_GET["dter"] == 1){
       ?>
<script>
   swal({
     title: "Invalid !",
     text: "Please select valid future date duration.",
     icon: "warning",
     timer: 5000
   });
   /*setTimeout(() => {
       window.location.href="/";
   }, 5000);*/
</script>
<?php
   }
   ?>
<?php if($this->session->flashdata('success_message') != ""): ?>
<script type="text/javascript">
   swal({
   
         title: "",
   
         text: "<?= $this->session->flashdata('success_message'); ?>",
   
         icon: "success",
   
         button: "OK",
   
       });
   
   
   
</script>
<?php
   $this->session->set_flashdata('success_message','');
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
<?php endif; ?>
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
   
</script> 
<script>
   $("#verify_otp").on("click", function(){
       $('#otpChecker').submit(function(event){
        $("#message").html("");
        $("#smessage").html("");
   event.preventDefault();
   var formData = new FormData(this);
   formData.append('ajax', 45);
   $.ajax({
   url: '/Signup/check_otp',
   type: 'POST',
   dataType: 'json',
   data: formData,
   processData: false,
   contentType: false,
   success: function(data){
   	if(data.status == 'success'){
                       location.reload();
   	}
   	else if(data.status == 'error')
   	{
   	      $("#message").html(data.message);
   	}else{
   	
   	}
   },
   
   });
   });
   });
</script> 
<script>
    // function copyCode() {
//     // Get the text from the offer code span
//     var offerCode = document.getElementById("offer-code").innerText;

//     // Create a temporary textarea element to hold the text
//     var tempTextarea = document.createElement("textarea");
//     tempTextarea.value = offerCode;
//     document.body.appendChild(tempTextarea);

//     // Select the text in the textarea
//     tempTextarea.select();
//     tempTextarea.setSelectionRange(0, 99999); // For mobile devices

//     // Copy the text to the clipboard
//     document.execCommand("copy");

//     // Remove the temporary textarea
//     document.body.removeChild(tempTextarea);

//     // Display the copy message
//     var copyMessage = document.getElementById("copy-message");
//     copyMessage.innerText = "Code copied!";
//     copyMessage.style.display = "block";

//     // Hide the message after 2 seconds
//     setTimeout(function() {
//         copyMessage.style.display = "none";
//     }, 2000);
// }

document.addEventListener('DOMContentLoaded', function() {
    // Function to copy code
    function copyCode(event) {
        const codeSection = event.currentTarget;
        const offerCode = codeSection.getAttribute('data-code');

        // Create a temporary textarea element to hold the text
        const tempTextarea = document.createElement('textarea');
        tempTextarea.value = offerCode;
        document.body.appendChild(tempTextarea);

        // Select the text in the textarea
        tempTextarea.select();
        tempTextarea.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text to the clipboard
        document.execCommand('copy');

        // Remove the temporary textarea
        document.body.removeChild(tempTextarea);

        // Display the copy message
        const copyMessage = codeSection.nextElementSibling;
        copyMessage.innerText = 'Code copied!';
        copyMessage.style.display = 'block';

        // Hide the message after 2 seconds
        setTimeout(function() {
            copyMessage.style.display = 'none';
        }, 2000);
    }

    // Attach event listeners to all code sections
    const codeSections = document.querySelectorAll('.code-section');
    codeSections.forEach(function(section) {
        section.addEventListener('click', copyCode);
    });
});



$('.owl-carousel').owlCarousel({
    loop:true,
    margin: 20,
    nav:true,
    freeDrag:true,
    autoplay:true,
    autoplayTimeout:3000,
    mouseDrag:true,
    lazyLoading:true,
    responsive:{
        0:{
            items:1
        },
        
        600:{
            items:1
        },
        800:{
             item:3
        },
        1000:{
            items:4
        }
    }
  });
</script>
</body>
</html>