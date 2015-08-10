<?php echo $header;?>

<section class="container">
  <section class="main_contentarea">
    <div class="hm_bnnr">
      <h1><?php echo $tag_line;?></h1>
      <div class="hm_bnnr_innr"> <img src="images/hm_banner.png" alt="Inner-Banner" title="Inner Page Banner"> </div>
    </div>
    <div class="hm_tag_wrp"> <span><img src="images/hm_tagline.png" alt="Complaint resolved" title="Complaint resolved"></span> <span><a href="#"><img src="images/start_here.png" alt="Start Here" title="Start Here"></a></span> </div>
    <div class="container">
      <div class="hm_lft_panel">
        <h2>TRENDING <small>SEARCHES</small></h2>
        <div class="tag_lnkwrp">
          <?php if(count($search_keywords)>0){?>
          <?php for($sk=0;$sk<count($search_keywords);$sk++){?>
          <a title="Search <?php echo $search_keywords[$sk]['keyword'];?>" href="<?php echo site_url('complaint/keysearch').'/'.$search_keywords[$sk]['keyword'];?>"><?php echo $search_keywords[$sk]['keyword'];?></a>
          <?php } ?>
          <?php } ?>
        </div>
      </div>
      <div class="hm_rght_panel">
        <div class="hm_live_menu"> <span><img src="images/ygr_live_logo.png" alt="Yougotrated live" title="Yougotrated live"></span>
          <ul>
            <li><a href="<?php echo base_url();?>" title="RECENT ACTIVITY" >RECENT ACTIVITY</a></li>
            <li><a href="<?php echo site_url('complaint/weektrending');?>" title="Trending Complaints" style="color:#333333 !important;">TRENDING COMPLAINTS</a></li>
            <li><a href="<?php echo site_url('complaint/advfilter');?>" title="Advance Filter" >ADVANCED FILTER</a></li>
          </ul>
        </div>
        <div class="hm_rvw_wrp">
          <?php if(count($complaints)>0) {?>
          <?php for($i=0; $i<count($complaints); $i++) { ?>
          <?php $user=$this->users->get_user_byid($complaints[$i]['userid']) ;?>
          <div class="review_block">
            <div class="review_lft">
              <div class="user_img"><img title="User image" alt="User image" src="images/user_icn.png"></div>
              <div class="user_name">
                <?php if($complaints[$i]['userid']!=0){ ?>
                <?php if(count($user)>0){ ?>
                <a href="<?php echo site_url('complaint/viewuser/'.$complaints[$i]['companyid'].'/'.$complaints[$i]['userid']); ?>" title="view profile"><?php echo $user[0]['username'];?> <span><?php echo $user[0]['city'];?>,<?php echo $user[0]['state'];?></span> </a>
                <?php } ?>
                <?php } else{?>
                <a href="Anonymous">Anonymous</a>
                <?php } ?>
              </div>
            </div>
            <div class="review_rgt">
              <div class="review_ratng_wrp">
                <div class="rating"> </div>
                <div class="rat_title">
                  <h2><a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']);?>" title="view Complaint Detail"><?php echo ucfirst(stripslashes($complaints[$i]['company'])); ?></a></h2>
                  <span><?php echo date('m/d/Y',strtotime($complaints[$i]['complaindate']));?></span></div>
              </div>
              <p><a href="<?php echo site_url('complaint/browse/'.$complaints[$i]['comseokeyword']); ?>" title="view complaint Detail"><?php echo strtolower(substr(stripslashes($complaints[$i]['detail']),0,212)."..."); ?></a></p>
            </div>
          </div>
          <?php } ?>
          <?php } ?>
        </div>
      </div>
    </div>
    <div class="brws_category">
      <div class="brwse_titl"> <img src="images/brwse_cat_title.png" alt="Browse Categories" title="Browse Categories"> </div>
      <div class="catgry_blck_wrp">
        <?php if(count($home_categorys)>0){?>
        <ul>
          <?php for($hc=0;$hc<count($home_categorys);$hc++){?>
          <li> <a href="#">
            <div class="ctgr_blck"> <span><?php echo $home_categorys[$hc]['category'];?></span> <img src="<?php if( $home_categorys[$hc]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('buscat_main_upload_path');?><?php echo ($home_categorys[$hc]['image']); } else { echo $this->common->get_setting_value('2').$this->config->item('company_thumb_upload_path')."no_image.png"; } ?>" alt="YGR-<?php echo $home_categorys[$hc]['category'];?>" title="<?php echo $home_categorys[$hc]['category'];?>"> </div>
            </a> </li>
          <?php } ?>
        </ul>
        <?php } ?>
      </div>
    </div>
  </section>
</section>
<?php echo $footer;?>
