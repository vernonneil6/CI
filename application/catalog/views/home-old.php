<?php echo $header;
		echo $menu;
		
?>
<script>
//will change view mode
function viewmodebuy(data)
{
	if(data==0)
	{
		$('#buybasecurrency').show();
		$('.mainbuy').show(); 
		$('.mainbuybase').show(); 
	}
	else
	{
		$('#buybasecurrency').hide();
		$('.mainbuy').hide();
		$('.mainbuybase').hide(); 
		
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
<script type="text/javascript">
function showlogin()
{
	$('#modaltrigger').trigger('click');
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
	
	
	 var basefee=$('.buyfees').html();
	 
	 var baseprice=document.getElementById('buyamount').value;
	
		var total=parseFloat(basefee)*parseFloat(baseprice);
		
	$('#feescalculation').html((total));
	document.getElementById('feescalculationtext').value=total;
	
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
	 var basefee=$('.sellfees').html();
	
	 var baseprice=document.getElementById('sellamount').value;
	
		var total=parseFloat(basefee)*parseFloat(baseprice);
		$('#feescalculationsell').html((total));
		document.getElementById('feescalculationselltext').value=total;

}
	 function checkcc2() {
              
			  		
			  		  var code=$("#orderotp2").val();
					  
				 	  if( ($("#orderotp2").val()) == "")
					  {
						  alert("Please Enter OTP CODE");
						  $("#orderotp2").val('').focus();
						  return false;
					  }
					 
							 	 $.ajax({
								  url:"home/checkotpcode",
								  data:{code:code},
								  type:"POST",
								  success:function(data)
								  {
									  if(data=="yes")
									  {
									  
									 if(document.getElementById('sellbasecurrency').value=='')
		{
			document.getElementById('sellbasecurrency').value='<?php if($avg_sell==''){echo $exchangedata[0]['currentprice'];} else {echo $avg_sell;}?>';
		}
		
			var base_price=document.getElementById('sellbasecurrency').value;
			var buyamount=document.getElementById('sellamount').value;
			var buytotaltext=document.getElementById('selltotaltext').value;
			var feescalculationtext=document.getElementById('feescalculationselltext').value;
			var buybasecurrency=document.getElementById('sellbasecurrency').value;
			var interfaceexid=document.getElementById('interfaceid').value;
			var sellview=document.getElementById('viewtypesell').value;
		if(sellview==1)
		{
			var urlsell="home/sellcurrency";
		}
		else
		{
			var urlsell="home/sellcurrencystandard";
		}
		$.ajax({
			url:urlsell,
			data:{base_price:base_price,buyamount:buyamount,buytotaltext:buytotaltext,feescalculationtext:feescalculationtext,buybasecurrency:buybasecurrency,interfaceexid:interfaceexid},
			type:"POST",
			success:function(data)
			{
				 if(data=="yes")
				 {
					 $('#sellmodal').modal('hide');
					 alert("Added successfully");
					 
					 return true;
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
										  alert("Invalid OTP CODE");
							 		 }
								  
								  }
							  });
					 	
					
             
				 }

 function checkcc() {
              
			  		
			  		  var code=$("#orderotp").val();
					  
				 	  if( ($("#orderotp").val()) == "")
					  {
						  alert("Please Enter OTP CODE");
						  $("#orderotp").val('').focus();
						  return false;
					  }
					 
							 	 $.ajax({
								  url:"home/checkotpcode",
								  data:{code:code},
								  type:"POST",
								  success:function(data)
								  {
									  if(data=="yes")
									  {
										  
										   if(document.getElementById('buybasecurrency').value=='')
											{
												document.getElementById('buybasecurrency').value='<?php if($avg_buy==''){echo $exchangedata[0]['currentprice'];} else {echo $avg_buy;}?>';
											}
											
										
											var base_price=document.getElementById('buybasecurrency').value;
											
											var buyamount=document.getElementById('buyamount').value;
											var buytotaltext=document.getElementById('buytotaltext').value;
											var feescalculationtext=document.getElementById('feescalculationtext').value;
											var buybasecurrency=document.getElementById('buybasecurrency').value;
											var interfaceexid=document.getElementById('interfaceid').value;
											var buyview=document.getElementById('viewtypebuy').value;
		if(buyview==1)
		{
			var urlbuy="home/buycurrency";
		}
		else
		{
			var urlbuy="home/buycurrencystandard";
		}
		$.ajax({
			url:urlbuy,
											data:{base_price:base_price,buyamount:buyamount,buytotaltext:buytotaltext,feescalculationtext:feescalculationtext,buybasecurrency:buybasecurrency,interfaceexid:interfaceexid},
											type:"POST",
											success:function(data)
											{
												 if(data=="yes")
												 {
													
													$('#myModal').modal('hide');
													 alert("Added successfully");
													 return true;
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
										  alert("Invalid OTP CODE");
							 		 }
								  
								  }
							  });
					 	
					
             
				 }
$(document).ready(function() {		
		$("#buycurrencybtn").click(function () {
			
			var namefilter = /^[+-]?\d+(\.\d+)?$/;
			
			if( ($("#buyamount").val()) == "" && ($("#buyamount").val())>0 )
			{
				alert("Please Insert Buy Amount");
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
			$.ajax({
							 url:"home/sent_otpcode",
							 type:"POST",
							  success:function(data)
							  {
								$('#myModal').modal();
							  }
			});
			
		});
		
	function buycurrency()
	{
		    if(document.getElementById('buybasecurrency').value=='')
				{
					document.getElementById('buybasecurrency').value='<?php if($avg_buy==''){echo $exchangedata[0]['currentprice'];} else {echo $avg_buy;}?>';
				}
				
			
				var base_price=document.getElementById('buybasecurrency').value;
				
				var buyamount=document.getElementById('buyamount').value;
				var buytotaltext=document.getElementById('buytotaltext').value;
				var feescalculationtext=document.getElementById('feescalculationtext').value;
				var buybasecurrency=document.getElementById('buybasecurrency').value;
				var interfaceexid=document.getElementById('interfaceid').value;
			$.ajax({
				url:"home/buycurrency",
				data:{base_price:base_price,buyamount:buyamount,buytotaltext:buytotaltext,feescalculationtext:feescalculationtext,buybasecurrency:buybasecurrency,interfaceexid:interfaceexid},
				type:"POST",
				success:function(data)
				{
					 if(data=="yes")
					 {
						 alert("Added successfully");
						 return true;
					 }
					 else
					 {
						 return false;
					 }
				}
				});
	}
		$("#sellcurrency").click(function () {
			
				var namefilter = /^[+-]?\d+(\.\d+)?$/;
			
			if( ($("#sellamount").val()) == "" )
			{
				alert("Please Insert Sell Amount");
				$("#sellamount").val('').focus();
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
		$.ajax({
							 url:"home/sent_otpcode",
							 type:"POST",
							  success:function(data)
							  {
								$('#sellmodel').modal();
							  }
			});
			

			
		});
	
		function sellcurrency()
		{
			if(document.getElementById('sellbasecurrency').value=='')
			{
				document.getElementById('sellbasecurrency').value='<?php if($avg_sell==''){echo $exchangedata[0]['currentprice'];} else {echo $avg_sell;}?>';
			}
			
			    var base_price=document.getElementById('sellbasecurrency').value;
				var buyamount=document.getElementById('sellamount').value;
				var buytotaltext=document.getElementById('selltotaltext').value;
				var feescalculationtext=document.getElementById('feescalculationselltext').value;
				var buybasecurrency=document.getElementById('sellbasecurrency').value;
				var interfaceexid=document.getElementById('interfaceid').value;
				
			$.ajax({
				url:"home/sellcurrency",
				data:{base_price:base_price,buyamount:buyamount,buytotaltext:buytotaltext,feescalculationtext:feescalculationtext,buybasecurrency:buybasecurrency,interfaceexid:interfaceexid},
				type:"POST",
				success:function(data)
				{
					 if(data=="yes")
					 {
						 alert("Added successfully");
						 return true;
					 }
					 else
					 {
						 return false;
					 }
				}
				});
			
			
		}
	
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

<!-- /.header-top-links -->

<div class="section_wrapper">
  <div id="wrapper"> 
    <!-- /.row -->
    <div class="section">
      <?php if( $this->session->flashdata('success') ) { ?>
      <div class="alert alert-success col-sm-6" style="margin-left: 7%;
    margin-right: 7%;
    width: 86%;"> <?php echo $this->session->flashdata('success'); ?> <a href="#" class="close" data-dismiss="alert">&times;</a> </div>
      <?php } ?>
      <?php if( $this->session->flashdata('error') ) { ?>
      <div class="alert alert-danger col-sm-6" style="margin-left: 7%;
    margin-right: 7%;
    width: 86%;"> <?php echo $this->session->flashdata('error'); ?> <a href="#" class="close" data-dismiss="alert">&times;</a> </div>
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
            <div class="small"><?php echo $exchanges[$i]['currentprice'];?></div>
            </a> </li>
          <?php } else {?>
          <li class="value_button"><a href="home/index/<?php echo $exchanges[$i]['interfaceexid'];?>" <?php if(($this->uri->segment(3)==$exchanges[$i]['interfaceexid']) ){?>class="current"<?php }?> title="<?php $fromcurr=$this->homes->get_currency_name($exchanges[$i]['fromcurrencyid']); echo $fromcurr[0]['currencycode'];?> / <?php $tocurr=$this->homes->get_currency_name($exchanges[$i]['tocurrencyid']); echo $tocurr[0]['currencycode'];?>">
            <div>
              <?php $fromcurr=$this->homes->get_currency_name($exchanges[$i]['fromcurrencyid']); echo $fromcurr[0]['currencycode'];?>
              /
              <?php $tocurr=$this->homes->get_currency_name($exchanges[$i]['tocurrencyid']); echo $tocurr[0]['currencycode'];?>
            </div>
            <div class="small"><?php echo $exchanges[$i]['currentprice'];?></div>
            </a> </li>
          <?php  }}}}?>
        </ul>
      </div>
      <div class="clearfix"></div>
      <div class="button">
        <div class="today"> <a href="#" class="current" title="today">Today</a> </div>
        <div class="today"> <a href="#" title="Weekly">Weekly</a> </div>
        <div class="today"> <a href="#" title="Monthly">Monthly</a> </div>
      </div>
      <div class="chart">
        <div id="chart_div" style="width: 780px; height: 450px;"></div>
      </div>
      <div class="clearfix"></div>
      <div class="row-fluid"> 
        <!-- Correct form message --> 
        
      </div>
      <?php if((isset($exchanges)) && (!empty($exchanges))){
		  $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']);
		  $tocurr=$this->homes->get_currency_name($exchangedata[0]['tocurrencyid']);
		  ?>
      <div class="box">
        <div class="buy_box">
          <h2 class="head">Buy <?php echo $fromcurr[0]['currencycode'];?></h2>
          <div class="head" style="float: right; margin-top: -36px;" >
            <select name="viewtypebuy" id="viewtypebuy"  onchange="return viewmodebuy(this.value);">
              <option value="1">Standard</option>
              <option value="0">Advanced</option>
            </select>
          </div>
          <div class="balance_part">
            <table class="table">
              <tbody>
                <tr>
                  <td><span>Your balance: </span></td>
                  <td><span>Lowest ask Price</span></td>
                </tr>
                <tr>
                  <td class="highlight">0
                    <?php $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']); echo $tocurr[0]['currencycode'];?></td>
                  <td><?php $lowestprice=$this->homes->get_lowest_price($exchangedata[0]['interfaceexid']); if(!empty($lowestprice)) echo $lowestprice; else echo $exchangedata[0]['currentprice'];?>
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
                    <input type="text" id="buybasecurrency" name="buybasecurrency" maxlength="10" value="<?php if($avg_buy==''){echo $exchangedata[0]['currentprice'];} else {echo $avg_buy;}?>" class="checkno">
                    <?php $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']);echo $tocurr[0]['currencycode'];?>
                  </div></td>
              </tr>
              <tr class="mainbuybase" >
                <td>Total :</td>
                <td ><div class="mainbuy">
                    <div class="buytotal"></div>
                    &nbsp;<?php echo $tocurr[0]['currencycode'];?>
                    <input type="hidden"  name="buytotaltext" id="buytotaltext">
                  </div></td>
              </tr>
              <tr>
                <td>Fee :</td>
                <td><div class="buyfees">
                    <?php if(!empty($fees)) echo $fees;?>
                  </div>
                  &nbsp; <?php echo $fromcurr[0]['currencycode'];?>
                  <input type="hidden" name="feestext" value="<?php if(!empty($fees)) echo $fees;?>">
                  <input type="hidden" id="interfaceid" name="interfaceid" value="<?php echo $exchangedata[0]['interfaceexid'];?>"></td>
              </tr>
              <tr>
                <td></td>
                <td><div id="feescalculation"> </div>
                  <input type="hidden"  name="feescalculationtext" id="feescalculationtext"></td>
              </tr>
            </tbody>
          </table>
          <div class="btn_panel">
            <div class="calculate"> <a href="javascript:void(0);" title="Calculate" onClick="calculatefeesbuy();">Calculate</a> </div>
            <?php if( array_key_exists('cc_user',$this->session->userdata) )
								  {?>
            <button type="submit" class="buy" name="buycurrency" id="buycurrencybtn" value="Buy <?php $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']); echo $fromcurr[0]['currencycode'];?>">Buy
            <?php $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']); echo $fromcurr[0]['currencycode'];?>
            </button>
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
          <div class="head" style="float: right; margin-top: -36px;" >
            <select name="viewtypesell" id="viewtypesell" onchange="return viewmodesell(this.value);">
              <option value="1">Standard</option>
              <option value="0">Advanced</option>
            </select>
          </div>
          <div class="balance_part">
            <table class="table">
              <tbody>
                <tr>
                  <td><span>Your balance: </span></td>
                  <td><span>Highest ask Price</span></td>
                </tr>
                <tr>
                  <td class="highlight">0
                    <?php $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']); echo $fromcurr[0]['currencycode'];?></td>
                  <td><?php $higestprice=$this->homes->get_higest_price($exchangedata[0]['interfaceexid']); if(!empty($higestprice)) echo $higestprice; else echo $exchangedata[0]['currentprice']; ?>
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
                <td><input type="text" id="sellamount" name="sellamount" onKeyUp="changepricesell(this.value);" maxlength="10" class="checkno"></td>
              </tr>
              <tr class="mainsellbase">
                <td>Price per
                  <?php $tocurr=$this->homes->get_currency_name($exchangedata[0]['tocurrencyid']); echo $fromcurr[0]['currencycode'];;?>
                  : </td>
                <td><div class="mainsellbase">
                    <input type="text" id="sellbasecurrency" name="sellbasecurrency" maxlength="10" value="<?php if($avg_sell==''){echo $exchangedata[0]['currentprice'];} else {echo $avg_sell;}?>" class="checkno">
                    <?php $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']); echo $tocurr[0]['currencycode'];?>
                  </div></td>
                  </td>
              </tr>
              <tr class="mainsellbase">
                <td>Total :</td>
                <td><div class="mainsell">
                    <div class="selltotal"></div>
                    &nbsp; <?php echo $tocurr[0]['currencycode'];?>
                    <input type="hidden"  name="selltotaltext" id="selltotaltext">
                  </div></td>
              </tr>
              <tr>
                <td>Fee :</td>
                <td><div class="sellfees">
                    <?php if(!empty($fees)) echo $fees;?>
                  </div>
                  &nbsp; <?php echo $tocurr[0]['currencycode'];?>
                  <input type="hidden" name="feestext" value="<?php if(!empty($fees)) echo $fees;?>">
                  <input type="hidden" id="interfaceid" name="interfaceid" value="<?php if(!empty($fees)) echo $fees;?>"></td>
              </tr>
              <tr>
                <td></td>
                <td><div id="feescalculationsell"></div>
                  <input type="hidden"  name="feescalculationselltext" id="feescalculationselltext"></td>
              </tr>
            </tbody>
          </table>
          <div class="btn_panel">
            <div class="calculate"> <a href="javascript:void(0);" title="Calculate" onClick="calculatefeessell();">Calculate</a> </div>
            <?php if( array_key_exists('cc_user',$this->session->userdata) )
								  {?>
            <button type="submit" class="buy" name="sellcurrency" id="sellcurrency" >Sell
            <?php $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']); echo $fromcurr[0]['currencycode'];?>
            </button>
            <?php } else {?>
            <a href="javascript:void(0);" class="buy" title="login" onclick="showlogin();">Sell <?php echo $fromcurr[0]['currencycode'];?></a>
            <?php }?>
          </div>
        </div>
      </div>
      <?php }?>
    </div>
    <?php if((isset($exchanges)) && (!empty($exchanges))){?>
    <div class="order_box">
      <h2 class="order_head">Buy Orders</h2>
      <h3 class="total_head">Total : <?php echo $totalbuy;?>
        <?php $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']); echo $tocurr[0]['currencycode'];?>
      </h3>
      <div class="order_heading">
        <table class="table">
          <tbody>
            <tr>
              <td>Price</td>
              <td><?php $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']); echo $fromcurr[0]['currencycode'];?></td>
              <td><?php $tocurr=$this->homes->get_currency_name($exchangedata[0]['tocurrencyid']); echo $tocurr[0]['currencycode'];?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="ordertable">
        <?php if( (isset($buyorderlist)) &&(!empty($buyorderlist))){
				
					?>
        <div class="content_2 content">
          <table class="table table-striped table-bordered">
            <tbody>
              <?php 	for($i=0;$i<count($buyorderlist);$i++){?>
              <tr>
                <td><?php echo $buyorderlist[$i]['base_price'];?></td>
                <td><?php echo $buyorderlist[$i]['orderamount'];?></td>
                <td><?php echo $buyorderlist[$i]['ordertotal'];?></td>
              </tr>
              <?php }?>
            </tbody>
          </table>
        </div>
        <?php } ?>
      </div>
    </div>
    <div class="order_box last_box">
      <h2 class="order_head">Sell Orders</h2>
      <h3 class="total_head">Total : <?php echo $totalsell;?>
        <?php $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']); echo $fromcurr[0]['currencycode'];?>
      </h3>
      <div class="order_heading">
        <table class="table">
          <tbody>
            <tr>
              <td>Price</td>
              <td><?php $fromcurr=$this->homes->get_currency_name($exchangedata[0]['fromcurrencyid']); echo $fromcurr[0]['currencycode'];?></td>
              <td><?php $tocurr=$this->homes->get_currency_name($exchangedata[0]['tocurrencyid']); echo $tocurr[0]['currencycode'];?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="ordertable">
        <?php if( (isset($sellorderlist)) &&(!empty($sellorderlist))){
				
					?>
        <div class="content_2 content">
          <table class="table table-striped table-bordered">
            <tbody>
              <?php 	for($i=0;$i<count($sellorderlist);$i++){?>
              <tr>
                <td><?php echo $sellorderlist[$i]['base_price'];?></td>
                <td><?php echo $sellorderlist[$i]['orderamount'];?></td>
                <td><?php echo $sellorderlist[$i]['ordertotal'];?></td>
              </tr>
              <?php }?>
            </tbody>
          </table>
        </div>
        <?php } ?>
      </div>
    </div>
    <?php }?>
    <?php if((empty($exchanges))){?>
    <h1>Sorry No Exchanges available at this moment!</h1>
    <?php }?>
    <div class="order_part">
      <h2 class="order_head">Your current active orders</h2>
      <div class="order_heading">
        <table class="table">
          <tbody>
            <tr>
              <td>Type</td>
              <td>Price</td>
              <td>Amount(BTC)</td>
              <td>Total(GHS)</td>
              <td>Date</td>
              <td>Action</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="order_description">No active orders at the moment.</div>
    </div>
    <div class="history_part">
      <h2 class="order_head">Trade History</h2>
      <div class="order_heading">
        <table class="table">
          <tbody>
            <tr>
              <td>Date</td>
              <td class="type">Type</td>
              <td class="price">Price</td>
              <td>Amount(BTC)</td>
              <td>Total(USD)</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="historytable">
        <div class="content_2 historytable">
          <table class="table table-striped table-bordered">
            <tbody>
              <tr>
                <td>21.05.14 &nbsp;&nbsp;   14:34</td>
                <td class="type sell">Sell</td>
                <td class="price">485</td>
                <td>3.81879559</td>
                <td>1852.11586115</td>
              </tr>
              <tr>
                <td>21.05.14 &nbsp;&nbsp; 14:34</td>
                <td class="buy1 type">Buy</td>
                <td class="price">485</td>
                <td>3.81879559</td>
                <td>1852.11586115</td>
              </tr>
              <tr>
                <td>21.05.14 &nbsp;&nbsp;  14:34</td>
                <td class="type sell">Sell</td>
                <td class="price">485</td>
                <td>3.81879559</td>
                <td>1852.11586115</td>
              </tr>
              <tr>
                <td>21.05.14 &nbsp;&nbsp; 14:34</td>
                <td class="type buy1">Buy</td>
                <td class="price">485</td>
                <td>3.81879559</td>
                <td>1852.11586115</td>
              </tr>
              <tr>
                <td>21.05.14 &nbsp;&nbsp; 14:34</td>
                <td class="sell type">Sell</td>
                <td class="price">485</td>
                <td>3.81879559</td>
                <td>1852.11586115</td>
              </tr>
              <tr>
                <td>21.05.14 &nbsp;&nbsp; 14:34</td>
                <td class="buy1 type">Buy</td>
                <td class="price">485</td>
                <td>3.81879559</td>
                <td>1852.11586115</td>
              </tr>
              <tr>
                <td>21.05.14 &nbsp;&nbsp; 14:34</td>
                <td class="sell type">Sell</td>
                <td class="price">485</td>
                <td>3.81879559</td>
                <td>1852.11586115</td>
              </tr>
              <tr>
                <td>21.05.14 &nbsp;&nbsp; 14:34</td>
                <td class="buy1 type">Buy</td>
                <td class="price">485</td>
                <td>3.81879559</td>
                <td>1852.11586115</td>
              </tr>
              <tr>
                <td>21.05.14 &nbsp;&nbsp; 14:34</td>
                <td class="sell type">Sell</td>
                <td class="price">485</td>
                <td>3.81879559</td>
                <td>1852.11586115</td>
              </tr>
              <tr>
                <td>21.05.14 &nbsp;&nbsp; 14:34</td>
                <td class="buy1 type">Buy</td>
                <td class="price">485</td>
                <td>3.81879559</td>
                <td>1852.11586115</td>
              </tr>
              <tr>
                <td>21.05.14 &nbsp;&nbsp; 14:34</td>
                <td class="sell type">Sell</td>
                <td class="price">485</td>
                <td>3.81879559</td>
                <td>1852.11586115</td>
              </tr>
              <tr>
                <td>21.05.14 &nbsp;&nbsp; 14:34</td>
                <td class="buy1 type">Buy</td>
                <td class="price">485</td>
                <td>3.81879559</td>
                <td>1852.11586115</td>
              </tr>
              <tr>
                <td>21.05.14 &nbsp;&nbsp; 14:34</td>
                <td class="sell type">Sell</td>
                <td class="price">485</td>
                <td>3.81879559</td>
                <td>1852.11586115</td>
              </tr>
              <tr>
                <td>21.05.14 &nbsp;&nbsp; 14:34</td>
                <td class="buy1 type">Buy</td>
                <td class="price">485</td>
                <td>3.81879559</td>
                <td>1852.11586115</td>
              </tr>
              <tr>
                <td>21.05.14 &nbsp;&nbsp; 14:34</td>
                <td class="sell type">Sell</td>
                <td class="price">485</td>
                <td>3.81879559</td>
                <td>1852.11586115</td>
              </tr>
              <tr>
                <td>21.05.14 &nbsp;&nbsp; 14:34</td>
                <td class="buy1 type">Buy</td>
                <td class="price">485</td>
                <td>3.81879559</td>
                <td>1852.11586115</td>
              </tr>
            </tbody>
          </table>
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
          <h3 class="services_head"><i><img src="images/settings.png" alt=""></i><?php echo $settings[0]['heading'];?></h3>
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
          <h3 class="services_head"><i><img src="images/rivacy.png" alt=""></i><?php echo $Privacy[0]['heading'];?></h3>
          <p><?php echo $Privacy[0]['shortdesc'];?></p>
        </li>
        </a>
        <?php }?>
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
<?php echo $footer;?>
</body></html>