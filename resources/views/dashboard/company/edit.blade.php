@extends('Dashboard.layouts.master')
@section('css')
    <link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"><a href="{{route("dashboard.home")}}">Dashboard</a></h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> / update / company</span>
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
                        <h4 class="card-title mg-b-0">Update company</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>

                <div class="card-body">
                    <form method="post" action="{{ route('dashboard.companies.update', $company->id) }}"
                          data-parsley-validate="" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row row-sm mg-b-20">
                            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">

                                            @foreach(siteLanguages() as $locale)
                                                <div class="col-md-6 col-lg-6 mg-t-20 mg-md-t-0">
                                                    <label id="email" class="form-control-label"> Company
                                                        Name {{$locale}}:
                                                        <span class="tx-danger">*</span>
                                                    </label>
                                                    <input
                                                        class="form-control @error($locale.'.name') is-invalid @enderror"

                                                        name="{{$locale}}[name]"
                                                        placeholder="Company {{$locale}} "
                                                        value="{{ old($locale.'.name', $company->translate($locale, true)->name) }}"
                                                        required
                                                        type="text">
                                                    @error($locale.'.name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            @endforeach

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
                                                <div class="form-group">
                                                    <label for="logo" class="mg-b-10"> logo: </label>
                                                    <input type="file" name="logo" id="logo" class="form-control">
                                                    @error('logo')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
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
                                                <p class="mg-b-10"> Departments: </p>
                                                <select class="form-control select2" name="departments[]" multiple>
                                                    <option label="Choose roles for user">
                                                    </option>
                                                    @foreach($departments as $key=>$item)
                                                        <option
                                                            {{ in_array($key, old('departments', [])) || $company->departments->contains($key) ? 'selected' : '' }}
                                                            value="{{ $key }}">
                                                            {{ $item }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('departments')
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
    <!-- Internal Select2.min js -->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <!-- Internal form-elements js -->
    <script src="{{URL::asset('assets/js/form-elements.js')}}"></script>
    <!-- Internal Form-validation js -->
    <script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
@endsection
