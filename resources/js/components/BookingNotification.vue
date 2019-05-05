<template>
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fa fa-bell-o"></i>
            <span class="badge badge-warning navbar-badge">{{order.length}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">{{booking.length}} Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="{{route('admin.orders.wait.edit', order.id)}}" class="dropdown-item">
                <i class="fa fa-star-o mr-2"></i> {{user.name}}
                <span class="float-right text-muted text-sm">{{order.created_at}}</span>
            </a>
            <a href="{{route('admin.orders.wait')}}" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
    </li>
</template>

<script>
    export default {
        props: [order, user],
    };
</script>
