"use strict";
var KTUsersUpdateRoles = function () {
    const t = document.getElementById("kt_modal_update_role"), e = t.querySelector("#kt_modal_update_role_form"),
        n = new bootstrap.Modal(t);

    const x = document.querySelector("#kt_roles_list");
    return {
        init: function () {
            (() => {
                var o = FormValidation.formValidation(e, {
                    fields: {
                        name: {validators: {notEmpty: {message: "Role name is required"}}},
                        description: {validators: {notEmpty: {message: "Role description is required"}}},
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger,
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                            eleInvalidClass: "",
                            eleValidClass: ""
                        })
                    }
                });
                t.querySelector('[data-kt-roles-modal-action="close"]').addEventListener("click", (t => {
                    t.preventDefault(), Swal.fire({
                        text: "Are you sure you would like to close?",
                        icon: "warning",
                        showCancelButton: !0,
                        buttonsStyling: !1,
                        confirmButtonText: "Yes, close it!",
                        cancelButtonText: "No, return",
                        customClass: {confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light"}
                    }).then((function (t) {
                        t.value && n.hide()
                    }))
                })), t.querySelector('[data-kt-roles-modal-action="cancel"]').addEventListener("click", (t => {
                    t.preventDefault(), Swal.fire({
                        text: "Are you sure you would like to cancel?",
                        icon: "warning",
                        showCancelButton: !0,
                        buttonsStyling: !1,
                        confirmButtonText: "Yes, cancel it!",
                        cancelButtonText: "No, return",
                        customClass: {confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light"}
                    }).then((function (t) {
                        t.value ? (e.reset(), n.hide()) : "cancel" === t.dismiss && Swal.fire({
                            text: "Your form has not been cancelled!.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {confirmButton: "btn btn-primary"}
                        })
                    }))
                })), x.querySelectorAll('[data-bs-target="#kt_modal_update_role"]').forEach((x => {
                    x.addEventListener("click", (function (event) {
                        event.preventDefault();
                        e.reset();
                        const z = event.target.closest('div');
                        const role_id = z.querySelector('[data-role-id]').getAttribute("data-role-id");
                        fetch('roles/get/' + role_id, {
                            method: 'GET',
                            headers: {'Content-Type': 'application/json',}
                        }).then(response => response.json()
                        ).then(response => {
                            const data = response.data;
                            e.querySelector('[name="name"]').value = data.role.name;
                            e.querySelector('[name="description"]').value = data.role.description;
                            e.querySelector('[name="id"]').value = data.role.id;
                            // e.querySelectorAll('#permission');
                            // console.log(e.querySelectorAll('#permission'));
                            if (data.permissions.length > 0) {
                                data.permissions.forEach((permission) => {
                                    var f = e.querySelector(`[data-permission-id="${permission.permission_id}"]`);
                                    f.querySelector(`[data-permission-access="read"]`).checked = permission.read === "1";
                                    f.querySelector(`[data-permission-access="write"]`).checked = permission.write === "1";
                                    f.querySelector(`[data-permission-access="create"]`).checked = permission.create === "1";
                                });
                            }
                            n.show();
                        }).catch((error) => {
                            console.error('Error:', error);
                        });
                    }))
                }));
                const i = t.querySelector('[data-kt-roles-modal-action="submit"]');
                i.addEventListener("click", (function (t) {
                    t.preventDefault(), o && o.validate().then((function (t) {
                        console.log("validated!");
                        if ("Valid" === t) {
                            i.setAttribute("data-kt-indicator", "on");
                            i.disabled = !0;

                            const hasChoosePermission = e.querySelectorAll('input[type="checkbox"]:checked').length > 0;
                            if (!hasChoosePermission) {
                                Swal.fire({
                                    text: "Please choose at least one permission.",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {confirmButton: "btn btn-primary"}
                                });
                                i.setAttribute("data-kt-indicator", "off");
                                i.disabled = !1;
                                // return;
                                //stop proses berikutnya
                                return false;
                            }

                            const d = e.querySelectorAll('#permission');
                            const permissions = [];
                            d.forEach((div) => {
                                const c = div.querySelectorAll('input[type="checkbox"]');
                                const isChecked = div.querySelector('input[type="checkbox"]:checked') !== null;
                                if (isChecked) {
                                    const permission = {
                                        group_id: e.querySelector('[name="id"]').value,
                                        permission_id: div.getAttribute('data-permission-id'),
                                        read: c[0].checked,
                                        write: c[1].checked,
                                        create: c[2].checked
                                    };
                                    permissions.push(permission);
                                }
                            })

                            const data = {
                                group: {
                                    id: e.querySelector('[name="id"]').value,
                                    name: e.querySelector('[name="name"]').value,
                                    description: e.querySelector('[name="description"]').value
                                },
                                permissions: permissions
                            }
                            fetch('/roles/update', {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify(data)
                            }).then(response => response.json()
                            ).then(response => {
                                i.removeAttribute("data-kt-indicator");
                                i.disabled = !1;
                                if (response.status === "success") {
                                    Swal.fire({
                                        text: response.message,
                                        icon: "success",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {confirmButton: "btn btn-primary"}
                                    }).then((function (t) {
                                        t.isConfirmed && (e.reset(), n.hide(), location.reload())
                                    }))
                                } else {
                                    Swal.fire({
                                        text: response.message,
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {confirmButton: "btn btn-primary"}
                                    })
                                }
                            })
                        } else Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {confirmButton: "btn btn-primary"}
                        })
                    }))
                }))
            })(), (() => {
                const t = e.querySelector("#kt_roles_select_all"), n = e.querySelectorAll('[type="checkbox"]');
                t.addEventListener("change", (t => {
                    n.forEach((e => {
                        e.checked = t.target.checked
                    }))
                }))
            })(), (() => {

            })()
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTUsersUpdateRoles.init()
}));