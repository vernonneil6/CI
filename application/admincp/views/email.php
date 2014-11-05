<?php echo $header; ?>

<!-- #content -->

<div id="content">
  <?php if( $this->uri->segment(2) == 'edit' ) { ?>
  <style>
	.variable_box
	{
		background: none repeat scroll 0 0 #F6F6F6;
		border: 1px solid #CCCCCC;
		border-radius: 5px 5px 5px 5px;
		margin: 10px 0;
		padding: 1% 0;
	}
	.variable_box span
	{
		color: #666666;
		display: block;
		float: left;
		font-weight: bold;
		padding: 5px;
	}
	.variable_box p
	{
		padding:5px;
	}
</style>
  <script type="text/javascript" language="javascript">
	function trim(stringToTrim) {
		return stringToTrim.replace(/^\s+|\s+$/g,"");
	}
	$(document).ready(function() {
		
		$("#btnupdate").click(function () {
	
			if( trim($("#txttitle").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#txttitle").val('').focus();
				$("#titleerror").show();
				return false;
			}
			else
			{
				$("#titleerror").hide();
			}
			
			if( trim($("#txtsubject").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#subjerror").show();
				$("#txtsubject").val('').focus();
				return false;
			}
			else
			{
				$("#subjerror").hide();
			}
						
    	});
	
	});
</script>
  <?php } ?>
  
  <!-- breadcrumbs -->
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('email');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
      <li>
        <?php if($this->uri->segment(2) == 'add'){echo 'Add Email Format';} else if($this->uri->segment(2) == 'edit') {echo 'Edit Email Format'; }?>
      </li>
    </ul>
  </div>
  <!-- /breadcrumbs -->
  
  <?php if($this->uri->segment(2) && ( $this->uri->segment(2) == 'edit') ) { ?>
  
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span>Edit Email Format</span></h2>
    </div>
    <div class="box-content"> <?php echo form_open('email/update',array('class'=>'formBox','id'=>'frmemail')); ?>
      <fieldset>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 17% !important;">
                <label for="txttitle">Title <span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width: 80% !important;">
                <?php 
				echo form_input( array( 'name'=>'txttitle','id'=>'txttitle','class'=>'input','type'=>'text','value'=>stripslashes($email[0]['title']) ) ); 
				?>
              </div>
            </div>
          </div>
          <div id="titleerror" class="error" style="padding-bottom:10px; width:auto; padding-top:0">Title is required.</div>
        </div>
        <div class="form-cols">
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 17% !important;">
                <label for="txtsubject">Subject <span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width: 80% !important;">
                <?php 
				echo form_input( array( 'name'=>'txtsubject','id'=>'txtsubject','class'=>'input','type'=>'text','value'=>stripslashes($email[0]['subject']) ) );
				?>
              </div>
            </div>
          </div>
          <div id="subjerror" class="error" style="padding-bottom:10px; width:auto; padding-top:0">Subject is required.</div>
        </div>
        <div class="clearfix">
          <div class="lab" style="width:17%">
            <label>Email Variables</label>
          </div>
          <div class="con" style="color:#CD0B1C; background:#E3E3E3; width:80%"> <span style="font-weight:bold;">You can use following variables in your mail which will be replaced with its actual value in mail.</span><br />
            <br />
            <p><span><?php echo nl2br(stripslashes($email[0]['variables'])); ?></span></p>
          </div>
        </div>
        <div class="clearfix">
          <div class="lab">
            <label for="txtmailformat">Email</label>
          </div>
          <div class="con" style="width:80%">
            <?php 
		echo form_textarea( array( 'name'=>'txtmailformat','id'=>'txtmailformat','class'=> 'cleditor','rows'=>'12','cols'=>'20','value'=> stripslashes($email[0]['mailformat']) ) );
		echo display_ckeditor($ckeditor);
		?>
          </div>
          <div id="emailerror" class="error" style="padding-bottom:10px; width:auto">Email is required.</div>
        </div>
        <div class="btn-submit" style="padding: 15px 0 0 20%;"> 
          <!-- Submit form --> 
          <?php echo form_input(array('name'=>'btnupdate','id'=>'btnupdate','class'=>'button','type'=>'submit','value'=>'Update')); ?> or <a href="<?php echo site_url('email');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php echo form_hidden( array( 'txtintid' => $this->encrypt->encode($email[0]['id']) ) ); ?> <?php echo form_close(); ?> </div>
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
      <h2><span><?php echo "Email Formats" ?></span></h2>
    </div>
    <div class="box-content"> <?php echo form_open('email/searchemail',array('class'=>'formBox','id'=>'frmsearch')); ?>
      <fieldset>
        <!-- Error form message -->
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="keysearch">Keyword<span>*</span></label>
              </div>
              <div class="con"> <?php echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search Email by keyword','value'=>$this->uri->segment(3))); ?> </div>
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
    <?php if( count($emails) > 0 ) { ?>
    <!-- table -->
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <th>Title</th>
        <th>Subject</th>
        <th>Action</th>
      </tr>
      <?php for($i=0;$i<count($emails);$i++) { ?>
      <tr>
        <td><?php echo stripslashes($emails[$i]['title']); ?></td>
        <td><?php echo stripslashes($emails[$i]['subject']); ?></td>
        <td><a href="<?php echo site_url('email/edit/'.$emails[$i]['id']); ?>" title="Edit" class="ico ico-edit" style="margin:3px 15px 0;">Edit</a></td>
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