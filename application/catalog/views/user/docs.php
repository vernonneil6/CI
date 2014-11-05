<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="<?php echo $keywords?>">
	<meta name="description" content="<?php echo $description?>">
	<base href="<?php echo base_url();?>" />
	<title>All Documents</title>


    <!-- Core CSS - Include with every page -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" />
    <!-- SB Admin CSS - Include with every page -->
    <link href="css/crypto_currency.css" rel="stylesheet">
    <script>!window.jQuery && document.write(unescape('%3Cscript src="js/minified/jquery-1.9.1.min.js"%3E%3C/script%3E'))</script>
	
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/moment.js"></script> 
	 
    
    <script type="text/javascript">
		$(function(){
		  $('#loginform').submit(function(e){
			//return false;
		  });
		  
		  $('#modaltrigger').leanModal({ top: 110, overlay: 0.45, closeButton: ".hidemodal" });
		});
	</script>
    <script>
		(function($){
			$(window).load(function(){
				
				
				/* custom scrollbar fn call */
				$(".content_2").mCustomScrollbar({
					scrollButtons:{
						enable:true
					}
				})
				
			});
		})(jQuery);
	</script>
</head>

	<body>
<?php echo $header;?>


<!-- /.header-top-links -->
<div class="menu_wrapper">
      <div id="wrapper">
    <div class="menu">
          <div class="navbar-default" role="navigation">
        <ul class="nav" id="side-menu">
              <li> <a href="<?php echo base_url();?>" title="home">Home</a> </li>
              <li> <a href="#" title="trade">Trade</a> </li>
              <li> <a href="page/About-Us" title="about us">About us</a> </li>
              <li> <a href="page/Support" title="support ">support </a> </li>
              <li> <a href="faq" title="faq">faq</a> </li>
            </ul>
      </div>
        </div>
  </div>
    </div>
<div class="section_wrapper"> 
      <div id="wrapper"> 
    <!-- /.row --><?php if( $this->session->flashdata('success') ) { ?>
        <div class="alert alert-success col-sm-6" style=" margin-left: 7%;
    margin-right: 7%;margin-top:10px !important;
    width: 88%;"> <?php echo $this->session->flashdata('success'); ?> <a href="#" class="close" data-dismiss="alert">&times;</a> </div>
        <?php } ?>
        <?php if( $this->session->flashdata('error') ) { ?>
        <div class="alert alert-danger col-sm-6" style=" margin-left: 7%;
    margin-right: 7%;margin-top:10px !important;
    width: 88%;"> <?php echo $this->session->flashdata('error'); ?> <a href="#" class="close" data-dismiss="alert">&times;</a> </div>
        <?php } ?>
    <div class="signup_part" style="min-height:220px;"> 
          <div class="user">
        <h2 class="fund_head">All Document</h2>
         <?php if(count($docs)<3){?>
        <a href="user/upload" style="  height: 31px;
    margin-top: -48px;
    padding-top: 9px;
    width: 100px;" class="buy">Add New</a>
        <?php }?> 
    
     <table  width="90%" cellpadding="0" cellspacing="0" class="table" >
     <tr>
     
     </tr>
     <tr>
     <th>Title</th>
     <th>Varification</th>
     <th>Reminder</th>
     </tr>
     <?php if(count($docs)>0){?>
     <?php for($i=0;$i<count($docs);$i++){?>
     <tr>
     	<td><a href="user/document/<?php echo base64_encode($docs[$i]['userid']);?>/<?php echo base64_encode($docs[$i]['userdocumentid']);?>" title="Click to download"><?php echo $docs[$i]['title'];?></a></td>
     	<td><?php 
		if($docs[$i]['isvarified']=='Yes')
		{
			?>
			<span style="color:#090;">DONE</span>
			<?php
		}
		else
		{
		?><span style="color:#F00;">PENDING</span>
        <?php
		}
		
		?></td>
        <td><?php 
		if($docs[$i]['remindermail']=='Yes')
		{
			?>
			<span class="subscribe_btn" style="float:left" >Sent</span>
			<?php
		}
		else
		{
		?>
        <?php   $date1 = date("Y-m-d H:i:s");
				$date2 = $docs[$i]['createddate'];
				$diff = abs(strtotime($date2) - strtotime($date1));
				$years = floor($diff / (365*60*60*24));
				$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
				$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
						
				if($days >1)			
				{?>
        <span style="color:#090;">
        <a href="<?php echo site_url('user/sendermind/'.base64_encode($docs[$i]['userid']).'/'.base64_encode($docs[$i]['userdocumentid']));?>" title="Send reminder to verify this document" onClick="return confirm('Are you sure to send reminder?');" class="subscribe_btn" style="float:left" >Send</a>
        </span>
        <?php
		}else
		{
		echo "---";
		} }
		
		?></td>
     </tr>
     <?php }?>
     <?php }else
	 {
		 ?>
	 <tr><td colspan="3">
     <div class="alert alert-info col-sm-6" style=" margin-left: 0%;
    margin-right: 0%;
    width: 99%;">No Document Found.<a href="#" class="close" data-dismiss="alert">&times;</a> </div></td>
    </tr>
    <?php
	 }
	 
	 ?>
     
 </table>

     
      </div>
      
        </div>
        <div class="signup_part">  
      <div class="user">
        <h2 class="fund_head">Mobile Verification</h2>
        <!--We have send you an OTP code to your email.Enter OTP code and new password here-->
        <fieldset>
          <div class="alert alert-danger col-sm-6 errormsg" id="otpcodeerror">OTP code is required.</div>
          <div class="alert alert-danger col-sm-6 errormsg" id="wrongotpcodeerror">OTP code is Wrong.</div>
        </fieldset>
        <?php if($user[0]['contactno']=='')
		{
		?><table class="table" cellpadding="0" cellspacing="0">
        <tr>
        	<td>
           Please Update Your mobile Number <a href='user/edit' style="color:#2F4354"><strong>Here</strong></a>
            </td>
        </tr>
        
       
        </table>
        <?php
		}
		else{
       if($user[0]['mobnumverified']=='No'){?>
        <form action="user/update" id="frmnewpass" method="post">
         <fieldset>
            Your Mobile Number is
            <?php echo "******".substr($user[0]['contactno'],9,12);?>
          </fieldset>
          <fieldset>
            <label>OTP code</label>
            <input type="text" autofocus="" autocomplete="off" tabindex="1" placeholder="Enter your OTP code" class="" id="otpcode" name="otpcode" maxlength="100">
          </fieldset>
          
          <fieldset>
            <div class="btn_panel" style="float:none !important;margin-left:350px;width:400px;">
              <button type="button" name="SendCodebtn" id="SendCodebtn" class="subscribe_btn" value="Send Code" title="Send Code" tabindex="3" style="float:none !important;" onClick="sendcode();">Send Code</button>
              <button type="submit" name="Verifybtn" id="Verifybtn" class="subscribe_btn" value="Verify" title="Verify" tabindex="3" style="float:none !important;">Verify</button>
            </div>
          </fieldset>
        </form>
        <?php } else {?>
       
       <?php /*?> <h4>Your Mobile Number is already Verified</h4><br><?php */?>
        <table class="table" cellpadding="0" cellspacing="0">
        <tr>
        	<td>
            Mobile No:
            </td>
            <td>
            Status
            </td>
        </tr>
        <tr>
        	<td>
           <?php echo $user[0]['contactno'];?>
            </td>
            <td>
             <?php echo $user[0]['mobnumverified'];?>
            </td>
        </tr>
       
        </table>

       <?php } }?>
      </div>
    </div>
  </div>
    </div>
    <br>
<br>

    
   <script type="text/javascript">
          function sendcode()
          {
              $.ajax({
               type 				: "POST",
               url 				: "<?php echo site_url('user/send'); ?>",
               data				:	{},
               dataType 			: "html",
               cache			    : false,
               success			: function(data){
				   
									alert("We have send you an OTP code to your registered mobile number *****"+data+" and verify your mobile");
							   		//return false;
                                                                                                      }
                  });
              }
       </script> <script type="text/javascript" language="javascript">
              function trim(stringToTrim) {
                  return stringToTrim.replace(/^\s+|\s+$/g,"");
              }
              	  $(document).ready(function() {
                  
				  $("#Verifybtn").click(function () {
              
				 	if( trim($("#otpcode").val()) == "" )
					{
						$("#otpcodeerror").show();
						$("#otpcode").val('').focus();
						return false;
					}
					else
					{
						$("#otpcodeerror").hide();
					}
					 					
					$("#frmnewpass").submit();
                          
                  });
              

              });
          </script>
<?php echo $footer;?>

</body>
</html>
