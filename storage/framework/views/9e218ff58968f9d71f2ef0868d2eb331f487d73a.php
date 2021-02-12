<?php $__env->startPush('plugin-styles'); ?>
  <link href="<?php echo e(asset('assets/plugins/datatables-net/dataTables.bootstrap4.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/@mdi/css/materialdesignicons.min.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo e(url('/app_issue')); ?>">Money Done Request</a></li>
  </ol>
</nav>

<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow">
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card bg-primary">
          <a href="<?php echo e(url('/money/done')); ?>">
            <div class="card-body">
              <div class=" row">
                <div class="col-md-8">
                  <h6 class="text-white mb-2">Today Withdraw Total</h6>
                  <div>
                    <h3 class="text-white"><i class="fa fa-inr mr-2"></i><?php echo e($res['todaySum']); ?></h3>
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
        <div class="card bg-secondary">
          <a href="<?php echo e(url('/money/done')); ?>">
            <div class="card-body">
              <div class=" row">
                <div class="col-md-8">
                  <h6 class="text-white mb-2">Last Month Withdraw Total</h6>
                  <div>
                    <h3 class="text-white"><i class="fa fa-inr mr-2"></i><?php echo e($res['lastMonth']); ?></h3>
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
        <div class="card bg-info">
          <a href="<?php echo e(url('/money/done')); ?>">
            <div class="card-body">
              <div class=" row">
                <div class="col-md-8">
                  <h6 class="text-white mb-2">Total Withdraw</h6>
                  <div>
                    <h3 class="text-white"><i class="fa fa-inr mr-2"></i><?php echo e($res['totalAmount']); ?></h3>
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
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>SRno.</th>
                <th>Username</th>
                <th>Request Amonut</th>
                <th>Type</th>
                <th>Number</th>
                <th>A/c number</th>
                <th>IFSC</th>
                <th>Status</th>
                <th>Created_at</th>
                <!-- <th>Action</th> -->
              </tr>
            </thead>
            <tbody>
              <?php 
                $no=1;
              ?>
              <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $user_id = $value->userid;
                ?>
                <?php if($value->status == 'success'): ?>
                  <?php $__currentLoopData = $udata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($user_id == $u->_id): ?>
                      <tr>
                        <td><?php echo e($no++); ?></td>
                        <td><?php echo e($u->username); ?></td>
                        <td><i class="mdi mdi-currency-inr"></i><?php echo e($value->amount); ?></td>
                        <?php
                          $type="bank";
                          if($value->type==1)$type="GoolePay";
                          else if($value->type==2)$type="Paytm";
                          else if($value->type==3)$type="PhonePay";
                        ?>
                        <td><span class="badge badge-primary" style="font-size: 12px;"><?php echo $type; ?></span></td>
                        <td><?php echo e($value->phonnumber); ?></td>
                        <td><?php echo ($value->type!=4)?"-":$value->accountnum;?></td>
                        <td><?php echo ($value->type!=4)?"-":$value->ifsc;?></td>
                        <td>
                          <?php if($value->status == 'pending'): ?>
                            <span class="badge badge-primary" style="font-size: 12px;">Pending</span>
                          <?php elseif($value->status == 'success'): ?>
                            <span class="badge badge-success" style="font-size: 12px;">Success</span>
                          <?php else: ?>
                            <span class="badge badge-danger" style="font-size: 12px;">Rejected</span>
                          <?php endif; ?>
                        </td>
                        <td><?php echo date("d/m/Y h:i A",strtotime($value->date->toDateTime()->format('r')));?></td>
                       
                      </tr>
                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <?php if($value->status == 'reject'): ?>
                  <?php $__currentLoopData = $udata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($user_id == $u->_id): ?>
                      <tr>
                        <td><?php echo e($no++); ?></td>
                        <td><?php echo e($u->username); ?></td>
                        <td><i class="mdi mdi-currency-inr"></i><?php echo e($value->amount); ?></td>
                        <?php
                          $type="bank";
                          if($value->type==1)$type="GoolePay";
                          else if($value->type==2)$type="Paytm";
                          else if($value->type==3)$type="PhonePay";
                        ?>
                        <td><span class="badge badge-primary" style="font-size: 12px;"><?php echo $type; ?></span></td>
                        <td><?php echo e($value->phonnumber); ?></td>
                        <td><?php echo ($value->type!=4)?"-":$value->accountnum;?></td>
                        <td><?php echo ($value->type!=4)?"-":$value->ifsc;?></td>
                        <td>
                          <?php if($value->status == 'pending'): ?>
                            <span class="badge badge-primary" style="font-size: 12px;">Pending</span>
                          <?php elseif($value->status == 'success'): ?>
                            <span class="badge badge-success" style="font-size: 12px;">Success</span>
                          <?php else: ?>
                            <span class="badge badge-danger" style="font-size: 12px;">Rejected</span>
                          <?php endif; ?>
                        </td>
                        <td><?php echo date("d/m/Y h:i A",strtotime($value->date->toDateTime()->format('r')));?></td>
                       
                      </tr>
                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
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
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/money_done.blade.php ENDPATH**/ ?>