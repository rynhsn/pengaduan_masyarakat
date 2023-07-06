"use strict";

var KTUsersAddMenu = function () {
    const t = document.getElementById("kt_modal_add_menu"), e = t.querySelector("#kt_modal_add_menu_form"),
        n = new bootstrap.Modal(t);
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
                        t.value ? (e.reset(), n.hide()) : "cancel" === t.dismiss && Swal.fire({
                            text: "Your form has not been cancelled!.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {confirmButton: "btn btn-primary"}
                        })
                    }))
                }));
                const i = t.querySelector('[data-kt-menus-modal-action="submit"]');
                i.addEventListener("click", function (t) {
                    t.preventDefault();
                    o && o.validate().then(function (t) {
                        console.log("validated!");
                        if ("Valid" === t) {
                            i.setAttribute("data-kt-indicator", "on");
                            i.disabled = !0;
                            setTimeout(function () {
                                i.removeAttribute("data-kt-indicator");
                                i.disabled = !1;

                                const menu = e.querySelector('[name="menu_name"]').value;
                                const permission_id = e.querySelector('[name="permission_id"]').value;
                                const desc = e.querySelector('[name="menu_desc"]').value;
                                const url = e.querySelector('[name="menu_url"]').value;
                                const icon = e.querySelector('[name="menu_icon"]').value;
                                const sequence = e.querySelector('[name="menu_seq"]').value;
                                const isActive = e.querySelector('[name="is_active"]').checked ? 1 : 0;
                                const isParent = e.querySelector('[name="is_parent"]').checked ? 1 : 0;
                                const isCore = e.querySelector('[name="is_core"]').checked ? 1 : 0;
                                const hasNotify = e.querySelector('[name="has_notify"]').checked ? 1 : 0;

                                const data = {
                                    menu: menu,
                                    permission_id: permission_id,
                                    desc: desc,
                                    url: url,
                                    icon: icon,
                                    sequence: sequence,
                                    is_active: isActive,
                                    is_parent: isParent,
                                    is_core: isCore,
                                    has_notify: hasNotify
                                };

                                fetch('/menus/create', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify(data)
                                })
                                    .then(response => response.json())
                                    .then(result => {
                                        console.log(result);
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
                    });
                });

            })()
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTUsersAddMenu.init()
}));
