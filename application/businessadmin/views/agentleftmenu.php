<div id="sidebar"> 
  <ul id="floatMenu" class="mainmenu">
    <li class="first"><a href="<?php echo site_url('agent'); ?>" class="link" title="Dashboard">Dashboard</a></li>
    <li><a href="<?php echo site_url('agent'); ?>" title="Elite Member">Elite Member</a>
      <ul class="submenu">
        <li><a href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/signuppage/affid/'.$this->session->userdata['agent_data'][0]->id;?>" title="Create Elite Member">Create Elite Member</a></li>
        <li><a href="<?php echo site_url('agent/elitemembers'); ?>" title="List All Elite Members">List All Elite Members</a></li>
      </ul>
    </li>
    <li><a href="<?php echo site_url('agent/userprofile'); ?>/<?php echo $this->session->userdata['agent_data'][0]->id; ?>" class="link" title="User Profile">User Profile</a></li>
    </ul>
</div>
