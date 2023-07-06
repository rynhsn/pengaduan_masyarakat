"use strict";
var KTUsersMenusList = function (input, init) {
    var t, e;
    return {
        init: function () {
            (e = document.querySelector("#kt_menus_table")) && (e.querySelectorAll("tbody tr").forEach((t => {
                const e = t.querySelectorAll("td"), n = moment(e[2].innerHTML, "DD MMM YYYY, LT").format();
                e[2].setAttribute("data-order", n)
            })), t = $(e).DataTable({
                // responsive: true,
                info: !1,
                order: [],
                // columnDefs: [{orderable: !1, targets: 1}, {orderable: !1, targets: 3}]
            }), document.querySelector('[data-kt-menus-table-filter="search"]').addEventListener("keyup", (function (e) {
                t.search(e.target.value).draw()
            })), e.querySelectorAll('[data-kt-menus-table-filter="delete_row"]').forEach((e => {
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
                        const menuId = n.querySelector("[data-menu-id]").getAttribute("data-menu-id");
                        const menuName = n.querySelectorAll("td")[0].innerText;
                        const url = n.querySelector("[data-url-delete]").getAttribute("data-url-delete");
                        const data = {
                            menu_id: menuId
                        };
                        if (e.value) {
                            fetch(url, {
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
            })), e.querySelectorAll('[data-bs-target="#kt_modal_update_menu"]').forEach((e => {
                e.addEventListener("click", (function (e) {
                    e.preventDefault();
                    t = document.getElementById("kt_modal_update_menu");
                    const n = e.target.closest("tr")
                    const o = t.querySelector("#kt_modal_update_menu_form");

                    const menuId = n.querySelector("[data-menu-id]").getAttribute("data-menu-id");
                    const data = {
                        menu_id: menuId
                    };
                    fetch('/menus/get', {
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
                            o.querySelector('#menu_id').value = response.data.id;
                            $(o.querySelector('#permission_id_update')).val(response.data.permission_id).trigger("change.select2");
                            o.querySelector('#menu_name').value = response.data.menu;
                            o.querySelector('#menu_seq').value = response.data.sequence;
                            o.querySelector('#menu_icon').value = response.data.icon;
                            o.querySelector('#menu_url').value = response.data.url;
                            o.querySelector('#is_parent').checked = (response.data.is_parent === "1");
                            o.querySelector('#is_active').checked = (response.data.is_active === "1");
                            o.querySelector('#is_core').checked = (response.data.is_core === "1");
                            o.querySelector('#has_notify').checked = (response.data.has_notify === "1");
                            o.querySelector('#menu_desc').value = response.data.description;
                            o.querySelector('#preview_icon_update').className = response.data.icon;
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
    KTUsersMenusList.init()
}));