<!DOCTYPE html>
<html>
<head>
<base href="<?php echo base_url();?>">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="crypto_currency">
<meta name="description" content="crypto_currency">
<title>Referrals</title>

<!-- Core CSS - Include with every page -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" />
<!-- SB Admin CSS - Include with every page -->
<link href="css/crypto_currency.css" rel="stylesheet">

<script>!window.jQuery && document.write(unescape('%3Cscript src="js/minified/jquery-1.9.1.min.js"%3E%3C/script%3E'))</script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
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
              <li> <a href="user/page/About-Us" title="about us">About us</a> </li>
              <li> <a href="user/page/Support" title="support ">support </a> </li>
              <li> <a href="user/faq" title="faq">faq</a> </li>
            </ul>
      </div>
        </div>
  </div>
    </div>
<?php /*?><a href="user/upload" title="Upload Document" >Upload Document</a><br/>
<a href="user/edit" title="Edit Profile" >Edit Profile</a><br/>
<a href="user/changepassword" title="Change Password" >Change Password</a>
<?php */?><?php if( $this->session->flashdata('success') ) { ?>
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
    <div class="section"> 
      <h2>User Referals</h2>
      <?php $qrcode=$this->common->get_qrcode();
	  if($qrcode!='')
	  {
	 $url=site_url('user/register/'.$qrcode);
     echo '<img src="https://chart.googleapis.com/chart?chs=160x160&amp;cht=qr&amp;chl='.$url.'&amp;choe=UTF-8" />';
	  }?>
  

      <div class="facebook">
      <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url;?>" target="_new"></a>
      </div>
      
      
      <div class="twitter">
      <a href="https://twitter.com/home?status=<?php echo $url;?>" target="_new"></a>
      </div>
      <div class="google">
      <a href=" https://plus.google.com/share?url=<?php echo $url;?>" target="_new"></a>
      </div>
       <?php  if(count($referals)>0){?>
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
       
        <?php } else {?>
        <h2 class="fund_head"> No Commission Earned</h2>
        <?php }?>
    
      
      <!--  <div class="btable_body2">
          <div class="body_icon"><img src="images/ftc.png" alt="" title="ftc"></div>
          <div class="body_balance">FTC : 0.00000</div>
          <div class="body_orders">0.00000000</div>
          <div class="body_bonus">0</div>
          <div class="body_total">0.00000000</div>
          <div class="body_button"><a href="#" title="Withdrawal">Withdrawal</a></div>
          <div class="body_button"><a href="#" title="Deposite">Deposite</a></div>
        </div>
        <div class="btable_body1">
          <div class="body_icon"><img src="images/aur.png" alt="" title="aur"></div>
          <div class="body_balance">AUR: 0.00000</div>
          <div class="body_orders">0.00000000</div>
          <div class="body_bonus">0</div>
          <div class="body_total">0.00000000</div>
          <div class="body_button"><a href="#" title="Withdrawal">Withdrawal</a></div>
          <div class="body_button"><a href="#" title="Deposite">Deposite</a></div>
        </div>
        <div class="btable_body2">
          <div class="body_icon"><img src="images/nmc.png" alt="" title="nmc"></div>
          <div class="body_balance">NMC : 0.00000</div>
          <div class="body_orders">0.00000000</div>
          <div class="body_bonus">0</div>
          <div class="body_total">0.00000000</div>
          <div class="body_button"><a href="#" title="Withdrawal">Withdrawal</a></div>
          <div class="body_button"><a href="#" title="Deposite">Deposite</a></div>
        </div>
        <div class="btable_body1">
          <div class="body_icon"><img src="images/ixc.png" alt="" title="ixc"></div>
          <div class="body_balance">IXC : 0.00000</div>
          <div class="body_orders">0.00000000</div>
          <div class="body_bonus">0</div>
          <div class="body_total">0.00000000</div>
          <div class="body_button"><a href="#" title="Withdrawal">Withdrawal</a></div>
          <div class="body_button"><a href="#" title="Deposite">Deposite</a></div>
        </div>
        <div class="btable_body2">
          <div class="body_icon"><img src="images/dvc.png" alt="" title="dvc"></div>
          <div class="body_balance">DVC : 0.00000</div>
          <div class="body_orders">0.00000000</div>
          <div class="body_bonus">0</div>
          <div class="body_total">0.00000000</div>
          <div class="body_button"><a href="#" title="Withdrawal">Withdrawal</a></div>
          <div class="body_button"><a href="#" title="Deposite">Deposite</a></div>
        </div>
        <div class="btable_body1">
          <div class="body_icon"><img src="images/ghs.png" alt="" title="ghs"></div>
          <div class="body_balance">GHS : 0.00000</div>
          <div class="body_orders">0.00000000</div>
          <div class="body_bonus">0</div>
          <div class="body_total">0.00000000</div>
          <div class="body_button"><a href="#" title="Withdrawal">Withdrawal</a></div>
          <div class="body_button"><a href="#" title="Deposite">Deposite</a></div>
        </div>
        <div class="btable_body2">
          <div class="body_icon"><img src="images/fhm.png" alt="" title="fhm"></div>
          <div class="body_balance">FHM : 0.00000</div>
          <div class="body_orders">0.00000000</div>
          <div class="body_bonus">0</div>
          <div class="body_total">0.00000000</div>
          <div class="body_button"><a href="#" title="Withdrawal">Withdrawal</a></div>
          <div class="body_button"><a href="#" title="Deposite">Deposite</a></div>
        </div>-->
      </div>
    </div>
    
  </div>
</div>
</div>
<div class="footer_wrapper">
  <div id="wrapper">
    <div class="footer">
      <ul>
        <li style="padding-left:0">
          <h3>How it works</h3>
          <p><a href="" title="Getting Started">Getting Started</a> <a href="" title="Trading">Trading</a></p>
        </li>
        <li>
          <h3>Documentation</h3>
          <p><a href="" title="faq">FAQ</a> <a href="" title="trade Api">Trade API</a> <a href="" title="transation fee">Transation Fee</a></p>
        </li>
        <li>
          <h3>Site Name</h3>
          <p><a href="" title="About us">About US</a> <a href="" title="Support">Support</a> <a href="" title="Terms">Terms</a> <a href="" title="Privarcy">Privarcy</a></p>
        </li>
        <li style="border:none">
          <h3>Follow us</h3>
          <div class="social_icon">
            <div class="facebook"><a href="#" title="Facebook"></a></div>
            <div class="linkedin"><a href="#" title="linkedin"></a></div>
            <div class="twitter"><a href="#" title="twitter"></a></div>
            <div class="google"><a href="#" title="google pluse"></a></div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>
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
