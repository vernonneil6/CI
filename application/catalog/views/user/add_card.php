<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="<?php echo $keywords?>">
	<meta name="description" content="<?php echo $description?>">
	<base href="<?php echo base_url();?>" />
	<title>Add New Card</title>

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
    <div class="signup_part">
          <div class="user">
        <h2 class="fund_head">Add New Card</h2>
        <script type="text/javascript" language="javascript">
              function trim(stringToTrim) {
                  return stringToTrim.replace(/^\s+|\s+$/g,"");
              }
              	  $(document).ready(function() {
                  
				  $("#newcardbtn").click(function () {
              
				 	 
					  if( trim($("#card_name").val()) == "" )
					  {
						  $("#card_nameerror").show();
						  $("#card_name").focus();
			       		  return false;
					  }
					  else
					  {
						   $("#card_nameerror").hide();
					  }
					  
					  if( trim($("#card_type").val()) == "" )
					  {
						  $("#card_typeerror").show();
			       		  $("#card_type").focus();
						  return false;
					  }
					  else
					  {
					  	  $("#card_typeerror").hide();
					  }
					  
					  if( trim($("#card_number").val()) == "" )
					  {
						  $("#card_numbererror").show();
			       		  $("#card_number").focus();
						  return false;
					  }
					  else
					  {
					  	  if(isNaN($("#card_number").val()))
						  {
						  	$("#card_numbererror").hide();
							$("#wrongcard_numbererror").show();
							return false;
						  }
						  else
						  {
						  	$("#card_numbererror").hide();
							$("#wrongcard_numbererror").hide();
						  }
					  }
							
					 if( trim($("#date1").val()) == "" )
					  {
						  $("#exp_dateerror").show();
			       		  $("#date1").focus();
						  return false;
					  }
					  else
					  {
					  	  $("#exp_dateerror").hide();
					  }
					  
					  if( trim($("#date2").val()) == "" )
					  {
						  $("#exp_dateerror").show();
			       		  $("#date2").focus();
						  return false;
					  }
					  else
					  {
					  	  $("#exp_dateerror").hide();
					  }
					  
					  //var date1 = $("#date1").val()+$("#date2").val();
					  //var date2 = '<?php echo date("m").date("Y");?>';
					  
					   // return false;
						   $("#frmcard").submit();
                          
                  });
              
              });
          </script>
        <fieldset>
              <div class="alert alert-danger col-sm-6 errormsg" id="card_nameerror">Name required.</div>
              <div class="alert alert-danger col-sm-6 errormsg" id="card_typeerror">Select card type.</div>
              <div class="alert alert-danger col-sm-6 errormsg" id="card_numbererror">Card Number required</div>
     <div class="alert alert-danger col-sm-6 errormsg" id="exp_dateerror">Select Exp date</div>
     <div class="alert alert-danger col-sm-6 errormsg" id="wrongexp_dateerror">Exp date must be future date</div>
     <div class="alert alert-danger col-sm-6 errormsg" id="wrongcard_numbererror">Enter Valid card number</div>
     
              
              
            </fieldset>
        <form action="user/update" id="frmcard" method="post" enctype="multipart/form-data">
              <fieldset>
            <label>Name</label>
            <input type="text" autofocus="" autocomplete="off" tabindex="1" placeholder="Enter Name" class="state" id="card_name" name="card_name" maxlength="30">
          </fieldset>
              <fieldset>
            <label>Card Type</label>
            <div class="tys">
                  <select name="card_type" id="card_type" tabindex="1" >
                <option value="">--Select--</option>
                <option value="Credit">Credit</option>
                <option value="Debit">Debit</option>
              </select>
                </div>
          </fieldset>
              <fieldset>
            <label>Card Number</label>
            <input type="text" autofocus="" autocomplete="off" tabindex="1" placeholder="Enter Number" class="state" id="card_number" name="card_number" maxlength="20">
          </fieldset>
              <fieldset>
            <label>Exp date</label>
            <div class="tys">
                  <select name="date2" id="date2" tabindex="1" style="margin:0 264px 0 0;width:10%;">
                <option value="">Year</option>
                <?php for($j=0;$j<5;$j++){?>
                <?php $x=$j+date("Y");?>
                <option value="<?php echo $x;?>"><?php echo $x;?></option>
                <?php }?>
              </select>
                </div>
            <div class="tys">
                  <select name="date1" id="date1" tabindex="1"  style="margin:0 10px 0 0;width:10%;">
                <option value="">Month</option>
                <?php for($m=1;$m<13;$m++){?>
                <?php if($m<10){?>
                <option value="0<?php echo $m;?>">0<?php echo $m;?></option>
                <?php }else{?>
				<option value="<?php echo $m;?>"><?php echo $m;?></option>
				<?php }}?>
              </select>
                </div>
          </fieldset>
              
              
              <fieldset>
            <div class="btn_panel">
                  <button type="submit" name="newcardbtn" id="newcardbtn" class="subscribe_btn" value="Add" title="Add" tabindex="3" style="float:left; margin-left:349px;">Add</button>
                </div>
          </fieldset>
              <input type="hidden" id="addcard" name="addcard" value="addcard" />
            </form>
      </div>
        </div>
  </div>
    </div>
<?php echo $footer;?>
</body>
</html>
