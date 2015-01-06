<?php echo $header; ?>
<section class="content-wrap" style="margin-right:0">
  <section class="inner_main">
    <!-- #content -->
    
    <div class="main_contentarea"> <?php echo $menu; ?>
    <?php if($topads){ ?>
       <div class="ad_up"><a href="<?php echo $topads[0]['url'];?>" title="" target="_blank"><img src="<?php if( $topads[0]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('ad_main_upload_path');?><?php echo stripslashes($topads[0]['image']); } ?>" alt="topads" width="940" height="180" class="adimg"/></a> </div>
		  <?php } ?>
      <?php  
	if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'browse' || $this->uri->segment(2) == 'editcomment' )){ ?>
      <div class="login_box_div" style="width:740px; margin-top:0; min-height:330px">
        <div class="box"> 
          <!-- Correct form message -->
          
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
          <?php if( $this->session->flashdata('error') ) { ?>
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
          <?php } ?>
          
          <!-- table --> 
          <script type="text/javascript" language="javascript">
              $(document).ready(function() {
				  $('#divcouponshare').hide();
               $('#couponshare').click(function() {
				   $('#divcouponshare').toggle();
				   
			   });
              });
          </script>
          <?php if( count($coupons) > 0 ) { ?>
          <?php $company=$this->coupons->get_company_byid($coupons[0]['companyid']);?>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td></td>
            </tr>
            <tr>
              <td width="460" valign="top" colspan="2"><div class="post_content_title" style="padding-bottom:0; height:auto"><?php echo stripslashes($coupons[0]['company']); ?></div></td>
            </tr>
            <tr height="50" valign="middle">
              <td colspan="3"><?php $date = date_default_timezone_set('Asia/Kolkata');                             
								$dbdate = date('Y-m-d',strtotime($coupons[0]['enddate']));
                $postdate = date('Y-m-d',strtotime($coupons[0]['enddate']));?>
                <div class="timing"> <a href="<?php echo $coupons[0]['url'];?>" target="_blank"> <?php echo "Promocode: ";?><span><?php echo $coupons[0]['promocode'];?></span> </a> <a> <?php echo "Expires: ";?><span><?php echo date('m/d/Y',strtotime($dbdate));?></span> </a><a> <?php echo "Category: ";?><span><?php echo $coupons[0]['category'];?></span> </a>
                <?php /*?><a href="<?php echo $coupons[0]['url'];?>" target="_blank"><?php echo $coupons[0]['url'];?></a><?php */?>
                 </div></td>
              <td></td>
              <td></td>
            </tr>
            <tr height="80">
              <td align="justify" colspan="2" style="padding-bottom:20px"><div class="post_content_dscr" style="word-wrap: break-word;margin-top:10px"> <?php echo nl2br(stripslashes($coupons[0]['title'])); ?> </div></td>
              <td></td>
              <td></td>
            </tr>
            <tr height="20">
              
              <td colspan="3"><div class="timing"><a title="click to share" style="cursor: pointer;"><span id="couponshare">Share it</span> </a> </div></td>
              <td></td>
              <td></td>
            </tr>
            <tr id="divcouponshare" style="display:block;">
              <td colspan="5"><input type="text"  class="complain_txtbox" value="<?php 
echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
?>
" style="width:600px;" /></td>
            </tr>
            <tr>
              <td style="border-bottom: 1px solid #CCCCCC; width:200px;" colspan="3"></td>
            </tr>
          </table>
          <?php } 

                else { ?>
          <tr>
            <td style="padding-left:20px"><!--  start message-red -->
              
              <div id="message-red">
                <table border="0" width="100%" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="red-left">No records found.</td>
                    <td class="red-right"><img src="<?php echo base_url(); ?>images/messages/icon_close_red.png" alt="Close"/></td>
                  </tr>
                </table>
              </div>
              
              <!--  end message-red --></td>
          </tr>
          <?php } ?>
          <!-- /pagination -->
          <?php  if($this->pagination->create_links()) { ?>
          <div class="pagination pagination-centered"> <?php echo $this->pagination->create_links(); ?> </div>
          <?php } ?>
          <!-- /pagination -->
          <?php if(count($couponcomments)>0)
		  { ?>
          <table border="0" style="background:none repeat scroll 0 0 #F6F6F6;padding-left:10px;margin-top:10px;" width="100%">
            <tr>
              <td colspan="2"><?php if(count($couponcomments)>0) { echo "Showing ".count($couponcomments)." comments"; } else { ?>
                No comments
                <?php
          }?></td>
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
              </tr>
            
            <?php for($k=0;$k<count($couponcomments);$k++) {
				$user=$this->users->get_user_byid($couponcomments[$k]['commentby']); ?>
            <tr>
              <td width="40px;">
              <div class="task-photo" style="width:40px; float:left; margin-right:20px"> <img width="60px" src="<?php if( strlen($user[0]['avatarbig']) > 1 ){ echo $this->common->get_setting_value('2').$this->config->item('user_thumb_upload_path');?><?php echo stripslashes($user[0]['avatarbig']); } else { if($user[0]['gender']=='Male') { echo $this->common->get_setting_value('2')."images/male.png"; } 
		  	if($user[0]['gender']=='Female') { echo $this->common->get_setting_value('2')."images/female.png"; } 
		  } 
		   ?>" alt="<?php echo stripslashes($user[0]['username']); ?>"/> </div>
              </td>
              
              <td><?php if(count($user)>0) { echo ucwords($user[0]['username']); } ?>
			  
			  		<div align="right">
                  <?php if( array_key_exists('youg_user',$this->session->userdata) ) { ?>
                  <?php if(($couponcomments[$k]['commentby']==$this->session->userdata['youg_user']['userid'])) { ?>
                  <span class="rev-user user_view" style="float:right"><a href="<?php echo site_url('coupon/deletecomment/'.$couponcomments[$k]['id']);?>" onclick="return confirm('Are you sure to delete this comment?');" title="Delete">Delete</a></span> <span style="float:right">&nbsp;or&nbsp;</span> <span class="rev-user user_view" style="float:right"><a href="<?php echo site_url('coupon/editcomment/'.$couponcomments[$k]['id']);?>" title="Edit">edit</a></span>
                  <?php } } ?>
                </div>
			  <?php
			
					$date1 = date('Y-m-d h:i:s',strtotime($couponcomments[$k]['commentdate'])); 
					$date2 = date('Y-m-d h:i:s');
					$diff = abs(strtotime($date2) - strtotime($date1)); 
					
					$years   = floor($diff / (365*60*60*24));
					$months  = floor($diff / (30*60*60*24));
					$days    = floor($diff/ (60*60*24));
					$hours   = floor($diff / (60*60));
					$minutes  = floor($diff/ 60);
					$seconds = floor($diff);
					
					if($seconds<=60){ $commenttime=$seconds.' Seconds '; }
					elseif($minutes<=60){ $commenttime=$minutes.' Minutes '; }
					elseif($hours<=24){ $commenttime=$hours.' Hours '; }
					elseif($days<=30){ $commenttime=$days.' Days '; }
					elseif($months<=12){ $commenttime=$months.' Months '; }
					else { $commenttime=$years.' Years '; }
					?>
                <div title="<?php echo date('d M, Y',strtotime($couponcomments[$k]['commentdate']));?>">commented : <i><?php echo $commenttime; ?>&nbsp;ago</i></div></td>
            </tr>
            <tr>
              <td colspan="2"><?php echo stripslashes($couponcomments[$k]['comment']); ?>
                </td>
            </tr>
            <?php
					}
					?>
          </table>
          <?php
		  }
          else
          {
         } 
		 ?>
         <table>
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
          </script>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2"><?php if( array_key_exists('youg_user',$this->session->userdata) ) { ?>
                <?php if($this->uri->segment(2) == 'browse') { ?>
                Add Your Comment
                <?php } ?>
                <?php if($this->uri->segment(2) == 'editcomment') { ?>
                Edit Your Comment
                <?php } ?>
                <?php } else {?>
                Please <span class="user_view"><a href="<?php echo site_url('login');?>">login</a></span> to add comment...
                <?php } ?>
                <?php if( array_key_exists('youg_user',$this->session->userdata) ) { ?>
                <?php echo form_open('coupon/upcomment',array('class'=>'formBox','id'=>'frmcomment'));?>
                <?php if($this->uri->segment(2) == 'browse') { ?>
                <?php echo form_textarea( array( 'name'=>'comment','id'=>'comment','class'=>'box_txtbox','rows'=>'4','cols'=>'15','style'=>'height:250px;width:640px')); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'editcomment') { ?>
                <?php echo form_textarea( array( 'name'=>'comment','id'=>'comment','class'=>'box_txtbox','type'=>'text','value'=>nl2br(stripslashes($couponcommentbyid[0]['comment'])),'style'=>'height:250px;width:640px' ) ); ?>
                <?php } ?>
                <div id="commenterror" class="error">Comment is required.</div>
                <?php if($this->uri->segment(2) == 'browse') { ?>
                <?php echo form_input(array('name'=>'btncommentsubmit','id'=>'btncommentsubmit','class'=>'dir-searchbtn','type'=>'submit','value'=>'Post Comment','style'=>'padding: 3px 16px;font-size:16px;text-shadow:none;float:right;margin-right:21px;')); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'editcomment') { ?>
                <?php echo form_input(array('name'=>'btncommentupdate','id'=>'btncommentupdate','class'=>'dir-searchbtn','type'=>'submit','value'=>'Update','style'=>'padding: 3px 16px;font-size:16px;text-shadow:none;float:right;margin-right:21px;')); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'editcomment') { ?>
                <?php echo form_hidden( array( 'id' => $this->encrypt->encode($couponcommentbyid[0]['id']) ) ); ?> <?php echo form_hidden( array( 'couponid' => $this->encrypt->encode($couponcommentbyid[0]['couponid']) ) ); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'browse') { ?>
                <?php echo form_hidden( array( 'couponid' => $this->encrypt->encode($this->uri->segment(3)) ) ); ?>
                <?php } ?>
                <?php echo form_close(); ?>
                <?php } ?></td>
            </tr>
         </table>
        </div>
      </div>
      <div class="profile-sidebar" style="border:none">
        <table border="0" cellspacing="0" cellpadding="0">
          <tr height="35">
            <td><b>Company Profile Summary</b></td>
          </tr>
          <tr>
            <td width="140"><div class="task-photo"> <img src="<?php if( $coupons[0]['logo'] ){ echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path');?><?php echo stripslashes($coupons[0]['logo']); } else{echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path')."/no_image.png"; } ?>" alt="<?php echo ucfirst(stripslashes($coupons[0]['company'])); ?>" style="border:1px solid #dcdcdc" width="100px" height="40px"/> </div></td>
          </tr>
          <tr height="35">
            <td><b>Company Statistics</b></td>
          </tr>
          <tr>
            <td class="company-wrap"><span>Complaint Against</span><br />
              <span><b><?php echo $coupons[0]['company']; ?></b></span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr height="35">
            <td class="company-wrap"><span>Total Coupons</span><br />
              <span><b><?php echo count($this->coupons->get_coupon_bycompanyid($coupons[0]['companyid'])); ?></b></span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>
      </div>
      <div style="margin-top:10px;margin-bottom:10px;" align="right">
        <table border="0">
          <tr>
            <td><div style="margin-top:5px;margin-bottom:5px;margin-right:5px;" align="right" class="my"><a href="<?php echo site_url('company/'.$company[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="visit complete company profile"><?php echo form_input(array('name'=>'btnsubmit','class'=>'complaint_btn','type'=>'submit','value'=>'visit complete company profile','style'=>'padding:0px 5px;font-size:14px;cursor: pointer;')); ?></a></div></td>
          </tr>
        </table>
      </div>
      <div style="margin-top:0px;margin-bottom:10px;margin-right:5px;float:right">
        <table border="0">
          <tr>
            <td width="40px"><span class="company_content_title">&nbsp;&nbsp;Do you have a complaint?</span></td>
          </tr>
          <tr>
            <td width="40px" class="company_dsr">Start with the name of the Company, Person or a Phone Number. Then select the complaint type to get started.</td>
          </tr>
          <tr>
            <td><div style="margin-top:5px;margin-bottom:5px;" align="right" class="my">
                <?php if( array_key_exists('youg_user',$this->session->userdata) ) { ?>
                <a href="<?php echo site_url();?>" title="submit a complaint"><?php echo form_input(array('name'=>'btnsubmit','id'=>'btnphone','class'=>'complaint_btn','type'=>'submit','value'=>'Submit a complaint','style'=>'padding:7px 25px;cursor: pointer;')); ?></a>
                <?php } else { ?>
                <a href="<?php echo site_url('welcome');?>" title="submit a complaint"><?php echo form_input(array('name'=>'btnsubmit','id'=>'btnphone','class'=>'complaint_btn','type'=>'submit','value'=>'Submit a complaint','style'=>'padding:7px 25px;cursor: pointer;')); ?></a>
                <?php } ?>
              </div></td>
          </tr>
        </table>
      </div>
      <?php }
	else { ?>
      <!-- Correct form message -->
      
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
      <?php if( $this->session->flashdata('error') ) { ?>
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
      <?php } ?>
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
          <td>&nbsp;</td>
          </tr>
        </table>
      <?php if($leftads){ ?>
       <div><a href="<?php echo $leftads[0]['url'];?>" title="" target="_blank"><img src="<?php if( $leftads[0]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('ad_main_upload_path');?><?php echo stripslashes($leftads[0]['image']); } ?>" alt="leftads" width="280" height="180" class="adimg"/></a> </div>
     
		  <?php } ?>
            </div>
      <div class="right_content_panel">
        <div class="treding_title">Yougotrated Live</div>
        <?php if(count($coupons)>0) {?>
        
			<?php for($i=0; $i<count($coupons); $i++) { ?>
        <div class="main_livepost">
          <div class="view_all"> <a href="<?php echo site_url('company').'/'.$coupons[$i]['companyseokeyword'].'/reviews/coupons/complaints';?>" title="view all"> <span>
            <h3>
              <?php $num=$this->coupons->get_coupon_bycompanyid($coupons[$i]['companyid']);?>
              <?php if(count($num)>0){?>
              <?php echo count($num);?>
              <?php }else{"0";}?>
            </h3>
            Related<br>
            Coupons </span></a> <!--<span>--><a href="<?php echo site_url('company').'/'.$coupons[$i]['companyseokeyword'].'/reviews/coupons/complaints';?>" title="view all">View All</a><!--</span>--> </div>
          <div class="post_maincontent">
            <div class="side-image"> <a href="<?php echo site_url('coupon/browse/'.$coupons[$i]['seokeyword']); ?>" title="view coupon detail"><img src="<?php if( $coupons[$i]['image'] ){ echo $this->common->get_setting_value('2').$this->config->item('coupon_thumb_upload_path');?><?php echo stripslashes($coupons[$i]['image']); } else{echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path')."/no_image.png"; } ?>" alt="<?php echo ucfirst(stripslashes($coupons[$i]['company'])); ?>" width="100px" height="40px"/></a> </div>
            <div class="post_content_title"><a href="<?php echo site_url('coupon/browse/'.$coupons[$i]['seokeyword']); ?>" title="view coupon detail"><?php echo ucfirst(stripslashes($coupons[$i]['company'])); ?></a></div>
            <div class="post_content_dscr user_view" style="margin-top:2px;width:inherit !important;"> <a href="<?php echo site_url('coupon/browse/'.$coupons[$i]['seokeyword']); ?>" title="view coupon detail"><?php echo strtolower(stripslashes($coupons[$i]['title'])); ?></a> </div>
            <?php 
                        $date = date_default_timezone_set('Asia/Kolkata');                             
                        $dbdate = date('Y-m-d',strtotime($coupons[$i]['enddate']));
                        $today = date('m/d/Y');
                        $d1 = strtotime(date('Y-m-d H:i:s'));
                        $d2 = strtotime($coupons[$i]['enddate']);
                        $newdate =round(($d1-$d2)/60);
                        if($newdate > 60){$diff = round(($d1-$d2)/60/60).' hours ago';}else{$diff = $newdate.' minutes ago';}
                        ?>
            <div class="timing"> <a href="<?php echo $coupons[$i]['url']; ?>" title="Promocode" target="_blank">Promocode : <span><?php echo $coupons[$i]['promocode'];?></span> </a> </div>
            <div class="timing"> <a href="<?php echo site_url('coupon/browse/'.$coupons[$i]['seokeyword']); ?>" title="view coupon detail">Expires : <span><?php echo date('m/d/Y',strtotime($dbdate));?></span> </a> </div>
            <div class="timing"> <a href="<?php echo site_url('coupon/browse/'.$coupons[$i]['seokeyword']); ?>" title="Business Category"><span><?php echo ucfirst($coupons[$i]['category']);?></span> </a> </div>
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
        <?php } ?>
        <?php }
        else
        {?>
         <div class="main_livepost">
                    <div class="post_maincontent">
                      <div class="form-message warning">
                        <p>No Coupons found.</p>
                      </div>
                    </div>
                  </div>
	   <?php }
	   ?>
      </div>
      <?php } ?>
     <?php if($bottomads){ ?>
       <div class="ad_bottom"><a href="<?php echo $topads[0]['url'];?>" title="" target="_blank"><img src="<?php if( $bottomads[0]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('ad_main_upload_path');?><?php echo stripslashes($bottomads[0]['image']); } ?>" alt="topads" width="940" height="180" class="adimg"/></a> </div>
     
		  <?php } ?>
      </div>
    </div>
    <!-- /#content --> 
  </section>
</section>
<?php echo $footer; ?>