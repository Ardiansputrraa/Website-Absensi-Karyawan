<x-header></x-header>
<body>
    <div class="container">
        <!-- Sidebar -->
        <x-sidebaruser></x-sidebaruser>

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
                <input type="date" id="date" name="date">
            </div>
            <!-- Tombol Tambah Data -->
            <button class="add-button">Tampilkan</button>
        </div>

        <!-- Tabel tetap di bawah -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                    <th>Total Jam</th>
                    <th>Terlambat</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>12 Februari 2025</td>
                    <td>07:45:56</td>
                    <td>16:02:34</td>
                    <td>08:16:38</td>
                    <td>ON TIME</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>12 Februari 2025</td>
                    <td>08:05:14</td>
                    <td>16:06:10</td>
                    <td>08:00:56</td>
                    <td>00:05:14</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
