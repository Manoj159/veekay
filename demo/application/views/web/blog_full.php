<div class="inner-page-banner">
            <div class="container">
                <div class="row">
                    <h1 class="page-title mb-2">
                    <?= $blog->title; ?>
                    </h1>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                          <li class="breadcrumb-item"><a href="<?= base_url('blogs'); ?>">Blog</a></li>
                          <li class="breadcrumb-item active" aria-current="page"><?= $blog->title; ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="detail-page mt-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <h4><?= $blog->title; ?></h4>
                        <p>  <?= $blog->description; ?></p>
                         <img src="<?= base_url($blog->image); ?>"  alt="veekaycabs Self drive car rental blog"  class="img-fluid">
                    </div>
                    <div class="col-lg-4 mt-sm-3">
                        <div class="sidebar ">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="heading">Recent Blogs</h2>
                                    <hr />
                                    <?php
                                        foreach($blogs as $b){
                                            $titleUrl = strtolower(str_replace(" ","-",$b->title));
                                    ?>
                                                <div class="blog-thumb">
                                                <a href="<?= base_url("blogs/read/$titleUrl"); ?>">
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
                </div>
            </div>

        </div>


