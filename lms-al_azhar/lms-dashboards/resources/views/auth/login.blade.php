<x-guest-layout>
    <div class="uni-login-page">
        <!-- Curved Background -->
        <div class="uni-bg-curve">
            <svg viewBox="0 0 1440 900" preserveAspectRatio="none" width="100%" height="100%">
                <rect width="1440" height="900" fill="#f4f5fa" />
                <path d="M 0,900 L 600,900 C 450,750 350,600 420,0 L 0,0 Z" fill="#e4e6f4" />
                <path d="M 420,0 C 350,600 450,750 600,900 L 1440,900 L 1440,0 Z" fill="#352166" />
            </svg>
        </div>

        <!-- Top Navigation Bar -->
        <header class="uni-header">
            <div class="uni-logo">UNIVERSITYLOGO</div>
            <nav class="uni-nav">
                <a href="#" class="uni-nav-btn">HOME</a>
                <a href="#" class="uni-nav-link">ABOUT</a>
                <a href="#" class="uni-nav-link">PRODUCTS</a>
                <a href="#" class="uni-nav-link">SERVICES</a>
                <a href="#" class="uni-nav-link">CONTACT</a>
            </nav>
        </header>

        <!-- Main Split Container -->
        <div class="uni-container">
            <!-- Left Section: Content & Form -->
            <div class="uni-left">
                <div class="uni-content">
                    <h1 class="uni-title">UNIVERSITY</h1>
                    <h2 class="uni-subtitle">LOGIN PAGE</h2>
                    <p class="uni-description">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    
                    <!-- Login Form Card -->
                    <div class="uni-form-card">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            
                            <div class="uni-form-group">
                                <label for="email" class="uni-label">Email or Username</label>
                                <div class="uni-input-wrapper">
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email">
                                </div>
                                @error('email')
                                    <div class="uni-error-text">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="uni-form-group">
                                <label for="password" class="uni-label">Password</label>
                                <div class="uni-input-wrapper">
                                    <input type="password" id="password" name="password" required placeholder="Enter your password">
                                    <button type="button" class="uni-password-toggle" onclick="togglePasswordVisibility()">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="uni-error-text">{{ $message }}</div>
                                @enderror
                            </div>

                            @if (session('status'))
                                <div class="uni-status-text">{{ session('status') }}</div>
                            @endif

                            <button type="submit" class="uni-btn-login">LOG IN</button>
                            
                            <div class="uni-form-footer">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="uni-forgot-link">Forgot Password?</a>
                                @endif
                                <div class="uni-divider-line"></div>
                                <span class="uni-signup-text">Don't have an account? <a href="#" class="uni-signup-link">Sign Up</a></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Section: Isometric Illustration -->
            <div class="uni-right">
                <!-- Watermark Background -->
                <div class="uni-watermarks">
                    <span class="uni-watermark wm-1">Magnific</span>
                    <span class="uni-watermark wm-2">Magnific</span>
                    <span class="uni-watermark wm-3">Magnific</span>
                    <span class="uni-watermark wm-4">Magnific</span>
                    <span class="uni-watermark wm-5">Magnific</span>
                </div>

                <!-- Isometric SVG -->
                <svg class="uni-isometric-svg" viewBox="0 0 800 650" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Definitions for Gradients -->
                    <defs>
                        <!-- Orange gradient -->
                        <linearGradient id="orangeGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#ffb74d" />
                            <stop offset="100%" stop-color="#f57c00" />
                        </linearGradient>
                        <!-- Pink gradient -->
                        <linearGradient id="pinkGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#f48fb1" />
                            <stop offset="100%" stop-color="#c2185b" />
                        </linearGradient>
                        <!-- Green leaf gradient -->
                        <linearGradient id="leafGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#81c784" />
                            <stop offset="100%" stop-color="#2e7d32" />
                        </linearGradient>
                        <!-- Building face gradient -->
                        <linearGradient id="wallGradLight" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#e0f7fa" />
                            <stop offset="100%" stop-color="#b2ebf2" />
                        </linearGradient>
                        <linearGradient id="wallGradDark" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#b2dfdb" />
                            <stop offset="100%" stop-color="#80cbc4" />
                        </linearGradient>
                    </defs>

                    <!-- Green Leaves (Background Layer) -->
                    <!-- Stem 1 (Left background) -->
                    <path d="M 280,380 C 270,300 240,240 210,180" stroke="#33691e" stroke-width="3" stroke-linecap="round" fill="none" />
                    <!-- Leaves for Stem 1 -->
                    <path d="M 210,180 C 190,190 180,210 200,225 C 220,215 220,195 210,180 Z" fill="url(#leafGrad)" />
                    <path d="M 230,220 C 210,230 205,250 225,265 C 245,255 245,235 230,220 Z" fill="url(#leafGrad)" />
                    <path d="M 250,270 C 230,280 225,300 245,315 C 265,305 265,285 250,270 Z" fill="url(#leafGrad)" />
                    <path d="M 265,320 C 245,330 240,350 260,365 C 280,355 280,335 265,320 Z" fill="url(#leafGrad)" />
                    
                    <!-- Stem 2 (Right background) -->
                    <path d="M 620,280 C 640,220 670,180 690,120" stroke="#33691e" stroke-width="3" stroke-linecap="round" fill="none" />
                    <!-- Leaves for Stem 2 -->
                    <path d="M 690,120 C 705,135 700,155 680,160 C 665,145 675,130 690,120 Z" fill="url(#leafGrad)" />
                    <path d="M 670,170 C 685,185 680,205 660,210 C 645,195 655,180 670,170 Z" fill="url(#leafGrad)" />
                    <path d="M 650,220 C 665,235 660,255 640,260 C 625,245 635,230 650,220 Z" fill="url(#leafGrad)" />

                    <!-- Standing Book (Orange, Middle-Left) -->
                    <!-- Top Face -->
                    <polygon points="310,240 335,255 425,210 400,195" fill="#f5f5f5" stroke="#e0e0e0" stroke-width="0.5" />
                    <!-- Left Spine -->
                    <polygon points="310,240 335,255 335,430 310,415" fill="#e65100" />
                    <path d="M 322,252 L 322,418" stroke="#ffb74d" stroke-width="2" opacity="0.3" fill="none" />
                    <!-- Right Cover -->
                    <polygon points="335,255 425,210 425,385 335,430" fill="url(#orangeGrad)" />
                    <!-- Pages edge (bottom-top lines to show pages block) -->
                    <polygon points="400,195 425,210 425,385 400,370" fill="#eeeeee" />

                    <!-- University Building (Middle-Right) -->
                    <!-- Left Wall -->
                    <polygon points="430,300 550,360 550,510 430,450" fill="url(#wallGradDark)" />
                    <!-- Right Wall (With Windows) -->
                    <polygon points="550,360 670,300 670,450 550,510" fill="url(#wallGradLight)" />
                    
                    <!-- Windows (Blue rectangles on Right Wall) -->
                    <!-- Window Column 1 -->
                    <polygon points="570,345 585,338 585,410 570,417" fill="#0288d1" />
                    <polygon points="570,430 585,423 585,475 570,482" fill="#0288d1" />
                    <!-- Window Column 2 -->
                    <polygon points="600,330 615,323 615,395 600,402" fill="#0288d1" />
                    <polygon points="600,415 615,408 615,460 600,467" fill="#0288d1" />
                    <!-- Window Column 3 -->
                    <polygon points="630,315 645,308 645,380 630,387" fill="#0288d1" />
                    <polygon points="630,400 645,393 645,445 630,452" fill="#0288d1" />

                    <!-- University Text on Left Wall (Isometric Skew) -->
                    <text x="445" y="415" fill="#1a237e" font-family="'Plus Jakarta Sans', sans-serif" font-weight="900" font-size="16" transform="matrix(0.866, 0.43, 0, 0.866, 30, -5)">UNIVERSITY</text>

                    <!-- Pink Slab Roof -->
                    <polygon points="410,300 550,370 690,300 550,230" fill="#d81b60" />
                    <polygon points="410,290 550,360 690,290 550,220" fill="#e91e63" />
                    <!-- Roof edge thickness -->
                    <polygon points="410,290 550,360 550,370 410,300" fill="#c2185b" />
                    <polygon points="550,360 690,290 690,300 550,370" fill="#ad1457" />

                    <!-- Academic Cap (Mortarboard, Top of Roof) -->
                    <!-- Cap Base/Skull Cap -->
                    <path d="M 525,185 C 525,198 575,198 575,185 L 575,197 C 575,207 525,207 525,197 Z" fill="#212121" />
                    <path d="M 525,185 C 525,195 575,195 575,185" stroke="#424242" stroke-width="1.5" fill="none" />
                    <!-- Cap Diamond Board -->
                    <polygon points="480,180 550,205 620,180 550,155" fill="#212121" />
                    <polygon points="480,177 550,202 620,177 550,152" fill="#37474f" />
                    <!-- Button on top -->
                    <ellipse cx="550" cy="177" rx="3.5" ry="2" fill="#ffeb3b" />
                    <!-- Tassel line -->
                    <path d="M 550,177 C 535,185 520,195 520,202" stroke="#ffeb3b" stroke-width="2" stroke-linecap="round" fill="none" />
                    <!-- Tassel fringe -->
                    <polygon points="517,202 523,202 525,212 515,212" fill="#ffeb3b" />

                    <!-- Lying Stack of Books (Bottom) -->
                    
                    <!-- 1. Yellow Book (Bottom) -->
                    <!-- Left Spine -->
                    <polygon points="320,500 350,515 350,545 320,530" fill="#ff8f00" />
                    <!-- Right Page Edge -->
                    <polygon points="350,515 480,450 480,480 350,545" fill="#f5f5f5" />
                    <line x1="360" y1="518" x2="470" y2="463" stroke="#e0e0e0" stroke-width="1" />
                    <line x1="360" y1="523" x2="470" y2="468" stroke="#e0e0e0" stroke-width="1" />
                    <line x1="360" y1="528" x2="470" y2="473" stroke="#e0e0e0" stroke-width="1" />
                    <!-- Top Cover -->
                    <polygon points="320,500 350,515 480,450 450,435" fill="url(#orangeGrad)" />
                    <!-- Red Bookmark ribbon -->
                    <polygon points="410,485 425,477 430,495 415,503" fill="#e53935" />

                    <!-- 2. Pink Book (Top of Yellow Book) -->
                    <!-- Left Spine -->
                    <polygon points="340,465 370,480 370,510 340,495" fill="#c2185b" />
                    <!-- Right Page Edge -->
                    <polygon points="370,480 490,420 490,450 370,510" fill="#f5f5f5" />
                    <line x1="380" y1="483" x2="480" y2="433" stroke="#e0e0e0" stroke-width="1" />
                    <line x1="380" y1="488" x2="480" y2="438" stroke="#e0e0e0" stroke-width="1" />
                    <!-- Top Cover -->
                    <polygon points="340,465 370,480 490,420 460,405" fill="url(#pinkGrad)" />

                    <!-- Foreground Leaves -->
                    <path d="M 290,520 C 270,540 230,550 210,530 C 200,510 230,490 260,500" fill="url(#leafGrad)" opacity="0.9" />
                    <path d="M 480,490 C 510,510 540,500 550,470 C 530,450 500,460 480,490 Z" fill="url(#leafGrad)" opacity="0.9" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Password visibility toggle script -->
    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    </script>
</x-guest-layout>
