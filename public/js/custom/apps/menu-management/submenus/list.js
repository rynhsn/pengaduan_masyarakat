"use strict";
var KTUsersSubMenusList = function (input, init) {
    var t, e;
    return {
        init: function () {
            (e = document.querySelector("#kt_submenus_table")) && (e.querySelectorAll("tbody tr").forEach((t => {
                const e = t.querySelectorAll("td"), n = moment(e[2].innerHTML, "DD MMM YYYY, LT").format();
                e[2].setAttribute("data-order", n)
            })), t = $(e).DataTable({
                // responsive: true,
                info: !1,
                order: [],
                // columnDefs: [{orderable: !1, targets: 1}, {orderable: !1, targets: 3}]
            }), document.querySelector('[data-kt-submenus-table-filter="search"]').addEventListener("keyup", (function (e) {
                t.search(e.target.value).draw()
            })), e.querySelectorAll('[data-kt-submenus-table-filter="delete_row"]').forEach((e => {
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
                        const submenuId = n.querySelector("[data-submenu-id]").getAttribute("data-submenu-id");
                        const data = {
                            id: submenuId
                        };
                        if (e.value) {
                            fetch('/submenus/delete', {
                                method: 'delete',
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify(data)
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
            })), e.querySelectorAll('[data-bs-target="#kt_modal_update_submenu"]').forEach((e => {
                e.addEventListener("click", (function (e) {
                    e.preventDefault();
                    t = document.getElementById("kt_modal_update_submenu");
                    const n = e.target.closest("tr")
                    const o = t.querySelector("#kt_modal_update_submenu_form");
                    const submenuId = n.querySelector("[data-submenu-id]").getAttribute("data-submenu-id");
                    const data = {
                        id: submenuId
                    };
                    fetch('/submenus/get', {
                        method: 'post',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(data)
                    }).then((response) => {
                        return response.json();
                    }).then((response) => {
                        console.log(response.data);
                        if (response.status === 'success') {
                            o.querySelector('#id').value = response.data.id;
                            o.querySelector('#sub_menu').value = response.data.sub_menu;
                            $(o.querySelector('#menu_id_update')).val(response.data.menu_id).trigger("change.select2");
                            o.querySelector('#permission_id_update').value = response.data.permission;
                            $(o.querySelector('#permission_id_update')).val(response.data.permission_id).trigger("change.select2");
                            o.querySelector('#sequence').value = response.data.sequence;
                            o.querySelector('#icon').value = response.data.icon;
                            o.querySelector('#url').value = response.data.url;
                            o.querySelector('#description').value = response.data.description;
                            o.querySelector('#is_active').checked = (response.data.is_active === "1");
                            o.querySelector('#has_notify').checked = (response.data.has_notify === "1");
                            o.querySelector('#preview_icon').className = response.data.icon;
                            // option.selected = true;
                        } else {
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
            })))
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTUsersSubMenusList.init()
}));