<x-header></x-header>

<script>
    function showTambahPegawaiModal() {
        $('#tambahPegawaiModal').modal('show');
    }

    function tambahPegawai() {
        let name = $('#name').val();
        let username = $('#username').val();
        let password = $('#password').val();
        let position = $('#position').val();
        let role = $('#role').val();
        let email = $('#email').val();
        let phoneNumber = $('#phoneNumber').val();

        if (name === "") {
            $("#helpName")
                .text("Silahkan masukan nama lengkap!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#name").focus();
            return;
        }

        if (name !== "") {
            $("#helpName")
                .text("")
                .removeClass("is-danger");
        }

        if (username === "") {
            $("#helpUsername")
                .text("Silahkan masukan username!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#username").focus();
            return;
        }

        if (username !== "") {
            $("#helpUsername")
                .text("")
                .removeClass("is-danger");
        }

        if (password === "") {
            $("#helpPassword")
                .text("Silahkan masukan password!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#password").focus();
            return;
        }

        if (password !== "") {
            $("#helpPassword")
                .text("")
                .removeClass("is-danger");
        }

        if (position === null) {
            $("#helpPosition")
                .text("Silahkan pilih jabatan!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#position").focus();
            return;
        }

        if (position !== null) {
            $("#helpPosition")
                .text("")
                .removeClass("is-danger");
        }

        if (role === null) {
            $("#helpRole")
                .text("Silahkan pilih role!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#role").focus();
            return;
        }

        if (role !== null) {
            $("#helpRole")
                .text("")
                .removeClass("is-danger");
        }

        if (email === "") {
            $("#helpEmail")
                .text("Silahkan masukan email!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#email").focus();
            return;
        }

        if (email !== "") {
            $("#helpEmail")
                .text("")
                .removeClass("is-danger");
        }

        if (phoneNumber === "") {
            $("#helpPhoneNumber")
                .text("Silahkan masukan nomer handphone!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#PhoneNumber").focus();
            return;
        }

        if (phoneNumber !== "") {
            $("#helpPhoneNumber")
                .text("")
                .removeClass("is-danger");
        }

        $.ajax({
            url: `/tambah-pegawai`,
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                username: username,
                password: password,
                name: name,
                position: position,
                role: role,
                email: email,
                phoneNumber: phoneNumber,
            },
            success: function(response) {
                Swal.fire({
                    title: "Berhasil",
                    text: "Tambah pegawai berhasil!",
                    icon: "success",
                    confirmButtonText: "Oke",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#name').val();
                        $('#username').val();
                        $('#password').val();
                        $('#position').val();
                        $('#role').val();
                        $('#email').val();
                        $('#phoneNumber').val();
                        window.location.reload();
                    }
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Data pegawai gagal ditambahkan.",
                    confirmButtonText: "Tutup",
                });
            }
        });
    }

    function detailPegawai(id) {
        $.ajax({
            url: `/detail-pegawai/${id}`,
            type: "GET",
            success: function(response) {
                $('#idPegawai').val(response.data.id);
                $('#editName').val(response.data.name);
                $('#editEmail').val(response.data.email);
                $('#editPhoneNumber').val(response.data.phone_number);
                $('#editPosition').val(response.data.position);
                $('#editRole').val(response.data.role);
                $('#editModal').modal('show');
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

    function updatePegawai() {
        let id = $('#idPegawai').val();
        let name = $('#editName').val();
        let email = $('#editEmail').val();
        let phoneNumber = $('#editPhoneNumber').val();
        let position = $('#editPosition').val();
        let role = $('#editRole').val();

        if (name === "") {
            $("#helpEditName")
                .text("Silahkan masukan nama lengkap!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#editName").focus();
            return;
        }

        if (name !== "") {
            $("#helpEditName")
                .text("")
                .removeClass("is-danger");
        }

        if (email === "") {
            $("#helpEditEmail")
                .text("Silahkan masukan email!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#editEmail").focus();
            return;
        }

        if (email !== "") {
            $("#helpEditEmail")
                .text("")
                .removeClass("is-danger");
        }

        if (phoneNumber === "") {
            $("#helpEditPhoneNumber")
                .text("Silahkan masukan nomer handphone!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#editPhoneNumber").focus();
            return;
        }

        if (phoneNumber !== "") {
            $("#helpEditPhoneNumber")
                .text("")
                .removeClass("is-danger");
        }

        if (position === null) {
            $("#helpEditPosition")
                .text("Silahkan pilih jabatan!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#editPosition").focus();
            return;
        }

        if (position !== null) {
            $("#helpEditPosition")
                .text("")
                .removeClass("is-danger");
        }

        if (role === null) {
            $("#helpEditRole")
                .text("Silahkan pilih role!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#editRole").focus();
            return;
        }

        if (role !== null) {
            $("#helpEditRole")
                .text("")
                .removeClass("is-danger");
        }

        $.ajax({
            url: `/edit-pegawai`,
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
                name: name,
                email: email,
                phone_number: phoneNumber,
                position: position,
                role: role,
            },
            success: function(response) {
                Swal.fire({
                    title: "Berhasil",
                    text: "Edit pegawai berhasil!",
                    icon: "success",
                    confirmButtonText: "Oke",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#editName').val();
                        $('#editEmail').val();
                        $('#editPhoneNumber').val();
                        $('#editPosition').val();
                        $('#editRole').val();
                        window.location.reload();
                    }
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Data pegawai gagal diubah.",
                    confirmButtonText: "Tutup",
                });
            }
        });
    }

    function hapusPegawai(id) {
        $.ajax({
            type: "GET",
            url: `/delete-pegawai/${id}`,
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
                <h2>Data Pegawai</h2>
                <!-- Tombol Tambah Data -->
                <div class="button-container">
                    <button class="add-button" type="button" onclick="showTambahPegawaiModal()">Tambah Data</button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Jabatan</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Nomer Handphone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pegawais as $pegawai)
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pegawai->name }}</td>
                            <td>{{ $pegawai->username }}</td>
                            <td>{{ $pegawai->position }}</td>
                            <td>{{ $pegawai->role }}</td>
                            <td>{{ $pegawai->email }}</td>
                            <td>{{ $pegawai->phone_number }}</td>
                            <td class="action-buttons">
                                <button class="edit-btn" type="button" onclick="detailPegawai('{{ $pegawai->id }}')">
                                    <img src="{{ asset('image/edit.png') }}" alt="Edit">
                                </button>
                                <button class="delete-btn" type="button"
                                    onclick="hapusPegawai('{{ $pegawai->user_id }}')">
                                    <img src="{{ asset('image/delete.png') }}" alt="Delete">
                                </button>
                            </td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Modal Tambah Role -->
    <div class="modal fade" id="tambahPegawaiModal" tabindex="-1" aria-labelledby="tambahPegawaiModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPegawaiModalLabel">Tambah Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="">
                        <div class="row g-3 mt-3">
                            <div class="col-md-12">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Masukkan Nama Lengkap">
                                <p id="helpName" class="help is-hidden"></p>
                            </div>
                            <div class="col-md-12">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Masukkan username">
                                <p id="helpUsername" class="help is-hidden"></p>
                            </div>
                            <div class="col-md-12">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Masukkan password">
                                <p id="helpPassword" class="help is-hidden"></p>
                            </div>
                            <div class="col-md-12">
                                <label for="position" class="form-label"><strong>Jabatan</strong></label>
                                <select class="form-control" id="position" name="position">
                                    <option disabled selected>Pilih Jabatan</option>
                                    @foreach ($jabatans as $jabatan)
                                        <option value="{{ $jabatan->jabatan }}">{{ $jabatan->jabatan }}</option>
                                    @endforeach
                                </select>
                                <p id="helpPosition" class="help is-hidden"></p>
                            </div>
                            <div class="col-md-12">
                                <label for="role" class="form-label"><strong>Role</strong></label>
                                <select class="form-control" id="role" name="role">
                                    <option disabled selected>Pilih Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->role }}">{{ $role->role }}</option>
                                    @endforeach
                                </select>
                                <p id="helpRole" class="help is-hidden"></p>
                            </div>
                            <div class="col-md-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Masukkan email" required>
                                <p id="helpEmail" class="help is-hidden"></p>
                            </div>
                            <div class="col-md-12">
                                <label for="phoneNumber" class="form-label">Nomer Handphone</label>
                                <input type="email" class="form-control" id="phoneNumber" name="phoneNumber"
                                    placeholder="Masukkan nomer handphone">
                                <p id="helpPhoneNumber" class="help is-hidden"></p>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn app-btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" onclick="tambahPegawai()" form="formTambahKegiatan"
                        class="btn btn-primary text-white">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Pegawai -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Jabatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formTambahKegiatan">
                        <div class="row g-3 mt-3">
                            <div class="col-md-12">
                                <label for="idPegawai" class="form-label">Nama Lengkap</label>
                                <p id="idPegawai" class="help is-hidden"></p>
                                <input type="text" class="form-control" id="editName" name="editName"
                                    placeholder="Masukkan nama lengkap">
                                <p id="helpEditName" class="help is-hidden"></p>
                            </div>
                            <div class="col-md-12">
                                <label for="position" class="form-label"><strong>Jabatan</strong></label>
                                <select class="form-control" id="editPosition" name="editPosition">
                                    <option disabled selected>Pilih Jabatan</option>
                                    @foreach ($jabatans as $jabatan)
                                        <option value="{{ $jabatan->jabatan }}">{{ $jabatan->jabatan }}</option>
                                    @endforeach
                                </select>
                                <p id="helpEditPosition" class="help is-hidden"></p>
                            </div>
                            <div class="col-md-12">
                                <label for="role" class="form-label"><strong>Role</strong></label>
                                <select class="form-control" id="editRole" name="editRole">
                                    <option disabled>Pilih Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->role }}">{{ $role->role }}</option>
                                    @endforeach
                                </select>
                                <p id="helpEditRole" class="help is-hidden"></p>
                            </div>
                            <div class="col-md-12">
                                <label for="narasumber" class="form-label">Email</label>
                                <input type="email" class="form-control" id="editEmail" name="editEmail"
                                    placeholder="Masukkan nama lengkap">
                                <p id="helpEditEmail" class="help is-hidden"></p>
                            </div>
                            <div class="col-md-12">
                                <label for="narasumber" class="form-label">Nomer Handphone</label>
                                <input type="text" class="form-control" id="editPhoneNumber"
                                    name="editPhoneNumber" placeholder="Masukkan nama lengkap">
                                <p id="helpEditPhoneNumber class="help is-hidden"></p>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn app-btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" onclick="updatePegawai()" form="formTambahKegiatan"
                        class="btn btn-primary text-white">Edit</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
