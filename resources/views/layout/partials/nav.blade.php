<!--            -->
<!-- BEGIN NAV  -->
<!--            -->
<!-- Topbar Navbar -->
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <div class="mobile-nav d-flex d-md-none">
    <button type="button" id="sidebarCollapse" class="btn btn-info ml-3"><i class="fa fas fa-bars"></i></button>
    <a class="pl-3 navbar-brand" href="{{ route('dashboard') }}">D∑VHE∆LTH -BETA-</a>
  </div>
  <a class="navbar-brand d-none d-md-flex col-sm-3 col-md-3 col-lg-2 mr-0 order-1" href="{{ route('dashboard') }}">D∑VHE∆LTH -BETA-</a>
  <input class="form-control form-control-dark w-100 order-3 order-md-2" type="text" placeholder="Search" aria-label="Search">
  <div class="dropdown action-menu order-2 order-md-3">
    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->first_name.' '.Auth::user()->last_name}}</a>

    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
      <a class="dropdown-item" href="{{url('/viewprofile')}}">View Profile</a>
      {{-- <a class="dropdown-item" href="{{url('/changePassword')}}">Change Password</a> --}}
      <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>
    </div>
  </div>
</nav>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
  @csrf
</form>
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar Navbar -->
    <nav class="col-6 col-md-3 col-lg-2 d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{Request::is('dashboard')?"active":''}}" href="{{url('/dashboard')}}">
              <span data-feather="grid"></span>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{Request::is('leads') || Request::is('newLead') || Request::is('editLead/*')?"active":''}}" href="{{ route('leads.index') }}">
              <span data-feather="file"></span>
              Leads
            </a>
          </li>
          @if(Auth::user()->hasRole('Admin'))
          <li class="nav-item">
            <a class="nav-link {{Request::is('providers') || Request::is('newProvider')?"active":''}}" href="{{ route('providers') }}">
              <span data-feather="users"></span>
              Providers
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{Request::is('centers') || Request::is('newCenter')?"active":''}}" href="{{ route('center.index') }}">
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
        </ul>
        @endif
        @if(Auth::user()->hasRole('Admin'))
        <hr>

        <ul class="nav flex-column mb-2">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span data-feather="settings"></span>
                admin
                </a>
                <div class="dropdown-menu" aria-labelledby="adminDropdown">
                    <a class="dropdown-item {{Request::is('user/*') || Request::is('users') ?"active":''}}" href="{{url('/users')}}">
                    <span data-feather="file-text"></span>
                    Manage Users
                    </a>
                </div>
            </li>
        </ul>
        @endif
	@if(Auth::user()->hasRole('msmc-manager') || Auth::user()->hasRole('Admin'))
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="{{url('/viewAllLogs')}}" id="viewLog" >
                <span data-feather="eye"></span>
                View Logs
                </a>
            </li>
        </ul>
	@endif
      </div>
    </nav>
    <!--            -->
    <!-- END NAV    -->
    <!--            -->
