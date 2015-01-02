<?php echo $header; ?>
<section class="content-wrap" style="margin-right:0">
  <section class="inner_main">
    <!-- #content -->
    
    <div class="main_contentarea"> <?php echo $menu; ?>
      <?php if($topads){ ?>
      <div class="ad_up"><a href="<?php echo $topads[0]['url'];?>" title="" target="_blank"><img src="<?php if( $topads[0]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('ad_main_upload_path');?><?php echo stripslashes($topads[0]['image']); } ?>" alt="topads" width="940" height="180" class="adimg"/></a> </div>
      <?php } ?>
      <div class="left_content_panel">
        <div class="treding_title">Trending Searches <span>Last 7 Days</span></div>
        <div class="treding_lnk">
          <?php if(count($keywords1)>0){?>
          <?php //echo '<pre>'; print_r($keywords1);?>
          <?php for($k=0; $k<count($keywords1); $k++)
					{ ?>
          <a title="Search <?php echo $keywords1[$k]['keyword'];?>" href="<?php echo base_url('complaint/keysearch');?><?php echo "/".$keywords1[$k]['keyword'];?>"><?php echo $keywords1[$k]['keyword'];?></a>
          <?php }?>
          <?php } ?>
        </div>
        <table border="0" align="left">
          <tr>
            <td width="40px"><span class="company_content_title">&nbsp;&nbsp;Do you have a complaint?</span></td>
          </tr>
          <tr>
            <td class="company_dsr">Start with the name of the Company, Person or a Phone Number. Then select the complaint type to get started.</td>
          </tr>
          <tr>
            <td><div style="margin-top:5px;margin-bottom:5px;" align="right" class="my"> <a href="<?php echo site_url('welcome');?>" title="submit a complaint"><?php echo form_input(array('name'=>'btnsubmit','id'=>'btnphone','class'=>'complaint_btn','type'=>'submit','value'=>'Submit a complaint','style'=>'padding:7px 25px;cursor: pointer;')); ?></a> </div></td>
          </tr>
        </table>
      </div>
      <div class="right_content_panel">
        <div class="treding_title" style="border-bottom: 1px solid #CCCCCC; margin-bottom: 10px; padding-bottom: 5px; width:545px">Search results for "<?php echo $keyword;?>" </div>
        <div class="example">
          <div id="content">
            <?php if(count($complaints)>0){?>
            <?php //echo '<pre>'; print_r($complaints);die();?>
            <div class="post_content_title" style="font-size:18px">Matching Results</div>
            <?php for($i=0; $i<count($complaints); $i++) { ?>
            <div class="main_livepost">
              <div class="post_maincontent">
                <div class="search_content_title"><a href="<?php echo site_url($complaints[$i]['link']); ?>" title="view detail">
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
                  </a></div>
                <?php 
?>
                <div class="search_content_date" style="margin-bottom:15px;"> <?php echo "Posted ".date('d M,Y',strtotime($complaints[$i]['complaindate'])); ?> </div>
                <div class="post_content_dscr user_view" style="min-width:500px;"> <a href="<?php echo site_url($complaints[$i]['link']);?>" title="view detail"> <?php echo strtolower(substr(stripslashes($complaints[$i]['detail']),0,212)."..."); ?></a></div>
              </div>
            </div>
            <?php }
		
		?>
            
            <?php } else { //$keyword = $keyword;?>
            <div class="post_content_title" style="font-size:18px">No Matches found</div>
            <?php } ?>
          </div>
        </div>
      </div>
      <?php 
	 ?>
      <div class="ad_bottom">
      <?php  if($this->pagination->create_links()) { ?>
            <div class="pagination pagination-centered"> <?php echo $this->pagination->create_links(); ?> </div>
            <?php } ?>
       </div>
	  <?php if($bottomads){ ?>
      <div class="ad_bottom"><a href="<?php echo $bottomads[0]['url'];?>" title="" target="_blank"><img src="<?php if( $bottomads[0]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('ad_main_upload_path');?><?php echo stripslashes($bottomads[0]['image']); } ?>" alt="topads" width="940" height="180" class="adimg"/></a> </div>
      <?php } ?>
    </div>
    <!-- /#content --> 
    
  </section>
</section>
<?php echo $footer; ?>