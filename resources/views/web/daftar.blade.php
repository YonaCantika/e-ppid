@php
    // Pastikan $errors terdefinisi sebagai ViewErrorBag yang aman
    $errors = $errors ?? new \Illuminate\Support\ViewErrorBag;

    // Cek jika terdapat error pendaftaran dari validasi server atau request register
    $showRegister = $errors->has('email-register') 
        || $errors->has('nomor-identitas-register') 
        || $errors->has('nama-lengkap-register') 
        || $errors->has('pekerjaan-register') 
        || $errors->has('alamat-register') 
        || $errors->has('telp-register') 
        || $errors->has('password-register')
        || $errors->has('jenis-permohonan-register')
        || $errors->has('jenis-identitas-register')
        || request()->query('mode') === 'register'
        || request()->query('tab') === 'register'
        || old('nama-lengkap-register');
@endphp

<section class="auth-portal-section">
    <div class="auto-container">
        
        <!-- ==============================================================
             STATE 1: LOGIN VIEW (DEFAULT)
             Kiri: Banner Sambutan "Belum punya akun?" + Tombol DAFTAR
             Kanan: Form Login Pemohon yang Bersih
             ============================================================== -->
        <div id="auth-login-view" class="auth-view-pane {{ $showRegister ? '' : 'active' }}" style="{{ $showRegister ? 'display: none;' : 'display: block;' }}">
            <div class="row clearfix auth-equal-row">
                
                <!-- KOLOM KIRI: BANNER SAMBUTAN "BELUM PUNYA AKUN?" -->
                <div class="col-md-5 col-sm-12 auth-col">
                    <div class="welcome-banner-card">
                        <div class="banner-decor-circle-1"></div>
                        <div class="banner-decor-circle-2"></div>
                        
                        <div class="welcome-content">
                            <!-- Badge / Pill KIP -->
                            <div class="welcome-badge">
                                <i class="fas fa-certificate"></i> Portal Resmi E-PPID
                            </div>

                            <!-- Ilustrasi / Ikon Keamanan -->
                            <div class="security-shield-wrapper">
                                <div class="security-shield-icon">
                                    <i class="fas fa-user-shield"></i>
                                </div>
                                <div class="security-shield-glow"></div>
                            </div>

                            <h2 class="welcome-heading">Belum punya akun?</h2>
                            <p class="welcome-desc">
                                Daftarkan diri Anda sekarang untuk kemudahan mengajukan permohonan informasi publik serta pengajuan keberatan secara mandiri, transparan, dan terpercaya.
                            </p>

                            <!-- Keunggulan Layanan -->
                            <div class="welcome-features">
                                <div class="feature-item">
                                    <div class="feature-icon"><i class="fas fa-check-circle"></i></div>
                                    <div class="feature-text">
                                        <strong>Keamanan Data Terjamin</strong>
                                        <span>Data pribadi terlindungi sesuai regulasi UU KIP.</span>
                                    </div>
                                </div>
                                <div class="feature-item">
                                    <div class="feature-icon"><i class="fas fa-clock"></i></div>
                                    <div class="feature-text">
                                        <strong>Pelacakan Status Real-Time</strong>
                                        <span>Pantau proses informasi publik secara transparan.</span>
                                    </div>
                                </div>
                                <div class="feature-item">
                                    <div class="feature-icon"><i class="fas fa-envelope-open-text"></i></div>
                                    <div class="feature-text">
                                        <strong>Verifikasi Cepat & Otomatis</strong>
                                        <span>Aktivasi akun mudah via kode OTP email.</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol CTA DAFTAR SEKARANG (Link dengan Fallback & Instant Toggle) -->
                            <div class="welcome-action-wrap">
                                <a href="{{ url('daftar') }}?mode=register#register" 
                                   class="btn-banner-register" 
                                   id="btn-trigger-register" 
                                   onclick="return switchToRegister(event);">
                                    <span>DAFTAR SEKARANG</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                                <p class="welcome-note">Gratis, cepat, dan mudah dalam hitungan menit</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KOLOM KANAN: FORM LOGIN PEMOHON BERSIH -->
                <div class="col-md-7 col-sm-12 auth-col">
                    <div class="auth-card-clean login-card-box">
                        
                        <!-- Header Form Login -->
                        <div class="auth-header-block">
                            <div class="auth-header-pill">
                                <i class="fas fa-sign-in-alt"></i> Masuk Pemohon
                            </div>
                            <h3 class="auth-card-title">Login Pemohon Informasi</h3>
                            <p class="auth-card-subtitle">Silakan masukkan email dan password yang telah Anda daftarkan.</p>
                        </div>

                        <!-- Feedback Alerts (Error / Success / Warning) -->
                        @if (session('login_error') || session('error_login') || $errors->has('login_error') || $errors->has('email') || $errors->has('password'))
                            <div class="auth-alert alert-danger-custom">
                                <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
                                <div class="alert-body">
                                    <strong>Login Gagal!</strong>
                                    <p>{{ session('login_error') ?? session('error_login') ?? $errors->first('login_error') ?? $errors->first('email') ?? $errors->first('password') }}</p>
                                </div>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="auth-alert alert-success-custom">
                                <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
                                <div class="alert-body">
                                    <strong>Berhasil!</strong>
                                    <p>{{ session('success') }}</p>
                                </div>
                            </div>
                        @endif

                        @if (session('warning'))
                            <div class="auth-alert alert-warning-custom">
                                <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                                <div class="alert-body">
                                    <strong>Pemberitahuan:</strong>
                                    <p>{{ session('warning') }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Form Login -->
                        <form method="post" id="form-login" action="{{ route('login.submit') }}">
                            @csrf
                            
                            <!-- Input Email -->
                            <div class="form-group modern-form-group">
                                <label class="modern-label" for="login-email">
                                    <i class="far fa-envelope"></i> Alamat Email <span class="text-danger">*</span>
                                </label>
                                <div class="modern-input-wrapper">
                                    <span class="modern-input-icon"><i class="fas fa-envelope"></i></span>
                                    <input type="email" name="email" id="login-email" class="modern-form-control" placeholder="contoh: nama@email.com" value="{{ old('email') }}" required autofocus>
                                </div>
                            </div>

                            <!-- Input Password -->
                            <div class="form-group modern-form-group">
                                <div class="label-flex-row">
                                    <label class="modern-label" for="login-password">
                                        <i class="fas fa-lock"></i> Password <span class="text-danger">*</span>
                                    </label>
                                    <a href="{{ route('lupa_password') }}" class="modern-forgot-link">Lupa Password?</a>
                                </div>
                                <div class="modern-input-wrapper">
                                    <span class="modern-input-icon"><i class="fas fa-key"></i></span>
                                    <input type="password" name="password" id="login-password" class="modern-form-control with-toggle-eye" placeholder="Masukkan kata sandi Anda" required>
                                    <button type="button" class="btn-toggle-eye" onclick="togglePasswordEye('login-password', 'eye-icon-login')" tabindex="-1" title="Lihat/Sembunyikan Password">
                                        <i class="far fa-eye" id="eye-icon-login"></i>
                                    </button>
                                </div>
                            </div>

                            <p id="ResponseInput"></p>

                            <!-- Tombol Submit Login -->
                            <div class="form-group" style="margin-top: 25px; margin-bottom: 20px;">
                                <button type="submit" class="btn-modern-primary btn-block">
                                    <i class="fas fa-sign-in-alt mr-2"></i> MASUK SEKARANG
                                </button>
                            </div>

                            <!-- Catatan Keamanan & Mobile Toggle -->
                            <div class="login-footer-security">
                                <i class="fas fa-shield-alt"></i> Koneksi aman & terenkripsi SSL 256-bit PT Garam
                            </div>

                            <div class="mobile-switch-box visible-xs visible-sm">
                                <span>Belum memiliki akun?</span>
                                <a href="{{ url('daftar') }}?mode=register#register" 
                                   class="btn-link-switch btn-switch-to-register" 
                                   onclick="return switchToRegister(event);">
                                    Daftar Sekarang <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>


        <!-- ==============================================================
             STATE 2: REGISTER VIEW (STATE SWITCHING)
             Formulir Registrasi Lengkap dengan Navigasi Kembali ke Login
             ============================================================== -->
        <div id="auth-register-view" class="auth-view-pane {{ $showRegister ? 'active' : '' }}" style="{{ $showRegister ? 'display: block;' : 'display: none;' }}">
            <div class="auth-card-clean register-card-box">
                
                <!-- Top Bar Navigasi Register -->
                <div class="register-header-flex">
                    <div class="register-header-info">
                        <div class="auth-header-pill">
                            <i class="fas fa-user-plus"></i> Pendaftaran Akun Pemohon
                        </div>
                        <h2 class="register-main-title">Register Pemohon Informasi</h2>
                        <p class="register-lead">
                            Formulir ini digunakan untuk registrasi pemohon di Sistem KIP PT Garam. Pemohon dinyatakan berhasil mendaftar apabila telah mengisi kelengkapan formulir dan memverifikasi <strong>kode OTP</strong> yang dikirimkan ke email Anda.
                        </p>
                    </div>
                    <div class="register-header-actions">
                        <div class="return-pill-box">
                            <span class="return-label">Sudah punya akun?</span>
                            <a href="{{ url('daftar') }}#login" 
                               class="btn-outline-login btn-switch-to-login" 
                               onclick="return switchToLogin(event);">
                                <i class="fas fa-sign-in-alt"></i> Masuk di sini
                            </a>
                        </div>
                    </div>
                </div>

                <hr class="register-inner-divider">

                <!-- Alert Validation Error Register -->
                @if ($errors->has('email-register') || $errors->has('nomor-identitas-register') || $errors->has('nama-lengkap-register') || $errors->has('pekerjaan-register') || $errors->has('alamat-register') || $errors->has('telp-register') || $errors->has('password-register'))
                    <div class="auth-alert alert-danger-custom" style="margin-bottom: 25px;">
                        <div class="alert-icon"><i class="fas fa-exclamation-triangle"></i></div>
                        <div class="alert-body">
                            <strong>Pendaftaran Belum Lengkap / Gagal!</strong>
                            <p>Silakan periksa kembali beberapa isian formulir di bawah ini:</p>
                            <ul style="margin: 5px 0 0 18px; padding: 0; font-size: 13px;">
                                @if ($errors->has('email-register'))
                                    <li><strong>Email:</strong> {{ $errors->first('email-register') }}</li>
                                @endif
                                @if ($errors->has('password-register'))
                                    <li><strong>Password:</strong> {{ $errors->first('password-register') }}</li>
                                @endif
                                @if ($errors->has('nama-lengkap-register'))
                                    <li><strong>Nama Lengkap:</strong> {{ $errors->first('nama-lengkap-register') }}</li>
                                @endif
                                @if ($errors->has('nomor-identitas-register'))
                                    <li><strong>Nomor Identitas:</strong> {{ $errors->first('nomor-identitas-register') }}</li>
                                @endif
                                @if ($errors->has('telp-register'))
                                    <li><strong>No. Telp / HP:</strong> {{ $errors->first('telp-register') }}</li>
                                @endif
                                @if ($errors->has('alamat-register'))
                                    <li><strong>Alamat:</strong> {{ $errors->first('alamat-register') }}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                @endif

                <!-- Form Pendaftaran Pemohon -->
                <form method="post" id="form-register" action="{{ route('daftar.submit') }}">
                    @csrf

                    <div class="row clearfix">
                        
                        <!-- 1. Jenis Permohonan -->
                        <div class="col-md-6 col-sm-12 form-group modern-form-group">
                            <label class="modern-label" for="jenis-permohonan-register">
                                Jenis Permohonan <span class="text-danger">*</span>
                            </label>
                            <div class="modern-select-wrapper">
                                <select class="modern-form-control modern-select" id="jenis-permohonan-register" name="jenis-permohonan-register" required>
                                    <option value="1" {{ old('jenis-permohonan-register') == '1' ? 'selected' : '' }}>Perorangan</option>
                                    <option value="2" {{ old('jenis-permohonan-register') == '2' ? 'selected' : '' }}>Kelompok Orang</option>
                                    <option value="3" {{ old('jenis-permohonan-register') == '3' ? 'selected' : '' }}>Badan Hukum</option>
                                </select>
                                <span class="select-chevron"><i class="fas fa-chevron-down"></i></span>
                            </div>
                            @error('jenis-permohonan-register') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- 2. Jenis Identitas -->
                        <div class="col-md-6 col-sm-12 form-group modern-form-group">
                            <label class="modern-label" for="jenis-identitas-register">
                                Jenis Identitas <span class="text-danger">*</span>
                            </label>
                            <div class="modern-select-wrapper">
                                <select class="modern-form-control modern-select" id="jenis-identitas-register" name="jenis-identitas-register" required>
                                    <option value="1" {{ old('jenis-identitas-register') == '1' ? 'selected' : '' }}>KTP</option>
                                    <option value="2" {{ old('jenis-identitas-register') == '2' ? 'selected' : '' }}>Pengesahan Badan Usaha</option>
                                    <option value="3" {{ old('jenis-identitas-register') == '3' ? 'selected' : '' }}>Surat Kuasa</option>
                                    <option value="4" {{ old('jenis-identitas-register') == '4' ? 'selected' : '' }}>Badan Publik</option>
                                </select>
                                <span class="select-chevron"><i class="fas fa-chevron-down"></i></span>
                            </div>
                            @error('jenis-identitas-register') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- 3. Nomor Identitas -->
                        <div class="col-md-6 col-sm-12 form-group modern-form-group">
                            <label class="modern-label" for="nomor-identitas-register">
                                Nomor Identitas (NIK/No. Pengesahan) <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="modern-form-control" id="nomor-identitas-register" name="nomor-identitas-register" value="{{ old('nomor-identitas-register') }}" placeholder="Nomor Identitas resmi" required>
                            @error('nomor-identitas-register') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- 4. Nama Lengkap -->
                        <div class="col-md-6 col-sm-12 form-group modern-form-group">
                            <label class="modern-label" for="nama-lengkap-register">
                                Nama Lengkap <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="modern-form-control" id="nama-lengkap-register" name="nama-lengkap-register" value="{{ old('nama-lengkap-register') }}" placeholder="Nama lengkap sesuai identitas" required>
                            @error('nama-lengkap-register') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- 5. Email -->
                        <div class="col-md-6 col-sm-12 form-group modern-form-group">
                            <label class="modern-label" for="email-register">
                                Alamat Email Aktif <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="modern-form-control" id="email-register" name="email-register" value="{{ old('email-register') }}" placeholder="alamat@email.com (Untuk kode OTP)" required>
                            <span class="field-hint"><i class="fas fa-info-circle"></i> Pastikan email aktif untuk verifikasi akun.</span>
                            @error('email-register') <small class="text-danger font-weight-bold d-block">{{ $message }}</small> @enderror
                        </div>

                        <!-- 6. NPWP -->
                        <div class="col-md-6 col-sm-12 form-group modern-form-group">
                            <label class="modern-label" for="npwp-register">
                                NPWP <span class="text-muted">(Opsional)</span>
                            </label>
                            <input type="text" class="modern-form-control" id="npwp-register" name="npwp-register" value="{{ old('npwp-register') }}" placeholder="Nomor Pokok Wajib Pajak">
                            @error('npwp-register') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- 7. Pekerjaan -->
                        <div class="col-md-6 col-sm-12 form-group modern-form-group">
                            <label class="modern-label" for="pekerjaan-register">
                                Pekerjaan <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="modern-form-control" id="pekerjaan-register" name="pekerjaan-register" value="{{ old('pekerjaan-register') }}" placeholder="Contoh: Wiraswasta, Karyawan, Mahasiswa" required>
                            @error('pekerjaan-register') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- 8. Password -->
                        <div class="col-md-6 col-sm-12 form-group modern-form-group">
                            <label class="modern-label" for="password-register">
                                Password Akun <span class="text-danger">*</span>
                            </label>
                            <div class="modern-input-wrapper">
                                <input type="password" class="modern-form-control with-toggle-eye" id="password-register" name="password-register" placeholder="Minimal 4 karakter" required>
                                <button type="button" class="btn-toggle-eye" onclick="togglePasswordEye('password-register', 'eye-icon-register')" tabindex="-1" title="Lihat/Sembunyikan Password">
                                    <i class="far fa-eye" id="eye-icon-register"></i>
                                </button>
                            </div>
                            @error('password-register') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- 9. No HP / WA -->
                        <div class="col-md-6 col-sm-12 form-group modern-form-group">
                            <label class="modern-label" for="telp-register">
                                No HP / WhatsApp <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="modern-form-control" id="telp-register" name="telp-register" value="{{ old('telp-register') }}" placeholder="Contoh: 081234567890" required>
                            @error('telp-register') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- 10. No Fax -->
                        <div class="col-md-6 col-sm-12 form-group modern-form-group">
                            <label class="modern-label" for="fax-register">
                                No Fax <span class="text-muted">(Opsional)</span>
                            </label>
                            <input type="text" class="modern-form-control" id="fax-register" name="fax-register" value="{{ old('fax-register') }}" placeholder="Nomor Fax (jika ada)">
                            @error('fax-register') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- 11. Alamat Lengkap -->
                        <div class="col-md-12 col-sm-12 form-group modern-form-group">
                            <label class="modern-label" for="alamat-register">
                                Alamat Lengkap <span class="text-danger">*</span>
                            </label>
                            <textarea class="modern-form-control modern-textarea" id="alamat-register" name="alamat-register" placeholder="Tuliskan alamat domisili lengkap Anda..." rows="3" required>{{ old('alamat-register') }}</textarea>
                            @error('alamat-register') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                    </div>

                    <!-- Bottom Action Controls -->
                    <div class="register-footer-bar">
                        <div class="footer-return-link">
                            <a href="{{ url('daftar') }}#login" 
                               class="btn-clean-back btn-switch-to-login" 
                               onclick="return switchToLogin(event);">
                                <i class="fas fa-arrow-left"></i> Sudah punya akun? Masuk di sini
                            </a>
                        </div>
                        <div class="footer-submit-action">
                            <button type="submit" class="btn-modern-primary btn-register-cta-main">
                                <i class="fas fa-user-plus mr-2"></i> DAFTAR SEKARANG
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>

    </div>
</section>

<!-- ==============================================================
     CUSTOM STYLING (Corporate PT Garam Theme, Responsive, Modern)
     ============================================================== -->
<style>
    /* Section Container */
    .auth-portal-section {
        padding: 55px 0 75px 0;
        background: linear-gradient(180deg, #f1f5f9 0%, #e2e8f0 100%);
        min-height: calc(100vh - 200px);
        position: relative;
    }

    /* Equal Height Alignment */
    .auth-equal-row {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-flex-wrap: wrap;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        align-items: stretch;
    }
    .auth-col {
        display: flex;
        flex-direction: column;
    }

    /* Base White Modern Card */
    .auth-card-clean {
        background: #ffffff;
        border-radius: 18px;
        padding: 40px 38px;
        box-shadow: 0 15px 35px -5px rgba(0, 40, 100, 0.08), 0 5px 15px rgba(0, 0, 0, 0.03);
        border: 1px solid #e2e8f0;
        position: relative;
        width: 100%;
        box-sizing: border-box;
    }

    /* ==============================================================
       1. BANNER SAMBUTAN "BELUM PUNYA AKUN?" (KIRI)
       ============================================================== */
    .welcome-banner-card {
        background: linear-gradient(145deg, #0f3460 0%, #004b93 45%, #1d4ed8 100%);
        border-radius: 18px;
        padding: 42px 36px;
        color: #ffffff;
        position: relative;
        overflow: hidden;
        box-shadow: 0 15px 35px -5px rgba(0, 75, 147, 0.35);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        border: 1px solid rgba(255, 255, 255, 0.15);
    }
    .banner-decor-circle-1 {
        position: absolute;
        top: -60px;
        right: -60px;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.16) 0%, rgba(255, 255, 255, 0) 70%);
        pointer-events: none;
    }
    .banner-decor-circle-2 {
        position: absolute;
        bottom: -80px;
        left: -80px;
        width: 260px;
        height: 260px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(56, 189, 248, 0.18) 0%, rgba(56, 189, 248, 0) 70%);
        pointer-events: none;
    }
    .welcome-content {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .welcome-badge {
        display: inline-block;
        align-self: flex-start;
        background: rgba(255, 255, 255, 0.18);
        border: 1px solid rgba(255, 255, 255, 0.3);
        padding: 5px 14px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        color: #e0f2fe;
        margin-bottom: 22px;
        backdrop-filter: blur(4px);
    }
    .welcome-badge i {
        color: #fbbf24;
        margin-right: 5px;
    }
    .security-shield-wrapper {
        position: relative;
        display: inline-block;
        margin-bottom: 20px;
    }
    .security-shield-icon {
        width: 68px;
        height: 68px;
        background: rgba(255, 255, 255, 0.15);
        border: 2px solid rgba(255, 255, 255, 0.35);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        color: #ffffff;
        backdrop-filter: blur(8px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }
    .welcome-heading {
        font-size: 27px;
        font-weight: 800;
        color: #ffffff;
        margin: 0 0 12px 0;
        line-height: 1.25;
        letter-spacing: -0.3px;
    }
    .welcome-desc {
        font-size: 14px;
        color: #e0f2fe;
        line-height: 1.65;
        margin-bottom: 26px;
    }
    .welcome-features {
        margin-bottom: 30px;
        display: flex;
        flex-direction: column;
        gap: 14px;
    }
    .feature-item {
        display: flex;
        align-items: flex-start;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        padding: 11px 14px;
        border: 1px solid rgba(255, 255, 255, 0.12);
        transition: transform 0.2s ease, background 0.2s ease;
    }
    .feature-item:hover {
        background: rgba(255, 255, 255, 0.14);
        transform: translateX(4px);
    }
    .feature-icon {
        color: #38bdf8;
        font-size: 16px;
        margin-right: 12px;
        margin-top: 2px;
        flex-shrink: 0;
    }
    .feature-text strong {
        display: block;
        font-size: 13.5px;
        color: #ffffff;
        font-weight: 700;
        line-height: 1.3;
    }
    .feature-text span {
        display: block;
        font-size: 12px;
        color: #cbd5e1;
        line-height: 1.4;
        margin-top: 2px;
    }
    .welcome-action-wrap {
        margin-top: auto;
        padding-top: 10px;
    }
    .btn-banner-register {
        background: #ffffff !important;
        color: #004b93 !important;
        border: none;
        width: 100%;
        padding: 14px 24px;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 800;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.18);
        transition: all 0.25s ease;
        cursor: pointer;
        text-decoration: none !important;
        box-sizing: border-box;
    }
    .btn-banner-register:hover, .btn-banner-register:focus {
        background: #f8fafc !important;
        color: #003366 !important;
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.25);
        text-decoration: none !important;
    }
    .btn-banner-register i {
        transition: transform 0.2s ease;
    }
    .btn-banner-register:hover i {
        transform: translateX(4px);
    }
    .welcome-note {
        font-size: 11.5px;
        color: #cbd5e1;
        text-align: center;
        margin-top: 9px;
        margin-bottom: 0;
    }

    /* ==============================================================
       2. FORM LOGIN (KANAN)
       ============================================================== */
    .login-card-box {
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 100%;
    }
    .auth-header-block {
        margin-bottom: 25px;
    }
    .auth-header-pill {
        display: inline-block;
        background: #e0f2fe;
        color: #0284c7;
        font-size: 12px;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 20px;
        margin-bottom: 12px;
        letter-spacing: 0.3px;
    }
    .auth-header-pill i {
        margin-right: 5px;
    }
    .auth-card-title {
        font-size: 24px;
        font-weight: 800;
        color: #0f172a;
        margin: 0 0 6px 0;
        line-height: 1.3;
    }
    .auth-card-subtitle {
        font-size: 14px;
        color: #64748b;
        margin: 0;
        line-height: 1.5;
    }

    /* Form Fields & Inputs */
    .modern-form-group {
        margin-bottom: 20px;
    }
    .modern-label {
        display: block;
        font-size: 13.5px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
    }
    .label-flex-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }
    .label-flex-row .modern-label {
        margin-bottom: 0;
    }
    .modern-forgot-link {
        font-size: 13px;
        font-weight: 600;
        color: #0284c7;
        transition: color 0.2s ease;
        text-decoration: none;
    }
    .modern-forgot-link:hover {
        color: #004b93;
        text-decoration: underline;
    }
    .modern-input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }
    .modern-input-icon {
        position: absolute;
        left: 14px;
        color: #94a3b8;
        font-size: 15px;
        pointer-events: none;
        z-index: 2;
    }
    .modern-form-control {
        width: 100%;
        height: 48px;
        background: #f8fafc;
        border: 1.5px solid #cbd5e1;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 14px;
        color: #1e293b;
        transition: all 0.25s ease;
        box-shadow: none;
        box-sizing: border-box;
    }
    .modern-input-wrapper .modern-form-control {
        padding-left: 42px;
    }
    .modern-form-control.with-toggle-eye {
        padding-right: 44px;
    }
    .modern-form-control:focus {
        background: #ffffff;
        border-color: #004b93;
        outline: none;
        box-shadow: 0 0 0 3.5px rgba(0, 75, 147, 0.15);
    }
    .modern-form-control::placeholder {
        color: #94a3b8;
        font-size: 13.5px;
    }
    .btn-toggle-eye {
        position: absolute;
        right: 12px;
        background: transparent;
        border: none;
        color: #94a3b8;
        font-size: 15px;
        cursor: pointer;
        padding: 6px;
        border-radius: 6px;
        transition: color 0.2s ease;
        z-index: 2;
    }
    .btn-toggle-eye:hover {
        color: #004b93;
    }

    /* Custom Select & Textarea */
    .modern-select-wrapper {
        position: relative;
    }
    .modern-select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        cursor: pointer;
        padding-right: 36px;
    }
    .select-chevron {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        pointer-events: none;
        font-size: 13px;
    }
    .modern-textarea {
        height: auto;
        min-height: 95px;
        resize: vertical;
        padding: 12px 14px;
        line-height: 1.5;
    }
    .field-hint {
        display: block;
        font-size: 12px;
        color: #64748b;
        margin-top: 5px;
    }

    /* Modern Primary Button */
    .btn-modern-primary {
        background: linear-gradient(135deg, #004b93 0%, #1d4ed8 100%);
        color: #ffffff !important;
        border: none;
        padding: 13px 28px;
        font-size: 15px;
        font-weight: 700;
        border-radius: 10px;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: all 0.25s ease;
        box-shadow: 0 6px 18px rgba(0, 75, 147, 0.28);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none !important;
    }
    .btn-modern-primary:hover, .btn-modern-primary:focus {
        background: linear-gradient(135deg, #003870 0%, #1e40af 100%);
        color: #ffffff !important;
        transform: translateY(-1.5px);
        box-shadow: 0 10px 24px rgba(0, 75, 147, 0.35);
        text-decoration: none !important;
    }
    .btn-block {
        display: flex;
        width: 100%;
    }
    .login-footer-security {
        text-align: center;
        font-size: 12.5px;
        color: #64748b;
        margin-top: 10px;
    }
    .login-footer-security i {
        color: #10b981;
        margin-right: 4px;
    }
    .mobile-switch-box {
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px dashed #e2e8f0;
        text-align: center;
        font-size: 13.5px;
        color: #475569;
    }
    .btn-link-switch {
        background: transparent;
        border: none;
        color: #004b93 !important;
        font-weight: 700;
        padding: 4px 8px;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-inline;
        text-decoration: none;
    }
    .btn-link-switch:hover {
        text-decoration: underline !important;
        color: #1d4ed8 !important;
    }

    /* Alerts */
    .auth-alert {
        display: flex;
        align-items: flex-start;
        padding: 13px 16px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 13.5px;
        line-height: 1.5;
    }
    .auth-alert .alert-icon {
        font-size: 18px;
        margin-right: 12px;
        margin-top: 2px;
        flex-shrink: 0;
    }
    .auth-alert .alert-body p {
        margin: 2px 0 0 0;
    }
    .alert-danger-custom {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #991b1b;
    }
    .alert-danger-custom .alert-icon {
        color: #ef4444;
    }
    .alert-success-custom {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        color: #166534;
    }
    .alert-success-custom .alert-icon {
        color: #22c55e;
    }
    .alert-warning-custom {
        background: #fffbeb;
        border: 1px solid #fde68a;
        color: #92400e;
    }
    .alert-warning-custom .alert-icon {
        color: #f59e0b;
    }

    /* ==============================================================
       3. REGISTER VIEW (STATE SWITCHING)
       ============================================================== */
    .register-card-box {
        padding: 42px 45px;
    }
    .register-header-flex {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
    }
    .register-header-info {
        flex: 1;
    }
    .register-main-title {
        font-size: 26px;
        font-weight: 800;
        color: #0f172a;
        margin: 4px 0 8px 0;
        line-height: 1.25;
    }
    .register-lead {
        font-size: 14px;
        color: #475569;
        line-height: 1.6;
        margin: 0;
        max-width: 720px;
    }
    .register-header-actions {
        flex-shrink: 0;
    }
    .return-pill-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 10px 16px;
        border-radius: 12px;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 6px;
    }
    .return-label {
        font-size: 12px;
        color: #64748b;
        font-weight: 600;
    }
    .btn-outline-login {
        background: #ffffff;
        color: #004b93 !important;
        border: 1.5px solid #004b93;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
        text-decoration: none !important;
    }
    .btn-outline-login:hover {
        background: #004b93;
        color: #ffffff !important;
    }
    .register-inner-divider {
        height: 1px;
        background: #e2e8f0;
        border: none;
        margin: 25px 0 30px 0;
    }
    .register-footer-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 30px;
        padding-top: 25px;
        border-top: 1px solid #f1f5f9;
        flex-wrap: wrap;
        gap: 15px;
    }
    .btn-clean-back {
        background: transparent;
        border: none;
        color: #64748b !important;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 0;
        transition: color 0.2s ease;
        text-decoration: none !important;
    }
    .btn-clean-back:hover {
        color: #004b93 !important;
        text-decoration: underline !important;
    }
    .btn-register-cta-main {
        padding: 14px 34px;
        font-size: 15px;
    }

    /* ==============================================================
       TRANSITION ANIMATION (Keyframes Fade In)
       ============================================================== */
    @keyframes authFadeIn {
        from {
            opacity: 0;
            transform: translateY(12px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .auth-view-pane.active {
        display: block !important;
        animation: authFadeIn 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    /* ==============================================================
       RESPONSIVE DESIGN (Tablets & Mobile)
       ============================================================== */
    @media (max-width: 991px) {
        .auth-equal-row {
            display: block;
        }
        .welcome-banner-card {
            margin-bottom: 30px;
            height: auto;
            min-height: auto;
        }
        .register-header-flex {
            flex-direction: column;
            align-items: flex-start;
        }
        .return-pill-box {
            align-items: flex-start;
            flex-direction: row;
            align-items: center;
            width: 100%;
            justify-content: space-between;
        }
    }

    @media (max-width: 767px) {
        .auth-portal-section {
            padding: 30px 0 50px 0;
        }
        .auth-card-clean {
            padding: 26px 20px;
            border-radius: 14px;
        }
        .welcome-banner-card {
            padding: 28px 20px;
            border-radius: 14px;
            margin-bottom: 25px;
        }
        .welcome-heading {
            font-size: 22px;
        }
        .auth-card-title {
            font-size: 21px;
        }
        .register-main-title {
            font-size: 22px;
        }
        .register-card-box {
            padding: 26px 20px;
        }
        .register-footer-bar {
            flex-direction: column-reverse;
            align-items: stretch;
            gap: 12px;
        }
        .btn-register-cta-main {
            width: 100%;
        }
        .btn-clean-back {
            justify-content: center;
            width: 100%;
        }
    }
</style>

<!-- ==============================================================
     INTERACTIVE JAVASCRIPT (Global Vanilla JS + Immediate Execution)
     ============================================================== -->
<script type="text/javascript">
    // Fungsi navigasi global (Vanilla JS murni, tidak bergantung pada library lain)
    function switchToRegister(e) {
        if (e) {
            if (typeof e.preventDefault === 'function') e.preventDefault();
            if (typeof e.stopPropagation === 'function') e.stopPropagation();
        }
        
        var loginView = document.getElementById('auth-login-view');
        var registerView = document.getElementById('auth-register-view');
        
        if (loginView && registerView) {
            loginView.style.display = 'none';
            loginView.classList.remove('active');
            
            registerView.style.display = 'block';
            registerView.classList.add('active');
        }

        // Update URL hash
        try {
            if (window.history && window.history.pushState) {
                window.history.pushState(null, null, '#register');
            } else {
                window.location.hash = '#register';
            }
        } catch (err) {}

        // Scroll halus ke container form
        var section = document.querySelector('.auth-portal-section');
        if (section) {
            section.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
        return false;
    }

    function switchToLogin(e) {
        if (e) {
            if (typeof e.preventDefault === 'function') e.preventDefault();
            if (typeof e.stopPropagation === 'function') e.stopPropagation();
        }
        
        var loginView = document.getElementById('auth-login-view');
        var registerView = document.getElementById('auth-register-view');
        
        if (loginView && registerView) {
            registerView.style.display = 'none';
            registerView.classList.remove('active');
            
            loginView.style.display = 'block';
            loginView.classList.add('active');
        }

        // Update URL hash
        try {
            if (window.history && window.history.pushState) {
                window.history.pushState(null, null, '#login');
            } else {
                window.location.hash = '#login';
            }
        } catch (err) {}

        // Scroll halus ke container form
        var section = document.querySelector('.auth-portal-section');
        if (section) {
            section.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
        return false;
    }

    // Toggle intip password (show/hide)
    function togglePasswordEye(inputId, iconId) {
        var input = document.getElementById(inputId);
        var icon = document.getElementById(iconId);
        if (!input || !icon) return;

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    // Pasang ke window object agar langsung tersedia
    window.switchToRegister = switchToRegister;
    window.switchToLogin = switchToLogin;
    window.togglePasswordEye = togglePasswordEye;

    // Periksa status hash URL / Query parameter saat pertama kali dimuat
    function checkInitialAuthState() {
        var hash = window.location.hash;
        var search = window.location.search || '';
        if (hash === '#register' || search.indexOf('mode=register') !== -1 || search.indexOf('tab=register') !== -1) {
            switchToRegister();
        } else if (hash === '#login' || search.indexOf('mode=login') !== -1) {
            switchToLogin();
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', checkInitialAuthState);
    } else {
        checkInitialAuthState();
    }

    window.addEventListener('hashchange', checkInitialAuthState);
</script>
