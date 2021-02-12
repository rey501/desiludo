@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/users')}}">Sub Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Sub Admin</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Sub Admin Detail</h6>
        <form class="forms-sample" method="post" action="{{url('sub_admin_update/'.$edata->_id)}}">
          @csrf
          @method('PUT')
          <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="exampleInputUsername2" class="control-label">Username</label>
                  <input type="text" class="form-control" id="exampleInputUsername2" name="name" value="{{$edata->adminname}}" placeholder="Username">
                </div>
              </div><!-- Col -->
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="control-label">Email</label>
                  <input type="email" class="form-control" id="exampleInputEmail2" name="email" value="{{$edata->email}}" placeholder="Email">
                </div>
              </div><!-- Col -->
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label">Password</label>
                <input type="text" class="form-control" id="exampleInputPassword2" name="password" value="{{$edata->password}}" placeholder="Password">
              </div>
            </div><!-- Col -->
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label">Mobile</label>
                <input type="number" class="form-control" id="exampleInputMobile" name="mobileno" value="{{$edata->mobileno}}" placeholder="Mobile number">
              </div>
            </div><!-- Col -->
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label">Amount Limit</label>
                <input type="text" class="form-control" id="amountbalance" name="amountbalance" value="{{$edata->amountbalance}}" placeholder="amount balance" readonly="readonly">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label">Current Balance</label>
                <input type="text" class="form-control" id="currentbalance" name="currentbalance" value="{{$edata->currentbalance}}" placeholder="amount balance" readonly="readonly">
              </div>
            </div>
            </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label">Add/Deduct Balance</label>
                <input type="text" class="form-control" id="adddedecutbalance" name="adddedecutbalance" value="0" placeholder="amount balance">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label">Commission(%)</label>
                <input type="text" class="form-control" id="commission" name="commission" value="{{$edata->commission}}"  placeholder="commission">
              </div>
            </div><!-- Col -->
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="exampleInputPassword2" class="col-sm-2 col-form-label pl-0">Pages</label>
                  <div class="form-check form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="userPage" value="true" {{($edata->userPage == "true") ? 'checked' : '' }}>Users
                      </label>
                  </div>
                  <div class="form-check form-check-inline">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="moneyPage" value="true" {{($edata->moneyPage == "true") ? 'checked' : '' }}>Money
                      </label>
                  </div>
                  <div class="form-check form-check-inline">    
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="commissionPage" value="true" {{($edata->commissionPage == "true") ? 'checked' : '' }}>Commission
                      </label>
                  </div>
                  <div class="form-check form-check-inline" hidden>    
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="tournamentPage" value="false" >Tournaments
                      </label>
                  </div>
                  <div class="form-check form-check-inline" hidden>    
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="botsPage" value="false" >Bots
                      </label>
                  </div>
                  <div class="form-check form-check-inline" hidden>    
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="cleardataPage" value="false" >ClearData
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
                        <input type="radio" class="form-check-input" name="isActive" value="true" {{($edata->isActive == "true") ? 'checked' : '' }}>Active
                      </label>
                  </div>
                  <div class="form-check form-check-inline">    
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="isActive" value="false" {{($edata->isActive == "false") ? 'checked' : '' }}>Deactive
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
              </div><!-- Col -->
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
  <script>
    $("#adddedecutbalance").change(function(){
      if(parseInt($("#adddedecutbalance").val())<0){
        var diff=parseInt($("#currentbalance").val()) - (parseInt($("#adddedecutbalance").val())*-1); 
        if(diff<=0){
          alert("deduct amount must be less than current balance");
          $("#adddedecutbalance").val("0");
        }
      }
    });
  </script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush

