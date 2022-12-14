@extends('layouts.admin')

@section('title') {{ __('Add User') }} @endsection

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
        <h1 class="m-0">{{ __('Users') }}</h1>
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
                        <h3 class="card-title">{{ __('Add User') }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-angle-double-left"></i>
                            {{ __('Back') }}
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->

                    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label> {{ __('Role') }}</label>
                                        <select name="role_id" id="role_id" class="form-control select2" style="width:100%;">
                                            <option value="">{{ __('Select Role') }}</option>
                                            @foreach($roles as $id => $role)
                                                <option value="{{ $id }}" {{ ($id == old('role_id')) ? 'selected' : '' }}>
                                                    {{ $role }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Name') }}</label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Email') }}</label>
                                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Password') }}</label>
                                        <input type="password" class="form-control" name="password" id="password">
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Status') }}</label>
                                        <select name="status" id="status" class="form-control" style="width: 100%;">
                                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>{{ __('Active') }}</option>
                                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>{{ __('Inactive') }}</option>
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
        $('.select2').select2();
    });
</script>
@endsection