var name = "#floatMenu";
var menuYloc = null;

$(document).ready(function(){

});

$(document).ready(function(){
	
	var address = window.location.href;

	$('.mainmenu').find('a.link').each(function() {
		
	   if($(this).attr('href') == address)
	   {
		   //alert($(this).attr('href'));
		   $(this).parent().parent().parent().parent().parent().addClass('active');		   	   
		   $(this).parent().parent().parent().parent().addClass('activateblock');		   	   
		   $(this).parent().parent().parent().addClass('active');		   
		   $(this).parent().parent().addClass('activateblock');
		   $(this).parent().addClass('active');
		   $(this).addClass("activatelink");
	   }
	});
	
	// Sidebar Accordion Menu
	$(".mainmenu li ul").hide();
	//$(".mainmenu li.active a").parent().find("ul").slideToggle("slow");
	
	/*$(".mainmenu a").click(function () {
	    $(".mainmenu li").removeClass('active');
	    $(this).parent().addClass('active');
			$(this).parent().siblings().find("ul").slideUp("600");
			$(this).next().slideToggle("600");
			return false;
		}
	);
	 
	$(".mainmenu li .submenu a").click(function () {
	    $(".mainmenu li").removeClass('active');
	    $(this).parent().parent().parent().addClass('active');
	    $(this).parent().addClass('active');
			window.location.href=(this.href);
			return false;
		}
	);*/
	
	$(".topmenu").click(function () {
			$(".mainmenu li").removeClass('active');
			$(this).removeClass('activatelink');
			$(this).parent().addClass('active');		
			$(this).parent().siblings().find(".submenu").removeClass('activateblock');
			$(this).parent().siblings().find(".submenu").slideUp("600");
			$(this).next().slideToggle("600");
			return false;
		}
	);
	
	$(".childmenu").click(function () {
			$(".submenu li").removeClass('active');
			$(this).removeClass('activatelink');
			$(this).parent().addClass('active');
			$(this).parent().siblings().find(".child").removeClass('activateblock');
			$(this).parent().siblings().find(".child").slideUp("600");
			$(this).next().slideToggle("600");
			return false;
		}
	);
		
	$(".mainmenu li a.link").click(function () {
			window.location.href=(this.href);
			return false;
		}
	);

	// Close form message
	$(".form-message").click(function () { 
      $(this).fadeTo(500, 0, function () { // Links with the class "close" will close parent
				$(this).slideUp(300);
			});      
		return false;
		}
	);

	// Initialise float menu
	menuYloc = parseInt($(name).css("top").substring(0,$(name).css("top").indexOf("px")))
	$(window).scroll(function () {
		var offset = menuYloc+$(document).scrollTop()-"92"+"px";
		$(name).animate({top:offset},{duration:500, queue:false});
		  if ($(document).scrollTop() <= '96') {
		  var offset = "0";
		  $(name).animate({top:offset},{duration:500, queue:false});
		  }
	});

	// File upload
	$(function() {
	  $("input.upload-file").filestyle({ 
		image: "../images/choose-file.gif",
		imageheight : 29,
		imagewidth : 99,
		width : 300
	  });
	});
	
	// Table checkbox
	$('.check-all').click(
	  function(){
		  $(this).parent().parent().parent().find(".checkbox input").attr('checked', $(this).is(':checked'));   
	  }
	)
	
	// Table row odd
	$(".tab tr:odd").addClass("odd");
	
	/*
	// Initialise Tabs
	$("#tabs").tabs();

	// Initialise Tabs
	$("#tabs-statistic").tabs();
	
	// Initialise Datepicker
	$('.date-pick').datePicker().val(new Date().asString()).trigger('change');	
	
	// Show gallery tools ico
	$(".gallery .item").hover(function(){     
		$(this).find(".tools").show(); 
	  }, function() { 
		$(this).find(".tools").hide(); 
	  } 
	);
	
	// Initialise FancyBox Modal window:
	$("a.fancy").fancybox({
		'titlePosition'			: 'inside',
		'hideOnOverlayClick' 	: 'true',
		'hideOnContentClick' 	: 'true',
		'enableEscapeButton' 	: true,
		'showCloseButton' 		: true
	});

	$('.help').fancybox({
		'modal' 				: false,
		'hideOnOverlayClick' 	: 'true',
		'hideOnContentClick' 	: 'true',
		'enableEscapeButton' 	: true,
		'showCloseButton' 		: true		
	});

	$('.modal').fancybox({
		'modal' 				: false,
		'hideOnOverlayClick' 	: 'true',
		'hideOnContentClick' 	: 'true',
		'enableEscapeButton' 	: true,
		'showCloseButton' 		: true		
	});
	
	// Table drag on drop
	$(".tab-drag").tableDnD({ 
		  onDrop: function(table, row) {
		  $(".tab-drag tr").removeClass('odd'); 
		  $(".tab-drag tr:odd").addClass('odd'); 
		  var rows = table.tBodies[0].rows;
		  var count = '';
		  for (var i=1; i<rows.length; i++) {
			count += rows[i].id + '/'; 
		}
	  },
	  dragHandle: "dragHandle" 
	});
	
	// Clear value input filter
	$('input, textarea').each(function () {
	  if ($(this).val() == '') {
		  $(this).val($(this).attr('Title'));
	  }
	}).focus(function () {
	  $(this).removeClass('inputerror');
	  if ($(this).val() == $(this).attr('Title')) {
		  $(this).val('');
	  }
	}).blur(function () {
	  if ($(this).val() == '') {
		  $(this).val($(this).attr('Title'));
	  }
	});
	
	// Show filter
	$(".show-filter").toggle(function(){    
		$(this).addClass("active");
		$(this).text("hidden filter");
		$(".filter").slideDown("slow");
	  }, function() {
		$(this).removeClass("active");
		$(this).text("show filter");
		$(".filter").slideUp("slow");
	  } 
	);
	
	// Initialise Graphs
	$('#pie').visualize({type: 'pie', height: 250});
	  $('#bar').visualize({type: 'bar'});
	  $('#line').visualize({type: 'line'});
  
	// Initialise WYSIWYG editor
	$(".wysiwyg").wysiwyg();
	*/
	
    
});
