<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/tooltipster.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.tooltipster.min.js"></script>
<script>
	$(document).ready(function() {
		$('.tooltip').tooltipster();
	});
</script>

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
			<textarea cols='90' rows='10'><a href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/badge/rating/'.md5($this->session->userdata['youg_admin']['id']);?>" target="_blank" title="Get Widget">
			<img src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/images/badge.png'; ?>" class="logo_btm" alt="Yougotrated" title="Yougotrated"  width='7%' ></a></textarea></td></tr>
			<tr class="odd">
			<td>Sample Image</td>
			<td>
			<a href="#" class = "tooltip" target="_blank" title="Get Widget">
			<img src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/images/badge.png'; ?>" class="logo_btm" alt="Yougotrated" title="Yougotrated"  width='10%' ></a>
			</td>
		  </tr>
		</tbody>
		</table>	  
	</div>

</div>

<div class="tooltip"> 
   The company is a verified merchant.
</div>

<?php include('leftmenu.php'); ?>
<?php echo $footer; ?>
