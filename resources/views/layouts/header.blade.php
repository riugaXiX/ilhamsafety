<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <!-- <a href="index3.html" class="nav-link">Home</a> -->
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <!-- <a href="#" class="nav-link">Contact</a> -->
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      @auth
      <form action="/logout" method="post">
        @csrf
        <button type="submit" class="dropdown-item p-2"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
      </form>
        @else
        <h1>Belum login kok bisa masuk</h1>
      @endauth
      

     
    </ul>
  </nav>
  <!-- /.navbar -->