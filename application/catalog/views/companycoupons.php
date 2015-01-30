<?php echo $header; ?>

<section class="container">
  <section class="main_contentarea">

    <div class="innr_wrap">
      
      <h1  class="bannertextcoupon bnrtxt">
		<span class="bannertextregular">Related </span> Coupons
      </h1>      
      <div class="coupon_wrap">
        <?php 
        if(count($coupons))
        { 
		for($i=0; $i<count($coupons); $i++) 
		{ 
		$date = date_default_timezone_set('Asia/Kolkata');                             
		$dbdate = date('Y-m-d',strtotime($coupons[$i]['enddate']));
		$today = date('m/d/Y');
		$d1 = strtotime(date('Y-m-d H:i:s'));
		$d2 = strtotime($coupons[$i]['enddate']);
		$newdate =round(($d1-$d2)/60);
		if($newdate > 60){$diff = round(($d1-$d2)/60/60).' hours ago';}else{$diff = $newdate.' minutes ago';}
		?>
        <div class="revw_blck">
            <div class="revw_blck_img"> 
				<a href="<?php echo site_url('coupon/browse/'.$coupons[$i]['seokeyword']); ?>" title="view coupon detail"><img src="<?php if( $coupons[$i]['image'] ){ echo $this->common->get_setting_value('2').$this->config->item('coupon_thumb_upload_path');?><?php echo stripslashes($coupons[$i]['image']); } else{echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path')."/no_image.png"; } ?>" alt="<?php echo ucfirst(stripslashes($coupons[$i]['company'])); ?>" width="90px" height="80px"/></a> 
			</div>
            <div class="revw_blck_cnt">
				<div class = "coupon_company_title">
					<a class = "font_color_3"  href="<?php echo site_url('coupon/browse/'.$coupons[$i]['seokeyword']); ?>" title="view coupon detail"><?php echo ucfirst(stripslashes($coupons[$i]['company'])); ?></a>
				</div>
				<h2>
					<a class = "recenttitle" href="<?php echo site_url('coupon/browse/'.$coupons[$i]['seokeyword']); ?>" title="view coupon detail"><?php echo strtolower(stripslashes($coupons[$i]['title'])); ?></a>
					<a class = "recentexpire" href="<?php echo site_url('coupon/browse/'.$coupons[$i]['seokeyword']); ?>" title="view coupon detail">Expires : <?php echo date('m/d/Y',strtotime($dbdate));?></a>
				</h2>
				<div class="coupon_dscrwrp">
					<div class="coupon_dscr">
						<div class="revw_desc"> 		   
						   <a href="<?php echo $coupons[$i]['url']; ?>" title="Advertisement" target="_blank" rel="nofollow">Promocode : <span><?php echo $coupons[$i]['promocode'];?></span> </a></br>
						   <a href="<?php echo site_url('coupon/browse/'.$coupons[$i]['seokeyword']); ?>" title="Business Category"><span><?php echo ucfirst($coupons[$i]['category']);?></span> </a>
						</div>
					</div>
					<div class="offer_wrp"> <a  class = "recent_view_all" href="<?php echo site_url('company').'/'.$coupons[$i]['companyseokeyword'].'/reviews/coupons/complaints';?>" title="view all"> + READ MORE</a> </div>
				</div>
			</div>
		</div>
        <?php 
        } 
        ?>
        <?php  if($this->pagination->create_links()) { ?>
        <tr style="background:#ffffff">
          <td></td>
          <td></td>
          <td></td>
          <td style="padding:10px"><div class="pagination"><?php echo $this->pagination->create_links(); ?></div></td>
        </tr>
        <?php } } else { ?>
        <div class="main_livepost">
          <div class="post_maincontent">
            <div class="form-message warning">
              <p>No coupons.</p>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
    <!-- /#content --> 
  </section>
</section>
<?php echo $footer; ?>
