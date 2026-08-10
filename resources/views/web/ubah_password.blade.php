<section class="register-login-section" style="padding: 60px 0px; background-color: #f1f5f9;">
    <div class="auto-container">
        <div class="row clearfix" style="justify-content: center;">
            
            <!-- UBAH PASSWORD -->
            <div class="col-md-6 col-sm-12">
                <div class="auth-card" style="border-top: 4px solid #f59e0b;">
                    <div style="text-align: center; margin-bottom: 20px;">
                        <div style="display: inline-flex; align-items: center; justify-content: center; width: 60px; height: 60px; background: linear-gradient(135deg, #fffbeb, #fef3c7); border-radius: 50%; margin-bottom: 15px;">
                            <i class="fa fa-key" style="font-size: 24px; color: #d97706;"></i>
                        </div>
                        <h3 class="auth-title" style="text-align: center;">Reset Password</h3>
                    </div>
                    
                    <!-- Info Box -->
                    <div style="background: linear-gradient(135deg, #eff6ff, #dbeafe); border: 1px solid #93c5fd; border-radius: 10px; padding: 16px 20px; margin-bottom: 25px; text-align: center;">
                        <p style="margin: 0; font-size: 14px; color: #1e40af;">
                            <i class="fa fa-envelope" style="margin-right: 6px;"></i>
                            Kode verifikasi telah dikirim ke email <strong>{{ $email }}</strong>
                        </p>
                        <p style="margin: 8px 0 0 0; font-size: 13px; color: #3b82f6;">
                            Silakan cek inbox atau folder spam Anda, kemudian masukkan 6 digit kode verifikasi di bawah ini.
                        </p>
                    </div>

                    <hr class="auth-divider" style="margin-left: auto; margin-right: auto; background: #f59e0b;"/>
                    
                    <form method="post" class="form form-horizontal" id="form-reset-password" action="javascript:void(0)">
                        @csrf
                        <input type="hidden" id="email" name="email" value="{{ $email }}">

                        <div class="form-group top-aligned-group">
                            <label class="top-label">Kode Verifikasi <span class="text-danger">*</span></label>
                            <div class="modern-input-group">
                                <span class="input-icon"><i class="fa fa-shield"></i></span>
                                <input type="text" class="modern-input with-icon otp-input" id="kde" name="kde" placeholder="Masukkan 6 digit kode" maxlength="6" required autocomplete="off" style="letter-spacing: 8px; font-size: 20px; font-weight: 700; text-align: center; padding-left: 45px;">
                            </div>
                            <small style="color: #64748b; margin-top: 5px; display: block;">Masukkan 6 digit kode yang dikirim ke email Anda</small>
                        </div>

                        <div class="form-group top-aligned-group">
                            <label class="top-label">Password Baru <span class="text-danger">*</span></label>
                            <div class="modern-input-group">
                                <span class="input-icon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="modern-input with-icon" id="password-baru" name="password-baru" placeholder="Masukkan password baru" required minlength="4">
                            </div>
                            <small style="color: #64748b; margin-top: 5px; display: block;">Minimal 4 karakter</small>
                        </div>

                        <div class="form-group top-aligned-group">
                            <label class="top-label">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                            <div class="modern-input-group">
                                <span class="input-icon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="modern-input with-icon" id="password-konfirmasi" name="password-konfirmasi" placeholder="Ulangi password baru" required minlength="4">
                            </div>
                            <small style="color: red; display: none;" id="password-match-alert">Password tidak sama!</small>
                        </div>

                        <div id="ResponseReset" style="margin-bottom: 15px;"></div>

                        <div class="form-group" style="margin-top: 20px;">
                            <button type="submit" id="btn-submit-reset" class="btn-modern-primary btn-block" style="background: linear-gradient(135deg, #d97706, #f59e0b); box-shadow: 0 4px 12px rgba(245, 158, 11, 0.2);">
                                <i class="fa fa-check-circle"></i> &nbsp; UBAH PASSWORD
                            </button>
                        </div>

                        <div class="form-group text-center" style="margin-top: 15px;">
                            <a href="{{ route('lupa_password') }}" class="forgot-link" style="color: #64748b;">
                                <i class="fa fa-arrow-left"></i> Kirim ulang kode
                            </a>
                            &nbsp;&nbsp;|&nbsp;&nbsp;
                            <a href="{{ route('login') }}" class="forgot-link" style="color: #64748b;">
                                Kembali ke Login
                            </a>
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
    .auth-title {
        font-size: 24px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 15px;
        margin-top: 0;
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
    .modern-input {
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
    .modern-input:focus {
        border-color: #f59e0b;
        background: #ffffff;
        outline: none;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
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
        transform: translateY(-1px);
        box-shadow: 0 6px 15px rgba(245, 158, 11, 0.3);
    }
    .btn-modern-primary:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
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
    .alert-success-custom {
        background: #f0fdf4;
        border: 1px solid #22c55e;
        color: #166534;
        padding: 12px 16px;
        border-radius: 8px;
        font-size: 14px;
    }
    .alert-danger-custom {
        background: #fef2f2;
        border: 1px solid #f87171;
        color: #991b1b;
        padding: 12px 16px;
        border-radius: 8px;
        font-size: 14px;
    }
    .otp-input::-webkit-inner-spin-button,
    .otp-input::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    
    @media (max-width: 768px) {
        .auth-card {
            padding: 25px 20px;
        }
    }
</style>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    // Hanya izinkan angka pada input OTP
    $('#kde').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    // Cek konfirmasi password
    $('#password-konfirmasi').on('input', function() {
        var pass = $('#password-baru').val();
        var konfirmasi = $(this).val();
        if (konfirmasi && pass !== konfirmasi) {
            $('#password-match-alert').show();
        } else {
            $('#password-match-alert').hide();
        }
    });

    $("#form-reset-password").submit(function(event) {
        event.preventDefault();

        $('#ResponseReset').html('');

        var kode = $('#kde').val().trim();
        var passwordBaru = $('#password-baru').val();
        var passwordKonfirmasi = $('#password-konfirmasi').val();

        if (!kode) {
            $('#ResponseReset').html('<div class="alert-danger-custom"><i class="fa fa-times-circle"></i> Kode verifikasi wajib diisi!</div>');
            return;
        }

        if (kode.length !== 6) {
            $('#ResponseReset').html('<div class="alert-danger-custom"><i class="fa fa-times-circle"></i> Kode verifikasi harus 6 digit!</div>');
            return;
        }

        if (!passwordBaru || passwordBaru.length < 4) {
            $('#ResponseReset').html('<div class="alert-danger-custom"><i class="fa fa-times-circle"></i> Password baru minimal 4 karakter!</div>');
            return;
        }

        if (passwordBaru !== passwordKonfirmasi) {
            $('#password-match-alert').show();
            return;
        }

        // Disable button & show loading
        var $btn = $('#btn-submit-reset');
        var originalText = $btn.html();
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> &nbsp; Memproses...');

        $.ajax({
            url: "{{ url('change_password') }}",
            data: $(this).serialize(),
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                if (data.status) {
                    $('#ResponseReset').html('<div class="alert-success-custom"><i class="fa fa-check-circle"></i> ' + (data.msg || 'Password berhasil diubah!') + ' Mengalihkan ke halaman login...</div>');
                    
                    // Redirect ke halaman login setelah 2 detik
                    setTimeout(function() {
                        location.href = "{{ route('login') }}";
                    }, 2000);
                } else {
                    $('#ResponseReset').html('<div class="alert-danger-custom"><i class="fa fa-times-circle"></i> ' + (data.msg || 'Kode verifikasi tidak cocok!') + '</div>');
                    $btn.prop('disabled', false).html(originalText);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#ResponseReset').html('<div class="alert-danger-custom"><i class="fa fa-times-circle"></i> Terjadi kesalahan server. Silakan coba lagi nanti.</div>');
                $btn.prop('disabled', false).html(originalText);
            }
        });
    });
</script>
