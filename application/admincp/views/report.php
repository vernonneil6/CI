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
		
		<!--For View details-->
	
	<!--Subbroker view popup-->	   		    
	<?php if($titletype[0]['type'] =='subbroker') { 
		?>
				  <?php foreach($elitemembers as $subbroker) {	?>
					
					  <tr>
						  <td><?php echo $subbroker['ybname']; ?></td>
						  <td><?php echo $subbroker['ybtype']; ?></td>
						  <td><?php echo $subbroker['yccompany']; ?></td>
						  <td><?php echo $subbroker['count']; ?></td>						  
						  <td><?php echo $subbroker['totalelites']; ?></td>
					  </tr>
					 
				<?php  } ?>	  
	<?php } ?>
	
	
	
	<!--Marketer view popup-->	 
	
	<?php if($titletype[0]['type'] =='marketer') { ?>
	          
	           <?php foreach($elitemembers as $marketer) { ?>
				     <tr>
						  <td><?php echo $marketer['ybname']; ?></td>
						  <td><?php echo $marketer['ybtype']; ?></td>
						  <td><?php echo $marketer['yccompany']; ?></td>
						  <td><?php echo $marketer['count']; ?></td>
						  <td><?php echo $marketer['totalelite']; ?></td>
					  </tr>
					 	
	           <?php  } ?>
	<?php  } ?>
	
	
	<!--agent view popup-->	 
	<?php if($titletype[0]['type'] =='agent') { ?>
	          
	           <?php foreach($elitemembers as $agent) {  ?>
				     
				<?php  if($agent['ybid']==$view_id and $agent['ybtype']=='agent') {   ?>
	
	                   <tr>
						  <td><?php echo $agent['ybname']; ?></td>
						  <td><?php echo $agent['ybtype']; ?></td>
						  <td><?php echo $agent['yccompany']; ?></td>
						  <td><?php echo $agent['count']; ?></td>
						  <td><?php echo $agent['totalelite']; ?></td>
					   </tr>
	             <?php } ?>
	
	           <?php  } ?>
	<?php  } ?>
	
	
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
function marketer_list(sel,id)
{
	var i = sel.selectedIndex;
	//alert(id);
	if (i != -1) {
		document.getElementById("subbrokername").value = sel.options[i].text;  
	   //alert(sel.options[i].text);
	  	 }
	//alert('this id value :'+id);
	 $.ajax({ type: "POST",
                    url: '<?php echo site_url('report/marketer_list/').'/';?>'+id,
                    data: id='subid',
                    success: function(datas){
                        //alert(datas);
                        $('#marketer').html(datas);
                        $('#agent').html('<option value="0">All</option>');
                       
                },
});

}

function agent_list(sel,id)
{
	
	var i = sel.selectedIndex;
	if (i != -1) {
		document.getElementById("marketername").value = sel.options[i].text;  
	 
	}
	$.ajax({ type: "POST",
                    url: '<?php echo site_url('report/agent_list/').'/';?>'+id,
                    data: id='mid',
                    success: function(datas){
                       
                        $('#agent').html(datas);
                },
});
}

function viewlist(sel,id)
{
	
	var i = sel.selectedIndex;
	if (i != -1) {
		document.getElementById("agentname").value = sel.options[i].text;  
	 
	}
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
      <li> Reportsearch </li>
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
					    <select name="subbroker" id="subbroker" class="select" onChange="marketer_list(this,this.value)">
					      <option value="0">All</option>
					      <?php for($i=0;$i<count($allsubbroker);$i++) {?>
							  <?php if($sub != $allsubbroker[$i]['id']) {?>
							  <option value="<?php echo $allsubbroker[$i]['id'];?>"><?php echo ucfirst($allsubbroker[$i]['name']);?></option>
						   <?php } else { ?>
							   <option value="<?php echo $allsubbroker[$i]['id'];?>" selected><?php echo ucfirst($allsubbroker[$i]['name']);?></option>
						  <?php } }?>		  
                   	   </select>
                   	   <input id="subbrokername" type="hidden" name="subbrokername"  />
				 </div>
				 
				<div class="lab" id="lab_text">
					<label for="keysearch">Search Marketer</label>
				  </div>
				 <div class="con" id="con_text"> 
					   <select name="marketer" id="marketer" class="select" onChange="agent_list(this,this.value)" disabled>
						  <?php if($_POST['marketer']==0) { ?>
						  <option value="0">All</option>
						  <?php }  else { ?>
						  <option value="<?php echo $_POST['marketer'];?>"><?php echo $_POST['marketername'];?></option>
						   <?php } ?> 	  	
                   	   </select>
                   	   <input type="hidden" name="marketername" value="" id="marketername">
				 </div>
				 
				<div class="lab" id="lab_text">
					<label for="keysearch">Search Agent</label>
				  </div>
				  <div class="con" id="con_text"> 
					   <select name="agent" id="agent" class="select"  onChange="viewlist(this,this.value)" disabled>
					  <?php if($_POST['agent']==0) {?> 
					      <option value="0">All</option>
					      <?php } else { ?>
						  <option value="<?php echo $_POST['agent'];?>" selected><?php echo $_POST['agentname'];?></option>
						  <?php } ?>
					  </select>
					  <input type="hidden" name="agentname" value="" id="agentname">
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
          <?php echo form_input(array('name'=>'btnsearch','id'=>'btnsearch','class'=>'button','type'=>'submit','value'=>'Search','style'=>'margin-left:-48px;','onclick'=>'showtext(); return false;')); ?> or <a href="<?php echo site_url('report');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <script>
		function showtext() {		  
		  var marketer = $("#marketer").val();
		  var marketername = $("#marketername").val();
		  var subbroker = $("#subbroker").val();
		  var subbrokername = $("#subbrokername").val();
		  var agent = $("#agent").val();
		  var agentname = $("#agentname").val();
		  var datepicker = $("#datepicker").val();
		  var datepicker1 = $("#datepicker1").val();
		  var mid = '';
		  var type = '';
		  var name = '';
		  if(subbroker!=0 && subbrokername!=''){ mid = subbroker; name = subbrokername; type = 'subbroker';  }
		  if(marketer!=0 && marketername!='' && marketer!='all'){ mid = marketer; name = marketername; type = 'marketer';}
		  if(agent!=0 && agentname!='' && agent!='all'){ mid = agent; name = agentname; type = 'agent';}
			if(mid!='' && datepicker=='' && datepicker1=='') {
				$("#dateLinks").hide();
				var getlink = '<a href="/admincp/report/subbrokerdetails/'+mid+'/'+type+'">Download broker-details CSV</a>';			
				$("#linksub").html(getlink);
				$("#linksub1").html(name);
				$("#showresults").show();
				$(".form-message.correct").show();
				$(".form-message.correct").css("opacity", "1");
				return false;
			}
			if(datepicker!='' || datepicker1!='' ) {
				var mtype = '';
				if(mid!='') mtype = '&	mid='+mid+'&type='+type;
				$("#showresults").hide();
				var getlink = '<a href="/admincp/report/signupdetailss?fromdates='+datepicker+'&todates='+datepicker1+''+mtype+'">Download Total EliteSales-Reports CSV</a>'
				$("#dateLinks").html(getlink);
				$("#dateLinks").show();
				$(".form-message.correct").show();
				$(".form-message.correct").css("opacity", "1");
				return false;
			}	
			var getlink = '<a href="/admincp/report/elitereport_csv">Download Total EliteSales-Reports CSV</a>'
			$("#dateLinks").html(getlink);
			$("#dateLinks").show();		
			$(".form-message.correct").show();	
			$(".form-message.correct").css("opacity", "1");
			return false;
		}
      </script>
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
	<?php if(count($reports) > 0){ ?>
				<div class="form-message correct">
					 <p><?php 
					    $counts=count($reports);
					    //echo "No.of.datas".'&nbsp;'.$counts;
					    echo "Results...".'&nbsp;';
					    ?>
				     </p>
				</div>
			 <?php if($_POST['subbroker']==0 and $_POST['marketername']==null and $_POST['agentname']==null and $_POST['fromdate']==null and $_POST['enddate']==null ) { ?>
					 
					<a href="<?php echo site_url('report/elitereport_csv'); ?>">Download Total Elitemembers-Reports CSV</a>
					
			 <?php }  ?>	 
			
	 <?php } ?>
			
			<?php if($_POST['fromdate'] != '') {?>
				<a href="<?php echo site_url('report/signupdetailss?fromdates='.$_POST['fromdate'].'&todates='.$_POST['enddate']); ?>">Download Total EliteSales-Reports CSV</a><br>
				<p>Date Range Searched &nbsp;<input type="text" name="from" class="dateinput" value="<?php echo $_POST['fromdate'];?>"> To <input type="text" name="end" class="dateinput" value="<?php echo $_POST['enddate'];?>"></p>
			<?php } ?>
			
	
    <!-- download csv links -->
    <div style="display:none;" class="form-message correct">
		  <p>Results...</p>
		</div>
    <div id="dateLinks" style="display:none;" ><a href="<?php echo site_url('report/signupdetailss?fromdates='.$_POST['fromdate'].'&todates='.$_POST['enddate']); ?>">Download Total EliteSales-Reports CSV</a><br></div>
    
    <table id="showresults" style="display:none;" class="tab tab-drag">
      <tr class="top nodrop nodrag">
        	<th>Name</th>
			<th>Download report</th>
			<!--<th>Action</th>-->
	  </tr>
	 <tr class="odd">
		<td  id="linksub1" style="font-weight:bold;">Roven<input type="hidden" value="1"></td>
		<td id="linksub"></td>
	 </tr>
		<?php if( count($reports) > 0 and $_POST['subbroker']!=0 and $_POST['fromdate']=='' ) { ?>
		  <?php 
				$site = site_url();			
				$url = explode("/admincp",$site);
				$path = $url[0];
		  ?>
				
			
						
			<?php if(count($reports) > 0) { ?>
				<?php  foreach($reports as $search) {   
						    
						          //subroker search
									if($search['type']=='subbroker' and $_POST['fromdate'] == '') { ?>
									  <tr>
										<td style="font-weight:bold;"><?php echo ucfirst(stripslashes($search['name']));?><input type="hidden" value="<?php echo stripslashes($search['id']);?>"></td>
										<td><?php echo stripslashes($search['signup']);?></td>
										<td><a href="<?php echo site_url('report/subbrokerdetails/'.$search['id']); ?>">Download broker-details CSV</a></td>
										<?php /*<td width="100px"><a href="<?php echo site_url('report/view/'.$search['id']); ?>" title="View Detail of <?php echo stripslashes($search['name']); ?>" class="colorbox"><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a> </td>*/?>
									  </tr>
								
								     <?php }  ?>
															
								<!--Marketer search-->
								<?php if($search['type']=='marketer'){ ?>
									  <tr>
										<td style="font-weight:bold;"><?php echo ucfirst(stripslashes($search['name']));?><input type="hidden" value="<?php echo stripslashes($search['id']);?>"></td>
										<td><?php echo stripslashes($search['signup']);?></td>
										<td><a href="<?php echo site_url('report/marketerdetails/'.$search['id']); ?>">Download marketers details CSV</a></td>
										<?php /*<td width="100px"><a href="<?php echo site_url('report/view/'.$search['id']); ?>" title="View Detail of <?php echo stripslashes($search['name']); ?>" class="colorbox"><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a> </td>*/?>

									  </tr>	 
								<?php } ?>
								
								<!--Agent search-->
								<?php if($search['type']=='agent'){ ?>
									<tr>
										<td style="font-weight:bold;"><?php echo ucfirst(stripslashes($search['name']));?><input type="hidden" value="<?php echo stripslashes($search['id']);?>"></td>
										<td><?php echo stripslashes($search['signup']);?></td>
										<td><a href="<?php echo site_url('report/agentdetails/'.$search['id']); ?>">Download agents details CSV</a></td>
										<?php /*<td width="100px"><a href="<?php echo site_url('report/view/'.$search['id']); ?>" title="View Detail of <?php echo stripslashes($search['name']); ?>" class="colorbox"><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a></td>*/?>

									</tr> 
								<?php } ?> 
								
								<!--Search with only SingUpdate And multiple date-->
								<?php if($_POST['fromdate'] != '' and $_POST['subbroker'] =='all') { ?>
									
									
									 <tr>
										<td style="font-weight:bold;"><?php echo stripslashes($search['company']);?><input type="hidden" value="<?php echo stripslashes($search['id']);?>"></td>
										<td><?php echo substr(stripslashes($search['registerdate']),0,10);?></td>
										<td><a href="<?php echo site_url('report/csv/signup'); ?>">Download Signup details CSV</a></td>
										<?php /*<td width="100px"><a href="<?php echo site_url('report/view/'.$search['id']); ?>" title="View Detail of <?php echo stripslashes($search['company']); ?>" class="colorbox"><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a></td>*/?>
									</tr>
									
										
								<?php } ?> 
								
								<!--subroker , marketer , agent search with Single date-->
								<?php if($_POST['fromdate'] != '' and $_POST['enddate'] =='') { ?>
									
									<tr>
										<td style="font-weight:bold;"><?php echo stripslashes($search['company']);?><input type="hidden" value="<?php echo stripslashes($search['id']);?>"></td>
										<td><?php echo substr(stripslashes($search['registerdate']),0,10);?></td>
										<!--<td><a href="<?php echo site_url('report/csv/signupdetailss'); ?>">Download Sub-Signup details CSV</a></td>-->
										<td><a href="<?php echo site_url('report/csv/signupdetailss'); ?>">--</a></td>
										<?php /*<td width="100px"><a href="<?php echo site_url('report/view/'.$search['id']); ?>" title="View Detail of <?php echo stripslashes($search['company']); ?>" class="colorbox"><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a></td>*/?>
									</tr>  
								<?php } ?> 
								
								<!--subroker,marketer,agent search with Multiple date-->
								<?php if($_POST['fromdate'] != '' and $_POST['enddate'] !='') { ?>
									
									<tr>
										<td style="font-weight:bold;"><?php echo stripslashes($search['company']);?><input type="hidden" value="<?php echo stripslashes($search['id']);?>"></td>
										<td><?php echo substr(stripslashes($search['registerdate']),0,10);?></td>
										<!--<td><a href="<?php echo site_url('report/csv/signupdetailss'); ?>">Download TotalSub-Signup details CSV</a></td>-->
										<td><a href="<?php echo site_url('report/csv/signupdetailss'); ?>">--</a></td>
										<?php /*<td width="100px"><a href="<?php echo site_url('report/view/'.$search['id']); ?>" title="View Detail of <?php echo stripslashes($search['company']); ?>" class="colorbox"><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a></td>*/?>
									</tr>  
								<?php } ?> 
															 
					  <?php }  ?>
					  
	</table>
    <?php } 
	else { ?>
    <?php } ?>
<?php } ?>
    <table class="tab tab-drag" style="margin-top:15px;">
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

	
