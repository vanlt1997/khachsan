<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('admin.index')}}" class="nav-link">Admin</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-comments-o"></i>
                <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <div class="media">
                        <img src="{{asset('dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Brad Diesel
                                <span class="float-right text-sm text-danger"><i class="fa fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Call me whenever you can...</p>
                            <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <div class="media">
                        <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                John Pierce
                                <span class="float-right text-sm text-muted"><i class="fa fa-star"></i></span>
                            </h3>
                            <p class="text-sm">I got your message bro</p>
                            <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <div class="media">
                        <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Nora Silvester
                                <span class="float-right text-sm text-warning"><i class="fa fa-star"></i></span>
                            </h3>
                            <p class="text-sm">The subject goes here</p>
                            <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-bell-o"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fa fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fa fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fa fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                    class="fa fa-th-large"></i></a>
        </li>
    </ul>
</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">MayStar</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Admin</a>
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
                <li class="nav-item">
                    <a href="{{route('admin.type-rooms.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-building-o"></i>
                        <p>
                            Type Rooms
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.rooms.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-hotel"></i>
                        <p>
                            Rooms
                        </p>
                    </a>
                </li>
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
                        <i class="nav-icon fa fa-hotel"></i>
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
                            Revenue
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
                            <a href="pages/forms/editors.html" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Report TypeRoom</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-pie-chart"></i>
                        <p>
                            Statistical
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/tables/simple.html" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>List Bill</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/tables/data.html" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Test $ Account</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/tables/data.html" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Business Results</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/tables/data.html" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Report</p>
                            </a>
                        </li>
                    </ul>
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
                <li class="nav-item">
                    <a href="pages/calendar.html" class="nav-link">
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
