<?php echo $header;
$elitemem_status = $this->common->get_eliteship_bycompanyid($review[0]['companyid']);
$username = $this->users->get_user_bysingleid($review[0]['reviewby']);
?><script type="text/javascript" language="javascript">				  
		  function countme(rid,vote)
		    {
			  $.ajax
			   ({
				  type 				: "POST",
				  url 				: "<?php echo site_url('review/countme');?>",
				  dataType 		    : "json",
				  data				: {reviewid:rid,vote : vote},
				  cache				: false,
				  success			: function(data)
									  {	
										$('.'+vote).html(data.total);
									
									  }
			    });
		    }
		  function check(ip,rid,vote)
		    {
			  
			  $.ajax
			   ({
				  type 				: "POST",
				  url 				: "<?php echo site_url('review/checkvote');?>",
				  dataType 		    : "json",
				  data				: { ip:ip,reviewid:rid,vote : vote},
				  cache				: false,
				  success			: function(data)
									  {	
										if(data.message == 'deleted')
										{
										   $('.'+vote).removeClass('vote-disable');
										   $('.'+vote).addClass('vote');
										}
										if(data.message == 'added')
										{
										   $('.'+vote).removeClass('vote');
										   $('.'+vote).addClass('vote-disable');										   										  
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
                  
				$("#btncommentsubmit").click(function () {
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

					if ($("input[name='score']").val() == "")
					{
						$("#rateerror").show();
						return false;
					}
					else
					{
						$("#rateerror").hide();
					}

					$("#frmcomment").submit();
				});
                 
                 
                $("#btncommentupdate").click(function () {
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

					if ($("input[name='score']").val() == "")
					{
						$("#rateerror").show();
						return false;
					}
					else
					{
						$("#rateerror").hide();
					}

					$("#frmcomment").submit();
				});  
         
				$('.rating_review').raty({ starOff : '../js/rating/img/star-off.png', starOn : '../images/YGR_Star_on.png'});
				$('.rating_comment_review').raty({
					starOff : '../js/rating/img/star-off.png', 
					starOn : '../images/YGR_Star_on.png',
					score: function() {
						return $(this).attr('data-score');
					}
				});
				$('.review_comment_view').raty({
					readOnly: true,
					starOff : '../js/rating/img/star-off.png', 
					starOn : '../images/YGR_Star_on.png',
					score: function() {
						return $(this).attr('data-score');
					}
				});
                 
              
              });
            
          </script>
<?php $company=$this->reviews->get_company_byid($review[0]['companyid']);?>
<section class="container">
  <section class="main_contentarea">
	  
	  <h1 class="bannertext"><span class="bannertextregular"><?php echo $review[0]['company'];?></span> Reviews</h1>
    <div class="verified_wrp pr_rwrp verfs_top">
      <?php 
			$company=$this->reviews->get_company_byid($review[0]['companyid']);
			$company_seoslug = ($company) ? $company[0]['seoslug'] : '';
			
			//get avg star by cmpyid
			$avgstar = $this->common->get_avg_ratings_bycmid($review[0]['companyid']);
			$avgstar = round($avgstar);
			
	  ?>
      <div class="verified_wrp pr_rwrp pr_rwrp">
        <?php /*?><div class="vry_logo"> <a href="<?php echo site_url('company/'.$review[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view complaint Detail"><img src="<?php if( $review[0]['logo'] ) { echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path');?><?php echo stripslashes($review[0]['logo']); } else { echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path')."no_image.png"; } ?>" alt="<?php echo ucfirst(stripslashes($review[0]['company'])); ?>" width="103px" height="88px" /></a> </div><?php */?>
        
        <?php if(count($elitemem_status)==0){?>
        <div class="vry_logo"> <a href="<?php echo site_url($company_seoslug); ?>" title="view company Detail"><img class = "reviewnotverifiedlogos" src="images/notverified.png" alt="<?php echo ucfirst(stripslashes($review[0]['company'])); ?> NotVerified Seal" /></a> </div>
        <?php }else{
				  ?>
        <div class="vry_logo"> <a href="<?php echo site_url($company_seoslug);?>" title="view company Detail"><img class = "reviewnotverifiedlogos" src="images/verifiedlogo.jpg" alt="<?php echo ucfirst(stripslashes($review[0]['company'])); ?> Verified Seal" /></a> </div>
        <?php
				  } ?>
        <div class="compny_name">
			
          <h1><a href="<?php echo site_url($company_seoslug);?>" title="view company Detail"><?php  echo $review[0]['company'];?></a></h1>
          
          <?php if(count($elitemem_status)==0){?>
			<a href="http://business.yougotrated.com/?elitemem=<?php echo $review[0]['companyid'] ?>" title="Upgrade to Elite">
					<img class="notverfiedimg" src="images/YouGotRated_BusinessProfile_NotVerified-CompanyHeaderText.jpg" alt="YGR-Businessprofile-Notverified">
				<div class="business_link"> 			
					IS THIS YOUR BUSINESS? CLICK HERE TO BECOME VERIFIED			
				</div>
			</a>
			
		  <?php } else { ?>
			  
			 <a href="<?php echo site_url('company/'.urlencode($review[0]['companyseokeyword']).'/reviews/coupons/complaints');?>" title="view company Detail"><div class="vrytitle verifytag">YouGotRated VERIFIED MERCHANT</div></a>
			  
		  <?php } ?>	  	  
          
          <?php 
		//get avg star by cmpyid
		$avgstar = $this->common->get_avg_ratings_bycmid($review[0]['companyid']);
		$avgstar = round($avgstar);
		;?>
          <div class="vry_rating reviewrates in_block custom-top-rating">
			<div class ="count-<?php echo $avgstar?>">  
            <?php for($r=0;$r<($avgstar);$r++){?>
            <i class="vry_rat_icn"></i>
            <?php } ?>
            </div>
            <?php for($p=0;$p<(5-($avgstar));$p++){?>
            <img src="images/no_star.png" alt="no_star" title="no_star" />
            <?php } ?>
          </div>
        <div class="vry_btn reviewbtn d_tab">
			<a href="<?php echo base_url('review/add/'.$review[0]['companyid']);?>" title="Write review">WRITE REVIEW</a> 
			<a href="<?php echo site_url('complaint/add/'.$review[0]['companyid']);?>" title="File Complaint">FILE COMPLAINT</a>
		</div> 
		
        </div>
        
      </div>
      <!-- Go to www.addthis.com/dashboard to customize your tools -->
	<div class="addthis_native_toolbox" id="custom-share"></div>
      <div class="pr_detlwrp">
        <div class="titl_pr_rel">
          <div class="pre_rls_rating">

          <div class ="count-<?php echo $review[0]['rate']?>">  
            <?php for($r=0;$r<($review[0]['rate']);$r++){?>
			<i class="vry_rat_icn"></i>
            <?php } ?>
          </div>  
            <?php for($p=0;$p<(5-($review[0]['rate']));$p++){?>
			<img src="images/no_star.png" alt="no_star" title="no_star" />
            <?php } ?>
        
 
          </div>
          <h1>"<?php echo stripslashes($review[0]['reviewtitle']); ?>"</h1>
          <p>- <?php echo $reviewdate = date('m/d/Y',strtotime($review[0]['reviewdate']));;?> -</p>
        </div>
       
       
				<script>
					<?php $ip = $_SERVER['REMOTE_ADDR'];  ?>
					$(function()
					{ 
					   $(".helpfuls").click(function() {
						 var vote = 'helpful';
						 var reviewid = $(this).attr('reviewid');
						 check('<?php echo $ip;?>',reviewid,vote);
					   });
					   $(".funnys").click(function() {
						 var vote = 'funny';
						 var reviewid = $(this).attr('reviewid');
						 check('<?php echo $ip;?>',reviewid,vote);
					   });
					   $(".agrees").click(function() {
						 var vote = 'agree';
						 var reviewid = $(this).attr('reviewid');
						 check('<?php echo $ip;?>',reviewid,vote);
						 countme(reviewid,'disagree');
						 $('.disagree').removeClass('vote-disable');
						 $('.disagree').addClass('vote'); 
					   });
					   $(".disagrees").click(function() {
						 var vote = 'disagree';
						 var reviewid = $(this).attr('reviewid');
						 check('<?php echo $ip;?>',reviewid,vote);
						 countme(reviewid,'agree');
						 $('.agree').removeClass('vote-disable');
						 $('.agree').addClass('vote'); 
					   });
					});
				</script>
       
        <div class="pr_countwrp custom-countwrp">
          <ul>
            <li>
              <div class="cnt_content cnt_cnet"> <span class="helpfuls" style="cursor:pointer !important;" reviewid="<?php echo $review[0]['id'];?>">HELPFUL</span>
                <p>
				 <?php if($this->reviews->check_vote($ip,$review[0]['id'],'helpful') == 'true'){ ?>
					  <a class="vote-disable helpful" reviewid="<?php echo $review[0]['id'];?>" title="Helpful" ><b id="helpful<?php echo $review[0]['id'];?>"><?php echo $this->reviews->getcount($review[0]['id'],'helpful');?></b></a>
					  <?php }else{ ?>
					  <a class="vote helpful"  reviewid="<?php echo $review[0]['id'];?>" title="Helpful" ><?php echo $this->reviews->getcount($review[0]['id'],'helpful');?></a>
					  <?php } ?>
                
                </p>
              </div>
            </li>
            <li>
              <div class="cnt_content cnt_cnet"> <span class="funnys" reviewid="<?php echo $review[0]['id'];?>" style="cursor:pointer !important;">Funny</span>
               <p> <?php if($this->reviews->check_vote($ip,$review[0]['id'],'funny') == 'true'){?>
					  <a class="vote-disable funny" title="funny" reviewid="<?php echo $review[0]['id'];?>" ><b id="funny<?php echo $review[0]['id'];?>"><?php echo $this->reviews->getcount($review[0]['id'],'funny');?></b> </a>
					  <?php }else{ ?>
					  <a class="vote funny" title="funny" reviewid="<?php echo $review[0]['id'];?>" ><?php echo $this->reviews->getcount($review[0]['id'],'funny');?></a>
				   <?php } ?>
			  </p>
              </div>
            </li>
            <li>
              <div class="cnt_content cnt_cnet"> <span class="agrees" reviewid="<?php echo $review[0]['id'];?>" style="cursor:pointer !important;">Agree</span>
                <p><?php if($this->reviews->check_vote($ip,$review[0]['id'],'agree') == 'true'){?>
					  <a class="vote-disable agree" reviewid="<?php echo $review[0]['id'];?>" title="Agree" ><b id="agree<?php echo $review[0]['id'];?>"><?php echo $this->reviews->getcount($review[0]['id'],'agree');?></b> </a>
					  <?php }else{ ?>
					  <a class="vote agree" reviewid="<?php echo $review[0]['id'];?>" title="Agree" ><?php echo $this->reviews->getcount($review[0]['id'],'agree');?></a>
					  <?php } ?></p>
              </div>
            </li>
            <li>
              <div class="cnt_content cnt_cnet"> <span class="disagrees" reviewid="<?php echo $review[0]['id'];?>" style="cursor:pointer !important;">Disagree</span>
                <p> <?php if($this->reviews->check_vote($ip,$review[0]['id'],'disagree') == 'true'){?>
					  <a class="vote-disable disagree" title="disagree" reviewid="<?php echo $review[0]['id'];?>" ><b id="disagree<?php echo $review[0]['id'];?>"><?php echo $this->reviews->getcount($review[0]['id'],'disagree');?></b> </a>
					  <?php }else{ ?>
					  <a class="vote disagree" title="disagree" reviewid="<?php echo $review[0]['id'];?>" ><?php echo $this->reviews->getcount($review[0]['id'],'disagree');?></a>
					  <?php } ?></p>
              </div>
            </li>
          </ul>
        </div>
        <div class="pr_testmnl_wrp">
          <p class = "testmnl_p">"<?php echo stripslashes($review[0]['comment']); ?>"</p>
          <div class="testmnl_clntwrp testmnl_cln">
            <div class="clnt_intr"><div class="hypen">-</div>
              <div class="clnt_pic"> 
				  <?php if($username['avatarthum']==null) {?>
					  <img src="images/default_user.png" alt="Client Image" title="Client Image"> 
				  <?php } else { ?>
					  <img src="uploads/user/thumb/<?php echo $username['avatarthum'];?>" alt="YGR-<?php echo $username['username'];?>-profile-image" title="User image">
				  <?php } ?>
			  </div>
              <div class="clnt_name">
                <?php if($review[0]['type']=='csv' or $review[0]['type']=='ygr') { 
					
				?>
                <h4><a title="<?php echo stripslashes($username['username']); ?>"> <?php if($username['username']!='') { echo stripslashes($username['username']); } else  { echo stripslashes($username['firstname']); } ?></a></h4>
                <?php } else { ?>
                <h4><a href="<?php echo site_url('complaint/viewuser/'.$review[0]['companyid'].'/'.$review[0]['reviewby']);?>" title="view profile"> <?php if($review[0]['username']!='') { echo stripslashes($review[0]['username']); } else { echo stripslashes($username['firstname']); } ?></a></h4>
                <?php } ?>
                <span><?php echo $review[0]['state'];?></span> </div>
				<!-- Go to www.addthis.com/dashboard to customize your tools -->
				<div class="addthis_native_toolbox" id="custom-share1" style="display:none"></div>
            </div>
            
         
          </div>
          <!-- responsive-->
           <div class="pr_countwrp custom-countwrp1" style="display:none;">
          <ul>
            <li>
              <div class="cnt_content cnt_cnet"> <span class="helpfuls" style="cursor:pointer !important;" reviewid="<?php echo $review[0]['id'];?>">HELPFUL</span>
                <p><?php 
				
				//echo $helpful = $this->common->get_votes($review[0]['id'],'helpful');
				//echo $this->reviews->getcount($review[0]['id'],'helpful');?>
				 <?php if($this->reviews->check_vote($ip,$review[0]['id'],'helpful') == 'true'){ ?>
					  <a class="vote-disable helpful" reviewid="<?php echo $review[0]['id'];?>" title="Helpful" ><b id="helpful<?php echo $review[0]['id'];?>"><?php echo $this->reviews->getcount($review[0]['id'],'helpful');?></b></a>
					  <?php }else{ ?>
					  <a class="vote helpful" reviewid="<?php echo $review[0]['id'];?>" title="Helpful" ><?php echo $this->reviews->getcount($review[0]['id'],'helpful');?></a>
					  <?php } ?>
                
                </p>
              </div>
            </li>
            <li>
              <div class="cnt_content cnt_cnet"> <span class="funnys" reviewid="<?php echo $review[0]['id'];?>" style="cursor:pointer !important;">funny</span>
                <p> <?php if($this->reviews->check_vote($ip,$review[0]['id'],'funny') == 'true'){?>
					  <a class="vote-disable funny" title="funny" reviewid="<?php echo $review[0]['id'];?>" ><b id="funny<?php echo $review[0]['id'];?>"><?php echo $this->reviews->getcount($review[0]['id'],'funny');?></b> </a>
					  <?php }else{ ?>
					  <a class="vote funny" title="funny" reviewid="<?php echo $review[0]['id'];?>" ><?php echo $this->reviews->getcount($review[0]['id'],'funny');?></a>
					  <?php } ?>
					  </p>
              </div>
            </li>
            <li>
              <div class="cnt_content cnt_cnet"> <span class="agrees" reviewid="<?php echo $review[0]['id'];?>" style="cursor:pointer !important;">Agree</span>
                 <p><?php if($this->reviews->check_vote($ip,$review[0]['id'],'agree') == 'true'){?>
					  <a class="vote-disable agree" reviewid="<?php echo $review[0]['id'];?>" title="Agree" ><b id="agree<?php echo $review[0]['id'];?>"><?php echo $this->reviews->getcount($review[0]['id'],'agree');?></b> </a>
					  <?php }else{ ?>
					  <a class="vote agree" reviewid="<?php echo $review[0]['id'];?>" title="Agree" ><?php echo $this->reviews->getcount($review[0]['id'],'agree');?></a>
					  <?php } ?></p>
              </div>
            </li>
            <li>
              <div class="cnt_content cnt_cnet"> <span class="disagrees" reviewid="<?php echo $review[0]['id'];?>" style="cursor:pointer !important;">Disagree</span>
                <p> <?php if($this->reviews->check_vote($ip,$review[0]['id'],'disagree') == 'true'){?>
					  <a class="vote-disable disagree" title="disagree" reviewid="<?php echo $review[0]['id'];?>" ><b id="disagree<?php echo $review[0]['id'];?>"><?php echo $this->reviews->getcount($review[0]['id'],'disagree');?></b> </a>
					  <?php }else{ ?>
					  <a class="vote disagree" title="disagree" reviewid="<?php echo $review[0]['id'];?>" ><?php echo $this->reviews->getcount($review[0]['id'],'disagree');?></a>
					  <?php } ?></p>
              </div>
            </li>
          </ul>
        </div>
        <!-- End-->
          <div class="addcmnt_wrp">
            <div class="cmnt_wrp">
              <?php 
          if($this->session->userdata('youg_user')){ ?>
			  <?php echo form_open('review/upcomment',array('class'=>'formBox','id'=>'frmcomment'));?>
			  <div id="rateerror" class="error">Please choose a star rating.</div>
			  <div id="commenterror" class="error">Comment is required.</div>
			 
			    <div class="rate-company">  
				<label class = "comment_rating_label">Rate this company  *</label>            
                <?php if($this->uri->segment(2) == 'editcomment') { ?>					
					<i class="rating_comment_review" data-score = "<?php echo $commentbyid[0]['rating'];?>"></i>
				<?php }else{ ?>
					<i class="rating_review"></i>
                <?php } ?>	
				</div>
             
              <label for="review">              
                <?php if($this->uri->segment(2) == 'editcomment') { ?>
					Edit Your Comment  *
                <?php }else{ ?>
					  Add Your Comment  *
                <?php } ?>
              </label>      
                    
              <?php if($this->uri->segment(2) == 'editcomment') { ?>
					<input type = "hidden" value = "<?php echo $commentbyid[0]['id'];?>" name = "id" >
              <?php echo form_textarea( array( 'name'=>'comment','id'=>'comment','class'=>'txrareawrp','type'=>'text','value'=>nl2br(stripslashes($commentbyid[0]['comment'])),'style'=>'height:50px;width:640px' ) ); ?>
              <?php }else{ ?>
				  
              <?php echo form_textarea( array( 'name'=>'comment','id'=>'comment','class'=>'txrareawrp','style'=>'height:50px;')); ?>
              <?php } ?>
              
              <!-- Submit form -->
			  <?php if($this->uri->segment(2) == 'editcomment') { ?>
              <?php echo form_input(array('name'=>'btncommentupdate','id'=>'btncommentupdate','class'=>'lgn_btn','type'=>'submit','value'=>'Update')); ?>
              <?php }else{ ?>
			  <?php echo form_input(array('name'=>'btncommentsubmit','id'=>'btncommentsubmit','class'=>'lgn_btn','type'=>'submit','value'=>'Post Comment')); ?>
              <?php } ?>	  
				  
              <?php echo form_hidden( array( 'reviewid' => $this->encrypt->encode($reviewid) ) ); ?> 
              <?php echo form_close();?> 
            </div>
            <?php  }else{ ?>
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
					elseif($days<=30)
					{ 
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
          <div class="clnt_pic"> 
			  <?php if($user[0]['avatarthum']==null) {?>
				  <img src="images/default_user.png" alt="Client Image" title="Client Image"> 
			  <?php } else { ?>
				  <img src="uploads/user/thumb/<?php echo $user[0]['avatarthum'];?>" alt="YGR-<?php echo $username['username'];?>-Profile-image" title="User image">
			  
			  <?php } ?>
			 
		  </div>
        </div>
        <div class="review_rgt cmnt_dscr">
          <p><?php echo stripslashes($comments[$i]['comment']); ?></p>
          <p><i data-score = "<?php echo $comments[$i]['rating']; ?>" class = "review_comment_view"></i></p>
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
