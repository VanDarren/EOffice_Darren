
<body class="vertical  light  ">
    <div class="wrapper">
      <nav class="topnav navbar navbar-light">
        <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
          <i class="fe fe-menu navbar-toggler-icon"></i>
        </button>
        <form class="form-inline mr-auto searchform text-muted">
          <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search" placeholder="Type something..." aria-label="Search">
        </form>
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
              <i class="fe fe-sun fe-16"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-shortcut">
              <span class="fe fe-grid fe-16"></span>
            </a>
          </li>
          <li class="nav-item nav-notif">
            <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-notif">
              <span class="fe fe-bell fe-16"></span>
              <span class="dot dot-md bg-success"></span>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="avatar avatar-sm mt-2">
                <img src="assets/avatars/face-1.jpg" alt="..." class="avatar-img rounded-circle">
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="{{url('profile')}}">Profile</a>
              <a class="dropdown-item" href="{{url('setting')}}">Settings</a>
              <a class="dropdown-item" href="{{url('logout')}}">Logout</a>
            </div>
          </li>
        </ul>
      </nav>
      <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
        <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
          <i class="fe fe-x"><span class="sr-only"></span></i>
        </a>
        <nav class="vertnav navbar navbar-light">
          <!-- nav bar -->
          <div class="w-100 mb-4 d-flex">
    <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
        <img src="{{ asset('img/' . htmlspecialchars($darren2->iconmenu)) }}" alt="IconMenu" class="logo-dashboard img-fit-menu">
    </a>
</div>

          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item">
              <a href="{{url('dashboard')}}"  aria-expanded="false" class="nav-link">
                <i class="fe fe-home fe-16"></i>
                <span class="ml-3 item-text">Dashboard</span><span class="sr-only">(current)</span>
              </a>
             
            </li>
          </ul>
          <p class="text-muted nav-heading mt-4 mb-1">
    <span>Document</span>
</p>
<ul class="navbar-nav flex-fill w-100 mb-2">
<li class="nav-item">
        <a href="{{url('document')}}" aria-expanded="false" class="nav-link">
            <i class="fe fe-mail fe-16"></i>
            <span class="ml-3 item-text">E-Document</span>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a href="#surat-elements" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <i class="fe fe-folder fe-16"></i>
            <span class="ml-3 item-text">Surat</span>
        </a>
        <ul class="collapse list-unstyled pl-4 w-100" id="surat-elements">
            <li class="nav-item">
                <a class="nav-link pl-3" href="{{url('suratmasuk')}}">
                    <span class="ml-1 item-text">Surat Masuk</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link pl-3" href="{{url('suratkeluar')}}">
                    <span class="ml-1 item-text">Surat Keluar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link pl-3" href="{{url('pengajuancuti')}}">
                    <span class="ml-1 item-text">Surat Pengajuan Cuti</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link pl-3" href="{{url('telathadir')}}">
                    <span class="ml-1 item-text">Surat Keterlambatan</span>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a href="#data-surat-elements" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <i class="fe fe-file fe-16"></i>
            <span class="ml-3 item-text ">Data Surat</span>
        </a>
        <ul class="collapse list-unstyled pl-4 w-100" id="data-surat-elements">
            <li class="nav-item">
                <a class="nav-link pl-3" href="{{url('datasuratmasuk')}}">
                    <span class="ml-1 item-text">Surat Masuk</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link pl-3" href="{{url('datasuratkeluar')}}">
                    <span class="ml-1 item-text">Surat Keluar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link pl-3" href="{{url('datapengajuancuti')}}">
                    <span class="ml-1 item-text">Surat Pengajuan Cuti</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link pl-3" href="{{url('dataketerlambatan')}}">
                    <span class="ml-1 item-text">Surat Keterlambatan</span>
                </a>
            </li>
        </ul>
    </li>
</ul>



@if($id_level == 1)
        
           
          <p class="text-muted nav-heading mt-4 mb-1">
            <span>Components</span>
          </p>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item">
              <a href="setting" aria-expanded="false" class="nav-link">
                <i class="fe fe-file fe-16"></i>
                <span class="ml-3 item-text">Setting</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="logactivity" aria-expanded="false" class="nav-link">
                <i class="fe fe-shield fe-16"></i>
                <span class="ml-3 item-text">Log Activity</span>
              </a>
            </li>

          </ul>
          
          
          @endif
        
        </nav>
      </aside>
      
     <style>
      .logo-dashboard {
    max-width: 100%; /* Membuat gambar tidak lebih besar dari kontainer */
    height: auto; /* Mempertahankan rasio gambar */
    display: block;
}

.img-fit-menu {
    width: 200px; /* Sesuaikan ukuran yang diinginkan untuk menu */
    height: 100px; /* Sesuaikan tinggi yang diinginkan untuk menu */
    object-fit: contain; /* Memastikan gambar pas tanpa terpotong */
    margin: 0 auto; /* Center image jika diperlukan */
}

     </style>
     
   