@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/admin/profile')}}">Admin Profile</a></li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Admin Detail</h6>
        <form class="forms-sample" method="post" action="{{url('admin/'.Auth::user()->_id)}}">
          @csrf
          @method('PUT')
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="exampleInputUsername2" class="control-label">Username</label>
                <input type="text" class="form-control" id="exampleInputUsername2" name="name" value="{{Auth::user()->name}}">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail2" name="email" value="{{Auth::user()->email}}" placeholder="Email">
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

<div class="row">
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Change Password</h6>
        <form method="post" action="{{url('ch_profile')}}" enctype="multipart/form-data">
          @csrf
          <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                    <label for="exampleInputUsername2" class="control-label">Old Password</label>
                    <input class="form-control" type="text" name="opass" placeholder="Enter Your old password" value="{{old('opass')}}">
                    @if (Session::has('msg'))
                        <div class="alert alert-danger">             
                          {{Session::get('msg')}}
                        </div>           
                    @endif
                    @error('opass')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
              </div>
          </div>
          <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="control-label">New Password</label>
                  <input class="form-control" type="text" name="npass" placeholder="Enter Your new password" value="{{old('npass')}}">
                  @error('npass')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
          </div>
          <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="control-label">Confirm Password</label>
                  <input class="form-control" type="text" name="cpass" placeholder="Enter Your confirm password" value="{{old('cpass')}}">
                  @error('cpass')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <button type="submit" class="btn btn-primary mr-2">Change Password</button>
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
@endpush

