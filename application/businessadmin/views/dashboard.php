<?php echo $header; ?>

<!-- #content -->
<style>
.box .icon_list li 
{
height:70px !important;
}
</style>
<div id="content"> 
  
  <!-- breadcrumbs -->
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard'); ?>" title="Dashboard">Dashboard</a></li>
    </ul>
  </div>
  <!-- /breadcrumbs --> 
  
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span>Dashboard</span></h2>
    </div>
    <div class="box-content" style="height:auto;">
      <ul class="icon_list">
        <li> <a href="<?php echo site_url('company/edit');?>" title="Profile"> <img src="images/company.jpeg" alt="Profile" title="Profile">
          <p>Profile</p>
          </a> </li>
        <li> <a href="<?php echo site_url('gallery');?>" title="Galleries"> <img src="images/gallery.jpeg" alt="gallery" title="Galleries">
          <p>Galleries</p>
          </a> </li>
        <li> <a href="<?php echo site_url('video');?>" title="Videos"> <img src="images/video.jpeg" alt="Videos" title="Videos">
          <p>Videos</p>
          </a> </li>
        <li> <a href="<?php echo site_url('sem');?>" title="Social Media"> <img src="images/sem.jpg" alt="Social Media" title="Social Media">
          <p>Social Media</p>
          </a> </li>
        <li> <a href="<?php echo site_url('seo');?>" title="SEO"> <img src="images/seo.jpg" alt="SEO" title="SEO">
          <p>SEO</p>
          </a> </li>
        <li> <a href="<?php echo site_url('review');?>" title="Business Reviews"> <img src="images/review.jpg" alt="Business Reviews" title="Business Reviews">
          <p>Business Reviews</p>
          </a> </li>
          <li> <a href="<?php echo site_url('elite');?>" title="Elite Members Status"> <img src="images/member.png" alt="Elite Members Status" title="Elite Members Status">
          <p>Elite Members Status</p>
          </a> </li>
          <li> <a href="<?php echo site_url('pressrelease');?>" title="Press Releases"> <img src="images/press.png" alt="Pressrelease" title="Press Releases">
          <p>Press Releases</p>
          </a> </li>
          <li> <a href="<?php echo site_url('pdf');?>" title="Menu/Catalogs Upload"> <img src="images/pdf.png" alt="Menu/Catalogs Upload" title="Menu/Catalogs Upload">
          <p>Menu/Catalogs Upload</p>
          </a> </li>
          <li> <a href="<?php echo site_url('coupon');?>" title="Coupons"> <img src="images/coupon.png" alt="Coupons" title="Coupons">
          <p>Coupons</p>
          </a> </li>
    
		<?php $siteid = $this->session->userdata['siteid'];?>
		<?php if($siteid!='all'){ ?>
		<li>
		<a href="<?php echo site_url('widget');?>" title="Embed Widget"><img src="images/widget.png" alt="Widgets" title="Embed Widget">
			  <p>Embed Widget</p>
			  </a>
		</li>
		<?php } ?>
	
		<li> <a href="<?php echo site_url('timing');?>" title="Hours Of Operation"> <img src="images/timing.png" alt="Hours Of Operation" title="Hours Of Operation">
          <p>Hours Of Operation</p>
          </a> </li>
          <li> <a href="<?php echo site_url('badge');?>" title="Embed YGR Seal"> <img src="/images/badge.png" alt="Embed YGR Seal" title="Embed YGR Seal">
			<p>Embed YGR Seal</p>
          </a> </li>
      </ul>
    </div>
  </div>
  <!-- /box --> 
  
</div>
<!-- /#content --> 

<!-- #sidebar -->
<?php include('leftmenu.php'); ?>
<!-- /#sidebar --> 

<!-- #footer --> 
<?php echo $footer; ?>
