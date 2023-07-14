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
                           class="form-control form-control-solid w-250px ps-13" placeholder="Search user"/>
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
                                <label class="form-label fs-6 fw-semibold">Role:</label>
                                <select class="form-select form-select-solid fw-bold" data-kt-select2="true"
                                        data-placeholder="Select option" data-allow-clear="true"
                                        data-kt-user-table-filter="role" data-hide-search="true">
                                    <option></option>
                                    <?php foreach ($groups as $group) : ?>
                                        <option value="<?= $group->name ?>"><?= $group->name ?></option>
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
                    <th class="min-w-125px">User</th>
                    <th class="min-w-125px">Role</th>
                    <th class="min-w-50px">Active</th>
                    <th class="min-w-125px">Joined Date</th>
                    <th class="text-end min-w-100px">Actions</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold">
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td class="d-flex align-items-center">
                            <!--begin:: Avatar -->
                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                <a href="<?= base_url('users/detail/' . $user->id) ?>">
                                    <div class="symbol-label">
                                        <img src="<?= base_url() ?>media/avatars/<?= $user->profile['foto_profil'] ?>" alt="<?= $user->username ?>"
                                             class="w-100"/>
                                    </div>
                                </a>
                            </div>
                            <!--end::Avatar-->
                            <!--begin::User details-->
                            <div class="d-flex flex-column">
                                <a href="<?= base_url('users/detail/' . $user->id) ?>"
                                   class="text-gray-800 text-hover-primary mb-1"><?= $user->username ?></a>
                                <span><?= $user->email ?></span>
                            </div>
                            <!--begin::User details-->
                        </td>
                        <td>
                            <?php foreach ($user->groups as $group) : ?>
                            <span class="badge badge-light-<?= COLOR[$group['group_id'] % count(COLOR)] ?> fw-bolder"><?= $group['name'] ?></span>
                            <?php endforeach; ?>
                        </td>
                        <td>
                            <span class="badge badge-light-<?= $user->active == 1 ? 'success' : 'danger' ?> fw-bolder"><?= $user->active == 1 ? 'Active' : 'Inactive' ?></span>
                        </td>
                        <td><?= date('d M Y', strtotime($user->created_at)) ?></td>

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
                                    <a href="<?= base_url('users/detail/' . $user->id) ?>"
                                       class="menu-link px-3">View</a>
                                </div>
                                <!--end::Menu item-->
                                <?php if (hasActionAccess('write', user_id()) && user_id() !== $user->id): ?>
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" data-kt-users-table-filter="activate_row"  data-active-status="<?= $user->active?'0':'1' ?>"
                                           data-user-id="<?= $user->id ?>"><?= $user->active?'Inactivate':'Activate' ?></a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" data-kt-users-table-filter="delete_row"
                                           data-user-id="<?= $user->id ?>">Delete</a>
                                    </div>
                                    <!--end::Menu item-->
                                <?php endif; ?>
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
<?= $this->endSection(); ?>