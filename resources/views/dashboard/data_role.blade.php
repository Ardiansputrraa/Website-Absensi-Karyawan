<x-header></x-header>

<script>
    function showTambahRoleModal() {
        $('#tambahRoleModal').modal('show');
    }

    function tambahRole() {
        let role = $('#role').val();

        if (role === "") {
            $("#helpRole")
                .text("Silahkan masukan role!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#role").focus();
            return;
        }

        if (role !== "") {
            $("#helpRole")
                .text("")
                .removeClass("is-danger");
        }

        $.ajax({
            url: `/tambah-role`,
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                role: role,
            },
            success: function(response) {
                Swal.fire({
                    title: "Berhasil",
                    text: "Tambah role berhasil!",
                    icon: "success",
                    confirmButtonText: "Oke",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#role').val("");
                        window.location.reload();
                    }
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Data role gagal ditambahkan.",
                    confirmButtonText: "Tutup",
                });
            }
        });
    }

    function detailRole(id) {
        $.ajax({
            url: `/detail-role/${id}`,
            type: "GET",
            success: function(response) {
                $('#idRole').val(response.data.id);
                $('#editRole').val(response.data.role);

                $('#editRoleModal').modal('show');
            },
            error: function(xhr) {
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Data role tidak ditemukan.",
                    confirmButtonText: "Tutup",
                });
            }
        });
    }

    function updateRole() {
        let idRole = $('#idRole').val();
        let role = $('#editRole').val();

        if (role === "") {
            $("#helpEditRole")
                .text("Silahkan masukan jabatan!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#editRole").focus();
            return;
        }

        if (role !== "") {
            $("#helpEditRole")
                .text("")
                .removeClass("is-danger");
        }

        $.ajax({
            url: `/edit-role`,
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: idRole,
                role: role,

            },
            success: function(response) {
                Swal.fire({
                    title: "Berhasil",
                    text: "Edit role berhasil!",
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
                    text: "Data role gagal diubah.",
                    confirmButtonText: "Tutup",
                });
            }
        });
    }

    function hapusRole(id) {
        $.ajax({
            type: "GET",
            url: `/delete-role/${id}`,
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
                <h2>Data Role</h2>
                <!-- Tombol Tambah Data -->
                <div class="button-container" type="button" onclick="showTambahRoleModal()">
                    <button class="add-button">Tambah Data</button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $role->role }}</td>
                            <td class="action-buttons">
                                <button class="edit-btn" type="button" onclick="detailRole('{{ $role->id }}')">
                                    <img src="{{ asset('image/edit.png') }}" alt="Edit">
                                </button>
                                <button class="delete-btn" type="button" onclick="hapusRole('{{ $role->id }}')">
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

    <!-- Modal Tambah Role -->
    <div class="modal fade" id="tambahRoleModal" tabindex="-1"
        aria-labelledby="tambahRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahRoleModalLabel">Tambah Jabatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formTambahKegiatan">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label for="narasumber" class="form-label">Role</label>
                                <input type="text" class="form-control" id="role" name="role"
                                    placeholder="Masukkan role baru">
                                <p id="helpRole" class="help is-hidden"></p>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn app-btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" onclick="tambahRole()" form="formTambahKegiatan"
                        class="btn btn-primary text-white">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Role -->
    <div class="modal fade" id="editRoleModal" tabindex="-1"
        aria-labelledby="editRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRoleModalLabel">Edit Jabatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formTambahKegiatan">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label for="narasumber" class="form-label">Role</label>
                                <p id="idRole" class="help is-hidden"></p>
                                <input type="text" class="form-control" id="editRole" name="editRole"
                                    placeholder="Masukkan role baru">
                                <p id="helpEditRole" class="help is-hidden"></p>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn app-btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" onclick="updateRole()" form="formTambahKegiatan"
                        class="btn btn-primary text-white">Edit</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>