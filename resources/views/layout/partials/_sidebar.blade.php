<div class="col-xl-3 col-lg-4 col-md-12 theiaStickySidebar">
    <div class="settings-widget account-settings">
        <div class="settings-menu">
            <h3>DASHBOARD</h3>
            <ul>
                <li class="nav-item @if(request()->is('admin')) {{'active'}} @endif">
                    <a href="/admin" class="nav-link">
                        <i class="feather-home"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item @if(request()->is('admin/courses')) {{'active'}} @endif">
                    <a href="/admin/courses" class="nav-link">
                        <i class="feather-book"></i> Courses
                    </a>
                </li>
                <li class="nav-item @if(request()->is('admin/levels')) {{'active'}} @endif">
                    <a href="/admin/levels" class="nav-link">
                        <i class="feather-server"></i> Classes
                    </a>
                </li>
                <li class="nav-item @if(request()->is('admin/users')) {{'active'}} @endif">
                    <a href="/admin/users" class="nav-link">
                        <i class="feather-users"></i> Users
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="#!" class="nav-link">
                        <i class="feather-lock"></i> Verifications
                    </a> --}}
                </li>
                <li class="nav-item @if(request()->is('admin/transactions')) {{'active'}} @endif">
                    <a href="/admin/transactions" class="nav-link">
                        <i class="feather-shopping-bag"></i> Transactions
                    </a>
                </li>
                <li class="nav-item @if(request()->is('admin/earnings')) {{'active'}} @endif">
                    <a href="/admin/earnings" class="nav-link">
                        <i class="feather-pie-chart"></i> Earnings
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#!" class="nav-link">
                        <i class="feather-dollar-sign"></i> Withdrawals
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#!" class="nav-link">
                        <i class="feather-star"></i> Reviews
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#!" class="nav-link">
                        <i class="feather-bell"></i> Notifications
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

@push('js')
<!-- Sticky Sidebar JS -->
<script src="{{asset('assets/plugins/theia-sticky-sidebar/ResizeSensor.js')}}"></script>
<script src="{{asset('assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js')}}"></script>    
@endpush