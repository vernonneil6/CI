<?php echo $header; ?>

<!-- #content -->

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
        <li> <a href="<?php echo site_url('setting');?>" title="Settings"> <img src="images/setting.jpg" alt="Settings" title="Settings">
          <p>Settings</p>
          </a> </li>
          <li> <a href="<?php echo site_url('homesetting');?>" title="Home Page Settings"> <img src="images/home.png" alt="Home Page Settings" title="Home Page Settings">
          <p>Home Page Settings</p>
          </a> </li>
        <li> <a href="<?php echo site_url('seo');?>" title="SEOs"> <img src="images/seo.jpg" alt="SEOs" title="SEOs">
          <p>SEOs</p>
          </a> </li>
        <li> <a href="<?php echo site_url('sem');?>" title="SEMs"> <img src="images/sem.jpg" alt="SEMs" title="SEMs">
          <p>SEMs</p>
          </a> </li>
        <li> <a href="<?php echo site_url('email');?>" title="Email Formats"> <img src="images/email.jpeg" alt="Email Formats" title="Email Formats">
          <p>Email Formats</p>
          </a> </li>
        <li> <a href="<?php echo site_url('page');?>" title="Pages"> <img src="images/page.png" alt="Pages" title="Pages">
          <p>Pages</p>
          </a> </li>
        <li> <a href="<?php echo site_url('faq');?>" title="FAQs"> <img src="images/faq.jpg" alt="FAQs" title="FAQs">
          <p>FAQs</p>
          </a> </li>
        <li> <a href="<?php echo site_url('solution');?>" title="Business Solutions"> <img src="images/solution2.png" alt="Business Solutions" title="Business Solutions">
          <p>Business Solutions</p>
          </a> </li>
          <li> <a href="<?php echo site_url('category');?>" title="Business Categories"> <img src="images/category-icon.png" alt="Business Categories" title="Business Categories">
          <p>Business Categories</p>
          </a> </li>
        <li> <a href="<?php echo site_url('search');?>" title="Trending Searches"> <img src="images/search2.png" alt="Trending Search" title="Trending Searches">
          <p>Trending Searches</p>
          </a> </li>
        <li> <a href="<?php echo site_url('user');?>" title="Users"> <img src="images/user.jpeg" alt="User" title="Users">
          <p>Users</p>
          </a> </li>
        <li> <a href="<?php echo site_url('company');?>" title="Companies"> <img src="images/company.gif" alt="Companies" title="Companies">
          <p>Companies</p>
          </a> </li>
        <li> <a href="<?php echo site_url('elite');?>" title="Elite Members"> <img src="images/elite.png" alt="Elite Members" title="Elite Members">
          <p>Elite Members</p>
          </a> </li>
        <li> <a href="<?php echo site_url('complaint');?>" title="Complaints"> <img src="images/complaint.jpg" alt="Complaints" title="Complaints">
          <p>Complaints</p>
          </a> </li>
        <li> <a href="<?php echo site_url('review');?>" title="Business Reviews"> <img src="images/review.jpg" alt="Business Reviews" title="Business Reviews">
          <p>Business Reviews</p>
          </a> </li>
        <li> <a href="<?php echo site_url('comment');?>" title="Comments on reviews"> <img src="images/comment.jpeg" alt="Comments" title="Comments on reviews">
          <p>Comments on reviews</p>
          </a> </li>
          <li> <a href="<?php echo site_url('coupon');?>" title="CouponsDeals & Steals"> <img src="images/coupon.png" alt="Coupons" title="Coupons">
          <p>Coupons</p>
          </a> </li>
          <li> <a href="<?php echo site_url('couponcomment');?>" title="Comments on coupons"> <img src="images/comment.jpeg" alt="Comments" title="Comments on coupons">
          <p>Comments on coupons</p>
          </a> </li>
          <li> <a href="<?php echo site_url('ad');?>" title="Google Ads"> <img src="images/ad.jpeg" alt="Google Ads" title="Google Ads">
          <p>Google Ads</p>
          </a> </li>
          <li> <a href="<?php echo site_url('report');?>" title="Reports"> <img src="images/report.png" alt="Reports" title="Reports">
          <p>Reports</p>
          </a> </li>
          <li> <a href="<?php echo site_url('url');?>" title="Websites"> <img src="images/site.jpeg" alt="Websites" title="Websites">
          <p>Websites</p>
          </a> </li>
          <li> <a href="<?php echo site_url('discount');?>" title="Discount"> <img src="images/dis.png" alt="discount" title="discount">
          <p>Discount</p>
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