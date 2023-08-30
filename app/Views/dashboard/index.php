<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>

    <div class="row gy-5 g-xl-10">
        <?php if (in_groups('User')) : ?>
<!--        tampilan selamat datang-->
            <div class="col-12">
                <div class="card card-custom">
                    <div class="card-body p-0">
                        <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
                            <div class="col-xl-12 col-xxl-7">
                                <h1 class="display-1 text-dark mb-10">Selamat Datang <?= user()->username ?></h1>
                                <p class="font-size-h3 text-muted fw-bold">SIMDUKAT - Sistem Pengaduan Masyarakat</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <!--begin::Col-->
            <div class="col-sm-6 col-xl-2 mb-xl-10">
                <!--begin::Card widget 2-->
                <a class="card h-lg-100" href="<?= base_url('pengaduan-masuk/masuk') ?>">
                    <!--begin::Body-->
                    <div class="card-body d-flex justify-content-between align-items-start flex-column">
                        <!--begin::Icon-->
                        <div class="m-0">
                            <i class="ki-outline ki-entrance-left fs-2hx text-gray-600"></i>
                        </div>
                        <!--end::Icon-->
                        <!--begin::Section-->
                        <div class="d-flex flex-column my-7">
                            <!--begin::Number-->
                            <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2"><?= $pengaduanMasuk ?></span>
                            <!--end::Number-->
                            <!--begin::Follower-->
                            <div class="m-0">
                                <span class="fw-semibold fs-6 text-gray-400">Pengaduan Masuk</span>
                            </div>
                            <!--end::Follower-->
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Card widget 2-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-sm-6 col-xl-2 mb-xl-10">
                <!--begin::Card widget 2-->
                <a class="card h-lg-100" href="<?= base_url('pengaduan-masuk/proses') ?>">
                    <!--begin::Body-->
                    <div class="card-body d-flex justify-content-between align-items-start flex-column">
                        <!--begin::Icon-->
                        <div class="m-0">
                            <i class="ki-outline ki-double-right-arrow fs-2hx text-gray-600"></i>
                        </div>
                        <!--end::Icon-->
                        <!--begin::Section-->
                        <div class="d-flex flex-column my-7">
                            <!--begin::Number-->
                            <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2"><?= $pengaduanDiproses ?></span>
                            <!--end::Number-->
                            <!--begin::Follower-->
                            <div class="m-0">
                                <span class="fw-semibold fs-6 text-gray-400">Pengaduan Diproses</span>
                            </div>
                            <!--end::Follower-->
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Card widget 2-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-sm-6 col-xl-2 mb-xl-10">
                <!--begin::Card widget 2-->
                <a class="card h-lg-100" href="<?= base_url('pengaduan-masuk/riwayat/selesai') ?>">
                    <!--begin::Body-->
                    <div class="card-body d-flex justify-content-between align-items-start flex-column">
                        <!--begin::Icon-->
                        <div class="m-0">
                            <i class="ki-outline ki-double-check-circle fs-2hx text-gray-600"></i>
                        </div>
                        <!--end::Icon-->
                        <!--begin::Section-->
                        <div class="d-flex flex-column my-7">
                            <!--begin::Number-->
                            <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2"><?= $pengaduanSelesai ?></span>
                            <!--end::Number-->
                            <!--begin::Follower-->
                            <div class="m-0">
                                <span class="fw-semibold fs-6 text-gray-400">Pengaduan Selesai</span>
                            </div>
                            <!--end::Follower-->
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Card widget 2-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-sm-6 col-xl-2 mb-xl-10">
                <!--begin::Card widget 2-->
                <a class="card h-lg-100" href="<?= base_url('pengaduan-masuk/riwayat/tolak') ?>">
                    <!--begin::Body-->
                    <div class="card-body d-flex justify-content-between align-items-start flex-column">
                        <!--begin::Icon-->
                        <div class="m-0">
                            <i class="ki-outline ki-cross-circle fs-2hx text-gray-600"></i>
                        </div>
                        <!--end::Icon-->
                        <!--begin::Section-->
                        <div class="d-flex flex-column my-7">
                            <!--begin::Number-->
                            <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2"><?= $pengaduanDitolak ?></span>
                            <!--end::Number-->
                            <!--begin::Follower-->
                            <div class="m-0">
                                <span class="fw-semibold fs-6 text-gray-400">Pengaduan Ditolak</span>
                            </div>
                            <!--end::Follower-->
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Card widget 2-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-sm-6 col-xl-2 mb-5 mb-xl-10">
                <!--begin::Card widget 2-->
                <a class="card h-lg-100" href="<?= base_url('pengaduan-masuk/riwayat/palsu') ?>">
                    <!--begin::Body-->
                    <div class="card-body d-flex justify-content-between align-items-start flex-column">
                        <!--begin::Icon-->
                        <div class="m-0">
                            <i class="ki-outline ki-trash fs-2hx text-gray-600"></i>
                        </div>
                        <!--end::Icon-->
                        <!--begin::Section-->
                        <div class="d-flex flex-column my-7">
                            <!--begin::Number-->
                            <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2"><?= $pengaduanPalsu ?></span>
                            <!--end::Number-->
                            <!--begin::Follower-->
                            <div class="m-0">
                                <span class="fw-semibold fs-6 text-gray-400">Pengaduan Palsu</span>
                            </div>
                            <!--end::Follower-->
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Card widget 2-->
            </div>
            <!--end::Col-->
        <?php endif; ?>
    </div>

<?= $this->endSection(); ?>