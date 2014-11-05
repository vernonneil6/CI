<?php echo $header; ?>


<div id="content">

  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('subbroker');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
    </ul>
  </div>

<?php if( $this->uri->segment(1)=='subbroker' && $this->uri->segment(2) == 'add' ) { ?>
<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Add Sub-Broker" ?></span></h2>
    </div>
<?php
if($brokerid==$this->session->userdata['youg_admin']['id'])
{
?>
	<?php
	if($marketercount==$remainingmarketercount and $agentcount==$remainingagentcount)
	{ 
	echo 'you have reached limits';	
	}
	else
	{
	?>
	<?php echo form_open('subbroker/add',array('class'=>'formBox broker')); ?>
	<fieldset>
	<div class="clearfix">
          <div class="lab">
            <label for="broker">Select Type</label>
          </div>
	<div class="con">
	 <?php
	if($marketercount!=$remainingmarketercount and $agentcount!=$remainingagentcount)
	{ 
 	$broker_list = array(
                  'marketeraccount'   => 'Marketer Account',
                  'agentaccount'   => 'Agent Account'
                );
        }
        else if($marketercount==$remainingmarketercount and $agentcount!=$remainingagentcount)
	{ 
 	$broker_list = array(
                  'agentaccount'   => 'Agent Account'
                );
        }
        else if($marketercount!=$remainingmarketercount and $agentcount==$remainingagentcount)
	{ 
 	$broker_list = array(
 		  'marketeraccount'   => 'Marketer Account'              
                );
        }
	 $classes = "class='select' id='brokername'";
 	echo form_dropdown('brokertype', $broker_list, 'subbroker',$classes);   
	?> 
	</div>
        </div>
        <?php
        if($marketercount==$remainingmarketercount and $agentcount!=$remainingagentcount)
	{ 
	?>
	<div class="clearfix">
          <div class="lab">
            <label for="broker">Select Marketer</label>
          </div>
	<div class="con">
	<select class='select'  name='marketername'>
		<option value='select'>Select</option>
		<?php
		 foreach($marketerview as $username)
		{
		?>
		<option value='<?php echo $username->username;?>'><?php echo $username->username;?></option>
		<?php
		}
		?>
	</select>	
	</div>
        </div>
        <?php
        }
        else
        {
        ?>
        <div class="clearfix"  id='marketername' style='display:none;'>
          <div class="lab">
            <label for="broker">Select Marketer</label>
          </div>
	<div class="con">
	<select class='select'  name='marketername'>
		<option value='select'>Select</option>
		<?php
		 foreach($marketerview as $username)
		{
		?>
		<option value='<?php echo $username->username;?>'><?php echo $username->username;?></option>
		<?php
		}
		?>
	</select>	
	</div>
        </div>
        <?php
        }
        ?>
	 <div class="clearfix">
          <div class="lab">
            <label for="name">Username</label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'brokername','class'=>'input','type'=>'text' ) ); ?>
          </div>
        </div>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Password</label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'brokerpassword','class'=>'input','type'=>'password' ) ); ?>
          </div>
        </div>
        <?php echo form_input(array('name'=>'submitbroker','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
      </fieldset>
      <?php echo form_close(); } ?>

<?php
}
else
{
?>
<h1>Contact Admin For Activating Sub-Broker</h1>
<?php
}
?>
</div>
<?php
}
else
{
?>
<div class="box">

    <div class="headlines">
      <h2><span><?php echo "Sub-Broker"  ?></span></h2>
    </div>

<?php
if($brokerid==$this->session->userdata['youg_admin']['id'])
{
?>
<table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <th width="40%">Type</th>
        <th width="40%">Username</th>
        <th width="7%">Password</th>
      </tr>
      <?php
	foreach($marketerview as $marketer)
	{
	?>
      <tr>
        <td><?php echo $marketer->type;?></td>
        <td><?php echo $marketer->username;?></td>
        <td><?php echo $marketer->password;?></td>
      </tr>
       <?php
	foreach($agentview as $marketers)
	{
	foreach($marketers as $agent)
	{
	if($marketer->id==$agent->marketerid)
	{ 
	?>
      <tr>
        <td><?php echo $agent->type;?></td>
        <td><?php echo $agent->username;?></td>
        <td><?php echo $agent->password;?></td>
      </tr>
      <?php
	}  
	}
	} 
	}
	 ?>
</table >
<?php
}
else
{
?>
<h1>Contact Admin For Activating Sub-Broker</h1>
<?php
}
?>
</div>
<?php
}
?>
</div>

<?php include('leftmenu.php'); ?>
<?php echo $footer; ?>


<script>
$(document).ready(function()
{
$('#brokername').change(function(){
var value=$('#brokername').val();
if(value=='agentaccount'){
$('#marketername').show();
}
else
{
$('#marketername').hide();
}
});
});
</script>