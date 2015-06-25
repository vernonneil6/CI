<?php echo $header;?>

<div class="slider" style="<?php if(isset($header['topads'])){ echo 'padding-top:0';} else { echo 'padding-top:8.5em'; } ?>">
    <div class="flexslider carousel">
        <ul class="slides">
		<?php 
			$i=0;
			//echo"<pre>"; print_r($homesliding);die;
			foreach($homesliding as $homeslide)
			{?>
				<li>
					<img src="uploads/slider/<?php echo $homeslide->image;?>" alt="How it works" title="How it works"  usemap="<?php if($i==0){echo '#planetmap';}?>">
					<div class="text-content"> <span><?php echo strip_tags($homeslide->title);?></span></div>
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
		<?php if($this->uri->segment(1)!='businessdirectory' && $this->uri->segment(1)!='solution' && $this->uri->segment(1)!='login' && $this->uri->segment(2)!='register') { ?> 
		<div class="container">
			<div class='headersearch'>
			<?php echo form_open('businessdirectory/search',array('class'=>'formBox','name'=>'frmsearch','id'=>'frmsearch')); ?>
			<?php if( $this->uri->segment(1)=='complaint' && $this->uri->segment(2)=='search') { $serkeyword=base64_decode($this->uri->segment(3));} else { $serkeyword =''; } ?>
				<input type='text'  class='headersearchbar' placeholder="Search for a Business..." name="searchcomp"  id="search" value="<?php echo $serkeyword;?>" required maxlength="30">
				<button type="submit" class="headersearchbtn fa fa-search" value="" name="btnsearch"></button>
				<div id="loading"></div>
			<?php echo form_close();?> 
			</div>
		</div>		
   <?php }  ?>	
	</div>
 </div>

  
<section class="container" >
  <section class="main_contentarea">    
    <div class="container table_hme" >      
	
	<div class="hm_rght_panel">
	<div class="hm_live_menus"><span>CURRENT REVIEWS</span></div>
	 
     
        <div class="hm_rvw_wrp"><table>
          <?php $j=0; $k=1;
			echo"<tr>";
			if(count($complaints)>0) { 
				for($i=0; $i<count($complaints); $i++) {   
			$user=$this->users->get_user_bysingleid($complaints[$i]['reviewby']) ;
			$companyname = $this->users->get_company_bysingleid($complaints[$i]['companyid']); 
			$avgstar = $this->common->get_avg_ratings_bycmid($complaints[$i]['companyid']);
			$avgstar = round($avgstar);						
          ?>
  		<td>			  
          <div class="review_blocks <?php if($j%4==2 || $j%4==3 ) {echo "fadeout ";} $j++; if($i%2==1) { echo "feed-right";}else { echo " feed-left";} ?>">
            <div class="review_left">
                                     
				  <?php if($user['id']==$complaints[$i]['reviewby']) { ?>
                                       <?php if($user['avatarthum']!="") { ?>					  
              <img title="User image" alt="User image" src="uploads/user/thumb/<?php echo $user['avatarthum']; ?>" style="width:50px;height:50px">
      <?php } else { ?>
              <img title="User image" alt="User image" src="images/default_user.png" style="width:50px;height:50px">
      <?php } ?>
				  <?php } else { ?>
					  <img title="User image" alt="User image" src="images/default_user.png" style="width:50px;height:50px">
				  <?php } ?>                      
            </div>
       
			<div class="review_right">
                         
                <div class="rat_title">  

					<div class="reptitle">
						<h2><a href="<?php echo site_url('company/'.$companyname['companyseokeyword'].'/reviews/coupons/complaints');?>" class="reviewname home_mar_title" title="view Review Detail"><?php echo ucfirst(stripslashes($complaints[$i]['company'])); ?></a></h2>
						<span class="datehome"><?php echo date('m/d/Y',strtotime($complaints[$i]['reviewdate']));?></span>
						<div class="clear"></div>
					</div>      
			 
				    <div class="home_mar_line">
						<?php for($r=0;$r<($complaints[$i]['rate']);$r++){  ?>
						<i class="vry_rat_icn"></i>
						<?php } ?>
						<?php for($p=0;$p<(5-($complaints[$i]['rate']));$p++){?>
						<img src="images/no_star.png" alt="no_star" title="no_star" />
						<?php } ?>
						<div class="clear"></div>
				    </div>
					  
					<div><a class="home_cap"><?php echo $complaints[$i]['reviewtitle'];?></a></div>
					<?php if($complaints[$i]['reviewby']==$user['id']){ ?>
				  	<div><a href="<?php echo site_url('complaint/viewuser/'.$complaints[$i]['id'].'/'.$complaints[$i]['reviewby']); ?>" class="home_cap1" title="view profile"><?php echo ucfirst($user['username']);?></a></div>
				    <?php } else{ ?>
					<div><a class="home_cap1"><?php echo ucfirst($complaints[$i]['reviewby']);?></a></div>
				    <?php } ?>  
					<div class="reviewspace_new">
						<a href="<?php echo site_url('review/browse/'.$complaints[$i]['seokeyword']); ?>" title="view Review Detail">
						<?php 
								if(strlen($complaints[$i]['comment']) > 137){ 
									echo ucfirst(substr(stripslashes($complaints[$i]['comment']),0,140)."..."); 
									echo '<div class="view-all"> <span><a href="'.site_url('review/browse/'.$complaints[$i]['seokeyword']).'">Read More</a></span></div>';
								}else{ 
									echo ucfirst(substr(stripslashes($complaints[$i]['comment']),0,140)); 
									echo '<div class="view-all"> <span><a href="'.site_url('review/browse/'.$complaints[$i]['seokeyword']).'">Read More</a></span></div>';
								} 
						?>
						 
						</a>
					</div>
                 </div>              
              
				</div>
			</div>
			</td>
			<?php 
				 if($k%2==0 && $k!=1) {  echo"</tr>"; if($k < count($complaints)){ echo "<tr>"; } } 
	             $k++; 
	           }  
			} echo "</tr>"; ?>
				
	</table>
	<div class="view-all-reviews"><a href="/review">View All Reviews</a></div>
        </div>
       
      </div>
<!--
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
</div>-->
</section>
</section>
<script>$(".hm_rght_panel").height($(".hm_lft_panel").height());</script>
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
</script>	
