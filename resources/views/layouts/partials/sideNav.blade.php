<style>
    /* Default link styles */
    .nav-link {
        color: #ddd;
        transition: background-color 0.3s, color 0.3s;
    }

    /* Hover effect */
    .nav-link:hover {
        background-color: #007bff;
        /* Hover background color */
        color: #fff;
        /* Text color on hover */
        text-decoration: none;
    }

    /* Active state for selected menu items */
    .nav-item.active>.nav-link,
    .nav-item.management-active>.nav-link {
        background-color: #007bff;
        /* Active background for selected routes */
        color: #fff;
        /* Text color for active item */
    }

    /* Active state for Management section */
    .nav-item.management-active>.nav-link {
        background-color: red;
        /* Special red background for expanded Management */
    }

    /* Prevent hover from overriding active styles */
    .nav-item.active>.nav-link:hover,
    .nav-item.management-active>.nav-link:hover {
        background-color: #007bff;
        /* Keep the active blue or red background */
        color: #fff;
    }

    /* Submenu active styles */
    #managementSubmenu.show {
        background-color: red;
        /* Same red background when submenu is expanded */
        color: #fff;
    }

    /* Submenu items hover effect */
    #managementSubmenu .nav-link:hover {
        background-color: #007bff;
        /* Hover background for submenu items */
        color: #fff;
    }
</style>
<div class="overlay"></div>
<nav class="navbar navbar-inverse fixed-top" id="sidebar-wrapper" role="navigation">
    <ul class="nav flex-column sidebar-nav">
        <div class="sidebar-header">
            <div class="sidebar-brand">
                <a href="#">Our Services</a>
            </div>
        </div>

        <!-- Regular Items -->
        <li class="nav-item">
            <a href="logo-design.php" class="nav-link {{ request()->routeIs('logo-design') ? 'active' : '' }}">
                <i class="fa fa-paint-brush mr-2"></i>Logo Design
            </a>
        </li>
        <li class="nav-item">
            <a href="graphic-design.php" class="nav-link {{ request()->routeIs('graphic-design') ? 'active' : '' }}">
                <i class="fa fa-picture-o mr-2"></i>Graphic Design
            </a>
        </li>
        <li class="nav-item">
            <a href="website-design.php" class="nav-link {{ request()->routeIs('website-design') ? 'active' : '' }}">
                <i class="fa fa-desktop mr-2"></i>Website Design
            </a>
        </li>
        <li class="nav-item">
            <a href="brochure-design.php" class="nav-link {{ request()->routeIs('brochure-design') ? 'active' : '' }}">
                <i class="fa fa-book mr-2"></i>Brochure Design
            </a>
        </li>
        <li class="nav-item">
            <a href="mobile-application.php"
                class="nav-link {{ request()->routeIs('mobile-application') ? 'active' : '' }}">
                <i class="fa fa-android mr-2"></i>Mobile App Development
            </a>
        </li>
        <li class="nav-item">
            <a href="crm-software-development.php"
                class="nav-link {{ request()->routeIs('crm-software-development') ? 'active' : '' }}">
                <i class="fa fa-code mr-2"></i>CRM Software Development
            </a>
        </li>
        <li class="nav-item">
            <a href="digital-marketing.php"
                class="nav-link {{ request()->routeIs('digital-marketing') ? 'active' : '' }}">
                <i class="fa fa-bullhorn mr-2"></i>Digital Marketing Service
            </a>
        </li>

        <!-- Management Section -->
        <li
            class="nav-item {{ request()->routeIs(['roles.*', 'permissions.*', 'admin.templates.*', 'blogs.*']) ? 'management-active' : '' }}">
            <a class="nav-link {{ request()->routeIs(['roles.*', 'permissions.*', 'admin.templates.*', 'blogs.*']) ? '' : 'collapsed' }}"
                data-bs-toggle="collapse" href="#managementSubmenu" role="button"
                aria-expanded="{{ request()->routeIs(['roles.*', 'permissions.*', 'admin.templates.*', 'blogs.*']) ? 'true' : 'false' }}"
                aria-controls="managementSubmenu">
                <i class="fa fa-cogs mr-2"></i>Management
            </a>
            <div class="collapse {{ request()->routeIs(['roles.*', 'permissions.*', 'admin.templates.*', 'blogs.*']) ? 'show' : '' }}"
                id="managementSubmenu">
                <ul class="list-unstyled ps-3">
                    <!-- Role Management -->
                    @can('view-roles')
                    <li>
                        <a href="{{ route('roles.index') }}"
                            class="nav-link {{ request()->routeIs('roles.*') ? 'active bg-primary text-white' : '' }}">
                            <i class="fa fa-user-circle mr-2"></i>Role Management
                        </a>
                    </li>
                    @endcan

                    <!-- User Management -->
                    <li>
                        <a href="user-management.php" class="nav-link">
                            <i class="fa fa-users mr-2"></i>User Management
                        </a>
                    </li>
                    <!-- Permission Management -->
                    <li>
                        <a href="{{ route('permissions.index') }}"
                            class="nav-link {{ request()->routeIs('permissions.*') ? 'active bg-primary text-white' : '' }}">
                            <i class="fa fa-lock mr-2"></i>Permission Management
                        </a>
                    </li>
                    <!-- Template Management -->
                    <li>
                        <a href="{{ route('admin.templates.index') }}"
                            class="nav-link {{ request()->routeIs('admin.templates.*') ? 'active bg-primary text-white' : '' }}">
                            <i class="fa fa-wrench mr-2"></i>Template Management
                        </a>
                    </li>
                    <!-- Blog Management -->
                    <li>
                        <a href="{{ route('blogs.index') }}"
                            class="nav-link {{ request()->routeIs('blogs.*') ? 'active bg-primary text-white' : '' }}">
                            <i class="fa fa-book mr-2"></i>Blog Management
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        @can('contact')
        <li class="nav-item">
            <a href="{{ route('contacts.index') }}" class="nav-link {{ request()->routeIs('contacts.index') ? 'active' : '' }}">
                <i class="fa fa-envelope mr-2"></i>Messages
            </a>
        </li>
        @endcan





    </ul>
</nav>
