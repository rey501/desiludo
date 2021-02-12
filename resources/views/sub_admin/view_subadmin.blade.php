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
<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow">
      
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card bg-primary">
          <a href="{{url('/users')}}">
            <div class="card-body">
              <div class=" row">
                <div class="col-md-8">
                  <h6 class="text-white mb-2">Total SubAdmin</h6>
                  <div>
                    <h3 class="text-white">{{$totalsubamdin}}</h3>
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
                  <h6 class="text-white mb-2">Active Subadmin</h6>
                  <div>
                    <h3 class="text-white">{{$activesubamdin}}</h3>
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
                  <h6 class="text-white mb-2">InActive Subadmin</h6>
                  <div>
                    <h3 class="text-white">{{$inactivesubamdin}}</h3>
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
                  <h6 class="text-white mb-2">Total Limit</h6>
                  <div>
                    <h3 class="text-white">{{$totalLimitsubamdin}}</h3>
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
          <a href="{{url('/users')}}">
            <div class="card-body">
              <div class=" row">
                <div class="col-md-8">
                  <h6 class="text-white mb-2">Total Commission</h6>
                  <div>
                    <h3 class="text-white">{{$totalCommission}}</h3>
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
            @foreach($data as $value)
            <tr>
              <td>{{$no++}}</td>
              <td>{{$value->adminname}}</td>
              <td>{{$value->email}}</td>
              <td>{{$value->mobileno}}</td>
              <td>{{$value->amountbalance}}</td>
              <td>{{$value->currentbalance}}</td>
              <td>{{$value->userbalance}}</td>
              <td>{{$value->subcommissionamt}}</td>
              <td>{{$value->commission}} %</td>
              <td>
                @if($value->isActive == 'true')
                  <span class="badge badge-success" style="font-size: 12px;">Active</span>
                @else
                  <span class="badge badge-danger" style="font-size: 12px;">Deactive</span>
                @endif
              </td> 
              
              <td class="d-flex flex-row">
                <a href="{{url('sub_admin_edit/'.$value->id.'/edit')}}"><span class="btn btn-xs btn-primary mx-1"><i class="fa fa-edit"></i></span></a>
                
                <form method="post" action="{{url('users/'.$value->_id)}}">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-xs btn-danger mx-1" type="submit"><i class="fa fa-trash"></i></button>
                </form> 
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