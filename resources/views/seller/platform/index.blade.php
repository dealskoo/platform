@extends('seller::layouts.panel')

@section('title',__('platform::platform.platforms_list'))
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a
                                href="{{ route('seller.dashboard') }}">{{ __('seller::seller.dashboard') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('platform::platform.platforms_list') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('platform::platform.platforms_list') }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-12">
                            <a href="{{ route('seller.platforms.create') }}" class="btn btn-danger mb-2"><i
                                    class="mdi mdi-plus-circle me-2"></i> {{ __('platform::platform.add_platform') }}
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="platforms_table" class="table table-centered w-100 dt-responsive nowrap">
                            <thead class="table-light">
                            <tr>
                                <th>{{ __('platform::platform.id') }}</th>
                                <th>{{ __('platform::platform.name') }}</th>
                                <th>{{ __('platform::platform.slug') }}</th>
                                <th>{{ __('platform::platform.website') }}</th>
                                <th>{{ __('platform::platform.score') }}</th>
                                <th>{{ __('platform::platform.country') }}</th>
                                <th>{{ __('platform::platform.approved') }}</th>
                                <th>{{ __('platform::platform.created_at') }}</th>
                                <th>{{ __('platform::platform.updated_at') }}</th>
                                <th>{{ __('platform::platform.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(function () {
            let table = $('#platforms_table').dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('seller.platforms.index') }}",
                "language": language,
                "pageLength": pageLength,
                "columns": [
                    {'orderable': true},
                    {'orderable': true},
                    {'orderable': true},
                    {'orderable': true},
                    {'orderable': true},
                    {'orderable': true},
                    {'orderable': true},
                    {'orderable': true},
                    {'orderable': true},
                    {'orderable': false},
                ],
                "order": [[0, "desc"]],
                "drawCallback": function () {
                    $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
                    $('#platforms_table tr td:nth-child(2)').addClass('table-user');
                    $('#platforms_table tr td:nth-child(12)').addClass('table-action');
                    delete_listener();
                }
            });
            table.on('childRow.dt', function (e, row) {
                delete_listener();
            });
        });
    </script>
@endsection
