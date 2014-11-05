<div class="header_wrapper"> 
  <div id="wrapper">
    <nav class="navbar" role="navigation">
      <div class="navbar-header"> <a class="navbar-brand" href="" title="Crypto Currency">
        <h1><img src="<?php echo $logoimage;?>" alt="" style="height: 125px; width: 250px;"></h1>
        </a> </div>
      <!-- /.navbar-header -->
      <div class="price_part">
        <ul class="top_row">
          <li class="price_box">
            <div class="big">last price</div>
            <div class="small"></div>
          </li>
          <li class="price_box">
            <div class="big">low price</div>
            <div class="small"></div>
          </li>
          <li class="price_box last_child">
            <div class="big">high price</div>
            <div class="small"></div>
          </li>
        </ul>
        <ul class="bottom_row">
          <li class="price_box">
            <div class="big">Daily change</div>
            <div class="small"></div>
          </li>
          <li class="price_box">
            <div class="big">range</div>
            <div class="small"></div>
          </li>
          <li class="price_box last_child">
            <div class="big">24h volume</div>
            <div class="small"></div>
          </li>
        </ul>
      </div>
      
      <ul class="nav navbar-top-links navbar-right">
        
        
     <?php  if( !array_key_exists('cc_user',$this->session->userdata) )
			{
        ?>
		<div class="btn_panel">
          <div class="login last_box"> <a href="#loginmodal" id="modaltrigger" title="login">login</a> </div>
          <div class="signup"> <a href="user/register" title="sign up">sign up</a> </div>
        </div>
        <div class="change_pwd"><a href="login/forgot" title="Forgot password?">Forgot password?</a></div>
      <?php }else{?>
	 <ul class="nav navbar-top-links navbar-right">
        <div class="balance_info">
          <div class="balance_head">Current<br>
            Balance</div>
            <?php $this->load->model('common');?>
        <div class="usd">$ <?php echo number_format($balance=$this->common->get_userbalance('USD'),3);?> USD</div>
            <div class="btc">$  <?php echo number_format($balance=$this->common->get_userbalance('BTC'),3);?> BTC</div>
           </div>
        <div class="currency">
          <select>
            <option value="usd [$]" title="USD [$]">usd [$]</option>
            <option value="saab">Saab</option>
            <option value="opel">Opel</option>
            <option value="audi">Audi</option>
          </select>
          <!-- /.dropdown-tasks --> 
        </div>
        <div></div>
        <div class="currency" style="margin-top:5px;">
          <select>
            <option value="eng [$]" title="eng [$]">eng [$]</option>
            <option value="saab">Saab</option>
            <option value="opel">Opel</option>
            <option value="audi">Audi</option>
          </select>
          <!-- /.dropdown-tasks --> 
        </div>
      </ul>
      <ul class="navbar-top-links navbar-right information_part">
   <li class="dropdown" style="margin-top:15px;"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" title="message"> <i><img src="images/message.png" alt=""></i> <span class="badge">	<?php
		
		 $count=$this->common->get_count_message(); 
		$count1=$this->common->get_count_messagelabel(); 
		echo count($count1);
		?>
			</span> </a>
          <ul class="dropdown-menu dropdown-messages" style="margin-top:15px;max-height: 400px;overflow-y: auto;">  
          <?php  
		 
		
		  if(count($messages)>0){
		  for($i=0;$i<count($messages);$i++)
		  {?>
            <li<?php if($messages[$i]['chat_status']==1) {?> style="background-color: #F8F8F8;"<?php }?>> 
                                <a href="javascript:void(0);">
                                    <div>
                                        <strong>Admin</strong>
                                        <span class="pull-right text-muted">
                                            <em><?php echo $messages[$i]['mcreateddate'];?></em>
                                        </span>
                                    </div>
                                    <div><?php echo $messages[$i]['message_body'];?>...</div>
                                </a>
                               <?php if($messages[$i]['chat_status']==0) {?>
                              	  <a href="javascript:void(0);" onClick="markasread('<?php echo $messages[$i]['chatid'];?>');">Mark as Read</a>
                           		<?php }?>
                              <a href="javascript:void(0);" onClick="showmsgbox('<?php echo $messages[$i]['chatid'];?>');" style="color:#060">Reply</a>

                            </li>
                            <li class="divider"></li>
                            <?php }}  else 
							{?>
                            <li>No Messages Found</li>
                               <li class="divider"></li>
                            <?php }?>
                           <a href="javascript:void(0);" onClick="showmsgbox('0');" style="color:#060" title="Compose New Message">Compose New Message</a>

          </ul>
          <!-- /.dropdown-messages --> 
        </li>
        <!-- /.dropdown -->
        
        <li class="dropdown" style="margin-top:15px"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" title="notification"> <i><img src="images/bell.png" alt=""></i><span class="badge">0</span> </a>
          <ul class="dropdown-menu dropdown-alerts">
            
            <li>No Alerts</li>
            
          </ul>
          <!-- /.dropdown-alerts --> 
        </li>
        <!-- /.dropdown -->
        <li class="dropdown" style="margin-top:15px;"> <a data-toggle="dropdown" class="dropdown-toggle account" href="#" title="User">
          <div class="avatar pull-left">   <?php if($logged_user[0]['avatar']==''){?> <img alt="avatar" class="img-responsive" src="images/avatar.jpg"><?php } else {?>   <img alt="avatar" class="img-responsive" src="<?php echo $this->config->item('avatar_upload_path').$logged_user[0]['avatar'];?>" height="40px" width="40px"><?php }?>  </div>
          <div class="user-mini pull-right"> <span class="welcome">Welcome,</span>
            <div class="clearfix"></div>
            <span><?php echo $logged_user[0]['username'];?></span> <i><img src="images/down_arrow.png" alt=""></i> </div>
          </a>
          <ul class="dropdown-menu dropdown-user">
               <li><a href="user/finance" title="Finance"><i class="fa fa-user fa-fw"></i>Finance</a> </li>
            <li><a href="user" title="User Profile"><i class="fa fa-user fa-fw"></i> User profile</a> </li>
            <li><a href="user/edit" title="Edit Profile"><i class="fa fa-user fa-fw"></i> Edit Profile</a> </li>
            <li><a href="user/document" title="User verification"><i class="fa fa-user fa-fw"></i> User verification</a> </li>
            <li><a title="Creditcards" href="user/creditcards"><i class="fa fa-user fa-fw"></i> Creditcards</a> </li>
            <li class="divider"></li>
            <li><a href="user/logout" title="Logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a> </li>
               </ul>
          <!-- /.dropdown-user --> 
        </li>
        <!-- /.dropdown -->
      </ul>
	  <?php } ?>
      </ul>
    </nav>
  </div>
</div>