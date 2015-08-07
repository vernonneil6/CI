<?php echo $header;?>
<section class="container">
  <section class="main_contentarea">
	
		<?php 
		    $avgstar = $this->common->get_avg_ratings_bycmid($company[0]['id']);
			$avgstar = round($avgstar);
			$elitemem_status = $this->common->get_eliteship_bycompanyid($company[0]['id']);
		?>
		<div class="verified_wrp pr_rwrp verfs_top">
            
            <div class="verified_wrp pr_rwrp pr_rwrp">
              <?php if(count($elitemem_status)==0){?>
              <div class="vry_logo"> <a href="<?php echo site_url($company[0]['seoslug']);?>" title="view company Detail" ><img src="images/notverified.png" class = "searchlogos" alt="<?php echo ucfirst(stripslashes($company[0]['company'])); ?>" /></a> </div>
              <?php }else{
				  ?>
              <div class="vry_logo"> <a href="<?php echo site_url($company[0]['seoslug']);?>" title="view company Detail"><img src="images/verifiedlogo.jpg" class = "searchlogoss" alt="<?php echo ucfirst(stripslashes($company[0]['company'])); ?>" /></a> </div>    
                  <?php
				  } ?>
			
		  <div class="compny_name">
			<h1>
			<a href="<?php echo site_url($company[0]['seoslug']);?>" title="view company Detail" style="height:auto;color:#333333 !important;">
			<?php echo strtoupper($company[0]['company']);?>
			</a>
			</h1>
		  
          
          <?php if(count($elitemem_status)==0){?>
			
				<?php $urls="http://business.yougotrated.com/?elitemem=".$company[0]['id'].""; ?>
				
				<a href="<?php echo $urls;?>" title="Upgrade to Elite">
					<img src="images/YouGotRated_BusinessProfile_NotVerified-CompanyHeaderText.jpg">
				<div class="business_link"> 			
					IS THIS YOUR BUSINESS? CLICK HERE TO BECOME VERIFIED			
				</div>
				</a>    
			
		<?php }else { ?>
			<div class="vrytitle">YouGotRated VERIFIED MERCHANT</div>
		<?php } ?>
             
		  <div class="vry_rating reviewrates in_block custom-top-rating" style="margin-top:-12px;">
			<div class="count-1">
			  <?php for($r=0;$r<$avgstar;$r++){?>
			  <i class="vry_rat_icn"></i>
			  <?php } ?>
			  <?php for($p=0;$p<(5-$avgstar);$p++){?>
			  <img src="images/no_star.png" alt="no_star" title="no_star" class = "float_left" />
			  <?php } ?>
			</div>
		  </div>
		  

				<div class="vry_btn reviewbtn d_tab">
					<a href="review/add/<?php echo $company[0]['id'];?>" title="Write review">WRITE REVIEW</a> 
					<a href="<?php echo site_url('complaint/add/'.$company[0]['id']);?>" title="File Complaint"> FILE COMPLAINT</a>
				</div>
			
				
            </div>
            </div>
           
            <div class="contct_dtl cntdll presscontact">
              <ul>
                <li><span>ADDRESS</span> <a> <?php echo ucfirst($company[0]['streetaddress']);?>&nbsp;&nbsp;&nbsp;<?php echo ucfirst($company[0]['city']);?>,&nbsp;&nbsp;&nbsp;<?php echo ucfirst($company[0]['state']);?>,&nbsp;&nbsp;&nbsp;<?php echo ucfirst($company[0]['country']);?>,&nbsp;&nbsp;&nbsp;<?php echo ($company[0]['zip']);?> </a></li>
                <li><span>PHONE</span> <a href="tel:<?php echo ($company[0]['phone']);?>" title="call us"><?php echo ($company[0]['phone']);?></a></li>
                <li><span>WEBSITE</span> <a href="<?php echo (strpos($company[0]['siteurl'],'http') !== false) ? '' :'//'; echo ($company[0]['siteurl']);?>" title="company website"><?php echo ($company[0]['siteurl']);?></a></li>
                <li><span>E-MAIL</span> <a href="mailto:<?php echo ($company[0]['email']);?>" title="mail us"><?php echo ($company[0]['email']);?></a></li>
              </ul>
            </div>
            <div class="addthis_native_toolbox"></div>
          </div>
          
          
          
          
    <div class="pr_detlwrp">
      <div class="titl_pr_rel">
        <h1>"<?php echo stripslashes(str_replace("-"," ",ucfirst($pressrelease[0]['title']))); ?>"</h1>
        <p> - <?php echo date("m/d/Y",strtotime($pressrelease[0]['insertdate']));?> -</p>
      </div>
      <div class="pr_testmnl_wrp">
        <p><?php echo stripslashes(ucfirst($pressrelease[0]['subtitle'])); ?></p>
        <p><?php echo stripslashes(($pressrelease[0]['sortdesc'])); ?></p>
        <p><?php echo stripslashes(($pressrelease[0]['presscontent'])); ?></p>
        <div class="testmnl_clntwrp cmt_single">
          <div class="clnt_intr">
            <div class="clnt_pic valign_img"> <img src="images/default_user.png" alt="Client Image" title="Client Image"> </div>
            <div class="clnt_name">
              
              <h4 class = "text_compny_heading"><?php echo $companyname;?></h4>
              <span><?php echo $address;?></span>
              <div>
				  <a href="tel:<?php echo $phone;?>" style="color: #999999;font-size: 12px;font-family: MyriadPro-Regular"><?php echo $phone;?></a><br/>
				  <a href="<?php echo $url;?>" title="<?php echo $url;?>" target="_blank" style="color: #999999;font-family: MyriadPro-Regular;font-size: 12px;"><?php echo strtolower($url); ?></a>
			  </div>
              <div>
				  <?php if( count($sems)>0 ) {?>
				  <?php for($j=0;$j<count($sems);$j++){?>
				  <?php if($sems[$j]['title']=='ebay') { ?>
				  <a href="<?php echo $sems[$j]['url'];?>" title="<?php echo $sems[$j]['title']; ?>" target="_blank"> <img src="<?php echo base_url(); ?>uploads/companysem/thumb/<?php echo $sems[$j]['thumbimg']; ?>" title="<?php echo $sems[$j]['title']; ?>" width="40px;" height="25px;" style="padding-bottom: 3px;" alt="<?php echo $sems[$j]['title']; ?>"/> </a>
				  <?php } else { ?>					  
				  <a href="<?php echo $sems[$j]['url'];?>" title="<?php echo $sems[$j]['title']; ?>" target="_blank"> <img src="<?php echo base_url(); ?>uploads/companysem/thumb/<?php echo $sems[$j]['thumbimg']; ?>" title="<?php echo $sems[$j]['title']; ?>" width="30px;" height="30px;" alt="<?php echo $sems[$j]['title']; ?>"/> </a>
				  <?php } } }?>
			  </div>           
            </div>          
          </div>
        </div>
        <div class="addcmnt_wrp">
          <div class="cmnt_wrp"> </div>
        </div>
      </div>
    </div>
    <?php if(count($mypressreleases) > 0){?>
    <div class="cmnts_mainwrp">
      <h2>MORE PRESS RELEASES FROM <?php echo $mypressreleases[0]['company'];?> </h2>
		<?php for($i=0;$i<count($mypressreleases);$i++){?>
		    <div class="cmnt_blckwrp">
				<div class="clnt_intr cmt_none">
				  <div class="clnt_pic valign_img"> <img src="images/default_user.png" alt="Client Image" title="Client Image"> </div>
				  <div class="clnt_name txt_right txt_lefts">
					<h4><a href="<?php echo site_url($mypressreleases[$i]['company_seoslug']);?>" title="View company"><?php echo stripslashes(ucfirst($mypressreleases[$i]['company'])); ?></a></h4>
					<span><?php echo stripslashes(ucfirst($mypressreleases[$i]['country'])); ?></span>
					<p><?php echo $this->pressreleases->get_count_for_pressreleases($mypressreleases[$i]['companyid']);?> POSTS</p>
				  </div>
				</div>
				<div class="review_rgt cmnt_dscr cmt_none cmt_word">
				  <a href="<?php echo site_url('pressrelease/browse/'.$mypressreleases[$i]['seokeyword']);?>" title="View pressrelease" ><p><?php echo stripslashes(($mypressreleases[$i]['sortdesc'])); ?></p></a>
				</div>
			  </div>
      
     <?php } ?> 
    </div>
    <?php } ?>
			
  </section>
</section>
<?php echo $footer;?>
