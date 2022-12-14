@extends('layouts.admin')

@section('title') {{ __('View Role') }} @endsection

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
                        <h3 class="card-title">{{ __('View Role') }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-angle-double-left"></i>
                            {{ __('Back') }}
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <td>{{ $role->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Permissions') }}</th>
                                    @if($role->name == 'Admin')
                                    <td>
                                        <span class="badge badge-info">{{ __('All permissions') }}</span>
                                    </td>
                                    @else
                                    <td>
                                        @if($role->permissions->count())
                                            @foreach($role->permissions as $key => $permission)
                                                <span class="badge badge-info">{{ $permission->name }}</span>
                                            @endforeach
                                        @endif
                                    </td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>{{ __('Created Date') }}</th>
                                    <td>{{ $role->created_at }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Updated Date') }}</th>
                                    <td>{{ $role->updated_at }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Action') }}</th>
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="{{ route('admin.roles.edit', $role->id) }}" title="Edit"><i class="fas fa-edit"></i></a>

                                        <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger delete-confirmation" title="Delete"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
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
