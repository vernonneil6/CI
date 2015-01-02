<?php echo $header;?>
<section class="container">
  <section class="inner_main">
    <div class="main_contentarea"> <?php echo $menu; ?>
      <div class="complain_tag"><?php echo $tag_line;?>
      
      <?php if($topads){ ?>
       <div class="ad_up"><a href="<?php echo $topads[0]['url'];?>" title="" target="_blank"><img src="<?php if( $topads[0]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('ad_main_upload_path');?><?php echo stripslashes($topads[0]['image']); } ?>" alt="topads" width="940" height="180" class="adimg"/></a> </div>
		  <?php } ?>
      
      </div>
      <div class="main_complain_div">
        <?php //$companies = $this->complaints->get_all_companies();?>
        <link rel="stylesheet" href="<?php echo base_url();?>js/datetimepicker/style.css" type="text/css" media="all" />
        <script src="<?php echo base_url();?>js/datetimepicker/jquery-ui-timepicker-addon.js"></script>
        <script>
	  	<?php /*?><?php if(count($companies)>0){?>
		  var companydata = new Array();
		  var myvar = [];
		  <?php $jsArray = array();
		  foreach($companies as $array) {
			 $jsArray[] = array('id'=>$array['id'], 'company'=>$array['company']); 
		  } ?>
		  <?php 
		  for($i=0; $i<count($jsArray); $i++)
		  { ?>
			  myvar.push({
				  "label":<?php echo json_encode($jsArray[$i]['company']); ?>,
				  "value":<?php echo json_encode($jsArray[$i]['id']); ?>
			  });
			  companydata = [{
			  value: <?php echo json_encode($jsArray[$i]['id']); ?>,
			  label: <?php echo json_encode($jsArray[$i]['company']); ?>
			  }];
		  <?php } ?><?php */?>
	      	function trim(stringToTrim) {
			  return stringToTrim.replace(/^\s+|\s+$/g,"");
		  }
		  $(document).ready(function(){
			  $('#imgload').hide();
				$("#lnkcompany").click(function() {
				$('#frmcompany #type').val('Company');
				
				var namefilter = /^[a-zA-Z0-9. -]+$/;
				
				if( trim($("#company").val()) == "" || !namefilter.test(trim($("#company").val())))
				{
					$("#companyerror").show();
			    	$("#company").css("border", "1px solid #CD0B1C");
					$("#company").focus();
					return false;
				}
				else
				{
					$("#company").css("border", "none");
					$("#companyerror").hide();
					$('#divcomplaint').hide();
					$('#divtype').hide();
					$('#divselect').show();
					$('#divstep2').show();
					$('#divcompany').show();
					$('#divperson').hide();
					$('#divphone').hide();
					$('#divselect #company-name').html(document.getElementById('company').value);
					$('#frmcompany #company').val($('#company').val());
				}
			});
			$("#lnkperson").click(function() {
				$('#frmperson #type').val('Person');
				if( trim($("#company").val()) == "" )
				{
					$("#error").attr('style','display:block;');
					$("#companyerror").show();
					$("#company").val('').focus();
					return false;
				}
				else
				{
					$("#error").attr('style','display:none;');
					$("#companyerror").hide();
					$('#divcomplaint').hide();
					$('#divtype').hide();
					$('#divselect').show();
					$('#divstep2').show();
					$('#divperson').show();
					$('#divcompany').hide();
					$('#divphone').hide();
					$('#divselect #company-name').html(document.getElementById('company').value);
					$('#frmperson #company').val($('#company').val());
				}
			});
			$("#lnkphone").click(function() {
				$('#frmphone #type').val('Phone');
				if( trim($("#company").val()) == "" )
				{
					$("#error").attr('style','display:block;');
					$("#companyerror").show();
					$("#company").val('').focus();
					return false;
				}
				else
				{
					$("#error").attr('style','display:none;');
					$("#companyerror").hide();
					$('#divcomplaint').hide();
					$('#divtype').hide();
					$('#divselect').show();
					$('#divstep2').show();
					$('#divphone').show();
					$('#divcompany').hide();
					$('#divperson').hide();
					$('#divselect #company-name').html(document.getElementById('company').value);
					$('#frmphone #company').val($('#company').val());
				}
			});
			$("#change").click(function() {
				$('#divcomplaint').show();
				$('#divtype').show();
				$('#divselect').hide();
				$('#divstep2').hide();
			});
			
			
			
		  });
		  </script>
          <script type="text/javascript">
	function searchcompany(company)
	{
		//alert(company);
		if (company.length > 3)
		{
			//alert(company.length);
			if( searchcompany != '' )
			{
			//$("#couponcodeerror").hide();
			//Return from conroller in php code : echo json_encode(array("result"=>"exist"));
			$.ajax({
				type 				: "POST",
				url 				: "<?php echo site_url('welcome/searchcompany'); ?>",
				data				:	{ 'company' : company },
				dataType 			: "json",
				cache				: false,
				beforeSend			: function(){
					$('#imgload').show();
					},
				success				: function(data){
												//alert(data);
												//console.log(data);
												$('#imgload').hide();
												$('#company').autocomplete({ 
				source: data,
				
				select: function (event, ui) {
					if ( ui.item ) {
					  $('#frmcompany #companyid').val(ui.item.value);
					 $('#frmperson #companyid').val(ui.item.value);
					  $('#frmphone #companyid').val(ui.item.value);
					  this.value = ui.item.label;
					  return false;
					}
				}
			});
			$(".ui-autocomplete").css("max-height", "250px");
			$(".ui-autocomplete").css("overflow-y", "auto");
												
											}
			});
		}
			else
			{
			
			return false;
			}
		}
		else
		{
			return false;
		}
	}
</script>
          <?php /*?><script>
		  $('#company').autocomplete({ 
				source: myvar,
				minLength: 4,
				select: function (event, ui) {
					if ( ui.item ) {
					 $('#frmcompany #companyid').val(ui.item.value);
					 $('#frmperson #companyid').val(ui.item.value);
					  $('#frmphone #companyid').val(ui.item.value);
					  this.value = ui.item.label;
					  return false;
					}
				}
			});
			$(".ui-autocomplete").css("max-height", "250px");
			$(".ui-autocomplete").css("overflow-y", "auto");
		  </script><?php */?>
        <?php // } ?>
        <div class="complain_leftmainbox">
		  <?php if( $this->session->flashdata('success') ) { ?>
          <!--  start message-green -->
          <div id="message-green">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td class="green-left"><?php echo $this->session->flashdata('success'); ?></td>
                <td class="green-right"><a class="close-green"><img src="<?php echo base_url(); ?>images/messages/icon_close_green.gif" alt="Close"/></a></td>
              </tr>
            </table>
          </div>
          <!--  end message-green -->
          <?php } ?>
          <?php if( $this->session->flashdata('error') ) { ?>
          <!--  start message-red -->
          <div id="message-red">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td class="red-left"><?php echo $this->session->flashdata('error'); ?></td>
                <td class="red-right"><a class="close-red"><img src="<?php echo base_url(); ?>images/messages/icon_close_red.gif" alt="Close"/></a></td>
              </tr>
            </table>
          </div>
          <!--  end message-red -->
          <?php } ?>
          <div class="complain_box" id="divcomplaint">
            <div class="complain_box_title"><img src="<?php echo site_url();?>images/step1.png"><span>&nbsp;I wish to file a complaint against:</span> </div>
            <div class="complain_textboxdiv"> <?php echo form_input( array( 'name'=>'company','id'=>'company','class'=>'complain_txtbox','type'=>'text','placeholder'=>'enter minimum 4 characters to search company...','onkeyup'=>'searchcompany(this.value)','style'=>'width:430px;')); ?>
            <img src="<?php echo base_url();?>images/ajax-load.gif" id="imgload"/>
              <input type="hidden" id="companyid" name="cid" />
              <div id="companyerror" class="error" style="float:left">Please Select Company Name.</div>
            </div>
          </div>
          <div class="complain_box" id="divtype">
            <div class="complain_box_title"><img src="<?php echo site_url();?>images/step2.png"><span>&nbsp;Select a complaint type:</span> </div>
            <div class="complain_textboxdiv">
              <ul>
                <li><a id="lnkcompany">Company</a></li>
                <li><a id="lnkperson">Person</a></li>
                <li><a id="lnkphone">Phone</a></li>
              </ul>
            </div>
          </div>
          <div class="complain_box" id="divselect">
            <div class="complain_box_title"><span>Complaint against:</span>
              <div style="margin-top:22px"><span id="company-name"></span><a id="change" title="Change"><-&nbsp;Change</a></div>
            </div>
          </div>
          <div class="complain_box" id="divstep2">
            <div class="complain_box_title"><span>Enter the complaint details:</span> </div>
            <div class="complain_textboxdiv" id="divcompany"> 
              <script>		 
						 $(document).ready(function(){
							$('#datecompany').datepicker({
								dateFormat : 'mm/dd/yy', maxDate: new Date

							});
										
							$("#btncompany").click(function () {
							  if(trim($("#damagesinamt").val()) == "")
							  {
								  $("#damageerror").show();
								  $("#damagesinamt").css("border", "1px solid #CD0B1C");
								  $("#damagesinamt").val('').focus();
								  return false;
							  }
							  else
							  {
								  if( isNaN(trim($("#damagesinamt").val())) )
								  {
									  $("#damageerror").hide();
									  $("#damageverror").show();
									  $("#damagesinamt").css("border", "1px solid #CD0B1C");
									  $("#damagesinamt").val('').focus();
									  return false;
								  }
								  else
								  {
									  $("#damageerror").hide();
									  $("#damageverror").hide();
									  $("#damagesinamt").css("border", "none");
								  }
							  }
							  
							  if( trim($("#datecompany").val()) == "" )
							  {
								  $("#dateerror").show();
								  $("#datecompany").css("border", "1px solid #CD0B1C");
								  $("#datecompany").val('').focus();
								  return false;
							  }
							  else
							  {
								  $("#dateerror").hide();
								  $("#datecompany").css("border", "none");
							  }
								
					  	//var namefilter = /^[a-zA-Z0-9. -]+$/;
						
						if( trim($("#detail").val()) == "" ||  ($("#detail").val().length) < 20 )
							  {
								  $("#detailerror").show();
								  $("#detail").css("border", "1px solid #CD0B1C");
								  $("#detail").focus();
								 
								  return false;
							  }
							  else
							  {
								  $("#detailerror").hide();
								  $("#detail").css("border", "none");
							  }
							  
							  if( trim($("#city").val()) == "" )
							  {
								  $("#cityerror").show();
								  $("#city").css("border", "1px solid #CD0B1C");
								  $("#city").val('').focus();
								  return false;
							  }
							  else
							  {
								  $("#cityerror").hide();
								  $("#city").css("border", "none");
							  }
							  
							  if( trim($("#state").val()) == "" )
							  {
								  $("#stateerror").show();
								  $("#state").css("border", "1px solid #CD0B1C");
								  $("#state").val('').focus();
								  return false;
							  }
							  else
							  {
								  $("#stateerror").hide();
								  $("#state").css("border", "none");
							  }
							  
							  if(trim($("#zip").val()) == "")
							  {
								  $("#ziperror").show();
								  $("#zip").css("border", "1px solid #CD0B1C");
								  $("#zip").val('').focus();
								  return false;
							  }
							  else
							  {
								  if( isNaN(trim($("#zip").val())) )
								  {
									  $("#ziperror").show();
									  $("#zip").css("border", "1px solid #CD0B1C");
									  $("#zip").val('').focus();
									  return false;
								  }
								  else
								  {
									  $("#ziperror").hide();
									  $("#zip").css("border", "none");
								  }
							  }
							  
							  if(trim($("#phone").val()) == "")
							  {
								  $("#phoneerror").show();
								  $("#phone").css("border", "1px solid #CD0B1C");
								  $("#phone").val('').focus();
								  return false;
							  }
							  else
							  {
								  if( isNaN(trim($("#phone").val())) )
								  {
									  $("#phoneerror").show();
									  $("#phone").css("border", "1px solid #CD0B1C");
									  $("#phone").val('').focus();
									  return false;
								  }
								  else
								  {
									  $("#phoneerror").hide();
									  $("#phone").css("border", "none");
								  }
							  }
							  
							   var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					  		   if( trim($("#email").val()) == "" )
					  		   {	
									  $("#emailverror").hide();
									  $("#emailerror").show();
									  $("#email").val('').focus();
									  $("#email").css("border", "1px solid #CD0B1C");
									  return false;
					  			}
							  else
							  	{
									if( !filter.test(trim($("#email").val())) )
						  			{
							  			$("#emailerror").hide();
									    $("#emailverror").show();
										$("#email").val('').focus();
										$("#email").css("border", "1px solid #CD0B1C");
										return false;
						  			}
						  			else
						  			{
							  			$("#emailerror").hide();
										$("#emailverror").hide();
										$("#email").css("border", "none");
						  			}
					  		    }
								
								if( trim($("#siteurl").val()) == "" )
							  	{
									  $("#siteurlerror").show();
									  $("#siteurl").css("border", "1px solid #CD0B1C");
									  $("#siteurl").val('').focus();
									  return false;
							  	}
							  	else
							  	{
									  $("#siteurlerror").hide();
								 	  $("#siteurl").css("border", "none");
							  	}
								
							    if(!$("#readterms").is(":checked") )
		                      	{
        			                 alert("Please read Terms and Conditions")
			                         return false;
            		          	}
								else
								{
								}
								
								if(!$("#terms").is(":checked") )
		                      	{
        			                 
									 alert("Please Agree with Terms and Conditions")
									 return false;
            		          	}
								else{}
		            	        
									$("#frmcompany").submit();
						  
						  });
						 });
						
						</script> 
              <?php echo form_open('welcome/update',array('class'=>'formBox','name'=>'frmcompany','id'=>'frmcompany')); ?>
              <table cellspacing="0" cellpadding="2" border="0">
                <tr>
                  <td class="box_label"><label for="Monetary Damages">Monetary Damages <span class="errorsign">*</span></label></td>
                  <td class="box_label"><label for="date">Date <span class="errorsign">*</span></label></td>
                </tr>
                <tr>
                  <td><?php echo form_input( array( 'name'=>'damagesinamt','id'=>'damagesinamt','class'=>'complain_txtbox','type'=>'text','style'=>'width:220px;text-indent:5px;','placeholder'=>'Total lost in USD' )); ?></td>
                  <td><?php echo form_input( array( 'name'=>'whendate','id'=>'datecompany','class'=>'complain_txtbox datetimepicker','type'=>'text','style'=>'width:225px','placeholder'=>'When did this happen?','readonly'=>'readonly' )); ?></td>
                </tr>
                <tr>
                  <td><div id="damageerror" class="error" style="padding-bottom:5px">Monetary Damage is required.</div>
                    <div id="damageverror" class="error" style="padding-bottom:5px">Enter Only Digits.</div></td>
                  <td><div id="dateerror" class="error" style="padding-bottom:5px">Date is required. </div></td>
                </tr>
                <tr>
                  <td class="box_label"><label for="Location">Location</label></td>
                  <td></td>
                </tr>
                <tr>
                  <td colspan="2" style="padding-bottom:10px"><?php echo form_input( array( 'name'=>'location','id'=>'location','class'=>'complain_txtbox','type'=>'text','placeholder'=>'Location info' )); ?></td>
                  <td></td>
                </tr>
                <tr>
                  <td class="box_label"><label for="Location">Detail <span class="errorsign">*</span></label></td>
                  <td></td>
                </tr>
                <tr>
                  <td colspan="2" style="padding-bottom:10px"><?php echo form_textarea( array( 'name'=>'detail','id'=>'detail','class'=>'complain_txtbox','rows'=>'9','cols'=>'5','style'=>'height:95%;','placeholder'=>'Enter the details' )); ?></td>
                  <td></td>
                </tr>
                <tr>
                  <td colspan="2"><div id="detailerror" class="error" style="padding-bottom:5px"> Minimum 20 characters required.</div></td>
                </tr>
                <tr>
                  <td class="box_label"><label for="city">City <span class="errorsign">*</span></label></td>
                  <td class="box_label"><label for="state">State <span class="errorsign">*</span></label></td>
                </tr>
                <tr>
                  <td><?php echo form_input( array( 'name'=>'city','id'=>'city','class'=>'complain_txtbox','type'=>'text','style'=>'width:220px;text-indent:5px;','placeholder'=>'enter city' )); ?></td>
                  <td><?php echo form_input( array( 'name'=>'state','id'=>'state','class'=>'complain_txtbox','type'=>'text','style'=>'width:225px','placeholder'=>'enter state')); ?></td>
                </tr>
                <tr>
                  <td><div id="cityerror" class="error" style="padding-bottom:5px">City is required.</div></td>
                  <td><div id="stateerror" class="error" style="padding-bottom:5px">State is required.</div></td>
                </tr>
                <tr>
                  <td class="box_label"><label for="zip">Zipcode <span class="errorsign">*</span></label></td>
                  <td class="box_label"><label for="phone">Phone Number <span class="errorsign">*</span></label></td>
                </tr>
                <tr>
                  <td><?php echo form_input( array( 'name'=>'zip','id'=>'zip','class'=>'complain_txtbox','type'=>'text','style'=>'width:220px;text-indent:5px;','placeholder'=>'enter zipcode' )); ?></td>
                  <td><?php echo form_input( array( 'name'=>'phone','id'=>'phone','class'=>'complain_txtbox','type'=>'text','style'=>'width:225px','placeholder'=>'enter phone number')); ?></td>
                </tr>
                <tr>
                  <td><div id="ziperror" class="error" style="padding-bottom:5px">Enter digits only.</div></td>
                  <td><div id="phoneerror" class="error" style="padding-bottom:5px">Enter digits only.</div></td>
                </tr>
                <tr>
                  <td class="box_label"><label for="email">Company Email <span class="errorsign">*</span></label></td>
                  <td class="box_label"><label for="siteurl">Website URL <span class="errorsign">*</span></label></td>
                </tr>
                <tr>
                  <td><?php echo form_input( array( 'name'=>'email','id'=>'email','class'=>'complain_txtbox','type'=>'text','style'=>'width:220px;text-indent:5px;','placeholder'=>'enter company email' )); ?></td>
                  <td><?php echo form_input( array( 'name'=>'siteurl','id'=>'siteurl','class'=>'complain_txtbox','type'=>'text','style'=>'width:225px','placeholder'=>'enter website url')); ?></td>
                </tr>
                <tr>
                  <td><div id="emailerror" class="error" style="padding-bottom:5px">Enter email address.</div>
                    <div id="emailverror" class="error" style="padding-bottom:5px">Enter valid email address.</div></td>
                  <td><div id="siteurlerror" class="error" style="padding-bottom:5px">Enter website url.</div></td>
                </tr>
                <tr>
                  <td colspan="2"><?php echo form_checkbox(array('name'=>'readterms','type'=>'checkbox','id'=>'readterms','value'=>'Yes')); ?>&nbsp;I have read the <a href="<?php echo site_url('complaintterms');?>" target="_blank" class="colorcode">Terms and Conditions</a></td>
                </tr>
                <tr>
                  <td colspan="2"><?php echo form_checkbox(array('name'=>'terms','type'=>'checkbox','id'=>'terms','value'=>'Yes')); ?>&nbsp;I agree to the terms and conditions</td>
                </tr>
                <tr>
                  <td><?php echo form_input(array('name'=>'btnsubmit','id'=>'btncompany','class'=>'complaint_btn','type'=>'submit','value'=>'Submit','style'=>'padding:7px 25px;')); ?></td>
                  <td></td>
                </tr>
                <input type="hidden" id="company" name="company" />
                <input type="hidden" id="companyid" name="companyid" />
                <input type="hidden" id="type" name="type" />
              </table>
              <?php echo form_close(); ?> </div>
            <div class="complain_textboxdiv" id="divperson"> 
              <script>		 
					   $(document).ready(function(){
						  $('#dateperson').datepicker({
							  dateFormat : 'mm/dd/yy',maxDate: new Date
						  });
						  $("#btnperson").click(function () {
							  if(trim($("#frmperson #damagesinamt").val()) == "")
							  {
								  $("#frmperson #damageerror").show();
								  $("#frmperson #damagesinamt").css("border", "1px solid #CD0B1C");
								  $("#frmperson #damagesinamt").val('').focus();
								  return false;
							  }
							  else
							  {
								  if( isNaN(trim($("#frmperson #damagesinamt").val())) )
								  {
									  $("#frmperson #damageerror").hide();
									  $("#frmperson #damageverror").show();
									  $("#frmperson #damagesinamt").css("border", "1px solid #CD0B1C");
									  $("#frmperson #damagesinamt").val('').focus();
									  return false;
								  }
								  else
								  {
									  $("#frmperson #damageerror").hide();
									  $("#frmperson #damageverror").hide();
									  $("#frmperson #damagesinamt").css("border", "none");
								  }
							  }
							  if( trim($("#frmperson #dateperson").val()) == "" )
							  {
								  $("#frmperson #dateerror").show();
								  $("#frmperson #dateperson").css("border", "1px solid #CD0B1C");
								  $("#frmperson #dateperson").val('').focus();
								  return false;
							  }
							  else
							  {
								  $("#frmperson #dateerror").hide();
								  $("#frmperson #dateperson").css("border", "none");

							  }
								var namefilter = /^[a-zA-Z0-9. -]+$/;
						
								if( trim($("#frmperson #detail").val()) == "" ||  ($("#frmperson #detail").val().length) < 20 )
							  {
								  $("#frmperson #detail").css("border", "1px solid #CD0B1C");
								  $("#frmperson #detailerror").show();
								  $("#frmperson #detail").focus();
								  return false;
							  }
							  else
							  {
								  $("#frmperson #detailerror").hide();
								  $("#frmperson #detail").css("border", "none");
							  }
							  
							    if( trim($("#frmperson #city").val()) == "" )
							  {
								  $("#frmperson #cityerror").show();
								  $("#frmperson #city").css("border", "1px solid #CD0B1C");
								  $("#frmperson #city").val('').focus();
								  return false;
							  }
							  else
							  {
								  $("#frmperson #cityerror").hide();
								  $("#frmperson #city").css("border", "none");
							  }
							  
							  if( trim($("#frmperson #state").val()) == "" )
							  {
								  $("#frmperson #stateerror").show();
								  $("#frmperson #state").css("border", "1px solid #CD0B1C");
								  $("#frmperson #state").val('').focus();
								  return false;
							  }
							  else
							  {
								  $("#frmperson #stateerror").hide();
								  $("#frmperson #state").css("border", "none");
							  }
							  
							  if(trim($("#frmperson #zip").val()) == "")
							  {
								  $("#frmperson #ziperror").show();
								  $("#frmperson #zip").css("border", "1px solid #CD0B1C");
								  $("#frmperson #zip").val('').focus();
								  return false;
							  }
							  else
							  {
								  if( isNaN(trim($("#frmperson #zip").val())) )
								  {
									  $("#frmperson #ziperror").show();
									  $("#frmperson #zip").css("border", "1px solid #CD0B1C");
									  $("#frmperson #zip").val('').focus();
									  return false;
								  }
								  else
								  {
									  $("#frmperson #ziperror").hide();
									  $("#frmperson #zip").css("border", "none");
								  }
							  }
							  
							  if(trim($("#frmperson #phone").val()) == "")
							  {
								  $("#frmperson #phoneerror").show();
								  $("#frmperson #phone").css("border", "1px solid #CD0B1C");
								  $("#frmperson #phone").val('').focus();
								  return false;
							  }
							  else
							  {
								  if( isNaN(trim($("#frmperson #phone").val())) )
								  {
									  $("#frmperson #phoneerror").show();
									  $("#frmperson #phone").css("border", "1px solid #CD0B1C");
									  $("#frmperson #phone").val('').focus();
									  return false;
								  }
								  else
								  {
									  $("#frmperson #phoneerror").hide();
									  $("#frmperson #phone").css("border", "none");
								  }
							  }
							  
							   var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					  		   if( trim($("#frmperson #email").val()) == "" )
					  		   {	
									  $("#frmperson #emailverror").hide();
									  $("#frmperson #emailerror").show();
									  $("#frmperson #email").val('').focus();
									  $("#frmperson #email").css("border", "1px solid #CD0B1C");
									  return false;
					  			}
							  else
							  	{
									if( !filter.test(trim($("#frmperson #email").val())) )
						  			{
							  			$("#frmperson #emailerror").hide();
									    $("#frmperson #emailverror").show();
										$("#frmperson #email").val('').focus();
										$("#frmperson #email").css("border", "1px solid #CD0B1C");
										return false;
						  			}
						  			else
						  			{
							  			$("#frmperson #emailerror").hide();
										$("#frmperson #emailverror").hide();
										$("#frmperson #email").css("border", "none");
						  			}
					  		    }
								
								if( trim($("#frmperson #siteurl").val()) == "" )
							  	{
									  $("#frmperson #siteurlerror").show();
									  $("#frmperson #siteurl").css("border", "1px solid #CD0B1C");
									  $("#frmperson #siteurl").val('').focus();
									  return false;
							  	}
							  	else
							  	{
									  $("#frmperson #siteurlerror").hide();
								 	  $("#frmperson #siteurl").css("border", "none");
							  	}
								
								 if(!$("#frmperson #readterms").is(":checked") )
		                      	{
        			                 alert("Please read Terms and Conditions")
			                         return false;
            		          	}
								else
								{
								}
								
								if(!$("#frmperson #terms").is(":checked") )
		                      	{
        			                 
									 alert("Please Agree with Terms and Conditions")
									 return false;
            		          	}
								else{}
							
							  $("#frmperson").submit();
						  
						  });
					   });
					  
					  </script> 
              <?php echo form_open('welcome/update',array('class'=>'formBox','name'=>'frmperson','id'=>'frmperson')); ?>
              <table cellspacing="0" cellpadding="2" border="0">
                <tr>
                  <td class="box_label"><label for="username">Username</label></td>
                  <td class="box_label"><label for="email">Email Address</label></td>
                </tr>
                <tr>
                  <td style="padding-bottom:10px"><?php echo form_input( array( 'name'=>'username','id'=>'username','class'=>'complain_txtbox','type'=>'text','style'=>'width:220px','placeholder'=>'enter username' )); ?></td>
                  <td style="padding-bottom:10px"><?php echo form_input( array( 'name'=>'emailid','id'=>'emailid','class'=>'complain_txtbox','type'=>'text','style'=>'width:225px','placeholder'=>'enter email address' ) ); ?></td>
                </tr>
                <tr>
                  <td class="box_label"><label for="Monetary Damages">Monetary Damages <span class="errorsign">*</span></label></td>
                  <td class="box_label"><label for="date">Date <span class="errorsign">*</span></label></td>
                </tr>
                <tr>
                  <td><?php echo form_input( array( 'name'=>'damagesinamt','id'=>'damagesinamt','class'=>'complain_txtbox','type'=>'text','style'=>'width:220px','placeholder'=>'Total lost in USD' )); ?></td>
                  <td><?php echo form_input( array( 'name'=>'whendate','id'=>'dateperson','class'=>'complain_txtbox datetimepicker','type'=>'text','style'=>'width:225px','placeholder'=>'When did this happen?','readonly'=>'readonly' ) ); ?></td>
                </tr>
                <tr>
                  <td><div id="damageerror" class="error" style="padding-bottom:5px">Monetary Damage is required.</div>
                    <div id="damageverror" class="error" style="padding-bottom:5px">Enter Only Digits.</div></td>
                  <td><div id="dateerror" class="error" style="padding-bottom:5px">Date is required. </div></td>
                </tr>
                <tr>
                  <td class="box_label"><label for="Location">Location</label></td>
                  <td></td>
                </tr>
                <tr>
                  <td colspan="2" style="padding-bottom:10px"><?php echo form_input( array( 'name'=>'location','id'=>'location','class'=>'complain_txtbox','type'=>'text','placeholder'=>'Location info' ) ); ?></td>
                  <td></td>
                </tr>
                <tr>
                  <td class="box_label"><label for="detail">Detail <span class="errorsign">*</span></label></td>
                  <td></td>
                </tr>
                <tr>
                  <td colspan="2" style="padding-bottom:10px"><?php echo form_textarea( array( 'name'=>'detail','id'=>'detail','class'=>'complain_txtbox','rows'=>'9','cols'=>'5','style'=>'height:95%','placeholder'=>'enter details')); ?></td>
                  <td></td>
                </tr>
                <tr>
                  <td colspan="2"><div id="detailerror" class="error" style="padding-bottom:5px">Minimum 20 characters required.</div></td>
                </tr>
                <tr>
                  <td class="box_label"><label for="city">City <span class="errorsign">*</span></label></td>
                  <td class="box_label"><label for="state">State <span class="errorsign">*</span></label></td>
                </tr>
                <tr>
                  <td><?php echo form_input( array( 'name'=>'city','id'=>'city','class'=>'complain_txtbox','type'=>'text','style'=>'width:220px;text-indent:5px;','placeholder'=>'enter city' )); ?></td>
                  <td><?php echo form_input( array( 'name'=>'state','id'=>'state','class'=>'complain_txtbox','type'=>'text','style'=>'width:225px','placeholder'=>'enter state')); ?></td>
                </tr>
                <tr>
                  <td><div id="cityerror" class="error" style="padding-bottom:5px">City is required.</div></td>
                  <td><div id="stateerror" class="error" style="padding-bottom:5px">State is required.</div></td>
                </tr>
                <tr>
                  <td class="box_label"><label for="zip">Zipcode <span class="errorsign">*</span></label></td>
                  <td class="box_label"><label for="phone">Phone Number <span class="errorsign">*</span></label></td>
                </tr>
                <tr>
                  <td><?php echo form_input( array( 'name'=>'zip','id'=>'zip','class'=>'complain_txtbox','type'=>'text','style'=>'width:220px;text-indent:5px;','placeholder'=>'enter zipcode' )); ?></td>
                  <td><?php echo form_input( array( 'name'=>'phone','id'=>'phone','class'=>'complain_txtbox','type'=>'text','style'=>'width:225px','placeholder'=>'enter phone number')); ?></td>
                </tr>
                <tr>
                  <td><div id="ziperror" class="error" style="padding-bottom:5px">Enter digits only.</div></td>
                  <td><div id="phoneerror" class="error" style="padding-bottom:5px">Enter digits only.</div></td>
                </tr>
                <tr>
                  <td class="box_label"><label for="email">Company Email <span class="errorsign">*</span></label></td>
                  <td class="box_label"><label for="siteurl">Website URL <span class="errorsign">*</span></label></td>
                </tr>
                <tr>
                  <td><?php echo form_input( array( 'name'=>'email','id'=>'email','class'=>'complain_txtbox','type'=>'text','style'=>'width:220px;text-indent:5px;','placeholder'=>'enter company email' )); ?></td>
                  <td><?php echo form_input( array( 'name'=>'siteurl','id'=>'siteurl','class'=>'complain_txtbox','type'=>'text','style'=>'width:225px','placeholder'=>'enter website url')); ?></td>
                </tr>
                <tr>
                  <td><div id="emailerror" class="error" style="padding-bottom:5px">Enter email address.</div>
                    <div id="emailverror" class="error" style="padding-bottom:5px">Enter valid email address.</div></td>
                  <td><div id="siteurlerror" class="error" style="padding-bottom:5px">Enter website url.</div></td>
                </tr>
                <tr>
                  <td colspan="2"><?php echo form_checkbox(array('name'=>'readterms','type'=>'checkbox','id'=>'readterms','value'=>'Yes')); ?>&nbsp;I have read the <a href="<?php echo site_url('complaintterms');?>" target="_blank" class="colorcode">Terms and Conditions</a></td>
                </tr>
                <tr>
                  <td colspan="2"><?php echo form_checkbox(array('name'=>'terms','type'=>'checkbox','id'=>'terms','value'=>'Yes')); ?>&nbsp;I agree to the terms and conditions</td>
                </tr>
                <tr>
                  <td><?php echo form_input(array('name'=>'btnsubmit','id'=>'btnperson','class'=>'complaint_btn','type'=>'submit','value'=>'Submit','style'=>'padding:7px 25px;')); ?></td>
                  <td></td>
                </tr>
              </table>
              <input type="hidden" id="company" name="company" />
              <input type="hidden" id="companyid" name="companyid" />
              <input type="hidden" id="type" name="type" />
              <?php echo form_close(); ?> </div>
            <div class="complain_textboxdiv" id="divphone"> 
              <script>		 
					   $(document).ready(function(){
						  $('#datephone').datepicker({
							  dateFormat : 'mm/dd/yy',maxDate: new Date
						  });
						  $("#btnphone").click(function () {
							  if(trim($("#frmphone #damagesinamt").val()) == "")
							  {
								  $("#frmphone #damageerror").show();
								  $("#frmphone #damagesinamt").css("border", "1px solid #CD0B1C");
								  $("#frmphone #damagesinamt").val('').focus();
								  return false;
							  }
							  else
							  {
								  if( isNaN(trim($("#frmphone #damagesinamt").val())) )
								  {
									  $("#frmphone #damageerror").hide();
									  $("#frmphone #damageverror").show();
									  $("#frmphone #damagesinamt").css("border", "1px solid #CD0B1C");
									  $("#frmphone #damagesinamt").val('').focus();
									  return false;
								  }
								  else
								  {
									  $("#frmphone #damageerror").hide();
									  $("#frmphone #damageverror").hide();
									  $("#frmphone #damagesinamt").css("border", "none");
								  }
							  }
							  if( trim($("#frmphone #datephone").val()) == "" )
							  {
								  $("#frmphone #dateerror").show();
								  $("#frmphone #datephone").css("border", "1px solid #CD0B1C");
								  $("#frmphone #datephone").val('').focus();
								  return false;
							  }
							  else
							  {
								  $("#frmphone #dateerror").hide();
								  $("#frmphone #datephone").css("border", "none");
							  }
								
								var namefilter = /^[a-zA-Z0-9. -]+$/;
						
							  if( trim($("#frmphone #detail").val()) == "" ||  ($("#frmphone #detail").val().length) < 20 )
							  {
								  $("#frmphone #detailerror").show();
								  $("#frmphone #detail").css("border", "1px solid #CD0B1C");
								  $("#frmphone #detail").focus();
								  return false;
							  }
							  else
							  {
								  $("#frmphone #detailerror").hide();
								  $("#frmphone #detail").css("border", "none");
							  }
							  
							    if( trim($("#frmphone #city").val()) == "" )
							  {
								  $("#frmphone #cityerror").show();
								  $("#frmphone #city").css("border", "1px solid #CD0B1C");
								  $("#frmphone #city").val('').focus();
								  return false;
							  }
							  else
							  {
								  $("#frmphone #cityerror").hide();
								  $("#frmphone #city").css("border", "none");
							  }
							  
							  if( trim($("#frmphone #state").val()) == "" )
							  {
								  $("#frmphone #stateerror").show();
								  $("#frmphone #state").css("border", "1px solid #CD0B1C");
								  $("#frmphone #state").val('').focus();
								  return false;
							  }
							  else
							  {
								  $("#frmphone #stateerror").hide();
								  $("#frmphone #state").css("border", "none");
							  }
							  
							  if(trim($("#frmphone #zip").val()) == "")
							  {
								  $("#frmphone #ziperror").show();
								  $("#frmphone #zip").css("border", "1px solid #CD0B1C");
								  $("#frmphone #zip").val('').focus();
								  return false;
							  }
							  else
							  {
								  if( isNaN(trim($("#frmphone #zip").val())) )
								  {
									  $("#frmphone #ziperror").show();
									  $("#frmphone #zip").css("border", "1px solid #CD0B1C");
									  $("#frmphone #zip").val('').focus();
									  return false;
								  }
								  else
								  {
									  $("#frmphone #ziperror").hide();
									  $("#frmphone #zip").css("border", "none");
								  }
							  }
							  
							  if(trim($("#frmphone #phone").val()) == "")
							  {
								  $("#frmphone #phoneerror").show();
								  $("#frmphone #phone").css("border", "1px solid #CD0B1C");
								  $("#frmphone #phone").val('').focus();
								  return false;
							  }
							  else
							  {
								  if( isNaN(trim($("#frmphone #phone").val())) )
								  {
									  $("#frmphone #phoneerror").show();
									  $("#frmphone #phone").css("border", "1px solid #CD0B1C");
									  $("#frmphone #phone").val('').focus();
									  return false;
								  }
								  else
								  {
									  $("#frmphone #phoneerror").hide();
									  $("#frmphone #phone").css("border", "none");
								  }
							  }
							  
							   var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					  		   if( trim($("#frmphone #email").val()) == "" )
					  		   {	
									  $("#frmphone #emailverror").hide();
									  $("#frmphone #emailerror").show();
									  $("#frmphone #email").val('').focus();
									  $("#frmphone #email").css("border", "1px solid #CD0B1C");
									  return false;
					  			}
							  else
							  	{
									if( !filter.test(trim($("#frmphone #email").val())) )
						  			{
							  			$("#frmphone #emailerror").hide();
									    $("#frmphone #emailverror").show();
										$("#frmphone #email").val('').focus();
										$("#frmphone #email").css("border", "1px solid #CD0B1C");
										return false;
						  			}
						  			else
						  			{
							  			$("#frmphone #emailerror").hide();
										$("#frmphone #emailverror").hide();
										$("#frmphone #email").css("border", "none");
						  			}
					  		    }
								
								if( trim($("#frmphone #siteurl").val()) == "" )
							  	{
									  $("#frmphone #siteurlerror").show();
									  $("#frmphone #siteurl").css("border", "1px solid #CD0B1C");
									  $("#frmphone #siteurl").val('').focus();
									  return false;
							  	}
							  	else
							  	{
									  $("#frmphone #siteurlerror").hide();
								 	  $("#frmphone #siteurl").css("border", "none");
							  	}
								
									 if(!$("#frmphone #readterms").is(":checked") )
		                      	{
        			                 alert("Please read Terms and Conditions")
			                         return false;
            		          	}
								else
								{
								}
								
								if(!$("#frmphone #terms").is(":checked") )
		                      	{
        			                 
									 alert("Please Agree with Terms and Conditions")
									 return false;
            		          	}
								else{}
								
							  $("#frmphone").submit();
						  
						  });
					   });
					  
					  </script> 
              <?php echo form_open('welcome/update',array('class'=>'formBox','name'=>'frmphone','id'=>'frmphone')); ?>
              <table cellspacing="0" cellpadding="2" border="0">
                <tr>
                  <td class="box_label"><label for="Monetary Damages">Monetary Damages <span class="errorsign">*</span></label></td>
                  <td class="box_label"><label for="date">Date <span class="errorsign">*</span></label></td>
                </tr>
                <tr>
                  <td><?php echo form_input( array( 'name'=>'damagesinamt','id'=>'damagesinamt','class'=>'complain_txtbox','type'=>'text','style'=>'width:220px','placeholder'=>'Total lost in USD' )); ?></td>
                  <td><?php echo form_input( array( 'name'=>'whendate','id'=>'datephone','class'=>'complain_txtbox datetimepicker','type'=>'text','style'=>'width:225px','placeholder'=>'When did this happen?','readonly'=>'readonly' ) ); ?></td>
                </tr>
                <tr>
                  <td><div id="damageerror" class="error" style="padding-bottom:5px">Monetary Damage is required.</div>
                    <div id="damageverror" class="error" style="padding-bottom:5px">Enter Only Digits.</div></td>
                  <td><div id="dateerror" class="error" style="padding-bottom:5px">Date is required.</div></td>
                </tr>
                <tr>
                  <td class="box_label"><label for="Location">Detail <span class="errorsign">*</span></label></td>
                  <td></td>
                </tr>
                <tr>
                  <td colspan="2" style="padding-bottom:10px"><?php echo form_textarea( array( 'name'=>'detail','id'=>'detail','class'=>'complain_txtbox','rows'=>'9','cols'=>'5','style'=>'height:95%','placeholder'=>'enter details')); ?></td>
                  <td></td>
                </tr>
                <tr>
                  <td colspan="2"><div id="detailerror" class="error" style="padding-bottom:5px">Minimum 20 characters required.</div></td>
                </tr>
                <tr>
                  <td class="box_label"><label for="city">City <span class="errorsign">*</span></label></td>
                  <td class="box_label"><label for="state">State <span class="errorsign">*</span></label></td>
                </tr>
                <tr>
                  <td><?php echo form_input( array( 'name'=>'city','id'=>'city','class'=>'complain_txtbox','type'=>'text','style'=>'width:220px;text-indent:5px;','placeholder'=>'enter city' )); ?></td>
                  <td><?php echo form_input( array( 'name'=>'state','id'=>'state','class'=>'complain_txtbox','type'=>'text','style'=>'width:225px','placeholder'=>'enter state')); ?></td>
                </tr>
                <tr>
                  <td><div id="cityerror" class="error" style="padding-bottom:5px">City is required.</div></td>
                  <td><div id="stateerror" class="error" style="padding-bottom:5px">State is required.</div></td>
                </tr>
                <tr>
                  <td class="box_label"><label for="zip">Zipcode <span class="errorsign">*</span></label></td>
                  <td class="box_label"><label for="phone">Phone Number <span class="errorsign">*</span></label></td>
                </tr>
                <tr>
                  <td><?php echo form_input( array( 'name'=>'zip','id'=>'zip','class'=>'complain_txtbox','type'=>'text','style'=>'width:220px;text-indent:5px;','placeholder'=>'enter zipcode' )); ?></td>
                  <td><?php echo form_input( array( 'name'=>'phone','id'=>'phone','class'=>'complain_txtbox','type'=>'text','style'=>'width:225px','placeholder'=>'enter phone number')); ?></td>
                </tr>
                <tr>
                  <td><div id="ziperror" class="error" style="padding-bottom:5px">Enter digits only.</div></td>
                  <td><div id="phoneerror" class="error" style="padding-bottom:5px">Enter digits only.</div></td>
                </tr>
                <tr>
                  <td class="box_label"><label for="email">Company Email <span class="errorsign">*</span></label></td>
                  <td class="box_label"><label for="siteurl">Website URL <span class="errorsign">*</span></label></td>
                </tr>
                <tr>
                  <td><?php echo form_input( array( 'name'=>'email','id'=>'email','class'=>'complain_txtbox','type'=>'text','style'=>'width:220px;text-indent:5px;','placeholder'=>'enter company email' )); ?></td>
                  <td><?php echo form_input( array( 'name'=>'siteurl','id'=>'siteurl','class'=>'complain_txtbox','type'=>'text','style'=>'width:225px','placeholder'=>'enter website url')); ?></td>
                </tr>
                <tr>
                  <td><div id="emailerror" class="error" style="padding-bottom:5px">Enter email address.</div>
                    <div id="emailverror" class="error" style="padding-bottom:5px">Enter valid email address.</div></td>
                  <td><div id="siteurlerror" class="error" style="padding-bottom:5px">Enter website url.</div></td>
                </tr>
                <tr>
                  <td colspan="2"><?php echo form_checkbox(array('name'=>'readterms','type'=>'checkbox','id'=>'readterms','value'=>'Yes')); ?>&nbsp;I have read the <a href="<?php echo site_url('complaintterms');?>" target="_blank" class="colorcode">Terms and Conditions</a></td>
                </tr>
                <tr>
                  <td colspan="2"><?php echo form_checkbox(array('name'=>'terms','type'=>'checkbox','id'=>'terms','value'=>'Yes')); ?>&nbsp;I agree to the terms and conditions</td>
                </tr>
                <tr>
                  <td><?php echo form_input(array('name'=>'btnsubmit','id'=>'btnphone','class'=>'complaint_btn','type'=>'submit','value'=>'Submit','style'=>'padding:7px 25px;')); ?></td>
                  <td></td>
                </tr>
              </table>
              <input type="hidden" id="company" name="company" />
              <input type="hidden" id="companyid" name="companyid" />
              <input type="hidden" id="type" name="type" />
              <?php echo form_close(); ?> </div>
          </div>
        </div>
        <div class="complain_rightmainbox">
          <div class="complain_form_title"><img src="<?php echo site_url();?>images/complain_title.png"></div>
          <div class="complain_dcsr"> <span>Quick Start</span> Start with the name of the Company, Person or a Phone Number. Then select the complaint type to get started.<br/>
            <br/>
            After you submit a complaint, you can view your complaint status in your dashboard. Yougotrated will notify you of any updates on your complaint. </div>
        </div>
        <div> </div>
      </div>
      <div class="shadow"></div>
    </div>
  </section>
</section>
<section class="content_wrap">
  <section class="inner_main">
    <div class="main_contentarea">
      <div class="vedio_frame">
        <?php $link = strstr($video_url, '=');?>
        <?php $link = str_replace('=','',$link);?>
        <iframe width="853" height="498" src="//www.youtube.com/embed/<?php echo $link;?>" frameborder="1" allowfullscreen id="ygrvideo"></iframe>
      </div>
      <div class="left_content_panel">
        <div class="treding_title">Trending  Searches <span>Last 7 Days</span></div>
        <div class="treding_lnk">
          <?php if(count($keywords)>0){?>
          <?php //echo '<pre>'; print_r($keywords);?>
          <?php for($i=0; $i<count($keywords); $i++)
					{ ?>
          <a title="Search <?php echo $keywords[$i]['keyword'];?>" href="<?php echo site_url('complaint/keysearch').'/'.$keywords[$i]['keyword'];?>"><?php echo $keywords[$i]['keyword'];?></a>
          <?php }
					?>
          <?php } ?>
        </div>
         <?php if($leftads){ ?>
       <div><a href="<?php echo $leftads[0]['url'];?>" title="" target="_blank"><img src="<?php if( $leftads[0]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('ad_main_upload_path');?><?php echo stripslashes($leftads[0]['image']); } ?>" alt="leftads" width="280" height="180" class="adimg"/></a> </div>
     
		  <?php } ?>
        
      </div>
      <div class="right_content_panel">
        <div class="treding_title">Yougotrated Live</div>
        <div class="filter"><span style="font-size:14px; font-weight:bold;">Filter by :</span> <a href="<?php echo site_url('welcome');?>" class="filter_active">Recent Activity</a> <a href="<?php echo site_url('complaint/weektrending');?>">Trending Complaints (7 Days)</a><!-- <a href="#">Most Active (7 Days)</a>--><a href="<?php echo site_url('complaint/advfilter');?>">Advance Filter</a></div>
        <?php if(count($complaints)>0) {?>
		<?php for($i=0; $i<count($complaints); $i++) { ?>
        <?php //echo "<pre>"; print_r($complaints); die();?>
        <?php $user=$this->users->get_user_byid($complaints[$i]['userid']) ;?>
        <div class="main_livepost">
          <div class="view_all"> <a href="<?php echo site_url('company/'.$complaints[$i]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view all"> <span>
            <h3>
              <?php $num=$this->complaints->get_complaint_bycompanyid($complaints[$i]['companyid']);?>
              <?php if(count($num)>0){?>
              <?php echo count($num);?>
              <?php }else{"0";}?>
            </h3>
            Related<br>
            Reports </span></a> <!--<span>--> <a href="<?php echo site_url('company/'.$complaints[$i]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="view all">View All</a><!--</span>--> </div>
          <div class="post_maincontent">
            <div class="side-image"> <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']);?>" title="view complaint Detail"><img src="<?php if( $complaints[$i]['logo'] ) { echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path');?><?php echo stripslashes($complaints[$i]['logo']); } else { echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path')."no_image.png"; } ?>" alt="<?php echo ucfirst(stripslashes($complaints[$i]['company'])); ?>" width="100px" height="40px" /></a> </div>
            <div class="post_content_title"><a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']);?>" title="view Complaint Detail"><?php echo ucfirst(stripslashes($complaints[$i]['company'])); ?></a></div>
            <div class="post_content_dscr user_view" style="margin-top:2px;width: -moz-available;"> <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint Detail"><?php echo strtolower(substr(stripslashes($complaints[$i]['detail']),0,212)."..."); ?></a> </div>
            <?php 
                        $date = date_default_timezone_set('Asia/Kolkata');                             
                        $dbdate = date('Y-m-d',strtotime($complaints[$i]['whendate']));
                        $complaindate = date('m/d/Y',strtotime($complaints[$i]['complaindate']));
                        $today = date('m/d/Y');
                        $d1 = strtotime(date('Y-m-d H:i:s'));
                        $d2 = strtotime($complaints[$i]['complaindate']);
                        $newdate =round(($d1-$d2)/60);
                        if($newdate > 60){$diff = round(($d1-$d2)/60/60).' hours ago';}else{$diff = $newdate.' minutes ago';}
                        ?>
            <div class="timing"> <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint Detail">Date occurred: <span><?php echo date('m/d/Y',strtotime($dbdate));?></span> </a> <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint Detail">Reported Damage: <span>$<?php echo $complaints[$i]['damagesinamt'];?></span> </a> <a href="<?php echo site_url('remove/complaint/'.$complaints[$i]['id'].'/'.$complaints[$i]['companyid']); ?>" title="Remove this complaint" style="background-color:#FFFFFF;">
              <input type="submit" name="submit" value="Remove" class="remove_btn" title="Remove this complaint" style="margin-top:-2px;"/>
              </a> </div>
            <div class="post_username">
              <?php if($complaints[$i]['userid']!=0){ ?>
              <?php if(count($user)>0){ ?>
              <a href="<?php echo site_url('complaint/viewuser/'.$complaints[$i]['companyid'].'/'.$complaints[$i]['userid']); ?>" title="view profile"><?php echo $user[0]['username'];?></a>
              <?php } ?>
              <?php } else{?>
              <a href="#">Anonymous</a>
              <?php } ?>
              <a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint Detail"><span><?php echo ($complaindate==$today)?'Posted: '.$diff:'Posted: '.date('m/d/Y',strtotime($complaints[$i]['complaindate'])); ?></span></a> </div>
          </div>
        </div>
        <?php } ?>
        <?php } else
		{
		?>
        <div class="main_livepost">
                    <div class="post_maincontent">
                      <div class="form-message warning">
                        <p>No Complaints found.</p>
                      </div>
                    </div>
                  </div>
        <?php
		}
		?>
      </div>
      <?php if($bottomads){ ?>
       <div class="ad_bottom"><a href="<?php echo $topads[0]['url'];?>" title="" target="_blank"><img src="<?php if( $bottomads[0]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('ad_main_upload_path');?><?php echo stripslashes($bottomads[0]['image']); } ?>" alt="topads" width="940" height="180" class="adimg"/></a> </div>
     
		  <?php } ?>
      
      </div>
      </div>
    </div>
  </section>
</section>
<?php echo $footer; ?>