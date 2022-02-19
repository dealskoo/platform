@extends('admin::layouts.panel')
@section('title',__('platform::platform.view_platform'))
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a
                                href="{{ route('admin.dashboard') }}">{{ __('admin::admin.dashboard') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('platform::platform.view_platform') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('platform::platform.view_platform') }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('platform::platform.name') }}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ old('name',$platform->name) }}" readonly>
                            </div>
                        </div>
                    </div> <!-- end row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="slug" class="form-label">{{ __('platform::platform.slug') }}</label>
                                <input type="text" class="form-control" id="slug" name="slug"
                                       value="{{ old('slug',$platform->slug) }}" readonly>
                            </div>
                        </div>
                    </div> <!-- end row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="website" class="form-label">{{ __('platform::platform.website') }}</label>
                                <input type="text" class="form-control" id="website" name="website"
                                       value="{{ old('website',$platform->website) }}" readonly>
                            </div>
                        </div>
                    </div> <!-- end row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="score" class="form-label">{{ __('platform::platform.score') }}</label>
                                <input type="number" class="form-control" id="score" name="score"
                                       value="{{ old('score',$platform->score) }}" readonly>
                            </div>
                        </div>
                    </div> <!-- end row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="country"
                                       class="form-label">{{ __('platform::platform.country') }}</label>
                                <input type="text" class="form-control" id="country" name="country"
                                       value="{{ old('country',$platform->country->name) }}" readonly>
                            </div>
                        </div>
                    </div> <!-- end row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="seller"
                                       class="form-label">{{ __('platform::platform.seller') }}</label>
                                <input type="text" class="form-control" id="seller" name="seller"
                                       value="{{ old('seller',$platform->seller->name) }}" readonly>
                            </div>
                        </div>
                    </div> <!-- end row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="approved" name="approved"
                                           tabindex="1"
                                           value="1" {{ $platform->approved?'checked':'' }}>
                                    <label for="approved"
                                           class="form-check-label">{{ __('platform::platform.approved') }}</label>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end row -->
                </div>
            </div>
        </div>
    </div>
@endsection
