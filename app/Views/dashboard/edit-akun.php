<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>
<?php if (session('pesan')): ?>
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
                <div class="fs-6 text-gray-700"><?= session('pesan'); ?></div>
            </div>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Notice-->
<?php endif; ?>

<div class="row g-5 g-xl-8">
    <div class="col-xl">
        <!--begin::Basic info-->
        <div class="card mb-5 mb-xl-10">
            <!--begin::Card header-->
            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                 data-bs-target="#kt_account_profile_details" aria-expanded="true"
                 aria-controls="kt_account_profile_details">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0"><?= $title; ?> Info</h3>
                </div>
                <!--end::Card title-->
            </div>
            <!--begin::Card header-->
            <!--begin::Content-->
            <div id="kt_account_settings_profile_details" class="collapse show">
                <?= form_open('/panel/settings/profile'); ?>
                <?= csrf_field(); ?>
                <?= form_hidden('_method', 'PUT'); ?>
                <?= form_hidden('id', $user->id); ?>
                <?= form_hidden('email', $user->email); ?>
                <?= form_hidden('usernameLama', $user->username); ?>
                <!--begin::Card body-->
                <div class="card-body border-top p-9">
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Email</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="email" name="email"
                                   class="form-control form-control-lg form-control-solid <?= validation_show_error('email') ? 'is-invalid' : ''; ?>"
                                   placeholder="Alamat email aktif"
                                   value="<?= old('email') ?? $user->email ?>" required/>
                            <div class="invalid-feedback">
                                <?= validation_show_error('email'); ?>
                            </div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Username</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="username"
                                   class="form-control form-control-lg form-control-solid <?= validation_show_error('username') ? 'is-invalid' : ''; ?>"
                                   placeholder="username tanpa spasi"
                                   pattern="^\S+$" value="<?= old('username') ?? $user->username ?>" required/>
                            <div class="invalid-feedback">
                                <?= validation_show_error('username'); ?>
                            </div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Card body-->
                <!--begin::Actions-->
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="reset" class="btn btn-light btn-active-light-primary me-2">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan
                    </button>
                </div>
                <!--end::Actions-->
                <?= form_close(); ?>
                <!--end::Form-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Basic info-->
    </div>
    <div class="col-xl">
        <!--begin::Basic info-->
        <div class="card mb-5 mb-xl-10">
            <!--begin::Card header-->
            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                 data-bs-target="#kt_account_profile_details" aria-expanded="true"
                 aria-controls="kt_account_profile_details">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0"><?= $title; ?> Password</h3>
                </div>
                <!--end::Card title-->
            </div>
            <!--begin::Card header-->
            <!--begin::Content-->
            <div id="kt_account_settings_profile_details" class="collapse show">
                <form action="/panel/settings/password" method="post">
                    <?= csrf_field(); ?>
                    <?= form_hidden('id', $user->id); ?>
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Password Sekarang</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <input type="password" name="current_password"
                                       class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 <?= session('errors.current_password') ? 'is-invalid' : ''; ?>"
                                       required/>
                                <div class="invalid-feedback">
                                    <?= session('errors.current_password'); ?>
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Password Baru</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <input type="password" name="password"
                                       class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 <?= session('errors.password') ? 'is-invalid' : ''; ?>"
                                       required/>
                                <div class="invalid-feedback">
                                    <?= session('errors.password'); ?>
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Ulangi
                                Password</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <input type="password" name="pass_confirm"
                                       class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 <?= session('errors.pass_confirm') ? 'is-invalid' : ''; ?>"
                                       required/>
                                <div class="invalid-feedback">
                                    <?= session('errors.pass_confirm'); ?>
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Card body-->
                    <!--begin::Actions-->
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="reset" class="btn btn-light btn-active-light-primary me-2">Batal</button>

                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                            Simpan
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Basic info-->
    </div>
</div>


<?= $this->endSection(); ?>