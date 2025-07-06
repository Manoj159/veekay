<main id="contact" class="py-5 login">

  <section id="contact" class="contact">
      <div class="container">
      
<nav aria-label="breadcrumb" class="">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Login</li>
  </ol>
</nav>
        
        <div class="section-title">
          <h3>Login</h3>
        </div>

        <div class="row">

          <div class="col-md-4 offset-4 mt-5 mt-lg-0 d-flex align-items-stretch">
            <form action="<?= base_url(); ?>Login/user_login" method="post" role="form" class="php-email-form  ">
               <div class="form-group mb-4 mt-4">
                  <input type="text" class="form-control p-3" name="email" required placeholder="Enter Email Address">
              </div>
              

              <div class="form-group mb-3">
                  <input type="password" class="form-control p-3" name="password" required placeholder="Enter Password">
              </div>

              <div class="form-group mt-3">
                <button type="submit" class="btn btn-login">CONTINUE</button>
              </div>
             
              <div class="row col-md-12 desc">
               <!--<p> Create new account.<a href="<?= base_url(); ?>"> Click Here. </a></p>-->
              </div>

            </form>
 
          </div>

        </div>

      </div>
    </section>

</main>