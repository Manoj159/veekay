<section></section>
<style>
    .section-title h2::after{
        display: none !important;
    }
    .section-title h2{
        position: inherit;
    }
    table{
        width: 100% !important;
    }
</style>
<main id="contact" class="py-5 cancellation-policy">
	
	<section id="contact" class="contact" style="background: #fff;">
      <div class="container">
<nav aria-label="breadcrumb" class="">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Cancellation  Policy</li>
  </ol>
</nav>
        <div class="section-title">
          <h2>Cancellation  Policy</h2>
        </div>

        <div class="row">
            <div class="tnc-text-continaer">
                <?= $this->db->get_where("policy", ["page"=>"refund"])->row()->content; ?>
            </div>

      </div>
        </div>
    </section>

</main>