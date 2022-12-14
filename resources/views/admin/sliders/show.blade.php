@extends('layouts.admin')

@section('title') {{ __('View Slider') }} @endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">{{ __('Sliders') }}</h1>
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
                        <h3 class="card-title">{{ __('View Slider') }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.sliders.index') }}" class="btn btn-sm btn-primary">
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
                                    <th>{{ __('Image') }}</th>
                                    <td>
                                    @if(!empty($slider->image))
                                        <img src="{{ $slider->image_url }}" alt="" class="img-responsive">
                                    @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('Heading') }}</th>
                                    <td>{{ $slider->heading }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Content') }}</th>
                                    <td>{{ $slider->content }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Button1 Text') }}</th>
                                    <td>{{ $slider->button1_text }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Button1 URL') }}</th>
                                    <td>{{ $slider->button1_url }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Button2 Text') }}</th>
                                    <td>{{ $slider->button2_text }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Button2 URL') }}</th>
                                    <td>{{ $slider->button2_url }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Position') }}</th>
                                    <td>{{ $slider->position }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Status') }}</th>
                                    <td>
                                        <div class="custom-control custom-switch custom-switch-lg"><input type="checkbox" name="status" data-url="{{ route('admin.sliders.update.status') }}" data-id="{{ $slider->id }}" class="custom-control-input js-switch" id="customSwitch2" {{ $slider->status == 1 ? 'checked' : '' }}><label class="custom-control-label" for="customSwitch2"></label></div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('Created Date') }}</th>
                                    <td>{{ $slider->created_at }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Updated Date') }}</th>
                                    <td>{{ $slider->updated_at }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Action') }}</th>
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="{{ route('admin.sliders.edit', $slider->id) }}" title="Edit"><i class="fas fa-edit"></i></a>

                                        <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" style="display:inline-block;">
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
