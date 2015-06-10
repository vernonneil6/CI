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
		  <h2><span><?php echo "Graphic" ?></span></h2>
		</div>
		
		<table class="tab tab-drag">
		 <tbody><tr class="top nodrop nodrag"> </tr>       
		<tr class="odd">
			<td></td>
			<td>
			<div class="widget_para">Please have your web developer copy this embed code into your email blast, website, blog, etc to help encourage positive reviews about your company.</div>
			</td>
		</tr>
		 <tr class="odd">
			<td>Graphic Embed Code</td>
			<td>
			<textarea cols='90' rows='10'>
				<img src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/images/YGR_email.jpg'; ?>"  title="<?php echo ucfirst($company['company']); ?>" usemap="#graphicmap">
				<map name="imgmap" id="graphicmap">
					<area shape="poly" coords="177,101,177,82,274,83,276,101" href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/company/'.urlencode($company['companyseokeyword']).'/reviews/coupons/complaints';?>">
				</map>
			</textarea>
			
			</td>
		</tr>
			
		<tr class="odd">
			<td>Sample Image</td>
			<td>
				<img src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/images/YGR_email.jpg'; ?>"  title="<?php echo ucfirst($company['company']); ?>" usemap="#graphicmap">
				<map name="imgmap" id="graphicmap">
					<area shape="poly" coords="177,101,177,82,274,83,276,101" href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/company/'.urlencode($company['companyseokeyword']).'/reviews/coupons/complaints';?>">
				</map>
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

