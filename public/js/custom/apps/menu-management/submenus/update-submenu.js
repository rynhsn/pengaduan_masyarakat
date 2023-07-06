"use strict";
var KTUsersUpdateSubMenu = function () {
    const t = document.getElementById("kt_modal_update_submenu"),
        e = t.querySelector("#kt_modal_update_submenu_form"), n = new bootstrap.Modal(t);

    return {
        init: function () {
            (() => {
                var o = FormValidation.formValidation(e, {
                    fields: {
                        sub_menu: {
                            validators: {
                                notEmpty: {message: "SubMenu name is required"}
                            }
                        },
                        menu_id: {
                            validators: {
                                notEmpty: {message: "Menu is required"}
                            }
                        },
                        permission_id: {
                            validators: {
                                notEmpty: {message: "Permission is required"}
                            }
                        },
                        url: {
                            validators: {
                                notEmpty: {message: "URL is required"}
                            }
                        },
                        sequence: {
                            validators: {
                                numeric: {message: "Sequence must be numeric"},
                                notEmpty: {message: "Sequence is required"}
                            }
                        },
                        icon: {
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
                t.querySelector('[data-kt-submenus-modal-action="close"]').addEventListener("click", (t => {
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
                })), t.querySelector('[data-kt-submenus-modal-action="cancel"]').addEventListener("click", (t => {
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
                const i = t.querySelector('[data-kt-submenus-modal-action="submit"]');
                i.addEventListener("click", (function (t) {
                    t.preventDefault(); o && o.validate().then((function (t) {
                        console.log("validated!");
                        if ("Valid" === t) {
                            i.setAttribute("data-kt-indicator", "on");
                            i.disabled = !0;
                            setTimeout(function () {
                                i.removeAttribute("data-kt-indicator");
                                i.disabled = !1;

                                const data = {
                                    id: e.querySelector('#id').value,
                                    sub_menu: e.querySelector('#sub_menu').value,
                                    menu_id: e.querySelector('#menu_id_update').value,
                                    permission_id: e.querySelector('#permission_id_update').value,
                                    description: e.querySelector('#description').value,
                                    url: e.querySelector('#url').value,
                                    icon: e.querySelector('#icon').value,
                                    sequence: e.querySelector('#sequence').value,
                                    is_active: e.querySelector('#is_active').checked ? 1 : 0,
                                    has_notify: e.querySelector('#has_notify').checked ? 1 : 0
                                };

                                fetch('/submenus/update', {
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
    KTUsersUpdateSubMenu.init()
}));