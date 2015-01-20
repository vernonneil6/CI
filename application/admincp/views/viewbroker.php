<?php echo $header; ?>
<div id="content">
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('mainbroker');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
    </ul>
  </div>

<?php if( $this->uri->segment(1)=='mainbroker' && $this->uri->segment(2) == 'edit' ) { ?>
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
	
<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Edit Broker" ?></span></h2>
    </div>
    <div class="box-content"> 
    	<?php echo form_open('mainbroker/update',array('class'=>'formBox broker')); ?>
	 <fieldset>
        <div class="clearfix">
          <div class="lab">
            <label for="name">Subbroker Name<div style="font-size:10px;">(Also the username)</div></label><?php echo $data;?>
          </div>
          <div class="con">
         <input type="text" class="input" name="username" value="<?php echo $Brokers['name'] ?>" required>
         <input type="hidden" class="input" name="table_id" value="<?php echo $Brokers['id'] ?>" required>
          </div>
        </div>
     <div class="clearfix">
          <div class="lab">
            <label for="name">Password</label><?php echo $data;?>
          </div>
          <div class="con">
         <input type="password" class="input" name="password" value="<?php echo $Brokers['password'] ?>" required>
          </div>
        </div>
	<div class="clearfix">
          <div class="lab">
            <label for="broker">Number of Allowed Marketers</label>
          </div>
	<div class="con">
	 <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'marketer','required'=>'required','value'=>$Brokers['marketer'])); ?>
	</div>
        </div>
	<div class="clearfix">
          <div class="lab">
            <label for="broker">Number of Allowed Agents</label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'agent','required'=>'required','value'=>$Brokers['agent'])); ?>
		</div>
    </div>
    <div class="clearfix">
          <div class="lab">
            <label>Company Name</label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'companyname','value'=>$Brokers['companyname'])); ?>
		</div>
    </div>
    <div class="clearfix">
          <div class="lab">
            <label>Company Contact Name</label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'companycontactname','value'=>$Brokers['companycontactname'])); ?>
		</div>
    </div>
    <div class="clearfix">
          <div class="lab">
            <label>Email Address</label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'emailaddress','value'=>$Brokers['emailaddress'])); ?>
		</div>
    </div>
    <div class="clearfix">
          <div class="lab">
            <label>Phone</label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'phone','value'=>$Brokers['phone'])); ?>
		</div>
    </div>
    <div class="clearfix">
          <div class="lab">
            <label>Address </label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'address','value'=>$Brokers['address'])); ?>
		</div>
    </div>
    
    <div class="clearfix">
          <div class="lab">
            <label>ID #</label>
          </div>
		<div class="con">
		  <?php echo form_input(array('type'=>'text','class'=>'input','name'=>'id','value'=>$Brokers['id#'])); ?>
		</div>
    </div>
    
        <?php echo form_input(array('name'=>'btnupdate','class'=>'button','type'=>'submit','value'=>'Update'));  ?> or <a href="<?php echo site_url('mainbroker');?>" class="Cancel">Cancel</a>
      </fieldset>
       <?php echo form_close(); ?>
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

	<table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <td width="30%">Subbroker-name</td>
        <td width="20%">Type</td>
		<td width="20%">Marketer</td>
        <td width="20%">Agent</td>
        <td width="20%">Action</td>
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
        <td width="100px"><a href="<?php echo site_url('mainbroker/view/'.$subbrokerview['id']); ?>" title="View Detail of <?php echo stripslashes($subbrokerview['name']); ?>" ><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a> </td>
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
      </tr>
      <?php
	foreach($marketers as $subbrokerview)
	{
	?>
	<tr>
		<td width="30%"><?php echo ucfirst($subbrokerview['name']); ?></td>
        <td width="20%"><?php echo ucfirst($subbrokerview['type']); ?></td>
		<td width="100px"><a href="<?php echo site_url('mainbroker/mview/'.$subbrokerview['id']); ?>" title="View Detail of <?php echo stripslashes($subbrokerview['name']); ?>" ><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a> </td>
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
      </tr>
      <?php
	foreach($agents as $subbrokerview)
	{
	?>
	<tr>
		<td width="30%"><?php echo ucfirst($subbrokerview['name']); ?></td>
        <td width="20%"><?php echo ucfirst($subbrokerview['type']); ?></td>
		<td width="100px"><a href="<?php echo site_url('mainbroker/aview/'.$subbrokerview['id']); ?>" title="View Detail of <?php echo stripslashes($subbrokerview['name']); ?>" ><img width="16" height="17" border="0" src="images/detail.jpeg" alt="view"></a> </td>
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
?>
</div>
<?php include('leftmenu.php'); ?>
<?php echo $footer; ?>

