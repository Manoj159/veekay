<style>
   #slider {
    width: 100%;
    height: 75vh;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
   margin: auto;
   overflow-x: scroll;
   overflow-y: hidden;
   }
   .slider::-webkit-scrollbar {
   display: none;
   }
   .slider .slide {
   display: flex;
   position: absolute;
   left: 0;
   transition: 0.3s left ease-in-out;
   }
   .slider .item {
   /* margin-right: 10px;*/
   height: 250px;
   }
   }
   .slider .item:last-child {
   margin-right: 0;
   }
   .ctrl {
   text-align: center;
   margin-top: 5px;
   }
   .ctrl-btn {
   padding: 20px 20px;
   min-width: 50px;
   background: #fff;
   border: none;
   font-weight: 600;
   text-align: center;
   cursor: pointer;
   outline: none;
   position: absolute;
   top: 50%;
   margin-top: -27.5px;
   }
   .ctrl-btn.pro-prev {
   left: 0;
   }
   .ctrl-btn.pro-next {
   right: 0;
   }
   .detail-area{
   background-color:#275d96;
   padding:15px;
   border-radius:0 0 8px 8px;
   margin-right:20px;
   }
   .card{
   margin:20px;
   }
   
 .d-block{
     width:100%;
     
 }

@media only screen and (max-width: 600px) {
  #header {
    background-color:#000;
  }
  #slider{
      height: 50vh;
  }
  .d-block{
      /*height:400;
      margin-top: 27%;*/
     
 }

 #carouselExampleControls .carousel-item img{
    height: auto !important;
 }
}

   .btn{
        background: linear-gradient(145deg, rgba(20,201,148,0.8),rgb(6,135,167)) !important;
        color: white !important;
        border: none !important;
        border-radius: 20px !important;
    }
   
</style>
  <section style="padding-bottom: 20px !important;" class="banner-hero-sec">
<!-- <section> -->
   <div class="d-flex align-items-center banner-sec-1" id="hero">
      <div class="row">
         <div class="col-lg-12">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
               <div class="carousel-inner">
                 <?php $img = $this->db->order_by('id','desc')->get('slider')->result_array();
                   $i=1;
                    foreach($img as $img): ?>
                  <div class="carousel-item carousel-item1 <?= ($i==1)?"active":""; ?>">
                     <img class="d-block" style="height:auto!important;"  src="<?= base_url($img['images']); ?>" alt="happyeasyrides" />
                  </div>
                  <?php $i++; endforeach; ?>
               </div>
               <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                  <!-- <span class="carousel-control-prev-icon" aria-hidden="true"></span>-->
                  <span class="visually-hidden">Previous</span>
               </button>
               <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                  <!--<span class="carousel-control-next-icon" aria-hidden="true"></span>-->
                  <span class="visually-hidden">Next</span>
               </button>
            </div>
         </div>
      </div>
   </div>
   
   <div class="container">
      <div class="row">
         <form action="<?= base_url(); ?>book" method="get" id="book-form" class="form" style="z-index:99; background:transparent;">
            <div class="col-md-7 col-sm-12 offset-1">
               <div class="justify-content-center mobile-search-123 form"  style="background: white;box-shadow: 0 3px 6px 0 rgb(0 0 0 / 16%);border-radius: 14px;padding: 35px 25px;">
                  <div class="input-group select_city rounded pill border custom-border-1 csb-no-border ">
                     <div class="input-group-prepend">
                        <span class="input-group-text p-3"><i class='bx bxs-circle text-danger'></i></span>
                     </div>
                     <!-- <input type="hidden" name="city_id" value="wdjpwd w-e0d16d01f13a217e462f97a5a9d31d9590c"> -->
                     <select class="form-control p-2 city_name" required name="city" id="get_city">
                        <option value="" selected disabled>Select City</option>
                        <?php $city = $this->db->order_by('name','asc')->get_where('city', array('status'=>1))->result();
                           foreach($city as $c){ ?>   
                        <option value="<?= $c->city_id; ?>"><?= $c->name; ?></option>
                        <?php } ?> 
                     </select>
                  </div>
                  <div class="row my-0" id="dates">
                     <div class="col-md-6 col-sm-6">
                        <label class="text-white">Start Date</label>
                        <input type="datetime" name="start" readonly required id="start-date"  autocomplete="off" autosave="off" value="" class="form-control p-2 select_date custom-border-1" placeholder="Select Start Date" style="background-color:#fff;" />
                     </div>
                     <div class="col-md-6 col-sm-6">
                        <label class="text-white">End Date</label>
                        <input type="datetime" name="end" readonly id="end-date" class="form-control p-2 select_date custom-border-1"  autocomplete="off" autosave="off"  value="" required placeholder="Select End Date"  style="background-color:#fff;"/>
                     </div>
                     <div class="col-md-2"></div>
                  </div>
                  <div class="form-group mt-3 select_city">
                     <button type="submit" id="find-cars2" class="btn btn-block btn-primary p-2 text-white custom-btn-12" style="border-radius:50px!important;">Find Cars</button> 
                  </div>
               </div>
            </div>
         </form>
      </div>
   </div>
</section>
<!-- End Hero -->