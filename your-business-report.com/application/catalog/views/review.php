<?php echo $header; ?>

<section class="content-wrap" style="margin-right:0">
  <section class="inner_main">
    <div class="main_contentarea"> <?php echo $menu; ?> 
    <?php if($topads){ ?>
       <div class="ad_up"><a href="<?php echo $topads[0]['url'];?>" title="" target="_blank"><img src="<?php if( $topads[0]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('ad_main_upload_path');?><?php echo stripslashes($topads[0]['image']); } ?>" alt="topads" width="940" height="180" class="adimg"/></a> </div>
     
		  <?php } ?>
    
      <script src='<?php echo site_url();?>js/star-rating/jquery.js' type="text/javascript"></script> 
      <script src='<?php echo site_url();?>js/star-rating/jquery.MetaData.js' type="text/javascript" language="javascript"></script> 
      <script src='<?php echo site_url();?>js/star-rating/jquery.rating.js' type="text/javascript" language="javascript"></script>
      <link href='<?php echo site_url();?>js/star-rating/jquery.rating.css' type="text/css" rel="stylesheet"/>
      <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js" type="text/javascript"></script>
      <?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'edit' ) ) { ?>
      <?php
			if( $this->session->flashdata('success') ) { ?>
      <!--  start message-green -->
      <div id="message-green">
        <table border="0" width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td class="green-left"><?php echo $this->session->flashdata('success'); ?></td>
            <td class="green-right"><a class="close-green"><img src="<?php echo base_url(); ?>images/messages/icon_close_green.gif" alt="Close"/></a></td>
          </tr>
        </table>
      </div>
      <!--  end message-green -->
      <?php }
        	if( $this->session->flashdata('error') ) { ?>
      <!--  start message-red -->
      <div id="message-red">
        <table border="0" width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td class="red-left"><?php echo $this->session->flashdata('error'); ?></td>
            <td class="red-right"><a class="close-red"><img src="<?php echo base_url(); ?>images/messages/icon_close_red.gif" alt="Close"/></a></td>
          </tr>
        </table>
      </div>
      <!--  end message-red -->
      <?php } 
		?>
      <script type="text/javascript" language="javascript">
          function trim(stringToTrim) {
              return stringToTrim.replace(/^\s+|\s+$/g,"");
          }
          $(document).ready(function() {
              
          <?php if( $this->uri->segment(2) == 'add' ) { ?>
              $("#btnsubmit").click(function () {
          <?php } ?>
          <?php if( $this->uri->segment(2) == 'edit' ) { ?>
              $("#btnupdate").click(function () {
          <?php } ?>
  
                 	if ($("input[name='test-4-rating-3']:checked").length == 0)
                  {
                      $("#rateerror").show();
                      return false;
                  }
                  else
                  {
                      $("#rateerror").hide();
                  }
									
									 if( trim($("#review").val()) == "" )
                  {
                      $("#reviewerror").show();
                      $("#review").val('').focus();
                      return false;
                  }
                  else
                  {
                      $("#reviewerror").hide();
                  }
									
											$("#form4").submit();
                   
              });
  
           });
      </script> 
      
      <!-- box -->
      <div class="dir_panel" style="width:980px; font-size:14px; color:#333333">
        <?php if($this->uri->segment(2) == 'add'){?>
        <div class="dir_title">Review : <?php echo $company[0]['company'];?></div>
        <?php } else {?>
        <div class="dir_title">Review : <?php echo $review[0]['company'];?></div>
        <?php } ?>
        <div id="tab-Testing"> 
          <script type="text/javascript" language="javascript">
          $(function(){  
           $('#form4 :radio.star').rating(); 
          });
          </script> 
          <script>
          $(function(){
           $('.star').rating({
              focus: function(value, link){
                var tip = $('#hover-test');
                tip[0].data = tip[0].data || tip.html();
                //tip.html('value: '+value);
              },
              blur: function(value, link){
                var tip = $('#hover-test');
                tip[0].data = tip[0].data;
                //tip.html(tip[0].data);
              }
           });
           $('.star').click(function (){
                var temp = $('input[name=test-4-rating-3]:checked', '#form4').attr('title');
                $('#hover-test').html(temp);
            });
          });
          </script> 
          <?php echo form_open('review/update',array('class'=>'formBox','id'=>'form4'));?>
          <table class="data_table" align="left" width="640">
            <tbody>
              <tr>
                <td class="lab"><label for="rating">How would you rate it?</label>
                  <span class="error-sign">*</span></td>
              </tr>
              <tr>
                <td></td>
              </tr>
              <tr>
                <td><?php if($this->uri->segment(2) == 'add') { ?>
                  <div class="Clear">
                    <input class="star required" type="radio" id="radt" name="test-4-rating-3" value="1" title="Terrible"/>
                    <input class="star" type="radio" id="radb" name="test-4-rating-3" value="2" title="Bad"/>
                    <input class="star" type="radio" id="rado" name="test-4-rating-3" value="3" title="Ok"/>
                    <input class="star" type="radio" id="radgd" name="test-4-rating-3" value="4" title="Good"/>
                    <input class="star" type="radio" id="radg" name="test-4-rating-3" value="5" title="Great!"/>
                  </div>
                  <span id="hover-test" style="margin:0 0 0 20px;"></span>
                  <input type="hidden" name="rating" id="rating"/>
                  <?php } ?>
                  <?php if($this->uri->segment(2) == 'edit') { ?>
                  <div class="Clear">
                    <?php if($review[0]['rate']=='1'){ ?>
                    <input class="star required" type="radio" id="radt" name="test-4-rating-3" value="1" title="Terrible" checked="checked"/>
                    <?php } else {?>
                    <input class="star required" type="radio" id="radt" name="test-4-rating-3" value="1" title="Terrible"/>
                    <?php } ?>
                    <?php if($review[0]['rate']=='2'){ ?>
                    <input class="star" type="radio" id="radb" name="test-4-rating-3" value="2" title="Bad" checked="checked"/>
                    <?php } else { ?>
                    <input class="star" type="radio" id="radb" name="test-4-rating-3" value="2" title="Bad"/>
                    <?php } ?>
                    <?php if($review[0]['rate']=='3'){ ?>
                    <input class="star" type="radio" id="rado" name="test-4-rating-3" value="3" title="Ok" checked="checked"/>
                    <?php } else { ?>
                    <input class="star" type="radio" id="rado" name="test-4-rating-3" value="3" title="Ok"/>
                    <?php } ?>
                    <?php if($review[0]['rate']=='4'){ ?>
                    <input class="star" type="radio" id="radgd" name="test-4-rating-3" value="4" title="Good" checked="checked"/>
                    <?php } else {?>
                    <input class="star" type="radio" id="radgd" name="test-4-rating-3" value="4" title="Good"/>
                    <?php } ?>
                    <?php if($review[0]['rate']=='5'){ ?>
                    <input class="star" type="radio" id="radg" name="test-4-rating-3" value="5" title="Great!" checked="checked"/>
                    <?php } else { ?>
                    <input class="star" type="radio" id="radg" name="test-4-rating-3" value="5" title="Great!"/>
                    <?php } ?>
                    <span id="hover-test" style="margin:0 0 0 20px;">
                    <?php if($review[0]['rate']=='1'){ ?>
                    <?php echo 'Terrible'; ?>
                    <?php } ?>
                    <?php if($review[0]['rate']=='2'){ ?>
                    <?php echo 'Bad'; ?>
                    <?php } ?>
                    <?php if($review[0]['rate']=='3'){ ?>
                    <?php echo 'Ok'; ?>
                    <?php } ?>
                    <?php if($review[0]['rate']=='4'){ ?>
                    <?php echo 'Good'; ?>
                    <?php } ?>
                    <?php if($review[0]['rate']=='5'){ ?>
                    <?php echo 'Great!'; ?>
                    <?php } ?>
                    </span>
                    <input type="hidden" name="rating" id="rating"/>
                  </div>
                  <?php } ?></td>
                <td></td>
              </tr>
              <tr>
                <td><div id="rateerror" class="error">Rating is required.</div></td>
              </tr>
              <tr>
                <td></td>
              </tr>
              <tr>
                <td class="lab" width="80px"><label for="review">Share your opinion</label>
                  <span class="error-sign">*
                  <div id="reviewerror" class="error">Review is required.</div>
                  </span></td>
              </tr>
              <tr>
                <td><?php if($this->uri->segment(2) == 'add') { ?>
                  <?php echo form_textarea( array( 'name'=>'review','id'=>'review','class'=>'box_txtbox','rows'=>'4','cols'=>'15','style'=>'height:200px;width:540px')); ?>
                  <?php } ?>
                  <?php if($this->uri->segment(2) == 'edit') { ?>
                  <?php echo form_textarea( array( 'name'=>'review','id'=>'review','class'=>'box_txtbox','type'=>'text','value'=>nl2br(stripslashes($review[0]['comment'])),'style'=>'height:200px;width:540px' ) ); ?>
                  <?php } ?></td>
              </tr>
              <tr>
                <td><!-- Submit form -->
                  
                  <?php if($this->uri->segment(2) == 'add') { ?>
                  <?php echo form_input(array('name'=>'btnsubmit','id'=>'btnsubmit','class'=>'dir-searchbtn','type'=>'submit','value'=>'Submit','style'=>'padding: 3px 16px;font-size:16px;text-shadow:none;float:right')); ?>
                  <?php } ?>
                  <?php if($this->uri->segment(2) == 'edit') { ?>
                  <?php echo form_input(array('name'=>'btnupdate','id'=>'btnupdate','class'=>'dir-searchbtn','type'=>'submit','value'=>'Update','style'=>'padding: 3px 16px;font-size:16px;text-shadow:none;float:right')); ?>
                  <?php } ?></td>
                <td></td>
              </tr>
            </tbody>
          </table>
          <?php if($this->uri->segment(2) == 'edit') { ?>
          <?php echo form_hidden( array( 'id' => $this->encrypt->encode($review[0]['id']) ) ); ?>
          <?php } ?>
          <?php echo form_hidden( array( 'companyid' => $this->encrypt->encode($companyid) ) ); ?> <?php echo form_close(); ?> </div>
        <!--// tab-Testing //--> 
      </div>
      <!-- /box-content -->
      <?php } else if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'companies' ) ){ ?>
      <?php
			if( $this->session->flashdata('success') ) { ?>
      <!--  start message-green -->
      <div id="message-green">
        <table border="0" width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td class="green-left"><?php echo $this->session->flashdata('success'); ?></td>
            <td class="green-right"><a class="close-green"><img src="<?php echo base_url(); ?>images/messages/icon_close_green.gif" alt="Close"/></a></td>
          </tr>
        </table>
      </div>
      <!--  end message-green -->
      <?php }
        	if( $this->session->flashdata('error') ) { ?>
      <!--  start message-red -->
      <div id="message-red">
        <table border="0" width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td class="red-left"><?php echo $this->session->flashdata('error'); ?></td>
            <td class="red-right"><a class="close-red"><img src="<?php echo base_url(); ?>images/messages/icon_close_red.gif" alt="Close"/></a></td>
          </tr>
        </table>
      </div>
      <!--  end message-red -->
      <?php } 
		?>
      <div class="dir_panel">
        <div class="dir_title">Business Review</div>
        <?php if( count($companies) > 0) { ?>
        <?php for($i=0; $i<count($companies); $i++) { ?>
        <div class="main_dir">
          <div class="dir_maincontent">
            <div class="dir-image"> <a href="<?php echo site_url('review/browse/'.$companies[$i]['id']); ?>" title="view <?php echo stripslashes($companies[$i]['company']); ?>'s detail"><img src="<?php if( $companies[$i]['logo'] ){ echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path');?><?php echo stripslashes($companies[$i]['logo']); } else{echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path')."/no_image.png"; } ?>" alt="<?php echo stripslashes($companies[$i]['logo']); ?>" width="100px" height="40px" /></a> </div>
            <div class="post-date" style="width:200px"><a style="color:#fff; padding: 3px 16px;font-size:16px; text-shadow:none" href="<?php echo site_url('review/add').'/'.$companies[$i]['id'];?>" title="Rate This Company" class="dir-searchbtn">rate it</a></div>
            <div class="dir_content_title"><a href="<?php echo site_url('review/browse/'.$companies[$i]['id']); ?>" title="view <?php echo stripslashes($companies[$i]['company']); ?>'s detail"><?php echo stripslashes($companies[$i]['company']); ?></a></div>
            <div class="dir_content_dscr" style="width:888px"> <a href="<?php echo site_url('review/browse/'.$companies[$i]['id']); ?>" title="view <?php echo stripslashes($companies[$i]['company']); ?>'s detail"><?php echo substr(stripslashes($companies[$i]['aboutus']),0,212)."..."; ?></a> </div>
          </div>
        </div>
        <?php } ?>
        <?php } ?>
        <?php  if($this->pagination->create_links()) { ?>
        <tr style="background:#ffffff">
          <td></td>
          <td></td>
          <td></td>
          <td style="padding:10px"><div class="pagination"><?php echo $this->pagination->create_links(); ?></div></td>
        </tr>
        <?php } ?>
      </div>
      <?php } else if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'browse' || $this->uri->segment(2) == 'editcomment') ) { ?>
      <?php if(count($elite)>0 && count($disreview)>0){ ?>
      <?php $user=$this->users->get_user_byid($disreview[0]['reviewby']); ?>
      <?php $company=$this->reviews->get_company_byid($disreview[0]['companyid']);?>
      <div class="dir_panel" style="width:980px; font-size:14px; color:#333333">
        <div style="font-size:18px; padding-bottom:30px"><span class="rev-company">
          <?php if(count($company)>0) { ?>
          <a href="<?php echo site_url('company/'.$company[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view <?php echo stripslashes($company[0]['company']);?>'s detail"> <?php echo ucfirst(stripslashes($company[0]['company']));?></a></span> reviewed by <span class="rev-user">
          <?php } ?>
          
		  <?php if(count($user)>0) { ?>
          <a href="<?php echo site_url('complaint/viewuser/'.$disreview[0]['companyid'].'/'.$disreview[0]['reviewby']);?>" title="view profile"> <?php echo stripslashes($user[0]['username']); ?></a>
          <?php } ?>
          
          </span> </div>
        <div style="margin-bottom:10px; margin-left:110px"><span><b>Review</b></span></div>
        <style>
		  	.job-table td{padding:10px;}
		  </style>
        <table width="980" border="0" cellspacing="0" cellpadding="0" class="job-table" style="border:none">
          <tr height="80">
            <td width="60px" valign="top"><?php if(count($user)>0) { ?>
              <a href="<?php echo site_url('complaint/viewuser/'.$disreview[0]['companyid'].'/'.$disreview[0]['reviewby']);?>" title="view profile">
              <div class="task-photo"> <img width="60px" src="<?php if( strlen($user[0]['avatarbig']) > 1 ){ echo $this->common->get_setting_value('2').$this->config->item('user_thumb_upload_path');?><?php echo stripslashes($user[0]['avatarbig']); } else { if($user[0]['gender']=='Male') { echo $this->common->get_setting_value('2')."images/male.png"; } 
		  	if($user[0]['gender']=='Female') { echo $this->common->get_setting_value('2')."images/female.png"; } 
		  } 
		   ?>" alt="<?php echo stripslashes($user[0]['username']); ?>"/> </div>
              </a>
              <div class="rev-company"><a href="<?php echo site_url('complaint/viewuser/'.$disreview[0]['companyid'].'/'.$disreview[0]['reviewby']);?>" title="view profile"><?php echo $user[0]['username'];?></a></div>
              <?php } ?>
              <?php
					    $reviewdate = date('m/d/Y',strtotime($disreview[0]['reviewdate']));
                        $today = date('m/d/Y'); 
					  	$date = date_default_timezone_set('Asia/Kolkata');
					    $d1 = strtotime(date('Y-m-d H:i:s'));
                        $d2 = strtotime($disreview[0]['reviewdate']);
                        $newdate =round(($d1-$d2)/60);
                        if($newdate > 60){$diff = round(($d1-$d2)/60/60).' hours ago';}else{$diff = $newdate.' mins ago';}
					  ?>
              <div class="rev-date" style="font-size:11px"> <?php echo ($reviewdate==$today)?$diff:date('m/d/Y',strtotime($disreview[0]['reviewdate'])); ?> </div></td>
            <td align="justify" valign="top" colspan="2" style="padding-bottom:20px;background:#f6f6f6" width="870px"><span>
              <div id="tab-Testing"> 
                <script type="text/javascript" language="javascript">
							$(function(){  
							 $('#form5 :radio.star').rating(); 
							});
						  </script>
                <div class="Clear">
                  <?php if($disreview[0]['rate']=='1'){ ?>
                  <input class="star required" type="radio" id="radt_<?php echo 0;?>" name="test-4-rating-<?php echo 0;?>" value="1" title="Terrible" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radb" name="test-4-rating-<?php echo 0;?>" value="2" title="Bad" disabled="disabled"/>
                  <input class="star" type="radio" id="rado" name="test-4-rating-<?php echo 0;?>" value="3" title="Ok" disabled="disabled"/>
                  <input class="star" type="radio" id="radgd" name="test-4-rating-<?php echo 0;?>" value="4" title="Good" disabled="disabled"/>
                  <input class="star" type="radio" id="radg" name="test-4-rating-<?php echo 0;?>" value="5" title="Great!" disabled="disabled"/>
                  <?php } ?>
                  <?php if($disreview[0]['rate']=='2'){ ?>
                  <input class="star required" type="radio" id="radt" name="test-4-rating-<?php echo 0;?>" value="1" title="Terrible" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radb" name="test-4-rating-<?php echo 0;?>" value="2" title="Bad" checked="checked"disabled="disabled"/>
                  <input class="star" type="radio" id="rado" name="test-4-rating-<?php echo 0;?>" value="3" title="Ok" disabled="disabled"/>
                  <input class="star" type="radio" id="radgd" name="test-4-rating-<?php echo 0;?>" value="4" title="Good" disabled="disabled"/>
                  <input class="star" type="radio" id="radg" name="test-4-rating-<?php echo 0;?>" value="5" title="Great!" disabled="disabled"/>
                  <?php } ?>
                  <?php if($disreview[0]['rate']=='3'){ ?>
                  <input class="star required" type="radio" id="radt" name="test-4-rating-<?php echo 0;?>" value="1" title="Terrible" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radb" name="test-4-rating-<?php echo 0;?>" value="2" title="Bad" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="rado" name="test-4-rating-<?php echo 0;?>" value="3" title="Ok" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radgd" name="test-4-rating-<?php echo 0;?>" value="4" title="Good" disabled="disabled"/>
                  <input class="star" type="radio" id="radg" name="test-4-rating-<?php echo 0;?>" value="5" title="Great!" disabled="disabled"/>
                  <?php } ?>
                  <?php if($disreview[0]['rate']=='4'){ ?>
                  <input class="star required" type="radio" id="radt" name="test-4-rating-<?php echo 0;?>" value="1" title="Terrible" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radb" name="test-4-rating-<?php echo 0;?>" value="2" title="Bad" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="rado" name="test-4-rating-<?php echo 0;?>" value="3" title="Ok" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radgd" name="test-4-rating-<?php echo 0;?>" value="4" title="Good" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radg" name="test-4-rating-<?php echo 0;?>" value="5" title="Great!" disabled="disabled"/>
                  <?php } ?>
                  <?php if($disreview[0]['rate']=='5'){ ?>
                  <input class="star required" type="radio" id="radt" name="test-4-rating-<?php echo 0;?>" value="1" title="Terrible" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radb" name="test-4-rating-<?php echo 0;?>" value="2" title="Bad" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="rado" name="test-4-rating-<?php echo 0;?>" value="3" title="Ok" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radgd" name="test-4-rating-<?php echo 0;?>" value="4" title="Good" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radg" name="test-4-rating-<?php echo 0;?>" value="5" title="Great!" checked="checked" disabled="disabled"/>
                  <?php } ?>
                  <span id="hover-test">
                  <?php if($disreview[0]['rate']=='1'){ ?>
                  <?php echo 'Terrible'; ?>
                  <?php } ?>
                  <?php if($disreview[0]['rate']=='2'){ ?>
                  <?php echo 'Bad'; ?>
                  <?php } ?>
                  <?php if($disreview[0]['rate']=='3'){ ?>
                  <?php echo 'Ok'; ?>
                  <?php } ?>
                  <?php if($disreview[0]['rate']=='4'){ ?>
                  <?php echo 'Good'; ?>
                  <?php } ?>
                  <?php if($disreview[0]['rate']=='5'){ ?>
                  <?php echo 'Great!'; ?>
                  <?php } ?>
                  </span>
                  <input type="hidden" name="rating" id="rating"/>
                </div>
              </div>
              </span><br />
              <span style="padding-bottom:10px"> <?php echo stripslashes($disreview[0]['comment']); ?> </span></td>
          </tr>
          <tr>
            <td></td>
            <td width="10px;" class="my"><a href="<?php echo site_url('review/accept/'.$disreview[0]['id']);?>" title="Accept this review" onclick="return confirm('Are you sure to accept this review?');"><?php echo form_input(array('name'=>'btnsubmit','id'=>'btnphone','class'=>'complaint_btn','type'=>'submit','value'=>'Accept','style'=>'padding:5px 20px;cursor: pointer;')); ?></a></td>
            <td class="my"><a href="<?php echo site_url('review/decline/'.$disreview[0]['id']);?>" title="Decline this review" onclick="return confirm('Are you sure to decline this review?');"><?php echo form_input(array('name'=>'btnsubmit','id'=>'btnphone','class'=>'complaint_btn','type'=>'submit','value'=>'Decline','style'=>'padding:5px 20px;cursor: pointer;')); ?></a></td>
          </tr>
            </tr>
          
        </table>
      </div>
      <?php } else {
				            if(count($review)>0) {
				  ?>
      <?php if( $this->session->flashdata('success') ) { ?>
      <!--  start message-green -->
      <div id="message-green">
        <table border="0" width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td class="green-left"><?php echo $this->session->flashdata('success'); ?></td>
            <td class="green-right"><a class="close-green"><img src="<?php echo base_url(); ?>images/messages/icon_close_green.gif" alt="Close"/></a></td>
          </tr>
        </table>
      </div>
      <!--  end message-green -->
      <?php }
        	 if( $this->session->flashdata('error') ) { ?>
      <!--  start message-red -->
      <div id="message-red">
        <table border="0" width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td class="red-left"><?php echo $this->session->flashdata('error'); ?></td>
            <td class="red-right"><a class="close-red"><img src="<?php echo base_url(); ?>images/messages/icon_close_red.gif" alt="Close"/></a></td>
          </tr>
        </table>
      </div>
      <!--  end message-red -->
      <?php } 	?>
      <div class="dir_panel" style="width:980px; font-size:14px; color:#333333"> 
        <script type="text/javascript" language="javascript">				  
		  function countme(rid,vote)
		  {
			  $.ajax({
				  type 				: "POST",
				  url 				: "<?php echo site_url('review/countme');?>",
				  dataType 		: "json",
				  data				: {reviewid:rid,vote : vote},
				  cache				: false,
				  success			: function(data)
									  {	
										$('#'+vote+rid).html(data.total);
									
									  }
			   });
		  }
		  function check(ip,rid,vote)
		  {
			  
			  $.ajax({
				  type 				: "POST",
				  url 				: "<?php echo site_url('review/checkvote');?>",
				  dataType 		: "json",
				  data				: { ip:ip,reviewid:rid,vote : vote},
				  cache				: false,
				  success			: function(data)
									  {	
										if(data.message == 'deleted')
										{
										   $('#'+vote+'a'+'_'+rid).removeClass('vote-disable');
										   $('#'+vote+'a'+'_'+rid).addClass('vote');
										}
										if(data.message == 'added')
										{
										   $('#'+vote+'a'+'_'+rid).removeClass('vote');
										   $('#'+vote+'a'+'_'+rid).addClass('vote-disable');										   										  
										}
										countme(rid,vote);
									  }
				  
									  
			   });
			  
		  }

		  </script>
        <?php $company=$this->reviews->get_company_byid($review[0]['companyid']);?>
        <div style="font-size:18px; padding-bottom:30px"><span class="rev-company"> <a href="<?php echo site_url('company/'.$company[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view <?php echo stripslashes($review[0]['company']);?>'s detail"><?php echo ucfirst(stripslashes($review[0]['company']));?></a></span> reviewed by <span class="rev-user"> 
        <?php if($review[0]['type']=='csv') {?>
        
        <a> <?php echo stripslashes($review[0]['reviewby']); ?></a>
        <?php } else { ?>  <a href="<?php echo site_url('complaint/viewuser/'.$review[0]['companyid'].'/'.$review[0]['reviewby']);?>" title="view profile"> <?php echo stripslashes($review[0]['username']); ?></a><?php } ?>
        </span>
          <div class="my" style="float:right;padding-bottom:-10px;"> <a href="<?php echo site_url('welcome');?>" title="submit a complaint"><?php echo form_input(array('name'=>'submitacomplaint','id'=>'submitacomplaint','class'=>'complaint_btn','type'=>'button','value'=>'Submit a complaint','style'=>'padding:7px 25px;cursor: pointer;')); ?></a> </div>
        </div>
        <div style="margin-bottom:10px; margin-left:110px"><span><b>Review</b></span></div>
        <style>
		  	.job-table td{padding:10px;}
		  </style>
        <table width="980" border="0" cellspacing="0" cellpadding="0" class="job-table" style="border:none">
          <tr height="80">
            <td width="60px" valign="top"><a href="<?php echo site_url('complaint/viewuser/'.$review[0]['companyid'].'/'.$review[0]['reviewby']);?>" title="view profile">
              <div class="task-photo"> <img width="60px" src="<?php if( strlen($review[0]['avatarbig']) > 1 ){ echo $this->common->get_setting_value('2').$this->config->item('user_thumb_upload_path');?><?php echo stripslashes($review[0]['avatarbig']); } else { if($review[0]['gender']=='Male') { echo $this->common->get_setting_value('2')."images/male.png"; } 
		  	if($review[0]['gender']=='Female') { echo $this->common->get_setting_value('2')."images/female.png"; } 
		  } 
		   ?>" alt="<?php echo stripslashes($review[0]['username']); ?>"/> </div>
              </a>
              <div class="rev-company"><a href="<?php echo site_url('complaint/viewuser/'.$review[0]['companyid'].'/'.$review[0]['reviewby']);?>" title="view profile"><?php echo $review[0]['username'];?></a></div>
              <?php
					    $reviewdate = date('m/d/Y',strtotime($review[0]['reviewdate']));
                        $today = date('m/d/Y'); 
					  	$date = date_default_timezone_set('Asia/Kolkata');
					    $d1 = strtotime(date('Y-m-d H:i:s'));
                        $d2 = strtotime($review[0]['reviewdate']);
                        $newdate =round(($d1-$d2)/60);
                        if($newdate > 60){$diff = round(($d1-$d2)/60/60).' hours ago';}else{$diff = $newdate.' mins ago';}
					  ?>
              <div class="rev-date" style="font-size:11px"> <?php echo ($reviewdate==$today)?$diff:date('m/d/Y',strtotime($review[0]['reviewdate'])); ?> </div></td>
            <td align="justify" valign="top" colspan="2" style="padding-bottom:20px;background:#f6f6f6" width="870px"><span>
              <div id="tab-Testing"> 
                <script type="text/javascript" language="javascript">
							$(function(){  
							 $('#form5 :radio.star').rating(); 
							});
						  </script> 
                <script>
					<?php $ip = $_SERVER['REMOTE_ADDR'];  ?>
					
					$(function(){ 
					 $("#helpfula_<?php echo $review[0]['id'];?>").click(function() {
						 var vote = 'helpful';
						 var reviewid = $(this).attr('reviewid');
						 check('<?php echo $ip;?>',reviewid,vote);
					   });
					   $("#funnya_<?php echo $review[0]['id'];?>").click(function() {
						 var vote = 'funny';
						 var reviewid = $(this).attr('reviewid');
						 check('<?php echo $ip;?>',reviewid,vote);
					   });
					   $("#agreea_<?php echo $review[0]['id'];?>").click(function() {
						 var vote = 'agree';
						 var reviewid = $(this).attr('reviewid');
						 check('<?php echo $ip;?>',reviewid,vote);
						 countme(reviewid,'disagree');
						 $('#disagreea_'+reviewid).removeClass('vote-disable');
						 $('#disagreea_'+reviewid).addClass('vote'); 
					   });
					   $("#disagreea_<?php echo $review[0]['id'];?>").click(function() {
						 var vote = 'disagree';
						 var reviewid = $(this).attr('reviewid');
						 check('<?php echo $ip;?>',reviewid,vote);
						 countme(reviewid,'agree');
						 $('#agreea_'+reviewid).removeClass('vote-disable');
						 $('#agreea_'+reviewid).addClass('vote'); 
					   });
					});
				</script>
                <div class="Clear">
                  <?php if($review[0]['rate']=='1'){ ?>
                  <input class="star required" type="radio" id="radt_<?php echo 0;?>" name="test-4-rating-<?php echo 0;?>" value="1" title="Terrible" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radb" name="test-4-rating-<?php echo 0;?>" value="2" title="Bad" disabled="disabled"/>
                  <input class="star" type="radio" id="rado" name="test-4-rating-<?php echo 0;?>" value="3" title="Ok" disabled="disabled"/>
                  <input class="star" type="radio" id="radgd" name="test-4-rating-<?php echo 0;?>" value="4" title="Good" disabled="disabled"/>
                  <input class="star" type="radio" id="radg" name="test-4-rating-<?php echo 0;?>" value="5" title="Great!" disabled="disabled"/>
                  <?php } ?>
                  <?php if($review[0]['rate']=='2'){ ?>
                  <input class="star required" type="radio" id="radt" name="test-4-rating-<?php echo 0;?>" value="1" title="Terrible" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radb" name="test-4-rating-<?php echo 0;?>" value="2" title="Bad" checked="checked"disabled="disabled"/>
                  <input class="star" type="radio" id="rado" name="test-4-rating-<?php echo 0;?>" value="3" title="Ok" disabled="disabled"/>
                  <input class="star" type="radio" id="radgd" name="test-4-rating-<?php echo 0;?>" value="4" title="Good" disabled="disabled"/>
                  <input class="star" type="radio" id="radg" name="test-4-rating-<?php echo 0;?>" value="5" title="Great!" disabled="disabled"/>
                  <?php } ?>
                  <?php if($review[0]['rate']=='3'){ ?>
                  <input class="star required" type="radio" id="radt" name="test-4-rating-<?php echo 0;?>" value="1" title="Terrible" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radb" name="test-4-rating-<?php echo 0;?>" value="2" title="Bad" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="rado" name="test-4-rating-<?php echo 0;?>" value="3" title="Ok" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radgd" name="test-4-rating-<?php echo 0;?>" value="4" title="Good" disabled="disabled"/>
                  <input class="star" type="radio" id="radg" name="test-4-rating-<?php echo 0;?>" value="5" title="Great!" disabled="disabled"/>
                  <?php } ?>
                  <?php if($review[0]['rate']=='4'){ ?>
                  <input class="star required" type="radio" id="radt" name="test-4-rating-<?php echo 0;?>" value="1" title="Terrible" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radb" name="test-4-rating-<?php echo 0;?>" value="2" title="Bad" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="rado" name="test-4-rating-<?php echo 0;?>" value="3" title="Ok" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radgd" name="test-4-rating-<?php echo 0;?>" value="4" title="Good" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radg" name="test-4-rating-<?php echo 0;?>" value="5" title="Great!" disabled="disabled"/>
                  <?php } ?>
                  <?php if($review[0]['rate']=='5'){ ?>
                  <input class="star required" type="radio" id="radt" name="test-4-rating-<?php echo 0;?>" value="1" title="Terrible" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radb" name="test-4-rating-<?php echo 0;?>" value="2" title="Bad" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="rado" name="test-4-rating-<?php echo 0;?>" value="3" title="Ok" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radgd" name="test-4-rating-<?php echo 0;?>" value="4" title="Good" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radg" name="test-4-rating-<?php echo 0;?>" value="5" title="Great!" checked="checked" disabled="disabled"/>
                  <?php } ?>
                  <span id="hover-test">
                  <?php if($review[0]['rate']=='1'){ ?>
                  <?php echo 'Terrible'; ?>
                  <?php } ?>
                  <?php if($review[0]['rate']=='2'){ ?>
                  <?php echo 'Bad'; ?>
                  <?php } ?>
                  <?php if($review[0]['rate']=='3'){ ?>
                  <?php echo 'Ok'; ?>
                  <?php } ?>
                  <?php if($review[0]['rate']=='4'){ ?>
                  <?php echo 'Good'; ?>
                  <?php } ?>
                  <?php if($review[0]['rate']=='5'){ ?>
                  <?php echo 'Great!'; ?>
                  <?php } ?>
                  </span>
                  <input type="hidden" name="rating" id="rating"/>
                </div>
              </div>
              </span><br />
              <span style="padding-bottom:10px"> <?php echo stripslashes($review[0]['comment']); ?> </span></td>
            <td width="30px"></td>
          </tr>
          <tr>
            <td></td>
            <td colspan="2" style="color:#333333; padding-bottom:10px; padding-top:10px">Add your vote:
              <?php $ip = $_SERVER['REMOTE_ADDR'];
					if($this->reviews->check_vote($ip,$review[0]['id'],'helpful') == 'true'){?>
              <a class="vote-disable" id="helpfula_<?php echo $review[0]['id'];?>" reviewid="<?php echo $review[0]['id'];?>">Helpful</a>
              <?php } else {?>
              <a class="vote" id="helpfula_<?php echo $review[0]['id'];?>" reviewid="<?php echo $review[0]['id'];?>">Helpful</a>
              <?php } ?>
              <?php if($this->reviews->check_vote($ip,$review[0]['id'],'funny') == 'true'){?>
              <a id="funnya_<?php echo $review[0]['id'];?>" class="vote-disable" title="funny" reviewid="<?php echo $review[0]['id'];?>">Funny</a>
              <?php } else {?>
              <a id="funnya_<?php echo $review[0]['id'];?>" class="vote" title="funny" reviewid="<?php echo $review[0]['id'];?>">Funny</a>
              <?php } ?>
              <?php if($this->reviews->check_vote($ip,$review[0]['id'],'agree') == 'true'){?>
              <a id="agreea_<?php echo $review[0]['id'];?>" class="vote-disable" reviewid="<?php echo $review[0]['id'];?>">Agree</a>
              <?php } else {?>
              <a id="agreea_<?php echo $review[0]['id'];?>" class="vote" reviewid="<?php echo $review[0]['id'];?>">Agree</a>
              <?php } ?>
              <?php if($this->reviews->check_vote($ip,$review[0]['id'],'disagree') == 'true'){?>
              <a id="disagreea_<?php echo $review[0]['id'];?>" class="vote-disable" title="disagree" reviewid="<?php echo $review[0]['id'];?>">Disagree</a>
              <?php } else {?>
              <a id="disagreea_<?php echo $review[0]['id'];?>" class="vote" title="disagree" reviewid="<?php echo $review[0]['id'];?>">Disagree</a>
              <?php } ?></td>
          </tr>
          <tr height="30px">
            <td></td>
            <td colspan="2" style="background:#E8E8E8">Votes on this review: <b><span id="helpful<?php echo $review[0]['id'];?>"><?php echo $this->reviews->getcount($review[0]['id'],'helpful');?></span> Helpful / <span id="funny<?php echo $review[0]['id'];?>"><?php echo $this->reviews->getcount($review[0]['id'],'funny');?></span> Funny / <span id="agree<?php echo $review[0]['id'];?>"><?php echo $this->reviews->getcount($review[0]['id'],'agree');?></span> Agree / <span id="disagree<?php echo $review[0]['id'];?>"><?php echo $this->reviews->getcount($review[0]['id'],'disagree');?></span> Disagree</span></b>
            <td></td>
          </tr>
          <tr>
            <td></td>
            <?php if(count($comments)>0) { ?>
            <td colspan="2" style="background:#f6f6f6;">Showing <?php echo count($comments);?> comments</td>
            <?php } ?>
            <td></td>
          </tr>
          <tr>
            <td></td>
            <td colspan="2" valign="top" style="background:#f6f6f6"><?php if(count($comments)>0){ ?>
              <?php for($i=0; $i<count($comments); $i++) {?>
              <?php $user=$this->users->get_user_byid($comments[$i]['commentby']);?>
              <div class="task-photo" style="width:40px; float:left; margin-right:20px"> <img width="60px" src="<?php if( strlen($user[0]['avatarbig']) > 1 ){ echo $this->common->get_setting_value('2').$this->config->item('user_thumb_upload_path');?><?php echo stripslashes($user[0]['avatarbig']); } else { if($user[0]['gender']=='Male') { echo $this->common->get_setting_value('2')."images/male.png"; } 
		  	if($user[0]['gender']=='Female') { echo $this->common->get_setting_value('2')."images/female.png"; } 
		  } 
		   ?>" alt="<?php echo stripslashes($user[0]['username']); ?>"/> </div>
              <div>
                <div> <span class="rev-user user_view"> <a href="<?php echo site_url('complaint/viewuser/'.$review[0]['companyid'].'/'.$user[0]['id']);?>" title="view profile"> <?php echo $user[0]['username'];?></a></span>
                  <?php //echo "<pre>"; ?>
                  <?php //print_r($this->session->userdata) ;?>
                  <?php //die();?>
                  <?php if( array_key_exists('youg_user',$this->session->userdata) ) { ?>
                  <?php if(($comments[$i]['commentby']==$this->session->userdata['youg_user']['userid'])) { ?>
                  <span class="rev-user user_view" style="float:right"><a href="<?php echo site_url('review/deletecomment/'.$comments[$i]['id']);?>" onclick="return confirm('Are you sure to delete this comment?');" title="Delete">Delete</a></span> <span style="float:right">&nbsp;or&nbsp;</span> <span class="rev-user user_view" style="float:right"><a href="<?php echo site_url('review/editcomment/'.$comments[$i]['id']);?>" title="Edit">edit</a></span>
                  <?php } } ?>
                  <?php
					$date1 = date('Y-m-d h:i:s',strtotime($comments[$i]['commentdate'])); 
					$date2 = date('Y-m-d h:i:s');
					$diff = abs(strtotime($date2) - strtotime($date1)); 
					
					$years   = floor($diff / (365*60*60*24));
					$months  = floor($diff / (30*60*60*24));
					$days    = floor($diff/ (60*60*24));
					$hours   = floor($diff / (60*60));
					$minutes  = floor($diff/ 60);
					$seconds = floor($diff);
					//printf("%d years, %d months, %d days, %d hours, %d minuts\n, %d seconds\n", $years, $months, $days, $hours, $minuts, $seconds); 
					//die();
					if($seconds<=60){ $commenttime=$seconds.' seconds '; }
					elseif($minutes<=60){ $commenttime=$minutes.' minutes '; }
					elseif($hours<=24){ $commenttime=$hours.' hours '; }
					elseif($days<=30){ 
						if($days==1)
						{
						$commenttime=$days.' day ';
						}else{
					$commenttime=$days.' days ';
						}
					 }
					elseif($months<=12){ $commenttime=$months.' months '; }
					else { $commenttime=$years.' years '; }
					?>
                  <br/>
                  <span title="<?php echo date('d M, Y',strtotime($comments[$i]['commentdate']));?>">commented : <i><?php echo $commenttime; ?>&nbsp;ago</i></span> </div>
                <div class="clear"></div>
                <div class="comcontent"> <?php echo nl2br(stripslashes($comments[$i]['comment'])); ?> </div>
              </div>
              <div class="blankdiv"></div>
              <?php } ?>
              <?php } 
							else {?>
              <?php echo "No Comments";?>
              <?php } 
							if($this->pagination->create_links()) { ?>
              <div align="center">
                <div class="pagination"><?php echo $this->pagination->create_links(); ?></div>
              </div>
              <?php } 
							?>
              <script type="text/javascript" language="javascript">
              function trim(stringToTrim) {
                  return stringToTrim.replace(/^\s+|\s+$/g,"");
              }
              $(document).ready(function() {
                  
              <?php if( $this->uri->segment(2) == 'browse' ) { ?>
                  $("#btncommentsubmit").click(function () {
              <?php } ?>
              <?php if( $this->uri->segment(2) == 'editcomment' ) { ?>
                  $("#btncommentupdate").click(function () {
              <?php } ?>
              
					  
					  if( trim($("#comment").val()) == "" )
					  {
						  $("#commenterror").show();
						  $("#comment").val('').focus();
						  return false;
					  }
					  else
					  {
						   $("#commenterror").hide();
						}
					  
					    $("#frmcomment").submit();
                          
                  });
              
              });
          </script></td>
          </tr>
          <?php if($this->session->userdata('youg_user')){ ?>
          <tr>
            <td></td>
            <td colspan="2" class="lab" width="80px" style="background:#f6f6f6; padding-bottom:0"><label for="review">
                <?php if($this->uri->segment(2) == 'browse') { ?>
                Add Your Comment
                <?php } ?>
                <?php if($this->uri->segment(2) == 'editcomment') { ?>
                Edit Your Comment
                <?php } ?>
              </label>
              <span class="error-sign">*</span>
              <div id="commenterror" class="error">Comment is required.</div></td>
          </tr>
          <tr>
            <td></td>
            <td colspan="2" style="background:#f6f6f6"><?php echo form_open('review/upcomment',array('class'=>'formBox','id'=>'frmcomment'));?>
              <?php if($this->uri->segment(2) == 'browse') { ?>
              <?php echo form_textarea( array( 'name'=>'comment','id'=>'comment','class'=>'box_txtbox','rows'=>'4','cols'=>'15','style'=>'height:250px;width:640px')); ?>
              <?php } ?>
              <?php if($this->uri->segment(2) == 'editcomment') { ?>
              <?php echo form_textarea( array( 'name'=>'comment','id'=>'comment','class'=>'box_txtbox','type'=>'text','value'=>nl2br(stripslashes($commentbyid[0]['comment'])),'style'=>'height:250px;width:640px' ) ); ?>
              <?php } ?></td>
          </tr>
          <tr>
            <td></td>
            <td colspan="2" style="background:#f6f6f6"><div style="width:653px;"> 
                
                <!-- Submit form -->
                <?php if($this->uri->segment(2) == 'browse') { ?>
                <?php echo form_input(array('name'=>'btncommentsubmit','id'=>'btncommentsubmit','class'=>'dir-searchbtn','type'=>'submit','value'=>'Post Comment','style'=>'padding: 3px 16px;font-size:16px;text-shadow:none;float:right')); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'editcomment') { ?>
                <?php echo form_input(array('name'=>'btncommentupdate','id'=>'btncommentupdate','class'=>'dir-searchbtn','type'=>'submit','value'=>'Update','style'=>'padding: 3px 16px;font-size:16px;text-shadow:none;float:right')); ?>
                <?php } ?>
              </div></td>
            <td width="30px"></td>
          </tr>
          <?php  } else
					{ ?>
          <tr>
            <td></td>
            <td colspan="2" style="background:#f6f6f6" class="user_view"> Please <a title="login" href="<?php echo site_url('login');?>"><span style="text-decoration:underline;">login</span></a> to add a comment...</td>
          </tr>
          <?php } ?>
        </table>
        <?php if($this->uri->segment(2) == 'editcomment') { ?>
        <?php echo form_hidden( array( 'id' => $this->encrypt->encode($commentbyid[0]['id']) ) ); ?>
        <?php } ?>
        <?php echo form_hidden( array( 'reviewid' => $this->encrypt->encode($reviewid) ) ); ?> <?php echo form_close(); ?> </div>
      <?php 
       
							}  }
							}
							
							 else { ?>
      <?php if( $this->session->flashdata('success') ) { ?>
      <!--  start message-green -->
      <div id="message-green">
        <table border="0" width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td class="green-left"><?php echo $this->session->flashdata('success'); ?></td>
            <td class="green-right"><a class="close-green"><img src="<?php echo base_url(); ?>images/messages/icon_close_green.gif" alt="Close"/></a></td>
          </tr>
        </table>
      </div>
      <!--  end message-green -->
      <?php } ?>
      <?php 	 if( $this->session->flashdata('error') ) { ?>
      <!--  start message-red -->
      <div id="message-red">
        <table border="0" width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td class="red-left"><?php echo $this->session->flashdata('error'); ?></td>
            <td class="red-right"><a class="close-red"><img src="<?php echo base_url(); ?>images/messages/icon_close_red.gif" alt="Close"/></a></td>
          </tr>
        </table>
      </div>
      <!--  end message-red -->
      <?php } 	?>
      <?php echo form_open('review/update',array('class'=>'formBox','id'=>'form5'));?>
      <div class="dir_panel"> 
        <script type="text/javascript" language="javascript">				  
		  function countme(rid,vote)
		  {
			  $.ajax({
				  type 				: "POST",
				  url 				: "<?php echo site_url('review/countme');?>",
				  dataType 		: "json",
				  data				: {reviewid:rid,vote : vote},
				  cache				: false,
				  success			: function(data)
									  {	
										$('#'+vote+rid).html(data.total);
									
									  }
			   });
		  }
		  function check(ip,rid,vote)
		  {
			  
			  $.ajax({
				  type 				: "POST",
				  url 				: "<?php echo site_url('review/checkvote');?>",
				  dataType 		: "json",
				  data				: { ip:ip,reviewid:rid,vote : vote},
				  cache				: false,
				  success			: function(data)
									  {	
										if(data.message == 'deleted')
										{
										   $('#'+vote+'_'+rid).removeClass('vote-disable');
										   $('#'+vote+'_'+rid).addClass('vote');
										}
										if(data.message == 'added')
										{
										   $('#'+vote+'_'+rid).removeClass('vote');
										   $('#'+vote+'_'+rid).addClass('vote-disable');										   										  
										}
										countme(rid,vote);
									  }
				  

			   });
			  
		  }

		  </script>
        <div class="dir_title" style="width:auto;padding-bottom:15px;">Business Review
          <div class="my" style="float:right;padding-bottom:-10px;"> <a href="<?php echo site_url('welcome');?>" title="submit a complaint"><?php echo form_input(array('name'=>'submitacomplaint','id'=>'submitacomplaint','class'=>'complaint_btn','type'=>'button','value'=>'Submit a complaint','style'=>'padding:7px 25px;cursor: pointer;')); ?></a> </div>
        </div>
        <div class="vote-box"> <span>Votes Since Yesterday: <?php echo $this->reviews->get_yest_count('helpful');?> Helpful / <?php echo $this->reviews->get_yest_count('funny');?> Funny / <?php echo $this->reviews->get_yest_count('agree');?> Agree / <?php echo $this->reviews->get_yest_count('disagree');?> Disagree</span> </div>
        <?php if(count($reviews)>0)
				 { 
				 //echo "<pre>";
				//print_r($reviews);
				//die();
				 ?>
        <?php for($i=0; $i<count($reviews); $i++) {?>
        
        <?php $company=$this->reviews->get_company_byid($reviews[$i]['companyid']);?>
        <script>
					<?php $ip = $_SERVER['REMOTE_ADDR'];  ?>
					
					$(function(){ 
					 $("#helpful_<?php echo $reviews[$i]['id'];?>").click(function() {
						 var vote = 'helpful';
						 var reviewid = $(this).attr('reviewid');
						 check('<?php echo $ip;?>',reviewid,vote);
					   });
					   $("#funny_<?php echo $reviews[$i]['id'];?>").click(function() {
						 var vote = 'funny';
						 var reviewid = $(this).attr('reviewid');
						 check('<?php echo $ip;?>',reviewid,vote);
					   });
					   $("#agree_<?php echo $reviews[$i]['id'];?>").click(function() {
						 var vote = 'agree';
						 var reviewid = $(this).attr('reviewid');
						 check('<?php echo $ip;?>',reviewid,vote);
						 countme(reviewid,'disagree');
						 $('#disagree_'+reviewid).removeClass('vote-disable');
						 $('#disagree_'+reviewid).addClass('vote'); 
					   });
					   $("#disagree_<?php echo $reviews[$i]['id'];?>").click(function() {
						 var vote = 'disagree';
						 var reviewid = $(this).attr('reviewid');
						 check('<?php echo $ip;?>',reviewid,vote);
						 countme(reviewid,'agree');
						 $('#agree_'+reviewid).removeClass('vote-disable');
						 $('#agree_'+reviewid).addClass('vote'); 
					   });
					});
				</script>
        <table width="980" border="0" cellspacing="0" cellpadding="0" class="job-table" style="border:none">
          <tr height="80">
            <td width="85px" valign="top"><a href="<?php echo site_url('complaint/viewuser/'.$reviews[$i]['companyid'].'/'.$reviews[$i]['reviewby']);?>" title="view profile">
              <?php if( $reviews[$i]['type']=='csv' )
               {?><div class="">  </div>
              <?php
               
			   }
              else
			  {
			  ?>
              <div class="task-photo"> <img width="60px" src="<?php if( strlen($reviews[$i]['avatarbig']) > 1 ){ echo $this->common->get_setting_value('2').$this->config->item('user_thumb_upload_path');?><?php echo stripslashes($reviews[$i]['avatarbig']); } else { if($reviews[$i]['gender']=='Male') { echo $this->common->get_setting_value('2')."images/male.png"; } 
		  	if($reviews[$i]['gender']=='Female') { echo $this->common->get_setting_value('2')."images/female.png"; } 
		  } 
		   ?>" alt="<?php echo stripslashes($reviews[0]['username']); ?>"/> </div>
              <?php }
			  
			  ?>
              </a>
              <?php
					    $reviewdate = date('m/d/Y',strtotime($reviews[$i]['reviewdate']));
                        $today = date('m/d/Y'); 
					  	$date = date_default_timezone_set('Asia/Kolkata');
					    $d1 = strtotime(date('Y-m-d H:i:s'));
                        $d2 = strtotime($reviews[$i]['reviewdate']);
                        $newdate =round(($d1-$d2)/60);
                        if($newdate > 60){$diff = round(($d1-$d2)/60/60).' hours ago';}else{
													if($newdate<2){$diff='Just now';}else{
													$diff = $newdate.' minutes ago'; }
													}
					  ?>
              <div class="rev-date"> <?php echo ($reviewdate==$today)?$diff:date('m/d/Y',strtotime($reviews[$i]['reviewdate'])); ?> </div></td>
            <td width="600" align="justify" valign="top" colspan="2" style="padding-bottom:5px"><span class="rev-user"> 
            <?php if($reviews[$i]['type']=='csv') { ?>
            <a><?php echo stripslashes($reviews[$i]['reviewby']); ?></a>
            <?php } else {?>
            <a href="<?php echo site_url('complaint/viewuser/'.$reviews[$i]['companyid'].'/'.$reviews[$i]['reviewby']);?>" title="view profile"> <?php echo stripslashes($reviews[$i]['username']); ?></a>
			<?php } ?>
            
            </span> reviewed <span class="rev-company"><a href="<?php echo site_url('company/'.$company[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view <?php echo stripslashes($reviews[$i]['company']);?>'s detail"><?php echo ucfirst(stripslashes($reviews[$i]['company']));?></a></span><br>
              <br>
              <span>
              <div id="tab-Testing"> 
                <script type="text/javascript" language="javascript">
							$(function(){  
							 $('#form5 :radio.star').rating(); 
							});
						  </script>
                <div class="Clear">
                  <?php if($reviews[$i]['rate']=='1'){ ?>
                  <input class="star required" type="radio" id="radt_<?php echo $i;?>" name="test-4-rating-<?php echo $i;?>" value="1" title="Terrible" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radb" name="test-4-rating-<?php echo $i;?>" value="2" title="Bad" disabled="disabled"/>
                  <input class="star" type="radio" id="rado" name="test-4-rating-<?php echo $i;?>" value="3" title="Ok" disabled="disabled"/>
                  <input class="star" type="radio" id="radgd" name="test-4-rating-<?php echo $i;?>" value="4" title="Good" disabled="disabled"/>
                  <input class="star" type="radio" id="radg" name="test-4-rating-<?php echo $i;?>" value="5" title="Great!" disabled="disabled"/>
                  <?php } ?>
                  <?php if($reviews[$i]['rate']=='2'){ ?>
                  <input class="star required" type="radio" id="radt" name="test-4-rating-<?php echo $i;?>" value="1" title="Terrible" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radb" name="test-4-rating-<?php echo $i;?>" value="2" title="Bad" checked="checked"disabled="disabled"/>
                  <input class="star" type="radio" id="rado" name="test-4-rating-<?php echo $i;?>" value="3" title="Ok" disabled="disabled"/>
                  <input class="star" type="radio" id="radgd" name="test-4-rating-<?php echo $i;?>" value="4" title="Good" disabled="disabled"/>
                  <input class="star" type="radio" id="radg" name="test-4-rating-<?php echo $i;?>" value="5" title="Great!" disabled="disabled"/>
                  <?php } ?>
                  <?php if($reviews[$i]['rate']=='3'){ ?>
                  <input class="star required" type="radio" id="radt" name="test-4-rating-<?php echo $i;?>" value="1" title="Terrible" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radb" name="test-4-rating-<?php echo $i;?>" value="2" title="Bad" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="rado" name="test-4-rating-<?php echo $i;?>" value="3" title="Ok" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radgd" name="test-4-rating-<?php echo $i;?>" value="4" title="Good" disabled="disabled"/>
                  <input class="star" type="radio" id="radg" name="test-4-rating-<?php echo $i;?>" value="5" title="Great!" disabled="disabled"/>
                  <?php } ?>
                  <?php if($reviews[$i]['rate']=='4'){ ?>
                  <input class="star required" type="radio" id="radt" name="test-4-rating-<?php echo $i;?>" value="1" title="Terrible" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radb" name="test-4-rating-<?php echo $i;?>" value="2" title="Bad" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="rado" name="test-4-rating-<?php echo $i;?>" value="3" title="Ok" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radgd" name="test-4-rating-<?php echo $i;?>" value="4" title="Good" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radg" name="test-4-rating-<?php echo $i;?>" value="5" title="Great!" disabled="disabled"/>
                  <?php } ?>
                  <?php if($reviews[$i]['rate']=='5'){ ?>
                  <input class="star required" type="radio" id="radt" name="test-4-rating-<?php echo $i;?>" value="1" title="Terrible" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radb" name="test-4-rating-<?php echo $i;?>" value="2" title="Bad" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="rado" name="test-4-rating-<?php echo $i;?>" value="3" title="Ok" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radgd" name="test-4-rating-<?php echo $i;?>" value="4" title="Good" checked="checked" disabled="disabled"/>
                  <input class="star" type="radio" id="radg" name="test-4-rating-<?php echo $i;?>" value="5" title="Great!" checked="checked" disabled="disabled"/>
                  <?php } ?>
                  <div style="margin-top:5px;"> <span id="hover-test">
                    <?php if($reviews[$i]['rate']=='1'){ ?>
                    <?php echo 'Terrible'; ?>
                    <?php } ?>
                    <?php if($reviews[$i]['rate']=='2'){ ?>
                    <?php echo 'Bad'; ?>
                    <?php } ?>
                    <?php if($reviews[$i]['rate']=='3'){ ?>
                    <?php echo 'Ok'; ?>
                    <?php } ?>
                    <?php if($reviews[$i]['rate']=='4'){ ?>
                    <?php echo 'Good'; ?>
                    <?php } ?>
                    <?php if($reviews[$i]['rate']=='5'){ ?>
                    <?php echo 'Great!'; ?>
                    <?php } ?>
                    </span> </div>
                  <input type="hidden" name="rating" id="rating"/>
                </div>
              </div>
              </span><br />
              <span style="padding-bottom:10px"> <?php echo nl2br(stripslashes($reviews[$i]['comment'])); ?> </span></td>
            <td class="post-date" style="width:150px;"><?php if($this->session->userdata('youg_user')){$userid = $this->session->userdata['youg_user']['userid']; ?>
              <?php if($reviews[$i]['reviewby'] == $userid) {?>
              <a style="color:#fff; padding: 3px 16px;font-size:16px;text-shadow:none;" href="<?php echo site_url('review/edit').'/'.$reviews[$i]['id'];?>" title="Edit Review" class="dir-searchbtn">Edit</a> <a style="color:#fff; padding: 3px 16px;font-size:16px;text-shadow:none;" href="<?php echo site_url('review/delete').'/'.$reviews[$i]['id'];?>" title="Delete Review" class="dir-searchbtn" onclick="return confirm('Are you sure to remove this review?');">Delete</a>
              <?php } else {?>
              <a style="color:#fff; padding: 3px 16px;font-size:16px;text-shadow:none;" href="<?php echo site_url('review/add').'/'.$reviews[$i]['companyid'];?>" title="Review This Company" class="dir-searchbtn">Review</a>
              <?php } ?>
              <?php } else {?>
              <a style="color:#fff; padding: 3px 16px;font-size:16px;text-shadow:none;" href="<?php echo site_url('review/add').'/'.$reviews[$i]['companyid'];?>" title="Review This Company" class="dir-searchbtn">Review</a>
              <?php } ?></td>
          </tr>
          <tr>
            <td></td>
            <td colspan="2" style="color:#333333; padding-bottom:10px; padding-top:10px">Add your vote:
              <?php $ip = $_SERVER['REMOTE_ADDR'];
					if($this->reviews->check_vote($ip,$reviews[$i]['id'],'helpful') == 'true'){?>
              <a class="vote-disable" id="helpful_<?php echo $reviews[$i]['id'];?>" reviewid="<?php echo $reviews[$i]['id'];?>">Helpful</a>
              <?php } else {?>
              <a class="vote" id="helpful_<?php echo $reviews[$i]['id'];?>" reviewid="<?php echo $reviews[$i]['id'];?>">Helpful</a>
              <?php } ?>
              <?php if($this->reviews->check_vote($ip,$reviews[$i]['id'],'funny') == 'true'){?>
              <a id="funny_<?php echo $reviews[$i]['id'];?>" class="vote-disable" title="funny" reviewid="<?php echo $reviews[$i]['id'];?>">Funny</a>
              <?php } else {?>
              <a id="funny_<?php echo $reviews[$i]['id'];?>" class="vote" title="funny" reviewid="<?php echo $reviews[$i]['id'];?>">Funny</a>
              <?php } ?>
              <?php if($this->reviews->check_vote($ip,$reviews[$i]['id'],'agree') == 'true'){?>
              <a id="agree_<?php echo $reviews[$i]['id'];?>" class="vote-disable" reviewid="<?php echo $reviews[$i]['id'];?>">Agree</a>
              <?php } else {?>
              <a id="agree_<?php echo $reviews[$i]['id'];?>" class="vote" reviewid="<?php echo $reviews[$i]['id'];?>">Agree</a>
              <?php } ?>
              <?php if($this->reviews->check_vote($ip,$reviews[$i]['id'],'disagree') == 'true'){?>
              <a id="disagree_<?php echo $reviews[$i]['id'];?>" class="vote-disable" title="disagree" reviewid="<?php echo $reviews[$i]['id'];?>">Disagree</a>
              <?php } else {?>
              <a id="disagree_<?php echo $reviews[$i]['id'];?>" class="vote" title="disagree" reviewid="<?php echo $reviews[$i]['id'];?>">Disagree</a>
              <?php } ?></td>
            <td></td>
            <td></td>
          </tr>
          <tr style="background:#E8E8E8" height="30px">
            <td width="105px" style="padding-left:1px" class="user_view"><div class="comment_img"> 
                <!--<img src="<?php echo site_url();?>/images/ico-riv-comment.png"/>--> 
                <span style="padding-left:25px;text-decoration:underline;"> <a href="<?php echo site_url('review/browse/'.$reviews[$i]['seokeyword']);?>" title="Comments">
                <?php $comments=$this->reviews->get_comments_byreviewid($reviews[$i]['id']); echo count($comments); ?>
                Comments</a></span></div></td>
            <td colspan="2" style="padding-left:60px">Votes on this review: <b><span id="helpful<?php echo $reviews[$i]['id'];?>"><?php echo $this->reviews->getcount($reviews[$i]['id'],'helpful');?></span> Helpful / <span id="funny<?php echo $reviews[$i]['id'];?>"><?php echo $this->reviews->getcount($reviews[$i]['id'],'funny');?></span> Funny / <span id="agree<?php echo $reviews[$i]['id'];?>"><?php echo $this->reviews->getcount($reviews[$i]['id'],'agree');?></span> Agree / <span id="disagree<?php echo $reviews[$i]['id'];?>"><?php echo $this->reviews->getcount($reviews[$i]['id'],'disagree');?></span> Disagree</span></b>
            <td></td>
            <td></td>
          </tr>
        </table>
        <?php } ?>
        <?php 
				if($this->pagination->create_links()) { ?>
        <table border="0">
          <tr style="background:#ffffff">
            <td><div class="pagination"><?php echo $this->pagination->create_links(); ?></div></td>
          </tr>
        </table>
        <?php } } else { ?>
		
		
		
		<div class="form-message warning">
                        <p>No Reviews found.</p>
                      </div>
		<?php } ?>
        <?php if($bottomads){ ?>
       <div class="ad_bottom"><a href="<?php echo $bottomads[0]['url'];?>" title="" target="_blank"><img src="<?php if( $bottomads[0]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('ad_main_upload_path');?><?php echo stripslashes($bottomads[0]['image']); } ?>" alt="topads" width="940" height="180" class="adimg"/></a> </div>
     
		  <?php } ?>
      </div>
      <?php echo form_close();?> 
      <!-- /box -->
      <?php } ?>
    </div>
  </section>
</section>
<?php echo $footer; ?>