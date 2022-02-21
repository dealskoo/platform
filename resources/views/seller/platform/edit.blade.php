@extends('seller::layouts.panel')

@section('title',__('platform::platform.edit_platform'))
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a
                                href="{{ route('seller.platforms.index') }}">{{ __('platform::platform.platforms_list') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('platform::platform.edit_platform') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('platform::platform.edit_platform') }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('seller.platforms.update',$platform) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @if(!empty(session('success')))
                            <div class="alert alert-success">
                                <p class="mb-0">{{ session('success') }}</p>
                            </div>
                        @endif
                        @if(!empty($errors->all()))
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <p class="mb-0">{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-2">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="avatar-box">
                                            <img src="{{ $platform->logo_url }}"
                                                 class="rounded-circle avatar-lg img-thumbnail file-pic">
                                            <div class="upload-image">
                                                <i class="mdi mdi-camera upload-btn"></i>
                                                <input class="file-input" name="logo" type="file" accept="image/*"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="name" class="form-label">{{ __('platform::platform.name') }}</label>
                                        <input type="text" class="form-control" id="name" name="name" required
                                               value="{{ old('name',$platform->name) }}" autofocus tabindex="1"
                                               placeholder="{{ __('platform::platform.name_placeholder') }}">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="website" class="form-label">{{ __('platform::platform.website') }}</label>
                                        <input type="text" class="form-control" id="website" name="website" required
                                               value="{{ old('website',$platform->website) }}" tabindex="2"
                                               placeholder="{{ __('platform::platform.website_placeholder') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="description"
                                       class="form-label">{{ __('platform::platform.description') }}</label>
                                <textarea class="form-control" name="description" id="description" required tabindex="3"
                                          rows="4"
                                          placeholder="{{ __('platform::platform.description_placeholder') }}">{{ old('description',$platform->description) }}</textarea>
                            </div>
                        </div> <!-- end row -->
                        <div class="text-end">
                            <button type="submit" class="btn btn-success mt-2" tabindex="4"><i
                                    class="mdi mdi-content-save"></i> {{ __('seller::seller.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
