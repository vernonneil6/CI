<?php echo $header; ?>
<div id="content">
	
	
<?php if($this->uri->segment(1)=='subbroker' && $this->uri->segment(2)=='') { ?>
 
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('marketer');?>" title="Dashboard">Dashboard</a></li>
    </ul>
  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Subbroker Url" ?></span></h2>
    </div>
    <table class="tab tab-drag">
     <tbody><tr class="top nodrop nodrag"> </tr>       
     <tr class="odd">
        <td>Subbroker Url</td>
        <td>
        <textarea cols='90' rows='10'>
			<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/signuppage/affid/'.$this->session->userdata['subbroker_data'][0]->id;?>
        </textarea>
        </td>
	 </tr>
     </tbody>
    </table>
	</div>
 
<?php } ?>


<?php if($this->uri->segment(1)=='subbroker' && $this->uri->segment(2)=='marketer') {?>
	
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('subbroker/agent');?>" title="agent">Agent</a></li>
    </ul>
  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Agent" ?></span></h2>
    </div>
    <div class="box-content"> 
			
	
     
	<?php if( count($allmarketer) > 0 ) { ?>
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
		<td>Username</td>
		<td>Password</td>
		<td>Signup</td>
      </tr>
      <?php foreach($allmarketer as $marketers){ ?>
      <tr>
		<td><?php echo $marketers['name']; ?></td>
        <td><?php echo $marketers['password']; ?></td>
        <td><?php echo $marketers['signup']; ?></td>
      </tr>
      <?php } ?>
    </table>
    <?php } ?>
    
	</div>
	</div>
	
<?php } ?>


<?php if($this->uri->segment(1)=='subbroker' && $this->uri->segment(2)=='addmarketer') {?>
	
 <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('subbroker/addmarketer');?>" title="addmarketer">Add Marketer</a></li>
    </ul>
  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Add Marketer" ?></span></h2>
    </div>
    <div class="box-content"> 
		
    	 <?php echo form_open('subbroker/addmarketer',array('class'=>'formBox broker')); ?>
	 <fieldset>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Marketer Name</label>
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


<?php if($this->uri->segment(1)=='subbroker' && $this->uri->segment(2)=='agent') { ?>
 <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('subbroker/agent');?>" title="agent">Agent</a></li>
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
      </tr>
      <?php foreach($allagent as $agents){ ?>
      <tr>
		<td><?php echo $agents['name']; ?></td>
        <td><?php echo $agents['password']; ?></td>
        <td><?php echo $agents['signup']; ?></td>
      </tr>
      <?php } ?>
    </table>
    <?php } ?>
    
	</div>
	</div>

<?php } ?>


<?php if($this->uri->segment(1)=='subbroker' && $this->uri->segment(2)=='addagent') { ?>

	<div class="breadcrumbs">
		<ul>
		  <li class="home"><a href="<?php echo site_url('subbroker/addagent');?>" title="addagent">Add Agent</a></li>
		</ul>
	  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Add Agent" ?></span></h2>
    </div>
    <div class="box-content"> 
		
    	 <?php echo form_open('subbroker/addagent',array('class'=>'formBox broker')); ?>
	 <fieldset>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Marketer Name</label>
          </div>
          <div class="con">
				<select name="agentmarketer" class="select">
					<?php foreach($marketername as $name) { ?>
						<option value="<?php echo $name['id']; ?>"><?php echo $name['name']; ?></option>
					<?php } ?>
				</select>
          </div>
    </div>
	<div class="clearfix">
          <div class="lab">
            <label for="name">Agent Name</label>
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


<?php if($this->uri->segment(1)=='subbroker' && $this->uri->segment(2)=='elitemember') {?>
	
	
	<div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('subbroker/elitemember');?>" title="elitemember">Elite Member</a></li>
    </ul>
  </div>


	<div class="box">
    <div class="headlines">
      <h2><span><?php echo "Elite Member" ?></span></h2>
    </div>
    <div class="box-content"> 
			
	
     
	<?php if( count($elitemembers) > 0 ) { //echo count($elitemembers); ?>
    <table class="tab tab-drag">
      <tr class="top nodrop nodrag">
		<td>Company</td>
		<td>Email</td>
		<td>Phone</td>
		<td>type</td>
      </tr>
      <?php 
      //echo '<pre>';//print_r($elitemembers);
      //$elitemember = array_unique($elitemembers);
      // $b1id='';
	  $i=0;
      foreach($elitemembers as $elite){ 
	  if($elite['yc1marketerid']=='' )
	  {
	  ?>
		<tr>
			<td><?php echo $elite['yb1name']; ?></td>
			<td><?php echo $elite['yc1company']; ?></td>
			<td><?php echo $elite['yc1email']; ?></td>
			<td><?php echo $elite['yc1phone']; ?></td>
			<td><?php echo $elite['yc1brokertype']; ?></td>
			<td><?php echo $elite['yb1id']; ?></td>
			<td><?php echo $elite['yb2id']; ?></td>
			<td><?php echo $elite['yb3id']; ?></td>
			<td><?php echo $elite['yc1brokerid']; ?></td>
			<td><?php echo $elite['yc2brokerid']; ?></td>
			<td><?php echo $elite['yc3brokerid']; ?></td>
			<td><?php echo $elite['yc1subbrokerid']; ?></td>
			<td><?php echo $elite['yc2subbrokerid']; ?></td>
			<td><?php echo $elite['yc3subbrokerid']; ?></td>
			
		</tr>
		<?php }// if($elite['yb1id'] == $elite['yc2subbrokerid'] and $elite['yb2id'] == $elite['yc2brokerid']) {  ?>
		<tr>
			<td><?php echo $elite['yb2name']; ?></td>
			<td><?php echo $elite['yc2company']; ?></td>
			<td><?php echo $elite['yc2email']; ?></td>
			<td><?php echo $elite['yc2phone']; ?></td>
			<td><?php echo $elite['yc2brokertype']; ?></td>
			
		</tr>
		<?php //} if($elite['yb1id'] == $elite['yc3subbrokerid'] and $elite['yb3id'] == $elite['yc3brokerid']) { ?>
		<tr>
			<td><?php echo $elite['yb3name']; ?></td>
			<td><?php echo $elite['yc3company']; ?></td>
			<td><?php echo $elite['yc3email']; ?></td>
			<td><?php echo $elite['yc3phone']; ?></td>
			<td><?php echo $elite['yc3brokertype']; ?></td>
			
		</tr>
	  <?php } //} ?>
    </table>
    <?php } ?>
    
	</div>
	</div>
	
	
<?php } ?>

</div>

<?php include('subbrokerleftmenu.php'); ?>
<?php echo $footer; ?>

