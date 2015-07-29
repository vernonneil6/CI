<?php echo $header;?>

<div class="slider <?php if(isset($header['topads'])){ echo 'addbanner';} else { echo 'no_addbanner'; } ?>">
    <div class="flexslider carousel">
        <ul class="slides">
		<?php 
			$i=0;
			//echo"<pre>"; print_r($homesliding);die;
			foreach($homesliding as $homeslide)
			{?>
				<li>
					<img src="uploads/slider/<?php echo $homeslide->image;?>" alt="YGR Banner" title="YGR Banner"  usemap="<?php if($i==0){echo '#planetmap';}?>">
					<div class="text-content" style="bottom:0;"> <span><?php echo $homeslide->title;?></span></div>
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
			
			<div class="headersearch headertoptext">
			<div class="bannertext" style="width:60%;margin:0 auto;">
				<?php 
				$l=0;
				$homebannertext;
			//echo"<pre>"; print_r($homebannertext);die;
			foreach($homebannertext as $bannertext)
			{
				   $logozone=$bannertext->position; ?>
				   
				<?php if($logozone=='top1' && $l==0){
				?><div class="banner-top1">	<?php echo $bannertext->text;?></div>
				<?php $l++;}?>
				
			<?php } 
			$j=0;
			foreach($homebannertext as $bannertext)
			{
				   $logozone=$bannertext->position; ?>
				  
				<?php if($logozone=='top2' && $j==0){
				?>	 <div class="banner-top2" ><?php echo $bannertext->text;?></div>
				<?php $j++; }?>
				
			<?php } 
			$k=0;
			foreach($homebannertext as $bannertext)
			{
				   $logozone=$bannertext->position; ?>
				 
				<?php if($logozone=='top3' && $k==0){
				?>	  <div class="banner-top3" ><?php echo $bannertext->text;?></div>
				<?php $k++; }?>
				
			<?php } 
				
			/*foreach($homelogosliding as $homelogoslide)
			{
				   $logozone=$homelogoslide->zone;
				if($logozone=='top'){
				?>	<img src="uploads/logoslider/<?php echo $homelogoslide->image;?>" alt="YGR-verified-logo" width="100%" />
				<?php break;}
				$m++;
			}*/
				
				?>
				</div>
			
			</div>
			<div class='headersearch' >
				
			<?php echo form_open('businessdirectory/search',array('class'=>'formBox','name'=>'frmsearch','id'=>'frmsearch')); ?>
			<?php if( $this->uri->segment(1)=='complaint' && $this->uri->segment(2)=='search') { $serkeyword=base64_decode($this->uri->segment(3));} else { $serkeyword =''; } ?>
				<div class="qwe" style="display:none">
					<input type='text' autocomplete="off"  class='headersearchbar' placeholder="Search for a Business..." name="searchcomp"  id="search" value="<?php echo $serkeyword;?>" required maxlength="30">
					<button type="submit" class="headersearchbtn fa fa-search" value="" name="btnsearch"></button>
					 <div id="display"></div>
				</div>
				<div id="loading"></div>
			<?php echo form_close();?>
			
				<form method="GET" action="searchresult" id="search_form" class="formBox">
					<input type="text" class="headersearchbar" name="query" id="suggest"
						autocomplete="off" value="<?php isset($_GET['query'])?htmlentities($_GET['query']):''?>">

					<input type="hidden" class="input-large" name="city" id="city"  value="<?=isset($_GET['city'])?htmlentities($_GET['city']):''?>"> 
					<input type="hidden" class="input-large" name="state" id="state"  value="<?=isset($_GET['state'])?htmlentities($_GET['state']):''?>"> 
					<button type="submit" id="send" class="headersearchbtn fa fa-search" name="send" value="Submit">
				</form>
			</div>
			
			
			<div class="headersearch headerbottomtext">
				<div class="bannertext" style="width:60%;margin:0 auto;">
				<?php 
						$l=0;
						$homebannertext;
			foreach($homebannertext as $bannertext)
			{
				   $logozone=$bannertext->position; ?>
				 
				<?php if($logozone=='bottom1' && $l==0){
				?>  <div class="banner-bottom1">	<?php echo $bannertext->text;?></div>
				<?php $l++;}?>
				
			<?php } 
			$m=0;
			foreach($homebannertext as $bannertext)
			{
				   $logozone=$bannertext->position; ?>
				  
				<?php if($logozone=='bottom2' && $m==0){
				?>	 <div class="banner-bottom2" ><?php echo $bannertext->text;?></div>
				<?php $m++; }?>
				
			<?php }
			$n=0; 
			foreach($homebannertext as $bannertext)
			{
				   $logozone=$bannertext->position; ?>
				   
				<?php if($logozone=='bottom3' && $n==0){
				?><div class="banner-bottom3" >	<?php echo $bannertext->text;?></div>
				<?php $n++; }?>
				
			<?php } 
					?>
				</div>
				</div>
				
			
			
		</div>		
   <?php }  ?>	
   
			
	</div>
 </div>


  
<section class="container" >
  <section class="main_contentarea" style="padding-top:0;">    
    <div class="container table_hme" >      
	
	<div class="hm_rght_panel">
		<div class="hm_live_menus"><span>CURRENT REVIEWS</span></div>
	 
	 <?php
        $table1 = "<div class='review-slider'><ul>";
        $table2 = "<div class='review-slider-right'><ul>";
        for($i=0;$i<count($complaints);$i++){
            $user=$this->users->get_user_bysingleid($complaints[$i]['reviewby']) ;
            $companyname = $this->users->get_company_bysingleid($complaints[$i]['companyid']); 
            $comany_seoslug = ($companyname) ? $companyname['seoslug'] : '';
            $avgstar = $this->common->get_avg_ratings_bycmid($complaints[$i]['companyid']);
            $avgstar = round($avgstar);
            //$img_src = 'images/default_user.png';
            if($user['id']==$complaints[$i]['reviewby']){
                $img_src = 'uploads/user/thumb/'.$user['avatarthum'];
            }
            if(!empty($companyname['companyseokeyword'])){
				$siteurl = site_url($comany_seoslug);
			}
            $review_detail = ucfirst(stripslashes($complaints[$i]['company'])); 
            $review_date = date('m/d/Y',strtotime($complaints[$i]['reviewdate'])); 
			$star = '<div class ="count-'.$complaints[$i]['rate'].'">';

			for($r=0;$r<($complaints[$i]['rate']);$r++){ 
							   //$s =$r+1;
			   $star = $star.'<i class="vry_rat_icn"></i>';
			}
			$star= $star.'</div>';

			for($p=0;$p<(5-($complaints[$i]['rate']));$p++){
			   $star = $star.'<img src="images/no_star.png" alt="no_star" title="no_star" class="no-star" />';                        
			}
            $review_title = ucfirst(substr(stripslashes( $complaints[$i]['reviewtitle']),0,50)."...");
           
            $review_site_url = 'complaint/viewuser/'.$complaints[$i]['id'].'/'.$complaints[$i]['reviewby'];
            if(strlen($complaints[$i]['comment']) > 137){ 
                $complaints_content = ucfirst(substr(stripslashes($complaints[$i]['comment']),0,100)."...");                
            }else{
                $complaints_content = ucfirst(substr(stripslashes($complaints[$i]['comment']),0,100));                
            }
            $content =             
            '<li>
            <div class="review_blocks  feed-left">
         
            <div class="home_right">                         
                 
               <div class="rat_title">
					<div class="user-img"> <img style="width:65px;height:65px" src="'.$img_src.'" alt="'.$user['username'].'-YGR-profile-image" title="'.$user['username'].'-YGR-profile-image"> </div>
                    <div class="reptitle">
                        <h2 style="padding: 0px; line-height: unset;"><a title="view Review Detail" class="reviewname home_mar_title" href="'.$siteurl.'">'.$review_detail.'</a></h2>
                         <div class="clear"></div>
                    </div>             
                    <div class="home_mar_line" style="margin-top: 0px; margin-bottom: 0px;">
                        '.$star.'
                        <div class="clear"></div>
                    </div>                      
                    <div class="review-head"><a class="home_cap">'.$review_title.'</a></div>
                    <div class="user-name"><a title="view profile" class="home_cap1" href="'.$review_site_url.'">'.ucfirst($user['username']).'</a></div>                     
                    <div class="reviewspace_new" style="margin-top: 0px; margin-bottom: 0px;">
                        <a title="view Review Detail" href="'.site_url($complaints[$i]['seoslug']).'">
                        '.$complaints_content.'</a>                                                 
                    </div>
                    <div class="view-all"><a title="view Review Detail" href="'.site_url($complaints[$i]['seoslug']).'"> <span></span></a><a href="'.site_url($complaints[$i]['seoslug']).'">Read More</a></div>
                </div>             
                </div>
            </div>            
            </li>';
            if($i % 2 == 0){
                $table1 =$table1.$content;
            }else{
                $table2 =$table2.$content;
            }
        }
        $table1 =$table1. "</ul></div>";
        $table2 =$table2. "</ul></div>";
        
?>
 
     
        <div class="hm_rvw_wrp">
		
		<?php echo $table1." ".$table2;?>
		
	
		
		
		
		
			<!--<div class="view-all-reviews"><a href="/review">View All Reviews</a></div>-->
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


$(function(){
	 $('.review-slider').easyTicker({
		direction: 'Top',
		visible: 10,
		interval: 14000
		
	});
	if($(window).width() >= 1049)
	{
		$('.review-slider-right').easyTicker({
			direction: 'Top',
			visible: 10,
			interval: 18000
			
		});
	}
});
</script>	
