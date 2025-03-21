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
        <h2>Laporan Harian</h2>
        
        <!-- Container untuk input tanggal & tombol -->
        <div class="date-container">
            <!-- Tombol Tambah Data -->
            <button class="add-button">Tambah Laporan</button>
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
                    <th>File Laporan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Dikco Agung Prasetyo</td>
                    <td>Web Developer</td>
                    <td>15 Maret 2025</td>
                    <td>laporan fronetend</td>
                    <td>frontend.png</td>
                    <td class="action-buttons">
                        <button class="edit-btn">
                            <img src="{{ asset('image/edit.png')}}">
                        </button>
                        <button class="delete-btn">
                            <img src="{{ asset('image/delete.png')}}">
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
