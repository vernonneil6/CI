<?php echo $heading; ?>
<!-- #content -->

<div id="content">
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('widget');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
    </ul>
  </div>
  <?php  ?>
  
  <!-- breadcrumbs --> 
  
  <!-- /breadcrumbs --> 
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span> Business Widget</span></h2>
    </div>
    
    <!-- Correct form message -->
    <?php if( $this->session->flashdata('success') ) { ?>
    <div class="form-message correct">
      <p><?php echo $this->session->flashdata('success'); ?></p>
    </div>
    <?php } ?>
    <!-- Error form message -->
    <?php if( $this->session->flashdata('error') ) { ?>
    <div class="form-message error1">
      <p><?php echo $this->session->flashdata('error'); ?></p>
    </div>
    <?php } ?>
    
    <!-- table -->
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag"> </tr>
      <?php $siteid = $this->session->userdata['siteid'];?>
      <?php if($siteid!='all'){ ?>
      <?php $url=$this->settings->get_url_by_id($siteid);?>
      
      <?php $companyid=$this->session->userdata['youg_admin']['id'];?>
      
      <?php $company = $this->settings->get_company_byid($companyid);
      		$websites = $this->settings->get_all_urls();
	  ?>
      <?php if(count($company)>0)
	  {
	  	$comseokeyword = $company[0]['companyseokeyword'];
	  }
	  ?>
      <?php if($companyid!='' && (count($url)>0)) {?>
     <?php if(count($websites)>0)
	  {?>
     
     <tr>
        <td>Widget</td>
        <td>
		<a class="widgetview" href="<?php echo $url[0]['siteurl'];?>widget/business/<?php echo $companyid;?>" target="_blank" title="Click to view your widget">Click to view your widget</a>
        <div class="widget_para">This embeddable widget will create a 'reviews' tab on the right side of the site it is embedded on. When clicked, the tab will show an iFrame popup, with an interactive list of reviews. Please copy and paste this embed code into your website's code. We recommend you place this code in a footer/file that appears on every page, or you can simply copy and paste this as-is into your website's CMS content editor.</div></td>
      </tr>
      <tr>
        <td>Widget Code</td>
        <td>
<textarea rows = "10" cols = "125">
	
	<link rel="stylesheet" href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/css/widget_iframe.css';?>" type="text/css">
	<script type="text/javascript" src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/js/widget_iframe.js';?>" ></script> 	 

	<div class="company_review_tab fancybox" href="#review_popup" onclick="showPopup()">&nbsp;</div>
	<div id="review_popup" class = "popupwidth">
		<div class='close_popup' onclick="closePopup()">&nbsp</div>		
		<iframe id="container_frame" src="http://www.yougotrated.com/widget/content/<?php echo $companyid; ?>" style="width:100%;height:100%;position:relative;" ></iframe></div> 		
	</div>
	

</textarea>
        </td>
      </tr>
      
	  <?php } ?>
	  <?php } }?>
    </table>
  </div>
  <!-- /box --> 
  
</div>
<!-- /#content -->
<?php  ?>
<!-- #sidebar -->

<?php include('leftmenu.php'); ?>
<!-- /#sidebar --> 
<!-- #footer --> 
<?php echo $footer; ?> 
