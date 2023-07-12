 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">
  @php
    $dashboard = Request::segment(1)
  @endphp

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item"  >
        <a class="nav-link collapsed" href="{{ route('admin.home') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      

      <li class="nav-item" >
        <a class="nav-link collapsed" href="{{ route('admin.category') }}">
          <i class="bi bi-bar-chart"></i>
          <span>Categories</span>
        </a>
      </li><!-- End Categorie Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#">
          <i class="bi bi-bar-chart"></i>
          <span>Products</span>
        </a>
      </li><!-- End Products Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="#">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>User Details</span>
        </a>
      </li><!-- End Login Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.logout') }}">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Logout</span>
        </a>
      </li><!-- End Loggout Nav -->


    </ul>

  </aside><!-- End Sidebar-->