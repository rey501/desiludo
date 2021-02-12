<?php $__env->startPush('plugin-styles'); ?>
  <link href="<?php echo e(asset('assets/plugins/datatables-net/dataTables.bootstrap4.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/@mdi/css/materialdesignicons.min.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo e(url('/users')); ?>">All Users</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit User</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">User Detail</h6>
        <form class="forms-sample" method="post" action="<?php echo e(url('users/'.$edata->_id.'/update')); ?>">
          <?php echo csrf_field(); ?>
          <input hidden type="text" class="form-control" id="userid" name="id" value="<?php echo e($edata->_id); ?>">
          <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="exampleInputUsername2" class="control-label">Username</label>
                  <input type="text" class="form-control" id="exampleInputUsername2" name="name" value="<?php echo e($edata->username); ?>">
                </div>
              </div><!-- Col -->
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="control-label">Email</label>
                  <input type="email" class="form-control" id="exampleInputEmail2" readonly name="email" value="<?php echo e($edata->emailid); ?>" placeholder="Email">
                </div>
              </div><!-- Col -->
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label">Password</label>
                <input type="text" class="form-control" id="exampleInputPassword2" name="password" value="<?php echo e($edata->password); ?>" placeholder="Password">
              </div>
            </div><!-- Col -->
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label">Mobile</label>
                <input type="number" class="form-control" id="exampleInputMobile" readonly name="mobile" value="<?php echo e($edata->mobileno); ?>" placeholder="Mobile number">
              </div>
            </div><!-- Col -->
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label">Amount</label>
                <input type="text" class="form-control" readonly value="<?php echo e($edata->points); ?>" name="amount" placeholder="Amount">
              </div>
            </div><!-- Col -->
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label">Add/Remove Amount</label>
               <input type="text" class="form-control" id="exampleInputAmount2" name="addamount" placeholder="Add/remove amount before eg.(10,-10)">
               <span style="color:red;">*** Deduct to Amount using '-' sign. Eg.= -10,-100,-150 ***</span>
              </div>
            </div><!-- Col -->
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="exampleInputPassword2" class="col-sm-3 col-form-label pl-0">Sub Admin</label>
                <select class="form-control" id="subadmin" name="subadmin">
                <?php
                  foreach($subAdminData as $subadmin){
                    $selected=($subadmin->_id==$edata->subAdminId)?"selected":'';
                    ?>
                      <option value="<?php echo $subadmin->_id;?>" <?php echo $selected;?>><?php echo $subadmin->adminname?></option>
                    
                    <?php
                  }
                
                ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="exampleInputPassword2" class="col-sm-3 col-form-label pl-0">Status</label>
                  <div class="form-check form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="isActive" value="true" <?php echo e(($edata->isActive == "true") ? 'checked' : ''); ?>>Active
                      </label>
                  </div>
                  <div class="form-check form-check-inline">    
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="isActive" value="false" <?php echo e(($edata->isActive == "false") ? 'checked' : ''); ?>>Deactive
                      </label>
                  </div>
              </div>
            </div><!-- Col -->
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
              </div><!-- Col -->
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


<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/useredit.blade.php ENDPATH**/ ?>