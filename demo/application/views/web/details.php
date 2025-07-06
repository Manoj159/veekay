
<main id="contact" class="py-5 login signup-details-complete">
  
  <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2 class="text-white">Signup Details</h2>
        </div>

        <div class="row">

          <div class="col-md-6 offset-3 d-flex align-items-stretch">
               
               <form action="<?= base_url(); ?>Details/register" method="post" class="php-email-form">
                
                     <div class="form-group">
                        <label>Enter Username</label>
                        <input type="text" class="form-control p-2" name="name" placeholder="Enter Username" required>
                     </div>

                     <input type="hidden" class="form-control p-2" name="contact" value="<?= $this->session->userdata('contact'); ?>">
                    
                     <div class="form-group">
                        <label>Enter Email ID</label>
                        <input type="text" class="form-control p-2" name="email" placeholder="Enter Email ID">
                     </div>

                     
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block btn-sm">Register Now</button>
                    </div>

                  </div>
               </form>
            </div>
         </div>
      </div>
   </section>

</main>