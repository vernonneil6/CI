<?php echo $header; ?>

<div id="content">
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('mainbroker');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
    </ul>
  </div>

<?php if( $this->uri->segment(1)=='mainbroker' && $this->uri->segment(2) == 'add' ) { ?>
<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Add Broker" ?></span></h2>
    </div>
    <div class="box-content"> 
    	<?php echo form_open('mainbroker/add',array('class'=>'formBox broker')); ?>
	 <fieldset>
        <div class="clearfix">
          <div class="lab">
            <label for="name">Subbroker Name</label><?php echo $data;?>
          </div>
          <div class="con">
         <input type="text" class="input" name="username" value="" required>
          </div>
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
        <?php echo form_input(array('name'=>'submitbroker','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
      </fieldset>
       <?php echo form_close(); ?>
    </div>
</div>
<?php
}
else
{
?>
<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Main Broker" ?></span></h2>
    </div>
    <div class="box-content"> 

	<table class="tab tab-drag">
      <tr class="top nodrop nodrag">
        <th width="30%">Subbroker</th>
        <th width="20%">Marketer</th>
	  <th width="20%">Agent</th>
        <th width="20%">Username</th>
        <th width="7%">Password</th>
      </tr>
      <?php
	foreach($brokerview as $subbroker)
	{
	if($subbroker->subbroker!='')
	{
       ?>
       <tr>
        <td><?php echo $subbroker->subbroker;?></td>
        <td></td>
        <td></td>
        <td></td>
	 <td></td>
      </tr>
	<?php
	}
	foreach($marketerview as $marketers)
	{
	foreach($marketers as $marketer)
	{
	if($subbroker->id == $marketer->brokerid)
	{
	?>
      <tr>
      	<td></td>
        <td><?php echo $marketer->type;?></td>
	<td></td>
        <td><?php echo $marketer->username;?></td>
        <td><?php echo $marketer->password;?></td>
      </tr>
       <?php
	foreach($agentview as $agents)
	{
	foreach($agents as $agent)
	{
	if($marketer->id == $agent->marketerid)
	{
	?>
      <tr>
      	<td></td>
	<td></td>
        <td><?php echo $agent->type;?></td>
        <td><?php echo $agent->username;?></td>
        <td><?php echo $agent->password;?></td>
      </tr>
       <?php
	}
	}
	}
	}
	}
	}
	}
	?> 
</table >
   </div>
</div>
<?php
}
?>
</div>
<?php include('leftmenu.php'); ?>
<?php echo $footer; ?>

<script type="text/javascript">
$(document).ready(function(){
$(function(){
  $("#company").autocomplete({
    source: "mainbroker/get_companyname" 
  });
});
});
</script>
