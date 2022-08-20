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
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang("lang.users") / @lang("lang.update")</span>
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
                        <h4 class="card-title mg-b-0">@lang("lang.update") @lang("lang.user")</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>

                <div class="card-body">
                    <form method="post" action="{{ route('dashboard.users.update', $user->id) }}"
                          enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row row-sm mg-b-20">
                            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-5 col-lg-4">
                                                <label id="first_name" class="form-control-label">@lang('lang.f_name'):
                                                    <span class="tx-danger">*</span>
                                                </label>
                                                <input class="form-control @error('first_name') is-invalid @enderror"
                                                       id="first_name"
                                                       name="first_name"
                                                       placeholder="@lang('lang.f_name')"
                                                       value="{{ old('first_name', $name[0]) }}"
                                                       required
                                                       type="text">
                                                @error('first_name')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-5 col-lg-4 mg-t-20 mg-md-t-0">
                                                <label id="second_name" class="form-control-label">@lang('lang.s_name'): <span
                                                        class="tx-danger">*</span></label>
                                                <input class="form-control @error('second_name') is-invalid @enderror"
                                                       id="second_name" name="second_name"
                                                       value="{{ old('second_name', $name[1]) }}"
                                                       placeholder="@lang('lang.s_name')" required type="text">
                                                @error('second_name')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-5 col-lg-4 mg-t-20 mg-md-t-0">
                                                <label id="last_name" class="form-control-label">@lang('lang.l_name') <span
                                                        class="tx-danger">*</span></label>
                                                <input class="form-control @error('last_name') is-invalid @enderror"
                                                       id="last_name" name="last_name"
                                                       value="{{ old('last_name', count($name) > 2 ? $name[2] : '') }}"
                                                       placeholder="@lang('lang.l_name')" required type="text">
                                                @error('last_name')
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
                                            <div class="col-md-6 col-lg-6 mg-t-20 mg-md-t-0">
                                                <label id="email" class="form-control-label"> @lang('lang.email'):
                                                    <span class="tx-danger">*</span>
                                                </label>
                                                <input class="form-control @error('email') is-invalid @enderror"
                                                       id="email"
                                                       name="email"
                                                       placeholder="@lang('lang.email')"
                                                       value="{{ old('email', $user->email) }}"
                                                       required
                                                       type="email">
                                                @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 col-lg-6 mg-t-20 mg-md-t-0">
                                                <p class="mg-b-10"> @lang('lang.Roles'): <span class="tx-danger">*</span></p>
                                                <select class="form-control select2" name="roles[]" multiple>
                                                    <option label="Choose roles for user">
                                                    </option>
                                                    @foreach($roles as $key=>$item)
                                                        <option
                                                            {{ in_array($key, old('roles', [])) || $user->roles->contains($key) ? 'selected' : '' }}
                                                            value="{{ $key }}" >
                                                            {{ $item }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('roles')
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
                                            <div class="col-md-12 col-lg-12 mg-t-20 mg-md-t-0">
                                                <label id="picture" class="form-control-label"> @lang('lang.img'):
                                                </label>
                                                <input class="form-control-file @error('picture') is-invalid @enderror"
                                                       id="picture"
                                                       name="picture"
                                                       type="file">
                                                @error('picture')
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
