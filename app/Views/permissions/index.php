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
                <input type="text" data-kt-permissions-table-filter="search"
                       class="form-control form-control-solid w-250px ps-13" placeholder="Search Permissions"/>
            </div>
            <!--end::Search-->
        </div>
        <!--end::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <?php if (hasActionAccess('create', user_id())): ?>
            <!--begin::Button-->
            <button type="button" class="btn btn-light-primary" data-bs-toggle="modal"
                    data-bs-target="#kt_modal_add_permission">
                <i class="ki-outline ki-plus-square fs-3"></i>Add Permission
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
        <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_permissions_table">
            <thead>
            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                <th class="min-w-125px">Name</th>
                <th class="min-w-125px">Description</th>
                <th class="min-w-250px">Assigned to</th>
                <?php if (hasActionAccess('write', user_id())): ?>
                <th class="text-end min-w-100px">Actions</th>
                <?php endif; ?>
            </tr>
            </thead>
            <tbody class="fw-semibold text-gray-600">
            <?php foreach ($permissions as $permission): ?>
            <tr>
                <td><?= $permission['name'] ?></td>
                <td><?= $permission['description'] ?></td>
                <td>
                    <?php foreach ($permission['groups'] as $group): ?>
                    <a href="demo27/dist/apps/user-management/roles/view.html"
                       class="badge badge-light-<?= COLOR[$group['group_id'] % count(COLOR)] ?> fs-7 m-1"><?= $group['group_name'] ?></a>
                    <?php endforeach; ?>
                </td>

                <?php if (hasActionAccess('write', user_id())): ?>
                <td class="text-end">
                    <button class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_update_permission"
                    data-permission-id="<?= $permission['id'] ?>">
                        <i class="ki-outline ki-setting-3 fs-3"></i>
                    </button>
                    <button class="btn btn-icon btn-active-light-primary w-30px h-30px"
                            data-kt-permissions-table-filter="delete_row" data-permission-id="<?= $permission['id'] ?>">
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
<!--begin::Modal - Add permissions-->
<div class="modal fade" id="kt_modal_add_permission" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add a Permission</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-permissions-modal-action="close">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form id="kt_modal_add_permission_form" class="form" action="#">
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Permission Name</span>
                            <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true"
                                  data-bs-content="Permission names is required to be unique.">
																	<i class="ki-outline ki-information fs-7"></i>
																</span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control form-control-solid" placeholder="Enter a permission name"
                               name="name" id="name"/>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Permission Description</span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control form-control-solid" placeholder="Enter a permission Description"
                               name="description" id="description"/>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-kt-permissions-modal-action="cancel">
                            Discard
                        </button>
                        <button type="submit" class="btn btn-primary" data-kt-permissions-modal-action="submit">
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
<!--end::Modal - Add permissions-->
<!--begin::Modal - Update permissions-->
<div class="modal fade" id="kt_modal_update_permission" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Update Permission</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-permissions-modal-action="close">
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
                                <strong class="me-1">Warning!</strong>By editing the permission name, you might break
                                the system permissions functionality. Please ensure you're absolutely certain before
                                proceeding.
                            </div>
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Notice-->
                <!--end::Notice-->
                <!--begin::Form-->
                <form id="kt_modal_update_permission_form" class="form" action="#">
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Permission Name</span>
                            <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true"
                                  data-bs-content="Permission names is required to be unique.">
																	<i class="ki-outline ki-information fs-7"></i>
																</span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control form-control-solid" placeholder="Enter a permission name"
                               name="name" id="name"/>
                        <input type="hidden" name="id" id="id"/>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Permission Description</span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control form-control-solid" placeholder="Enter a permission Description"
                               name="description" id="description"/>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-kt-permissions-modal-action="cancel">
                            Discard
                        </button>
                        <button type="submit" class="btn btn-primary" data-kt-permissions-modal-action="submit">
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
<!--end::Modal - Update permissions-->
<!--end::Modals-->

<?= $this->endSection() ?>
