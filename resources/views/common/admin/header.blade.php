<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        @if(Auth::user()->roles->first()->name == 'admin')
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('admin.index')}}" class="nav-link">Dashboard</a>
        </li>
            @endif
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-bell-o"></i>
                <span class="badge badge-warning navbar-badge orderWait">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header orderWaitMessage">0 Notifications</span>
                <div class="dropdown-divider"></div>
                <div id="showOrderWait"></div>
                <a href="{{route('admin.orders.wait')}}" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                    class="fa fa-th-large"></i></a>
        </li>
    </ul>
</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{route('admin.index')}}" class="brand-link">
        <img src="{{asset('images/star.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">MayStar</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('images/admin/van.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{route('admin.info')}}" class="d-block">{{Auth::user()->name}}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('admin.orders.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-money"></i>
                        <p>
                            Orders <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.orders.index')}}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>List Order</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.orders.wait')}}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>List Order Waiting</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.orders.handled')}}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>List Order Handled</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @if(Auth::user()->roles->first()->name === 'admin')
                <li class="nav-item">
                    <a href="{{route('admin.type-rooms.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-building-o"></i>
                        <p>
                            Type Rooms
                        </p>
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a href="{{route('admin.rooms.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-home"></i>
                        <p>
                            Rooms
                        </p>
                    </a>
                </li>
                @if(Auth::user()->roles->first()->name === 'admin')
                <li class="nav-item has-treeview">
                    <a href="{{route('admin.devices.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-cogs"></i>
                        <p>
                            Devices
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{route('admin.services.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-hand-scissors-o "></i>
                        <p>
                           Services
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.promotions.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-arrow-circle-o-down"></i>
                        <p>
                            Promotions
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{route('admin.users.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-user-circle"></i>
                        <p>
                            Customers
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{route('admin.contacts.index')}}" class="nav-link">
                        <i class="fa fa-envelope"></i>
                        <p>
                            Contacts
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="{{route('admin.revenues.index')}}" class="nav-link">
                        <i class="fa fa-line-chart"></i>
                        <p>
                            Charts
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.revenues.index')}}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Report</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.revenues.type-rooms')}}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Report TypeRoom</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.calendars.rooms')}}" class="nav-link">
                        <i class="nav-icon fa fa-calendar-check-o"></i>
                        <p>
                            Calendar Room
                        </p>
                    </a>
                </li>
                <li class="nav-header">Menu</li>
                <li class="nav-item">
                    <a href="{{route('admin.library-images.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-image"></i>
                        <p>
                            Library Images
                        </p>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="{{route('client.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-undo"></i>
                        <p>
                            Back Client
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
