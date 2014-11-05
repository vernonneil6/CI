<?php echo $header;?>

<section class="container">
  <section class="main_contentarea">
    <div class="innr_wrap">
      
      <div class="dir_rew_wrap">
        <?php if(count($complaints)>0){ ?>
        <?php //echo "<pre>"; print_r($complaints); //die;?>
        <?php for($i=0; $i<count($complaints); $i++) { ?>
        <div class="revw_blck">
          <div class="revw_blck_img"> <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint detail"><img src="<?php if( $complaints[$i]['logo'] ){ echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path');?><?php echo stripslashes($complaints[$i]['logo']); } else{echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path')."/no_image.png"; } ?>" alt="<?php echo ucfirst(stripslashes($complaints[$i]['company'])); ?>" width="100px" height="40px"/></a> </div>
          <div class="revw_blck_cnt">
            <h2> <a href="<?php echo site_url($complaints[$i]['link']); ?>" title="view detail" style="color:#0080FF;">
                  <?php $ex = explode('/',$complaints[$i]['link']);
			if($ex[0]=='complaint'){
			?>
                  <?php echo " Complaint for $".$complaints[$i]['damagesinamt'];?>
                  <?php }
            if($ex[0]=='pressrelease'){
			?>
                  <?php echo " Pressrelease ".$complaints[$i]['damagesinamt'];?>
                  <?php }
            if($ex[0]=='review'){
			?>
                  <?php echo " Review ".$complaints[$i]['damagesinamt'];?> star
                  <?php }
            if($ex[0]=='coupon'){
			?>
                  <?php echo " Promo code ".$complaints[$i]['damagesinamt'];?>
                  <?php }?>
                  </a> </h2>
            <div class="revw_occupt"> <span></span>
              
              <div class="revw_date"> <?php echo "Posted ".date('d M,Y',strtotime($complaints[$i]['complaindate'])); ?> </div>
            </div>
            
            <div class="revw_desc"> " <a href="<?php echo site_url($complaints[$i]['link']);?>" title="view detail"> <?php echo strtolower(substr(stripslashes($complaints[$i]['detail']),0,212)."..."); ?></a>" </div>
            
          </div>
          <?php } ?>
        </div>
        
        <?php
		if($this->pagination->create_links()) { ?>
        <div class="pagination"><?php echo $this->pagination->create_links(); ?></div>
        <?php } 
	   
		 }else
		 {
		?>
        <div class="data_table" align="center" style="width:80%;margin-left:10%;margin-right:10%;"> 
  
  
  <div class="isa_info">No Record found.
  
  </div>
  
</div>
        <?php
		
		}?>
      </div>
    </div>
  </section>
</section>
<?php echo $footer;?>