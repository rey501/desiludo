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

<label class="form-check-label" style="color:red;">
  <?php echo $error; ?>
</label>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <table id="dataTableExample" class="table table-responsive">
          <thead>
            <tr>
              <th>SRno.</th>
              <th>UserName</th>
              <th>oldbalace</th>
              <th>Amount</th>
              <th>Type</th>
              <th>Current Balance</th>
              <th>Remark</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $no=1;
            ?>
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			
            <tr>
              <td><?php echo e($no++); ?></td>
              <td><?php echo e($value->username); ?></td>
              <td><?php echo e($value->oldbalace); ?></td>
              <td><?php echo e($value->creditDebit); ?></td>
              <td>
                <?php 
                if($value->type==1){
                  ?>
                    <span class="badge badge-success">Credit</span>
                  <?php
                  }else{
                    ?>
                      <span class="badge badge-danger">Debit</span>
                    <?php
                  }
                ?>
              </td>
              <td><?php echo e($value->currentbalance); ?></td>
              <td><?php echo e($value->remark); ?></td>
              <td><?php echo date("d/m/Y",strtotime($value->date));?></td>
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
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/accounthistory.blade.php ENDPATH**/ ?>