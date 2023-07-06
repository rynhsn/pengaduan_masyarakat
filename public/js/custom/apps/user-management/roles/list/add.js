"use strict";
var KTUsersAddRole = function () {
    const t = document.getElementById("kt_modal_add_role"), e = t.querySelector("#kt_modal_add_role_form"),
        n = new bootstrap.Modal(t);
    return {
        init: function () {
            (() => {
                var o = FormValidation.formValidation(e, {
                    fields: {
                        name: {validators: {notEmpty: {message: "Role name is required"}}},
                        description: {validators: {notEmpty: {message: "Role description is required"}}}},
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
                }));
                const r = t.querySelector('[data-kt-roles-modal-action="submit"]');
                r.addEventListener("click", (function (t) {
                    t.preventDefault(), o && o.validate().then((function (t) {
                        console.log("validated!");
                        if ("Valid" === t) {
                            r.setAttribute("data-kt-indicator", "on");
                            r.disabled = !0;
                            setTimeout((function () {
                                r.removeAttribute("data-kt-indicator");
                                r.disabled = !1;

                                const hasChoosePermission = e.querySelectorAll('input[type="checkbox"]:checked').length > 0;
                                if (!hasChoosePermission) {
                                    Swal.fire({
                                        text: "Please choose at least one permission.",
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {confirmButton: "btn btn-primary"}
                                    })
                                    return;
                                }

                                const d = e.querySelectorAll('#permission');
                                const permissions = [];
                                d.forEach((div) => {
                                    const c = div.querySelectorAll('input[type="checkbox"]');
                                    const isChecked = div.querySelector('input[type="checkbox"]:checked') !== null;
                                    if (isChecked) {
                                        const permission = {
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
                                        name: e.querySelector('[name="name"]').value,
                                        description: e.querySelector('[name="description"]').value
                                    },
                                    permissions: permissions
                                }
                                fetch('/roles/create', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify(data)
                                }).then((response) => {
                                    return response.json();
                                }).then((response) => {
                                    if (response.status === 'success') {
                                        Swal.fire({
                                            text: response.message,
                                            icon: "success",
                                            buttonsStyling: !1,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {confirmButton: "btn btn-primary"}
                                        }).then((function (t) {
                                            t.isConfirmed && window.location.reload()
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
                                }).catch((error) => {
                                    console.log(error);
                                });
                            }), 2e3)
                        } else {
                            Swal.fire({
                                text: "Sorry, looks like there are some errors detected, please try again.",
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, got it!",
                                customClass: {confirmButton: "btn btn-primary"}
                            })
                        }
                    }))
                }))
            })(), (() => {
                const t = e.querySelector("#kt_roles_select_all"), n = e.querySelectorAll('[type="checkbox"]');
                t.addEventListener("change", (t => {
                    n.forEach((e => {
                        e.checked = t.target.checked
                    }))
                }))
            })()
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTUsersAddRole.init()
}));