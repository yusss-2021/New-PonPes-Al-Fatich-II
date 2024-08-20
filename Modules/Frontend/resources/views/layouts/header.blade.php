<header>
    <nav class="navbar navbar-expand-lg navbar-white bg-white rounded" aria-label="Eleventh navbar example">
        <div class="container">
            <a class="navbar-brand fs-2" href="{{ route('Frontend') }}">Pon Pes Al Fatich 2</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample09"
                aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample09">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active fw-bolder" aria-current="page"
                            href="{{ route('Frontend') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bolder" href="{{ route('berita') }}">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bolder" href="{{ route('Wakaftanah') }}">Wakaf</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bolder" href="{{ route('donasi') }}">Donasi</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-bolder" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Profil
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item fw-bolder" href="{{ route('Tentang-kami') }}">Tentang Kami</a>
                            </li>
                            <li><a class="dropdown-item fw-bolder" href="{{ route('Galleri') }}">Galleri</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary fw-bolder" href="#" role="button">
                            Wakaf Sekarang
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

</header>
