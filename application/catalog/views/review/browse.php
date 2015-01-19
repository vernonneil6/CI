<?php echo $header;
$elitemem_status = $this->common->get_eliteship_bycompanyid($review[0]['companyid']);
?><script type="text/javascript" language="javascript">				  
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
<?php $company=$this->reviews->get_company_byid($review[0]['companyid']);?>

<section class="container">
  <section class="main_contentarea">
    <div class="verified_wrp pr_rwrp verfs_top">
      <?php $company=$this->reviews->get_company_byid($review[0]['companyid']);?>
      <?php  //get avg star by cmpyid
			$avgstar = $this->common->get_avg_ratings_bycmid($review[0]['companyid']);
			$avgstar = round($avgstar);
			//$elitemem_status = $this->common->get_eliteship_bycompanyid($review[0]['companyid']);
			?>
      <div class="verified_wrp pr_rwrp pr_rwrp">
        <?php /*?><div class="vry_logo"> <a href="<?php echo site_url('company/'.$review[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view complaint Detail"><img src="<?php if( $review[0]['logo'] ) { echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path');?><?php echo stripslashes($review[0]['logo']); } else { echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path')."no_image.png"; } ?>" alt="<?php echo ucfirst(stripslashes($review[0]['company'])); ?>" width="103px" height="88px" /></a> </div><?php */?>
        
        <?php if(count($elitemem_status)==0){?>
        <div class="vry_logo"> <a href="<?php echo site_url('company/'.$review[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view company Detail"><img class = "reviewnotverifiedlogos" src="images/notverified.png" alt="<?php echo ucfirst(stripslashes($review[0]['company'])); ?>" /></a> </div>
        <?php }else{
				  ?>
        <div class="vry_logo"> <a href="<?php echo site_url('company/'.$review[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view company Detail"><img class = "reviewnotverifiedlogos" src="images/verifiedlogo.jpg" alt="<?php echo ucfirst(stripslashes($review[0]['company'])); ?>" /></a> </div>
        <?php
				  } ?>
        <div class="compny_name">
          <h1><a href="<?php echo site_url('company/'.$review[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view company Detail"><?php  echo $review[0]['company'];?></a></h1>
          <?php 
		//get avg star by cmpyid
		$avgstar = $this->common->get_avg_ratings_bycmid($review[0]['companyid']);
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
        <div class="vry_btn"><a href="<?php echo base_url('review/add/'.$review[0]['companyid']);?>" title="Write review">WRITE REVIEW</a> <a href="<?php echo site_url('complaint/add');?>" title="File Complaint">FILE COMPLAINT</a></div>
      </div>
      <div class="pr_detlwrp">
        <div class="titl_pr_rel">
          <div class="pre_rls_rating">
            <ul>
              
            <?php for($r=0;$r<($review[0]['rate']);$r++){?>
            <li><i class="vry_rat_icn"></i></li>
            <?php } ?>
            <?php for($p=0;$p<(5-($review[0]['rate']));$p++){?>
            <li><img src="images/no_star.png" alt="no_star" title="no_star" /></li>
            <?php } ?>
        
            </ul>
          </div>
          <h1>"<?php echo stripslashes($review[0]['reviewtitle']); ?>"</h1>
          <p>- <?php echo $reviewdate = date('m/d/Y',strtotime($review[0]['reviewdate']));;?> -</p>
        </div>
       
       
       
       
        <div class="pr_countwrp">
          <ul>
            <li>
              <div class="cnt_content cnt_cnet"> <span>HELPFUL</span>
                <p><?php 
				
				echo $helpful = $this->common->get_votes($review[0]['id'],'helpful');?>
				
                
                </p>
              </div>
            </li>
            <li>
              <div class="cnt_content cnt_cnet"> <span>Funny</span>
                <p><?php echo $funny = $this->common->get_votes($review[0]['id'],'funny');?></p>
              </div>
            </li>
            <li>
              <div class="cnt_content cnt_cnet"> <span>Agree</span>
                <p><?php echo $agree = $this->common->get_votes($review[0]['id'],'agree');?></p>
              </div>
            </li>
            <li>
              <div class="cnt_content cnt_cnet"> <span>Disagree</span>
                <p><?php echo $disagree = $this->common->get_votes($review[0]['id'],'disagree');?></p>
              </div>
            </li>
          </ul>
        </div>
        <div class="pr_testmnl_wrp">
          <p class = "testmnl_p">"<?php echo stripslashes($review[0]['comment']); ?>"</p>
          <div class="testmnl_clntwrp testmnl_cln">
            <div class="clnt_intr"> - &nbsp;&nbsp;
              <div class="clnt_pic"> <img src="images/user_icn.png" alt="Client Image" title="Client Image"> </div>
              <div class="clnt_name">
                <?php if($review[0]['type']=='csv') {?>
                <h4><a title="<?php echo stripslashes($review[0]['reviewby']); ?>"> <?php echo stripslashes($review[0]['reviewby']); ?></a></h4>
                <?php } else { ?>
                <h4><a href="<?php echo site_url('complaint/viewuser/'.$review[0]['companyid'].'/'.$review[0]['reviewby']);?>" title="view profile"> <?php echo stripslashes($review[0]['username']); ?></a></h4>
                <?php } ?>
                <span><?php echo $review[0]['state'];?></span> </div>
            </div>
          </div>
          <div class="addcmnt_wrp">
            <div class="cmnt_wrp">
              <?php 
          if($this->session->userdata('youg_user')){ ?>
              <label for="review">
                <?php if($this->uri->segment(2) == 'browse') { ?>
                Add Your Comment
                <?php } ?>
                <?php if($this->uri->segment(2) == 'editcomment') { ?>
                Edit Your Comment
                <?php } ?>
              </label>
              <span class="error-sign">*</span>
              <div id="commenterror" class="error">Comment is required.</div>
              <?php echo form_open('review/upcomment',array('class'=>'formBox','id'=>'frmcomment'));?>
              <?php if($this->uri->segment(2) == 'browse') { ?>
              <?php echo form_textarea( array( 'name'=>'comment','id'=>'comment','class'=>'txrareawrp','style'=>'height:50px;width:640px')); ?>
              <?php } ?>
              <?php if($this->uri->segment(2) == 'editcomment') { ?>
              <?php echo form_textarea( array( 'name'=>'comment','id'=>'comment','class'=>'txrareawrp','type'=>'text','value'=>nl2br(stripslashes($commentbyid[0]['comment'])),'style'=>'height:50px;width:640px' ) ); ?>
              <?php } ?>
              
              <!-- Submit form -->
              <?php if($this->uri->segment(2) == 'browse') { ?>
              <?php echo form_input(array('name'=>'btncommentsubmit','id'=>'btncommentsubmit','class'=>'lgn_btn','type'=>'submit','value'=>'Post Comment')); ?>
              <?php } ?>
              <?php if($this->uri->segment(2) == 'editcomment') { ?>
              <?php echo form_input(array('name'=>'btncommentupdate','id'=>'btncommentupdate','class'=>'lgn_btn','type'=>'submit','value'=>'Update')); ?>
              <?php } ?>
              <?php echo form_hidden( array( 'reviewid' => $this->encrypt->encode($reviewid) ) ); ?> <?php echo form_close();?> </div>
            <?php  }
           else{?>
            <a href="login"> <i class="add_cmnt"></i> Please login add comment </a>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <?php if(count($comments)>0){?>
    <div class="cmnt_mainwrp">
      <h2>WHAT OTHERS HAVE BEEN SAYING</h2>
      <?php for($i=0; $i<count($comments); $i++) {?>
      <?php $user=$this->users->get_user_byid($comments[$i]['commentby']);?>
      <div class="cmnt_blckwrp">
        <div class="clnt_intr cmt_lft">
          <div class="clnt_name txt_right">
            <h4><?php echo stripslashes($user[0]['username']); ?></h4>
            <span><?php echo stripslashes($user[0]['state']); ?></span>
            <p>
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
              <i><?php echo $commenttime; ?>&nbsp;ago</i> </p>
          </div>
          <div class="clnt_pic"> <img src="images/user_icn.png" alt="Client Image" title="Client Image"> </div>
        </div>
        <div class="review_rgt cmnt_dscr">
          <p><?php echo stripslashes($comments[$i]['comment']); ?></p>
          <p>
            <?php if( array_key_exists('youg_user',$this->session->userdata) ) { ?>
            <?php if(($comments[$i]['commentby']==$this->session->userdata['youg_user']['userid'])) { ?>
            <a href="<?php echo site_url('review/deletecomment/'.$comments[$i]['id']);?>" onclick="return confirm('Are you sure to delete this comment?');" title="Delete">delete</a>&nbsp;or&nbsp;<a href="<?php echo site_url('review/editcomment/'.$comments[$i]['id']);?>" title="Edit">edit</a>
            <?php } } ?>
          </p>
        </div>
      </div>
      <?php } ?>
    </div>
    <?php } ?>
  </section>
</section>
<?php echo $footer;?>
