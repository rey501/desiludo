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
              <th>Amount</th>
              <th>Played</th>
              <th>Wins</th>
              <th>Type</th>
              <th>Status</th>
              <th>Created_at</th>
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
              <td>{{$value->email}}</td>
              <td>{{$value->mobile}}</td>
              <td><i class="mdi mdi-currency-inr"></i>{{$value->amount}}</td>
              <td>{{$value->totalGamesPlayed}}</td>
              <td>{{$value->won}}</td>
              <td>
                @if($value->type == 'user')
                  <span class="badge badge-primary" style="font-size: 12px;">User</span>
                @endif
              </td>
              <td>
                @if($value->isActive == 'true')
                  <span class="badge badge-success" style="font-size: 12px;">Active</span>
                @else
                  <span class="badge badge-danger" style="font-size: 12px;">Deactive</span>
                @endif
              </td> 
              <td>
                <?php echo date("d/m/Y h:i A",strtotime($value->createdAt->toDateTime()->format('r')));?>
              </td>
              <td class="d-flex flex-row">
                <a href="{{url('users/'.$value->id.'/edit')}}"><span class="btn btn-xs btn-primary mx-1"><i class="fa fa-edit"></i></span></a>
               <!--  <button data-toggle="modal" data-target="#exampleModal" class="btn btn-xs btn-success mx-1"><a href="#" onclick="showAjaxModal(');"><i class="fa fa-eye"></i></a>
                                      </button> -->
                <!-- <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-xs btn-success mx-1">
                 <a href="{{ url('getuser/'.$value->_id.'/view')}}"></a>
                  </a>
                </button> -->

                <!-- <button type="button" class="btn btn-xs btn-success mx-1" data-toggle="modal" data-target="#message<?php echo $value->_id ;?>"><i class="fa fa-eye"></i></button> -->

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
                                <td>{{$value->name}}</td>
                              </tr>
                              <tr>
                                <td>Email</td>
                                <td>{{$value->email}}</td>
                              </tr>
                              <tr>
                                <td>Password</td>
                                <td>{{$value->password}}</td>
                              </tr>
                              <tr>
                                <td>Mobile</td>
                                <td>{{$value->mobile}}</td>
                              </tr>
                              <tr>
                                <td>Amount</td>
                                <td>{{$value->amount}}</td>
                              </tr>
                              <tr>
                                <td>GamePlayed</td>
                                <td>{{$value->totalGamesPlayed}}</td>
                              </tr>
                              <tr>
                                <td>Wins</td>
                                <td>{{$value->won}}</td>
                              </tr>
                              <tr>
                                <td>Loss</td>
                                <td>{{$value->loss}}</td>
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