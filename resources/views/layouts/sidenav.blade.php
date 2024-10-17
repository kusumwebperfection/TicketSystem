<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="{{ url('/') }}">
    <img src="{{ asset('public/img/headerlogo.png') }}" class="navbar-brand-img h-100 rounded-circle" alt="main_logo">
    <span class="ms-1 font-weight-bold">
        @if (\App\Helpers\RoleHelper::hasRole('admin'))
            Admin
            @elseif(\App\Helpers\RoleHelper::hasRole('sub_admin'))
            Sub Admin
        @endif
        Dashboard
    </span>
</a>

  </div>
  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">

  <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#manage-roles-perm" aria-expanded="false" aria-controls="manage-roles-perm">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-badge text-warning text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Users</span>
        </a>
        <ul class="navbar-nav flex-column collapse" id="manage-roles-perm">
          <li class="nav-item">
            <a class="nav-link" href="{{url('/admin/dashboard')}}">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-collection text-info text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">All Users</span>
            </a>
          </li>
     
        </ul>
      </li>

    <a class="nav-link"  href="{{route("ticket.index")}}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Tickets</span>
        </a>

        <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#manage-payments" aria-expanded="false" aria-controls="manage-payments">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Payments</span>
        </a>
        <ul class="navbar-nav flex-column collapse" id="manage-payments">
          <li class="nav-item">
            <a class="nav-link" href="{{url('/admin/dashboard')}}">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">All Transaction</span>
            </a>
          </li>
     
        </ul>
      </li>
    </ul>

  </div>
  <script>
    $(document).ready(function() {
      $('.collapse').on('show.bs.collapse', function() {
        // Close other collapsible menus
        $('.collapse.show').not($(this)).collapse('hide');

        // Toggle icon direction
        $(this).next().find('i').removeClass('fa-angle-right').addClass('fa-angle-down');
      });

      $('.collapse').on('hide.bs.collapse', function() {
        // Toggle icon direction
        $(this).next().find('i').removeClass('fa-angle-down').addClass('fa-angle-right');
      });
    });
  </script>

</aside>