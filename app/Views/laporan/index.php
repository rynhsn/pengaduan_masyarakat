<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>


    <!--begin::Card-->
    <form class="card mb-5" action="<?= base_url('laporan') ?>">
        <!--begin::Card body-->
        <div class="card-body py-4">
            <div class="row">
                <?php if (hasActionAccess('create', user_id())): ?>
                    <div class="col">
                        <button type="button" class="btn btn-primary" data-bs-target="#tambahLaporan"
                                data-bs-toggle="modal">
                            <i class="ki-duotone ki-plus-square fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                            Buat Laporan
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!--end::Card body-->
    </form>

<?php if (session('message')): ?>
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

<?php if (session('error')): ?>
    <!--begin::Notice-->
    <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
        <!--begin::Icon-->
        <i class="ki-duotone ki-information fs-2tx text-warning me-4">
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

    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-4">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <input type="text" data-kt-filter="search"
                           class="form-control form-control-solid w-250px ps-14"
                           placeholder="Cari .."/>
                </div>
                <!--end::Search-->
                <!--begin::Export buttons-->
                <div id="kt_datatable_example_1_export" class="d-none"></div>
                <!--end::Export buttons-->
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
                        <form action="<?= base_url('laporan') ?>" method="get">
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
                                <label class="form-label fs-6 fw-semibold">Tanggal:</label>
                                <input class="form-control form-control-solid ps-12" name="date" placeholder="Pilih tanggal" value="<?= date('Y-m-d') ?>" id="kt_datepicker_1"/>
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
                        </form>
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
            <table class="table align-middle gs-0 gy-4" id="kt_datatable_siswa">
                <thead>
                <tr class="fw-bold text-muted bg-light">
                    <th class="ps-4 min-w-50px rounded-start min-w-100px">Periode</th>
                    <th class="min-w-100px">Keterangan</th>
                    <th class="min-w-50px">Dibuat</th>
                    <th class="min-w-50px">Diperbarui</th>
                    <th class="min-w-125px text-end rounded-end"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($laporan as $item): ?>
                    <tr>
<!--                        <td class="ps-4 fw-bold">--><?php //= BULAN[$item['bulan']] . ' ' . $item['tahun'] ?><!--</td>-->
                        <td class="ps-4 fw-bold"><?= date('d M Y', strtotime($item['tanggal_awal'])) . ' - ' . date('d M Y', strtotime($item['tanggal_akhir'])) ?></td>
                        <td class="fw-bold"><?= $item['keterangan'] ?></td>
                        <td class="fw-bold"><?= date('d M Y', strtotime($item['created_at'])) ?></td>
                        <td class="fw-bold"><?= date('d M Y', strtotime($item['updated_at'])) ?></td>
                        <td class="text-end">
                            <a href="<?= base_url('laporan/detail/' . $item['id']) ?>"
                               class="btn btn-icon btn-active-color-warning btn-sm me-1" title="Detail">
                                <i class="ki-duotone ki-eye fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </a>
                            <?php if (hasActionAccess('write', user_id())): ?>
                                <a href="<?= base_url('laporan/drop/'.$item['id']) ?>"
                                        class="btn btn-icon btn-active-color-primary btn-sm me-1"
                                        title="Hapus" onclick="return confirm('Laporan akan dihapus, anda yakin?')">
                                    <i class="ki-duotone ki-trash fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                </a>
                            <?php endif; ?>
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


    <div class="modal fade" id="tambahLaporan" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <?= form_open('/laporan/create'); ?>
                <?= csrf_field(); ?>
                <?= form_hidden('_method', 'POST'); ?>
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2>Buat laporan</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body py-10 px-lg-17">
                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-5 fv-row">
<!--                        <div class="row mb-3">-->
<!--                            <label for="periode" class="col-sm-3 col-form-label">Bulan</label>-->
<!--                            <div class="col-sm-9">-->
<!--                                <select class="form-select form-select-solid" name="bulan" required>-->
<!--                                    <option value="">Pilih Bulan</option>-->
<!--                                    --><?php //foreach ($bulan as $k): ?>
<!--                                        <option value="--><?php //= $k ?><!--">--><?php //= BULAN[$k] ?><!--</option>-->
<!--                                    --><?php //endforeach; ?>
<!--                                </select>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="row mb-3">-->
<!--                            <label for="periode" class="col-sm-3 col-form-label">Tahun</label>-->
<!--                            <div class="col-sm-9">-->
<!--                                <select class="form-select form-select-solid" name="tahun" required>-->
<!--                                    <option value="">Pilih Tahun</option>-->
<!--                                    --><?php //foreach($tahun as $i): ?>
<!--                                        <option value="--><?php //= $i ?><!--">--><?php //= $i ?><!--</option>-->
<!--                                    --><?php //endforeach; ?>
<!--                                </select>-->
<!--                            </div>-->
<!--                        </div>-->
                        <div class="row mb-3">
                            <label for="periode" class="col-sm-3 col-form-label">Periode</label>
                            <div class="col-sm-9">
                                <input class="form-control form-control-solid" placeholder="Pick date" id="kt_daterangepicker" name="periode" required/>
                            </div>
                        </div>
                        <div class="row">
                            <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                            <div class="col-sm-9">
                                <!--                                textarea-->
                                <textarea class="form-control form-control-solid" name="keterangan" id="keterangan" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Modal body-->
                <!--begin::Modal footer-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="reset" data-bs-dismiss="modal" class="btn btn-light me-3">Batal</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">Simpan</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                    </button>
                    <!--end::Button-->
                </div>
                <!--end::Modal footer-->
                <?= form_close(); ?>
                <!--end::Form-->
            </div>
        </div>
    </div>

<?= $this->endSection(); ?>