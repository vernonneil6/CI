<?php echo $header;?>

<section class="container">
  <section class="main_contentarea serch_result">
    <h1 class="bannertext btxt">
		<span class="bannertextregular">YOUR SEARCH </span>RESULTS</h1>
    </h1>
    <div class="srch_rslt_wrp">
		<div style='text-align:center'>
      If the business you are looking for isnt here, add it!

	<a href="<?php echo site_url('businessdirectory/add');?>">ADD BUSINESS</a>
  </div>
      <form class="busdt_wrap" method="post" id="frmcompany" action="businessdirectory/search">
      <div class="main_bd_srchwrp">
          <div class="bdsrch_wrp">
            <h2>Search</h2>
            <div class="bd_srchwrp">
              <input type="text" class="bdsrch_txtbx" placeholder="ENTER CITY OR COMPANY NAME HERE" id="searchcomp" name="searchcomp" maxlength="100" required value="<?php echo $keyword;?>">
              <input type="submit" class="bdsrch_btn" title="Search" id="btnsearch" name="btnsearch" value="">
            </div>
          </div>
        </div>
        </form>
      <?php if( count($companies) > 0) { ?>
      <?php for($i=0; $i<count($companies); $i++) { ?>
      
      <?php $avgstar = $this->common->get_avg_ratings_bycmid($companies[$i]['id']);
			$avgstar = round($avgstar);
			$elitemem_status = $this->common->get_eliteship_bycompanyid($companies[$i]['id']);
			
			?>
     <div class="srch_result_blck">
        <div class="innr_wrap">
          <div class="srch_rslt_left">
            <div class="verified_wrp srch_rslt_vrfy vfy_rvw">
              <?php if(count($elitemem_status)==0){?>
              <div class="vry_logo"> <a href="<?php echo site_url('company/'.$companies[$i]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view company Detail" ><img src="images/notverified.png" class = "searchlogos" alt="<?php echo ucfirst(stripslashes($companies[$i]['company'])); ?>" /></a> </div>
              <?php }else{
				  ?>
              <div class="vry_logo"> <a href="<?php echo site_url('company/'.urlencode($companies[$i]['companyseokeyword']).'/reviews/coupons/complaints');?>" title="view company Detail"><img src="images/verifiedlogo.jpg" class = "searchlogoss" alt="<?php echo ucfirst(stripslashes($companies[$i]['company'])); ?>" /></a> </div>    
                  <?php
				  } ?>
			<div>
				
             <div class="compny_name cpyynme">
                <h2>
				
				 <?php if(count($elitemem_status)==0){?>
				<a class="cmpn_name" href="<?php echo site_url('company/'.$companies[$i]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view company Detail" >
				<?php echo strtoupper($companies[$i]['company']);?>
				
					<a class="image_novrf" href="http://business.yougotrated.com/?elitemem=<?php echo $companies[$i]['id'] ?>" title="Upgrade to Elite">
					<img class="notverfiedimg" src="images/YouGotRated_BusinessProfile_NotVerified-CompanyHeaderText.jpg">
				<div class="business_link clickhere"> 			
					IS THIS YOUR BUSINESS? CLICK HERE TO BECOME VERIFIED			
				</div>
				</a>
				</a>
				
              <?php } else { ?>
                <a class="cmpn_name" href="<?php echo site_url('company/'.$companies[$i]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view company Detail" >
				<?php echo strtoupper($companies[$i]['company']);?>
				
                <a class="vrf_merchant" href="<?php echo site_url('company/'.urlencode($companies[$i]['companyseokeyword']).'/reviews/coupons/complaints');?>" title="view company Detail"><div class="vrytitle verifytag">YouGotRated VERIFIED MERCHANT</div></a>
                  <?php  } ?>
			
                </a>
                </h2>
              </div>
              <div class="compny_name">
                <div class="vry_rating">
                  <?php for($r=0;$r<$avgstar;$r++){?>
                  <i class="vry_rat_icn"></i>
                  <?php } ?>
                  <?php for($p=0;$p<(5-$avgstar);$p++){?>
                  <img src="images/no_star.png" alt="no_star" title="no_star" />
                  <?php } ?>
                </div>
              </div>
<?php if(count($elitemem_status)==0){?>
              <div class="vry_btn bmoves"><a href="review/add/<?php echo $companies[$i]['id'];?>" title="Write review">WRITE REVIEW</a> <a href="<?php echo site_url('complaint/add/'.$companies[$i]['id']);?>" title="File Complaint"> FILE COMPLAINT</a>
</div>
<?php }else{  ?>
<div class="vry_btn bmoves"><a href="review/add/<?php echo $companies[$i]['id'];?>" title="Write review">WRITE REVIEW</a> <a href="<?php echo site_url('complaint/dispute/'.$companies[$i]['id']);?>" title="File Complaint"> FILE COMPLAINT</a>
</div>
<?php }  ?>
            </div>
            </div>
            <div class="contct_dtl cntdll">
              <ul>
                <li><span>ADDRESS</span> <a> <?php echo ucfirst($companies[$i]['streetaddress']);?>&nbsp;&nbsp;&nbsp;<?php echo ucfirst($companies[$i]['city']);?>,&nbsp;&nbsp;&nbsp;<?php echo ucfirst($companies[$i]['state']);?>,&nbsp;&nbsp;&nbsp;<?php echo ucfirst($companies[$i]['country']);?>,&nbsp;&nbsp;&nbsp;<?php echo ($companies[$i]['zip']);?> </a></li>
                <li><span>PHONE</span> <a href="tel:<?php echo ($companies[$i]['phone']);?>" title="call us"><?php echo ($companies[$i]['phone']);?></a></li>
                <li><span>WEBSITE</span> <a href="<?php echo (strpos($companies[$i]['siteurl'],'http') !== false) ? '' :'//'; echo ($companies[$i]['siteurl']);?>" title="company website"><?php echo ($companies[$i]['siteurl']);?></a></li>
                <li><span>E-MAIL</span> <a href="mailto:<?php echo ($companies[$i]['email']);?>" title="mail us"><?php echo ($companies[$i]['email']);?></a></li>
                <li><span>Total Reviews</span><a>  <?php echo $this->complaints->get_to_reviews_cid($companies[$i]['id']); ?></a></li> 
              </ul>
            </div>
          </div>
          <?php 
			  $mapaddress = stripslashes($companies[$i]['streetaddress'].','.$companies[$i]['city'].','.$companies[$i]['state'].','.$companies[$i]['country'].','.$companies[$i]['zip']);
			  $string = str_replace(' ', '-', $mapaddress); // Replaces all spaces with hyphens.

   $mapaddress = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
			  ?>
          <div class="srch_rslt_right srh_rght">
            <div class="" align="center">
              <div class="Flexible-container">         
                <script>
			function PopupCenter(pageURL, title,w,h)
			{
				var left = (screen.width/2)-(w/2);
				var top = (screen.height/2)-(h/2);
			  var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
  
			}
			</script><a style="cursor: pointer;" onclick="PopupCenter('businessdirectory/map/<?php echo $mapaddress; ?>','','800','500');" target="_blank" title="View Map">View Map</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <?php } 
	 
	 
	 if($this->pagination->create_links()) { ?>
      <div class="pagination"><?php echo $this->pagination->create_links(); ?></div>
      <?php } 
	  } ?>
    </div>
    <div class="lgn_btnlogo"> <a><img src="images/ygr_logos.png" class="logo_btm" alt="Yougotrated" title="Yougotrated"></a> </div>
    <!--pagination--> 
  </section>
</section>
<?php echo $footer;?>
