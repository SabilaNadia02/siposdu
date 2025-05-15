<nav class="app-header navbar navbar-expand bg-body shadow-sm">
    <!--begin::Container-->
    <div class="container-fluid">

        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
        </ul>
        <!--end::Start Navbar Links-->

        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto">
            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                </a>
            </li>
            <!--end::Fullscreen Toggle-->

            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="{{ asset('images/default-user-icon.svg') }}" class="user-image rounded-circle shadow" alt="User Icon" />
                    <span class="d-none d-md-inline">{{ auth()->user()->nama }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <!--begin::User Image-->
                    <li class="user-header text-bg-primary">
                        <img src="{{ asset('images/default-user-icon.svg') }}" class="user-image rounded-circle shadow" alt="User Icon" />
                        <p>
                            {{ auth()->user()->nama }}
                            <small>
                                @if (auth()->user()->role == 1)
                                    ADMIN
                                @elseif(auth()->user()->role == 2)
                                    TENAGA KESEHATAN
                                @elseif(auth()->user()->role == 3)
                                    KADER
                                @else
                                    -
                                @endif
                            </small>
                        </p>
                    </li>
                    <!--end::User Image-->
                    <!--begin::Menu Footer-->
                    <li class="user-footer" style="display: flex; justify-content: center; align-items: center;">
                        <a href="{{ route('logout') }}" class="btn btn-default btn-flat"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            KELUAR
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    <!--end::Menu Footer-->
                </ul>
            </li>
            <!--end::User Menu Dropdown-->
        </ul>
        <!--end::End Navbar Links-->
    </div>
    <!--end::Container-->
</nav>
