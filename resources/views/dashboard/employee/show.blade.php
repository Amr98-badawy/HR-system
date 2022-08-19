@php use App\Models\Employee;use Carbon\Carbon; @endphp
@extends('dashboard.layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Dashboard</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ Profile</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-lg-4">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="pl-0">
                        <div class="main-profile-overview">
                            <div class="main-img-user profile-user">

                                @if($employee->getFirstMedia('photo'))
                                    {{$employee->getFirstMedia('photo')->img()}}
                                @else
                                    <img alt="" src="{{ asset('assets/img/Avatar/user-avatar.png') }}">
                                @endif
                            </div>
                            <div class="d-flex justify-content-between mg-b-20">
                                <div>
                                    <h5 class="main-profile-name">{{ $employee->fullName }}</h5>
                                    <p class="main-profile-name-text">{{ $employee->job_title }}</p>
                                </div>
                            </div>
                            <hr class="mg-y-30">
                            <label class="main-content-label tx-13 mg-b-20">Social</label>
                            <div class="main-profile-social-list">
                                <div class="media">
                                    <div class="media-icon bg-primary-transparent text-white">
                                        <i class="fas fa-phone-square-alt"></i>
                                    </div>
                                    <div class="media-body">
                                        <span>Mobile</span>
                                        <a href="tel:{{$employee->mobile}}">{{ $employee->mobile }}</a>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-icon bg-primary-transparent text-white">
                                        <i class="fas fa-venus-mars"></i>
                                    </div>
                                    <div class="media-body">
                                        <span>Gender</span>
                                        <a href="javascript:void(0)">{{ Employee::GENDER[$employee->gender] }}</a>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-icon bg-primary-transparent text-white">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="media-body">
                                        <span>Status</span>
                                        <a href="javascript:void(0)">{{ Employee::STATUS[$employee->status] }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="row row-sm">
                <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class="counter-status d-flex md-mb-0">
                                <div class="counter-icon bg-primary-transparent">
                                    <i class="fas fa-building text-white"></i>
                                </div>
                                <div class="mr-auto">
                                    <h5 class="tx-13">Company</h5>
                                    <h2 class="mb-0 tx-22 mb-1 mt-1">{{ $employee->company->name }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class="counter-status d-flex md-mb-0">
                                <div class="counter-icon bg-danger-transparent">
                                    <i class="fas fa-building text-danger"></i>
                                </div>
                                <div class="mr-auto">
                                    <h5 class="tx-13">Department</h5>
                                    <h2 class="mb-0 tx-22 mb-1 mt-1">{{ $employee->department->name }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class="counter-status d-flex md-mb-0">
                                <div class="counter-icon bg-success-transparent">
                                    <i class="fas fa-building text-success"></i>
                                </div>
                                <div class="mr-auto">
                                    <h5 class="tx-13">Section</h5>
                                    <h2 class="mb-0 tx-22 mb-1 mt-1">{{ $employee->section->name }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-sm">
                <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class="counter-status d-flex md-mb-0">
                                <div class="counter-icon bg-warning-transparent">
                                    <i class="fas fa-dollar-sign text-warning"></i>
                                </div>
                                <div class="mr-auto">
                                    <h5 class="tx-13">Salary</h5>
                                    <h2 class="mb-0 tx-22 mb-1 mt-1">{{ $employee->salary }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="tabs-menu ">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs profile navtab-custom panel-tabs">
                            <li class="active">
                                <a href="#home" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i
                                            class="las la-user-circle tx-16 mr-1"></i></span> <span class="hidden-xs">About Employee</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#profile" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i
                                            class="las la-images tx-15 mr-1"></i></span> <span
                                        class="hidden-xs">Files</span> </a>
                            </li>
                            <li class="">
                                <a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i
                                            class="las la-cog tx-16 mr-1"></i></span> <span
                                        class="hidden-xs">Attendance</span> </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content border-left border-bottom border-right border-top-0 p-4">
                        <div class="tab-pane active" id="home">
                            <h4 class="tx-15 text-uppercase mb-3">Address</h4>
                            <p class="m-b-5">
                                {{ $employee->address }}
                            </p>
                            <div class="m-t-30">
                                <h4 class="tx-15 text-uppercase mt-3">Date Of Birth</h4>
                                <div class=" p-t-10">
                                    <p><b>{{ $employee->date_of_birth }}</b></p>
                                </div>
                                <hr>
                                <div class="">
                                    <h4 class="tx-15 text-uppercase mt-3">Date Of Employment</h4>
                                    <div class=" p-t-10">
                                        <p><b>{{ $employee->date_of_employment }}</b></p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="m-t-30">
                                <h4 class="tx-15 text-uppercase mt-3">ID Card</h4>
                                <div class=" p-t-10">
                                    <p><b>{{ $employee->id_card }}</b></p>
                                </div>

                                <div class="">
                                    <h4 class="tx-15 text-uppercase mt-3">Nationality</h4>
                                    <div class=" p-t-10">
                                        <p><b>{{ $employee->nationality }}</b></p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="m-t-30">
                                <h4 class="tx-15 text-uppercase mt-3">Bank Account</h4>
                                <div class=" p-t-10">
                                    <p><b>{{ $employee->bank_account }}</b></p>
                                </div>
                            </div>
                            <hr>
                            <div class="m-t-30">
                                <div class="">
                                    <h4 class="tx-15 text-uppercase mt-3">Shift</h4>
                                    <div class=" p-t-10">
                                        <p><b>{{ $employee->shift->name }}</b></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="tx-15 text-uppercase mt-3">From</h4>
                                        <div class=" p-t-10">
                                            <p>
                                                <b>{{ Carbon::make($employee->shift->from)->format('h:i A') }}</b>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="tx-15 text-uppercase mt-3">To</h4>
                                        <div class=" p-t-10">
                                            <p><b>{{ Carbon::make($employee->shift->to)->format('h:i A') }}</b>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="profile">
                            <div class="row">
                                @if($employee->getFirstMedia('photo'))
                                    <div class="col-sm-4">
                                        <div class="border p-1 card thumb">
                                            <a href="{{ $employee->getFirstMedia('photo')->getUrl() }}" target="_blank"
                                               class="image-popup"
                                               title="Screenshot-2">
                                                <img src="{{ asset('assets/img/Avatar/docs.jpg') }}"
                                                     class="thumb-img"
                                                     alt="work-thumbnail" height="250">
                                            </a>
                                            <h4 class="text-center tx-14 mt-3 mb-0">
                                                Personal Photo
                                            </h4>
                                            <div class="ga-border"></div>
                                            <p class="text-muted text-center">
                                                <small>Photography</small>
                                            </p>
                                        </div>
                                    </div>
                                @endif
                                @if($employee->getFirstMedia('military_status'))
                                    <div class="col-sm-4">
                                        <div class=" border p-1 card thumb">
                                            <a href="{{ $employee->getFirstMedia('military_status')->getUrl() }}"
                                               class="image-popup" title="Screenshot-2" target="_blank">
                                                <img src="{{ asset('assets/img/Avatar/docs.jpg') }}" class="thumb-img"
                                                     height="250" alt="work-thumbnail">
                                            </a>
                                            <h4 class="text-center tx-14 mt-3 mb-0">Military File</h4>
                                            <div class="ga-border"></div>
                                            <p class="text-muted text-center">
                                                <small>Docs</small>
                                            </p>
                                        </div>
                                    </div>
                                @endif
                                @if($employee->getFirstMedia('criminal_record'))
                                    <div class="col-sm-4">
                                        <div class=" border p-1 card thumb">
                                            <a href="{{ $employee->getFirstMedia('criminal_record')->getUrl() }}"
                                               class="image-popup" title="Screenshot-2" target="_blank">
                                                <img src="{{ asset('assets/img/Avatar/docs.jpg') }}" class="thumb-img"
                                                     height="250" alt="work-thumbnail">
                                            </a>
                                            <h4 class="text-center tx-14 mt-3 mb-0">Criminal Record</h4>
                                            <div class="ga-border"></div>
                                            <p class="text-muted text-center">
                                                <small>Docs</small>
                                            </p>
                                        </div>
                                    </div>
                                @endif
                                @if($employee->getFirstMedia('collage_certificate'))
                                    <div class="col-sm-4">
                                        <div class=" border p-1 card thumb">
                                            <a href="{{ $employee->getFirstMedia('collage_certificate')->getUrl() }}"
                                               class="image-popup" title="Screenshot-2" target="_blank">
                                                <img src="{{ asset('assets/img/Avatar/docs.jpg') }}" class="thumb-img"
                                                     height="250" alt="work-thumbnail">
                                            </a>
                                            <h4 class="text-center tx-14 mt-3 mb-0">Collage Certificate</h4>
                                            <div class="ga-border"></div>
                                            <p class="text-muted text-center">
                                                <small>Docs</small>
                                            </p>
                                        </div>
                                    </div>
                                @endif
                                @if($employee->getFirstMedia('birth_certificate'))
                                    <div class="col-sm-4">
                                        <div class=" border p-1 card thumb">
                                            <a href="{{ $employee->getFirstMedia('birth_certificate')->getUrl() }}"
                                               class="image-popup" title="Screenshot-2" target="_blank">
                                                <img src="{{ asset('assets/img/Avatar/docs.jpg') }}" class="thumb-img"
                                                     height="250" alt="work-thumbnail">
                                            </a>
                                            <h4 class="text-center tx-14 mt-3 mb-0">Birth Certificate</h4>
                                            <div class="ga-border"></div>
                                            <p class="text-muted text-center">
                                                <small>Docs</small>
                                            </p>
                                        </div>
                                    </div>
                                @endif
                                @if($employee->getMedia('additional_files'))
                                    @forelse($employee->getMedia('additional_files') as $item)
                                        <div class="col-sm-4">
                                            <div class=" border p-1 card thumb">
                                                <a href="{{ $item->getUrl() }}"
                                                   class="image-popup" title="Screenshot-2" target="_blank">
                                                    <img src="{{ asset('assets/img/Avatar/docs.jpg') }}"
                                                         class="thumb-img"
                                                         height="250" alt="work-thumbnail">
                                                </a>
                                                <h4 class="text-center tx-14 mt-3 mb-0">Additional Data</h4>
                                                <div class="ga-border"></div>
                                                <p class="text-muted text-center">
                                                    <small>Docs</small>
                                                </p>
                                            </div>
                                        </div>
                                    @empty
                                    @endforelse
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane" id="settings">
                            <form role="form">
                                <div class="form-group">
                                    <label for="FullName">Full Name</label>
                                    <input type="text" value="John Doe" id="FullName" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="Email">Email</label>
                                    <input type="email" value="first.last@example.com" id="Email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="Username">Username</label>
                                    <input type="text" value="john" id="Username" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="Password">Password</label>
                                    <input type="password" placeholder="6 - 15 Characters" id="Password"
                                           class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="RePassword">Re-Password</label>
                                    <input type="password" placeholder="6 - 15 Characters" id="RePassword"
                                           class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="AboutMe">About Me</label>
                                    <textarea id="AboutMe" class="form-control">Loren gypsum dolor sit mate, consecrate disciplining lit, tied diam nonunion nib modernism tincidunt it Loretta dolor manga Amalia erst volute. Ur wise denim ad minim venial, quid nostrum exercise ration perambulator suspicious cortisol nil it applique ex ea commodore consequent.</textarea>
                                </div>
                                <button class="btn btn-primary waves-effect waves-light w-md" type="submit">Save
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
@endsection
