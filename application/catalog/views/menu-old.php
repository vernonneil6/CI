<div class="header_wrapper">
  <div id="wrapper">
    <nav class="navbar" role="navigation">
          <div class="navbar-header"> <a class="navbar-brand" href="" title="Crypto Currency">
            <h1><img src="images/logo.jpg" alt=""></h1>
            </a> </div>
          <!-- /.navbar-header -->
          <div class="price_part">
        <ul class="top_row">
              <li class="price_box">
            <div class="big">last price</div>
            <div class="small">0.00893400</div>
          </li>
              <li class="price_box">
            <div class="big">low price</div>
            <div class="small">0.0002498</div>
          </li>
              <li class="price_box last_child">
            <div class="big">high price</div>
            <div class="small">0.080532</div>
          </li>
            </ul>
        <ul class="bottom_row">
              <li class="price_box">
            <div class="big">Daily change</div>
            <div class="small">0.003215</div>
          </li>
              <li class="price_box">
            <div class="big">range</div>
            <div class="small">0.00738-0.00812</div>
          </li>
              <li class="price_box last_child">
            <div class="big">24h volume</div>
            <div class="small">230856.0321</div>
          </li>
            </ul>
      </div>
          <ul class="nav navbar-top-links navbar-right">
        <div class="balance_info">
              <div class="balance_head">Current<br>
            Balance</div>
              <div class="usd">$ 3805 USD</div>
              <div class="btc">$ 826 BTC</div>
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
        <li class="dropdown" style="margin-top:15px"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" title="message"> <i><img src="images/message.png" alt=""></i> <span class="badge">0</span> </a>
              <ul class="dropdown-menu dropdown-messages">
            <li>No messages</li>
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
        <li class="dropdown"> <a data-toggle="dropdown" class="dropdown-toggle account" href="#" title="User">
          <div class="avatar pull-left"> <img alt="avatar" class="img-responsive" src="images/avatar.jpg"> </div>
          <div class="user-mini pull-right"> <span class="welcome">Welcome,</span>
            <div class="clearfix"></div>
            <span><?php if(isset($logged_user)){echo $logged_user[0]['username'];}?></span> <i><img src="images/down_arrow.png" alt=""></i> </div>
          </a>
              <ul class="dropdown-menu dropdown-user">
            <li><a href="user" title="User Profile"><i class="fa fa-user fa-fw"></i> User Profile</a> </li>
            <li><a href="user/upload" title="Upload Document"><i class="fa fa-user fa-fw"></i> Upload Document</a> </li>
            <li><a href="user/edit" title="User Profile"><i class="fa fa-user fa-fw"></i> Edit Profile</a> </li>
            <li><a href="user/changepassword" title="User Profile"><i class="fa fa-user fa-fw"></i> Change Password</a> </li>
            <li class="divider"></li>
            <li><a href="user/logout" title="Logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a> </li>
          </ul>
              <!-- /.dropdown-user --> 
            </li>
        <!-- /.dropdown -->
      </ul>
        </nav>
  </div>
</div>
<div class="menu_wrapper">
  <div id="wrapper">
    <div class="menu">
      <div class="navbar-default" role="navigation">
        <ul class="nav" id="side-menu">
          <li> <a href="<?php echo base_url();?>" title="home">Home</a> </li>
          <li> <a href="#" title="trade">Trade</a> </li>
          <li> <a href="#" title="about us">About us</a> </li>
          <li> <a href="#" title="support ">support </a> </li>
          <li> <a href="#" title="faq">faq</a> </li>
        </ul>
      </div>
    </div>
  </div>
</div>
