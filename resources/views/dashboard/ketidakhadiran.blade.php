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
        <h2>Ketidakhadiran</h2>
        
        <!-- Container untuk input tanggal & tombol -->
        <div class="date-container">
            <!-- Input for Date -->
            <div class="date-input">
                <label for="date">Tanggal:</label>
                <input type="date" id="date" name="date">
            </div>

            <!-- Input untuk Pilih Nama Pegawai -->
    <div class="employee-input">
        <label for="employee">Nama Pegawai:</label>
        <select id="employee" name="employee">
            <option value="">Pilih Pegawai</option>
            <option value="Dikco Agung Prasetyo">Dikco Agung Prasetyo</option>
            <option value="Anugrah Lan Pambudi">Anugrah Lan Pambudi</option>
            <!-- Tambahkan opsi pegawai lainnya sesuai kebutuhan -->
        </select>
    </div>
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
                    <th>Keterangan</th>
                    <th>Deskripsi</th>
                    <th>Surat Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Dikco Agung Prasetyo</td>
                    <td>12 Februari 2025</td>
                    <td>izin</td>
                    <td>ada acara keluarga</td>
                    <td>nikahan.pdf</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Anugrah Lan Pambudi</td>
                    <td>12 Februari 2025</td>
                    <td>sakit</td>
                    <td>mual dan BAB</td>
                    <td>sakit.png</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
