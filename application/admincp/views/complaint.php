<?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'view' ) ) { ?>
<!-- box -->

<div class="box">
  <div class="headlines">
    <h2><span>Complaint Detail</span></h2>
  </div>
  <!-- table -->
  <table align="center" width="100%" cellspacing="10" cellpadding="0" border="0">
    <?php if( count($complaint)>0 ) { ?>
    <?php //echo "<pre>"; print_r($complaint); die();?>
    <?php $user = $this->users->get_user_byid($complaint[0]['userid']);?>
    <?php $company = $this->companys->get_company_byid($complaint[0]['companyid']);?>
    <tr>
      <td width="120"><b>Complaint Type</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($complaint[0]['type']); ?></td>
    </tr>
    <tr>
      <td width="120" valign="top"><b>Complaint</b></td>
      <td valign="top"><b>:</b></td>
      <td><?php echo nl2br(stripslashes($complaint[0]['detail'])); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Against</b></td>
      <td><b>:</b></td>
      <td><?php if(count($company)>0) { echo stripslashes($company[0]['company']); } else { echo "---"; } ?></td>
    </tr>
    <tr>
      <td width="120"><b>By</b></td>
      <td><b>:</b></td>
      <td><?php if(count($user)>0) { echo stripslashes($user[0]['firstname'].' '.$user[0]['lastname']); } else { echo "Anonymous"; } ?></td>
    </tr>
    <tr>
      <td width="120"><b>Damage Amout</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($complaint[0]['damagesinamt']); ?></td>
    </tr>
    <tr>
      <td width="120"><b>When Date</b></td>
      <td><b>:</b></td>
      <td><?php echo date('M d Y',strtotime($complaint[0]['whendate'])); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Location</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($complaint[0]['location']); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Username</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($complaint[0]['username']); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Email ID</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($complaint[0]['emailid']); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Seo keyword</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($complaint[0]['comseokeyword']); ?></td>
    </tr>
    <?php if( stripslashes($complaint[0]['status'] == 'Disable' ))
    {?>
    <tr>
      <td width="120"><b>Cancel Amount</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($complaint[0]['cancel_amount']); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Transaction ID</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($complaint[0]['transactionid']); ?></td>
    </tr>
    <tr>
      <td width="120"><b>Transaction Date</b></td>
      <td><b>:</b></td>
      <td><?php echo date('M d Y',strtotime($complaint[0]['transaction_date'])); ?></td>
    </tr>
    <?php
    }
     } else { ?>
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
		$('.colorbox').colorbox({'width':'55%','height':'80%'});
		/*$('.colorbox').colorbox({'width':'55%','height':'60%'});
		$('.colorbox').colorbox({ 
			onComplete : function() { 
			   $(this).colorbox.resize();
			}
		});*/
  });
</script> 

<!-- #content -->
<div id="content">
  <?php if( $this->uri->segment(2) == 'edit' ) { ?>
  <link rel="stylesheet" href="<?php echo base_url();?>js/datetimepicker/style.css" type="text/css" media="all" />
  <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script> 
  <script src="<?php echo base_url();?>js/datetimepicker/jquery-ui-timepicker-addon.js"></script>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
  <script type="text/javascript">
	function trim(stringToTrim) {
		return stringToTrim.replace(/^\s+|\s+$/g,"");
	}
	function chkcomseokeyword(comseokeyword)
	{
	//	alert(comseokeyword);
		var seofilter  = /^[a-zA-Z0-9_-]+$/;
		if( trim(comseokeyword) != '' && seofilter.test(trim(comseokeyword)) )
		{
			$("#seocorerror").hide();
			//Return from conroller in php code : echo json_encode(array("result"=>"exist"));
			$.ajax({
				type 				: "POST",
				url 				: "<?php echo site_url('complaint/fieldcheck'); ?>",
				data				:	{ <?php if($this->uri->segment(2) == 'edit' ) echo "'id' : ".$complaint[0]['id'].", "; ?>'comseokeyword' : comseokeyword },
				dataType 		: "json",
				cache				: false,
				success			: function(data){
												//alert(data.result); return false;
												if( data.result == 'old')
												{
													$("#seocorerror").hide();
													$("#seotknerror").show();
													$("#comseokeyword").val('').focus();
													return false;
												}
												else
												{
													$("#seotknerror").hide();
												}
											}
			});
		}
		else
		{
			$("#seotknerror").hide();
			$("#seocorerror").show();
			$("#comseokeyword").val('').focus();
			return false;
		}
	}
</script> 
  <script type="text/javascript" language="javascript">
	function trim(stringToTrim) {
		return stringToTrim.replace(/^\s+|\s+$/g,"");
	}
	$(document).ready(function() {
		$('#whendate').datepicker({
								dateFormat : 'mm/dd/yy', maxDate: new Date
							});
		
		$("#btnupdate").click(function () {
	
			if( trim($("#complainttype").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#complainttypeerror").show();
				$("#complainttype").val('').focus();
				return false;
			}
			else
			{
				$("#complainttypeerror").hide();
			}
						
			if(trim($("#damagesinamt").val()) == "")
			{
				$("#error").attr('style','display:block;');
				$("#damagesinamterror").show();
				$("#damagesinamt").val('').focus();
				return false;
			}
			else
			{
				if( isNaN(trim($("#damagesinamt").val())) )
				{
					$("#error").attr('style','display:block;');
					$("#damagesinamterror").show();
					$("#damagesinamt").val('').focus();
					return false;
				}
				else
				{
					$("#damagesinamterror").hide();
				}
			}
			
			if( trim($("#whendate").val()) == "" )
			{
				$("#error").attr('style','display:block;');
				$("#whendateerror").show();
				$("#whendate").val('').focus();
				return false;
			}
			else
			{
				$("#whendateerror").hide();
			}
			
			if( trim($("#detail").val()) == "" || $("#detail").val().length < 150)
			{
				$("#error").attr('style','display:block;');
				$("#detailerror").show();
				$("#detail").focus();
				return false;
			}
			else
			{
				$("#detailerror").hide();
			}
			
			var seofilter  = /^[a-zA-Z0-9_-]+$/;
			
			if( trim($("#comseokeyword").val()) == "" )
			{
				$("#seocorerror").hide();
				$("#error").attr('style','display:block;');
				$("#seoerror").show();
				$("#comseokeyword").val('').focus();
				return false;
			}
			else
			{
				$("#seoerror").hide();
				if( !seofilter.test(trim($("#comseokeyword").val())) )
				{
					$("#error").attr('style','display:block;');
					$("#seocorerror").show();
					$("#comseokeyword").focus();
					return false;
				}
				else
				{
					$("#seocorerror").hide();
				}
			}
			
			if( $("#frmcomplaint").submit() )
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
      <li><a href="<?php echo site_url('complaint');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
      <li>
        <?php if($this->uri->segment(2) == 'edit') { echo 'Edit'; }?>
        <?php if($this->uri->segment(2) == 'removed') { echo 'Removed Complaints'; }?>
      </li>
    </ul>
  </div>
  <!-- /breadcrumbs -->
  
  <?php if($this->uri->segment(2) && ( $this->uri->segment(2) == 'edit') ) { ?>
  
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span>Edit</span></h2>
    </div>
    <div class="box-content"> <?php echo form_open('complaint/update',array('class'=>'formBox','id'=>'frmcomplaint')); ?>
      <fieldset>
        <div class="form-cols"><!-- two form cols -->
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 20% !important;">
                <label for="complainttype">Complaint Type<span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width: 77% !important; float:left">
                <?php $js = 'id="complainttype" class="select"'; ?>
                <?php $types = array(''=>'---Select---','Company'=>'Company','Phone'=>'Phone','Person'=>'Person');?>
                <?php echo form_dropdown('complainttype',$types,stripslashes($complaint[0]['type']),$js); ?> </div>
            </div>
          </div>
          <div id="complainttypeerror" class="error" style="width:auto;">Complaint Type is required.</div>
        </div>
        <div class="form-cols">
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 20% !important;">
                <label for="damagesinamt">Damages Amount<span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width: 77% !important; float:left">
                <?php 
				echo form_input( array( 'name'=>'damagesinamt','id'=>'damagesinamt','class'=>'input','type'=>'text','value'=>stripslashes($complaint[0]['damagesinamt']) ) );
				?>
              </div>
            </div>
          </div>
          <div id="damagesinamterror" class="error" style="width:auto;">Enter Digits Only.</div>
        </div>
        <div class="form-cols">
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 20% !important;">
                <label for="whendate">When Date<span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width: 77% !important; float:left">
                <?php 
				echo form_input( array( 'name'=>'whendate','id'=>'whendate','class'=>'input datetimepicker','type'=>'text','value'=>date('M d Y',strtotime(stripslashes($complaint[0]['whendate']))) ) );
				?>
              </div>
            </div>
          </div>
          <div id="whendateerror" class="error" style="width:auto;">When Date is required.</div>
        </div>
        <div class="form-cols">
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 20% !important;">
                <label for="location">Location</label>
              </div>
              <div class="con" style="width: 77% !important; float:left">
                <?php 
				echo form_input( array( 'name'=>'location','id'=>'location','class'=>'input','type'=>'text','value'=>stripslashes($complaint[0]['location']) ) );
				?>
              </div>
            </div>
          </div>
          <div id="locationerror" class="error" style="width:auto;">Location required.</div>
        </div>
        <div class="form-cols">
          <div class="col1" style="width: 100% !important;">
            <div class="clearfix">
              <div class="lab" style="width: 20% !important; padding-bottom:5px;">
                <label for="detail">Detail<span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width: 77% !important; text-align:justify; float:left;">
                <?php 
				echo form_textarea( array( 'name'=>'detail','id'=>'detail','class'=>'textarea','rows'=>'4','cols'=>'15','value'=>stripslashes($complaint[0]['detail']) ) );
				?>
              </div>
            </div>
          </div>
          <div id="detailerror" class="error" style="width:auto;">Detail is required (minimum 150 charactars).</div>
        </div>
        <div class="form-cols">
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 20% !important;">
                <label for="comseokeyword">Seo Keyword<span class="errorsign">*</span></label>
              </div>
              <div class="con" style="width: 77% !important; float:left">
                <?php 
				echo form_input( array( 'name'=>'comseokeyword','id'=>'comseokeyword','class'=>'input','type'=>'text','value'=>stripslashes($complaint[0]['comseokeyword']),'onchange'=>'chkcomseokeyword(this.value)' ) ); ?>
              </div>
            </div>
          </div>
          <div id="seoerror" class="error" style="width:auto;">Complaint SEO Keyword is required.</div>
          <div id="seocorerror" class="error" style="width:auto;">Only 'a-z,A-Z,0-9,-,_' allowed characters for Complaint SEO Keyword.</div>
          <div id="seotknerror" class="error" style="width:auto;">This SEO Keyword is already taken.</div>
        </div>
        <div class="btn-submit" style="padding: 15px 0 0 22%;"> 
          <!-- Submit form --> 
          <?php echo form_input(array('name'=>'btnupdate','id'=>'btnupdate','class'=>'button','type'=>'submit','value'=>'Update')); ?> or <a href="<?php echo site_url('complaint');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php echo form_hidden( array( 'txtintid' => $this->encrypt->encode($complaint[0]['id']) ) ); ?> <?php echo form_close(); ?> </div>
  </div>
  <!-- /box-content -->
  
  <?php } 
  elseif( $this->uri->segment(2) && ( $this->uri->segment(2) == 'search' ) ) { ?>
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
      <h2><span>Search Complaints</span></h2>
    </div>
    <div class="box-content"> <?php echo form_open('complaint/searchcomplaint',array('class'=>'formBox','id'=>'frmsearch')); ?>
      <fieldset>
        
        <!-- Error form message -->
        
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="keysearch">Keyword<span>*</span></label>
              </div>
              <div class="con"> <?php echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search complaint by user or company or keyword')); ?> </div>
            </div>
          </div>
          <div id="keysearcherror" style="display:none;" class="error" align="right">Enter Keyword.</div>
        </div>
        <div class="btn-submit"> 
          <!-- Submit form --> 
          <?php echo form_input(array('name'=>'btnsearch','id'=>'btnsearch','class'=>'button','type'=>'submit','value'=>'Search','style'=>'margin-left:-48px;')); ?> or <a href="<?php echo site_url('complaint');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php echo form_close(); ?> </div>
  </div>
  <!-- /box-content -->
  <?php } 
  elseif( $this->uri->segment(2) && ( $this->uri->segment(2) == 'removed' ) ) { ?>
  <!-- box -->
   <div class="box">
	   
    <div class="headlines">
      <h2><span>Removed Complaints</span></h2>
      
      <h2>
		   <span>
			   
			   
				<a href="<?php if(!empty($_GET['s'])){ echo site_url('complaint/removedcomplaintcsv/'.$_GET['s']); } else { echo site_url('complaint/removedcomplaintcsv'); } ?>" title="Export as CSV file">
					<img src="<?php echo base_url(); ?>images/csv.jpeg" alt="" title="Export as CSV file" width="20" height="20"/>&nbsp;CSV 
				</a>
			</span>
		</h2>
		
    </div>
        <div class="box-content"> <?php echo form_open('complaint/removedsearchcomplaint',array('class'=>'formBox','id'=>'frmsearch')); ?>
      <fieldset>
        <!-- Error form message -->
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="keysearch">Keyword<span>*</span></label>
              </div>
              <div class="con"> <?php echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search complaint by user or company or keyword','value'=>'')); ?> </div>
            </div>
          </div>
          <div id="keysearcherror" style="display:none;" class="error" align="right">Enter Keyword.</div>
        </div>
        <div class="btn-submit"> 
          <!-- Submit form --> 
          <?php echo form_input(array('name'=>'btnsearch','id'=>'btnsearch','class'=>'button','type'=>'submit','value'=>'Search','style'=>'margin-left:-48px;')); ?> or <a href="<?php echo site_url('complaint/removed');?>" class="Cancel">Cancel</a> </div>
          
         <?php if(!empty($_GET['s']))
			{	   
				echo "<div style='margin-top:1em;'> Search results for <span style='color:#1a2e4d'>' ". $_GET['s'] . " ' </span> </div>";
			}
			
		?> 
      </fieldset>
      <?php echo form_close(); ?> </div>
        <?php if(count($removedcomplaints) > 0 ) { 
			
			?>
		<!-- table -->
		
		 <table class="tab tab-drag complaints">
		<thead>
			<tr class="top nodrop nodrag">
			<?php 
			
			
			foreach($fields as $field_name => $field_display): ?>
		
				<th <?php if ($sort_by == $field_name) echo "class=\"sort_$sort_order sorttitle \"" ?>>
				<?php
				if($sort_by == $field_name){ 
						$field_display .= "<img alt='desc' src='".site_url("images/sort_".$sort_order.".gif")."'/>";
				}?>
				<?php echo anchor("complaint/removed/$field_name/" .
					(($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc') ,
					$field_display,array('class' => 'sorttitle')); ?>
				</th>
						
			<?php endforeach; ?>
				<th>Action</th>
				<th>Print History</th>
			
			</tr>
		</thead>
		
		<tbody>
			<?php foreach($removedcomplaints as $removedcomplaint): 
			
			?>
			<tr>
				<?php foreach($fields as $field_name => $field_display): ?>
				
				
				<td>
					<?php 
					
					if($field_name == 'detail'){
						echo (strlen($removedcomplaint->$field_name) > 50) ? substr($removedcomplaint->$field_name,0,50).'...' : $removedcomplaint->$field_name;
					}elseif ($field_name == 'companyid'){
						$company = $this->companys->get_company_byid($removedcomplaint->companyid);
						if(count($company)>0) { 
							echo ucfirst($company[0]['company']); 
						}
					}elseif ($field_name == 'userid'){
						$user = $this->users->get_user_byid($removedcomplaint->userid); 						
						if(count($user)>0) { 
							echo ucfirst($user[0]['firstname'].' '.$user[0]['lastname']);
						}else { ?>
							<span title="Anonymous"></span>
					<?php }						
					}
					elseif($field_name == 'whendate'){
						echo date('m-d-Y', strtotime($removedcomplaint->whendate));
					}					
					elseif($field_name == 'transaction_date'){
						echo date('m-d-Y', strtotime($removedcomplaint->transaction_date));
					}
					else{
						echo $removedcomplaint->$field_name; 
					 }
					?>	
					
				</td>			
				<?php endforeach; ?>
				<td><a href="<?php echo site_url('complaint/view/'.$removedcomplaint->id); ?>" title="View Detail" class="colorbox"><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a></td>
				<td><a href="<?php echo site_url('complaint/printhistory/'.$removedcomplaint->id); ?>">Click here</a></td>		
			</tr>
			<?php endforeach; ?>			
		</tbody>
		
	</table> 
  
		
		
		
    <!-- /table --> 
			<!-- /pagination -->
			<?php  if($this->pagination->create_links()) { ?>
			<tr style="background:#ffffff">
			  <td></td>
			  <td></td>
			  <td></td>
			  <td style="padding:10px"><div class="pagination"><?php echo $this->pagination->create_links(); ?></div></td>
			</tr>
			<?php } ?>
			<!-- /pagination -->
			<?php } else { ?>
			<!-- Warning form message -->
			<div class="form-message warning">
			  <p>No records found.</p>
			</div>
			<?php } ?>

  </div>
  <!-- /box-content -->
  <?php } elseif($this->uri->segment(2) && $this->uri->segment(2)=='printhistory'){ ?>
	
	<!-- breadcrumbs -->
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('complaint/removed');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
      <li>
        <?php if($this->uri->segment(2) == 'printhistory') { echo 'Removed Complaints History'; }?>
      </li>
    </ul>
  </div>
  <!-- /breadcrumbs -->  
	  
	    <!-- box -->
   <div class="box">
    <div class="headlines">
      <h2><span>Removed Complaints History</span></h2>
    </div>
        <?php if(count($getcomplainthistory) > 0 ) { ?>
    <!-- table -->
    <table class="tab tab-drag complaint">
      <tr class="top nodrop nodrag">
        <th>Date</th>
	    <th>Status</th>
      </tr>
      <?php 
	$site = site_url();			
	$url = explode("/admincp",$site);
	$path = $url[0];
	?>
      <?php for($i=0;$i<count($getcomplainthistory);$i++) { ?>
      <?php $user = $this->users->get_user_byid($getcomplainthistory[$i]['userid']);?>
      <?php $company = $this->companys->get_company_byid($getcomplainthistory[$i]['companyid']);?>
     
     <?php if($getcomplainthistory[$i]['complaindate']!="" || $getcomplainthistory[$i]['transaction_date']!="" ) {?>
     <tr>
		<?php if($getcomplainthistory[$i]['complaindate']!="") { ?>
        <td><?php echo  date('m-d-Y',strtotime($getcomplainthistory[$i]['whendate']));?></td>
        <td>Customer Filed a complaint with information</td>
        <?php } ?>	
      </tr>  
      <tr> 
        <?php if($getcomplainthistory[$i]['transaction_date']!="") { ?>
        <td><?php echo date('m-d-Y',strtotime($getcomplainthistory[$i]['transaction_date']));?></td>
        <td>Complaint has been closed</td>
        <?php } ?>	
      </tr>
      <?php } else { ?>
		  
		  <td>No records found</td>
		  <td></td>
		  
	 <?php } ?>	    
      <?php } ?>
      <!-- /pagination --> 
      
      <!-- /pagination -->
    </table>
    <!-- /table --> 
    <!-- /pagination -->
    <?php  if($this->pagination->create_links()) { ?>
    <tr style="background:#ffffff">
      <td></td>
      <td></td>
      <td></td>
      <td style="padding:10px"><div class="pagination"><?php echo $this->pagination->create_links(); ?></div></td>
    </tr>
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
  <!-- /box-content -->
	   
	  
	  
	  
	  
	 
	  
<?php } else { ?>
  
  <!-- box -->
  <div class="box">
    <div class="headlines">
       <h2><span> Complaints: </span></h2>
       
        <h2><span>

        <a href="<?php if(!empty($_GET['s'])){ echo site_url('complaint/csv/'.$_GET['s']); } else { echo site_url('complaint/csv'); } ?>" title="Export as CSV file">
       <img src="<?php echo base_url(); ?>images/csv.jpeg" alt="" title="Export as CSV file" width="20" height="20"/>&nbsp;CSV </a>
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
    
    <div class="box-content"> <?php echo form_open('complaint/searchcomplaint',array('class'=>'formBox','id'=>'frmsearch')); ?>
      <fieldset>
        <!-- Error form message -->
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="keysearch">Keyword<span>*</span></label>
              </div>
              <div class="con"> <?php echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search complaint by user or company or keyword','value'=>'')); ?> </div>
            </div>
          </div>
          <div id="keysearcherror" style="display:none;" class="error" align="right">Enter Keyword.</div>
        </div>
        <div class="btn-submit"> 
          <!-- Submit form --> 
          <?php echo form_input(array('name'=>'btnsearch','id'=>'btnsearch','class'=>'button','type'=>'submit','value'=>'Search','style'=>'margin-left:-48px;')); ?> or <a href="<?php echo site_url('complaint');?>" class="Cancel">Cancel</a> </div>
          <?php if(!empty($_GET['s']))
			{	   
				echo "<div style='margin-top:1em;'> Search results for <span style='color:#1a2e4d'>' ". $_GET['s'] . " ' </span> </div>";
			}
			
		?>
      </fieldset>
      <?php echo form_close(); ?> </div>


    <?php if( count($complaints) > 0 ) { 
		$order_seg = $this->uri->segment(4,"asc"); 
	  if($order_seg == "asc"){ $orderby = "desc";} else { $orderby = "asc"; }
		
		?><script language="javascript">
$(function(){
 
    // add multiple select / deselect functionality
    $("#selectall").click(function () {
          $('.case').attr('checked', this.checked);
    });
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function(){
 
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
 
    });
});

function submitfrm()
{
	var len =$('[name="foo[]"]:checked').length;
	
	if(len==0)
	{
		alert("Select atleast one complaint");
		return false;
	}
	
	
	$('#get_id').submit();
}
</script>
<?php if($this->uri->segment(2)!='removedsearchresult'){ ?>
    <!-- table --><form action="complaint/foo" id="get_id" method="post" class="formBox">
   <table class="">
      <tr class="">
      <td>
    <div style="height:25px;width:150px !important;" class="con">
    <select id="checktype" class="select" name="checktype" style="padding-top:1px;">
<option value="Enable">Enable</option>
<option value="Disable">Disable</option>
<option value="Delete">Delete</option>
</select>
	
                
              </div>
              </td> <td><a onclick="submitfrm();" title="Submit" style="cursor:pointer;">Submit</a></td>
    </tr>
    </table>
<?php } ?>
  
  <table class="tab tab-drag complaints">
		<thead>
			<tr class="top nodrop nodrag">
			<?php 
			
			
			foreach($fields as $field_name => $field_display): ?>
				<?php if($field_name == 'id') {					
						if($this->uri->segment(2)!='removedsearchresult'){  ?>
							<th><input type="checkbox" id="selectall" name="maincheck"/></th>
					<?php }
					}else{ ?>
				<th <?php if ($sort_by == $field_name) echo "class=\"sort_$sort_order sorttitle \"" ?>>
				<?php
				if($sort_by == $field_name){ 
						$field_display .= "<img alt='desc' src='".site_url("images/sort_".$sort_order.".gif")."'/>";
				}?>
				<?php echo anchor("complaint/index/$field_name/" .
					(($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc') ,
					$field_display,array('class' => 'sorttitle')); ?>
				</th>
				<?php } ?>			
			<?php endforeach; ?>
				<th>Action</th>
			
			</tr>
		</thead>
		
		<tbody>
			<?php foreach($complaints as $complaint): 
			
			?>
			<tr>
				<?php foreach($fields as $field_name => $field_display): ?>
				
				
				<td>
					<?php if($field_name == 'id'){ ?>
						
						<input type="checkbox" class="case" name="foo[]" value="<?php echo $complaint->id;?>" />
				 <?php					
					}elseif($field_name == 'detail'){
						echo (strlen($complaint->$field_name) > 50) ? substr($complaint->$field_name,0,50).'...' : $complaint->$field_name;
					}elseif ($field_name == 'companyid'){
						$company = $this->companys->get_company_byid($complaint->companyid);
						if(count($company)>0) { 
							echo ucfirst($company[0]['company']); 
						}
					}elseif ($field_name == 'userid'){
						$user = $this->users->get_user_byid($complaint->userid); 						
						if(count($user)>0) { 
							echo ucfirst($user[0]['firstname'].' '.$user[0]['lastname']);
						}else { ?>
							<span title="Anonymous"></span>
					<?php }						
					}
					elseif ($field_name == 'status' ) { ?>
							<?php
							if( $complaint->$field_name == 'Enable' ){ ?>
								<a href="<?php echo site_url('complaint/disable/'.$complaint->id);?>" title="Click to Disable" class="btn btn-small btn-success" onClick="return confirm('Are you sure to Disable this user?');"><span><?php echo $complaint->$field_name; ?></span></a>
								
							<?php 
							}else{ ?>
								
							<a href="<?php echo site_url('complaint/enable/'.$complaint->id);?>" title="Click to Enable" class="btn btn-small btn-success" style="cursor:default; color: #CD0B1C;" onClick="return confirm('Are you sure to Enable this user?');"><span><?php echo $complaint->$field_name; ?></span></a>
						 <?php
							}
					}elseif($field_name == 'complaindate'){
						echo date('m-d-Y', strtotime($complaint->complaindate));
					}					
					else{
						echo $complaint->$field_name; 
					 }
					?>	
					
				</td>			
				<?php endforeach; ?>
				<td style='padding: 8px 4px;'>
					<a href="<?php echo site_url('complaint/edit/'.$complaint->id); ?>" title="Edit" class="ico ico-edit">Edit</a>
					<a href="<?php echo site_url('complaint/delete/'.$complaint->id);?>" title="Delete" class="ico ico-delete" onClick="return confirm('Are you sure to Delete this Coupon?');">Delete</a>
					<a href="<?php echo site_url('complaint/view/'.$complaint->id); ?>" title="View Detail" class="colorbox"><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a>
				</td>			
			</tr>
			<?php endforeach; ?>			
		</tbody>
		
	</table> 
  
  
    </form>
    <!-- /table --> 
    <!-- /pagination -->
    <?php  if($this->pagination->create_links()) { ?>
    <tr style="background:#ffffff">
      <td></td>
      <td></td>
      <td></td>
      <td style="padding:10px"><div class="pagination"><?php echo $this->pagination->create_links(); ?></div></td>
    </tr>
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
<?php } ?>
