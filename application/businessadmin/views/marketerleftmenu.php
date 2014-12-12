<div id="sidebar"> 
  <ul id="floatMenu" class="mainmenu">
    <li class="first"><a href="<?php echo site_url('marketer'); ?>" class="link" title="Dashboard">Dashboard</a></li>
    <li><a href="<?php echo site_url('marketer'); ?>" title="Marketer">Agent</a>
      <ul class="submenu">
        <li><a href="<?php echo site_url('marketer/addagent'); ?>" title="Add Marketer">Add Agent</a></li>
        <li><a href="<?php echo site_url('marketer/agent'); ?>" title="List All Marketer">List All Agent</a></li>
      </ul>
    </li>
    <li><a href="<?php echo site_url('marketer'); ?>" title="Elite Member">Elite Member</a>
      <ul class="submenu">
        <li><a href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/signuppage/affid/'.$this->session->userdata['marketer_data'][0]->id;?>" title="Create Elite Member">Create Elite Member</a></li>
        <li><a href="<?php echo site_url('marketer/elitemember'); ?>" title="List All Elite Member">List All Elite Member</a></li>
      </ul>
    </li>
  </ul>
</div>
