<x-header></x-header>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    function showAbsensiModal() {
        $('#tambahAbsensiModal').modal('show');
    }
</script>

<body>
    <div class="container">
        <x-profile></x-profile>

        <main class="main-content">
            <h2>Home</h2>
            <div style="display: flex; gap: 20px;">
                <div style="border: 1px solid #000; padding: 20px; border-radius: 10px; background: #d3d3d3; text-align: center; min-width: 300px;">
                    <h3>Presensi Masuk</h3>
                    <p id="current-date"></p>
                    <h2 id="clock" style="font-weight: bold;"></h2>
                    <button style="background-color: blue; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;" 
                            type="button" onclick="requestLocationPermission()">Masuk</button>
                </div>
                <div style="border: 1px solid #000; padding: 20px; border-radius: 10px; background: #d3d3d3; text-align: center; min-width: 300px;">
                    <h3>Presensi Keluar</h3>
                    <p id="status-keluar">Belum Waktunya Pulang</p>
                    <span style="font-size: 30px; font-weight: bold;">&#10060;</span>
                </div>
            </div>
            
            <h3>Lokasi Anda</h3>
            <div id="map" style="width: 100%; height: 400px;"></div>
        </main>
    </div>

    <form id="formAbsensi">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">
    </form>

    <script>
        let kantorLatitude = {{ $kantor->latitude }};
        let kantorLongitude = {{ $kantor->longitude }};
        let map, userMarker;

        function initMap() {
            map = L.map('map').setView([kantorLatitude, kantorLongitude], 16);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);
            L.marker([kantorLatitude, kantorLongitude]).addTo(map).bindPopup("Lokasi Kantor").openPopup();
        }

        function requestLocationPermission() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Geolocation tidak didukung oleh browser ini.");
            }
        }

        function showPosition(position) {
            let userLat = position.coords.latitude;
            let userLng = position.coords.longitude;

            $("#latitude").val(userLat);
            $("#longitude").val(userLng);

            if (userMarker) {
                userMarker.setLatLng([userLat, userLng]);
            } else {
                userMarker = L.marker([userLat, userLng]).addTo(map).bindPopup("Lokasi Anda").openPopup();
            }

            map.setView([userLat, userLng], 16);

            $.ajax({
                url: "{{ route('absen.masuk') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    latitude: userLat,
                    longitude: userLng
                },
                success: function(response) {
                    alert("Presensi berhasil!");
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                    alert("Terjadi kesalahan saat mengirim data.");
                }
            });
        }

        function showError(error) {
            let errorMessage;
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    errorMessage = "Pengguna menolak permintaan geolokasi.";
                    break;
                case error.POSITION_UNAVAILABLE:
                    errorMessage = "Informasi lokasi tidak tersedia.";
                    break;
                case error.TIMEOUT:
                    errorMessage = "Permintaan lokasi pengguna habis waktu.";
                    break;
                case error.UNKNOWN_ERROR:
                    errorMessage = "Terjadi kesalahan yang tidak diketahui.";
                    break;
            }
            alert(errorMessage);
        }

        function updateClock() {
            const now = new Date();
            document.getElementById('clock').innerText = now.toLocaleTimeString('id-ID');
        }

        function updateDate() {
            const now = new Date();
            document.getElementById('current-date').innerText = now.toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        }

        setInterval(() => {
            updateClock();
            updateDate();
        }, 1000);

        document.addEventListener("DOMContentLoaded", function() {
            initMap();
            updateClock();
            updateDate();
        });
    </script>
</body>
</html>
