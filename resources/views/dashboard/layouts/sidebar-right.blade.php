<!-- Sidebar-right-->
<div class="sidebar sidebar-right sidebar-animate">
    <div class="panel panel-primary card mb-0 box-shadow">
        <div class="tab-menu-heading border-0 p-3">
            <div class="card-title mb-0">Management</div>
            <div class="card-options ml-auto">
                <a href="#" class="sidebar-remove"><i class="fe fe-x"></i></a>
            </div>
        </div>
        <div class="panel-body tabs-menu-body latest-tasks p-0 border-0">
            <div class="tabs-menu ">
                <!-- Tabs -->
                <ul class="nav panel-tabs">
                    @can('access_user')
                        <li class="">
                            <a href="#user" class="active" data-toggle="tab">
                                <i class="ion ion-md-person tx-18 mr-2" style="margin-right: 10px;"></i>
                                <b  style=" font-size: larger;margin-right: 10px;">
                                @lang("lang.UserManage")
                                </b>
                            </a>
                        </li>
                    @endcan
                    @if(auth()->user()->can('access_company') || auth()->user()->can('access_department') || auth()->user()->can('access_employee') || auth()->user()->can('access_section') || auth()->user()->can('access_shift') || auth()->user()->can('access_attendance'))
                        <li>
                            <a href="#org" data-toggle="tab">
                                <i class="ion ion-md-business tx-18  mr-2" style="margin-right: 10px;"></i>
                                <b  style=" font-size: larger;margin-right: 10px;">
                                @lang("lang.Organization")
                                </b>
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->can('access_company') || auth()->user()->can('access_department') || auth()->user()->can('access_employee') || auth()->user()->can('access_section') || auth()->user()->can('access_shift') || auth()->user()->can('access_attendance'))
                        <li><a href="#setting" data-toggle="tab" >
                                <i class="ion ion-md-cog tx-18 mr-2" style="margin-right: 10px;"></i>
                                <b  style=" font-size: larger;margin-right: 10px;"> @lang("lang.Settings") </b>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active " id="user">
                    @can('access_user')
                        <div class="list d-flex align-items-center border-bottom p-3">
                            <div class="">
                                <span class="avatar bg-primary brround avatar-md">U</span>
                            </div>
                            <a class="wrapper w-100 ml-3" href="{{ route('dashboard.users.index') }}">
                                <p class="mb-0 d-flex " style="margin-right: 10px;">
                                    <b>@lang("lang.users")   </b>
                                </p>
                            </a>
                        </div>
                    @endcan
                    @can('access_role')
                        <div class="list d-flex align-items-center border-bottom p-3">
                            <div class="">
                                <span class="avatar bg-primary brround avatar-md">R</span>
                            </div>
                            <a class="wrapper w-100 ml-3" href="{{ route('dashboard.roles.index') }}">
                                <p class="mb-0 d-flex " style="margin-right: 10px;">
                                    <b> @lang("lang.Roles")   </b>
                                </p>
                            </a>
                        </div>
                    @endcan
                    @can('access_permission')
                        <div class="list d-flex align-items-center border-bottom p-3">
                            <div class="">
                                <span class="avatar bg-primary brround avatar-md">P</span>
                            </div>
                            <a class="wrapper w-100 ml-3" href="{{ route('dashboard.permissions.index') }}">
                                <p class="mb-2 d-flex " style="margin-right: 10px;">
                                    <b>@lang("lang.permissions") </b>
                                </p>
                            </a>
                        </div>
                    @endcan
                </div>
                <div class="tab-pane" id="org">
                    <div class="list-group list-group-flush ">
                        @can('access_company')
                            <div class="list d-flex align-items-center border-bottom p-3">
                                <div class="">
                                    <span class="avatar bg-primary brround avatar-md">C</span>
                                </div>
                                <a class="wrapper w-100 ml-3" href="{{ route('dashboard.companies.index') }}">
                                    <p class="mb-0 d-flex " style="margin-right: 10px;">
                                                                          <b> @lang("lang.Companies") </b>
                                    </p>
                                </a>
                            </div>
                        @endcan
                        @can('access_department')
                            <div class="list d-flex align-items-center border-bottom p-3">
                                <div class="">
                                    <span class="avatar bg-primary brround avatar-md">D</span>
                                </div>
                                <a class="wrapper w-100 ml-3" href="{{ route('dashboard.departments.index') }}">
                                    <p class="mb-0 d-flex " style="margin-right: 10px;">
                                        <b>@lang("lang.Departments") </b>
                                    </p>
                                </a>
                            </div>
                        @endcan
                        @can('access_section')
                            <div class="list d-flex align-items-center border-bottom p-3">
                                <div class="">
                                    <span class="avatar bg-primary brround avatar-md">S</span>
                                </div>
                                <a class="wrapper w-100 ml-3" href="{{ route('dashboard.sections.index') }}">
                                    <p class="mb-0 d-flex " style="margin-right: 10px;">
                                        <b>@lang("lang.Sections") </b>
                                    </p>
                                </a>
                            </div>
                        @endcan
                        @can('access_shift')
                            <div class="list d-flex align-items-center border-bottom p-3">
                                <div class="">
                                    <span class="avatar bg-primary brround avatar-md">S</span>
                                </div>
                                <a class="wrapper w-100 ml-3" href="{{ route('dashboard.shifts.index') }}">
                                    <p class="mb-0 d-flex " style="margin-right: 10px;">
                                        <b>@lang("lang.Shifts") </b>
                                    </p>
                                </a>
                            </div>
                        @endcan
                        @can('access_employee')
                            <div class="list d-flex align-items-center border-bottom p-3">
                                <div class="">
                                    <span class="avatar bg-primary brround avatar-md">E</span>
                                </div>
                                <a class="wrapper w-100 ml-3" href="{{ route('dashboard.employees.index') }}">
                                    <p class="mb-0 d-flex " style="margin-right: 10px;">
                                        <b>@lang("lang.Employees") </b>
                                    </p>
                                </a>
                            </div>
                        @endcan
                        @can('access_attendance')
                            <div class="list d-flex align-items-center border-bottom p-3">
                                <div class="">
                                    <span class="avatar bg-primary brround avatar-md">A</span>
                                </div>
                                <a class="wrapper w-100 ml-3" href="{{ route('dashboard.attendances.index') }}">
                                    <p class="mb-0 d-flex " style="margin-right: 10px;">
                                        <b>@lang("lang.Attendances") </b>
                                    </p>
                                </a>
                            </div>
                        @endcan
                    </div>
                </div>
                <div class="tab-pane" id="setting">

                    <div class="list-group list-group-flush ">
                        @can('access_translation')
                            <div class="list d-flex align-items-center border-bottom p-3">
                                <div class="">
                                    <span class="avatar bg-primary brround avatar-md">ST</span>
                                </div>
                                <a class="wrapper w-100 ml-3" target="_blank" href="{{ route('languages.index') }}">
                                    <p class="mb-0 d-flex " style="margin-right: 10px;">
                                        <b>@lang("lang.site_trans") </b>
                                    </p>
                                </a>
                            </div>
                        @endcan
                        @can('access_log')
                            <div class="list d-flex align-items-center border-bottom p-3">
                                <div class="">
                                    <span class="avatar bg-primary brround avatar-md">LS</span>
                                </div>
                                <a class="wrapper w-100 ml-3" href="{{ route('dashboard.logs.index') }}">
                                    <p class="mb-0 d-flex " style="margin-right: 10px;">
                                        <b>@lang("lang.log_system") </b>
                                    </p>
                                </a>
                            </div>
                        @endcan
                        @can('access_device')
                            <div class="list d-flex align-items-center border-bottom p-3">
                                <div class="">
                                    <span class="avatar bg-primary brround avatar-md">RD</span>
                                </div>
                                <a class="wrapper w-100 ml-3" href="{{ route('dashboard.devices.index') }}">
                                    <p class="mb-0 d-flex " style="margin-right: 10px;">
                                        <b>@lang("lang.route_devices")</b>
                                    </p>
                                </a>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
