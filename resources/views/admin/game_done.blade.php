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
    <li class="breadcrumb-item active" aria-current="page">Game done</li>
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
              <th>RoomId</th>
              <th>Bet<br>Amount</th>
              <th>Users</th>
              <th>Winners</th>
              <th>Total<br>Amount</th>
              <th>WinAmount</th>
              <th>Admin<br>Commission</th>
              <th>Created_at</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $no=1;
            ?>
            @foreach($data as $value)
              <?php
                  $user = $value->users;
              ?>
                    <tr>
                      <td>{{$no++}}</td>
                      <td>{{$value->_id}}</td>
                      <td>{{$value->price}}</td>
                      <td>
                        @foreach ($user as $u)
                          @foreach($udata as $u_id)
                            @if($u == $u_id->_id)
                                {{$u_id->name}}, 
                            @endif
                          @endforeach
                        @endforeach 
                      </td>
                      <td>
                        @foreach ($user as $u)
                          @foreach($udata as $u_id)
                            @if($u == $u_id->_id)
                              @if($value->winner == $u_id->_id)
                                {{$u_id->name}}
                              @endif  
                            @endif
                          @endforeach
                        @endforeach 
                      </td>
                      <td><?php echo ($value->price*4); ?></td>
                      <td><?php echo ($value->price*3); ?></td>
                      <td><?php echo ($value->price); ?></td>
                      <td>
                        <?php echo date("d/m/Y h:i A",strtotime($value->createdAt->toDateTime()->format('r')));?>
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