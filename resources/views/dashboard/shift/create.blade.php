@extends('dashboard.layouts.master')
@section('css')
    <link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"><a href="{{route("dashboard.home")}}">@lang("lang.dashboard")</a></h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang("lang.shift") / @lang("lang.create")</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <a href="https://vodex-hr.tawk.help" target="_blank" type="button" class="btn btn-info btn-icon ml-2"><i class="fas fa-info"></i></a>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">

                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">@lang("lang.create") @lang("lang.shift")</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>

                <div class="card-body">
                    <form method="post" action="{{ route('dashboard.shifts.store') }}" data-parsley-validate="">
                        @csrf
                        <div class="row row-sm mg-b-20">
                            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-md-12 col-lg-12 mg-t-20 mg-md-t-0">
                                                <label class="form-control-label">  @lang("lang.Shift_name") :
                                                    <span class="tx-danger">*</span>
                                                </label>
                                                <input
                                                    class="form-control @error('name') is-invalid @enderror"

                                                    name="name"
                                                    placeholder="@lang("lang.Shift_name")"
                                                    value="{{ old('name') }}"
                                                    required
                                                    type="text">
                                                @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row row-sm mg-b-20">
                            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 col-lg-4 mg-t-20 mg-md-t-0">
                                                <label id="email" class="form-control-label"> @lang("lang.Shift_start") :
                                                    <span class="tx-danger">*</span>
                                                </label>
                                                <input
                                                    class="form-control @error('from') is-invalid @enderror"
                                                    name="from"
                                                    placeholder="@lang("lang.Shift_start")"
                                                    value="{{ old('from') }}"
                                                    required
                                                    type="time">
                                                @error('from')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-md-4 col-lg-4 mg-t-20 mg-md-t-0">
                                                <label id="email" class="form-control-label"> @lang('lang.Shift_space')

                                                    :
                                                    <span class="tx-danger">*</span>
                                                </label>
                                                <input
                                                    class="form-control @error('extra_time') is-invalid @enderror"
                                                    name="extra_time"
                                                    placeholder="@lang('lang.Shift_space')"
                                                    value="{{ old('extra_time') }}"
                                                    required
                                                    type="time">
                                                @error('extra_time')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-md-4 col-lg-4 mg-t-20 mg-md-t-0">
                                                <label id="email" class="form-control-label">@lang('lang.Shift_end'):
                                                    <span class="tx-danger">*</span>
                                                </label>
                                                <input
                                                    class="form-control @error('to') is-invalid @enderror"
                                                    name="to"
                                                    placeholder="@lang('lang.Shift_end')"
                                                    value="{{ old('to') }}"
                                                    required
                                                    type="time">
                                                @error('to')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row row-sm mg-b-20">
                            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-md-4 col-lg-4 mg-t-20 mg-md-t-0">
                                                <div class="form-check-inline">
                                                    <input type="checkbox" {{ old('active', 0) === 1 ? 'checked' : '' }} name="active" id="active" class="form-check mr-2">
                                                    <label for="active" class="form-check-label mg-20"> @lang('lang.active') </label>
                                                </div>
                                                @error('active')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row row-xs wd-xl-80p">
                            <div class="col-sm-6 col-md-3 mg-t-10 mg-md-t-0">
                                <button type="submit" class="btn btn-success">@lang('lang.submit')</button>
                                <button type="reset" class="btn btn-danger">@lang('lang.reset')</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('js')
    <!-- Internal Select2.min js -->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <!-- Internal form-elements js -->
    <script src="{{URL::asset('assets/js/form-elements.js')}}"></script>
    <!-- Internal Form-validation js -->
    <script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
@endsection
