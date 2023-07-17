<?= $this->extend('layouts/layout'); ?>
<?= $this->section('content'); ?>

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
<?php if (session('error')) : ?>
    <!--begin::Notice-->
    <div class="notice d-flex bg-light-danger rounded border-danger border border-dashed mb-9 p-6">
        <!--begin::Icon-->
        <i class="ki-duotone ki-information fs-2tx text-danger me-4">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
        </i>
        <!--end::Icon-->
        <!--begin::Wrapper-->
        <div class="d-flex flex-stack flex-grow-1">
            <!--begin::Content-->
            <div class="fw-semibold">
                <h4 class="text-gray-900 fw-bold">Gagal</h4>
                <div class="fs-6 text-gray-700"><?= session('error'); ?></div>
            </div>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Notice-->
<?php endif; ?>

<a href="<?= base_url('pengaduan-masuk/riwayat') ?>" class="btn btn-light-danger mb-10 me-3">
    <i class="ki-outline ki-to-left fs-2"></i>Kembali
</a>

<button type="button" class="btn btn-light-success mb-10 me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_update_status">
    <i class="ki-outline ki-switch fs-2"></i>Ubah Status
</button>


<!--begin::Row-->
<div class="row mb-3">
    <!--begin::Col-->
    <div class="col-3">
        <div class="fs-6 mb-3">Kode Tiket</div>
    </div>
    <div class="col-9">
        <div class="fs-6 fw-semibold mb-3"><?= $pengaduan['kode'] ?></div>
        <span class="fs-6 badge badge-light-<?= $pengaduan['warna'] ?> fw-bolder"><?= $pengaduan['label'] ?></span>
    </div>
</div>
<!--end::Row-->

<!--begin::Row-->
<div class="row mb-3">
    <!--begin::Col-->
    <div class="col-3">
        <div class="fs-6 mb-3">Oleh</div>
    </div>
    <div class="col-9 d-flex align-items-center">
        <!--begin:: Avatar -->
        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
            <a href="<?= base_url('users/detail/' . $pengaduan['user_id']) ?>">
                <div class="symbol-label">
                    <img src="<?= base_url() ?>media/avatars/<?= $pengaduan['foto_profil'] ?>"
                         alt="<?= $pengaduan['username'] ?>"
                         class="w-100"/>
                </div>
            </a>
        </div>
        <!--end::Avatar-->
        <!--begin::User details-->
        <div class="d-flex flex-column">
            <a href="<?= base_url('users/detail/' . $pengaduan['user_id']) ?>"
               class="text-gray-900 fw-bolder text-hover-primary mb-1"><?= $pengaduan['username'] ?></a>
            <span><?= $pengaduan['email'] ?></span>
        </div>
        <!--begin::User details-->
    </div>
</div>
<!--end::Row-->

<!--begin::Row-->
<div class="row mb-3">
    <!--begin::Col-->
    <div class="col-3">
        <div class="fs-6 mb-3">Pelaksana</div>
    </div>
    <div class="col-9">
        <span class="fs-6 badge badge-light-<?= COLOR[$pengaduan['wilayah_id'] % count(COLOR)] ?> fw-bolder"><?= $pengaduan['nama_wilayah'] ?></span>
    </div>
</div>
<!--end::Row-->

<!--begin::Row-->
<div class="row mb-3">
    <!--begin::Col-->
    <div class="col-3">
        <div class="fs-6 mb-3">Subjek</div>
    </div>
    <div class="col-9">
        <div class="fs-6 fw-bolder mb-3"><?= $pengaduan['judul'] ?></div>
    </div>
</div>
<!--end::Row-->

<!--begin::Row-->
<div class="row mb-3">
    <!--begin::Col-->
    <div class="col-3">
        <div class="fs-6 mb-3">Dibuat pada</div>
    </div>
    <div class="col-9">
        <div class="fs-6 fw-bolder mb-3"><?= date('d F Y - H:i A', strtotime($pengaduan['created_at'])) ?></div>
    </div>
</div>
<!--end::Row-->

<!--begin::Row-->
<div class="row mb-8">
    <!--begin::Col-->
    <div class="col-3">
        <div class="fs-6 mb-3">Terakhir diperbarui</div>
    </div>
    <div class="col-9">
        <div class="fs-6 fw-bolder mb-3"><?= date('d F Y - H:i A', strtotime($pengaduan['updated_at'])) ?></div>
    </div>
</div>
<!--end::Row-->
<div class="separator separator-solid mb-8"></div>
<!--begin::Row-->
<div class="row mb-8">
    <!--begin::Col-->
    <div class="col-xl-3">
        <div class="fs-6 fw-semibold mt-2 mb-3">Foto</div>
    </div>
    <!--end::Col-->
    <!--        preview foto-->
    <div class="col-xl-3 fv-row mb-3">
        <img src="<?= base_url('media/uploads/pengaduan/' . $pengaduan['foto']) ?>" alt="foto" width="360px">
    </div>
</div>
<!--end::Row-->

<!--begin::Row-->
<div class="row mb-8">
    <!--begin::Col-->
    <div class="col-xl-3">
        <div class="fs-6 fw-semibold mb-3">Deskripsi</div>
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-xl-9 fv-row">
        <textarea type="text" class="form-control form-control-solid" rows="3" disabled><?= $pengaduan['deskripsi'] ?></textarea>
    </div>
</div>
<!--end::Row-->

<!--begin::Row-->
<div class="row mb-8">
    <!--begin::Col-->
    <div class="col-xl-3">
        <div class="fs-6 fw-semibold mt-2 mb-3">Tanggapan</div>
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-xl-9 fv-row">
        <textarea type="text" class="form-control form-control-solid" rows="3" disabled><?= $pengaduan['komentar'] ?></textarea>
    </div>
</div>
<!--end::Row-->

<!--begin::Modal - Update menus-->
<div class="modal fade" id="kt_modal_update_status" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Alih Tugas Pengaduan</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--end::Notice-->
                <!--begin::Form-->
                <form id="kt_modal_update_status" action="<?= base_url('pengaduan-masuk/update') ?>" method="post">
                    <input type="hidden" name="kode" value="<?= $pengaduan['kode'] ?>">
                    <input type="hidden" name="wilayah_id" value="<?= $pengaduan['wilayah_id'] ?>">

                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mb-2" for="status_id">
                            <span class="required">Status</span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <select class="form-select form-select-solid" data-control="select2"
                                data-placeholder="Pilih Status"
                                name="status_id"
                                data-dropdown-parent="#kt_modal_update_status"
                                data-allow-clear="true">
                            <option></option>
                            <?php foreach ($status as $s) : ?>
                                <option value="<?= $s['id'] ?>" <?= $pengaduan['status_id'] == $s['id'] ? 'selected' : '' ?>><?= $s['label'] . ' | ' . $s['deskripsi'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mb-2" for="komentar">Tanggapan</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea class="form-control form-control-solid" rows="3" name="komentar" placeholder="Tanggapan"><?= $pengaduan['komentar'] ?></textarea>
                            <!--end::Input-->
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary" data-kt-menus-modal-action="submit">
                            <span class="indicator-label">Kirim</span>
                            <span class="indicator-progress">Please wait...
								    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Update menus-->

<?= $this->endSection() ?>
