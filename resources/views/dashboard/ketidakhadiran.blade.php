<x-header></x-header>

<script>
    function setuju(id) {
        $.ajax({
            url: `/setuju-ketidakhadiran`,
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
                status: 'diterima',
            },
            success: function(response) {
                Swal.fire({
                    title: "Berhasil",
                    text: "Ketidakhadiran berhasil diterima!",
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
                    text: "Data role gagal ditambahkan.",
                    confirmButtonText: "Tutup",
                });
            }
        });
    }

    function tolak(id) {
        $.ajax({
            url: `/setuju-ketidakhadiran`,
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
                status: 'ditolak',
            },
            success: function(response) {
                Swal.fire({
                    title: "Berhasil",
                    text: "Ketidakhadiran berhasil diterima!",
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
                    text: "Data role gagal ditambahkan.",
                    confirmButtonText: "Tutup",
                });
            }
        });
    }

    function search() {
        let pegawai_id = $('#pegawaiId').val();
        let start_date = $('#start_date').val();

        $.ajax({
            url: "{{ route('ketidakhadiran.search') }}",
            type: "GET",
            data: {
                pegawai_id: pegawai_id,
                start_date: start_date
            },
            success: function(data) {
                $("#results").empty();
                var rows = "";
                if (data.length > 0) {
                    $.each(data, function(index, request) {
                        let approveButtons = "";

                        if (request.status === 'diproses') {
                            approveButtons =
                                `<button class="approve-button" type="button" onclick="setuju('${request.id}')">Setujui</button>
                         <button class="reject-button" type="button" onclick="tolak('${request.id}')">Tolak</button>`;
                        }

                        rows += `<tr>
                    <td>${index + 1}</td>
                    <td>${request.name}</td>
                    <td>${request.leave_type}</td>
                    <td>${request.reason}</td>
                    <td>${request.start_date}</td>
                    <td>${request.end_date}</td>
                    <td>${request.status}</td>
                    <td>
                        <button class="btn-primary">
                            <a href="/download-ketidakhadiran/${request.id}" target="_blank">Download</a>
                        </button>
                        ${approveButtons}
                    </td>
                </tr>`;

                    });
                } else {
                    rows = "<tr><td colspan='4'>Data tidak ditemukan</td></tr>";
                }
                $("#results").append(rows);
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
                <h2>Ketidakhadiran</h2>

                <!-- Container untuk input tanggal & tombol -->
                <div class="date-container">
                    <!-- Input for Date -->
                    <div class="date-input">
                        <label for="date">Tanggal:</label>
                        <input type="date" id="start_date" name="start_date">
                    </div>

                    <!-- Input untuk Pilih Nama Pegawai -->
                    <div class="employee-input">
                        <label for="employee">Nama Pegawai:</label>
                        <select id="pegawaiId" name="pegawaiId">
                            <option disabled selected>Pilih Pegawai</option>
                            @foreach ($pegawais as $pegawai)
                            <option value="{{ $pegawai->id }}">{{ $pegawai->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Tombol Tambah Data -->
                    <button class="add-button" type="button" onclick="search()">Tampilkan</button>
                </div>

                <!-- Tabel tetap di bawah -->
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th>Deskripsi</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="results">
                        @foreach ($leave_request as $ketidakhadiran)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $ketidakhadiran->name }}</td>
                            <td>{{ $ketidakhadiran->leave_type }}</td>
                            <td>{{ $ketidakhadiran->reason }}</td>
                            <td>{{ $ketidakhadiran->start_date }}</td>
                            <td>{{ $ketidakhadiran->end_date }}</td>
                            <td>{{ $ketidakhadiran->status }}</td>
                            <td>
                                <button class="btn-primary"><a href="{{ route('download.ketidakhadiran', $ketidakhadiran->id) }}">Download</a></button>
                                @if ($ketidakhadiran->status == 'diproses')
                                <button class="approve-button" type="button" onclick="setuju('{{ $ketidakhadiran->id }}')">Setujui</button>
                                <button class="reject-button" type="button" onclick="tolak('{{ $ketidakhadiran->id }}')">Tolak</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
</body>

</html>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .approve-button {
        background-color: green;
        color: white;
        border: none;
        padding: 5px 10px;
        margin-right: 5px;
        cursor: pointer;
    }

    .reject-button {
        background-color: red;
        color: white;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
    }

    .approve-button:hover {
        background-color: darkgreen;
    }

    .reject-button:hover {
        background-color: darkred;
    }
</style>