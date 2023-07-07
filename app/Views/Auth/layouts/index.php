<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?= base_url() ?>"/>
    <title>Portal Pengaduan Masyarakat</title>
    <meta charset="utf-8"/>
    <meta name="description"
          content="Portal Pengaduan Masyarakat"/>
    <meta name="keywords"
          content="Portal Pengaduan Masyarakat"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title"
          content="Portal Pengaduan Masyarakat"/>
    <meta property="og:url" content="https://keenthemes.com/metronic"/>
    <meta property="og:site_name" content="Portal Pengaduan Masyarakat"/>
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8"/>
    <link rel="shortcut icon" href="<?= base_url() ?>media/logos/favicon.ico"/>
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="<?= base_url() ?>plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url() ?>css/style.bundle.css" rel="stylesheet" type="text/css"/>
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="app-blank">
<!--begin::Theme mode setup on page load-->
<script>var defaultThemeMode = "light";
    var themeMode;
    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
        } else {
            if (localStorage.getItem("data-bs-theme") !== null) {
                themeMode = localStorage.getItem("data-bs-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }
        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }
        document.documentElement.setAttribute("data-bs-theme", themeMode);
    }</script>
<!--end::Theme mode setup on page load-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
    <?= $this->renderSection('content'); ?>
    <!--begin::Aside-->
    <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2"
         style="background-image: url(<?= base_url() ?>media/misc/auth-bg.png)">
        <!--begin::Content-->
        <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
            <!--begin::Logo-->
            <a href="../../demo27/dist/index.html" class="mb-0 mb-lg-12">
                <img alt="Logo" src="<?= base_url() ?>media/logos/custom-1.png" class="h-60px h-lg-75px"/>
            </a>
            <!--end::Logo-->
            <!--begin::Image-->
            <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20"
                 src="<?= base_url() ?>media/misc/auth-screens.png" alt=""/>
            <!--end::Image-->
            <!--begin::Title-->
            <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">Fast, Efficient and
                Productive</h1>
            <!--end::Title-->
            <!--begin::Text-->
            <div class="d-none d-lg-block text-white fs-base text-center">In this kind of post,
                <a href="#" class="opacity-75-hover text-warning fw-bold me-1">the blogger</a>introduces a person
                they’ve interviewed
                <br/>and provides some background information about
                <a href="#" class="opacity-75-hover text-warning fw-bold me-1">the interviewee</a>and their
                <br/>work following this is a transcript of the interview.
            </div>
            <!--end::Text-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Aside-->
</div>
<!--end::Authentication - Sign-in-->
</div>
<!--end::Root-->
<!--begin::Javascript-->
<script>var hostUrl = "<?= base_url() ?>";</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="<?= base_url() ?>plugins/global/plugins.bundle.js"></script>
<script src="<?= base_url() ?>js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="<?= base_url() ?>js/custom/authentication/sign-in/general.js"></script>
<!--end::Custom Javascript-->
<!--end::Javascript-->

<script>
    $("#kt_datepicker_flat").flatpickr();
</script>
</body>
<!--end::Body-->
</html>