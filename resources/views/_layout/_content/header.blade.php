@include('_layout.html_open')

{{-- <div class="splash active">
    <div class="splash-icon"></div>
</div> --}}

<div class="wrapper">
    <nav id="sidebar" class="sidebar">
        <a class="sidebar-brand" asp-controller="Dashboards" asp-action="Index">
            {{-- <img src="~/img/avatars/wmsmini.jpg" class="img-fluid rounded-3  mb-2" alt="M-API" /> --}}
            &nbsp;&nbsp;
            M-API
        </a>
        <div class="sidebar-content">
            <div class="sidebar-user">
                <img src="{{ URL::asset('image/default-profile-pricture.jpg') }}" class="img-fluid rounded-circle mb-2" alt="Profile Picture" />

                <div class="fw-bold">

                    Muzakki Ahmad Al Farisi

                </div>
                {{-- <small> @User.FindFirst(x => x.Type == "ProfileName")?.Value </small> --}}
            </div>

            <ul class="sidebar-nav">
                @include('_layout._content.menu')
            </ul>

        </div>
    </nav>

    <div class="main">
        <nav class="navbar navbar-expand navbar-theme">
            <a class="sidebar-toggle d-flex me-2">
                <i class="hamburger align-self-center"></i>
            </a>

            <div class="navbar-text">
                {{-- @ViewData["MenuKey"] / @ViewData["Title"] --}}
            </div>

            <div class="navbar-collapse collapse">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item dropdown ms-lg-2">

                        <a class="nav-link dropdown-toggle position-relative" href="#" id="userDropdown" data-bs-toggle="dropdown">
                            <i class="align-middle fas fa-user-cog"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            {{-- <a class="dropdown-item" asp-controller="Account" asp-action="Index"><i class="align-middle me-1 fas fa-fw fa-user"></i> View Profile</a>
                            <div class="dropdown-divider"></div> --}}
                            <form method="post" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit"><i class="align-middle me-1 fas fa-fw fa-arrow-alt-circle-right"></i> Sign out</button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>

        </nav>
        <main class="container-fluid">