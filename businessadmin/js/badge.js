$(document).ready(function() 
{
		$('.tooltip').tooltipster();
		
		$('.disablerightclick').on("contextmenu",function(e)
		{
			alert('This is an copyright seal');
			return false;
		});

});
