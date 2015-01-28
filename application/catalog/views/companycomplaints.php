<?php echo $header; ?>

<section class="container">
  <section class="main_contentarea">
    <div class="innr_wrap">
      <h1 class="bannertextcoupon">
   		<span class="bannertextregular">Recent </span>Complaints
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
					<img width="60px" src="<?php if( strlen($complaints[$i]['avatarbig']) > 1 ){ echo $this->common->get_setting_value('2').$this->config->item('user_thumb_upload_path');?><?php echo stripslashes($complaints[$i]['avatarbig']); } else { if($complaints[$i]['gender']=='Male') { echo $this->common->get_setting_value('2')."images/default_user.png"; } 
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
            <h2> <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint detail" style="color:#0080FF;"> <?php echo strtoupper($complaints[$i]['company']);?> </a> </h2>
            <div class="revw_occupt"> <span></span>-
              <p>
                <?php if($complaints[$i]['userid']!=0){ ?>
                <?php if(count($user)>0) {?>
                <a href="<?php echo site_url('complaint/viewuser/'.$complaints[$i]['companyid'].'/'.$complaints[$i]['userid']); ?>" title="view profile" style="color:#0080FF;"><?php echo $user[0]['username'];?></a>
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
