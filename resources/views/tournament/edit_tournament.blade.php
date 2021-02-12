@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/tournament')}}">Tournament</a></li>
    <li class="breadcrumb-item active" aria-current="page">Update Tournament Admin</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Tournament Detail</h6>
        <form class="forms-sample" method="post" action="{{url('tournament/'.$edata->_id.'/update')}}">
          @csrf
          <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="exampleInputUsername2" class="control-label">Tournament Name</label>
                  <input type="text" class="form-control" id="exampleInputUsername2" name="tournament_name" placeholder="Tournament Name" value="{{$edata->tournament_name}}">
                 
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="exampleInputPassword2" class="col-sm-3 col-form-label pl-0">Game Type</label>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="game_type" value="2"  {{($edata->game_type == "2") ? 'checked' : '' }}>2 Player
                        </label>
                    </div>
                    <div class="form-check form-check-inline">    
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="game_type" value="4"  {{($edata->game_type == "4") ? 'checked' : '' }}>4 Player
                        </label>
                    </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="col-sm-3 col-form-label pl-0">Time Limit</label>
                  <input type="number" class="form-control" id="time_limit" name="time_limit" placeholder="Time limit in minutes"  value="{{$edata->time_limit}}" required>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="col-sm-3 col-form-label pl-0">Join Amount</label>
                  <input type="text" class="form-control" name="tournament_price" id="tournament_price" placeholder="Join Amount" value="{{$edata->tournament_price}}">
                  
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label">Winning Amount</label>
                <input type="text" class="form-control" id="winning_amount" name="winning_amount" placeholder="Winning Amount" value="{{$edata->winning_amount}}"  onchange="myChangeFunction(this)">
                
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="exampleInputPassword2" class="col-sm-3 col-form-label pl-0">Status</label>
                  <div class="form-check form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="isActive" value="true" {{($edata->isActive == 'true') ? 'checked' : '' }}>Active
                      </label>
                  </div>
                  <div class="form-check form-check-inline">    
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="isActive" value="false" {{($edata->isActive == 'false') ? 'checked' : '' }}>Deactive
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
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>

@endpush

