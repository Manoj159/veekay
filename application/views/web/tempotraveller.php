<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tempo</title>
   
         <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/css/styless.css"/>
                  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/css/comman.css"/>
    <link rel="stylesheet" href="assets/js/index.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-8A23Z+2XYkzDC6r9BVo3ZqU0XRU+Z0zvhk2MZ1Cv4n1JfTFg1VmzErJ+koMKVgCZRxMnM+i+lW8Dx5k7QWQfQw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&family=Poppins&family=Inter&display=swap" rel="stylesheet">

    <!-- ============ owl============ -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

<!-- ================ -->
 <!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

</head>
<body>
           <div class="main">
  <div class="navbar">
    <div class="logo">
      <img src="<?= base_url(); ?>/assets/images/veekaylogo.png" alt="VE Logo">
    </div>

    <div class="menu-toggle" id="menuToggle">
      <span>&#9776;</span> <!-- Hamburger icon -->
    </div>

    <div class="nav-links" id="navLinks">
      <a href="index.html" class="active">HOME</a>
      <a href="about.html" >ABOUT</a>
      <a href="#">BLOGS</a>
      <a href="#">CONTACT US</a>
      <span class="contact-button">
        <img src="<?= base_url(); ?>/assets/images/24.png" alt="#"> +91 9999920867
      </span>
      <button class="login-button">
        <img src="<?= base_url(); ?>/assets/images/login.png" alt="#"> LOGIN / SIGNUP
      </button>
    </div>
  </div>
</div>
  <!--=========================================  -->
  <div class="content">
    <h2>Lorem Ipsum is simply <span>dummy text of the</span> printing & industry.</h2>
    <p>When an unknown printer took a galley of type & scrambled it to make.</p>
  </div>
  
  <!-- ======================= -->
<section class="tab-section">
  <div class="tab-container" id="tabMenu">
  <a href="#" class="tab active">ONE WAY TRIP</a>
  <a href="#" class="tab">ROUND TRIP</a>
  <a href="#" class="tab">LOCAL TRIP</a>
  <a href="#" class="tab">AIRPORT TRIP</a>
</div>

  <div class="form-container">
    <!-- <div class="form-group"> -->
  <label class="return">Pick Up & Return City</label>
  <div class="location">
  <select class="pickup">
    <option value="">Enter Pickup Location</option>
    <option value="delhi">Delhi</option>
    <option value="mumbai">Mumbai</option>
    <option value="bangalore">Bangalore</option>
    <option value="hyderabad">Hyderabad</option>
    <option value="kolkata">Kolkata</option>
  </select>
<!-- </div> -->
<img src="<?= base_url(); ?>/assets/images/return.png" alt="">
<!-- <div class="form-group"> -->
  <select class="drop">
    <option value="">Enter Drop Location</option>
    <option value="agra">Agra</option>
    <option value="jaipur">Jaipur</option>
    <option value="chandigarh">Chandigarh</option>
    <option value="lucknow">Lucknow</option>
    <option value="goa">Goa</option>
  </select>
<!-- </div> -->
</div>
    <div class="form-groupA">
      <label>Pick Up Date</label>
      <input type="date" class="calendar" value="2024-05-17" />
    </div>
    <div class="form-groupA">
      <label>Pick Up Time</label>
      <input type="time" class="clock" value="08:00" />
    </div>
    <button class="search-btn"><i class="fa-solid fa-magnifying-glass"></i> EXPLORE CABS</button>
  </div>
</section>
<!-- ======================== -->

<!-- =================== -->
<section>
    <div class="dots">
        <img src="<?= base_url(); ?>/assets/images/rent-car.png" alt="#" style="width: 100%;" class="dots-imageA">
        <div class="rental">
            <div class="rental-1" style="width: 40%;">
                <p>Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.</p>
            </div>
            <div class="rental-2">
                <div class="cards">
                    <div class="card">
                        <img src="<?= base_url(); ?>/assets/images/card-1.png" alt="#">
                        <h2>2010</h2>
                        <p>Car Rental Expert since</p>
                    </div>

                    <div class="card">
                        <img src="<?= base_url(); ?>/assets/images/card-2.png" alt="#">
                        <h2>46+</h2>
                        <p>Car Rental Expert since</p>
                    </div>

                    <div class="card">
                        <img src="<?= base_url(); ?>/assets/images/card-3.png" alt="#">
                        <h2>1,800+</h2>
                        <p>Car Rental Expert since</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- ==============  -->
 <section>
    <div class="services">
        <div class="left-services">
            <img src="<?= base_url(); ?>/assets/images/services.png" alt="#" style="width: 100%;">
        </div>
        <div class="right-services">
            <h4 class="headingd-1">Affordable Services</h4>
            <h2 class="heading-2">Rent A Tempo Traveller In Delhi</h2>
            <h3>Affordable Rates For Veekay Luxury Tempo Traveller In Delhi</h3>
            <p class="para-A">Lorem Ipsum is simply dummy text of the printing & typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
            <p class="para-A">when an unknown printer took a galley of type & scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release.</p>
            <p class="red-border">Lorem Ipsum is simply dummy text of the printing & typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>


              <table class="rate-table">
    <thead>
      <tr>
        <th>TT RATES</th>
        <th>OUTSTATION PRICE (PER KM)</th>
        <th>FULL DAY HIRE</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>9–12 SEATER</td>
        <td>STARTING FROM ₹22 /KM</td>
        <td>₹ 2,800</td>
      </tr>
      <tr>
        <td>15–16 SEATER</td>
        <td>STARTING FROM ₹26 /KM</td>
        <td>₹ 2,800</td>
      </tr>
      <tr>
        <td>18–20 SEATER</td>
        <td>STARTING FROM ₹30 /KM</td>
        <td>NA</td>
      </tr>
    </tbody>
  </table>

        </div>
    </div>
 </section>
<!-- ========================= -->
 <!-- ====== ================ -->
  <section class="red-imageE" style="position: relative; height: 85vh;">
    <div class="seating">
        <img src="<?= base_url(); ?>/assets/images/Luxury-tempo.png" alt="#" class="Luxury-tempo">
        <div class="all-mains" style="margin: 20px auto;">
        <h4 class="headingd-1">Our Seating Services</h4>
        <h2 class="heading-2" style="color: #FFF;">Multiple Seating Options On All Our Minibuses</h2>
        <p class="para-A seating-B">Lorem Ipsum is simply dummy text of the printing & typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
    </div>

    
    </div>
    <div class="owl-carousel owl-theme" id="carousel-C">

    <div class="item-B">
      <img src="<?= base_url(); ?>/assets/images/tempo1.png" alt="#">
  </div>

    <div class="item-B">
      <img src="<?= base_url(); ?>/assets/images/tempo2.png" alt="#">
  </div>

    </div>

    <div class="content-B">
      <strong>Hire a 9-12 seater Tempo
Traveller in Delhi</strong>
<p>Lorem Ipsum is simply dummy text of the printing typesetting industry. Lorem Ipsum has been and the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
    </div>
    <img src="<?= base_url(); ?>/assets/images/dots-1.png" alt="#" class="dots-1">
  </section>
  <!-- ===================== -->
   <!-- ====================== -->
    <section>
        <div class="testmonial">
            <div class="all-mains">
            <h4 class="headingd-1">Affordable Services</h4>
            <h2 class="heading-2">Rent A Tempo Traveller In Delhi</h2>
            <section class="testimonial-section">
  <div class="owl-carousel owl-theme" id="carousel-A">

    <div class="item review-card">
      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
      <div class="review-footer">
        <div class="reviewer-info">
            <div>  
                <img src="<?= base_url(); ?>/assets/images/user1.png" alt="user" class="user-image">
            </div>
        <div>  
            <h4> <span style="color: orange;">Lorem Ipsum is simply</span></h4>
              <p>Simply Dummy Text</p>
        </div>
        </div>
        <img src="<?= base_url(); ?>/assets/images/message.png" alt="#" class="message-icon">
    </div>
  </div>

    <div class="item review-card">
      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
      <div class="review-footer">
        <div class="reviewer-info">
            <div>  
                <img src="<?= base_url(); ?>/assets/images/user2.png" alt="user" class="user-image">
            </div>
        <div>  
            <h4> <span style="color: orange;">Lorem Ipsum is simply</span></h4>
              <p>Simply Dummy Text</p>
        </div>
        </div>
        <img src="<?= base_url(); ?>/assets/images/message.png" alt="#" class="message-icon">
    </div>
  </div>

    <div class="item review-card">
      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
      <div class="review-footer">
        <div class="reviewer-info">
            <div>  
                <img src="<?= base_url(); ?>/assets/images/user3.png" alt="user" class="user-image">
            </div>
        <div>  
            <h4> <span style="color: orange;">Lorem Ipsum is simply</span></h4>
              <p>Simply Dummy Text</p>
        </div>
        </div>
        <img src="<?= base_url(); ?>/assets/images/message.png" alt="#" class="message-icon">
    </div>
  </div>
</section>
        </div>
        </div>
    </section>
<!-- ============================ -->
<!-- ============================= -->
<section style="position: relative;">
    <div class="places">
        <div class="all-mains">
            <h4 class="headingd-1">Affordable Services</h4>
                <h2 class="heading-2">Rent A Tempo Traveller In Delhi</h2>
                <p class="tempo">Lorem Ipsum is simply dummy text of the printing & typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>

         
                <div class="owl-carousel owl-theme" id="carousel-D">
                  <div class="item places-card">
                <div class="left">
                    <h3>Weddings</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing typesetting industry. Lorem Ipsum has been & the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley type scrambled it to make a type specimen book.</p>
                </div>
                <img src="<?= base_url(); ?>/assets/images/wedding.png" alt="#" class="wedding-image">
            </div>

            <div class="item places-card">
                <div class="left">
                    <h3>Corporate Events, Offsites,
                        & Employee Transportation</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing typesetting industry. Lorem Ipsum has been & the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley type scrambled it to make a type specimen book.</p>
                </div>
                <img src="<?= base_url(); ?>/assets/images/event.png" alt="#" class="wedding-image">
            </div>
    
  </div>


          <div class="owl-carousel owl-theme" id="carousel-E">
            <div class="item places-card">
                <div class="left">
                    <h3>Pilgrimages</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing typesetting industry. Lorem Ipsum has been & the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley type scrambled it to make a type specimen book.</p>
                </div>
                <img src="<?= base_url(); ?>/assets/images/pilgri.png" alt="#" class="wedding-image">
            </div>


            <div class="item places-card">
                <div class="left">
                    <h3>Amusement Park Outings
                        and Picnics</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing typesetting industry. Lorem Ipsum has been & the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley type scrambled it to make a type specimen book.</p>
                </div>
                <img src="<?= base_url(); ?>/assets/images/parks.png" alt="#" class="wedding-image">
            </div>
    
  </div>
        </div>
        </div>

        <img src="<?= base_url(); ?>/assets/images/right-side.png" alt="#" class="right-side">
</section>
<!-- ==================== -->
<!-- ==================== -->
<section class="choose all-mains">
    <div class="choose-left">
        <img src="<?= base_url(); ?>/assets/images/vekay.png" alt="#">
    </div>

    <div class="choose-right">
        <h4 class="headingd-1">Why Choose Us</h4>
        <h2 class="heading-2">Why hire a Tempo Traveller on
            rent in Delhi with Veekay Cab
            Rentals?</h2>
        <p>Lorem Ipsum is simply dummy text of the printing & typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
        <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised the 1960s with the release Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like.</p>
        <ul>
            <li>
                Lorem Ipsum is simply dummy text the printing & typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took.
            </li>
            <li>
                Lorem Ipsum is simply dummy text the printing and typesetting industry.
            </li>
            <li>
                Lorem Ipsum is simply dummy text the printing & typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took.
            </li>
        </ul>
    </div>

</section>

<!-- =================== fAQ =============== -->
<section class="FAQ">
    <div class="faq">
        <div class="left-faq">
            <img src="<?= base_url(); ?>/assets/images/faq-left.png" alt="#">
        </div>
        <div class="right-faq">
            <h4 class="headingd-1" style="font-size: 24px; margin: 8px;">Our Question And Answer</h4>
        <h2 class="heading-2" style="margin: 8px;">Do you have question? Find
Answer Here</h2>
            <p>Lorem Ipsum is simply dummy text of the printing & typesetting industry. Lorem Ipsum has been the 
industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type 
& scrambled it to make a type specimen book.</p>

  <div class="faq-box">
    <div class="faq-header" onclick="toggleFAQ(this)">
        <button class="toggle-btn white"><i class="fas fa-angle-up"></i></button>
      <div class="faq-question">Lorem Ipsum is simply dummy text of the printing and typesetting.</div>
    </div>
    <div class="faq-answer">
      Lorem Ipsum is simply dummy text of the printing & typesetting industry. Lorem Ipsum has been the industry's
      standard dummy text ever since the 1500s, when an unknown printer took a galley of type & scrambled it to make a type.
    </div> 
  </div>
  <div class="faq-box">
    <div class="faq-header" onclick="toggleFAQ(this)">
        <button class="toggle-btn white"><i class="fas fa-angle-up"></i></button>
      <div class="faq-question">Lorem Ipsum is simply dummy text of the printing and typesetting.</div>
    </div>
    <div class="faq-answer">
      Lorem Ipsum is simply dummy text of the printing & typesetting industry. Lorem Ipsum has been the industry's
      standard dummy text ever since the 1500s, when an unknown printer took a galley of type & scrambled it to make a type.
    </div>
  </div>

  <div class="faq-box">
    <div class="faq-header" onclick="toggleFAQ(this)">
        <button class="toggle-btn white"><i class="fas fa-angle-up"></i></button>
      <div class="faq-question">Lorem Ipsum is simply dummy text of the printing and typesetting.</div>
    </div>
    <div class="faq-answer">
      Lorem Ipsum is simply dummy text of the printing & typesetting industry. Lorem Ipsum has been the industry's
      standard dummy text ever since the 1500s, when an unknown printer took a galley of type & scrambled it to make a type.
    </div>
  </div>

  <div class="faq-box">
    <div class="faq-header" onclick="toggleFAQ(this)">
        <button class="toggle-btn white"><i class="fas fa-angle-up"></i></button>
      <div class="faq-question">Lorem Ipsum is simply dummy text of the printing and typesetting.</div>
    </div>
    <div class="faq-answer">
      Lorem Ipsum is simply dummy text of the printing & typesetting industry. Lorem Ipsum has been the industry's
      standard dummy text ever since the 1500s, when an unknown printer took a galley of type & scrambled it to make a type.
    </div>
  </div>


        </div>
    </div>
</section>
<!-- =================== -->
<!-- =========== feature =========== -->
<section class="features-A">
    <div class="features all-mains">
      <h2 class="heading-2">Featured In</h2>
        <div class="owl-carousel owl-theme" id="carousel-B">

    <div class="item-A">
        <img src="<?= base_url(); ?>/assets/images/feature-1.png" alt="#">
    </div>

    <div class="item-A">
        <img src="<?= base_url(); ?>/assets/images/feature-2.png" alt="#">
    </div>

    <div class="item-A">
        <img src="<?= base_url(); ?>/assets/images/feature-3.png" alt="#">
    </div>

    <div class="item-A">
        <img src="<?= base_url(); ?>/assets/images/feature-4.png" alt="#">
    </div>

    <div class="item-A">
        <img src="<?= base_url(); ?>/assets/images/feature-5.png" alt="#">
    </div>

    <div class="item-A">
        <img src="<?= base_url(); ?>/assets/images/feature-6.png" alt="#">
    </div>
    </div>
    </div>
    <img src="<?= base_url(); ?>/assets/images/feature.png" alt="#" class="feature-back">
</section>

<!-- ========= footer ====================== -->

<footer class="footer">
  <div class="footer-wrapper">

    <!-- Left Column: About -->
    <div class="footer-left">
      <img src="<?= base_url(); ?>/assets/images/footer-logo.png" alt="#" class="footer-logo">
      <p>Veekay Cabs allows up to 120 km/hr. However, it is 80 km/hr in a few cities where some cars might be equipped with speed governors as per government directives.</p>
      <div class="social-icons">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-google-plus-g"></i></a>
      </div>
    </div>

    <!-- Middle Column: Our Links + Support -->
    <div class="footer-center">
      <div class="footer-column">
        <h3>OUR LINKS</h3>
        <a href="#">Home</a>
        <a href="#">Blogs</a>
        <a href="#">Contact Us</a>
        <a href="#">Add Your Car</a>
      </div>
      <div class="footer-column">
        <h3>SUPPORT</h3>
        <a href="#">Self Drive Car Rental</a>
        <a href="#">Terms & Conditions</a>
        <a href="#">Privacy Policy</a>
        <a href="#">Cancellation & Refund Policy</a>
      </div>
    </div>

    <!-- Right Column: App Download -->
    <div class="footer-right">
      <h3>DOWNLOAD APP</h3>
      <img src="<?= base_url(); ?>/assets/images/google.png" alt="#" style="width: 100%;">
    </div>

  </div>

  <!-- ====== -->
   <div class="seo-links">
    <div class="links-seo">
  <div class="seo-header toggle-seo" onclick="toggleSEO(this)">
    <h3>About Company</h3>
    <img src="<?= base_url(); ?>/assets/images/footer-icon.png" alt="Toggle Icon" class="seo-toggle-icon" />
  </div>
  <p class="seo-text" style="display: none;">
    Veekay Cabs is a premier self-drive car rental service that offers customers the freedom
  </p>
</div>

    <div class="links-seo">
  <div class="seo-header toggle-seo" onclick="toggleSEO(this)">
    <h3>Solo Travel with a Self-Drive Car</h3>
    <img src="<?= base_url(); ?>/assets/images/footer-icon.png" alt="Toggle Icon" class="seo-toggle-icon" />
  </div>
  <p class="seo-text" style="display: none;">
    Solo Travel with a Self-Drive Car: Empowering Solo Explorati
  </p>
</div>

    <div class="links-seo">
  <div class="seo-header toggle-seo" onclick="toggleSEO(this)">
    <h3>Road Trip Essentials: What to Pack for a Memorable Self Drive Journey?</h3>
    <img src="<?= base_url(); ?>/assets/images/footer-icon.png" alt="Toggle Icon" class="seo-toggle-icon" />
  </div>
  <p class="seo-text" style="display: none;">
    Embarking on a self-drive adventure is a thrilling way to explore new horizons,
  </p>
</div>

    <div class="links-seo">
  <div class="seo-header toggle-seo" onclick="toggleSEO(this)">
    <h3>Self-Drive Car Rentals in Delhi NCR</h3>
    <img src="<?= base_url(); ?>/assets/images/footer-icon.png" alt="Toggle Icon" class="seo-toggle-icon" />
  </div>
  <p class="seo-text" style="display: none;">
    Self-drive car rental offers unmatched freedom and convenience. With a self-drive rental,
  </p>
</div>

    <div class="links-seo">
  <div class="seo-header toggle-seo" onclick="toggleSEO(this)">
    <h3>Self-drive car on rent</h3>
    <img src="<?= base_url(); ?>/assets/images/footer-icon.png" alt="Toggle Icon" class="seo-toggle-icon" />
  </div>
  <p class="seo-text" style="display: none;">
    Self-drive car rental offers unmatched freedom and convenience. With a self-drive rental,
  </p>
</div>

    <div class="links-seo">
  <div class="seo-header toggle-seo" onclick="toggleSEO(this)">
    <h3>Self-drive car rental in Delhi</h3>
    <img src="<?= base_url(); ?>/assets/images/footer-icon.png" alt="Toggle Icon" class="seo-toggle-icon" />
  </div>
  <p class="seo-text" style="display: none;">
    Renting a self-drive SUV in Delhi NCR offers a blend of comfort and adventure.
  </p>
</div>

    <div class="links-seo">
  <div class="seo-header toggle-seo" onclick="toggleSEO(this)">
    <h3>Self-drive SUV Delhi NCR</h3>
    <img src="<?= base_url(); ?>/assets/images/footer-icon.png" alt="Toggle Icon" class="seo-toggle-icon" />
  </div>
  <p class="seo-text" style="display: none;">
    Renting a self-drive SUV in Delhi NCR offers a blend of comfort and adventure. 
  </p>
</div>

    <div class="links-seo">
  <div class="seo-header toggle-seo" onclick="toggleSEO(this)">
    <h3>Self-Driven Car for Outstation</h3>
    <img src="<?= base_url(); ?>/assets/images/footer-icon.png" alt="Toggle Icon" class="seo-toggle-icon" />
  </div>
  <p class="seo-text" style="display: none;">
    A self-driven car for outstation trips offers unmatched comfort. When you are planning...
  </p>
</div>
   </div>
  <!-- Footer Bottom -->
  <div class="footer-bottom">
    <p>© veekaycabs, 2025. VEEKAY CABS & CARS PVT LTD</p>
  </div>
</footer>



<script>
  const navLinks = document.querySelectorAll('#navLinks a');

  navLinks.forEach(link => {
    link.addEventListener('click', function (e) {
      e.preventDefault();
    navLinks.forEach(link => link.classList.remove('active'));
      this.classList.add('active');
    });
  });
</script>
<script>
  const tabLinks = document.querySelectorAll('#tabMenu a');

  tabLinks.forEach(tab => {
    tab.addEventListener('click', function (e) {
      e.preventDefault();

      // Remove 'active' from all tabs
      tabLinks.forEach(t => t.classList.remove('active'));

      // Add 'active' to clicked tab
      this.classList.add('active');
    });
  });
</script>
<!-- ============================= -->
 <!-- jQuery + Owl Carousel JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script>
  $(document).ready(function(){
    $("#carousel-A").owlCarousel({
      loop: true,
      margin: 20,
      autoplay: true,
      autoplayTimeout: 3000,
      responsive: {
        0: { items: 1 },
        600: { items: 2 },
        1000: { items: 3 }
      }
    });
  });

  $(document).ready(function(){
    $("#carousel-C").owlCarousel({
      loop: true,
      margin: 20,
      autoplay: true,
      autoplayTimeout: 3000,
      responsive: {
        0: { items: 1 },
        600: { items: 1 },
        1000: { items: 2 }
      }
    });
  });
</script>

<script>
  $(document).ready(function(){
    $("#carousel-B").owlCarousel({
      loop: true,
      margin: 20,
      autoplay: true,
      autoplayTimeout: 3000,
      responsive: {
        0: { items: 3 },
        600: { items: 4 },
        1000: { items: 6 }
      }
    });
  });

   $(document).ready(function(){
    $("#carousel-D").owlCarousel({
      loop: true,
      margin: 30,
      autoplay: true,
      autoplayTimeout: 3000,
      responsive: {
        0: { items: 1},
        600: { items: 1 },
        1000: { items: 2 }
      }
    });
  });

    $(document).ready(function(){
    $("#carousel-E").owlCarousel({
      loop: true,
      margin: 30,
      autoplay: true,
      autoplayTimeout: 3000,
      responsive: {
        0: { items: 1},
        600: { items: 1 },
        1000: { items: 2 }
      }
    });
  });
</script>


  <script>
    function toggleFAQ(header) {
      const box = header.parentElement;
      const btn = header.querySelector(".toggle-btn");
      const isActive = box.classList.contains("active");

      document.querySelectorAll(".faq-box").forEach(f => {
        f.classList.remove("active");
        f.querySelector(".toggle-btn").classList.replace("orange", "white");
      });

      if (!isActive) {
        box.classList.add("active");
        btn.classList.replace("white", "orange");
      }
    }
  </script>
<script>
  function toggleSEO(element) {
    const textPara = element.nextElementSibling;
    const icon = element.querySelector('.seo-toggle-icon');

    if (textPara.style.display === 'none') {
      textPara.style.display = 'block';
      element.classList.add('open');
    } else {
      textPara.style.display = 'none';
      element.classList.remove('open');
    }
  }
</script>



</body>
</html>