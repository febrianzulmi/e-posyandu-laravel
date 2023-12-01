<nav class="navbar navbar-expand-lg">
    <div class="container">
        <div>
            <a class="navbar-brand animated-text font-nav" href="{{ url('/') }}">E-POSYANDU</a>
            <!-- Other navigation elements here -->
        </div>


        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            @if (auth()->user())
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }} font-size-14 font-weight-light"
                            href="{{ url('/') }}" style="color: black">Halaman Utama</a>
                    </li>

                    @can('isAdmin')
                        <li class="nav-item ms-2">
                            <a class="nav-link {{ request()->is('anak') || request()->is('anak/*') ? 'active' : '' }} font-size-14 font-weight-light"
                                href="{{ route('anak.index') }}" style="color: black">Data Anak</a>
                        </li>
                        <li class="nav-item ms-2">
                            <a class="nav-link {{ request()->is('perkembangan-anak') || request()->is('perkembangan-anak/*') ? 'active' : '' }} font-size-14 font-weight-light"
                                href="{{ route('perkembangan-anak.index') }}" style="color: black">Perkembangan Anak</a>
                        </li>
                        <li class="nav-item dropdown ms-2">
                            <a class="nav-link {{ request()->is('laporan/*') ? 'active' : '' }} dropdown-toggle font-size-14 font-weight-light"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                                style="color: black">
                                Laporan
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item font-size-14 font-weight-light"
                                        href="{{ route('laporan.per-anak') }}">Per Anak</a></li>
                                <li><a class="dropdown-item font-size-14 font-weight-light"
                                        href="{{ route('laporan.per-bulan') }}">Per Bulan</a></li>
                            </ul>
                        </li>
                        <li class="nav-item ms-2">
                            <a class="nav-link font-size-14 font-weight-light" href="http://absens1.xyz/admin/absensi"
                                style="color: black">Data
                                Kehadiran</a>
                        </li>
                    @endcan
                    <li class="nav-item ms-2">
                        <form id="form_logout" action="{{ url('/logout') }}" method="POST">
                            @csrf

                            <a class="nav-link font-size-14 font-weight-light" href="javascript:{}"
                                onclick="document.getElementById('form_logout').submit();"
                                style="color: black">Logout</a>
                        </form>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</nav>
