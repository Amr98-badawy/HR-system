@extends('dashboard.layouts.master')
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

    <div class="row row-sm">
        <div class="col-lg-6">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="pl-0">
                        <div class="main-profile-overview">
                            <div class="main-img-user profile-user">
                                <img alt="" src="{{ asset('assets/img/Avatar/user-avatar.png')}}">
                            </div>
                            <div class="d-flex justify-content-between mg-b-20">
                                <div>
                                    <h5 class="main-profile-name">  {{$user->name}}</h5>
                                    <p class="main-profile-name-text"> <span class="badge badge-purple"> {{$user->roles[0]['name']}}</span></p>
                                </div>
                            </div>
                            <h6>Email</h6>
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
