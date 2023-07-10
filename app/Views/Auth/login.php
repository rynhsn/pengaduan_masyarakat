<?= $this->extend($config->viewLayout) ?>
<?= $this->section('content') ?>
        <!--begin::Body-->
        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
            <!--begin::Form-->
            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                <!--begin::Wrapper-->
                <div class="w-lg-500px p-10">
                    <!--begin::Form-->
                    <form class="form w-350px" action="<?= url_to('login') ?>" method="post">
                        <?= csrf_field() ?>
                        <!--begin::Heading-->
                        <div class="text-center mb-11">
                            <!--begin::Title-->
                            <h1 class="text-dark fw-bolder mb-3"><?= lang('Auth.loginTitle') ?></h1>
                            <!--end::Title-->

                            <?= view('App\Views\Auth\_message_block') ?>

                        </div>
                        <!--begin::Heading-->

                        <?php if ($config->validFields === ['email']): ?>
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <!--begin::Email-->
                                <input type="email" placeholder="<?= lang('Auth.email') ?>" name="login"
                                       autocomplete="off"
                                       class="form-control bg-transparent <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>"/>
                                <!--end::Email-->
                                <div class="invalid-feedback">
                                    <?= session('errors.login') ?>
                                </div>
                            </div>
                            <!--end::Input group=-->
                        <?php else: ?>
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <!--begin::Email-->
                                <input type="text" placeholder="<?= lang('Auth.emailOrUsername') ?>" name="login"
                                       autocomplete="off"
                                       class="form-control bg-transparent <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>"/>
                                <!--end::Email-->
                                <div class="invalid-feedback">
                                    <?= session('errors.login') ?>
                                </div>
                            </div>
                            <!--end::Input group=-->
                        <?php endif; ?>
                        <!--begin::Input group=-->
                        <div class="fv-row mb-8">
                            <!--begin::Password-->
                            <input type="password" placeholder="<?= lang('Auth.password') ?>" name="password"
                                   autocomplete="off"
                                   class="form-control bg-transparent  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>"/>
                            <div class="invalid-feedback">
                                <?= session('errors.password') ?>
                            </div>
                            <!--end::Password-->
                        </div>
                        <!--end::Input group=-->
                        <div class="fv-row mb-8 fv-plugins-icon-container fv-plugins-bootstrap5-row-valid">
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox"
                                       name="remember" <?php if (old('remember')) : ?> checked <?php endif ?>>
                                <span
                                    class="form-check-label fw-semibold text-gray-700 fs-base ms-1"><?= lang('Auth.rememberMe') ?></span>
                            </label>
                        </div>
                        <?php if ($config->activeResetter): ?>
                            <!--begin::Actions-->
                            <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                <div></div>
                                <!--begin::Link-->
                                <a href="<?= url_to('forgot') ?>"
                                   class="link-primary"><?= lang('Auth.forgotYourPassword') ?></a>
                                <!--end::Link-->
                            </div>
                            <!--end::Actions-->
                        <?php endif; ?>
                        <!--begin::Submit button-->
                        <div class="d-grid mb-10">
                            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                <!--begin::Indicator label-->
                                <span class="indicator-label"><?= lang('Auth.loginAction') ?></span>
                                <!--end::Indicator label-->
                                <!--begin::Indicator progress-->
                                <span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                <!--end::Indicator progress-->
                            </button>
                        </div>
                        <!--end::Submit button-->

                        <?php if ($config->allowRegistration) : ?>
                            <!--begin::Sign up-->
                            <div class="text-gray-500 text-center fw-semibold fs-6">
                                <a href="<?= url_to('register') ?>"
                                   class="link-primary"><?= lang('Auth.needAnAccount') ?></a>
                            </div>
                            <!--end::Sign up-->
                        <?php endif; ?>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Form-->
        </div>
        <!--end::Body-->
<?= $this->endSection() ?>