<?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'view' ) ) { ?>
<!-- box -->

<div class="box">
  <div class="headlines">
    <h2><span>Press Release Detail</span></h2>
  </div>
  <!-- table -->
  <table align="center" width="100%" cellspacing="10" cellpadding="0" border="0">
    <?php if( count($pressrelease)>0 ) { ?>
    <tr>
      <td width="120"><b>Title</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($pressrelease[0]['title']); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Sub Title</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($pressrelease[0]['subtitle']); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Meta Keywords</b></td>
      <td><b>:</b></td>
      <td style="text-align:justify"><?php echo nl2br(stripslashes($pressrelease[0]['metakeywords'])); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Meta Description</b></td>
      <td><b>:</b></td>
      <td style="text-align:justify"><?php echo nl2br(stripslashes($pressrelease[0]['metadescription'])); ?></td>
    </tr>
    <tr>
      <td width="120" valign="top"><b>Press Contents</b></td>
      <td style="vertical-align:top"><b>:</b></td>
      <td <?php if($pressrelease[0]['presscontent'] != ''){?>style="text-align:justify; background:#EEEEEE;vertical-align:top" <?php } ?>colspan="3"><?php echo nl2br(stripslashes($pressrelease[0]['presscontent'])); ?></td>
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
else {
echo $header; ?>
<!-- #content -->

<div id="content">
  <?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'edit' ) ) { ?>
  <script type="text/javascript">
	function chktitle(title)
	{
		
		if( title != '' )
		{
			$("#titleerror").hide();
			//Return from conroller in php code : echo json_encode(array("result"=>"exist"));
			$.ajax({
				type 				: "POST",
				url 				: "<?php echo site_url('pressrelease/fieldcheck'); ?>",
				data				:	{ <?php if($this->uri->segment(2) == 'edit' ) echo "'id' : ".$pressrelease[0]['id'].", "; ?>'title' : title },
				dataType 			: "json",
				cache				: false,
				success				: function(data){
												//alert(data.result); return false;
												if( data.result == 'old')
												{
													$("#titleerror").hide();
													$("#titletknerror").show();
													$("#title").val('').focus();
													return false;
												}
												else
												{
													$("#titletknerror").hide();
												}
											}
			});
		}
		else
		{
			$("#titletknerror").hide();
			$("#titleerror").show();
			$("#title").val('').focus();
			return false;
		}
	}
</script>
<script type="text/javascript">
	function chksubtitle(subtitle)
	{
		if( subtitle != '' )
		{
			$("#subtitleerror").hide();
			//Return from conroller in php code : echo json_encode(array("result"=>"exist"));
			$.ajax({
				type 				: "POST",
				url 				: "<?php echo site_url('pressrelease/fieldcheck'); ?>",
				data				:	{ <?php if($this->uri->segment(2) == 'edit' ) echo "'id' : ".$pressrelease[0]['id'].", "; ?>'subtitle' : subtitle },
				dataType 			: "json",
				cache				: false,
				success				: function(data){
												//alert(data.result); return false;
												if( data.result == 'old')
												{
													$("#subtitleerror").hide();
													$("#subtitletknerror").show();
													$("#subtitle").val('').focus();
													return false;
												}
												else
												{
													$("#subtitletknerror").hide();
												}
											}
			});
		}
		else
		{
			$("#subtitletknerror").hide();
			$("#subtitleerror").show();
			$("#subtitle").val('').focus();
			return false;
		}
	}
</script>
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
			if( trim($("#subtitle").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#subtitleerror").show();
				$("#subtitle").val('').focus();
				return false;
			}
			else
			{
				$("#subtitleerror").hide();
			}
			
			if( trim($("#sortdesc").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#sortdescerror").show();
				$("#sortdesc").val('').focus();
				return false;
			}
			else
			{
				$("#sortdescerror").hide();
			}
						
			if( trim($("#metakeywords").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#metakeywordserror").show();
				$("#metakeywords").val('').focus();
				return false;
			}
			else
			{
				$("#metakeywordserror").hide();
			}
			if( trim($("#metadescription").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#metadescriptionerror").show();
				$("#metadescription").val('').focus();
				return false;
			}
			else
			{
				$("#metadescriptionerror").hide();
			}
					
			if( $("#frmpressrelease").submit() )
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
      <li><a href="<?php echo site_url('pressrelease');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
      <li>
        <?php if($this->uri->segment(2) == 'add'){echo 'Add  Press Release';} else if($this->uri->segment(2) == 'edit') {echo 'Edit  Press Release'; }?>
      </li>
      
    </ul>
  </div>
  <!-- /breadcrumbs -->
  
  <?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'edit' ) ) { ?>
  
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span>
        <?php if($this->uri->segment(2) == 'add') { echo "Add  Press Release"; } ?>
        <?php if($this->uri->segment(2) == 'edit') { echo "Edit  Press Release"; } ?>
        </span></h2>
    </div>
    <div class="box-content"> <?php echo form_open_multipart('pressrelease/update',array('class'=>'formBox','id'=>'frmpressrelease')); ?>
      <fieldset>
		<div class="form-cols"><!-- two form cols -->
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 14% !important;">
                <label for="site">Site</label>
              </div>
              <div class="con" style="width: 59% !important; float:left">
				<?php 
					
				$options = array(
					'1'  => 'YouGotRated',
					'2'  => 'Bestratedseller',
					'3'  => 'Topsellerratings',
					'4'  => 'Business-reports-online',
					'5'  => 'Consumer-magazine-ratings',
					'6'  => 'Consumer-trusted-magazine',
					'7'  => 'Customer-feedback-central',
					'8'  => 'Merchant-informer',
					'9'  => 'Safe-merchants',
					'10' => 'Safe-online-shopper',
					'11' => 'Seller-ratings',
					'12' => 'Trusted-consumer-reports',
					'13' => 'Trusted-online-merchants',
					'14' => 'Verified-online-merchants',
					'15' => 'Verified-trusted-merchants',
					'16' => 'Your-business-report'
					);
				
				$class = 'class = "select"';
				
                if($this->uri->segment(2) == 'add') 
                { 
					echo form_dropdown('siteid', $options, '1', $class);
                } 
                
				if($this->uri->segment(2) == 'edit') 
				{ 
					echo form_dropdown('siteid', $options, $pressrelease[0]['websiteid'], $class);
                } 
                
                ?>
              </div>
            </div>
          </div>
        </div>
        
        <div class="form-cols"><!-- two form cols -->
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 14% !important;">
                <label for="title">Title <span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width: 59% !important; float:left">
                <?php if($this->uri->segment(2) == 'add') { ?>
                <input name="addpress" type="hidden" value="addpress" />
                <?php echo form_input( array( 'name'=>'title','id'=>'title','class'=>'input','type'=>'text','maxlength'=>'20','onchange'=>'chktitle(this.value)' ) ); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'title','id'=>'title','class'=>'input','type'=>'text','value'=>ucfirst(stripslashes($pressrelease[0]['title'])),'maxlength'=>'20','onchange'=>'chktitle(this.value)' ) ); ?>
                <?php } ?>
              </div>
              <div id="titleerror" class="error" style="width:95px">Title is required.</div>
              <div id="titletknerror" class="error" style="width:140px">Title already exists.</div>
            </div>
          </div>
        </div>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 14% !important;">
                <label for="sutitle">Sub Title <span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width: 59% !important; float:left">
                <?php if($this->uri->segment(2) == 'add') { ?>
                <?php echo form_input( array( 'name'=>'subtitle','id'=>'subtitle','class'=>'input','type'=>'text','onchange'=>'chksubtitle(this.value)' ) ); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'subtitle','id'=>'subtitle','class'=>'input','type'=>'text','value'=>ucfirst(stripslashes($pressrelease[0]['subtitle'])),'onchange'=>'chksubtitle(this.value)' ) ); ?>
                <?php } ?>
              </div>
              <div id="subtitleerror" class="error" style="width:135px">Sub Title is required.</div>
              <div id="subtitletknerror" class="error" style="width:140px">Subtitle already exists.</div>
            </div>
          </div>
        </div>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 14% !important;">
                <label for="sortdesc">Sort Description <span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width: 59% !important; text-align:justify; float:left;">
                <?php if($this->uri->segment(2) == 'add') { ?>
                <?php echo form_textarea( array( 'name'=>'sortdesc','id'=>'sortdesc','class'=>'textarea','rows'=>'4','cols'=>'15' ) ); ?>
                <?php } ?>
				<?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_textarea( array( 'name'=>'sortdesc','id'=>'sortdesc','class'=>'textarea','rows'=>'4','cols'=>'15','value'=>stripslashes($pressrelease[0]['sortdesc']) ) ); ?>
                <?php } ?>
              </div>
              <div id="sortdescerror" class="error" style="width:135px">Sort Description is required.</div>
            </div>
          </div>
        </div>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 14% !important;">
                <label for="title">Metakeywords <span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width: 59% !important; text-align:justify; float:left;">
                <?php if($this->uri->segment(2) == 'add') { ?>
                <?php echo form_textarea( array( 'name'=>'metakeywords','id'=>'metakeywords','class'=>'textarea','rows'=>'4','cols'=>'15' ) ); ?>
                <?php } ?>
				<?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_textarea( array( 'name'=>'metakeywords','id'=>'metakeywords','class'=>'textarea','rows'=>'4','cols'=>'15','value'=>stripslashes($pressrelease[0]['metakeywords']) ) ); ?>
                <?php } ?>
              </div>
              <div id="metakeywordserror" class="error" style="width:135px">Metakeywords is required.</div>
            </div>
          </div>
        </div>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 14% !important;">
                <label for="metadescription">Metadescription <span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width: 59% !important; text-align:justify; float:left;">
                <?php if($this->uri->segment(2) == 'add') { ?>
                <?php echo form_textarea( array( 'name'=>'metadescription','id'=>'metadescription','class'=>'textarea','rows'=>'4','cols'=>'15' ) ); ?>
                <?php } ?>
				<?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_textarea( array( 'name'=>'metadescription','id'=>'metadescription','class'=>'textarea','rows'=>'4','cols'=>'15','value'=>stripslashes($pressrelease[0]['metadescription']) ) ); ?>
                <?php } ?>
              </div>
              <div id="metadescriptionerror" class="error" style="width:135px">Metadescription is required.</div>
            </div>
          </div>
        </div>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 15% !important;">
                <label for="title">Press Content <span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width: 98% !important; float:left">
                <?php if($this->uri->segment(2) == 'add') { 
                      echo form_textarea( array( 'name'=>'presscontent','id'=>'presscontent','class'=> 'cleditor','style'=>'width:900px' ) );
					  echo display_ckeditor($ckeditor);
                } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php  echo form_textarea( array( 'name'=>'presscontent','id'=>'presscontent','class'=> 'cleditor','value'=> stripslashes($pressrelease[0]['presscontent']),'style'=>'width:900px' ) );
					  echo display_ckeditor($ckeditor); ?>
                <?php } ?>
              </div>
              
            </div>
          </div>
        </div>
        <div class="btn-submit"> 
          <!-- Submit form -->
          <?php if($this->uri->segment(2) == 'add') { ?>
          <?php echo form_input(array('name'=>'btnsubmit','id'=>'btnsubmit','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
          <?php } ?>
          <?php if($this->uri->segment(2) == 'edit') { ?>
          <?php echo form_input(array('name'=>'btnupdate','id'=>'btnupdate','class'=>'button','type'=>'submit','value'=>'Update')); ?>
          <?php } ?>
          or <a href="<?php echo site_url('pressrelease');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php if($this->uri->segment(2) == 'edit') { ?>
      <?php echo form_hidden( array( 'id' => $this->encrypt->encode($pressrelease[0]['id']) ) ); ?>
      <?php } ?>
      <?php echo form_close(); ?> </div>
  </div>
  <!-- /box-content -->
  
  <?php } 
else { ?>
   <?php echo link_tag('colorbox/colorbox.css'); ?> 
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>colorbox/jquery.colorbox.js"></script> 
<script language="javascript" type="text/javascript">
  $(document).ready(function(){
		$('.colorbox').colorbox({'width':'65%','height':'85%'});
	
  });
</script> 
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span> Press Releases </span></h2>
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
    <?php if( count($pressreleases) > 0 ) { ?>
    <!-- table -->
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <th>Title</th>
		<th>Subtitle</th>
        <th>Release Date</th>
        <th>Status</th>
        <th>Action</th>
        <th>Share On</th>
        
      </tr>
      <?php $id = $this->session->userdata('siteid');?>
      <?php $companyid = $this->session->userdata['youg_admin']['id']; ?>
      <?php $company = $this->settings->get_company_byid($companyid); ?>
      <?php if(count($company)>0)
	  {
	  	$pressimage = $company[0]['logo'];
	  }
	  ?>
	  <?php $url1 = $this->pressreleases->get_url_byid($id);?>
	  <?php if(count($url1)>0){?>
	  <?php $pageurl = $url1[0]['siteurl'].'pressrelease/browse/';?>
      <?php } ?>
	  <?php for($i=0;$i<count($pressreleases);$i++) { ?>
       <tr>
        <td><?php echo ucfirst(stripslashes($pressreleases[$i]['title'])); ?></td>
        <td><?php echo ucfirst(stripslashes($pressreleases[$i]['subtitle'])); ?></td>
        <td><?php echo date("M d Y",strtotime($pressreleases[$i]['insertdate'])); ?></td>
        <td><?php if( stripslashes($pressreleases[$i]['status']) == 'Enable' ) { ?>
          <a href="<?php echo site_url('pressrelease/disable/'.$pressreleases[$i]['id']);?>" title="Click to Disable" class="btn btn-small btn-success" onClick="return confirm('Are you sure to Disable this pressrelease?');"><span>Enable</span></a>
          <?php } ?>
          <?php if( stripslashes($pressreleases[$i]['status']) == 'Disable' ) { ?>
          <a href="<?php echo site_url('pressrelease/enable/'.$pressreleases[$i]['id']);?>" title="Click to Enable" class="btn btn-small btn-info" style="cursor:default; color: #CD0B1C;" onClick="return confirm('Are you sure to Enable this pressrelease?');"><span>Disable</span></a>
          <?php } ?></td>
        <td><a href="<?php echo site_url('pressrelease/edit/'.$pressreleases[$i]['id']); ?>" title="Edit" class="ico ico-edit">Edit</a> <a href="<?php echo site_url('pressrelease/delete/'.$pressreleases[$i]['id']);?>" title="Delete" class="ico ico-delete" onClick="return confirm('Are you sure to Delete this pressrelease?');">Delete</a>
        	 <a href="<?php echo site_url('pressrelease/view/'.$pressreleases[$i]['id']); ?>" title="View Detail of <?php echo stripslashes($pressreleases[$i]['title']);?>" class="colorbox"><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a>
        </td>
        <?php if($id!='all')
		{?>
        <td>
          <?php $title=urlencode($pressreleases[$i]['title']);
                $url=urlencode($pageurl.$pressreleases[$i]['seokeyword']);
				$m = ($this->settings->get_setting_value('2').substr($this->config->item('company_thumb_upload_path'),3).stripslashes($pressimage));?>
                 <a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[url]=<?php echo $url; ?>&amp;&p[images][0]=<?php echo $m;?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');" target="_parent" href="javascript: void(0)">
                   <img width="16" height="17" border="0" src="images/fa.png" alt="fbshare">
                </a>
                    
                </a>
               <a title="google+" onClick="window.open('https://plus.google.com/share?url=<?php echo urlencode($pageurl.$pressreleases[$i]['seokeyword']);?>','Google+','width=500,height=400,dependent=yes,resizable=yes,scrollbars=yes,menubar=no,toolbar=no,status=no,directories=no,location=yes');"
                ><img width="16" height="17" border="0" src="images/go.jpg" alt="googleshare"></a>
           <a href="https://twitter.com/share" class="twitter-share-button" data-url="google.com" data-text="<?php echo ucwords($pressreleases[$i]['title']);?> <?php echo $pageurl.$pressreleases[$i]['seokeyword'];?>" data-count="none">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        </td>
        <?php
        }
        else
        {
        	?>
            <td>---</td>
            <?php
		}
        ?>
      </tr>
      <?php } ?>
    </table><?php  if($this->pagination->create_links()) { ?>
    <div class="pagination"> <?php echo $this->pagination->create_links(); ?> </div>
    <?php } ?>
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
