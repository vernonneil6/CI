function trim(stringToTrim) {
      return stringToTrim.replace(/^\s+|\s+$/g,"");
}
$(document).ready(function() {
	
	$("#submitorder").click(function(){
		if(!$("#terms-conditions").prop('checked')){
			$("#terms-error").show().delay(5000).fadeOut();				
			return false;
		}
	});
  $("#btnaddcompany").click(function () {
	  
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
	  
	  var checkedCategory = [];
	$('.checkboxLabel:checked').each(function(){
         checkedCategory.push($(this).next("span").text());         
    });
    $("#categorylist").val(checkedCategory);
    
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
	
	  if(checkcard()==false)
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
	  $("#frmaddcompany").submit();
  });
});
/*get All States*/        
function getstates(id,state,where) {	//alert(id);
	if(id !='') {
		if(state == 'state1'){
			$('#countryname1').val($("#country1 :selected").text());
		}else{
			$('#countryname').val($("#country :selected").text());
		}
		var requestData = { 'type' : 'getAllStates', 'cid' : id , 'state':state };
		
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

