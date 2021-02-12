<?php $__env->startPush('plugin-styles'); ?>
  <link href="<?php echo e(asset('assets/plugins/datatables-net/dataTables.bootstrap4.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/@mdi/css/materialdesignicons.min.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('assets/plugins/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo e(url('/commission')); ?>">Commission</a></li>
  </ol>
</nav>

<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow">
      <div class="col-md-4 grid-margin stretch-card" <?php echo ($subadmin==1)?'hidden':''?>>
        <div class="card bg-primary">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title text-white mb-2">Today Commission</h6>
            </div>
            <div class="row">
              <div class="col-12 col-md-12 col-xl-12">
                <h3 class="text-white"><i class="fa fa-inr mr-2"></i><?php echo e($maindata['todaySum']); ?></h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card" <?php echo ($subadmin==1)?'hidden':''?>>
        <div class="card bg-success">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title text-white mb-2">Last Month Commission</h6>
            </div>
            <div class="row">
              <div class="col-12 col-md-12 col-xl-12">
                 <h3 class="text-white"><i class="fa fa-inr mr-2"></i><?php echo e($maindata['lastMonth']); ?></h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body bg-info">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title text-white mb-2">Total Commission</h6>
            </div>
            <div class="row">
              <div class="col-12 col-md-12 col-xl-12">
                <h3 class="text-white"><i class="fa fa-inr mr-2"></i><?php echo e($maindata['totalAmount']); ?></h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php 
  if($subadmin==0){
    ?>
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title">User Detail</h6>
              <form class="forms-sample" method="post" action="<?php echo e(url('users/gamecommission')); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="control-label">Game Commission</label>
                        <input type="text" class="form-control" id="gamecommission" name="gamecommission" value="<?php echo e($gamecommission->gamecommission); ?>" placeholder="gamecommission">
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
    
    
    <?php
  }

?>
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
        <?php
          if($subadmin==0){
            ?>
              <table id="dataTableExample" class="table ">
                <thead>
                  <tr>
                    <th>SRno.</th>
                    <th>RoomPrice</th>
                    <th>Number Of<br>Player</th>
                    <th>Winner<br>User</th>
                    <th>Total<br>Amount</th>
                    <th>Admin<br>Commission</th>
                    <th>Win<br>Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $no=1;
                  ?>
                  <?php $__currentLoopData = $dataGames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e($no++); ?></td>
                      <td><?php echo e($value['roomPrice']); ?></td>
                      <td><?php echo e($value['numberOfPlayers']); ?></td>
                      <td>
                        <?php $__currentLoopData = $udata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php if($user['_id'] == $value['winneruser']): ?>
                              <a href="" data-toggle="modal" data-target="#message<?php echo $value->_id ;?>"><?php echo e($user['username']); ?></a>

                              <div id="message<?php echo $value->_id;?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">User Deatils</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <table class="table table-striped">
                                <tbody class="thead-striped">
                                  <tr>
                                    <td>Name</td>
                                    <td><?php echo e($user->username); ?></td>
                                  </tr>
                                  <tr>
                                    <td>Email</td>
                                    <td><?php echo e($user->emailid); ?></td>
                                  </tr>
                                  <tr>
                                    <td>Password</td>
                                    <td><?php echo e($user->password); ?></td>
                                  </tr>
                                  <tr>
                                    <td>Mobile</td>
                                    <td><?php echo e($user->mobileno); ?></td>
                                  </tr>
                                  <tr>
                                    <td>Amount</td>
                                    <td><?php echo e($user->points); ?></td>
                                  </tr>
                                  
                                </tbody>
                              </table>
                          </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                          <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </td>
                      <td><i class="fa fa-inr"></i>&nbsp;<?php echo $total = $value['roomPrice']*$value['numberOfPlayers']; ?></td>
                      <td><i class="fa fa-inr"></i>&nbsp;<?php echo ($value['commission']); ?></td>
                      <td><i class="fa fa-inr"></i>&nbsp;<?php echo $total-($value['commission']); ?></td>
                      
                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            
            <?php
          }else{
            ?>
              <table id="dataTableExample" class="table ">
                <thead>
                  <tr>
                    <th>SRno.</th>
                    <th>SubAdmin</th>
                    <th>Commission</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $no=1;
                    
                  ?>
                  <?php $__currentLoopData = $subdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subAd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php
                    if(Session::has('subadmin')){
                       
                        if(Session::get('subadminid')==$subAd['_id']){
                          ?>
                            <tr>
                              <td><?php echo e($no++); ?></td>
                              <td><?php echo e($subAd['adminname']); ?></td>
                              <td><?php echo (array_key_exists($subAd['_id'],$resSubAdminArray))?$resSubAdminArray[$subAd['_id']]['commission']:0 ?></td>
                            </tr>
                          <?php
                        }
                    }else{
                      ?>
                        <tr>
                          <td><?php echo e($no++); ?></td>
                          <td><?php echo e($subAd['adminname']); ?></td>
                          <td><?php echo (array_key_exists($subAd['_id'],$resSubAdminArray))?$resSubAdminArray[$subAd['_id']]['commission']:0 ?></td>
                          
                        </tr>
                      <?php
                    }
                  ?>

                    
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            
            <?php
          }
        
        ?>
          
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
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/commission.blade.php ENDPATH**/ ?>