<aside class="col-md-4 col-lg-3">
    <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
        <li class="nav-item">
            <a href="{{ url('user/dashboard') }}" class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">Dashboard</a>
        </li>
        <li class="nav-item">
            <a href="{{ url('user/orders') }}" class="nav-link @if (Request::segment(2) == 'orders') active @endif">Orders</a>
        </li>
        <li class="nav-item">
            <a href="{{ url('user/edit_profile') }}" class="nav-link @if (Request::segment(2) == 'edit_profile') active @endif">Edit Prodife</a>
        </li>
        <li class="nav-item">
            <a href="{{ url('user/change_password') }}" class="nav-link @if (Request::segment(2) == 'change_password') active @endif">Change Password</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/logout') }}">logout</a>
        </li>
    </ul>
</aside><!-- End .col-lg-3 -->
