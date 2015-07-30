	$(document).ready(function() 
	{
		$('.data_table').delay(6000).fadeOut(600);
		$('#menu').slicknav();
	});
	window.onorientationchange = function() { location.reload() };
 
	function PopupCenter(pageURL, title,w,h)
	{
		var left = (screen.width/2)-(w/2);
		var top = (screen.height/2)-(h/2);
		var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
	}
	function fill(Value)
	{
		$('#search').val(Value);
		$('#display').hide();
	}
	jQuery(function($) 
	{
		var currentRequest = null;
		var data ='';
		$('#search').on('keyup', function() 
		{
			//$( "#search" ).autocomplete();
			$("#display").hide();
			var req1 = $('#search').val();
			var req2 ='New York';// $('#ccity').val();
			var req='name:'+req1+',ccity:'+req2;
			if (req.length > 0) 
			{
				$('#loading').show();
				$('#loading').html('<img src="images/spin.gif" height="20px">');
				currentRequest=$.ajax
				({
					url: "<?php echo base_url(); ?>search/autocomplete", //Controller where search is performed
					type: 'POST',
					data: {'name':req1,'ccity':req2},	
					beforeSend : function()
						{           
							if(currentRequest != null)
							{		
								currentRequest.abort();	
								data = '';	
								html = '';		
								$("#display").hide();
								
							}
						},		
						success: function(html)
						{
							$("#display").html(html).show();
							$('#loading').html('').hide();
							html ='';
							data = '';  
							//console.log(data);       
						}			
				});
		
			}
		});
	});

	/*side banner script*/
	$(window).load(function() 
	{
		var className = $('#add-banner').attr('class');
		if($(window).width() >= 770) 
		{
			if(className == 'addvert')
			{
				$(".main_contentarea").css({ 'padding-top': '0' });  
				$("#main_contentarea").css({ 'padding-top': '0' }); 
				$(".account").css({ 'padding-top': '0' });  
			}
			else
			{
				$(".main_contentarea").css({ 'padding-top': '8.5em' });  
				$("#main_contentarea").css({ 'padding-top': '8.5em' }); 
				$(".account").css({ 'padding-top': '8.5em' });
			}
		}
		$('#leftclosead').click( function()
		{ 
			$(this).parents('.ad_left').hide(); 
		});
		$('#rightclosead').click( function()
		{ 
			$(this).parents('.ad_right').hide(); 
		});

	});
	$(window).load(function() 
	{
	  $('.flexslider').flexslider
	  ({
			animation: "slide"
	  });
 
	});
	$(document).ready(function()
	{
		$('.browses').hover(function()
		{
			$(this) .find('.hoverimg').css('display','block');
			$(this) .find('#browseimg').css('display','none');
			$(this) .find('.hovertxt').css('color','#AE9D05');
		},
		function()
		{
			$(this) .find('.hoverimg').css('display','none');
			$(this) .find('#browseimg').css('display','block');
			$(this) .find('.hovertxt').css('color','black');
		});
		var height = $(".hm_lft_panel").height();
		var portion = Math.round(height)-83;
		var singleheight = Math.round(portion/6);
		var m_1 = Math.round(height/90);//8
		var m_2 = Math.round(height/144);//5
		$(".reviewspace_new").css({'margin-top': m_2,'margin-bottom':'0'});	
		$(".home_mar_line").css({'margin-top': m_2,'margin-bottom':m_1 });
		$(".reptitle h2").css({'padding':'0','line-height':'unset'});
		$(".review_blocks ").css({'height': singleheight});
	});
	$(function()
	{
		$('.review-slider').easyTicker
		({
			direction: 'Top',
			visible: 10,
			interval: 14000
		});
		if($(window).width() >= 1049)
		{
			$('.review-slider-right').easyTicker
			({
				direction: 'Top',
				visible: 10,
				interval: 18000
			});
		}
	});
	function elitelogin()
	{        
		if( $("#user_name").val()=='' )
		{
			 $("#user_name").val('').focus();
			 return false;
		}
		if( $("#user_pass").val()=='' )
		{
			 $("#user_pass").val('').focus();
			 return false;
		}
		$("#elitelogin").submit();
			
	}

	function userlogin()
	{  
		if( $("#loginemail").val()=='' )
		{
			 $("#loginemail").val('').focus();
			 return false;
		}
		if( $("#loginpassword").val()=='' )
		{
			 $("#loginpassword").val('').focus();
			 return false;
		}
		$("#userflogin").submit();		
	}
	function createCookie(name, value, days) 
	{
		var expires;
		if (days)
		{
			var date = new Date();
			date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
			expires = "; expires=" + date.toGMTString();
		} else {
			expires = "";
		}
			document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
	}
	
	function readCookie(name) 
	{
		var nameEQ = encodeURIComponent(name) + "=";
		var ca = document.cookie.split(';');
		for (var i = 0; i < ca.length; i++) 
		{
			var c = ca[i];
			while (c.charAt(0) === ' ') c = c.substring(1, c.length);
			if (c.indexOf(nameEQ) === 0) return decodeURIComponent(c.substring(nameEQ.length, c.length));
		}
		return null;
	}
	function eraseCookie(name) 
	{
		createCookie(name, "", -1);
	}	
	function __highlight(s, t) {
    var matcher = new RegExp("(" + $.ui.autocomplete.escapeRegex(t) + ")", "ig");
    return s.replace(matcher, "$1");
}

$(document).ready(
	function() {
	    $("#suggest").autocomplete(
		    {
			source : function(request, response) {
			    $.ajax({
				url : '/sp/ajax_suggest.php',
				dataType : 'json',
				data : {
				    term : request.term
				},

				success : function(data) {
					//alert(data);
				    response($.map(data, function(item) {
					return {
					    label : __highlight(item.label,
						    request.term),
					    value : item.label
					};
				    }));
				}
			    });
			},
			minLength : 3,
			select : function(event, ui) {

			    $('#searchbutton').submit();
			}
		    }).keydown(function(e) {
		if (e.keyCode === 13) {
		    $("#search_form").trigger('submit');
		}
	    }).data("ui-autocomplete")._renderItem = function(ul, item) {

		return $("<li></li>").data("item.autocomplete", item).append(
			$("<a></a>").html(item.label)).appendTo(ul);
	    };
	});
