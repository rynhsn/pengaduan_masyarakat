"use strict";
var KTUsersList = function () {
    var e, t, n, r, o = document.getElementById("kt_table_users"), c = () => {
        o.querySelectorAll('[data-kt-users-table-filter="delete_row"]').forEach((t => {
            t.addEventListener("click", (function (t) {
                t.preventDefault();
                const n = t.target.closest("tr"), r = n.querySelectorAll("td")[0].querySelectorAll("a")[1].innerText;
                Swal.fire({
                    text: "Are you sure you want to delete " + r + "?",
                    icon: "warning",
                    showCancelButton: !0,
                    buttonsStyling: !1,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then((function (t) {
                    if (t.value) {
                        const userId = n.querySelector("[data-user-id]").getAttribute("data-user-id");
                        fetch('/users/delete', {
                            method: 'delete',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({id: userId})
                        }).then((response) => {
                            return response.json();
                        }).then((response) => {
                            if (response.status === 'success') {
                                Swal.fire({
                                    text: response.message,
                                    icon: response.status,
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {confirmButton: "btn fw-bold btn-primary"}
                                }).then((function () {
                                    e.row($(n)).remove().draw()
                                }))
                            } else {
                                Swal.fire({
                                    text: response.message,
                                    icon: response.status,
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {confirmButton: "btn fw-bold btn-primary"}
                                })
                            }
                        }).catch((error) => {
                            console.log(error);
                        });
                    }else if ("cancel" ===  t.dismiss) {
                        Swal.fire({
                            text: r + " was not deleted.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {confirmButton: "btn fw-bold btn-primary"}
                        })
                    }
                }))
            }))
        })), o.querySelectorAll('[data-kt-users-table-filter="activate_row"]').forEach((e => {
            e.addEventListener("click", (function (e) {
                e.preventDefault();
                const t = e.target.closest("tr"), n = t.querySelectorAll("td")[0].querySelectorAll("a")[1].innerText, r = t.querySelector('[data-kt-users-table-filter="activate_row"]').innerText, k = t.querySelector('[data-kt-users-table-filter="activate_row"]').getAttribute("data-active-status");
                console.log(k);
                Swal.fire({
                    text: "Are you sure you want to " + r.toLowerCase() + " " + n + "?",
                    icon: "warning",
                    showCancelButton: !0,
                    buttonsStyling: !1,
                    confirmButtonText: `Yes, ${r.toLowerCase()}!`,
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then((function (e) {
                    if (e.value) {
                        const userId = t.querySelector("[data-user-id]").getAttribute("data-user-id");
                        fetch('/users/activate', {
                            method: 'post',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({id: userId, active: k})
                        }).then((response) => {
                            return response.json();
                        }).then((response) => {
                            if (response.status === 'success') {
                                Swal.fire({
                                    text: response.message,
                                    icon: response.status,
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {confirmButton: "btn fw-bold btn-primary"}
                                }).then((function (t) {
                                    t.isConfirmed && window.location.reload();
                                }))
                            } else {
                                Swal.fire({
                                    text: response.message,
                                    icon: response.status,
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {confirmButton: "btn fw-bold btn-primary"}
                                })
                            }
                        }).catch((error) => {
                            console.log(error);
                        });
                    }
                }))
            }))
        }))
    };
    return {
        init: function () {
            o && (o.querySelectorAll("tbody tr").forEach((e => {
                const t = e.querySelectorAll("td"), n = t[3].innerText.toLowerCase();
                let r = 0, o = "minutes";
                n.includes("yesterday") ? (r = 1, o = "days") : n.includes("mins") ? (r = parseInt(n.replace(/\D/g, "")), o = "minutes") : n.includes("hours") ? (r = parseInt(n.replace(/\D/g, "")), o = "hours") : n.includes("days") ? (r = parseInt(n.replace(/\D/g, "")), o = "days") : n.includes("weeks") && (r = parseInt(n.replace(/\D/g, "")), o = "weeks");
                const c = moment().subtract(r, o).format();
                t[3].setAttribute("data-order", c);
                const l = moment(t[3].innerHTML, "DD MMM YYYY, LT").format();
                t[3].setAttribute("data-order", l)
            })), (e = $(o).DataTable({
                info: !1,
                order: [],
                pageLength: 10,
                lengthChange: !1,
                // columnDefs: [{orderable: !1, targets: 4}]
            })).on("draw", (function () {
                c()
            })), document.querySelector('[data-kt-user-table-filter="search"]').addEventListener("keyup", (function (t) {
                e.search(t.target.value).draw()
            })), document.querySelector('[data-kt-user-table-filter="reset"]').addEventListener("click", (function () {
                document.querySelector('[data-kt-user-table-filter="form"]').querySelectorAll("select").forEach((e => {
                    $(e).val("").trigger("change")
                })), e.search("").draw()
            })), c(), (() => {
                const t = document.querySelector('[data-kt-user-table-filter="form"]'),
                    n = t.querySelector('[data-kt-user-table-filter="filter"]'), r = t.querySelectorAll("select");
                n.addEventListener("click", (function () {
                    var t = "";
                    r.forEach(((e, n) => {
                        e.value && "" !== e.value && (0 !== n && (t += " "), t += e.value)
                    })), e.search(t).draw()
                }))
            })())
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTUsersList.init()
}));