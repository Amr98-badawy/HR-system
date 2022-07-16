@extends('dashboard.layouts.master')
@section('css')

    <link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    @livewireStyles
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"><a href="{{route("dashboard.home")}}">Dashboard</a></h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Users</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
{{--    <div class="row">--}}

{{--        <div class="col-lg-12 col-md-12">--}}
{{--            <div class="card">--}}

{{--                <div class="card-header pb-0">--}}
{{--                    <div class="d-flex justify-content-between">--}}
{{--                        <h4 class="card-title mg-b-0">Add New User</h4>--}}
{{--                        <i class="mdi mdi-dots-horizontal text-gray"></i>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="post" action="{{ route('dashboard.users.store') }}" data-parsley-validate=""--}}
{{--                          enctype="multipart/form-data">--}}
{{--                        @csrf--}}
{{--                        <div class="row row-sm mg-b-20">--}}
{{--                            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">--}}
{{--                                <div class="card">--}}
{{--                                    <div class="card-body">--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-md-5 col-lg-4">--}}
{{--                                                <label id="first_name" class="form-control-label">First Name:--}}
{{--                                                    <span class="tx-danger">*</span>--}}
{{--                                                </label>--}}
{{--                                                <input class="form-control @error('first_name') is-invalid @enderror"--}}
{{--                                                       id="first_name"--}}
{{--                                                       name="first_name"--}}
{{--                                                       placeholder="First Name"--}}
{{--                                                       value="{{ old('first_name') }}"--}}
{{--                                                       required--}}
{{--                                                       type="text">--}}
{{--                                                @error('first_name')--}}
{{--                                                <p class="text-danger">{{ $message }}</p>--}}
{{--                                                @enderror--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-5 col-lg-4 mg-t-20 mg-md-t-0">--}}
{{--                                                <label id="second_name" class="form-control-label">Second Name: <span--}}
{{--                                                        class="tx-danger">*</span></label>--}}
{{--                                                <input class="form-control @error('second_name') is-invalid @enderror"--}}
{{--                                                       id="second_name" name="second_name"--}}
{{--                                                       value="{{ old('second_name') }}"--}}
{{--                                                       placeholder="Second Name" required type="text">--}}
{{--                                                @error('second_name')--}}
{{--                                                <p class="text-danger">{{ $message }}</p>--}}
{{--                                                @enderror--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-5 col-lg-4 mg-t-20 mg-md-t-0">--}}
{{--                                                <label id="last_name" class="form-control-label">Family Name <span--}}
{{--                                                        class="tx-danger">*</span></label>--}}
{{--                                                <input class="form-control @error('last_name') is-invalid @enderror"--}}
{{--                                                       id="last_name" name="last_name"--}}
{{--                                                       value="{{ old('last_name') }}"--}}
{{--                                                       placeholder="Family Name" required type="text">--}}
{{--                                                @error('last_name')--}}
{{--                                                <p class="text-danger">{{ $message }}</p>--}}
{{--                                                @enderror--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row row-sm mg-b-20">--}}
{{--                            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">--}}
{{--                                <div class="card">--}}
{{--                                    <div class="card-body">--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-md-6 col-lg-6 mg-t-20 mg-md-t-0">--}}
{{--                                                <label id="email" class="form-control-label"> Email:--}}
{{--                                                    <span class="tx-danger">*</span>--}}
{{--                                                </label>--}}
{{--                                                <input class="form-control @error('email') is-invalid @enderror"--}}
{{--                                                       id="email"--}}
{{--                                                       name="email"--}}
{{--                                                       placeholder="Email"--}}
{{--                                                       value="{{ old('email') }}"--}}
{{--                                                       required--}}
{{--                                                       type="email">--}}
{{--                                                @error('email')--}}
{{--                                                <p class="text-danger">{{ $message }}</p>--}}
{{--                                                @enderror--}}
{{--                                            </div>--}}

{{--                                            <div class="col-md-6 col-lg-6 mg-t-20 mg-md-t-0">--}}
{{--                                                <p class="mg-b-10"> Roles: <span class="tx-danger">*</span></p>--}}
{{--                                                <select class="form-control select2" name="roles[]" multiple>--}}
{{--                                                    <option label="Choose roles for user">--}}
{{--                                                    </option>--}}
{{--                                                    @foreach($roles as $key=>$item)--}}
{{--                                                        <option--}}
{{--                                                            {{ in_array($key, old('roles', [])) ? 'selected' : '' }}--}}
{{--                                                            value="{{ $key }}" >--}}
{{--                                                            {{ $item }}--}}
{{--                                                        </option>--}}
{{--                                                    @endforeach--}}
{{--                                                </select>--}}
{{--                                                @error('roles')--}}
{{--                                                <p class="text-danger">{{ $message }}</p>--}}
{{--                                                @enderror--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row row-sm mg-b-20">--}}
{{--                            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">--}}
{{--                                <div class="card">--}}
{{--                                    <div class="card-body">--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-md-12 col-lg-12 mg-t-20 mg-md-t-0">--}}
{{--                                                <label id="picture" class="form-control-label"> Picture:--}}
{{--                                                </label>--}}
{{--                                                <input class="form-control-file @error('picture') is-invalid @enderror"--}}
{{--                                                id="picture"--}}
{{--                                                name="picture"--}}
{{--                                                type="file">--}}
{{--                                                @error('picture')--}}
{{--                                                <p class="text-danger">{{ $message }}</p>--}}
{{--                                                @enderror--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row row-sm mg-b-20">--}}
{{--                            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">--}}
{{--                                <div class="card">--}}
{{--                                    <div class="card-body">--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-md-6 col-lg-6 mg-t-20 mg-md-t-0">--}}
{{--                                                <label class="form-control-label"> Password: <span--}}
{{--                                                        class="tx-danger">*</span></label>--}}
{{--                                                <input class="form-control @error('password') is-invalid @enderror"--}}
{{--                                                       name="password"--}}
{{--                                                       placeholder="password"--}}
{{--                                                       required--}}
{{--                                                       type="password">--}}
{{--                                                @error('password')--}}
{{--                                                <p class="text-danger">{{ $message }}</p>--}}
{{--                                                @enderror--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6 col-lg-6 mg-t-20 mg-md-t-0">--}}
{{--                                                <label class="form-control-label"> Confirm Password:--}}
{{--                                                    <span class="tx-danger">*</span>--}}
{{--                                                </label>--}}
{{--                                                <input class="form-control"--}}
{{--                                                       name="password_confirmation"--}}
{{--                                                       placeholder="Confirm Password"--}}
{{--                                                       required--}}
{{--                                                       type="password">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row row-xs wd-xl-80p">--}}
{{--                            <div class="col-sm-6 col-md-3 mg-t-10 mg-md-t-0">--}}
{{--                                <button type="submit" class="btn btn-success">Submit</button>--}}
{{--                                <button type="reset" class="btn btn-danger">Reset</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    @livewire('users.user-create-form')

@endsection
@section('js')

    <!-- Internal Select2.min js -->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <!-- Internal form-elements js -->
    <script src="{{URL::asset('assets/js/form-elements.js')}}"></script>
    <!-- Internal Form-validation js -->
    <script src="{{URL::asset('assets/js/form-validation.js')}}"></script>

    @livewireScripts
@endsection
