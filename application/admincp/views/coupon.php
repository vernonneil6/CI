<?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'view' ) ) { ?>
<!-- box -->
<div class="box">
<div class="headlines">
    <h2><span>Coupon Detail</span></h2>
  </div>
    <!-- table -->
    <table align="center" width="100%" cellspacing="10" cellpadding="0" border="0">
   <?php if( count($coupon)>0 ) { ?>
   <?php $company = $this->companys->get_company_byid($coupon[0]['companyid']);?>
    <tr>
      <td width="120"><b>Company</b></td>
      <td><b>:</b></td>
      <td><?php if(count($company)>0) { echo ucfirst(stripslashes($company[0]['company'])); } else { echo "---";} ?></td>
    </tr>
    <tr>
      <td width="120"><b>Title</b></td>
      <td><b>:</b></td>
      <td><?php echo ucwords(stripslashes($coupon[0]['title'])) ?></td>
    </tr>
    <tr>
      <td width="120"><b>Promocode</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($coupon[0]['promocode']) ?></td>
    </tr>
    <tr>
      <td width="120"><b>Enddate</b></td>
      <td><b>:</b></td>
      <td><?php echo date("M d Y",strtotime($coupon[0]['enddate'])) ?></td>
    </tr>
    <tr>
      <td width="120"><b>Link</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($coupon[0]['url']) ?></td>
    </tr>
    <tr>
    	<td width="120"><b>coupon image</b></td>
        <td><b>:</b></td>
        <td>
        <img style="margin-left:0px;" width="50" height="50" src="<?php if( $coupon[0]['image'] ){ echo $this->settings->get_setting_value('2').substr($this->config->item('coupon_thumb_upload_path'),3);?><?php echo stripslashes($coupon[0]['image']); } else{echo $this->settings->get_setting_value('2').substr($this->config->item('coupon_thumb_upload_path'),3)."/no_image.png"; } ?>" /> 
          
        </td>
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
<?php //$companies = $this->companys->get_all_companys();?>
		<style>
		#frmcoupon.formBox .file .upload-file { margin-left:0 !important; } 
		</style>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script> 
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
        <?php /*?><script>
	 	  var coupondata = new Array();
		  var myvar = [];
		  <?php $jsArray = array();
		  foreach($companies as $array) {
			 $jsArray[] = array('id'=>$array['id'], 'company'=>$array['company']); 
		  } ?>
		  <?php 
		  for($i=0; $i<count($jsArray); $i++)
		  { ?>
			  myvar.push({
				  "label":<?php echo json_encode($jsArray[$i]['company']); ?>,
				  "value":<?php echo json_encode($jsArray[$i]['id']); ?>
			  });
			  companydata = [{
			  value: <?php echo json_encode($jsArray[$i]['id']); ?>,
			  label: <?php echo json_encode($jsArray[$i]['company']); ?>
			  }];
			  
		  <?php } ?>
	      	
		  </script><?php */?>
<script type="text/javascript">
	function trim(stringToTrim) {
		return stringToTrim.replace(/^\s+|\s+$/g,"");
	}
	function chkcode(promocode)
	{
		if( trim(promocode) != '' )
		{
			$("#couponcodeerror").hide();
			//Return from conroller in php code : echo json_encode(array("result"=>"exist"));
			$.ajax({
				type 				: "POST",
				url 				: "<?php echo site_url('coupon/fieldcheck'); ?>",
				data				:	{ <?php if($this->uri->segment(2) == 'edit' ) echo "'id' : ".$coupon[0]['id'].", "; ?>'promocode' : promocode },
				dataType 			: "json",
				cache				: false,
				success				: function(data){
												//alert(data.result); return false;
												if( data.result == 'old')
												{
													$("#couponcodeerror").hide();
													$("#couponcodeverror").show();
													$("#couponcode").val('').focus();
													return false;
												}
												else
												{
													$("#couponcodeverror").hide();
													$("#couponcodeerror").hide();
												}
											}
			});
		}
		else
		{
			$("#couponcodeverror").hide();
			$("#couponcodeerror").show();
			$("#couponcode").val('').focus();
			return false;
		}
	}
</script>

<script type="text/javascript">
	function searchcompany(company)
	{
		
		if (company.length > 0)
		{
			//alert(company.length);
			if( searchcompany != '' )
			{
			//$("#couponcodeerror").hide();
			//Return from conroller in php code : echo json_encode(array("result"=>"exist"));
			$.ajax({
				type 				: "POST",
				url 				: "<?php echo site_url('coupon/searchcompany'); ?>",
				data				:	{ 'company' : company },
				dataType 			: "json",
				cache				: false,
				success				: function(data){
												//alert(data);
												//console.log(data);
												$('#selcompany').autocomplete({ 
				source: data,
				
				select: function (event, ui) {
					if ( ui.item ) {
					  $('#companyid').val(ui.item.value);
					  this.value = ui.item.label;
					  return false;
					}
				}
			});
			$(".ui-autocomplete").css("max-height", "250px");
			$(".ui-autocomplete").css("overflow-y", "auto");
												
											}
			});
		}
			else
			{
			
			return false;
			}
		}
		else
		{
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
	
		
			if( trim($("#selcompany").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#selcompanyerror").show();
				$("#selcompany").val('').focus();
				return false;
			}
			else
			{
				$("#selcompanyerror").hide();
			}
			
			
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
			
			if( trim($("#couponcode").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#couponcodeerror").show();
				$("#couponcode").val('').focus();
				return false;
			}
			else
			{
				$("#couponcodeerror").hide();
			}
			
			if( trim($("#enddate").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#enddateerror").show();
				$("#enddate").val('').focus();
				return false;
			}
			else
			{
				$("#enddateerror").hide();
			}
			
			
			if( trim($("#categoryid").val()) == "" )
			{
				$("#categoryiderror").show();
				$("#categoryid").val('').focus();
				return false;
			}
			else
			{
				$("#categoryiderror").hide();
			}
			
			if( trim($("#url").val()) == "" )
			{
				$("#urlerror").show();
				$("#url").val('').focus();
				return false;
			}
			else
			{
				var filter=/^(http|https):\/\/[\w\-_]+(\.[\w\-_]+)+([\w\-\.,@?^=%&amp;:\+#]*[\w\-\@?^=%&amp;\+#])?/;
					
					if( !filter.test(trim($("#url").val())))
					{
						$("#error").attr('style','display:block;');
						$("#urlerror").show();
						$("#url").val('').focus();
						return false;
					}
					else
					{
						$("#urlerror").hide();
						
					}	
				}
			
			
			if( $("#frmcoupon").submit() )
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
   <li><a href="<?php echo site_url('coupon');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
   <li><?php if($this->uri->segment(2) == 'add'){echo 'Add Coupon';} else if($this->uri->segment(2) == 'edit') {echo 'Edit Coupon'; }?></li>
</ul>
</div>
<!-- /breadcrumbs -->

<?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'edit' ) ) { ?>

<!-- box -->
<div class="box">
    
    <div class="headlines">
    	<h2><span>
		<?php if($this->uri->segment(2) == 'add') {echo "Add Coupon"; } ?>
        <?php if($this->uri->segment(2) == 'edit') { echo "Edit Coupon"; } ?>
        </span></h2>
	</div>
    <div class="box-content">
    <?php echo form_open_multipart('coupon/update',array('class'=>'formBox','id'=>'frmcoupon')); ?>
    <fieldset>
    
        <div class="clearfix">
          <div class="lab">
            <label for="selcompany">Company <span class="errorsign">*</span></label>
          </div>
          <div class="con">
            <?php if($this->uri->segment(2) == 'add') { ?>
            <?php echo form_input( array( 'name'=>'selcompany','id'=>'selcompany','class'=>'input','type'=>'text','placeholder'=>'enter mininum 4 characters to search company','onkeyup'=>'searchcompany(this.value)')); ?> 
            <?php echo form_input( array( 'name'=>'companyid','id'=>'companyid','class'=>'input','type'=>'hidden','onkeyup'=>'searchcompany(this.value)')); ?> 
            <?php } ?>
            <?php if($this->uri->segment(2) == 'edit') { ?>
            <?php $company = $this->companys->get_company_byid($coupon[0]['companyid']);?>
            <?php if(count($company)>0) {
            	  echo form_input( array( 'name'=>'selcompany','id'=>'selcompany','class'=>'input','type'=>'text','value'=>$company[0]['company'],'placeholder'=>'enter mininum 4 characters to search company'));
				  echo form_input( array( 'name'=>'companyid','id'=>'companyid','class'=>'input','type'=>'hidden','value'=>$company[0]['id']));
				   }
				  else
				  {
					echo form_input( array( 'name'=>'selcompany','id'=>'selcompany','class'=>'input','type'=>'text'));
				  	echo form_input( array( 'name'=>'companyid','id'=>'companyid','class'=>'input','type'=>'hidden'));
				}} ?>
                </div>
          <div id="selcompanyerror" class="error" style="width:auto">Company is required.</div>

    </div>
    <div class="clearfix">
          <div class="lab">
            <label for="title">Title <span class="errorsign">*</span></label>
          </div>
          <div class="con">
            <?php if($this->uri->segment(2) == 'add') { ?>
            <?php echo form_input( array( 'name'=>'title','id'=>'title','class'=>'input','type'=>'text' ) ); ?>
            <?php } ?>
            <?php if($this->uri->segment(2) == 'edit') { ?>
            <?php echo form_input( array( 'name'=>'title','id'=>'title','class'=>'input','type'=>'text','value'=>stripslashes($coupon[0]['title']) )); ?>
            <?php } ?>
          </div>
          <div id="titleerror" class="error" align="right">Title is required.</div>

    </div>
    <div class="form-cols">
    <div class="clearfix">
    	  <div class="col1">
          <div class="lab">
            <label for="couponcode">Coupon Code <span class="errorsign">*</span></label>
          </div>
          <div class="con">
            <?php if($this->uri->segment(2) == 'add') { ?>
            <?php echo form_input( array( 'name'=>'couponcode','id'=>'couponcode','class'=>'input','type'=>'text','onchange'=>'chkcode(this.value)' ) ); ?>
            <?php } ?>
            <?php if($this->uri->segment(2) == 'edit') { ?>
            <?php echo form_input( array( 'name'=>'couponcode','id'=>'couponcode','class'=>'input','type'=>'text','value'=>stripslashes($coupon[0]['promocode']),'onchange'=>'chkcode(this.value)' ) ); ?>
            <?php } ?>
          </div>
          <div id="couponcodeerror" class="error" align="right">Couponcode is required.</div>
          <div id="couponcodeverror" class="error" align="right">Couponcode is already exists.</div>
</div>
    </div>
    </div>
    <div class="form-cols">
    <div class="clearfix">
    	  <div class="col1">
          <div class="lab">
            <label for="enddate">Enddate <span class="errorsign">*</span></label>
          </div>
          <div class="con">
            <?php if($this->uri->segment(2) == 'add') { ?>
            <?php echo form_input( array( 'name'=>'enddate','id'=>'enddate','class'=>'input datetimepicker','type'=>'text','readonly'=>'readonly')); ?> 
            <?php } ?>
            <?php if($this->uri->segment(2) == 'edit') { ?>
            <?php echo form_input( array( 'name'=>'enddate','id'=>'enddate','class'=>'input datetimepicker','type'=>'text','value'=>stripslashes($coupon[0]['enddate']) ,'readonly'=>'readonly')); ?>
            <?php } ?>
          </div>
          <div id="enddateerror" class="error" align="right">Enddate is required.</div>
</div>
    </div>
    </div>
    <div class="clearfix file">
          <div class="lab" style="width:12.8%;">
            <label for="image">Image </label>
          </div>
          <div class="con" style="width:50%; float:left"> <?php echo form_input( array( 'name'=>'image','id'=>'image','class'=>'input file upload-file','type'=>'file') ); ?> 
          
          <?php if($this->uri->segment(2) == 'edit') { ?>
          <img style="margin-left:120px;" width="50" height="50" src="<?php if( $coupon[0]['image'] ){ echo $this->settings->get_setting_value('2').substr($this->config->item('coupon_thumb_upload_path'),3);?><?php echo stripslashes($coupon[0]['image']); } else{echo $this->settings->get_setting_value('2').substr($this->config->item('coupon_thumb_upload_path'),3)."/no_image.png"; } ?>" /> 
          <?php echo form_input( array( 'name'=>'couponhiddenimage','value'=>$coupon[0]['image'],'type'=>'hidden' ) ); ?>
          <?php } ?>
          </div>
          <div id="imageerror" class="error" style="width:auto">Photo required.</div>
        </div>
    <div class="form-cols">
          <div>
            <div class="lab">
              <label for="categoryid">Category<span class="errorsign">*</span></label>
            </div>
            <?php if($this->uri->segment(2) == 'add') { ?>
            <div class="con" style="width:33%; float:left;margin-left:10px;margin-bottom:10px;"> <?php echo form_dropdown('categoryid',$selcat,'',"id='categoryid'  class='select'"); ?></div>
            <?php } ?>
            <?php if($this->uri->segment(2) == 'edit') { ?>
            <div class="con" style="width:33%; float:left;margin-left:10px;margin-bottom:10px;"> <?php echo form_dropdown('categoryid',$selcat,$coupon[0]['categoryid'],"id='categoryid' class='select'"); ?> </div>
            <?php } ?>
          </div>
          <div id="categoryiderror" class="error" style="width:132px;">Select Category.</div>
        </div>  
        
        <div class="clearfix">
          <div class="lab">
            <label for="url">Link <span class="errorsign">*</span></label>
          </div>
          <div class="con">
            <?php if($this->uri->segment(2) == 'add') { ?>
            <?php echo form_input( array( 'name'=>'url','id'=>'url','class'=>'input','type'=>'text' ) ); ?>
            <?php } ?>
            <?php if($this->uri->segment(2) == 'edit') { ?>
            <?php echo form_input( array( 'name'=>'url','id'=>'url','class'=>'input','type'=>'text','value'=>stripslashes($coupon[0]['url']) )); ?>
            <?php } ?>
          </div>
          <div id="urlerror" class="error" align="right">enter valid url example(http://xyz.com).</div>

    </div>
        
         
    <div class="btn-submit">
        <!-- Submit form -->
        <?php if($this->uri->segment(2) == 'add') { ?>
        <?php echo form_input(array('name'=>'btnsubmit','id'=>'btnsubmit','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
        <?php } ?>
        <?php if($this->uri->segment(2) == 'edit') { ?>
        <?php echo form_input(array('name'=>'btnupdate','id'=>'btnupdate','class'=>'button','type'=>'submit','value'=>'Update')); ?>
        <?php } ?>
        or <a href="<?php echo site_url('coupon');?>" class="Cancel">Cancel</a>
    </div>
    
    </fieldset>
    <?php if($this->uri->segment(2) == 'edit') { ?>     
    <?php echo form_hidden( array( 'id' => $this->encrypt->encode($coupon[0]['id']) ) ); ?>
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
	    <h2><span><?php echo 'CouponsDeals & Steals'; ?></span></h2>
	    <h2>
		   <span>
				<a href="<?php if($this->uri->segment(2)=='searchresult'){ echo site_url('coupon/csv/'.$this->uri->segment(3)); } else { echo site_url('coupon/csv'); } ?>" title="Export as CSV file">
					<img src="<?php echo base_url(); ?>images/csv.jpeg" alt="" title="Export as CSV file" width="20" height="20"/>&nbsp;CSV 
				</a>
			</span>
		</h2>
    </div>
    <div class="box-content"> <?php echo form_open('coupon/searchcoupon',array('class'=>'formBox','id'=>'frmsearch')); ?>
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
			  		echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search coupon by keyword','value'=>$this->uri->segment(3)));
			  }
			  else
			  {
			  	echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search coupon by keyword'));
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
    
	<?php if( count($coupons) > 0 ) { ?>
	<!-- table -->

	
	<table class="tab tab-drag coupons">
		<thead>
			<tr class="top nodrop nodrag">
			<?php 
			
			
			foreach($fields as $field_name => $field_display): ?>
			
			<th width="30%" <?php if ($sort_by == $field_name) echo "class=\"sort_$sort_order sorttitle \"" ?>>
				<?php
				if($sort_by == $field_name){ 
						$field_display .= "<img alt='desc' src='".site_url("images/sort_".$sort_order.".gif")."'/>";
				}?>
				<?php echo anchor("coupon/index/$field_name/" .
					(($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc') ,
					$field_display,array('class' => 'sorttitle')); ?>
			</th>
	
			
			<?php endforeach; ?>
			<th>Actions</th>			
			</tr>
		</thead>
		
		<tbody>
			<?php foreach($coupons as $coupon): 
			
			?>
			<tr>
				<?php foreach($fields as $field_name => $field_display): ?>
				
				<?php $company=$this->companys->get_company_byid($coupon->companyid)?>
				<td>
					<?php if($field_name == 'companyid'){ 
												
							if(count($company)>0) { 
								echo ucfirst(stripslashes($company[0]['company'])); 
							} else { 
								echo "---"; 
							} 				 				
						}
						elseif($field_name == 'enddate'){
						echo date('m-d-Y', strtotime($coupon->enddate));
						}
						elseif ($field_name == 'status' ) { ?>
							<?php
							if( $coupon->$field_name == 'Enable' ){ ?>
								<a href="<?php echo site_url('coupon/disable/'.$coupon->id);?>" title="Click to Disable" class="btn btn-small btn-success" onClick="return confirm('Are you sure to Disable this user?');"><span><?php echo $coupon->$field_name; ?></span></a>
								
							<?php 
							}else{ ?>
								
							<a href="<?php echo site_url('coupon/enable/'.$coupon->id);?>" title="Click to Enable" class="btn btn-small btn-success" style="cursor:default; color: #CD0B1C;" onClick="return confirm('Are you sure to Enable this user?');"><span><?php echo $coupon->$field_name; ?></span></a>
						 <?php
							}
					}
					else{
						echo $coupon->$field_name; 
					 }
					?>	
					
				</td>			
				<?php endforeach; ?>
				<td style='padding: 8px 4px;'>
					<a href="<?php echo site_url('coupon/edit/'.$coupon->id); ?>" title="Edit" class="ico ico-edit">Edit</a>
					<a href="<?php echo site_url('coupon/delete/'.$coupon->id);?>" title="Delete" class="ico ico-delete" onClick="return confirm('Are you sure to Delete this Coupon?');">Delete</a>
					<a href="<?php echo site_url('coupon/view/'.$coupon->id); ?>" title="View Detail" class="colorbox"><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a>
				</td>			
			</tr>
			<?php endforeach; ?>			
		</tbody>
		
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
