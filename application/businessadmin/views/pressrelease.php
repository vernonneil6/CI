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
			 if (!$("#terms-conditions").is(":checked")) {
						$('#terms-error').show();
						return false;
					}
					else
					{
						$('#terms-error').hide();
						return true;
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
    <div class="box-content"> <?php echo form_open_multipart('pressrelease/update',array('class'=>'formBox','id'=>'frmpressrelease')); ?>
      <fieldset>
		<div class="form-cols"><!-- two form cols -->
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 14% !important;">
                <label for="site">Choose where you want to Publish your Press Release from this Drop-Down Menu </label>
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
                <?php echo form_input( array( 'name'=>'title','id'=>'title','class'=>'input','type'=>'text','onchange'=>'chktitle(this.value)' ) ); ?>
                <?php } ?>
                <?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_input( array( 'name'=>'title','id'=>'title','class'=>'input','type'=>'text','value'=>ucfirst(stripslashes($pressrelease[0]['title'])),'onchange'=>'chktitle(this.value)' ) ); ?>
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
                <label for="sortdesc">Short Description <span class="errorsign">*</span></label>
                <div class="pressrelease-note">This overview/summary will appear on your profile page or any page requiring a short description of the press release.</div>
              </div>
              <div class="con" style="width: 59% !important; text-align:justify; float:left;">
                <?php if($this->uri->segment(2) == 'add') { ?>
                <?php echo form_textarea( array( 'name'=>'sortdesc','id'=>'sortdesc','class'=>'textarea','rows'=>'4','cols'=>'15' ) ); ?>
                <?php } ?>
				<?php if($this->uri->segment(2) == 'edit') { ?>
                <?php echo form_textarea( array( 'name'=>'sortdesc','id'=>'sortdesc','class'=>'textarea','rows'=>'4','cols'=>'15','value'=>stripslashes($pressrelease[0]['sortdesc']) ) ); ?>
                <?php } ?>
              </div>
              <div id="sortdescerror" class="error" style="width:135px">Short Description is required.</div>
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
      <h2>
		   <span>
				<a href="<?php if(!empty($_GET['s'])){  echo site_url('pressrelease/export_csv/'.$_GET['s']); }else { echo site_url('pressrelease/export_csv'); } ?>" title="Export as CSV file">
					<img src="<?php echo base_url(); ?>images/export_csv.jpeg" alt="" title="Export as CSV file" width="20" height="20"/>&nbsp;CSV 
				</a>
			</span>
		</h2>
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
    
    <div class="box-content"> 
	<?php echo form_open('pressrelease/searchpressrelease',array('class'=>'formBox','id'=>'frmsearch')); ?>  
    <fieldset>
		<div class="form-cols">
		  <div class="col1">
			<div class="clearfix">
			  <div class="lab">
				<label for="keysearch">Keyword<span>*</span></label>
			  </div>
			  <div class="con"> <?php echo form_input( array( 'name'=>'keysearch','class'=>'input','type'=>'text')); ?> </div>
			</div>
		  </div>
		  <div id="keysearcherror" style="display:none;" class="error" align="right">Enter Keyword.</div>
		</div>
		<div class="btn-submit"> 
		  <?php echo form_input(array('name'=>'btnsearch','class'=>'button','type'=>'submit','value'=>'Search','style'=>'margin-left:-48px;')); ?> or <a href="<?php echo site_url('pressrelease');?>" class="Cancel">Cancel</a> 
		 
		</div>
		<?php if(!empty($_GET['s']))
			{	   
				echo "<div style='margin-top:2em;'> Search results for <span style='color:#1a2e4d'>' ". $_GET['s'] . " ' </span> </div>";
			}
			
		?> 
    </fieldset>
    <?php echo form_close(); ?> 
    </div>
      
      
    
    
    <?php if( count($pressreleases) > 0 ) {

	 ?>
    <!-- table -->
    <table class="tab tab-drag">
		<thead>
			<tr class="top nodrop nodrag">
			<?php 
			
			
			foreach($fields as $field_name => $field_display): ?>
		
			<th <?php if ($sort_by == $field_name) echo "class=\"sort_$sort_order sorttitle \"" ?>>
				<?php
				if($sort_by == $field_name){ 
						$field_display .= "<img alt='desc' src='".site_url("images/sort_".$sort_order.".gif")."'/>";
				}
				?>
				<?php echo anchor("pressrelease/index/$field_name/" .
					(($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc') ,
					$field_display,array('class' => 'sorttitle')); ?>
			</th>			
			
			<?php endforeach; ?>			 
			<th width="10%">Action</th>
			<th width="15%">Share On</th>
			</tr>
		</thead>
		
		<tbody>
			<?php foreach($pressreleases as $pressrelease): 
			
			?>
			<tr>
				<?php foreach($fields as $field_name => $field_display): ?>
				<td>
					<?php 
					
					
					if($field_name == 'release'){
						echo date('m-d-Y', strtotime($pressrelease->insertdate));
					}
					elseif ($field_name == 'status' ) { 
						?>
							<?php
							if( $pressrelease->$field_name == 'Enable' ){ ?>
								<a href="<?php echo site_url('pressrelease/disable/'.$pressrelease->id);?>" title="Click to Disable" class="btn btn-small btn-success" onClick="return confirm('Are you sure to Disable this user?');"><span><?php echo $pressrelease->$field_name; ?></span></a>
								
							<?php 
							}else{ ?>
								
							<a href="<?php echo site_url('pressrelease/enable/'.$pressrelease->id);?>" title="Click to Enable" class="btn btn-small btn-success" style="cursor:default; color: #CD0B1C;" onClick="return confirm('Are you sure to Enable this user?');"><span><?php echo $pressrelease->$field_name; ?></span></a>
						 <?php
							}
					}
					else{
						echo $pressrelease->$field_name; 
					 }
					?>	
					
				</td>			
				<?php endforeach; ?>
				 <td>
					<a href="<?php echo site_url('pressrelease/edit/'.$pressrelease->id); ?>" title="Edit" class="ico ico-edit">Edit</a> 
					<a href="<?php echo site_url('pressrelease/delete/'.$pressrelease->id);?>" title="Delete" class="ico ico-delete" onClick="return confirm('Are you sure to Delete this pressrelease?');">Delete</a>
					<a href="<?php echo site_url('pressrelease/view/'.$pressrelease->id); ?>" title="View Detail of <?php echo stripslashes($pressrelease->id);?>" class="colorbox"><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a>
				</td>
				<?php 
				 $id = $this->session->userdata('siteid');
				if($id!='all')
				{?>
				<td>
				<?php 
					$title=urlencode($pressrelease->title);
					$url=urlencode($pageurl.$pressrelease->seokeyword);
					$m = ($this->settings->get_setting_value('2').substr($this->config->item('company_thumb_upload_path'),3).stripslashes($pressimage));?>
                 <a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[url]=<?php echo $url; ?>&amp;&p[images][0]=<?php echo $m;?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');" target="_parent" href="javascript: void(0)">
                   <img width="16" height="17" border="0" src="images/fa.png" alt="fbshare">
                </a>
                    
                
               <a title="google+" onClick="window.open('https://plus.google.com/share?url=<?php echo urlencode($pageurl.$pressreleases[$i]['seokeyword']);?>','Google+','width=500,height=400,dependent=yes,resizable=yes,scrollbars=yes,menubar=no,toolbar=no,status=no,directories=no,location=yes');">
                <img width="16" height="17" border="0" src="images/go.jpg" alt="googleshare">
               </a>
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
			<?php endforeach; ?>			
		</tbody>
		
	</table>
   
   
   <?php  if($this->pagination->create_links()) { ?>
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
