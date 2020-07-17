<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/home')}}" class="brand-link">
        <span class="brand-text font-weight-light">Report Management System</span>
        <hr style="border-top: 1px solid rgba(193, 196, 202, 0.54);">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="d-flex">
            <div class="info">

            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @role('admin')
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fa fa-users-cog"></i>
                        <p>
                            Users
                          
                        </p>
                         <i class="fa fa-caret-down" style="
"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('users')}}" class="nav-link ">
                                <i class="fa fa-user-friends nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('roles')}}" class="nav-link">
                                <i class="fa fa-user-check nav-icon"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('permissions')}}" class="nav-link">
                                <i class="fa fa-user-edit nav-icon"></i>
                                <p>Permissions</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{url('groups')}}" class="nav-link">
                        <i class="fa fa-users nav-icon"></i>
                        <p>Groups</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('tags')}}" class="nav-link">
                        <i class="fa fa-edit nav-icon"></i>
                        <p>Tags</p>
                    </a>
                </li>
                @endrole
                <li class="nav-item">
                    <a href="{{url('/reports')}}" class="nav-link">
                        <i class="fa fa-book nav-icon"></i>
                        <p>Reports</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
