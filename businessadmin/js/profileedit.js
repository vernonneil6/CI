$(document).ready(function() {
		$("#btnupdate").click(function () {
			if( trim($("#company").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#companyerror").show();
				$("#company").val('').focus();
				return false;
			}
			else
			{
				$("#companyerror").hide();
			}
			
			if( trim($("#streetaddress").val()) == "" )
			{
				$("#error").attr('style','display:block;');
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
				$("#error").attr('style','display:block;');
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
				$("#error").attr('style','display:block;');
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
				$("#error").attr('style','display:block;');
				$("#countryerror").show();
				$("#country").val('').focus();
				return false;
			}
			else
			{
				$("#countryerror").hide();
			}
			
			var zipcode = /^([0-9\(\)\/\+ \-]*)$/; 
			if(trim($("#zip").val()) == "")
			{
				$("#ziperror").show();
				$("#zip").val('').focus();
				return false;
			}
			else
			{
				if( !zipcode.test(trim($("#zip").val())) || trim($("#zip").val()).length < 4)
				{
					$("#ziperror").hide();
					$("#error").attr('style','display:block;');
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

			}
			
			if( trim($("#siteurl").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#siteurlerror").show();
				$("#siteurlerror").text('Site Url is required.');
				$("#siteurl").val('').focus();
				return false;
			}
			else
			{
				var txt = $('#siteurl').val();
				//var re = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
				var re = /^(?:(?:https?|ftp):\/\/)(?:\S+(?::\S*)?@)?(?:(?!10(?:\.\d{1,3}){3})(?!127(?:\.\d{1,3}){3})(?!169\.254(?:\.\d{1,3}){2})(?!192\.168(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/[^\s]*)?$/
				//var regexp = /(http(s)?:\\)?([\w-]+\.)+[\w-]+[.com|.in|.org]+(\[\?%&=]*)?/
				if (re.test(txt)) {					
				}
				else {
					$("#error").attr('style','display:block;');
					$("#siteurlerror").show();
					$("#siteurlerror").text('Please enter a valid URL. For example http://www.example.com or https://www.example.com');
					$("#siteurl").focus();
					return false;
				}
				$("#siteurlerror").hide();
			}
					
			var pfilter = /^([0-9\(\)\/\+ \-]*)$/; 
			if(trim($("#phone").val()) == "")
			{
				$("#phoneerror").show();
				$("#phone").val('').focus();
				return false;
			}
			else
			{
				if( !pfilter.test(trim($("#phone").val())) || trim($("#phone").val()).length <10)
				{
					$("#phoneerror").hide();
					$("#error").attr('style','display:block;');
					$("#phoneinverror").show();
					$("#phone").focus();
					return false;
				}
				else
				{
					$("#phoneinverror").hide();
					$("#phoneerror").hide();
				}
			}
		
			
			
			if( trim($("#contactname").val()) == "" )
			{
				
				$("#error").attr('style','display:block;');
				$("#contactnameerror").show();
				$("#contactname").val('').focus();
				return false;
			}
			else
			{
				$("#contactnameerror").hide();
			}
			if( trim($("#ctitle").val()) == "" )
			{
				
				$("#error").attr('style','display:block;');
				$("#titleerror").show();
				$("#ctitle").val('').focus();
				return false;
			}
			else
			{
				$("#titleerror").hide();
			}
			
			if( trim($("#companystreet").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#contactcompanystreeterror").show();
				$("#companystreet").val('').focus();
				return false;
			}
			else
			{
				$("#contactcompanystreeterror").hide();
			}
			
			if( trim($("#companycity").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#contactcompanycityerror").show();
				$("#companycity").val('').focus();
				return false;
			}
			else
			{
				$("#contactcompanycityerror").hide();
			}
			
			
			if( trim($("#companystate").val()) == "" )
			{   
				$("#error").attr('style','display:block;');
				$("#contactcompanystateerror").show();
				$("#companystate").val('').focus();
				return false;
			}
			else
			{
				$("#contactcompanystateerror").hide();
			}
			
			if( trim($("#companycountry").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#contactcompanycountryerror").show();
				$("#companycountry").val('').focus();
				return false;
			}
			else
			{
				$("#contactcompanycountryerror").hide();
			}
			
			var zipcode = /^([0-9\(\)\/\+ \-]*)$/; 
			if(trim($("#companyzip").val()) == "")
			{
				$("#contactcompanyziperror").show();
				$("#companyzip").val('').focus();
				return false;
			}
			else
			{
				if( !zipcode.test(trim($("#companyzip").val())) || trim($("#companyzip").val()).length < 4)
				{
					$("#ziperror").hide();
					$("#error").attr('style','display:block;');
					$("#contactcompanyvziperror").show();
					$("#companyzip").focus();
					return false;
				}
				else
				{
					$("#contactcompanyziperror").hide();
					$("#contactcompanyvziperror").hide();
				}
			}
			
			
			var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if( trim($("#contactemail").val()) == "" )
			{   
				
				$("#contactcompanyvemailerror").hide();
				$("#contactcompanyemailerror").show();
				$("#contactemail").val('').focus();
				return false;
			}
			else
			{
				if( !filter.test(trim($("#contactemail").val())) )
				{

					$("#contactcompanyvemailerror").hide();
					$("#contactcompanyemailerror").show();
					$("#contactemail").val('').focus();
					return false;

				}

			}
			
			
			var pfilter = /^([0-9\(\)\/\+ \-]*)$/; 
			if(trim($("#contactphonenumber").val()) == "")
			{
				$("#contactphonenumbererror").show();
				$("#contactphonenumber").val('').focus();
				return false;
			}
			else
			{
				if( !pfilter.test(trim($("#contactphonenumber").val())) || trim($("#contactphonenumber").val()).length <10)
				{
					$("#contactphonenumbererror").hide();
					$("#error").attr('style','display:block;');
					$("#contactvphonenumbererror").show();
					$("#contactphonenumber").focus();
					return false;
				}
				else
				{
					$("#contactvphonenumbererror").hide();
					$("#contactphonenumbererror").hide();
				}
			}
		
			
		});
	
	});

 
