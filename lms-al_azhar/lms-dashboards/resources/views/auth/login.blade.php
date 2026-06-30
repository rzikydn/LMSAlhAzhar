<x-guest-layout>
    <div class="uni-login-page">
        <!-- Background Curve SVG dari Backgroud4.svg -->
        <div class="uni-bg-curve" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; width: 100%; height: 100%; z-index: 1; pointer-events: none;">
            <svg id="visual" viewBox="0 0 900 600" width="100%" height="100%" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1">
                <rect x="0" y="0" width="900" height="600" fill="#ffffff"></rect>
                <path d="M443 0L457.7 14.3C472.3 28.7 501.7 57.3 512 85.8C522.3 114.3 513.7 142.7 492.5 171.2C471.3 199.7 437.7 228.3 414.5 257C391.3 285.7 378.7 314.3 395.7 343C412.7 371.7 459.3 400.3 474.3 428.8C489.3 457.3 472.7 485.7 460.7 514.2C448.7 542.7 441.3 571.3 437.7 585.7L434 600L0 600L0 585.7C0 571.3 0 542.7 0 514.2C0 485.7 0 457.3 0 428.8C0 400.3 0 371.7 0 343C0 314.3 0 285.7 0 257C0 228.3 0 199.7 0 171.2C0 142.7 0 114.3 0 85.8C0 57.3 0 28.7 0 14.3L0 0Z" fill="#2ebe9f" stroke-linecap="round" stroke-linejoin="miter"></path>
            </svg>
        </div>
        
        <!-- Main Split Container -->
        <div class="uni-container">
            <!-- Left Section: Green area (Empty) -->
            <div class="uni-left">
                <!-- Sisi kiri kosong (warna hijau toska dari background) -->
            </div>

            <!-- Right Section: White area (Contains Login Form Card) -->
            <div class="uni-right">
                <div class="uni-form-card" style="width: 100%; max-width: 440px;">
                    
                    @if (session('status'))
                        <div class="uni-status-text">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address / Username -->
                        <div class="uni-form-group">
                            <label class="uni-label">Email or Username</label>
                            <div class="uni-input-wrapper">
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required autofocus style="background: #ffffff; border: 1.5px solid #dcdffd;">
                            </div>
                            @error('email')
                                <div class="uni-error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="uni-form-group">
                            <label class="uni-label">Password</label>
                            <div class="uni-input-wrapper">
                                <input id="password" type="password" name="password" placeholder="Enter your password" required style="padding-right: 48px;">
                                <button type="button" onclick="togglePasswordVisibility()" class="uni-password-toggle">
                                    <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" style="width: 20px; height: 20px;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <div class="uni-error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Login Button -->
                        <button type="submit" class="uni-btn-login" style="background: #e91e63;">
                            LOGIN
                        </button>
                    </form>

                    <!-- Footer Links -->
                    <div class="uni-form-footer">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="uni-forgot-link">
                                Forgot Password?
                            </a>
                        @endif
                        <div class="uni-divider-line"></div>
                        <div class="uni-signup-text">
                            Don't have an account? <a href="{{ route('register') }}" class="uni-signup-link">Sign Up</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Password visibility toggle script -->
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                `;
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                `;
            }
        }
    </script>
</x-guest-layout>
