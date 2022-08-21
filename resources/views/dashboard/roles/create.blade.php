@extends('dashboard.layouts.master')
@section('css')

    <link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!--Internal Sumoselect css-->
    @if(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
        <link rel="stylesheet" href="{{asset('assets/plugins/sumoselect/sumoselect-rtl.css')}}">
    @endif
    @if(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocaleDirection() == 'ltr')
        <link rel="stylesheet" href="{{asset('assets/plugins/sumoselect/sumoselect.css')}}">
    @endif

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"><a href="{{route("dashboard.home")}}">@lang('lang.dashboard')</a></h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> / @lang('lang.Roles') / @lang('lang.create')</span>
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
                        <h4 class="card-title mg-b-0">@lang('lang.create') @lang('lang.permissions')</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>

                <div class="card-body">
                    <form method="post" action="{{ route('dashboard.roles.store') }}" data-parsley-validate="">
                        @csrf


                        <div class="row row-sm mg-b-20">
                            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12 mg-t-20 mg-md-t-0 mb-3">
                                                <label id="email" class="form-control-label"> @lang('lang.name'):
                                                    <span class="tx-danger">*</span>
                                                </label>
                                                <input class="form-control @error('name') is-invalid @enderror"
                                                       id="name"
                                                       name="name"
                                                       placeholder="@lang('lang.name') "
                                                       value="{{ old('name') }}"
                                                       required
                                                       type="text">
                                                @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-md-12 col-lg-12 mg-t-20 mg-md-t-0">
                                                <p class="mg-b-10">@lang('lang.permissions')</p>
                                                <select multiple="multiple" name="permissions[]" class="testselect2">
                                                    @foreach($permissions as $key=>$val)
                                                        <option
                                                            {{ in_array($key, old('permissions',[])) ? 'selected' : '' }} value="{{$key}}">{{$val}}</option>
                                                    @endforeach
                                                </select>

                                                @error('permissions')
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

    <!--Internal  Form-elements js-->
    <script src="{{URL::asset('assets/js/advanced-form-elements.js')}}"></script>
    <script src="{{URL::asset('assets/js/select2.js')}}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js')}}"></script>

    <!-- Internal Form-validation js -->
    <script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
@endsection
