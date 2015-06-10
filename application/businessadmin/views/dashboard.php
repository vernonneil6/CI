<?php echo $header; ?>

<!-- #content -->
<style>
.box .icon_list li 
{
height:70px !important;
}
#popup
{
    position:absolute;
    top:165px;
    left:50%;
    width:500px; 
    height:350px; 
    margin-left:-250px;
    border:1px solid #000000; 
    padding:20px;
    background-color:white;
    z-index:99;
}
.black_overlay
{
	position:absolute;
	top:0px;
    width:100%;
    height:100%;
    padding:20px;
    background-color:black;
    z-index:99;
    opacity:0.5;
	
}
h4{
margin-top: 20%;
text-align: center;
}
.review_txt_box
{
 margin-left: 18%;
 margin-top: 5%;
}
.formBox .btn-submit
{
	border:none;
	padding-top: 25px;
	padding-left: 37%;
}
</style>
<script type="text/javascript" language="javascript">
	function trim(stringToTrim) {
		return stringToTrim.replace(/^\s+|\s+$/g,"");
	}
	$(document).ready(function() {
		$("#btnsubmit").click(function () {
			var checkcondition=0;
			if (!$("#terms-conditions").is(":checked")) {
				$('#terms-error').show();
			}
			else
			{
				$('#terms-error').hide();
				checkcondition++;
			}
			if (!$("#terms-conditions2").is(":checked")) {
				$('#terms-error2').show();
			}
			else
			{
				$('#terms-error2').hide();
				checkcondition++;
			}
			
			if(checkcondition==2){
				return true;
			} else {
				return false;
			}
				
			if( $("#frmacceptterms").submit() )
			{
			  $("#error").attr('style','display:none;');
			}
    	});
	});
</script>
<script type="text/javascript">
function show_popup()
{
document.getElementById('popup').style.display = 'block'; 
}
window.onload = show_popup;
</script>
<?php 
$logdata=$this->session->all_userdata();
$logcount=$this->session->userdata['youg_admin']['logcount'];
?>
<!--Terms and conditions Popup-->
<?php if($logcount=='0'){ 
	//setcookie("firstvisit", "1", time() + 2592000); ?>

<div class="black_overlay" id="black_overlay"></div>
<div id="popup" class="popupclose">
	<h4><span>Welcome the the YouGotRated Elite Admin dashboard.</span></h4>
        <?php echo form_open('dashboard/popupclicked',array('class'=>'formBox','id'=>'frmacceptterms')); ?>
             <input type="hidden" name="firstvisit" id="firstvisit" >
			 <div id="termscondn" class="review_txt_box" >
					<input type="checkbox" id="terms-conditions" />
					<label> I have read and accept the <a href="http://yougotrated.com/footerpage/index/2" target="_blank">Terms and Conditions</a>.</label>
					<div><label id="terms-error" style='display:none;color:#ff0000;'>Please indicate that you accept the Terms and Conditions</label></div>
					<input type="checkbox" id="terms-conditions2" />
					<label>I have read and accept the <a href="http://yougotrated.com/footerpage/index/102" target="_blank">Privacy Policy</a>.</label>
					<div><label id="terms-error2" style='display:none;color:#ff0000;'>Please indicate that you accept the Privacy Policy</label></div>
				</div>
				<div class="btn-submit"> 
				   <?php echo form_input(array('name'=>'btnsubmit','id'=>'btnsubmit','class'=>'button','type'=>'submit','value'=>'I agree')); ?>
				</div>
        <?php echo form_close(); ?>  
</div>
<?php } ?>
<!--End Terms and conditions Popup-->

<!--Welcome video Popup-->

<?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'popupclicked' ) ) {
	
	$get_sessionvalue = $this->session->all_userdata();
	$get_sessionvalue['youg_admin']['logcount'] = $this->session->userdata['youg_admin']['logcount']+1;
	$this->session->set_userdata($get_sessionvalue);
	 ?>
<style>
.welcomevideo
{
padding-left: 44px;
padding-top: 3px;
}
.closebtn
{
  margin-left: 97%;
  cursor:pointer;
}
</style>
<script type="text/javascript">
function show_popup()
{
  document.getElementById('popup').style.display = 'block'; 
}
window.onload = show_popup;
function closepopup()
{
	$('.popupclose').css("display","none");
	$('.black_overlay').css("display","none");
	window.location = "<?php echo site_url('dashboard');?>";
}
</script>

<?php 
    $ytarray=explode("/", $show_welcome_video[0]['file']);
	$ytendstring=end($ytarray);
	$ytendarray=explode("?v=", $ytendstring);
	$ytendstring=end($ytendarray);
	$ytendarray=explode("&", $ytendstring);
	$ytcode=$ytendarray[0];
?>
<div class="black_overlay" id="black_overlay"></div>
<div id="popup" class="popupclose">
	<div class="closebtn" id="closebtn" onclick="return closepopup()">X</div>
    <div><iframe id="video" class="welcomevideo" width="420" height="315" src="//www.youtube.com/embed/<?php echo $ytcode;?>?rel=0" frameborder="0" allowfullscreen></iframe></div> 
</div>

<?php } ?>
<!--End Welcome video Popup-->


<div id="content"> 
  
  <!-- breadcrumbs -->
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard'); ?>" title="Dashboard">Dashboard</a></li>
    </ul>
  </div>
  <!-- /breadcrumbs --> 
  
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span>Dashboard</span></h2>
    </div>
    <div class="box-content" style="height:auto;">
      <ul class="icon_list">
        <li> <a href="<?php echo site_url('company/edit');?>" title="Profile"> <img src="images/company.jpeg" alt="Profile" title="Profile">
          <p>Profile</p>
          </a> </li>
        <li> <a href="<?php echo site_url('gallery');?>" title="Galleries"> <img src="images/gallery.jpeg" alt="gallery" title="Galleries">
          <p>Galleries</p>
          </a> </li>
        <li> <a href="<?php echo site_url('video');?>" title="Videos"> <img src="images/video.jpeg" alt="Videos" title="Videos">
          <p>Videos</p>
          </a> </li>
        <li> <a href="<?php echo site_url('sem');?>" title="Social Media"> <img src="images/sem.jpg" alt="Social Media" title="Social Media">
          <p>Social Media</p>
          </a> </li>
        <li> <a href="<?php echo site_url('seo');?>" title="SEO"> <img src="images/seo.jpg" alt="SEO" title="SEO">
          <p>SEO</p>
          </a> </li>
        <li> <a href="<?php echo site_url('review');?>" title="Business Reviews"> <img src="images/review.jpg" alt="Business Reviews" title="Business Reviews">
          <p>Business Reviews</p>
          </a> </li>
          <li> <a href="<?php echo site_url('elite');?>" title="Elite Members Status"> <img src="images/member.png" alt="Elite Members Status" title="Elite Members Status">
          <p>Elite Members Status</p>
          </a> </li>
          <li> <a href="<?php echo site_url('elite/update');?>" title="Update Payment Information"> <img src="images/payment_icon.png" alt="Update Payment Information" title="Update Payment Information">
          <p>Update Payment Information</p>
          </a> </li>
          <li> <a href="<?php echo site_url('pressrelease');?>" title="Press Releases"> <img src="images/press.png" alt="Pressrelease" title="Press Releases">
          <p>Press Releases</p>
          </a> </li>
          <li> <a href="<?php echo site_url('pdf');?>" title="Menu/Catalogs Upload"> <img src="images/pdf.png" alt="Menu/Catalogs Upload" title="Menu/Catalogs Upload">
          <p>Menu/Catalogs Upload</p>
          </a> </li>
          <li> <a href="<?php echo site_url('coupon');?>" title="Coupons"> <img src="images/coupon.png" alt="Coupons" title="Coupons">
          <p>Coupons</p>
          </a> </li>
    
		<?php $siteid = $this->session->userdata['siteid'];?>
		<?php if($siteid!='all'){ ?>
		<li>
		<a href="<?php echo site_url('widget');?>" title="Embed Widget"><img src="images/widget.png" alt="Widgets" title="Embed Widget">
			  <p>Embed Widget</p>
			  </a>
		</li>
		<?php } ?>
	
		<li> <a href="<?php echo site_url('buyer');?>" title="Buyer Protection Badge"> <img src="images/BuyersProtection_Badge.png" alt="Buyer Protection Badge" title="Buyer Protection Badge">
          <p>Buyer Protection Badge</p>
          </a> </li>
		<li> <a href="<?php echo site_url('tutorial');?>" title="Tutorials"> <img src="images/tutorial.png" alt="Tutorials" title="Tutorials">
          <p>Tutorials</p>
          </a> </li>
		<li> <a href="<?php echo site_url('timing');?>" title="Hours Of Operation"> <img src="images/timing.png" alt="Hours Of Operation" title="Hours Of Operation">
          <p>Hours Of Operation</p>
          </a> </li>
          <li> <a href="<?php echo site_url('badge');?>" title="Embed YGR Seal"> <img src="/images/badge.png" alt="Embed YGR Seal" title="Embed YGR Seal">
			<p>Embed YGR Seal</p>
          </a> </li>
      </ul>
     
       <?php if(count($checksem) > 0) { ?>
       <?php for($i=0;$i<=count($checksem);$i++) { 
			
				$url= $checksem[$i]['url'];
				$parsed_url=parse_url($url);
				$sub_folder = explode('/',$parsed_url['path']);
				$domain=$parsed_url['scheme'].'://'.$parsed_url['host'];
				$folder="";
				$a=array_filter($sub_folder);
				if(!empty($a)){
				  $check[]=$a;
			    }
			}
		?>	
        <?php if(count($check)==0) { ?>
        <div class = "review_para">Note: Please update your social media account by clicking the Social Media tab in the left menu. You can add URL to the social media account and also can enable it, So that it can be viewed at the front end of the Profile page in YouGotRated.com website(show publicly in YouGotRated).</div>
        <?php } ?>
      <?php } ?>
    </div>
  </div>
  <!-- /box --> 
  
</div>
<!-- /#content --> 

<!-- #sidebar -->
<?php include('leftmenu.php'); ?>
<!-- /#sidebar --> 

<!-- #footer --> 
<?php echo $footer; ?>
