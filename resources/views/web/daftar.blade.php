<section class="register-login-section" style="padding: 60px 0px; background-color: #f1f5f9;">
    <div class="auto-container">
        <div class="row clearfix">
            
            <!-- REGISTRASI -->
            <div class="col-md-8 col-sm-12">
                <div class="auth-card">
                    <h3 class="auth-title">Register Pemohon Informasi</h3>
                    <p class="auth-desc">Formulir ini digunakan untuk registrasi pemohon. Dengan mendaftar di Sistem KIP, pemohon mendapatkan kemudahan dalam mengajukan permohonan informasi maupun pengajuan keberatan secara online. Pemohon dinyatakan berhasil mendaftar apabila telah memenuhi semua kelengkapan yang dibutuhkan dan mendapatkan <strong>email konfirmasi</strong> dari pengelola Sistem KIP.</p>
                    <hr class="auth-divider"/>
                    
                    <form method="post" id="form-register" action="{{ route('daftar.submit') }}">
                        @csrf

                        @if ($errors->has('email-register') || $errors->has('nomor-identitas-register') || $errors->has('nama-lengkap-register') || $errors->has('pekerjaan-register') || $errors->has('alamat-register') || $errors->has('telp-register') || $errors->has('password-register'))
                            <div class="alert alert-danger" style="border-radius: 8px; margin-bottom: 20px; background: #fef2f2; border: 1px solid #f87171; color: #991b1b; padding: 12px 16px;">
                                <strong><i class="fa fa-exclamation-triangle mr-2"></i> Pendaftaran Gagal!</strong> Silakan periksa kembali isian formulir Anda.
                                @if ($errors->has('email-register'))
                                    <br><i class="fa fa-info-circle mr-2"></i> <strong>Email:</strong> {{ $errors->first('email-register') }}
                                @endif
                            </div>
                        @endif

                        <div class="row clearfix">
                            <div class="col-md-6 col-sm-12 form-group top-aligned-group">
                                <label class="top-label">Jenis Permohonan <span class="text-danger">*</span></label>
                                <select class="modern-input" id="jenis-permohonan-register" name="jenis-permohonan-register" required>
                                    <option value="1" {{ old('jenis-permohonan-register') == '1' ? 'selected' : '' }}>Perorangan</option>
                                    <option value="2" {{ old('jenis-permohonan-register') == '2' ? 'selected' : '' }}>Kelompok Orang</option>
                                    <option value="3" {{ old('jenis-permohonan-register') == '3' ? 'selected' : '' }}>Badan Hukum</option>
                                </select>
                                @error('jenis-permohonan-register') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 col-sm-12 form-group top-aligned-group">
                                <label class="top-label">Jenis Identitas <span class="text-danger">*</span></label>
                                <select class="modern-input" id="jenis-identitas-register" name="jenis-identitas-register" required>
                                    <option value="1" {{ old('jenis-identitas-register') == '1' ? 'selected' : '' }}>KTP</option>
                                    <option value="2" {{ old('jenis-identitas-register') == '2' ? 'selected' : '' }}>Pengesahan Badan Usaha</option>
                                    <option value="3" {{ old('jenis-identitas-register') == '3' ? 'selected' : '' }}>Surat Kuasa</option>
                                    <option value="4" {{ old('jenis-identitas-register') == '4' ? 'selected' : '' }}>Badan Publik</option>
                                </select>
                                @error('jenis-identitas-register') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            
                            <div class="col-md-6 col-sm-12 form-group top-aligned-group">
                                <label class="top-label">Nomor Identitas <span class="text-danger">*</span></label>
                                <input type="text" class="modern-input" id="nomor-identitas-register" name="nomor-identitas-register" value="{{ old('nomor-identitas-register') }}" placeholder="Nomor Identitas" required>
                                @error('nomor-identitas-register') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 col-sm-12 form-group top-aligned-group">
                                <label class="top-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="modern-input" id="nama-lengkap-register" name="nama-lengkap-register" value="{{ old('nama-lengkap-register') }}" placeholder="Nama Lengkap" required>
                                @error('nama-lengkap-register') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            
                            <div class="col-md-6 col-sm-12 form-group top-aligned-group">
                                <label class="top-label">NPWP</label>
                                <input type="text" class="modern-input" id="npwp-register" name="npwp-register" value="{{ old('npwp-register') }}" placeholder="NPWP (Opsional)">
                                @error('npwp-register') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 col-sm-12 form-group top-aligned-group">
                                <label class="top-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="modern-input" id="email-register" name="email-register" value="{{ old('email-register') }}" placeholder="alamat@email.com" required>
                                @error('email-register') <small class="text-danger font-weight-bold">{{ $message }}</small> @enderror
                            </div>
                            
                            <div class="col-md-6 col-sm-12 form-group top-aligned-group">
                                <label class="top-label">Pekerjaan <span class="text-danger">*</span></label>
                                <input type="text" class="modern-input" id="pekerjaan-register" name="pekerjaan-register" value="{{ old('pekerjaan-register') }}" placeholder="Pekerjaan" required>
                                @error('pekerjaan-register') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 col-sm-12 form-group top-aligned-group">
                                <label class="top-label">Password <span class="text-danger">*</span></label>
                                <input type="password" class="modern-input" id="password-register" name="password-register" placeholder="Password untuk login" required>
                                @error('password-register') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            
                            <div class="col-md-6 col-sm-12 form-group top-aligned-group">
                                <label class="top-label">No HP / No WA <span class="text-danger">*</span></label>
                                <input type="text" class="modern-input" id="telp-register" name="telp-register" value="{{ old('telp-register') }}" placeholder="Contoh : 0813xxxxxxxx" required>
                                @error('telp-register') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 col-sm-12 form-group top-aligned-group">
                                <label class="top-label">No Fax</label>
                                <input type="text" class="modern-input" id="fax-register" name="fax-register" value="{{ old('fax-register') }}" placeholder="No Fax (Opsional)">
                                @error('fax-register') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            
                            <div class="col-md-12 col-sm-12 form-group top-aligned-group">
                                <label class="top-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                <textarea class="modern-textarea" id="alamat-register" name="alamat-register" placeholder="Tulis Alamat Lengkap..." required>{{ old('alamat-register') }}</textarea>
                                @error('alamat-register') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        
                        <div class="form-group text-right" style="margin-top: 15px;">
                            <button type="submit" class="btn-modern-primary"><i class="fa fa-user-plus"></i> DAFTAR SEKARANG</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- LOGIN -->
            <div class="col-md-4 col-sm-12">
                <div class="auth-card login-card">
                    <h3 class="auth-title">Login Pemohon</h3>
                    <p class="auth-desc text-center" style="margin-bottom: 25px;">Sudah punya akun? Silakan masuk.</p>
                    <hr class="auth-divider" style="margin-left: auto; margin-right: auto;" />
                    
                    <form method="post" id="form-login" action="{{ route('login.submit') }}">
                        @csrf
                        <div class="form-group top-aligned-group">
                            <label class="top-label">Email</label>
                            <div class="modern-input-group">
                                <span class="input-icon"><i class="fa fa-envelope"></i></span>
                                <input type="email" name="email" id="usern" class="modern-input with-icon" placeholder="Email Anda">
                            </div>
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        
                        <div class="form-group top-aligned-group">
                            <label class="top-label">Password</label>
                            <div class="modern-input-group">
                                <span class="input-icon"><i class="fa fa-lock"></i></span>
                                <input type="password" name="password" id="passw" class="modern-input with-icon" placeholder="Password Anda">
                            </div>
                            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        
                        <div class="form-group">
                            <p id="ResponseInput"></p>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn-modern-primary btn-block"><i class="fas fa-sign-in-alt"></i> MASUK</button>
                        </div>
                        
                        <div class="form-group text-center" style="margin-top: 15px;">
                            <a href="{{ route('lupa_password') }}" class="forgot-link">Lupa Password?</a>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</section>

<style>
    .auth-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 40px 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        margin-bottom: 30px;
        border: 1px solid #f1f5f9;
    }
    .login-card {
        background: linear-gradient(to bottom, #ffffff, #f8fafc);
        border-top: 4px solid #2563eb;
    }
    .auth-title {
        font-size: 24px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 15px;
        margin-top: 0;
    }
    .login-card .auth-title {
        text-align: center;
    }
    .auth-desc {
        font-size: 14px;
        color: #475569;
        line-height: 1.6;
        margin-bottom: 20px;
    }
    .auth-divider {
        width: 60px;
        height: 4px;
        background: #2563eb;
        border: none;
        margin: 0 0 30px 0;
        border-radius: 2px;
    }
    .top-aligned-group {
        margin-bottom: 20px;
    }
    .top-label {
        display: block;
        font-size: 14px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
    }
    .modern-input, .modern-textarea {
        width: 100%;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 12px 15px;
        font-size: 14px;
        color: #334155;
        transition: all 0.3s ease;
        background: #f8fafc;
        box-shadow: none;
    }
    .modern-input:focus, .modern-textarea:focus {
        border-color: #3b82f6;
        background: #ffffff;
        outline: none;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    .modern-textarea {
        min-height: 100px;
        resize: vertical;
    }
    .modern-input-group {
        position: relative;
    }
    .modern-input-group .input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 16px;
        z-index: 2;
    }
    .modern-input.with-icon {
        padding-left: 45px;
    }
    .btn-modern-primary {
        background: linear-gradient(135deg, #1d4ed8, #2563eb);
        color: #ffffff;
        border: none;
        padding: 12px 25px;
        font-size: 15px;
        font-weight: 700;
        border-radius: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        cursor: pointer;
    }
    .btn-modern-primary:hover {
        background: linear-gradient(135deg, #1e3a8a, #1d4ed8);
        box-shadow: 0 6px 15px rgba(37, 99, 235, 0.3);
        transform: translateY(-1px);
    }
    .btn-block {
        display: block;
        width: 100%;
    }
    .forgot-link {
        color: #3b82f6;
        font-size: 14px;
        font-weight: 600;
        transition: color 0.2s;
    }
    .forgot-link:hover {
        color: #1d4ed8;
        text-decoration: underline;
    }
    
    @media (max-width: 768px) {
        .auth-card {
            padding: 25px 20px;
        }
    }
</style>
