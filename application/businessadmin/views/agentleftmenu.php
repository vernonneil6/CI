<div id="sidebar"> 
  <ul id="floatMenu" class="mainmenu">
    <li class="first"><a href="<?php echo site_url('agent'); ?>" class="link" title="Dashboard">Dashboard</a></li>
    <li><a href="<?php echo site_url('agent'); ?>" title="Agent">Elite Member</a>
      <ul class="submenu">
        <li><a href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/signuppage/affid/'.$this->session->userdata['agent_data'][0]->id;?>" title="Create Elite Member">Create Elite Member</a></li>
        <li><a href="<?php echo site_url('agent/elitemember'); ?>" title="List All Elite Member">List All Elite Member</a></li>
      </ul>
    </li>
    </ul>
</div>
