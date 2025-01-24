<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link text-center">
        <img src="{{ asset('img/logo.jpg') }}" class="brand-image img-circle mr-0">
        <span class="brand-text font-weight-light"><b>AdvoCaseeNgp</b></span>
    </a>
    @php
        // dd(Auth::user());
    @endphp
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image"> --}}
                {{-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2"> --}}
            {{-- </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user() ? Auth::user()->name : '' }}</a>
            </div>
        </div> --}}

        <!-- SidebarSearch Form -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item {{ request()->is('home') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li
                    class="nav-item {{ request()->is('users*') || request()->is('lawyers*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Clients
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}"
                                class="nav-link {{ request()->is('users*') ? 'active' : '' }} ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Client List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('lawyers.index') }}"
                                class="nav-link {{ request()->is('lawyers*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lawyer List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li
                    class="nav-item {{ request()->is('cases*') || request()->is('districtCourtReport') || request()->is('highCourtReport') || request()->is('todayReport') || request()->is('pastReport') || request()->is('futureReport') || request()->is('recordRoomReport') || request()->is('dateWiseCaseReport')|| request()->is('postDateWiseCaseReport') || request()->is('fileUploads*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Cases
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('cases.index') }}"
                                class="nav-link {{ (request()->is('cases*') || request()->is('fileUploads*')) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create New Case</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dateWiseCaseReport') }}"
                                class="nav-link {{ request()->is('dateWiseCaseReport*') || request()->is('postDateWiseCaseReport*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Date Wise Case Report</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('districtCourtReport') }}"
                                class="nav-link {{ request()->is('districtCourtReport') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>District Court</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('highCourtReport') }}"
                                class="nav-link {{ request()->is('highCourtReport') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>High Court</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('todayReport') }}"
                                class="nav-link {{ request()->is('todayReport') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Today Case</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pastReport') }}"
                                class="nav-link {{ request()->is('pastReport') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Past Case</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('futureReport') }}"
                                class="nav-link {{ request()->is('futureReport') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Future Case</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('recordRoomReport') }}"
                                class="nav-link {{ request()->is('recordRoomReport') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Record Room</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li
                    class="nav-item {{ request()->is('casetypes*') || request()->is('matters*') || request()->is('briefs*') || request()->is('courts*')|| request()->is('districtcourts*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-database "></i>
                        <p>
                            Masters
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- <li class="nav-item">
                            <a href="{{ route('districtcourts.index') }}"
                                class="nav-link {{ request()->is('districtcourts*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Courts</p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ route('casetypes.index') }}"
                                class="nav-link {{ request()->is('casetypes*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cases</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('matters.index') }}"
                                class="nav-link {{ request()->is('matters*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Matters</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('briefs.index') }}"
                                class="nav-link {{ request()->is('briefs*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Brief</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('courts.index') }}"
                                class="nav-link {{ request()->is('courts*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Courts</p>
                            </a>
                        </li>
                    </ul>
                </li>
                 {{-- <li class="nav-item">
                    <a href="{{ route('calculator') }}" class="nav-link">
                        <i class="fas fa-calculator nav-icon"></i>
                        <p>Calculator</p>
                    </a> 
                </li>  --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
