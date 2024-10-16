<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html" target="_blank">
      <img src="{{ asset('public/img/headerlogo.png')}}" class="navbar-brand-img h-100 rounded-circle" alt="main_logo">
      <span class="ms-1 font-weight-bold">Admin Dashboard </span>
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">

    <ul class="navbar-nav">
      <li>
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