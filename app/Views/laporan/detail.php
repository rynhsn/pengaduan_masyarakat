<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>

    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-siswa-table-toolbar="base">
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <a href="<?= base_url('laporan/cetak/' . $laporan['id']) ?>"
                           class="btn btn-light-info" target="_blank">
                            <i class="ki-duotone ki-file-down fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                            Unduh
                        </a>
                    </div>
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <div class="row">
                <div class="col">
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Periode</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" class="form-control form-control-lg form-control-transparent"
                                   value="<?= BULAN[$laporan['bulan']] . ' ' . $laporan['tahun']; ?>" disabled/>
                        </div>

                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Keterangan</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <textarea class="form-control form-control-lg form-control-transparent" disabled><?= $laporan['keterangan'] ?></textarea>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Dibuat</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" class="form-control form-control-lg form-control-transparent"
                                   value="<?= date('d M Y', strtotime($laporan['created_at']))?>" disabled/>
                        </div>

                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                </div>
            </div>

            <h3 class="fw-bold m-0">Detail</h3>
            <hr class="text-muted">
            <!--begin::Table-->
            <table class="table align-middle gs-0 gy-4" id="kt_datatable_siswa">
                <thead>
                <tr class="fw-bold text-muted bg-light">
                    <th class="ps-4 min-w-100px rounded-start">Kode Pengaduan</th>
                    <th class="min-w-75px">Oleh (NIK)</th>
                    <th class="min-w-100px">Tanggal</th>
                    <th class="min-w-200px">Status</th>
                </tr>
                </thead>
                <tbody>
                <!--                        --><?php //dd($detail)?>
                <?php foreach ($detail as $item): ?>
                    <tr>
                        <td class="ps-4 fw-bold">
                            <?= $item['pengaduan_kode'] ?>
                        </td>
                        <td class="fw-bold"><?= $item['nik'] ?></td>
                        <td class="fw-bold"><?= date('d M Y', strtotime($item['tanggal_buat'])) ?></td>
                        <td>
                            <span class="badge badge-light-<?= $item['warna'] ?>"><?= $item['label'] ?></span>
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

<?= $this->endSection(); ?>