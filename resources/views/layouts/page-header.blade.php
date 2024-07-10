<div class="navbar-header">
    <div class="d-flex">
        <!-- LOGO -->
        <div class="navbar-brand-box">
            <a href="#" class="logo logo-dark">
                <span class="logo-sm mt-2">
                    <img src="{{ asset('images/logo-dewata.png') }}" alt="" height="26">

                </span>
                <span class="logo-lg">
                    {{-- <img src="{{ asset('images/logo-dewata.png') }}" alt="" height="28"> --}}
                    <h6 class=" text-center m-4">KLINIK BERSAMA</h6>
                    <hr class=" bg-yellow-50">
                </span>
            </a>

            <a href="#" class="logo logo-light">
                <span class="logo-lg">
                    <img src="{{ asset('images/logo-dewata.png') }}" alt="" height="30">
                </span>
                <span class="logo-sm">
                    <img src="{{ asset('images/logo-dewata.png') }}" alt="" height="26">
                </span>
            </a>
        </div>

        <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn">
            <i class="bx bx-menu align-middle"></i>
        </button>

        <!-- start page title -->
        <div class="page-title-box align-self-center d-none d-md-block">
            <h4 class="page-title mb-0">KLINIK BERSAMA</h4>
        </div>
        <!-- end page title -->
        {{-- <div class="d-flex pt-3">
            <div class="container">
                <div class="row">
                    <div class="col d-flex align-items-center justify-content-center">
                        <div id="current-time" class=" card rounded-1 p-2">
                        </div>
                    </div>
                </div>
            </div>
    </div> --}}

    </div>

    <div class="d-grid">
        <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item user text-start d-flex align-items-center"
                id="page-header-user-dropdown-v" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="rounded-circle header-profile-user" src="{{ asset('assets/images/users/avatar-none.svg') }}"
                    alt="Header Avatar">
                <span class="d-none d-xl-inline-block ms-2 fw-medium font-size-15">{{ Auth::user()->nama }}</span>
            </button>
            <div class="dropdown-menu dropdown-menu-end pt-0">
                <div class="p-3 border-bottom">
                    <h6 class="mb-0">{{ Auth::user()->nama }}</h6>
                    <p class="mb-0 font-size-11 text-muted">{{ Auth::user()->role }}</p>
                </div>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"><i
                        class="mdi mdi-logout text-muted font-size-16 align-middle me-2"></i> <span
                        class="align-middle">Logout</span></a>
            </div>
        </div>
    </div>


</div>
