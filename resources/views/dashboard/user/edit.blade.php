@extends('Dashboard.layouts.master')
@section('css')

    <link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئيسيه</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ المسخدمين</span>
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
                        <h4 class="card-title mg-b-0">إضافه مستخدم جديد</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>

                </div>

                @php
                    $name = explode(' ', $user['name']);
                @endphp






                <div class="card-body">
                    <form method="post" action="{{ route('dashboard.users.store') }}" data-parsley-validate="">
                        @csrf
                        <div class="row row-sm mg-b-20">
                            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-5 col-lg-4">
                                                <label class="form-control-label">الاسم الاول: <span
                                                        class="tx-danger">*</span></label>
                                                <input class="form-control"
                                                       id="first_name"
                                                       name="first_name"
                                                       placeholder="إسم المستخدم"
                                                       value="{{ $name[0] }}"
                                                       required
                                                       type="text">
                                                @error('first_name')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-5 col-lg-4 mg-t-20 mg-md-t-0">
                                                <label class="form-control-label">الاسم الثاني: <span class="tx-danger">*</span></label>
                                                <input class="form-control" id="second_name" name="second_name"
                                                       value="{{ $name[1] }}"
                                                       placeholder="إسم الاب " required type="text">
                                                @error('second_name')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-5 col-lg-4 mg-t-20 mg-md-t-0">
                                                <label class="form-control-label">الاسم الثالث: <span class="tx-danger">*</span></label>
                                                <input class="form-control" id="last_name" name="last_name"
                                                       value="{{ $name[2] }}"
                                                       placeholder="إسم الالعائلة" required="" type="text">
                                                @error('last_name')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row row-sm">


                            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 mg-t-20 mg-md-t-0">
                                                <label class="form-control-label"> البريد الالكتروني: <span
                                                        class="tx-danger">*</span></label>
                                                <input class="form-control"
                                                       id="email"
                                                       name="email"
                                                       placeholder="البريد الإلكتروني"
                                                       value="{{ $user['email'] }}"
                                                       required
                                                       type="email">
                                                @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 col-lg-6 mg-t-20 mg-md-t-0">
                                                <p class="mg-b-10"> الصلاحيه: <span class="tx-danger">*</span></p>
                                                <select class="form-control select2" name="role_id"
                                                        value="">
                                                    <option label="Choose one">
                                                    </option>
                                                    @foreach($roles as $key=>$item)
                                                        <option
                                                            {{$key ==  $roles('id')?   'selected' : ''   }}
                                                            value="{{ $key }}" {{ old('role_id', '') === $key ? 'selected' : '' }}>
                                                            {{ $item }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('role_id')
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
                                <button type="submit" class="btn btn-success btn-block">تسجيل البيانات</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /row -->


    </div>
    <!-- Container closed -->
    </div>
    </div>
    <!-- Maincom-content closed -->
@endsection
@section('js')

    <!-- Internal Select2.min js -->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <!-- Internal form-elements js -->
    <script src="{{URL::asset('assets/js/form-elements.js')}}"></script>
    <!-- Internal Form-validation js -->
    <script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
@endsection
