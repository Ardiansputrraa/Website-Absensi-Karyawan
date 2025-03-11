<x-header></x-header>
<body>
    <div class="container">
        <!-- Sidebar -->
        <x-sidebaruser></x-sidebaruser>

        <!-- Profile -->
        <x-profile></x-profile>
        
        <!-- Main Content -->
        <main class="main-content" style="margin-left: 250px; padding: 20px;">
            <h2>Home</h2>
            <div style="display: flex; gap: 20px;">
                <!-- Presensi Masuk -->
                <div style="border: 1px solid #000; padding: 20px; border-radius: 10px; background: #d3d3d3; text-align: center; min-width: 300px;">
                    <h3>Presensi Masuk</h3>
                    <p id="current-date"></p>
                    <h2 id="clock" style="font-weight: bold;"></h2>
                    <button style="background-color: blue; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Masuk</button>
                </div>

                <!-- Presensi Keluar -->
                <div style="border: 1px solid #000; padding: 20px; border-radius: 10px; background: #d3d3d3; text-align: center; min-width: 300px;">
                    <h3>Presensi Keluar</h3>
                    <p id="status-keluar">Belum Waktunya Pulang</p>
                    <span style="font-size: 30px; font-weight: bold;">&#10060;</span>
                </div>
            </div>
        </main>
    </div>

    <script>
        function updateClock() {
            const now = new Date();
            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const seconds = now.getSeconds().toString().padStart(2, '0');
            document.getElementById('clock').innerText = `${hours}:${minutes}:${seconds}`;
        }
        
        function updateDate() {
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('current-date').innerText = now.toLocaleDateString('id-ID', options);
        }
        
        setInterval(updateClock, 1000);
        updateClock();
        updateDate();
    </script>
</body>
</html>