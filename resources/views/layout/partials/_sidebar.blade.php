<div class="col-xl-3 col-lg-4 col-md-12 theiaStickySidebar">
    <div class="settings-widget dash-profile">
        <div class="settings-menu p-0">
            <div class="profile-bg">
                {{-- <h5>Beginner</h5> --}}
                <img src="{{asset('assets/img/instructor-profile-bg.jpg')}}" alt="">
                <div class="profile-img">
                    <a href="instructor-profile.html"><img src="{{asset('assets/img/user/user15.jpg')}}" alt=""></a>
                </div>
            </div>
            <div class="profile-group">
                <div class="profile-name text-center">
                    <h4><a href="instructor-profile.html">{{auth()->user()->name}}</a></h4>
                    <p>
                        {{(auth()->user()->role == 'Customer') ? 'Customer' : ( auth()->user()->role == 'Tentor' ? 'Tentor' : 'Admin' )}}
                    </p>
                </div>
                <div class="go-dashboard text-center">
                    <a href="add-course.html" class="btn btn-primary">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
    <div class="settings-widget account-settings">
        <div class="settings-menu">
            <h3>DASHBOARD</h3>
            <ul>
                <li class="nav-item active">
                    <a href="{{(auth()->user()->role == 'Customer') ? '/dashboard' : ( auth()->user()->role == 'Tentor' ? '/tentor' : '/admin' )}}" class="nav-link">
                        <i class="feather-home"></i> {{(auth()->user()->role == 'Customer' or auth()->user()->role == 'Tentor') ? 'My Dashboard' : 'Dashboard'}}
                    </a>
                </li>

                @if (auth()->user()->role == 'Super' or auth()->user()->role == 'Admin')
                <li class="nav-item">
                    <a href="/admin/courses" class="nav-link">
                        <i class="feather-book"></i> Courses
                    </a>
                </li>                    
                @endif

                <li class="nav-item">
                    <a href="instructor-reviews.html" class="nav-link">
                        <i class="feather-star"></i> Reviews
                    </a>
                </li>
                <li class="nav-item">
                    <a href="instructor-earnings.html" class="nav-link">
                        <i class="feather-pie-chart"></i> Earnings
                    </a>
                </li>
                <li class="nav-item">
                    <a href="instructor-orders.html" class="nav-link">
                        <i class="feather-shopping-bag"></i> Orders
                    </a>
                </li>
                <li class="nav-item">
                    <a href="instructor-student-grid.html" class="nav-link">
                        <i class="feather-users"></i> Students
                    </a>
                </li>
                <li class="nav-item">
                    <a href="instructor-payouts.html" class="nav-link">
                        <i class="feather-dollar-sign"></i> Payouts
                    </a>
                </li>
                <li class="nav-item">
                    <a href="instructor-tickets.html" class="nav-link">
                        <i class="feather-server"></i> Support Tickets
                    </a>
                </li>
            </ul>
            <div class="instructor-title">
                <h3>ACCOUNT SETTINGS</h3>
            </div>
            <ul>
                <li class="nav-item">
                    <a href="instructor-edit-profile.html" class="nav-link ">
                        <i class="feather-settings"></i> Edit Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a href="instructor-security.html" class="nav-link">
                        <i class="feather-user"></i> Security
                    </a>
                </li>
                <li class="nav-item">
                    <a href="instructor-social-profiles.html" class="nav-link">
                        <i class="feather-refresh-cw"></i> Social Profiles
                    </a>
                </li>
                <li class="nav-item">
                    <a href="instructor-notification.html" class="nav-link">
                        <i class="feather-bell"></i> Notifications
                    </a>
                </li>
                <li class="nav-item">
                    <a href="instructor-profile-privacy.html" class="nav-link">
                        <i class="feather-lock"></i> Profile Privacy
                    </a>
                </li>
                <li class="nav-item">
                    <a href="instructor-delete-profile.html" class="nav-link">
                        <i class="feather-trash-2"></i> Delete Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a href="instructor-linked-account.html" class="nav-link">
                        <i class="feather-user"></i> Linked Accounts
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.html" class="nav-link">
                        <i class="feather-power"></i> Sign Out
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