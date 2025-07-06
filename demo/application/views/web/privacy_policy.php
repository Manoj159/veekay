<section></section>
<style>
    .section-title h2::after{
        display: none !important;
    }
    .section-title h2{
        position: inherit;
    }
</style>
<main id="contact" class="py-5 privacy-policy">
	
	<section id="contact" class="contact" style="background: #fff;">
      <div class="container">
<nav aria-label="breadcrumb" class="">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Privacy Policy</li>
  </ol>
</nav>
        <div class="section-title">
          <h2>Privacy Policy</h2>
        </div>

        <div class="row">
            <div class="tnc-text-continaer">
                <?= $this->db->get_where("policy", ["page"=>"privacy"])->row()->content; ?>
            </div>
            
        </div>

      </div>
    </section>

</main>