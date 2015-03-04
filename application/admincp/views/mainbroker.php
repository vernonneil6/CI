<?php echo $header; ?>
<script type="text/javascript" src="js/brokerform.js"></script>
<div id="content">
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('mainbroker');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
    </ul>
  </div>

<!-- Correct form message -->
<?php if( $this->session->flashdata('success') ) { ?>
<div class="form-message correct">
  <p><?php echo $this->session->flashdata('success'); ?></p>
</div>
<?php } ?>
<!-- Error form message -->
<?php if( $this->session->flashdata('error') ) { ?>
<div class="form-message error">
  <p><?php echo $this->session->flashdata('error'); ?></p>
</div>
<?php } ?>

<?php if( $this->uri->segment(1)=='mainbroker' && $this->uri->segment(2) == 'add' ) { ?>

	
<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Add Subbroker" ?></span></h2>
    </div>
    <div class="box-content"> 
    	<?php echo form_open('mainbroker/add',array('class'=>'formBox broker','id'=>'frmbrokeradd')); ?>
	 <fieldset>
        <div class="clearfix">
          <div class="lab">
            <label for="name">Add under Broker</label><?php echo $data;?>
          </div>
          <div class="con">
        <select name="mainbrokerid" id="mainbrokerid" class="select" >
			  <option value="0">Select Broker</option>
			  <?php for($i=0;$i<count($brokertype);$i++) {?>
				<option value="<?php echo $brokertype[$i]['id'];?>"><?php echo ucfirst($brokertype[$i]['name']);?></option>
			  <?php } ?>		  
		   </select>
          </div>
          <div id="selecterror" class="error">Please choose an option</div> 
        </div>
        <div class="clearfix">
          <div class="lab">
            <label for="name">Subbroker Name<div style="font-size:10px;">(Also the username)</div></label><?php echo $data;?>
          </div>
          <div class="con">
		 <input type="hidden" class="input" name="usercheck" id="usercheck" value="" >
		 <input type="hidden" class="input" name="brokertype" id="brokertype" value="subbroker" >	  
         <input type="text" class="input" name="username" id="username" required>
          </div>
          <div id="nameexisterror" class="error">Subbrokername already Exist.</div> 
        </div>
     <div class="clearfix">
          <div class="lab">
            <label for="name">Password</label><?php echo $data;?>
          </div>
          <div class="con">
         <input type="password" class="input" name="password" required>
          </div>
        </div>
	<div class="clearfix">
          <div class="lab">
            <label for="broker">Number of Allowed Marketers</label>
          </div>
	<div class="con">
	 <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'marketer','required'=>'required')); ?>
	</div>
        </div>
	<div class="clearfix">
          <div class="lab">
            <label for="broker">Number of Allowed Agents</label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'agent','required'=>'required')); ?>
		</div>
    </div>
    <div class="clearfix">
          <div class="lab">
            <label>Company Name</label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'companyname')); ?>
		</div>
    </div>
    <div class="clearfix">
          <div class="lab">
            <label>Company Contact Name</label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'companycontactname')); ?>
		</div>
    </div>
    <div class="clearfix">
          <div class="lab">
            <label>Email Address</label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'emailaddress')); ?>
		</div>
    </div>
    <div class="clearfix">
          <div class="lab">
            <label>Phone</label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'phone')); ?>
		</div>
    </div>
    <div class="clearfix">
          <div class="lab">
            <label>Address </label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'address')); ?>
		</div>
    </div>
    <div class="clearfix">
          <div class="lab">
            <label>ID #</label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'id')); ?>
		</div>
    </div>
        <?php echo form_input(array('name'=>'submitbroker','id'=>'submitbroker','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
      </fieldset>
       <?php echo form_close(); ?>
    </div>
</div>
<?php
}
if($this->uri->segment(1)=='mainbroker' && $this->uri->segment(2) == 'subbroker' )
{
?>
<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Main Broker" ?></span></h2>
    </div>
    <div class="box-content"> 
 <style>
 .tab th, .tab td{padding: 8px 17px;}
 
 </style>
	<table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <td width="30%">Subbroker-name</td>
        <td width="20%">Type</td>
		<td width="20%">Marketer</td>
        <td width="20%">Agent</td>
        <td width="20%">Action</td>
        <td width="20%">Download report</td>
      </tr>
      <?php
	foreach($subbroker as $subbrokerview)
	{
	?>
	<tr>
		<td width="30%"><?php echo ucfirst($subbrokerview['name']); ?></td>
        <td width="20%"><?php echo ucfirst($subbrokerview['type']); ?></td>
		<td width="20%"><?php echo $subbrokerview['marketer']; ?></td>
        <td width="20%"><?php echo $subbrokerview['agent']; ?></td>
        <td width="100px"><a href="<?php echo site_url('mainbroker/view/'.$subbrokerview['id']); ?>" title="View Detail of <?php echo stripslashes($subbrokerview['name']); ?>" ><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a> 
        
        <a class="ico ico-delete" onclick="return confirm('Are you sure to Delete this Main Broker?');" title="Delete" href="<?php echo site_url('mainbroker/delete/'.$subbrokerview['id']); ?>">Delete</a>
		<a class="ico ico-edit" title="Edit" href="<?php echo site_url('mainbroker/edit/'.$subbrokerview['id']); ?>">Edit</a>
        </td>
        <td width="20%"><a href="<?php echo site_url('mainbroker/getmycsv/'.$subbrokerview['id'].'/'.'subbroker');?>">Elite csv</td>
        
	</tr>
	<?php
	}
	?> 
	</table >
   </div>
</div>
<?php
}
if($this->uri->segment(1)=='mainbroker' && $this->uri->segment(2) == '' )
{
?>
<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Main Broker" ?></span></h2>
    </div>
    <div class="box-content"> 
 <style>
 .tab th, .tab td{padding: 8px 17px;}
 
 </style>
	<table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <td>Broker-name</td>
        <td>Type</td>
        <td>Subbroker</td>
		<td>Marketer</td>
        <td>Agent</td>
        <td>Action</td>
        <td>Download report</td>
      </tr>
      <?php
	foreach($broker as $subbrokerview)
	{
		
	?>
	<tr>
		<td><?php echo ucfirst($subbrokerview['name']); ?></td>
        <td><?php echo ucfirst($subbrokerview['type']); ?></td>
        <td><?php echo ucfirst($subbrokerview['subbroker']); ?></td>
		<td><?php echo $subbrokerview['marketer']; ?></td>
        <td><?php echo $subbrokerview['agent']; ?></td>
        <td><a href="<?php echo site_url('mainbroker/brokerview/'.$subbrokerview['id']); ?>" title="View Detail of <?php echo stripslashes($subbrokerview['name']); ?>" ><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a> 
        
        <a class="ico ico-delete" onclick="return confirm('Are you sure to Delete this Broker?');" title="Delete" href="<?php echo site_url('mainbroker/bdelete/'.$subbrokerview['id']); ?>">Delete</a>
		<a class="ico ico-edit" title="Edit" href="<?php echo site_url('mainbroker/brokeredit/'.$subbrokerview['id']); ?>">Edit</a>
        </td>
        <td><a href="<?php echo site_url('mainbroker/getmycsv/'.$subbrokerview['id'].'/'.'broker');?>">Elite csv</td>
        
	</tr>
	<?php
	}
	?> 
	</table >
   </div>
</div>
<?php
}
if( $this->uri->segment(1) == 'mainbroker' && $this->uri->segment(2) == 'elitemember' )
{
?>
<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Elite Member" ?></span></h2>
    </div>
    <div class="box-content"> 

	<table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <td width="30%">Elite-name</td>
        <td width="30%">Brokername</td>
        <td width="20%">Type</td>
		<td width="20%">Email</td>
      </tr>
     <?php
	foreach($subbroker as $subbrok)
	{
	foreach($subbrok as $subbrokers)
	{
	?>
	<tr>
		<td width="30%"><?php echo ucfirst($subbrokers['yccompany']); ?></td>
		<td width="20%"><?php echo ucfirst($subbrokers['ybname']);?></td>
		<td width="20%"><?php echo $subbrokers['ybtype']; ?></td>
		<td width="20%"><?php echo $subbrokers['ycemail']; ?></td>
    </tr>
	<?php
	}
	}
	?> 
   </table>
   </div>
</div>	
<?php
}
if($this->uri->segment(1) == 'mainbroker' && $this->uri->segment(2) == 'marketer')
{
?>
<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Main broker" ?></span></h2>
    </div>
    <div class="box-content"> 

	<table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <td width="30%">Marketer-name</td>
        <td width="20%">Type</td>
	    <td width="20%">Action</td>
	    <td width="20%">Download report</td>
      </tr>
      <?php
	foreach($marketers as $subbrokerview)
	{
	?>
	<tr>
		<td width="30%"><?php echo ucfirst($subbrokerview['name']); ?></td>
        <td width="20%"><?php echo ucfirst($subbrokerview['type']); ?></td>
		<td width="100px"><a href="<?php echo site_url('mainbroker/mview/'.$subbrokerview['id']); ?>" title="View Detail of <?php echo stripslashes($subbrokerview['name']); ?>" ><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a><a class="ico ico-edit" title="Edit" href="<?php echo site_url('mainbroker/medit/'.$subbrokerview['id']); ?>">Edit</a> 
		<a class="ico ico-delete" onclick="return confirm('Are you sure to Delete this Main Broker?');" title="Delete" href="<?php echo site_url('mainbroker/mdelete/'.$subbrokerview['id']); ?>">Delete</a>
		</td>
		<td width="20%"><a href="<?php echo site_url('mainbroker/getmycsv/'.$subbrokerview['id'].'/'.'marketer');?>">Elite csv</td>
	      
	</tr>
	<?php
	}
	?> 
	</table >
   </div>
</div>
<?php
}
if($this->uri->segment(1) == 'mainbroker' && $this->uri->segment(2) == 'agent') {
?>
<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Main broker" ?></span></h2>
    </div>
    <div class="box-content"> 

	<table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <td width="30%">Agent-name</td>
        <td width="20%">Type</td>
	    <td width="20%">Action</td>
	    <td width="20%">Download report</td>
      </tr>
      <?php
	foreach($agents as $subbrokerview)
	{
	?>
	<tr>
		<td width="30%"><?php echo ucfirst($subbrokerview['name']); ?></td>
        <td width="20%"><?php echo ucfirst($subbrokerview['type']); ?></td>
		<td width="100px"><a href="<?php echo site_url('mainbroker/aview/'.$subbrokerview['id']); ?>" title="View Detail of <?php echo stripslashes($subbrokerview['name']); ?>" ><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a><a class="ico ico-edit" title="Edit" href="<?php echo site_url('mainbroker/aedit/'.$subbrokerview['id']); ?>">Edit</a> 
		<a class="ico ico-delete" onclick="return confirm('Are you sure to Delete this Main Broker?');" title="Delete" href="<?php echo site_url('mainbroker/adelete/'.$subbrokerview['id']); ?>">Delete</a>
		</td>
	   <td width="20%"><a href="<?php echo site_url('mainbroker/getmycsv/'.$subbrokerview['id'].'/'.'agent');?>">Elite csv</td> 
	</tr>
	<?php
	}
	?> 
	</table >
   </div>
</div>
<?php
}
if($this->uri->segment(1) == 'mainbroker' && $this->uri->segment(2) == 'nodetail')
{
?>
<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Broker details" ?></span></h2>
    </div>
    <div class="box-content"> 

	<table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <td width="30%"><div class="form-message warning">No Sales Records Found</div></td>
      </tr>
    </table >
   </div>
</div>
<?php
}
if($this->uri->segment(1)=='mainbroker' && $this->uri->segment(2) == 'marketeradd')
{
?>
<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Add Marketer" ?></span></h2>
    </div>
    <div class="box-content"> 
    	<?php echo form_open('mainbroker/marketeradd',array('class'=>'formBox broker','id'=>'frmbrokeradd')); ?>
	 <fieldset>
		 <div class="clearfix">
          <div class="lab">
            <label for="name">Add under Subbroker</label><?php echo $data;?>
          </div>
          <div class="con">
        <select name="subbrokerid" id="subbrokerid" class="select" required>
			  <option value="0">Select Subbroker</option>
			  <?php for($i=0;$i<count($subbrokertype);$i++) {?>
				<option value="<?php echo $subbrokertype[$i]['id'];?>"><?php echo ucfirst($subbrokertype[$i]['name']);?></option>
			  <?php } ?>		  
		   </select>
          </div>
           <div id="selecterror" class="error">Please choose an option</div> 
        </div>
        <div class="clearfix">
          <div class="lab">
            <label for="name">Marketer Name<div style="font-size:10px;">(Also the username)</div></label><?php echo $data;?>
          </div>
          <div class="con">
		 <input type="hidden" class="input" name="usercheck" id="usercheck" value="" >
		 <input type="hidden" class="input" name="brokertype" id="brokertype" value="marketer" >	  
         <input type="text" class="input" name="username" id="username" required>
          </div>
          <div id="nameexisterror" class="error">Marketername already Exist.</div> 
        </div>
     <div class="clearfix">
          <div class="lab">
            <label for="name">Password</label><?php echo $data;?>
          </div>
          <div class="con">
         <input type="password" class="input" name="password" required>
          </div>
        </div>
	
    <div class="clearfix">
          <div class="lab">
            <label>Company Name</label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'companyname')); ?>
		</div>
    </div>
    <div class="clearfix">
          <div class="lab">
            <label>Company Contact Name</label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'companycontactname')); ?>
		</div>
    </div>
    <div class="clearfix">
          <div class="lab">
            <label>Email Address</label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'emailaddress')); ?>
		</div>
    </div>
    <div class="clearfix">
          <div class="lab">
            <label>Phone</label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'phone')); ?>
		</div>
    </div>
    <div class="clearfix">
          <div class="lab">
            <label>Address </label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'address')); ?>
		</div>
    </div>
    <div class="clearfix">
          <div class="lab">
            <label>ID #</label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'id')); ?>
		</div>
    </div>
        <?php echo form_input(array('name'=>'submitbroker','id'=>'submitbroker','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
      </fieldset>
       <?php echo form_close(); ?>
    </div>
</div>


<?php
 } 
if($this->uri->segment(1)=='mainbroker' && $this->uri->segment(2) == 'agentadd')
{
?>
<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Add Agent" ?></span></h2>
    </div>
    <div class="box-content"> 
    	<?php echo form_open('mainbroker/agentadd',array('class'=>'formBox broker','id'=>'frmbrokeradd')); ?>
	 <fieldset>
		  <div class="clearfix">
          <div class="lab">
            <label for="name">Add under Marketer</label><?php echo $data;?>
          </div>
          <div class="con">
        <select name="marketerid" id="marketerid" class="select" required>
			  <option value="0">Select Marketer</option>
			  <?php for($i=0;$i<count($marketertype);$i++) {?>
				<option value="<?php echo $marketertype[$i]['id'];?>"><?php echo ucfirst($marketertype[$i]['name']);?></option>
			  <?php } ?>		  
		   </select>
          </div>
           <div id="selecterror" class="error">Please choose an option</div> 
        </div>
        <div class="clearfix">
          <div class="lab">
            <label for="name">Agent Name<div style="font-size:10px;">(Also the username)</div></label><?php echo $data;?>
          </div>
          <div class="con">
         <input type="text" class="input" name="username" id="username" required>
         <input type="hidden" class="input" name="usercheck" id="usercheck" value="" >
         <input type="hidden" class="input" name="brokertype" id="brokertype" value="agent" >
          </div>
          <div id="nameexisterror" class="error">Agent already Exist.</div> 
        </div>
     <div class="clearfix">
          <div class="lab">
            <label for="name">Password</label><?php echo $data;?>
          </div>
          <div class="con">
         <input type="password" class="input" name="password" required>
          </div>
        </div>
	
    <div class="clearfix">
          <div class="lab">
            <label>Company Name</label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'companyname')); ?>
		</div>
    </div>
    <div class="clearfix">
          <div class="lab">
            <label>Company Contact Name</label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'companycontactname')); ?>
		</div>
    </div>
    <div class="clearfix">
          <div class="lab">
            <label>Email Address</label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'emailaddress')); ?>
		</div>
    </div>
    <div class="clearfix">
          <div class="lab">
            <label>Phone</label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'phone')); ?>
		</div>
    </div>
    <div class="clearfix">
          <div class="lab">
            <label>Address </label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'address')); ?>
		</div>
    </div>
    <div class="clearfix">
          <div class="lab">
            <label>ID #</label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'id')); ?>
		</div>
    </div>
        <?php echo form_input(array('name'=>'submitbroker','id'=>'submitbroker','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
      </fieldset>
       <?php echo form_close(); ?>
    </div>
</div>

<?php
 } 
if($this->uri->segment(1)=='mainbroker' && $this->uri->segment(2) == 'brokeradd')
{
?>

<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Add Broker" ?></span></h2>
    </div>
    <div class="box-content"> 
    	<?php echo form_open('mainbroker/brokeradd',array('class'=>'formBox broker','id'=>'frmbrokeradd')); ?>
	 <fieldset>
        <div class="clearfix">
          <div class="lab">
            <label for="name">Broker Name<div style="font-size:10px;">(Also the username)</div></label><?php echo $data;?>
          </div>
          <div class="con">
		    <input type="text" class="input" name="username" id="username" required>
            <input type="hidden" class="input" name="usercheck" id="usercheck" value="" >
            <input type="hidden" class="input" name="brokertype" id="brokertype" value="broker" >
          </div>
        <div id="nameexisterror" class="error">Brokername already Exist.</div>  
        </div>
     <div class="clearfix">
          <div class="lab">
            <label for="name">Password</label><?php echo $data;?>
          </div>
          <div class="con">
         <input type="password" class="input" name="password" required>
          </div>
        </div>
	<div class="clearfix" >
          <div class="lab">
            <label for="broker">Number of Allowed Subbrokers</label>
          </div>
	<div class="con">
	 <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'subbroker','required'=>'required')); ?>
	</div>
	<div class="clearfix">
          <div class="lab">
            <label for="broker">Number of Allowed Marketers</label>
          </div>
	<div class="con">
	 <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'marketer','required'=>'required')); ?>
	</div>
        </div>
	<div class="clearfix">
          <div class="lab">
            <label for="broker">Number of Allowed Agents</label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'agent','required'=>'required')); ?>
		</div>
    </div>
    <div class="clearfix">
          <div class="lab">
            <label>Company Name</label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'companyname')); ?>
		</div>
    </div>
    <div class="clearfix">
          <div class="lab">
            <label>Company Contact Name</label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'companycontactname')); ?>
		</div>
    </div>
    <div class="clearfix">
          <div class="lab">
            <label>Email Address</label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'emailaddress')); ?>
		</div>
    </div>
    <div class="clearfix">
          <div class="lab">
            <label>Phone</label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'phone')); ?>
		</div>
    </div>
    <div class="clearfix">
          <div class="lab">
            <label>Address </label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'address')); ?>
		</div>
    </div>
    <div class="clearfix">
          <div class="lab">
            <label>ID #</label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'id')); ?>
		</div>
    </div>
        <?php echo form_input(array('name'=>'submitbroker','id'=>'submitbroker','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
      </fieldset>
       <?php echo form_close(); ?>
    </div>
</div>
<?php }?>
</div>
<script>
$(document).ready(function() {
	
	//brokername check
                  $("#username").blur(function() {
				  var brokername=$('#username').val();
				  if(brokername != "")
					  {
						 var requestData = {
								type: 'checkBrokername',
								username: $("#username").val(),
								btype: $("#brokertype").val()
							  };
						  $.ajax({
						   type: "POST",
						   url: "index.php/mainbroker/ajaxRequest",
						   data: requestData,
						   dataType:"json",
						   success: function(data){
							if(data.status=="success")
							{
							  $('#nameexisterror').hide();
							  $('#usercheck').val(data.checkname); 
							  return true;
							}
							else
							{
							  $('#nameexisterror').show();
							  $('#usercheck').val(data.checkname);
							  return false;
							}
						   }
						  });
					  }
                  });
              });

</script>
<?php include('leftmenu.php'); ?>
<?php echo $footer; ?>

