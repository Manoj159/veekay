

    <!-- About page wrapper start -->

    <section class="inner-page-wraper carneed-page-title">



        <div class="inner-page-banner">

            <div class="container">

                <div class="row">

                    <h1 class="page-title">

                        Delete Account 
                    </h1>



                    <nav aria-label="breadcrumb">

                        <ol class="breadcrumb">

                          <li class="breadcrumb-item"><a href="#">Home</a></li>

                          <li class="breadcrumb-item active" aria-current="page">Delete account</li>

                        </ol>

                    </nav>

                </div>

            </div>

        </div>

        

    </section>

    <!-- About page wrapper end -->



    <!-- About page description points start-->


    <section class="add-car-form">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form action="<?php echo base_url('welcome/delete_user_account'); ?>"  method="get">
                        <div class="row">
                           
                            
                            <div class="col-lg-4 mb-3 form-group">
                            <label class="form-label">Your Mobile</label>
                               <input type="number" name="contact" class="form-control" placeholder="Mobile number"  required >
                            </div>
                            
                          
                            <div class="col-lg-12 mb-3 mt-3">
                              <input type="submit" class="btn-themed" value="Delete Account">
                            </div>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        var msg = "<?=base64_decode($this->input->get('msg'))?>";
        if(msg.length > 0){
            alert(msg);
            window.location.href="/";
        }
    </script>
