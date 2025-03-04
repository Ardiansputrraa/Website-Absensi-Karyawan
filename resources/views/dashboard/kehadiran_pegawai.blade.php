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
                <div class="card-header">
                    <h2>Total Pegawai</h2>
                    <div class="dropdown">
                        <select>
                            <option>Total Hadir</option>
                            <option>Total Tidak Hadir</option>
                            <option>Total Izin/Sakit/Cuti</option>
                        </select>
                    </div>
                </div>
                <p>3 Orang</p>
                
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Role</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Dikco Agung Prasetyo</td>
                            <td>Jaringan</td>
                            <td>Magang</td>
                            <td>Hadir</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Anugrah Lan Pambudi</td>
                            <td>Web Developer</td>
                            <td>Magang</td>
                            <td>Tidak Hadir</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Ardian Saputra</td>
                            <td>Android Developer</td>
                            <td>Pegawai</td>
                            <td>Izin</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
