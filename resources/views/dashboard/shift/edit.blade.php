@extends('Dashboard.layouts.master')
@section('css')
    <link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> / edit / Shift</span>
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
                        <h4 class="card-title mg-b-0">Edit Shift</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>

                <div class="card-body">
                    <form method="post" action="{{ route('dashboard.shifts.update', $shift->id) }}"
                          data-parsley-validate="">
                        @method('PUT')
                        @csrf
                        <div class="row row-sm mg-b-20">
                            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-md-12 col-lg-12 mg-t-20 mg-md-t-0">
                                                <label class="form-control-label"> Shift
                                                    Name :
                                                    <span class="tx-danger">*</span>
                                                </label>
                                                <input
                                                    class="form-control @error('name') is-invalid @enderror"

                                                    name="name"
                                                    placeholder="Shift Name"
                                                    value="{{ old('name', $shift->name) }}"
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
                                                <label id="email" class="form-control-label"> Shift Start :
                                                    <span class="tx-danger">*</span>
                                                </label>
                                                <input
                                                    class="form-control @error('from') is-invalid @enderror"
                                                    name="from"
                                                    placeholder="Shift Start"
                                                    value="{{ old('from', $shift->from) }}"
                                                    required
                                                    type="time">
                                                @error('from')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-md-4 col-lg-4 mg-t-20 mg-md-t-0">
                                                <label id="email" class="form-control-label"> Shift Accepted Late
                                                    Estimated
                                                    :
                                                    <span class="tx-danger">*</span>
                                                </label>
                                                <input
                                                    class="form-control @error('extra_time') is-invalid @enderror"
                                                    name="extra_time"
                                                    placeholder="Shift Accepted Late Estimated"
                                                    value="{{ old('extra_time', $shift->extra_time) }}"
                                                    required
                                                    type="time">
                                                @error('extra_time')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-md-4 col-lg-4 mg-t-20 mg-md-t-0">
                                                <label id="email" class="form-control-label"> Shift End :
                                                    <span class="tx-danger">*</span>
                                                </label>
                                                <input
                                                    class="form-control @error('to') is-invalid @enderror"
                                                    name="to"
                                                    placeholder="Shift End"
                                                    value="{{ old('to', $shift->to) }}"
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
                                                    <input type="checkbox" name="active" id="active"
                                                           {{ $shift->active || old('active', 0) === 1 ? 'checked' : '' }}
                                                           class="form-check mr-2">
                                                    <label for="active" class="form-check-label">
                                                        Active </label>
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
