<?php echo $header; ?>
<div id="content">

<?php if($this->uri->segment(1)=='marketer' && $this->uri->segment(2)=='') { ?>
	
	<div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('marketer');?>" title="Dashboard">Dashboard</a></li>
    </ul>
  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Marketer Url" ?></span></h2>
    </div>
    <div class="broker_heading">Welcome to the YouGotRated Marketer dashboard. From here, you can manage your agents, see your staff's Elite Member signups, and more. Note you can also use this URL below to recruit new Elite members, and receive credit.</div>
    <table class="tab tab-drag">
     <tbody><tr class="top nodrop nodrag"> </tr>       
     <tr class="odd">
        <td>Subbroker Url</td>
        <td>
        <textarea cols='90' rows='10'>
			<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/signuppage/affid/'.$this->session->userdata['marketer_data'][0]->id;?>
        </textarea>
        </td>
	 </tr>
     </tbody>
    </table>
	</div>
	
<?php }?>



<?php if($this->uri->segment(1)=='marketer' && $this->uri->segment(2)=='agent') { ?>
 <div class="breadcrumbs">
    <ul>
	  <li class="home"><a href="<?php echo site_url('marketer');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('marketer/agent');?>" title="Agent">Agent</a></li>
    </ul>
  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Agent" ?></span></h2>
    </div>
    <div class="box-content"> 
			
	
     
	<?php if( count($allagent) > 0 ) { ?>
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
		<td>Username</td>
		<td>Password</td>
		<td>Signup</td>
		<td>Action</td>
      </tr>
      <?php foreach($allagent as $agents){ ?>
      <tr>
		<td><?php echo $agents['name']; ?></td>
        <td><?php echo $agents['password']; ?></td>
        <td><?php echo date('m-d-Y', strtotime($agents['signup'])); ?></td>
        <td class="action">
			<a href="<?php echo site_url('marketer/agentdelete/'.$agents['id']);?>" title="Delete" class="ico ico-delete" onClick="return confirm('Are you sure to Delete this Agent?');">Delete</a>
			<a href="<?php echo site_url('marketer/agentedit/'.$agents['id']); ?>" title="Edit" class="ico ico-edit">Edit</a>
		</td>
      </tr>
      <?php } ?>
    </table>
    <?php } ?>
    
	</div>
	</div>

<?php } ?>


<?php if($this->uri->segment(1)=='marketer' && $this->uri->segment(2)=='addagent') { ?>

	<div class="breadcrumbs">
		<ul>
		  <li class="home"><a href="<?php echo site_url('marketer');?>" title="Dashboard">Dashboard</a></li>
		  <li><a href="<?php echo site_url('marketer/addagent');?>" title="Add Agent">Add Agent</a></li>
		</ul>
	  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Add Agent" ?></span></h2>
    </div>
    <div class="box-content"> 
		
    <?php echo form_open('marketer/addagent',array('class'=>'formBox broker')); ?>
	<fieldset>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Agent Username</label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'agentname','class'=>'input','type'=>'text' ) ); ?>
          </div>
        </div>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Password</label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'agentpassword','class'=>'input','type'=>'password' ) ); ?>
          </div>
        </div>
        <?php echo form_input(array('name'=>'agentsubmit','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
	
      </fieldset>
       <?php echo form_close(); ?>
       
    </div>
	</div>
<?php } ?>

<?php if($this->uri->segment(1)=='marketer' && $this->uri->segment(2)=='agentedit') { ?>
	
	<div class="breadcrumbs">
		<ul>
		  <li class="home"><a href="<?php echo site_url('marketer');?>" title="Dashboard">Dashboard</a></li>
		  <li><a href="<?php echo site_url('marketer/agentedit');?>" title="Edit Agent">Edit Agent</a></li>
		</ul>
	  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Edit Agent" ?></span></h2>
    </div>
    <div class="box-content"> 
		
    <?php echo form_open('marketer/agentedit/'. $agentedits['id'],array('class'=>'formBox broker')); ?>
	<fieldset>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Agent Username</label>
          </div>
          <div class="con">
			 <input type="text" value = "<?php echo $agentedits['name'];?>"  class = "input" name = "agentname">
            <!--<php echo form_input( array( 'name'=>'agentname','class'=>'input','type'=>'text','value'=> $agentedit['name'] ) ); ?>-->
          </div>
        </div>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Password</label>
          </div>
          <div class="con">
			  <input type="password" value = "<?php echo $agentedits['password'];?>"  class = "input" name = "agentpassword">
            <!--<php echo form_input( array( 'name'=>'agentpassword','class'=>'input','type'=>'password','value'=> $agentedit['password'] ) ); ?>-->
          </div>
        </div>
        <?php echo form_input(array('name'=>'agentupdatesubmit','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
	
      </fieldset>
       <?php echo form_close(); ?>
       
    </div>
	</div>
	
<?php } ?>


<?php if($this->uri->segment(1)=='marketer' && $this->uri->segment(2)=='elitemember') {?>
	
	
	<div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('marketer');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('marketer/elitemember');?>" title="Elite Member">Elite Member</a></li>
    </ul>
  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Elite Member" ?></span></h2>
    </div>
    <div class="box-content"> 
			
	
     
		<?php if( count($elitemembers) > 0 ) { ?>
		<table class="tab tab-drag">
		  <tr class="top nodrop nodrag">
			<td>Name</td>
			<td>Type</td>
			<td>Company</td>
			<td>Email</td>
			<td>Phone</td>
			
		  </tr>
			<?php  
			foreach($elitemembers as $elite) 
			{ 
			if($elite['ybid']==$this->session->userdata['marketer_data'][0]->id and $elite['ybtype']=='marketer' and $elite['yctype']=='marketer') 
			{ 
			?>
			<tr>
				<td><?php echo $elite['ybname']; ?></td>
				<td><?php echo $elite['ybtype']; ?></td>
				<td><?php echo $elite['yccompany']; ?></td>
				<td><?php echo $elite['ycemail']; ?></td>
				<td><?php echo $elite['ycphone']; ?></td>
			</tr>
			<?php
			} 
			if($elite['ycmarketerid']==$this->session->userdata['marketer_data'][0]->id and $elite['ybtype']=='agent' and $elite['yctype']=='agent') 
			{	
			?>
			<tr>
				<td><?php echo $elite['ybname']; ?></td>
				<td><?php echo $elite['ybtype']; ?></td>
				<td><?php echo $elite['yccompany']; ?></td>
				<td><?php echo $elite['ycemail']; ?></td>
				<td><?php echo $elite['ycphone']; ?></td>
			</tr>
			<?php  
			} 
			}	
			?>
		</table>
		<?php } ?>
		
		
    
	</div>
	</div>
	
	
<?php } ?>

</div>

<?php include('marketerleftmenu.php'); ?>
<?php echo $footer; ?>
