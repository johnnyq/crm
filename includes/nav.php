<nav class="navbar navbar-inverse">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
  </div>
  <div class="collapse navbar-collapse" id="navbar-collapse">
    <ul class="nav navbar-nav">
      <li <?php if($_SERVER["REQUEST_URI"] == "/crm/dashboard.php") { echo 'class="active"';} ?>><a href="dashboard.php"><i class='fa fa-dashboard'></i> Dashboard</a></li>
      <li <?php if($_SERVER["REQUEST_URI"] == "/crm/customers.php") { echo 'class="active"';} ?>><a href="customers.php"><i class="fa fa-group"></i> Customers</a></li>
      <li <?php if($_SERVER["REQUEST_URI"] == "/crm/computers.php") { echo 'class="active"';} ?>><a href="computers.php"><i class="fa fa-desktop"></i> Computers</a></li>
      <li <?php if($_SERVER["REQUEST_URI"] == "/crm/work_orders.php") { echo 'class="active"';} ?>><a href="work_orders.php"><i class="fa fa-wrench"></i> WorkOrders</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><img class="img-circle" src='<?php echo "$session_avatar"; ?>' height='48' width='48'></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo "$session_username"; ?> <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="messages.php"><i class="glyphicon glyphicon-envelope"></i> Messages <span class="badge"><?php echo $message_count; ?></span></a></li>
          <li><a href="user_preferences.php"><i class="glyphicon glyphicon-cog"></i> Preferences</a></li>
          <li class="<?php echo "$hide"; ?>"><a href="search_users.php"><i class="glyphicon glyphicon-cog"></i> Settings</a></li>
          <li class="divider"></li>
          <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>