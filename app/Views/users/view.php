<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>
<!--begin::Layout-->
<div class="d-flex flex-column flex-lg-row">
    <!--begin::Sidebar-->
    <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">

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


        <?php if (session('errors')) : ?>
            <!--begin::Notice-->
            <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                <!--begin::Icon-->
                <i class="ki-duotone ki-cross-square fs-2tx text-warning me-4">
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
                        <div class="fs-6 text-gray-700">
                            <ul>
                                <?php foreach (session('errors') as $error) : ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Notice-->
        <?php endif; ?>

        <!--begin::Card-->
        <div class="card mb-5 mb-xl-8">
            <!--begin::Card body-->
            <div class="card-body">
                <!--begin::Summary-->
                <!--begin::User Info-->
                <div class="d-flex flex-center flex-column py-5">
                    <!--begin::Avatar-->
                    <div class="symbol symbol-100px symbol-circle mb-7">
                        <img src="<?= base_url() ?>media/avatars/<?= $user->profile['foto_profil'] ?>" alt="image"/>
                    </div>
                    <!--end::Avatar-->
                    <!--begin::Name-->
                    <p class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3"><?= $user->profile['nama_lengkap'] ?></p>
                    <!--end::Name-->
                    <!--begin::Position-->
                    <div class="mb-3">
                        <?php foreach ($user->groups as $group) : ?>
                            <span
                                class="badge badge-lg badge-light-<?= COLOR[$group['group_id'] % count(COLOR)] ?> d-inline"><?= $group['name'] ?></span>
                            <!--begin::Badge-->
                        <?php endforeach; ?>
                    </div>
                    <!--end::Position-->
                    <!--begin::Position-->
                    <div class="mb-9">
                        <span
                            class="badge badge-lg badge-light-<?= IS_VALID_COLOR[$user->active] ?> d-inline"><?= $user->active ? 'Aktif' : 'Tidak Aktif' ?></span>
                    </div>
                    <!--end::Position-->
                </div>
                <!--end::User Info-->
                <!--end::Summary-->
                <!--begin::Details toggle-->
                <div class="d-flex flex-stack fs-4 py-3">
                    <div class="fw-bold rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details"
                         role="button" aria-expanded="false" aria-controls="kt_user_view_details">Detail
                        <span class="ms-2 rotate-180">
                            <i class="ki-outline ki-down fs-3"></i>
                        </span>
                    </div>

                    <?php if (hasActionAccess('write', user_id())): ?>
                        <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Perbarui profil pengguna">
                        <a href="#" class="btn btn-sm btn-light-primary" data-bs-toggle="modal"
                           data-bs-target="#kt_modal_update_details">Perbarui</a>
                    </span>
                    <?php endif; ?>
                </div>
                <!--end::Details toggle-->
                <div class="separator"></div>
                <!--begin::Details content-->
                <div id="kt_user_view_details" class="collapse show">
                    <div class="pb-5 fs-6">
                        <!--begin::Details item-->
                        <div class="fw-bold mt-5">NIK</div>
                        <div class="text-gray-600"><?= $user->profile['nik'] ?></div>
                        <!--begin::Details item-->
                        <!--begin::Details item-->
                        <div class="fw-bold mt-5">Nama Lengkap</div>
                        <div class="text-gray-600"><?= $user->profile['nama_lengkap'] ?></div>
                        <!--begin::Details item-->
                        <!--begin::Details item-->
                        <div class="fw-bold mt-5">Username</div>
                        <div class="text-gray-600"><?= $user->username ?></div>
                        <!--begin::Details item-->
                        <!--begin::Details item-->
                        <div class="fw-bold mt-5">Email</div>
                        <div class="text-gray-600">
                            <a href="#" class="text-gray-600 text-hover-primary"><?= $user->email ?></a>
                        </div>
                        <!--begin::Details item-->
                        <!--begin::Details item-->
                        <div class="fw-bold mt-5">Jenis Kelamin</div>
                        <div class="text-gray-600"><?= $user->profile['jenis_kelamin'] ?></div>
                        <!--begin::Details item-->
                        <!--begin::Details item-->
                        <div class="fw-bold mt-5">Tanggal Lahir</div>
                        <div
                            class="text-gray-600"><?= date('d M Y', strtotime($user->profile['tanggal_lahir'])) ?></div>
                        <!--begin::Details item-->
                        <!--begin::Details item-->
                        <div class="fw-bold mt-5">No. Telp</div>
                        <div class="text-gray-600"><?= $user->profile['telepon'] ?></div>
                        <!--begin::Details item-->
                        <!--begin::Details item-->
                        <div class="fw-bold mt-5">Alamat</div>
                        <div class="text-gray-600"><?= $user->profile['alamat'] ?></div>
                        <!--begin::Details item-->
                        <!--begin::Details item-->
                        <div class="fw-bold mt-5">Bergabung</div>
                        <div class="text-gray-600"><?= date('d M Y', strtotime($user->created_at)) ?></div>
                        <!--begin::Details item-->
                    </div>
                </div>
                <!--end::Details content-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Sidebar-->
    <!--begin::Content-->
    <div class="flex-lg-row-fluid ms-lg-15">
        <!--begin:::Tabs-->
        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
            <?php if (hasActionAccess('write', user_id())): ?>
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4 active" data-kt-countup-tabs="true" data-bs-toggle="tab"
                       href="#kt_user_view_overview_security">Keamanan</a>
                </li>
                <!--end:::Tab item-->
            <?php endif; ?>
        </ul>
        <!--end:::Tabs-->
        <!--begin:::Tab content-->
        <div class="tab-content" id="myTabContent">
            <!--begin:::Tab pane-->
            <div class="tab-pane fade active show" id="kt_user_view_overview_security" role="tabpanel">
                <!--begin::Card-->
                <div class="card pt-4 mb-6 mb-xl-9">
                    <!--begin::Card header-->
                    <div class="card-header border-0">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>Akun Pengguna</h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0 pb-5">
                        <!--begin::Table wrapper-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed gy-5" id="kt_table_users_login_session">
                                <tbody class="fs-6 fw-semibold text-gray-600">
                                <tr>
                                    <td>Email</td>
                                    <td><?= $user->email ?></td>
                                    <td class="text-end">
                                        <button type="button"
                                                class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto"
                                                data-bs-toggle="modal" data-bs-target="#kt_modal_update_email">
                                            <i class="ki-outline ki-pencil fs-3"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td>******</td>
                                    <td class="text-end">
                                        <button type="button"
                                                class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto"
                                                data-bs-toggle="modal" data-bs-target="#kt_modal_update_password">
                                            <i class="ki-outline ki-pencil fs-3"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Role</td>
                                    <td><?= $user->groups[0]['name'] ?></td>
                                    <td class="text-end">
                                        <button type="button"
                                                class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto<?= $user->id == user_id() ? ' disabled' : '' ?>"
                                                data-bs-toggle="modal" data-bs-target="#kt_modal_update_role">
                                            <i class="ki-outline ki-pencil fs-3"></i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table wrapper-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end:::Tab pane-->
        </div>
        <!--end:::Tab content-->
    </div>
    <!--end::Content-->
</div>
<!--end::Layout-->
<!--begin::Modals-->
<!--begin::Modal - Update user details-->
<div class="modal fade" id="kt_modal_update_details" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form" action="<?= base_url('users/update-profile/'.$user->id) ?>" id="kt_modal_update_user_form" enctype="multipart/form-data" method="post">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_update_user_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">Perbarui Profil</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body py-10 px-lg-17">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_user_scroll"
                         data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                         data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_user_header"
                         data-kt-scroll-wrappers="#kt_modal_update_user_scroll" data-kt-scroll-offset="300px">
                        <!--begin::User toggle-->
                        <div class="fw-bolder fs-3 rotate collapsible mb-7" data-bs-toggle="collapse"
                             href="#kt_modal_update_user_user_info" role="button" aria-expanded="false"
                             aria-controls="kt_modal_update_user_user_info">Profil Pengguna
                            <span class="ms-2 rotate-180">
                                <i class="ki-outline ki-down fs-3"></i>
                            </span>
                        </div>
                        <!--end::User toggle-->
                        <!--begin::User form-->
                        <div id="kt_modal_update_user_user_info" class="collapse show">
                            <!--begin::Input group-->
                            <div class="mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold mb-2">
                                    <span>Perbarui Foto Profil</span>
                                    <span class="ms-1" data-bs-toggle="tooltip"
                                          title="Allowed file types: png, jpg, jpeg.">

                                </label>
                                <!--end::Label-->
                                <!--begin::Image input wrapper-->
                                <div class="mt-1">
                                    <!--begin::Image placeholder-->
                                    <style>.image-input-placeholder {
                                            background-image: url('<?= base_url() ?>media/svg/avatars/blank.svg');
                                        }

                                        [data-bs-theme="dark"] .image-input-placeholder {
                                            background-image: url('<?= base_url() ?>media/svg/avatars/blank-dark.svg');
                                        }</style>
                                    <!--end::Image placeholder-->
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline image-input-placeholder"
                                         data-kt-image-input="true">
                                        <!--begin::Preview existing avatar-->
                                        <div class="image-input-wrapper w-125px h-125px"
                                             style="background-image: url(<?= base_url() ?>media/avatars/<?= $user->profile['foto_profil'] ?>"></div>
                                        <!--end::Preview existing avatar-->
                                        <!--begin::Edit-->
                                        <label
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                            title="Change avatar">
                                            <i class="ki-outline ki-pencil fs-7"></i>
                                            <!--begin::Inputs-->
                                            <input type="file" name="foto_profil" accept=".png, .jpg, .jpeg"/>
                                            <input type="hidden" name="avatar_remove"/>
                                            <input type="text" name="foto_lama" value="<?= $user->profile['foto_profil'] ?>" hidden/>
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Edit-->
                                        <!--begin::Cancel-->
                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                            title="Batal">
																				<i class="ki-outline ki-cross fs-2"></i>
																			</span>
                                        <!--end::Cancel-->
                                        <!--begin::Remove-->
                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                            title="Hapus foto">
                                            <i class="ki-outline ki-cross fs-2"></i>
                                        </span>
                                        <!--end::Remove-->
                                    </div>
                                    <!--end::Image input-->
                                </div>
                                <!--end::Image input wrapper-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold mb-2">NIK</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="number" class="form-control form-control-solid" name="nik" value="<?= $user->profile['nik'] ?>" required/>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold mb-2">Nama Lengkap</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid" name="nama_lengkap" value="<?= $user->profile['nama_lengkap'] ?>" required/>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row g-9 mb-7">
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold mb-2">Jenis Kelamin</label>
                                    <!--end::Label-->
                                    <!--begin::select gender-->
                                    <select class="form-select form-select-solid" name="jenis_kelamin" required>
                                        <option
                                            value="Laki-laki" <?= $user->profile['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>
                                            Laki-laki
                                        </option>
                                        <option
                                            value="Perempuan" <?= $user->profile['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>
                                            Perempuan
                                        </option>
                                        <!--end::Input-->
                                    </select>
                                </div>
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold mb-2">Tanggal Lahir</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" id="kt_datepicker_flat" class="form-control form-control-solid" placeholder="" name="tanggal_lahir" value="<?= $user->profile['tanggal_lahir'] ?>" required/>
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::User form-->
                        <!--begin::Address toggle-->
                        <div class="fw-bolder fs-3 rotate collapsible mb-7" data-bs-toggle="collapse"
                             href="#kt_modal_update_user_address" role="button" aria-expanded="false"
                             aria-controls="kt_modal_update_user_address">Kontak
                            <span class="ms-2 rotate-180">
																<i class="ki-outline ki-down fs-3"></i>
															</span></div>
                        <!--end::Address toggle-->
                        <!--begin::Address form-->
                        <div id="kt_modal_update_user_address" class="collapse show">
                            <div class="row g-9 mb-7">
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold mb-2">Alamat Lengkap</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <textarea class="form-control form-control-solid" placeholder="" name="alamat" required><?= $user->profile['alamat'] ?></textarea>
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold mb-2">No. Telp</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control form-control-solid" name="telepon"
                                           value="<?= $user->profile['telepon'] ?>" required/>
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Address form-->
                    </div>
                    <!--end::Scroll-->
                </div>
                <!--end::Modal body-->
                <!--begin::Modal footer-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">Submit</span>
                    </button>
                    <!--end::Button-->
                </div>
                <!--end::Modal footer-->
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
<!--end::Modal - Update user details-->
<!--begin::Modal - Update email-->
<div class="modal fade" id="kt_modal_update_email" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Update Email Address</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form id="kt_modal_update_email_form" class="form" method="post"
                      action="<?= base_url('users/update-email/' . $user->id) ?>">
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Email Address</span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control form-control-solid" name="email" type="email"
                               value="<?= $user->email ?>"/>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Submit</span>
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
<!--end::Modal - Update email-->
<!--begin::Modal - Update password-->
<div class="modal fade" id="kt_modal_update_password" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Update Password</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form id="kt_modal_update_password_form" class="form"
                      action="<?= base_url('users/update-password/' . $user->id) ?>" method="post">

                    <!--begin::Input group-->
                    <div class="mb-10 fv-row" data-kt-password-meter="true">
                        <!--begin::Wrapper-->
                        <div class="mb-1">
                            <!--begin::Label-->
                            <label class="form-label fw-semibold fs-6 mb-2">New Password</label>
                            <!--end::Label-->
                            <!--begin::Input wrapper-->
                            <div class="position-relative mb-3">
                                <input class="form-control form-control-lg form-control-solid" type="password"
                                       placeholder="" name="new_password" autocomplete="off"/>
                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                      data-kt-password-meter-control="visibility">
																		<i class="ki-outline ki-eye-slash fs-1"></i>
																		<i class="ki-outline ki-eye d-none fs-1"></i>
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
                        <div class="text-muted">Use 8 or more characters with a mix of letters, numbers & symbols.</div>
                        <!--end::Hint-->
                    </div>
                    <!--end::Input group=-->
                    <!--begin::Input group=-->
                    <div class="fv-row mb-10">
                        <label class="form-label fw-semibold fs-6 mb-2">Confirm New Password</label>
                        <input class="form-control form-control-lg form-control-solid" type="password" placeholder=""
                               name="confirm_password" autocomplete="off"/>
                    </div>
                    <!--end::Input group=-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Submit</span>
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
<!--end::Modal - Update password-->
<!--begin::Modal - Update role-->
<div class="modal fade" id="kt_modal_update_role" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Update User Role</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form id="kt_modal_update_role_form" action="<?= base_url('users/update-role/' . $user->id) ?>"
                      method="post">
                    <!--begin::Notice-->
                    <!--begin::Notice-->
                    <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-9 p-6">
                        <!--begin::Icon-->
                        <i class="ki-outline ki-information fs-2tx text-primary me-4"></i>
                        <!--end::Icon-->
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack flex-grow-1">
                            <!--begin::Content-->
                            <div class="fw-semibold">
                                <div class="fs-6 text-gray-700">Please note that reducing a user role rank, that user
                                    will lose all priviledges that was assigned to the previous role.
                                </div>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Notice-->
                    <!--end::Notice-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mb-5">
                            <span class="required">Select a user role</span>
                        </label>
                        <!--end::Label-->

                        <?php foreach ($groups as $group) : ?>
                            <!--begin::Input row-->
                            <div class="d-flex">
                                <!--begin::Radio-->
                                <div class="form-check form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input me-3" name="role" type="radio"
                                           value="<?= $group->id ?>" <?= $user->groups[0]['name'] == $group->name ? 'checked' : '' ?> />
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <label class="form-check-label" for="kt_modal_update_role_option_0">
                                        <div class="fw-bold text-gray-800"><?= $group->name ?></div>
                                        <div class="text-gray-600"><?= $group->description ?></div>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Radio-->
                            </div>
                            <!--end::Input row-->
                            <div class='separator separator-dashed my-5'></div>
                        <?php endforeach; ?>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Submit</span>
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
<!--end::Modal - Update role-->
<!--end::Modals-->

<?= $this->endSection() ?>
