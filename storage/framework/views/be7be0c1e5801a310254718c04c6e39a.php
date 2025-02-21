<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="brand-link">
        <img src="<?php echo e(asset('assets/admin/dist/img/AdminLTELogo.png')); ?>" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light px-3">ADMİN PANEL</span>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-start">
            <?php if(isset($loginUser->avatar)): ?>
                <div class="image">
                    <img src="<?php echo e(Storage::url($loginUser->avatar)); ?>" class="img-circle elevation-2"
                         style="width: 35px; height: 35px; object-fit: cover;" alt="User Image">
                </div>
            <?php endif; ?>
            <?php if(isset($loginUser)): ?>
                <div class="info">
                    <span class="d-block text-white"><?php echo e($loginUser->name); ?></span>
                </div>
            <?php endif; ?>

        </div>

        <!-- SidebarSearch Form -->


        <!-- Sidebar Menu -->
        <nav class="my-4 mb-5">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-header m-auto">
                    <span class="h6">PROYEKT İDARƏ SİSTEMİ</span>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo e(\App\Helpers\Helper::isActiveMenu(route('admin.dashboard'))); ?>"
                       href="<?php echo e(route('admin.dashboard')); ?>">
                        <i class="fa-solid fa-house h5 px-2"></i>
                        <span class="nav-link-text ms-1">Əsas Səhifə</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a class="nav-link <?php echo e(\App\Helpers\Helper::isActiveMenu(route('admin.project'))); ?> "
                       href="<?php echo e(route('admin.project')); ?>">
                        <i class="fa-solid fa-bars-progress  h5 px-2"></i>
                        <span class="nav-link-text ms-1">Proyektlər</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(\App\Helpers\Helper::isActiveMenu(route('admin.task'))); ?>"
                       href="<?php echo e(route('admin.task')); ?>">
                        <i class="fa-solid fa-list-check h5 px-2"></i>
                        <span class="nav-link-text ms-1">Tapşırıqlar</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(\App\Helpers\Helper::isActiveMenu(route('admin.user'))); ?> "
                       href="<?php echo e(route('admin.user')); ?>">
                        <i class="fa-solid fa-users h5 px-2"></i>
                        <span class="nav-link-text ms-1">İstifadəçilər</span>
                    </a>
                </li>
                <li class="nav-header m-auto">
                    <span class="h6">ADMİN BİLGİLƏRİ</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(\App\Helpers\Helper::isActiveMenu(route('admin.profile'))); ?> "
                       href="<?php echo e(route('admin.profile')); ?>">
                        <i class="fa-solid fa-user h5 px-2"></i>
                        <span class="nav-link-text ms-1">Profil</span>
                    </a>
                </li>
                <?php if(Auth::user()?->role == 'superadmin'): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(\App\Helpers\Helper::isActiveMenu(route('admin.manager'))); ?> "
                           href="<?php echo e(route('admin.manager')); ?>">
                            <i class="fa-solid fa-shield-halved h5 px-2"></i>
                            <span class="nav-link-text ms-1">Adminlər</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo e(\App\Helpers\Helper::isActiveMenu(route('admin.position'))); ?> "
                           href="<?php echo e(route('admin.position')); ?>">
                            <i class="fa-regular fa-circle-user h5 px-2"></i>
                            <span class="nav-link-text ms-1">Vəzifələr</span>
                        </a>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('logout')); ?>">
                        <i class="fa-solid fa-right-from-bracket h5 px-2 "></i>
                        <span class="nav-link-text ms-1">Çıxış</span>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside><?php /**PATH C:\Users\aygun\PhpstormProjects\TrelloApp\resources\views/admin/partials/sidebar.blade.php ENDPATH**/ ?>