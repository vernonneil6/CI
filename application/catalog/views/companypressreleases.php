<?php echo $header;?>
<section class="container">
  <section class="main_contentarea">
    <div class="innr_wrap">
      
      <h1  class="bannertextcoupon profile_page_heading">
		<div class ="float_left profile_page_title">
			<span class="bannertextregular">PRESS </span><br> RELEASE
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
			  <img src="images/no_star.png" alt="no_star" title="no_star" class = "float_left" />
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
                <li><span>WEBSITE</span> <a href="<?php echo (strpos($company[0]['siteurl'],'http') !== false) ? '' :'//'; echo ($company[0]['siteurl']);?>" title="company website"><?php echo ($company[0]['siteurl']);?></a></li>
                <li><span>E-MAIL</span> <a href="mailto:<?php echo ($company[0]['email']);?>" title="mail us"><?php echo ($company[0]['email']);?></a></li>
              </ul>
            </div>
          </div>
          
          
          
      </h1>      
      
      
      
      
      <form class="p_realse_wrap" action="pressrelease/search" method="post">
        <div class="main_press_srchwrp">
          <div class="pres_srch_wrp">
            <div class="press_srchwrp">
              <input type="text" class="press_srch_txtbx" placeholder="SEARCH FOR PRESS RELEASE" required maxlength="20" name="searchpress" id="searchpress" value="<?php echo $keyword;?>">
              <input type="submit" class="press_srch_btn" title="Search" value="">
            </div>
          </div>
        </div>
      </form>
        
        
			<?php 
			$avgstar = $this->common->get_avg_ratings_bycmid($company[0]['id']);
			$avgstar = round($avgstar);
			$elitemem_status = $this->common->get_eliteship_bycompanyid($company[0]['id']);
			
			 if( count($pressreleases) > 0) { ?>
			 <div class="dir_rew_wrap">
			<?php for($i=0; $i<count($pressreleases); $i++) { ?>

			 <div class="revw_blck">
			  <div class="revw_blck_img"> 
				 <?php 
					if(count($elitemem_status)==0)
					{
				 ?>
						<div class="vry_logo"> 
							<a href="<?php echo site_url('company/'.$pressreleases[$i]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view company Detail">
								<img  class="reviewnotverifiedlogo" src="images/notverified.png"  />
							</a> 
						</div>  <?php 
						}else{  ?>
						<div class="vry_logo"> 
							<a href="<?php echo site_url('company/'.$pressreleases[$i]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view company Detail">
								<img class="reviewverifiedlogo" src="images/verifiedlogo.jpg" />
							</a> 
						</div>      
				<?php
					} 
				?> 
					
			  </div>
			  <div class="revw_blck_cnt">
				<h2>
					<a class = "font_color_2 float_left" href="<?php echo site_url('company/'.$pressreleases[$i]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view <?php echo stripslashes(ucfirst($pressreleases[$i]['company'])); ?>'s detail"><?php echo stripslashes(ucfirst($pressreleases[$i]['company'])); ?></a>
				  
				  <div class="rating float_left">
					
					<?php for($r=0;$r<$avgstar;$r++){?>
						<i class="vry_rat_icn"></i>
					<?php } ?>
					<?php for($p=0;$p<(5-$avgstar);$p++){?>
						<img src="images/no_star.png" alt="no_star" title="no_star" />
					<?php } ?>
					
				  </div>
				</h2>
				
				<div class="revw_occupt"> 
					<span>
						<a class = "font_color_white" href="<?php echo site_url('pressrelease/browse/'.$pressreleases[$i]['seokeyword']); ?>" title="view <?php echo stripslashes(ucfirst($pressreleases[$i]['title'])); ?>'s detail">"<?php echo stripslashes(ucfirst($pressreleases[$i]['title'])); ?>"</a>
					</span>
				</div>
				
				<div class="revw_desc">
					<a href="<?php echo site_url('pressrelease/browse/'.$pressreleases[$i]['seokeyword']); ?>" title="view <?php echo stripslashes(ucfirst($pressreleases[$i]['title'])); ?>'s detail"> "<?php echo stripslashes(substr($pressreleases[$i]['sortdesc'],0,100)).'...'; ?>"</a>
				</div>
			  </div>
			</div>
                   
          <?php 
		  }
          ?>
          </div>
          <?php	 
		  }	 
          else
		  {
		  ?>
          <div id="message-red">
              <table cellpadding="0" cellspacing="0" width="99%">
              <tr>
                <td class="red-left">No Records Found.</td>
                <td class="red-right"><a class="close-green" title="Close"><img src="<?php echo base_url(); ?>images/messages/icon_close_red.gif" alt="Close"/></a></td>
              </tr>
              </table>
            </div>
          <?php
		  }?>
      
        <?php  if($this->pagination->create_links()) { ?>
			<div class="pagination"> <?php echo $this->pagination->create_links(); ?> </div>
		<?php } ?>
      
		<div class="lgn_btnlogo"> <a href=""><img src="images/ygr_logos.png" class="logo_btm" alt="Yougotrated" title="Yougotrated"></a> </div>
      
    </div>
  </section>
</section>

<?php echo $footer;?>
