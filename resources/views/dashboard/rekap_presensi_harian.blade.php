<x-header></x-header>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function formatTanggal(dateString) {
        if (!dateString) return '';

        let date = new Date(dateString);
        let days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        let months = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        let dayName = days[date.getDay()];
        let day = date.getDate();
        let month = months[date.getMonth()];
        let year = date.getFullYear();

        return `${dayName}, ${day} ${month} ${year}`;
    }

    function search() {
        let tanggal = formatTanggal($('#tanggal').val()); // Ambil nilai tanggal input
        console.log(tanggal)
        $.ajax({
            url: "{{ route('search.laporan.harian') }}",
            type: "GET",
            data: {
                tanggal: tanggal
            },
            success: function(response) {
                let rows = '';

                if (response.length > 0) {
                    console.log(response)
                    $.each(response, function(index, item) {
                        let jamMasukKantor = new Date('1970-01-01T08:00:00').getTime();
                        let checkInTime = new Date(`1970-01-01T${item.check_in}`).getTime();
                        let checkOutTime = new Date(`1970-01-01T${item.check_out}`).getTime();

                        let keterlambatan = Math.max(0, Math.round((checkInTime - jamMasukKantor) / (1000 * 60)));
                        let statusHadir = keterlambatan > 0 ? `Terlambat ${keterlambatan} menit` : "Tepat Waktu";

                        let durasiKerja = checkOutTime > checkInTime ? new Date(checkOutTime - checkInTime).toISOString().substr(11, 8) : "00:00:00";

                        console.log(`Keterlambatan: ${keterlambatan} menit, Durasi Kerja: ${durasiKerja}`); // Debugging
                        rows += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.pegawai.name}</td>
                                <td>${item.pegawai.position}</td>
                                <td>${item.date}</td>
                                <td>${item.check_in}</td>
                                <td>${item.check_out}</td>
                                <td>${durasiKerja}</td>
                            <td>${statusHadir}</td>
                            </tr>
                        `;
                    });
                } else {
                    rows = `<tr><td colspan="8" class="text-center">Data tidak ditemukan</td></tr>`;
                }

                $('#results').html(rows);
            },
            error: function() {
                alert("Terjadi kesalahan saat mengambil data.");
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
                <h2>Rekap Presensi Harian</h2>

                <!-- Container untuk input tanggal & tombol -->
                <div class="date-container">
                    <!-- Input for Date -->
                    <div class="date-input">
                        <label for="date">Tanggal:</label>
                        <input type="date" id="tanggal" name="tanggal">
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
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Total Jam</th>
                            <th>Terlambat</th>
                        </tr>
                    </thead>
                    <tbody id="results">
                        @foreach ($absensi as $item)
                        @php
                        $jam_masuk_kantor = strtotime('08:00:00');
                        $check_in_time = strtotime($item->check_in);
                        $check_out_time = strtotime($item->check_out);

                        $keterlambatan = max(0, round(($check_in_time - $jam_masuk_kantor) / 60));

                        $status_hadir = $keterlambatan > 0 ? "Terlambat $keterlambatan menit" : "Tepat Waktu";

                        $durasi_kerja = gmdate("H:i:s", max(0, $check_out_time - $check_in_time));
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->pegawai->name }}</td>
                            <td>{{ $item->pegawai->position }}</td>
                            <td>{{ $item->date }}</td>
                            <td>{{ $item->check_in }}</td>
                            <td>{{ $item->check_out }}</td>
                            <td>{{ $durasi_kerja }}</td>
                            <td>{{ $status_hadir }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
</body>

</html>