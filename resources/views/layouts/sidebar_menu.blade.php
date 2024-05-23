<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
      <a class="nav-link" href="{{ route('home') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <!-- End Dashboard Nav -->

    <li class="nav-heading">Setup Options</li>
    <!-- medical insurers -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('medical_insurers.create') }}">
        <i class="bi bi-clipboard2-pulse"></i><span>Medical Insurers</span>
      </a>
    </li>
    
    <!-- user management -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('user_profiles.index') }}">
        <i class="bi bi-people"></i><span>Users</span>
      </a>
    </li>
  </ul>
</aside>
