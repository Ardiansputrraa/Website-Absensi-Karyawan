<x-header></x-header>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<body>
    <div class="container">
        <x-profile></x-profile>
        <x-sidebaruser></x-sidebaruser>

        <div class="content-wrapper">
            <div class="presensi-container">
                <div class="presensi-box">
                    <h3>Presensi Masuk</h3>
                    <p id="current-date-masuk"></p>
                    <h2 id="clock-masuk"></h2>
                    <button id="btnMasuk" disabled>Masuk</button>
                </div>
                <div class="presensi-box">
                    <h3>Presensi Keluar</h3>
                    <p id="current-date-keluar"></p>
                    <h2 id="clock-keluar"></h2>
                    <button id="btnKeluar" disabled>Keluar</button>
                </div>
            </div>
            <div id="map"></div>
        </div>
    </div>

    <!-- Modal Login User -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Konfirmasi Absen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formTambahKegiatan">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Masukkan username">
                                <p id="helpUsername" class="help is-hidden"></p>
                            </div>
                            <div class="col-md-12">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Masukkan password">
                                <p id="helpPassword" class="help is-hidden"></p>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn app-btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" onclick="login()" form="formTambahKegiatan"
                        class="btn btn-primary text-white">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let kantorLatitude = parseFloat(`{{ $kantor->latitude }}`);
        let kantorLongitude = parseFloat(`{{ $kantor->longitude }}`);
        let kantorRadius = parseFloat(`{{ $kantor->radius }}`);
        let map, userMarker;

        function initMap() {
            map = L.map('map').setView([kantorLatitude, kantorLongitude], 16);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);
            L.marker([kantorLatitude, kantorLongitude]).addTo(map).bindPopup("Lokasi Kantor").openPopup();
            L.circle([kantorLatitude, kantorLongitude], {
                radius: kantorRadius
            }).addTo(map);
        }

        function requestLocationPermission(action) {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition((position) => {
                    showPosition(position, action);
                }, showError);
            } else {
                alert("Geolocation tidak didukung oleh browser ini.");
            }
        }

        function showPosition(position, action) {
            let userLat = position.coords.latitude;
            let userLng = position.coords.longitude;

            if (userMarker) {
                map.removeLayer(userMarker);
            }
            userMarker = L.marker([userLat, userLng]).addTo(map).bindPopup("Lokasi Anda").openPopup();

            let distance = getDistance(userLat, userLng, kantorLatitude, kantorLongitude);
            if (distance > kantorRadius) {
                alert("Anda berada di luar area kantor");
            } else {
                if (action === "masuk") {
                    kirimAbsensiMasuk(userLat, userLng);
                } else if (action === "keluar") {
                    kirimAbsensiKeluar();
                }
            }
        }

        function showError(error) {
            alert("Gagal mendapatkan lokasi: " + error.message);
        }

        function getDistance(lat1, lon1, lat2, lon2) {
            let R = 6371000;
            let dLat = (lat2 - lat1) * Math.PI / 180;
            let dLon = (lon2 - lon1) * Math.PI / 180;
            let a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                Math.sin(dLon / 2) * Math.sin(dLon / 2);
            let c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c;
        }


        function updateDate() {
            const now = new Date();
            document.getElementById('current-date-masuk').innerText = now.toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            document.getElementById('current-date-keluar').innerText = now.toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        }

        function checkAttendanceTime() {
        const now = new Date();
        const hours = now.getHours();
        const minutes = now.getMinutes();
        const today = now.toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

        const lastCheckedInDate = localStorage.getItem("lastCheckedInDate");
        const hasCheckedIn = localStorage.getItem("hasCheckedIn") === "true";
        const hasCheckedOut = localStorage.getItem("hasCheckedOut") === "true";

        const isCheckInTime = (hours === 8 && minutes >= 0 && minutes <= 30);
        const isCheckOutTime = (hours >= 16);

        if (lastCheckedInDate !== today) {
            localStorage.removeItem("hasCheckedIn");
            localStorage.removeItem("lastCheckedInDate");
            localStorage.removeItem("hasCheckedOut");
            localStorage.removeItem("jamMasuk");
            localStorage.removeItem("jamKeluar");
        }

        document.getElementById("btnMasuk").disabled = hasCheckedIn || !isCheckInTime;
        document.getElementById("btnKeluar").disabled = !(hasCheckedIn && isCheckOutTime) || hasCheckedOut;

        if (!isCheckInTime || hasCheckedIn) {
            document.getElementById('clock-masuk').innerText = localStorage.getItem("jamMasuk");
        } else {
            document.getElementById('clock-masuk').innerText = now.toLocaleTimeString('id-ID');
        }

        if (!(hasCheckedIn && isCheckOutTime) || hasCheckedOut) {
            document.getElementById('clock-keluar').innerText = localStorage.getItem("jamKeluar");
        } else {
            document.getElementById('clock-keluar').innerText = now.toLocaleTimeString('id-ID');
        }
    }

        function kirimAbsensiMasuk(lat, lng) {
            const now = new Date();
            let date = now.toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            let check_in = now.toLocaleTimeString('id-ID');

            $.ajax({
                url: "{{ route('absen.masuk') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    date: date,
                    check_in: check_in,
                    latitude: lat,
                    longitude: lng
                },
                success: function(response) {
                    alert("Presensi masuk berhasil!");
                    localStorage.setItem("hasCheckedIn", "true");
                    localStorage.setItem("lastCheckedInDate", date);
                    localStorage.setItem("jamMasuk", check_in);
                    checkAttendanceTime();
                },
                error: function(xhr) {
                    if (xhr.status === 419) {
                        Swal.fire({
                            icon: "info",
                            title: "Konfirmasi Akun",
                            text: `Lakukan konfirmasi akun terlebih dahulu`,
                            confirmButtonText: "Oke",
                        }).then(() => {
                            $('#loginModal').modal('show');
                        });

                    } else {
                         Swal.fire({
                            icon: "info",
                            title: "Konfirmasi Akun",
                            text: `Lakukan konfirmasi akun terlebih dahulu`,
                            confirmButtonText: "Oke",
                        }).then(() => {
                            $('#loginModal').modal('show');
                        });
                    }
                }
            });
        }

        function kirimAbsensiKeluar() {
            const now = new Date();
            let date = now.toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            let check_out = now.toLocaleTimeString('id-ID');

            $.ajax({
                url: "{{ route('absen.keluar') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    date: date,
                    check_out: check_out,
                },
                success: function(response) {
                    alert("Presensi keluar berhasil!");
                    localStorage.setItem("hasCheckedOut", "true");
                    localStorage.setItem("jamKeluar", check_out);
                    checkAttendanceTime();
                },
                error: function(xhr) {
                    if (xhr.status === 419) {
                        Swal.fire({
                            icon: "info",
                            title: "Konfirmasi Akun",
                            text: `Lakukan konfirmasi akun terlebih dahulu`,
                            confirmButtonText: "Oke",
                        }).then(() => {
                            $('#loginModal').modal('show');
                        });

                    } else {
                         Swal.fire({
                            icon: "info",
                            title: "Konfirmasi Akun",
                            text: `Lakukan konfirmasi akun terlebih dahulu`,
                            confirmButtonText: "Oke",
                        }).then(() => {
                            $('#loginModal').modal('show');
                        });
                    }
                }
            });
        }

        function login() {
            let username = $("#username").val();
            let password = $("#password").val();

            if (username === "") {
                $("#helpUsername")
                    .text("Silahkan masukan username!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#username").focus();
                return;
            }

            if (username != "") {
                $("#helpUsername")
                    .text("")
                    .removeClass("is-safe")
                    .addClass("is-danger");
            }

            if (password === "") {
                $("#helpPassword")
                    .text("Silahkan masukan password!")
                    .removeClass("is-safe")
                    .addClass("is-danger");
                $("#password").focus();
                return;
            }

            if (password != "") {
                $("#helpPassword")
                    .text("")
                    .removeClass("is-safe")
                    .addClass("is-danger");
            }

            console.log(username, password)

            $.ajax({
                type: "POST",
                url: "/login-check",
                data: {
                    _token: "{{ csrf_token() }}",
                    username: username,
                    password: password,
                },
                success: function(response) {
                    Swal.fire({
                        icon: "success",
                        title: "Konfirmasi Berhasil",
                        text: `Konfirmasi akun ${username} berhasil!`,
                        confirmButtonText: "Oke",
                    }).then(() => {
                        window.location.reload();
                    });
                },
                error: function(xhr) {
                    var errorResponse = JSON.parse(xhr.responseText);
                    var errorMessage = errorResponse.message || 'Terjadi kesalahan. Silakan coba lagi.';
                    Swal.fire({
                        icon: "error",
                        title: "Login Gagal!",
                        text: "Pastikan username dan password telah sesuai!",
                        confirmButtonText: "Oke",
                    });
                }
            });
        }

        document.getElementById("btnMasuk").addEventListener("click", function() {
            requestLocationPermission("masuk");
        });

        document.getElementById("btnKeluar").addEventListener("click", function() {
            requestLocationPermission("keluar");
        });

        setInterval(() => {
            updateDate();
            checkAttendanceTime();
        }, 10);

        document.addEventListener("DOMContentLoaded", function() {
            initMap();
            updateDate();
            checkAttendanceTime();
        });
    </script>

    <style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .content-wrapper {
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 1200px;
        }

        .presensi-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            width: 350px;
        }

        .presensi-box {
            border: 1px solid #000;
            padding: 20px;
            border-radius: 10px;
            background: #d3d3d3;
            text-align: center;
        }

        .presensi-box button {
            background-color: blue;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .presensi-box button:disabled {
            background-color: gray;
            cursor: not-allowed;
        }

        #map {
            width: 600px;
            height: 400px;
            border-radius: 10px;
        }
    </style>
</body>

</html>