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
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>SRno.</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Created_at</th>
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
                @foreach($udata as $u)
                  @if($user_id == $u->_id)
                    <tr>
                      <td>{{$no++}}</td>
                      <td>{{$u->name}}</td>
                      <td><i class="mdi mdi-currency-inr"></i>{{$value->amount}}</td>
                      <td>
                        @if($value->status == 'pending')
                          <span class="badge badge-primary" style="font-size: 12px;">Pending</span>
                        @elseif($value->status == 'success')
                          <span class="badge badge-success" style="font-size: 12px;">Success</span>
                        @else
                          <span class="badge badge-danger" style="font-size: 12px;">Failed</span>
                        @endif
                      </td> 
                      <td>
                        <?php echo date("d/m/Y h:i A",strtotime(@$value->createdAt->toDateTime()->format('r')));?>
                      </td>
                    </tr>
                  @endif
                @endforeach
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