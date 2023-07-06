"use strict";
var KTUsersAddUser = function () {
    const t = document.getElementById("kt_modal_add_user"), e = t.querySelector("#kt_modal_add_user_form"),
        n = new bootstrap.Modal(t);
    return {
        init: function () {
            (() => {
                var o = FormValidation.formValidation(e, {
                    fields: {
                        username: {
                            validators: {
                                notEmpty: {message: "Full name is required"},
                                regexp: {
                                    regexp: /^[a-zA-Z0-9]+$/,
                                    message: 'The username can only consist of alphabetical and number'
                                },
                            }
                        },
                        email: {
                            validators: {
                                notEmpty: {message: "Valid email address is required"},
                                emailAddress: {message: "Format email tidak valid"}
                            }
                        },
                        password: {
                            validators: {
                                notEmpty: {message: "Password is required"},
                                stringLength: {
                                    min: 6,
                                    max: 30,
                                    message: 'The username must be more than 6 and less than 30 characters long'
                                },
                                different: {
                                    compare: function () {
                                        return e.querySelector('[name="username"]').value;
                                    },
                                    message: 'The password and username cannot be the same as each other'
                                }
                            }
                        },
                        pass_confirm: {
                            validators: {
                                notEmpty: {
                                    message: 'The password confirmation is required'
                                },
                                identical: {
                                    compare: function () {
                                        return e.querySelector('[name="password"]').value;
                                    },
                                    message: 'The password and its confirm are not the same'
                                }
                            }
                        },
                        user_role: {
                            validators: {
                                notEmpty: {
                                    message: 'Radio input is required'
                                }
                            }
                        },
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
                const i = t.querySelector('[data-kt-users-modal-action="submit"]');
                i.addEventListener("click", (t => {
                    t.preventDefault(), o && o.validate().then((function (t) {
                        console.log("validated!");
                        if("Valid" === t) {
                            i.setAttribute("data-kt-indicator", "on");
                            i.disabled = !0;
                            setTimeout((function () {
                                i.removeAttribute("data-kt-indicator");
                                i.disabled = !1;

                                const data = {
                                    username: e.querySelector("#username").value,
                                    email: e.querySelector("#email").value,
                                    password: e.querySelector("#password").value,
                                    pass_confirm: e.querySelector("#pass_confirm").value,
                                    user_role: e.querySelector('[name="user_role"]:checked').value,
                                };

                                fetch('/users/create', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify(data)
                                }).then((response) => {
                                    return response.json();
                                }).then((response) => {
                                    console.log(response.errors);
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
                                        console.log(response.errors);
                                        console.log(response.message);
                                        let errorMessage = '';

                                        Object.keys(response.errors).forEach((fieldName) => {
                                            errorMessage += `${response.errors[fieldName]}\n`;
                                        });

                                        Swal.fire({
                                            text: errorMessage,
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
                })), t.querySelector('[data-kt-users-modal-action="cancel"]').addEventListener("click", (t => {
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
                })), t.querySelector('[data-kt-users-modal-action="close"]').addEventListener("click", (t => {
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
                }))
            })()
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTUsersAddUser.init()
}));