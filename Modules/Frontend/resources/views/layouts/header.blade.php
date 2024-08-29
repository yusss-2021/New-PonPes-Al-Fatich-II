 <!-- Navbar & Hero Start -->
 <div class="container-fluid nav-bar px-0 px-lg-4 py-lg-0">
     <div class="container-fluid">
         <nav class="navbar navbar-expand-lg navbar-light">
             <a href="#" class="navbar-brand p-0">
                 <h1 class="text-primary mb-0"> Ponpes Al-Fatich II </h1>
                 {{-- <img src="" alt="Logo">  --}}
             </a>
             <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                 <span class="fa fa-bars"></span>
             </button>
             <div class="collapse navbar-collapse" id="navbarCollapse">
                 <div class="navbar-nav mx-0 mx-lg-auto">
                     <a href="{{ route('frontend.index') }}"
                         class="nav-item nav-link {{ Route::currentRouteName() == 'frontend.index' ? 'active' : '' }}">Home</a>
                     <a href="{{ route('frontend.blog.index') }}"
                         class="nav-item nav-link {{ Route::currentRouteName() == 'frontend.blog.index' ? 'active' : '' }}"
                         id="mnBerita">Berita</a>
                     <a href="{{ route('frontend.wakaf.index') }}"
                         class="nav-item nav-link {{ Route::currentRouteName() == 'frontend.wakaf.index' ? 'active' : '' }}"
                         id="mnWakaf">Wakaf</a>
                     <a href="{{ route('frontend.donasi.index') }}"
                         class="nav-item nav-link {{ Route::currentRouteName() == 'frontend.donasi.index' ? 'active' : '' }}"
                         id="mnDonasi">Donasi</a>
                     <div class="nav-item dropdown">
                         <a href="javascript:void(0)" class="nav-link" data-bs-toggle="dropdown">
                             <span class="dropdown-toggle">Profil</span>
                         </a>
                         <div class="dropdown-menu">
                             <a href="{{ route('frontend.profile.abount-me') }}" class="dropdown-item">Tentang
                                 Kami</a>
                             <a href="{{ route('frontend.profile.gallery') }}" class="dropdown-item">Gallery</a>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="d-none d-xl-flex flex-shrink-0 ps-4">
                 <a href="{{ route('frontend.wakaf.index') }}" class="btn btn-primary">Wakaf Sekarang</a>

             </div>
         </nav>
     </div>
 </div>
 <!-- Navbar & Hero End -->
