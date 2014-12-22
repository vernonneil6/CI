function trim(stringToTrim) {
                  return stringToTrim.replace(/^\s+|\s+$/g,"");
              }
              $(document).ready(function() {
                  $("#btnaddcompany").click(function () {
					 				  
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
					   if(checkcard()==false)
					  {
						return false;  
					  }
					 					  
					  $("#frmaddcompany").submit();
                  });
              });
function number(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
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
	  }
	 else if (/^4[0-9]{6,}/.test(card))
	  {
	   success.innerHTML="visa";
	  }
      else if (/^3[47][0-9]{13}$/.test(card))
	  {
	   success.innerHTML="American Express";
	  }
	  else if(/^(?:6(?:011|5[0-9][0-9])[0-9]{12})$/.test(card))
	  {
	   success.innerHTML="discover"; 
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
