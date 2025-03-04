<aside class="sidebar">
    <div class="logo-dashboard">
        <img src="{{ asset('image/Logo-Absensi.png') }}" alt="Logo" class="logo-img">
        <h1>AbsenPro</h1>
    </div>
    <nav>
        <ul>
            <li><a href="/kehadiran-pegawai">Total Pegawai</a></li>
            <li><a href="/data-pegawai">Pegawai</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle">Masterdata <span class="arrow">▼</span></a>
                <ul class="dropdown-menu">
                    <li><a href="/data-jabatan">Data Jabatan</a></li>
                    <li><a href="/data-role">Data Role</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle">Rekap Presensi <span class="arrow">▼</span></a>
                <ul class="dropdown-menu">
                    <li><a href="/rekap-presensi-harian">Rekap Presensi Harian</a></li>
                    <li><a href="/rekap-presensi-bulanan">Rekap Presensi Bulanan</a></li>
                </ul>
            </li>
            <li><a href="/ketidakhadiran">Ketidakhadiran</a></li>
            <li><a href="/laporan-harian">Laporan Harian</a></li>
        </ul>
    </nav>
</aside>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var path = window.location.pathname;
        $(".sidebar nav ul li a").each(function() {
            if ($(this).attr("href") === path) {
                $(this).addClass("active");
            }
        });
        
        // Toggle dropdown
        $('.dropdown-toggle').click(function(e) {
            e.preventDefault();
            $(this).next('.dropdown-menu').slideToggle();
            $(this).find('.arrow').toggleClass('rotate');
        });
    });
</script>

<style>
    .dropdown-menu {
        display: none;
        list-style: none;
        padding-left: 20px;
    }
    .arrow {
        margin-left: 60px;
        font-size: 12px;
        transition: transform 0.3s ease;
    }
    .rotate {
        transform: rotate(180deg);
    }
</style>
