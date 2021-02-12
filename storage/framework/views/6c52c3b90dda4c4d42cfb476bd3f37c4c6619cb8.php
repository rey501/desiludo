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
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>SRno.</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Created_at</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $no=1;
              ?>
              <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $user_id = $value->user;
                ?>
                <?php $__currentLoopData = $udata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($user_id == $u->_id): ?>
                    <tr>
                      <td><?php echo e($no++); ?></td>
                      <td><?php echo e($u->name); ?></td>
                      <td><i class="mdi mdi-currency-inr"></i><?php echo e($value->amount); ?></td>
                      <td>
                        <?php if($value->status == 'pending'): ?>
                          <span class="badge badge-primary" style="font-size: 12px;">Pending</span>
                        <?php elseif($value->status == 'success'): ?>
                          <span class="badge badge-success" style="font-size: 12px;">Success</span>
                        <?php else: ?>
                          <span class="badge badge-danger" style="font-size: 12px;">Failed</span>
                        <?php endif; ?>
                      </td> 
                      <td>
                        <?php echo date("d/m/Y h:i A",strtotime(@$value->createdAt->toDateTime()->format('r')));?>
                      </td>
                    </tr>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>

          </table>
        </div>
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
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/walletuser.blade.php ENDPATH**/ ?>