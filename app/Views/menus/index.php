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
                    <input type="text" data-kt-menus-table-filter="search"
                           class="form-control form-control-solid w-250px ps-13" placeholder="Search Menu"/>
                </div>
                <!--end::Search-->
            </div>
            <!--end::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <?php if (hasActionAccess('create', user_id())): ?>
                    <!--begin::Button-->
                    <button type="button" class="btn btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_menu">
                        <i class="ki-outline ki-plus-square fs-3"></i>Add Menu
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
            <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_menus_table">
                <thead>
                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-125px">Menu</th>
                    <th class="min-w-150px">Assigned to</th>
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
                <?php foreach ($menus as $menu) : ?>
                    <tr>
                        <td>
                            <i class="<?= $menu['icon'] ?> fs-2"></i>
                            <span class="ms-1"><?= $menu['menu'] ?></span>
                        </td>
                        <td>
                                <span
                                    class="badge badge-light-<?= COLOR[$menu['permission_id'] % count(COLOR)] ?> fs-7 m-1"><?= $menu['permission'] ?></span>
                        </td>
                        <td><a class="fw-semibold text-gray-600"
                               href="<?= base_url($menu['url'] ?? '#') ?>"><?= $menu['url'] ?? '#' ?></a></td>
                        <td>
                            <span
                                class="badge badge-light-success"><?= $menu['is_active'] ? 'Active' : '' ?></span>
                            <span
                                class="badge badge-light-warning"><?= $menu['is_parent'] ? 'Parent' : '' ?></span>
                            <span
                                class="badge badge-light-danger"><?= $menu['is_core'] ? 'Core Menu' : '' ?></span>
                            <span
                                class="badge badge-light-primary"><?= $menu['has_notify'] ? 'Notify' : '' ?></span>
                        </td>
                        <td><?= $menu['sequence'] ?></td>
                        <td><?= $menu['description'] ?></td>
                        <td><?= date('d M Y', strtotime($menu['created_at'])) ?></td>
                        <?php if (hasActionAccess('write', user_id())): ?>
                            <td class="text-end">
                                <button class="btn btn-icon btn-active-light-primary w-30px h-30px"
                                        data-bs-toggle="modal" data-bs-target="#kt_modal_update_menu"
                                        data-menu-id="<?= $menu['id'] ?>">
                                    <i class="ki-outline ki-setting-3 fs-3"></i>
                                </button>
                                <button
                                    class="btn btn-icon btn-active-light-primary w-30px h-30px <?= $menu['is_core'] ? 'disabled' : '' ?>"
                                    data-kt-menus-table-filter="delete_row" data-menu-id="<?= $menu['id'] ?>"
                                    data-url-delete="<?= base_url('menus/delete') ?>">
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
    <!--begin::Modal - Add menus-->
    <div class="modal fade" id="kt_modal_add_menu" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">Add a Menu</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-menus-modal-action="close">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <!--begin::Form-->
                    <form id="kt_modal_add_menu_form" class="form" action="#">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Menu Name</span>
                                <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true"
                                      data-bs-content="Menu names is required to be unique.">
                                    <i class="ki-outline ki-information fs-7"></i>
                                </span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control form-control-solid" placeholder="Enter a menu name"
                                   name="menu_name" id="menu_name"/>
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
                                    data-dropdown-parent="#kt_modal_add_menu"
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
                            <input class="form-control form-control-solid" placeholder="Enter a menu description"
                                   name="menu_desc" id="menu_desc"/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span>Route to</span>
                                <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true"
                                      data-bs-content="Route to endpoint is required to be unique or leave it with null value if this is parent menu.">
                                    <i class="ki-outline ki-information fs-7"></i>
                                </span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <div class="input-group input-group-solid">
                                <span class="input-group-text"><?= base_url() ?></span>
                                <input type="text" class="form-control form-control-solid"
                                       placeholder="Enter endpoint URL" aria-label="Menu URL" name="menu_url"
                                       id="menu_url"/>
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
                                               placeholder="Enter icon class name" aria-label="Menu icon"
                                               name="menu_icon" id="menu_icon"/>
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
                                              data-bs-content="Route to endpoint is required to be unique or leave it with a hash sign if this is parent menu.">
                                            <i class="ki-outline ki-information fs-7"></i>
                                        </span>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control form-control-solid" placeholder="Enter sequence of menu"
                                           name="menu_seq" id="menu_seq"/>
                                    <!--end::Input-->
                                </div>
                            </div>

                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <div class="row d-flex align-items-start">
                                <div class="col-lg mb-2">
                                    <!--begin::Checkbox-->
                                    <label class="form-check form-check-custom form-check-danger form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="" name="is_core"
                                               id="is_core"/>
                                        <span class="form-check-label">Core Menu</span>
                                    </label>
                                    <!--end::Checkbox-->
                                </div>
                                <div class="col-lg mb-2">
                                    <!--begin::Checkbox-->
                                    <label class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="" name="is_active"
                                               id="kt_menus_active"/>
                                        <span class="form-check-label">Set active</span>
                                    </label>
                                    <!--end::Checkbox-->
                                </div>
                                <div class="col-lg mb-2">
                                    <!--begin::Checkbox-->
                                    <label class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="" name="is_parent"
                                               id="kt_menus_parent" onchange="checkIsParentAdd()"/>
                                        <span class="form-check-label">As parent</span>
                                    </label>
                                    <!--end::Checkbox-->
                                </div>
                                <div class="col-lg mb-2">
                                    <!--begin::Checkbox-->
                                    <label class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="" name="has_notify"
                                               id="kt_menus_notify"/>
                                        <span class="form-check-label">Set notify</span>
                                    </label>
                                    <!--end::Checkbox-->
                                </div>
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-kt-menus-modal-action="cancel">
                                Discard
                            </button>
                            <button type="submit" class="btn btn-primary" data-kt-menus-modal-action="submit">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
																<span
                                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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
    <!--end::Modal - Add menus-->
    <!--begin::Modal - Update menus-->
    <div class="modal fade" id="kt_modal_update_menu" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">Update Menu</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-menus-modal-action="close">
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
                                    <strong class="me-1">Warning!</strong>By editing the menu name, you might
                                    break the system menus functionality. Please ensure you're absolutely certain
                                    before proceeding.
                                </div>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Notice-->
                    <!--end::Notice-->
                    <!--begin::Form-->
                    <form id="kt_modal_update_menu_form" class="form" action="#">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Menu Name</span>
                                <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true"
                                      data-bs-content="Menu names is required to be unique.">
                                    <i class="ki-outline ki-information fs-7"></i>
                                </span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control form-control-solid" placeholder="Enter a menu name"
                                   name="menu_name" id="menu_name"/>
                            <input type="hidden"
                                   name="menu_id" id="menu_id"/>
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
                            <input class="form-control form-control-solid" placeholder="Enter a menu description"
                                   name="menu_desc" id="menu_desc"/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span>Route to</span>
                                <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true"
                                      data-bs-content="Route to endpoint is required to be unique or leave it with null value if this is parent menu.">
                                    <i class="ki-outline ki-information fs-7"></i>
                                </span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <div class="input-group input-group-solid">
                                <span class="input-group-text"><?= base_url() ?></span>
                                <input type="text" class="form-control form-control-solid"
                                       placeholder="Enter endpoint URL" aria-label="Menu URL" name="menu_url"
                                       id="menu_url"/>
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
                                               placeholder="Enter icon class name" aria-label="Menu icon"
                                               name="menu_icon_update" id="menu_icon"/>
                                        <span class="input-group-text"><i id="preview_icon_update"></i></span>
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <div class="col-lg-4 mb-7   ">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Sequence</span>
                                        <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover"
                                              data-bs-html="true"
                                              data-bs-content="Route to endpoint is required to be unique or leave it with a hash sign if this is parent menu.">
                                            <i class="ki-outline ki-information fs-7"></i>
                                        </span>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control form-control-solid" placeholder="Enter sequence of menu"
                                           name="menu_seq" id="menu_seq"/>
                                    <!--end::Input-->
                                </div>
                            </div>

                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <div class="row d-flex align-items-start">
                                <div class="col-lg mb-2">
                                    <!--begin::Checkbox-->
                                    <label class="form-check form-check-custom form-check-danger form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="" name="is_core"
                                               id="is_core"/>
                                        <span class="form-check-label">Core Menu</span>
                                    </label>
                                    <!--end::Checkbox-->
                                </div>
                                <div class="col-lg mb-2">
                                    <!--begin::Checkbox-->
                                    <label class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" name="is_active"
                                               id="is_active"/>
                                        <span class="form-check-label">Set active</span>
                                    </label>
                                    <!--end::Checkbox-->
                                </div>
                                <div class="col-lg mb-2">
                                    <!--begin::Checkbox-->
                                    <label class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" name="is_parent"
                                               id="is_parent" onchange="checkIsParentUpdate()"/>
                                        <span class="form-check-label">As parent</span>
                                    </label>
                                    <!--end::Checkbox-->
                                </div>
                                <div class="col-lg mb-2">
                                    <!--begin::Checkbox-->
                                    <label class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" name="has_notify"
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
                            <button type="reset" class="btn btn-light me-3" data-kt-menus-modal-action="cancel">
                                Discard
                            </button>
                            <button type="submit" class="btn btn-primary" data-kt-menus-modal-action="submit">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
																<span
                                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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
    <!--end::Modals-->

    <script>
        const menuIconInput = document.getElementById('menu_icon');
        const previewIcon = document.getElementById('preview_icon');
        const menuIconInputUpdate = document.querySelector('[name="menu_icon_update"]');
        const previewIconUpdate = document.getElementById('preview_icon_update');

        menuIconInput.addEventListener('keyup', function () {
            previewIcon.className = this.value;
        });
        menuIconInputUpdate.addEventListener('keyup', function () {
            previewIconUpdate.className = this.value;
        });

        function checkIsParentAdd() {
            const modalAdd = document.getElementById('kt_modal_add_menu');
            const menuUrl = modalAdd.querySelector('#menu_url');
            const isParentAdd = modalAdd.querySelector('#kt_menus_parent');
            if (isParentAdd.checked) {
                menuUrl.disabled = true;
                menuUrl.value = '';
            } else {
                menuUrl.disabled = false;
            }
        }

        function checkIsParentUpdate() {
            const modalUpdate = document.getElementById('kt_modal_update_menu');
            const menuUrl = modalUpdate.querySelector('#menu_url');
            const isParentUpdate = modalUpdate.querySelector('#is_parent');
            if (isParentUpdate.checked) {
                menuUrl.disabled = true;
                menuUrl.value = '';
            } else {
                menuUrl.disabled = false;
            }
        }
    </script>
<?= $this->endSection(); ?>