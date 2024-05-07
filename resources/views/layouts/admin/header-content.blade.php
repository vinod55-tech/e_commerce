@include("layouts.admin.header")
<header id="header" class="site-header background_lgray">
    <div class="main-header">
        <div class="nav-group">
            <div class="left-menu">
                <a href="javascript:void(0);" class="toggle-btn d-block d-md-none">
                    <i class="la la-bars"></i>
                </a>
                <div class="profile-action">
                    <a>
                        <p>Admin</p><i class="fas fa-caret-down"></i>
                    </a>
                    <div class="drop-area">
                        <ul>
                            <li>
                                <a href="{{ route('logout') }}">
                                    <i class="la la-sign-out" aria-hidden="true"></i>
                                    <span>Log Out</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>


<aside class="main-sidebar background_lgray">
    <div class="logo-sidebar">
        <a href="{{url('/')}}" class="logo-img">
            <h3>Home</h3>
        </a>
    </div>
    <div class="dashboard-listing">
        <ul class="nav flex-column" id="nav_accordion">
            <li class="nav-item has-submenu">
                <a class="nav-link" href="{{route('products')}}">
                    <svg>
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#dashboard"></use>
                    </svg>
                    <span class="big">Dashboard</span>
                </a>
            </li>
            <li class="nav-item has-submenu">
                <a class="nav-link" href="{{route('color')}}">
                    <svg>
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#dashboard"></use>
                    </svg>
                    <span class="big">Colors</span>
                </a>
            </li>
            <li class="nav-item has-submenu">
                <a class="nav-link" href="{{route('size')}}">
                    <svg>
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#dashboard"></use>
                    </svg>
                    <span class="big">Sizes</span>
                </a>
            </li>
            
            
        </ul>
    </div>
</aside>

<main class="content">
@yield('content')
</main>
@include('layouts.admin.footer')