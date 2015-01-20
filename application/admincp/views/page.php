<?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'view' ) ) { ?>
<!-- box -->

<div class="box">
  <div class="headlines">
    <h2><span>Page Detail</span></h2>
  </div>
  <!-- table -->
  <table align="center" width="100%" cellspacing="10" cellpadding="0" border="0">
    <?php if( count($page)>0 ) { ?>
    <tr>
      <td width="120"><b>Page Title</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($page[0]['title']); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Page heading</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($page[0]['heading']); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Meta Keywords</b></td>
      <td><b>:</b></td>
      <td style="text-align:justify"><?php echo nl2br(stripslashes($page[0]['metakeywords'])); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Meta Description</b></td>
      <td><b>:</b></td>
      <td style="text-align:justify"><?php echo nl2br(stripslashes($page[0]['metadescription'])); ?></td>
    </tr>
    <tr>
      <td width="120" valign="top"><b>Page Contents</b></td>
      <td style="vertical-align:top"><b>:</b></td>
      <td <?php if($page[0]['pagecontent'] != ''){?>style="text-align:justify; background:#EEEEEE;vertical-align:top" <?php } ?>colspan="3"><?php echo nl2br(stripslashes($page[0]['pagecontent'])); ?></td>
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
<?php echo $heading; ?> <?php echo link_tag('colorbox/colorbox.css'); ?> 
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>colorbox/jquery.colorbox.js"></script> 
<script language="javascript" type="text/javascript">
  $(document).ready(function(){
		$('.colorbox').colorbox({'width':'55%'});
	
  });
</script> 

<!-- #content -->
<div id="content">
  <?php if( $this->uri->segment(2) == 'edit' ) { ?>
  <script type="text/javascript" language="javascript">
	function trim(stringToTrim) {
		return stringToTrim.replace(/^\s+|\s+$/g,"");
	}
	$(document).ready(function() {
		
		$("#btnupdate").click(function () {
	
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
			
			if( trim($("#heading").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#headingerror").show();
				$("#heading").val('').focus();
				return false;
			}
			else
			{
				$("#headingerror").hide();
			}
			
			if( trim($("#metakeywords").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#metakeyerror").show();
				$("#metakeywords").val('').focus();
				return false;
			}
			else
			{
				$("#metakeyerror").hide();
			}
			
			if( trim($("#metadescription").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#metadeserror").show();
				$("#metadescription").val('').focus();
				return false;
			}
			else
			{
				$("#metadeserror").hide();
			}
			
			if( $("#frmpage").submit() )
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
      <li><a href="<?php echo site_url('page');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
      <li>
        <?php if($this->uri->segment(2) == 'add'){echo 'Add Page';} else if($this->uri->segment(2) == 'edit') {echo 'Edit Page'; }?>
      </li>
    </ul>
  </div>
  <!-- /breadcrumbs -->
  
  <?php if($this->uri->segment(2) && ( $this->uri->segment(2) == 'edit') ) { ?>
  
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span>Edit Page</span></h2>
    </div>
    <div class="box-content"> <?php echo form_open('page/update',array('class'=>'formBox','id'=>'frmpage')); ?>
      <fieldset>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 20% !important;">
                <label for="title">Title <span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width: 77% !important; float:left">
                <?php 
				echo form_input( array( 'name'=>'title','id'=>'title','class'=>'input','type'=>'text','value'=>stripslashes($page[0]['title']) ) ); 
				?>
              </div>
            </div>
          </div>
          <div id="titleerror" class="error" style="width:auto;">Page Title is required.</div>
        </div>
        <div class="form-cols">
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 20% !important;">
                <label for="heading">Heading <span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width: 77% !important; float:left">
                <?php 
				echo form_input( array( 'name'=>'heading','id'=>'heading','class'=>'input','type'=>'text','value'=>stripslashes($page[0]['heading']) ) );
				?>
              </div>
            </div>
          </div>
          <div id="headingerror" class="error" style="width:auto;">Page heading is required.</div>
        </div>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1" style="width: 100% !important;">
            <div class="clearfix">
              <div class="lab" style="width: 20% !important; padding-bottom:5px">
                <label for="metakeywords">Meta Keywords <span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width: 77% !important; text-align:justify; float:left;">
                <?php 
					echo form_textarea( array( 'name'=>'metakeywords','id'=>'metakeywords','class'=>'textarea','rows'=>'4','cols'=>'15','value'=>stripslashes($page[0]['metakeywords']) ) ); 
				?>
              </div>
            </div>
          </div>
          <div id="metakeyerror" class="error" style="width:auto;">Meta Keywords are required.</div>
        </div>
        <div class="form-cols">
          <div class="col1" style="width: 100% !important;">
            <div class="clearfix">
              <div class="lab" style="width: 20% !important; padding-bottom:5px;">
                <label for="metadescription">Meta Description <span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width: 77% !important; text-align:justify; float:left;">
                <?php 
				echo form_textarea( array( 'name'=>'metadescription','id'=>'metadescription','class'=>'textarea','rows'=>'4','cols'=>'15','value'=>stripslashes($page[0]['metadescription']) ) );
				?>
              </div>
            </div>
          </div>
          <div id="metadeserror" class="error" style="width:auto;">Meta Description is required.</div>
        </div>
        <div class="clearfix">
          <div class="lab" style="padding-bottom:5px; width:20%">
            <label for="pagecontent">Page Content</label>
          </div>
          <div class="con" style="float:left; width:77%">
            <?php 
			if($this->uri->segment(3) < 177 || $this->uri->segment(3)>192)
			 { 
				echo form_textarea( array( 'name'=>'pagecontent','id'=>'pagecontent','class'=> 'cleditor','value'=> stripslashes($page[0]['pagecontent']),'style'=>'width:900px' ) );
				echo display_ckeditor($ckeditor);
			}
			else
			{
				echo form_textarea( array( 'name'=>'pagecontent','id'=>'pagecontent','class'=> 'textarea','value'=> stripslashes($page[0]['pagecontent']),'style'=>'width:200px','rows'=>'4','cols'=>'15' ) );
			}
		?>
          </div>
          <div id="pageconterror" class="error" style="width:auto;">Page Content is required.</div>
        </div>
        <div class="btn-submit" style="padding: 15px 0 0 22%;"> 
          <!-- Submit form --> 
          <?php echo form_input(array('name'=>'btnupdate','id'=>'btnupdate','class'=>'button','type'=>'submit','value'=>'Update')); ?> or <a href="<?php echo site_url('page');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php echo form_hidden( array( 'txtintid' => $this->encrypt->encode($page[0]['intid']) ) ); ?> <?php echo form_close(); ?> </div>
  </div>
  <!-- /box-content -->
  
  <?php } 
  
  
  
  
 if($this->uri->segment(2) && ( $this->uri->segment(2) == 'add') ) { ?>
  
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span>Edit Page</span></h2>
    </div>
    <div class="box-content"> <?php echo form_open('page/add',array('class'=>'formBox')); ?>
      <fieldset>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 20% !important;">
                <label for="title">Title <span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width: 77% !important; float:left">
                <?php 
				echo form_input( array( 'name'=>'title','id'=>'title','class'=>'input','type'=>'text' ) ); 
				?>
              </div>
            </div>
          </div>
          <div id="titleerror" class="error" style="width:auto;">Page Title is required.</div>
        </div>
        <div class="form-cols">
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 20% !important;">
                <label for="heading">Heading <span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width: 77% !important; float:left">
                <?php 
				echo form_input( array( 'name'=>'heading','id'=>'heading','class'=>'input','type'=>'text' ) );
				?>
              </div>
            </div>
          </div>
          <div id="headingerror" class="error" style="width:auto;">Page heading is required.</div>
        </div>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1" style="width: 100% !important;">
            <div class="clearfix">
              <div class="lab" style="width: 20% !important; padding-bottom:5px">
                <label for="metakeywords">Meta Keywords <span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width: 77% !important; text-align:justify; float:left;">
                <?php 
					echo form_textarea( array( 'name'=>'metakeywords','id'=>'metakeywords','class'=>'textarea','rows'=>'4','cols'=>'15' ) ); 
				?>
              </div>
            </div>
          </div>
          <div id="metakeyerror" class="error" style="width:auto;">Meta Keywords are required.</div>
        </div>
        <div class="form-cols">
          <div class="col1" style="width: 100% !important;">
            <div class="clearfix">
              <div class="lab" style="width: 20% !important; padding-bottom:5px;">
                <label for="metadescription">Meta Description <span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width: 77% !important; text-align:justify; float:left;">
                <?php 
				echo form_textarea( array( 'name'=>'metadescription','id'=>'metadescription','class'=>'textarea','rows'=>'4','cols'=>'15' ) );
				?>
              </div>
            </div>
          </div>
          <div id="metadeserror" class="error" style="width:auto;">Meta Description is required.</div>
        </div>
        <div class="clearfix">
          <div class="lab" style="padding-bottom:5px; width:20%">
            <label for="pagecontent">Page Content</label>
          </div>
          <div class="con" style="float:left; width:77%">
            <?php 
			if($this->uri->segment(3) < 177 || $this->uri->segment(3)>192)
			 { 
				echo form_textarea( array( 'name'=>'pagecontent','id'=>'pagecontent','class'=> 'cleditor','style'=>'width:900px' ) );
				echo display_ckeditor($ckeditor);
			}
			else
			{
				echo form_textarea( array( 'name'=>'pagecontent','id'=>'pagecontent','class'=> 'textarea','style'=>'width:200px','rows'=>'4','cols'=>'15' ) );
			}
		?>
          </div>
          <div id="pageconterror" class="error" style="width:auto;">Page Content is required.</div>
        </div>
        <div class="btn-submit" style="padding: 15px 0 0 22%;"> 
          <!-- Submit form --> 
          <?php echo form_input(array('name'=>'btnupdate','id'=>'btnupdate','class'=>'button','type'=>'submit','value'=>'Add')); ?> or <a href="<?php echo site_url('page');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php echo form_hidden( array( 'txtintid' => $this->encrypt->encode($page[0]['intid']) ) ); ?> <?php echo form_close(); ?> </div>
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
      <h2><span><?php echo "Pages"; ?></span></h2>
    </div>
    <div class="box-content"> <?php echo form_open('page/searchpage',array('class'=>'formBox','id'=>'frmsearch')); ?>
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
			  echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search Page by keyword','value'=>$this->uri->segment(3)));
			  }
			  else
			  {
			  	echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search Page by keyword'));
			  }?>
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
    <?php if( count($pages) > 0 ) { ?>
    <!-- table -->
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <th>Title</th>
        <th>Heading</th>
        <th>Action</th>
      </tr>
      <?php for($i=0;$i<count($pages);$i++) { ?>
      <tr>
        <td><a href="<?php echo site_url('page/view/'.$pages[$i]['intid']); ?>" title="View Detail of <?php echo stripslashes($pages[$i]['title']);?>" class="colorbox" style="color: #404040;"><?php echo stripslashes($pages[$i]['title']); ?></a></td>
        <td><?php echo stripslashes($pages[$i]['heading']); ?></td>
        <td><a href="<?php echo site_url('page/edit/'.$pages[$i]['intid']); ?>" title="Edit" class="ico ico-edit">Edit</a> <a href="<?php echo site_url('page/view/'.$pages[$i]['intid']); ?>" title="View Detail of <?php echo stripslashes($pages[$i]['title']);?>" class="colorbox"><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a></td>
      </tr>
      <?php } ?>
    </table>
    <!-- /table --> 
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
<?php } ?>
