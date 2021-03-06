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
			
			if( trim($("#footerposition").val()) == 0 )
			{
				$("#error").attr('style','display:block;');
				$("#positionerror").show();
				$("#footerposition").val('').focus();
				return false;
			}
			else
			{
				$("#positionerror").hide();
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
				echo form_textarea( array( 'name'=>'pagecontent','id'=>'pagecontent','class'=> 'tinymce','value'=> stripslashes($page[0]['pagecontent']),'style'=>'width:900px' ) );
			}
			else
			{
				echo form_textarea( array( 'name'=>'pagecontent','id'=>'pagecontent','class'=> 'textarea tinymce','value'=> stripslashes($page[0]['pagecontent']),'style'=>'width:200px','rows'=>'4','cols'=>'15' ) );
			}
		?>
          </div>
          <div id="pageconterror" class="error" style="width:auto;">Page Content is required.</div>
        </div>
        
        <div class="form-cols">
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 20% !important;">
                <label for="heading">Category</label>
              </div>
              <div class="con" style="width: 77% !important; float:left">
                <?php 
                if($this->session->userdata('siteid')==1)
                {
					$option = array(
					'1' => 'YOU GOT RATED GUIDE',
					'2' => 'COMPLAINT REPORTS',
					'3' => 'MERCHANT INFORMATION',
					'4' => 'COPYRIGHTS',
					);
				}
				else
				{
					$option = array(
					'1' => 'Column1',
					'2' => 'Column2',
					'3' => 'Column3',
					'4' => 'Column4',
					);
				}
                
                $class = 'class = "input"';
				echo form_dropdown( 'footercategory', $option, $page[0]['id'], $class ) ;
				?>
              </div>
            </div>
          </div>
        </div>
        
        
        <div class="form-cols">
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 20% !important;">
                <label for="heading">Position</label>
              </div>
              <div class="con" style="width: 77% !important; float:left">
                <?php 
               
                 $range = range(0, 25);
                $class = 'id = "footerposition" class = "input"';
				echo form_dropdown( 'footerposition', $range, $page[0]['position'], $class ) ;
				?>
              </div>
            </div>
          </div>
        </div>
        <div id="positionerror" class="error" style="width:auto;">Position is required.</div>
        
        <div class="btn-submit" style="padding: 15px 0 0 22%;"> 
          <!-- Submit form --> 
          <?php echo form_input(array('name'=>'btnupdate','id'=>'btnupdate','class'=>'button','type'=>'submit','value'=>'Update')); ?> or <a href="<?php echo site_url('page');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php echo form_hidden( array( 'txtintid' => $this->encrypt->encode($page[0]['intid']) ) ); ?> <?php echo form_close(); ?> </div>
  </div>
  <!-- /box-content -->
  
  <?php } 
  
  
  
  
 else if($this->uri->segment(2) && ( $this->uri->segment(2) == 'add') ) { ?>
  
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
				echo form_textarea( array( 'name'=>'pagecontent','id'=>'pagecontent','class'=> 'tinymce','style'=>'width:900px' ) );
		  ?>
          </div>
          <div id="pageconterror" class="error" style="width:auto;">Page Content is required.</div>
        </div>
        
        <div class="form-cols">
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 20% !important;">
                <label for="heading">Category</label>
              </div>
              <div class="con" style="width: 77% !important; float:left">
                <?php 
                if($this->session->userdata('siteid')==1)
                {
					$option = array(
					'1' => 'YOU GOT RATED GUIDE',
					'2' => 'COMPLAINT REPORTS',
					'3' => 'MERCHANT INFORMATION',
					'4' => 'COPYRIGHTS',
					);
				}
				else
				{
					$option = array(
					'1' => 'Column1',
					'2' => 'Column2',
					'3' => 'Column3',
					'4' => 'Column4',
					);
				}
                
                $class = 'class = "input"';
				echo form_dropdown( 'footercategory', $option, '1', $class ) ;
				?>
              </div>
            </div>
          </div>
        </div>
        
         <div class="form-cols">
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 20% !important;">
                <label for="heading">Category</label>
              </div>
              <div class="con" style="width: 77% !important; float:left">
                <?php 
                $range = range(0, 25);
                $class = 'id = "footerposition" class = "input"';
                
				echo form_dropdown( 'footerposition', $range, '0', $class ) ;
				?>
              </div>
            </div>
          </div>
        </div>
        
        
        
        <div class="btn-submit" style="padding: 15px 0 0 22%;"> 
          <!-- Submit form --> 
          <?php echo form_input(array('name'=>'btnupdate','id'=>'btnupdate','class'=>'button','type'=>'submit','value'=>'Add')); ?> or <a href="<?php echo site_url('page');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php echo form_close(); ?> </div>
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
        <th>Section</th>
        <th>Title</th>
        <th>Heading</th>
        <th>Status</th>
        <th>Position</th>
        <th>Action</th>
      </tr>
      <?php for($i=0;$i<count($pages);$i++) { ?>
      <tr>
        <td>
			<?php 
			if($this->session->userdata('siteid')==1)
			{
				$option = array(
				'1' => 'YOU GOT RATED GUIDE',
				'2' => 'COMPLAINT REPORTS',
				'3' => 'MERCHANT INFORMATION',
				'4' => 'COPYRIGHTS',
				);
			}
			else
			{
				$option = array(
				'1' => 'Column1',
				'2' => 'Column2',
				'3' => 'Column3',
				'4' => 'Column4',
				);
			}
              foreach ($option as $key => $value) 
              {
					if($pages[$i]['id'] == $key)
					{
						echo $value; 
					}
				}
            ?>
        </td>
        <td><a href="<?php echo site_url('page/view/'.$pages[$i]['intid']); ?>" title="View Detail of <?php echo stripslashes($pages[$i]['title']);?>" class="colorbox" style="color: #404040;"><?php echo stripslashes($pages[$i]['title']); ?></a></td>
        <td><?php echo stripslashes($pages[$i]['heading']); ?></td>
        <td>
          
          <?php if( stripslashes($pages[$i]['status']) == 'Enable' ) { ?>
          <a href="<?php echo site_url('page/disable/'.$pages[$i]['intid']);?>" title="Click to Disable" class="btn btn-small btn-success" onClick="return confirm('Are you sure to Disable this page?');"><span>Enable</span></a>
          <?php } ?>
          <?php if( stripslashes($pages[$i]['status']) == 'Disable' ) { ?>
          <a href="<?php echo site_url('page/enable/'.$pages[$i]['intid']);?>" title="Click to Enable" class="btn btn-small btn-info" style="cursor:default; color: #CD0B1C;" onClick="return confirm('Are you sure to Enable this page?');"><span>Disable</span></a>
          <?php } ?>
        
        </td>
        <td><?php echo $pages[$i]['position']; ?></td>
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

<script type="text/javascript" src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'] ?>/admincp/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea.tinymce",
    theme: "modern",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons",
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ]
});
</script>
