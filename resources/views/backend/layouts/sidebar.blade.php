<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link text-center">
    <span class="brand-text font-weight-bold">iischool.com</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('backend') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @if(Auth::user()->role == 1)
        <li class="nav-item">
          <a href="{{ url('admin/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('admin/admin/list') }}" class="nav-link  @if(Request::segment(2) == 'admin') active @endif">
            <i class="nav-icon far fa-user"></i>
            <p>Admin</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('admin/lesson/list') }}" class="nav-link  @if(Request::segment(2) == 'lesson') active @endif">
            <i class="nav-icon far fa-user"></i>
            <p>Lessons</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('admin/subject/list') }}" class="nav-link  @if(Request::segment(2) == 'subject') active @endif">
            <i class="nav-icon far fa-user"></i>
            <p>Subjects</p>
          </a>
        </li>
        @elseif(Auth::user()->role == 2)
        <li class="nav-item">
          <a href="{{ url('teacher/dashboard') }}" class="nav-link  @if(Request::segment(2) == 'dashboard') active @endif">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        @elseif(Auth::user()->role == 3)
        <li class="nav-item">
          <a href="{{ url('student/dashboard') }}" class="nav-link  @if(Request::segment(2) == 'dashboard') active @endif">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        @elseif(Auth::user()->role == 4)
        <li class="nav-item">
          <a href="{{ url('parent/dashboard') }}" class="nav-link  @if(Request::segment(2) == 'dashboard') active @endif">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        @endif

        <li class="nav-item">
          <a href="{{ url('logout') }}" class="nav-link">
            <i class="nav-icon far fa-user"></i>
            <p>Logout</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>