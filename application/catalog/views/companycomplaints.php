<?php echo $header; ?>
<section class="content-wrap" style="margin-right:0">
  <section class="inner_main">
    <!-- #content -->
    
    <div class="main_contentarea"> <?php echo $menu; ?>
     
      <link rel="stylesheet" href="<?php echo base_url();?>js/datetimepicker/style.css" type="text/css" media="all" />
      <script src="<?php echo base_url();?>js/datetimepicker/jquery-ui-timepicker-addon.js"></script>
      <div class="left_content_panel">
        <div class="treding_title">Trending  Searches <span>Last 7 Days</span></div>
        <div class="treding_lnk">
          <?php if(count($keywords)>0){?>
          <?php for($i=0; $i<count($keywords); $i++)
                { 
								?>
          <a title="Search <?php echo $keywords[$i]['keyword'];?>" href="<?php echo site_url('complaint/keysearch').'/'.$keywords[$i]['keyword'];?>"><?php echo $keywords[$i]['keyword'];?></a>
          <?php }
                ?>
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
          <tr>
            <td></td>
          </tr>
          <tr>
            <td><?php if($leftads){ ?>
              <div><a href="<?php echo $leftads[0]['url'];?>" title="Advertisement" target="_blank" rel="nofollow"><img src="<?php if( $leftads[0]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('ad_main_upload_path');?><?php echo stripslashes($leftads[0]['image']); } ?>" alt="Advertisement" width="280" height="180" class="adimg"/></a> </div>
              <?php } ?></td>
          </tr>
        </table>
      </div>
      <div class="right_content_panel">
        <div class="treding_title">
          <h1 style="font-size:24px !important;">Yougotrated Live</h1>
        </div>
        <div class="filter"><span style="font-size:14px; font-weight:bold;">Filter by :</span> <a href="<?php echo site_url('complaint');?>" class="filter_active" title="Recent Activity">Recent Activity</a> <a href="<?php echo site_url('complaint/weektrending');?>" title="Trending Complaints">Trending Complaints (7 Days)</a> <!--<a href="#">Most Active (7 Days)</a>--><a href="<?php echo site_url('complaint/advfilter');?>" title="Advance Filter"><span class="advfilterspan"><span id="advfilter" style="cursor: pointer;">Advance Filter</span></span></a></div>
        <?php if(count($complaints)){ ?>
        <?php for($i=0; $i<count($complaints); $i++) { 
        $user=$this->users->get_user_byid($complaints[$i]['userid']) ;?>
        <div class="main_livepost">
          <div class="view_all"> <a href="<?php echo site_url('company').'/'.$complaints[$i]['companyseokeyword'].'/reviews/coupons/complaints';?>" title="view all"> <span>
            <h3>
              <?php $num=$this->complaints->get_complaint_bycompanyid($complaints[$i]['companyid']);?>
              <?php if(count($num)>0){?>
              <?php echo count($num);?>
              <?php }else{"0";}?>
            </h3>
            Related<br>
            Reports </span></a> <!--<span>--><a href="<?php echo site_url('company').'/'.$complaints[$i]['companyseokeyword'].'/reviews/coupons/complaints';?>" title="view all">View All</a><!--</span>--> </div>
          <div class="post_maincontent">
            <div class="side-image"> <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint detail"><img src="<?php if( $complaints[$i]['logo'] ){ echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path');?><?php echo stripslashes($complaints[$i]['logo']); } else{echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path')."/no_image.png"; } ?>" alt="<?php echo ucfirst(stripslashes($complaints[$i]['company'])); ?>" width="100px" height="40px"/></a> </div>
            <div class="post_content_title"><a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint detail"><?php echo ucfirst(stripslashes($complaints[$i]['company'])); ?></a></div>
            <div class="post_content_dscr user_view" style="margin-top:2px;width: -moz-available;"> <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint detail"><?php echo strtolower(substr(stripslashes($complaints[$i]['detail']),0,212)."..."); ?></a> </div>
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
            <div class="timing"> <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint detail">Date occurred: <span><?php echo date('m/d/Y',strtotime($dbdate));?></span> </a> <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint detail">Reported Damage: <span>$<?php echo $complaints[$i]['damagesinamt'];?></span> </a> <a href="<?php echo site_url('remove/complaint/'.$complaints[$i]['id'].'/'.$complaints[$i]['companyid']); ?>" title="Remove this complaint" style="background-color:#FFFFFF;">
              <input type="submit" name="submit" value="Remove" class="remove_btn" title="Remove this complaint" style="margin-top:-2px;"/>
              </a> </div>
            <div class="post_username">
              <?php if($complaints[$i]['userid']!=0){ ?>
              <?php if(count($user)>0) {?>
              <a href="<?php echo site_url('complaint/viewuser/'.$complaints[$i]['companyid'].'/'.$complaints[$i]['userid']); ?>" title="view profile"><?php echo $user[0]['username'];?></a>
              <?php } ?>
              <?php } else{ ?>
              <a href="" title="Anonymous">Anonymous</a>
              <?php } ?>
              <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint detail"><span><?php echo ($complaindate==$today)?'Posted: '.$diff:'Posted: '.date('m/d/Y',strtotime($complaints[$i]['complaindate'])); ?></span></a> </div>
          </div>
        </div>
        <?php } ?>
        <?php  if($this->pagination->create_links()) { ?>
        <tr style="background:#ffffff">
          <td></td>
          <td></td>
          <td></td>
          <td style="padding:10px"><div class="pagination"><?php echo $this->pagination->create_links(); ?></div></td>
        </tr>
        <tr>
          <?php } } else { ?>
          <div class="main_livepost">
            <div class="post_maincontent">
              <div class="form-message warning">
                <p>No complaints.</p>
              </div>
            </div>
          </div>
          <?php } ?>
      </div>
      <?php  ?>
     
    </div>
    <!-- /#content --> 
    
  </section>
</section>
<?php echo $footer; ?>