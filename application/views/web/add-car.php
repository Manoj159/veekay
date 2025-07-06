

    <!-- About page wrapper start -->

    <section class="inner-page-wraper carneed-page-title">



        <div class="inner-page-banner">

            <div class="container">

                <div class="row">

                    <h1 class="page-title">

                        Add your car

                    </h1>



                    <nav aria-label="breadcrumb">

                        <ol class="breadcrumb">

                          <li class="breadcrumb-item"><a href="#">Home</a></li>

                          <li class="breadcrumb-item active" aria-current="page">Library</li>

                        </ol>

                    </nav>

                </div>

            </div>

        </div>

        

    </section>

    <!-- About page wrapper end -->



    <!-- About page description points start-->

    <section class="about-page-heading pt-5 mb-5">

        <div class="container">

            <div class="row d-flex header-inner">

                    <div class="col-lg-4">

                        <img src="<?= base_url(); ?>/assets/img/about-img.jpg" alt="aboutImg" class="img-fluid"> 

                    </div>

                    <div class="col-lg-8">

                        <div class="content-about">

                            <h2>Now add your car & earn</h2>

                            <p>VeekayCabs allows users to register their car for rental purposes. Users need to fill out a form with their full name, mobile number, email, car brand, car name, and fuel type. Additionally, they must upload copies of their Aadhar card and car registration certificate (RC). For more details, .</p>

                            <a href="#" class="btn-themed" style="text-decoration: none;">Contact us</a>

                        </div>

                    </div>

            </div>

        </div>

    </section>

    <section class="add-car-form">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form acction="/add-car" enctype="multipart/form-data" method="post">
                        <div class="row">
                            <div class="col-lg-4 mb-3">
                            <label class="form-label">Your Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            </div>
                            
                            <div class="col-lg-4 mb-3">
                            <label class="form-label">Your Mobile</label>
                            <input type="number" name="contact" class="form-control" placeholder="Mobile" >
                            </div>
                            
                            <div class="col-lg-4 mb-3">
                            <label class="form-label">Your Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" >
                            </div>
        
                            <div class="col-lg-4 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Car Brand</label>
                            <input type="text" name="brand" class="form-control" placeholder="Brand" >
                            </div>
        
                            <div class="col-lg-4 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Car Name</label>
                            <input type="text" name="car_name" class="form-control" placeholder="Car name" >
                            </div>
        
                            <div class="col-lg-4 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Fuel Type</label>
                            <input type="text" name="fuel" class="form-control" placeholder="Type" >
                            </div>
        
                            <div class="col-lg-4 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Upload aadhar card</label>
                            <input type="file" name="adhaar" class="form-control" placeholder="Type" >
                            </div>
        
                            <div class="col-lg-4 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Upload car RC</label>
                            <input type="file" name="rc" class="form-control" placeholder="Type" >
                            </div>
                            <div class="col-lg-12 mb-3 mt-3">
                            <input type="submit" class="btn-themed" value="Add car">
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
