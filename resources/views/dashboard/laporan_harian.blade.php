<x-header></x-header>

<script>
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
    
    function search() {
        let pegawai_id = $('#pegawaiId').val();
        let date = $('#tanggal').val();

        $.ajax({
            url: "{{ route('logbook.search') }}",
            type: "GET",
            data: {
                pegawai_id: pegawai_id,
                date: date
            },
            success: function(data) {
                console.log(data)
                $("#results").empty();
                var rows = "";
                if (data.length > 0) {
                    $.each(data, function(index, request) {
                        rows += `<tr>
                    <td>${index + 1}</td>
                    <td>${request.name}</td>
                    <td>${request.jabatan}</td>
                    <td>${request.date}</td>
                    <td>${request.deskripsi}</td>
                    <td>
                        <button class="btn-primary">
                            <a href="/download-logbook/${request.id}" target="_blank">Download</a>
                        </button>
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
                <h2>Laporan Harian</h2>

                <!-- Container untuk input tanggal & tombol -->
                <div class="date-container">
                    <!-- Input for Date -->
                    <div class="date-input">
                        <label for="date">Tanggal:</label>
                        <input type="date" id="tanggal" name="tanggal">
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
                            <th>Jabatan</th>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="results">
                        @foreach ($logbook as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->jabatan }}</td>
                            <td>{{ $item->date }}</td>
                            <td>{{ $item->deskripsi }}</td>
                            <td class="action-buttons">
                                <a class="edit-btn"
                                    href="{{ route('download.logbook', $item->id) }}">
                                    <img src="{{ asset('image/download.png') }}">
                                </a>
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
</body>

</html>