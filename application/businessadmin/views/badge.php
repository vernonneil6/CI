<?php echo $header; ?>


<div id="content">

	<div class="breadcrumbs">
		<ul>
		  <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
		  <li><a href="<?php echo site_url('badge');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
		</ul>
	</div>


	<div class="box">
		<div class="headlines">
		  <h2><span><?php echo "Badge" ?></span></h2>
		</div>
		
		<table class="tab tab-drag">
		 <tbody><tr class="top nodrop nodrag"> </tr>       
		 <tr class="odd">
			<td>Badge Url</td>
			<td>
			<textarea cols='90' rows='10'>
				<a href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'company/'.urlencode($company['companyseokeyword']).'/reviews/coupons/complaints';?>"  class="disablerightclick" >
					<img src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/images/badge.png'; ?>" class="tooltip"  title="The <?php echo $company['company']; ?> is a verified merchant.">
				</a>
			</textarea>
			</td>
		</tr>
			
			<tr class="odd">
			<td>Sample Image</td>
			<td>
			<a href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'company/'.urlencode($company['companyseokeyword']).'/reviews/coupons/complaints';?>" class="disablerightclick" >
				<img src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/images/badge.png'; ?>"  class="tooltip" title="The <?php echo $company['company']; ?> is a verified merchant.">
			</a>
			</td>
		  </tr>
		</tbody>
		</table>	  
	</div>

</div>

<div class="tooltip"> 
   
</div>

<?php include('leftmenu.php'); ?>
<?php echo $footer; ?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/tooltipster.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.tooltipster.min.js"></script>
<script>
	$(document).ready(function() {
		$('.tooltip').tooltipster();
		
		$('.disablerightclick').on("contextmenu",function(e)
		{
			alert('right click disabled');
			return false;
		});

	});
</script>

