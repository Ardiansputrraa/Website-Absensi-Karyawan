<x-header></x-header>

<script>
    function showTambahKetidakhadiranModal() {
        $('#tambahLogbookModal').modal('show');
    }

    function tambahLogbook() {
        let tanggal = $('#tanggal').val();
        let file = $('#file')[0].files[0];
        let deskripsi = $('#deskripsi').val();

        if (tanggal === "") {
            $("#helpTanggal")
                .text("Silahkan pilih tanggal!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#tanggal").focus();
            return;
        }

        if (tanggal !== "") {
            $("#helpTanggal")
                .text("")
                .removeClass("is-danger");
        }

        if (!file) {
            $("#helpFile")
                .text("Silahkan masukan bukti kegiatan!")
                .removeClass("is-safe")
                .addClass("is-danger");
            return;
        }

        if (file) {
            $("#helpFile")
                .text("")
                .removeClass("is-danger");
        }

        if (deskripsi === "") {
            $("#helpDeskripsi")
                .text("Silahkan masukan deskripsi!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#deskripsi").focus();
            return;
        }

        if (deskripsi !== "") {
            $("#helpDeskripsi")
                .text("")
                .removeClass("is-danger");
        }

        let formInput = new FormData();
        formInput.append('_token', "{{ csrf_token() }}");
        formInput.append('date', tanggal);
        formInput.append('file', file);
        formInput.append('deskripsi', deskripsi);

        $.ajax({
            url: `/tambah-logbook`,
            type: "POST",
            data: formInput,
            contentType: false,
            processData: false,
            success: function(response) {
                Swal.fire({
                    title: "Berhasil",
                    text: "Tambah laporan berhasil!",
                    icon: "success",
                    confirmButtonText: "Oke",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Data laporan gagal ditambahkan.",
                    confirmButtonText: "Tutup",
                });
            }
        });
    }

    function detailLogbook(id) {
        $.ajax({
            url: `/detail-logbook/${id}`,
            type: "GET",
            success: function(response) {
                $('#idLogbook').val(response.data.id);
                const filePath = response.data.file;
                const fileName = filePath.split('/').pop()
                // $('#editFile').val(fileName);
                $('#editTanggal').val(response.data.date);
                $('#editDeskripsi').val(response.data.deskripsi);
                $('#editLogbookModal').modal('show');
            },
            error: function(xhr) {
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Data kegiatan tidak ditemukan.",
                    confirmButtonText: "Tutup",
                });
            }
        });
    }

    function editLogbook() {
        let idLogbook = $('#idLogbook').val();
        let tanggal = $('#editTanggal').val();
        let file = $('#editFile')[0].files[0];
        let deskripsi = $('#editDeskripsi').val();

        if (tanggal === "") {
            $("#helpEditTanggal")
                .text("Silahkan pilih tanggal!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#editTanggal").focus();
            return;
        }

        if (tanggal !== "") {
            $("#helpEditTanggal")
                .text("")
                .removeClass("is-danger");
        }

        if (deskripsi === "") {
            $("#helpEditDeskripsi")
                .text("Silahkan masukan deskripsi!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#editDeskripsi").focus();
            return;
        }

        if (deskripsi !== "") {
            $("#helpEditDeskripsi")
                .text("")
                .removeClass("is-danger");
        }

        let formInputEdit = new FormData();

        if (file) {
            formInputEdit.append('file', file);
        }

        formInputEdit.append('id', idLogbook);
        formInputEdit.append('_token', "{{ csrf_token() }}");
        formInputEdit.append('date', tanggal);
        formInputEdit.append('deskripsi', deskripsi);

        $.ajax({
            url: `/edit-logbook`,
            type: "POST",
            data: formInputEdit,
            contentType: false,
            processData: false,
            success: function(response) {
                Swal.fire({
                    title: "Berhasil",
                    text: "Edit logbook berhasil!",
                    icon: "success",
                    confirmButtonText: "Oke",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Data logbook gagal diubah.",
                    confirmButtonText: "Tutup",
                });
            }
        });
    }

    function hapusLogbook(id) {
        $.ajax({
            type: "GET",
            url: `/delete-logbook/${id}`,
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
        <x-sidebaruser></x-sidebaruser>

        <!-- Profile -->
        <x-profile></x-profile>

        <!-- Main Content -->
        <main class="main-content">
            <div class="card">
                <h2>Laporan Harian</h2>

                <!-- Container untuk input tanggal & tombol -->
                <div class="date-container">
                    <!-- Tombol Tambah Data -->
                    <button class="add-button" type="button" onclick="showTambahKetidakhadiranModal()">Tambah Laporan</button>
                </div>

                <!-- Tabel tetap di bawah -->
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logbook as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->date }}</td>
                            <td>{{ $item->deskripsi }}</td>
                            <td class="action-buttons">
                                <a class="edit-btn"
                                    href="{{ route('download.logbook', $item->id) }}">
                                    <img src="{{ asset('image/download.png') }}">
                                </a>
                                <button class="edit-btn" type="button" onclick="detailLogbook('{{ $item->id }}')">
                                    <img src="{{ asset('image/edit.png') }}">
                                </button>
                                <button class="delete-btn" type="button"
                                    onclick="hapusLogbook('{{ $item->id }}')">
                                    <img src="{{ asset('image/delete.png') }}">
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal Tambah Logbook -->
            <div class="modal fade" id="tambahLogbookModal" tabindex="-1"
                aria-labelledby="tambahLogbookModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahLogbookModalLabel">Tambah Laporan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formTambahKegiatan">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="name" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Masukkan nama lengkap"
                                            value="{{ Auth::user()->pegawai->name }}" disabled readonly>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="jabatan" class="form-label">Jabatan</label>
                                        <input type="text" class="form-control" id="jabatan" name="jabatan"
                                            placeholder="Masukkan jabatan"
                                            value="{{ Auth::user()->pegawai->position }}" disabled readonly>
                                        <p id="helpJabatan" class="help is-hidden"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="tanggal" class="form-label">Tanggal</label>
                                        <input type="date" class="form-control" id="tanggal"
                                            name="tanggal">
                                        <p id="helpTanggal" class="help is-hidden"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="file" class="form-label">Bukti Kegiatan</label>
                                        <input type="file" class="form-control" id="file" name="file"
                                            placeholder="Masukkan bukti kegiatan">
                                        <p id="helpFile" class="help is-hidden"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                        <textarea type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukkan deskrips"></textarea>
                                        <p id="helpDeskripsi" class="help is-hidden"></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn app-btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="button" onclick="tambahLogbook()" form="formTambahKegiatan"
                                class="btn btn-primary text-white">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Laporan -->
            <div class="modal fade" id="editLogbookModal" tabindex="-1"
                aria-labelledby="editLogbookModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editLogbookModalLabel">Edit Laporan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formTambahKegiatan">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="name" class="form-label">Nama Lengkap</label>
                                        <p id="idLogbook" class="help is-hidden"></p>
                                        <input type="text" class="form-control" id="editName" name="editName"
                                            placeholder="Masukkan nama lengkap"
                                            value="{{ Auth::user()->pegawai->name }}" disabled readonly>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="name" class="form-label">Jabatan</label>
                                        <input type="text" class="form-control" id="editJabatan" name="editJabatan"
                                            placeholder="Masukkan nama lengkap"
                                            value="{{ Auth::user()->pegawai->position }}" disabled readonly>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="editTanggal" class="form-label">Tanggal</label>
                                        <input type="date" class="form-control" id="editTanggal"
                                            name="editTanggal">
                                        <p id="helpEditTanggal" class="help is-hidden"></p>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="file" class="form-label">Bukti Kegiatan</label>
                                        <input type="file" class="form-control" id="editFile" name="editFile"
                                            placeholder="Masukkan bukti kegiatan">
                                        <p id="helpEditFile" class="help is-hidden"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                        <textarea type="text" class="form-control" id="editDeskripsi" name="editDeskripsi"
                                            placeholder="Masukkan deskrips"></textarea>
                                        <p id="helpEditDeskripsi" class="help is-hidden"></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn app-btn-secondary"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="button" onclick="editLogbook()" form="formTambahKegiatan"
                                class="btn btn-primary text-white">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
</body>

</html>