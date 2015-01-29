<?php echo $header; ?>

<section class="container">
  <section class="main_contentarea">
    <div class="innr_wrap">
      <h1 class="bannertext font_size_banner"><?php echo $varheading; ?></h1>
      <div class="footer_page_content"><?php echo preg_replace('/<br[^>]*>/i', '', stripslashes($content)); ?></div>
    </div>
  </section>
</section>

<?php echo $footer; ?> 
