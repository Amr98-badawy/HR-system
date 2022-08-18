@extends('dashboard.layouts.master')
@section('css')

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"><a href="{{route("dashboard.home")}}"> @lang('lang.dashboard')</a></h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/  @lang('lang.company')</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="row row-sm">
        <div class="col-lg-6">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="pl-0">
                        <div class="main-profile-overview">
                            <div class="main-img-user  profile-user">
                                @if($company->getFirstMedia('logo'))
                                    <img alt="" src="{{ $company->getFirstMedia('logo')->getUrl() }}">
                                @else
                                    <img alt=""  src="{{ asset('assets/img/website -images/company-building.jpg') }}">
                                @endif
                            </div>
                            <div class="d-flex justify-content-between  mg-b-20">
                                <div>
                                    <h5 class="main-profile-name">  {{$company->name}}</h5>
                                    @forelse($company->departments as $dep)
                                        <p class="main-profile-name-text mg-t-10">
                                            <span
                                                class="badge badge-purple"> {{$dep->name}}</span>

                                            @forelse($dep->sections as $sec)
                                                <span
                                                    class="badge  badge-primary"> {{$sec->name}}</span>
                                            @empty
                                                <span class="badge  badge-warning">@lang('lang.no_sections')</span>
                                            @endforelse

                                        </p>
                                        @empty

                                        <span class="badge  badge-warning">@lang('lang.no_department')</span>
                                    @endforelse
                                </div>
                            </div>


                            <!--skill bar-->
                        </div><!-- main-profile-overview -->
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
@section('js')


@endsection
