@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/users')}}">All Users</a></li>
  </ol>
</nav>

<label class="form-check-label" style="color:red;">
  <?php echo $error; ?>
</label>
<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow">
      
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card bg-primary">
          <a href="{{url('/users')}}">
            <div class="card-body">
              <div class=" row">
                <div class="col-md-8">
                  <h6 class="text-white mb-2">Total Users</h6>
                  <div>
                    <h3 class="text-white">{{$totalUsers}}</h3>
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
          <a href="{{url('/users')}}">
            <div class="card-body">
              <div class=" row">
                <div class="col-md-8">
                  <h6 class="text-white mb-2">Active Users</h6>
                  <div>
                    <h3 class="text-white">{{$ativatedata}}</h3>
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
          <a href="{{url('/users')}}">
            <div class="card-body">
              <div class=" row">
                <div class="col-md-8">
                  <h6 class="text-white mb-2">InActive Users</h6>
                  <div>
                    <h3 class="text-white">{{$deativatedata}}</h3>
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
          <a href="{{url('/users')}}">
            <div class="card-body">
              <div class=" row">
                <div class="col-md-8">
                  <h6 class="text-white mb-2">Total User Balace</h6>
                  <div>
                    <h3 class="text-white">{{$totalUserBalance}}</h3>
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
              <th>UserName</th>
              <th>Amount</th>
              <th>Created_at</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $no=1;
            ?>
            @foreach($data as $value)
			
            <tr>
              <td>{{$no++}}</td>
              <td>{{$value->username}}</td>
              <td>{{$value->points}}</td>
              <td><?php echo date("d/m/Y",strtotime($value->created_date));?></td>
              <td><?php echo ($value->isActive=="true")?'Active':'InActive';?></td>
              <td class="d-flex flex-row">
                <!-- <a href="{{url('users/'.$value->id.'/edituser')}}"><span class="btn btn-xs btn-primary mx-1"><i class="fa fa-edit"></i></span></a> -->
                <form method="post" action="{{url('users/'.$value->id.'/edituser')}}">
                  @csrf
                  <button class="btn btn-xs btn-primary mx-1" type="submit"><i class="fa fa-edit"></i></button>
                </form>
                <a href="" class="btn btn-xs btn-danger mx-1" data-toggle="modal" data-target="#message<?php echo $value->_id ;?>"><i class="fa fa-trash"></i></a>
                  <div id="message<?php echo $value->_id;?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">User Delete</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                          <?php
                            if($value->points > 0){
                              ?>
                              <h5>This User has remaining amount , so not able to delete.</h5>
                              <?php
                            }else{
                              ?>
                              <h5>Are you sure to delete ??</h5>
                              <?php
                            }
                          ?>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <?php
                            if($value->points > 0){
                            }else{
                              ?>
                              <form method="post" action="{{url('users/'.$value->_id.'/delete')}}">
                                @csrf
                                <button class="btn btn-xs btn-danger mx-1" type="submit">Delete</button>
                              </form>
                              <?php
                            }
                          ?>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                <!-- <form method="post" action="{{url('users/'.$value->_id.'/delete')}}">
                  @csrf
                  <button class="btn btn-xs btn-danger mx-1" type="submit"><i class="fa fa-trash"></i></button>
                </form>  -->
              </td>
            </tr> 
            @endforeach
          </tbody>

        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush