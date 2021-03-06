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
			
			if( $("#frmseo").submit() )
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
      <li><a href="<?php echo site_url('seo');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
      <li>
        <?php if($this->uri->segment(2) == 'add'){echo 'Add SEO';} else if($this->uri->segment(2) == 'edit') {echo 'Edit SEO'; }?>
      </li>
    </ul>
  </div>
  <!-- /breadcrumbs -->
  
  <?php if( $this->uri->segment(2) && $this->uri->segment(2) == 'edit' ) { ?>
  
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span>Edit SEO</span></h2>
    </div>
    <div class="box-content"> <?php echo form_open('seo/update',array('class'=>'formBox','id'=>'frmseo')); ?>
      <fieldset>
        <div class="clearfix" style="width: 100% !important;">
          <div class="lab" style="width: auto; padding-bottom:5px">
            <label for="txtvalue"><?php echo $seo[0]['fieldname']; ?><span class="errorsign"> *</span></label>
          </div>
          <div class="con" style="width: 99% !important; text-align:justify; float:left;">
            <?php if($seo[0]['id'] == 3) {?>
            <?php echo form_input( array( 'name'=>'txtvalue','id'=>'txtvalue','class'=>'input','type'=>'text','value'=>stripslashes($seo[0]['value']) ) ); } else {?> <?php echo form_textarea( array( 'name'=>'txtvalue','id'=>'txtvalue','class'=>'textarea','rows'=>'4','cols'=>'15','value'=>stripslashes($seo[0]['value']),'style'=>'height:225px' ) ); ?>
            <?php } ?>
          </div>
          <div id="txtvalueerror" class="error" style="width:auto"><?php echo $seo[0]['fieldname']; ?> field is required.</div>
        </div>
        <div class="btn-submit"> 
          <!-- Submit form --> 
          <?php echo form_input(array('name'=>'btnupdate','id'=>'btnupdate','class'=>'button','type'=>'submit','value'=>'Update')); ?> or <a href="<?php echo site_url('seo');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php echo form_hidden( array( 'txtintid' => $this->encrypt->encode($seo[0]['intid']) ) ); ?> <?php echo form_close(); ?> </div>
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
      <h2><span><?php echo "SEOs" ?></span></h2>
    </div>
    <div class="box-content"> <?php echo form_open('seo/searchseo',array('class'=>'formBox','id'=>'frmsearch')); ?>
      <fieldset>
        <!-- Error form message -->
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="keysearch">Keyword<span>*</span></label>
              </div>
              <div class="con"> <?php echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search seo by keyword','value'=>$this->uri->segment(3))); ?> </div>
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
    <?php if( count($seos) > 0 ) { ?>
    <!-- table -->
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <th>Title</th>
        <!--  <th>Value</th>-->
        <th class="action">Action</th>
      </tr>
      <?php for($i=0;$i<count($seos);$i++) { ?>
      <tr>
        <td><?php echo stripslashes($seos[$i]['fieldname']); ?></td>
        <td class="action"><a href="<?php echo site_url('seo/edit/'.$seos[$i]['intid']); ?>" title="Edit" class="ico ico-edit" style="margin:3px 15px 0;">Edit</a></td>
      </tr>
      <?php } ?>
    </table>
    <!-- /table -->
    <?php } ?>
    
    <!-- /pagination -->
    <?php  if($this->pagination->create_links()) { ?>
    <div class="pagination"> <?php echo $this->pagination->create_links(); ?> </div>
    <?php } ?>
    <!-- /pagination --> 
    
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