"use strict";
var KTUsersUpdateMenu = function () {
    const t = document.getElementById("kt_modal_update_menu"),
        e = t.querySelector("#kt_modal_update_menu_form"), n = new bootstrap.Modal(t);

    return {
        init: function () {
            (() => {
                var o = FormValidation.formValidation(e, {
                    fields: {
                        menu_name: {
                            validators: {
                                notEmpty: {message: "Menu name is required"}
                            }
                        },
                        permission_id: {
                            validators: {
                                notEmpty: {message: "Permission is required"}
                            }
                        },
                        menu_seq: {
                            validators: {
                                numeric: {message: "Sequence must be numeric"},
                                notEmpty: {message: "Sequence is required"}
                            }
                        },
                        menu_icon: {
                            validators: {
                                notEmpty: {message: "Icon is required"}
                            }
                        }
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
                t.querySelector('[data-kt-menus-modal-action="close"]').addEventListener("click", (t => {
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
                })), t.querySelector('[data-kt-menus-modal-action="cancel"]').addEventListener("click", (t => {
                    t.preventDefault(), Swal.fire({
                        text: "Are you sure you would like to cancel?",
                        icon: "warning",
                        showCancelButton: !0,
                        buttonsStyling: !1,
                        confirmButtonText: "Yes, cancel it!",
                        cancelButtonText: "No, return",
                        customClass: {confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light"}
                    }).then((function (t) {
                        t.value ? (e.reset(), n.hide()) : "cancel" === t.dismiss
                    }))
                }));
                const i = t.querySelector('[data-kt-menus-modal-action="submit"]');
                i.addEventListener("click", (function (t) {
                    t.preventDefault(); o && o.validate().then((function (t) {
                        console.log("validated!");
                        if ("Valid" === t) {
                            i.setAttribute("data-kt-indicator", "on");
                            i.disabled = !0;
                            setTimeout(function () {
                                i.removeAttribute("data-kt-indicator");
                                i.disabled = !1;

                                const menuId = e.querySelector('#menu_id').value;
                                const permissionId = e.querySelector('#permission_id_update').value;
                                const menu = e.querySelector('#menu_name').value;
                                const description = e.querySelector('#menu_desc').value;
                                const url = e.querySelector('#menu_url').value;
                                const icon = e.querySelector('#menu_icon').value;
                                const sequence = e.querySelector('#menu_seq').value;
                                const isActive = e.querySelector('#is_active').checked ? 1 : 0;
                                const isParent = e.querySelector('#is_parent').checked ? 1 : 0;
                                const isCore = e.querySelector('#is_core').checked ? 1 : 0;
                                const hasNotify = e.querySelector('#has_notify').checked ? 1 : 0;

                                const data = {
                                    id: menuId,
                                    permission_id: permissionId,
                                    menu: menu,
                                    description: description,
                                    url: url,
                                    icon: icon,
                                    sequence: sequence,
                                    is_active: isActive,
                                    is_parent: isParent,
                                    is_core: isCore,
                                    has_notify: hasNotify
                                };

                                fetch('/menus/update', {
                                    method: 'PUT',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify(data)
                                })
                                    .then(response => response.json())
                                    .then(result => {
                                        if (result.status === 'success') {
                                            i.disabled = !1;
                                            Swal.fire({
                                                text: result.message,
                                                icon: result.status,
                                                buttonsStyling: !1,
                                                confirmButtonText: "Ok, got it!",
                                                customClass: {confirmButton: "btn btn-primary"}
                                            }).then(function (t) {
                                                if (t.isConfirmed) {
                                                    n.hide();
                                                    e.reset();
                                                    window.location.reload();
                                                }
                                            });
                                        } else {
                                            i.disabled = !1;
                                            Swal.fire({
                                                text: result.message,
                                                icon: result.status,
                                                buttonsStyling: !1,
                                                confirmButtonText: "Ok, got it!",
                                                customClass: {confirmButton: "btn btn-primary"}
                                            });
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                        i.disabled = !1;
                                    });
                            }, 2000);
                        } else {
                            Swal.fire({
                                text: "Sorry, looks like there are some errors detected, please try again.",
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, got it!",
                                customClass: {confirmButton: "btn btn-primary"}
                            });
                        }
                    }))
                }))
            })()
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTUsersUpdateMenu.init()
}));