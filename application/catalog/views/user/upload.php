<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="<?php echo $keywords?>">
	<meta name="description" content="<?php echo $description?>">
	<base href="<?php echo base_url();?>" />
	<title>Upload Document</title>


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
    <div class="signup_part">
          <div class="user">
        <h2 class="fund_head">Upload Document</h2>
    
     
 
<script type="text/javascript" language="javascript">
              function trim(stringToTrim) {
                  return stringToTrim.replace(/^\s+|\s+$/g,"");
              }
              	  $(document).ready(function() {
                  
				  $("#uploadbtn").click(function () {
              
				 	 
					  if( trim($("#title").val()) == "" )
					  {
						  $("#titleerror").show();
						  $("#title").focus();
			       		  return false;
					  }
					  else
					  {
						   $("#titleerror").hide();
					  }
					  
					  if( trim($("#document").val()) == "" )
					  {
						  $("#documenterror").show();
			       		  $("#document").focus();
						  return false;
					  }
					  else
					  {
						  var file = document.getElementById('document').files[0];
						  Size = file.size;
						  type = file.type;
						  
						  var myarray = ['"application/pdf"',"image/jpeg","image/gif","image/bmp","image/png","application/pdf"];
						  
						  if ($.inArray(type, myarray) !== -1)
							{
								$("#fileerror").hide();
							}
							else
							{
								$("#fileerror").show();
								return false;
							}

					  		
						  if(Size > 1048576  )
						  {
						  	$("#filesizeerror").show();
						  	return false;
					 	 }
					 	 else
					 	 {
							$("#filesizeerror").hide();
						 }
					  }
							
						   $("#frmdocument").submit();
                          
                  });
              
              });
          </script>
          <fieldset>
        <div class="alert alert-danger col-sm-6 errormsg" id="documenterror">Document required.</div>
        <div class="alert alert-danger col-sm-6 errormsg" id="titleerror">Document Type required.</div>
        <div class="alert alert-danger col-sm-6 errormsg" id="fileerror"><b>Allowed Types:</b> .pdf,.jpeg,.gif,.bmp,.png<br/>
    </div>
    <div class="alert alert-danger col-sm-6 errormsg" id="filesizeerror">
    <b>Max Allowed Size:</b> 1MB</div>
        </fieldset>
     <form action="user/update" id="frmdocument" method="post" enctype="multipart/form-data">
        <fieldset>
              <label>Document Type</label>
              <div class="tys">
             <select name="title" id="title" tabindex="1" >
             <option value="">--Select--</option>
             <option value="Passport">Passport</option>
			 <option value="National id card">National id card</option>
             <option value="Driver license">Driver license</option>
             </select>
             </div>
           <?php /*?>   <input type="text" autofocus="" autocomplete="off" tabindex="1" placeholder="Enter Title" class="state" id="title" name="title" maxlength="30"><?php */?>
            </fieldset>
            <fieldset>
              <label>Document</label>
              <input type="file" autofocus="" autocomplete="off" tabindex="1" class="state" id="document" name="document">
            </fieldset>
        <fieldset>
        <label></label>
<div class="alert alert-info col-sm-6" style="margin-left: 45%;margin-right:49%;width:55%;">
    <b>Allowed Types:</b> .pdf,.jpeg,.gif,.bmp,.png<br/>
    <b>Max Allowed Size:</b> 1MB
    </div>
        </fieldset>
     
        <fieldset>
              <div class="btn_panel">
            <button type="submit" name="uploadbtn" id="uploadbtn" class="subscribe_btn" value="Upload" title="Upload" tabindex="3" style="float:left; margin-left:349px;">Upload</button>
          </div>
            </fieldset>
            <input type="hidden" id="uploaddoc" name="uploaddoc" value="uploaddoc" />
     </form>
      </div>
        </div>
  </div>
    </div>
<?php echo $footer;?>

</body>
</html>
