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
							<li class="">
                                <a href="#user" class="active" data-toggle="tab">
                                    <i class="ion ion-md-person tx-18 mr-2"></i>
                                    User Management
                                </a>
                            </li>
							<li>
                                <a href="#org" data-toggle="tab">
                                    <i class="ion ion-md-business tx-18  mr-2"></i>
                                    Organization
                                </a>
                            </li>
							<li><a href="#setting" data-toggle="tab">
                                    <i class="ion ion-md-cog tx-18 mr-2"></i>
                                    Settings
                                </a>
                            </li>
						</ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane active " id="user">
							<div class="list d-flex align-items-center border-bottom p-3">
								<div class="">
									<span class="avatar bg-primary brround avatar-md">U</span>
								</div>
								<a class="wrapper w-100 ml-3" href="{{ route('dashboard.users.index') }}" >
									<p class="mb-0 d-flex ">
										<b>Users</b>
									</p>
								</a>
							</div>
							<div class="list d-flex align-items-center border-bottom p-3">
								<div class="">
									<span class="avatar bg-primary brround avatar-md">R</span>
								</div>
								<a class="wrapper w-100 ml-3" href="{{ route('dashboard.roles.index') }}" >
									<p class="mb-0 d-flex ">
										<b>Roles</b>
									</p>
								</a>
							</div>
							<div class="list d-flex align-items-center border-bottom p-3">
								<div class="">
									<span class="avatar bg-primary brround avatar-md">P</span>
								</div>
								<a class="wrapper w-100 ml-3" href="{{ route('dashboard.permissions.index') }}" >
									<p class="mb-0 d-flex ">
										<b>Permissions</b>
									</p>
								</a>
							</div>
						</div>
						<div class="tab-pane" id="org">
							<div class="list-group list-group-flush ">
                                <div class="list d-flex align-items-center border-bottom p-3">
                                    <div class="">
                                        <span class="avatar bg-primary brround avatar-md">C</span>
                                    </div>
                                    <a class="wrapper w-100 ml-3" href="{{ route('dashboard.companies.index') }}" >
                                        <p class="mb-0 d-flex ">
                                            <b>Companies</b>
                                        </p>
                                    </a>
                                </div>
                                <div class="list d-flex align-items-center border-bottom p-3">
                                    <div class="">
                                        <span class="avatar bg-primary brround avatar-md">D</span>
                                    </div>
                                    <a class="wrapper w-100 ml-3" href="{{ route('dashboard.departments.index') }}" >
                                        <p class="mb-0 d-flex ">
                                            <b>Departments</b>
                                        </p>
                                    </a>
                                </div>
                                <div class="list d-flex align-items-center border-bottom p-3">
                                    <div class="">
                                        <span class="avatar bg-primary brround avatar-md">S</span>
                                    </div>
                                    <a class="wrapper w-100 ml-3" href="{{ route('dashboard.sections.index') }}" >
                                        <p class="mb-0 d-flex ">
                                            <b>Sections</b>
                                        </p>
                                    </a>
                                </div>
                                <div class="list d-flex align-items-center border-bottom p-3">
                                    <div class="">
                                        <span class="avatar bg-primary brround avatar-md">S</span>
                                    </div>
                                    <a class="wrapper w-100 ml-3" href="{{ route('dashboard.shifts.index') }}" >
                                        <p class="mb-0 d-flex ">
                                            <b>Shifts</b>
                                        </p>
                                    </a>
                                </div>
                                <div class="list d-flex align-items-center border-bottom p-3">
                                    <div class="">
                                        <span class="avatar bg-primary brround avatar-md">E</span>
                                    </div>
                                    <a class="wrapper w-100 ml-3" href="{{ route('dashboard.employees.index') }}" >
                                        <p class="mb-0 d-flex ">
                                            <b>Employees</b>
                                        </p>
                                    </a>
                                </div>
                                <div class="list d-flex align-items-center border-bottom p-3">
                                    <div class="">
                                        <span class="avatar bg-primary brround avatar-md">A</span>
                                    </div>
                                    <a class="wrapper w-100 ml-3" href="{{ route('dashboard.attendances.index') }}" >
                                        <p class="mb-0 d-flex ">
                                            <b>Attendances</b>
                                        </p>
                                    </a>
                                </div>
							</div>
						</div>
						<div class="tab-pane" id="setting">
							<div class="list-group list-group-flush ">
                                <div class="list d-flex align-items-center border-bottom p-3">
                                    <div class="">
                                        <span class="avatar bg-primary brround avatar-md">SL</span>
                                    </div>
                                    <a class="wrapper w-100 ml-3" href="" >
                                        <p class="mb-0 d-flex ">
                                            <b>Site Languages</b>
                                        </p>
                                    </a>
                                </div>
                                <div class="list d-flex align-items-center border-bottom p-3">
                                    <div class="">
                                        <span class="avatar bg-primary brround avatar-md">S</span>
                                    </div>
                                    <a class="wrapper w-100 ml-3" href="" >
                                        <p class="mb-0 d-flex ">
                                            <b>Settings</b>
                                        </p>
                                    </a>
                                </div>
                                <div class="list d-flex align-items-center border-bottom p-3">
                                    <div class="">
                                        <span class="avatar bg-primary brround avatar-md">ST</span>
                                    </div>
                                    <a class="wrapper w-100 ml-3" href="" >
                                        <p class="mb-0 d-flex ">
                                            <b>Site Translations</b>
                                        </p>
                                    </a>
                                </div>
                                <div class="list d-flex align-items-center border-bottom p-3">
                                    <div class="">
                                        <span class="avatar bg-primary brround avatar-md">RD</span>
                                    </div>
                                    <a class="wrapper w-100 ml-3" href="" >
                                        <p class="mb-0 d-flex ">
                                            <b>Route Devices</b>
                                        </p>
                                    </a>
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<!--/Sidebar-right-->
