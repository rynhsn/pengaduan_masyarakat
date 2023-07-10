<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="../"/>
		<title><?= $title ?> | Pengaduan Masyarakat</title>
		<meta charset="utf-8" />
		<meta name="description" content="Portal Pengaduan Masyarakat" />
		<meta name="keywords" content="Portal Pengaduan Masyarakat" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Portal Pengaduan Masyarakat" />
		<meta property="og:url" content="https://keenthemes.com/metronic" />
		<meta property="og:site_name" content="Portal Pengaduan Masyarakat" />
		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
		<link rel="shortcut icon" href="<?= base_url() ?>media/logos/favicon.ico" />
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Vendor Stylesheets(used for this page only)-->
		<link href="<?= base_url() ?>plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="<?= base_url() ?>plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url() ?>css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_app_body" data-kt-app-header-fixed-mobile="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" class="app-default">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->
		<!--begin::App-->
		<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
			<!--begin::Page-->
			<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
				<!--begin::Header-->
				<div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: false, lg: true}" data-kt-sticky-name="app-header-sticky" data-kt-sticky-offset="{default: false, lg: '300px'}">
					<!--begin::Header container-->
					<div class="app-container container-fluid d-flex flex-stack" id="kt_app_header_container">
						<!--begin::Sidebar toggle-->
						<div class="d-flex align-items-center d-block d-lg-none ms-n3" title="Show sidebar menu">
							<div class="btn btn-icon btn-active-color-primary w-35px h-35px me-2" id="kt_app_sidebar_mobile_toggle">
								<i class="ki-outline ki-abstract-14 fs-2"></i>
							</div>
						</div>
						<!--end::Sidebar toggle-->
						<!--begin::Header wrapper-->
						<div class="d-flex flex-stack flex-lg-row-fluid" id="kt_app_header_wrapper">
							<!--begin::Page title-->
							<div class="page-title gap-4 me-3 mb-5 mb-lg-0" data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_header_wrapper'}">
								<!--begin::Title-->
								<h1 class="text-gray-900 fw-bolder m-0"><?= $title ?></h1>
								<!--end::Title-->
							</div>
							<!--end::Page title-->
						</div>
						<!--end::Header wrapper-->
					</div>
					<!--end::Header container-->
				</div>
				<!--end::Header-->
				<!--begin::Wrapper-->
				<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
					<?= $this->include('Layouts/sidebar') ?>
					<!--begin::Main-->
					<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
						<!--begin::Content wrapper-->
						<div class="d-flex flex-column flex-column-fluid">
							<!--begin::Content-->
							<div id="kt_app_content" class="app-content flex-column-fluid">
								<!--begin::Content container-->
								<div id="kt_app_content_container" class="app-container container-fluid">
									<?= $this->renderSection('content') ?>
								</div>
								<!--end::Content container-->
							</div>
							<!--end::Content-->
						</div>
						<!--end::Content wrapper-->
					</div>
					<!--end:::Main-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::App-->
		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<i class="ki-outline ki-arrow-up"></i>
		</div>
		<!--end::Scrolltop-->
		<!--begin::Modals-->
		<!--end::Modals-->

		<!--begin::Javascript-->
		<script>var hostUrl = "<?= base_url() ?>";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="<?= base_url() ?>plugins/global/plugins.bundle.js"></script>
		<script src="<?= base_url() ?>js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Vendors Javascript(used for this page only)-->
		<script src="<?= base_url() ?>plugins/custom/fslightbox/fslightbox.bundle.js"></script>
		<script src="<?= base_url() ?>plugins/custom/datatables/datatables.bundle.js"></script>
		<!--end::Vendors Javascript-->
		<!--begin::Custom Javascript(used for this page only)-->
		<script src="<?= base_url() ?>js/custom/apps/user-management/users/list/table.js"></script>
		<script src="<?= base_url() ?>js/custom/apps/user-management/users/list/export-users.js"></script>
		<script src="<?= base_url() ?>js/custom/apps/user-management/users/list/add.js"></script>

		<script src="<?= base_url() ?>js/custom/apps/user-management/roles/list/add.js"></script>
		<script src="<?= base_url() ?>js/custom/apps/user-management/roles/list/update-role.js"></script>

		<script src="<?= base_url() ?>js/custom/apps/user-management/permissions/list.js"></script>
		<script src="<?= base_url() ?>js/custom/apps/user-management/permissions/add-permission.js"></script>
		<script src="<?= base_url() ?>js/custom/apps/user-management/permissions/update-permission.js"></script>

		<script src="<?= base_url() ?>js/custom/apps/menu-management/menus/list.js"></script>
		<script src="<?= base_url() ?>js/custom/apps/menu-management/menus/add-menu.js"></script>
		<script src="<?= base_url() ?>js/custom/apps/menu-management/menus/update-menu.js"></script>

		<script src="<?= base_url() ?>js/custom/apps/menu-management/submenus/list.js"></script>
		<script src="<?= base_url() ?>js/custom/apps/menu-management/submenus/add-submenu.js"></script>
		<script src="<?= base_url() ?>js/custom/apps/menu-management/submenus/update-submenu.js"></script>

		<script src="<?= base_url() ?>js/custom/apps/user-management/users/view/view.js"></script>
		<script src="<?= base_url() ?>js/custom/apps/user-management/users/view/update-details.js"></script>
		<script src="<?= base_url() ?>js/custom/apps/user-management/users/view/add-schedule.js"></script>
		<script src="<?= base_url() ?>js/custom/apps/user-management/users/view/add-task.js"></script>
		<script src="<?= base_url() ?>js/custom/apps/user-management/users/view/update-email.js"></script>
		<script src="<?= base_url() ?>js/custom/apps/user-management/users/view/update-password.js"></script>
		<script src="<?= base_url() ?>js/custom/apps/user-management/users/view/update-role.js"></script>
		<script src="<?= base_url() ?>js/custom/apps/user-management/users/view/add-auth-app.js"></script>
		<script src="<?= base_url() ?>js/custom/apps/user-management/users/view/add-one-time-password.js"></script>
		<script src="<?= base_url() ?>js/custom/apps/projects/settings/settings.js"></script>

		<script src="<?= base_url() ?>js/widgets.bundle.js"></script>
		<script src="<?= base_url() ?>js/custom/widgets.js"></script>
<!--		<script src="--><?php //= base_url() ?><!--js/custom/apps/chat/chat.js"></script>-->
<!--		<script src="--><?php //= base_url() ?><!--js/custom/utilities/modals/create-campaign.js"></script>-->
<!--		<script src="--><?php //= base_url() ?><!--js/custom/utilities/modals/users-search.js"></script>-->
		<!--end::Custom Javascript-->
		<!--end::Javascript-->

		<script>
			$("#kt_datepicker_flat").flatpickr();
		</script>
	</body>
	<!--end::Body-->
</html>