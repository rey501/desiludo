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
    <li class="breadcrumb-item active" aria-current="page">Add Tournament</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Tournament Detail</h6>
        <form class="forms-sample" method="post" action="{{url('tournament/store')}}">
          @csrf
          <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="exampleInputUsername2" class="control-label">Tournament Name</label>
                  <input type="text" class="form-control" name="tournament_name" placeholder="Tournament Name" > 
                  <!-- error particuler field wise -->
                  @error('tournament_name')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
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

@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
  <script type="text/javascript">
    $('#winning_amount').change(function() {
      // var $value = (($(this).val())*8)-$(this).val();
      console.log($('#winning_amount').val());
      if($('#winning_amount').val() <0){
        alert("winning amount must be greater than zero");
      }
    });
  </script>
@endpush

