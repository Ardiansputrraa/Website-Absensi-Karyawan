<x-header></x-header>

<script>
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
                        title: "Login Berhasil",
                        text: "Selamat anda berhasil login!",
                        confirmButtonText: "Oke",
                    }).then(() => {
                        if (response.user.role == "admin") {
                            window.location.href = "/data-pegawai";
                            return;
                        } else {
                            window.location.href = "/user-home";
                        }
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
</script>
<body>

    <div class="container">

        <div class="login-box">
            <h2>Login to Your Account</h2>
            <form>
                <div class="input-group">
                    <input type="text" placeholder="masukan username" id="username">
                    <i class="fa fa-user"></i>
                </div>
                <div>
                    <span id="helpUsername" class="help is-danger"></span>
                </div>
                <div class="input-group">
                    <input type="password" placeholder="Masukan password" id="password">
                    <i class="fa fa-lock"></i>
                </div>
                <div>
                    <span id="helpPassword" class="help is-danger"></span>
                </div>
                <button type="button" class="login-btn" onclick="login()">LOGIN</button>
            </form>
        </div>

        <div class="illustration">
            <img  src="{{ asset('image/Logo-Login.png') }}" alt="Illustration">
        </div>
    </div>

</body>
</html>
