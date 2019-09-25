<!--            -->
<!-- BEGIN NAV  -->
<!--            -->
<!-- Topbar Navbar -->
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ route('dashboard') }}">D∑VHE∆LTH</a>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">Sign out</a>

    </li>
  </ul>
</nav>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
  @csrf
</form>
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar Navbar -->
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="{{url('/dashboard')}}">
              <span data-feather="{{ route('dashboard') }}"></span>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('leads.index') }}">
              <span data-feather="file"></span>
              Leads
            </a>
          </li>
          @if(Auth::user()->hasRole('Admin'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('providers') }}">
              <span data-feather="users"></span>
              Providers
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('centers') }}">
              <span data-feather="home"></span>
              Centers
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="clipboard"></span>
              Health Plans
            </a>
          </li>
          @endif
        </ul>
        @if(Auth::user()->hasRole('msmc-manager') || Auth::user()->hasRole('agent-user'))
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Activity</span>
          <a class="d-flex align-items-center text-muted" href="#">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>

        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              New Leads
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Closed Leads
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Unassigned Leads
            </a>
          </li>
          @endif
          @if(Auth::user()->hasRole('Admin'))
          <li class="nav-item">
            <a class="nav-link" href="{{url('/users')}}">
              <span data-feather="file-text"></span>
              Manage Users
            </a>
          </li>

        </ul>
        @endif
        @if(Auth::user()->hasRole('Admin'))
        <hr>
        <a class="nav-link" href="#">
          <span data-feather="settings"></span>
          admin
        </a>
        @endif

      </div>
    </nav>
    <!--            -->
    <!-- END NAV    -->
    <!--            -->