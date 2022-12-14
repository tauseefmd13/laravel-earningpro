@extends('layouts.admin')

@section('title') {{ __('All Roles') }} @endsection

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">{{ __('Roles') }}</h1>
      </div>
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('All Roles') }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus-circle"></i>
                                {{ __('Add Role') }}
                            </a>

                            <button class="btn btn-sm btn-danger delete-all" data-url="{{ route('admin.roles.massDestroy') }}">
                                <i class="fas fa-trash"></i>
                                {{ __('Delete Selected') }}
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="checkAll" class="checkAll" id="checkAll"></th>
                                    <th>{{ __('S.No.') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th style="width:400px;" class="permission-column">{{ __('Permissions') }}</th>
                                    <th>{{ __('Created Date') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection

@section('scripts')
<!-- DataTables -->
<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script>
    $(function () {
        $("#example1").DataTable({
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.roles.index') }}",
            columns: [
                { data: 'checkAll', name: 'checkAll', orderable: false, searchable: false },
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'permissions', name: 'permissions' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            order: [[1, 'asc']],
        });
    });
</script>
@endsection