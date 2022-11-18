<header class="header @if(!request()->is('/')) header-page @endif">
    <div class="header-fixed">
        <nav class="navbar navbar-expand-lg header-nav scroll-sticky">
            <div class="container @if(request()->is('courses')) header-border @endif">
                <div class="navbar-header">
                    <a id="mobile_btn" href="javascript:void(0);">
                        <span class="bar-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </a>
                    <a href="/" class="navbar-brand logo">
                        <img src="{{config('belajarin.logo')}}" class="img-fluid" alt="Logo">
                    </a>
                </div>
                <div class="main-menu-wrapper">
                    <div class="menu-header">
                        <a href="/" class="menu-logo">
                            <img src="{{config('belajarin.logo')}}" class="img-fluid" alt="Logo">
                        </a>
                        <a id="menu_close" class="menu-close" href="javascript:void(0);">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                    <ul class="main-nav">

                        @if (!auth()->user() or isRole('Student'))

                            <li>
                                <a href="/" @if(request()->is('/')) style='color: #392C7D; font-weight: bold;'@endif>Beranda</a>
                            </li>
                            <li>
                                <a href="/courses" @if(request()->is('courses')) style='color: #392C7D; font-weight: bold;'@endif>Courses</a>
                            </li>
                            
                        @endif

                        @if (isRole('Student'))

                            <li>
                                <a href="/dashboard" @if(request()->is('dashboard')) style='color: #392C7D; font-weight: bold;'@endif>Dashboard</a>
                            </li>
                            <li>
                                <a href="/transactions" @if(request()->is('transactions') or request()->is('transactions/*')) style='color: #392C7D; font-weight: bold;'@endif>Transactions</a>
                            </li>

                        @elseif(isRole('Tentor'))

                            <li>
                                <a href="/tentor" @if(request()->is('tentor')) style='color: #392C7D; font-weight: bold;'@endif>Dashboard</a>
                            </li>
                            <li>
                                <a href="/tentor/courses" @if(request()->is('tentor/courses') or request()->is('tentor/courses/*')) style='color: #392C7D; font-weight: bold;'@endif>Courses</a>
                            </li>
                            <li>
                                <a href="/tentor/transactions" @if(request()->is('tentor/transactions') or request()->is('tentor/transactions/*')) style='color: #392C7D; font-weight: bold;'@endif>Transactions</a>
                            </li>
                            <li>
                                <a href="/tentor/reviews" @if(request()->is('tentor/reviews')) style='color: #392C7D; font-weight: bold;'@endif>Reviews</a>
                            </li>
                            <li>
                                <a href="/tentor/earnings" @if(request()->is('tentor/earnings')) style='color: #392C7D; font-weight: bold;'@endif>Earnings</a>
                            </li>
                            <li>
                                <a href="/tentor/withdrawals" @if(request()->is('tentor/withdrawals')) style='color: #392C7D; font-weight: bold;'@endif>Withdrawals</a>
                            </li>

                        @else     

                            <li class="hide">
                                <a href="/admin">Dashboard</a>
                            </li>
                            <li class="hide">
                                <a href="/admin/lessons">Pelajaran</a>
                            </li>
                            <li class="hide">
                                <a href="/admin/levels">Kelas</a>
                            </li>
                            <li class="hide">
                                <a href="/admin/users">Users</a>
                            </li>
                            {{-- <li>
                                <a href="#!">Verifications</a>
                            </li> --}}
                            <li class="hide">
                                <a href="/admin/transactions">Transactions</a>
                            </li>
                            <li class="hide">
                                <a href="/admin/earnings">Earnings</a>
                            </li>
                            <li class="hide">
                                <a href="/admin/withdrawals">Withdrawals</a>
                            </li>
                            {{-- <li>
                                <a href="#!">Reviews</a>
                            </li>
                            <li>
                                <a href="#!">Notifications</a>
                            </li> --}}
                        @endif
                    </ul>
                </div>
                @if (auth()->user())
                    <ul class="nav header-navbar-rht">
                        {{-- <li class="nav-item">
                            <a href="instructor-chat.html"><img src="{{asset('assets/img/icon/messages.svg')}}" alt="img"></a>
                        </li>
                        <li class="nav-item cart-nav">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                <img src="{{asset('assets/img/icon/cart.svg')}}" alt="img">
                            </a>
                            <div class="wishes-list dropdown-menu dropdown-menu-right">
                                <div class="wish-header">
                                    <a href="#">View Cart</a>
                                    <a href="javascript:void(0)" class="float-end">Checkout</a>
                                </div>
                                <div class="wish-content">
                                    <ul>
                                        <li>
                                            <div class="media">
                                                <div class="d-flex media-wide">
                                                    <div class="avatar">
                                                        <a href="course-details.html">
                                                            <img alt="" src="{{asset('assets/img/course/course-04.jpg')}}">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6><a href="course-details.html">Learn Angular...</a></h6>
                                                        <p>By Dave Franco</p>
                                                        <h5>$200 <span>$99.00</span></h5>
                                                    </div>
                                                </div>
                                                <div class="remove-btn">
                                                    <a href="#" class="btn">Remove</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <div class="d-flex media-wide">
                                                    <div class="avatar">
                                                        <a href="course-details.html">
                                                            <img alt="" src="{{asset('assets/img/course/course-14.jpg')}}">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6><a href="course-details.html">Build Responsive Real...</a></h6>
                                                        <p>Jenis R.</p>
                                                        <h5>$200 <span>$99.00</span></h5>
                                                    </div>
                                                </div>
                                                <div class="remove-btn">
                                                    <a href="#" class="btn">Remove</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <div class="d-flex media-wide">
                                                    <div class="avatar">
                                                        <a href="course-details.html">
                                                            <img alt="" src="{{asset('assets/img/course/course-15.jpg')}}">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6><a href="course-details.html">C# Developers Double ...</a></h6>
                                                        <p>Jesse Stevens</p>
                                                        <h5>$200 <span>$99.00</span></h5>
                                                    </div>
                                                </div>
                                                <div class="remove-btn">
                                                    <a href="#" class="btn">Remove</a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="total-item">
                                        <h6>Subtotal : $ 600</h6>
                                        <h5>Total : $ 600</h5>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item wish-nav">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                <img src="{{asset('assets/img/icon/wish.svg')}}" alt="img">
                            </a>
                            <div class="wishes-list dropdown-menu dropdown-menu-right">
                                <div class="wish-content">
                                    <ul>
                                        <li>
                                            <div class="media">
                                                <div class="d-flex media-wide">
                                                    <div class="avatar">
                                                        <a href="course-details.html">
                                                            <img alt="" src="{{asset('assets/img/course/course-04.jpg')}}">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6><a href="course-details.html">Learn Angular...</a></h6>
                                                        <p>By Dave Franco</p>
                                                        <h5>$200 <span>$99.00</span></h5>
                                                        <div class="remove-btn">
                                                            <a href="#" class="btn">Add to cart</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <div class="d-flex media-wide">
                                                    <div class="avatar">
                                                        <a href="course-details.html">
                                                            <img alt="" src="{{asset('assets/img/course/course-14.jpg')}}">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6><a href="course-details.html">Build Responsive Real...</a></h6>
                                                        <p>Jenis R.</p>
                                                        <h5>$200 <span>$99.00</span></h5>
                                                        <div class="remove-btn">
                                                            <a href="#" class="btn">Add to cart</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <div class="d-flex media-wide">
                                                    <div class="avatar">
                                                        <a href="course-details.html">
                                                            <img alt="" src="{{asset('assets/img/course/course-15.jpg')}}">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6><a href="course-details.html">C# Developers Double ...</a></h6>
                                                        <p>Jesse Stevens</p>
                                                        <h5>$200 <span>$99.00</span></h5>
                                                        <div class="remove-btn">
                                                            <a href="#" class="btn">Remove</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item noti-nav">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                <img src="{{asset('assets/img/icon/notification.svg')}}" alt="img">
                            </a>
                            <div class="notifications dropdown-menu dropdown-menu-right">
                                <div class="topnav-dropdown-header">
                                    <span class="notification-title">Notifications
                                        <select>
                                            <option>All</option>
                                            <option>Unread</option>
                                        </select>
                                    </span>
                                    <a href="javascript:void(0)" class="clear-noti">Mark all as read <i
                                            class="fa-solid fa-circle-check"></i></a>
                                </div>
                                <div class="noti-content">
                                    <ul class="notification-list">
                                        <li class="notification-message">
                                            <div class="media d-flex">
                                                <div>
                                                    <a href="notifications.html" class="avatar">
                                                        <img class="avatar-img" alt="" src="{{asset('assets/img/user/user1.jpg')}}">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h6><a href="notifications.html">Lex Murphy requested <span>access
                                                                to</span> UNIX directory tree hierarchy </a></h6>
                                                    <button class="btn btn-accept">Accept</button>
                                                    <button class="btn btn-reject">Reject</button>
                                                    <p>Today at 9:42 AM</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="notification-message">
                                            <div class="media d-flex">
                                                <div>
                                                    <a href="notifications.html" class="avatar">
                                                        <img class="avatar-img" alt="" src="{{asset('assets/img/user/user2.jpg')}}">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h6><a href="notifications.html">Ray Arnold left 6 <span>comments
                                                                on</span> Isla Nublar SOC2 compliance report</a></h6>
                                                    <p>Yesterday at 11:42 PM</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="notification-message">
                                            <div class="media d-flex">
                                                <div>
                                                    <a href="notifications.html" class="avatar">
                                                        <img class="avatar-img" alt="" src="{{asset('assets/img/user/user3.jpg')}}">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h6><a href="notifications.html">Dennis Nedry <span>commented on</span>
                                                            Isla Nublar SOC2 compliance report</a></h6>
                                                    <p class="noti-details">“Oh, I finished de-bugging the phones, but the
                                                        system's compiling for eighteen minutes, or twenty. So, some minor
                                                        systems may go on and off for a while.”</p>
                                                    <p>Yesterday at 5:42 PM</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="notification-message">
                                            <div class="media d-flex">
                                                <div>
                                                    <a href="notifications.html" class="avatar">
                                                        <img class="avatar-img" alt="" src="{{asset('assets/img/user/user1.jpg')}}">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h6><a href="notifications.html">John Hammond <span>created</span> Isla
                                                            Nublar SOC2 compliance report </a></h6>
                                                    <p>Last Wednesday at 11:15 AM</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li> --}}
                        <li class="nav-item user-nav">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                <span class="user-img">
                                    <img src="{{asset('assets/img/instructor/profile-avatar.jpg')}}" alt="">
                                    <span class="status online"></span>
                                </span>
                            </a>
                            <div class="users dropdown-menu dropdown-menu-right" data-popper-placement="bottom-end">
                                <div class="user-header">
                                    <div class="avatar avatar-sm">
                                        <img src="{{asset('assets/img/instructor/profile-avatar.jpg')}}" alt="User Image"
                                            class="avatar-img rounded-circle">
                                    </div>
                                    <div class="user-text">
                                        <h6>{{auth()->user()->name ?? null}}</h6>
                                        <p class="text-muted mb-0">{{auth()->user()->role ?? null}}</p>
                                    </div>
                                </div>
                                <a class="dropdown-item" href="{{(isRole('Student') ? '/dashboard' : (isRole('Tentor') ? '/tentor' : '/admin'))}}"><i class="feather-home me-1"></i>
                                    Dashboard</a>
                                <a class="dropdown-item" href="/profile"><i
                                        class="feather-user me-1"></i> Edit Profile</a>
                                <a class="dropdown-item" href="/setting"><i
                                        class="feather-settings me-1"></i> Settings</a>
                                
                                <a class="dropdown-item" href="/logout"><i class="feather-log-out me-1"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                @else
                    <ul class="nav header-navbar-rht">
                        <li class="nav-item">
                            <a class="nav-link header-sign" href="/login">Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link header-login" href="/register">Daftar</a>
                        </li>
                    </ul>            
                @endif
            </div>
        </nav>
    </div>
</header>
