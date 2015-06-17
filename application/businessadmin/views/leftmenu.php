<div id="sidebar"> 
  
  <!-- mainmenu -->
    <ul id="floatMenu" class="mainmenu">
	  
	    <!--Dashboard-->
	    <li class="first"><a class="topmenu" href="<?php echo site_url('dashboard'); ?>" class="link" title="Dashboard">Dashboard</a>
		    <ul class="submenu">
				<li><a href="<?php echo site_url('elite'); ?>" title="Elite Membership Status" class="link">Elite Membership Status</a> </li>
				<li><a href="<?php echo site_url('elite/update'); ?>" title="Update Your Credit Card" class="link">Update Your Credit Card</a> </li>
				<li><a href="<?php echo site_url('tutorial'); ?>"  class="link" title="Tutorials">Tutorials</a>
				<li><a href="<?php echo site_url('faq'); ?>"  class="link" title="FAQ">FAQ</a>
		    </ul>
		</li>
    
		<!--Profile-->
		<li><a class="topmenu" href="<?php echo site_url('company/edit'); ?>" title="Profile">Profile</a>
			<ul class="submenu">
				<li><a href="<?php echo site_url('company/edit'); ?>" class="link" title="Profile">Profile</a></li>
				<li><a href="<?php echo site_url('timing');?>" class="link" title="Hours Of Operation">Hours Of Operation</a></li>
				<li><a class="childmenu" href="<?php echo site_url('gallery'); ?>" title="Galleries">Photo Galleries</a>
					<ul class="child">
						<li><a class="link" href="<?php echo site_url('gallery/add'); ?>" title="Add Galleries">Add Galleries</a></li>
						<li><a class="link" href="<?php echo site_url('gallery'); ?>" title="List All Galleries">List All Galleries</a></li>
					</ul>
				</li>
				<li><a class="childmenu" href="<?php echo site_url('video'); ?>" title="videos">Videos</a>
				    <ul class="child">
						<li><a class="link" href="<?php echo site_url('video/addvideo'); ?>" title="Add Video">Add Video</a></li>
						<li><a class="link" href="<?php echo site_url('video'); ?>" title="View Video">View Video</a></li>
					</ul>
				</li>
				<li><a href="<?php echo site_url('sem'); ?>" class="link" title="Social Media">Social Media</a></li>
				<li><a href="<?php echo site_url('seo'); ?>" class="link" title="SEO Meta Data Tools">SEO Meta Data Tools</a></li> 
     		</ul>
	    </li>	 
    
		<!--Verified Seals-->
		<li><a class="topmenu" href="<?php echo site_url('company/edit'); ?>" title="Verified Seals">Verified Seals</a>
			<ul class="submenu">
				<li><a href="<?php echo site_url('badge');?>" class="link" title="Embed YGR Verified Seal">Embed YGR Verified Seal</a></li>
				<li><a href="<?php echo site_url('widget');?>" class="link" title="Embed Reviews Widget">Embed Reviews Widget</a></li>
				<li><a href="<?php echo site_url('buyer');?>"  class="link" title="Embed Buyers Protection Badge">Embed Buyers Protection Badge</a></li>
				<li><a href="<?php echo site_url('review?embed'); ?>" class="link" title="Embed Request for New Reviews">Embed Request for New Reviews</a></li>
			</ul>
		</li>
		
    
		<!--Selling Tools-->
		<li><a class="topmenu" href="<?php echo site_url('review'); ?>" title="Selling Tools">Selling Tools</a>
			<ul class="submenu">
				<li><a class="childmenu" href="<?php echo site_url('review'); ?>" title="Reviews">Reviews</a>
					<ul class="child">
						<li><a href="<?php echo site_url('review/uploadReview'); ?>" class="link" title="Upload Reviews in Bulk">Upload Reviews in Bulk</a></li>
						<li><a href="<?php echo site_url('review'); ?>"  class="link" title="List All Reviews">List All Reviews</a></li>
					</ul>
				</li>
				<li><a class="childmenu" href="<?php echo site_url('pdf'); ?>" title="Profile Docs">Menu/Catalogs</a>
					<ul class="child">
						<li><a href="<?php echo site_url('pdf/add'); ?>" class="link" title="Add Profile Docs">Add Menu/Catalog </a></li>
						<li><a href="<?php echo site_url('pdf'); ?>" class="link" title="List All Profile Docs">List All Menu/Catalogs </a></li>
					</ul>
				</li>
			    <li><a class="childmenu" href="<?php echo site_url('pressrelease'); ?>" title="Press Releases">Press Releases</a>
					<ul class="child">
						<li><a href="<?php echo site_url('pressrelease/add'); ?>" class="link" title="Add A Press Releases">Add A Press Releases</a></li>
						<li><a href="<?php echo site_url('pressrelease'); ?>" class="link" title="List All Press Releases">List All Press Releases</a></li>
					</ul>
			    </li>
			    <li><a class="childmenu" href="<?php echo site_url('coupon'); ?>" title="Manage Your Coupons">Manage Your Coupons</a>
					<ul class="child">
						<li><a href="<?php echo site_url('coupon/add'); ?>" class="link" title="Add A Coupon">Add A Coupon</a></li>
						<li><a href="<?php echo site_url('coupon'); ?>" class="link" title="List All Coupons">List All Coupons</a></li>
					</ul>
			    </li>
			    <li><a class="childmenu" href="<?php echo site_url('reviewpromo'); ?>" title="Review Promo Code">Review Promo Code</a>
					<ul class="child">
						<li><a href="<?php echo site_url('reviewpromo/add'); ?>" class="link" title="Add A Review Promo Code">Add A Review Promo Code</a></li>
						<li><a href="<?php echo site_url('reviewpromo'); ?>" class="link" title="List All Coupons">List All Review Promo Code</a></li>
					</ul>
			    </li>
			</ul>
		</li>
    
		<!--Resolution Center-->
		<li><a class="topmenu" href="<?php echo site_url('review'); ?>" title="Resolution Center">Resolution Center</a>
			<ul class="submenu">
				<li><a href="<?php echo site_url('review/reviews'); ?>" class="link" title="Review Removal Tool">Review Removal Tool</a></li>
				<li><a href="<?php echo site_url('businessdispute');?>" class="link" title="Complaints Removal Tool">Complaints Removal Tool</a></li>	   
			</ul>
		</li>

        <li><a href="<?php echo site_url('dashboard/logout');?>" class="link" title="Logout">Logout</a></li>

    </ul>
  <!-- /.mainmenu --> 
</div>
