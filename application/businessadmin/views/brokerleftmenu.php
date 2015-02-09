<div id="sidebar"> 
  <ul id="floatMenu" class="mainmenu">
    <li class="first"><a href="<?php echo site_url('broker'); ?>" class="link" title="Dashboard">Dashboard</a></li>
    <li><a href="<?php echo site_url('broker'); ?>" title="Subbroker">Subbroker</a>
      <ul class="submenu">
        <li><a href="<?php echo site_url('broker/addsubbroker'); ?>" title="Add Subbroker">Add Subbroker</a></li>
        <li><a href="<?php echo site_url('broker/subbroker'); ?>" title="List All Subbroker">List All Subbroker</a></li>
      </ul>
    </li>
    <li><a href="<?php echo site_url('broker'); ?>" title="Marketer">Marketer</a>
      <ul class="submenu">
        <li><a href="<?php echo site_url('broker/addmarketer'); ?>" title="Add Marketer">Add Marketer</a></li>
        <li><a href="<?php echo site_url('broker/marketer'); ?>" title="List All Marketer">List All Marketer</a></li>
      </ul>
    </li>
    <li><a href="<?php echo site_url('broker'); ?>" title="Agent">Agent</a>
      <ul class="submenu">
        <li><a href="<?php echo site_url('broker/addagent'); ?>" title="Add Agent">Add Agent</a></li>
        <li><a href="<?php echo site_url('broker/agent'); ?>" title="List All Agent">List All Agent</a></li>
      </ul>
    </li>
    <li><a href="<?php echo site_url('broker'); ?>" title="Agent">Elite Member</a>
      <ul class="submenu">
        <li><a href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/signuppage/affid/'.$this->session->userdata['broker_data'][0]->id;?>" title="Create Elite Member">Create Elite Member</a></li>
        <li><a href="<?php echo site_url('broker/elitemembers'); ?>" title="List All Elite Members">List All Elite Members</a></li>
      </ul>
    </li>
    <li><a href="<?php echo site_url('broker/userprofile'); ?>/<?php echo $this->session->userdata['broker_data'][0]->id; ?>" class="link" title="User Profile">User Profile</a></li>
  </ul>
</div>
