<div id="sidebar"> 
  <ul id="floatMenu" class="mainmenu">
    <li class="first"><a href="<?php echo site_url('subbroker'); ?>" class="link" title="Dashboard">Dashboard</a></li>
    <li><a href="<?php echo site_url('subbroker'); ?>" title="Marketer">Marketer</a>
      <ul class="submenu">
        <li><a href="<?php echo site_url('subbroker/addmarketer'); ?>" title="Add Marketer">Add Marketer</a></li>
        <li><a href="<?php echo site_url('subbroker/marketer'); ?>" title="List All Marketers">List All Marketers</a></li>
      </ul>
    </li>
    <li><a href="<?php echo site_url('subbroker'); ?>" title="Agent">Agent</a>
      <ul class="submenu">
        <li><a href="<?php echo site_url('subbroker/addagent'); ?>" title="Add Agent">Add Agent</a></li>
        <li><a href="<?php echo site_url('subbroker/agent'); ?>" title="List All Agents">List All Agents</a></li>
      </ul>
    </li>
    <li><a href="<?php echo site_url('subbroker'); ?>" title="Agent">Elite Member</a>
      <ul class="submenu">
        <li><a href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/signuppage/affid/'.$this->session->userdata['subbroker_data'][0]->id;?>" title="Create Elite Member">Create Elite Member</a></li>
        <li><a href="<?php echo site_url('subbroker/elitemember'); ?>" title="List All Elite Members">List All Elite Members</a></li>
      </ul>
    </li>
    <li><a href="<?php echo site_url('subbroker/userprofile/'); ?><?php echo $this->session->userdata['subbroker_data'][0]->id; ?>" class="link" title="User Profile">User Profile</a></li>
  </ul>
</div>
