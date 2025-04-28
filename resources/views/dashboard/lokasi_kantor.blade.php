<x-header></x-header>

<script>
    function showTambahLokasiModal() {
        $('#tambahLokasiKantorModal').modal('show');

        // Menunggu modal terbuka sempurna, lalu resize map agar tampil dengan baik
        setTimeout(function() {
            map.invalidateSize();
        }, 500);
    }

    function tambahLokasiKantor() {
        let namaKantor = $('#namaKantor').val();
        let alamat = $('#alamat').val();
        let latitude = $('#latitude').val();
        let longitude = $('#longitude').val();
        let radius = $('#radius').val();


        if (namaKantor === "") {
            $("#helpNamaKantor")
                .text("Silahkan masukan nama kantor!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#namaKantor").focus();
            return;
        }

        if (namaKantor !== "") {
            $("#helpNamaKantor")
                .text("")
                .removeClass("is-danger");
        }

        if (alamat === "") {
            $("#helpAlamat")
                .text("Silahkan cari lokasi terlebih dahulu!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#alamat").focus();
            return;
        }

        if (alamat !== "") {
            $("#helpAlamat")
                .text("")
                .removeClass("is-danger");
        }

        if (latitude === "") {
            $("#helpLatitude")
                .text("Silahkan cari lokasi terlebih dahulu!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#latitude").focus();
            return;
        }

        if (latitude !== "") {
            $("#helpLatitude")
                .text("")
                .removeClass("is-danger");
        }

        if (longitude === "") {
            $("#helpLongitude")
                .text("Silahkan cari lokasi terlebih dahulu!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#longitude").focus();
            return;
        }

        if (longitude !== "") {
            $("#helpLongitude")
                .text("")
                .removeClass("is-danger");
        }

        if (radius === "") {
            $("#helpRadius")
                .text("Silahkan masukan radius kantor!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#radius").focus();
            return;
        }

        if (radius !== "") {
            $("#helpRadius")
                .text("")
                .removeClass("is-danger");
        }

        $.ajax({
            url: `/create-lokasi-kantor`,
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                nama_kantor: namaKantor,
                alamat: alamat,
                latitude: latitude,
                longitude: longitude,
                radius: radius,

            },
            success: function(response) {
                Swal.fire({
                    title: "Berhasil",
                    text: "Tambah lokasi kantor berhasil!",
                    icon: "success",
                    confirmButtonText: "Oke",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#namaKantor').val("");
                        $('#alamat').val("");
                        $('#latitude').val("");
                        $('#longitude').val("");
                        $('#radius').val("");
                        window.location.reload();
                    }
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Data lokasi kantor gagal ditambahkan.",
                    confirmButtonText: "Tutup",
                });
            }
        });
    }

    function detailLokasiKantor(id) {
        $.ajax({
            url: `/detail-lokasi-kantor/${id}`,
            type: "GET",
            success: function(response) {
                console.log(response)
                $('#idLokasi').val(response.data.id);
                $('#editNamaKantor').val(response.data.nama_kantor);
                $('#editAlamat').val(response.data.alamat);
                $('#editLatitude').val(response.data.latitude);
                $('#editLongitude').val(response.data.longitude);
                $('#editRadius').val(response.data.radius);

                setTimeout(function() {
                editMap.invalidateSize(); // Resize peta agar tetap tampil dengan benar
                updateMarkerEdit(response.data.latitude, response.data.longitude); // Tetapkan marker pada lokasi yang sesuai
            }, 500);

                $('#editLokasiKantorModal').modal('show');
            },
            error: function(xhr) {
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Data lokasi kantor tidak ditemukan.",
                    confirmButtonText: "Tutup",
                });
            }
        });
    }

    function updateLokasiKantor() {
        let idLokasi = $('#idLokasi').val();
        let namaKantor = $('#editNamaKantor').val();
        let alamat = $('#editAlamat').val();
        let latitude = $('#editLatitude').val();
        let longitude = $('#editLongitude').val();
        let radius = $('#editRadius').val();


        if (namaKantor === "") {
            $("#helpEditNamaKantor")
                .text("Silahkan masukan nama kantor!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#editNamaKantor").focus();
            return;
        }

        if (namaKantor !== "") {
            $("#helpEditNamaKantor")
                .text("")
                .removeClass("is-danger");
        }

        if (alamat === "") {
            $("#helpEditAlamat")
                .text("Silahkan cari lokasi terlebih dahulu!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#editAlamat").focus();
            return;
        }

        if (alamat !== "") {
            $("#helpEditAlamat")
                .text("")
                .removeClass("is-danger");
        }

        if (latitude === "") {
            $("#helpEditLatitude")
                .text("Silahkan cari lokasi terlebih dahulu!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#editLatitude").focus();
            return;
        }

        if (latitude !== "") {
            $("#helpEditLatitude")
                .text("")
                .removeClass("is-danger");
        }

        if (longitude === "") {
            $("#helpEditLongitude")
                .text("Silahkan cari lokasi terlebih dahulu!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#editLongitude").focus();
            return;
        }

        if (longitude !== "") {
            $("#helpEditLongitude")
                .text("")
                .removeClass("is-danger");
        }

        if (radius === "") {
            $("#helpEditRadius")
                .text("Silahkan masukan radius kantor!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#editRadius").focus();
            return;
        }

        if (radius !== "") {
            $("#helpEditRadius")
                .text("")
                .removeClass("is-danger");
        }

        $.ajax({
            url: `/edit-lokasi-kantor`,
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: idLokasi,
                nama_kantor: namaKantor,
                alamat: alamat,
                latitude: latitude,
                longitude: longitude,
                radius: radius,
            },
            success: function(response) {
                Swal.fire({
                    title: "Berhasil",
                    text: "Edit lokasi kantor berhasil!",
                    icon: "success",
                    confirmButtonText: "Oke",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#editNamaKantor').val("");
                        $('#editAlamat').val("");
                        $('#editLatitude').val("");
                        $('#editLongitude').val("");
                        $('#editRadius').val("");
                        window.location.reload();
                    }
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Data lokasi kantor gagal ditambahkan.",
                    confirmButtonText: "Tutup",
                });
            }
        });
    }


    function hapusLokasiKantor(id) {
        $.ajax({
            type: "GET",
            url: `/delete-lokasi-kantor/${id}`,
            success: function(response) {
                Swal.fire({
                    title: "Berhasil",
                    text: response.success,
                    icon: "success",
                    confirmButtonText: "Oke",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseJSON.error);
            },
        });
    }
</script>

<body>
    <div class="container">
        <!-- Sidebar -->
        <x-sidebar></x-sidebar>

        <!-- Profile -->
        <x-profile></x-profile>

        <!-- Main Content -->
        <main class="main-content">
            <div class="card">
                <h2>Data Lokasi Kantor</h2>
                <!-- Tombol Tambah Data -->
                <div class="button-container">
                    <button class="add-button" type="button" onclick="showTambahLokasiModal()">Tambah Data</button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kantor</th>
                            <th>Alamat</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Radius</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lokasiKantor as $lokasi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $lokasi->nama_kantor }}</td>
                            <td>{{ $lokasi->alamat }}</td>
                            <td>{{ $lokasi->latitude }}</td>
                            <td>{{ $lokasi->longitude }}</td>
                            <td>{{ $lokasi->radius }}</td>
                            <td class="action-buttons">
                                <button class="edit-btn" type="button" onclick="detailLokasiKantor('{{ $lokasi->id }}')">
                                    <img src="{{ asset('image/edit.png') }}" alt="Edit">
                                </button>
                                <button class="delete-btn" type="button" onclick="hapusLokasiKantor('{{ $lokasi->id }}')">
                                    <img src="{{ asset('image/delete.png') }}" alt="Delete">
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Modal Tambah Lokasi Kantor -->
    <div class="modal fade" id="tambahLokasiKantorModal" tabindex="-1"
        aria-labelledby="tambahLokasiKantorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahLokasiKantorModalLabel">Tambah Lokasi Kantor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 mb-4">
                        <div class="d-flex">
                            <input type="text" class="form-control me-2" id="search_address" name="search_address" placeholder="Cari Lokasi">
                            <button id="search_btn" class="btn btn-primary text-white">Cari Lokasi</button>
                        </div>
                    </div>
                    <div id="map"></div>

                    <form>
                        <div class="row g-3">

                            <div class="col-md-12">
                                <label for="nama_kantor" class="form-label">Nama Kantor</label>
                                <input type="text" class="form-control" id="namaKantor" name="namaKantor"
                                    placeholder="Masukkan Nama Kantor">
                                <p id="helpNamaKantor" class="help is-hidden"></p>
                            </div>
                            <div class="col-md-12">
                                <label for="alamat" class="form-label">Alamat Kantor</label>
                                <input type="text" class="form-control" id="alamat" name="alamat"
                                    placeholder="Masukkan Alamat Kantor" readonly disabled>
                                <p id="helpAlamat" class="help is-hidden"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="latitude" class="form-label">Latitude Kantor</label>
                                <input type="text" class="form-control" id="latitude" name="latitude"
                                    placeholder="Masukkan Latitude Kantor" readonly disabled>
                                <p id="helpLatitude" class="help is-hidden"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="longitude" class="form-label">Longitude Kantor</label>
                                <input type="text" class="form-control" id="longitude" name="longitude"
                                    placeholder="Masukkan Longitude Kantor" readonly disabled>
                                <p id="helpLongitude" class="help is-hidden"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="radius" class="form-label">Radius Kantor</label>
                                <input type="number" class="form-control" id="radius" name="radius"
                                    placeholder="Masukkan Radius Kantor (meter)">
                                <p id="helpRadius" class="help is-hidden"></p>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn app-btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" onclick="tambahLokasiKantor()"
                        class="btn btn-primary text-white">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Lokasi Kantor -->
    <div class="modal fade" id="editLokasiKantorModal" tabindex="-1"
        aria-labelledby="editLokasiKantorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLokasiKantorModalLabel">Edit Lokasi Kantor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 mb-4">
                        <div class="d-flex">
                            <input type="text" class="form-control me-2" id="search_address_edit" name="search_address_edit" placeholder="Cari Lokasi">
                            <button id="search_btn_edit" class="btn btn-primary text-white">Cari Lokasi</button>
                        </div>
                    </div>
                    <div id="editMap"></div>

                    <form>
                        <div class="row g-3">

                            <div class="col-md-12">
                                <label for="editNamaKantor" class="form-label">Nama Kantor</label>
                                <p id="idLokasi" class="help is-hidden"></p>
                                <input type="text" class="form-control" id="editNamaKantor" name="editNamaKantor"
                                    placeholder="Masukkan Nama Kantor">
                                <p id="helpEditNamaKantor" class="help is-hidden"></p>
                            </div>
                            <div class="col-md-12">
                                <label for="editAlamat" class="form-label">Alamat Kantor</label>
                                <input type="text" class="form-control" id="editAlamat" name="editAlamat"
                                    placeholder="Masukkan Alamat Kantor" readonly disabled>
                                <p id="helpEditAlamat" class="help is-hidden"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="editLatitude" class="form-label">Latitude Kantor</label>
                                <input type="text" class="form-control" id="editLatitude" name="editLatitude"
                                    placeholder="Masukkan Latitude Kantor" readonly disabled>
                                <p id="helpEditLatitude" class="help is-hidden"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="editLongitude" class="form-label">Longitude Kantor</label>
                                <input type="text" class="form-control" id="editLongitude" name="editLongitude"
                                    placeholder="Masukkan Longitude Kantor" readonly disabled>
                                <p id="helpEditLongitude" class="help is-hidden"></p>
                            </div>

                            <div class="col-md-12">
                                <label for="editRadius" class="form-label">Radius Kantor</label>
                                <input type="number" class="form-control" id="editRadius" name="editRadius"
                                    placeholder="Masukkan Radius Kantor (meter)">
                                <p id="helpEditRadius" class="help is-hidden"></p>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn app-btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" onclick="updateLokasiKantor()"
                        class="btn btn-primary text-white">Edit</button>
                </div>
            </div>
        </div>
    </div>

</body>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>

<style>
    /* Pastikan map memiliki ukuran yang sesuai */
    #map {
        width: 100%;
        height: 400px;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    /* Responsif untuk modal */
    @media (max-width: 768px) {
        #map {
            height: 300px;
        }
    }

    #editMap {
        width: 100%;
        height: 400px;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    /* Responsif untuk modal */
    @media (max-width: 768px) {
        #editMap {
            height: 300px;
        }
    }
</style>

<script>
    var map = L.map('map').setView([-6.200000, 106.816666], 12); // Jakarta
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    var marker = null;

    function updateMarker(lat, lng) {
        if (marker) {
            map.removeLayer(marker);
        }
        marker = L.marker([lat, lng]).addTo(map);
        $("#latitude").val(lat);
        $("#longitude").val(lng);
        map.setView([lat, lng], 15);
    }

    function onMapClick(e) {
        updateMarker(e.latlng.lat, e.latlng.lng);
    }

    map.on('click', onMapClick);

    $("#search_btn").on("click", function() {
        var address = $("#search_address").val();
        if (address.trim() === "") {
            alert("Masukkan alamat yang ingin dicari.");
            return;
        }

        $.getJSON(`https://nominatim.openstreetmap.org/search?format=json&q=${address}`, function(data) {
            if (data.length > 0) {
                var lat = data[0].lat;
                var lon = data[0].lon;
                $("#alamat").val(data[0].display_name);
                updateMarker(lat, lon);
            } else {
                alert("Alamat tidak ditemukan. Coba alamat lain.");
            }
        });
    });

    var editMap = L.map('editMap').setView([-6.200000, 106.816666], 12); // Jakarta
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(editMap);

    var editMarker = null;

    function updateMarkerEdit(lat, lng) {
        if (editMarker) {
            editMap.removeLayer(editMarker);
        }
        editMarker = L.marker([lat, lng]).addTo(editMap);
        $("#editLatitude").val(lat);
        $("#editLongitude").val(lng);
        editMap.setView([lat, lng], 15);
    }

    function onMapClickEdit(e) {
        updateMarkerEdit(e.latlng.lat, e.latlng.lng);
    }

    editMap.on('click', onMapClickEdit);

    $("#search_btn_edit").on("click", function() {
        var addressEdit = $("#search_address_edit").val();
        if (addressEdit.trim() === "") {
            alert("Masukkan alamat yang ingin dicari.");
            return;
        }

        $.getJSON(`https://nominatim.openstreetmap.org/search?format=json&q=${addressEdit}`, function(data) {
            if (data.length > 0) {
                var lat = data[0].lat;
                var lon = data[0].lon;
                $("#editAlamat").val(data[0].display_name);
                updateMarkerEdit(lat, lon);
            } else {
                alert("Alamat tidak ditemukan. Coba alamat lain.");
            }
        });
    });
</script>