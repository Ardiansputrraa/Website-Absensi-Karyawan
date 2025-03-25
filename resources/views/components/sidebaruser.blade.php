<aside class="sidebar">
    <div class="logo-dashboard">
        <img src="{{ asset('image/Logo-Absensi.png') }}" alt="Logo" class="logo-img">
        <h1>AbsenPro</h1>
    </div>
    <nav>
        <ul>
            <li><a href="/user-home">Home</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle">Rekap Presensi <span class="arrow"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/user-rekap-presensi-harian">Rekap Presensi Harian</a></li>
                    <li><a href="/user-rekap-presensi-bulanan">Rekap Presensi Bulanan</a></li>
                </ul>
            </li>
            <li><a href="/user-ketidakhadiran">Ketidakhadiran</a></li>
            <li><a href="/user-logbook">Laporan Harian</a></li>
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
            var submenu = $(this).next('.dropdown-menu');
            var parent = $(this).parent();
            
            submenu.slideToggle();
            $(this).find('.arrow').toggleClass('rotate');
            
            if (parent.hasClass('dropdown')) {
                parent.toggleClass('open');
            }
        });
    });
</script>

<style>
    .sidebar {
        width: 250px;
        background-color: #ffffff;
        color: black;
        padding: 20px;
        position: fixed;
        height: 100%;
        overflow-y: auto;
    }
    .logo-dashboard {
        text-align: center;
        margin-bottom: 20px;
    }
    .logo-img {
        max-width: 100px;
    }
    .sidebar nav ul {
        list-style: none;
        padding: 0;
    }
    .sidebar nav ul li {
        margin-bottom: 10px;
        position: relative;
        display: block;
    }
    .sidebar nav ul li a {
        text-decoration: none;
        color: black;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border-radius: 5px;
        transition: background 0.3s;
    }
    .sidebar nav ul li a:hover, .sidebar nav ul li a.active {
        background-color: #D3E0FF;
    }
    .dropdown-menu {
        display: none;
        list-style: none;
        padding-left: 15px;
        position: relative;
    }
    .dropdown.open .dropdown-menu {
        display: block;
        position: static;
    }
    .dropdown-menu li {
        display: block;
    }
    .dropdown-menu li a {
        padding: 8px 15px;
        display: block;
        background-color: #ffffff;
        border-radius: 5px;
        transition: background 0.3s;
    }
    .dropdown-menu li a:hover {
        background-color: #16a085;
    }
    .arrow {
        font-size: 12px;
        transition: transform 0.3s ease;
    }
    .rotate {
        transform: rotate(180deg);
    }
</style>
