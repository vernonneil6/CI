<?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'view' ) ) { ?>
<!-- box -->

<div class="box" id="popup">
  <div class="headlines">
    <h2><span>Subbroker details</span></h2>
  </div>
  <!-- table -->
  <table align="center" width="100%" cellspacing="10" cellpadding="5" border="0" id="detail">
     
    <?php if(count($subbroker) > 0) { ?>
		
    <tr>
      <td width="120"><b>Subbroker Name</b></td>
      <td><b>:</b></td>
      <td><?php echo ucfirst(stripcslashes($subbroker[0]['name'])); ?></td>
      <input type="hidden" name="subid" value="<?php $subbroker[0]['id']; ?>">
    </tr>
    
    
    <tr>
      <td width="120"><b>No.of.Marketers Allowed</b></td>
      <td><b>:</b></td>
      <td><?php echo stripcslashes($subbroker[0]['marketer']); ?></td>
    </tr>
    <tr>
      <td width="120"><b>No.of.Agents Allowed</b></td>
      <td><b>:</b></td>
      <td><?php echo stripcslashes($subbroker[0]['agent']); ?></td>
    </tr>
    
    <tr>
      <td width="180"><b>Total counts of Elitemembers Added<br>(Total Sales made)</b></td>
      <td><b>:</b></td>
      <td>
		  <?php $subbrokercount=count($subbroker_elite);
				$marketercount=count($marketer_elite);
				$agentcount=count($agent_elite); 
				$total=$subbrokercount+$marketercount+$agentcount;
		        if($total == 0) { 						
				  echo "No Sales Available";	
				} else {
				
				  echo $total;
				}
		  ?>
	  </td>
    </tr>
    
    <tr>
		  <td width="120"><b>Marketers Name list </b></td>
		  <td><b>:</b></td>
		  <td>			      
			   <ul>
				  <?php for($i=0;$i<count($m_list);$i++){ ?>
				  <li id="countshow"><?php echo ucfirst($m_list[$i]['name']);?></li>	  
				  <?php  }  ?>
			   </ul>
		  </td>
		 
    </tr>
   
    <tr>
		  <td width="120"><b>Marketers indvidual sales made</b></td>
		  <td><b>:</b></td>
		  <td>
			   <ul>
				  <?php foreach($marketer as $key => $value){ echo $key; ?>
						  <?php if(count($key) == 0){ ?>
							 <li>No Sales Available</li>
						  <?php } else { ?>	  
						  <li id="countshow"><?php echo ucfirst($key); echo "&nbsp;"."(".$value.")";?></li>	  
						  <?php  } ?>
				  <?php  } ?>
				  
			   </ul>
		  </td>
		 
    </tr>
    
     <tr>
		 <td width="120"><b>Agent Name list </b></td>
		  <td><b>:</b></td>
		  <td>
			  
			  <ul>
				  <?php for($i=0;$i<count($a_list);$i++){ ?>
				  <li id="countshow"><?php echo ucfirst($a_list[$i]['name']);?></li>	  
				  <?php  }  ?>
			  </ul>
			  
		  </td>
    </tr>
     <tr>
		 <td width="120"><b>Agent indvidual sales made</b></td>
		  <td><b>:</b></td>
		  <td>
			  
			  <ul>
				  <?php foreach($agent as $key => $value){ ?>
				  <li id="countshow"><?php echo ucfirst($key); echo "&nbsp;"."(".$value.")";?></li>	  
				  <?php  }  ?>
			  </ul>
			  
		  </td>
    </tr>
    
    
    <?php }  ?>
    
  </table>
  <!-- /table --> 
</div>
<!-- /box -->
<?php } 
else {?>
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
  $(function() {
    $( "#datepicker2" ).datepicker();
    $( "#format" ).change(function() {
      $( "#datepicker2" ).datepicker( "option", "dateFormat", $( this ).val() );
    });
  });
  
 
$(document).ready(function(){
$("#type").change(function(){
	if(this.value == 'signupdate'){
		$('#dateshow').show();
		$('#'+$(this).val()).show();
   }
   else
   {
	    $('#dateshow').hide();
   }
});
});

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
				  <div class="lab">
					<label for="keysearch">Keyword<span>*</span></label>
				  </div>
				  <div class="con"> 
					<?php echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search Reports by keyword')); ?> 
					<input type="hidden" name="searchdate" value="<?php echo date('Y-m-d H:i:s');?>">
				  </div>
				  <div class="lab" id="dates_text">
						<label for="datepicker_2">Search with date<span></span></label>
					  </div>
					  <div class="con" id="datescon_text"> 
						<?php echo form_input(array('name'=>'singledate','id'=>'datepicker2','class'=>'input','type'=>'text','placeholder'=>'Search Reports by signupdate')); ?>
		         </div>
				
					<div class="lab" id="lab_text">
						<label for="keysearch">Search options</label>
					  </div>
					  <div class="con" id="con_text">
					   <select name="type" id ="type" class="select" >
							   <option>Select options</option>
							   <option value="signupdate">SignUp-date</option>
							   <option value="broker">Broker</option>
							   <option value="marketer">Marketer</option>
							   <option value="agent">Agent</option>
					  </select>
					  </div>
				  
				
					 <div id="dateshow" style="display:none;">
						  <div class="lab" id="lab_text" >
								<label for="datepicker">From-date</label>
							  </div>
						  <div class="con" id="con_text" > 
							 <?php echo form_input(array( 'name'=>'fromdate','id'=>'datepicker','class'=>'input','type'=>'text','placeholder'=>'Choose from-date')); ?>
						 </div>
						  <div class="lab" id="lab_text">
								<label for="datepicker_1">Till-date</label>
							  </div>
						  <div class="con" id="con_text"> 
							<?php echo form_input(array( 'name'=>'enddate','id'=>'datepicker1','class'=>'input','type'=>'text','placeholder'=>'Choose to-date')); ?>  
						  </div>
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
        	<th>Type</th>
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
					
					<div class="form-message error1">
						<p id="error">No data to display</p>	
					</div>
			<?php } ?>
				<?php  foreach($reports as $search) {   
						
								if($_POST['type'] == 'broker')	{ ?>
									  <tr>
										<td style="font-weight:bold;"><?php echo $_POST['type'];?></td>        
										<td><?php echo ucfirst(stripslashes($search['name']));?><input type="hidden" value="<?php echo stripslashes($search['id']);?>"></td>
										<td><?php echo stripslashes($search['signup']);?></td>
										<td><a href="<?php echo site_url('report/subbrokerdetails/'.$search['id']); ?>">Download subbroker details</a></td>
										<td width="100px"><a href="<?php echo site_url('report/edit/'.$search['id']); ?>" title="Edit" class="ico ico-edit">Edit</a> <a href="<?php echo site_url('report/view/'.$search['id']); ?>" title="View Detail of <?php echo stripslashes($search['name']); ?>" class="colorbox"><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a> </td>
									  </tr>
									 
									  
								<?php }  ?>
								
								<?php if($_POST['type'] == 'marketer'){ ?>
									  <tr>
										<td style="font-weight:bold;"><?php echo $_POST['type'];?></td>        
										<td><?php echo stripslashes($search['name']);?><input type="hidden" value="<?php echo stripslashes($search['id']);?>"></td>
										<td><?php echo stripslashes($search['signup']);?></td>
										<td><a href="<?php echo site_url('report/csv/marketers'); ?>">Download marketers details</a></td>
										<td width="100px"><a href="<?php echo site_url('report/edit/'.$search['id']); ?>" title="Edit" class="ico ico-edit">Edit</a></td>
									  </tr>	 
								<?php } ?>
								
								<?php if($_POST['type'] == 'agent')	{ ?>
									<tr>
										<td style="font-weight:bold;"><?php echo $_POST['type'];?></td>        
										<td><?php echo stripslashes($search['name']);?><input type="hidden" value="<?php echo stripslashes($search['id']);?>"></td>
										<td><?php echo stripslashes($search['signup']);?></td>
										<td><a href="<?php echo site_url('report/csv/agents'); ?>">Download agents details</a></td>
										<td width="100px"><a href="<?php echo site_url('report/edit/'.$search['id']); ?>" title="Edit" class="ico ico-edit">Edit</a> </td>
									</tr> 
								<?php } ?> 
								
								<?php if($_POST['type'] == 'signupdate') { ?>
										<tr>
										<td style="font-weight:bold;">Sign-Up-Date</td>        
										<td><?php echo stripslashes($search['name']);?><input type="hidden" value="<?php echo stripslashes($search['id']);?>"></td>
										<td><?php echo stripslashes($search['signup']);?></td>
										<td><a href="<?php echo site_url('report/csv/signup'); ?>">Download SignUp details</a></td>
										<td width="100px"><a href="<?php echo site_url('report/edit/'.$search['id']); ?>" title="Edit" class="ico ico-edit">Edit</a></td>
									</tr>  
								<?php } ?> 
					  <?php }  ?>
	</table>
    <?php  if($this->pagination->create_links()) { ?>
    <tr style="background:#ffffff">
      <td></td>
      <td></td>
      <td></td>
      <td style="padding:10px"><div class="pagination"><?php echo $this->pagination->create_links(); ?></div></td>
    </tr>
    <?php } ?>
    <?php } 
	//else { ?>
    <!-- Warning form message -->
    <?php /*<div class="form-message warning">
      <p>No records found.</p>
    </div>*/?>
    <?php //} ?>
	
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

	
