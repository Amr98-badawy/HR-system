@extends('dashboard.layouts.master')
@section('css')

    <link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    {{--    @livewireStyles--}}
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"><a href="{{route("dashboard.home")}}">@lang('lang.dashboard')</a></h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('lang.route_devices')  / @lang('lang.update')</span>
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
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">

                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">@lang('lang.update') @lang('lang.route_devices')</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>

                <div class="card-body">
                    <form method="post" action="{{ route('dashboard.devices.update', $device->id) }}" data-parsley-validate="">
                        @method('PUT')
                        @csrf
                        <div class="row row-sm mg-b-20">
                            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6">
                                                <label id="first_name" class="form-control-label">@lang('lang.name') @lang('lang.device'):
                                                    <span class="tx-danger">*</span>
                                                </label>
                                                <input class="form-control @error('name') is-invalid @enderror"
                                                       id="name"
                                                       name="name"
                                                       placeholder="Device Name"
                                                       value="{{ old('name', $device->name) }}"
                                                       required
                                                       type="text">
                                                @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 col-lg-6 mg-t-20 mg-md-t-0">
                                                <label id="second_name" class="form-control-label">Device Mac Address: <span
                                                        class="tx-danger">*</span></label>
                                                <input class="form-control @error('mac_address') is-invalid @enderror"
                                                       id="mac_address" name="mac_address"
                                                       value="{{ old('mac_address', $device->mac_address) }}"
                                                       placeholder="Device Mac Address" required type="text">
                                                @error('mac_address')
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
                                                    <input type="checkbox" {{ old('status', $device->status) === 1 ? 'checked' : '' }} value="1" name="status" id="status" class="form-check mr-2">
                                                    <label for="active" class="form-check-label mg-20"> @lang('lang.status') </label>
                                                </div>
                                                @error('status')
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

    {{--    @livewire('users.user-create-form')--}}

@endsection
@section('js')

    <!-- Internal Select2.min js -->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <!-- Internal form-elements js -->
    <script src="{{URL::asset('assets/js/form-elements.js')}}"></script>
    <!-- Internal Form-validation js -->
    <script src="{{URL::asset('assets/js/form-validation.js')}}"></script>

    {{--    @livewireScripts--}}
@endsection
