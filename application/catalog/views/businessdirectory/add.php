<?php echo $header;?>
<script type="text/javascript" src="/js/formsubmit.js"></script>
<script src="http://www.google.com/recaptcha/api.js" async defer></script>
<script type="text/javascript">
      var onloadCallback = function() {
        grecaptcha.render('recaptcha', {			
				'sitekey' : '6Lcj5QETAAAAAGjqfr2_v-jKUhz6CGVVJG-QlpOb'		
        });
      };
</script>

<script type="text/javascript" language="javascript">

              function trim(stringToTrim) {
                  return stringToTrim.replace(/^\s+|\s+$/g,"");
              }
              $(document).ready(function() {
                  $("#btnaddcompany").click(function () {
					  
					 
					  if($('#g-recaptcha-response').val() != ''){
					  var site_domain = '<?php echo $_SERVER['REMOTE_ADDR']; ?>';
					  var responseData = {
						  secret : '6Lcj5QETAAAAAPty66XTLlKG1ERLbMkLkMI-Yguf',
						  response :  $('#g-recaptcha-response').val(),
						  remoteip: site_domain
					  }
					 var google_url="http://www.google.com/recaptcha/api/siteverify";	
					 $.ajax( { 
						url: google_url,
						type:'GET',
						dataType:'json',
						data:responseData,
						success: function(data){							
							if(data.success=='true'){
								$('#recaptcha_error').html('success');
							}else{
								$('#recaptcha_error').html('Please re-enter your reCAPTCHA.');
							}
							
						}						
					 });
				 }else{
					 $('#recaptcha_error').show();
					 return false;
				 }
					  
					  
					  if( trim($("#name").val()) == "" )
					  {
						  $("#nameerror").show();
						  $("#name").val('').focus();
						  return false;
					  }
					  else
					  {						  
						  $("#nameerror").hide();
						
					  }
					  
					   if( trim($("#website").val()) == "" )
					  {
						  $("#websiteerror").show();
						  $("#website").focus();
						  return false;
					  }
					  else
					  {
						  $("#websiteerror").hide();
					  }
					  
					   var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					  if( trim($("#email").val()) == "" )
					  {
						  $("#emailtknerror").hide();
						  $("#emailerror").show();
						  $("#email").val('').focus();
						  return false;
					  }
					  else
					  {
						  if( !filter.test(trim($("#email").val())) )
						  {
							  $("#emailtknerror").hide();
							  $("#emailerror").show();
							  $("#email").val('').focus();
							  return false;
						  }
						  else
						  {
							  $("#emailerror").hide();
						  }
					  }
					  
					  if( trim($("#streetaddress").val()) == "" )
					  {
						  $("#streetaddresserror").show();
						  $("#streetaddress").val('').focus();
						  return false;
					  }
					  else
					  {
						  $("#streetaddresserror").hide();
					  }
					  
					  if( trim($("#city").val()) == "" )
					  {
						  $("#cityerror").show();
						  $("#city").val('').focus();
						  return false;
					  }
					  else
					  {
						  $("#cityerror").hide();
					  }
					  
					  if( trim($("#state").val()) == "" )
					  {
						  $("#stateerror").show();
						  $("#state").val('').focus();
						  return false;
					  }
					  else
					  {
						  $("#stateerror").hide();
					  }
					  
					  if( trim($("#country").val()) == "" )
					  {
						  $("#countryerror").show();
						  $("#country").val('').focus();
						  return false;
					  }
					  else
					  {
						  $("#countryerror").hide();
					  }
					  
					  if( trim($("#zip").val()) == "" )
					  {
						  $("#ziperror").show();
						  $("#zipverror").hide();
						  $("#zip").val('').focus();
						  return false;
					  }
					  else
					  {
						  if( isNaN(trim($("#zip").val())))
						  {
							  $("#ziperror").hide();
						  	  $("#zipverror").show();
							  $("#zip").focus();
							  return false;
						  }
						  else
						  {
							  $("#ziperror").hide();
							  $("#zipverror").hide();
						  }
					  }
					  
					  if( trim($("#phone").val()) == "" )
					  {
						  $("#phoneerror").show();
						  $("#phoneverror").hide();
						  $("#phone").val('').focus();
						  return false;
					  }
					  else
					  {
						  if( isNaN(trim($("#phone").val())) || $("#phone").val().length < 10)
						  {
							  $("#phoneerror").hide();
						  	  $("#phoneverror").show();
							  $("#phone").focus();
							  return false;
						  }
						  else
						  {
							  $("#phoneerror").hide();
							  $("#phoneverror").hide();
						  }
					  }
					  
					  
					  
					  if( trim($("#cname").val()) == "" )
					  {
						  $("#cnameerror").show();
						  $("#cname").focus();
						  return false;
					  }
					  else
					  {
						  $("#cnameerror").hide();
					  }
					  
					  if( trim($("#cphone").val()) == "" )
					  {
						  $("#cphoneerror").show();
						  $("#cphoneverror").hide();
						  $("#cphone").val('').focus();
						  return false;
					  }
					  else
					  {
						  if( isNaN(trim($("#cphone").val())) || $("#cphone").val().length < 10)
						  {
							  $("#cphoneerror").hide();
						  	  $("#cphoneverror").show();
							  $("#cphone").focus();
							  return false;
						  }
						  else
						  {
							  $("#cphoneerror").hide();
							  $("#cphoneverror").hide();
						  }
					  }
					  
					  var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					  if( trim($("#cemail").val()) == "" )
					  {
						  $("#cemailerror").show();
						  $("#cemail").val('').focus();
						  return false;
					  }
					  else
					  {
						  if( !filter.test(trim($("#cemail").val())) )
						  {
							  $("#cemailerror").show();
							  $("#cemail").val('').focus();
							  return false;
						  }
						  else
						  {
							  $("#cemailerror").hide();
						  }
					  }
					  
					  
					 					
						  
					  $("#frmaddcompany").submit();
                  });
              });
          </script>

<section class="container">
  <section class="main_contentarea">
    <div class="banner_wrp"> <img src="images/YouGotRated_HeaderGraphics_SignUpPage.png" alt="Register" title="Register" style="width:966px;height:100%;"> </div>
    <div class="regr_lnk">
      <div class="innr_wrap">
        <div class="new_usr"> ADD BUSINESS TO YGR DIRECTORY</div>
        
      </div>
    </div>
    <div class="container">
      <div>
        <form class="reg_frm" action="businessdirectory/add" id="frmaddcompany" method="post" enctype="multipart/form-data"> 
          
          <div class="reg-row">
			<div>
				<span class="form-col-1">
					<span class="form-circle">1</span>
				</span>
				<span class="form-col-2" style="width:300px;">
					<label>BUSINESS' NAME</label>           
					<input type="text" class="reg_txt_box" placeholder="NAME" id="name" name="name" >
					<div id="nameerror" class="error">Name is required.</div>
					<div id="nametknerror" class="error">This company name is already exists.</div>
					<div id="namechecks" class="error"></div>					
				</span>
			</div> 
          </div>
          
          <div class="reg-row business-callout">
			<div >
				<span class="form-col-2" style="width:400px;">
					<a href="/solution/claimbusiness"><h3 >YouGotRated Elite Membership:</h3></a>
					<h4 >Becoming a YGR Elite member gives you the following benefits:</h4>        
					<ul>
					<li><p>Negative review removal tool</p></li>
					<li><p>Verified Seal</p></li>
					<li><p>Press Releases</p></li>				
					<li><p>Photo Gallery</p></li>
					<li><p>Review Promo Tools</p></li>
					<li style="margin-bottom:5px;"><p>Much more! <a href="/solution/claimbusiness"><b style="color:#000;">CLICK HERE</b></a> to UPGRADE!</p></li>
					</ul>
				</span>
			</div> 
          </div>
          
          <div class="reg-row" style="margin-top:10px;">
			<div>
				<span class="form-col-1">
					&nbsp;
				</span>
				<span class="form-col-2" style="width:300px;">
					<div class="reg_fld">BUSINESS'S WEBSITE?</div>
					<input type="text" class="reg_txt_box" placeholder="WEBSITE" id="website" name="website"  maxlength="150" onchange="chkwebsite(this.value);">
					<div id="websiteerror" class="error">Website is required.</div>
					<div id="weberror" class="error"></div>
				</span>
			</div> 
          </div>
          
          
          
          <div class="reg-row" style="margin-top:10px;">
			<div>
				<span class="form-col-1">
					&nbsp;
				</span>
				<span class="form-col-2">
					<div class="reg_fld">CATEGORY</div>
					<div id="" style="overflow-y: scroll; height:180px;border: 1px solid #D9D9D9;width:100%;">
						<?php for($i=0;$i<count($categories);$i++) { ?>
						<?php  $option = array( 'name'=>'cat[]', 'id'=>'cat-'.$categories[$i]['id'], 'value'=>$categories[$i]['id'],'class'=>'checkboxLabel' );
						echo form_checkbox( $option ); ?>
						&nbsp; <span style="color: #999999;"> <?php echo stripslashes($categories[$i]['category'])."<br/>";?> </span>
						<?php } ?>
					  </div>
					<div id="websiteerror" class="error">Website is required.</div>				
				</span>
			</div> 
          </div>
          
          <div class="reg-row">
			<div>
				<span class="form-col-1">
					<span class="form-circle">2</span>
				</span>
				<span class="form-col-2">
					<label>BUSINESS EMAIL ADDRESS</label>            
					<input type="email" class="reg_txt_box" placeholder="E-MAIL ADDRESS" id="email" name="email"  maxlength="250" onchange="chkmail(this.value);">
					<div id="emailerror" class="error">Enter valid Emailid.</div>
					<div id="emailcheck" class="error"></div>
					<div id="emailtknerror" class="error">This Emailid already taken.</div>
				</span>
			</div> 
          </div>
          
          
          <div class="reg-row">
			<div>
				<span class="form-col-1">
					<span class="form-circle">3</span>
				</span>
				<span class="form-col-2">
					<label>BUSINESS ADDRESS</label>            
					<input type="text" class="reg_txt_box-lg" placeholder="ADDRESS LINE" name="streetaddress" id="streetaddress" maxlength="150">
					<input type="text" class="reg_txt_box-md" placeholder="CITY" id="city" name="city" maxlength="50" />					
					<!--<input type="text" class="reg_txt_box-md" placeholder="COUNTRY" id="country" name="country" maxlength="50" />-->
					<?php echo form_dropdown('country',$selcon,'','id="country1" class="seldrop" onchange=getstates(this.value,"state","#selstatediv1","");');?>
				   <!--<input type="hidden" name="country" id="countryname1"/>-->
					<!--<input type="text" class="reg_txt_box-md" placeholder="STATE" id="state" name="state" maxlength="50" />-->
					<span id="selstatediv1"><?php $selstate=array(''=>'--Select State--'); ?></span>
					<?php echo form_dropdown('state',$selstate,'','id="state1" class="seldrop"');?>
					<input type="text" class="reg_txt_box-md" placeholder="ZIP CODE" id="zip" name="zip" maxlength="10" />
					<div id="streetaddresserror" class="error">Street Address is required.</div>
					<div id="cityerror" class="error">City is required.</div>
					<div id="stateerror" class="error">State is required.</div>
					<div id="countryerror" class="error">Country is required.</div>
					<div id="ziperror" class="error">Zip Code is required.</div>
					<div id="zipverror" class="error">Enter digits only valid format 123456</div>
					<div style="margin-top:36px;" class="reg_fld">BUSINESS PHONE NUMBER</div>
					<div>
					  <input type="text" class="reg_txt_box-md" placeholder="(XXX) XXX - XXXX" name="phone" maxlength="12" id="phone">
					  <div id="phoneerror" class="error">Phone is required.</div>
					  <div id="phoneverror" class="error">Enter Valid format.0741852963</div>
					</div>
					<div id="streeterror" class="error">Street Address is required.</div>
					<div id="cityerror" class="error">City is required.</div>
					<div id="stateerror" class="error">State is required.</div>
					<div id="streeterror" class="error">Street Address is required.</div>
					<div id="zipcodeerror" class="error">Enter digits only.</div>
				</span>
			</div>
          </div>
          <div id="phonenoerror" class="error">Enter Phone number.</div>
          
          
          <div class="reg-row" style="margin-top:10px !important;">
			<div>
				<span class="form-col-1">
					&nbsp;
				</span>
				<span class="form-col-2">
					<div class="reg_fld">ABOUT US</div>
					<textarea class="txt_box" placeholder="TELL US ABOUT YOUR BUSINESS" id="aboutcompany" name="aboutcompany" style="height:100px;"></textarea>
				</span>
			</div>
              
          </div>
          
          
          <div class="reg-row" style="margin-top:27px;">  
			<div>
				<span class="form-col-1">
					&nbsp;
				</span>
				<span class="form-col-2">      
					<div style='clear:both'>
						
					<div class="g-recaptcha" data-sitekey="6Lcj5QETAAAAAGjqfr2_v-jKUhz6CGVVJG-QlpOb"></div>
					<div id="recaptcha_error" class="error">Recaptcha is required</div>

					</div>
					<button type="submit" class="lgn_btn" style="margin-top:32px;" title="SUBMIT BUSINESS" id="btnaddcompany" name="btnaddcompany">Submit Business</button>
				</span>
			</div>
          </div>
          
          
        </form>
        <div class="lgn_btnlogo" > <a href="<?php echo base_url();?>" title="<?php echo $site_name;?>" ><img src="images/ygr_logos.png" class="logo_btm" alt="Yougotrated" title="Yougotrated"></a> </div>
        
        
      </div>
    </div>
  </section>
</section>

<?php echo $footer;?>
<script>
<?php
if(isset($post_data)){ foreach($post_data as $k => $v){ if($k == 'cat') { foreach($v as $key=>$value){ ?> 	
	$("#cat-<?php echo $value; ?>").prop("checked", true);	 	
<?php } }else{ ?>	
	$("#<?php echo $k; ?>").val('<?php $varname = $k; if(isset($post_data[$varname])){ echo $post_data[$varname];  }  ?>');	
<?php
} } }
?>
</script> 
<script>
function chkwebsite(website){
	var filter  = /^(?:(?:https?|ftp):\/\/)(?:\S+(?::\S*)?@)?(?:(?!10(?:\.\d{1,3}){3})(?!127(?:\.\d{1,3}){3})(?!169\.254(?:\.\d{1,3}){2})(?!192\.168(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/[^\s]*)?$/;
	if(!filter.test(trim(website)))
	{
		$("#weberror").show();
		$("#weberror").append('Please enter a valid URL. For example http://www.example.com or https://www.example.com');
		$("#website").focus();
		return false;
	}
	else
	{
		$("#weberror").hide();
		return true;
	}
}

$(function(){
	$('#email').blur(function(){
		var email = $('#email').val();
		$.ajax({			
			url : '/businessdirectory/emailcheck',
			type : 'POST',
			data : {email : email},
			dataType:"json",
			success : function(a)
			{
				if(a.status=='1')
				{
					$('#emailcheck').show();
					$('#emailcheck').html(a.email);
					return false;
					
				}
				else
				{
					$('#emailcheck').hide();
					return true;
				}
			}
		});
	});
	
	$('#name').blur(function(){
		var name = $('#name').val();
		$.ajax({			
			url : '/businessdirectory/namecheck',
			type : 'POST',
			data : {name : name},
			dataType:"json",
			success : function(a)
			{
				if(a.status=='1')
				{
					$('#namechecks').show();
					$('#namechecks').html(a.name);
					return false;
					
				}
				else
				{
					$('#namechecks').hide();
					return true;
				}
			}
		});
	});
	
});

</script>
