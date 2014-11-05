
<?php echo $header;
echo $menu;
?>

<!-- /.header-top-links -->

<div class="section_wrapper">
      <div id="wrapper"> 
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
    <!-- /.row -->
    <div class="signup_part" style="min-height: 400px;">
          <div class="user">
        <h2 class="fund_head">Forgot Password</h2>
    
     
 
<script type="text/javascript" language="javascript">
              function trim(stringToTrim) {
                  return stringToTrim.replace(/^\s+|\s+$/g,"");
              }
              	  $(document).ready(function() {
                  
				  $("#forgotbtn").click(function () {
              
				 	 
					   var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					  if( trim($("#email").val()) == "" )
					  {
						  $("#emailerror").show();
						  $("#email").val('').focus();
						  return false;
					  }
					  else
					  {
						  if( !filter.test(trim($("#email").val())) )
						  {
							  $("#emailerror").show();
							  $("#email").val('').focus();
							  return false;
						  }
						  else
						  {
							  $("#emailerror").hide();
						  }
					  }
					  $("#frmforgot").submit();
                          
                  });
              
              });
          </script>
          <fieldset>
        <div id="emailerror" class="alert alert-danger col-sm-6 errormsg">Enter valid Email.</div>
        
        </fieldset>
     <form action="login/update" id="frmforgot" method="post">
        
        <fieldset>
              <label>Email</label>
              <input type="email" autofocus="" autocomplete="off" tabindex="1" placeholder="Enter your Email-ID" class="mail_id" id="email" name="email" maxlength="100">
            </fieldset>
        
            
        
        
        
     
        <fieldset>
              <div class="btn_panel">
            <button type="Submit" name="forgotbtn" id="forgotbtn" class="subscribe_btn" value="Submit" title="subscribe" tabindex="3">Submit</button>
          </div>
            </fieldset>
            
     </form>
      </div>
        </div>
  </div>
    </div>
<?php echo $footer;?>

</body>
</html>
