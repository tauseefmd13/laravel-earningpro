@extends('layouts.admin')

@section('title') {{ __('Add Role') }} @endsection

@section('styles')
<!-- select2 -->
<link rel="stylesheet" href="{{ asset('backend/plugins/select2/select2.min.css') }}">
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
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Add Role') }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-angle-double-left"></i>
                            {{ __('Back') }}
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->

                    <form action="{{ route('admin.roles.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ __('Name') }}</label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                                    </div>

                                    <div class="form-group">
                                        <label> {{ __('Permissions') }}
                                            <span class="btn btn-info btn-xs select-all">{{ __('Select all') }}</span>
                                            <span class="btn btn-info btn-xs deselect-all">{{ __('Deselect all') }}</span>
                                        </label>
                                        <select name="permissions[]" id="permissions" class="form-control select2" multiple="multiple" data-placeholder="" style="width:100%;">
                                            @foreach($permissions as $id => $permission)
                                                <option value="{{ $id }}" {{ (in_array($id, old('permissions', []))) ? 'selected' : '' }}>
                                                    {{ $permission }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection

@section('scripts')
<!-- select2 -->
<script src="{{ asset('backend/plugins/select2/select2.full.min.js') }}"></script>
<script>
    $(function () {
        $('.select-all').click(function () {
            var select2 = $(this).parent().siblings('.select2');
            select2.find('option').prop('selected', 'selected');
            select2.trigger('change');
        });
        $('.deselect-all').click(function () {
            var select2 = $(this).parent().siblings('.select2');
            select2.find('option').prop('selected', '');
            select2.trigger('change');
        });
        $('.select2').select2();
    });
</script>
@endsection