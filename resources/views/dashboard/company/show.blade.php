@extends('Dashboard.layouts.master')
@section('css')

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

{{--@dd($company->departments[0])--}}
<div class="row row-sm">
    <div class="col-lg-6">
        <div class="card mg-b-20">
            <div class="card-body">
                <div class="pl-0">
                    <div class="main-profile-overview">
                        <div class="main-img-user  profile-user">
                            <img alt="" src="{{ $company->getFirstMedia('logo')->getUrl()}}">
                        </div>
                        <div class="d-flex justify-content-between  mg-b-20">
                            <div>
                                <h5 class="main-profile-name">  {{$company->translate(app()->getLocale(),true)->name}}</h5>
                                @foreach($company->departments as $dep)
                                <p class="main-profile-name-text mg-t-10">
                                    <span class="badge badge-purple"> {{$dep->translate(app()->getLocale(),true)->name}}</span>

                                    @forelse($dep->sections as $sec)
                                         <span class="badge  badge-primary"> {{$sec->translate(app()->getLocale(),true)->name}}</span>
                                    @empty
                                        <span class="badge  badge-warning">no Sections</span>
                                    @endforelse

                                </p>
                                @endforeach
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
