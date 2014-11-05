<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="<?php echo $keywords?>">
	<meta name="description" content="<?php echo $description?>">
	<base href="<?php echo base_url();?>" />
	<title>BTC trancsations</title>

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
    <div class="section">
        
        <div class="balance_table">
        <h2 class="fund_head">&nbsp;BTC Address : <?php echo $btcaddr;?></h2>
        <div class="btable_head">
              <div class="head_balance">Balance</div>
              <div class="head_order">Total trascations</div>
              
            </div>
       <?php 
	   $b = file_get_contents("http://btc.blockr.io/api/v1/address/info/".$btcaddr);
$de = json_decode($b);
$balance = $de->data->balance;
$nb_txs = $de->data->nb_txs;
$first_tx = $de->data->first_tx;
if(count($first_tx)>0)
{
$first_tx_confirmations = $de->data->first_tx->confirmations;
}
$last_tx = $de->data->last_tx;
if(count($last_tx)>0)
{
$last_tx_confirmations = $de->data->last_tx->confirmations;
}
  ?>
        
        <div class="btable_body1">
              <div class="body_icon"><img src="images/btc.png" alt="" title="btc"></div>
              <div class="body_balance"><?php echo $balance;?></div>
              <div class="body_orders"><?php echo $nb_txs;?></div>
              
            
			
            </div>
 <?php
           if(count($first_tx)>0)
{?>
            <div class="btable_body1">
              <div class="body_icon"></div>
              <div class="body_balance">
			  First trascation confirmations: 
			  </div>
              <div class="body_orders">
			 
             <?php echo $first_tx_confirmations;?> </div>
              
            
			
            </div>
      <?php } ?>
 <?php
           if(count($last_tx)>0)
{?>
      
            <div class="btable_body1">
              <div class="body_icon"></div>
              <div class="body_balance">
			  Last trascation confirmations: 
			  </div>
              <div class="body_orders">
			 <?php echo $last_tx_confirmations;?>
              </div>
              
            
			
            </div>
<?php } ?>    
      </div>
        </div>
  </div>
    </div>
<div class="modal fade" id="withdrawalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      
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
	 $('#depositModal').modal('hide');
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
		$('#demodiv').load('code/'+currency);
		
		$('#demodiv').empty();
		
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
        <a href="user/btctrascations" title="View BTC Histroy">View BTC Histroy</a>
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
