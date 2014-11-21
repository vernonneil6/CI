<?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'view' ) ) { ?>
<!-- box -->
<?php  $view_id=$this->uri->segment(3); ?>

<?php if($titletype[0]['type']=='') {?>
	
<div class="box">
		<div class="headlines">
			  <h2><span><?php echo "Signup details" ?></span></h2>
		</div>
 <!--Report view for signup date-->	

<div class="box-content"> 
	<table class="tab tab-drag">
	    <tr class="top nodrop nodrag">
			<td>Company</td>
			<td>Email</td>
			<td>Country</td>
			<td>Createdby</td>
			<td>CreatedbyName</td>
			<td>Status</td>
		  </tr>
		  <?php foreach($signups as $sign) { ?>			  
		 
		 <tr> 
			 <?php if($sign['id']==$view_id) {  ?>
			  <td><?php echo ucfirst($sign['company']);?></td>
			  <td><?php echo $sign['email'];?></td>
			  <td><?php echo ucfirst($sign['country']);?></td>
			  <td><?php echo ucfirst($sign['type']);?></td>
			  <td><?php echo ucfirst($sign['name']);?></td>
			  <td><?php echo $sign['status'];?></td>
		     <?php } ?>
		  </tr>
		<?php }  ?>
	</table>
</div>
</div>
<?php } ?>
	<!--Report view for signup date-->	
	
	<!--Report view for subbroker, marketer , agent -->
<?php if($titletype[0]['type']!='' ) { ?>
<?php if(count($elitemembers) > 0 ) { ?>
	
	<div class="box">
		<div class="headlines">
		 <?php if($titletype[0]['type'] =='subbroker') { ?>
		 		  <h2><span><?php echo "Subbroker details" ?></span></h2>
		  <?php } ?>
		 <?php if($titletype[0]['type'] =='marketer') { ?>
		 		  <h2><span><?php echo "Marketer details" ?></span></h2>
		  <?php } ?>
		 <?php if($titletype[0]['type'] =='agent') { ?>
		 		  <h2><span><?php echo "Agent details" ?></span></h2>
		  <?php } ?>
		</div>
		
		<div class="box-content"> 
		<table class="tab tab-drag">
		  <tr class="top nodrop nodrag">
			<td>Name</td>
			<td>Type</td>
			<td>Company</td>
			<td>Individual-Elitesales</td>
			<td>Total-Elitesales</td>
		
		  </tr>
		
		<!--For Subbroker details-->
		      
	    <?php  foreach($elitemembers as $elite) 	{ 
			        
					if($elite['ybid']==$view_id and $elite['ybtype']=='subbroker' and $elite['yctype']=='subbroker')	
					{	  
					?>
					<tr>
						<td><?php echo $elite['ybname']; ?></td>
						<td><?php echo $elite['ybtype']; ?></td>
						<td><?php echo $elite['yccompany']; ?></td>
						<td><?php echo $elite['subbroker']; ?></td>
						<td><?php echo $totalelite; ?></td>
					</tr>
					<?php 
					}
					?> 
					<?php if($elite['ycsubbrokerid']==$view_id  and $elite['ybtype']=='marketer' and $elite['yctype']=='marketer') 
					{ 
					?>   
					<tr>
						<td><?php echo $elite['ybname']; ?></td>
						<td><?php echo $elite['ybtype']; ?></td>
						<td><?php echo $elite['yccompany']; ?></td>
						<td><?php echo $elite['marketer']; ?></td>
						<td></td>
					</tr>
					<?php 
					foreach($elitemember as $agent)
					{
					if($agent['ycsubbrokerid']==$view_id  and $elite['ybid']==$agent['ycmarketerid'] and $agent['ybtype']=='agent' and $agent['yctype']=='agent') 
					{ 
					?>
					<tr>
						<td><?php echo $agent['ybname']; ?></td>
						<td><?php echo $agent['ybtype']; ?></td>
						<td><?php echo $agent['yccompany']; ?></td>
						<td><?php echo $agent['agent']; ?></td>
						<td></td>
					</tr>
					<?php 	
					}
					}
					} 
					} 
					?>
					
		<!--End for Subbroker details-->
		
		
		<!--For marketer details-->
				<?php foreach($elitemembers as $elite) 
				{ 
					if($elite['ybid']==$view_id and $elite['ybtype']=='marketer' and $elite['yctype']=='marketer')	
					{	  
					?>
					<tr>
						<td><?php echo $elite['ybname']; ?></td>
						<td><?php echo $elite['ybtype']; ?></td>
						<td><?php echo $elite['yccompany']; ?></td>
						<td><?php echo $elite['marketer']; ?></td>
						<td><?php echo $marketer_totalelite;?></td>
						</tr>
						<?php 
					}
					if($elite['ycmarketerid']==$view_id and $elite['ycbrokerid']==$elite['ybid'] and $elite['ybtype']=='agent' and $elite['yctype']=='agent') 
					{ 
					?>
					<tr>
						<td><?php echo $elite['ybname']; ?></td>
						<td><?php echo $elite['ybtype']; ?></td>
						<td><?php echo $elite['yccompany']; ?></td>
						<td><?php echo $elite['agents']; ?></td>
						<td><?php echo $agent_totalelite;?></td>
					</tr>
				    <?php 
					} 
					}
					?>
			
		
		<!--End for marketer details-->
		
		<!--For agent details-->
		<?php	foreach($elitemembers as $elite) 
				{ 
				if($elite['ybid']==$view_id and $elite['ybtype']=='agent' and $elite['yctype']=='agent')	
				{	  
				?>
				<tr>
					<td><?php echo $elite['ybname']; ?></td>
					<td><?php echo $elite['ybtype']; ?></td>
					<td><?php echo $elite['yccompany']; ?></td>
					<td><?php echo $elite['agents']; ?></td>
					<td><?php echo $agent_totalelite;?></td>
				</tr>
				<?php 
				}
				if($elite['ycmarketerid']==$view_id  and $elite['ybtype']=='agent' and $elite['yctype']=='agent') 
				{ 
				?>
				<tr>
					<td><?php echo $elite['ybname']; ?></td>
					<td><?php echo $elite['ybtype']; ?></td>
					<td><?php echo $elite['yccompany']; ?></td>
					<td><?php echo $elite['agents']; ?></td>
					<td></td>
				</tr>
				<?php 
				} 
				}
				?>
		
		<!--End for agent details-->
		</table>
</div>
<?php } ?>
</div>
<?php } ?>
<!--Report view for subbroker, marketer , agent -->

<!-- /box -->
<?php } else { ?>
<?php echo $header; ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script>
	  $(function() {
		$( "#datepicker" ).datepicker();
		$( "#format" ).change(function() {
		  $( "#datepicker" ).datepicker( "option", "dateFormat", $( this ).val() );
		});
	  });
	  $(function() {
		$( "#datepicker1" ).datepicker();
		$( "#format" ).change(function() {
		  $( "#datepicker1" ).datepicker( "option", "dateFormat", $( this ).val() );
		});
	  });

	$(document).ready(function() {
	 $("#subbroker").change(function(){
	   
		  $("#marketer").prop("disabled", false);
	 });
	 $("#marketer").change(function(){
	   
		  $("#agent").prop("disabled", false);
	});
	});

</script>
<script>
function marketer_list(id)
{
	//alert('this id value :'+id);
	 $.ajax({ type: "POST",
                    url: '<?php echo site_url('report/marketer_list/').'/';?>'+id,
                    data: id='subid',
                    success: function(datas){
                        //alert(datas);
                        $('#marketer').html(datas);
                },
});

}
function agent_list(id)
{
	//alert('this id value :'+id);
	 $.ajax({ type: "POST",
                    url: '<?php echo site_url('report/agent_list/').'/';?>'+id,
                    data: id='mid',
                    success: function(datas){
                        //alert(datas);
                        $('#agent').html(datas);
                },
});

}

</script>

<?php echo link_tag('colorbox/colorbox.css'); ?> 
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>colorbox/jquery.colorbox.js"></script> 
<script language="javascript" type="text/javascript">
  $(document).ready(function(){
		
		$('.colorbox').colorbox({'width':'60%','height':'70%'});
	
  });
</script>
<!-- #content -->
<div id="content"> 
  <!-- breadcrumbs -->
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('report');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
      <li> Reports </li>
    </ul>
  </div>
  <!-- /breadcrumbs --> 
  
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span><?php echo "Reports"; ?> <img src="<?php echo base_url(); ?>images/csv.jpeg" alt="" title="Export as CSV file" width="20" height="20"/>&nbsp;CSV </span></h2>
    </div>
     
     <div class="box-content"> <?php echo form_open('report/reportsearch',array('class'=>'formBox','id'=>'frmsearch')); ?>
      <fieldset>
        
        <!-- Error form message -->
        
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
								  
				<div class="lab" id="lab_text">
					<label for="keysearch">Search Subbroker</label>
				  </div>
				   <div class="con" id="con_text"> 
					    <select name="subbroker" id="subbroker" class="select" onChange="marketer_list(this.value)">
					      <option>All</option>
					      <?php for($i=0;$i<count($allsubbroker);$i++) {?>
							  <option value="<?php echo $allsubbroker[$i]['id'];?>"><?php echo $allsubbroker[$i]['name'];?></option>
						  <?php } ?>		  
                   	   </select>
				 </div>
				 
				<div class="lab" id="lab_text">
					<label for="keysearch">Search Marketer</label>
				  </div>
				 <div class="con" id="con_text"> 
					   <select name="marketer" id="marketer" class="select" onChange="agent_list(this.value)" disabled>
					      <option>All</option>
					      	
                   	   </select>
				 </div>
				 
				<div class="lab" id="lab_text">
					<label for="keysearch">Search Agent</label>
				  </div>
				  <div class="con" id="con_text"> 
					   <select name="agent" id="agent" class="select" disabled>
					     <option>All</option>
					     
                   	   </select>
				</div>
				 
				<div class="lab" id="lab_text" >
								<label for="datepicker">Search Signup</label>
							  </div>
						  <div class="con" id="con_text" > 
							 <?php echo form_input(array('name'=>'fromdate','id'=>'datepicker','class'=>'input','value'=>$fromdate,'type'=>'text','placeholder'=>'Choose From date')); ?>
				            
				          </div> 
				
				<div class="lab" id="lab_text">
								<label for="datepicker_1">Date Range</label>
							  </div>
						  <div class="con" id="con_text"> 
							<?php echo form_input(array( 'name'=>'enddate','id'=>'datepicker1','class'=>'input','value'=>$enddate,'type'=>'text','placeholder'=>'Choose Till date')); ?>  
				             
				</div>
					 
			</div>
          </div>
          <div id="keysearcherror" style="display:none;" class="error" align="right">Enter Keyword.</div>
        </div>
        <div class="btn-submit"> 
          <!-- Submit form --> 
          <?php echo form_input(array('name'=>'btnsearch','id'=>'btnsearch','class'=>'button','type'=>'submit','value'=>'Search','style'=>'margin-left:-48px;','onclick'=>'function showtext()')); ?> or <a href="<?php echo site_url('report');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php echo form_close(); ?> 
    </div>
      
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
    
    <!-- table -->
    <style>
	.tab td {
		padding: 8px 10px;
	}
    .tab th {
		padding: 8px 10px;
	}
	</style>
	<?php if( count($reports) > 0 ) { ?>
    <!-- table -->
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        	<th>Name</th>
			<th>Signup</th>
			<th>Download report</th>
			<th>Action</th>
	  </tr>
		  <?php 
				$site = site_url();			
				$url = explode("/admincp",$site);
				$path = $url[0];
		  ?>
				
			<?php if($reports != ''){ ?>
				<div class="form-message correct">
					 <p><?php $counts=count($reports);echo "No.of.datas".'&nbsp;'.$counts;?></p>
				</div>
				<?php } else { ?>
					
					 <div class="form-message warning">
					  <p>No records found.</p>
					</div>
			<?php } ?>
			
			<?php if($_POST['fromdate'] != '') {?>
			<button name="total" id="total" class="button">Download TotalSignUp Details CSV</button>
			<?php } ?>
				<?php if(count($reports) > 0) { ?>
				<?php  foreach($reports as $search) {   
						    
									if($search['type']=='subbroker') { ?>
									  <tr>
										<td style="font-weight:bold;"><?php echo ucfirst(stripslashes($search['name']));?><input type="hidden" value="<?php echo stripslashes($search['id']);?>"></td>
										<td><?php echo stripslashes($search['signup']);?></td>
										<td><a href="<?php echo site_url('report/subbrokerdetails/'.$search['id']); ?>">Download subbroker-details CSV</a></td>
										<td width="100px"><a href="<?php echo site_url('report/view/'.$search['id']); ?>" title="View Detail of <?php echo stripslashes($search['name']); ?>" class="colorbox"><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a> </td>
									  </tr>
								
								     <?php }  ?>
															
								
								<?php if($search['type']=='marketer'){ ?>
									  <tr>
										<td style="font-weight:bold;"><?php echo ucfirst(stripslashes($search['name']));?><input type="hidden" value="<?php echo stripslashes($search['id']);?>"></td>
										<td><?php echo stripslashes($search['signup']);?></td>
										<td><a href="<?php echo site_url('report/marketerdetails/'.$search['id']); ?>">Download marketers details CSV</a></td>
										<td width="100px"><a href="<?php echo site_url('report/view/'.$search['id']); ?>" title="View Detail of <?php echo stripslashes($search['name']); ?>" class="colorbox"><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a> </td>

									  </tr>	 
								<?php } ?>
								
								<?php if($search['type']=='agent'){ ?>
									<tr>
										<td style="font-weight:bold;"><?php echo ucfirst(stripslashes($search['name']));?><input type="hidden" value="<?php echo stripslashes($search['id']);?>"></td>
										<td><?php echo stripslashes($search['signup']);?></td>
										<td><a href="<?php echo site_url('report/agentdetails/'.$search['id']); ?>">Download agents details CSV</a></td>
										<td width="100px"><a href="<?php echo site_url('report/view/'.$search['id']); ?>" title="View Detail of <?php echo stripslashes($search['name']); ?>" class="colorbox"><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a></td>

									</tr> 
								<?php } ?> 
								
								<?php if($_POST['fromdate'] != '') { ?>
									    <tr>
										<td style="font-weight:bold;"><?php echo stripslashes($search['company']);?><input type="hidden" value="<?php echo stripslashes($search['id']);?>"></td>
										<td><?php echo substr(stripslashes($search['registerdate']),0,10);?></td>
										<td><a href="<?php echo site_url('report/csv/signup'); ?>">Download SignUp details CSV</a></td>
										<td width="100px"><a href="<?php echo site_url('report/view/'.$search['id']); ?>" title="View Detail of <?php echo stripslashes($search['company']); ?>" class="colorbox"><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a></td>
									</tr>  
								<?php } ?> 
					  <?php }  ?>
	</table>
    <?php  /*if($this->pagination->create_links()) { ?>
    <tr style="background:#ffffff">
      <td></td>
      <td></td>
      <td></td>
      <td style="padding:10px"><div class="pagination"><?php echo $this->pagination->create_links(); ?></div></td>
    </tr>
    <?php } */?>
    <?php } 
	else { ?>
    <!-- Warning form message -->
    <?php /*<div class="form-message warning">
      <p>No records found.</p>
    </div> */?>
    <?php } ?>
<?php } ?>
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag"> </tr>
      <tr>
        <td><a href="<?php echo site_url('report/csv/allenable'); ?>" title="Export as CSV file"> Download Reports for Elite members that are currently Enabled status</a></td>
      	</tr>
      <tr>
        <td><a href="<?php echo site_url('report/csv/alldisable'); ?>" title="Export as CSV file"> Download Reports for all Elite members with Disabled accounts </a></td>
      </tr>
      <tr>
        <td><a href="<?php echo site_url('report/csv/allelite'); ?>" title="Export as CSV file"> Download Reports for all Enabled and Disabled accounts</a></td>
        </tr>
        <tr>
        <td><a href="<?php echo site_url('report/csv/allenablewithcode'); ?>" title="Export as CSV file">Download Reports for elite members that used a promotional code and a currently in Enabled Status</a></td>
        </tr>
        <tr>
        <td><a href="<?php echo site_url('report/csv/alldisablewithcode'); ?>" title="Export as CSV file">Download Reports for all Elite members with Disabled accounts that used a promotional code </a></td>
        </tr>
        <tr>
        <td><a href="<?php echo site_url('report/csv/callcenter'); ?>" title="Export as CSV file">Download Reports for all Elite members with call center checkout process </a></td>
      </tr>
      <tr>
      <td><a href="<?php echo site_url('report/csv/removedreviews'); ?>" title="Export as CSV file">Download Reports for all removed Reviews</a>
      </td>
      </tr>
      <tr>
      <td><a href="<?php echo site_url('report/csv/removedcomplaints'); ?>" title="Export as CSV file">Download Reports for all removed Complaints</a>
      </td>
      </tr>
    </table>
    <!-- /table --> 
    
  </div>
  <!-- /box --> 
  
</div>
<!-- /#content --> 

<!-- #sidebar -->
<?php include('leftmenu.php'); ?>
<!-- /#sidebar --> 

<!-- #footer --> 
<?php echo $footer; }?>

	
