<x-header></x-header>
<body>

    <div class="container">

        <div class="login-box">
            <h2>Login to Your Account</h2>
            <form>
                <div class="input-group">
                    <input type="text" placeholder="Username">
                    <i class="fa fa-user"></i>
                </div>
                <div class="input-group">
                    <input type="password" placeholder="Password">
                    <i class="fa fa-lock"></i>
                </div>
                <button type="submit" class="login-btn">LOGIN</button>
            </form>
        </div>

        <div class="illustration">
            <img  src="{{ asset('image/Logo-Login.png') }}" alt="Illustration">
        </div>
    </div>

</body>
</html>
