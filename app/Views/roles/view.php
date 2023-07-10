<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>
<!--begin::Layout-->
<div class="d-flex flex-column flex-lg-row">
    <!--begin::Sidebar-->
    <div class="flex-column flex-lg-row-auto w-100 w-lg-200px w-xl-300px mb-10">
        <!--begin::Card-->
        <div class="card card-flush">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2 class="mb-0"><?= $role->name ?></h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Permissions-->
                <div class="d-flex flex-column text-gray-600">
                    <?php foreach ($role->permissions as $permission) : ?>
                    <div class="d-flex align-items-center py-2">
                        <span class="bullet bg-primary me-3"></span><?= $permission->description ?></div>
                    <?php endforeach; ?>
                </div>
                <!--end::Permissions-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Sidebar-->
    <!--begin::Content-->
    <div class="flex-lg-row-fluid ms-lg-10">
        <!--begin::Card-->
        <div class="card card-flush mb-6 mb-xl-9">
            <!--begin::Card header-->
            <div class="card-header pt-5">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2 class="d-flex align-items-center">Users Assigned
                        <span class="text-gray-600 fs-6 ms-1"><?= $role->total_user ?></span></h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_roles_view_table">
                    <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th class="min-w-150px">User</th>
                        <th class="min-w-150px">Active</th>
                        <th class="min-w-125px">Joined Date</th>
                    </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                    <?php foreach ($role->users as $user) : ?>
                    <tr>
                        <td class="d-flex align-items-center">
                            <!--begin:: Avatar -->
                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                <a href="<?= base_url('users/detail/' . $user['id']) ?>">
                                    <div class="symbol-label">
                                        <img src="<?= base_url() ?>media/avatars/blank.png" alt="Emma Smith" class="w-100" />
                                    </div>
                                </a>
                            </div>
                            <!--end::Avatar-->
                            <!--begin::User details-->
                            <div class="d-flex flex-column">
                                <a href="<?= base_url('users/detail/' . $user['id']) ?>" class="text-gray-800 text-hover-primary mb-1"><?= $user['username'] ?></a>
                                <span><?= $user['email'] ?></span>
                            </div>
                            <!--begin::User details-->
                        </td>
                        <td>
                            <span class="badge badge-light-<?= $user['active'] == 1 ? 'success' : 'danger' ?> fw-bolder"><?= $user['active'] == 1 ? 'Active' : 'Inactive' ?></span>
                        </td>
                        <td><?= date('d M Y', strtotime($user['created_at'])) ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Content-->
</div>
<!--end::Layout-->
<?= $this->endSection(); ?>
