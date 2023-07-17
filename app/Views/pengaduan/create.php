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

<!--begin::Form-->
<form enctype="multipart/form-data" method="post" action="<?= base_url('pengaduan/create') ?>">
    <!--begin::Card body-->
    <!--begin::Row-->
    <div class="row mb-8">
        <!--begin::Col-->
        <div class="col-xl-3">
            <div class="fs-6 fw-semibold mt-2 mb-3 required">Subjek Pengaduan</div>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-9 fv-row">
            <input type="text" class="form-control form-control-solid <?= session('errors.judul') ? 'is-invalid' : '' ?>" placeholder="Subjek pengaduan" name="judul" value="<?= old('judul') ?>" minlength="3" maxlength="255" required/>

            <div class="fv-plugins-message-container invalid-feedback">
                <?= session('errors.judul') ?>
            </div>
        </div>
    </div>
    <!--end::Row-->

    <!--begin::Row-->
    <div class="row mb-8">
        <!--begin::Col-->
        <div class="col-xl-3">
            <div class="fs-6 fw-semibold mt-2 mb-3 required">Deskripsi</div>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-9 fv-row">
            <textarea type="text" class="form-control form-control-solid <?= session('errors.judul') ? 'is-invalid' : '' ?>" rows="7" placeholder="Detail pengaduan" name="deskripsi" required><?= old('judul') ?? null ?></textarea>

            <div class="fv-plugins-message-container invalid-feedback">
                <?= session('errors.deskripsi') ?>
            </div>
        </div>
    </div>
    <!--end::Row-->

    <!--begin::Row-->
    <div class="row mb-8">
        <!--begin::Col-->
        <div class="col-xl-3">
            <div class="fs-6 fw-semibold mt-2 mb-3">Tanggal</div>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-9 fv-row">
            <div class="position-relative d-flex align-items-center">
                <i class="ki-outline ki-calendar-8 position-absolute ms-4 mb-1 fs-2"></i>
                <input class="form-control form-control-solid ps-12" name="date" placeholder="Pilih tanggal"
                       id="kt_datepicker_1"/>
            </div>
        </div>
        <!--begin::Col-->
    </div>
    <!--end::Row-->

    <!--begin::Row-->
    <div class="row mb-8">
        <!--begin::Col-->
        <div class="col-xl-3">
            <div class="fs-6 fw-semibold mt-2 mb-3 required">Foto</div>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-9 fv-row">
            <input type="file" class="form-control form-control-solid <?= session('errors.foto') ? 'is-invalid' : '' ?>" name="foto" accept=".png, .jpg, .jpeg" required/>

            <div class="fv-plugins-message-container invalid-feedback">
                <?= session('errors.foto') ?>
            </div>
        </div>
    </div>
    <!--end::Row-->

    <button type="submit" class="btn btn-primary">Kirim</button>
</form>
<!--end:Form-->

<?= $this->endSection() ?>
