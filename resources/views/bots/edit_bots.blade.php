@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/bots')}}">Bots</a></li>
    <li class="breadcrumb-item active" aria-current="page">Update Bots</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Bots Detail</h6>
        <form class="forms-sample" method="post" action="{{url('bots/'.$edata->_id)}}">
          @csrf
          @method('PUT')
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="exampleInputUsername2" class="control-label">Bets Price</label>
                <input type="text" class="form-control" id="exampleInputUsername2" name="bet" placeholder="bets price" value="{{$edata->bet}}">
                <!-- error particuler field wise -->
                @error('bets')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
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
                          <input type="radio" class="form-check-input" name="game_type" value="2" {{($edata->game_type == "2") ? 'checked' : '' }}>2
                        </label>
                    </div>
                    <div class="form-check form-check-inline">    
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="game_type" value="4" {{($edata->game_type == "4") ? 'checked' : '' }}>4
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
                          <input type="radio" class="form-check-input" name="status" value="true" {{($edata->status == "true") ? 'checked' : '' }}>Active
                        </label>
                    </div>
                    <div class="form-check form-check-inline">    
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="status" value="false" {{($edata->status == "false") ? 'checked' : '' }}>Deactive
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
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>

@endpush

