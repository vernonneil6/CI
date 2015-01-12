<!DOCTYPE html>
<html>
<head>
<base href="<?php echo base_url();?>">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="crypto_currency">
<meta name="description" content="crypto_currency">
<title>Dashboard</title>

<!-- Core CSS - Include with every page -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" />
<!-- SB Admin CSS - Include with every page -->
<link href="css/crypto_currency.css" rel="stylesheet">
<script>!window.jQuery && document.write(unescape('%3Cscript src="js/minified/jquery-1.9.1.min.js"%3E%3C/script%3E'))</script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script> 

$(window).load(function(){
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
});
});

</script>
</head>

<body>
<?php echo $header;?>
<!-- /.navbar-top-links -->
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
<?php /*?><a href="user/upload" title="Upload Document" >Upload Document</a><br/>
<a href="user/edit" title="Edit Profile" >Edit Profile</a><br/>
<a href="user/changepassword" title="Change Password" >Change Password</a>
<?php */?>
<?php if( $this->session->flashdata('success') ) { ?>
<div class="alert alert-success col-sm-6" style="margin-left: 7%;
    margin-right: 7%;margin-top:10px !important;
    width: 86%;"> <?php echo $this->session->flashdata('success'); ?> <a href="#" class="close" data-dismiss="alert">&times;</a> </div>
<?php } ?>
<?php if( $this->session->flashdata('error') ) { ?>
<div class="alert alert-danger col-sm-6" style="margin-left: 7%;
    margin-right: 7%;margin-top:10px !important;
    width: 86%;"> <?php echo $this->session->flashdata('error'); ?> <a href="#" class="close" data-dismiss="alert">&times;</a> </div>
<?php } ?>
<div class="section_wrapper">
  <div id="wrapper"> 
    <!-- /.row -->
    
    <div class="transtation_part"> 
      <div class="left_trpart">
        <h2 class="fund_head">Transactions</h2>
      </div>
      <?php /*?><div class="right_trpart">
        <div class="export_button"><a href="#" title="Export to Excel">Export to Excel</a></div>
        <ul class="date_picker">
          <li class="dropdown"> <a data-toggle="dropdown" class="dropdown-toggle account" href="#" title="daterange">
            <div class="date_range"> <i class="glyphicon glyphicon-calendar"></i> <span>Date Range</span> <i style="padding:10px;"><img src="images/bdown_arrow.png" alt=""></i> </div>
            </a> 
            <!--<ul class="dropdown-menu dropdown-user">
                                <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                                </li>
                                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                                </li>
                            </ul>--> 
            <!-- /.dropdown-user --> 
          </li>
        </ul>
      </div><?php */?>
      <div class="clearfix"></div>
     <?php /*?> <div class="tab_menu"> 
        <ul> 
          <li><a href="#" title="all">All</a></li>
          <li><a href="#" title="Deposite">Deposite</a></li>
          <li><a href="#" title="Withdrawal">Withdrawal</a></li>
          <li><a href="#" title="Trade">Trade</a></li>
          <li><a href="#" title="Mining">Mining</a></li>
        </ul>
      </div>
      <div  class="col-sm-12"> 
        <div class="row">
          <div class="col-xs-3 tabs-left"> <!-- required for floating --> 
            <!-- Nav tabs -->
            <div class="row">
              <ul class="nav nav-tabs tabs-left">
                <li class="active"><a id="#home"href="" data-toggle="tab" title="Ghs">Ghs</a></li>
                <li><a id="#home" href="#" data-toggle="tab" title="btc">btc</a></li>
                <li><a id="#home" href="#" data-toggle="tab" title="ltc">ltc</a></li>
                <li><a id="#home" href="#" data-toggle="tab" title="nmc">nmc</a></li>
                <li><a id="#home" href="#" data-toggle="tab" title="ixc">ixc</a></li>
                <li><a id="#home" href="#" data-toggle="tab" title="dvc">dvc</a></li>
                <li><a id="#home" href="#" data-toggle="tab" title="doge">doge</a></li>
              </ul>
            </div>
          </div>
          <div class="col-xs-9 tabs-right"> 
            <!-- Tab panes -->
            <div class="tab-content">
              <div class="tab-pane active" id="home">
                <div class="tab_table">
                  <div class="tab_head">
                    <div class="head_date">Date</div>
                    <div class="head_amt">Amount</div>
                    <div class="head_orders">Balance</div>
                    <div class="head_type">type</div>
                    <div class="head_fee">fee</div>
                  </div>
                  <?php 
				  if(count($orders)>0)
				  {
					  for($i=0;$i<count($orders);$i++)
					  {
				  ?>
                  <div class="<?php if($i%2==0) echo 'btable_body1'; else echo 'btable_body2';?>">
                    <div class="tab_date"><?php echo date('m/d/Y',strtotime($orders[$i]['createddate']));?></div>
                    <div class="tab_balance"><?php echo $mainbal=0;?></div>
                    <div class="tab_orders"><?php echo $mainbal=0;?></div>
                    <div class="tab_bonus sell"><?php echo $orders[$i]['ordertype'];?></div>
                    <div class="tab_total"><?php echo $orders[$i]['feeschargedtotal'];?></div>
                  </div>
                  <?php } } else { ?>
                  <h1>No Order Found</h1>
                  <?php }?>
                </div>
              </div>
              <div class="tab-pane" id="profile">Profile Tab.</div>
              <div class="tab-pane" id="messages">Messages Tab.</div>
              <div class="tab-pane" id="settings">Settings Tab.</div>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div><?php */?>
      
      <div  class="col-sm-12"> 
        <div class="row">
          <div class="col-xs-3 tabs-left"> <!-- required for floating --> 
            <!-- Nav tabs -->
            <div class="row">
              <ul class="nav nav-tabs tabs-left">
                <li class="active"><a id="#"href="#home" data-toggle="tab" title="All">All</a></li>
                <li><a id="#" href="#buy" data-toggle="tab" title="Buy">Buy</a></li>
                <li><a id="#" href="#sell" data-toggle="tab" title="Sell">Sell</a></li>
                <li><a id="#" href="#activeorders" data-toggle="tab" title="Active Orders">Active Orders</a></li>
                <li><a id="#" href="#deposith" data-toggle="tab" title="Deposit History">Deposit History</a></li>
                <li><a id="#" href="#withdrawalh" data-toggle="tab" title="Withdrawal History">Withdrawal History</a></li>
                <li><a id="#" href="#btctranscations" data-toggle="tab" title="BTC History">BTC Histroy</a></li>
             
              </ul>
            </div>
          </div>
          <div class="col-xs-9 tabs-right"> 
            <!-- Tab panes -->
            <div class="tab-content">
              <div class="tab-pane active" id="home"> 
                <div class="tab_table"> 
                  <div class="tab_head">
                    <div class="head_date">Date</div>
                    <div class="head_amt">Amount</div>
                  <?php /*?>  <div class="head_orders">Balance</div><?php */?>
                    <div class="head_type">type</div>
                    <div class="head_fee">fee</div>
                  </div>
                  <?php 
				  if(count($orders)>0)
				  {
					  for($i=0;$i<count($orders);$i++)
					  {
				  ?>
                  <div class="<?php if($i%2==0) echo 'btable_body1'; else echo 'btable_body2';?>">
                    <div class="tab_date"><?php echo date('m/d/Y',strtotime($orders[$i]['createddate']));?></div>
                    <div class="tab_balance"><?php echo $orders[$i]['orderamount'];?></div>
                 <?php /*?>   <div class="tab_orders"><?php echo $mainbal=0;?></div><?php */?>
                    <div class="tab_bonus <?php if($orders[$i]['ordertype']=='Buy'){?>sell<?php } else {?>buy1<?php }?>"><?php echo $orders[$i]['ordertype'];?></div>
                    <div class="tab_total"><?php echo $orders[$i]['feeschargedtotal'];?></div>
                  </div>
                  <?php } } else { ?>
                  <h6>No Order Found</h6>
                  <?php }?>
                </div> 
              </div>
              
              <div class="tab-pane" id="buy">
              <div class="tab_table">   
                  <div class="tab_head">
                    <div class="head_date">Date</div>
                    <div class="head_amt">Amount</div>
                    <?php /*?><div class="head_orders">Balance</div><?php */?>
                    <div class="head_type">type</div>
                    <div class="head_fee">fee</div>
                  </div>
                  <?php 
				  if(count($ordersbuy)>0)
				  {
					  for($i=0;$i<count($ordersbuy);$i++)
					  {
				  ?>
                  <div class="<?php if($i%2==0) echo 'btable_body1'; else echo 'btable_body2';?>">
                    <div class="tab_date"><?php echo date('m/d/Y',strtotime($ordersbuy[$i]['createddate']));?></div>
                      <div class="tab_balance"><?php echo $ordersbuy[$i]['orderamount'];?></div>
                 <?php /*?>   <div class="tab_orders"><?php echo $mainbal=0;?></div><?php */?>
                    <div class="tab_bonus sell"><?php echo $ordersbuy[$i]['ordertype'];?></div>
                    <div class="tab_total"><?php echo $ordersbuy[$i]['feeschargedtotal'];?></div>
                  </div>
                  <?php } } else { ?>
                  <h6>No Order Found</h6>
                  <?php }?>
                </div></div>
              <div class="tab-pane" id="sell"><div class="tab_table">   
                  <div class="tab_head">
                    <div class="head_date">Date</div>
                    <div class="head_amt">Amount</div>
                   <?php /*?> <div class="head_orders">Balance</div><?php */?>
                    <div class="head_type">type</div>
                    <div class="head_fee">fee</div>
                  </div>
                  <?php 
				  if(count($orderssell)>0)
				  {
					  for($i=0;$i<count($orderssell);$i++)
					  {
				  ?>
                  <div class="<?php if($i%2==0) echo 'btable_body1'; else echo 'btable_body2';?>">
                    <div class="tab_date"><?php echo date('m/d/Y',strtotime($orderssell[$i]['createddate']));?></div>
                     <div class="tab_balance"><?php echo $orderssell[$i]['orderamount'];?></div>
                 <?php /*?>   <div class="tab_orders"><?php echo $mainbal=0;?></div><?php */?>
                    <div class="tab_bonus buy1"><?php echo $orderssell[$i]['ordertype'];?></div>
                    <div class="tab_total"><?php echo $orderssell[$i]['feeschargedtotal'];?></div>
                  </div>
                  <?php } } else { ?>
                  <h6>No Order Found</h6>
                  <?php }?>
                </div></div>
                
                
              <div class="tab-pane" id="activeorders"><div class="tab_table">   
                  <div class="tab_head">
                    <div class="head_date">Date</div>
                    <div class="head_amt">Amount</div>
                    <?php /*?><div class="head_orders">Balance</div><?php */?>
                    <div class="head_type">type</div>
                    <div class="head_fee">fee</div>
                  </div>
                  <?php 
				  if(count($ordersactive)>0)
				  {
					  for($i=0;$i<count($ordersactive);$i++)
					  {
				  ?>
                  <div class="<?php if($i%2==0) echo 'btable_body1'; else echo 'btable_body2';?>">
                    <div class="tab_date"><?php echo date('m/d/Y',strtotime($ordersactive[$i]['createddate']));?></div>
                      <div class="tab_balance"><?php echo $ordersactive[$i]['orderamount'];?></div>
                 <?php /*?>   <div class="tab_orders"><?php echo $mainbal=0;?></div><?php */?>
                    <div class="tab_bonus  <?php if($ordersactive[$i]['ordertype']=='Buy'){?>sell<?php } else {?>buy1<?php }?>"><?php echo $ordersactive[$i]['ordertype'];?></div>
                    <div class="tab_total"><?php echo $ordersactive[$i]['feeschargedtotal'];?></div>
                  </div>
                  <?php } } else { ?>
                  <h6>No Order Found</h6>
                  <?php }?>
                </div></div>
                
                <div class="tab-pane" id="deposith"><div class="tab_table">   
                  <div class="tab_head">
                    <div class="head_date">Date</div>
                    <div class="head_amt">Amount</div>
                    <div class="head_orders">Balance</div>
                    <div class="head_fee">Currency</div>
                  </div>
                  <?php 
				  if(count($ordersdeposit)>0)
				  {
					  for($i=0;$i<count($ordersdeposit);$i++)
					  {
				  ?>
                  <div class="<?php if($i%2==0) echo 'btable_body1'; else echo 'btable_body2';?>">
                    <div class="tab_date"><?php echo date('m/d/Y',strtotime($ordersdeposit[$i]['dcreateddate']));?></div>
                    <div class="tab_balance"><?php echo $ordersdeposit[$i]['amount'];?></div>
                    <div class="tab_orders"><?php echo $ordersdeposit[$i]['total_balance'];?></div>
                    <div class="tab_total"><?php echo $ordersdeposit[$i]['currencycode'];?></div>
                  </div>
                  <?php } } else { ?>
                  <h6>No Order Found</h6>
                  <?php }?>
                </div></div>
                
                <div class="tab-pane" id="withdrawalh"><div class="tab_table">   
                  <div class="tab_head">
                    <div class="head_date">Date</div>
                    <div class="head_amt">Amount</div>
                    <div class="head_orders">Balance</div>
                    <div class="head_fee">Currency</div>
                  </div>
                  <?php 
				  if(count($orderswithdrawal)>0)
				  {
					  for($i=0;$i<count($orderswithdrawal);$i++)
					  {
				  ?>
                  <div class="<?php if($i%2==0) echo 'btable_body1'; else echo 'btable_body2';?>">
                    <div class="tab_date"><?php echo date('m/d/Y',strtotime($orderswithdrawal[$i]['createddate']));?></div>
                    <div class="tab_balance"><?php echo $orderswithdrawal[$i]['withdrawalamount'];?></div>
                    <div class="tab_orders"><?php echo $orderswithdrawal[$i]['total_balance'];?></div>
                 
                    <div class="tab_total"><?php echo $orderswithdrawal[$i]['currencycode'];?></div>
                  </div>
                  <?php } } else { ?>
                  <h6>No Order Found</h6>
                  <?php }?> 
                </div></div>
                <div class="tab-pane" id="btctranscations"><div class="tab_table">   
                  <div class="tab_head">
                    <div class="head_date" style="width:340px;">Address</div>
                    <div class="head_fee" style="width:110px;">Balance</div>
                    <div class="head_fee" style="width:163px;">Transcations</div>
                    <div class="head_fee" style="width:40px;">Confimations</div>
                  </div>
                  <?php 
				  
		$userid = $this->session->userdata['cc_user']['userid'];
		$result = $this->users->get_user_address($userid,'btc');
		
		$b = file_get_contents("http://btc.blockr.io/api/v1/address/info/".$result);
$de = json_decode($b);
/*echo "<pre>";
print_r($de);
die();*/
$balance = $de->data->balance;
$nb_txs = $de->data->nb_txs;
$first_tx = $de->data->first_tx;
if(count($first_tx)>0)
{
$first_tx_confirmations = $de->data->first_tx->confirmations;
}
else
{
$first_tx_confirmations = 0;
}
$last_tx = $de->data->last_tx;
if(count($last_tx)>0)
{
$last_tx_confirmations = $de->data->last_tx->confirmations;
}
else
{
$last_tx_confirmations = 0;
}

?>
                  <div style="width:100%;">
                   <?php if(strlen($result)>5){?>
                    <div class="tab_date" style="width:340px;">
                    <?php echo $result;?>
                    </div>
                    <div class="tab_balance" style="width:110px;"><?php echo $balance;?></div>
                    <div class="tab_orders" style="width:163px;"><?php echo $nb_txs;?></div>
                    <div class="tab_orders" style="width:40px;"><?php echo $first_tx_confirmations;?></div>
                   <?php }else
				   {
				   ?>
                   <h6>No Record Found</h6>
                   <?php
				   }?> 
                    
                  </div>
                  <?php ?> 
                </div></div>
            </div>
            
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="section">  
      <h2 class="fund_head">User Referals</h2>
      <h3>You Can Share Your Referral Code From Following links</h3><br>

	  <?php 
	  
	  $qrcode=$this->common->get_qrcode();
	 if(isset($qrcode)){
	  if($qrcode!='')
	  {
	 $url=site_url('user/register/'.$qrcode);
     echo '<img src="https://chart.googleapis.com/chart?chs=160x160&amp;cht=qr&amp;chl='.$url.'&amp;choe=UTF-8" />';
	  ?>
  

      <div class="facebook">
      <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url;?>" target="_new"></a>
      </div>
      
      
      <div class="twitter">
      <a href="https://twitter.com/home?status=<?php echo $url;?>" target="_new"></a>
      </div>
      <div class="google">
      <a href=" https://plus.google.com/share?url=<?php echo $url;?>" target="_new"></a>
      </div>
      <?php }?>
       <?php 
	   if(isset($referals)){
	    if(count($referals)>0){?>
    <table class="table table-striped table-bordered">
            <tbody>
              <tr>
                <td>User Name</td>
                <td>Commission</td>
                <td>Status</td>
                <td>Created Date</td>
              </tr>
              <?php
			for($i=0;$i<count($referals);$i++)
			{
			?>
                <tr>
                <td><?php echo $referals[$i]['username'];?></td>
                <td><?php echo $commissionfees=$this->common->get_setting_value(8);?></td>
                <td><?php echo $referals[$i]['status'];?></td>
                <td><?php echo $referals[$i]['createddate'];?></td>
              </tr>
              <?php }?>
               </tbody>
          </table>
       
        <?php }} } else {?>
        <h3 class="fund_head"> No Commission Earned</h3>
        <?php }?>
    
      </div>
  </div>
</div>
</div>
<div class="modal fade" id="withdrawalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
  <h4 class="modal-title" id="myModalLabel">Withdrawal BTC</h4>
</div>
<div class="modal-body">

<label id="label_div" style="display:none;">
<div class="alert alert-danger col-sm-6" style="margin-left: 3%;
    margin-right: 3%;width: 94%;padding:10px !important;">
  <div id="error_div"></div>
  <a href="#" class="close" data-dismiss="alert">&times;</a> </div>
</label>
<form method="post" action="user/withdrawalfunds">
<table cellpadding="4px" cellspacing="5px">
  <tr>
    <td><label for="otplabel">Available funds:</label>
      <span id="availbal" style="font-weight:bold"></span></td>
      <td class="currencycode"><td>
  </tr>
  <tr>
    <td><label>Expended limit:</label>
      <br>
       <span id="totalbals" style="font-weight:bold"></span></td>
      </td>
      <td class="currencycode"><td>
  </tr>
  <tr>
    <td><label for="otplabel">Address:</label></td>
    <td><input type="text" name="eaddress" id="eaddress"/>
      <input type="hidden" name="balanceid" id="balanceid">
      <input type="hidden" name="currencyid" id="currencyid">
      <br></td>
      
  </tr>
  <tr>
    <td><label for="otplabel">Amount to withdrawal:</label></td>
    <td><input type="text" name="amountw" id="amountw" class="checkno"/>
      <br></td>
      <td class="currencycode"><td>
  </tr>
  <tr>
    <td><label for="otplabel">You will receive:</label></td>
    <td><input type="text"  readonly name="availablefunds" id="availablefunds"/>
      <br></td>
      <td class="currencycode"><td>
  </tr>
</table>
</div>
<div class="modal-footer">
  <input type="submit" name="withdrawal" id="withdrawal"  class="buy" value="Withdrawal" />
</div>
</div>
</div>
</div>
<div class="modal fade" id="depositModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Deposit</h4>
      </div>
      <div class="modal-body">
        <label id="label_div" style="display:none;">
        <div class="alert alert-danger col-sm-6" style="margin-left: 3%;
    margin-right: 3%;width: 94%;padding:10px !important;">
          <div id="error_div"></div>
          <a href="#" class="close" data-dismiss="alert">&times;</a> </div>
        </label>
     <label for="otplabel">Deposit Amount:</label>
     <input type="hidden" name="balanceid1" id="balanceid1">
     <input type="hidden" name="availbal1" id="availbal1">
     
        <input type="text" style="width:200px" name="depamnt" id="depamnt" class="txtfield checkno" tabindex="1" maxlength="30">
      </div>
      <div class="modal-footer">
        <input type="button" name="depamntbtn" id="depamntbtn"  class="buy" value="Deposit" />
      </div>
    </div>
  </div>
</div>


<?php echo $footer;?>
<!--<div class="chat">
        <div class="chat-warper">
            <div style="top: 140px; left: 1115px;" class="main-window hidden">
                <div class="chat-head">
                    <div class="head-icon"></div>
                        <span class="head-text">CEX.io chat</span>
                        <div class="close"></div>
                        <div class="full"></div>
                    </div>
                    <div class="chat-tabs">
                        <div id="en" class="msgWindow scroll tab-pane active">
                            <span class="allMsg"><span class="user" style="">jmintuck011 : </span><span class="time"> 7:07</span><br>oh god. are you saying sh!t that I think you may be trying to refer to, ohmygod no</span>
                        </div>
                    </div>
                    <div class="sender-btn"></div>
                    <textarea id="msg" type="text" maxlength="1000"></textarea>
                    <div class="users-online">
                        <span class="usersonline">1854</span>  users online
                    </div>
                </div>
        </div>
        <div class="chat-bottom">
            <div style="opacity: 0;" class="new-message"></div>
                <span class="chat-bottom-title">Open chat</span>
                <div class="online">
                    <span class="usersonline">1854</span>
                </div>
            </div>
        </div> 
	</div>--> 

</body>
</html>
