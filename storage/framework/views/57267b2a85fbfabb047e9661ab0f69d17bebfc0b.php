<?php $__env->startPush('plugin-styles'); ?>
  <link href="<?php echo e(asset('assets/plugins/datatables-net/dataTables.bootstrap4.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/@mdi/css/materialdesignicons.min.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo e(url('/tournament')); ?>">Tournament</a></li>
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
                <th>Status</th>
                <th>Is_Available</th>
                <th>Bets</th>
                <th>Game_type</th>
                <th>Updated_At</th>
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
                <td><?php echo e($value->name); ?></td>
                <td>
                  <?php if($value->status == "true"): ?>
                    <span class="badge badge-success" style="font-size: 12px;">Active</span>
                  <?php else: ?>
                    <span class="badge badge-danger" style="font-size: 12px;">Deactive</span>
                  <?php endif; ?>
                </td>
                <td>
                  <?php if($value->is_available == "false"): ?>
                    <span class="badge badge-success" style="font-size: 12px;">Available</span>
                  <?php else: ?>
                    <span class="badge badge-danger" style="font-size: 12px;">Unavailable</span>
                  <?php endif; ?>
                </td> 
                <td><?php echo e($value->bet); ?></td>
                <td><?php echo e($value->game_type); ?></td>
                <td>
                  <?php 
                  if($value->createdAt){
                    echo date("d/m/Y h:i A",strtotime($value->updatedAt->toDateTime()->format('r')));
                  }else if($value->updated_at){
                    echo date("d/m/Y h:i A",strtotime($value->updated_at->toDateTime()->format('r')));
                  }

                  ?>
                </td>
                <td class="d-flex flex-row">
                  <a href="<?php echo e(url('bots/'.$value->_id.'/edit')); ?>"><span class="btn btn-xs btn-primary mx-1"><i class="fa fa-edit"></i></span></a>
                 <!--  <button data-toggle="modal" data-target="#exampleModal" class="btn btn-xs btn-success mx-1"><a href="#" onclick="showAjaxModal(');"><i class="fa fa-eye"></i></a>
                                        </button> -->
                  <!-- <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-xs btn-success mx-1">
                   <a href="<?php echo e(url('getuser/'.$value->_id.'/view')); ?>"></a>
                    </a>
                  </button> -->

                  <!-- <button type="button" class="btn btn-xs btn-success mx-1" data-toggle="modal" data-target="#message<?php echo $value->_id ;?>"><i class="fa fa-eye"></i></button> -->
                  <!-- <form method="post" action="<?php echo e(url('tournament/'.$value->_id)); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button class="btn btn-xs btn-danger mx-1" type="submit"><i class="fa fa-trash"></i></button>
                  </form> --> 
                </td>
              </tr> 
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
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/bots/view_bots.blade.php ENDPATH**/ ?>