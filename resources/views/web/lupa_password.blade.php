<section class="register-login-section" style="padding: 60px 0px; background-color: #f1f5f9;">
    <div class="auto-container">
        <div class="row clearfix" style="justify-content: center;">
            
            <!-- LUPA PASSWORD -->
            <div class="col-md-6 col-sm-12">
                <div class="auth-card" style="border-top: 4px solid #ef4444;">
                    <div style="text-align: center; margin-bottom: 20px;">
                        <div style="display: inline-flex; align-items: center; justify-content: center; width: 60px; height: 60px; background: linear-gradient(135deg, #fef2f2, #fee2e2); border-radius: 50%; margin-bottom: 15px;">
                            <i class="fa fa-lock" style="font-size: 24px; color: #dc2626;"></i>
                        </div>
                        <h3 class="auth-title" style="text-align: center;">Lupa Password</h3>
                    </div>
                    <p class="auth-desc" style="text-align: center;">Masukkan alamat email yang Anda daftarkan. Kami akan mengirimkan <strong>kode verifikasi 6 digit</strong> ke email tersebut untuk mereset password Anda.</p>
                    <hr class="auth-divider" style="margin-left: auto; margin-right: auto; background: #ef4444;"/>
                    
                    <form method="post" class="form form-horizontal" id="form-lupa" action="javascript:void(0)">
                        @csrf

                        <div class="form-group top-aligned-group">
                            <label class="top-label">Email <span class="text-danger">*</span></label>
                            <div class="modern-input-group">
                                <span class="input-icon"><i class="fa fa-envelope"></i></span>
                                <input type="email" class="modern-input with-icon" id="email" name="email" placeholder="Masukkan email Anda" required>
                            </div>
                            <small style="color: red; display: none;" id="email-alert">Email wajib diisi.</small>
                        </div>

                        <div id="ResponseLupa" style="margin-bottom: 15px;"></div>

                        <div class="form-group" style="margin-top: 20px;">
                            <button type="submit" id="btn-submit-lupa" class="btn-modern-primary btn-block" style="background: linear-gradient(135deg, #dc2626, #ef4444); box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);">
                                <i class="fa fa-paper-plane"></i> &nbsp; KIRIM KODE VERIFIKASI
                            </button>
                        </div>

                        <div class="form-group text-center" style="margin-top: 15px;">
                            <a href="{{ route('login') }}" class="forgot-link" style="color: #64748b;">
                                <i class="fa fa-arrow-left"></i> Kembali ke halaman Login
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
        border-color: #ef4444;
        background: #ffffff;
        outline: none;
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
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
        box-shadow: 0 6px 15px rgba(239, 68, 68, 0.3);
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

    $("#form-lupa").submit(function(event) {
        event.preventDefault();

        $('#email-alert').hide();
        $('#ResponseLupa').html('');

        var email = $('#email').val().trim();

        if (!email) {
            $('#email-alert').show();
            return;
        }

        // Disable button & show loading
        var $btn = $('#btn-submit-lupa');
        var originalText = $btn.html();
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> &nbsp; Mengirim...');

        // Cek apakah email terdaftar
        $.ajax({
            url: "{{ url('cek_email') }}",
            data: { email: email },
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                if (data.count == 0) {
                    $('#ResponseLupa').html('<div class="alert-danger-custom"><i class="fa fa-times-circle"></i> Email tidak ditemukan di database! Pastikan email yang Anda masukkan benar.</div>');
                    $btn.prop('disabled', false).html(originalText);
                } else {
                    // Email ditemukan, kirim kode verifikasi
                    $.ajax({
                        url: "{{ url('lupa_password2') }}",
                        data: { email: email },
                        type: "POST",
                        dataType: "JSON",
                        success: function(json) {
                            if (json.status == 1) {
                                // Redirect ke halaman ubah password
                                location.replace('{{ url("/ubah_password") }}?email=' + encodeURIComponent(json.email));
                            } else {
                                $('#ResponseLupa').html('<div class="alert-danger-custom"><i class="fa fa-times-circle"></i> ' + (json.msg || 'Gagal mengirim kode verifikasi. Silakan coba lagi.') + '</div>');
                                $btn.prop('disabled', false).html(originalText);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            $('#ResponseLupa').html('<div class="alert-danger-custom"><i class="fa fa-times-circle"></i> Terjadi kesalahan server. Silakan coba lagi nanti.</div>');
                            $btn.prop('disabled', false).html(originalText);
                        }
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#ResponseLupa').html('<div class="alert-danger-custom"><i class="fa fa-times-circle"></i> Terjadi kesalahan server. Silakan coba lagi nanti.</div>');
                $btn.prop('disabled', false).html(originalText);
            }
        });
    });
</script>
