function trim(stringToTrim) {
      return stringToTrim.replace(/^\s+|\s+$/g,"");
}
$(document).ready(function() {
	
  $("#btnaddcompany").click(function (e) {
          e.preventDefault();   
          console.log('test');   
	    
	 
	  
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
	  
	  var checkedCategory = [];
	  $('.checkboxLabel:checked').each(function(){
         checkedCategory.push($(this).next("span").text());         
		});
      $("#categorylist").val(checkedCategory);
      
      
	  
	  var checkisfalse = $('input[name="cat[]"]:checked').length;

	  if (checkisfalse==0) 
	  {
		   $('#categoryerror').show();
		   $('#categoryerror').focus();
		   return false;
	  } 
	  $('#categoryerror').hide();
	  
    
    console.log('test1');
    
	  
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
/*Contact address validation*/
	  if( trim($("#streetaddress1").val()) == "" )
	  {
		  $("#streetaddresserror").show();
		  $("#streetaddress1").val('').focus();
		  return false;
	  }
	  else
	  {
		  $("#streetaddresserror").hide();
	  }
	
          if( trim($("#country1").val()) == "" )
	  {
		  $("#countryerror").show();
		  $("#country1").val('').focus();
		  return false;
	  }
	  else
	  {
		  $("#countryerror").hide();
	  } 

          if( trim($("#state1").val()) == "" )
	  {
		  $("#stateerror").show();
		  $("#state1").val('').focus();
		  return false;
	  }
	  else
	  {
		  $("#stateerror").hide();
	  }
	  
	  if( trim($("#city1").val()) == "" )
	  {
		  $("#cityerror").show();
		  $("#city1").val('').focus();
		  return false;
	  }
	  else
	  {
		  $("#cityerror").hide();
	  }
	  
	  
	  if( trim($("#zip1").val()) == "" )
	  {
		  $("#ziperror").show();
		  $("#zipverror").hide();
		  $("#zip1").val('').focus();
		  return false;
	  }
	  else
	  {
		  if( isNaN(trim($("#zip1").val())))
		  {
			  $("#ziperror").hide();
			  $("#zipverror").show();
			  $("#zip1").focus();
			  return false;
		  }
		  else
		  {
			  $("#ziperror").hide();
			  $("#zipverror").hide();
		  }
	  }
	   
	  
/*billing address validation*/	  
	  if( trim($("#streetaddress").val()) == "" )
	  {
		  $("#b_streetaddresserror").show();
		  $("#streetaddress").val('').focus();
		  return false;
	  }
	  else
	  {
		  $("#b_streetaddresserror").hide();
	  }
	  
	 if( trim($("#country").val()) == "" )
	  {
		  $("#b_countryerror").show();
		  $("#country").val('').focus();
		  return false;
	  }
	  else
	  {
		  $("#b_countryerror").hide();
	  }
	  
	  if( trim($("#state").val()) == "" )
	  {
		  $("#b_stateerror").show();
		  $("#state").val('').focus();
		  return false;
	  }
	  else
	  {
		  $("#b_stateerror").hide();
	  }
	  
	  if( trim($("#city").val()) == "" )
	  {
		  $("#b_cityerror").show();
		  $("#city").val('').focus();
		  return false;
	  }
	  else
	  {
		  $("#b_cityerror").hide();
	  }
	  
	  
	  if( trim($("#zip").val()) == "" )
	  {
		  $("#b_ziperror").show();
		  $("#b_zipverror").hide();
		  $("#zip").val('').focus();
		  return false;
	  }
	  else
	  {
		  if( isNaN(trim($("#zip").val())))
		  {
			  $("#b_ziperror").hide();
			  $("#b_zipverror").show();
			  $("#zip").focus();
			  return false;
		  }
		  else
		  {
			  $("#b_ziperror").hide();
			  $("#b_zipverror").hide();
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
		  var characterReg = /^\d{3}-?\d{3}-?\d{4}$/;
                  if(!(characterReg.test($("#phone").val()))) 
		  {
			  $("#phoneerror").hide();
			  $("#phoneverror").show();
			  $("#phone").focus();
			  return false;
		  }
		  
		  //if( isNaN(trim($("#phone").val())) || $("#phone").val().length < 10)
		  //{
			  //$("#phoneerror").hide();
			  //$("#phoneverror").show();
			  //$("#phone").focus();
			  //return false;
		  //}
		  else
		  {
			  $("#phoneerror").hide();
			  $("#phoneverror").hide();
		  }
	  }
	  
	  if( trim($("#fname").val()) == "" )
	  {
		  $("#fnameerror").show();
		  $("#fname").focus();
		  return false;
	  }
	  else
	  {
		  $("#fnameerror").hide();
	  }
	  
	  if( trim($("#lname").val()) == "" )
	  {
		  $("#lnameerror").show();
		  $("#lname").focus();
		  return false;
	  }
	  else
	  {
		  $("#lnameerror").hide();
	  }
	  
	  if( trim($("#ccnumber").val()) == "" )
	  {
		  $("#ccnumbererror").show();
		  $("#ccnumber").focus();
		  return false;
	  }
	  else
	  {
		  $("#ccnumbererror").hide();
	  }
	  
	  if( trim($("#expirationdatey").val()) == "")
	  {
		  $("#expirationdateerror").show();
		  $("#expirationdatey").focus();
		  return false;
	  }
	  else
	  {
		  $("#expirationdateerror").hide();
	  }
	  
	  if( trim($("#expirationdatem").val()) == "")
	  {
		  $("#expirationdateerror").show();
		  $("#expirationdatem").focus();
		  return false;
	  }
	  else
	  {
		  $("#expirationdateerror").hide();
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
	  if( trim($("#ctitle").val()) == "" )
	  {
		  $("#ctitleerror").show();
		  $("#ctitle").focus();
		  return false;
	  }
	  else
	  {
		  $("#ctitleerror").hide();
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
		  var characterReg = /^\d{3}-?\d{3}-?\d{4}$/;
		  if(!characterReg.test($("#cphone").val())) 
		  {
			  $("#cphoneerror").hide();
			  $("#cphoneverror").show();
			  $("#cphone").focus();
			  return false;
		  }
		  
		  //if( isNaN(trim($("#cphone").val())) || $("#cphone").val().length < 10)
		  //{
			  //$("#cphoneerror").hide();
			  //$("#cphoneverror").show();
			  //$("#cphone").focus();
			  //return false;
		  //}
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
	  if(checkcard()==false)
	  {
		return false;  
	  }
	  if($('#substreetaddress').val()==1)
	  {
		  return false;
	  }
	  if($('#substreetaddress1').val()==1)
	  {
		  return false;
	  }
          var elitememflag=$('#elitemem').val();
          if(elitememflag==''){ 
          if($("#namecheck").val()==0)
          {
               return false; 
          }
	  if($("#emailcheck").val()==0)
          {
               return false; 
          } 
	  }
	  
	if(!$("#terms-conditions").is(':checked'))
	{
		$("#terms-error").show().delay(5000).fadeOut();				
		return false;
	}
	
			
	var exp_year = $('#expirationdatey').val().toString().substr(2,2);	
	var exp_dates = $('#expirationdatem').val() + exp_year;
console.log('test2');

	if($('#expirationdatem').val().length == 1){
		exp_dates = '0'+$('#expirationdatem').val() + exp_year;
	}
var requestData = {
		firstname: $('#fname').val(),
		lastname: $('#lname').val(),
		company: $('#name').val(),
		streetaddress: $('#streetaddress').val(),
		country: $('#countryname').val(),
		state: $('#state').val(),
		city: $('#city').val(),
		zip: $('#zip').val(),
		ccnumber: $('#ccnumber').val(),
		cvv: $('#cvv').val(),
        finalamount:$('#finalamount').val(),
        discount_code_type:$('#discount-code-type').val(),
		exp_date: exp_dates		
	  };
                                                  
						$.ajax({
						type: "POST",
						url: "/GMI_scripts/addressverifier.php",
 	    					data: requestData,
						dataType:"json",
						success: function(data){
							
							console.log(data);
						 	

							if(data.status == "y"){
								 $('#transactionerror').hide();
								 $('#transactionid').val(data.trans_id);
                                 $('#auth_type').val(data.auth_type);
								 $("#frmaddcompany").submit();
                                                                 
											
							}else{
                                 $('#transactionerror').show();
							     $("#ccnumber").focus();
		                         $('#transactionerror').html("Transaction declined due to an Address Verification (AVS) Mismatch.");
								 $('#transactionid').val(data.trans_id);
								 $('#auth_type').val(data.auth_type);
							}
						},
						error: function(data){
							//console.log(data);
						}
						


					});						

		

  });

});
/*get All States*/  
function getbusinessstates(id,state,where,stateval) {	//alert(id);
	if(id !='') {
		if(state == 'state1'){
			$('#countryname1').val($("#country1 :selected").text());
		}else{
			$('#countryname').val($("#country :selected").text());
		}
		if(stateval==undefined || stateval==null)
		{
			var staticdrop = ''; 
		}
		else
		{
			var staticdrop = stateval;
		}
		var requestData = { 'type' : 'getAllStates', 'cid' : id , 'state':state, 'stateval':staticdrop };
				
		$.ajax({
			type 				: "POST",
			url 				: "index.php/businessdirectory/ajaxRequest",
			data				: requestData,
			dataType 			: "html",
			cache				: false,
			success				: function(data){
							//console.log(data);
									//alert(data);
								$(where).empty();
								$(where).append(data);
							}
		});
	}
}      
function getstates(id,state,where,stateval) {	//alert(id);
	if(id !='') {
		if(state == 'state1'){
			$('#countryname1').val($("#country1 :selected").text());
		}else{
			$('#countryname').val($("#country :selected").text());
		}
		if(stateval==undefined || stateval==null)
		{
			var staticdrop = ''; 
		}
		else
		{
			var staticdrop = stateval;
		}
		var requestData = { 'type' : 'getAllStates', 'cid' : id , 'state':state, 'stateval':staticdrop };
				
		$.ajax({
			type 				: "POST",
			url 				: "index.php/solution/ajaxRequest",
			data				: requestData,
			dataType 			: "html",
			cache				: false,
			success				: function(data){
							//console.log(data);
									//alert(data);
								$(where).empty();
								$(where).append(data);
							}
		});
	}
}
function number(evt){
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57 || charCode==189 || charCode==32) )
	return false;
	return true;
} 
/*Check Credit Card*/
function checkcard(){

	var result = "unknown";
	var card=document.getElementById('ccnumber').value;
	var success=document.getElementById('cardsuccess');
	var fail=document.getElementById('carderror'); 

	if(card)
	{
		fail.innerHTML="";   
		if (/^5[1-5]/.test(card))
		{
			success.innerHTML="mastercard";
			$("#card_type option[value='MC']").attr('selected', 'selected');
		}
		else if (/^4[0-9]{6,}/.test(card))
		{
			success.innerHTML="visa";
			$("#card_type option[value='VI']").attr('selected', 'selected');
		}
		else if (/^3[47][0-9]{13}$/.test(card))
		{
			success.innerHTML="American Express";
			$("#card_type option[value='AE']").attr('selected', 'selected');
		}
		else if(/^(?:6(?:011|5[0-9][0-9])[0-9]{12})$/.test(card))
		{
			success.innerHTML="discover"; 
			$("#card_type option[value='DI']").attr('selected', 'selected');
		}
		else if(/^(?:3(?:0[0-5]|[68][0-9])[0-9]{11})$/.test(card))
		{
			success.innerHTML="diner"; 
		}
		else if(/^(?:(?:2131|1800|35\d{3})\d{11})$/.test(card))
		{
			success.innerHTML="jcb";   
		}
		else if(/^((?:6334|6767)\d{12}(?:\d\d)?\d?)$/.test(card))
		{
			success.innerHTML="solo";  
		}
		else if(/^(?:(?:(?:4903|4905|4911|4936|6333|6759)\d{12})|(?:(?:564182|633110)\d{10})(\d\d)?\d?)$/.test(card))
		{
			success.innerHTML="switch";
		}
		else if(/^(5019)\d+$/.test(card))
		{
			success.innerHTML="dankort";  
		}
		else if(/^((?:5020|5038|6304|6579|6761)\d{12}(?:\d\d)?)$/.test(card))
		{
			success.innerHTML="maestro";  
		}
		else
		{
			success.innerHTML="";
			fail.innerHTML="not a valid card. Please Enter the valid !";
			return false;    
		}
	}
	else
	{
		success.innerHTML="";
		fail.innerHTML="Please Enter the card information!";
	}

} 


function dropdownss() 
{
	$('#statedropmenu').val($('#state1').val());
	//var no = $('#state1').val();
	//$('select[name^="state1"] option[value=""]').attr("selected",null);
	//$('select[name^="state1"] option[value="'+no+'"]').attr("selected","selected");
}

function dropcheck(a)
{
	$('#state').val(a);
}
