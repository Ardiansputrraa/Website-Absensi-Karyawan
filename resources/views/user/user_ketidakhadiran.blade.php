<x-header></x-header>

<script>
    function showTambahKetidakhadiranModal() {
        $('#tambahKetidakhadiranModal').modal('show');
    }

    function tambahKetidakhadiran() {
        let name = $('#name').val();
        let keterangan = $('#keterangan').val();
        let tanggalMulai = $('#tanggalMulai').val();
        let tanggalSelesai = $('#tanggalSelesai').val();
        let file = $('#file')[0].files[0];
        let deskripsi = $('#deskripsi').val();

        if (name === "") {
            $("#helpNama")
                .text("Silahkan masukan nama lengkap!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#name").focus();
            return;
        }

        if (name !== "") {
            $("#helpNama")
                .text("")
                .removeClass("is-danger");
        }

        if (keterangan === "") {
            $("#helpKeterangan")
                .text("Silahkan pilih keterangan!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#keterangan").focus();
            return;
        }

        if (keterangan !== "") {
            $("#helpKeterangan")
                .text("")
                .removeClass("is-danger");
        }

        if (tanggalMulai === "") {
            $("#helpTanggalMulai")
                .text("Silahkan pilih tanggal mulai!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#tanggalMulai").focus();
            return;
        }

        if (tanggalMulai !== "") {
            $("#helpTanggalMulai")
                .text("")
                .removeClass("is-danger");
        }

        if (tanggalSelesai === "") {
            $("#helpTanggalSelesai")
                .text("Silahkan pilih tanggal selesai!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#tanggalSelesai").focus();
            return;
        }

        if (tanggalSelesai !== "") {
            $("#helpTanggalSelesai")
                .text("")
                .removeClass("is-danger");
        }

        if (!file) {
            $("#helpFile")
                .text("Silahkan masukan surat keterangan!")
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
        formInput.append('leave_type', keterangan);
        formInput.append('start_date', tanggalMulai);
        formInput.append('end_date', tanggalSelesai);
        formInput.append('file', file);
        formInput.append('reason', deskripsi);

        $.ajax({
            url: `/tambah-ketidakhadiran`,
            type: "POST",
            data: formInput,
            contentType: false,
            processData: false,
            success: function(response) {
                Swal.fire({
                    title: "Berhasil",
                    text: "Tambah ketidakhadiran berhasil!",
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
                    text: "Data ketidakhadiran gagal ditambahkan.",
                    confirmButtonText: "Tutup",
                });
            }
        });
    }

    function detailKetidakhadiran(id) {
        $.ajax({
            url: `/detail-ketidakhadiran/${id}`,
            type: "GET",
            success: function(response) {
                $('#idKetidakhadiran').val(response.data.id);
                const filePath = response.data.file;
                const fileName = filePath.split('/').pop()
                // $('#editFile').val(fileName);
                $('#editKeterangan').val(response.data.leave_type);
                $('#editTanggalMulai').val(response.data.start_date);
                $('#editTanggalSelesai').val(response.data.end_date);
                $('#editDeskripsi').val(response.data.reason);
                $('#editKetidakhadiranModal').modal('show');
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

    function editKetidakhadiran() {
        let idKetidakhadiran = $('idKetidakhadiran').val();
        let keterangan = $('#editKeterangan').val();
        let tanggalMulai = $('#editTanggalMulai').val();
        let tanggalSelesai = $('#editTanggalSelesai').val();
        let file = $('#editFile')[0].files[0];
        let deskripsi = $('#editDeskripsi').val();


        if (keterangan === "") {
            $("#helpKeterangan")
                .text("Silahkan pilih keterangan!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#keterangan").focus();
            return;
        }

        if (keterangan !== "") {
            $("#helpKeterangan")
                .text("")
                .removeClass("is-danger");
        }

        if (tanggalMulai === "") {
            $("#helpTanggalMulai")
                .text("Silahkan pilih tanggal mulai!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#tanggalMulai").focus();
            return;
        }

        if (tanggalMulai !== "") {
            $("#helpTanggalMulai")
                .text("")
                .removeClass("is-danger");
        }

        if (tanggalSelesai === "") {
            $("#helpTanggalSelesai")
                .text("Silahkan pilih tanggal selesai!")
                .removeClass("is-safe")
                .addClass("is-danger");
            $("#tanggalSelesai").focus();
            return;
        }

        if (tanggalSelesai !== "") {
            $("#helpTanggalSelesai")
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

        let formInputEdit = new FormData();

        if (file) {
            formInputEdit.append('file', file);
        }

        console.log(idKetidakhadiran);
        console.log(keterangan);

        formInputEdit.append('id', idKetidakhadiran);
        formInputEdit.append('_token', "{{ csrf_token() }}");
        formInputEdit.append('leave_type', keterangan);
        formInputEdit.append('start_date', tanggalMulai);
        formInputEdit.append('end_date', tanggalSelesai);
        formInputEdit.append('reason', deskripsi);

        $.ajax({
            url: `/edit-ketidakhadiran`,
            type: "POST",
            data: formInputEdit,
            contentType: false,
            processData: false,
            success: function(response) {
                Swal.fire({
                    title: "Berhasil",
                    text: "Edit ketidakhadiran berhasil!",
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
                    text: "Data ketidakhadiran gagal diubah.",
                    confirmButtonText: "Tutup",
                });
            }
        });
    }

    function hapusKetidakhadiran(id) {
        $.ajax({
            type: "GET",
            url: `/delete-ketidakhadiran/${id}`,
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
                <h2>Izin Ketidakhadiran</h2>

                <!-- Container untuk input tanggal & tombol -->
                <div class="date-container">
                    <!-- Tombol Tambah Data -->
                    <button class="add-button" type="button" onclick="showTambahKetidakhadiranModal()">Izin
                        Ketidakhadiran</button>
                </div>

                <!-- Tabel tetap di bawah -->
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Keterangan</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leave_request as $ketidakhadiran)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ketidakhadiran->leave_type }}</td>
                                <td>{{ $ketidakhadiran->start_date }}</td>
                                <td>{{ $ketidakhadiran->end_date }}</td>
                                <td>{{ $ketidakhadiran->reason }}</td>
                                <td>{{ $ketidakhadiran->status }}</td>
                                <td class="action-buttons">
                                    <a class="edit-btn"
                                        href="{{ route('download.ketidakhadiran', $ketidakhadiran->id) }}">
                                        <img src="{{ asset('image/download.png') }}">
                                    </a>
                                    @if ($ketidakhadiran->status == 'diproses')
                                    <button class="edit-btn" type="button" onclick="detailKetidakhadiran('{{ $ketidakhadiran->id }}')">
                                        <img src="{{ asset('image/edit.png') }}">
                                    </button>
                                    <button class="delete-btn" type="button"
                                        onclick="hapusKetidakhadiran('{{ $ketidakhadiran->id }}')">
                                        <img src="{{ asset('image/delete.png') }}">
                                    </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal Tambah Ketidakhadiran -->
            <div class="modal fade" id="tambahKetidakhadiranModal" tabindex="-1"
                aria-labelledby="tambahKetidakhadiranModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahKetidakhadiranModalLabel">Tambah Ketidakhadiran</h5>
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
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <select class="form-control" id="keterangan" name="keterangan">
                                            <option disabled selected>Pilih Keterangan</option>
                                            <option value="izin">izin</option>
                                            <option value="cuti">cuti</option>
                                            <option value="sakit">sakit</option>
                                        </select>
                                        <p id="helpKeterangan" class="help is-hidden"></p>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-md-6">
                                            <label for="tanggalMulai" class="form-label">Tanggal Mulai</label>
                                            <input type="date" class="form-control" id="tanggalMulai"
                                                name="tanggalMulai">
                                            <p id="helpTanggalMulai" class="help is-hidden"></p>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="tanggalSelesai" class="form-label">Tanggal Selesai</label>
                                            <input type="date" class="form-control" id="tanggalSelesai"
                                                name="tanggalSelesai">
                                            <p id="helpTanggalSelesai" class="help is-hidden"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="file" class="form-label">Surat Keterangan</label>
                                        <input type="file" class="form-control" id="file" name="file"
                                            placeholder="Masukkan surat keterangan">
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
                            <button type="button" onclick="tambahKetidakhadiran()" form="formTambahKegiatan"
                                class="btn btn-primary text-white">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Ketidakhadiran -->
            <div class="modal fade" id="editKetidakhadiranModal" tabindex="-1"
                aria-labelledby="editKetidakhadiranModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editKetidakhadiranModalLabel">Edit Ketidakhadiran</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formTambahKegiatan">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="name" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" type="hidden" id="idKetidakhadiran" name="idKetidakhadiran"
                                            placeholder="idKetidakhadiran">
                                        <input type="text" class="form-control" id="editName" name="editName"
                                            placeholder="Masukkan nama lengkap"
                                            value="{{ Auth::user()->pegawai->name }}" disabled readonly>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <select class="form-control" id="editKeterangan" name="editKeterangan">
                                            <option disabled selected>Pilih Keterangan</option>
                                            <option value="izin">izin</option>
                                            <option value="cuti">cuti</option>
                                            <option value="sakit">sakit</option>
                                        </select>
                                        <p id="helpEditKeterangan" class="help is-hidden"></p>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-md-6">
                                            <label for="tanggalMulai" class="form-label">Tanggal Mulai</label>
                                            <input type="date" class="form-control" id="editTanggalMulai"
                                                name="editTanggalMulai">
                                            <p id="helpEditTanggalMulai" class="help is-hidden"></p>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="tanggalSelesai" class="form-label">Tanggal Selesai</label>
                                            <input type="date" class="form-control" id="editTanggalSelesai"
                                                name="editTanggalSelesai">
                                            <p id="helpEditTanggalSelesai" class="help is-hidden"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="file" class="form-label">Surat Keterangan</label>
                                        <input type="file" class="form-control" id="editFile" name="editFile"
                                            placeholder="Masukkan surat keterangan">
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
                            <button type="button" onclick="editKetidakhadiran()" form="formTambahKegiatan"
                                class="btn btn-primary text-white">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
</body>

</html>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        let tanggalMulai = document.getElementById("tanggalMulai");
        let tanggalSelesai = document.getElementById("tanggalSelesai");

        let today = new Date().toISOString().split("T")[0];

        tanggalMulai.setAttribute("min", today);
        tanggalSelesai.setAttribute("min", today);

        tanggalMulai.addEventListener("change", function() {
            tanggalSelesai.setAttribute("min", this.value);
        });
    });
</script>
