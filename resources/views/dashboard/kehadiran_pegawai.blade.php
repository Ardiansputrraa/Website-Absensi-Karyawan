<x-header></x-header>

<script>
    function dateTimeToday() {
        const now = new Date();
        const hours = now.getHours();
        const minutes = now.getMinutes();
        const today = now.toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            document.getElementById('date-today').innerText = today;
            return today;
    }
    setInterval(() => {
        dateTimeToday();
        }, 10);
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
                <div class="card-header">
                    <h2>Kehadiran Pegawai Pegawai</h2>
                    <div class="dropdown">
                        <select>
                            <option>Total Hadir</option>
                            <option>Total Tidak Hadir</option>
                            <option>Total Izin/Sakit/Cuti</option>
                        </select>
                    </div>
                </div>
                <h5 id="date-today">>{{ $today }}</h5>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Tanggal</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                        </tr>
                    </thead>
                    <tbody id="results">
                        @foreach ($absensi as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->pegawai->name }}</td>
                            <td>{{ $item->pegawai->position }}</td>
                            <td>{{ $item->date }}</td>
                            <td>{{ $item->check_in }}</td>
                            <td>{{ $item->check_out }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
