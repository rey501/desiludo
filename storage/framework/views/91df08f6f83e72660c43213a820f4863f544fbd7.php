<?php $__env->startPush('plugin-styles'); ?>
  <link href="<?php echo e(asset('assets/plugins/datatables-net/dataTables.bootstrap4.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/@mdi/css/materialdesignicons.min.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo e(url('/tournament')); ?>">Tournament</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Tournament</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Tournament Detail</h6>
        <form class="forms-sample" method="post" action="<?php echo e(url('tournament/store')); ?>">
          <?php echo csrf_field(); ?>
          <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="exampleInputUsername2" class="control-label">Tournament Name</label>
                  <input type="text" class="form-control" name="tournament_name" placeholder="Tournament Name" > 
                  <!-- error particuler field wise -->
                  <?php $__errorArgs = ['tournament_name'];
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
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="exampleInputPassword2" class="col-sm-3 col-form-label pl-0">Game Type</label>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="game_type" value="2" checked>2 Player
                        </label>
                    </div>
                    <div class="form-check form-check-inline">    
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="game_type" value="4">4 Player
                        </label>
                    </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="col-sm-3 col-form-label pl-0">Time Limit</label>
                  <input type="number" class="form-control" id="time_limit" name="time_limit" placeholder="Time limit in minutes" >
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="col-sm-3 col-form-label pl-0">Join Amount</label>
                  <input type="number" class="form-control" id="tournament_price" name="tournament_price" placeholder="Join Amount" >
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label">Winning Amount</label>
                <?php $total = 0; ?>
                <input type="number" class="form-control" id="winning_amount" name="winning_amount" placeholder="Winning Amount" >
               
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="exampleInputPassword2" class="col-sm-3 col-form-label pl-0">Status</label>
                  <div class="form-check form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="isActive" value="true" checked>Active
                      </label>
                  </div>
                  <div class="form-check form-check-inline">    
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="isActive" value="false" >Deactive
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

<?php $__env->stopSection(); ?>

<?php $__env->startPush('plugin-scripts'); ?>
  <script src="<?php echo e(asset('assets/plugins/datatables-net/jquery.dataTables.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('custom-scripts'); ?>
  <script src="<?php echo e(asset('assets/js/data-table.js')); ?>"></script>
  <script type="text/javascript">
    $('#winning_amount').change(function() {
      // var $value = (($(this).val())*8)-$(this).val();
      console.log($('#winning_amount').val());
      if($('#winning_amount').val() <0){
        alert("winning amount must be greater than zero");
      }
    });
  </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/tournament/add_tournament.blade.php ENDPATH**/ ?>