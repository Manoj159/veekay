 <!-- blog page wrapper start -->
 <section class="inner-page-wraper">

<div class="inner-page-banner">
    <div class="container">
        <div class="row">
            <h1 class="page-title">
                Blog
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Blog</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="blog-content pt-5 pb-5">
    <div class="container">
    <div class="row order-mobile">
        <div class="col-lg-4 ">
            <div class="sidebar">
                <div class="card">
                    <div class="card-body">
                        <h2 class="heading">Recent Blogs</h2>
                        <hr />

                        <?php
                        foreach($blog as $b){
                            $titleUrl = $b->slug;  ?>
                                <div class="blog-thumb">
                                <a href="<?= base_url("blog/$titleUrl"); ?>">
                                   <div class="img">
                                      <img src="<?= base_url($b->image); ?>" alt="<?= $b->title; ?>" class="img-fluid">
                                    </div>
                                  </a>
                             <div class="text">
                                <h5><?= $b->title; ?></h5>
                                <!-- <span>August 26, 2023</span> -->
                             </div>
                        </div>
                       
                     <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-sm-12 order-sm-first">
        <?php
                foreach($blog as $b){
                    $titleUrl = $b->slug;
            ?>


            <div class="blog-card card">
                <div class="photo">
                    <img src="<?= base_url($b->image); ?>" alt="blog-img" class="img-fluid" alt="<?= $b->meta_title; ?>" style=" height: 200px;">
                </div>
                <div class="content">
                    <div class="blog-info">
                      <span>By Veekay Cabs</span>
                    </div>
                    <h2 class="title"><?= $b->title; ?></h2>
                   
                     <a href="<?= base_url("blog/$titleUrl"); ?>">Read More</a>
                </div>
            </div>
            
            <?php  }  ?>

        </div>
    </div>
</div>
</div>



</section>

<!-- blog page wrapper end -->



