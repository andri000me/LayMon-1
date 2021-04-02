let mobil = $('#mobil-data').DataTable({
        responsive: true,
        ajax: {
            "url":readUrl,
            "dataSrc": function(data){
                if(data.data == null){
                    return [];
                } else {
                    return data.data;
                }
            }
        },
        columnDefs: [{
            searchable: false,
            orderable: false,
            targets: 0
        }],
        columns: [{
            defaultContent: '',
            data: "id_mobil"
        }, {
            defaultContent: '',
            data: "nopol_mobil"
        }, {
            defaultContent: '',
            data: "merk_mobil"
        }, {
            defaultContent: '',
            data: "kapasitas_mobil"
        }, {
            defaultContent: '',
            data: "action"
        }],
        "lengthChange": true,
        "lengthMenu": [[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]],
        "paging":   true,
        "ordering": true,
        "info": true
      });

function reloadTable() {
    mobil.ajax.reload()
}

mobil.on("order.dt search.dt", () => {
    mobil.column(0, {
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
                if (dataSimpan.errData === true) {
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
                if (dataUpdate.errData === true) {
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
});