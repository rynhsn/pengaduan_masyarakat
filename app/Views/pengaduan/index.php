<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>

    <?php if (session('message')) : ?>
    <!--begin::Notice-->
    <div class="notice d-flex bg-light-success rounded border-success border border-dashed mb-9 p-6">
        <!--begin::Icon-->
        <i class="ki-duotone ki-check-square fs-2tx text-success me-4">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
        </i>
        <!--end::Icon-->
        <!--begin::Wrapper-->
        <div class="d-flex flex-stack flex-grow-1">
            <!--begin::Content-->
            <div class="fw-semibold">
                <h4 class="text-gray-900 fw-bold">Berhasil</h4>
                <div class="fs-6 text-gray-700"><?= session('message'); ?></div>
            </div>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Notice-->
    <?php endif; ?>

    <!--begin::Row-->
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">
        <?php if (count($pengaduan) > 0) : ?>
        <?php foreach ($pengaduan as $item) : ?>
            <div class="col-xl-6">
                <!--begin::Feeds Widget 5-->
                <div class="card mb-5 mb-xl-5">
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
                            <div class="fw-bold text-gray-800 mb-2">Tiket : <?= $item['kode'] ?></div>
                            <div class="fw-bold text-gray-800 mb-2">Ditangani oleh : <?= $item['nama_wilayah'] ?></div>
                            <!--begin::Image-->
                            <div class="bgi-no-repeat bgi-size-cover rounded min-h-250px mb-5"
                                 style="background-image:url('<?= base_url() ?>media/uploads/pengaduan/<?= $item['foto'] ?>');"></div>
                            <!--end::Image-->

                            <!--begin::Text-->
                            <div class="fw-bold text-gray-800"><?= $item['judul'] ?></div>
                            <div class="text-muted font-italic"><?= date('d M Y', strtotime($item['tanggal'])) ?></div>
                            <!--                            status-->
                            <span class="badge badge-light-<?= $item['warna'] ?> mb-5"
                                  title="<?= $item['status_deskripsi'] ?>"><?= $item['label'] ?></span>
                            <div class="text-gray-800 mb-5"><?= word_limiter($item['deskripsi'], 50) ?></div>
                            <!--end::Text-->
                            <!--begin::Toolbar-->
                            <div class="d-flex align-items-center mb-5">
                                <form action="pengaduan/edit/<?= $item['kode'] ?>">
                                    <button type="submit"
                                            class="btn btn-sm btn-light btn-color-muted btn-active-light-success px-4 py-2 me-4 <?= $item['status_id'] != 1 ? 'disabled' : '' ?>">
                                        <i class="ki-outline ki-pencil fs-2"></i>Ubah
                                    </button>
                                </form>

                                <a href="<?= base_url('pengaduan/delete/' . $item['kode']) ?>"
                                   class="btn btn-sm btn-light btn-color-muted btn-active-light-danger px-4 py-2 me-4 <?= $item['status_id'] != 1 ? 'disabled' : '' ?>">
                                    <i class="ki-outline ki-trash fs-2"
                                       onclick="return confirm('Pengaduan akan dihapus, yakin?')"></i>Hapus</a>

                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Post-->
                    </div>
                    <!--end::Body-->
                    <div class="card-footer pt-0">
                        <!--begin::Comment form-->
                        <div class="d-flex align-items-center mt-6">
                            <!--begin::Input group-->
                            <div class="position-relative w-100">
                                <!--begin::Input-->
                                <textarea class="form-control form-control-solid border ps-5" placeholder="Belum ada tanggapan" rows="1" disabled><?= $item['komentar'] ?></textarea>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Comment form-->
                    </div>
                </div>
                <!--end::Feeds Widget 5-->
            </div>
        <?php endforeach; ?>
        <?php else : ?>
            <div class="col-xl-12">
                <div class="card mb-5 mb-xl-5">
                    <div class="card-body pb-0">
                        <div class="text-center">
                            <img src="<?= base_url() ?>assets/media/illustrations/empty.svg" alt="" class="mw-100 mh-300px mb-10"/>
                            <h3 class="fs-2x fw-bold mb-10">Tidak ada pengaduan</h3>
                            <p class="text-gray-400 fs-4 fw-bold mb-10">Silahkan buat pengaduan baru</p>
                            <a href="<?= base_url('pengaduan') ?>" class="btn btn-primary mb-10">Buat Pengaduan</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <!--end::Row-->

<?= $this->endSection(); ?>