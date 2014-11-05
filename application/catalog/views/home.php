<?php echo $header;?>
<div class="slider">
        <div class="flexslider carousel">
          <ul class="slides">


<?php 
	$i=0;
	foreach($homesliding as $homeslide)
	{
?>
	    
	    		<li>
				<img src="uploads/slider/<?php echo $homeslide->image;?>" alt="How it works" title="How it works"  usemap="<?php if($i==0){echo '#planetmap';}?>">
				<?php 
				if($i==0)
				{
				?>
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
            <li><a href="<?php echo site_url('complaint/weektrending');?>" title="Trending Complaints">TRENDING COMPLAINTS<span>:<span></a></li>
            <li><a href="<?php echo site_url('complaint/advfilter');?>" title="Advance Filter">ADVANCED FILTER<span>:<span></a></li>
          </ul>
        </div>
        <div class="hm_rvw_wrp">
          <?php if(count($complaints)>0) {?>
          <?php for($i=0; $i<count($complaints); $i++) {            
           ?>
           
           <?php $user=$this->users->get_user_byid($complaints[$i]['userid']) ;?>
          <div class="review_block <?php if($i%2==1)   {echo "fadeout";   }?>">
            <div class="review_lft">
              <div class="user_img"><img title="User image" alt="User image" src="images/default_user.png"></div>
             <!-- <div class="user_name">
              
              
              <?php if($complaints[$i]['userid']!=0){ ?>
              <?php if(count($user)>0){ ?>
              <a href="<?php echo site_url('complaint/viewuser/'.$complaints[$i]['companyid'].'/'.$complaints[$i]['userid']); ?>" title="view profile"><?php echo $user[0]['username'];?>
               <span><?php echo $user[0]['city'];?>,<?php echo $user[0]['state'];?></span> 
              </a>
              <?php } ?>
              <?php } else{?>
              <a href="Anonymous">Anonymous</a>
              <?php } ?>
              </div>-->
              
            </div>
            
            <div class="review_rgt  ">
              <div class="review_ratng_wrp">
              
                <div class="rat_title">
              
              <?php if($complaints[$i]['userid']!=0){ ?>
              <?php if(count($user)>0){ ?>
              <label><a href="<?php echo site_url('complaint/viewuser/'.$complaints[$i]['companyid'].'/'.$complaints[$i]['userid']); ?>" class="homename" title="view profile"><?php echo $user[0]['username'];?></a></label>
              <?php } ?>
              <?php } else{?>
              <label><a href="Anonymous">Anonymous</a></label>
              <?php } ?>
                   <span class="datehome"><?php echo date('m.d.Y',strtotime($complaints[$i]['complaindate']));?></span>
                  <h2><a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']);?>" title="view Complaint Detail"><?php echo ucfirst(stripslashes($complaints[$i]['company'])); ?></a></h2>
                 </div>
              </div>
              <p><a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint Detail"><?php echo strtolower(substr(stripslashes($complaints[$i]['detail']),0,212)."..."); ?></a></p>
              <div class="cmnt_wrp"> <a href="<?php echo site_url('remove/complaint/'.$complaints[$i]['id'].'/'.$complaints[$i]['companyid']); ?>" title="Remove this complaint"><i class="rmv_rw"></i> remove</a> </div>
            </div>
          </div>
          
          <?php } ?>
          <?php } ?>
        </div>
      </div>
<!--<div class="hm_lft_panel">
	<div class='browsecategories'></div>	
	<div class='browselink'>
	<div><img src="../images/img/browseicons/food&groument.jpg" class="foodandgourment"><a href='#'></span>FOOD & GOURMET</a></div>
	<div><img src="../images/img/browseicons/Health.jpg" class="foodandgourment"><a href='#'>HEALTH, FITNESS & BEAUTY</a></div>
	<div><img src="../images/img/browseicons/electronics.jpg" class="foodandgourment"><a href='#'>CONSUMER ELECTRONICS</a></div>
	<div><img src="../images/img/browseicons/computer.jpg" class="foodandgourment"><a href='#'>COMPUTER HARDWARE & SOFTWARE</a></div>
	<div><img src="../images/img/browseicons/music.jpg" class="foodandgourment"><a href='#'>MUSIC, INSRUMENTS & CDS</a></div>
	<div><img src="../images/img/browseicons/dvd&videos.jpg" class="foodandgourment"><a href='#'>DVDS & VIDEOS</a></div>
	<div><img src="../images/img/browseicons/book.jpg" class="foodandgourment"><a href='#'>BOOK & MAGAZINES</a></div>
	<div><img src="../images/img/browseicons/home.jpg" class="foodandgourment"><a href='#'>HOME & GARDEN</a></div>
	<div><img src="../images/img/browseicons/toys.jpg" class="foodandgourment"><a href='#'>TOYS, GAMES & HOBBIES</a></div>
	<div><img src="../images/img/browseicons/sports.jpg" class="foodandgourment"><a href='#'>SPORTS & OUTDOORS</a></div>
	<div><img src="../images/img/browseicons/apparael.jpg" class="foodandgourment"><a href='#'>APPAREL & JEWELRY</a></div>
	<div><img src="../images/img/browseicons/automotive.jpg" class="foodandgourment"><a href='#'>AUTOMOTIVE</a></div>
	<div><img src="../images/img/browseicons/pets.jpg" class="foodandgourment"><a href='#'>PETS</a></div>
	<div><img src="../images/img/browseicons/gifts.jpg" class="foodandgourment"><a href='#'>GIFTS & FLOWERS</a></div>
	<div><img src="../images/img/browseicons/furniture.jpg" class="foodandgourment"><a href='#'>OFFICES FURNITURES &SUPPLIES</a></div>
	<div><img src="../images/img/browseicons/celluar.jpg" class="foodandgourment"><a href='#'>CELLULAR & ACCESSORIES</a></div>
	<div><img src="../images/img/browseicons/aviation.jpg" class="foodandgourment"><a href='#'>AVIATION & MARINE</a></div>
	<div><img src="../images/img/browseicons/service.jpg" class="foodandgourment"><a href='#'>SERVICES</a></div>
	<div><img src="../images/img/browseicons/tools.jpg" class="foodandgourment"><a href='#'>TOOLS & MACHINERY</a></div>
	<div><img src="../images/img/browseicons/misc.jpg" class="foodandgourment"><a href='#'>MISCELLANEOUS</a></div>

	</div>
</div>-->

<div class="hm_lft_panel">
<div class='browsecategories'></div>	
<div class='browselink'>
<?php 
      if(count($home_categorys)>0){
      for($hc=0;$hc<count($home_categorys);$hc++){
	  
	//lower case everything
	$categoryname = strtolower($home_categorys[$hc]['category']);
	//make alphaunermic
	$categoryname = preg_replace("/[^a-z0-9\s-]/", "", $categoryname);
	//Clean multiple dashes or whitespaces
	$categoryname = preg_replace("/[\s-]+/", " ", $categoryname);
	//Convert whitespaces to dash
	$categoryname = preg_replace("/[\s]/", "-", $categoryname);

?>
     <div id='browsecategory' class="browses">
           <img id="browseimg" src="<?php if( $home_categorys[$hc]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('buscat_main_upload_path');?><?php echo ($home_categorys[$hc]['image']); } else { echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path')."no_image.png"; } ?>" alt="<?php echo $home_categorys[$hc]['category'];?>" title="<?php echo $home_categorys[$hc]['category'];?>">
	   <img class="hoverimg"  src="<?php if( $home_categorys[$hc]['hover'] ) { echo $this->common->get_setting_value('2').$this->config->item('buscat_main_upload_path');?><?php echo ($home_categorys[$hc]['hover']); } else { echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path')."no_image.png"; } ?>" alt="<?php echo $home_categorys[$hc]['category'];?>" title="<?php echo $home_categorys[$hc]['category'];?>">
           <a class='hovertxt' href="businessdirectory/category/<?php echo $categoryname;?>/<?php echo $home_categorys[$hc]['id'];?>" title="find all companies for <?php echo $home_categorys[$hc]['category'];?>"> <span><?php echo $home_categorys[$hc]['category'];?></span>  </a> 
       
       </div>
<?php 
}
} 
?>
</div>
</div>

    </div>

<!--<div class="hm_lft_panel">
<div class='browsecategories'></div>	
<div class='browselink'>
<?php 
      if(count($home_categorys)>0){
      for($hc=0;$hc<count($home_categorys);$hc++){
	  
	//lower case everything
	$categoryname = strtolower($home_categorys[$hc]['category']);
	//make alphaunermic
	$categoryname = preg_replace("/[^a-z0-9\s-]/", "", $categoryname);
	//Clean multiple dashes or whitespaces
	$categoryname = preg_replace("/[\s-]+/", " ", $categoryname);
	//Convert whitespaces to dash
	$categoryname = preg_replace("/[\s]/", "-", $categoryname);

?>
     <div>
           <img src="<?php if( $home_categorys[$hc]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('buscat_main_upload_path');?><?php echo ($home_categorys[$hc]['image']); } else { echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path')."no_image.png"; } ?>" alt="<?php echo $home_categorys[$hc]['category'];?>" title="<?php echo $home_categorys[$hc]['category'];?>">

           <a href="businessdirectory/category/<?php echo $categoryname;?>/<?php echo $home_categorys[$hc]['id'];?>" title="find all companies for <?php echo $home_categorys[$hc]['category'];?>"> <span><?php echo $home_categorys[$hc]['category'];?></span>  </a> 
       
       </div>
<?php 
}
} 
?>
</div>
</div>


      <div class="brwse_titl"> <img src="images/brwse_cat_title.png" alt="Browse Categories" title="Browse Categories"> </div>
      <div class="catgry_blck_wrp">
        <?php if(count($home_categorys)>0){?> 
        <ul>
          <?php for($hc=0;$hc<count($home_categorys);$hc++){?> 
          <?php 
		  
		  //lower case everything
			$categoryname = strtolower($home_categorys[$hc]['category']);
			//make alphaunermic
			$categoryname = preg_replace("/[^a-z0-9\s-]/", "", $categoryname);
			//Clean multiple dashes or whitespaces
			$categoryname = preg_replace("/[\s-]+/", " ", $categoryname);
			//Convert whitespaces to dash
			$categoryname = preg_replace("/[\s]/", "-", $categoryname);
		  ?>
          <li> <a href="businessdirectory/category/<?php echo $categoryname;?>/<?php echo $home_categorys[$hc]['id'];?>" title="find all companies for <?php echo $home_categorys[$hc]['category'];?>">
            <div class="ctgr_blck">
            <span><?php echo $home_categorys[$hc]['category'];?></span> 
            
            <img src="<?php if( $home_categorys[$hc]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('buscat_main_upload_path');?><?php echo ($home_categorys[$hc]['image']); } else { echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path')."no_image.png"; } ?>" alt="<?php echo $home_categorys[$hc]['category'];?>" title="<?php echo $home_categorys[$hc]['category'];?>"> </div>
            </a> </li>
        <?php } ?>    
        </ul>
        <?php } ?>
      </div>
    </div>-->
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