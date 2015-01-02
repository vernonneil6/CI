<?php echo $header; ?>

<!-- #content -->

<div id="content">
<?php if( $this->uri->segment(2) == 'edit' ) { ?>
<script type="text/javascript" language="javascript">
	function trim(stringToTrim) {
		return stringToTrim.replace(/^\s+|\s+$/g,"");
	}
	$(document).ready(function() {		
	
		$("#btnupdate").click(function () {
			
			<?php if($settings[0]['id'] != 17) { ?>
			
			if( trim($("#txtvalue").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#txtvalueerror").show();
				$("#txtvalue").val('').focus();
				return false;
			}
			else
			{
				$("#txtvalueerror").hide();
			}
			<?php } ?>
			
			if( $("#frmsetting").submit() )
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
    <li><a href="<?php echo site_url('setting');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
    <li>
      <?php if($this->uri->segment(2) == 'add'){echo 'Add Setting';} else if($this->uri->segment(2) == 'edit') {echo 'Edit Setting'; }?>
    </li>
  </ul>
</div>
<!-- /breadcrumbs -->

<?php if( $this->uri->segment(2) && $this->uri->segment(2) == 'edit' ) { ?>

<!-- box -->
<div class="box">
  <div class="headlines">
    <h2><span>Edit Setting</span></h2>
  </div>
  <div class="box-content"> <?php echo form_open_multipart('setting/update',array('class'=>'formBox','id'=>'frmsetting')); ?>
    <?php if($settings[0]['id'] == 17) { ?>
    <div class="clearfix file" style="width: 91% !important;">
      <?php } else { ?>
      <div class="clearfix" style="width: 91% !important;">
        <?php } ?>
        <div class="lab" style="width: 20% !important; padding-bottom:5px">
          <label for="txtvalue"><?php echo $settings[0]['fieldname']; ?><span class="errorsign"> *</span></label>
        </div>
        <?php if($settings[0]['id'] == 17) { ?>
        <style>
.form-cols .col1 {
	width: 63%;
}
.formBox .col1 .lab{
	width: 32% !important;
}
.formBox .col1 .con{
	width: 65% !important;
}
.formBox .file .upload-file {
    width: 252px !important;
}
.error{
	width:210px;
}
.formBox .file .button-upload {
	left:260px;
}

</style>
        <div class="con" style="width: 40% !important; text-align:justify; float:left;"><?php echo form_input( array( 'name'=>'txtvalue','id'=>'txtvalue','class'=>'input file upload-file','type'=>'file' ) ); ?> </div>
        <div align="right" style="margin-right:230px;"> <img width="60" height="40" src="<?php if( $settings[0]['id'] ){ echo $this->settings->get_setting_value('2').substr($this->config->item('verifiedlogo_thumb_upload_path'),3);?><?php echo stripslashes($settings[0]['value']); } else { echo $this->settings->get_setting_value('2').substr($this->config->item('verifiedlogo_thumb_upload_path'),3)."/no-image.gif"; } ?>" alt=""/> </div>
        <?php }
		
		
		elseif($settings[0]['id'] == 4) { ?>
        <div class="con" style="width: 99% !important; text-align:justify; float:left;"> <?php echo form_textarea( array( 'name'=>'txtvalue','id'=>'txtvalue','class'=>'textarea','rows'=>'4','cols'=>'15','value'=>stripslashes($settings[0]['value']),'style'=>'height:225px' ) ); ?> </div>
        <?php } else {?>
        <div class="con" style="width: 40% !important; text-align:justify; float:left;"> <?php echo form_input( array( 'name'=>'txtvalue','id'=>'txtvalue','class'=>'input','type'=>'text','value'=>stripslashes($settings[0]['value']) ) ); ?> </div>
        <?php } ?>
        <div id="txtvalueerror" class="error" style="width:auto"><?php echo $settings[0]['fieldname']; ?> field is required.</div>
      </div>
      <div class="btn-submit"> 
        <!-- Submit form --> 
        <?php echo form_input(array('name'=>'btnupdate','id'=>'btnupdate','class'=>'button','type'=>'submit','value'=>'Update')); ?> or <a href="<?php echo site_url('setting');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php echo form_hidden( array( 'txtintid' => $this->encrypt->encode($settings[0]['intid']) ) ); ?>
      <?php echo form_hidden( array( 'intid' => $this->encrypt->encode($settings[0]['id']) ) ); ?> <?php echo form_close(); ?> </div>
  </div>
  <!-- /box-content -->
  
  <?php } 
else { ?>
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
  <!-- box --> 
  <!-- /box-content --> 
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span><?php echo "Settings"; ?></span></h2>
    </div>
    <div class="box-content"> <?php echo form_open('setting/searchsetting',array('class'=>'formBox','id'=>'frmsearch')); ?>
      <fieldset>
        <!-- Error form message -->
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="keysearch">Keyword<span>*</span></label>
              </div>
              <div class="con"> <?php echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search setting by keyword','value'=>$this->uri->segment(3))); ?> </div>
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
      <?php echo form_close(); ?> </div>
    
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
    <?php if( count($settings) > 0 ) { ?>
    <!-- table -->
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <th>Title</th>
        <th>Value</th>
        <th class="action">Action</th>
      </tr>
      <?php for($i=0;$i<count($settings);$i++) { ?>
      <tr>
        <td><?php echo stripslashes($settings[$i]['fieldname']); ?></td>
        <td><?php echo nl2br(stripslashes($settings[$i]['value'])); ?></td>
        <td class="action" align="center"><a href="<?php echo site_url('setting/edit/'.$settings[$i]['intid']); ?>" title="Edit" class="ico ico-edit" style="margin:3px 15px 0;">Edit</a></td>
      </tr>
      <?php } ?>
    </table>
    <!-- /table -->
    <?php } else { ?>
    <div class="form-message warning">
      <p>No records found.</p>
    </div>
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