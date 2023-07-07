<?= $this->extend('auth/layouts/index') ?>
<?= $this->section('content') ?>
    <!--begin::Body-->
    <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
        <!--begin::Form-->
        <div class="d-flex flex-center flex-column flex-lg-row-fluid">
            <!--begin::Wrapper-->
            <div class="w-lg-500px p-10">
                <!--begin::Form-->
                <form class="form w-350px" action="<?= url_to('register') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <!--begin::Heading-->
                    <div class="text-center mb-11">
                        <!--begin::Title-->
                        <h1 class="text-dark fw-bolder mb-3"><?= lang('Auth.register') ?></h1>
                        <!--end::Title-->

                        <?php //= view('App\Views\Auth\_message_block') ?>

                    </div>
                    <!--begin::Heading-->
                    <!--begin::Input group=-->
                    <div class="fv-row mb-8">
                        <!--begin::NIK-->
                        <input type="number" placeholder="Masukkan 16 angka NIK" name="nik" minlength="16" maxlength="16"
                               class="form-control bg-transparent <?php if (session('errors.nik')) : ?>is-invalid<?php endif ?>"
                               value="<?= old('nik') ?>" required/>
                        <div class="invalid-feedback">
                            <?= session('errors.nik') ?>
                        </div>
                        <!--end::NIK-->
                    </div>
                    <!--end::Input group=-->

                    <!--begin::Input group=-->
                    <div class="fv-row mb-8">
                        <!--begin::Nama Lengkap-->
                        <input type="text" placeholder="Masukkan nama lengkap" name="nama_lengkap"
                               class="form-control bg-transparent <?php if (session('errors.nama_lengkap')) : ?>is-invalid<?php endif ?>"
                               value="<?= old('nama_lengkap') ?>" required/>
                        <div class="invalid-feedback">
                            <?= session('errors.nama_lengkap') ?>
                        </div>
                        <!--end::Nama Lengkap-->
                    </div>
                    <!--end::Input group=-->

                    <!--begin::Input group=-->
                    <div class="fv-row mb-8">
                        <!--begin::Alamat Lengkap-->
                        <textarea placeholder="Masukkan alamat lengkap" name="alamat" class="form-control bg-transparent <?php if (session('errors.alamat')) : ?>is-invalid<?php endif ?>" required><?= old('alamat') ?><?= old('alamat') ?></textarea>
                        <div class="invalid-feedback">
                            <?= session('errors.alamat') ?>
                        </div>
                        <!--end::Alamat Lengkap-->
                    </div>
                    <!--end::Input group=-->

                    <!--begin::Input group=-->
                    <div class="fv-row mb-8">
                        <!--begin::No. Telepon-->
                        <input type="number" placeholder="Nomor Telepon" name="telepon" maxlength="13" minlength="10"
                               class="form-control bg-transparent <?php if (session('errors.telepon')) : ?>is-invalid<?php endif ?>"
                               value="<?= old('telepon') ?>" required/>
                        <div class="invalid-feedback">
                            <?= session('errors.telepon') ?>
                        </div>
                        <!--end::No. Telepon-->
                    </div>
                    <!--end::Input group=-->

                    <!--begin::Input group=-->
                    <div class="fv-row mb-8">
                        <select name="jenis_kelamin" class="form-select bg-transparent <?php if (session('errors.jenis_kelamin')) : ?>is-invalid<?php endif ?>" required>
                            <option value="">Pilih jenis kelamin</option>
                            <option value="Laki-laki" <?php if (old('jenis_kelamin') === 'Laki-laki') : ?>selected<?php endif ?>>Laki-laki</option>
                            <option value="Perempuan" <?php if (old('jenis_kelamin') === 'Perempuan') : ?>selected<?php endif ?>>Perempuan</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= session('errors.jenis_kelamin') ?>
                        </div>
                    </div>
                    <!--end::Input group=-->

                    <!--begin::Input group=-->
                    <div class="fv-row mb-8">
                        <!--begin::tanggal lahir-->
                        <input type="text" id="kt_datepicker_flat" placeholder="Tanggal Lahir" name="tanggal_lahir" aria-describedby="tglLahirHelp" class="form-control bg-transparent<?php if (session('errors.tanggal_lahir')) : ?> is-invalid<?php endif ?>" value="<?= old('tanggal_lahir') ?>" required/>
                        <div class="invalid-feedback">
                            <?= session('errors.tanggal_lahir') ?>
                        </div>
                        <div id="tglLahirHelp" class="text-muted">Tanggal Lahir</div>
                        <!--end::tanggal lahir-->
                    </div>
                    <!--begin::Input group=-->

                    <!--begin::Input group=-->
                    <div class="fv-row mb-8">
                        <!--begin::Foto KTP-->
                        <input type="file" name="foto_ktp" aria-describedby="ktpHelp"
                               class="form-control bg-transparent <?php if (session('errors.foto_ktp')) : ?>is-invalid<?php endif ?>" accept=".png, .jpg, .jpeg" value="<?= old('foto_ktp') ?>" required/>
                        <div class="invalid-feedback">
                            <?= session('errors.foto_ktp') ?>
                        </div>
                        <div id="ktpHelp" class="text-muted">Harap masukkan foto KTP</div>
                        <!--end::Foto KTP-->
                    </div>
                    <!--end::Input group=-->

                    <!--begin::Input group=-->
                    <div class="fv-row mb-8">
                        <!--begin::Email-->
                        <input type="email" placeholder="<?= lang('Auth.email') ?>" name="email"
                               aria-describedby="emailHelp"
                               class="form-control bg-transparent <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>"
                               value="<?= old('email') ?>"/>
                        <div class="invalid-feedback">
                            <?= session('errors.email') ?>
                        </div>
                        <div id="emailHelp" class="text-muted"><?= lang('Auth.weNeverShare') ?></div>
                        <!--end::Email-->
                    </div>
                    <!--begin::Input group=-->
                    <div class="fv-row mb-8">
                        <!--begin::Email-->
                        <input type="text" placeholder="<?= lang('Auth.username') ?>" name="username"
                               class="form-control bg-transparent <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>"
                               value="<?= old('username') ?>"/>
                        <div class="invalid-feedback">
                            <?= session('errors.username') ?>
                        </div>
                        <!--end::Email-->
                    </div>
                    <!--begin::Input group-->
                    <div class="fv-row mb-8" data-kt-password-meter="true">
                        <!--begin::Wrapper-->
                        <div class="mb-1">
                            <!--begin::Input wrapper-->
                            <div class="position-relative mb-3">
                                <input
                                    class="form-control bg-transparent <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>"
                                    type="password" placeholder="<?= lang('Auth.password') ?>" name="password"
                                    autocomplete="off"/>
                                <div class="invalid-feedback">
                                    <?= session('errors.password') ?>
                                </div>
                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                      data-kt-password-meter-control="visibility">
												<i class="ki-outline ki-eye-slash fs-2"></i>
												<i class="ki-outline ki-eye fs-2 d-none"></i>
											</span>
                            </div>
                            <!--end::Input wrapper-->
                            <!--begin::Meter-->
                            <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                            </div>
                            <!--end::Meter-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Hint-->
                        <div class="text-muted">Gunakan 8 karakter atau lebih dengan gabungan huruf, angka dan simbol.
                        </div>
                        <!--end::Hint-->
                    </div>
                    <!--end::Input group=-->
                    <!--end::Input group=-->
                    <div class="fv-row mb-8">
                        <!--begin::Repeat Password-->
                        <input placeholder="<?= lang('Auth.repeatPassword') ?>" name="pass_confirm" type="password"
                               autocomplete="off"
                               class="form-control bg-transparent <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>"/>
                        <!--end::Repeat Password-->
                    </div>
                    <!--end::Input group=-->
                    <!--begin::Submit button-->
                    <div class="d-grid mb-10">
                        <button type="submit" class="btn btn-primary">
                            <!--begin::Indicator label-->
                            <span class="indicator-label"><?= lang('Auth.register') ?></span>
                            <!--end::Indicator label-->
                        </button>
                    </div>
                    <!--end::Submit button-->
                    <!--begin::Sign up-->
                    <div class="text-gray-500 text-center fw-semibold fs-6"><?= lang('Auth.alreadyRegistered') ?>
                        <a href="<?= url_to('login') ?>" class="link-primary fw-semibold"><?= lang('Auth.signIn') ?></a>
                    </div>
                    <!--end::Sign up-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Form-->
    </div>
    <!--end::Body-->
<?= $this->endSection() ?>