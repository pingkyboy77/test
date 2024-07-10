<!-- LOGO -->
<div class="navbar-brand-box bg-dark">
    <a href="#" class="logo logo-dark">
        <span class="logo-sm my-4">
            <img src="{{ asset('images/hospital.png') }}" alt="" height="26">

        </span>
        <span class="logo-lg">
            <div class="row d-flex justify-content-start align-items-center my-4 mx-2">
                <div class="col-2 p-0">
                    <img src="{{ asset('images/hospital.png') }}" alt="" height="28">
                </div>
                <div class="col-8 pl-3">
                    <h6 class="text-light m-0">KLINIK BERSAMA</h6>
                </div>
            </div>

            <hr class=" bg-yellow-50 m-0">
        </span>
    </a>

    <a href="#" class="logo logo-light">
        <span class="logo-lg">
            <img src="{{ asset('images/hospital.png') }}" alt="" height="30">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('images/hospital.png') }}" alt="" height="26">
        </span>
    </a>
</div>

<button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn">
    <i class="bx bx-menu align-middle" style="color: white"></i>
</button>

<div data-simplebar class="sidebar-menu-scroll">

    <!--- Sidemenu -->
    <div id="sidebar-menu" class="mt-4 p-0">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            @if(auth()->user()->role=='admin' || auth()->user()->role=='direktur')
            <li>
                <a href="{{ route('beranda') }}">
                    <i class="bx bx-home-alt icon nav-icon"></i>
                    <span class="menu-item" data-key="t-dashboard">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('user-Management') }}">
                    <i class="bx bx-user-circle icon nav-icon"></i>
                    <span class="menu-item" data-key="t-dashboard">User Management</span>
                </a>
            </li>
            {{-- <li>
                <a href="{{ route('warehouse-Management.admin') }}">
                    <i class="bx bxs-factory icon nav-icon"></i>
                    <span class="menu-item" data-key="t-dashboard">Dokter Management</span>
                </a>
            </li> --}}
            <li>
                <a href="{{ route('data-Management') }}">
                    <i class="bx bx-file icon nav-icon"></i>
                    <span class="menu-item" data-key="t-dashboard">Pendaftaran Management</span>
                </a>
            </li>
            {{-- <li>
                <a href="#">
                    <i class="bx bx-history icon nav-icon"></i>
                    <span class="menu-item" data-key="t-dashboard">History Project</span>
                </a>
            </li> --}}
            {{-- <li>
                <a href="{{ route('history.admin') }}">
                    <i class="bx bx-history icon nav-icon"></i>
                    <span class="menu-item" data-key="t-dashboard">History Penerimaan Barang</span>
                </a>
            </li> --}}
            @endif
            @if(auth()->user()->role=='kepala_warehouse')
            <li>
                <a href="{{ route('beranda') }}">
                    <i class="bx bx-home-alt icon nav-icon"></i>
                    <span class="menu-item" data-key="t-dashboard">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('warehouse-Management.kepala') }}">
                    <i class="bx bxs-factory icon nav-icon"></i>
                    <span class="menu-item" data-key="t-dashboard">Warehouse Management</span>
                </a>
            </li>
            <li>
                <a href="{{ route('history.kepala') }}">
                    <i class="bx bx-history icon nav-icon"></i>
                    <span class="menu-item" data-key="t-dashboard">History Project</span>
                </a>
            </li>
            @endif

            @if(auth()->user()->role=='Dokter')
            <li>
                <a href="{{ route('beranda') }}">
                    <i class="bx bx-home-alt icon nav-icon"></i>
                    <span class="menu-item" data-key="t-dashboard">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('workorder.keproj') }}">
                    <i class="bx bx-file icon nav-icon"></i>
                    <span class="menu-item" data-key="t-dashboard">Work Order</span>
                </a>
            </li>
            {{-- <li>
                <a href="#">
                    <i class="bx bx-history icon nav-icon"></i>
                    <span class="menu-item" data-key="t-dashboard">History Project</span>
                </a>
            </li> --}}
            @endif

        </ul>
    </div>
    <!-- Sidebar -->
</div>
@include('layouts.horizontal-nav')
