<div id="sidebar"> 
  
  <!-- mainmenu -->
  <ul id="floatMenu" class="mainmenu">
    <li class="first"><a href="<?php echo site_url('dashboard'); ?>" class="link" title="Dashboard">Dashboard</a></li>
    <li><a href="<?php echo site_url('company/edit'); ?>" class="link" title="Profile">Profile</a></li>
    <li><a href="<?php echo site_url('gallery'); ?>" title="Galleries">Galleries</a>
      <ul class="submenu">
        <li><a href="<?php echo site_url('gallery/add'); ?>" title="Add Galleries">Add Galleries</a></li>
        <li><a href="<?php echo site_url('gallery'); ?>" title="List All Galleries">List All Galleries</a></li>
      </ul>
    </li>
    <li><a href="<?php echo site_url('video'); ?>" title="videos">Videos</a> 
		<ul class="submenu">
        		<li><a href="<?php echo site_url('video/addvideo'); ?>" title="Add Video">Add Video</a></li>
        		<li><a href="<?php echo site_url('video'); ?>" title="View Video">View Video</a></li>
		</ul>
	</li>
    <li><a href="<?php echo site_url('sem'); ?>" class="link" title="Social Media">Social Media</a></li>
    <li><a href="<?php echo site_url('seo'); ?>" class="link" title="SEO Tools">SEO Tools</a></li>
    <li><a href="<?php echo site_url('review'); ?>" title="Reviews">Reviews</a>
      <ul class="submenu">
        <li><a href="<?php echo site_url('review'); ?>" title="Reviews">Reviews</a></li>
        <li><a href="<?php echo site_url('review/reviews'); ?>" title="Remove Reviews">Remove Reviews</a></li>
      </ul>
    </li>
   <li><a href="<?php echo site_url('elite'); ?>" title="Elite Membership Status" class="link">Elite Membership Status</a> </li>
   <li><a href="<?php echo site_url('elite/update'); ?>" title="Update Your Credit Card" class="link">Update Your Credit card</a> </li>
   <li><a href="<?php echo site_url('pressrelease'); ?>" title="Press Releases">Press Releases</a>
      <ul class="submenu">
        <li><a href="<?php echo site_url('pressrelease/add'); ?>" title="Add Press Releases">Add Press Releases</a></li>
        <li><a href="<?php echo site_url('pressrelease'); ?>" title="List All Press Releases">List All Press Releases</a></li>
      </ul>
    </li>
    <li><a href="<?php echo site_url('badge');?>" class="link" title="Embed YGR Seal">Embed YGR Seal</a></li>
    <li><a href="<?php echo site_url('businessdispute');?>" title="Business Disputes">Business Disputes</a>
       <ul class="submenu">
		   <li><a href="<?php echo site_url('businessdispute');?>" class="link" title="List All Business Disputes">List All Disputes</a></li>	   
		   
       </ul>
    </li>
    <li><a href="<?php echo site_url('pdf'); ?>" title="Profile Docs">Menu/Catalogs Upload</a>
      <ul class="submenu">
        <li><a href="<?php echo site_url('pdf/add'); ?>" title="Add Profile Docs">Add Profile Docs</a></li>
        <li><a href="<?php echo site_url('pdf'); ?>" title="List All Profile Docs">List All Profile Docs</a></li>
      </ul>
    </li>
    <li><a href="<?php echo site_url('coupon'); ?>" title="Coupons">Coupons</a>
      <ul class="submenu">
        <li><a href="<?php echo site_url('coupon/add'); ?>" title="Add Coupon">Add Coupon</a></li>
        <li><a href="<?php echo site_url('coupon'); ?>" title="List All Coupons">List All Coupons</a></li>
      </ul>
    </li>
    
	<?php $siteid = $this->session->userdata['siteid'];?>
	<?php if($siteid!='all'){ ?>
    <li><a href="<?php echo site_url('widget');?>" class="link" title="Review Feed Widget">Review Feed Widget</a></li>
	<?php $companyid=$this->session->userdata['youg_admin']['id'];?>
    <?php $autho = $this->settings->get_subscribtion_bycompanyid($companyid);
    
		if(count($autho)>0)
		{
		if($autho[0]['paymentmethod']!='paypal'){
    ?>
    <li><a href="<?php echo site_url('elite/cancel_subscribtion'); ?>" title="Cancel Subscription" class="link">Cancel Subscription</a> </li>
    <?php }}}?>
    <li><a href="<?php echo site_url('timing');?>" class="link" title="Hours Of Operation">Hours Of Operation</a></li>
    <li><a href="<?php echo site_url('dashboard/logout');?>" class="link" title="Logout">Logout</a></li>
    
  </ul>
  <!-- /.mainmenu --> 
</div>
