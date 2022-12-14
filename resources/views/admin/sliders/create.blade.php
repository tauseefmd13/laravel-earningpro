@extends('layouts.admin')

@section('title') {{ __('Add Slider') }} @endsection

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
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Add Slider') }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.sliders.index') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-angle-double-left"></i>
                            {{ __('Back') }}
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->

                    <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                      <label>{{ __('Image') }} <span class="text-danger">*</span></label>
                                      <div class="input-group">
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" name="image" id="image">
                                          <label class="custom-file-label" for="image">{{ __('Choose Image') }}</label>
                                        </div>
                                      </div>
                                      <span>(Only jpg, jpeg, gif and png are allowed)</span>
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Heading') }}</label>
                                        <input type="text" class="form-control" name="heading" id="heading" value="{{ old('heading') }}">
                                    </div>

                                    <div class="form-group">
                                      <label>{{ __('Content') }}</label>
                                      <textarea class="form-control" name="content" id="content" rows="4">{{ old('content') }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Button1 Text') }}</label>
                                        <input type="text" class="form-control" name="button1_text" id="button1_text" value="{{ old('button1_text') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Button1 URL') }}</label>
                                        <input type="text" class="form-control" name="button1_url" id="button1_url" value="{{ old('button1_url') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Button2 Text') }}</label>
                                        <input type="text" class="form-control" name="button2_text" id="button2_text" value="{{ old('button2_text') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Button2 URL') }}</label>
                                        <input type="text" class="form-control" name="button2_url" id="button2_url" value="{{ old('button2_url') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Position') }}</label>
                                        <select name="position" id="position" class="form-control" style="width: 100%;">
                                            <option value="Left" {{ old('position') == 'Left' ? 'selected' : '' }}>{{ __('Left') }}</option>
                                            <option value="Right" {{ old('position') == 'Right' ? 'selected' : '' }}>{{ __('Right') }}</option>
                                        </select>
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
<!-- bs-custom-file-input -->
<script src="{{ asset('backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

<script>
  $(function () {
    bsCustomFileInput.init();
  });
</script>
@endsection