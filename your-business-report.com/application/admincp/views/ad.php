<?php echo $header; ?>
<!-- #content -->
<div id="content">

<?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'edit' ) ) { ?>
<script type="text/javascript" language="javascript">
	function trim(stringToTrim) {
		return stringToTrim.replace(/^\s+|\s+$/g,"");
	}
	$(document).ready(function() {
		
	<?php if( $this->uri->segment(2) == 'add' ) { ?>
		$("#btnsubmit").click(function () {
	<?php } ?>
	<?php if( $this->uri->segment(2) == 'edit' ) { ?>
		$("#btnupdate").click(function () {
	<?php } ?>
	
			if( trim($("#zone").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#zoneerror").show();
				$("#zone").val('').focus();
				return false;
			}
			else
			{
				$("#zoneerror").hide();
			}
			
			if( trim($("#page").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#pageerror").show();
				$("#page").val('').focus();
				return false;
			}
			else
			{
				$("#pageerror").hide();
			}
			
			if( trim($("#categoryid").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#categoryiderror").show();
				$("#categoryid").val('').focus();
				return false;
			}
			else
			{
				$("#categoryiderror").hide();
			}
			
			var url = /^(http|https):\/\/[\w\-_]+(\.[\w\-_]+)+([\w\-\.,@?^=%&amp;:\+#]*[\w\-\@?^=%&amp;\+#])?/; 
			if(trim($("#url").val()) == "")
			{
				$("#urlerror").show();
				$("#url").val('').focus();
				return false;
			}
			else
			{
				if( !url.test(trim($("#url").val())))
				{
					$("#urlerror").hide();
					$("#error").attr('style','display:block;');
					$("#urlverror").show();
					$("#url").focus();
					return false;
				}
				else
				{
					$("#urlerror").hide();
					$("#urlverror").hide();
				}
			}
			
			<?php if( $this->uri->segment(2) == 'add' ) { ?>
			if( $("#image").val() == "" )
			{
				$("#error").attr('style','display:block;');
				$("#imageerror").show();
				$("#image").val('').focus();
				return false;
			}
			else
			{
				$("#imageerror").hide();
			}
			<?php } ?>
			
			
			if( $("#frmad").submit() )
			{
				$("#error").attr('style','display:none;');
			}
	
    	});
	
	});
</script>
<?php } ?>

<!-- breadcrumbs -->
<div class="breadcrumbs">
<ul>
   <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
   <li><a href="<?php echo site_url('ad');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
   <li><?php if($this->uri->segment(2) == 'add'){echo 'Add Google Ad';} else if($this->uri->segment(2) == 'edit') {echo 'Edit Google Ad'; }?></li>
</ul>
</div>
<!-- /breadcrumbs -->

<?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'edit' ) ) { ?>
<!-- box -->
<div class="box">
    
    <div class="headlines">
    	<h2><span>
		<?php if($this->uri->segment(2) == 'add') {echo "Add Google Ad"; } ?>
        <?php if($this->uri->segment(2) == 'edit') { echo "Edit Google Ad"; } ?>
        </span></h2>
	</div>
    <div class="box-content">
    <?php echo form_open_multipart('ad/update',array('class'=>'formBox','id'=>'frmad')); ?>
    <fieldset>
    
    <div class="clearfix">
          <div class="lab">
            <label for="zone">Zone <span class="errorsign">*</span></label>
          </div>
          <div class="con">
            <?php $zones = array(''=>'Select','top'=>'Top','bottom'=>'Bottom','left'=>'Left','right'=>'Right');?>
			<?php if($this->uri->segment(2) == 'add') { ?>

            <?php $zones = array(''=>'Select','top'=>'Top','bottom'=>'Bottom','left'=>'Left','right'=>'Right');?>
            <?php echo form_dropdown('zone',$zones,'Select',"id='zone' class='select'"); ?>
            
            <?php } ?>
            <?php if($this->uri->segment(2) == 'edit') { ?>

            <?php $zones = array(''=>'Select','top'=>'Top','bottom'=>'Bottom','left'=>'Left','right'=>'Right');?>
            <?php echo form_dropdown('zone',$zones,stripslashes($ad[0]['zone']),"id='zone' class='select'"); ?>
            <?php } ?>
          </div>
          <div id="zoneerror" class="error" style="width:auto">Select Zone.</div>

    </div>
    <div class="clearfix">
          <div class="lab">
            <label for="page">Page <span class="errorsign">*</span></label>
          </div>
          <div class="con">
            <?php $pages = array(''=>'Select','home'=>'Home Page','complaint'=>'Complaint Page','review'=>'Business Review','directory'=>'Business Directory','pressrelease'=>'Pressreleases','solution'=>'Business Solution','coupon'=>'CouponDeals & Steals','others'=>'Others');?>
			
			<?php if($this->uri->segment(2) == 'add') { ?>
            <?php echo form_dropdown('page',$pages,'Select',"id='page' class='select'"); ?>
            <?php } ?>
            <?php if($this->uri->segment(2) == 'edit') { ?>
            <?php echo form_dropdown('page',$pages,stripslashes($ad[0]['page']),"id='page' class='select'"); ?>
            <?php } ?>
          </div>
          <div id="pageerror" class="error" style="width:auto">Select Page.</div>

    </div>
    <div class="clearfix">
          <div class="lab">
            <label for="categoryid">Category <span class="errorsign">*</span></label>
          </div>
          <div class="con">
            <?php if($this->uri->segment(2) == 'add') { ?>
            <?php echo form_dropdown('categoryid',$selcat,'Select',"id='categoryid' class='select'"); ?>
            <?php } ?>
            <?php if($this->uri->segment(2) == 'edit') { ?>
            <?php echo form_dropdown('categoryid',$selcat,stripslashes($ad[0]['categoryid']),"id='categoryid' class='select'"); ?>
            <?php } ?>
          </div>
          <div id="categoryiderror" class="error" style="width:auto">Select Category.</div>

    </div>
    <div class="clearfix">
        <div class="lab"><label for="ad">URL <span class="errorsign">*</span></label></div>
        <div class="con">
        <?php if($this->uri->segment(2) == 'add') { ?>
        <?php echo form_input( array( 'name'=>'url','id'=>'url','class'=>'input'));?>
        <?php } ?>
        <?php if($this->uri->segment(2) == 'edit') { ?>
        <?php echo form_input( array( 'name'=>'url','id'=>'url','class'=>'input','value'=>stripslashes($ad[0]['url']) ) ); ?>
        <?php } ?>
        </div>
        <div id="urlerror" class="error" style="width:auto">URL is required.</div>
        <div id="urlverror" class="error">Enter valid URL example(https://www.google.co.in/)</div>
    </div>
    <div class="clearfix file">
          <div class="lab" style="width:13%">
            <label for="image">Banner Logo <span class="errorsign">*</span></label>
          </div>
          <div class="con" style="width:40%; float:left"> <?php echo form_input( array( 'name'=>'image','id'=>'image','class'=>'input file upload-file','type'=>'file') ); ?> </div>
          <?php if($this->uri->segment(2) == 'edit') { ?>
          <div class="task-photo"> <img width="60" height="40" src="<?php if( $ad[0]['image'] ){ echo $this->settings->get_setting_value('2').substr($this->config->item('ad_thumb_upload_path'),3);?><?php echo stripslashes($ad[0]['image']); } else{echo $this->settings->get_setting_value('2').substr($this->config->item('ad_thumb_upload_path'),3)."/no-image.gif"; } ?>" alt="<?php echo stripslashes($ad[0]['image']); ?>"/> </div>
          <?php } ?>
          <div id="imageerror" class="error" style="width:123px">Banner Logo is required.</div>
        </div>
    <div class="btn-submit">
        <!-- Submit form -->
        <?php if($this->uri->segment(2) == 'add') { ?>
        <?php echo form_input(array('name'=>'btnsubmit','id'=>'btnsubmit','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
        <?php } ?>
        <?php if($this->uri->segment(2) == 'edit') { ?>
        <?php echo form_input(array('name'=>'btnupdate','id'=>'btnupdate','class'=>'button','type'=>'submit','value'=>'Update')); ?>
        <?php } ?>
        or <a href="<?php echo site_url('ad');?>" class="Cancel">Cancel</a>
    </div>
    
    </fieldset>
    <?php if($this->uri->segment(2) == 'edit') { ?>     
    <?php echo form_hidden( array( 'id' => $this->encrypt->encode($ad[0]['id']) ) ); ?>
    <?php } ?>
    <?php echo form_close(); ?>
    </div>
    </div>
<!-- /box-content -->

<?php } else { ?>
<script type="text/javascript" language="javascript">
	function trim(stringToTrim) {
		return stringToTrim.replace(/^\s+|\s+$/g,"");
	}
	$(document).ready(function() {
		$("#btnsearch").click(function () {
	
			if( trim($("#keysearch").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#keysearcherror").show();
				$("#keysearch").val('').focus();
				return false;
			}
			else
			{
				$("#keysearcherror").hide();
			}
			
			if( $("#frmsearch").submit() )
			{
				$("#error").attr('style','display:none;');
			}
    	});
	
	});
</script>
<?php echo link_tag('colorbox/colorbox.css'); ?> 
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>colorbox/jquery.colorbox.js"></script> 
<script language="javascript" type="text/javascript">
  $(document).ready(function(){
		$('.colorbox').colorbox({'width':'55%','height':'60%'});
  });
</script>
<!-- box -->
<div class="box">
    <div class="headlines">
	    <h2><span><?php echo 'Google Ads'; ?></span></h2>
    </div>
    <div class="box-content"> <?php echo form_open('ad/searchad',array('class'=>'formBox','id'=>'frmsearch')); ?>
      <fieldset>
        <!-- Error form message -->
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="keysearch">Keyword<span>*</span></label>
              </div>
              <div class="con"> 
				<?php if($this->uri->segment(2)=='searchresult') { 
			  			echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search Ad by keyword','value'=>$this->uri->segment(3)));
				}
				else
				{
					echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search Ad by keyword'));
				}
				?>
                </div>
            </div>
          </div>
          <div class="col1">
            <div class="clearfix">
             <div><?php echo form_input(array('name'=>'btnsearch','id'=>'btnsearch','class'=>'button','type'=>'submit','value'=>'Search','style'=>'margin-left:15px;')); ?></div>
            </div>
          </div>
          <div id="keysearcherror" style="display:none;" class="error" align="right">Enter Keyword.</div>
        </div>
      </fieldset>
      <?php echo form_close(); ?> 
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
    
	<?php if( count($ads) > 0 ) { ?>
	<!-- table -->
    <style>
	.tab td {
		padding: 8px 10px;
	}
    .tab th {
		padding: 8px 10px;
	}
	</style>
	<table class="tab tab-drag">
    <tr class="top nodrop nodrag">
        <th width="7%">Zone</th>
        <th width="20%">URL</th>
        <th width="30%">Banner</th>
        <th width="30%">Page</th>
        <th width="7%">Status</th>
        <th width="8%">Action</th>
    </tr>
    <?php for($i=0;$i<count($ads);$i++) { ?>
    <tr>
	   	<td>
		<?php echo stripslashes($ads[$i]['zone']); ?></td>
      	<td><?php echo $ads[$i]['url']; ?>
        </td>
        <td><div class="task-photo"> <img width="60" height="40" src="<?php if( $ads[$i]['image'] ){ echo $this->settings->get_setting_value('2').substr($this->config->item('ad_thumb_upload_path'),3);?><?php echo stripslashes($ads[$i]['image']); } else{echo $this->settings->get_setting_value('2').substr($this->config->item('ad_thumb_upload_path'),3)."/no-image.gif"; } ?>" alt=""/> </div></td>
      	<td><?php echo ucfirst($ads[$i]['page']); ?>
        <td><?php if( stripslashes($ads[$i]['status']) == 'Enable' ) { ?>
          <a href="<?php echo site_url('ad/disable/'.$ads[$i]['id']);?>" title="Click to Disable" class="btn btn-small btn-success" onClick="return confirm('Are you sure to Disable this Ad?');" style="cursor:pointer">Enable</a>
          <?php } ?>
          <?php if( stripslashes($ads[$i]['status']) == 'Disable' ) { ?>
          <a href="<?php echo site_url('ad/enable/'.$ads[$i]['id']);?>" title="Click to Enable" class="btn btn-small btn-info" style="cursor:pointer" onClick="return confirm('Are you sure to Enable this Ad?');"><span style="color: #CD0B1C;">Disable</span></a>
          <?php } ?></td>
  	<td style="padding: 8px 4px;"><a href="<?php echo site_url('ad/edit/'.$ads[$i]['id']); ?>" title="Edit" class="ico ico-edit">Edit</a>
        <a href="<?php echo site_url('ad/delete/'.$ads[$i]['id']);?>" title="Delete" class="ico ico-delete" onClick="return confirm('Are you sure to Delete this FAQ?');">Delete</a>
        </td>
    </tr>
    <?php } ?>
    </table>
    <!-- /table -->
	<!-- /pagination -->
	<?php  if($this->pagination->create_links()) { ?>
	<div class="pagination"> <?php echo $this->pagination->create_links(); ?> </div>
	<?php } ?>
	<!-- /pagination -->
    <?php } 
	else { ?>
    <!-- Warning form message -->
    <div class="form-message warning"><p>No records found.</p></div>
    <?php } ?>
   </div>
<!-- /box -->
<?php } ?>

</div>
<!-- /#content -->
<!-- #sidebar -->
<?php include('leftmenu.php'); ?>
<!-- /#sidebar -->
<!-- #footer -->
<?php echo $footer; ?>
