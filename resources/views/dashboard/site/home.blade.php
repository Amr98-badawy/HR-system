@php use Carbon\Carbon; @endphp
@extends('dashboard.layouts.master')
@section('css')
    <!--  Owl-carousel css-->
    <link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet"/>
    <!-- Maps css -->
    <link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1"> @lang('lang.Welcome')</h2>
                <p class="mg-b-0">{{ auth()->user()->name }}</p>

            </div>

        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <a href="https://vodex-hr.tawk.help" target="_blank" type="button" class="btn btn-info btn-icon ml-2"><i class="fas fa-info"></i></a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row row-sm">
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">@lang("lang.Companies")</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ $companies_count }}</h4>
                                <p class="mb-0 tx-12 text-white op-7">@lang("lang.company_count")</p>
                            </div>
                        </div>
                    </div>
                </div>
                <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">@lang("lang.Employees")</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ $employees_count }}</h4>
                                <p class="mb-0 tx-12 text-white op-7">@lang('lang.employee_cont')</p>
                            </div>
                        </div>
                    </div>
                </div>
                <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
            </div>
        </div>
    </div>
    <div class="row row-sm row-deck">
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card card-table-two">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mb-1">@lang("lang.checkin")</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <span
                    class="tx-12 tx-muted mb-3 ">@lang("lang.checkinT")</span>
                <div class="table-responsive country-table">
                    <table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
                        <thead>
                        <tr>
                            <th class="tx-center">@lang("lang.name")</th>
                            <th class="tx-center">@lang("lang.company")</th>
                            <th class="tx-center">@lang("lang.shift")</th>
                            <th class="tx-center">@lang("lang.Shift_start")</th>
                            <th class="tx-center">@lang("lang.check_in")</th>
                            <th class="tx-center">@lang("lang.d_time")</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($attendances as $item)
                            <tr>
                                <td class="tx-center tx-medium tx-inverse">
                                    {{ $item->employee->fullName }}
                                </td>
                                <td class="tx-center tx-medium tx-inverse">
                                    {{ $item->employee->company->name }}
                                </td>
                                <td class="tx-center tx-medium tx-inverse">
                                    {{ $item->employee->shift->name }}
                                </td>
                                <td class="tx-center tx-medium tx-inverse">
                                    {{ Carbon::make($item->employee->shift->extra_time)->format('h:i A') }}
                                </td>
                                <td class="tx-center tx-medium tx-inverse">
                                    {{ Carbon::make($item->check_in)->format('h:i A') }}
                                </td>
                                <td class="tx-center tx-medium tx-danger">
                                    {{ Carbon::make($item->delay)->format('H:i') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="tx-center">@lang("lang.nodata")</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm row-deck">
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card card-table-two">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mb-1">@lang("lang.checkout")</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <span
                    class="tx-12 tx-muted mb-3 ">@lang("lang.checkoutT")</span>
                <div class="table-responsive country-table">
                    <table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
                        <thead>
                        <tr>
                            <th class="tx-center">@lang("lang.name")</th>
                            <th class="tx-center">@lang("lang.company")</th>
                            <th class="tx-center">@lang("lang.shift")</th>
                            <th class="tx-center">@lang("lang.Shift_end")</th>
                            <th class="tx-center">@lang("lang.check_out")</th>
                            <th class="tx-center">@lang("lang.W_hour")</th>
                            <th class="tx-center">@lang("lang.A_time")</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($attendanceCheckout as $item)
                            <tr>
                                <td class="tx-center tx-medium tx-inverse">
                                    {{ $item->employee->fullName }}
                                </td>
                                <td class="tx-center tx-medium tx-inverse">
                                    {{ $item->employee->company->name }}
                                </td>
                                <td class="tx-center tx-medium tx-inverse">
                                    {{ $item->employee->shift->name }}
                                </td>
                                <td class="tx-center tx-medium tx-inverse">
                                    {{ Carbon::make($item->employee->shift->to)->format('h:i A') }}
                                </td>
                                <td class="tx-center tx-medium tx-inverse">
                                    {{ Carbon::make($item->check_out)->format('h:i A') }}
                                </td>
                                <td class="tx-center tx-medium tx-inverse">
                                    {{ Carbon::make($item->work_hour)->format('H:i:s') }}
                                </td>
                                <td class="tx-center tx-medium tx-success">
                                    {{ $item->additional ? Carbon::make($item->additional)->format('h:i') : "00:00"}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="tx-center">@lang("lang.nodata")</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
    <!-- Moment js -->
    <script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
    <!--Internal  Flot js-->
    <script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
    <script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
    <script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
    <!--Internal Apexchart js-->
    <script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
    <!-- Internal Map -->
    <script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
    <!--Internal  index js -->
    <script src="{{URL::asset('assets/js/index.js')}}"></script>
    <script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>
@endsection
