<?php echo $header;?>
<section class="container">
  <section class="main_contentarea">
    <?php  //get avg star by cmpyid
			$avgstar = $this->common->get_avg_ratings_bycmid($pressrelease[0]['companyid']);
			$avgstar = round($avgstar);
			$elitemem_status = $this->common->get_eliteship_bycompanyid($pressrelease[0]['companyid']);
			//echo "<pre>";
			//print_r($elitemem_status);
			//die();
			?>
    
    <div class="verified_wrp pr_rwrp pr_rwrp">
      <?php if(count($elitemem_status)==0){?>
              <div class="vry_logo"> <a href="<?php echo site_url('company/'.$pressrelease[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view company Detail"><img src="images/YouGotRated_BusinessProfile_NotVerified-ReviewsTag.png" alt="<?php echo ucfirst(stripslashes($pressrelease[0]['company'])); ?>" /></a> </div>
              <?php }else{
				  ?>
              <div class="vry_logo"> <a href="<?php echo site_url('company/'.$pressrelease[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view company Detail"><img src="images/verified_img.png" alt="<?php echo ucfirst(stripslashes($pressrelease[0]['company'])); ?>" /></a> </div>    
                  <?php
				  } ?>
      <?php if(count($elitemem_status)>0){?>
      <div class="vry_title"></div>
      <?php }else { ?>
      <div class="bsntvry_title">
        <div class="bsvry_tag"> <span>IS THIS YOUR BUSINESS?</span>
          <p><a href="solution/claimbusiness" title="CLICK HERE TO BECOME VERIFIED">CLICK HERE TO BECOME VERIFIED</a></p>
        </div>
      </div>
      <?php } ?>
      <div class="compny_name">
        <h1 onclick="javascipt:window.open('<?php echo site_url('company/'.$pressrelease[0]['companyseokeyword'].'/reviews/coupons/complaints');?>')" title="view company" style="cursor:pointer">
        
		<?php echo $companyname;?></a></h1>
        <?php 
		//get avg star by cmpyid
		$avgstar = $this->common->get_avg_ratings_bycmid($pressrelease[0]['companyid']);
		$avgstar = round($avgstar);
		;?>
        <div class="vry_rating">
          <?php for($r=0;$r<($avgstar);$r++){?>
          <i class="vry_rat_icn"></i>
          <?php } ?>
          <?php for($p=0;$p<(5-($avgstar));$p++){?>
          <img src="images/no_star.png" alt="no_star" title="no_star" />
          <?php } ?>
        </div>
      </div>
      <div class="vry_btn"><a href="<?php echo base_url('review/add/'.$pressrelease[0]['companyid']);?>" title="Write review">WRITE REVIEW</a> <a href="<?php echo site_url('complaint/add');?>" title="File Complaint">FILE COMPLAINT</a></div>
    </div>
    <div class="pr_detlwrp">
      <div class="titl_pr_rel">
        <h1>"<?php echo stripslashes(ucfirst($pressrelease[0]['title'])); ?>"</h1>
        <p> - <?php echo date("d.m.y",strtotime($pressrelease[0]['insertdate']));?> -</p>
      </div>
      <div class="pr_testmnl_wrp">
        <p><?php echo stripslashes(ucfirst($pressrelease[0]['subtitle'])); ?></p>
        <p><?php echo stripslashes(($pressrelease[0]['sortdesc'])); ?></p>
        <p><?php echo stripslashes(($pressrelease[0]['presscontent'])); ?></p>
        <div class="testmnl_clntwrp">
          <div class="clnt_intr"> - &nbsp;&nbsp;
            <div class="clnt_pic"> <img src="images/user_icn.png" alt="Client Image" title="Client Image"> </div>
            <div class="clnt_name">
              <h4><?php echo $companyname;?></h4>
              <span><?php echo $country;?></span>
              <p><?php echo $this->pressreleases->get_count_for_pressreleases($pressrelease[0]['companyid']);?> POSTS</p>
            </div>
            <br/>
            <?php /*?><?php echo $address;?><br/><?php */?>
            <div style="margin:0px 0px 0px 65px;"><a href="tel:<?php echo $phone;?>" style="color: #999999;font-size: 12px;font-family: "nimbus-sans-condensed""><?php echo $phone;?></a><br/>
            <a href="<?php echo $url;?>" title="<?php echo $url;?>" target="_blank" style="color: #999999;
    font-family: "nimbus-sans-condensed";
    font-size: 12px;
"><?php echo $url;?></a></div>
            <div>
              <?php if( count($sems)>0 ) {?>
              <?php for($j=0;$j<count($sems);$j++){?>
              <a href="<?php echo $sems[$j]['url'];?>" title="<?php echo $sems[$j]['title']; ?>" target="_blank"> <img src="<?php echo base_url(); ?>uploads/companysem/thumb/<?php echo $sems[$j]['thumbimg']; ?>" title="<?php echo $sems[$j]['title']; ?>" width="30px;" height="30px;" alt="<?php echo $sems[$j]['title']; ?>"/> </a>
              <?php
		
		} }?>
            </div>
          </div>
        </div>
        <div class="addcmnt_wrp">
          <div class="cmnt_wrp"> </div>
        </div>
      </div>
    </div>
    <?php if(count($otherpressreleases)>0){?>
    <div class="cmnt_mainwrp">
      <h2>WHAT OTHERS HAVE BEEN SAYING</h2>
      <?php for($i=0;$i<count($otherpressreleases);$i++){?>
      <div class="cmnt_blckwrp">
        <div class="clnt_intr cmt_lft">
          <div class="clnt_name txt_right">
            <h4><a href="<?php echo site_url('company/'.$otherpressreleases[$i]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="View company"><?php echo stripslashes(ucfirst($otherpressreleases[$i]['company'])); ?></a></h4>
            <span><?php echo stripslashes(ucfirst($otherpressreleases[$i]['country'])); ?></span>
            <p><?php echo $this->pressreleases->get_count_for_pressreleases($otherpressreleases[$i]['companyid']);?> POSTS</p>
          </div>
          <div class="clnt_pic"> <img src="images/user_icn.png" alt="Client Image" title="Client Image"> </div>
        </div>
        <div class="review_rgt cmnt_dscr">
          <p><?php echo stripslashes(($otherpressreleases[$i]['sortdesc'])); ?></p>
        </div>
      </div>
      <?php } ?>
    </div>
    <?php } ?>
  </section>
</section>
<?php echo $footer;?>