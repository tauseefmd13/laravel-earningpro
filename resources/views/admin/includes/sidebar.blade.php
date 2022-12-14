<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
      <img src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    {{ __('Dashboard') }}
                  </p>
                </a>
            </li>

            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <i class="nav-icon far fa-user"></i>
                <p>
                  {{ __('User Management') }}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('admin.permissions.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ __('Permissions') }}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.roles.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ __('Roles') }}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.users.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ __('Users') }}</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <i class="nav-icon far fa-image"></i>
                <p>
                  {{ __('Sliders') }}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('admin.sliders.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ __('All Sliders') }}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.sliders.create') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ __('Add Slider') }}</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>
                    {{ __('Logout') }}
                    </p>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>