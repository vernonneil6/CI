<?php $menu1 = $this->common->get_homesetting_value(1); 
	  $menu2 = $this->common->get_homesetting_value(2); 
	  $menu3 = $this->common->get_homesetting_value(3); 
	  $menu4 = $this->common->get_homesetting_value(4); 
	  $menu5 = $this->common->get_homesetting_value(5); 
	  $menu6 = $this->common->get_homesetting_value(6); 
	  $menu7 = $this->common->get_homesetting_value(7); 
	  ?>
      
<div class="menu">
  <ul>
    <li>
      <?php if($this->uri->segment(1)=='' || $this->uri->segment(1)=='welcome'){ ?>
      <a href="<?php echo site_url('');?>" title="<?php echo ucfirst($menu1);?>" style="color:#000000;"><?php echo ucfirst($menu1);?></a>
      <?php } else { ?>
      <a href="<?php echo site_url('');?>" title="<?php echo ucfirst($menu1);?>"><?php echo ucfirst($menu1);?></a>
      <?php } ?>
    </li>
    <li>
      <?php if($this->uri->segment(1)=='complaint'){ ?>
      <a href="<?php echo site_url('complaint');?>" style="color:#000000;" title="<?php echo ucfirst($menu2);?>"><?php echo ucfirst($menu2);?></a>
      <?php } else{ ?>
      <a href="<?php echo site_url('complaint');?>" title="<?php echo ucfirst($menu2);?>"><?php echo ucfirst($menu2);?></a>
      <?php } ?>
    </li>
    <li>
      <?php if($this->uri->segment(1)=='review'){ ?>
      <a href="<?php echo site_url('review');?>" style="color:#000000;" title="<?php echo ucfirst($menu3);?>"><?php echo ucfirst($menu3);?></a>
      <?php } else{ ?>
      <a href="<?php echo site_url('review');?>" title="<?php echo ucfirst($menu3);?>"><?php echo ucfirst($menu3);?></a>
      <?php } ?>
    </li>
    <li>
      <?php if($this->uri->segment(1)=='businessdirectory'){ ?>
      <a href="<?php echo site_url('businessdirectory');?>" style="color:#000000;" title="<?php echo ucfirst($menu4);?>"><?php echo ucfirst($menu4);?></a>
      <?php } else{ ?>
      <a href="<?php echo site_url('businessdirectory');?>" title="<?php echo ucfirst($menu4);?>"><?php echo ucfirst($menu4);?></a>
      <?php } ?>
    </li>
    <li>
      <?php if($this->uri->segment(1)=='pressrelease'){ ?>
      <a href="<?php echo site_url('pressrelease');?>" style="color:#000000;" title="<?php echo ucfirst($menu5);?>"><?php echo ucfirst($menu5);?></a>
      <?php } else{ ?>
      <a href="<?php echo site_url('pressrelease');?>" title="<?php echo ucfirst($menu5);?>"><?php echo ucfirst($menu5);?></a>
      <?php } ?>
    </li>
    <li>
      <?php if($this->uri->segment(1)=='solution'){ ?>
      <a href="<?php echo site_url('solution');?>" style="color:#000000;" title="<?php echo ucfirst($menu6);?>"><?php echo ucfirst($menu6);?></a>
      <?php } else{ ?>
      <a href="<?php echo site_url('solution');?>" title="<?php echo ucfirst($menu6);?>"><?php echo ucfirst($menu6);?></a>
      <?php } ?>
    </li>
    <li>
      <?php if($this->uri->segment(1)=='coupon'){ ?>
      <a href="<?php echo site_url('coupon');?>" style="color:#000000;" title="<?php echo ucfirst($menu7);?>"><?php echo ucfirst($menu7);?></a>
      <?php } else{ ?>
      <a href="<?php echo site_url('coupon');?>" title="<?php echo ucfirst($menu7);?>"><?php echo ucfirst($menu7);?></a>
      <?php } ?>
    </li>
  </ul>
</div>
