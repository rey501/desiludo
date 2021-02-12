<?php $__env->startPush('plugin-styles'); ?>
  <link href="<?php echo e(asset('assets/plugins/datatables-net/dataTables.bootstrap4.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/@mdi/css/materialdesignicons.min.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo e(url('/tournament')); ?>">Tournament</a></li>
    <li class="breadcrumb-item active" aria-current="page">Update Tournament Admin</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Tournament Detail</h6>
        <form class="forms-sample" method="post" action="<?php echo e(url('tournament/'.$edata->_id.'/update')); ?>">
          <?php echo csrf_field(); ?>
          <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="exampleInputUsername2" class="control-label">Tournament Name</label>
                  <input type="text" class="form-control" id="exampleInputUsername2" name="tournament_name" placeholder="Tournament Name" value="<?php echo e($edata->tournament_name); ?>">
                 
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="exampleInputPassword2" class="col-sm-3 col-form-label pl-0">Game Type</label>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="game_type" value="2"  <?php echo e(($edata->game_type == "2") ? 'checked' : ''); ?>>2 Player
                        </label>
                    </div>
                    <div class="form-check form-check-inline">    
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="game_type" value="4"  <?php echo e(($edata->game_type == "4") ? 'checked' : ''); ?>>4 Player
                        </label>
                    </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="col-sm-3 col-form-label pl-0">Time Limit</label>
                  <input type="number" class="form-control" id="time_limit" name="time_limit" placeholder="Time limit in minutes"  value="<?php echo e($edata->time_limit); ?>" required>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="col-sm-3 col-form-label pl-0">Join Amount</label>
                  <input type="text" class="form-control" name="tournament_price" id="tournament_price" placeholder="Join Amount" value="<?php echo e($edata->tournament_price); ?>">
                  
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label">Winning Amount</label>
                <input type="text" class="form-control" id="winning_amount" name="winning_amount" placeholder="Winning Amount" value="<?php echo e($edata->winning_amount); ?>"  onchange="myChangeFunction(this)">
                
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="exampleInputPassword2" class="col-sm-3 col-form-label pl-0">Status</label>
                  <div class="form-check form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="isActive" value="true" <?php echo e(($edata->isActive == 'true') ? 'checked' : ''); ?>>Active
                      </label>
                  </div>
                  <div class="form-check form-check-inline">    
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="isActive" value="false" <?php echo e(($edata->isActive == 'false') ? 'checked' : ''); ?>>Deactive
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
       // var $value = (($(this).val())*8)-$(this).val();
      console.log($('#winning_amount').val());
      if($('#winning_amount').val() <0){
        alert("winning amount must be greater than zero");
      }
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


<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/tournament/edit_tournament.blade.php ENDPATH**/ ?>