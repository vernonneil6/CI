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
        <td><a href="<?php echo $url[0]['siteurl'];?>widget/business/<?php echo $companyid;?>" target="_blank" title="Get Widget">Get Widget</a></td>
      </tr>
      <tr>
        <td>Widget Code</td>
        <td>&lt;iframe src=&quot;<?php echo $url[0]['siteurl'];?>widget/business/<?php echo $companyid;?>&quot; style=&quot;border:none;height:375px;&quot;&gt;&lt;/iframe&gt; 
        	<br/>
			&lt;div style=&quot;display:none;&quot;&gt;
			&lt;a href=&quot;<?php echo $websites[0]['url'].("/company/".$company[0]['companyseokeyword']."/reviews/coupons/complaints");?>&quot;&gt;&lt;/a&gt;
			&lt;a href=&quot;<?php echo $websites[1]['url'].("/company/".$company[0]['companyseokeyword']."/reviews/coupons/complaints");?>&quot;&gt;&lt;/a&gt;
            &lt;a href=&quot;<?php echo $websites[2]['url'].("/company/".$company[0]['companyseokeyword']."/reviews/coupons/complaints");?>&quot;&gt;&lt;/a&gt;
            &lt;a href=&quot;<?php echo $websites[3]['url'].("/company/".$company[0]['companyseokeyword']."/reviews/coupons/complaints");?>&quot;&gt;&lt;/a&gt;
            &lt;a href=&quot;<?php echo $websites[4]['url'].("/company/".$company[0]['companyseokeyword']."/reviews/coupons/complaints");?>&quot;&gt;&lt;/a&gt;
            &lt;a href=&quot;<?php echo $websites[5]['url'].("/company/".$company[0]['companyseokeyword']."/reviews/coupons/complaints");?>&quot;&gt;&lt;/a&gt;
            &lt;a href=&quot;<?php echo $websites[6]['url'].("/company/".$company[0]['companyseokeyword']."/reviews/coupons/complaints");?>&quot;&gt;&lt;/a&gt;
            &lt;a href=&quot;<?php echo $websites[7]['url'].("/company/".$company[0]['companyseokeyword']."/reviews/coupons/complaints");?>&quot;&gt;&lt;/a&gt;
            &lt;a href=&quot;<?php echo $websites[8]['url'].("/company/".$company[0]['companyseokeyword']."/reviews/coupons/complaints");?>&quot;&gt;&lt;/a&gt;
            &lt;a href=&quot;<?php echo $websites[9]['url'].("/company/".$company[0]['companyseokeyword']."/reviews/coupons/complaints");?>&quot;&gt;&lt;/a&gt;
            &lt;a href=&quot;<?php echo $websites[10]['url'].("/company/".$company[0]['companyseokeyword']."/reviews/coupons/complaints");?>&quot;&gt;&lt;/a&gt;
            &lt;a href=&quot;<?php echo $websites[11]['url'].("/company/".$company[0]['companyseokeyword']."/reviews/coupons/complaints");?>&quot;&gt;&lt;/a&gt;
            &lt;a href=&quot;<?php echo $websites[12]['url'].("/company/".$company[0]['companyseokeyword']."/reviews/coupons/complaints");?>&quot;&gt;&lt;/a&gt;
            &lt;a href=&quot;<?php echo $websites[13]['url'].("/company/".$company[0]['companyseokeyword']."/reviews/coupons/complaints");?>&quot;&gt;&lt;/a&gt;
            &lt;a href=&quot;<?php echo $websites[14]['url'].("/company/".$company[0]['companyseokeyword']."/reviews/coupons/complaints");?>&quot;&gt;&lt;/a&gt;
            &lt;a href=&quot;<?php echo $websites[15]['url'].("/company/".$company[0]['companyseokeyword']."/reviews/coupons/complaints");?>&quot;&gt;&lt;/a&gt;&lt;/div&gt;
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