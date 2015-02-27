<div id="sidebar">   
  <!-- mainmenu -->
  <ul id="floatMenu" class="mainmenu">
    <li class="first <?=($this->uri->segment(1)==='dashboard')?'active':''?>">
		<a href="<?php echo site_url('dashboard'); ?>" class="link" title="Dashboard">Dashboard</a>
	</li>
    <li class="<?=($this->uri->segment(1)==='setting')?'active':''?>">
		<a href="<?php echo site_url('setting'); ?>" class="link" title="Settings">Settings</a>
	</li>
    <li class="<?=($this->uri->segment(1)==='homesetting')?'active':''?>">
		<a href="<?php echo site_url('homesetting'); ?>" class="link" title="Home Page Settings">Home Page Settings</a>
	</li>
	<li class="<?=($this->uri->segment(1)==='homeslider')?'active':''?>">
		<a href="<?php echo site_url('homeslider'); ?>" title="Home Page Slider">Home Page Slider</a>
		<ul class="submenu">
			<li>
				<a href="<?php echo site_url('homeslider/add'); ?>" title="Add Image">Add Image</a>
			</li>
			<li>
				<a href="<?php echo site_url('homeslider'); ?>" title="List All Image">List All Images</a>
			</li>
		</ul>
	</li>
    <li class="<?=($this->uri->segment(1)==='mainbroker')?'active':''?>">
		<a href="<?php echo site_url('mainbroker'); ?>" title="Multi-Tier Marketing">Multi-Tier Marketing</a>
		<ul class="submenu">
			<li>
				<a href="<?php echo site_url('mainbroker/brokeradd'); ?>" title="Add Broker">Add Broker</a>
			</li>
			<li>
				<a href="<?php echo site_url('mainbroker/add'); ?>" title="Add Subbroker">Add Subbroker</a>
			</li>
			<li>
				<a href="<?php echo site_url('mainbroker/marketeradd'); ?>" title="Add marketer">Add marketer</a>
			</li>
			<li>
				<a href="<?php echo site_url('mainbroker/agentadd'); ?>" title="Add agent">Add agent</a>
			</li>
			<li>
				<a href="<?php echo site_url('mainbroker'); ?>" title="List All Brokers">List All Brokers</a>
			</li>
			<li>
				<a href="<?php echo site_url('mainbroker/subbroker'); ?>" title="List All Subbrokers">List All Subbrokers</a>
			</li>
			<li>
				<a href="<?php echo site_url('mainbroker/marketer'); ?>" title="List All Marketers">List All Marketers</a>
			</li>
			<li>
				<a href="<?php echo site_url('mainbroker/agent'); ?>" title="List All Agents">List All Agents</a>
			</li>
			<li>
				<a href="<?php echo site_url('mainbroker/elitemember'); ?>" title="List All Elite Members">List All Elite Members</a>
			</li>
		</ul>
	</li>
    <li class="<?=($this->uri->segment(1)==='seo')?'active':''?>">
		<a href="<?php echo site_url('seo'); ?>" class="link" title="SEO">SEO</a>
	</li>
    <li class="<?=($this->uri->segment(1)==='sem')?'active':''?>">
		<a href="<?php echo site_url('sem'); ?>" class="link" title="Social Media">Social Media</a>
    </li>
    <li class="<?=($this->uri->segment(1)==='email')?'active':''?>">
		<a href="<?php echo site_url('email');?>" class="link" title="Email Formats">Email Formats</a>
    </li>
    <li class="<?=($this->uri->segment(1)==='page')?'active':''?>">
		<a href="<?php echo site_url('page'); ?>" title="Edit Pages">Edit Pages</a>
		<ul class="submenu">
			<li>
				<a href="<?php echo site_url('page/add'); ?>" title="Add Page">Add Page</a>
			</li>
			<li>
				<a href="<?php echo site_url('page'); ?>" title="List All Pages">List All Pages</a>
			</li>
		</ul>
	</li>
    <li class="<?=($this->uri->segment(1)==='faq')?'active':''?>">
		<a href="<?php echo site_url('faq'); ?>" title="FAQs">FAQs</a>
		<ul class="submenu">
			<li>
				<a href="<?php echo site_url('faq/add'); ?>" title="Add FAQ">Add FAQ</a>
			</li>
			<li>
				<a href="<?php echo site_url('faq'); ?>" title="List All FAQs">List All FAQs</a>
			</li>
		</ul>
    </li>
    <li class="<?=($this->uri->segment(1)==='solution')?'active':''?>">
		<a href="<?php echo site_url('solution'); ?>" title="Business Solutions">Business Solutions</a>
		<ul class="submenu">
			<li>
				<a href="<?php echo site_url('solution/add'); ?>" title="Add Solution">Add Solution</a>
			</li>
			<li>
				<a href="<?php echo site_url('solution'); ?>" title="List All Solutions">List All Solutions</a>
			</li>
			<li>
				<a href="<?php echo site_url('solution/search'); ?>" title="Search Solution">Search Solution</a>
			</li>
		</ul>
    </li>
    <li class="<?=($this->uri->segment(1)==='category')?'active':''?>">
		<a href="<?php echo site_url('category'); ?>" title="Business Categories">Business Categories</a>
		<ul class="submenu">
			<li>
				<a href="<?php echo site_url('category/add'); ?>" title="Add Business Category">Add Category</a>
			</li>
			<li>
				<a href="<?php echo site_url('category'); ?>" title="List All Categories">List All Categories</a>
			</li>
			<li>
				<a href="<?php echo site_url('category/search'); ?>" title="Search Category">Search Category</a>
			</li>
		</ul>
    </li>
    <li class="<?=($this->uri->segment(1)==='search')?'active':''?>">
		<a href="<?php echo site_url('search'); ?>" title="Trending Searches">Trending Searches</a> 
		<ul class="submenu">
			<li>
				<a href="<?php echo site_url('search/add'); ?>" title="Add Search">Add Search</a>
			</li>
			<li>
				<a href="<?php echo site_url('search'); ?>" title="List All Searches">List All Searches</a>
			</li>
		</ul>
    </li>
    <li class="<?=($this->uri->segment(1)==='user')?'active':''?>">
		<a href="<?php echo site_url('user'); ?>" title="Users">Users</a>
		<ul class="submenu">
			<li>
				<a href="<?php echo site_url('user/add'); ?>" title="Add New User">Add User</a>
			</li>
			<li>
				<a href="<?php echo site_url('user'); ?>" title="List All Users">List All Users</a>
			</li>
			<!--<li>
				<a href="<php echo site_url('user/search'); ?>" title="Search User">Search User</a>
			</li>-->
		</ul>
    </li>
    <li class="<?=($this->uri->segment(1)==='company')?'active':''?>">
		<a href="<?php echo site_url('company'); ?>" title="Companies">Companies</a>
		<ul class="submenu">
			<li>
				<a href="<?php echo site_url('company/add'); ?>" title="Add Company">Add Company</a>
			</li>
			<li>
				<a href="<?php echo site_url('company'); ?>" title="List All Companies">List All Companies</a>
			</li>
			<li>
				<a href="<?php echo site_url('company/search'); ?>" title="Search Company">Search Company</a>
			</li>
		</ul>
    </li>
    <li class="<?=($this->uri->segment(1)==='elite')?'active':''?>">
		<a href="<?php echo site_url('elite'); ?>" title="Elite Members">Elite Members</a>
		<ul class="submenu">
			<li>
				<a href="<?php echo site_url('elite'); ?>" title="List All Elite Members">List All Elite Members</a>
			</li>
			<!--<li>
				<a href="<php echo site_url('elite/search'); ?>" title="Search Elite Member">Search Elite Member</a>
			</li>-->
			<li>
				<a href="<?php echo site_url('elite/subscriptions'); ?>" title="Subscribtions">Subscriptions</a>
			</li>
		</ul>
    </li>
    <li class="<?=($this->uri->segment(1)==='complaint')?'active':''?>">
		<a href="<?php echo site_url('complaint'); ?>" title="Complaints">Complaints</a>
		<ul class="submenu">
			<li>
				<a href="<?php echo site_url('complaint'); ?>" title="List All Complaints">List All Complaints</a>
			</li>
			<li>
				<a href="<?php echo site_url('complaint/search'); ?>" title="Search Complaint">Search Complaint</a>
			</li>
			<li>
				<a href="<?php echo site_url('complaint/removed'); ?>" title="Removed Complaints">Removed Complaints</a>
			</li>
		</ul>
    </li>
    <li class="<?=($this->uri->segment(1)==='review')?'active':''?>">
		<a href="<?php echo site_url('review'); ?>" title="Business Reviews">Business Reviews</a>
		<ul class="submenu">
			<li>
				<a href="<?php echo site_url('review'); ?>" title="List All Reviews">List All Reviews</a>
			</li>
			<!--<li>
				<a href="<php echo site_url('review/search'); ?>" title="Search Review">Search Review</a>
			</li>-->
		</ul>
    </li>
    <li class="<?=($this->uri->segment(1)==='dispute')?'active':''?>">
		<a href="<?php echo site_url('dispute'); ?>" title="Disputes">Disputes</a>
		<ul class="submenu">
			<li>
				<a href="<?php echo site_url('dispute'); ?>" title="List All Disputes">List All Disputes</a>
			</li>
		</ul>
    </li>
    <li class="<?=($this->uri->segment(1)==='comment')?'active':''?>">
		<a href="<?php echo site_url('comment'); ?>" title="Comments">Comments on Reviews</a>
		<ul class="submenu">
			<li>
				<a href="<?php echo site_url('comment'); ?>" title="List All Comments">List All Comments</a>
			</li>
			<li>
				<a href="<?php echo site_url('comment/search'); ?>" title="Search Comment">Search Comment</a>
			</li>
		</ul>
    </li>
    <li class="<?=($this->uri->segment(1)==='coupon')?'active':''?>">
		<a href="<?php echo site_url('coupon'); ?>" title="Coupons">Coupons</a>
		<ul class="submenu">
			<li>
				<a href="<?php echo site_url('coupon/add'); ?>" title="Add Coupon">Add Coupon</a>
			</li>
			<li>
				<a href="<?php echo site_url('coupon'); ?>" title="List All Coupons">List All Coupons</a>
			</li>
		</ul>
    </li>
    <li class="<?=($this->uri->segment(1)==='couponcomment')?'active':''?>">
		<a href="<?php echo site_url('couponcomment'); ?>" title="Comments on coupons">Comments on Coupons</a>
		<ul class="submenu">
			<li>
				<a href="<?php echo site_url('couponcomment'); ?>" title="List All Comments">List All Comments</a>
			</li>
			<!--<li>
				<a href="<php echo site_url('couponcomment/search'); ?>" title="Search Comment">Search Comment</a>
			</li>-->
		</ul>
    </li>
    <li class="<?=($this->uri->segment(1)==='ad')?'active':''?>">
		<a href="<?php echo site_url('ad'); ?>" title="Google ads">Google ads</a>
		<ul class="submenu">
			<li>
				<a href="<?php echo site_url('ad/add'); ?>" title="Add ad">Add ad</a>
			</li>
			<li>
				<a href="<?php echo site_url('ad'); ?>" title="List All ads">List All ads</a>
			</li>
		</ul>
    </li>
    <li class="<?=($this->uri->segment(1)==='tutorial')?'active':''?>">
		<a href="<?php echo site_url('tutorial'); ?>" title="Tutorials Management Tool">Tutorials Management Tool</a>
		<ul class="submenu">
			<li>
				<a href="<?php echo site_url('tutorial/add'); ?>" title="Add Elite Admin Tutorial">Add Elite Admin Tutorial</a>
			</li>
			<li>
				<a href="<?php echo site_url('tutorial'); ?>" title="List All Elite Admin Tutorial">List All Elite Admin Tutorial</a>
			</li>
		</ul>
    </li>
	<li class="<?=($this->uri->segment(1)==='report')?'active':''?>">
		<a href="<?php echo site_url('report');?>" class="link" title="Reports">Reports</a>
	</li>
	<li class="<?=($this->uri->segment(1)==='url')?'active':''?>">
		<a href="<?php echo site_url('url'); ?>" title="Website">Websites</a>
		<ul class="submenu">
			<li>
				<a href="<?php echo site_url('url/add'); ?>" title="Add Website">Add Website</a>
			</li>
			<li>
				<a href="<?php echo site_url('url'); ?>" title="List All Websites">List All Websites</a>
			</li>
		</ul>
    </li>
    <li class="<?=($this->uri->segment(1)==='discount')?'active':''?>">
		<a href="<?php echo site_url('discount'); ?>" title="Discount Codes">Discount Codes</a>
		<ul class="submenu">
			<li>
				<a href="<?php echo site_url('discount/add'); ?>" title="Add Discount">Add Discount</a>
			</li>
			<li>
				<a href="<?php echo site_url('discount'); ?>" title="List All Discounts">List All Discounts</a>
			</li>
		</ul>
    </li>
    <li class="<?=($this->uri->segment(1)==='logout')?'active':''?>">
		<a href="<?php echo site_url('dashboard/logout');?>" class="link" title="Logout">Logout</a>
	</li>
  </ul>
  <!-- /.mainmenu --> 
</div>

