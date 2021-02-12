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
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>SRno.</th>
                <th>Name</th>
                <th>Status</th>
                <th>Is_Available</th>
                <th>Bets</th>
                <th>Game_type</th>
                <th>Updated_At</th>
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
                <td>{{$value->name}}</td>
                <td>
                  @if($value->status == "true")
                    <span class="badge badge-success" style="font-size: 12px;">Active</span>
                  @else
                    <span class="badge badge-danger" style="font-size: 12px;">Deactive</span>
                  @endif
                </td>
                <td>
                  @if($value->is_available == "false")
                    <span class="badge badge-success" style="font-size: 12px;">Available</span>
                  @else
                    <span class="badge badge-danger" style="font-size: 12px;">Unavailable</span>
                  @endif
                </td> 
                <td>{{$value->bet}}</td>
                <td>{{$value->game_type}}</td>
                <td>
                  <?php 
                  if($value->createdAt){
                    echo date("d/m/Y h:i A",strtotime($value->updatedAt->toDateTime()->format('r')));
                  }else if($value->updated_at){
                    echo date("d/m/Y h:i A",strtotime($value->updated_at->toDateTime()->format('r')));
                  }

                  ?>
                </td>
                <td class="d-flex flex-row">
                  <a href="{{url('bots/'.$value->_id.'/edit')}}"><span class="btn btn-xs btn-primary mx-1"><i class="fa fa-edit"></i></span></a>
                 <!--  <button data-toggle="modal" data-target="#exampleModal" class="btn btn-xs btn-success mx-1"><a href="#" onclick="showAjaxModal(');"><i class="fa fa-eye"></i></a>
                                        </button> -->
                  <!-- <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-xs btn-success mx-1">
                   <a href="{{ url('getuser/'.$value->_id.'/view')}}"></a>
                    </a>
                  </button> -->

                  <!-- <button type="button" class="btn btn-xs btn-success mx-1" data-toggle="modal" data-target="#message<?php echo $value->_id ;?>"><i class="fa fa-eye"></i></button> -->
                  <!-- <form method="post" action="{{url('tournament/'.$value->_id)}}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-xs btn-danger mx-1" type="submit"><i class="fa fa-trash"></i></button>
                  </form> --> 
                </td>
              </tr> 
              @endforeach
            </tbody>

          </table>
        </div>
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