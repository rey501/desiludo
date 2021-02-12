@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
@endpush

@section('content')


<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/app_issue')}}">Money Pending Request</a></li>
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
                <th>Request Amonut</th>
                <th>Transfer in</th>
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
                <?php
                    $user_id = $value->user;
                ?>
                @if($value->status == 'cancel')
                  @foreach($udata as $u)
                    @if($user_id == $u->_id)
                      <tr>
                        <td>{{$no++}}</td>
                        <td>{{$u->name}}</td>
                        <td><i class="mdi mdi-currency-inr"></i>{{$value->amount}}</td>
                        <td>{{$value->mobile}}</td>
                        <td><span class="badge badge-primary" style="font-size: 12px;">{{$value->withdrawType}}</span></td>
                        <td>
                          @if($value->status == 'pending')
                            <span class="badge badge-primary" style="font-size: 12px;">Pending</span>
                          @elseif($value->status == 'success')
                            <span class="badge badge-success" style="font-size: 12px;">Success</span>
                          @else
                            <span class="badge badge-danger" style="font-size: 12px;">Cancel</span>
                          @endif
                        </td>
                        <td><?php echo date("d/m/Y h:i A",strtotime($value->createdAt->toDateTime()->format('r')));?></td>
                        <td class="d-flex flex-row">
                          @if($value->status == 'pending')
                            <a href="{{url('users/'.$u->_id.'/edit')}}"><span class="btn btn-xs btn-primary mx-1"><i class="fa fa-edit"></i></span></a> 
                          @endif
                          @if($value->withdrawType == 'Bank')
                            <button type="button" class="btn btn-xs btn-success mx-1" data-toggle="modal" data-target="#message<?php echo $u->_id ;?>"><i class="fa fa-eye"></i></button>

                              <div id="message<?php echo $u->_id;?>" class="modal fade" role="dialog">
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
                                            <td>{{$u->name}}</td>
                                          </tr>
                                          <tr>
                                            <td>Amount</td>
                                            <td>{{$value->amount}}</td>
                                          </tr>
                                          <tr>
                                            <td>Account_No</td>
                                            <td>{{$value->accountNo}}</td>
                                          </tr>
                                          <tr>
                                            <td>IFSC</td>
                                            <td>{{$value->ifsc}}</td>
                                          </tr>
                                          <tr>
                                            <td>Status</td>
                                            <td>{{$value->status}}</td>
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
                          @endif
                        </td>
                      </tr>
                    @endif
                  @endforeach
                @endif
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