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
            <a href="<?php echo e(route('logo.design')); ?>" class="nav-link <?php echo e(request()->routeIs('logo.design') ? 'active' : ''); ?>">
                <i class="fa fa-paint-brush mr-2"></i>Logo Design
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo e(route('graphic.design')); ?>" class="nav-link <?php echo e(request()->routeIs('graphic.design') ? 'active' : ''); ?>">
                <i class="fa fa-picture-o mr-2"></i>Graphic Design
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo e(route('website.design')); ?>" class="nav-link <?php echo e(request()->routeIs('website.design') ? 'active' : ''); ?>">
                <i class="fa fa-desktop mr-2"></i>Website Design
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo e(route('brochure.design')); ?>" class="nav-link <?php echo e(request()->routeIs('brochure.design') ? 'active' : ''); ?>">
                <i class="fa fa-book mr-2"></i>Brochure Design
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo e(route('mobile.application')); ?>"
                class="nav-link <?php echo e(request()->routeIs('mobile.application') ? 'active' : ''); ?>">
                <i class="fa fa-android mr-2"></i>Mobile App Development
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo e(route('crm')); ?>"
                class="nav-link <?php echo e(request()->routeIs('crm') ? 'active' : ''); ?>">
                <i class="fa fa-code mr-2"></i>CRM Software Development
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo e(route('digital.marketing')); ?>"
                class="nav-link <?php echo e(request()->routeIs('digital.marketing') ? 'active' : ''); ?>">
                <i class="fa fa-bullhorn mr-2"></i>Digital Marketing Service
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo e(route('hosting.service')); ?>" class="nav-link <?php echo e(request()->routeIs('hosting.service') ? 'active' : ''); ?>">
                <i class="fa fa-server mr-2"></i> Hosting Service
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo e(route('domain.purchase')); ?>" class="nav-link <?php echo e(request()->routeIs('domain.purchase') ? 'active' : ''); ?>">
                <i class="fa fa-globe mr-2"></i> Domain Purchase
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo e(route('fbads')); ?>" class="nav-link <?php echo e(request()->routeIs('fbads') ? 'active' : ''); ?>">
                <i class="fa fa-facebook mr-2"></i> Facebook Ads
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo e(route('googleads')); ?>" class="nav-link <?php echo e(request()->routeIs('googleads') ? 'active' : ''); ?>">
                <i class="fa fa-google mr-2"></i> Google Ads
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo e(route('twitterads')); ?>" class="nav-link <?php echo e(request()->routeIs('twitterads') ? 'active' : ''); ?>">
                <i class="fa fa-twitter mr-2"></i> Twitter Ads
            </a>
        </li>


        <!-- Management Section -->
        <li
            class="nav-item <?php echo e(request()->routeIs(['roles.*', 'permissions.*', 'admin.templates.*', 'blogs.*', 'users.*']) ? 'management-active' : ''); ?>">
            <a class="nav-link <?php echo e(request()->routeIs(['roles.*', 'permissions.*', 'admin.templates.*', 'blogs.*', 'users.*']) ? '' : 'collapsed'); ?>"
            data-bs-toggle="collapse" href="#managementSubmenu" role="button"
            aria-expanded="<?php echo e(request()->routeIs(['roles.*', 'permissions.*', 'admin.templates.*', 'blogs.*', 'users.*']) ? 'true' : 'false'); ?>"
            aria-controls="managementSubmenu">
            <i class="fa fa-cogs mr-2"></i>Management
            </a>
            <div class="collapse <?php echo e(request()->routeIs(['roles.*', 'permissions.*', 'admin.templates.*', 'blogs.*', 'users.*']) ? 'show' : ''); ?>"
            id="managementSubmenu">
            <ul class="list-unstyled ps-3">
                <!-- Role Management -->
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-roles')): ?>
                <li>
                <a href="<?php echo e(route('roles.index')); ?>"
                    class="nav-link <?php echo e(request()->routeIs('roles.*') ? 'active bg-primary text-white' : ''); ?>">
                    <i class="fa fa-user-circle mr-2"></i>Role Management
                </a>
                </li>
                <?php endif; ?>

                <!-- User Management -->
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-users')): ?>
                <li>
                    <a href="<?php echo e(route('users.index')); ?>"
                        class="nav-link <?php echo e(request()->routeIs('users.*') ? 'active bg-primary text-white' : ''); ?>">
                        <i class="fa fa-users mr-2"></i>User Management
                    </a>
                    </li>
                <?php endif; ?>

                <!-- Permission Management -->
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-permissions')): ?>
                <li>
                    <a href="<?php echo e(route('permissions.index')); ?>"
                        class="nav-link <?php echo e(request()->routeIs('permissions.*') ? 'active bg-primary text-white' : ''); ?>">
                        <i class="fa fa-lock mr-2"></i>Permission Management
                    </a>
                    </li>
                <?php endif; ?>

                <!-- Template Management -->
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-tamplates')): ?>
                <li>
                    <a href="<?php echo e(route('admin.templates.index')); ?>"
                        class="nav-link <?php echo e(request()->routeIs('admin.templates.*') ? 'active bg-primary text-white' : ''); ?>">
                        <i class="fa fa-wrench mr-2"></i>Template Management
                    </a>
                    </li>
                <?php endif; ?>

                <!-- Blog Management -->

                <li>
                <a href="<?php echo e(route('blogs.index')); ?>"
                    class="nav-link <?php echo e(request()->routeIs('blogs.*') ? 'active bg-primary text-white' : ''); ?>">
                    <i class="fa fa-book mr-2"></i>Blog Management
                </a>
                </li>
            </ul>
            </div>
        </li>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('contact')): ?>
        <li class="nav-item">
            <a href="<?php echo e(route('contacts.index')); ?>" class="nav-link <?php echo e(request()->routeIs('contacts.index') ? 'active bg-primary text-white' : ''); ?>">
                <i class="fa fa-envelope mr-2"></i>Messages
            </a>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('discuss-project')): ?>
        <li class="nav-item">
            <a href="<?php echo e(route('discuss-project.index')); ?>" class="nav-link <?php echo e(request()->routeIs('discuss-project.index') ? 'active bg-primary text-white' : ''); ?>">
                <i class="fa fa-envelope mr-2"></i>Discussion Project
            </a>
        </li>
        <?php endif; ?>





    </ul>
</nav>
<?php /**PATH E:\mywork\vivek startup\digital-startup\resources\views/layouts/partials/sideNav.blade.php ENDPATH**/ ?>