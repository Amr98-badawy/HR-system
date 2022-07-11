@extends('Dashboard.layouts.master')
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
                <h4 class="content-title mb-0 my-auto"><a href="{{route("dashboard.home")}}">Dashboard</a></h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> / Edit / Role</span>
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
                        <h4 class="card-title mg-b-0">Update Role</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.roles.update',$role->id) }}"
                          data-parsley-validate="">
                        @method('PUT')
                        @csrf


                        <div class="row row-sm mg-b-20">
                            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12 mg-t-20 mg-md-t-0 mb-3">
                                                <label id="email" class="form-control-label"> Name:
                                                    <span class="tx-danger">*</span>
                                                </label>
                                                <input class="form-control @error('name') is-invalid @enderror"
                                                       id="name"
                                                       name="name"
                                                       placeholder="name "
                                                       value="{{ $role['name'] }}"
                                                       required
                                                       type="text">
                                                @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-md-12 col-lg-12 mg-t-20 mg-md-t-0">
                                                <p class="mg-b-10">Multiple Select</p>
                                                <select multiple="multiple" name="permissions[]" class="testselect2">
                                                    @foreach($permissions as $key=>$val)
                                                        <option
                                                            {{ in_array($key, old('permissions', [])) || $role->permissions->contains($key) ? 'selected' : '' }}
                                                            value="{{$key}}">
                                                            {{$val}}
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


                        <div class="row row-xs wd-xl-80p">
                            <div class="col-sm-6 col-md-3 mg-t-10 mg-md-t-0">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
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
