<nav class="navbar navbar-expand-lg bg-light">
    <div class="container">
        <a class="navbar-brand font-weight-bold" href="{{ url('/') }}">E-Posyandu</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            @if(auth()->user())
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }} font-size-14 font-weight-bold" href="{{ url('/') }}">Halaman Utama</a>
                    </li>

                    @can('isAdmin')
                        <li class="nav-item ms-2">
                            <a class="nav-link {{ request()->is('anak') || request()->is('anak/*') ? 'active' : '' }} font-size-14 font-weight-bold" href="{{ route('anak.index') }}">Data Anak</a>
                        </li>
                        <li class="nav-item ms-2">
                            <a class="nav-link {{ request()->is('perkembangan-anak') || request()->is('perkembangan-anak/*') ? 'active' : '' }} font-size-14 font-weight-bold" href="{{ route('perkembangan-anak.index') }}">Perkembangan Anak</a>
                        </li>
                        <li class="nav-item dropdown ms-2">
                            <a class="nav-link {{ request()->is('laporan/*') ? 'active' : '' }} dropdown-toggle font-size-14 font-weight-bold" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Laporan
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item font-size-14 font-weight-bold" href="{{ route('laporan.per-anak') }}">Per Anak</a></li>
                                <li><a class="dropdown-item font-size-14 font-weight-bold" href="{{ route('laporan.per-bulan') }}">Per Bulan</a></li>
                            </ul>
                        </li>
                        <li class="nav-item ms-2">
                            <a class="nav-link font-size-14 font-weight-bold" href="http://absens1.xyz/admin/absensi">Data Kehadiran</a>
                        </li>
                    @endcan
                    <li class="nav-item ms-2">
                        <form id="form_logout" action="{{ url('/logout') }}" method="POST">
                            @csrf

                            <a class="nav-link font-size-14 font-weight-bold" href="javascript:{}" onclick="document.getElementById('form_logout').submit();">Logout</a>
                        </form>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</nav>