<div id="sidebar"> 
  <ul id="floatMenu" class="mainmenu">
    <li class="first"><a href="<?php echo site_url('marketer'); ?>" class="link" title="Dashboard">Dashboard</a></li>
    <li><a href="<?php echo site_url('marketer'); ?>" title="Agent">Agent</a>
      <ul class="submenu">
        <li><a href="<?php echo site_url('marketer/addagent'); ?>" title="Add Agent">Add Agent</a></li>
        <li><a href="<?php echo site_url('marketer/agent'); ?>" title="List All Agents">List All Agents</a></li>
      </ul>
    </li>
    <li><a href="<?php echo site_url('marketer'); ?>" title="Elite Member">Elite Member</a>
      <ul class="submenu">
        <li><a href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/signuppage/affid/'.$this->session->userdata['marketer_data'][0]->id;?>" title="Create Elite Member">Create Elite Member</a></li>
        <li><a href="<?php echo site_url('marketer/elitemember'); ?>" title="List All Elite Members">List All Elite Members</a></li>
      </ul>
    </li>
  </ul>
</div>
