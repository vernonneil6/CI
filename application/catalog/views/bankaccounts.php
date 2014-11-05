<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="<?php echo $keywords?>">
	<meta name="description" content="<?php echo $description?>">
	<base href="<?php echo base_url();?>" />
	<title>All Bank Accounts</title>

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
    <!-- /.row -->
    <?php if( $this->session->flashdata('success') ) { ?>
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
        <h2 class="fund_head">All Accounts</h2>
        <a href="user/add_account" style="  height: 31px;
    margin-top: -48px;
    padding-top: 9px;
    width: 100px;" class="buy">Add New</a>
        <table width="90%" cellpadding="0" cellspacing="0" class="table" >
              <tr>
            <th>Bank Name</th>
             <th>Acc Number</th>
            <th>Address</th>
            </tr>
              <?php if(count($bankaccounts)>0){?>
              <?php for($i=0;$i<count($bankaccounts);$i++){?>
              <tr>
            <td><?php echo $bankaccounts[$i]['bank_name'];?></td>
            <td><?php echo $bankaccounts[$i]['bank_address'];?></td>
            <td><?php echo ($bankaccounts[$i]['bank_acc_number']);?></td>
            <td><a href="<?php echo site_url('user/deleteacc/'.base64_encode($bankaccounts[$i]['user_bank_detail_id']).'/'.base64_encode($bankaccounts[$i]['userid']));?>" title="Delete" class="" onClick="return confirm('Are you sure to Delete this account?');"><img src="images/delete.png" width="16" height="16" /></a>
            </td>
       </td>
            
          </tr>
              <?php }?>
              <?php }else
	 {
		 ?>
              <tr>
            <td colspan="6"><div class="alert alert-info col-sm-6" style=" margin-left: 0%;
    margin-right: 0%;
    width: 99%;">No Accounts Found.<a href="#" class="close" data-dismiss="alert">&times;</a> </div>
    
    </td>
          </tr>
              <?php
	 }
	 
	 ?>
            </table>
      </div>
        </div>
  </div>
    </div>
<br>
<br>
<script type="text/javascript">
function verifiy(id)
	{
            $("#cardid").val(id);
			  $.ajax({
               type 			: "POST",
               url 				: "<?php echo site_url('user/send1'); ?>",
               data				:	{},
               dataType 		: "json",
               cache			: false,
               success			: function(data){
				   					//alert(data);
									$("#oldotp").val(data.msgcode);
									
									alert("We have send you an OTP code to your registered mobile number *****"+data.msgnumber+" and verify your mobile");
							   		//return false;
                                                                                                      }
                  });
              
		$('#verifiyModal').modal();
	}
	
          
       </script> 
<?php echo $footer;?><div class="modal fade" id="verifiyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	 <a href="javascript:void(0);" class="close" onClick="hidemodal1();">&times;</a>
        <h4 class="modal-title" id="myModalLabel">Enter OTP Code</h4>
      </div>
      <div class="modal-body">
      
        <script type="text/javascript" language="javascript">
		function hidemodal1()
{
	 $('#verifiyModal').modal('hide');
}
                function my() {
              
				 	  if( $("#cardotp").val() == "" )
					  {
					  	alert("please enter otp code");
						$("#cardotp").val('').focus();
						return false;
					  }
					  
					  if( $("#cardotp").val() != $("#oldotp").val() )
					  {
					  	alert("you have entered wrong otp code");
						$("#cardotp").val('').focus();
						return false;
					  }
					 $("#frmedit").submit();
                          
                
              
              }
          </script>
     <form action="user/update" id="frmedit" method="post" >
     <label for="otplabel">OTP Code:</label>
      <input type="hidden" name="oldotp" id="oldotp">
      <input type="hidden" name="cardid" id="cardid">
      <input type="text" style="width:200px" name="cardotp" id="cardotp" class="txtfield checkno" tabindex="1" maxlength="30" required>
      </div>
      <div class="modal-footer">
        <input type="button" name="otpverfifybtn" id="otpverfifybtn"  class="subscribe_btn" value="Submit" onClick="my();" />
        
      </div>
     </form>
    </div>
  </div>
</div>
</body>
</html>
