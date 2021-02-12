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

<label class="form-check-label" style="color:red;">
  <?php echo $error; ?>
</label>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <table id="dataTableExample" class="table table-responsive">
          <thead>
            <tr>
              <th>SRno.</th>
              <th>UserName</th>
              <th>oldbalace</th>
              <th>Amount</th>
              <th>Type</th>
              <th>Current Balance</th>
              <th>Remark</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $no=1;
            ?>
            @foreach($data as $value)
			
            <tr>
              <td>{{$no++}}</td>
              <td>{{$value->username}}</td>
              <td>{{$value->oldbalace}}</td>
              <td>{{$value->creditDebit}}</td>
              <td>
                <?php 
                if($value->type==1){
                  ?>
                    <span class="badge badge-success">Credit</span>
                  <?php
                  }else{
                    ?>
                      <span class="badge badge-danger">Debit</span>
                    <?php
                  }
                ?>
              </td>
              <td>{{$value->currentbalance}}</td>
              <td>{{$value->remark}}</td>
              <td><?php echo date("d/m/Y",strtotime($value->date));?></td>
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