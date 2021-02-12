<?php
  $userpage=0;
  $moneyPage=0;
  $commissionpage=0;
  $tournamentpage=0;
  $botspages=0;
  $cleardatapage=0;
  $subadmin=0;
  
  if(Session::has('subadmin')){
    $subadmin=1;
    $userpage=Session::get('userPage');
    $moneyPage=Session::get('moneyPage');
    $commissionpage=Session::get('commissionPage');
    $tournamentpage=Session::get('tournamentPage');
    $botspages=Session::get('botsPage');
    $cleardatapage=Session::get('cleardataPage');
  }

?>

<nav class="sidebar">
  <div class="sidebar-header">
    <a href="#" class="sidebar-brand" style="font-size: 20px;">
      DesiLudo
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">
      <li class="nav-item nav-category">Main</li>
      <li class="nav-item <?php echo e(active_class(['/'])); ?>" >
        <a href="<?php echo e(url('/dashboard')); ?>" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>
	  
      <li class="nav-item nav-category" <?php echo ($subadmin != "true") ? 'hidden' : '' ?>>Sub Admin</li>
	   <li class="nav-item <?php echo e(active_class(['sub_admin/*'])); ?>" <?php echo ($subadmin != "true") ? 'hidden' : '' ?>>
        <a class="nav-link" data-toggle="collapse" href="#sub_admin" role="button" aria-expanded="<?php echo e(is_active_route(['sub_admin/*'])); ?>" aria-controls="uiComponents">
          <i class="link-icon fa fa-trophy" style="font-size: 17px;"></i>
          <span class="link-title">Sub Admin</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse <?php echo e(show_class(['sub_admin/*'])); ?>" id="sub_admin">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="<?php echo e(url('/sub_admin/create')); ?>" class="nav-link <?php echo e(active_class(['users/create'])); ?>">Add Subadmin</a>
            </li>
            <li class="nav-item">
              <a href="<?php echo e(url('/sub_admin')); ?>" class="nav-link <?php echo e(active_class(['sub_admin'])); ?>">View SubAdmin</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item nav-category" <?php echo ($userpage != "true") ? 'hidden' : '' ?>>Users</li>
	   <li class="nav-item <?php echo e(active_class(['users/*'])); ?>" <?php echo ($userpage != "true") ? 'hidden' : '' ?>>
        <a class="nav-link" data-toggle="collapse" href="#users" role="button" aria-expanded="<?php echo e(is_active_route(['users/*'])); ?>" aria-controls="uiComponents">
          <i class="link-icon fa fa-trophy" style="font-size: 17px;"></i>
          <span class="link-title">Users</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse <?php echo e(show_class(['users/*'])); ?>" id="users">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="<?php echo e(url('/users/create')); ?>" class="nav-link <?php echo e(active_class(['users/create'])); ?>">Add users</a>
            </li>
            <li class="nav-item">
              <a href="<?php echo e(url('/users')); ?>" class="nav-link <?php echo e(active_class(['users'])); ?>">View users</a>
            </li>
            <li class="nav-item">
              <a href="<?php echo e(url('/users/accounthistory')); ?>" class="nav-link <?php echo e(active_class(['users'])); ?>">Account History</a>
            </li>
            <li class="nav-item">
              <a href="<?php echo e(url('/users/commissionhistory')); ?>" class="nav-link <?php echo e(active_class(['users'])); ?>">Commission History</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item <?php echo e(active_class(['/commission'])); ?>" <?php echo ($commissionpage != "true") ? 'hidden' : '' ?>>
        <a href="<?php echo e(url('/commission')); ?>" class="nav-link">
          <i class="link-icon fa fa-inr" style="font-size: 16px;"></i>
          <span class="link-title">Commission</span>
        </a>
      </li>
      <li class="nav-item <?php echo e(active_class(['/commissionsub'])); ?>" <?php echo ($commissionpage != "true") ? 'hidden' : '' ?>>
        <a href="<?php echo e(url('/commission/subadmin')); ?>" class="nav-link">
          <i class="link-icon fa fa-inr" style="font-size: 16px;"></i>
          <span class="link-title">SubAdmin Commission</span>
        </a>
      </li>
      <li class="nav-item nav-category" <?php echo ($moneyPage != "true") ? 'hidden' : '' ?>>Money</li>
      <li class="nav-item <?php echo e(active_class(['Money/*'])); ?>" <?php echo ($moneyPage != "true") ? 'hidden' : '' ?>>
        <a class="nav-link" data-toggle="collapse" href="#Money" role="button" aria-expanded="<?php echo e(is_active_route(['Money/*'])); ?>" aria-controls="uiComponents">
          <i class="link-icon fa fa-trophy" style="font-size: 17px;"></i>
          <span class="link-title">Money</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse <?php echo e(show_class(['Money/*'])); ?>" id="Money">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="<?php echo e(url('/money')); ?>" class="nav-link <?php echo e(active_class(['walletuser'])); ?>">Money Requested</a>
            </li>
            <li class="nav-item">
              <a href="<?php echo e(url('/money/done')); ?>" class="nav-link <?php echo e(active_class(['walletuser'])); ?>">Withdraw Done</a>
            </li>
            <li class="nav-item">
              <a href="<?php echo e(url('/money/cancel')); ?>" class="nav-link <?php echo e(active_class(['walletuser'])); ?>">Withdraw Reject</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item nav-category" <?php echo ($tournamentpage != "true") ? 'hidden' : '' ?>>Tournaments</li>
      <li class="nav-item <?php echo e(active_class(['tournament/*'])); ?>" <?php echo ($tournamentpage != "true") ? 'hidden' : '' ?>>
        <a class="nav-link" data-toggle="collapse" href="#tournament" role="button" aria-expanded="<?php echo e(is_active_route(['tournament/*'])); ?>" aria-controls="uiComponents">
          <i class="link-icon fa fa-trophy" style="font-size: 17px;"></i>
          <span class="link-title">Tournament</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse <?php echo e(show_class(['tournament/*'])); ?>" id="tournament">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="<?php echo e(url('/tournament/create')); ?>" class="nav-link <?php echo e(active_class(['tournament/create'])); ?>">Add Tournament</a>
            </li>
            <li class="nav-item">
              <a href="<?php echo e(url('/tournament')); ?>" class="nav-link <?php echo e(active_class(['tournament'])); ?>">View Tournament</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item <?php echo e(active_class(['/bots'])); ?>" <?php echo ($botspages != "true") ? 'hidden' : '' ?>>
        <a href="<?php echo e(url('/bots')); ?>" class="nav-link">
          <i class="link-icon fa fa-reddit-alien" style="font-size: 16px;"></i>
          <span class="link-title">Bots</span>
        </a>
      </li>
      <li class="nav-item <?php echo e(active_class(['/bots'])); ?>" <?php echo ($cleardatapage != "true") ? 'hidden' : '' ?>>
        <a href="<?php echo e(url('/clearData')); ?>" class="nav-link">
          <i class="link-icon fa fa-reddit-alien" style="font-size: 16px;"></i>
          <span class="link-title">Clear Data</span>
        </a>
      </li>
    </ul>
  </div>
</nav>
<!-- <nav class="settings-sidebar">
  <div class="sidebar-body">
    <a href="#" class="settings-sidebar-toggler">
      <i data-feather="settings"></i>
    </a>
    <h6 class="text-muted">Sidebar:</h6>
    <div class="form-group border-bottom">
      <div class="form-check form-check-inline">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight" value="sidebar-light" checked>
          Light
        </label>
      </div>
      <div class="form-check form-check-inline">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark" value="sidebar-dark">
          Dark
        </label>
      </div>
    </div>
    <div class="theme-wrapper">
      <h6 class="text-muted mb-2">Light Version:</h6>
      <a class="theme-item active" href="https://www.nobleui.com/laravel/template/light/">
        <img src="<?php echo e(url('assets/images/screenshots/light.jpg')); ?>" alt="light version">
      </a>
      <h6 class="text-muted mb-2">Dark Version:</h6>
      <a class="theme-item" href="https://www.nobleui.com/laravel/template/dark">
        <img src="<?php echo e(url('assets/images/screenshots/dark.jpg')); ?>" alt="light version">
      </a>
    </div>
  </div>
</nav> --><?php /**PATH /var/www/html/resources/views/layout/sidebar.blade.php ENDPATH**/ ?>