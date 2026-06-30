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
        <div class="uni-container" style="font-family: 'Plus Jakarta Sans', sans-serif;">
            <!-- Left Section: Green area (Empty) -->
            <div class="uni-left" style="flex: 1.2;">
                <!-- Sisi kiri kosong (warna hijau toska dari background) -->
            </div>

            <!-- Right Section: White area (Contains new Login Form) -->
            <div class="uni-right" style="flex: 0.8; display: flex; align-items: center; justify-content: flex-start; padding-left: 80px; z-index: 5;">
                <div style="width: 100%; max-width: 400px; display: flex; flex-direction: column;">
                    
                    <!-- Header Teks -->
                    <div style="text-align: center; margin-bottom: 32px;">
                        <h2 style="font-size: 38px; font-weight: 700; color: #1e293b; margin: 0 0 12px 0; letter-spacing: -0.5px;">Hello Again!</h2>
                        <p style="font-size: 14px; color: #94a3b8; line-height: 1.6; margin: 0; padding: 0 10px;">Aliquam consectetur et tincidunt praesent enim massa pellentesque velit odio neque</p>
                    </div>

                    @if (session('status'))
                        <div class="uni-status-text" style="color: #10b981; font-size: 13px; margin-bottom: 16px; text-align: center; font-weight: 500;">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Input (Floating Label on Border Style - Color #FF7A60) -->
                        <div style="position: relative; margin-bottom: 24px;">
                            <label style="position: absolute; left: 16px; top: -10px; background: #ffffff; padding: 0 6px; font-size: 12px; font-weight: 600; color: #FF7A60; z-index: 2;">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus style="width: 100%; padding: 16px 48px 16px 20px; border: 1.5px solid #FF7A60; border-radius: 12px; font-size: 15px; outline: none; color: #1e293b; background: #ffffff; font-family: inherit; box-shadow: 0 0 0 3px rgba(255, 122, 96, 0.05);">
                            <span style="position: absolute; right: 18px; top: 50%; transform: translateY(-50%); color: #FF7A60; font-size: 18px; font-weight: 600; pointer-events: none; user-select: none;">@</span>
                            @error('email')
                                <div style="color: #ef4444; font-size: 12px; margin-top: 6px; font-weight: 500;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div style="position: relative; margin-bottom: 20px;">
                            <input id="password" type="password" name="password" placeholder="Password" required style="width: 100%; padding: 16px 48px 16px 20px; border: 1.5px solid #e2e8f0; border-radius: 12px; font-size: 15px; outline: none; color: #1e293b; background: #f8fafc; font-family: inherit; transition: border-color 0.2s ease;">
                            <button type="button" onclick="togglePasswordVisibility()" style="position: absolute; right: 18px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #94a3b8; cursor: pointer; display: flex; align-items: center; justify-content: center; padding: 0;">
                                <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" style="width: 20px; height: 20px;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                            </button>
                            @error('password')
                                <div style="color: #ef4444; font-size: 12px; margin-top: 6px; font-weight: 500;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remember Me & Recovery Password Row (Color #FF7A60) -->
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; font-size: 13.5px;">
                            <label style="display: flex; align-items: center; gap: 8px; color: #94a3b8; cursor: pointer; user-select: none;">
                                <input type="checkbox" name="remember" style="width: 16px; height: 16px; border: 1.5px solid #cbd5e1; border-radius: 4px; accent-color: #FF7A60; cursor: pointer;">
                                Remember Me
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" style="color: #FF7A60; text-decoration: none; font-weight: 600;">Recovery Password</a>
                            @endif
                        </div>

                        <!-- Login Button (Color #FF7A60) -->
                        <button type="submit" style="width: 100%; padding: 16px; background: #FF7A60; color: #ffffff; border: none; border-radius: 12px; font-size: 16px; font-weight: 600; cursor: pointer; transition: background 0.2s ease; margin-bottom: 16px; font-family: inherit; box-shadow: 0 4px 14px rgba(255, 122, 96, 0.2);">
                            Login
                        </button>

                        <!-- Google Sign In Button -->
                        <button type="button" style="width: 100%; padding: 16px; background: #ffffff; color: #64748b; border: 1.5px solid #e2e8f0; border-radius: 12px; font-size: 15px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px; transition: background 0.2s ease; margin-bottom: 36px; font-family: inherit;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" style="width: 20px; height: 20px;">
                                <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                                <path fill="#4285F4" d="M46.5 24c0-1.55-.15-3.24-.47-4.77H24v9.03h12.75c-.55 2.92-2.2 5.4-4.69 7.07l7.29 5.65C43.6 36.42 46.5 30.73 46.5 24z"/>
                                <path fill="#FBBC05" d="M10.54 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.98-6.19z"/>
                                <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.29-5.65c-2.02 1.35-4.61 2.16-8.6 2.16-6.26 0-11.57-4.22-13.46-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                            </svg>
                            Sign in with Google
                        </button>
                    </form>

                    <!-- Footer Link (Sign Up Color #FF7A60) -->
                    <div style="text-align: center; font-size: 14px; color: #94a3b8;">
                        Don't have an account yet? <a href="{{ route('register') }}" style="color: #FF7A60; text-decoration: none; font-weight: 700; margin-left: 4px;">Sign Up</a>
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
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5V6.75a4.5 4.5 0 119 0v3.75M3.75 21.75h16.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H3.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                `;
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                `;
            }
        }
    </script>
</x-guest-layout>
