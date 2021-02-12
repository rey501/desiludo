<!DOCTYPE html>
<html>
<head>
  <title>DesiLudo</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- CSRF Token -->
  <meta name="_token" content="<?php echo e(csrf_token()); ?>">

  <!-- plugin css -->
  <link href="<?php echo e(asset('assets/fonts/feather-font/css/iconfont.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/flag-icon-css/css/flag-icon.min.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/@mdi/css/materialdesignicons.min.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet" />
  <!-- end plugin css -->

  <?php echo $__env->yieldPushContent('plugin-styles'); ?>

  <!-- common css -->
  <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet" />
  <!-- end common css -->

  <?php echo $__env->yieldPushContent('style'); ?>
</head>
<body data-base-url="<?php echo e(url('/')); ?>" class="sidebar-dark">

  <script src="<?php echo e(asset('assets/js/spinner.js')); ?>"></script>

  <div class="main-wrapper" id="app">
    <?php echo $__env->make('layout.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="page-wrapper">
      <?php echo $__env->make('layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <div class="page-content">
        <?php echo $__env->yieldContent('content'); ?>
      </div>
      <?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
  </div>

    <!-- base js -->
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/feather-icons/feather.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')); ?>"></script>
    <!-- end base js -->

    <!-- plugin js -->
    <?php echo $__env->yieldPushContent('plugin-scripts'); ?>
    <!-- end plugin js -->

    <!-- common js -->
    <script src="<?php echo e(asset('assets/js/template.js')); ?>"></script>
    <!-- end common js -->

    <?php echo $__env->yieldPushContent('custom-scripts'); ?>
</body>
</html><?php /**PATH /var/www/html/resources/views/layout/master.blade.php ENDPATH**/ ?>