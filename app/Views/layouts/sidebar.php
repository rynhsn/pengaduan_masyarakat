<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
     data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px"
     data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Header-->
    <div class="app-sidebar-header d-none d-lg-flex px-6 pt-8 pb-4" id="kt_app_sidebar_header">
        <!--begin::Toggle-->
            <!--begin::Logo-->
            <span class="d-flex flex-center flex-shrink-0 w-40px me-3">
									<img alt="Logo" src="<?= base_url() ?>media/logos/logo.png"
                                         data-kt-element="logo" class="h-30px"/>
								</span>
            <!--end::Logo-->
            <!--begin::Info-->
            <span class="d-flex flex-column align-items-start flex-grow-1">
									<span class="fs-5 fw-bold text-white text-uppercase" data-kt-element="title">SIMDUKAT</span>
									<span class="fs-7 fw-bold text-gray-700 lh-sm"
                                          data-kt-element="desc">Pengaduan Masyarakat Kecamatan Bandung</span>
								</span>
            <!--end::Info-->
        <!--end::Toggle-->
    </div>
    <!--end::Header-->
    <!--begin::Navs-->
    <div class="app-sidebar-navs flex-column-fluid py-6" id="kt_app_sidebar_navs">
        <div id="kt_app_sidebar_navs_wrappers" class="hover-scroll-y my-2" data-kt-scroll="true"
             data-kt-scroll-activate="true" data-kt-scroll-height="auto"
             data-kt-scroll-dependencies="#kt_app_sidebar_header, #kt_app_sidebar_footer"
             data-kt-scroll-wrappers="#kt_app_sidebar_navs" data-kt-scroll-offset="5px">
            <!--begin::Sidebar menu-->
            <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false"
                 class="menu menu-column menu-rounded menu-sub-indention menu-active-bg">

                <!--begin::Menu Item-->
                <div class="menu-item <?= service('uri')->getPath() == '/' ? 'here' : '' ?>">
                    <!--begin::Menu link-->
                    <a href="/"
                       class="menu-link <?= service('uri')->getPath() == '/' ? 'active' : '' ?>">
                        <!--begin::Icon-->
                        <span class="menu-icon">
												<i class="ki-outline ki-home-2 fas-1"></i>
											</span>
                        <!--end::Icon-->
                        <!--begin::Title-->
                        <span class="menu-title">Dashboard</span>
                    </a>
                    <!--end:::Menu link-->
                </div>
                <!--end::Menu Item-->

                <?php foreach (getMenus() as $menu): ?>
                    <?php if (has_permission($menu['permission_id']) && $menu['is_active']): ?>
                        <?php if (!$menu['is_parent']): ?>
                            <!--begin::Menu Item-->
                            <div class="menu-item <?= isActiveLink($menu['url'], $menu['id']) ? 'here' : '' ?>">
                                <!--begin::Menu link-->
                                <a href="<?= base_url($menu['url']) ?>"
                                   class="menu-link <?= isActiveLink($menu['url'], $menu['id']) ? 'active' : '' ?>">
                                    <!--begin::Icon-->
                                    <span class="menu-icon">
												<i class="<?= $menu['icon'] ?> <?= isActiveLink($menu['url'], $menu['id']) ? 'fs-2' : 'fs-1' ?>"></i>
											</span>
                                    <!--end::Icon-->
                                    <!--begin::Title-->
                                    <span class="menu-title"><?= $menu['menu'] ?></span>
                                    <!--end::Title-->
                                    <?php if ($menu['has_notify']): ?>
                                        <!--begin::Badge-->
                                        <span class="menu-badge">
                                            <span class="badge badge-light-primary"><?= $menu['notify'] ?></span>
                                        </span>
                                        <!--end::Badge-->
                                    <?php endif; ?>
                                </a>
                                <!--end:::Menu link-->
                            </div>
                            <!--end::Menu Item-->
                        <?php else: ?>
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click"
                                 class="menu-item <?= isActiveLink($menu['url'], $menu['id']) ? 'here show' : '' ?> menu-accordion">
                                <!--begin:Menu link-->
                                <span class="menu-link">
											<span class="menu-icon">
												<i class="<?= $menu['icon'] ?> <?= isActiveLink($menu['url'], $menu['id']) ? 'fs-2' : 'fs-1' ?>"></i>
											</span>
											<span class="menu-title"><?= $menu['menu'] ?></span>
											<span class="menu-arrow"></span>
										</span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion">
                                    <?php foreach (getSubMenus($menu['id']) as $submenu): ?>
                                        <?php if (has_permission($submenu['permission_id']) && $menu['is_active']): ?>
                                            <!--begin:Menu item-->
                                            <div class="menu-item">
                                                <!--begin:Menu link-->
                                                <a class="menu-link <?= isActiveLink($submenu['url']) ? 'active' : '' ?>"
                                                   href="<?= base_url($submenu['url']) ?>"
                                                   title="<?= $submenu['description'] ?>"
                                                   data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                   data-bs-dismiss="click"
                                                   data-bs-placement="right">
													<span class="menu-bullet">
														<span class="bullet bullet-dot"></span>
													</span>
                                                    <span class="menu-title"><?= $submenu['sub_menu'] ?></span>

                                                    <?php if ($submenu['has_notify']): ?>
                                                        <!--begin::Badge-->
                                                        <span class="menu-badge">
                                                            <span
                                                                class="badge badge-light-primary"><?= $submenu['notify'] ?></span>
                                                        </span>
                                                        <!--end::Badge-->
                                                    <?php endif; ?>
                                                </a>
                                                <!--end:Menu link-->
                                            </div>
                                            <!--end:Menu item-->
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                                <!--end:Menu sub-->
                            </div>
                            <!--end:Menu item-->
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <!--end::Sidebar menu-->
        </div>
    </div>
    <!--end::Navs-->
    <!--begin::Footer-->
    <div class="app-sidebar-footer d-flex flex-stack px-11 pb-10" id="kt_app_sidebar_footer">
        <!--begin::User menu-->
        <div class="">
            <!--begin::Menu wrapper-->
            <div class="cursor-pointer symbol symbol-circle symbol-40px"
                 data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-overflow="true"
                 data-kt-menu-placement="top-start">
                <img src="<?= base_url() ?>media/avatars/<?= getProfilePicture(user_id()) ?>" alt="image"/>
            </div>
            <!--begin::User account menu-->
            <div
                class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                data-kt-menu="true">
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <div class="menu-content d-flex align-items-center px-3">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-50px me-5">
                            <img alt="Logo" src="<?= base_url() ?>media/avatars/<?= getProfilePicture(user_id()) ?>"/>
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Username-->
                        <div class="d-flex flex-column">
                            <div class="fw-bold d-flex align-items-center fs-5"><?= user()->username ?></div>
                            <a href="#" class="fw-semibold text-muted text-hover-primary fs-7"><?= user()->email ?></a>
                        </div>
                        <!--end::Username-->
                    </div>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu separator-->
                <div class="separator my-2"></div>
                <!--end::Menu separator-->
                <!--begin::Menu item-->
                <div class="menu-item px-5">
                    <a href="demo27/dist/account/overview.html" class="menu-link px-5">My Profile</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu separator-->
                <div class="separator my-2"></div>
                <!--end::Menu separator-->
                <!--begin::Menu item-->
                <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                     data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                    <a href="#" class="menu-link px-5">
											<span class="menu-title position-relative">Mode
											<span class="ms-5 position-absolute translate-middle-y top-50 end-0">
												<i class="ki-outline ki-night-day theme-light-show fs-2"></i>
												<i class="ki-outline ki-moon theme-dark-show fs-2"></i>
											</span></span>
                    </a>
                    <!--begin::Menu-->
                    <div
                        class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
                        data-kt-menu="true" data-kt-element="theme-mode-menu">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
													<span class="menu-icon" data-kt-element="icon">
														<i class="ki-outline ki-night-day fs-2"></i>
													</span>
                                <span class="menu-title">Light</span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
													<span class="menu-icon" data-kt-element="icon">
														<i class="ki-outline ki-moon fs-2"></i>
													</span>
                                <span class="menu-title">Dark</span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
													<span class="menu-icon" data-kt-element="icon">
														<i class="ki-outline ki-screen fs-2"></i>
													</span>
                                <span class="menu-title">System</span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu-->
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-5 my-1">
                    <a href="demo27/dist/account/settings.html" class="menu-link px-5">Account Settings</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-5">
                    <a href="<?= base_url('logout') ?>" class="menu-link px-5">Keluar</a>
                </div>
                <!--end::Menu item-->
            </div>
            <!--end::User account menu-->
            <!--end::Menu wrapper-->
        </div>
        <!--end::User menu-->
    </div>
    <!--end::Footer-->
</div>
<!--end::Sidebar-->