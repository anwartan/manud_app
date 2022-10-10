   <!-- Navbar Start -->
   <div class="container-fluid p-0">
       <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-2 py-lg-0 px-lg-5">
           <a href="index.html" class="navbar-brand d-block d-lg-none">
               <h1 class="m-0 display-4 text-uppercase text-primary">Desa<span
                       class="text-white font-weight-normal">MANUD</span></h1>
           </a>
           <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
               <span class="navbar-toggler-icon"></span>
           </button>
           <div class="collapse navbar-collapse justify-content-between px-0 px-lg-3" id="navbarCollapse">
               <div class="navbar-nav mr-auto py-0">
                   <a href="{{ url('') }}"
                       class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
                   {{-- <a href="category.html" class="nav-item nav-link">Category</a>
                <a href="single.html" class="nav-item nav-link">Single News</a> --}}
                   <div class="nav-item dropdown">
                       <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Layanan</a>
                       <div class="dropdown-menu rounded-0 m-0">
                           <a href="#" class="dropdown-item">Layanan Pekerjaan</a>
                           <a href="#" class="dropdown-item">Layanan Kesehatan</a>
                           <a href="#" class="dropdown-item">Pengaduan</a>
                           <a href="#" class="dropdown-item">Informasi Kuliner</a>
                           <a href="#" class="dropdown-item">Informasi Event</a>
                           <a href="#" class="dropdown-item">Informasi Wisata</a>
                           <a href="#" class="dropdown-item">Informasi Kebudayaan</a>
                           <a href="#" class="dropdown-item">Galeri</a>
                           <a href="#" class="dropdown-item">Informasi Lokasi</a>
                       </div>
                   </div>
                   <a href="{{ url('organization') }}"
                       class="nav-item nav-link {{ request()->is('organization') ? 'active' : '' }}">Profil
                       Organisasi</a>
               </div>
               {{-- <div class="input-group ml-auto d-none d-lg-flex" style="width: 100%; max-width: 300px;">
                <input type="text" class="form-control border-0" placeholder="Keyword">
                <div class="input-group-append">
                    <button class="input-group-text bg-primary text-dark border-0 px-3"><i
                            class="fa fa-search"></i></button>
                </div>
            </div> --}}
           </div>
       </nav>
   </div>
   <!-- Navbar End -->
