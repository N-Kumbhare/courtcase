<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li> 
    </ul> 
    @php
        $explodeArray = explode(" ",Auth::user()->name); 
    @endphp
      <ul class="navbar-nav ml-auto"> 
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>&nbsp; {{$explodeArray[0]}}
            </a>
            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                <a href="{{route('users.edit',Auth::user())}}" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i> My Profile
                </a>
                <a href="{{route('subscription')}}" class="dropdown-item">
                    <i class="fas fa-id-card  mr-2"></i>{{Auth::user()->isTrial === "0" ? "Change membership" : "Purchase membership"}}
                </a>
                <div class="dropdown-divider"></div> 
                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                    <i class="fas fa-lock mr-2"></i> {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
