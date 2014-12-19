
<?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'view' ) ) { ?>
<!-- box -->

<div class="box">
  <div class="headlines">
    <h2><span>Subscription Detail</span></h2>
  </div>
  <!-- table -->
  <table align="center" width="100%" cellspacing="10" cellpadding="0" border="0">
    <?php if( count($subscription)>0 ) { ?>
    <tr>
      <td width="120"><b>Company Name</b></td>
      <td><b>:</b></td>
      <td><?php $company=$this->settings->get_company_byid($subscription[0]['company_id'])?>
      <?php if(count($company)>0) {?>
          <div class="task-photo"><?php echo stripslashes($company[0]['company']); ?></div>
          <?php } ?>
      </td>
    </tr>
        
    <tr>
      <td width="120"><b>Amount</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($subscription[0]['amount']);?></td>
    </tr>
    
    <tr>
      <td width="120"><b>txn id</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($subscription[0]['txn_id']);?></td>
    </tr>
    <tr>
      <td width="120"><b>Payment Date</b></td>
      <td><b>:</b></td>
      <td><?php echo date('M d Y',strtotime($subscription[0]['payment_date']));?></td>
    </tr>
    <tr>
      <td width="120"><b>Expire Date</b></td>
      <td><b>:</b></td>
      <td><?php echo date('M d Y',strtotime($subscription[0]['expires']));?></td>
    </tr>
    <tr>
      <td width="120"><b>Payment method</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($subscription[0]['paymentmethod']);?></td>
    </tr>
    <tr>
      <td width="120"><b>Subscribtion ID</b></td>
      <td><b>:</b></td>
      <td><?php echo stripslashes($subscription[0]['subscr_id']);?></td>
    </tr>
    
    <td></td>
        <?php /*?><td><?php echo date('d M Y',strtotime($subscriptions[$i]['payment_date']));?></td>
		<?php */?>
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
<?php echo $heading; ?>
<script type="text/javascript" language="javascript">
	function goto(a) {
		$('#formBox'+a).submit();
		}
</script>
<!-- #content -->

<div id="content">
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('elite');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
    </ul>
  </div>
  <?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'search' ) ) { ?>
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
      <h2><span>Search Elite Members</span></h2>
    </div>
    <div class="box-content"> <?php echo form_open('elite/searchelitemember',array('class'=>'formBox','id'=>'frmsearch')); ?>
      <fieldset>
        
        <!-- Error form message -->
        
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="keysearch">Keyword<span>*</span></label>
              </div>
              <div class="con"> <?php echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search elite member by name')); ?> </div>
            </div>
          </div>
          <div id="keysearcherror" style="display:none;" class="error" align="right">Enter Keyword.</div>
        </div>
        <div class="btn-submit"> 
          <!-- Submit form --> 
          <?php echo form_input(array('name'=>'btnsearch','id'=>'btnsearch','class'=>'button','type'=>'submit','value'=>'Search','style'=>'margin-left:-48px;')); ?> or <a href="<?php echo site_url('elite');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php echo form_close(); ?> </div>
  </div>
  <!-- /box-content -->
  <?php } 
  		elseif( $this->uri->segment(2) && ( $this->uri->segment(2) == 'subscriptions' ) ) { ?>
    <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span>Elite Subscription</span></h2>
    </div>
      <?php echo link_tag('colorbox/colorbox.css'); ?> 
  <script language="javascript" type="text/javascript" src="<?php echo base_url();?>colorbox/jquery.colorbox.js"></script> 
  <script language="javascript" type="text/javascript">
  $(document).ready(function(){
		//$('.colorbox').colorbox({'width':'55%'});
		$('.colorbox').colorbox({'width':'60%','height':'70%'});
	
	   
  });
</script>
    <?php if( count($subscriptions) > 0 ) { ?>
    <!-- table -->
    <style>
	
.tab th, .tab td {
    padding: 8px 15px !important;
    
}
	</style>
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <th width="15%">Company</th>
        <th width="10%">Type</th>
        <th width="75%">Transaction ID</th>
        <th width="7%">Action</th>
      </tr>
      <?php for($i=0;$i<count($subscriptions);$i++) { ?>
      <?php $company=$this->settings->get_company_byid($subscriptions[$i]['company_id'])?>
      <tr>
        <td><?php if(count($company)>0) {?>
          <div class="task-photo"><?php echo stripslashes($company[0]['company']);?></div>
          <?php } ?></td>
        <td><?php echo stripslashes($subscriptions[$i]['paymentmethod']);?></td>
        <td><?php echo stripslashes($subscriptions[$i]['txn_id']);?></td>
        <td><a href="<?php echo site_url('elite/view/'.$subscriptions[$i]['id']); ?>" title="" class="colorbox"><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a></td>
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
  <!-- /box-content -->
  <?php } 
    	else { ?>
  <!-- box -->
  <div class="box">
    <div class="headlines">
      <h2><span><?php echo "Elite Members"; ?></span></h2>
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
  <?php if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'searchresult' ) ) { ?>
   <div class="box-content"> <?php echo form_open('elite/searchelitemember',array('class'=>'formBox','id'=>'frmsearch')); ?>
      <fieldset>
        
        <!-- Error form message -->
        
        <div class="form-cols"><!-- two form cols -->
          <div class="col1">
            <div class="clearfix">
              <div class="lab">
                <label for="keysearch">Keyword<span>*</span></label>
              </div>
              <div class="con"> <?php echo form_input( array( 'name'=>'keysearch','id'=>'keysearch','class'=>'input','type'=>'text','placeholder'=>'Search elite member by name')); ?> </div>
            </div>
          </div>
          <div id="keysearcherror" style="display:none;" class="error" align="right">Enter Keyword.</div>
        </div>
        <div class="btn-submit"> 
          <!-- Submit form --> 
          <?php echo form_input(array('name'=>'btnsearch','id'=>'btnsearch','class'=>'button','type'=>'submit','value'=>'Search','style'=>'margin-left:-48px;')); ?> or <a href="<?php echo site_url('elite');?>" class="Cancel">Cancel</a> </div>
      </fieldset>
      <?php echo form_close(); ?> </div>
<?php } ?>
		  
    <?php if( count($elitemembers) > 0 ) { ?>
    <script language="javascript">
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
		alert("Select atleast one company");
		return false;
	}
	
	
	$('#get_id').submit();
}
</script><form action="elite/foo" id="get_id" method="post" class="formBox">
    <!-- table --><table class="">
      <tr class="">
      <td>
    <div style="height:25px;width:150px !important;" class="con">
    <select id="checktype" class="select" name="checktype" style="padding-top:1px;">
<option value="Disable">Disable</option>
</select>
	
                
              </div>
              </td> <td><a onclick="submitfrm();" title="Submit" style="cursor:pointer;">Submit</a></td>
    </tr>
    </table>
    </form>
    <table class="tab tab-drag elites">
      <tr class="top nodrop nodrag">
        <th width="7%"><input type="checkbox" id="selectall" name="maincheck"/></th>
        <th>Company</th>
        <th>Payment Amount</th>
        <th>Status</th>
        <th width="17%">Payment date</th>
        <th>Discount Code</th>
        <th>Payment details</th>
        <th>Business admin</th>
      </tr>
      <?php for($i=0;$i<count($elitemembers);$i++) { ?>
      <?php $company=$this->settings->get_company_byid($elitemembers[$i]['company_id'])?>
      <tr>
        <td><input type="checkbox" class="case" name="foo[]" value="<?php echo $elitemembers[$i]['company_id'];?>" /></td>
        <td><?php if(count($company)>0) {?>
          <div class="task-photo"><?php echo stripslashes($company[0]['company']); ?></div>
          <?php } ?></td>
        <td><?php echo stripslashes($elitemembers[$i]['payment_currency']).' '.$elitemembers[$i]['payment_amount'];?></td>
        <td><?php echo stripslashes($elitemembers[$i]['status']);?></td>
        <td><?php echo date('M d Y',strtotime($elitemembers[$i]['payment_date']));?></td>
        <td><?php echo stripslashes($elitemembers[$i]['discountcode']);?></td>
       <td width="100px"><a href="<?php echo site_url('elite/payview/'.$elitemembers[$i]['company_id']); ?>" title="View Detail of <?php echo stripslashes($elitemembers[$i]['company_id']); ?>" class="colorbox"><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a></td>
        <td>
        <form action="<?php echo $site_url;?>businessadmin/adminlogin/index/" method="post" id="formBox<?php echo $i;?>" class="formBox" target="_blank" style="padding-bottom:0px;">
        	<input name="user_name" id="user_name" type="hidden" value="<?php echo $company[0]['email'];?>" />
            <input name="user_pass" id="user_pass" type="hidden" value="<?php echo $company[0]['password'];?>"/>
 <input name="btnsubmitform" id="btnsubmitform<?php echo $i;?>" type="submit" value="Go" class="button" style="width:auto;" myid="<?php echo $i;?>" onclick="goto(this.id)" />
          </form>
        </td>
      </tr>
      <?php } ?>
    </table>
    
    <!-- /table --> 
    <!-- /pagination -->
    <?php  if($this->pagination->create_links()) { ?>
    <div class="pagination"> <?php echo $this->pagination->create_links(); ?> </div>
    <?php } ?>
    <!-- /pagination -->
    <?php } if( $this->uri->segment(2) && ( $this->uri->segment(2) == 'payview' ) ) {?>
	
	<table class="tab tab-drag">
		  <tr class="top nodrop nodrag">
			  <?php //echo '<pre>';print_r($payment);?>
			<th>Started date</th>
			<th>Subscription amount</th>
			<th>Payment date</th>
			<th>Expire date</th>
			<th>Total payments</th>
			<th>Status</th>
		  </tr>
		  <?php if($payment) { ?>
          <tr>
			<td><?php echo date('M d Y',strtotime($payment['startdate']));?></td>
			<td><?php echo '$'.$payment['amount'];?></td>
			<td><?php echo date('M d Y',strtotime($payment['payment_date']));?></td>
			<td><?php echo date('M d Y',strtotime($payment['expires']));?></td>
			<td><?php if($payment['subscription_paynumber']!='') {echo $payment['subscription_paynumber'].'/'.'12';} else { echo '0/12';} ?></td>
			<td><?php echo $payment['status'];?></td>
		  </tr>
        <?php } else { ?>
			<tr>
			 <td>No records found</td>
			 <td></td>
			 <td></td>
			 <td></td>
			 <td></td>
			 <td></td>
			</tr>
			
		<?php } ?>	
    </table>  
      
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
<?php echo $footer; ?> <?php } ?>
