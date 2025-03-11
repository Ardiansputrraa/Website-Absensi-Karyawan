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
                    <th>Keterangan</th>
                    <th>Deskripsi</th>
                    <th>Tanggal</th>
                    <th>Surat Keterangan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Dikco Agung Prasetyo</td>
                    <td>izin</td>
                    <td>ada acara keluarga</td>
                    <td>12 Februari 2025</td>
                    <td>nikahan.pdf</td>
                    <td>Menunggu Persetujuan</td>
                    <td>
                        <button class="approve-button">Setujui</button>
                        <button class="reject-button">Tolak</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Anugrah Lan Pambudi</td>
                    <td>sakit</td>
                    <td>mual dan BAB</td>
                    <td>12 Februari 2025</td>
                    <td>sakit.png</td>
                    <td>Menunggu Persetujuan</td>
                    <td>
                        <button class="approve-button">Setujui</button>
                        <button class="reject-button">Tolak</button>
                    </td>
                </tr>
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
    th, td {
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
