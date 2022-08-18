<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="{{route('dashboard.home') }}"><img
                src="{{URL::asset('assets/img/brand/logo.png')}}" class="main-logo" alt="logo"></a>
        <a class="desktop-logo logo-dark active" href="{{ route('dashboard.home') }}"><img
                src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-light active" href="{{ route('dashboard.home') }}"><img
                src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-icon" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-dark active" href="{{ route('dashboard.home') }}"><img
                src="{{URL::asset('assets/img/brand/favicon-white.png')}}" class="logo-icon dark-theme" alt="logo"></a>
    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">

                    @if (auth()->user()->avatar)
                       {{ auth()->user()->avatar->img()->attributs(['class'=> 'avatar avatar-xl brround'])}}
                    @else
                        <img alt="user-img" class="avatar avatar-xl brround"
                             src="{{URL::asset('assets/img/Avatar/user-avatar.png')}}">

                    @endif
                    <span class="avatar-status profile-status bg-green"></span>
                </div>
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0">{{ auth()->user()->name }}</h4>

                    <span class="mb-0 text-muted">
                        @forelse( auth()->user()->roles as $role)
                            {{ $role->name }}
                        @empty
                        @endforelse
                    </span>
                </div>
            </div>
        </div>
        <ul class="side-menu">
            <li class="side-item side-item-category">@lang("lang.Companies")</li>
            @forelse($companies as $key=>$item)
                @can('access_'.\Illuminate\Support\Str::slug($item,'_'))
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="javascript:void(0)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 448 512">
                                <path d="M436 480h-20V24c0-13.255-10.745-24-24-24H56C42.745 0 32 10.745 32 24v456H12c-6.627 0-12 5.373-12 12v20h448v-20c0-6.627-5.373-12-12-12zM128 76c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12V76zm0 96c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40zm52 148h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12zm76 160h-64v-84c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v84zm64-172c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40zm0-96c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40zm0-96c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12V76c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40z"/>
                            </svg>
                            <span class="side-menu__label">
                                {{ $item }}
                            </span>
                            <i class="angle fe fe-chevron-down"></i>
                        </a>
                        <ul class="slide-menu">
                            <li>
                                <a class="slide-item"
                                   href="{{ route('dashboard.employees.company',$key) }}">@lang("lang.Employees")</a>
                            </li>
                            <li>
                                <a class="slide-item"
                                   href="{{ route('dashboard.attendances.company', $key) }}">@lang("lang.Attendances")</a>
                            </li>
                        </ul>
                    </li>
                @endcan
            @empty
            @endforelse
        </ul>
    </div>
</aside>
<!-- main-sidebar -->
