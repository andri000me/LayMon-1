let pelanggan = $('#pelanggan-data').DataTable({
        responsive: true,
        ajax: {"url":readUrl,"dataSrc":'data'},
        columnDefs: [{
            searcable: false,
            orderable: false,
            targets: 0
        }],
        columns: [{
            data: "id_pelanggan"
        }, {
            data: "nama_pelanggan"
        }, {
            data: "nohp_pelanggan"
        }, {
            data: "alamat_pelanggan"
        }, {
            data: "username_user"
        }, {
            data: "action"
        }],
        "lengthChange": true,
        "lengthMenu": [[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]],
        "paging":   true,
        "ordering": true,
        "info": true
      });

function reloadTable() {
    pelanggan.ajax.reload()
}

pelanggan.on("order.dt search.dt", () => {
    pelanggan.column(0, {
        search: "applied",
        order: "applied"
    }).nodes().each((el, val) => {
        el.innerHTML = val + 1
    })
});

$(document).ready(function () {
    $(".form-create").submit(function (event) {
        $.ajax({
            url: addUrl,
            type: "post",
            dataType: "json",
            data: $(".form-create").serialize(),
            success: (dataSimpan) => {
                reloadTable();
                if (dataSimpan.error === true) {
                    let errorList='';

                    Object.keys(dataSimpan.errorMsg).forEach(function(key) {
                        errorList += '<p>'+dataSimpan.errorMsg[key]+'<p>';
                    });

                    Swal.fire("Gagal", dataSimpan.message+'<hr class="hr">'+errorList, "error").then(function() {
                        window.location.href = dataSimpan.redirect;
                    });;
                } else {
                    Swal.fire("Sukses", dataSimpan.message, "success").then(function() {
                        window.location.href = dataSimpan.redirect;
                    });;
                }
            },
            error: err => {
                console.log(err)
            }
        });

        event.preventDefault();
    });

    $(".form-update").submit(function (event) {
        $.ajax({
            url: editUrl,
            type: "post",
            dataType: "json",
            data: $(".form-update").serialize(),
            success: (dataUpdate) => {
                reloadTable();
                if (dataUpdate.error === true) {
                    let errorList='';

                    Object.keys(dataUpdate.errorMsg).forEach(function(key) {
                        errorList += '<p>'+dataUpdate.errorMsg[key]+'<p>';
                    });

                    Swal.fire("Gagal", dataUpdate.message+'<hr class="hr">'+errorList, "error").then(function() {
                        window.location.href = dataUpdate.redirect;
                    });;
                } else {
                    Swal.fire("Sukses", dataUpdate.message, "success").then(function() {
                        window.location.href = dataUpdate.redirect;
                    });;
                }
            },
            error: err => {
                console.log(err)
            }
        });

        event.preventDefault();
    });

    $(".form-updateuser").submit(function (event) {
        $.ajax({
            url: edituserUrl,
            type: "post",
            dataType: "json",
            data: $(".form-updateuser").serialize(),
            success: (dataUpdateUser) => {
                reloadTable();
                if (dataUpdateUser.error === true) {
                    let errorList='';

                    Object.keys(dataUpdateUser.errorMsg).forEach(function(key) {
                        errorList += '<p>'+dataUpdateUser.errorMsg[key]+'<p>';
                    });

                    Swal.fire("Gagal", dataUpdateUser.message+'<hr class="hr">'+errorList, "error").then(function() {
                        window.location.href = dataUpdateUser.redirect;
                    });;
                } else {
                    Swal.fire("Sukses", dataUpdateUser.message, "success").then(function() {
                        window.location.href = dataUpdateUser.redirect;
                    });;
                }
            },
            error: err => {
                console.log(err)
            }
        });

        event.preventDefault();
    });
});