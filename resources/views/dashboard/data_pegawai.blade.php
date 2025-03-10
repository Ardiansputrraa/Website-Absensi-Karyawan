<x-header></x-header>
<script>
    function addPegawaiModal() {
        $('#tambahPegawaiModal').modal('show');
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
                <h2>Data Pegawai</h2>
                    <button class="add-button" type="button" onclick="addPegawaiModal()">Tambah Data</button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Jabatan</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>MAG-1001</td>
                            <td>Dikco Agung Prasetyo</td>
                            <td>diko</td>
                            <td>123</td>
                            <td>Jaringan</td>
                            <td>Magang</td>
                            <td class="action-buttons">
                                <button class="edit-btn">
                                    <img src="{{ asset('image/details.png') }}" alt="Edit">
                                </button>
                                <button class="edit-btn">
                                    <img src="{{ asset('image/edit.png') }}" alt="Edit">
                                </button>
                                <button class="delete-btn">
                                    <img src="{{ asset('image/delete.png') }}" alt="Delete">
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>MAG-1002</td>
                            <td>Anugrah Lan Pambudi</td>
                            <td>alan</td>
                            <td>123</td>
                            <td>Web Developer</td>
                            <td>Magang</td>
                            <td class="action-buttons">
                                <button class="edit-btn">
                                    <img src="{{ asset('image/details.png') }}" alt="Edit">
                                </button>
                                <button class="edit-btn">
                                    <img src="{{ asset('image/edit.png') }}" alt="Edit">
                                </button>
                                <button class="delete-btn">
                                    <img src="{{ asset('image/delete.png') }}" alt="Delete">
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>PEG-1001</td>
                            <td>Ardian Saputra</td>
                            <td>ardian</td>
                            <td>123</td>
                            <td>Android Developer</td>
                            <td>Pegawai</td>
                            <td class="action-buttons">
                                <button class="edit-btn">
                                    <img src="{{ asset('image/details.png') }}" alt="Edit">
                                </button>
                                <button class="edit-btn">
                                    <img src="{{ asset('image/edit.png') }}" alt="Edit">
                                </button>
                                <button class="delete-btn">
                                    <img src="{{ asset('image/delete.png') }}" alt="Delete">
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>

    </div>
</body>
</html>
