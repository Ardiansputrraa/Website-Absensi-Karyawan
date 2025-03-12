<x-header></x-header>

<script>
    function showTambahJabatanModal() {
        $('#tambahJabatanModal').modal('show');
    }

    function tambahJabatan() {
        let jabatan = $('#jabatan').val();

        if (jabatan === "") {
                $("#helpJabatan")
                    .text("Silahkan masukan jabatan!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#jabatan").focus();
                return;
            }

            if (jabatan !== "") {
                $("#helpJabatan")
                    .text("")
                    .removeClass("is-danger");
            }

        $.ajax({
                url: `/tambah-jabatan`,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    jabatan: jabatan,
                },
                success: function(response) {
                    Swal.fire({
                        title: "Berhasil",
                        text: "Tambah Jabatan berhasil!",
                        icon: "success",
                        confirmButtonText: "Oke",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#jabatan').val("");
                            window.location.reload();
                        }
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: "Data jabatan gagal ditambahkan.",
                        confirmButtonText: "Tutup",
                    });
                }
            });
    }

    function detailJabatan(id) {
        $.ajax({
                url: `/detail-jabatan/${id}`,
                type: "GET",
                success: function(response) {
                    $('#idJabatan').val(response.data.id);
                    $('#editJabatan').val(response.data.jabatan);

                    $('#editJabatanModal').modal('show');
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

    function updateJabatan() {
        let idJabatan = $('#idJabatan').val(); 
        let jabatan = $('#editJabatan').val();
        
        if (jabatan === "") {
                $("#helpEditJabatan")
                    .text("Silahkan masukan jabatan!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#editJabatan").focus();
                return;
            }

            if (jabatan !== "") {
                $("#helpEditJabatan")
                    .text("")
                    .removeClass("is-danger");
            }

        $.ajax({
                url: `/edit-jabatan`,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: idJabatan,
                    jabatan: jabatan,

                },
                success: function(response) {
                    Swal.fire({
                        title: "Berhasil",
                        text: "Edit Jabatan berhasil!",
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
                        text: "Data jabatan gagal ditambahkan.",
                        confirmButtonText: "Tutup",
                    });
                }
            });
    }

    function hapusJabatan(id) {
            $.ajax({
                type: "GET",
                url: `/delete-jabatan/${id}`,
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
                <h2>Data Jabatan</h2>
                <!-- Tombol Tambah Data -->
                <div class="button-container">
                    <button class="add-button" type="button" onclick="showTambahJabatanModal()">Tambah Data</button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Jabatan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($jabatans as $jabatan)
                    <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jabatan->jabatan }}</td>
                            <td class="action-buttons">
                                <button class="edit-btn" type="button" onclick="detailJabatan('{{ $jabatan->id }}')">
                                    <img src="{{ asset('image/edit.png') }}" alt="Edit">
                                </button>
                                <button class="delete-btn" type="button" onclick="hapusJabatan('{{ $jabatan->id }}')">
                                    <img src="{{ asset('image/delete.png') }}" alt="Delete" >
                                </button>
                            </td>
                        </tr>
                    @endforeach
                        
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Modal Tambah Pegawai -->
    <div class="modal fade" id="tambahJabatanModal" tabindex="-1"
            aria-labelledby="tambahJabatanModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahJabatanModalLabel">Tambah Jabatan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formTambahKegiatan">
                            <div class="row g-3 mt-3">
                                <div class="col-md-12">
                                    <label for="narasumber" class="form-label">Jabatan</label>
                                    <input type="text" class="form-control" id="jabatan" name="jabatan"
                                        placeholder="Masukkan jabatan baru">
                                        <p id="helpJabatan" class="help is-hidden"></p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn app-btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" onclick="tambahJabatan()" form="formTambahKegiatan"
                            class="btn btn-primary text-white">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Pegawai -->
    <div class="modal fade" id="editJabatanModal" tabindex="-1"
            aria-labelledby="editJabatanModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editJabatanModalLabel">Tambah Jabatan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formTambahKegiatan">
                            <div class="row g-3 mt-3">
                                <div class="col-md-12">
                                    <label for="narasumber" class="form-label">Jabatan</label>
                                    <p id="idJabatan" class="help is-hidden"></p>
                                    <input type="text" class="form-control" id="editJabatan" name="editJabatan"
                                        placeholder="Masukkan jabatan baru">
                                        <p id="helpEditJabatan" class="help is-hidden"></p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn app-btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" onclick="updateJabatan()" form="formTambahKegiatan"
                            class="btn btn-primary text-white">Edit</button>
                    </div>
                </div>
            </div>
        </div>


</body>
</html>
