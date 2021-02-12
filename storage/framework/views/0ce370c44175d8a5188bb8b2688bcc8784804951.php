<?php $__env->startPush('plugin-styles'); ?>
  <link href="<?php echo e(asset('assets/plugins/datatables-net/dataTables.bootstrap4.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/@mdi/css/materialdesignicons.min.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo e(url('/bots')); ?>">Bots</a></li>
    <li class="breadcrumb-item active" aria-current="page">Update Bots</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Bots Detail</h6>
        <form class="forms-sample" method="post" action="<?php echo e(url('bots/'.$edata->_id)); ?>">
          <?php echo csrf_field(); ?>
          <?php echo method_field('PUT'); ?>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="exampleInputUsername2" class="control-label">Bets Price</label>
                <input type="text" class="form-control" id="exampleInputUsername2" name="bet" placeholder="bets price" value="<?php echo e($edata->bet); ?>">
                <!-- error particuler field wise -->
                <?php $__errorArgs = ['bets'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="alert alert-danger"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <!-- error end -->
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                  <label for="exampleInputPassword2" class="col-sm-3 col-form-label pl-0">Game Type</label>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="game_type" value="2" <?php echo e(($edata->game_type == "2") ? 'checked' : ''); ?>>2
                        </label>
                    </div>
                    <div class="form-check form-check-inline">    
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="game_type" value="4" <?php echo e(($edata->game_type == "4") ? 'checked' : ''); ?>>4
                        </label>
                    </div>
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                  <label for="exampleInputPassword2" class="col-sm-3 col-form-label pl-0">Status</label>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="status" value="true" <?php echo e(($edata->status == "true") ? 'checked' : ''); ?>>Active
                        </label>
                    </div>
                    <div class="form-check form-check-inline">    
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="status" value="false" <?php echo e(($edata->status == "false") ? 'checked' : ''); ?>>Deactive
                        </label>
                    </div>
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
<script type="text/javascript">
  function myChangeFunction(input1) {
    var input2 = document.getElementById('winning_amount');
    input2.value = (10/100)*(input1.value*8);
  }
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('plugin-scripts'); ?>
  <script src="<?php echo e(asset('assets/plugins/datatables-net/jquery.dataTables.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('custom-scripts'); ?>
  <script src="<?php echo e(asset('assets/js/data-table.js')); ?>"></script>

<?php $__env->stopPush(); ?>


<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/bots/edit_bots.blade.php ENDPATH**/ ?>