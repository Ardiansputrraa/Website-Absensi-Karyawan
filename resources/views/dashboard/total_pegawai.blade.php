<x-header></x-header>
<body>
    <div class="container">
        <!-- Sidebar -->
        <x-sidebar></x-sidebar>
        
        <!-- Main Content -->
        <main class="main-content">
            <div class="card">
                <h2>Total Pegawai</h2>
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
        
        <!-- User Profile -->
        <div class="user-profile">
            <img src="{{ asset('image/Profil-User.png') }}" alt="User" class="profile-img">
            <div>
                <p class="name">Dikco Agung</p>
                <p class="role">HRD</p>
            </div>
        </div>
    </div>
</body>
</html>
