<?php echo $header;?>
<?php $avgstar = $this->common->get_avg_ratings_bycmid($company[0]['id']);
			$itemproaverage = $avgstar;
			$star = explode('.',$itemproaverage);
			$avgstar = round($avgstar);
			$elitemem_status = $this->common->get_eliteship_bycompanyid($company[0]['id']);
			
			?>
<!--<script type="text/javascript" src="js/tytabs.jquery.min.js"></script>-->

<link rel="stylesheet" href="<?php echo site_url('js/Easy-Responsive-Tab-Accordion/easy-responsive-tabs.css'); ?>">

<script src="<?php echo site_url('js/Easy-Responsive-Tab-Accordion/easy-responsive-tabs.js');?>"></script>



<script type="text/javascript">
	$(document).ready(function(){
		
		
		$('#horizontalTab').easyResponsiveTabs({
			type: 'default', //Types: default, vertical, accordion           
			width: 'auto', //auto or any width like 600px
			fit: true,   // 100% fit in a container
			closed: 'accordion', // Start closed if in accordion view
			activate: function(event) { // Callback function if tab is switched
			var $tab = $(this);
			var $info = $('#tabInfo');
			var $name = $('span', $info);
			$name.text($tab.text());
			$info.show();
			}
		});
		
		
		$( ".stars" ).each(function() { 
			// Get the value
			var val = $(this).data("rating");
			// Make sure that the value is in 0 - 5 range, multiply to get width
			var size = Math.max(0, (Math.min(5, val))) * 23;
			// Create stars holder
			var $span = $('<span />').width(size);
			// Replace the numerical value with stars
			$(this).html($span);
		});
		
		
		 // tabbed content
    // http://www.entheosweb.com/tutorials/css/tabs.asp
    $(".tab_content").hide();
    $(".tab_content:first").show();

  /* if in tab mode */
    $("ul.tabs li").click(function() {
		
      $(".tab_content").hide();
      var activeTab = $(this).attr("rel"); 
      $("#"+activeTab).fadeIn();		
		
      $("ul.tabs li").removeClass("active");
      $(this).addClass("active");

	  $(".tab_drawer_heading").removeClass("d_active");
	  $(".tab_drawer_heading[rel^='"+activeTab+"']").addClass("d_active");
	  
    });
	/* if in drawer mode */
	$(".tab_drawer_heading").click(function() {
      
      $(".tab_content").hide();
      var d_activeTab = $(this).attr("rel"); 
      $("#"+d_activeTab).fadeIn();
	  
	  $(".tab_drawer_heading").removeClass("d_active");
      $(this).addClass("d_active");
	  
	  $("ul.tabs li").removeClass("active");
	  $("ul.tabs li[rel^='"+d_activeTab+"']").addClass("active");
    });
	
	
	
	
	/* Extra class "tab_last" 
	   to add border to right side
	   of last tab */
	$('ul.tabs li').last().addClass("tab_last");
	
		
	});
</script>
<section class="container">
  <section class="main_contentarea">
    <div class="innr_wrap wrapborder" itemscope itemtype="http://schema.org/localBusiness">

		<!-- Go to www.addthis.com/dashboard to customize your tools -->
				<div class="addthis_native_toolbox"></div>

      <div class="left_panel  leftpanelwidth">

		
		<div>
			<?php 
			
			$company_seoslug = ($company) ? $company[0]['seoslug'] : '';
			if(count($elitemem_status)==0){?>
			<div class="vry_logo"> <a href="<?php echo site_url($company_seoslug);?>" title="view company Detail"><img src="images/notverified.png" class="imgverify" alt="<?php echo ucfirst(stripslashes($company[0]['company'])); ?>" /></a> </div>
			<?php }else{
					  ?>
			<div class="vry_logo"> <a href="<?php echo site_url($company_seoslug);?>" title="view company Detail"><img src="images/verifiedlogo.jpg" class="imgverify" alt="<?php echo ucfirst(stripslashes($company[0]['company'])); ?>" /></a> </div>
			<?php } ?>
			  
				  
			<?php if(count($elitemem_status)==0){?>
			<div>
				<?php $urls="http://business.yougotrated.com/?elitemem=".$company[0]['id'].""; ?>
				
				<a href="<?php echo $urls;?>" title="Upgrade to Elite">
					<img src="images/YouGotRated_BusinessProfile_NotVerified-CompanyHeaderText.jpg">
				<div class="business_link"> 			
					IS THIS YOUR BUSINESS? CLICK HERE TO BECOME VERIFIED			
				</div>
				</a>    
			</div>
      
			<div class="compny_name">
			  <h1><span itemprop="name" class = "fn" ><?php echo strtoupper($company[0]['company']);?></span></h1>
			  <div class="vry_rating vryrating">
	           
	           <?php if($star[0] < 2) { ?>
	           
				<div class ="count-<?php echo $star[0] ?>">
					<?php for($r=0;$r<($star[0]);$r++){?>
					<i class="vry_rat_icn"></i>
					<?php } ?>
				</div>	
					<?php for($p=0;$p<(5-($star[0]));$p++){?>
					<i class="dull_starrat"></i>
				   <?php } } else {?>
							<span class="stars" data-rating="<?php echo $itemproaverage; ?>"></span>
					<?php }?>		
			  </div>
			</div>
			<?php }else { ?>
      
			<div class="compny_name">

					<h1><span itemprop="name" class = "fn"><?php echo strtoupper($company[0]['company']);?></span></h1>

			<div class="vrytitle">YouGotRated VERIFIED MERCHANT</div>
			  <div class="vry_rating vryrating">
				<?php if($star[0] < 2) { ?>
				<div class ="count-<?php echo $star[0] ?>">
					<?php for($r=0;$r<($star[0]);$r++){?>
					<i class="vry_rat_icn"></i>
					<?php } ?>
				</div>	
					<?php for($p=0;$p<(5-($star[0]));$p++){?>
					<i class="dull_starrat"></i>
				   <?php } } else { ?>  
			   <span class="stars" data-rating="<?php echo $itemproaverage; ?>"></span>
			   <?php } ?>
			  </div>
			</div>
			<?php } ?>
        
			
			<div class="vry_btn vry_width">
				<a href="review/add/<?php echo $company[0]['id'];?>" title="Write review">WRITE REVIEW</a> 
				<a href="<?php echo site_url('complaint/add/'.$company[0]['id']);?>" title="File Complaint">FILE COMPLAINT</a>
			</div>
			
			
      </div>


      <div class="contct_dtl">
          <ul itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
			  <?php $country = $this->complaints->get_country_byidss($company[0]['country']); if($country){  $elitecountry=$country['name']; } else { $elitecountry=$company[0]['country'];}
			        $companycountry= $this->complaints->get_country_byidss($company[0]['companycountry']); if($companycountry){ $nonelitecountry=$companycountry['name']; } else { $nonelitecountry=$company[0]['companycountry'];}?>
			  <?php if(count($elitemem_status) > 0) { ?>
			         
			         <?php if($company[0]['companystreet']=="" || $company[0]['companystreet']!="" ) { ?>
                        
					   <?php if($company[0]['companystreet']==""){ ?>
							<li><a><span itemprop="streetAddress" style='font-family: "myriadpro-regular"; margin: 0px; color: #575757;'><?php echo strtoupper(stripslashes($company[0]['streetaddress'])); ?></span></a></li>
							<li><a><span itemprop="addressLocality" style='font-family: "myriadpro-regular"; margin: 0px; color: #575757;'><?php echo strtoupper(stripslashes($company[0]['city'].',     '.$company[0]['state'].',     '.$company[0]['zip'].',		'.$elitecountry)); ?></span></a></li>
					   
					   <?php }  if($company[0]['companystreet']!="") { ?>
						
								<li><a><span itemprop="streetAddress" style='font-family: "myriadpro-regular"; margin: 0px; color: #575757;'><?php echo strtoupper(stripslashes($company[0]['companystreet'])); ?></span></a></li>
							   <li><a><span itemprop="addressLocality" style='font-family: "myriadpro-regular"; margin: 0px; color: #575757;'><?php echo strtoupper(stripslashes($company[0]['companycity'].',  '.$company[0]['companystate'].',   '.$company[0]['companyzip'].',		'.$nonelitecountry)); ?></span></a></li>
				     <?php } } ?>
				
		    <?php } else { ?>
			  
			 <?php if($company[0]['companystreet']=="" || $company[0]['companystreet']!="" ) { ?>
              
					   <?php if($company[0]['companystreet']==""){?>
							<li><a><span itemprop="streetAddress" style='font-family: "myriadpro-regular"; margin: 0px; color: #575757;'><?php echo strtoupper(stripslashes($company[0]['streetaddress'])); ?></span></a></li>
							<li><a><span itemprop="addressLocality" style='font-family: "myriadpro-regular"; margin: 0px; color: #575757;'><?php echo strtoupper(stripslashes($company[0]['city'].',     '.$company[0]['state'].',     '.$company[0]['zip'].',		'.$elitecountry)); ?></span></a></li>
					   
					   <?php }  if($company[0]['companystreet']!="") {?>
						
								<li><a><span itemprop="streetAddress" style='font-family: "myriadpro-regular"; margin: 0px; color: #575757;'><?php echo strtoupper(stripslashes($company[0]['companystreet'])); ?></span></a></li>
							   <li><a><span itemprop="addressLocality" style='font-family: "myriadpro-regular"; margin: 0px; color: #575757;'><?php echo strtoupper(stripslashes($company[0]['companycity'].',  '.$company[0]['companystate'].',   '.$company[0]['companyzip'].',		'.$nonelitecountry)); ?></span></a></li>
				     <?php } } ?>
			  <?php } ?>
            <li class = "singletimings">
				<?php 
				if(count($elitemem_status)!=0)
				{
					if(count($company_timings) > 0)
					{
						if($company_timings['off']=='Yes')
						{
				?>
							<label>Closed</label>
				<?php
						}
						if($company_timings['off']=='No')
						{
						?>
							<label class = "font_size_bold">Open Today </label> : <?php echo date("g:i A",strtotime($company_timings['start']));?> - <?php echo date("g:i A",strtotime($company_timings['end']));
						}
					}
				} 
				?>
			</li>
            <li><a class="colors" href="tel:<?php echo $company[0]['phone'];?>" title="<?php echo $company[0]['phone'];?>"><span itemprop="telephone"><?php echo $company[0]['phone']; ?></span></a></li>
            <?php if(strlen($company[0]['fax']>8)){?>
            <li><a><?php echo $company[0]['fax'];?></a></li>
            <?php } ?>
			<li><a href="mailto:<?php echo strtoupper($company[0]['email']);?>" title="Email us" class="colors"><?php echo strtoupper($company[0]['email']);?></a></li>
            <li>
              <a class="colors" itemprop="url" href="<?php  echo (strpos($company[0]['siteurl'],'http') !== false) ? '' :'//'; echo strtoupper($company[0]['siteurl']);?>" target="_blank" title="<?php echo $company[0]['siteurl'];?>"><?php echo strtoupper($company[0]['siteurl']);?></a>
            </li>

          </ul>
        </div>
        
        <div itemscope itemtype = "http://schema.org/AggregateRating" itemprop = "aggregateRating">
			  <meta itemprop = "reviewCount" content = "<?php echo $to_reviews; ?>" >
			  <meta itemprop = "ratingValue" content = "<?php echo $itemproaverage; ?>" >
			  <meta itemprop = "bestRating" content = "<?php echo  '5'; ?>" >
			  <meta itemprop = "worstRating" content = "<?php echo '0'; ?>" >	
		</div>	
		
        <div class="social_blck">
          <?php if(count($elitemem_status)!=0){?>
          <ul>
            <?php for($cs=0;$cs<count($companysems);$cs++)
			  {?>
	     <?php if($companysems[$cs]['type']=='t'){?>
            <?php if(strlen($companysems[$cs]['url'])>7){?>
            <li class="twitter"><a href="<?php echo $companysems[$cs]['url'];?>" title="twitter" target = "_blank"></a></li>
            <?php }} ?>
             <?php if($companysems[$cs]['type']=='f'){?>
            <?php if(strlen($companysems[$cs]['url'])>7){?>
            <li class="facebook"><a href="<?php echo $companysems[$cs]['url'];?>" title="facebook" target = "_blank"></a></li>
            <?php }} ?>
            <?php if($companysems[$cs]['type']=='g'){?>
            <?php if(strlen($companysems[$cs]['url'])>7){?>
            <li class="google"><a href="<?php echo $companysems[$cs]['url'];?>" title="google" target = "_blank"></a></li>
            <?php }} ?>
   	     <?php if($companysems[$cs]['type']=='p'){?>
            <?php if(strlen($companysems[$cs]['url'])>7){?>
            <li class="pintrest"><a href="<?php echo $companysems[$cs]['url'];?>" title="pintrest" target = "_blank"></a></li>
            <?php }} ?>
            <?php if($companysems[$cs]['type']=='a'){?>
            <?php if(strlen($companysems[$cs]['url'])>7){?>
            <li class="amazon"><a href="<?php echo $companysems[$cs]['url'];?>" title="amazon" target = "_blank"></a></li>
            <?php }} ?>
            <?php if($companysems[$cs]['type']=='e'){?>
            <?php if(strlen($companysems[$cs]['url'])>7){?>
            <li class="ebay"><a href="<?php echo $companysems[$cs]['url'];?>" title="ebay" target = "_blank"></a></li>
            <?php }} ?>
         <?php if($companysems[$cs]['type']=='l'){?>
            <?php if(strlen($companysems[$cs]['url'])>7){?>
            <li class="linkedin"><a href="<?php echo $companysems[$cs]['url'];?>" title="linkedin"></a></li>
            <?php }} ?>
            <?php if($companysems[$cs]['type']=='y'){?>
            <?php if(strlen($companysems[$cs]['url'])>7){?>
           <!--  <li class="youtube"><a href="<?php echo $companysems[$cs]['url'];?>" title="youtube"></a></li>-->
            <?php }} ?>
            <?php } ?>
          </ul>
          <?php } ?>
        </div>

         <div class="get_dirct">
          <div class="getdir_title">
            <!--<label id="directions">GET DIRECTIONS</label>
            <i class="line"></i>--> 
            <?php 
			  $mapaddress = stripslashes($company[0]['streetaddress'].','.$company[0]['city'].','.$company[0]['state'].','.$company[0]['country'].','.$company[0]['zip']);
			  $string = str_replace(' ', '-', $mapaddress);
			  $mapaddress = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
			  
			  $mapaddress1 = stripslashes($company[0]['city'].','.$company[0]['state'].','.$company[0]['country'].','.$company[0]['zip']);
			  $string1 = str_replace(' ', '-', $mapaddress1);
			  $mapaddress1 = preg_replace('/[^A-Za-z0-9\-]/', '', $string1);
			  $address=$mapaddress.'add='.$mapaddress1;
			?>
            <script>
			function PopupCenter(pageURL, title,w,h)
			 {
			  var left = (screen.width/2)-(w/2);
		  	  var top = (screen.height/2)-(h/2);
			  var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
			 }
			</script>
			<label class = "view_direction_map" onclick="PopupCenter('businessdirectory/map/<?php echo $address; ?>','','800','500');" target="_blank" title="View Map">Get Directions</label>       		         
		</div>
		
	   </div>
		
		
		<?php if( count($elitemem_status)>0 )  {	?>
        <?php if( count($companypdfs) > 0 ) { ?>
		<?php for($x=0; $x<count($companypdfs); $x++) { ?>
		<script>
		function PopupCenter(pageURL, title,w,h)
		 {
		  var left = (screen.width/2)-(w/2);
		  var top = (screen.height/2)-(h/2);
		  var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
		 }		
		</script>
		
		<div class="get_dirct">
			<div class="getdir_title">
				<?php $file = $this->common->get_setting_value(2).$this->config->item('pdf_main_upload_path')."uploads/pdf/".$companypdfs[$x]['pdf'];?>
				<?php $title = ucfirst(stripslashes($companypdfs[$x]['title'])); ?>
				<div>
				<label style="cursor: pointer;" onclick="PopupCenter('<?php echo $file;?>','<?php echo $title;?>','800','500');" class = "view_direction_map" target="_blank" title="View document">
					<?php echo $companypdfs[$x]['title'];?>
				</label>
				</div>		
			</div>
		</div>
		
	  <?php } } } ?>

        <div class="review_wrp">
          <div class="contct_dtl">
            <ul>
              
              <li><span>TOTAL REVIEWS </span><my class="fontcolors";><?php echo $to_reviews;?></my></li>
              <li><a style="font-size: 11px;">Some Reviews may have originated from other review platforms and have been aggregated. </a></li>
              <li><span>TOTAL COMPLAINTS </span><my  class="fontcolors";> <?php echo $to_complaints;?></my></li>
              <?php /*<li><span>TOTAL DAMAGES </span><my  class="fontcolors";> $  <?php if($to_damages!=''){ echo round($to_damages);}else{echo "0";}?>  </my></li>*/?>
			  <?php if($company[0]['price_range']!='') { ?>
				<li><span>PRICE RANGE </span><my  class="fontcolors";> <?php echo $company[0]['price_range'];?></my></li>
              <?php } ?>
              <li><span>ACCEPTS CREDIT CARDS </span><my  class="fontcolors";> <?php echo $company[0]['accept_credit_cards'];?></my></li>
              <li><span>ACCEPTS PAYPAL </span><my  class="fontcolors";> <?php echo $company[0]['accept_paypal'];?></my></li>
			  <li><span>CATEGORY</span><a>
        
          <?php $ex = explode(',',$company[0]['categoryid']); ?>
          <?php for($a=0;$a<count($ex);$a++)
			  {
			  		
					$cat = $this->complaints->get_category_byid($ex[$a]);
					if(count($cat)>0) 
					{
						?>
                        <a class="fontcolors";>
                                
                        <?php
                        echo strtoupper($cat[0]['category']);
						?>
                        </a>
						<?php
                      
					}
			  }
			  ?>
            </a></li>
            </ul>
          </div>
        </div>

        </ul>
     </div>
     

    <div class="right_panel rightpanelwidth">

	<div class = "profile_about_us">
		<?php if($company[0]['aboutus']){ ?>
			<div class = "profile_about_company"><h3>About <?php echo $company[0]['company']; ?></h3></div>
			<div class = "profile_about_data">
				<?php echo stripslashes(substr($company[0]['aboutus'], 0, 480)); 
				if(strlen($company[0]['aboutus']) > 480)
				{ 
				?>
					...<a href = "#readmore" class = "readmore font_color_1">Read More</a>
				<?php
				}
				?>
			</div>
		<?php } ?>
	</div>
	<div id = "readmore" style = "width : 500px; display : none">
		<div class = "profile_about_company">
			<h3>About <?php echo $company[0]['company']; ?></h3>
		</div>
		<div class = "profile_about_data">
			<?php echo stripslashes($company[0]['aboutus']); ?>
		</div>
	</div>

 <!--Profile Tab--->

	<div id="horizontalTab" class="profile_tab_space">
	<ul class="resp-tabs-list">
		<li>REVIEWS</li>
		<li>COMPLAINTS</li>
		<?php if(count($elitemem_status)==0){?>
		<li>COUPONS</li>		 
		<?php } else {  ?>				
		<li>COUPONS</li>
		<li>PRESS RELEASES</li>			  
		<li>PHOTOS</li>
		<li>VIDEOS</li>
		<?php } ?>	
	</ul>
	<div class="resp-tabs-container">
		<div>	
			<p>		
		<?php if( count($reviews) > 0 ) { 
			if(count($reviews)>5)
			{
				$newreviews = 5;
			}
			else
			{
				$newreviews = count($reviews);
			}
			for($i=0; $i<$newreviews; $i++) { 			    
				$users = $this->users->get_user_bysingleid($reviews[$i]['reviewby']); 
		?>
		<div itemscope itemtype = "http://schema.org/Review" itemprop = "review" class="review_block <?php if($i%2==0){echo "fadeout";}?>">
		<div class="review_lft">

			<div class="user_img">
			<?php if($users['avatarthum']==null) {?>
				<img src="images/default_user.png" alt="User image" title="User image">
			<?php } else {?>
				<img src="uploads/user/thumb/<?php echo $users['avatarthum'];?>" alt="User image" title="User image">	 
			<?php } ?>
			</div>
			<meta itemprop = "itemReviewed" content = "<?php echo site_url(); ?>">
		</div>
		<div class="review_rgt reviewstab">
			<div class="user_name">	
			<?php 
			if($reviews[$i]['type']=='csv' || $reviews[$i]['type']=='ygr') 
			{ 
			if($users['id']==$reviews[$i]['reviewby'])
			{
			?>
				<a href="<?php echo site_url('complaint/viewuser/'.$reviews[$i]['companyid'].'/'.$reviews[$i]['reviewby']);?>" title="view profile"><span itemprop = "author"><?php if($users['username']!=''){ echo $users['username']; } else { echo $users['firstname']; } ?></span></a>
			<?php
			}
			else
			{
			?>
				<a><span itemprop = "author"><?php echo $reviews[$i]['reviewby']; ?></span></a>
			<?php
			}
			?>
			<div class="datereview"><span itemprop = "datePublished"><?php echo date("m/d/Y",strtotime($reviews[$i]['reviewdate']));?></span></div>
		<?php  
		} 
		?>
		</div>
		<div class="review_ratng_wrp">
		<div class="rating <?php if($i%2==0){echo "raticn";}?>">
		<div class ="count-<?php echo $reviews[$i]['rate']?>">
		<?php for($r=0;$r<($reviews[$i]['rate']);$r++){?>
		<i class="vry_rat_icn"></i>
		<?php } ?>
		</div>
		<?php for($p=0;$p<(5-($reviews[$i]['rate']));$p++){?>
		<img src="images/no_star.png" alt="no_star" title="no_star" />
		<?php } ?>
		</div>
		<div class="rat_title reptitle">
		<h2><?php echo stripslashes($reviews[$i]['reviewtitle']);?></h2>
		</div>
		</div>
		<p><span itemprop ="reviewbody"><?php echo stripslashes($reviews[$i]['comment']);?></span></p>
		<div class="cmnt_wrp wrps"> <a href="<?php echo $reviews[$i]['seoslug'];?>" title="Add comment">  +  Add comment </a> </div>
		</div>
		<div itemscope itemtype = "http://schema.org/Rating" itemprop = "reviewRating">

		<meta itemprop = "ratingValue" content="<?php echo $reviews[$i]['rate']; ?>">
		<meta itemprop = "bestRating"  content="<?php echo  '5'; ?>">
		<meta itemprop = "worstRating" content="<?php echo '0'; ?>">	
		</div>
		</div>

		<?php } 
		?>
		<p align="right" class="cmnt_wrp wrps"><a href="<?php echo site_url('company/reviews/'.$company[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="View All">View All</a>
		</p>

		<?php
		}?>
		<?php  if( count($reviews)==0 ) 
		{ ?>
		<div class="form-message warning">
		<p>No Reviews.</p>
		</div>
		<?php } ?>

</p>
			
			
		</div>
		<div>
			<p>
			
			<?php if( count($complaints) > 0 ) { ?>
<?php if(count($complaints)>5)
{

$newcomplaints = 5;
}
else
{
$newcomplaints = count($complaints);
}?>
<?php for($i=0; $i<($newcomplaints); $i++) { ?>
<?php 
$company=$this->complaints->get_company_byid($complaints[$i]['companyid']);
$usersimg = $this->users->get_user_bysingleid($complaints[$i]['userid']);
?>
<div class="review_block <?php if($i%2==0){echo "fadeout";}?>">
<div class="review_lft">
<div class="user_img">
<?php if($usersimg['avatarthum']==null) {?>
<img src="images/default_user.png" alt="User image" title="User image">
<?php } else {?>
<img src="uploads/user/thumb/<?php echo $usersimg['avatarthum'];?>" alt="User image" title="User image">	 
<?php } ?>
</div>
</div>


<div class="review_rgt reviewstab">

<div class="user_name">
<?php $user=$this->users->get_user_byid($complaints[$i]['userid']);?>
<?php 
if(count($user)>0) { 
?>
<a href="<?php echo site_url('complaint/viewuser/'.$complaints[$i]['companyid'].'/'.$complaints[$i]['userid']); ?>" title="view profile"><?php echo $user[0]['username'];?></a>
<?php } else { ?>
<a><?php echo "";?></a>
<?php	}?>
<span class="datereview"><?php echo date('m/d/Y',strtotime($complaints[$i]['complaindate']));?></span>
</div>


<div class="review_ratng_wrp">
<div class="rat_title reptitle">
<h2>Reported Damage: $<?php echo $complaints[$i]['damagesinamt'];?></h2>
</div>
<p> <a href="<?php echo site_url($complaints[$i]['seoslug']); ?>" title="view complaint detail"><?php echo strtolower(substr(stripslashes($complaints[$i]['detail']),0,212)."..."); ?></a> </p>

</div>
</div>


</div>
<?php } ?><div class="cmnt_wrp wrps "><a class="valigns" href="<?php echo site_url('company/complaints/'.$company[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="View All">View All</a></div> <?php }else{?>
<div class="review_block noblock">
<p>No Complaints.</p>
</div>
<?php } ?>

			
			</p>
		</div>
		<div>
			<p>
			
			<?php if( count($coupons) > 0 ) { ?>
<?php if(count($coupons)>5)
{
$d = 5;
}
else
{
$d = count($coupons);
}?>
<?php for($i=0; $i<$d; $i++) { ?>
<div class="review_block <?php if($i%2==0){echo "fadeout";}?>">
<div class="review_rgt reviewstab">
<div class="review_ratng_wrp">
<div class="rat_title reptitle">
<h2>
<a href="<?php echo site_url($coupons[$i]['seoslug']);?>" title="view coupon detail"><?php echo stripslashes($coupons[$i]['title']); ?></a>
<span><a href="<?php echo $coupons[$i]['url'];?>" title="<?php echo $coupons[$i]['url'];?>" target="_blank" rel="nofollow">Promocode: <span><?php echo $coupons[$i]['promocode'];?></span> </a></span></div>
</h2>
</div>
<p><?php echo date("m/d/Y",strtotime($coupons[$i]['enddate']));?></p>
</div>
</div>
<?php } ?>
<p align="right" class="cmnt_wrp wrps">
<a href="<?php echo site_url('company/coupons/'.$company[0]['companyseokeyword'].'/reviews/coupons/complaints');?>" title="View All">View All</a>
</p>
<?php } 
else { ?>
<div class="review_block noblock">
<p>No Coupons.</p>
</div>
<?php } ?>
			</p>
		</div>
		
<?php if(count($elitemem_status)==1){?>		
		
		<div>
			
			
			<p>
		<?php if(count($companypressreleases)>0)
	{?>
	<?php for($pr=0;$pr<count($companypressreleases);$pr++){?>
	<div class="review_block <?php if($pr%2==0){echo "fadeout";}?>">
	<div class="review_rgt reviewstab">
	<div class="review_ratng_wrp">
	<div class="rat_title reptitle">
	<h2 class="flats"><a href="<?php echo site_url('pressrelease/browse/'.$companypressreleases[$pr]['seokeyword']); ?>" title="view <?php echo stripslashes(ucfirst($companypressreleases[$pr]['title'])); ?>'s detail"><?php echo $companypressreleases[$pr]['title'];?></a></h2>
	<span class="datereview pads"><?php echo date('m/d/Y',strtotime($companypressreleases[$pr]['insertdate']));?></span></div>
	</div>
	<p> <a href="<?php echo site_url('pressrelease/browse/'.$companypressreleases[$pr]['seokeyword']); ?>" title="view <?php echo stripslashes(ucfirst($companypressreleases[$pr]['title'])); ?>'s detail"> <?php echo $companypressreleases[$pr]['sortdesc'];?> </a> </p>
	</div>
	</div>
	<?php } ?>
	<p align="right" class="cmnt_wrp wrps">
	<a href="<?php echo site_url('company/pressreleases/'.$company[0]['companyseokeyword']);?>" title="View All">View All</a></p>
	<?php }else{ ?>
	<div class="review_block noblock">
	<p> No Pressreleases. </p>
	</div>
	<?php } ?>
		
		</p></div>
		
		
		<div>
		<p>
			<div class="review_block noblock">
              <link rel="stylesheet" href="<?php echo base_url();?>js/orbit/orbit-1.2.3.csss" type="text/css">
              <script type="text/javascript" src="<?php echo base_url();?>js/orbit/jquery.orbit-1.2.3.min.jss"></script>
              <link rel="stylesheet" href="<?php echo base_url();?>js/flexslider/flexslider.css" type="text/css">
              <script type="text/javascript" src="<?php echo base_url();?>js/flexslider/jquery.flexslider.js"></script>
              <script type="text/javascript">
              
              // Can also be used with $(document).ready()
$(window).load(function() {
  $('#profile-flexslider').flexslider({
    animation: "slide",
    
    after: function(slider){
    currHeight = $('.slides > li').eq(slider.currentSlide).outerHeight(true);
    $('.flexslider').height(currHeight);
  }
    
  });
});
              </script>
               <div class="flexslider" id="profile-flexslider">
          <ul class="slides">
            <li>
  	    	    <img src="<?php echo $site;?>uploads/images/9aa576af0c5b529d5164f35f314740de.png" />
  	    		</li>
  	    		<li>
  	    	    <img src="<?php echo $site;?>uploads/images/82ec90334f6d31d2c76ee377e98569f0.png" />
  	    		</li>
  	    		<li>
  	    	    <img src="<?php echo $site;?>uploads/images/e4492d6cf2c1db62a3a3a6709a827298.png" />
  	    		</li>
  	    		<li>
  	    	    <img src="<?php echo $site;?>uploads/images/aa2dd981eb771c862d295a39cb4845d8.jpeg" />
  	    		</li>
          </ul>
        </div>
              
              <?php if( count($gallerys) > 0 ) { ?>
			  <?php if(count($gallerys)>5)
			  {
				$d = 5;
			  }
			  else
			  {
			  	$d = count($gallerys);
			  }?>
              <?php $site = site_url();
			  
			 
			  		?>
              <script type="text/javascript">
				$(window).load(function() {
				$('.gallery_featured').orbit();
					});
				</script>
              <?php for($i=0; $i<$d; $i++) { ?>
              <?php $photos = $this->complaints->get_photos_bygalleryid($gallerys[$i]['id']);?>
              <div class = "gallery_title"><?php echo $gallerys[$i]['title'];?></div>
              <?php if(count($photos)>0){ ?>
              <div class="container1">
                <div id="featured" class = "gallery_featured">
                  <?php for($f=0; $f<count($photos); $f++) { ?>
					<img src="<?php echo $site;?>uploads/gallery/main/<?php echo stripslashes($photos[$f]['photo']); ?>" title="<?php echo stripslashes($gallerys[$i]['title']); ?>" alt="<?php echo stripslashes($photos[$f]['photo']); ?>" width="520;" height="392"/>
                  <?php } ?>
                </div>
              </div>
              <div style="padding-bottom:15; margin-top:15px;"></div>
              <?php } else { ?>
              <div class="form-message warning">
                <p>No photos in this gallery.</p>
              </div>
              <?php } 
				}
				if(count($gallerys)>5)
				{	
					
					if(count($company) > 0){
						$company_name = preg_replace("/\.$/","",$company[0]['company']);
						$company_name = trim(preg_replace('/-+/', '-',preg_replace('/[^a-zA-Z0-9-.]/', '-', trim(strtolower($company_name)))), '-');
					}else{
						$company_name = "anonymous";
					} 
					$company_photo_url = "company/".$company_name."/view-all-photos/".$company[0]['id'];
							
				?>
					<p align="right" class="cmnt_wrp">
					<a href="<?php echo site_url($company_photo_url);?>" title="View All">View All</a></p>

              <?php } } else { ?>
              <div class="form-message warning">
                <p>No Photos.</p>
              </div>
              <?php } ?>
            </div>
		</p>
		
		</div>
		<div>
			<p>
			
				 <?php 
				if( count($videos) > 0 ) { 	
			    
			 
			  		
			?>
			 <?php if(count($videos)>5)
			  {
				$d = 5;
			  }
			  else
			  {
			  	$d = count($videos);
			  }?>
            <?php for($i=0; $i<$d; $i++) { ?>
            <div class="noblock review_block">
              <div class="company_content_title contenttag"><?php echo $videos[$i]['title'];?></div>
              <br />
              <div>
				<?php
					$ytarray=explode("/", $videos[$i]['videourl']);
					$ytendstring=end($ytarray);
					$ytendarray=explode("?v=", $ytendstring);
					$ytendstring=end($ytendarray);
					$ytendarray=explode("&", $ytendstring);
					$ytcode=$ytendarray[0];
					echo "<iframe class=\"videotab$i\" width=\"520\" height=\"280\" src=\"http://www.youtube.com/embed/$ytcode?enablejsapi=1&version=3&playerapiid=ytplayer\" frameborder=\"1\" allowscriptaccess=\"always\" allowfullscreen></iframe>";
				?>  
              </div>
              <div style="display:none;"> <a href="<?php echo $videos[$i]['videourl'];?>" title="<?php echo $videos[$i]['videourl'];?>"><?php echo $videos[$i]['videourl'];?></a> </div>
            </div>
            <?php 
			}
			 
			?>
				
            <?php  }
            if(count($videos)>5)
			  {
				  
				 
				if(count($company) > 0){
					$company_name = preg_replace("/\.$/","",$company[0]['company']);
					$company_name = trim(preg_replace('/-+/', '-',preg_replace('/[^a-zA-Z0-9-.]/', '-', trim(strtolower($company_name)))), '-');
				}else{
					$company_name = "anonymous";
				} 
				$company_video_url = "company/".$company_name."/view-all-videos/".$company[0]['id'];
				  
            ?>
            <p align="right" class="cmnt_wrp">
				<a href="<?php echo site_url($company_video_url);?>" title="View All">View All</a></p>
				<?php
			}
			?>
			</p>
		
		</div>
<?php } ?>		
	</div>
</div>

	
 <!--Profile Tab--->	
	     
        </div>
      </div>
       </div>
	<div class="load_rvw"> 
		<a href="<?php echo site_url();?>" title="YOUGOTRATED"><img class="logo_btm" src="images/ygr_logos.png" alt="YOUGOTRATED" title="YOUGOTRATED"> </a> 
	</div>
    </div>
    
	<ol itemscope itemtype="http://schema.org/BreadcrumbList" style="display: none;">
		<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
			<a itemprop="item" href="<?php echo site_url();?>"><span itemprop="name">Home</span></a>
			<meta itemprop="position" content="1" />
		</li>
		<?php $ex = explode(',',$company[0]['categoryid']); $cat_breadcrumb = ''; ?>
		<?php 
		if(!empty($ex)){
			for($a=0;$a<count($ex);$a++)
			{

				$cat = $this->complaints->get_category_byid($ex[$a]);
				if(count($cat)>0) 
				{
					$cat_breadcrumb .= $cat[0]['category'].' | ';
				  
				}
			}
			
		}
		?>
		<?php if(!empty($cat_breadcrumb)) { ?>
		<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
			<a itemprop="item" href="<?php echo site_url();?>"><span itemprop="name"><?php echo substr($cat_breadcrumb,0,-3); ?></span></a>
			<meta itemprop="position" content="2" />
		</li>
		<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
			<a itemprop="item" href="<?php echo site_url($company[0]['seoslug']);?>"><span itemprop="name"><?php echo $company[0]['company']; ?></span></a>
			<meta itemprop="position" content="3" />
		</li>
		<?php } else { ?>
		<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
			<a itemprop="item" href="<?php echo site_url($company[0]['seoslug']);?>"><span itemprop="name"><?php echo $company[0]['company']; ?></span></a>
			<meta itemprop="position" content="2" />
		</li>
		<?php } ?>
		
	</ol>
  </section>
</section>

<?php echo $footer;?>

<link rel="stylesheet" href="<?php echo base_url();?>css/fancybox.css" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>businessadmin/css/tooltipster.css" />
<script type="text/javascript" src="<?php echo base_url();?>js/fancybox.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>businessadmin/js/jquery.tooltipster.min.js"></script>
<script type="text/javascript" language="javascript">	
	
	$(document).ready(function() 
	{
		$('.readmore').fancybox();
	});

</script>
