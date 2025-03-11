<x-header></x-header>
<body>
    <div class="container">
        <!-- Sidebar -->
        <x-sidebaruser></x-sidebaruser>

         <!-- Profile -->
        <x-profile></x-profile>
        <div style="overflow-x: auto; white-space: nowrap; margin-left: 250px;">
            <table style="min-width: 100%; border-collapse: collapse;">
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
                        <td>
                            <select>
                                <option value="izin">Izin</option>
                                <option value="sakit">Sakit</option>
                                <option value="cuti">Cuti</option>
                            </select>
                        </td>
                        <td><input type="text" placeholder="Isi deskripsi"></td>
                        <td><input type="date"></td>
                        <td><input type="file" accept="*"></td>
                        <td>Menunggu Persetujuan</td>
                        <td><button style="background-color: blue; color: white; padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer;">Kirim</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
           
    </div>
</body>
</html>
