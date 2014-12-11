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










<?php if($this->uri->segment(1)=='subbroker' && $this->uri->segment(2)=='addelitemember') {?>
	
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
		
			<form class="formBox broker" action="solution/update" id="frmaddcompany" method="post" enctype="multipart/form-data">
			<fieldset>
            <label>INTRODUCE YOUR BUSINESS</label>
            
            <div class="reg_fld">THIS INFORMATION WILL BE PUBLISHED ON YOUGOTRATED'S BUSINESS DATABASE</div>
            
            
            <div class="clearfix">
			  <div class="lab">
				<label for="name">WHAT IS YOUR COMPANY NAME?</label>
			  </div>
			  <div class="con">
				<input type="text" class="input" placeholder="NAME" id="name" name="name"  maxlength="30">
				 <div id="nameerror" class="error">Name is required.</div>
				 <div id="nametknerror" class="error">This compnay name is already exists.</div>
			  </div>
			</div>
            
             <div class="clearfix">
			  <div class="lab">
				<label for="name">WHAT IS YOUR COMPANY WEBSITE?</label>
			  </div>
			  <div class="con">
				<input type="text" class="input" placeholder="WEBSITE" id="website" name="website"  maxlength="150">
				<div id="websiteerror" class="error">Website is required.</div>
			  </div>
			</div>
			
			<div class="clearfix">
			  <div class="lab">
				<label for="name">CATEGORY</label>
			  </div>
			  <div class="con">
					<div id="" style="overflow-y: scroll; height:180px;border: 1px solid #D9D9D9;width:100%;">
					<?php for($i=0;$i<count($categories);$i++) { ?>
					<?php  $option = array( 'name'=>'cat[]', 'id'=>'cat[]', 'value'=>$categories[$i]['id'],'class'=>'checkboxLabel' );
					echo form_checkbox( $option ); ?>
					&nbsp; <span style="color:#666666;"> <?php echo stripslashes($categories[$i]['category'])."<br/>";?> </span>
					<?php } ?>
					</div>
					<div id="websiteerror" class="error">Website is required.</div>
			  </div>
			</div>
			
			
			<div class="clearfix">
			  <div class="lab">
				<label for="name">YOUR EMAIL ADDRESS</label>
			  </div>
			  <div class="con">
					<div class="reg_fld">WHERE DO YOU RECEIVE YOUR E-MAIL?</div>
					<input type="email" class="input" placeholder="E-MAIL ADDRESS" id="email" name="email"  maxlength="250" onchange="chkmail(this.value);">
					<div id="emailerror" class="error">Enter valid Emailid.</div>
					<div id="emailtknerror" class="error">This Emailid already taken.</div>
			  </div>
			</div>
			
			
			<div class="clearfix">
			  <div class="lab">
				<label for="name">YOUR ADDRESS INFORMATION</label>
			  </div>
			  <div class="con">
				  
					<div class="reg_fld">WHAT IS YOUR ADDRESS?</div>
					<input type="text" class="input" placeholder="ADDRESS LINE" name="streetaddress" id="streetaddress" maxlength="50" />
					<br/>
					<style>
					.seldrop
					{
						background: none repeat scroll 0 0 #FFFFFF;
						border: 1px solid #000000;
						margin-top: 8px;
						width: 249px;
					}
					</style>
				  <div style="float:left;">
				   <?php echo form_dropdown('country',$selcon,'','id="country" class="seldrop" onchange="getstates(this.value);"');?>
				   </div>
				   <?php 
				  $selstate=array(''=>'--Select State--');
				  ?>
				  <div id="selstatediv" style="float:right;margin-right:127px;">
				  <?php echo form_dropdown('state',$selstate,'','id="state" class="seldrop"');?></div>
				  <br/>
					<input type="text" class="input" placeholder="CITY" id="city" name="city" maxlength="50" />					  
					<input type="text" class="input" placeholder="ZIP CODE" id="zip" name="zip" maxlength="10" />
					<div id="streetaddresserror" class="error">Street Address is required.</div>
					<div id="cityerror" class="error">City is required.</div>
					<div id="stateerror" class="error">State is required.</div>
					<div id="countryerror" class="error">Country is required.</div>
					<div id="ziperror" class="error">Zip Code is required.</div>
					<div id="zipverror" class="error">Enter digits only valid format 123456</div>
					<div style="margin-top:36px;" class="reg_fld">WHAT IS YOUR PHONE NUMBER?</div>
					<div>
					  <input type="text" class="input" placeholder="XXX-XXX-XXXX" name="phone" maxlength="12" id="phone">
					  <div id="phoneerror" class="error">Phone is required.</div>
					  <div id="phoneverror" class="error">Enter valid format - i.e. XXX-XXX-XXXX</div>
					</div>
					<div id="streeterror" class="error">Street Address is required.</div>
					<div id="cityerror" class="error">City is required.</div>
					<div id="stateerror" class="error">State is required.</div>
					<div id="streeterror" class="error">Street Address is required.</div>
					<div id="zipcodeerror" class="error">Enter digits only.</div>
					<div id="phonenoerror" class="error">Enter Phone number.</div>
            
            
			  </div>
			</div>
            
            
           <div class="clearfix">
			  <div class="lab">
				<label for="name">YOUR CONTACT INFORMATION</label>
			  </div>
			  <div class="con">
				<div class="reg_fld"><?php echo strtoupper('The following information will not be published YouGotRated and is used for administration purposes only.This information is where you will receive emails,and receipts from YouGotRated.com');?></div>
				<div class="reg_fld">CONTACT NAME</div>
				<input type="text" class="input" placeholder="CONTACT NAME" id="cname" name="cname" maxlength="30" /><div id="cnameerror" class="error">contact name is required.</div>
			  </div>
			</div>
			
			<div class="clearfix">
			  <div class="lab">
				<label for="name">CONTACT NUMBER</label>
			  </div>
			  <div class="con">
				 <input type="text" class="input" placeholder="XXX-XXX-XXXX" id="cphone" name="cphone" maxlength="12" /><div id="cphoneerror" class="error">Contactphone is required.</div>
				 <div id="cphoneverror" class="error">Enter valid format - i.e. XXX-XXX-XXXX</div>
			  </div>
			</div>
			
			<div class="clearfix">
			  <div class="lab">
				<label for="name">CONTACT EMAIL</label>
			  </div>
			  <div class="con">
				 <input type="text" class="input" placeholder="CONTACT EMAIL" id="cemail" name="cemail" maxlength="200" /><div id="cemailerror" class="error">Enter valid Emailid.</div>
			  </div>
			</div>
			
			<div class="clearfix">
				
			  <div class="lab">
				<label for="name">YOUR PAYMENT INFORMATION</label>
			  </div>
			  
			  <div>FIRST NAME</div>
			  <div class="con"> 
				<input type="text" class="input" placeholder="FIRST NAME" id="fname" name="fname" maxlength="30" /><div id="fnameerror" class="error">First Name is required.</div>
			  </div>
			  
			  <div>LAST NAME</div>
			  <div class="con"> 
				<input type="text" class="input" placeholder="LAST NAME" id="lname" name="lname" maxlength="30" /><div id="lnameerror" class="error">Last Name is required.</div>
			  </div>
			  
			  <div>CREDIT CARD NUMBER</div>
			  <div class="con"> 
				<input type="text" class="input" placeholder="CREDIT CARD NUMBER" id="ccnumber" name="ccnumber" maxlength="20" onkeypress="return number(event)"/><div id="ccnumbererror" class="error">Credit Card Number is required.</div>
			  </div>
			   
			</div>
 
			<div class="clearfix">
			  <div class="lab">
				<label for="name">EXPIRATION DATE</label>
			  </div>
			  <div class="con">
				  <select id="expirationdatem" name="expirationdatem">
					<option value="">--Select--</option>
					<?php for($i=1;$i<13;$i++) {?>
					<option value="<?php echo $i;?>"><?php echo $i;?></option>
					<?php } ?>
				  </select>
				  &nbsp;
				  <select id="expirationdatey" name="expirationdatey">
					<option value="">--Select--</option>
					<?php for($k=0;$k<10;$k++) {?>
					<?php $a = date('Y')+$k;?>
					<option value="<?php echo $a;?>"><?php echo $a;?></option>
					<?php } ?>
				  </select>
				  <div id="ccnumbererror" class="error">Credit Card Number is required.</div><div id="expirationdateerror" class="error">Select Expiration Date.</div>
				  <div id="ccnumbererror" class="error">Credit Card Number is required.</div>
			  </div>
			</div>
         
       
			<div class="clearfix">
			  <div class="lab">
				<label for="name">HAVE DISCOUNT CODE?</label>
			  </div>
			  <div class="con">
				<div class="reg_fld">ENTER DISCOUNT CODE</div>
				<input type="text" class="input" placeholder="DISCOUNT CODE" id="discountcode" name="discountcode" maxlength="50" />
			  </div>
			</div>
         
			<div class="clearfix">
			  <div class="lab">
				<label for="name">CREATE YOUR ACCOUNT</label>
			  </div>
			  <div class="con">
				<div class="reg_fld">PLEASE VERIFY THAT ALL INFORMATION ENTERED ABOVE IS CORRECT.</div>
				<button type="submit" class="lgn_btn" style="margin-top:32px;" title="CONTINUE TO CHECKOUT" id="btnaddcompany" name="btnaddcompany">CONTINUE TO CHECKOUT</button>
			  </div>
			</div>

        </fieldset>
        </form>
		
		
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
			if($elite['ybid']==$this->session->userdata['subbroker_data'][0]->id and $elite['ybtype']=='subbroker' and $elite['yctype']=='subbroker')	
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
			if($elite['ycsubbrokerid']==$this->session->userdata['subbroker_data'][0]->id and $elite['ybtype']=='marketer' and $elite['yctype']=='marketer') 
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
			foreach($elitemember as $agent)
			{
			if($agent['ycsubbrokerid']==$this->session->userdata['subbroker_data'][0]->id and $elite['ybid']==$agent['ycmarketerid'] and $agent['ybtype']=='agent' and $agent['yctype']=='agent') 
			{ 
			?>
			<tr>
				<td><?php echo $agent['ybname']; ?></td>
				<td><?php echo $agent['ybtype']; ?></td>
				<td><?php echo $agent['yccompany']; ?></td>
				<td><?php echo $agent['ycemail']; ?></td>
				<td><?php echo $agent['ycphone']; ?></td>
			</tr>
			<?php 	
			}
			}
			} 
			}
			?>
		</table>
		<?php } ?>
		
		
		</div>
	</div>	
<?php } ?>

</div>

<?php include('subbrokerleftmenu.php'); ?>
<?php echo $footer; ?>

