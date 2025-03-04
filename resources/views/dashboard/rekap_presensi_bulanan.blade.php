<x-header></x-header>
<body>
    <div class="container">
        <!-- Sidebar -->
        <x-sidebar></x-sidebar>

         <!-- Profile -->
        <x-profile></x-profile>
        
       <!-- Main Content -->
<main class="main-content">
    <div class="card">
        <h2>Rekap Presensi Bulanan</h2>
        
        <!-- Container untuk input bulan & tahun -->
        <div class="date-container">
            <!-- Pilih Bulan -->
            <select id="month" class="date-select">
                <option value="01">Januari</option>
                <option value="02">Februari</option>
                <option value="03">Maret</option>
                <option value="04">April</option>
                <option value="05">Mei</option>
                <option value="06">Juni</option>
                <option value="07">Juli</option>
                <option value="08">Agustus</option>
                <option value="09">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>

            <!-- Pilih Tahun -->
            <select id="year" class="date-select"></select>
            <!-- Tombol Tambah Data -->
            <button class="add-button">Tampilkan</button>
        </div>

        <!-- Tabel tetap di bawah -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
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
                    <td>Dikco Agung Prasetyo</td>
                    <td>12 Februari 2025</td>
                    <td>07:45:56</td>
                    <td>16:02:34</td>
                    <td>08:16:38</td>
                    <td>ON TIME</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Anugrah Lan Pambudi</td>
                    <td>12 Februari 2025</td>
                    <td>08:05:14</td>
                    <td>16:06:10</td>
                    <td>08:00:56</td>
                    <td>00:05:14</td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        // Script untuk mengisi pilihan tahun dari 10 tahun terakhir
        const yearSelect = document.getElementById("year");
        const currentYear = new Date().getFullYear();
  
        for (let i = 0; i < 10; i++) {
            let yearOption = document.createElement("option");
            yearOption.value = currentYear - i;
            yearOption.textContent = currentYear - i;
            yearSelect.appendChild(yearOption);
        }
      </script>
</body>
</html>
