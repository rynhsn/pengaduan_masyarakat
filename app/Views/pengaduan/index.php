<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>

    <!--begin::Row-->
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">
        <?php foreach ($pengaduan as $item) : ?>
            <div class="col-xl-6">
                <!--begin::Feeds Widget 5-->
                <div class="card mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body pb-0">
                        <!--begin::Header-->
                        <div class="d-flex align-items-center mb-5">
                            <!--begin::User-->
                            <div class="d-flex align-items-center flex-grow-1">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-45px me-5">
                                    <img src="<?= base_url() ?>media/avatars/<?= $item['foto_profil'] ?>" alt="">
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Info-->
                                <div class="d-flex flex-column">
                                    <div class="text-gray-900 fs-6 fw-bold"><?= $item['nama_lengkap'] ?></div>
                                    <span class="text-gray-400 fw-bold"><?= $item['email'] ?></span>
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::User-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Post-->
                        <div class="mb-5">
                            <!--begin::Image-->
                            <div class="bgi-no-repeat bgi-size-cover rounded min-h-250px mb-5"
                                 style="background-image:url('<?= base_url() ?>media/uploads/pengaduan/<?= $item['foto'] ?>');"></div>
                            <!--end::Image-->

                            <!--begin::Text-->
                            <div class="fw-bold text-gray-800"><?= $item['judul'] ?></div>
                            <div class="text-muted font-italic"><?= date('d M Y', strtotime($item['tanggal'])) ?></div>
<!--                            status-->
                                <span class="badge badge-light-<?= $item['warna'] ?> mb-5"><?= $item['label'] ?></span>
                            <div class="text-gray-800 mb-5"><?= word_limiter($item['deskripsi'], 50) ?></div>
                            <!--end::Text-->
                            <!--begin::Toolbar-->
                            <div class="d-flex align-items-center mb-5">
                                <?= form_open('pengaduan/edit/'.base64_encode($item['id']), ['method'=>'GET']) ?>
                                <button type="submit"
                                   class="btn btn-sm btn-light btn-color-muted btn-active-light-success px-4 py-2 me-4 <?= $item['status_id'] != 1 ? 'disabled' : '' ?>">
                                    <i class="ki-outline ki-pencil fs-2"></i>Ubah</button>
                                <?= form_close() ?>

                                <a href="<?= base_url('pengaduan/delete/'. base64_encode($item['id'])) ?>" class="btn btn-sm btn-light btn-color-muted btn-active-light-danger px-4 py-2 me-4 <?= $item['status_id'] != 1 ? 'disabled' : '' ?>">
                                    <i class="ki-outline ki-trash fs-2" onclick="return confirm('Pengaduan akan dihapus, yakin?')"></i>Hapus</a>

                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Post-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Feeds Widget 5-->
            </div>
        <?php endforeach; ?>
    </div>
    <!--end::Row-->

<?= $this->endSection(); ?>