<?php echo $header; ?>
<div id="content">
	
<?php if($this->uri->segment(1)=='broker' && $this->uri->segment(2)=='') { ?>
 
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('marketer');?>" title="Dashboard">Dashboard</a></li>
    </ul>
  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Broker Url" ?></span></h2>
    </div>
    <div class = "broker_heading"><label>Welcome to your YouGotRated Broker dashboard! You can use the link below to recruit new Elite members, and when signed up - you will receive credit for the signup. You can also use the left column menu to create new Elite members, which will bring you to the creation form that will give you this credit.</label></div>
    <table class="tab tab-drag">
     <tbody>
	 <tr class="odd">
        <td>Broker Url</td>
        <td>
        <textarea cols='90' rows='10'>
			<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/signuppage/affid/'.$this->session->userdata['broker_data'][0]->id;?>
        </textarea>
        </td>
	 </tr>
     </tbody>
    </table>
	</div>
 
<?php } ?>


<?php if($this->uri->segment(1)=='broker' && $this->uri->segment(2)=='subbroker') {?>
	
  <div class="breadcrumbs">
    <ul>
	  <li class="home"><a href="<?php echo site_url('broker');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('broker/subbroker');?>" title="subbroker">subbroker</a></li>
    </ul>
  </div>
	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "subbroker" ?></span></h2>
    </div>
    <div class="box-content"> 
			
	
     
	<?php if( count($allsubbroker) > 0 ) { ?>
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
		<td>Username</td>
		<td>Password</td>
		<td>Signup</td>
		<td>Action</td>
                <td>Download report</td>
      </tr>
      <?php foreach($allsubbroker as $subbrokers){ ?>
      <tr>
		<td><?php echo $subbrokers['name']; ?></td>
        <td><?php echo $subbrokers['password']; ?></td>
        <td><?php echo date('m-d-Y', strtotime($subbrokers['signup'])); ?></td>
        <td class="action">
			<a href="<?php echo site_url('broker/deletesubbroker/'.$subbrokers['id']);?>" title="Delete" class="ico ico-delete" onClick="return confirm('Are you sure to Delete this Subbroker?');">Delete</a>
			<a href="<?php echo site_url('broker/editsubbroker/'.$subbrokers['id']); ?>" title="Edit" class="ico ico-edit">Edit</a>

		</td>
 <td><a href="<?php echo site_url('broker/getmycsv/'.$subbrokers['id'].'/'.'subbroker');?>">Elite csv</td>
      </tr>
      <?php } ?>
    </table>
    <?php } ?>
    
	</div>
	</div>
	
<?php } ?>


<?php if($this->uri->segment(1)=='broker' && $this->uri->segment(2)=='marketer') {?>
	
  <div class="breadcrumbs">
    <ul>
	  <li class="home"><a href="<?php echo site_url('broker');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('broker/marketer');?>" title="marketer">marketer</a></li>
    </ul>
  </div>
	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "marketer" ?></span></h2>
    </div>
    <div class="box-content"> 
			
	
     
	<?php if( count($allmarketer) > 0 ) { ?>
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
		<td>Username</td>
		<td>Password</td>
		<td>Signup</td>
		<td>Action</td>
                <td>Download report</td>
      </tr>
      <?php foreach($allmarketer as $subbrokers){ ?>
      <tr>
		<td><?php echo $subbrokers['name']; ?></td>
        <td><?php echo $subbrokers['password']; ?></td>
        <td><?php echo date('m-d-Y', strtotime($subbrokers['signup'])); ?></td>
        <td class="action">
			<a href="<?php echo site_url('broker/deletemarketer/'.$subbrokers['id']);?>" title="Delete" class="ico ico-delete" onClick="return confirm('Are you sure to Delete this marketer?');">Delete</a>
			<a href="<?php echo site_url('broker/editmarketer/'.$subbrokers['id']); ?>" title="Edit" class="ico ico-edit">Edit</a>

		</td>
 <td><a href="<?php echo site_url('broker/getmycsv/'.$subbrokers['id'].'/'.'marketer');?>">Elite csv</td>
      </tr>
      <?php } ?>
    </table>
    <?php } ?>
    
	</div>
	</div>
	
<?php } ?>
<?php if($this->uri->segment(1)=='broker' && $this->uri->segment(2)=='agent') {?>
	
  <div class="breadcrumbs">
    <ul>
	  <li class="home"><a href="<?php echo site_url('broker');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('broker/agent');?>" title="agent">agent</a></li>
    </ul>
  </div>
	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "agent" ?></span></h2>
    </div>
    <div class="box-content"> 
			
	
     
	<?php if( count($allagent) > 0 ) { ?>
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
		<td>Username</td>
		<td>Password</td>
		<td>Signup</td>
		<td>Action</td>
                <td>Download report</td>
      </tr>
      <?php foreach($allagent as $subbrokers){ ?>
      <tr>
		<td><?php echo $subbrokers['name']; ?></td>
        <td><?php echo $subbrokers['password']; ?></td>
        <td><?php echo date('m-d-Y', strtotime($subbrokers['signup'])); ?></td>
        <td class="action">
			<a href="<?php echo site_url('broker/deleteagent/'.$subbrokers['id']);?>" title="Delete" class="ico ico-delete" onClick="return confirm('Are you sure to Delete this Agent?');">Delete</a>
			<a href="<?php echo site_url('broker/editagent/'.$subbrokers['id']); ?>" title="Edit" class="ico ico-edit">Edit</a>

		</td>
 <td><a href="<?php echo site_url('broker/getmycsv/'.$subbrokers['id'].'/'.'agent');?>">Elite csv</td>
      </tr>
      <?php } ?>
    </table>
    <?php } ?>
    
	</div>
	</div>
	
<?php } ?>

<?php if($this->uri->segment(1)=='broker' && $this->uri->segment(2)=='addsubbroker') {?>
	
 <div class="breadcrumbs">
    <ul>
	  <li class="home"><a href="<?php echo site_url('broker');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('broker/addsubbroker');?>" title="Add subbroker">Add subbroker</a></li>
    </ul>
  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Add subbroker" ?></span></h2>
    </div>
    <div class="box-content"> 
		
    	 <?php echo form_open('broker/addsubbroker',array('class'=>'formBox broker')); ?>
	 <fieldset>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Subbroker Username</label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'subbrokername','class'=>'input','type'=>'text' ) ); ?>
          </div>
        </div>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Password</label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'subbrokerpassword','class'=>'input','type'=>'password' ) ); ?>
          </div>
        </div>
        <?php echo form_input(array('name'=>'subbrokersubmit','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
	
      </fieldset>
       <?php echo form_close(); ?>
       
    </div>
	</div>

	

<?php } ?>

<?php if($this->uri->segment(1)=='broker' && $this->uri->segment(2)=='addmarketer') {?>
	
 <div class="breadcrumbs">
    <ul>
	  <li class="home"><a href="<?php echo site_url('broker');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('broker/addmarketer');?>" title="Add subbroker">Add marketer</a></li>
    </ul>
  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Add marketer" ?></span></h2>
    </div>
    <div class="box-content"> 
		
    	 <?php echo form_open('broker/addmarketer',array('class'=>'formBox broker')); ?>
	 <fieldset>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Marketer Username</label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'marketername','class'=>'input','type'=>'text' ) ); ?>
          </div>
        </div>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Password</label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'marketerpassword','class'=>'input','type'=>'password' ) ); ?>
          </div>
        </div>
        <?php echo form_input(array('name'=>'marketersubmit','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
	
      </fieldset>
       <?php echo form_close(); ?>
       
    </div>
	</div>

	

<?php } ?>

<?php if($this->uri->segment(1)=='broker' && $this->uri->segment(2)=='addagent') {?>
	
 <div class="breadcrumbs">
    <ul>
	  <li class="home"><a href="<?php echo site_url('broker');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('broker/addagent');?>" title="Add agent">Add agent</a></li>
    </ul>
  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Add agent" ?></span></h2>
    </div>
    <div class="box-content"> 
		
    	 <?php echo form_open('broker/addagent',array('class'=>'formBox broker')); ?>
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

<?php if($this->uri->segment(1)=='broker' && $this->uri->segment(2)=='editsubbroker') {?>
	
 <div class="breadcrumbs">
    <ul>
	  <li class="home"><a href="<?php echo site_url('broker');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('broker/editsubbroker');?>" title="Edit subbroker">Edit subbroker</a></li>
    </ul>
  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Edit subbroker" ?></span></h2>
    </div>
    <div class="box-content"> 
		
    	 <?php echo form_open('broker/editsubbroker/'.$getsubbrokerdata['id'],array('class'=>'formBox broker')); ?> 
	 <fieldset>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Subbroker Username</label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'subbrokername','value' => $getsubbrokerdata['name'] ,'class'=>'input','type'=>'text' ) ); ?>
          </div>
        </div>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Password</label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'subbrokerpassword','value' => $getsubbrokerdata['password'],'class'=>'input','type'=>'password' ) ); ?>
          </div>
        </div>
        <?php echo form_input(array('name'=>'subbrokersubmit','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
	
      </fieldset>
       <?php echo form_close(); ?>
       
    </div>
	</div>

	

<?php } ?>

<?php if($this->uri->segment(1)=='broker' && $this->uri->segment(2)=='editmarketer') {?>
	
 <div class="breadcrumbs">
    <ul>
	  <li class="home"><a href="<?php echo site_url('broker');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('broker/editmarketer');?>" title="Edit marketer">Edit marketer</a></li>
    </ul>
  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Edit marketer" ?></span></h2>
    </div>
    <div class="box-content"> 
		
    	 <?php echo form_open('broker/editmarketer/'.$getmarketerdata['id'],array('class'=>'formBox broker')); ?> 
	 <fieldset>
	<div class="clearfix">
          <div class="lab">
            <label for="name">marketer Username</label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'marketername','value' => $getmarketerdata['name'] ,'class'=>'input','type'=>'text' ) ); ?>
          </div>
        </div>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Password</label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'marketerpassword','value' => $getmarketerdata['password'],'class'=>'input','type'=>'password' ) ); ?>
          </div>
        </div>
        <?php echo form_input(array('name'=>'marketersubmit','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
	
      </fieldset>
       <?php echo form_close(); ?>
       
    </div>
	</div>

	

<?php } ?>

<?php if($this->uri->segment(1)=='broker' && $this->uri->segment(2)=='editagent') {?>
	
 <div class="breadcrumbs">
    <ul>
	  <li class="home"><a href="<?php echo site_url('broker');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('broker/editagent');?>" title="Edit agent">Edit agent</a></li>
    </ul>
  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Edit agent" ?></span></h2>
    </div>
    <div class="box-content"> 
		
    	 <?php echo form_open('broker/editagent/'.$getagentdata['id'],array('class'=>'formBox broker')); ?> 
	 <fieldset>
	<div class="clearfix">
          <div class="lab">
            <label for="name">marketer Username</label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'agentname','value' => $getagentdata['name'] ,'class'=>'input','type'=>'text' ) ); ?>
          </div>
        </div>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Password</label>
          </div>
          <div class="con">
            <?php echo form_input( array( 'name'=>'agentpassword','value' => $getagentdata['password'],'class'=>'input','type'=>'password' ) ); ?>
          </div>
        </div>
        <?php echo form_input(array('name'=>'agentsubmit','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
	
      </fieldset>
       <?php echo form_close(); ?>
       
    </div>
	</div>

	

<?php } ?>


<?php if($this->uri->segment(1)=='broker' && $this->uri->segment(2)=='elitemembers') {?>
	
	<style>
        .tab th, .tab td{padding: 8px 10px; }
        </style>

	<div class="breadcrumbs">
		<ul>
		  <li class="home"><a href="<?php echo site_url('subbroker');?>" title="Dashboard">Dashboard</a></li>
		  <li><a href="<?php echo site_url('subbroker/elitemember');?>" title="Elite Member">Elite Member</a></li>
		</ul>
	</div>


	<div class="box">
		<div class="headlines">
		  <h2><span><?php echo "Elite Member" ?></span></h2>
		</div>
		<div class="box-content"> 
		<a href="<?php echo site_url('broker/getmycsv/'.$this->session->userdata['broker_data'][0]->id.'/'.'broker');?>">Download Total Broker Elite CSV Report</a>
		<?php if( count($brokers) > 0 ) { ?>
		<table class="tab tab-drag" style="font-size: 11px;">
		  <tr class="top nodrop nodrag">
			<td>Broker Name</td>
            <td>Subbroker Name</td>
			<td>Marketer Name</td>
			<td>Agent Name</td>
			<td>Type</td>
			<td>Company</td>
			<td>Email</td>
			<td>Date signed</td>
			<td>Monthly fee</td>
			<td>Status</td>
			
		  </tr>
		<?php
                foreach($brokers as $subbrok)
		{
		
		?>
		<tr>
			<td><?php echo ucfirst($subbrok['ycmainbrokerid']); ?></td>
                        <td><?php echo ucfirst($subbrok['ycsubbrokerid']); ?></td>
			<td><?php echo ucfirst($subbrok['ycmarketerid']); ?></td>
			<td><?php echo ucfirst($subbrok['ycbrokerid']); ?></td>
			<td><?php echo ucfirst($subbrok['ycbrokertype']);?></td>
			<td><?php echo $subbrok['yccompany']; ?></td>
			<td><?php echo $subbrok['ycemail']; ?></td>
			<td><?php echo $subbrok['ycreg']; ?></td>
			<td><?php echo $subbrok['ysamt']; ?></td>
			<td><?php echo $subbrok['ycstatus']; ?></td>
		
		</tr>
		<?php
		
		}
		?> 
		</table>
		<?php } ?>
		
		
		</div>
	</div>	
<?php } ?>


<?php if($this->uri->segment(1)=='broker' && $this->uri->segment(2)=='userprofile') { ?>
	
	<div class="breadcrumbs">
		<ul>
		  <li class="home"><a href="<?php echo site_url('broker');?>" title="Dashboard">Dashboard</a></li>
		  <li><a href="<?php echo site_url('broker/userprofile');?>" title="User Profile">User Profile</a></li>
		</ul>
	  </div>


	<div class="box">
		<div class="headlines">
		  <h2><span><?php echo "User Profile" ?></span></h2>
		</div>
		
		<div class="box-content"> 
		<?php echo form_open('broker/resetpassword/'.$getdata['id'], array('class'=>'formBox broker')); ?>	
		<fieldset>
			<div class="clearfix">
				  <div class="lab">
					<label>Username</label>
				  </div>
				  <div class="lab">
					<?php echo $getdata['name'] ?>
				  </div>
			</div>
			<div class="clearfix">
				  <div class="lab">
					<label>Password</label>
				  </div>
				  <div class="lab">
					<?php echo $getdata['password'] ?>
				  </div>
			 </div>
			 <?php echo form_input(array('name'=>'updatepassword','class'=>'button','type'=>'submit','value'=>'Update')); ?>
		 </fieldset>
		 
		 <?php echo form_close(); ?>
 
		</div>
	</div>
	
	
<?php } ?>

<?php if($this->uri->segment(1)=='broker' && $this->uri->segment(2)=='resetpassword') { ?>
	
	<?php if( $this->session->flashdata('success') ) { ?>
		<div class="lab form-message correct">
		  <p><?php echo $this->session->flashdata('success'); ?></p>
		</div>
    <?php } ?>
    
    <?php if( $this->session->flashdata('error') ) { ?>
		<div class="lab form-message error1">
		  <p><?php echo $this->session->flashdata('error'); ?></p>
		</div>
    <?php } ?>	
	
	<div class="breadcrumbs">
		<ul>
		  <li class="home"><a href="<?php echo site_url('broker');?>" title="Dashboard">Dashboard</a></li>
		  <li><a href="<?php echo site_url('broker/resetpassword');?>" title="Reset Password">Reset Password</a></li>
		</ul>
	</div>


	<div class="box">
		<div class="headlines">
		  <h2><span><?php echo "User Profile" ?></span></h2>
		</div>
		
		<div class="box-content"> 
		<?php echo form_open('broker/resetpassword/'.$getdata['id'], array('class'=>'formBox broker')); ?>	
		<fieldset>
			<div class="clearfix">
				  <div class="lab">
					<label>Old Password</label>
				  </div>
				  <div class="con">
					 <?php echo form_input( array( 'name'=>'oldpassword', 'class'=>'input','type'=>'password','required'=>'required' ) ); ?>
				  </div>
			</div>
			<div class="clearfix">
				  <div class="lab">
					<label>New Password</label>
				  </div>
				  <div class="con">
					 <?php echo form_input( array( 'name'=>'password', 'class'=>'input','type'=>'password','required'=>'required' ) ); ?>
				  </div>
			 </div>
			 <div class="clearfix">
				  <div class="lab">
					<label>Retype Password</label>
				  </div>
				  <div class="con">
					 <?php echo form_input( array( 'name'=>'retypepassword','class'=>'input','type'=>'password','required'=>'required' ) ); ?>
				  </div>
			 </div>
			 <input type = "hidden" value = "<?php echo $getdata['password']; ?>" name = "pwd">
			 <?php echo form_input(array('name'=>'newpassword','class'=>'button','type'=>'submit','value'=>'Submit')); ?>
		 </fieldset>
		 <?php echo form_close(); ?>
		</div>
	</div>
	
	
<?php } ?>

</div>

<?php include('brokerleftmenu.php'); ?>
<?php echo $footer; ?>

