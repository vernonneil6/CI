<?php echo $header; ?>

<section class="container">
  <section class="main_contentarea">
    <div class="innr_wrap">
     
      <h1  class="bannertextcoupon profile_page_heading">
		<div class ="float_left profile_page_title">
			<span class="bannertextregular">RECENT </span><br> COMPLAINTS
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
                <li><span>WEBSITE</span> <a href="//<?php echo ($company[0]['siteurl']);?>" title="company website"><?php echo ($company[0]['siteurl']);?></a></li>
                <li><span>E-MAIL</span> <a href="mailto:<?php echo ($company[0]['email']);?>" title="mail us"><?php echo ($company[0]['email']);?></a></li>
              </ul>
            </div>
          </div>

      </h1>   
     
     
     
     
     
     
      <div class="dir_rew_wrap">
        <?php if(count($complaints)>0){ ?>
        <?php for($i=0; $i<count($complaints); $i++) {
		$elitemem_status = $this->common->get_eliteship_bycompanyid($complaints[$i]['companyid']);	
			 ?>
        <?php $user = $this->common->get_user_byid($complaints[$i]['userid']);?>
        <div class="revw_blck">
          <div class="revw_blck_img">
			<a href="<?php echo site_url('complaint/viewuser/'.$complaints[$i]['companyid'].'/'.$complaints[$i]['userid']);?>" title="view profile">
				<div class="task-photo"> 
					<img width="90px" height="90" src="<?php if( strlen($complaints[$i]['avatarbig']) > 1 ){ echo $this->common->get_setting_value('2').$this->config->item('user_thumb_upload_path');?><?php echo stripslashes($complaints[$i]['avatarbig']); } else { if($complaints[$i]['gender']=='Male') { echo $this->common->get_setting_value('2')."images/default_user.png"; } 
						if($complaints[$i]['gender']=='Female') { echo $this->common->get_setting_value('2')."images/default_user.png"; } 
					  } 
					   ?>" alt="<?php echo stripslashes($complaints[$i]['username']); ?>"/> 
			   </div>
            </a> 
        </div>
          <?php 
                        $date = date_default_timezone_set('Asia/Kolkata');                             
                        $dbdate = date('Y-m-d',strtotime($complaints[$i]['whendate']));
                        $complaindate = date('m/d/Y',strtotime($complaints[$i]['complaindate']));
                        $today = date('m/d/Y');
                        $d1 = strtotime(date('Y-m-d H:i:s'));
                        $d2 = strtotime($complaints[$i]['complaindate']);
                        $newdate =round(($d1-$d2)/60);
                        if($newdate > 60){$diff = round(($d1-$d2)/60/60).' hours ago';}else{$diff = $newdate.' minutes ago';}
                        ?>
          <div class="revw_blck_cnt">
            <h2> <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint detail" class="complaintlist"> <?php echo strtoupper($complaints[$i]['company']);?> </a> </h2>
            <div class="revw_occupt"> <span></span>-
              <p>
                <?php if($complaints[$i]['userid']!=0){ ?>
                <?php if(count($user)>0) {?>
                <a href="<?php echo site_url('complaint/viewuser/'.$complaints[$i]['companyid'].'/'.$complaints[$i]['userid']); ?>" title="view profile" class="complaintlist"><?php echo $user[0]['username'];?></a>
                <?php } ?>
                <?php } else{ ?>
                <a title="Anonymous">Anonymous</a>
                <?php } ?>
              </p>
              <div class="revw_date"> <?php echo date('m/d/Y',strtotime($dbdate));?> </div>
            </div>
            <div class="revw_desc"> " <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint detail"><?php echo strtolower(substr(stripslashes($complaints[$i]['detail']),0,212)."..."); ?></a>" </div>
            <div class="revw_ratpoint"> <span> <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint detail">Reported Damage: $<?php echo $complaints[$i]['damagesinamt'];?> </a> </span>
            </div>
          </div>
          <?php } ?>
        </div>
        <?php 
		if($this->pagination->create_links()) { ?>
        <div class="pagination"><?php echo $this->pagination->create_links(); ?></div>
        <?php } 
	   ?>
        <?php } ?>
      </div>
    </div>
  </section>
</section>
<?php echo $footer;?>
