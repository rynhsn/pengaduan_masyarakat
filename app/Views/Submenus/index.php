<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>
    <!--begin::Card-->
    <div class="card card-flush">
        <!--begin::Card header-->
        <div class="card-header mt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1 me-5">
                    <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                    <input type="text" data-kt-submenus-table-filter="search"
                           class="form-control form-control-solid w-250px ps-13" placeholder="Search Sub Menu"/>
                </div>
                <!--end::Search-->
            </div>
            <!--end::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <?php if (hasActionAccess('create', user_id())): ?>
                    <!--begin::Button-->
                    <button type="button" class="btn btn-light-primary" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_add_submenu">
                        <i class="ki-outline ki-plus-square fs-3"></i>Add Sub Menu
                    </button>
                    <!--end::Button-->
                <?php endif; ?>
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_submenus_table">
                <thead>
                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-125px">Sub Menu</th>
                    <th class="min-w-100px">Parent</th>
                    <th class="min-w-100px">Permission</th>
                    <th class="min-w-50px">Url</th>
                    <th class="min-w-50px">Active</th>
                    <th class="min-w-50px">Seq</th>
                    <th class="min-w-100px">Description</th>
                    <th class="min-w-100px">Created Date</th>
                    <?php if (hasActionAccess('write', user_id())): ?>
                        <th class="text-end min-w-100px">Actions</th>
                    <?php endif; ?>
                </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                <?php foreach ($submenus as $submenu) : ?>
                    <tr>
                        <td>
                            <i class="<?= $submenu['icon'] ?> fs-2"></i>
                            <span class="ms-1"><?= $submenu['sub_menu'] ?></span>
                        </td>
                        <td>
                                <span
                                    class="badge badge-light-<?= COLOR[$submenu['menu_id'] % count(COLOR)] ?> fs-7 m-1"><?= $submenu['menu'] ?></span>
                        </td>
                        <td>
                                <span
                                    class="badge badge-light-<?= COLOR[$submenu['permission_id'] % count(COLOR)] ?> fs-7 m-1"><?= $submenu['permission'] ?></span>
                        </td>
                        <td><a class="fw-semibold text-gray-600"
                               href="<?= base_url($submenu['url'] ?? '#') ?>"><?= $submenu['url'] ?? '#' ?></a></td>
                        <td>
                            <span
                                class="badge badge-light-success"><?= $submenu['is_active'] ? 'Active' : '' ?></span>
                            <span
                                class="badge badge-light-primary"><?= $submenu['has_notify'] ? 'Notify' : '' ?></span>
                        </td>
                        <td><?= $submenu['sequence'] ?></td>
                        <td><?= $submenu['description'] ?></td>
                        <td><?= date('d M Y', strtotime($submenu['created_at'])) ?></td>
                        <?php if (hasActionAccess('write', user_id())): ?>
                            <td class="text-end">
                                <button class="btn btn-icon btn-active-light-primary w-30px h-30px"
                                        data-bs-toggle="modal" data-bs-target="#kt_modal_update_submenu"
                                        data-submenu-id="<?= $submenu['id'] ?>">
                                    <i class="ki-outline ki-setting-3 fs-3"></i>
                                </button>
                                <button class="btn btn-icon btn-active-light-primary w-30px h-30px"
                                        data-kt-submenus-table-filter="delete_row"
                                        data-submenu-id="<?= $submenu['id'] ?>">
                                    <i class="ki-outline ki-trash fs-3"></i>
                                </button>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->

    <!--begin::Modals-->
    <!--begin::Modal - Add submenus-->
    <div class="modal fade" id="kt_modal_add_submenu" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">Add a Sub Menu</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-submenus-modal-action="close">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <!--begin::Form-->
                    <form id="kt_modal_add_submenu_form" class="form" action="#">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mb-2" for="sub_menu">
                                <span class="required">Sub Menu Name</span>
                                <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true"
                                      data-bs-content="Sub Menu names is required to be unique.">
                                    <i class="ki-outline ki-information fs-7"></i>
                                </span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control form-control-solid" placeholder="Enter a submenu name"
                                   name="sub_menu" id="sub_menu"/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mb-2" for="menu_id">
                                <span class="required">Parent</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select class="form-select form-select-solid" data-control="select2"
                                    data-placeholder="Select a menu"
                                    name="menu_id" id="menu_id"
                                    data-dropdown-parent="#kt_modal_add_submenu"
                                    data-allow-clear="true">
                                <option></option>
                                <?php foreach ($menus as $menu) : ?>
                                    <option value="<?= $menu['id'] ?>"><?= $menu['menu'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mb-2" for="permission_id">
                                <span class="required">Permission</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select class="form-select form-select-solid" data-control="select2"
                                    data-placeholder="Select a permision"
                                    name="permission_id" id="permission_id"
                                    data-dropdown-parent="#kt_modal_add_submenu"
                                    data-allow-clear="true">
                                <option></option>
                                <?php foreach ($permissions as $permission) : ?>
                                    <option value="<?= $permission->id ?>"><?= $permission->description ?></option>
                                <?php endforeach; ?>
                            </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span>Description</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control form-control-solid" placeholder="Enter a submenu description"
                                   name="description" id="description"/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Route to</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <div class="input-group input-group-solid">
                                <span class="input-group-text"><?= base_url() ?></span>
                                <input type="text" class="form-control form-control-solid"
                                       placeholder="Enter endpoint URL" aria-label="Sub Menu URL" name="url"
                                       id="url"/>
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row">
                            <div class="row">
                                <div class="col-lg mb-7">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Icon</span>
                                        <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover"
                                              data-bs-html="true"
                                              data-bs-content="Icon is required.">
                                            <i class="ki-outline ki-information fs-7"></i>
                                        </span>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <!--begin::Input group-->
                                    <div class="input-group input-group-solid">
                                        <input type="text" class="form-control form-control-solid"
                                               placeholder="Enter icon class name" aria-label="Sub Menu icon"
                                               name="icon" id="icon"/>
                                        <span class="input-group-text"><i id="preview_icon"></i></span>
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <div class="col-lg-4 mb-7   ">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Sequence</span>
                                        <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover"
                                              data-bs-html="true"
                                              data-bs-content="Route to endpoint is required to be unique or leave it with a hash sign if this is parent submenu.">
                                            <i class="ki-outline ki-information fs-7"></i>
                                        </span>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control form-control-solid"
                                           placeholder="Enter sequence of submenu"
                                           name="sequence" id="sequence"/>
                                    <!--end::Input-->
                                </div>
                            </div>

                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <div class="row">
                                <div class="col-lg-3 mb-2">
                                    <!--begin::Checkbox-->
                                    <label class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="" name="is_active"
                                               id="is_active"/>
                                        <span class="form-check-label">Set active</span>
                                    </label>
                                    <!--end::Checkbox-->
                                </div>
                                <div class="col-lg mb-2">
                                    <!--begin::Checkbox-->
                                    <label class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="" name="has_notify"
                                               id="has_notify"/>
                                        <span class="form-check-label">Set notify</span>
                                    </label>
                                    <!--end::Checkbox-->
                                </div>
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-kt-submenus-modal-action="cancel">
                                Discard
                            </button>
                            <button type="submit" class="btn btn-primary" data-kt-submenus-modal-action="submit">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span
                                        class="spinner-border spinner-border-sm align-middle ms-2"></span>
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
    <!--end::Modal - Add submenus-->
    <!--begin::Modal - Update submenus-->
    <div class="modal fade" id="kt_modal_update_submenu" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">Update Sub Menu</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-submenus-modal-action="close">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <!--begin::Notice-->
                    <!--begin::Notice-->
                    <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                        <!--begin::Icon-->
                        <i class="ki-outline ki-information fs-2tx text-warning me-4"></i>
                        <!--end::Icon-->
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack flex-grow-1">
                            <!--begin::Content-->
                            <div class="fw-semibold">
                                <div class="fs-6 text-gray-700">
                                    <strong class="me-1">Warning!</strong>By editing the submenu name, you might
                                    break the system submenus functionality. Please ensure you're absolutely certain
                                    before proceeding.
                                </div>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Notice-->
                    <!--begin::Form-->
                    <form id="kt_modal_update_submenu_form" class="form" action="#">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mb-2" for="sub_menu">
                                <span class="required">Sub Menu Name</span>
                                <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true"
                                      data-bs-content="Sub Menu names is required to be unique.">
                                    <i class="ki-outline ki-information fs-7"></i>
                                </span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control form-control-solid" placeholder="Enter a submenu name"
                                   name="sub_menu" id="sub_menu"/>
                            <input type="hidden" name="id" id="id"/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mb-2" for="menu_id">
                                <span class="required">Parent</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select class="form-select form-select-solid" data-control="select2"
                                    data-placeholder="Select a menu"
                                    name="menu_id" id="menu_id_update"
                                    data-dropdown-parent="#kt_modal_update_submenu"
                                    data-allow-clear="true">
                                <option></option>
                                <?php foreach ($menus as $menu) : ?>
                                    <option value="<?= $menu['id'] ?>"><?= $menu['menu'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mb-2" for="permission_id">
                                <span class="required">Permission</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select class="form-select form-select-solid" data-control="select2"
                                    data-placeholder="Select a permission"
                                    name="permission_id" id="permission_id_update"
                                    data-dropdown-parent="#kt_modal_update_submenu"
                                    data-allow-clear="true">
                                <option></option>
                                <?php foreach ($permissions as $permission) : ?>
                                    <option value="<?= $permission->id ?>"><?= $permission->description ?></option>
                                <?php endforeach; ?>
                            </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span>Description</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control form-control-solid" placeholder="Enter a submenu description"
                                   name="description" id="description"/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Route to</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <div class="input-group input-group-solid">
                                <span class="input-group-text"><?= base_url() ?></span>
                                <input type="text" class="form-control form-control-solid"
                                       placeholder="Enter endpoint URL" aria-label="Sub Menu URL" name="url"
                                       id="url"/>
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row">
                            <div class="row">
                                <div class="col-lg mb-7">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Icon</span>
                                        <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover"
                                              data-bs-html="true"
                                              data-bs-content="Icon is required.">
                                            <i class="ki-outline ki-information fs-7"></i>
                                        </span>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <!--begin::Input group-->
                                    <div class="input-group input-group-solid">
                                        <input type="text" class="form-control form-control-solid"
                                               placeholder="Enter icon class name" aria-label="Sub Menu icon"
                                               name="icon" id="icon"/>
                                        <span class="input-group-text"><i id="preview_icon"></i></span>
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <div class="col-lg-4 mb-7   ">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Sequence</span>
                                        <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover"
                                              data-bs-html="true"
                                              data-bs-content="Route to endpoint is required to be unique or leave it with a hash sign if this is parent submenu.">
                                            <i class="ki-outline ki-information fs-7"></i>
                                        </span>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control form-control-solid"
                                           placeholder="Enter sequence of submenu"
                                           name="sequence" id="sequence"/>
                                    <!--end::Input-->
                                </div>
                            </div>

                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <div class="row">
                                <div class="col-lg-3 mb-2">
                                    <!--begin::Checkbox-->
                                    <label class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="" name="is_active"
                                               id="is_active"/>
                                        <span class="form-check-label">Set active</span>
                                    </label>
                                    <!--end::Checkbox-->
                                </div>
                                <div class="col-lg mb-2">
                                    <!--begin::Checkbox-->
                                    <label class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="" name="has_notify"
                                               id="has_notify"/>
                                        <span class="form-check-label">Set notify</span>
                                    </label>
                                    <!--end::Checkbox-->
                                </div>
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-kt-submenus-modal-action="cancel">
                                Discard
                            </button>
                            <button type="submit" class="btn btn-primary" data-kt-submenus-modal-action="submit">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span
                                        class="spinner-border spinner-border-sm align-middle ms-2"></span>
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
    <!--end::Modal - Update submenus-->
    <!--end::Modals-->

    <script>
        const modalAdd = document.getElementById('kt_modal_add_submenu');
        const submenuIconInput = modalAdd.querySelector('#icon');
        submenuIconInput.addEventListener('keyup', function () {
            const previewIcon = modalAdd.querySelector('#preview_icon');
            previewIcon.className = this.value;
        });

        const modalUpdate = document.getElementById('kt_modal_update_submenu');
        const submenuIconInputUpdate = modalUpdate.querySelector('#icon');
        submenuIconInputUpdate.addEventListener('keyup', function () {
            const previewIconUpdate = modalUpdate.querySelector('#preview_icon');
            previewIconUpdate.className = this.value;
        });
    </script>
<?= $this->endSection(); ?>