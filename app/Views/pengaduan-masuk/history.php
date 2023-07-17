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

<?php if (session('error')) : ?>
    <!--begin::Notice-->
    <div class="notice d-flex bg-light-danger rounded border-danger border border-dashed mb-9 p-6">
        <!--begin::Icon-->
        <i class="ki-duotone ki-information fs-2tx text-success me-4">
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
                <div class="fs-6 text-gray-700"><?= session('message'); ?></div>
            </div>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Notice-->
<?php endif; ?>

    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                    <input type="text" data-kt-user-table-filter="search"
                           class="form-control form-control-solid w-250px ps-13" placeholder="Cari .."/>
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <!--begin::Filter-->
                    <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                            data-kt-menu-placement="bottom-end">
                        <i class="ki-outline ki-filter fs-2"></i>Filter
                    </button>
                    <!--begin::Menu 1-->
                    <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                        <!--begin::Header-->
                        <div class="px-7 py-5">
                            <div class="fs-5 text-dark fw-bold">Filter Options</div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Separator-->
                        <div class="separator border-gray-200"></div>
                        <!--end::Separator-->
                        <!--begin::Content-->
                        <div class="px-7 py-5" data-kt-user-table-filter="form">
                            <!--begin::Input group-->
                            <div class="mb-10">
                                <label class="form-label fs-6 fw-semibold">Status:</label>
                                <select class="form-select form-select-solid fw-bold" data-kt-select2="true"
                                        data-placeholder="Select option" data-allow-clear="true"
                                        data-kt-user-table-filter="status" data-hide-search="true">
                                    <option></option>
                                    <?php foreach ($statusFilter as $s) : ?>
                                        <option value="<?= $s['label'] ?>"><?= $s['label'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Actions-->
                            <div class="d-flex justify-content-end">
                                <button type="reset"
                                        class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6"
                                        data-kt-menu-dismiss="true" data-kt-user-table-filter="reset">Reset
                                </button>
                                <button type="submit" class="btn btn-primary fw-semibold px-6"
                                        data-kt-menu-dismiss="true" data-kt-user-table-filter="filter">Apply
                                </button>
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Menu 1-->
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-125px">Oleh</th>
                    <th class="min-w-125px">Tiket</th>
                    <th class="min-w-125px">Subjek</th>
                    <th class="min-w-50px">Status</th>
                    <th class="min-w-100px">Pelaksana</th>
                    <th class="min-w-100px">Dibuat</th>
                    <th class="min-w-100px">Diperbarui</th>
                    <th class="text-end min-w-100px">Actions</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold">
                <?php foreach ($pengaduan as $item) : ?>
                    <tr>
                        <td class="d-flex align-items-center">
                            <!--begin:: Avatar -->
                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                <a href="<?= base_url('users/detail/' . $item['user_id']) ?>">
                                    <div class="symbol-label">
                                        <img src="<?= base_url() ?>media/avatars/<?= $item['foto_profil'] ?>" alt="<?= $item['username'] ?>"
                                             class="w-100"/>
                                    </div>
                                </a>
                            </div>
                            <!--end::Avatar-->
                            <!--begin::User details-->
                            <div class="d-flex flex-column">
                                <a href="<?= base_url('users/detail/' . $item['user_id']) ?>"
                                   class="text-gray-800 text-hover-primary mb-1"><?= $item['username'] ?></a>
                                <span><?= $item['email'] ?></span>
                            </div>
                            <!--begin::User details-->
                        </td>
                        <td class="fw-bold text-gray-900">
                            <a href="<?= base_url('pengaduan-masuk/riwayat/detail/' . $item['kode']) ?>" class="text-gray-800 text-hover-primary mb-1"><?= $item['kode'] ?></a>
                        </td>
                        <td><?= $item['judul'] ?></td>
                        <td>
                            <span class="badge badge-light-<?= $item['warna'] ?> fw-bolder"><?= $item['label'] ?></span>
                        </td>
                        <td>
                            <span
                                class="badge badge-light-<?= COLOR[$item['wilayah_id'] % count(COLOR)] ?> fw-bolder"><?= $item['nama_wilayah'] ?></span>
                        </td>
                        <td><?= date('d M Y', strtotime($item['created_at'])) ?></td>
                        <td><?= date('d M Y', strtotime($item['updated_at'])) ?></td>

                        <td class="text-end">
                            <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                               data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                            <!--begin::Menu-->
                            <div
                                class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="<?= base_url('pengaduan-masuk/riwayat/detail/' . $item['kode']) ?>"
                                       class="menu-link px-3">Detail</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a class="menu-link px-3"
                                       data-bs-toggle="modal"
                                       data-bs-target="#kt_modal_update_status_<?= $item['kode'] ?>">
                                        Ubah Status
                                    </a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->

<?php foreach ($pengaduan as $item) : ?>
    <!--begin::Modal - Update menus-->
    <div class="modal fade" id="kt_modal_update_status_<?= $item['kode'] ?>" tabindex="-1" aria-hidden="true">
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
                    <form id="kt_modal_update_status_<?= $item['kode'] ?>"
                          action="<?= base_url('pengaduan-masuk/update') ?>" method="post">
                        <input type="hidden" name="kode" value="<?= $item['kode'] ?>">
                        <input type="hidden" name="wilayah_id" value="<?= $item['wilayah_id'] ?>">

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
                                    data-dropdown-parent="#kt_modal_update_status_<?= $item['kode'] ?>"
                                    data-allow-clear="true">
                                <option></option>
                                <?php foreach ($status as $s) : ?>
                                    <option
                                        value="<?= $s['id'] ?>" <?= $item['status_id'] == $s['id'] ? 'selected' : '' ?>><?= $s['label'] . ' | ' . $s['deskripsi'] ?></option>
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
                                <textarea class="form-control form-control-solid" rows="3" name="komentar"
                                          placeholder="Tanggapan"><?= $item['komentar'] ?></textarea>
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
<?php endforeach; ?>
<?= $this->endSection(); ?>