<?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'view' ) ) { ?>
<!-- box -->
<div class="box">
    <!-- table -->
    <table class="tab">
    <?php if( count($faq)>0 ) { ?>
    <tr>
        <th valign="top">Question</th>
        <td><?php echo nl2br(stripslashes($faq[0]['question'])) ?></td>
    </tr>
    <tr>
        <th valign="top">Answer</th>
        <td><?php echo nl2br(stripslashes($faq[0]['answer'])) ?></td>
    </tr>
    <?php } else { ?>
    <!-- Warning form message -->
    <div class="form-message warning"><p>No record found.</p></div>
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
	
			if( trim($("#question").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#queerror").show();
				$("#question").val('').focus();
				return false;
			}
			else
			{
				$("#queerror").hide();
			}
			
			if( trim($("#answer").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#anserror").show();
				$("#answer").val('').focus();
				return false;
			}
			else
			{
				$("#anserror").hide();
			}
			
			if( $("#frmfaq").submit() )
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
   <li><a href="<?php echo site_url('faq');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
   <li><?php if($this->uri->segment(2) == 'add'){echo 'Add FAQ';} else if($this->uri->segment(2) == 'edit') {echo 'Edit FAQ'; }?></li>
</ul>
</div>
<!-- /breadcrumbs -->

<?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'edit' ) ) { ?>
<!-- box -->
<div class="box">
    
    <div class="headlines">
    	<h2><span>
		<?php if($this->uri->segment(2) == 'add') {echo "Add FAQ"; } ?>
        <?php if($this->uri->segment(2) == 'edit') { echo "Edit FAQ"; } ?>
        </span></h2>
	</div>
    <div class="box-content">
    <?php echo form_open('faq/update',array('class'=>'formBox','id'=>'frmfaq')); ?>
    <fieldset>
    
    <div class="clearfix">
          <div class="lab">
            <label for="question">Question <span class="errorsign">*</span></label>
          </div>
          <div class="con">
            <?php if($this->uri->segment(2) == 'add') { ?>
            <?php echo form_input( array( 'name'=>'question','id'=>'question','class'=>'input','type'=>'text' ) ); ?>
            <?php } ?>
            <?php if($this->uri->segment(2) == 'edit') { ?>
            <?php echo form_input( array( 'name'=>'question','id'=>'question','class'=>'input','type'=>'text','value'=>stripslashes($faq[0]['question']) )); ?>
            <?php } ?>
          </div>
          <div id="queerror" class="error" style="width:auto">Question is required.</div>

    </div>
    <div class="clearfix">
        <div class="lab"><label for="answer">Answer <span class="errorsign">*</span></label></div>
        <div class="con">
        <?php if($this->uri->segment(2) == 'add') { ?>
        <?php echo form_textarea( array( 'name'=>'answer','id'=>'answer','class'=>'textarea','rows'=>'4','cols'=>'15'));?>
        <?php } ?>
        <?php if($this->uri->segment(2) == 'edit') { ?>
        <?php echo form_textarea( array( 'name'=>'answer','id'=>'answer','class'=>'textarea','rows'=>'4','cols'=>'15','value'=>stripslashes($faq[0]['answer']) ) ); ?>
        <?php } ?>
        </div>
        <div id="anserror" class="error" style="width:auto">Answer is required.</div>

    </div>
    <div class="btn-submit">
        <!-- Submit form -->
        <?php if($this->uri->segment(2) == 'add') { ?>
        <?php echo form_input(array('name'=>'btnsubmit','id'=>'btnsubmit','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
        <?php } ?>
        <?php if($this->uri->segment(2) == 'edit') { ?>
        <?php echo form_input(array('name'=>'btnupdate','id'=>'btnupdate','class'=>'button','type'=>'submit','value'=>'Update')); ?>
        <?php } ?>
        or <a href="<?php echo site_url('faq');?>" class="Cancel">Cancel</a>
    </div>
    
    </fieldset>
    <?php if($this->uri->segment(2) == 'edit') { ?>     
    <?php echo form_hidden( array( 'id' => $this->encrypt->encode($faq[0]['id']) ) ); ?>
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
	    <h2><span><?php echo 'FAQs'; ?></span></h2>
    </div>
    <div class="box-content"> <?php echo form_open('faq/searchfaq',array('class'=>'formBox','id'=>'frmsearch')); ?>
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
			  			echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search FAQ by keyword','value'=>$this->uri->segment(3)));
				}
				else
				{
					echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search FAQ by keyword'));
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
    
	<?php if( count($faqs) > 0 ) { ?>
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
        <th width="40%">Question</th>
        <th width="40%">Answer</th>
        <th width="7%">Status</th>
        <th width="13%">Action</th>
    </tr>
    <?php for($i=0;$i<count($faqs);$i++) { ?>
    <tr>
	   	<td><?php echo stripslashes($faqs[$i]['question']); ?></td>
      <td><?php echo substr(stripslashes($faqs[$i]['answer']),0,100)."..."; ?></td>
      <td><?php if( stripslashes($faqs[$i]['status']) == 'Enable' ) { ?>
          <a href="<?php echo site_url('faq/disable/'.$faqs[$i]['id']);?>" title="Click to Disable" class="btn btn-small btn-success" onClick="return confirm('Are you sure to Disable this FAQ?');" style="cursor:pointer">Enable</a>
          <?php } ?>
          <?php if( stripslashes($faqs[$i]['status']) == 'Disable' ) { ?>
          <a href="<?php echo site_url('faq/enable/'.$faqs[$i]['id']);?>" title="Click to Enable" class="btn btn-small btn-info" style="cursor:pointer" onClick="return confirm('Are you sure to Enable this FAQ?');"><span style="color: #CD0B1C;">Disable</span></a>
          <?php } ?></td>
  	<td style="padding: 8px 4px;"><a href="<?php echo site_url('faq/edit/'.$faqs[$i]['id']); ?>" title="Edit" class="ico ico-edit">Edit</a>
        <a href="<?php echo site_url('faq/delete/'.$faqs[$i]['id']);?>" title="Delete" class="ico ico-delete" onClick="return confirm('Are you sure to Delete this FAQ?');">Delete</a>
        <a href="<?php echo site_url('faq/view/'.$faqs[$i]['id']); ?>" title="View Detail" class="colorbox"><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a></td>
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