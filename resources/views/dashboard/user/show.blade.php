@extends('dashboard.layouts.master')
@section('css')

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"><a href="{{route("dashboard.home")}}">@lang('lang.dashboard')</a></h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('lang.user')</span>
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

    <div class="row row-sm">
        <div class="col-lg-4 ">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="pl-0 ">
                        <div class="main-profile-overview   ">
                            <div class="main-img-user profile-user">
                                <img alt="" src="{{ asset('assets/img/Avatar/user-avatar.png')}}">
                            </div>
                            <div class="d-flex justify-content-between mg-b-20">
                                <div>
                                    <h5 class="main-profile-name">  {{$user->name}}</h5>
                                    <p class="main-profile-name-text"> <span class="badge badge-purple"> {{$user->roles[0]['name']}}</span></p>
                                </div>
                            </div>
                            <h6>@lang('lang.email')</h6>
                            <div class="main-profile-bio">
                                {{$user->email   }}
                            </div><!-- main-profile-bio -->


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
