<x-guest-layout>
    <div class="login-page">
        <div class="login-container">
            <div class="login-left">
                <div class="login-left-content">
                    <span class="welcome-tag">Selamat Datang</span>
                    <h1>LMS Al Azhar Jaya Indonesia</h1>
                </div>
            </div>
            <div class="login-right">
                <div class="login-logo-container">
                    <img src="/lms_logo.png" alt="LMS Al Azhar Logo" class="login-logo-img">
                </div>
                
                <h2 class="login-title">Masuk dan Verifikasi</h2>
                <p class="login-sub">Nikmati kemudahan sistem pembelajaran mandiri dengan satu akun terintegrasi.</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label>Email/akun pengguna<span class="required">*</span></label>
                        <div class="input-wrap">
                            <input type="email" name="email" placeholder="contoh@alazharjayaindonesia.sch.id" value="{{ old('email') }}" required autofocus autocomplete="username">
                        </div>
                        @error('email')
                            <div style="color:var(--red);font-size:12px;margin-top:4px">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Password<span class="required">*</span></label>
                        <div class="input-wrap">
                            <input type="password" name="password" placeholder="Password" required autocomplete="current-password">
                        </div>
                        @error('password')
                            <div style="color:var(--red);font-size:12px;margin-top:4px">{{ $message }}</div>
                        @enderror
                    </div>

                    @if (session('status'))
                        <div style="color:var(--green);font-size:13px;margin-bottom:12px;text-align:center">{{ session('status') }}</div>
                    @endif

                    <div class="form-options">
                        <label class="remember-me">
                            <input type="checkbox" name="remember">
                            Ingat saya
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-pass-link">Lupa password?</a>
                        @endif
                    </div>

                    <button type="submit" class="btn-login-submit">Masuk</button>
                </form>

                <div class="login-footer">Powered By Al Azhar Jaya Indonesia</div>
            </div>
        </div>
    </div>
</x-guest-layout>
