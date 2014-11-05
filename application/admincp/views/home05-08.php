<?php
$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
$this->output->set_header('Pragma: no-cache');

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
	<head>
	<base href="<?php echo base_url();?>" />
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<title><?php echo $title;?></title>

	<!-- Core CSS - Include with every page -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" />
	<!-- SB Admin CSS - Include with every page -->
	<link href="css/crypto_currency.css" rel="stylesheet">
	<link rel="stylesheet" href="css/chat.css">
	<script src="js/jquery-1.11.0.min.js"></script>
	<script>!window.jQuery && document.write(unescape('%3Cscript src="js/minified/jquery-1.9.1.min.js"%3E%3C/script%3E'))</script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/jquery.number.js"></script>
    
	<?php 
	//graph values
	
	?>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart']});
    </script>
	<style>
table td {
	font-weight:normal !important;
	font-size:12px !important;
}
</style>
	<?php $check_order = $this->homes->check_atleast_one_order($ex_id);
   
   		 if(count($check_order)>0)
		 {?>
	<script type="text/javascript">
			function drawVisualization() {
						
				<?php if($gtype!=''){?>
				<?php if($gtype=='today'){?>
				var data = google.visualization.arrayToDataTable([
				<?php 
				
				//$hour_main = date("H",strtotime(date('Y-m-d H:i:s')));
				$hour=0;
				/*if($hour_main<7)
				{
					$hour=$hour_main+6;
				}
				if($hour_main>7)
				{
					$hour=$hour_main-6;
				}*/				
				//for($k=$hour;$k<$hour_main;$k++){
				for($k=0;$k<15;$k++){	
			if($k<10)
			{
		$values = $this->homes->get_values_for_graphs_today($ex_id,'0'.$k);
			}else
			{
			$values = $this->homes->get_values_for_graphs_today($ex_id,$k);
			}
			$get_last_value= $this->homes->get_list_transaction($ex_id,$k);
			
			//print_r($values);
			
			if(count($values)==4)
			{
				
				$a_max = $values[0]['base_price'];
				$b_min = $values[1]['base_price'];
			    $c_initial_price = $values[2]['initial_price'];
			    $d_currentprice = $values[2]['base_price'];
				$e_sumquantity=$values[3]['orderamount'];
				if(count($get_last_value)>0)
				{
				$get_last_transaction=$get_last_value[0]['base_price'];
				}
				else
				{
				$get_last_transaction=$values[2]['initial_price'];
				}
				
				if($get_last_transaction=='')
				{
					
					$get_last_transaction=0;
				
				
				} 
				
				if($b_min=='')
				{
					$b_min=0;
				}
				if($c_initial_price=='')
				{
					$c_initial_price=0;
				}
				if($d_currentprice=='')
				{
					$d_currentprice=0;
				}
				if($a_max=='')
				{
					$a_max=0;
				}
				if($e_sumquantity=='')
				{
					$e_sumquantity=0;
				}
			
					if($k==0)
					{		
				echo '["'.$k.':00"'.','.floatval($b_min).','.floatval($c_initial_price).','.floatval($d_currentprice).','.floatval($a_max).','.$e_sumquantity.'],';
					}
					else
					{
					echo '["'.$k.':00"'.','.floatval($b_min).','.floatval($get_last_transaction).','.floatval($d_currentprice).','.floatval($a_max).','.$e_sumquantity.'],';
					}
				
			 }
			 else
			 {
				//echo '["'.$k.':00"'.',0,0,0,0,0],';
			 }
		  
			 
			  }?>
				], true);
				<?php } ?>
				<?php if($gtype=='week'){?>
				var data = google.visualization.arrayToDataTable([
				<?php for($k=1;$k<8;$k++){
			$values = $this->homes->get_values_for_graphs_week($ex_id,$k);
			$last_trans=$this->homes->get_last_transaciton_weekly($ex_id,$k);
				
			if(count($values)==6)
			{
				$a = $values[2]['base_price'];
				$b = $values[4]['initial_price'];
				$c = $values[4]['base_price'];
				$d = $values[0]['base_price'];
			    $e = $values[5]['orderamount'];
				if(count($last_trans)>0)
				{
					$wtrans=$last_trans[0]['base_price'];
				}
				else
				{
					$wtrans= $values[4]['initial_price'];
					
				}
				if($a=='')
				{
					$a=0;
				}
				$b = $values[4]['initial_price'];
				if($b=='')
				{
					$b=0;
				}
				
				$c = $values[4]['base_price'];
				if($c=='')
				{
					$c=0;
				}
				$d = $values[0]['base_price'];
			
				if($d=='')
				{
					$d=0;
				}
				if($e=='')
				{
					$e=0;
				}
				if($wtrans=='')
				{
					$wtrans=0;
				}
				
				$date = date("l", strtotime("".-$k." day"));
				if($k==0)
				{
				echo '["'.$date.'"'.','.$a.','.$b.','.$c.','.$d.','.$e.'],';
				}
				else
				{
				echo '["'.$date.'"'.','.$a.','.$wtrans.','.$c.','.$d.','.$e.'],';
				}
			 } }?>
				], true);
				<?php } ?>
				<?php if($gtype=='month'){?>
				var data = google.visualization.arrayToDataTable([
				<?php for($k=1;$k<=12;$k++){
			$values = $this->homes->get_values_for_graphs_month($ex_id,$k);
			
			if(count($values)==6)
			{
				$a = $values[2]['base_price'];
				$b = $values[4]['initial_price'];
				$c = $values[4]['base_price'];
				$d = $values[0]['base_price'];
				$e = $values[5]['orderamount'];
				if($a=='')
				{
					$a=0;
				}
				$b = $values[4]['initial_price'];
				if($b=='')
				{
					$b=0;
				}
				
				$c = $values[4]['base_price'];
				if($c=='')
				{
					$c=0;
				}
				$d = $values[0]['base_price'];
			
				if($d=='')
				{
					$d=0;
				}
				
				 $date =  date("M", strtotime("$k/12/10"));
				
				echo '["'.$date.'"'.','.$a.','.$b.','.$c.','.$d.','.$e.'],';
			 } }?>
				], true);
				<?php } ?>
				<?php } ?>
				
				options = {
					chartArea:{
						left: 50,
						top: 10,
						width: 680,
						height: 400
					},
					colors:["#515151","#515151"],
					candlestick:{
						fallingColor:{
							fill: "#00ff00",
							stroke: "green",
							strokeWidth: 1
						},
						risingColor:{
							fill: "#ff0000",
							stroke: "#d91e1e",
							strokeWidth: 1
						},
						hollowIsRising: true
					},
					series: {0: {type: "candlesticks"}, 1: {type: "bars", targetAxisIndex:1, color:"#d9d9d9"}},
					legend:"none"
				};
				
				chart = new google.visualization.ComboChart(document.getElementById("chart_div"));
				chart.draw(data, options);
			}

			google.setOnLoadCallback(drawVisualization);
	</script>
	<?php } ?>
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
		$(function(){
		  $('#loginform').submit(function(e){
			//return false;
		  });
		  $('#modaltrigger').leanModal({ top: 110, overlay: 0.45, closeButton: ".modal_close" });
		});
	</script>
	</head>
	<body>
<!--table sort-->    
    
    
<div class="header_wrapper">
      <div id="wrapper">
    <nav class="navbar" role="navigation">
          <div class="navbar-header"> <a class="navbar-brand" href="" title="Crypto Currency">
            <h1><img src="<?php echo $logoimage;?>" alt="" style="height: 125px; width: 250px;"></h1>
            </a> </div>
          <!-- /.navbar-header -->
          <div class="price_part">
        <ul class="top_row">
              <li class="price_box">
            <div class="big">last price</div>
            <div class="small">
<?php /*?>                  <?php if(!empty($lastprice)) echo $lastprice;?>
<?php */?>                </div>
          </li>
              <li class="price_box">
            <div class="big">low price</div>
            <div class="small">
                  <?php /*?><?php if(!empty($lowprice)) echo $lowprice;?><?php */?>
                </div>
          </li>
              <li class="price_box last_child">
            <div class="big">high price</div>
            <div class="small">
<?php /*?>                  <?php if(!empty($highprice)) echo $highprice;?>
<?php */?>                </div>
          </li>
            </ul>
        <ul class="bottom_row">
              <li class="price_box">
            <div class="big">Daily change</div>
            <div class="small"></div>
          </li>
              <li class="price_box">
            <div class="big">range</div>
            <div class="small"></div>
          </li>
              <li class="price_box last_child">
            <div class="big">24h volume</div>
            <div class="small"></div>
          </li>
            </ul>
      </div>
          <ul class="nav navbar-top-links navbar-right">
        <?php  if( !array_key_exists('cc_user',$this->session->userdata) )
			{
        ?>
        <div class="btn_panel">
              <div class="login last_box"> <a href="#loginmodal" id="modaltrigger" title="login">login</a> </div>
              <div class="signup"> <a href="user/register" title="sign up">sign up</a> </div>
            </div>
        <div class="change_pwd"><a href="login/forgot" title="Forgot password?">Forgot password?</a></div>
        <?php }else{?>
        <ul class="nav navbar-top-links navbar-right">
              <div class="balance_info">
            <div class="balance_head">Current<br>
                  Balance</div>
            <div class="usd">$ <?php echo number_format($balance=$this->homes->get_userbalance('USD'),3);?> USD</div>
            <div class="btc">$  <?php echo number_format($balance=$this->homes->get_userbalance('BTC'),3);?> BTC</div>
          </div>
              <div class="currency">
            <select>
                  <option value="usd [$]" title="USD [$]">usd [$]</option>
                  <option value="saab">Saab</option>
                  <option value="opel">Opel</option>
                  <option value="audi">Audi</option>
                </select>
            <!-- /.dropdown-tasks --> 
          </div>
              <div></div>
              <div class="currency" style="margin-top:5px;">
            <select>
                  <option value="eng [$]" title="eng [$]">eng [$]</option>
                  <option value="saab">Saab</option>
                  <option value="opel">Opel</option>
                  <option value="audi">Audi</option>
                </select>
            <!-- /.dropdown-tasks --> 
          </div>
            </ul>
        <ul class="navbar-top-links navbar-right information_part">
             <li class="dropdown" style="margin-top:15px;" > <a class="dropdown-toggle" data-toggle="dropdown" href="#" title="message"> <i><img src="images/message.png" alt=""></i> <span class="badge">	<?php
		 
		 $count=$this->common->get_count_message(); 
		$count1=$this->common->get_count_messagelabel(); 
		echo count($count1);
			?></span> </a>
     <ul class="dropdown-menu dropdown-messages" style="margin-top:15px;max-height: 400px;overflow-y: auto;">  
          <?php  
		 
		  if(count($messages)>0){
		  for($i=(count($messages)-1);$i>=0;$i--)
		  {?>
            <li<?php if($messages[$i]['chat_status']==1) {?> style="background-color: #F8F8F8;"<?php }?>> 
                                <a href="javascript:void(0);">
                                    <div>
                                        <strong>Admin</strong>
                                        <span class="pull-right text-muted">
                                            <em><?php echo $messages[$i]['mcreateddate'];?></em>
                                        </span>
                                    </div>
                                    <div><?php echo $messages[$i]['message_body'];?>...</div>
                                </a>
                               <?php if($messages[$i]['chat_status']==0) {?>
                              	  <a href="javascript:void(0);" onClick="markasread('<?php echo $messages[$i]['chatid'];?>');">Mark as Read</a>
                           		<?php }?>
                              <a href="javascript:void(0);" onClick="showmsgbox('<?php echo $messages[$i]['chatid'];?>');" style="color:#060">Reply</a>

                            </li>
                            <li class="divider"></li>
                            <?php }}  else 
							{?>
                            <li>No Messages Found</li>
                               <li class="divider"></li>
                            <?php }?>
                           <a href="javascript:void(0);" onClick="showmsgbox('0');" style="color:#060" title="Compose New Message">Compose New Message</a>

          </ul>
            <!-- /.dropdown-messages --> 
          </li>
              <!-- /.dropdown -->
              
              <li class="dropdown" style="margin-top:15px"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" title="notification"> <i><img src="images/bell.png" alt=""></i><span class="badge">0</span> </a>
            <ul class="dropdown-menu dropdown-alerts">
                  <li>No Alerts</li>
                </ul>
            <!-- /.dropdown-alerts --> 
          </li>
              <!-- /.dropdown -->
              <li class="dropdown" style="margin-top:15px;"> <a data-toggle="dropdown" class="dropdown-toggle account" href="#" title="User">
                <div class="avatar pull-left">
                <?php if($logged_user[0]['avatar']==''){?>
                <img alt="avatar" class="img-responsive" style="height:40px; width:40px" src="images/avatar.jpg">
                <?php } else {?>
                <img alt="avatar" class="img-responsive" style="height:40px; width:40px" src="<?php echo $this->config->item('avatar_upload_path').$logged_user[0]['avatar'];?>">
                <?php }?>
              </div>
                <div class="user-mini pull-right"> <span class="welcome">Welcome,</span>
                <div class="clearfix"></div>
                <span><?php echo $logged_user[0]['username'];?></span> <i><img src="images/down_arrow.png" alt=""></i> </div>
                </a>
            <ul class="dropdown-menu dropdown-user">
                  <li><a href="user/finance" title="Finance"><i class="fa fa-user fa-fw"></i>Finance</a> </li>
                  <li><a href="user" title="User Profile"><i class="fa fa-user fa-fw"></i> User profile</a> </li>
                  <li><a href="user/edit" title="User Profile"><i class="fa fa-user fa-fw"></i> Edit Profile</a> </li>
                  <li><a href="user/document" title="User verification"><i class="fa fa-user fa-fw"></i> User verification</a> </li>
                  <li><a title="Creditcards" href="user/creditcards"><i class="fa fa-user fa-fw"></i> Creditcards</a> </li>
                  <li class="divider"></li>
                  <li><a href="user/logout" title="Logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a> </li>
                </ul>
            <!-- /.dropdown-user --> 
          </li>
              <!-- /.dropdown -->
            </ul>
        <?php } ?>
      </ul>
        </nav>
  </div>
    </div>
<div class="menu_wrapper">
      <div id="wrapper">
    <div class="menu">
          <div class="navbar-default" role="navigation">
        <ul class="nav" id="side-menu">
              <li> <a href="<?php echo base_url();?>" title="Trade">Trade</a> </li>
           
              <li> <a href="page/About-Us" title="about us">About us</a> </li>
              <li> <a href="page/Support" title="support ">support </a> </li>
              <li> <a href="faq" title="faq">faq</a> </li>
            </ul>
      </div>
        </div>
  </div>
    </div>
    
    	<script type="text/javascript" language="javascript" src="js/tablesort.uncompressed.js"></script>
	<?php if(count($exchangedata)>0){?>
	<script type="text/javascript" language="javascript" class="init">
	$(document).ready(function() {
		   new Tablesort(document.getElementById('buytable'));
		   new Tablesort(document.getElementById('selltable'));
		   new Tablesort(document.getElementById('activeorder'));
		   new Tablesort(document.getElementById('histable'));	 
	} );
	</script>
    <?php }?>
<?php if(count($exchangedata)>0){?>

<script type="text/javascript"> 
$(document).ready(function() {	

$('.numberformat').number( true, 4 );
setInterval(function() {
  $.ajax({
	
	url:"home/loadbuydata",
	type:"POST",
	datatype:"JSON",
	data:{id:<?php echo $exchangedata[0]['interfaceexid'];?>},
	success:function(d)
	{
		 new Tablesort(document.getElementById('buytable'));
		var data=$.parseJSON(d);
		$('.loadbuydata').empty();
		
		for(var i=0;i<data.length;i++)
		{
					
				var html="<tr><td class='numberformat'>"+$.number(data[i].base_price,4)+"</td><td class='numberformat'>"+$.number(data[i].orderamount,4)+"</td><td class='numberformat'>"+$.number(data[i].ordertotal,4)+"</td></tr>";
				 $('.loadbuydata').append(html);
		}
		 $.ajax({
	
			url:"home/loadbuytotal",
			type:"POST",
			data:{id:<?php echo $exchangedata[0]['interfaceexid'];?>},
			success:function(d)
		 	{
				$('#totalheadbuy').html(d);
				
			}
			});		
	
	}
	});
	
	<?php if(strlen($exchangedata[0]['interfaceexid'])>0){?>
	$.ajax({
	
	url:"home/loadselldata",
	type:"POST",
	datatype:"JSON",
	data:{id:<?php echo $exchangedata[0]['interfaceexid'];?>},
	success:function(d)
	{
		var data=$.parseJSON(d);
		$('.loadselldata').empty();
		if(data[0].orderamount!==null)
		{
		for(var i=0; i<data.length;i++)
		{
			
					
		var html="<tr><td class='numberformat'>"+$.number(data[i].base_price,4)+"</td><td class='numberformat'>"+$.number(data[i].orderamount,4)+"</td><td class='numberformat'>"+$.number(data[i].ordertotal,4)+"</td></tr>";
				 $('.loadselldata').append(html);				
		}
		 $.ajax({
	
			url:"home/loadselltotal",
			type:"POST",
			data:{id:<?php echo $exchangedata[0]['interfaceexid'];?>},
			success:function(d)
		 	{
				$('#totalheadsell').html(d);
				
			}
			});		

		
	}
		else
		{
			var html="<td colspan='3'>No Orders Found</td>";
			 $('.loadselldata').append(html);	
		}
	}
	
	});
	
	<?php if(strlen($exchangedata[0]['interfaceexid'])>0){?>
		$.ajax({
	
	url:"home/loadactivedata",
	type:"POST",
	datatype:"JSON",
	data:{id:<?php echo $exchangedata[0]['interfaceexid'];?>},
	success:function(d)
	{
		var data=$.parseJSON(d);
		$('.activedata').empty();
		for(var i=0; i<data.length;i++)
		{
			if(data[i].ordertype=='Sell')
			
			{var  t='buy1';  } else {  var t='sell'; }
			
		var html="<tr><td><span class='"+t+"'> "+data[i].ordertype+"</span></td><td>"+$.number(data[i].base_price,4)+"</td><td>"+$.number(data[i].orderamount,4)+"</td><td>"+$.number(data[i].ordertotal,4)+"</td><td>"+data[i].createddate+"</td><td><a href='javascript:void(0);' onclick='deleteorder("+data[i].order_id+")'><img src='images/delete.png' width='16' height='16'></a></td></tr>";			
					 $('.activedata').append(html);				
		}

	}
	});
	
	
	$.ajax({
	
	url:"home/loadhistorydata",
	type:"POST",
	datatype:"JSON",
	data:{id:<?php echo $exchangedata[0]['interfaceexid'];?>},
	success:function(d)
	{
		var data=$.parseJSON(d);
		$('.historydata').empty();
		for(var i=0; i<data.length;i++)
		{
		     if(data[i].ordertype=='Sell')
			
			{var  t='buy1';  } else {  var t='sell'; }
			 			
		var html="<tr><td class='numberformat'>"+data[i].createddate+"</td><td class='"+t+"'>"+data[i].ordertype+"</td><td class='numberformat'>"+$.number(data[i].base_price,4)+"</td><td class='numberformat'>"+$.number(data[i].orderamount,4)+"</td><td class='numberformat'>"+$.number(data[i].ordertotal,4)+"</td></tr>";
				 $('.historydata').append(html);				
		}
		
	}
	});
	
	<?php }?>
	$.ajax({
	
	url:"home/loadmessagedata",
	type:"POST",
	datatype:"JSON",
	success:function(d)
	{
		var data=$.parseJSON(d);
		//$('#msgWindow').empty();
		for(var i=0; i<data.length;i++)
		{
		
			//	var html="<span class='allMsg'><span class='user' >"+data[i].username+" </span>:"+data[i].message+"</span>";
		//	var html="<tr><td>"+data[i].base_price+"</td><td>"+data[i].orderamount+"</td><td>"+data[i].ordertotal+"</td></tr>";
		//$('#msgWindow').append(html);
		
		}
	
		
	}
	});
	
	
	}, 1000 * 60 * 0.5);	
	setInterval(function() {
	$.ajax({
	
	url:"home/loadmessagedata",
	type:"POST",
	datatype:"JSON",
	success:function(d)
	{
		var data1=$.parseJSON(d);
		var data=data1.reverse();
		$('.msgWindow').empty();
		for(var i=0; i<data.length;i++)
						{
						
						/*if(data[i].avatar=='')
						{
						var image='images/avatar.jpg';
						}
						else
						{
						var image='<?php echo $this->config->item('avatar_upload_path');?>/'+data[i].avatar;
						}*/
						
						var html="<span class='allMsg'><span class='user' >"+data[i].username+" </span>:"+data[i].message+"</span>";
						//var html="<span class='allMsg'><img src='"+image+"' class='img-responsive' alt='avatar'><span class='user' >"+data[i].username+" </span><span class='time'>"+data[i].createddate+"</span><br>"+data[i].message+"</span>";
						//	var html="<tr><td>"+data[i].base_price+"</td><td>"+data[i].orderamount+"</td><td>"+data[i].ordertotal+"</td></tr>";
						$('.msgWindow').append(html);
						}
						console.log;
		
		
	}
	});
	}, 1000 * 60 * 10);	
});
//will change view mode
function viewmodebuy(data)
{
	if(data==0)
	{
		$('#buybasecurrency').show();
		$('.mainbuy').show(); 
		$('.mainbuybase').show(); 
		$('#sellbasecurrency').show();
		$('.mainsell').show();
		$('.mainsellbase').show(); 
	}
	else
	{
		$('#buybasecurrency').hide();
		$('.mainbuy').hide();
		$('.mainbuybase').hide(); 
		$('#sellbasecurrency').hide();
		$('.mainsell').hide();
		$('.mainsellbase').hide(); 
		
	}
}

function viewmodesell(data)
{
	if(data==0)
	{
		$('#sellbasecurrency').show();
		$('.mainsell').show();
		$('.mainsellbase').show(); 
	}
	else
	{
		$('#sellbasecurrency').hide();
		$('.mainsell').hide();
		$('.mainsellbase').hide(); 
	}
}
</script> 
<?php } ?>
<script type="text/javascript">
function showlogin()
{
	$('#modaltrigger').trigger('click');
}

function changeamountsell(val)
{
	 var baseprice=document.getElementById('sellbasecurrency').value
	document.getElementById('sellamount').value=val;
	var total=parseFloat(val)*parseFloat(baseprice);

	$('.selltotal').html((total));
	document.getElementById('selltotaltext').value=total;
}
function changeamountbuy(val)
{
	var baseprice=document.getElementById('buyamount').value;
	var baseprice2=document.getElementById('buybasecurrency').value;
	var final=(parseFloat(val)/parseFloat(baseprice2));
	var total=parseFloat(val)*parseFloat(baseprice2);
	document.getElementById('buyamount').value=final;
	$('.buytotal').html((val));
	document.getElementById('buytotaltext').value=val;
}

function changepricebuy(id)
{
	var baseprice=document.getElementById('buybasecurrency').value;
	var total=parseFloat(id)*parseFloat(baseprice);
	
	$('.buytotal').html((total));
	document.getElementById('buytotaltext').value=total;

	
}
function calculatefeesbuy()
{
	
	 var basefee=$('#feestext').val();
	
	 var baseprice=document.getElementById('buyamount').value;
	 if(baseprice!='')
	 {
	
		var total=((parseFloat(basefee)*parseFloat(baseprice))/100);
		
	 $('#feescalculation').html((total));
	document.getElementById('feescalculationtext').value=total;
	 }
	
}
function changepricesell(id)
{
	
	var baseprice=document.getElementById('sellbasecurrency').value;
	var total=parseFloat(id)*parseFloat(baseprice);
	$('.selltotal').html((total));
	document.getElementById('selltotaltext').value=total;
	
}
function calculatefeessell()
{
	 var basefee=$('#feestext').val();

	 var baseprice=document.getElementById('selltotaltext').value;
		 if(baseprice!='')
	 {
	
		var total=(parseFloat(basefee)*parseFloat(baseprice)/100);
		$('#feescalculationsell').html((total));
		document.getElementById('feescalculationselltext').value=total;

	 }

}
 
$(document).ready(function() {		


		$("#sellcurrency").click(function () {
			
				var namefilter = /^[+-]?\d+(\.\d+)?$/;
			
			if( ($("#sellamount").val()) == ""  )
			{
				alert("Please Insert Sell Amount");
				$("#sellamount").val('').focus();
				return false;
			}
			if( ($("#sellamount").val())==0 )
			{
				alert("Amount must be Greater than 0");
				$("#sellamount").val('').focus();
				return false;
			}
			if( ($("#sellbasecurrency").val())==0 )
			{
				alert("Amount must be Greater than 0");
				$("#sellbasecurrency").val('').focus();
				return false;
			}
			var sumdata=((parseFloat($("#sellamount").val()))*(parseFloat($("#sellbasecurrency").val())));

			
			if(parseFloat($("#sellbal").val())<parseFloat($("#sellamount").val()))
			{
				alert("You dont have enough balance to place the Order");
				return false;
			}
			else
			{
				if( !namefilter.test(($("#sellamount").val())) )
				{
					alert("Amount should be Numeric");				
					return false;
				}
			}
		 var maxamount='<?php echo $buyamt=$this->common->get_setting_value(15);?>';
			//if($("#buyamount").val()>maxamount)
		//	{
				
				if(document.getElementById('sellbasecurrency').value=='')
				{
				document.getElementById('sellbasecurrency').value='<?php if($avg_sell==''){echo $exchangedata[0]['currentprice'];} else {echo $avg_sell;}?>';
				}
					var currency=document.getElementById('currencyname').value;
					var base_price=document.getElementById('sellbasecurrency').value;
					var buyamount=document.getElementById('sellamount').value;
					var buytotaltext=document.getElementById('selltotaltext').value;
					var feescalculationtext=document.getElementById('feescalculationselltext').value;
					var buybasecurrency=document.getElementById('sellbasecurrency').value;
					var interfaceexid=document.getElementById('interfaceid').value;
					var sellview=document.getElementById('viewtypebuy').value;
					
					if(sellview==0)
					{
						var urlsell="home/sellcurrency";
					}
					else
					{
						var urlsell="home/sellcurrencystandard";
					}
					$.ajax({
						url:urlsell,
						data:{base_price:base_price,buyamount:buyamount,buytotaltext:buytotaltext,feescalculationtext:feescalculationtext,buybasecurrency:buybasecurrency,interfaceexid:interfaceexid,currency:currency},
						type:"POST",
						success:function(data)
						{
							 if(data=="yes")
							 {
								 //$('#sellmodal').modal('hide');
								 alert("Added successfully");
						
				
				$.ajax({
				
				url:"home/loadselldata",
				type:"POST",
				datatype:"JSON",
				data:{id:<?php echo $exchangedata[0]['interfaceexid'];?>},
				success:function(d)
				{
					var data=$.parseJSON(d);
					$('.loadselldata').empty();
					 for(var i=0; i<data.length;i++)
					{
					
									
				var html="<tr><td class='numberformat'>"+$.number(data[i].base_price,4)+"</td><td class='numberformat'>"+$.number(data[i].orderamount,4)+"</td><td class='numberformat'>"+$.number(data[i].ordertotal,4)+"</td></tr>";
				 $('.loadselldata').append(html);				
	
						}
						
						 $.ajax({
	
						url:"home/loadselltotal",
						type:"POST",
						data:{id:<?php echo $exchangedata[0]['interfaceexid'];?>},
						success:function(d)
						{
							$('#totalheadsell').html(d);
							
						}
						});		

			
					
				}
				});
						$.ajax({
	
						url:"home/loadactivedata",
						type:"POST",
						datatype:"JSON",
						data:{id:<?php echo $exchangedata[0]['interfaceexid'];?>},
						success:function(d)
						{
							var data=$.parseJSON(d);
							$('.activedata').empty();
							for(var i=0; i<data.length;i++)
							{
								if(data[i].ordertype=='Sell')
								
								{var  t='buy1';  } else {  var t='sell'; }
								
							var html="<tr><td><span class='"+t+"'> "+data[i].ordertype+"</span></td><td>"+$.number(data[i].base_price,4)+"</td><td>"+$.number(data[i].orderamount,4)+"</td><td>"+$.number(data[i].ordertotal,4)+"</td><td>"+data[i].createddate+"</td><td><a href='javascript:void(0);' onclick='deleteorder("+data[i].order_id+")'><img src='images/delete.png' width='16' height='16'></a></td></tr>";			
										 $('.activedata').append(html);				
							}
						
						}
						});
							 	//window.location.reload(true);
								 
								 return true;
							 }
							  else if(data=="balance")
							 {
								 alert("You Dont Have Enough Balance to Place This Order");
								 return false;
							 }
							 else 
							 {
									 return false;
							 }
									}
						});
			
			//	}
			//else
			//{
		//		alert("Minimum"+maxamount+"USD is Required");
		//	}
			
		});
	
	
	$('#buybasecurrency').change(function()
	{
		$('#buyamount').val('');
		
	});
	$('#sellbasecurrency').change(function()
	{
		$('#sellamount').val('');
	});
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
<script type="text/javascript">
	$(document).ready(function() {		
		$("#buycurrencybtn").click(function() {
			
			var sumdata=(parseFloat($("#buybal").val()))*(parseFloat($("#buybasecurrency").val()));

		
			var namefilter = /^[+-]?\d+(\.\d+)?$/;
			
			
			if((parseFloat($("#buytotaltext").val()))>(parseFloat($("#buybal").val())))
			{
				alert("You dont have enough balance to place the Order");
				return false;
			}
		
			if( ($("#buyamount").val()) == "" )
			{
				alert("Please Insert Buy Amount");
				$("#buyamount").val('').focus();
				return false;
			}
			if( ($("#buyamount").val())==0 )
			{
				alert("Amount must be Greater than 0");
				$("#buyamount").val('').focus();
				return false;
			}
			if( ($("#buybasecurrency").val())==0 )
			{
				alert("Amount must be Greater than 0");
				$("#buyamount").val('').focus();
				return false;
			}
			
			
			else
			{
				if( !namefilter.test(($("#buyamount").val())) )
				{
					alert("Amount should be Numeric");				
					return false;
				}
			}
		 var maxamount='<?php echo $buyamt=$this->common->get_setting_value(15);?>';
			//if($("#buyamount").val()>maxamount)
		//	{
			   if(document.getElementById('buybasecurrency').value=='')
					{
				document.getElementById('buybasecurrency').value='<?php if($avg_buy==''){echo $exchangedata[0]['currentprice'];} else {echo $avg_buy;}?>';
					}
			var base_price=document.getElementById('buybasecurrency').value;
			var currency=document.getElementById('currencyname1').value;
			var buyamount=document.getElementById('buyamount').value;
			var buytotaltext=document.getElementById('buytotaltext').value;
			var feescalculationtext=document.getElementById('feescalculationtext').value;
			var buybasecurrency=document.getElementById('buybasecurrency').value;
			var interfaceexid=document.getElementById('interfaceid').value;
			var buyview=document.getElementById('viewtypebuy').value;
			
		if(buyview==0)
		{
			var urlbuy="home/buycurrency";
		}
		else
		{
			var urlbuy="home/buycurrencystandard";
		}
		$.ajax({
			url:urlbuy,
			data:{base_price:base_price,buyamount:buyamount,buytotaltext:buytotaltext,feescalculationtext:feescalculationtext,buybasecurrency:buybasecurrency,interfaceexid:interfaceexid,currency:currency},
			type:"POST",
			success:function(data)
			{
				 if(data=="yes")
				 {
					
						//$('#myModal').modal('hide');
				     	 alert("Added successfully");
					 	//	setInterval(function() {		
							 $.ajax({
							
							url:"home/loadbuydata",
							type:"POST",
							datatype:"JSON",
							data:{id:<?php echo $exchangedata[0]['interfaceexid'];?>},
							success:function(d)
							{
								var data=$.parseJSON(d);
								$('.loadbuydata').empty();
								 for(var i=0; i<data.length;i++)
							{
			
				var html="<tr><td class='numberformat'>"+$.number(data[i].base_price,4)+"</td><td class='numberformat'>"+$.number(data[i].orderamount,4)+"</td><td class='numberformat'>"+$.number(data[i].ordertotal,4)+"</td></tr>";
				 $('.loadbuydata').append(html);
			
								}
							 $.ajax({
	
							url:"home/loadbuytotal",
							type:"POST",
							data:{id:<?php echo $exchangedata[0]['interfaceexid'];?>},
							success:function(d)
							{
								$('#totalheadbuy').html(d);
								
							}
							});		
		
								//}, 1000 * 60 * 1);
								//console.log;
								
							}
							});
									$.ajax({
	
						url:"home/loadactivedata",
						type:"POST",
						datatype:"JSON",
						data:{id:<?php echo $exchangedata[0]['interfaceexid'];?>},
						success:function(d)
						{
							var data=$.parseJSON(d);
							$('.activedata').empty();
							for(var i=0; i<data.length;i++)
							{
								if(data[i].ordertype=='Sell')
								
								{var  t='buy1';  } else {  var t='sell'; }
								
							var html="<tr><td><span class='"+t+"'> "+data[i].ordertype+"</span></td><td>"+$.number(data[i].base_price,4)+"</td><td>"+$.number(data[i].orderamount,4)+"</td><td>"+$.number(data[i].ordertotal,4)+"</td><td>"+data[i].createddate+"</td><td><a href='javascript:void(0);' onclick='deleteorder("+data[i].order_id+")'><img src='images/delete.png' width='16' height='16'></a></td></tr>";			
										 $('.activedata').append(html);				
							}
					
						}
						});
					// window.location.reload(true);
					 return true;
				 }
				 else if(data=="balance")
				 {
					 alert("You Dont Have Enough Balance to Place This Order");
					 return false;
				 }
				 else 
				 {
					 	 return false;
				 }
			}
			});
			
			//}
			//else
		//	{
		//	alert("Minimum"+maxamount+"USD is Required");
		//	}
			
		});});
		
</script> 
<?php }?>
<!-- /.header-top-links -->

<div class="section_wrapper">
      <div id="wrapper"> 
    <!-- /.row -->
    <div class="section1">
          <?php if( $this->session->flashdata('success') ) { ?>
          <div class="alert alert-success col-sm-6" style=" width: 99%;"> <?php echo $this->session->flashdata('success'); ?> <a href="#" class="close" data-dismiss="alert">&times;</a> </div>
          <?php } ?>
          <?php if( $this->session->flashdata('error') ) { ?>
          <div class="alert alert-danger col-sm-6" style="width: 99%;"> <?php echo $this->session->flashdata('error'); ?> <a href="#" class="close" data-dismiss="alert">&times;</a> </div>
          <?php } ?>
          <div class="chart_section">
        <ul>
              <?php if((isset($exchanges)) && (!empty($exchanges) && (count($exchanges)>0)))
					{
					
						for($i=0;$i<count($exchanges);$i++)
						{
								
					    $tocurr=$this->homes->get_currency_name($exchanges[$i]['tocurrencyid']);	
						$fromcurr=$this->homes->get_currency_name($exchanges[$i]['fromcurrencyid']);	
						if(!empty($tocurr) && !empty($fromcurr)){
							
							if($this->uri->segment(3)=='')
							{
							?>
              <li class="value_button"><a href="home/index/<?php echo $exchanges[$i]['interfaceexid'];?>" <?php if(($i==0) ){?>class="current"<?php }?> title="<?php $fromcurr=$this->homes->get_currency_name($exchanges[$i]['fromcurrencyid']); echo $fromcurr[0]['currencycode'];?> / <?php $tocurr=$this->homes->get_currency_name($exchanges[$i]['tocurrencyid']); echo $tocurr[0]['currencycode'];?>">
                <div>
                <?php $fromcurr=$this->homes->get_currency_name($exchanges[$i]['fromcurrencyid']); echo $fromcurr[0]['currencycode'];?>
                /
                <?php $tocurr=$this->homes->get_currency_name($exchanges[$i]['tocurrencyid']); echo $tocurr[0]['currencycode'];?>
              </div>
                <div class="small"><?php echo round($exchanges[$i]['currentprice'],4);?></div>
                </a> </li>
              <?php } else {?>
              <li class="value_button"><a href="home/index/<?php echo $exchanges[$i]['interfaceexid'];?>" <?php if(($this->uri->segment(3)==$exchanges[$i]['interfaceexid']) ){?>class="current"<?php }?> title="<?php $fromcurr=$this->homes->get_currency_name($exchanges[$i]['fromcurrencyid']); echo $fromcurr[0]['currencycode'];?> / <?php $tocurr=$this->homes->get_currency_name($exchanges[$i]['tocurrencyid']); echo $tocurr[0]['currencycode'];?>">
                <div>
                <?php $fromcurr=$this->homes->get_currency_name($exchanges[$i]['fromcurrencyid']); echo $fromcurr[0]['currencycode'];?>
                /
                <?php $tocurr=$this->homes->get_currency_name($exchanges[$i]['tocurrencyid']); echo $tocurr[0]['currencycode'];?>
              </div>
                <div class="small"><?php echo round($exchanges[$i]['currentprice'],4);?></div>
                </a> </li>
              <?php  }}}}?>
            </ul>
      </div>
          <div class="clearfix"></div>
          <div class="button">
        <?php if($gtype=='today'){
		?>
        <div class="today"> <a href="home/index/<?php echo $ex_id;?>" class="current" title="today">Today</a> </div>
        <?php	
		}else{?>
        <div class="today"> <a href="home/index/<?php echo $ex_id;?>" class="" title="today">Today</a> </div>
        <?php } ?>
        <?php if($this->uri->segment(4)=='w'){
		?>
        <div class="today"> <a href="home/index/<?php echo $ex_id;?>/w" title="Weekly" class="current">Weekly</a> </div>
        <?php	
		}else{?>
        <div class="today"> <a href="home/index/<?php echo $ex_id;?>/w" title="Weekly">Weekly</a> </div>
        <?php } ?>
        <?php if($this->uri->segment(4)=='m'){
		?>
        <div class="today"> <a href="home/index/<?php echo $ex_id;?>/m" title="Monthly" class="current">Monthly</a> </div>
        <?php	
		}else{?>
        <div class="today"> <a href="home/index/<?php echo $ex_id;?>/m" title="Monthly">Monthly</a> </div>
        <?php } ?>
      </div>
          <?php if(count($check_order)==0)
		 {?>
          <div class="chart">
        <div id="chart_div" style="width: 770px; height: 450px;" align="center"> No Active orders. </div>
      </div>
          <?php }else
	  {
	  ?>
          <div class="chart">
        <div id="chart_div" style="width: 780px; height: 450px;"></div>
      </div>
          <?php
	  } ?>
          <div class="clearfix"></div>
          <div class="hty" align="center"> 
        <!-- Correct form message -->
         <?php if((isset($exchanges)) && (!empty($exchanges))){?>
        <select name="viewtypebuy" id="viewtypebuy"  onchange="return viewmodebuy(this.value);" style="margin-left: 270px;
    margin-top: 10px;">
              <option value="1">Standard</option>
              <option value="0" selected="selected">Advanced</option>
            </select>
           <?php }?>
      </div>
   
          <?php if((isset($exchanges)) && (!empty($exchanges))){
		  $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']);
		  $tocurr=$this->homes->get_currency_name($exchangedata[0]['tocurrencyid']);
		  ?>
          <div class="box">
        <div class="buy_box">
              <h2 class="head">Buy <?php echo $fromcurr[0]['currencycode'];?></h2>
              <div class="balance_part">
            <table class="table">
                  <tbody>
                <tr>
                      <td><span>Your balance: </span></td>
                      <td><span>Lowest ask Price</span></td>
                    </tr>
                <tr>
                      <td class="highlight">		   <?php if( array_key_exists('cc_user',$this->session->userdata) )
	  		{?>			
				<input type="hidden" name="buybal" id="buybal" value="<?php echo $balance=$this->homes->get_userbalance($tocurr[0]['currencycode']);?>" onclick="changeamountbuy(this.value);"/><a href="javascript:void(0);"  onclick="changeamountbuy('<?php echo $balance=$this->homes->get_userbalance($tocurr[0]['currencycode']);?>');" > <span id="buybalancetext"><?php echo $balance=$this->homes->get_userbalance($tocurr[0]['currencycode']);?></span>
                      <?php } else { echo 0; }?>
                    <?php $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']); echo $tocurr[0]['currencycode'];?></a></td>
                      <td><?php $lowestprice=$this->homes->get_lowest_price($exchangedata[0]['interfaceexid']); if(!empty($lowestprice)) echo number_format($lowestprice,4); else echo number_format($exchangedata[0]['currentprice'],4);?>
                    <?php $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']); echo $tocurr[0]['currencycode'];?></td>
                    </tr>
              </tbody>
                </table>
          </div>
              <table class="table">
            <tbody>
                  <tr>
                <td>Amount
                      <?php $tocurr=$this->homes->get_currency_name($exchangedata[0]['tocurrencyid']); echo $fromcurr[0]['currencycode'];?>
                      : </td>
                <td><input type="text" name="buyamount" id="buyamount" onKeyUp="changepricebuy(this.value);" maxlength="10" class="checkno"></td>
              </tr>
                  <tr class="mainbuybase">
                <td>Price per
                      <?php $tocurr=$this->homes->get_currency_name($exchangedata[0]['tocurrencyid']); echo $fromcurr[0]['currencycode'];?>
                      : </td>
                <td><div class="mainbuybase">
                    <input type="text" id="buybasecurrency" name="buybasecurrency" maxlength="10" value="<?php if($avg_buy==''){echo number_format($exchangedata[0]['currentprice'],4);} else {echo number_format($avg_buy,4);}?>" class="checkno">
                    <?php $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']);echo $tocurr[0]['currencycode'];?>
                  </div></td>
              </tr>
                  <tr class="mainbuybase" >
                <td>Total :</td>
                <td ><div class="mainbuy">
                    <div class="buytotal">0</div>
                    &nbsp;<?php echo $tocurr[0]['currencycode'];?>
                    <input type="hidden"  name="buytotaltext" id="buytotaltext">
                    <input type="hidden" id="currencyname1" name="currencyname1"  class="checkno" value="<?php echo $tocurr[0]['currencycode'];?>"></td>

                  </div></td>
              </tr>
                  <tr>
                <td>Fee : <br />
<span style="font-size:10px;font-style:italic">(Fees Will be <?php if(!empty($fees)) echo $fees;?>% each transaction)</span>
</td>
                <td><div class="buyfees">
                
                  </div><div id="feescalculation" class="buyfees">0 </div>
                      &nbsp; <?php echo $fromcurr[0]['currencycode'];?>
                      <input type="hidden" name="feestext" id="feestext" value="<?php if(!empty($fees)){ echo $fees;}?>">
                      <input type="hidden" id="interfaceid" name="interfaceid" value="<?php echo $exchangedata[0]['interfaceexid'];?>"></td>
              </tr>
                  <tr>
                <td></td>
                <td>
                      <input type="hidden"  name="feescalculationtext" id="feescalculationtext"></td>
              </tr>
                </tbody>
          </table>
              <div class="btn_panel">
            <div class="calculate"> <a href="javascript:void(0);" class="buy" title="Calculate" onClick="calculatefeesbuy();">Calculate</a> </div>
            <?php if( array_key_exists('cc_user',$this->session->userdata) )
								  {?>
            <a href="javascript:void(0);" name="buycurrency" id="buycurrencybtn" class="buy" title="Buy">Buy
                <?php $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']); echo $fromcurr[0]['currencycode'];?>
                </a>
            <?php /*?>  <button type="submit" class="buy" name="buycurrency" id="buycurrencybtn" value="Buy <?php $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']); echo $fromcurr[0]['currencycode'];?>">Buy
            <?php $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']); echo $fromcurr[0]['currencycode'];?>
            </button><?php */?>
            <?php  } else {?>
            <a href="javascript:void(0);"  class="buy" id="loginbtn" title="login" onclick="showlogin();">Buy <?php echo $fromcurr[0]['currencycode'];?> </a>
            <?php  }?>
          </div>
            </div>
      </div>
          <?php }?>
          <?php if((isset($exchanges)) && (!empty($exchanges))){?>
          <div class="box last_box">
        <div class="cell_box">
              <h2 class="head">Sell
            <?php $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']); echo $fromcurr[0]['currencycode'];?>
          </h2>
              <div class="head" style="float: right; margin-top: -36px;" > </div>
              <div class="balance_part">
            <table class="table">
                  <tbody>
                <tr>
                      <td><span>Your balance: </span></td>
                      <td><span>Highest ask Price</span></td>
                    </tr>
                <tr>
                      <td class="highlight">
					   <?php if( array_key_exists('cc_user',$this->session->userdata) )
	  		{?>			
					<input type="hidden" name="sellbal" id="sellbal" value="<?php echo $balance=$this->homes->get_userbalance($fromcurr[0]['currencycode']);?>"/> <a href="javascript:void(0);"  onclick="changeamountsell('<?php echo $balance=$this->homes->get_userbalance($fromcurr[0]['currencycode']);?>');" ><span id="sellbalancetext"> <?php echo $balance=$this->homes->get_userbalance($fromcurr[0]['currencycode']);?></span>
                      <?php } else { echo 0; }?> 
                    <?php $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']); echo $fromcurr[0]['currencycode'];?></a></td>
                      <td><?php $higestprice=$this->homes->get_higest_price($exchangedata[0]['interfaceexid']); if(!empty($higestprice)) echo number_format($higestprice,4); else echo number_format($exchangedata[0]['currentprice'],4); ?>
                    <?php $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']); echo $tocurr[0]['currencycode'];?></td>
                    </tr>
              </tbody>
                </table>
          </div>
              <table class="table">
            <tbody>
                  <tr>
                <td>Amount
                      <?php $tocurr=$this->homes->get_currency_name($exchangedata[0]['tocurrencyid']); echo $fromcurr[0]['currencycode'];?>
                      :
                      <input type="hidden" id="currencyname" name="currencyname"  class="checkno" value="<?php echo $fromcurr[0]['currencycode'];?>"></td>
                <td><input type="text" id="sellamount" name="sellamount" onKeyUp="changepricesell(this.value);" maxlength="10" class="checkno"></td>
              </tr>
                  <tr class="mainsellbase">
                <td>Price per
                      <?php $tocurr=$this->homes->get_currency_name($exchangedata[0]['tocurrencyid']); echo $fromcurr[0]['currencycode'];;?>
                      : </td>
                <td><div class="mainsellbase">
                    <input type="text" id="sellbasecurrency" name="sellbasecurrency" maxlength="10" value="<?php if($avg_sell==''){echo number_format($exchangedata[0]['currentprice'],4);} else {echo number_format($avg_sell,4);}?>" class="checkno">
                    <?php $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']); echo $tocurr[0]['currencycode'];?>
                  </div></td>
                  </td>
              </tr>
                  <tr class="mainsellbase">
                <td>Total :</td>
                <td><div class="mainsell">
                    <div class="selltotal">0</div>
                    &nbsp; <?php echo $tocurr[0]['currencycode'];?>
                    <input type="hidden"  name="selltotaltext" id="selltotaltext">
                  </div></td>
              </tr>
                  <tr>
                <td>Fee :<br />
<span style="font-size:10px; font-style:italic">(Fees Will be <?php if(!empty($fees)) echo $fees;?>% each transaction)</span>
</td>
                <td><div class="sellfees">
                    </div>
                    <div id="feescalculationsell" class="sellfees">0</div>
                      &nbsp; <?php echo $tocurr[0]['currencycode'];?>
                      <input type="hidden" name="feestext" id="feestext"  value="<?php if(!empty($fees)) echo $fees;?>">
                      <input type="hidden" id="interfaceid" name="interfaceid" value="<?php if(!empty($fees)) echo $fees;?>"></td>
              </tr>
                  <tr>
                <td></td>
                <td>
                      <input type="hidden"  name="feescalculationselltext" id="feescalculationselltext"></td>
              </tr>
                </tbody>
          </table>
              <div class="btn_panel">
            <div class="calculate"> <a href="javascript:void(0);"  class="buy" title="Calculate" onClick="calculatefeessell();">Calculate</a> </div>
            <?php if( array_key_exists('cc_user',$this->session->userdata) )
								  {?>
            <a href="javascript:void(0);" name="sellcurrency" id="sellcurrency" class="buy" title="Sell">Sell
                <?php $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']); echo $fromcurr[0]['currencycode'];?>
                </a>
            <?php /*?> <button type="submit" class="buy" name="sellcurrency" id="sellcurrency" >Sell
            <?php $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']); echo $fromcurr[0]['currencycode'];?>
            </button><?php */?>
            <?php } else {?>
            <a href="javascript:void(0);" class="buy" title="login" onclick="showlogin();">Sell <?php echo $fromcurr[0]['currencycode'];?></a>
            <?php }?>
          </div>
            </div>
      </div>
          <?php }?>
        </div>
    <div class="chat">
          <div class="main-window">
        <div class="msgWindow scroll" id="en">
              <?php 
				  
				 
				      if(count($userposts)>0){
                      for($i=(count($userposts)-1);$i>=0;$i--)
                      {
                      ?>
              <span class="allMsg">
         <?php /*?> <?php if($userposts[$i]['avatar']==''){?>
          <img alt="avatar" class="img-responsive" src="images/avatar.jpg">
          <?php } else {?>
          <img alt="avatar" class="img-responsive" src="<?php echo $this->config->item('avatar_upload_path').$userposts[$i]['avatar'];?>" height="40" width="40">
          <?php }?><?php */?>
          <span style="" class="user"><?php echo $userposts[$i]['username'];?> : </span><?php /*?><span class="time"><?php echo date('M d H:i',strtotime($userposts[$i]['createddate']));?></span><br><?php */?>
          <?php echo $userposts[$i]['message'];?></span>
              <?php  } } else {?>
              <?php if( array_key_exists('cc_user',$this->session->userdata) )
	  					{?>
              <p style="font-size: 10px;">No Chat Available start chat by adding message below</p>
              <?php } else {?>
               <p style="font-size: 10px;">No Chat Available Login and start chat </p>

              <?php }?>
           
              <?php }?>
            </div>
        <?php if( array_key_exists('cc_user',$this->session->userdata) )
	  					{?>
        <div class="sender-btn"></div>
        <textarea maxlength="500" type="text" name="messagepost" placeholder="Post Your Message Here" id="messagepost" style="resize: none;"></textarea>
        <?php }?>
        <!--<div class="users-online">
                          <span class="usersonline">1854</span>  users online
        </div>--> 
      </div>
          <div class="main-window" style="margin-top:15px;">
          <?php $int_id =  $this->session->userdata('interfaceid');
		  	if($int_id==0)
			{
				$fb_widget_url = $this->common->get_setting_value(20);
				$fb_widget_id = $this->common->get_setting_value(22);
				$tw_widget_url = $this->common->get_setting_value(21);
				$tw_widget_id = $this->common->get_setting_value(23);
			}
			else
			{
				$fb_widget_url = $this->common->get_interface_setting_value_bynameanduid('fburl',$int_id);
				$fb_widget_id = $this->common->get_interface_setting_value_bynameanduid('fburlid',$int_id);
				$tw_widget_url = $this->common->get_interface_setting_value_bynameanduid('twitterurl',$int_id);
				$tw_widget_id = $this->common->get_interface_setting_value_bynameanduid('twitterurlid',$int_id);
			}
		  ?>
        <?php if($fb_widget_url!='' && $fb_widget_id!='' && $tw_widget_url!='' && $tw_widget_id!='')  {?>
        <div class="scroll" id="en">
              <div class="innr_rght_blck" > <a class="twitter-timeline"  href="<?php echo $tw_widget_url;?>"  data-widget-id="<?php echo $tw_widget_id;?>">Tweets</a> 
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script> 
          </div>
              <div class="innr_rght_blck">
            <iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo urlencode($fb_widget_url);?>&amp;width&amp;height=62&amp;colorscheme=light&amp;show_faces=false&amp;header=true&amp;stream=false&amp;show_border=true&amp;appId=<?php echo ($fb_widget_id);?>" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:auto;" allowTransparency="true"></iframe>
          </div>
            </div>
        <?php } ?>    
      </div>
       <div class="section1">
          <?php if((isset($exchanges)) && (!empty($exchanges))){?>
         
        <div class="" style="width:99%;">
              <div class="" style="width:48%;float:left; min-height:100px !important"">
            <h2 class="order_head">Buy Orders</h2>
            <h3 class="total_head">Total : <span  id="totalheadbuy"><?php echo number_format($totalbuy,4);?></span>
                  <?php $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']); echo $tocurr[0]['currencycode'];?>
                </h3>
            
            <div class="ordertable">
                
                  <div class="content_2 content">
                <table class="table table-striped table-bordered " id="buytable">
                 <thead>
                  <tr class="tble_heading">
                   <td title="Click Here to Sort by Price" style="cursor:pointer">Price</td>
                    <td title="Click Here to Sort by <?php $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']); echo $fromcurr[0]['currencycode'];?>" style="cursor:pointer"><?php $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']); echo $fromcurr[0]['currencycode'];?></td>
                    <td title="Click Here to Sort by <?php $tocurr=$this->homes->get_currency_name($exchangedata[0]['tocurrencyid']); echo $tocurr[0]['currencycode'];?>" style="cursor:pointer"><?php $tocurr=$this->homes->get_currency_name($exchangedata[0]['tocurrencyid']); echo $tocurr[0]['currencycode'];?></td>
    	
                  </tr>
                  </thead>
                  
                   <tbody class="loadbuydata">
                    
                    <?php 	if(count($buyorderlist)>0){ for($i=0;$i<count($buyorderlist);$i++){
						
						
						?>
                    <tr>
                          <td><?php  $buyorderlist[$i]['order_id'];?><?php echo number_format($buyorderlist[$i]['base_price'],4);?></td>
                          <td><?php echo number_format($buyorderlist[$i]['orderamount'],4);?></td>
                          <td><?php echo number_format($buyorderlist[$i]['ordertotal'],4);?></td>
                       
                        </tr>
                    <?php } } else {?>
                  	<td colspan="3">No Orders Found</td>
                    <?php }?>
               	</tbody>
                 
                    </table>
              </div>
                 
                </div>
          </div>
              <div class="last_box" style="float: left;
    margin-left: 23px;
    width: 48%; min-height:100px !important">
            <h2 class="order_head">Sell Orders</h2>
            <h3 class="total_head">Total : <span  id="totalheadsell"><?php echo number_format($totalsell,4);?></span>
                  <?php $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']); echo $fromcurr[0]['currencycode'];?>
                </h3>
            
            <div class="ordertable">
              
                  <div class="content_2 content">
                <table class="table table-striped table-bordered " id="selltable" >
                   <thead class="tble_heading">
                   <tr>
                    <td title="Click Here to Sort by Price" style="cursor:pointer">Price</td>
                    <td title="Click Here to Sort by <?php $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']); echo $fromcurr[0]['currencycode'];?>" style="cursor:pointer"><?php $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']); echo $fromcurr[0]['currencycode'];?></td>
                    <td title="Click Here to Sort by <?php $tocurr=$this->homes->get_currency_name($exchangedata[0]['tocurrencyid']); echo $tocurr[0]['currencycode'];?>" style="cursor:pointer"><?php $tocurr=$this->homes->get_currency_name($exchangedata[0]['tocurrencyid']); echo $tocurr[0]['currencycode'];?></td>
                  </tr>
                    </thead>
                      <tbody class="loadselldata">
                  <?php if(count($sellorderlist)>0){  for($i=0;$i<count($sellorderlist);$i++){?>
                    <tr>
                          <td><?php echo number_format($sellorderlist[$i]['base_price'],4);?></td>
                          <td><?php echo number_format($sellorderlist[$i]['orderamount'],4);?></td>
                          <td><?php echo number_format($sellorderlist[$i]['ordertotal'],4);?></td>
                                  </tr>
                   
                     <?php } } else {?>
                  	<td colspan="3">No Orders Found</td>
                    <?php }?>
                  </tbody>
                    </table>
              </div>
                 
                </div>
          </div>
            </div>
        <?php }?>
        <?php if((empty($exchanges))){?>
        <h3 align="center">Sorry No Exchanges available at this moment!</h3>
        <?php }?>

        <div class="" style="width:98% !important; clear:both;">
              <h2 class="order_head">Your current active orders</h2>
  
            
              <div class="historytable">
            <table class="table table-striped table-bordered" id="activeorder">
            <thead class="order_heading2">
                <tr>
                      <td title="Click Here to Sort by Type" style="cursor:pointer">Type</td>
                      <td title="Click Here to Sort by Price" style="cursor:pointer">Price</td>
                      <td title="Click Here to Sort by Amount" style="cursor:pointer">Amount(
                    <?php $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']); echo $fromcurr[0]['currencycode'];?>
                    )</td>
                      <td title="Click Here to Sort by Total" style="cursor:pointer">Total (
                    <?php $tocurr=$this->homes->get_currency_name($exchangedata[0]['tocurrencyid']); echo $tocurr[0]['currencycode'];?>
                    )</td>
                      <td title="Click Here to Sort by Date" style="cursor:pointer">Date</td>
                      <td>Action</td>
                    </tr>
              </thead>
                  <tbody class="activedata">
                <?php if(count($activeorders)>0)
			  { 
			  ?>
                <?php for($i=0;$i<count($activeorders);$i++){?>
                <tr>
                      <td><span class="<?php if($activeorders[$i]['ordertype']=='Sell'){?>buy1 <?php } else {?> sell<?php }?>"><?php echo $activeorders[$i]['ordertype'];?></span></td>
                      <td><?php echo number_format($activeorders[$i]['base_price'],4);?></td>
                      <td><?php echo number_format($activeorders[$i]['orderamount'],4);?></td>
                      <td><?php echo number_format($activeorders[$i]['ordertotal'],4);?>
                     <?php $tocurr=$this->homes->get_currency_name($exchangedata[0]['tocurrencyid']); echo $tocurr[0]['currencycode'];?></td>
                      <td><?php echo $activeorders[$i]['createddate'];?></td>
                     <td><a href="javascript:void(0);" onclick="deleteorder(<?php echo $activeorders[$i]['order_id'];?>)"><img src='images/delete.png' width='16' height='16'></a></td>

                    </tr>
                <?php }?>
                <?php } else {?>
                 <tr><td colspan="6"> No active orders at the moment.</td></tr>
                  <?php }?>
                    </tbody>
                  
                </table>
                
          </div>
            </div>
        <div class="" style="width:98% !important;">
              <h2 class="order_head">Trade History</h2>
          
              <div class="historytable content_2" >
            <table class="table table-striped table-bordered" id="histable">
             <thead class="order_heading2">
                <tr>
                      <td title="Click Here to Sort by Date" style="cursor:pointer">Date</td>
                      <td title="Click Here to Sort by Type" style="cursor:pointer" class="type">Type</td>
                      <td title="Click Here to Sort by Price" style="cursor:pointer" class="price">Price</td>
                      <td title="Click Here to Sort by Amount" style="cursor:pointer">Amount(
                    <?php $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']); echo $fromcurr[0]['currencycode'];?>
                    )</td>
                      <td title="Click Here to Sort by Total" style="cursor:pointer">Total (
                    <?php $tocurr=$this->homes->get_currency_name($exchangedata[0]['tocurrencyid']); echo $tocurr[0]['currencycode'];?>
                    )</td>
                    </tr>
              </thead>
                  <tbody class="historydata">
                <?php if(count($orderhistory)>0){
								for($i=0;$i<count($orderhistory);$i++){?>
                <tr>
                      <td><?php echo $orderhistory[$i]['createddate'];?></td>
                      <td class="type sell"><?php echo $orderhistory[$i]['ordertype'];?></td>
                      <td class="price"><?php echo  number_format($orderhistory[$i]['base_price'],4);?></td>
                      <td><?php echo  number_format($orderhistory[$i]['orderamount'],4);?></td>
                      <td><?php echo  number_format($orderhistory[$i]['ordertotal'],4);?></td>
                    </tr>
                <?php } } else {?>
                 <tr><td colspan="5">  No Record Found</td></tr>
                  <?php }?>
                    </tbody>
                  
                </table>
          </div>
            </div>
      </div>
        </div> 
        <div class="services_part">
          <ul>
        <?php $earn = $this->common->get_page_by_uniquename('Earn');?>
        <?php if(count($earn)>0)
		{?>
        <a href="page/Earn" title="Read More">
            <li>
          <h3 class="services_head"><i><img src="images/earn.png" alt=""></i><?php echo $earn[0]['heading'];?></h3>
          <p><?php echo $earn[0]['shortdesc'];?></p>
        </li>
            </a>
        <?php }?>
        <?php $tools = $this->common->get_page_by_uniquename('Tools');?>
        <?php if(count($tools)>0)
		{?>
        <a href="page/Tools" title="Read More">
            <li>
          <h3 class="services_head"><i><img src="images/tools.png" alt=""></i><?php echo $tools[0]['heading'];?></h3>
          <p><?php echo $tools[0]['shortdesc'];?></p>
        </li>
            </a>
        <?php }?>
        <?php $settings = $this->common->get_page_by_uniquename('Custom-settings');?>
        <?php if(count($settings)>0)
		{?>
        <a href="page/Custom-settings" title="Read More">
            <li>
          <h3 class="services_head"><i><img src="images/setting.png" alt=""></i><?php echo $settings[0]['heading'];?></h3>
          <p><?php echo $settings[0]['shortdesc'];?></p>
        </li>
            </a>
        <?php }?>
        <?php $Security = $this->common->get_page_by_uniquename('Security');?>
        <?php if(count($Security)>0)
		{?>
        <a href="page/Security" title="Read More">
            <li>
          <h3 class="services_head"><i><img src="images/security.png" alt=""></i><?php echo $Security[0]['heading'];?></h3>
          <p><?php echo $Security[0]['shortdesc'];?></p>
        </li>
            </a>
        <?php }?>
        <?php $Audience = $this->common->get_page_by_uniquename('Audience-Targetring');?>
        <?php if(count($Audience)>0)
		{?>
        <a href="page/Audience-Targetring" title="Read More">
            <li>
          <h3 class="services_head"><i><img src="images/audience.png" alt=""></i><?php echo $Audience[0]['heading'];?></h3>
          <p><?php echo $Audience[0]['shortdesc'];?></p>
        </li>
            </a>
        <?php }?>
        <?php $High = $this->common->get_page_by_uniquename('High-efficiency');?>
        <?php if(count($High)>0)
		{?>
        <a href="page/High-efficiency" title="Read More">
            <li>
          <h3 class="services_head"><i><img src="images/high.png" alt=""></i><?php echo $High[0]['heading'];?></h3>
          <p><?php echo $High[0]['shortdesc'];?></p>
        </li>
            </a>
        <?php }?>
        <?php $Market = $this->common->get_page_by_uniquename('Market-pricing');?>
        <?php if(count($Market)>0)
		{?>
        <a href="page/Market-pricing" title="Read More">
            <li>
          <h3 class="services_head"><i><img src="images/univercity.png" alt=""></i><?php echo $Market[0]['heading'];?></h3>
          <p><?php echo $Market[0]['shortdesc'];?></p>
        </li>
            </a>
        <?php }?>
        <?php $Privacy = $this->common->get_page_by_uniquename('Privacy');?>
        <?php if(count($Privacy)>0)
		{?>
        <a href="page/Privacy" title="Read More">
            <li>
          <h3 class="services_head"><i><img src="images/priverce.png" alt=""></i><?php echo $Privacy[0]['heading'];?></h3>
          <p><?php echo $Privacy[0]['shortdesc'];?></p>
        </li>
            </a>
        <?php }?>
      </ul>
        </div>
        <?php /*?> <?php $footerpages = $this->common->get_page_footer();?>
        <?php if(count($footerpages)>0)
			{?>
    <div class="services_part">
          
        <ul>
     <?php
			for($i=0;$i<count($footerpages);$i++){
			?>
        <a href="page/<?php echo $footerpages[$i]['uniquename'];?>" title="Read More">
            <li>
          <h3 class="services_head"><i><img src="images/earn.png" alt=""></i><?php echo $footerpages[$i]['heading'];?></h3>
          <p><?php echo $footerpages[$i]['shortdesc'];?></p>
        </li>
    </a>
        <?php } ?>
 
      
      </ul>
    
        </div>
          <?php }?><?php */?>
  </div>
    </div>
<script>

$('#messagepost').on('keydown', function(e) {
    if (e.which == 13) {
		var message=$(this).val();
		
		if(message!='' && message.length>0)
		{
	        e.preventDefault();
		$.ajax({
			url:"home/addpost",
			type:"post",
			data:{message:message},
			success:function(data)
			{
				document.getElementById('messagepost').value='';
				//alert('Message successfully posted');
					$.ajax({
	
					url:"home/loadmessagedata",
					type:"POST",
					datatype:"JSON",
					success:function(d)
					{
						var data1=$.parseJSON(d);
						var data=data1.reverse();
						$('.msgWindow').empty();
						for(var i=0; i<data.length;i++)
						{
						
						/*if(data[i].avatar=='')
						{
						var image='images/avatar.jpg';
						}
						else
						{
						var image='<?php echo $this->config->item('avatar_upload_path');?>/'+data[i].avatar;
						}*/
						
						var html="<span class='allMsg'><span class='user' >"+data[i].username+" </span>:"+data[i].message+"</span>";
						//var html="<span class='allMsg'><img src='"+image+"' class='img-responsive' alt='avatar'><span class='user' >"+data[i].username+" </span><span class='time'>"+data[i].createddate+"</span><br>"+data[i].message+"</span>";
						//	var html="<tr><td>"+data[i].base_price+"</td><td>"+data[i].orderamount+"</td><td>"+data[i].ordertotal+"</td></tr>";
						$('.msgWindow').append(html);
						}
						console.log;
						
					}
					});
			}
			});
		}
		else
		{
			alert("please input any message");
		}
    }
});

</script> 
	<?php if(strlen($exchangedata[0]['interfaceexid'])>0){?>
<script>
function deleteorder(id)
{
	
	var x=confirm("Are you sure to delete this order?");
	if(x==true)
	{
		$.ajax({
			url:"home/removeorder",
			data:{id:id},
			type:"post",
			success:function(d)
			{
				if(d==1)
					{
						alert("Order Deleted Successfully");
						
								$.ajax({
	
								url:"home/loadactivedata",
								type:"POST",
								datatype:"JSON",
								data:{id:<?php echo $exchangedata[0]['interfaceexid'];?>},
								success:function(d)
								{
									var data=$.parseJSON(d);
									$('.activedata').empty();
									for(var i=0; i<data.length;i++)
									{
										if(data[i].ordertype=='Sell')
										
										{var  t='buy1';  } else {  var t='sell'; }
										
									var html="<tr><td><span class='"+t+"'> "+data[i].ordertype+"</span></td><td>"+$.number(data[i].base_price,4)+"</td><td>"+$.number(data[i].orderamount,4)+"</td><td>"+$.number(data[i].ordertotal,4)+"</td><td>"+data[i].createddate+"</td><td><a href='javascript:void(0);' onclick='deleteorder("+data[i].order_id+")'><img src='images/delete.png' width='16' height='16'></a></td></tr>";			
												 $('.activedata').append(html);				
									}
									
									$.ajax({
	
									url:"home/loadbuytotal",
									type:"POST",
									data:{id:<?php echo $exchangedata[0]['interfaceexid'];?>},
									success:function(d)
									{
										$('#totalheadbuy').html(d);
										
									}
									});
									 $.ajax({
	
									url:"home/loadselltotal",
									type:"POST",
									data:{id:<?php echo $exchangedata[0]['interfaceexid'];?>},
									success:function(d)
									{
										$('#totalheadsell').html(d);
										
									}
									});				
							
							
								}
								});
						
					}
					else
					{
						alert("Problem While Deleteing Order");
						return false;
					}
			}
			})
		}
	else
	{
		return false;
	}
}
</script>
<?php }?>
<?php if(count($exchangedata)>0){?>
   <script type="text/javascript">
	 $(document).ready(function()
	 {
		 setInterval(function() {
	  $.ajax({
		  url:"home/getbalancefrom",
		  data:{id:<?php echo $exchangedata[0]['fromcurrencyid'];?>},
		  type:"POST",
		  success:function(d)
		  {
			$('#sellbalancetext').html(d);
			$('#sellbal').val(d);
			
		  }
		  });
		  
		   $.ajax({
		  url:"home/getbalanceto",
		  data:{id:<?php echo $exchangedata[0]['tocurrencyid'];?>},
		  type:"POST",
		  success:function(d)
		  {
			  $('#buybalancetext').html(d)
			  $('#buybal').val(d);
		  }
		  });
		  }, 1000 * 60 * 0.5);	
	
		  }); 
	  </script>
      <?php }?>
<?php echo $footer;?>
</body>
</html>