let pengiriman = $('#pengiriman-data').DataTable({
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
            data: 'id_mon'
        }, {
            defaultContent: '',
            data: 'kodejalan'
        }, {
            defaultContent: '',
            data: 'nopol'
        }, {
            defaultContent: '',
            data: 'supir'
        }, {
            defaultContent: '',
            data: 'pelanggan'
        }, {
            defaultContent: '',
            data: 'start'
        }, {
            defaultContent: '',
            data: 'end'
        }, {
            defaultContent: '',
            data: 'status'
        }, {
            defaultContent: '',
            data: 'tanggal'
        }, {
            defaultContent: '',
            data: 'action'
        }],
        "lengthChange": true,
        "lengthMenu": [[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]],
        "paging":   true,
        "ordering": true,
        "info": true
      });

function reloadTable() {
    pengiriman.ajax.reload()
}

pengiriman.on("order.dt search.dt", () => {
    pengiriman.column(0, {
        search: "applied",
        order: "applied"
    }).nodes().each((el, val) => {
        el.innerHTML = val + 1
    })
});

let center = null,zoom = 16,map = L.map('map'),markers = null,atLayer = null;

map.on('click', function(e) {
    Swal.fire("Data Kordinat", e.latlng.lat+","+e.latlng.lng, "info");
});

function showMap(lat,long, message = '') {
    center = [lat, long];
    atLayer = new L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });

    map.setView(new L.LatLng(lat,long), zoom);
    map.addLayer(atLayer);

    markers = L.marker(center).bindPopup("I am here"+message).addTo(map);
}

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        Swal.fire("Unsupported Browser", 'Geolocation is not supported by this browser.', "error");
    }
}

function showPosition(position) {
    showMap(position.coords.latitude, position.coords.longitude);
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            Swal.fire("Denied Access", 'User denied the request for Geolocation.', "error");
            break;
        case error.POSITION_UNAVAILABLE:
            Swal.fire("Unavailable Access", 'Location information is unavailable.', "error");
            break;
        case error.TIMEOUT:
            Swal.fire("Timeout Access", 'The request to get user location timed out.', "error");
            break;
        case error.UNKNOWN_ERROR:
            Swal.fire("Unknow Access", 'An unknown error occurred.', "error");
            break;
    }
}

function dataMap(id) {
    $.ajax({
        url: dataMapUrl,
        type: "post",
        dataType: "json",
        data: {"id": id},
        success: (dataMaps) => {
            if (dataMaps.errData === true) {
                Swal.fire("Gagal", dataMaps.message, "error");
            } else {
                let strMap = dataMaps.data.end_mon,
                    split = strMap.split(','),
                    latStr = split[0],longStr = split[1];

                showMap(latStr, longStr);
            }
        },
        error: err => {
            console.log(err)
        }
    });
}

$(document).ready(function () {
    getLocation();

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