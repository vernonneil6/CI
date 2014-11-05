<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="<?php echo $keywords?>">
	<meta name="description" content="<?php echo $description?>">
	<base href="<?php echo base_url();?>" />
	<title>All Currencies</title>

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
	<script type="text/javascript">
	$(document).ready(function() {	
	 $(".checkno").on("keypress keyup blur",function (event) {

    if(event.which == 8 || event.which == 0){
        return true;
    }
    if(event.which < 46 || event.which > 59) {
        return false;
        //event.preventDefault();
    } // prevent if not number/dot
    
    if(event.which == 46 && $(this).val().indexOf('.') != -1) {
        return false;
        //event.preventDefault();
    } // prevent if already dot
});});

	</script>
	</head>

	<body onLoad="btcadd(),update_all_balance();">
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
    <div class="section">
          <?php /*?> <div class="code_img"> <img src="images/code_image.png" alt="" title="code"> </div>
      <div class="fund_left">
        <h2 class="fund_head">Fund BTC Account:</h2>
        <p class="fund_tag">Send your Bitcoins to this Address</p>
      </div>
      <div class="fund_right">
        <p class="fund_notic">It may take up to few minutes for the Bitcoin network to confirm the transaction. We require only 3 network confirmations.</p>
      </div>
      <div class="serial_part">18eQACr2RqSLEKNKjW3sBKCJY2MDNFKUPP</div><?php */?>
        <p align="right" style="margin-right:25px;"><a href="user" title="View History">View History</a></p>
        <div class="balance_table">
        <h2 class="fund_head">Finance</h2>
        <div class="btable_head">
              <div class="head_balance">Balance</div>
              <div class="head_order">In Orders</div>
              <div class="head_total">Status</div>
              <div class="head_total" style="width: 200px;">Balance After Execution</div>
            </div>
        <?php if(count($balance)>0){
			for($i=0;$i<count($balance);$i++){
				$totalbuyorders=$this->users->get_totaltrans_orders($balance[$i]['currencycode']);
				
			?>
        <div class="btable_body1">
              <div class="body_icon"><img src="images/btc.png" alt="" title="btc"></div>
              <div class="body_balance"><?php echo $balance[$i]['currencycode'];?> : 
			  <?php if($balance[$i]['currencycode']=='BTC'){?>
              
              <?php $userid = $this->session->userdata['cc_user']['userid'];
					$btcadd = $this->users->get_user_address($userid,'btc');
				
			  ?>
              <script language="javascript" type="application/javascript">
			  <?php if(strlen($btcadd)>5){?>
			  function btcadd(){
			  $.ajax({
                      type 				: "POST",
                      url 					: "user/getbtcaddr/<?php echo $btcadd; ?>",
                      data				:	{},
                      dataType 			: "json",
                     // cache			   	: false,
                      success			: function(data){
						  //var data1=$.parseJSON(data);
                         //alert(data.balance);
						// alert(data.balance);
						 $("#btctotalbal").empty();
						 $("#btctotalbal").append(data.balance);
						 $("#btctotalbal1").empty();
						 $("#btctotalbal1").append(data.balance);
						 $("#btcstatus").empty();
						 $("#btcstatus").append(data.status);
                                                      
                                                  }
                  });
			  }
			  <?php }else{
				?>
				
				function btcadd(){
					$('#demodiv').empty();
					$('#demodiv').load('code/btc');
					}
					 $("#btctotalbal").empty();
					 $("#btctotalbal").append(0);
					 $("#btctotalbal1").empty();
					 $("#btctotalbal1").append(0);
				<?php  } ?>
            
			  </script>
				 
              <span id="btctotalbal"></span>
			  <?php
			  }else{?>
              
              <span id="<?php echo $balance[$i]['currencycode'];?>_Balance">
			  <?php echo round($balance[$i]['total_balance'],4);?>
              </span>
              <?php } ?>
              </div>
              <div class="body_orders" id="<?php echo $balance[$i]['currencycode'];?>_In_Orders">
              
               <?php echo round($totalbuyorders,4);?></div>
               <div class="body_orders">
               <?php if($balance[$i]['currencycode']=='BTC'){?>
               <span id="btcstatus"></span>
               <?php }else
			   { 
			   echo "---";
			   }?>
               </div>
              <div class="body_total">
			  <?php if($balance[$i]['currencycode']=='BTC'){?>
               <span id="btctotalbal1"></span>
               <?php }else{?>
			  <span id="<?php echo $balance[$i]['currencycode'];?>Balance_After_Execution"><?php echo round(($finalbal=$balance[$i]['total_balance']-$totalbuyorders),4);?>
              </span>
              <?php }?>
              </div>
              <?php $checkuserdocument=$this->users->check_document($balance[$i]['userid']);
	   		 $checkmobilenumber=$this->users->check_mobile($balance[$i]['userid']);
	   		if(count($checkuserdocument)>0 && count($checkmobilenumber)>0)
			{
				
	   ?>
	   <?php if($balance[$i]['currencytype']=='CryptoCurrency')
			 {
				 ?>
              <div class="body_button"><a href="javascript:void(0);" onClick="openpop('<?php echo strtolower($balance[$i]['currencycode']);?>')" title="Deposite">Deposit</a></div>
              <div class="body_button"><a href="javascript:void(0);" onClick="return withdrawal('<?php echo $balance[$i]['currencycode'];?>','<?php echo $balance[$i]['total_balance'];?>', '<?php echo $balance[$i]['currencyid'];?>',<?php echo $balance[$i]['balanceid'];?>,'<?php echo $balance[$i]['currencytype'];?>');" title="Withdrawal">Withdrawal</a></div>
              <?php  
			 }else{?>
              <div class="body_button"><a href="javascript:void(0);" onClick="return deposit(<?php echo $balance[$i]['balanceid'];?>,<?php echo $balance[$i]['total_balance'];?>,'<?php echo $balance[$i]['currencytype'];?>','<?php echo $balance[$i]['currencyid'];?>'); "title="Deposite">Deposit</a></div>
              <div class="body_button"><a href="javascript:void(0);" onClick="return withdrawal('<?php echo $balance[$i]['currencycode'];?>','<?php echo $balance[$i]['total_balance'];?>', '<?php echo $balance[$i]['currencyid'];?>',<?php echo $balance[$i]['balanceid'];?>,'<?php echo $balance[$i]['currencytype'];?>');" title="Withdrawal">Withdrawal</a></div>
              <?php }}
			else if(count($checkuserdocument)==0 && count($checkmobilenumber)==0)
			{
				if($balance[$i]['currencytype']=='CryptoCurrency'){
				?>
              <div class="body_button"><a href="javascript:void(0);" onClick="openpop('<?php echo strtolower($balance[$i]['currencycode']);?>')" title="Deposite">Deposit</a></div>
              <div class="body_button"><a href="javascript:void(0);" onClick="return withdrawal('<?php echo $balance[$i]['currencycode'];?>','<?php echo $balance[$i]['total_balance'];?>', '<?php echo $balance[$i]['currencyid'];?>',<?php echo $balance[$i]['balanceid'];?>,'<?php echo $balance[$i]['currencytype'];?>'); " title="Withdrawal">Withdrawal</a></div>
              <?php }else
			  {
			  ?>
             <div class="body_button"><a href="javascript:alert('Please verify your document and mobile to Deposit');" title="Deposit">Deposit</a></div>
              <div class="body_button"><a href="javascript:alert('Please verify your document and mobile to Withdrawal');" title="Withdrawal">Withdrawal</a></div>
              
			  <?php
			  
			  }
			  
			  } else if(count($checkuserdocument)==0 && count($checkmobilenumber)>0){?>
              <?php if($balance[$i]['currencytype']=='CryptoCurrency'){?>
               <div class="body_button"><a href="javascript:void(0);" onClick="openpop('<?php echo strtolower($balance[$i]['currencycode']);?>')" title="Deposite">Deposit</a></div>
               <div class="body_button"><a href="javascript:alert('Please verify your document to Withdrawal');" title="Withdrawal">Withdrawal</a></div>
              <?php } else {?>
             <div class="body_button"><a href="javascript:void(0);" onClick="return deposit(<?php echo $balance[$i]['balanceid'];?>,<?php echo $balance[$i]['total_balance'];?>,'<?php echo $balance[$i]['currencytype'];?>','<?php echo $balance[$i]['currencyid'];?>'); "title="Deposite">Deposit</a></div>
              <div class="body_button"><a href="javascript:alert('Please verify your document to Withdrawal');" title="Withdrawal">Withdrawal</a></div>
              <?php }}?>
            </div>
        <?php }}?>
      </div>
        </div>
  </div>
    </div>
<div class="modal fade" id="withdrawalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header"> <a href="javascript:void(0);"  onClick="hidemodal1();" class="close" >&times;</a>
        <h4 class="modal-title" id="myModalLabel">Withdrawal <span class="currencycode"></span></h4>
      </div>
          <div class="modal-body">
          <label id="label_div" style="display:none;">
          <div class="alert alert-danger col-sm-6" style="margin-left: 3%;
    margin-right: 3%;width: 94%;padding:10px !important;">
        <div id="error_div"></div>
        <a href="#" class="close" data-dismiss="alert">&times;</a> </div>
          </label>
          <form method="post" action="user/withdrawalfunds">
        <table cellpadding="4" cellspacing="5">
              <tr class="displaywid1">
            <td><label>Available funds:</label></td>
            <td>     <span id="availbal" style="font-weight:bold"></span></td>
            <td class="currencycode"></td>
          </tr>
              <tr class="displaywid">
            <td><label>Expended limit:</label></td>
                 <td> <span id="totalbals" style="font-weight:bold"></span></td>
            <td class=""></td>
          </tr>
              <tr class="displaywid">
            <td><label for="otplabel">Address:</label></td>
            <td><input type="text" name="eaddress" id="eaddress"/></td>
          </tr>
              <tr class="displaywid1">
            <td><label for="otplabel">Amount to withdrawal:</label></td>
            <td><input type="text" name="amountw" id="amountw" class="checkno" maxlength="15"/>
                  <br></td>
            <td class="currencycode"></td>
          </tr>
              <?php /*?>  <tr>
    <td><label for="otplabel">You will receive:</label></td>
    <td><input type="hidden"  readonly name="availablefunds" id="availablefunds"/>
      <br></td>
      <td class="currencycode"></td>
  </tr><?php */?>
            </table>
        </div>
        <div class="modal-footer">
        <input type="submit" name="withdrawal" id="withdrawal"  class="subscribe_btn" value="Withdrawal" />
        <input type="hidden" name="balanceid" id="balanceid">
        <input type="hidden" name="currencytype1" id="currencytype1">
        <input type="hidden" name="currencyid" id="currencyid">
        <input type="hidden"  name="currencycode" id="currencycode1">
        <input type="hidden"  readonly name="availablefunds" id="availablefunds"/>
      </form>
        </div>
  </div>
    </div>
</div>
<div class="modal fade" id="depositModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header"> <a href="javascript:void(0);" class="close" onClick="hidemodal2();">&times;</a>
        <h4 class="modal-title" id="myModalLabel">Deposit</h4>
      </div>
          <div class="modal-body">
        <label id="label_div" style="display:none;">
        <div class="alert alert-danger col-sm-6" style="margin-left: 3%;
    margin-right: 3%;width: 94%;padding:10px !important;">
              <div id="error_div"></div>
              <a href="#" class="close" data-dismiss="alert">&times;</a> </div>
        </label>
        <label>Deposit Type</label>
        <br>
        <div class="tys" style="float:left !important;">
              <select name="deposittype" id="deposittype"  style="float:left !important;width:200px;" onChange="showdepositdata(this.value);"  >
            <option value="">--Select--</option>
            <?php $carddata=$this->users->get_creditcards_byuserid($this->session->userdata['cc_user']['userid']);
		if(count($carddata)>0){?>
            <option value="CreditCard">Credit Card</option>
            <?php }?>
            <option value="WireTransfer">Wire Transfer</option>
          </select>
            </div>
        <br>
        <div id="showcreditcard" style="display:none;margin-top: 20px;">
              <div id="oldcreditcard">
            <?php $carddata=$this->users->get_creditcards_byuserid($this->session->userdata['cc_user']['userid']);
		if(count($carddata)>0)
		{?>
            <label for="otplabel">Choose Credit Card
            <a href="user/add_card" title="Add New Card" style="text-decoration:underline;">Add New Card</a>
            </label>
            
            <br>
            <div class="tys" style="float:left !important;">
                  <select name="creditcardno" id="creditcardno"  style="float:left !important;width:200px" >
                <option value="">--Select--</option>
                <?php for($i=0;$i<count($carddata);$i++){?>
                <?php if($carddata[$i]['status']=='Yes' && $carddata[$i]['verified']=='Yes'){?>
                <option value="<?php echo $carddata[$i]['creditcardid'];?>"><?php echo $carddata[$i]['card_name'];?>&nbsp;(<?php echo $carddata[$i]['card_type'];?>)</option>
                <?php }}?>
              </select>
                </div>
            <?php }?>
            <input name="creditcardno" id="creditcardno" type="hidden" value="0" />
          </div>
              <br>
              <br>
              <div id="newcreditcard"> </div>
            </div>
        <div id="showwiretransfer" style="display:none; margin-top: 20px;">
              <div id="newdiv">Address: State Bank Of USA<br>
            798/ PLAN Street Na <br>
            Account Number: 787818778985 </div>
              <br>
              please use this Code for Wire Transfer Motive
              <?php $userdata=$this->users->get_user_byid($this->session->userdata['cc_user']['userid']); echo $userdata[0]['uniqueid'];?>
            </div>
        <?php /*?>  <?php $bankdetails=$this->users->get_wiretransferdetails();
			if(!empty($bankdetails)){?>
          <address>
          Name:<?php echo $bankdetails[0]['bank_name'];?><br>
          Address:<?php echo $bankdetails[0]['bank_address'];?><br>
          Account Number:<?php echo $bankdetails[0]['bank_acc_number'];?><br>
		please use this Code for Wire Transfer Motive <strong><?php $userdata=$this->users->get_user_byid($this->session->userdata['cc_user']['userid']); echo $userdata[0]['uniqueid'];?></strong>
         <?php } else {?>
         No Bank Details Available
         <?php }?><?php */?>
        <br>
        <br>
        <label for="otplabel">Deposit Amount:</label>
        <input type="hidden" name="balanceid1" id="balanceid1">
        <input type="hidden" name="availbal1" id="availbal1">
        <input type="hidden"  name="currencycode" id="currencycode">
        <input type="text" style="width:200px" name="depamnt" id="depamnt" class="txtfield checkno" tabindex="1" maxlength="15">
      </div>
          <div class="modal-footer">
        <input type="button" name="depamntbtn" id="depamntbtn"  class="subscribe_btn" value="Deposit" />
      </div>
        </div>
  </div>
    </div>
<div class="modal fade" id="messagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header"> <a href="javascript:void(0);" class="close" onClick="hidemodal3();">&times;</a>
        <h4 class="modal-title" id="myModalLabel">Send Message</h4>
      </div>
          <div class="modal-body">
          <label id="label_div" style="display:none;">
          <div class="alert alert-danger col-sm-6" style="margin-left: 3%;
    margin-right: 3%;width: 94%;padding:10px !important;">
        <div id="error_div"></div>
        <a href="#" class="close" data-dismiss="alert">&times;</a> </div>
          </label>
          <form id="messagefrm" name="messagefrm" method="post" action="user/sendmessage">
        <label for="otplabel">Message</label>
        <textarea name="messagebody" id="messagebody" rows="6" cols="25"></textarea>
        <input name="chatid" id="chatid" type="hidden" >
        </div>
        <div class="modal-footer">
              <input type="button" name="sendmessage" id="sendmessage"  class="subscribe_btn" value="Send" />
            </div>
      </form>
        </div>
  </div>
    </div>
    <div id="demodiv" style="display:none">
    
    </div>
<script>

function showdepositdata(data)
{
	if(data=='CreditCard')
	{
	$('#showwiretransfer').hide();
	$('#showcreditcard').show();	
	}
	else
	{
	$('#showwiretransfer').show();
	$('#showcreditcard').hide();		
	}
}
function hidemodal1()
{
	 $('#withdrawalModal').modal('hide');
}
function hidemodal2()
{
	 //$('#depositModal').modal('hide');
	 location.reload();
}
function hidemodal3()
{
	 $('#messagemodal').modal('hide');
}
	function withdrawal(currencytype,funds,currencyid,balanceid,type)
	{
		$('.currencycode').html('&nbsp;&nbsp;'+currencytype);
		$('#currencycode1').val(currencytype);
		$('#availbal').html(' '+funds);
		$('#balanceid').val(balanceid);
		$('#totalbals').html(' &nbsp;3&nbsp;'+currencytype);
		$('#currencytype1').val(type);
	
		if(type=='RealMoney')
		{
			$('.displaywid').hide();
		}
		else
		{
			$('.displaywid').show();
		}
		
		$('#currencyid').val(currencyid);
		$('#availablefunds').val(funds);
		$('#withdrawalModal').modal();
	}
	
	function deposit(balanceid,funds,currencytype,currencyid)
	{
	$('#balanceid1').val(balanceid);	
	$('#availbal1').val(funds);
	$('#currencycode').val(currencytype);
	$('#newdiv').empty();
	$.ajax({
		url:"user/get_wiretransferdata/",
		data:{currencyid:currencyid},
		type:"post",
		
		success:function(d)
		{
		
		$('#newdiv').html(d);				
		
		
		}
		});
	$('#depositModal').modal();
	}
	
	
	
	function showmsgbox(messageid)
	{
		$('#chatid').val(messageid);
		$('#messagemodal').modal();
	}
	$('#sendmessage').click(function()
	{
		
		var messagebody=document.getElementById('messagebody').value;
		var chatid=document.getElementById('chatid').value;
		if(messagebody!='')
		{
		$.ajax({
			url:"user/sendmessage",
			data:{messagebody:messagebody,chatid:chatid},
			type:"post",
			success:function(data)
			{
				if(data==1)
				{
					alert("Message Succesfully Sent");
					$('#messagemodal').modal('hide');
					
				}
				else
				{
					return false;
				}
			}
						
			});
		}
		else
		{
			alert("Please Input message");
			return false;
		}
	});
	
		$('#depamntbtn').click(function()
	{
		
		var depamnt=document.getElementById('depamnt').value;
		var balid=document.getElementById('balanceid1').value;
		var availbal=document.getElementById('availbal1').value;
	
		var deposittype=document.getElementById('deposittype').value;
		if(document.getElementById('creditcardno').value=='')
		{
			cardno=0;
		}
		else
		{
		 cardno=document.getElementById('creditcardno').value;
		}
		if(deposittype=='')
		{
			alert('Please Select Deposit Method');
			return false;
		}
		if(cardno=='' && deposittype=='CreditCard')
		{
			alert('Please Your Card to Deposit');
			
			return false;
		}
		if(deposittype=='WireTransfer')
		{
			if($('#newdiv').html()=='No Bank Details Available' || $('#newdiv').html()=='')
			{
				alert('Sorry you Can not Deposit Amount right now');
				$('#depositModal').modal('hide');
				return false;	
				
			}
		}
		if(depamnt!='')
		{
		$.ajax({
			url:"user/depositamt",
			data:{depamnt:depamnt,balid:balid,availbal:availbal,cardno:cardno,deposittype:deposittype},
			type:"post",
			success:function(data)
			{
				if(data==1)
				{
					alert("Deposit request has been sent for approval");
					$('#depositModal').modal('hide');
					//location.reload();
					
				}
				else if(data==3)
				{
					alert("You Have already requested for Deposit so Please wait untill it gets completed");
					$('#depositModal').modal('hide');
				}
				else if(data==2)
				{
					alert("You Can Request <?php echo $maxamount=$this->common->get_setting_value(24);?> Amount to Deposit When you are using Credit Card First time");
					$('#depositModal').modal('hide');
				}
				else
				{
					return false;
				}
			}
						
			});
		}
		else
		{
			alert("Please Input Amount");
				return false;
		}
	});
	$('#withdrawal').click(function()
	{
	
		if( $('#currencytype1').val()=='CryptoCurrency')
		{
			if($('#eaddress').val()=='')
			{
				alert("Please Enter Vallet Address");
				return false;
			}
		}
			if($('#amountw').val()=='' || $('#amountw').val()==0 ||isNaN($('#amountw').val()))
			{
				alert("Please Enter Amount");
				$('#amountw').focus();
				return false;
			}
		
		
		
	});
	function markasread(chatid)
	{
		$.ajax({
			url:"user/markasread",
			data:{chatid:chatid},
			type:"post",
			success:function(data)
			{
				if(data==1)
				{
					location.reload();
				}
				else
				{
					return false;
				}
			}
						
			});
		
	}
	
	function openpop(currency)
	{
		$('#demodiv').empty();
		$('#demodiv').load('code/'+currency);
			
		$.ajax({
			url:"user/getaddress",
			data:{address:currency},
			type:"post",
			success:function(data)
			{
				$('#btcaddr').empty();
				$('#fund_id').empty();
				$('#fund_tag').empty();
				
				$('#btcaddr').append(data);
				$('#fund_id').append('Fund&nbsp;'+currency.toUpperCase()+'&nbsp;Account:');
				if(currency=='btc')
				{
					$('#fund_tag').append('Send your Bitcoins to this Address');
				}
				if(currency=='ltc')
				{
					$('#fund_tag').append('Send your Litecoins to this Address');
				}
				if(currency=='doge')
				{
					$('#fund_tag').append('Send your Dogecoins to this Address');
				}
				if(currency=='peer')
				{
					$('#fund_tag').append('Send your Peercoins to this Address');
				}
				
				$('#code_image').attr( "src","https://chart.googleapis.com/chart?chs=160x160&cht=qr&chl="+data+"&choe=UTF-8" );

			}
						
			});
		
		$('#depositModalnew').modal();
			
	
	}
	</script>
    <script>
window.setInterval(function(){
  
  //location.reload();
  btcadd();
  update_all_balance();
  //calling every 15 seconds
}, 10000);
</script>
<script>
function update_all_balance(){
			  $.ajax({
                      type 				: "POST",
                      url 				: "user/all_balance",
                      data				:	{},
                      dataType 			: "json",
                     // cache			   	: false,
                      success			: function(data){
						 //alert(data);
						 total = data['balance'].length;
						 for(var i=0;i<total;i++)
						{
			
			var balanceid = data['balance'][i]['balanceid'];
			var currencyid = data['balance'][i]['currencyid'];
			var total_balance = data['balance'][i]['total_balance'];
			var currencycode = data['balance'][i]['currencycode'];
			var currencytype = data['balance'][i]['currencytype'];
			var totalbuyorders = data['balance'][i]['totalbuyorders'];
			var Balance_After_Execution = data['balance'][i]['Balance_After_Execution'];
			if(totalbuyorders==null)
			{
				total = 0;
			}
			else
			{
				total = totalbuyorders;
			}
			
			//USD
			//USD_In_Orders
			//USD_Balance_After_Execution
			$('#'+currencycode+'_Balance').empty();
			$('#'+currencycode+'_In_Orders').empty();
			$('#'+currencycode+'_Balance_After_Execution').empty();
			
			$('#'+currencycode+'_Balance').append(total_balance);
			$('#'+currencycode+'_In_Orders').append(total);
			$('#'+currencycode+'_Balance_After_Execution').append(Balance_After_Execution);
			
			
			}
						                                                     
                                                  }
                  });
			  }
</script>

<?php echo $footer;?>
<div class="modal fade" id="depositModalnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header"> <a href="javascript:void(0);" class="close" onClick="hidemodal2();">&times;</a>
        <h4 class="modal-title" id="myModalLabel">Deposit</h4>
      </div>
          <div class="modal-body">
        <label id="label_div" style="display:none;">
        <div class="alert alert-danger col-sm-6" style="margin-left: 3%;
    margin-right: 3%;width: 94%;padding:10px !important;">
              <div id="error_div"></div>
              <a href="#" class="close" data-dismiss="alert">&times;</a> </div>
        </label>
        <?php /*?><a href="user/btctrascations" title="View BTC Histroy">View BTC Histroy</a><?php */?>
        <br>
        
        <br>
        <div id="showcreditcard" style="margin-top: 20px;">
                 <div class=""> <img src="" alt="" title="code" id="code_image"> </div>
      <div class="fund_left">
        <h2 class="fund_head" id="fund_id"></h2>
        <p class="fund_tag" id="fund_tag"></p>
      </div>
      
      <div class="fund_notic" id="btcaddr" style="font-weight:bold;"></div>
        <p class="">It may take up to few minutes for the Bitcoin network to confirm the transaction. We require only 3 network confirmations.</p>
              <br>
              <br>
              <div id="newcreditcard"> </div>
            </div>
            <div class="fund_right">
        
      </div>
        
        
        <br>
        <br>
        
      </div>
          
        </div>
  </div>
    </div>
</body>
</html>
