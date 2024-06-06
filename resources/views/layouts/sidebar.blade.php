<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{ asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8" >
      <span class="brand-text font-weight-light" style="text-decoration: none;">Ilham Safety</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
        </div>
        <div class="info">
          <p class="text-white">Selamat Datang {{ auth()->user()->name }}</p>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @php
            $sensorActive = in_array($title, ['dht', 'flame', 'gas']);
          @endphp
          <li class="nav-item {{ $sensorActive ? 'menu-open' : 'menu-closed' }}">
            <a href="#" class="nav-link {{ $sensorActive ? 'active' : '' }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Sensor
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/dht22" class="nav-link {{ ($title === 'dht') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DHT22</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/flame" class="nav-link {{ ($title === 'flame') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Flame</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/gas" class="nav-link {{ ($title === 'gas') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>MQ 2</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="/decision-tree" class="nav-link {{ ($title === 'C4.5') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tree"></i>
              <p>C4.5</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  </aside>