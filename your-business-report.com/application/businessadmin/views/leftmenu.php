<div id="sidebar"> 
  
  <!-- mainmenu -->
  <ul id="floatMenu" class="mainmenu">
    <li class="first"><a href="<?php echo site_url('dashboard'); ?>" class="link" title="Dashboard">Dashboard</a></li>
    <li><a href="<?php echo site_url('company'); ?>" title="Profile">Profile</a>
      <ul class="submenu">
        <li><a href="<?php echo site_url('company/edit'); ?>" title="Edit Profile">Edit Profile</a></li>
        <li><a href="<?php echo site_url('company'); ?>" title="View Profile">View Profile</a></li>
        <li><a href="<?php echo site_url('company/changepassword'); ?>" title="Change Password">Change Password</a></li>
      </ul>
    </li>
    <li><a href="<?php echo site_url('gallery'); ?>" title="Gallerys">Gallerys</a>
      <ul class="submenu">
        <li><a href="<?php echo site_url('gallery/add'); ?>" title="Add Gallery">Add Gallery</a></li>
        <li><a href="<?php echo site_url('gallery'); ?>" title="List All Gallerys">List All Gallerys</a></li>
      </ul>
    </li>
    <li><a href="<?php echo site_url('video'); ?>" title="videos" class="link">Videos</a> </li>
    <li><a href="<?php echo site_url('sem'); ?>" class="link" title="SEMs">SEMs</a></li>
    <li><a href="<?php echo site_url('seo'); ?>" class="link" title="SEOs">SEOs</a></li>
    <li><a href="<?php echo site_url('review'); ?>" title="Reviews">Reviews</a>
      <ul class="submenu">
        <li><a href="<?php echo site_url('review'); ?>" title="Reviews">Reviews</a></li>
        <li><a href="<?php echo site_url('review/reviews'); ?>" title="YGR Reviews">YGR Reviews</a></li>
      </ul>
    </li>
   <li><a href="<?php echo site_url('elite'); ?>" title="Elite Membership" class="link">Elite Membership</a> </li>
   <li><a href="<?php echo site_url('pressrelease'); ?>" title="Pressrelease">Pressrelease</a>
      <ul class="submenu">
        <li><a href="<?php echo site_url('pressrelease/add'); ?>" title="Add Pressrelease">Add Pressrelease</a></li>
        <li><a href="<?php echo site_url('pressrelease'); ?>" title="List All Pressreleases">List All Pressreleases</a></li>
      </ul>
    </li>
    <li><a href="<?php echo site_url('pdf'); ?>" title="Pdfs">Pdfs</a>
      <ul class="submenu">
        <li><a href="<?php echo site_url('pdf/add'); ?>" title="Add pdf">Add Pdf</a></li>
        <li><a href="<?php echo site_url('pdf'); ?>" title="List All pdf">List All Pdfs</a></li>
      </ul>
    </li>
    <li><a href="<?php echo site_url('coupon'); ?>" title="Coupons">CouponsDeals & Steals</a>
      <ul class="submenu">
        <li><a href="<?php echo site_url('coupon/add'); ?>" title="Add Coupon">Add Coupon</a></li>
        <li><a href="<?php echo site_url('coupon'); ?>" title="List All Coupons">List All Coupons</a></li>
      </ul>
    </li>
    
	<?php $siteid = $this->session->userdata['siteid'];?>
	<?php if($siteid!='all'){ ?>
    <li><a href="<?php echo site_url('widget');?>" class="link" title="Get Widget">Get Widget</a></li>
	<?php $companyid=$this->session->userdata['youg_admin']['id'];?>
    <?php $autho = $this->settings->get_subscribtion_bycompanyid($companyid);
    
		if(count($autho)>0)
		{
		if($autho[0]['paymentmethod']!='paypal'){
    ?>
    <li><a href="<?php echo site_url('elite/cancel_subscribtion'); ?>" title="Cancel Subscribtion" class="link">Cancel Subscribtion</a> </li>
    <?php }}}?>
    <li><a href="<?php echo site_url('dashboard/logout');?>" class="link" title="Logout">Logout</a></li>
  </ul>
  <!-- /.mainmenu --> 
</div>
