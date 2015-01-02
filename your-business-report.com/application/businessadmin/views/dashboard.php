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
        <li> <a href="<?php echo site_url('company');?>" title="Profile"> <img src="images/company.jpeg" alt="Profile" title="Profile">
          <p>Profile</p>
          </a> </li>
        <li> <a href="<?php echo site_url('gallery');?>" title="Gallerys"> <img src="images/gallery.jpeg" alt="gallery" title="gallery">
          <p>Gallerys</p>
          </a> </li>
        <li> <a href="<?php echo site_url('video');?>" title="Videos"> <img src="images/video.jpeg" alt="Videos" title="Videos">
          <p>Videos</p>
          </a> </li>
        <li> <a href="<?php echo site_url('sem');?>" title="SEMs"> <img src="images/sem.jpg" alt="SEMs" title="SEMs">
          <p>SEMs</p>
          </a> </li>
        <li> <a href="<?php echo site_url('seo');?>" title="SEOs"> <img src="images/seo.jpg" alt="SEOs" title="SEOs">
          <p>SEOs</p>
          </a> </li>
        <li> <a href="<?php echo site_url('review');?>" title="Business Reviews"> <img src="images/review.jpg" alt="Business Reviews" title="Business Reviews">
          <p>Business Reviews</p>
          </a> </li>
          <li> <a href="<?php echo site_url('elite');?>" title="Elite Membership"> <img src="images/member.png" alt="Elite Membership" title="Elite Membership">
          <p>Elite Membership</p>
          </a> </li>
          <li> <a href="<?php echo site_url('pressrelease');?>" title="Pressrelease"> <img src="images/press.png" alt="Pressrelease" title="Pressrelease">
          <p>Pressrelease</p>
          </a> </li>
          <li> <a href="<?php echo site_url('pdf');?>" title="Upload pdf"> <img src="images/pdf.png" alt="Upload pdf" title="Upload pdf">
          <p>Upload pdf</p>
          </a> </li>
          <li> <a href="<?php echo site_url('coupon');?>" title="CouponsDeals & Steals"> <img src="images/coupon.png" alt="Coupons" title="Coupons">
          <p>Coupons</p>
          </a> </li>
    
    <?php $siteid = $this->session->userdata['siteid'];?>
	<?php if($siteid!='all'){ ?>
    <li>
    <a href="<?php echo site_url('widget');?>" title="Get Widget"><img src="images/widget.png" alt="Widgets" title="Widgets">
          <p>Get Widget</p>
          </a>
    </li>
    <?php $companyid=$this->session->userdata['youg_admin']['id'];?>
    <?php $autho = $this->settings->get_subscribtion_bycompanyid($companyid);
    	if(count($autho)>0)
		{
		if($autho[0]['paymentmethod']!='paypal'){
		?>
    <li>
    <a href="<?php echo site_url('elite/cancel_subscribtion');?>" title="Get Widget"><img src="images/cancelsubscription.png" alt="Widgets" title="Widgets">
          <p>Cancel Subscribtion</p>
          </a>
    </li>
    <?php }}}?>
	
 
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