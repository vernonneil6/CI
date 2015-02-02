<?php echo $header; ?>

<section class="container">
  <section class="main_contentarea">

    <div class="innr_wrap">
      
      <h1  class="bannertextcoupon profile_page_heading">
		<div class ="float_left profile_page_title">
			<span class="bannertextregular">RELATED </span><br> VIDEOS
		</div>
		<?php 
		    
		    $avgstar = $this->common->get_avg_ratings_bycmid($company[0]['id']);
			$avgstar = round($avgstar);
			$elitemem_status = $this->common->get_eliteship_bycompanyid($company[0]['id']);
			
		?>
		<div class="srch_rslt_left profile_page_content">
            
            <div class="verified_wrp srch_rslt_vrfy vfy_rvw">
              <?php if(count($elitemem_status)==0){?>
              <div class="vry_logo"> <a href="<?php echo site_url('company/'.$company[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view company Detail" ><img src="images/notverified.png" class = "searchlogos" alt="<?php echo ucfirst(stripslashes($company[0]['company'])); ?>" /></a> </div>
              <?php }else{
				  ?>
              <div class="vry_logo"> <a href="<?php echo site_url('company/'.urlencode($company[0]['companyseokeyword']).'/reviews/coupons/complaints');?>" title="view company Detail"><img src="images/verifiedlogo.jpg" class = "searchlogoss" alt="<?php echo ucfirst(stripslashes($company[0]['company'])); ?>" /></a> </div>    
                  <?php
				  } ?>
			<div>
              
		  <div class="compny_name cpyynme">
			<h2>
			<a href="<?php echo site_url('company/'.$company[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view company Detail" style="height:auto;color:#333333 !important;">
			<?php echo strtoupper($company[0]['company']);?>
			</a>
			</h2>
		  </div>
              
		  <div class="compny_name" style="margin-top:-12px;">
			<div class="vry_rating">
			  <?php for($r=0;$r<$avgstar;$r++){?>
			  <i class="vry_rat_icn"></i>
			  <?php } ?>
			  <?php for($p=0;$p<(5-$avgstar);$p++){?>
			  <img src="images/no_star.png" alt="no_star" title="no_star" class = "float_left"/>
			  <?php } ?>
			</div>
		  </div>
		  
			<?php if(count($elitemem_status)==0){?>
				<div class="vry_btn">
					<a href="review/add/<?php echo $company[0]['id'];?>" title="Write review">WRITE REVIEW</a> 
					<a href="<?php echo site_url('complaint/add/'.$company[0]['id']);?>" title="File Complaint"> FILE COMPLAINT</a>
				</div>
			<?php }else{  ?>
				<div class="vry_btn">
					<a href="review/add/<?php echo $company[0]['id'];?>" title="Write review">WRITE REVIEW</a> 
					<a href="<?php echo site_url('complaint/dispute/'.$company[0]['id']);?>" title="File Complaint"> FILE COMPLAINT</a>
				</div>
			<?php }  ?>
				
            </div>
            </div>
            <div class="contct_dtl cntdll">
              <ul>
                <li><span>ADDRESS</span> <a> <?php echo ucfirst($company[0]['streetaddress']);?>&nbsp;&nbsp;&nbsp;<?php echo ucfirst($company[0]['city']);?>,&nbsp;&nbsp;&nbsp;<?php echo ucfirst($company[0]['state']);?>,&nbsp;&nbsp;&nbsp;<?php echo ucfirst($company[0]['country']);?>,&nbsp;&nbsp;&nbsp;<?php echo ($company[0]['zip']);?> </a></li>
                <li><span>PHONE</span> <a href="tel:<?php echo ($company[0]['phone']);?>" title="call us"><?php echo ($company[0]['phone']);?></a></li>
                <li><span>WEBSITE</span> <a href="<?php echo (strpos($company[0]['siteurl'],'http') !== false) ? '' :'//'.($company[0]['siteurl']);?>" title="company website"><?php echo ($company[0]['siteurl']);?></a></li>
                <li><span>E-MAIL</span> <a href="mailto:<?php echo ($company[0]['email']);?>" title="mail us"><?php echo ($company[0]['email']);?></a></li>
              </ul>
            </div>
          </div>
          
          
          
      </h1>      
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
					echo "<iframe width=\"967\" height=\"425\" src=\"http://www.youtube.com/embed/$ytcode\" frameborder=\"1\" allowfullscreen></iframe>";
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
