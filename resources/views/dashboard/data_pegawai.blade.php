<x-header></x-header>
<script>
    function addPegawaiModal() {
        $('#tambahPegawaiModal').modal('show');
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
                    <button class="add-button" type="button" onclick="addPegawaiModal()">Tambah Data</button>
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
    
        <!-- Tombol Tambah Data -->
        <div class="button-container">
                    <!-- Modal Tambah Pegawai -->
        <div class="modal fade" id="tambahPegawaiModal" tabindex="-1" aria-labelledby="tambahPegawaiModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahPegawaiModalLabel">Tambah Pegawai</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formTambahKegiatan">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="tanggal" class="form-label">NIP</label>
                                    <input type="text" class="form-control" id="nip" name="nip" placeholder="Masukan NIP">
                                    <p id="helpNip" class="help is-hidden"></p>
                                </div>
                                <div class="col-md-6">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Lengkap">
                                    <p id="helpNama" class="help is-hidden"></p>
                                </div>
                                <div class="col-md-6">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukan Username">
                                    <p id="helpUsername" class="help is-hidden"></p>
                                </div>
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password">
                                    <p id="helpPassword" class="help is-hidden"></p>
                                </div>
                                <div class="col-md-6">
                                    <label for="jabatan" class="form-label">Jabatan</label>
                                    <input type="jabatan" class="form-control" id="jabatan" name="jabatan" placeholder="Masukan Jabatan">
                                    <p id="helpJabatan" class="help is-hidden"></p>
                                </div>
                                <div class="col-md-6">
                                    <label for="role" class="form-label">Pilih Role</label>
                                    <select id="role" name="role">
                                        <option value="pilihan1">Pegawai</option>
                                        <option value="pilihan2">Magang</option>
                                    </select>
                                    <input type="jabatan" class="form-control" id="jabatan" name="jabatan" placeholder="Masukan Jabatan">
                                    <p id="helpRole" class="help is-hidden"></p>
                                </div>
                            </div>

                        </form>
                    </div>
                    <!-- Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="button" onclick="buatLogbook()" form="formTambahKegiatan"
                            class="btn btn-primary text-white">Buat Logbook</button>
                    </div>
                </div>
            </div>
        </div>
    
    </div>
</body>
</html>
