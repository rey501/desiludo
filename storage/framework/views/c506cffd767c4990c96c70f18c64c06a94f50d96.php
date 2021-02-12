<?php $__env->startPush('plugin-styles'); ?>
  <link href="<?php echo e(asset('assets/plugins/datatables-net/dataTables.bootstrap4.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/@mdi/css/materialdesignicons.min.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo e(url('/users')); ?>">All Users</a></li>
  </ol>
</nav>
<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow">
      
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card bg-primary">
          <a href="<?php echo e(url('/users')); ?>">
            <div class="card-body">
              <div class=" row">
                <div class="col-md-8">
                  <h6 class="text-white mb-2">Total SubAdmin</h6>
                  <div>
                    <h3 class="text-white"><?php echo e($totalsubamdin); ?></h3>
                  </div>
                </div>
                <div class="col-md-4 mt-1">
                    <h1 class="text-white text-right mr-3"><i class="fa fa-users"></i></h2>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card bg-warning">
          <a href="<?php echo e(url('/users')); ?>">
            <div class="card-body">
              <div class=" row">
                <div class="col-md-8">
                  <h6 class="text-white mb-2">Active Subadmin</h6>
                  <div>
                    <h3 class="text-white"><?php echo e($activesubamdin); ?></h3>
                  </div>
                </div>
                <div class="col-md-4 mt-1">
                    <h1 class="text-white text-right mr-3"><i class="fa fa-users"></i></h2>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card bg-primary">
          <a href="<?php echo e(url('/users')); ?>">
            <div class="card-body">
              <div class=" row">
                <div class="col-md-8">
                  <h6 class="text-white mb-2">InActive Subadmin</h6>
                  <div>
                    <h3 class="text-white"><?php echo e($inactivesubamdin); ?></h3>
                  </div>
                </div>
                <div class="col-md-4 mt-1">
                    <h1 class="text-white text-right mr-3"><i class="fa fa-users"></i></h2>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card bg-danger">
          <a href="<?php echo e(url('/users')); ?>">
            <div class="card-body">
              <div class=" row">
                <div class="col-md-8">
                  <h6 class="text-white mb-2">Total Limit</h6>
                  <div>
                    <h3 class="text-white"><?php echo e($totalLimitsubamdin); ?></h3>
                  </div>
                </div>
                <div class="col-md-4 mt-1">
                    <h1 class="text-white text-right mr-3"><i class="fa fa-money"></i></h2>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card bg-success">
          <a href="<?php echo e(url('/users')); ?>">
            <div class="card-body">
              <div class=" row">
                <div class="col-md-8">
                  <h6 class="text-white mb-2">Total Commission</h6>
                  <div>
                    <h3 class="text-white"><?php echo e($totalCommission); ?></h3>
                  </div>
                </div>
                <div class="col-md-4 mt-1">
                    <h1 class="text-white text-right mr-3"><i class="fa fa-money"></i></h2>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <table id="dataTableExample" class="table table-responsive">
          <thead>
            <tr>
              <th>SRno.</th>
              <th>Name</th>
              <th>Email</th>
              <th>Mobile</th>
              <th>Limit</th>
              <th>Balance</th>
              <th>User Balance</th>
              <th>Commission Amount</th>
              <th>Commission(%)</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $no=1;
            ?>
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($no++); ?></td>
              <td><?php echo e($value->adminname); ?></td>
              <td><?php echo e($value->email); ?></td>
              <td><?php echo e($value->mobileno); ?></td>
              <td><?php echo e($value->amountbalance); ?></td>
              <td><?php echo e($value->currentbalance); ?></td>
              <td><?php echo e($value->userbalance); ?></td>
              <td><?php echo e($value->subcommissionamt); ?></td>
              <td><?php echo e($value->commission); ?> %</td>
              <td>
                <?php if($value->isActive == 'true'): ?>
                  <span class="badge badge-success" style="font-size: 12px;">Active</span>
                <?php else: ?>
                  <span class="badge badge-danger" style="font-size: 12px;">Deactive</span>
                <?php endif; ?>
              </td> 
              
              <td class="d-flex flex-row">
                <a href="<?php echo e(url('sub_admin_edit/'.$value->id.'/edit')); ?>"><span class="btn btn-xs btn-primary mx-1"><i class="fa fa-edit"></i></span></a>
                
                <form method="post" action="<?php echo e(url('users/'.$value->_id)); ?>">
                  <?php echo csrf_field(); ?>
                  <?php echo method_field('DELETE'); ?>
                  <button class="btn btn-xs btn-danger mx-1" type="submit"><i class="fa fa-trash"></i></button>
                </form> 
              </td>
            </tr> 
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>

        </table>
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
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/sub_admin/view_subadmin.blade.php ENDPATH**/ ?>