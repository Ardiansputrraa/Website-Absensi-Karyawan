<x-header></x-header>

<script>
    function showTambahPegawaiModal() {
        $('#tambahPegawaiModal').modal('show');
    }

    function tambahPegawai() {
        let username = $('#username').val();
        let password = $('#password').val();

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

        $.ajax({
            url: `/tambah-pegawai`,
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                username: username,
                password: password,
            },
            success: function(response) {
                Swal.fire({
                    title: "Berhasil",
                    text: "Tambah pegawai berhasil!",
                    icon: "success",
                    confirmButtonText: "Oke",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#username').val("");
                        $('#password').val("");
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
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Jabatan</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>MAG-1001</td>
                            <td>Dikco Agung Prasetyo</td>
                            <td>diko</td>
                            <td>123</td>
                            <td>Jaringan</td>
                            <td>Magang</td>
                            <td class="action-buttons">
                                <button class="edit-btn">
                                    <img src="{{ asset('image/details.png') }}" alt="Edit">
                                </button>
                                <button class="edit-btn">
                                    <img src="{{ asset('image/edit.png') }}" alt="Edit">
                                </button>
                                <button class="delete-btn">
                                    <img src="{{ asset('image/delete.png') }}" alt="Delete">
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>MAG-1002</td>
                            <td>Anugrah Lan Pambudi</td>
                            <td>alan</td>
                            <td>123</td>
                            <td>Web Developer</td>
                            <td>Magang</td>
                            <td class="action-buttons">
                                <button class="edit-btn">
                                    <img src="{{ asset('image/details.png') }}" alt="Edit">
                                </button>
                                <button class="edit-btn">
                                    <img src="{{ asset('image/edit.png') }}" alt="Edit">
                                </button>
                                <button class="delete-btn">
                                    <img src="{{ asset('image/delete.png') }}" alt="Delete">
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>PEG-1001</td>
                            <td>Ardian Saputra</td>
                            <td>ardian</td>
                            <td>123</td>
                            <td>Android Developer</td>
                            <td>Pegawai</td>
                            <td class="action-buttons">
                                <button class="edit-btn">
                                    <img src="{{ asset('image/details.png') }}" alt="Edit">
                                </button>
                                <button class="edit-btn">
                                    <img src="{{ asset('image/edit.png') }}" alt="Edit">
                                </button>
                                <button class="delete-btn">
                                    <img src="{{ asset('image/delete.png') }}" alt="Delete">
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Modal Tambah Role -->
    <div class="modal fade" id="tambahPegawaiModal" tabindex="-1"
        aria-labelledby="tambahPegawaiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPegawaiModalLabel">Tambah Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formTambahKegiatan">
                        <div class="row g-3 mt-3">
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
</body>
</html>
