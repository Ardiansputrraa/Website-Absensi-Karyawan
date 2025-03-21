<x-header></x-header>

<script>
    function showTambahKetidakhadiranModal() {
        $('#tambahKetidakhadiranModal').modal('show');
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
                <h2>Izin Ketidakhadiran</h2>

                <!-- Container untuk input tanggal & tombol -->
                <div class="date-container">
                    <!-- Tombol Tambah Data -->
                    <button class="add-button" type="button" onclick="showTambahKetidakhadiranModal()">Izin Ketidakhadiran</button>
                </div>

                <!-- Tabel tetap di bawah -->
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th>Surat Keterangan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Dikco Agung Prasetyo</td>
                            <td>Izin</td>
                            <td>15 Maret 2025</td>
                            <td>acara keluarga</td>
                            <td>acara.png</td>
                            <td>Menunggu Persetujuan</td>
                            <td class="action-buttons">
                                <button class="edit-btn">
                                    <img src="{{ asset('image/edit.png')}}">
                                </button>
                                <button class="delete-btn">
                                    <img src="{{ asset('image/delete.png')}}">
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Modal Tambah Ketidakhadiran -->
            <div class="modal fade" id="tambahKetidakhadiranModal" tabindex="-1" aria-labelledby="tambahKetidakhadiranModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahKetidakhadiranModalLabel">Edit Jabatan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formTambahKegiatan">
                                <div class="row g-3 mt-3">
                                    <div class="col-md-12">
                                        <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="namaLengkap" name="namaLengkap"
                                            placeholder="Masukkan nama lengkap">
                                        <p id="helpJabatan" class="help is-hidden"></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn app-btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="button" onclick="" form="formTambahKegiatan"
                                class="btn btn-primary text-white">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
</body>

</html>