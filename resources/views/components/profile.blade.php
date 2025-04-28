<!-- User Profile -->
<div class="user-profile">
    <img src="{{ asset('image/Profil-User.png') }}" alt="User" class="profile-img">
    <div>
        @if (Auth::user()->role == 'admin')
            <p class="name">{{ Auth::user()->admin->name }}</p>
        @elseif (Auth::user()->role == 'user')
            <p class="name">{{ Auth::user()->pegawai->name }}</p>
            <p class="role">{{ Auth::user()->pegawai->position }}</p>
        @endif
        <button class="btn btn-danger mt-4 text-center" type="button" onclick="logout()">Logout</button>
    </div>
</div>

<script>
    function logout() {
        $.ajax({
            url: "{{ route('logout') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
            },
            success: function(response) {
                Swal.fire({
                    icon: "success",
                    title: "Logout Berhasil",
                    text: "Anda berhasil logout!",
                    confirmButtonText: "Oke",
                }).then(() => {
                    window.location.href = "{{ route('login') }}";
                });
            },
            error: function(xhr, status, error) {
                console.log("Terjadi kesalahan saat logout. Silakan coba lagi.")
            }
        });
    };
</script>