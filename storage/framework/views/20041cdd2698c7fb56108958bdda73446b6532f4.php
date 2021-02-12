<nav class="navbar">
  <a href="#" class="sidebar-toggler">
    <i data-feather="menu"></i>
  </a>
  <div class="navbar-content">
    <ul class="navbar-nav">
      <li class="nav-item dropdown nav-profile">
        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <!-- <img src="<?php echo e(url('https://via.placeholder.com/30x30')); ?>" alt="profile"> -->
          <p class="name font-weight-bold mb-0"><?php echo (Session::has('subadmin'))?Session::get('subadminname'):Session::get('adminname')?></p>
        </a>
        <div class="dropdown-menu" aria-labelledby="profileDropdown">
          <div class="dropdown-header d-flex flex-column align-items-center"> 
            <div class="info text-center">
              <p class="name font-weight-bold mb-0"><?php echo (Session::has('subadmin'))?Session::get('subadminname'):Session::get('adminname')?></p>
              <p class="email text-muted mb-3"><?php echo (Session::has('subadmin'))?Session::get('subadminemail'):Session::get('adminname')?></p>
            </div>
          </div>
          <div class="dropdown-body">
            <ul class="profile-nav p-0 pt-3">
              <li class="nav-item">
                <a href="<?php echo e(url('/admin/create')); ?>" class="nav-link">
                  <i data-feather="user"></i>
                  <span>Profile</span>
                </a>
              <li class="nav-item">
                <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                  <i data-feather="log-out"></i>
                  <span><?php echo e(__('Logout')); ?></span>
                </a>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                    <?php echo csrf_field(); ?>
                </form>
              </li>
            </ul>
          </div>
        </div>
      </li>
    </ul>
  </div>
</nav>


                                    <?php /**PATH /var/www/html/resources/views/layout/header.blade.php ENDPATH**/ ?>