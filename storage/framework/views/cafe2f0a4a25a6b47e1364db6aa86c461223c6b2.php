<?php $__env->startPush('plugin-styles'); ?>
  <link href="<?php echo e(asset('assets/plugins/datatables-net/dataTables.bootstrap4.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/@mdi/css/materialdesignicons.min.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo e(url('/admin/profile')); ?>">Admin Profile</a></li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Admin Detail</h6>
        <form class="forms-sample" method="post" action="<?php echo e(url('admin/'.Auth::user()->_id)); ?>">
          <?php echo csrf_field(); ?>
          <?php echo method_field('PUT'); ?>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="exampleInputUsername2" class="control-label">Username</label>
                <input type="text" class="form-control" id="exampleInputUsername2" name="name" value="<?php echo e(Auth::user()->name); ?>">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail2" name="email" value="<?php echo e(Auth::user()->email); ?>" placeholder="Email">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Change Password</h6>
        <form method="post" action="<?php echo e(url('ch_profile')); ?>" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
          <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                    <label for="exampleInputUsername2" class="control-label">Old Password</label>
                    <input class="form-control" type="text" name="opass" placeholder="Enter Your old password" value="<?php echo e(old('opass')); ?>">
                    <?php if(Session::has('msg')): ?>
                        <div class="alert alert-danger">             
                          <?php echo e(Session::get('msg')); ?>

                        </div>           
                    <?php endif; ?>
                    <?php $__errorArgs = ['opass'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <div class="alert alert-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              </div>
          </div>
          <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="control-label">New Password</label>
                  <input class="form-control" type="text" name="npass" placeholder="Enter Your new password" value="<?php echo e(old('npass')); ?>">
                  <?php $__errorArgs = ['npass'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              </div>
          </div>
          <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="control-label">Confirm Password</label>
                  <input class="form-control" type="text" name="cpass" placeholder="Enter Your confirm password" value="<?php echo e(old('cpass')); ?>">
                  <?php $__errorArgs = ['cpass'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <button type="submit" class="btn btn-primary mr-2">Change Password</button>
                <button class="btn btn-light">Cancel</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('plugin-scripts'); ?>
  <script src="<?php echo e(asset('assets/plugins/datatables-net/jquery.dataTables.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('custom-scripts'); ?>
  <script src="<?php echo e(asset('assets/js/data-table.js')); ?>"></script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/admin_profile.blade.php ENDPATH**/ ?>