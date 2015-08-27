<?php echo $header; ?>
<script type="text/javascript">
	$(document).ready(function(){
		$( ".stars" ).each(function() { 
			// Get the value
			var val = $(this).data("rating");
			// Make sure that the value is in 0 - 5 range, multiply to get width
			var size = Math.max(0, (Math.min(5, val))) * 23;
			// Create stars holder
			var $span = $('<span />').width(size);
			// Replace the numerical value with stars
			$(this).html($span);
		});
	});
</script>
<section class="container">
  <section class="main_contentarea">
    <div class="innr_wrap">
      <h1  class="bannertext">
			<span class="bannertextregular"><?php echo ucfirst($company[0]['company']);?> RELATED </span>VIDEOS
	  </h1> 
		<?php 
		    
		    $avgstar = $this->common->get_avg_ratings_bycmid($company[0]['id']);
		    $itemproaverage = $avgstar;
			$avgstar = round($avgstar);
			$elitemem_status = $this->common->get_eliteship_bycompanyid($company[0]['id']);
			
		?>
		<div class="verified_wrp pr_rwrp verfs_top">
            <div class="verified_wrp pr_rwrp pr_rwrp">
              <?php if(count($elitemem_status)==0){?>
              <div class="vry_logo"  style="min-height: 138px;"> <a href="<?php echo site_url('company/'.$company[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view company Detail" ><img src="images/notverified.png" class = "searchlogos" alt="<?php echo ucfirst(stripslashes($company[0]['company'])); ?> Notverified Seal" /></a> </div>
              <?php }else{
				  ?>
              <div class="vry_logo"> <a href="<?php echo site_url('company/'.urlencode($company[0]['companyseokeyword']).'/reviews/coupons/complaints');?>" title="view company Detail"><img src="images/verifiedlogo.jpg" class = "searchlogoss" alt="<?php echo ucfirst(stripslashes($company[0]['company'])); ?> Verified Seal" /></a> </div>    
                  <?php
				  } ?>
			  <div class="compny_name">
			   <h1>
			    <a href="<?php echo site_url('company/'.$company[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view company Detail" style="height:auto;color:#333333 !important;">
			       <?php echo strtoupper($company[0]['company']);?>
			    </a>
			   </h1>
		 
          <?php if(count($elitemem_status)==0){?>
			<div class="vrytitle">
				<?php $urls="http://business.yougotrated.com/?elitemem=".$company[0]['id'].""; ?>
				
				<a href="<?php echo $urls;?>" title="Upgrade to Elite">
					<img src="images/YouGotRated_BusinessProfile_NotVerified-CompanyHeaderText.jpg">
				<div class="business_link"> 			
					IS THIS YOUR BUSINESS? CLICK HERE TO BECOME VERIFIED			
				</div>
				</a>    
			</div>
		<?php }else { ?>
			<div class="vrytitle">YouGotRated VERIFIED MERCHANT</div>
		<?php } ?>
				<div class="vry_rating reviewrates in_block custom-top-rating">
					<span class="stars" data-rating="<?php echo $itemproaverage; ?>"></span>
				</div>
				<div class="vry_btn reviewbtn d_tab">
					<a href="review/add/<?php echo $company[0]['id'];?>" title="Write review">WRITE REVIEW</a> 
					<a href="<?php echo site_url('complaint/add/'.$company[0]['id']);?>" title="File Complaint"> FILE COMPLAINT</a>
				</div>
			 </div>
			</div>	
				<div class="contct_dtl cntdll presscontact">
				<div class="inner-contct">
					<ul>
					<li><span>ADDRESS</span> <a> <?php echo ucfirst($company[0]['streetaddress']);?>&nbsp;&nbsp;&nbsp;<?php echo ucfirst($company[0]['city']);?>,&nbsp;&nbsp;&nbsp;<?php echo ucfirst($company[0]['state']);?>,&nbsp;&nbsp;&nbsp;<?php echo ucfirst($company[0]['country']);?>,&nbsp;&nbsp;&nbsp;<?php echo ($company[0]['zip']);?> </a></li>
					<li><span>PHONE</span> <a href="tel:<?php echo ($company[0]['phone']);?>" title="call us"><?php echo ($company[0]['phone']);?></a></li>
					<li><span>WEBSITE</span> <a href="<?php echo (strpos($company[0]['siteurl'],'http') !== false) ? '' :'//'; echo ($company[0]['siteurl']);?>" title="company website"><?php echo ($company[0]['siteurl']);?></a></li>
					<li><span>E-MAIL</span> <a href="mailto:<?php echo ($company[0]['email']);?>" title="mail us"><?php echo ($company[0]['email']);?></a></li>
					</ul>
				</div>
				</div>
          </div>
         
      <div class="coupon_wrap">
        <?php 
				if( count($videos) > 0 ) { 				
			?>
            <?php for($i=0; $i<count($videos); $i++) { ?>
            <div>
              <div class="company_content_title contenttag"><?php echo $videos[$i]['title'];?></div>
              <br />
              <div>
				<?php
					$ytarray=explode("/", $videos[$i]['videourl']);
					$ytendstring=end($ytarray);
					$ytendarray=explode("?v=", $ytendstring);
					$ytendstring=end($ytendarray);
					$ytendarray=explode("&", $ytendstring);
					$ytcode=$ytendarray[0];
					echo "<iframe width=\"100%\" height=\"425\" src=\"http://www.youtube.com/embed/$ytcode\" frameborder=\"1\" allowfullscreen></iframe>";
				?>  
              </div>
              <div style="display:none;"> <a href="<?php echo $videos[$i]['videourl'];?>" title="<?php echo $videos[$i]['videourl'];?>"><?php echo $videos[$i]['videourl'];?></a> </div>
            </div>
            <?php 
            }  }
            ?>
       
      </div>
    </div>
    <!-- /#content --> 
  </section>
</section>
<?php echo $footer; ?>
