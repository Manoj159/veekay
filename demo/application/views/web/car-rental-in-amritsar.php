<?php
    require"slider-form-section.php";
?>

<section class="why-happy-easy-rides custom-padding-1 location-city" >
   
   <div class="container">
      <div class="row">
         <div class="col-xl-12">
            
            <div class="custom-heading-1">
               <h4>Self Drive Car Rental in Amritsar</h4>
            </div>
            
            <div class="row">
               <p>
                   Amritsar is a city where religion has no boundaries.A city that stays lit all year round!The largest city in Punjab, also known for being the site of the holiest shrine of Sikhism.In addition to being the most revered and beautiful site in the city, the Golden Temple is also the most popular among tourists and worshippers alike.
               </p>
               <p>
                   You should always spend some time exploring the sprawling complex, but you cannot stop there.Amritsar is more than sacred places.In addition to street food and museums, this holy city has a bustling bazaar and market, as well as many forts and fortifications.Renting a self-drive car allows you to travel through Amritsar's roads and see its surrounding areas.
               </p>
              
            </div>
            
            <div class="custom-heading-1">
               <h4>Best Self Drive Cars in Amritsar</h4>
            </div>
            <div class="row">
                <p>
                    VeekayCabss is a reputable service provider of <a href="https://www.happyeasyrides.com/car-rental-in-amritsar/">self drive car rental in amritsar</a>. Hire a car should be hassle-free with VeekayCabss' affordable prices and simple verification process.Offering 24x7 Customer Support and High Quality Vehicles with a 100% Satisfaction Guarantee.
                </p>
                <p>
                    Our dealerships are verified and committed to quality for convenient self-drive.You can choose one of our cars from our wide range of fleet to travel outstation or commute intercity.You can hire a car for a day or a week and it is unlimited kilometers.
                </p>
                <p>
                   Our car rentals service packages are flexible and highly suitable to meet customer demands.VeekayCabss pick up points are scattered across Amritsar such as the airport, stadiums, parks, the railway station, bus stations, and amritsar malls.
                </p>
            </div>
            
            <div class="custom-heading-1">
               <h4>What Do You Know About Us</h4>
            </div>
            <div class="row">
                <p>
                    A leading online car rental company in India, VeekayCabss arranges rental cars in more than 20 states a year, offering best-class rentals.The purpose of VeekayCabss is to provide its customers with world-class service.
                </p>
                <ul>
                    <li>	Book a Car Online made easy.</li>
                    <li>	Guaranteed best price</li>
                    <li>	100 percent customer satisfaction</li>
                    <li>	You can cancel at no cost</li>
                    <li>	Excellent car condition</li>
                </ul>
             </div>
             
             
             <div class="custom-heading-1">
               <h4>Where are the best places to visit in Amritsar? </h4>
            </div>
              <div class="row">
                  <p>
                      At the <a href="https://en.wikipedia.org/wiki/Golden_Temple/">Golden Temple</a> langar, where thousands of people irrespective of their caste and religion are fed with fresh foods, Amritsar's legendary hospitality is on full display.A city where history is alive but does not live in the past at the same time.
                  </p>
                  <p>
                      Compared to other places in India, Punjab has a rich and flavorful cuisine, which is why it is so close to Punjab.Street food such as paranthas, lassi, and kulcha are available at very low prices.
                  </p>
                  <p>
                      Self drive car rental Amritsar Airport services make it easier to commute from one place to another.You can end the evening with a short drive in the city or witness the closing of the border and head to SaddaPind featuring fun activities.
                  </p>
             </div>
             
            
             <div class="custom-heading-1">
               <h4>Why You Choose VeekayCabss?</h4>
            </div>
             <div class="row">
                <p>
                    In Amritsar-Punjab, VeekayCabss is one of the leading tour and taxi companies.Our fleet consists of a number of well-maintained Premium, Economy, and Executive vehicles.We offer <a href="https://www.happyeasyrides.com/car-rental-in-amritsar/">Luxury car rentals Amritsar</a>, tours and travels Amritsar, car hire Amritsar, heritage tours in Punjab and India, airport transfers to Amritsar International Airport, hotels in Amritsar, and North India tours around Amritsar.
                </p>
                <p>
                    Taking high care to maintain the cars for customer's safety and comfort means a lot to us.During the ride, the driver will be very interactive.To satisfy the needs of our customers in terms of type and / or make of vehicle, we have created a fleet made up of a great variety of new model cars.
                </p>
                <p>
                    We provide all kinds of taxi services in Amritsar.All types of cars and cabs are rented at a reasonable cost with security deposit.
                </p>
             </div>
             
             <div class="custom-heading-1">
               <h4>Frequently Asked Questions (FAQs)</h4>
            </div>
             <div class="row">
                 <p>
                     <b>Q.1 Why Is Amritsar Famous?</b><br/>
This city has many beautiful places that can captivate your eye, including the Sikh community of India and the Golden Temple.Amritsar is the perfect combination of food, tradition, history, and culture for tourists.

                 </p>
                 <p>
                    <b> Q.2 When Is The Best Time To Visit Amritsar?</b><br/>
During the months of November to March, Amritsar's weather is comfortable and ideal for sightseeing and visiting the Golden Temple.
                 </p>
                 <p>
                     <b>Q.3 In Amritsar, how much does it cost to rent a self-drive car for a week?</b><br/>
Our rates are dynamic and change every month.Renting a car in Amritsar is priced differently during the weekdays and weekends, too.
                 </p>
                 <p>
                     <b>Q.4 Can I get the self-driven cars delivered anywhere in Amritsar?</b><br/>
VeekayCabss offers a range of self-drive cars for rent in Amritsar that can either be picked up from one of our predefined locations near you or delivered to your doorstep, office or airport upon arrival.

                 </p>
             </div>
             
             
             
             
             
             
             
         </div>
      </div>
   </div>
</section>




<script>
   "use strict";
   
   productScroll();
   
   function productScroll() {
      let slider = document.getElementById("slider");
      let next = document.getElementsByClassName("pro-next");
      let prev = document.getElementsByClassName("pro-prev");
      let slide = document.getElementById("slide");
      let item = document.getElementById("slide");
      
      for (let i = 0; i < next.length; i++) {
      
      let position = 0;
      
      prev[i].addEventListener("click", function() {
        if (position > 0) {
          position -= 1;
          translateX(position);
        }
      });
      
      next[i].addEventListener("click", function() {
        if (position >= 0 && position < hiddenItems()) {
          position += 1;
          translateX(position);
        }
      });
      }
      
      function hiddenItems() {
         let items = getCount(item, false);
         let visibleItems = slider.offsetWidth / 210;
         return items - Math.ceil(visibleItems);
      }
   }
   
   function translateX(position) {
      slide.style.left = position * -210 + "px";
   }
   
   function getCount(parent, getChildrensChildren) {
         let relevantChildren = 0;
         let children = parent.childNodes.length;
         for (let i = 0; i < children; i++) {
         if (parent.childNodes[i].nodeType != 3) {
           if (getChildrensChildren)
             relevantChildren += getCount(parent.childNodes[i], true);
           relevantChildren++;
         }
      }
      return relevantChildren;
   }
   
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        $("form").removeClass("form");
        $("form").addClass("mt-3");
        $("div").removeClass("form");
        
        $(".desktop_slides").remove();
    }else{
        $(".mobile_slides").remove();
    }
</script>

<script>
   $(document).ready(function() {
    $('#autoWidth').lightSlider-product({
        autoWidth:true,
        loop:true,
        onSliderLoad: function() {
            $('#autoWidth').removeClass('cS-hidden');
        } 
    });  
   });
</script>
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/style1.css" />
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/lightslider.css" />
<script src="<?= base_url(); ?>assets/lightslider.js" ></script>