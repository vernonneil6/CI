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
			
			if( $("#frmhomesetting").submit() )
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
      <li><a href="<?php echo site_url('homesetting');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
      <li>
        <?php if($this->uri->segment(2) == 'add'){echo 'Add Home Page Setting';} else if($this->uri->segment(2) == 'edit') {echo 'Edit Home Page Setting'; }?>
      </li>
    </ul>
  </div>
  <!-- /breadcrumbs -->
  
  <?php if( $this->uri->segment(2) && $this->uri->segment(2) == 'edit' ) { ?>
  
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span>Edit Home Page Setting</span></h2>
    </div>
    <div class="box-content"> <?php echo form_open('homesetting/update',array('class'=>'formBox','id'=>'frmhomesetting')); ?>
      <fieldset>
        <div class="clearfix" style="width: 100% !important;">
          <div class="lab" style="width: 15% !important; padding-bottom:5px">
            <label for="txtvalue"><?php echo $homesettings[0]['fieldname']; ?><span class="errorsign"> *</span></label>
          </div>
          <?php if($homesettings[0]['id'] == '8') { ?>
          <div class="con" style="width: 70% !important; text-align:justify; float:left;"> <?php echo form_input( array( 'name'=>'txtvalue','id'=>'txtvalue','class'=>'input','type'=>'text','value'=>stripslashes($homesettings[0]['value']),'placeholder'=>'Just enter any youtube video url' ) ); ?> </div>
          <?php } else{ ?>
          <div class="con" style="width: 70% !important; text-align:justify; float:left;"> <?php echo form_input( array( 'name'=>'txtvalue','id'=>'txtvalue','class'=>'input','type'=>'text','value'=>stripslashes($homesettings[0]['value']) ) ); ?> </div>
          <?php } ?>
          <div id="txtvalueerror" class="error" style="width:auto"><?php echo $homesettings[0]['fieldname']; ?> field is required.</div>
        </div>
        <div class="btn-submit"> 
          <!-- Submit form --> 
          <?php echo form_input(array('name'=>'btnupdate','id'=>'btnupdate','class'=>'button','type'=>'submit','value'=>'Update','style'=>'margin-left:-30px;')); ?> or <a href="<?php echo site_url('homesetting');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php echo form_hidden( array( 'txtintid' => $this->encrypt->encode($homesettings[0]['intid']) ) ); ?> <?php echo form_close(); ?> </div>
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
  <div class="box">
    <div class="headlines">
      <h2><span><?php echo "Home Page Settings"; ?></span></h2>
    </div>
    <div class="box-content"> <?php echo form_open('homesetting/searchhomesetting',array('class'=>'formBox','id'=>'frmsearch')); ?>
      <fieldset>
        <!-- Error form message -->
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="keysearch">Keyword<span>*</span></label>
              </div>
              <div class="con"> <?php echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search home setting by keyword','value'=>$this->uri->segment(3))); ?> </div>
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
    <?php if( count($homesettings) > 0 ) { ?>
    <!-- table -->
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <th>Title</th>
        <th>Value</th>
        <th class="action">Action</th>
      </tr>
      <?php for($i=0;$i<count($homesettings);$i++) { ?>
      <tr>
        <td><?php echo stripslashes($homesettings[$i]['fieldname']); ?></td>
        <td><?php echo nl2br(stripslashes($homesettings[$i]['value'])); ?></td>
        <td class="action" align="center"><a href="<?php echo site_url('homesetting/edit/'.$homesettings[$i]['intid']); ?>" title="Edit" class="ico ico-edit" style="margin:3px 15px 0;">Edit</a></td>
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