<?php echo $header;?>
<div class="slider">
    <div class="flexslider carousel">
        <ul class="slides">
		<?php 
			$i=0;
			foreach($homesliding as $homeslide)
			{?>
				<li>
					<img src="uploads/slider/<?php echo $homeslide->image;?>" alt="How it works" title="How it works"  usemap="<?php if($i==0){echo '#planetmap';}?>">
					<?php 
					if($i==0)
					{	?>
						<map name="planetmap">
							<area shape="rect" coords="170,380,435,340" href="<?php echo base_url();?>go/register" >
						</map>
					<?php
					}
					?>
				</li>			
		<?php
			$i++;	
			}
		?>
		</ul>
	</div>
</div>

  
<section class="container">
  <section class="main_contentarea">    
    <div class="container">      
	<div class="hm_rght_panel">
	 <div class="hm_live_menus"></div>
        <div class="hm_live_menu">
			<ul>
				<li><a href="<?php echo base_url();?>" title="RECENT ACTIVITY" style="color:black;">RECENT ACTIVITY</a></li>
				<li><a href="<?php echo site_url('complaint');?>" title="Trending Complaints">TRENDING COMPLAINTS<span>:<span></a></li>
				<li><a href="<?php echo site_url('complaint/advfilter');?>" title="Advance Filter">ADVANCED FILTER<span>:<span></a></li>
			</ul>
        </div>
        <div class="hm_rvw_wrp">
          <?php if(count($complaints)>0) {?>
          <?php for($i=0; $i<count($complaints); $i++) {     ?>           
          <?php $user=$this->users->get_user_byid($complaints[$i]['reviewby']) ;?>
          <div class="review_block <?php if($i%2==1)   {echo "fadeout";   }?>">
            <div class="review_lft">
              <div class="user_img"><img title="User image" alt="User image" src="images/default_user.png"></div>            
            </div>
            <style>
            
            </style>
        <div class="review_rgt  ">
              <div class="review_ratng_wrp">              
                <div class="rat_title">  
			  <?php if($complaints[$i]['reviewby']==$user[0]['id']){ ?>
				  	<label><a href="<?php echo site_url('complaint/viewuser/'.$complaints[$i]['id'].'/'.$complaints[$i]['reviewby']); ?>" class="homename" title="view profile"><?php echo $user[0]['username'];?></a></label>
				  <?php } else{ ?>
					<label><a><?php echo $complaints[$i]['reviewby'];?></a></label>
				  <?php } ?>
				    
                   <span class="datehome"><?php echo date('m/d/Y',strtotime($complaints[$i]['reviewdate']));?></span>
                   <?php $companyname = $this->users->get_company_bysingleid($complaints[$i]['companyid']); ?>
                  <h2><a href="<?php echo site_url('company/'.$companyname['companyseokeyword'].'/reviews/coupons/complaints');?>" class="reviewname" title="view Review Detail"><?php echo ucfirst(stripslashes($complaints[$i]['company'])); ?></a>
                   
                   <?php //get avg star by cmpyid
						$avgstar = $this->common->get_avg_ratings_bycmid($complaints[$i]['companyid']);
						$avgstar = round($avgstar);
					?>
					  <div class="vry_rating reviewrate">
						<?php for($r=0;$r<($avgstar);$r++){?>
						<i class="vry_rat_icn"></i>
						<?php } ?>
						<?php for($p=0;$p<(5-($avgstar));$p++){?>
						<img src="images/no_star.png" alt="no_star" title="no_star" />
						<?php } ?>
					  </div>
					  </h2>
                 </div>
              </div>
              <p class="reviewspace"><a href="<?php echo site_url('review/browse/'.$complaints[$i]['seokeyword']); ?>" title="view Review Detail"><?php echo strtolower(substr(stripslashes($complaints[$i]['comment']),0,212)."..."); ?></a></p>
            </div>
          </div>
          
          <?php } ?>
          <?php } ?>
        </div>
      </div>

<div class="hm_lft_panel">
	<div class='browsecategories'></div>	
		<div class='browselink'>
		<?php 
			if(count($home_categorys)>0){
				$mainuploadpath = $this->config->item('buscat_main_upload_path');
				$siteurlimage = $this->common->get_setting_value('2');
				$thumbuploadpath = $this->config->item('company_thumb_upload_path');
				for($hc=0;$hc<count($home_categorys);$hc++){	  
					//lower case everything
					$categoryname = strtolower($home_categorys[$hc]['category']);
					//make alphaunermic
					$categoryname = preg_replace("/[^a-z0-9\s-]/", "", $categoryname);
					//Clean multiple dashes or whitespaces
					$categoryname = preg_replace("/[\s-]+/", " ", $categoryname);
					//Convert whitespaces to dash
					$categoryname = preg_replace("/[\s]/", "-", $categoryname);
					//image path
					$imagepath = ( $home_categorys[$hc]['image'] ) ? $siteurlimage.$mainuploadpath.$home_categorys[$hc]['image'] : $siteurlimage.$thumbuploadpath."no_image.png";
					//hover image path
					$hoverpath = ( $home_categorys[$hc]['hover'] ) ? $siteurlimage.$mainuploadpath.$home_categorys[$hc]['hover'] : $siteurlimage.$thumbuploadpath."no_image.png"; ?>
					<div id='browsecategory' class="browses">
						<img id="browseimg" src="<?php echo $imagepath; ?>" alt="<?php echo $home_categorys[$hc]['category'];?>" title="<?php echo $home_categorys[$hc]['category'];?>">
					   <img class="hoverimg"  src="<?php echo $hoverpath; ?>" alt="<?php echo $home_categorys[$hc]['category'];?>" title="<?php echo $home_categorys[$hc]['category'];?>">
						<a class='hovertxt' href="businessdirectory/category/<?php echo $categoryname;?>/<?php echo $home_categorys[$hc]['id'];?>" title="find all companies for <?php echo $home_categorys[$hc]['category'];?>"> 
							<span><?php echo $home_categorys[$hc]['category'];?></span>
						</a> 
					</div><?php 
				}
			} 
		?>
		</div>
	</div>
</div>
</section>
</section>
<?php echo $footer;?>

<script type="text/javascript">
$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "slide"
  });
});
$(document).ready(function(){
	$('.browses').hover(function(){
		$(this) .find('.hoverimg').css('display','block');
		$(this) .find('#browseimg').css('display','none');
		$(this) .find('.hovertxt').css('color','#AE9D05');
	},function(){
		$(this) .find('.hoverimg').css('display','none');
		$(this) .find('#browseimg').css('display','block');
		$(this) .find('.hovertxt').css('color','black');
	});
});
</script>	
