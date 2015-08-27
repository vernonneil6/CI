<?php $fb = $this->common->get_semsetting_value(1);?>
<?php $tw = $this->common->get_semsetting_value(2);?>
<?php $pi = $this->common->get_semsetting_value(3);?>
<?php $go = $this->common->get_semsetting_value(4);?>
<?php $li= $this->common->get_semsetting_value(5);?>
<?php
/* Facebook login redirect to pervious page to welcome controller fblogin() */
$currenturl=base_url(uri_string()); 
$url=base_url()."login";
$url1=base_url()."welcome/fblogin";
$url2=base_url()."user/logout";

$CI =& get_instance();
$CI->load->library('user_agent');
if($CI->agent->is_referral()){
	$lasturl = $CI->agent->referrer();
	if($lasturl !=$url && $lasturl !=$url1 && $lasturl !=$url2)
	{	
		$this->session->set_userdata('lastURL',$lasturl);
	}
}   

/* Ends Here */
?>
<link rel="stylesheet" href="http://www.yougotrated.writerbin.com/css/widget.css" type="text/css">
	<script type="text/javascript" src="http://www.yougotrated.writerbin.com/js/widget.js" ></script>

	<div class = "company_review_tab fancybox" href="#review_popup" onclick="ygrembeddedwidgetshowPopup('<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME']. '/widget/content/'.$companyid; ?>')"></div>
<div class="review_cover ygrembbededwidget" id="review_cover">	
<div id="review_popup" class = "popupwidth ">
	<div class='close_popup' onclick="ygrembeddedwidgetclosePopup()"> </div>		
	
</div> 
</div>
<div class="container">
	<div align="center" class="addvert-bottom">
		<?php if(isset($bottomads) && count($bottomads)){ ?>       
		<div class="ad_bottom"><a href="<?php echo $bottomads[0]['url'];?>" title="Adverstiment"  rel="nofollow"><img src="<?php if( $bottomads[0]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('ad_main_upload_path');?><?php echo stripslashes($bottomads[0]['image']); } ?>" alt="Adverstiment" width="940" height="180" class="adimg"/></a> </div>
		<?php } ?>
	</div>
</div>

<footer>
  <div class="ft_cat_wrp">
    <div class="container">
      <div class="innr_wrap">
        <div class="main_footer">
          <div class="main_footer_block">
            <div class="footer_block foot_bar" id="first">
              <div class="footer-col">
				  <ul>
					<li class="ftitle">YOU GOT RATED GUIDE</li>
					<?php 
					$footerpart1 = $this->common->get_footerlink_byid(1); 
					if($footerpart1 != '')
					{
					foreach($footerpart1 as $part1) 
					{ 
					?>
						<li class="fmenu"><a href="<?php echo 'footerpage/index/'.$part1['intid'];?>" title="<?php echo $part1['title'];?>"><?php echo $part1['title'];?></a></li>
					<?php 
					}
					}
					?>
					
				  </ul>
			</div>
			<div class="footer-col">	
				  <ul class="foot_mid_bar">
					<li class="ftitle">COMMUNITY BOARDS</li>
					<?php /*<li><a href="<?php echo site_url('businessdirectory');?>" title="Report a Complaint">File Complaint</a></li> */?>
					<li class="fmenu"><a href="<?php echo site_url('review');?>" title="Browse Reviews">BROWSE REVIEWS</a></li>
					<li class="fmenu"><a href="<?php echo site_url('complaint');?>" title="Browse Complaints">BROWSE COMPLAINTS</a></li>
					<li class="fmenu"><a href="<?php echo site_url('pressrelease');?>" title="Browse Press Releases">BROWSE PRESS RELEASES</a></li>
					<li class="fmenu"><a href="<?php echo site_url('businessdirectory');?>" title="Browse Companies">BROWSE COMPANIES</a></li>
					<?php 
					$footerpart2 = $this->common->get_footerlink_byid(2); 
					if($footerpart2 != '')
					{
					foreach($footerpart2 as $part2) 
					{ 
					?>
						<li class="fmenu"><a href="<?php echo 'footerpage/index/'.$part2['intid'];?>" title="<?php echo $part2['title'];?>"><?php echo $part2['title'];?></a></li>
					<?php 
					}
					}
					?>
				  </ul>
              </div>
              
              <div class="footer-col">	
				  <ul>
				  <li class="ftitle">BUYER PROTECTION PROGRAM</li>
				  <?php 
					$footerpart5 = $this->common->get_footerlink_byid(5); 
					if($footerpart5 != '')
					{
					foreach($footerpart5 as $part5) 
					{ 
					?>
						<li class="fmenu"><a href="<?php echo 'footerpage/index/'.$part5['intid'];?>" title="<?php echo $part5['title'];?>"><?php echo $part5['title'];?></a></li>
					<?php 
					}
					}
					?>
				  </ul>
              </div>
               <div class="footer-col">           
				  <ul class="forbusiness_footer">
					<li class="ftitle">FOR BUSINESSES</li>
					<li class="fmenu"><a href="http://business.yougotrated.com/" title="Business Solution">BUSINESS SOLUTIONS</a></li>
					<?php 
					$url = str_replace( 'http://', 'https://',site_url('solution/claimbusiness'));
					?>
					<li class="fmenu"><a id="merchant-signup" href="<?php echo site_url('solution/claimbusiness'); ?>" title="Merchant Signup">merchant sign up</a></li>
					<?php 
					$footerpart3 = $this->common->get_footerlink_byid(3); 
					if($footerpart3 != '')
					{
					foreach($footerpart3 as $part3) 
					{ 
					?>
						<li class="fmenu"><a href="<?php echo 'footerpage/index/'.$part3['intid'];?>" title="<?php echo $part3['title'];?>"><?php echo $part3['title'];?></a></li>
					<?php 
					}
					}
					?>
				  </ul>
              </div>
              
              
              
            </div>
            
            <div class="footer_block"  id="first">
			  <div class="footer-col">
				  <ul>
					<li class="social_tit foot_title_bar">JOIN THE CONVERSATION</li>
					<div class="foot_social_img ">
						<li class="twitter "><a href="<?php echo $tw;?>" title="Twitter"><img src="../images/img/socialicon/twitter.jpg" alt="YGR-Social-Twitter" title="YGR-Social-Twitter" /></a></li>
						<li class="facebook "><a href="<?php echo $fb;?>" title="Facebook"><img src="../images/img/socialicon/facebook.jpg" alt="YGR-Social-Facebook" title="YGR-Social-Facebook" /></a></li>
						<li class="google "><a href="<?php echo $go;?>" title="Google"><img src="../images/img/socialicon/googleplus.jpg" alt="YGR-Social-Google" title="YGR-Social-Google" /></a></li>
						<li class="pinterest "><a href="<?php echo $pi;?>" title="Pinterest"><img src="../images/img/socialicon/pinterest.jpg" alt="YGR-Social-Pin" title="YGR-Social-Pin" /></a></li>
						<li class="linkedin "><a href="<?php echo $li;?>" title="linkedin"><img src="../images/img/socialicon/LinkedIn_icon.jpg" alt="YGR-Social-LinkedIn" title="YGR-Social-LinkedIn" /></a></li>
					</div>
				  </ul>
			  </div>
			  <div class="footer-col">  
				  <ul class="foot_last_bar">
					<?php if($this->uri->segment(1)!='login'){?>
				   <?php if( !array_key_exists('youg_user',$this->session->userdata) ) { ?>
				   <li class="ftitle">User LOGIN</li>
				   <li class="fmenu">
					  <div class="user_login">
					  <form action="login" id="userflogin" name="" method="post">
						  <input type="email" class="usr_txtbox" placeholder="Username" name="loginemail" id="loginemail" required>
						  <input type="password" class="usr_txtbox" placeholder="Password" name="loginpassword" id="loginpassword" required>
						  <span><button type="button" title="Login" onclick="userlogin();">login</button></span> 
					  </form>
					  </div>
					</li>
					<?php } } ?>
				   </ul>
			  </div>		  
             
              <div class="footer-col">
				  <ul  class="foot_last_bar">              
					<li class="ftitle">MERCHANT LOGIN</li>
					<li class="fmenu">
					  <form action="<?php echo base_url();?>businessadmin/adminlogin" id="elitelogin" method="post">
					    <div class="user_login">
						<input type="text" class="usr_txtbox" placeholder="Username" name="user_name" id="user_name" required>
						<input type="password" class="usr_txtbox" placeholder="Password" name="user_pass" id="user_pass" required>
						<span><button title="Login" onclick="elitelogin();" type="button">login</button></span> </div>
					  </form>
					</li>
				  </ul>
              </div>
              
            </div>
                    
          </div>
        </div>
        
		<div class="footerbottomlink">
			<span>© Copyright <?php echo date("Y");?>  <?php echo $site_name;?></span>
			<span>All Rights Reserved</span>
			<span>
				<?php 
				
				$footerpart4 = $this->common->get_footerlink_byid(4); 
				if($footerpart4 != '')
				{
				foreach($footerpart4 as $part4) 
				{ 
				?>
					<a href="<?php echo 'footerpage/index/'.$part4['intid'];?>" title="<?php echo $part4['title'];?>"><?php echo $part4['title'];?></a>
				<?php 
				}
				}
				?>
		    </span>
		</div>
		
	</div>   
  </div>
</div>
</footer>
<script type="text/javascript" src="js/use.js"></script>
<script> 
function __highlight(s, t) {
    var matcher = new RegExp("(" + $.ui.autocomplete.escapeRegex(t) + ")", "ig");
    return s.replace(matcher, "$1");
}

$(document).ready(
	function() {
	    $("#suggest").autocomplete(
		    {
			source : function(request, response) {
			    $.ajax({
				url : '/sp/ajax_suggest.php',
				dataType : 'json',
				data : {
				    term : request.term
				},

				success : function(data) {
					//alert(data);
				    response($.map(data, function(item) {
					return {
					    label : __highlight(item.label,request.term),
					    value : item.label
					};
				    }));
				}
			    });
			},
			minLength : 3,
			select : function(event, ui) {

			    $('#searchbutton').submit();
			}
		    }).keydown(function(e) {
		if (e.keyCode === 13) {
		    $("#search_form").trigger('submit');
		}
	    }).data("ui-autocomplete")._renderItem = function(ul, item) {

		return $("<li></li>").data("item.autocomplete", item).append(
			$("<a></a>").html(item.label)).appendTo(ul);
	    };
	});
</script>
</body>
</html>
