<?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'view' ) ) { ?>
<!-- box -->
<div class="box">
<div class="headlines">
    <h2><span>reviewpromo Detail</span></h2>
  </div>
    <!-- table -->
    <table align="center" width="100%" cellspacing="10" cellpadding="0" border="0">
   <?php if( count($reviewpromo)>0 ) { ?>
   <?php $company = $this->reviewpromos->get_company_byid($reviewpromo[0]['companyid']);?>
    <tr>
      <td width="120"><b>Company</b></td>
      <td><b>:</b></td>
      <td><?php if(count($company)>0) { echo ucfirst(stripslashes($company[0]['company'])); } else { echo "---";} ?></td>
    </tr>
    <tr>
      <td width="120"><b>Title</b></td>
      <td><b>:</b></td>
      <td><?php echo ucwords(stripslashes($reviewpromo[0]['name'])) ?></td>
    </tr>
    <tr>
      <td width="120"><b>code</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($reviewpromo[0]['code']) ?></td>
    </tr>
    <tr>
      <td width="120"><b>datecreated</b></td>
      <td><b>:</b></td>
      <td><?php echo date("M d Y",strtotime($reviewpromo[0]['datecreated'])) ?></td>
    </tr>
    <tr>
    	<td width="120"><b>reviewpromo Image</b></td>
        <td><b>:</b></td>
        <td>
        <img style="margin-left:0px;" width="50" height="50" src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/uploads/coupon'.'/main/'.stripslashes($reviewpromo[0]['image']); ?>" /> 
          
        </td>
    </tr>
    <tr>
      <td width="120"><b>summary</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($reviewpromo[0]['text']) ?></td>
    </tr>
    
    <?php } else { ?>
    <!-- Warning form message -->
    <div class="form-message warning">
      <p>No record found.</p>
    </div>
    <?php } ?>
  </table>
    
    <!-- /table -->
</div>
<!-- /box -->
<?php } 
else { ?>
<?php echo $header; ?>
<!-- #content -->
<div id="content">

<?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'edit' ) ) { ?>

         
        
        
<script type="text/javascript">
	function trim(stringToTrim) {
		return stringToTrim.replace(/^\s+|\s+$/g,"");
	}
	function chkcode(promocode)
	{
		if( trim(promocode) != '' )
		{
			$("#reviewpromocodeerror").hide();
			//Return from conroller in php code : echo json_encode(array("result"=>"exist"));
			$.ajax({
				type 				: "POST",
				url 				: "<?php echo site_url('reviewpromo/fieldcheck'); ?>",
				data				:	{ <?php if($this->uri->segment(2) == 'edit' ) echo "'id' : ".$reviewpromo[0]['id'].", "; ?>'promocode' : promocode },
				dataType 			: "json",
				cache				: false,
				success				: function(data){
												//alert(data.result); return false;
												if( data.result == 'old')
												{
													$("#reviewpromocodeerror").hide();
													$("#reviewpromocodeverror").show();
													$("#reviewpromocode").val('').focus();
													return false;
												}
												else
												{
													$("#reviewpromocodeverror").hide();
													$("#reviewpromocodeerror").hide();
												}
											}
			});
		}
		else
		{
			$("#reviewpromocodeverror").hide();
			$("#reviewpromocodeerror").show();
			$("#reviewpromocode").val('').focus();
			return false;
		}
	}
</script>



<link rel="stylesheet" href="<?php echo base_url();?>js/datetimepicker/style.css" type="text/css" media="all" />
  <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script> 
  <script src="<?php echo base_url();?>js/datetimepicker/jquery-ui-timepicker-addon.js"></script>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script type="text/javascript" language="javascript">
	function trim(stringToTrim) {
		return stringToTrim.replace(/^\s+|\s+$/g,"");
	}
	$(document).ready(function() {
		$('.datetimepicker').datepicker
		({dateFormat : 'yy-mm-dd',minDate: new Date});
		
	<?php if( $this->uri->segment(2) == 'add' ) { ?>
		$("#btnsubmit").click(function () {
	<?php } ?>
	<?php if( $this->uri->segment(2) == 'edit' ) { ?>
		$("#btnupdate").click(function () {
	<?php } ?>
	
		
			if( trim($("#title").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#titleerror").show();
				$("#title").val('').focus();
				return false;
			}
			else
			{
				$("#titleerror").hide();
			}
			
			/*if( trim($("#reviewpromocode").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#reviewpromocodeerror").show();
				$("#reviewpromocode").val('').focus();
				return false;
			}
			else
			{
				$("#reviewpromocodeerror").hide();
			}*/
			
			if( trim($("#datecreated").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#datecreatederror").show();
				$("#datecreated").val('').focus();
				return false;
			}
			else
			{
				$("#datecreatederror").hide();
			}
			if( trim($("#summary").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#summaryerror").show();
				$("#summary").val('').focus();
				return false;
			}
			else
			{
				$("#summaryerror").hide();
			}
		
			
			
		
			
			if (!$("#terms-conditions").is(":checked")) {
						$('#terms-error').show();
						return false;
					}
					else
					{
						$('#terms-error').hide();
						return true;
					}
			
			
			if( $("#frmreviewpromo").submit() )
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
   <li><a href="<?php echo site_url('reviewpromo');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
   <li><?php if($this->uri->segment(2) == 'add'){echo 'Add reviewpromo';} else if($this->uri->segment(2) == 'edit') {echo 'Edit reviewpromo'; }?></li>
</ul>
</div>
<!-- /breadcrumbs -->

<?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'edit' ) ) { ?>
<style>
.formBox .con {
width: 33.5%;
float: left;
}

</style>
<!-- box -->
<div class="box">
    
    <div class="headlines">
    	<h2><span>
		<?php if($this->uri->segment(2) == 'add') {echo "Add reviewpromo"; } ?>
        <?php if($this->uri->segment(2) == 'edit') { echo "Edit reviewpromo"; } ?>
        </span></h2>
	</div>
    <div class="box-content">
    <?php echo form_open_multipart('reviewpromo/update',array('class'=>'formBox','id'=>'frmreviewpromo')); ?>
    <fieldset>
    
        
    <div class="clearfix">
          <div class="lab">
            <label for="title">Title <span class="errorsign">*</span></label>
          </div>
          <div class="con">
            <?php if($this->uri->segment(2) == 'add') { ?>
            <?php echo form_input( array( 'name'=>'title','id'=>'title','class'=>'input','type'=>'text' ) ); ?>
            <?php } ?>
            <?php if($this->uri->segment(2) == 'edit') { ?>
            <?php echo form_input( array( 'name'=>'title','id'=>'title','class'=>'input','type'=>'text','value'=>stripslashes($reviewpromo[0]['name']) )); ?>
            <?php } ?>
          </div>
          <div id="titleerror" class="error" align="right">Title is required.</div>

    </div>
    <div class="form-cols">
    <div class="clearfix">
    	  <div class="col1">
          <div class="lab">
            <label for="reviewpromocode">Promotion Code <!-- <span class="errorsign">*</span> --></label>
          </div>
          <div class="con">
            <?php if($this->uri->segment(2) == 'add') { ?>
            <?php echo form_input( array( 'name'=>'reviewpromocode','id'=>'reviewpromocode','class'=>'input','type'=>'text') ); ?>
            <?php } ?>
            <?php if($this->uri->segment(2) == 'edit') { ?>
            <?php echo form_input( array( 'name'=>'reviewpromocode','id'=>'reviewpromocode','class'=>'input','type'=>'text','value'=>stripslashes($reviewpromo[0]['code']))); ?>
            <?php } ?>
          </div>
          <div id="reviewpromocodeerror" class="error" align="right">reviewpromocode is required.</div>
          <div id="reviewpromocodeverror" class="error" align="right">reviewpromocode is already exists.</div>
</div>
    </div>
    </div>
    <div class="form-cols">
    <div class="clearfix">
    	  <div class="col1">
          <div class="lab">
            <label for="reviewpromocode">Date created <span class="errorsign">*</span></label>
          </div>
          <div class="con">
            <?php if($this->uri->segment(2) == 'add') { ?>
            <?php echo form_input( array( 'name'=>'datecreated','id'=>'datecreated','class'=>'input datetimepicker','type'=>'text') ); ?>
            <?php } ?>
            <?php if($this->uri->segment(2) == 'edit') { ?>
            <?php echo form_input( array( 'name'=>'datecreated','id'=>'datecreated','class'=>'input datetimepicker','type'=>'text','value'=>stripslashes($reviewpromo[0]['datecreated'])) ); ?>
            <?php } ?>
          </div>
          <div id="datecreatederror" class="error" align="right">datecreated is required.</div>
         
</div>
    </div>
    </div>
    <div class="form-cols">
    <div class="clearfix">
    	  <div class="col1">
          <div class="lab">
            <label for="enddate">Summary <span class="errorsign">*</span></label>
          </div>
          <div class="con">
            <?php if($this->uri->segment(2) == 'add') { ?>
            <?php echo form_textarea( array( 'name'=>'summary','id'=>'summary','class'=>'textarea','rows'=>'4','cols'=>'15' )); ?> 
            <?php } ?>
            <?php if($this->uri->segment(2) == 'edit') { ?>
            <?php echo form_textarea( array( 'name'=>'summary','id'=>'summary','class'=>'textarea','rows'=>'4','cols'=>'15','value'=>stripslashes($reviewpromo[0]['text']))); ?>
            <?php } ?>
          </div>
          <div id="summaryerror" class="error" align="right">Summary is required.</div>
</div>
    </div>
    </div>
  <div class="form-cols"><!-- two form cols -->
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 14% !important;">
                <label for="status">Status </label>
              </div>
              <div class="con" style="width: 10% !important;float: left;margin-left: -15px;">
				<?php 
					
				$options = array(
					'1'  => 'Enable',
					'2'  => 'Disable',
				
					);
				
				$class = 'class = "select"';
				
                if($this->uri->segment(2) == 'add') 
                { 
					echo form_dropdown('status', $options, '1', $class);
                } 
                
				if($this->uri->segment(2) == 'edit') 
				{ 
					echo form_dropdown('status', $options, $reviewpromo[0]['status'], $class);
                } 
                
                ?>
              </div>
            </div>
          </div>
        </div>
    <div class="clearfix file">
          <div class="lab" style="width:12.8%;">
            <label for="image">Upload Image/file </label>
          </div>
          <div class="con" style="width:50%; float:left"> <?php echo form_input( array( 'name'=>'image','id'=>'image','class'=>'input file upload-file','type'=>'file') ); ?> 
          
          <?php if($this->uri->segment(2) == 'edit') { ?>
          <img style="margin-left:120px;" width="50" height="50" src="<?php if( $reviewpromo[0]['image'] ){ echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/uploads/coupon'.'/main/'.stripslashes($reviewpromo[0]['image']);  } else{echo $this->settings->get_setting_value('2').substr($this->config->item('reviewpromo_thumb_upload_path'),3)."/no-image.gif"; } ?>" /> 
          <?php echo form_input( array( 'name'=>'reviewpromohiddenimage','value'=>$reviewpromo[0]['image'],'type'=>'hidden' ) ); ?>
          <?php } ?>
          </div>
          <div id="imageerror" class="error" style="width:auto">Photo required.</div>
        </div>
    
     <div id="termscondn" class="review_txt_box">
			<input type="checkbox" id="terms-conditions" />
			<label>I am Authorized to act on behalf of the Company and agree to the <a href="http://yougotrated.com/footerpage/index/2" target="_blank">Terms and Conditions</a> of use.</label>
			<div><label id="terms-error" style='display:none;color:#ff0000;'>Please indicate that you accept the Terms and Conditions</label></div>
		</div>
    <div class="btn-submit">
        <!-- Submit form -->
        <?php if($this->uri->segment(2) == 'add') { ?>
        <?php echo form_input(array('name'=>'btnsubmit','id'=>'btnsubmit','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
        <?php } ?>
        <?php if($this->uri->segment(2) == 'edit') { ?>
        <?php echo form_input(array('name'=>'btnupdate','id'=>'btnupdate','class'=>'button','type'=>'submit','value'=>'Update')); ?>
        <?php } ?>
        or <a href="<?php echo site_url('reviewpromo');?>" class="Cancel">Cancel</a>
    </div>
    
    </fieldset>
    <?php if($this->uri->segment(2) == 'edit') { ?>     
    <?php echo form_hidden( array( 'id' => $this->encrypt->encode($reviewpromo[0]['id']) ) ); ?>
    <?php } ?>
    <?php echo form_close(); ?>
    </div>
    </div>
<!-- /box-content -->

<?php } else { ?>

<?php echo link_tag('colorbox/colorbox.css'); ?> 
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
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>colorbox/jquery.colorbox.js"></script> 
<script language="javascript" type="text/javascript">
  $(document).ready(function(){
		//$('.colorbox').colorbox({'width':'55%'});
		$('.colorbox').colorbox({'width':'55%','height':'60%'});
/*		$('.colorbox').colorbox({ 
			onComplete : function() { 
			   $(this).colorbox.resize();
			}
		});*/
  });
</script>
<!-- box -->
<div class="box">
    <div class="headlines">
	    <h2><span><?php echo 'Review Promo Code'; ?></span></h2>
    </div>
    <div class="box-content"> <?php echo form_open('reviewpromo/searchresult',array('class'=>'formBox','id'=>'frmsearch')); ?>
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
			  		echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search reviewpromo by keyword','value'=>$keysearch));
			  }
			  else
			  {
			  	echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search reviewpromo by keyword'));
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
    
	<?php if( count($reviewpromos) > 0 ) { ?>
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
        
        <th>Title</th>
        <th width="10%">Promocode</th>
        <th width="10%">Enddate</th>
        <th width="10%">Status</th>
        <th width="10%">Action</th>
    </tr>
    <?php for($i=0;$i<count($reviewpromos);$i++) { ?>
    
    <tr>
	  
      <td><?php echo substr(stripslashes($reviewpromos[$i]['name']),0,100).'...'; ?></td>
      <td><?php echo stripslashes($reviewpromos[$i]['code']); ?></td>
      <td><?php echo date("M d Y",strtotime($reviewpromos[$i]['datecreated'])); ?></td>
      <td><?php if( stripslashes($reviewpromos[$i]['status']) == 'Enable' ) { ?>
          <a href="<?php echo site_url('reviewpromo/disable/'.$reviewpromos[$i]['id']);?>" title="Click to Disable" class="btn btn-small btn-success" onClick="return confirm('Are you sure to Disable this reviewpromo?');" style="cursor:pointer">Enable</a>
          <?php } ?>
          <?php if( stripslashes($reviewpromos[$i]['status']) == 'Disable' ) { ?>
          <a href="<?php echo site_url('reviewpromo/enable/'.$reviewpromos[$i]['id']);?>" title="Click to Enable" class="btn btn-small btn-info" style="cursor:pointer" onClick="return confirm('Are you sure to Enable this reviewpromo?');"><span style="color: #CD0B1C;">Disable</span></a>
          <?php } ?></td>
  	<td style="padding: 8px 4px;"><a href="<?php echo site_url('reviewpromo/edit/'.$reviewpromos[$i]['id']); ?>" title="Edit" class="ico ico-edit">Edit</a>
        <a href="<?php echo site_url('reviewpromo/delete/'.$reviewpromos[$i]['id']);?>" title="Delete" class="ico ico-delete" onClick="return confirm('Are you sure to Delete this reviewpromo?');">Delete</a>
        <a href="<?php echo site_url('reviewpromo/view/'.$reviewpromos[$i]['id']); ?>" title="View Detail" class="colorbox"><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a></td>
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
<?php } ?>
