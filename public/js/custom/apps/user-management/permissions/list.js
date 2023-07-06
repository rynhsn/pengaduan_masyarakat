"use strict";
var KTUsersPermissionsList = function () {
    var t, e;
    return {
        init: function () {
            (e = document.querySelector("#kt_permissions_table")) && (e.querySelectorAll("tbody tr").forEach((t => {
                const e = t.querySelectorAll("td"), n = moment(e[2].innerHTML, "DD MMM YYYY, LT").format();
                e[2].setAttribute("data-order", n)
            })), t = $(e).DataTable({
                info: !1, order: [], // columnDefs: [{orderable: !1, targets: 1}]
            }), document.querySelector('[data-kt-permissions-table-filter="search"]').addEventListener("keyup", (function (e) {
                t.search(e.target.value).draw()
            })), e.querySelectorAll('[data-bs-target="#kt_modal_update_permission"]').forEach((e => {
                e.addEventListener("click", (function (e) {
                    e.preventDefault();
                    t = document.getElementById("kt_modal_update_permission");
                    const n = e.target.closest("tr")
                    const o = t.querySelector("#kt_modal_update_permission_form");

                    const id = n.querySelector("[data-permission-id]").getAttribute("data-permission-id");
                    fetch('/permissions/get', {
                        method: 'post', headers: {
                            'Content-Type': 'application/json',
                        }, body: JSON.stringify({id: id})
                    }).then((response) => {
                        return response.json();
                    }).then((response) => {
                        console.log(response);
                        if (response.status === 'success') {
                            o.querySelector('#id').value = response.data.id;
                            o.querySelector('#name').value = response.data.name;
                            o.querySelector('#description').value = response.data.description;
                        } else {
                            console.log(response);
                            Swal.fire({
                                text: response.message,
                                icon: response.status,
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, got it!",
                                customClass: {confirmButton: "btn fw-bold btn-primary"}
                            }).then((function () {
                                o.hide();
                            }))
                        }
                    }).catch((error) => {
                        console.log(error);
                    });
                }))
            }))), e.querySelectorAll('[data-kt-permissions-table-filter="delete_row"]').forEach((e => {
                e.addEventListener("click", (function (e) {
                    e.preventDefault();
                    const n = e.target.closest("tr"), o = n.querySelectorAll("td")[0].innerText;
                    Swal.fire({
                        text: "Are you sure you want to delete " + o + "?",
                        icon: "warning",
                        showCancelButton: !0,
                        buttonsStyling: !1,
                        confirmButtonText: "Yes, delete!",
                        cancelButtonText: "No, cancel",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then((function (e) {

                        const permissionId = n.querySelector("[data-permission-id]").getAttribute("data-permission-id");

                        if (e.value) {
                            fetch('/permissions/delete', {
                                method: 'delete', headers: {
                                    'Content-Type': 'application/json',
                                }, body: JSON.stringify({id: permissionId})
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
                                        t.row($(n)).remove().draw()
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
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTUsersPermissionsList.init()
}));