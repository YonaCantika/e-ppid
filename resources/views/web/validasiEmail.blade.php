<section class="register-login-section" style="padding: 60px 0px; background-color: #f1f5f9; min-height: 70vh; display: flex; align-items: center;">
    <div class="auto-container">
        <div class="row clearfix justify-content-center" style="display: flex; justify-content: center;">
            <div class="col-md-7 col-sm-10 col-xs-12" style="margin: 0 auto; float: none;">
                <div class="auth-card" style="background: #ffffff; border-radius: 16px; padding: 40px; box-shadow: 0 10px 40px rgba(0,0,0,0.06); border-top: 5px solid #2563eb;">
                    <div class="text-center" style="margin-bottom: 25px;">
                        <div style="width: 70px; height: 70px; background: #eff6ff; color: #2563eb; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 32px; margin-bottom: 15px;">
                            <i class="fas fa-envelope-open-text"></i>
                        </div>
                        <h3 class="auth-title" style="font-size: 26px; font-weight: 800; color: #0f172a; margin: 0 0 10px 0;">Verifikasi Akun & Email</h3>
                        <p class="auth-desc" style="font-size: 15px; color: #475569; line-height: 1.6; margin: 0;">
                            Selesaikan langkah terakhir ini untuk mengaktifkan akun pemohon informasi Anda. Setelah verifikasi berhasil, Anda akan langsung diarahkan ke halaman pengguna (Dashboard Pemohon).
                        </p>
                    </div>

                    <hr style="border-top: 1px solid #e2e8f0; margin: 25px 0;" />

                    @if(isset($pemohon) && $pemohon)
                        <div class="info-user-box" style="background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 10px; padding: 15px 20px; margin-bottom: 25px; font-size: 14px; color: #334155;">
                            <p style="margin: 0 0 6px 0;"><strong><i class="fa fa-user mr-2" style="color: #2563eb;"></i> Nama Pemohon:</strong> {{ $pemohon->nama }}</p>
                            <p style="margin: 0 0 6px 0;"><strong><i class="fa fa-envelope mr-2" style="color: #2563eb;"></i> Email Terdaftar:</strong> {{ $pemohon->email }}</p>
                            <p style="margin: 0;"><strong><i class="fa fa-phone mr-2" style="color: #2563eb;"></i> No. HP/WA:</strong> {{ $pemohon->notelp }}</p>
                        </div>

                        <!-- Pemberitahuan Kode Verifikasi Dikirim ke Email -->
                        <div class="alert alert-success" style="background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; border-radius: 10px; padding: 16px; margin-bottom: 25px;">
                            <div style="display: flex; align-items: center;">
                                <i class="fas fa-paper-plane" style="font-size: 28px; margin-right: 15px; color: #10b981;"></i>
                                <div>
                                    <strong style="font-size: 15px;">Kode Verifikasi Telah Dikirim ke Email!</strong>
                                    <p style="margin: 6px 0 0 0; font-size: 14px; color: #047857; line-height: 1.5;">
                                        Silakan periksa kotak masuk (<em>Inbox</em>) atau folder <em>Spam</em> pada email <strong>{{ $pemohon->email }}</strong>.<br/>
                                        Anda dapat langsung mengklik tombol <strong>VERIFIKASI AKUN SAYA SEKARANG</strong> pada email tersebut atau memasukkan 6 digit kode OTP pada kotak di bawah ini.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <form method="post" id="form-verify" action="javascript:void(0)">
                            @csrf
                            <input type="hidden" id="id" name="id" value="{{ $pemohon->id_pemohon }}">

                            <div class="form-group" style="margin-bottom: 25px;">
                                <label style="display: block; font-size: 15px; font-weight: 700; color: #1e293b; margin-bottom: 10px;">
                                    Masukkan Kode Verifikasi (6 Digit) <span class="text-danger">*</span>
                                </label>
                                <div style="position: relative;">
                                    <span style="position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 18px;"><i class="fas fa-key"></i></span>
                                    <input type="text" id="kde" name="kde" class="form-control modern-input" placeholder="Masukkan 6 digit kode unik" required maxlength="6" style="height: 52px; padding-left: 50px; font-size: 18px; font-weight: 700; letter-spacing: 2px; border-radius: 10px; border: 2px solid #cbd5e1; transition: all 0.3s; background: #ffffff;">
                                </div>
                                <small class="text-muted" style="display: block; margin-top: 6px;">Ketikkan kode verifikasi (OTP) Anda pada kotak di atas.</small>
                            </div>

                            <div class="text-center">
                                <button type="submit" id="btn-submit-verify" class="btn-modern-primary" style="width: 100%; padding: 14px; font-size: 16px; font-weight: 700; border-radius: 10px; background: linear-gradient(135deg, #1d4ed8, #2563eb); color: #fff; border: none; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2); cursor: pointer; transition: all 0.3s;">
                                    <i class="fa fa-check-circle mr-2"></i> VERIFIKASI SEKARANG & MASUK
                                </button>
                            </div>
                        </form>

                        <!-- ═══════ Kirim Ulang OTP ═══════ -->
                        <div id="resend-otp-section" style="margin-top: 20px; padding-top: 20px; border-top: 1px dashed #e2e8f0;">
                            <div class="text-center">
                                <p style="font-size: 14px; color: #64748b; margin-bottom: 12px;">
                                    Belum menerima kode? Anda dapat mengirim ulang.
                                </p>

                                <!-- Tombol Kirim Ulang (tanpa disabled di HTML, dikontrol oleh JS) -->
                                <button type="button" id="btn-resend-otp" class="btn-resend-otp" style="padding: 10px 24px; font-size: 14px; font-weight: 600; border-radius: 8px; background: #e2e8f0; color: #94a3b8; border: 2px solid #e2e8f0; cursor: not-allowed; transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-redo-alt" id="resend-icon"></i>
                                    <span id="resend-text">Kirim Ulang OTP (<span id="countdown">30</span>s)</span>
                                </button>

                                <!-- Info sisa kesempatan -->
                                <div id="resend-info" style="margin-top: 10px;">
                                    <small style="color: #64748b;">
                                        <i class="fas fa-info-circle"></i>
                                        Sisa kesempatan kirim ulang: <strong id="sisa-kesempatan">3</strong>x
                                    </small>
                                </div>

                                <!-- Alert resend result -->
                                <div id="resend-alert" style="display: none; margin-top: 12px; padding: 10px 16px; border-radius: 8px; font-size: 13px;"></div>
                            </div>
                        </div>

                        <!-- ═══════ Batalkan Pendaftaran ═══════ -->
                        <div style="margin-top: 20px; padding-top: 20px; border-top: 1px dashed #e2e8f0;">
                            <div class="text-center">
                                <button type="button" id="btn-cancel-register" style="padding: 10px 24px; font-size: 14px; font-weight: 600; border-radius: 8px; background: #ffffff; color: #dc2626; border: 2px solid #fecaca; cursor: pointer; transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-arrow-left"></i>
                                    <span>Batalkan Pendaftaran</span>
                                </button>
                                <div style="margin-top: 8px;">
                                    <small style="color: #94a3b8;"><i class="fas fa-exclamation-triangle" style="margin-right: 3px;"></i> Data pendaftaran Anda akan dihapus secara permanen.</small>
                                </div>
                            </div>
                        </div>

                    @else
                        <div class="alert alert-danger text-center" style="border-radius: 10px; padding: 20px;">
                            <i class="fa fa-exclamation-triangle fa-2x mb-3"></i>
                            <h4 style="font-weight: 700; margin-bottom: 10px;">Data Pemohon Tidak Ditemukan!</h4>
                            <p style="margin-bottom: 15px;">Akun pemohon tidak ditemukan atau link verifikasi tidak valid.</p>
                            <a href="{{ route('login') }}" class="btn btn-primary" style="border-radius: 6px; padding: 8px 20px;">Kembali ke Halaman Daftar</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .modern-input:focus {
        border-color: #2563eb !important;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15) !important;
        outline: none;
    }
    .btn-modern-primary:hover {
        background: linear-gradient(135deg, #1e3a8a, #1d4ed8) !important;
        box-shadow: 0 6px 15px rgba(37, 99, 235, 0.3) !important;
        transform: translateY(-1px);
    }
    .btn-resend-otp.active {
        background: #ffffff !important;
        color: #2563eb !important;
        border-color: #2563eb !important;
        cursor: pointer !important;
    }
    .btn-resend-otp.active:hover {
        background: #eff6ff !important;
        transform: translateY(-1px);
        box-shadow: 0 3px 10px rgba(37, 99, 235, 0.15);
    }
    .btn-resend-otp.loading {
        background: #f1f5f9 !important;
        color: #64748b !important;
        border-color: #cbd5e1 !important;
        cursor: wait !important;
    }
    #btn-cancel-register:hover {
        background: #fef2f2 !important;
        border-color: #dc2626 !important;
        transform: translateY(-1px);
        box-shadow: 0 3px 10px rgba(220, 38, 38, 0.15);
    }
    @keyframes spin-resend {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    .fa-spin-custom {
        animation: spin-resend 1s linear infinite;
    }
</style>

@if(isset($pemohon) && $pemohon)
<script type="text/javascript">
    // ─── OTP Resend & Verify - Pure JS + jQuery AJAX ──────────────────
    // Menggunakan pure JS untuk timer agar tidak bergantung pada jQuery ready event
    (function() {
        var resendCount = 0;
        var maxResend = 3;
        var baseCooldown = 30;
        var countdownTimer = null;
        var isResendAllowed = false;

        // ── Fungsi Helper ─────────────────────────────────────────────
        function getEl(id) { return document.getElementById(id); }

        function startCountdown(seconds) {
            var btn = getEl('btn-resend-otp');
            var resendText = getEl('resend-text');
            var countdownEl;
            var remaining = seconds;

            isResendAllowed = false;

            // Disable tombol & styling
            btn.disabled = true;
            btn.className = 'btn-resend-otp';
            btn.style.background = '#e2e8f0';
            btn.style.color = '#94a3b8';
            btn.style.borderColor = '#e2e8f0';
            btn.style.cursor = 'not-allowed';

            var iconEl = getEl('resend-icon');
            if (iconEl) iconEl.className = 'fas fa-redo-alt';

            resendText.innerHTML = 'Kirim Ulang OTP (<span id="countdown">' + remaining + '</span>s)';

            if (countdownTimer) clearInterval(countdownTimer);

            countdownTimer = setInterval(function() {
                remaining--;
                countdownEl = getEl('countdown');
                if (countdownEl) countdownEl.textContent = remaining;

                if (remaining <= 0) {
                    clearInterval(countdownTimer);
                    countdownTimer = null;
                    isResendAllowed = true;

                    // Aktifkan tombol
                    btn.disabled = false;
                    btn.className = 'btn-resend-otp active';
                    btn.style.background = '#ffffff';
                    btn.style.color = '#2563eb';
                    btn.style.borderColor = '#2563eb';
                    btn.style.cursor = 'pointer';
                    resendText.innerHTML = '<i class="fas fa-paper-plane" style="margin-right: 4px;"></i> Kirim Ulang Kode OTP';
                }
            }, 1000);
        }

        function disableResendPermanently() {
            var btn = getEl('btn-resend-otp');
            isResendAllowed = false;
            btn.disabled = true;
            btn.className = 'btn-resend-otp';
            btn.style.background = '#fee2e2';
            btn.style.color = '#dc2626';
            btn.style.borderColor = '#fecaca';
            btn.style.cursor = 'not-allowed';
            getEl('resend-text').innerHTML = '<i class="fas fa-ban" style="margin-right: 4px;"></i> Batas Kirim Ulang Tercapai';
            getEl('resend-info').innerHTML = '<small style="color: #dc2626;"><i class="fas fa-exclamation-circle"></i> Anda telah menggunakan semua kesempatan kirim ulang. Hubungi admin jika butuh bantuan.</small>';
        }

        function showResendAlert(message, type) {
            var alertEl = getEl('resend-alert');
            var bgColor = type === 'success' ? '#ecfdf5' : '#fef2f2';
            var borderColor = type === 'success' ? '#a7f3d0' : '#fecaca';
            var textColor = type === 'success' ? '#065f46' : '#991b1b';
            var icon = type === 'success' ? 'fa-check-circle' : 'fa-times-circle';

            alertEl.style.display = 'block';
            alertEl.style.background = bgColor;
            alertEl.style.border = '1px solid ' + borderColor;
            alertEl.style.color = textColor;
            alertEl.innerHTML = '<i class="fas ' + icon + '" style="margin-right: 4px;"></i> ' + message;

            setTimeout(function() {
                alertEl.style.display = 'none';
            }, 5000);
        }

        function enableResendButton() {
            var btn = getEl('btn-resend-otp');
            isResendAllowed = true;
            btn.disabled = false;
            btn.className = 'btn-resend-otp active';
            btn.style.background = '#ffffff';
            btn.style.color = '#2563eb';
            btn.style.borderColor = '#2563eb';
            btn.style.cursor = 'pointer';
            getEl('resend-text').innerHTML = '<i class="fas fa-paper-plane" style="margin-right: 4px;"></i> Kirim Ulang Kode OTP';
        }

        // ── Inisialisasi Countdown (langsung, tanpa tunggu ready event) ──
        startCountdown(baseCooldown);

        // ── Event: Klik Tombol Resend OTP ──────────────────────────────
        getEl('btn-resend-otp').addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            if (!isResendAllowed || this.disabled) return;

            var btn = this;
            isResendAllowed = false;
            btn.disabled = true;
            btn.className = 'btn-resend-otp loading';
            var iconEl = getEl('resend-icon');
            if (iconEl) iconEl.className = 'fas fa-redo-alt fa-spin-custom';
            getEl('resend-text').innerHTML = 'Mengirim ulang...';

            // jQuery AJAX (jQuery sudah pasti dimuat di head)
            $.ajax({
                url: "{{ url('resend_otp') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: getEl('id').value
                },
                dataType: "JSON",
                global: false,
                success: function(data) {
                    btn.className = 'btn-resend-otp';
                    if (iconEl) iconEl.className = 'fas fa-redo-alt';

                    if (data.status) {
                        resendCount = data.resend_count;
                        getEl('sisa-kesempatan').textContent = data.sisa_kesempatan;
                        showResendAlert(data.msg, 'success');

                        if (data.sisa_kesempatan > 0) {
                            startCountdown(data.next_cooldown);
                        } else {
                            disableResendPermanently();
                        }
                    } else {
                        showResendAlert(data.msg, 'error');
                        if (resendCount < maxResend) {
                            enableResendButton();
                        }
                    }
                },
                error: function() {
                    btn.className = 'btn-resend-otp';
                    if (iconEl) iconEl.className = 'fas fa-redo-alt';
                    showResendAlert('Terjadi kesalahan koneksi. Silakan coba lagi.', 'error');
                    enableResendButton();
                }
            });
        });

        // ── Event: Submit Form Verifikasi OTP ─────────────────────────
        getEl('form-verify').addEventListener('submit', function(e) {
            e.preventDefault();

            var btn = getEl('btn-submit-verify');
            var originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fa fa-spinner fa-spin mr-2"></i> Memeriksa Kode...';
            btn.disabled = true;

            $.ajax({
                url: "{{ url('validasi_kode_unik') }}",
                data: $(this).serialize(),
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    if (data.status) {
                        if (countdownTimer) clearInterval(countdownTimer);

                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                title: 'Verifikasi Berhasil!',
                                text: 'Akun Anda telah terverifikasi. Mengalihkan ke halaman Users (Dashboard Pemohon)...',
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(function() {
                                window.location.href = data.redirect_url || "{{ route('user.dashboard') }}";
                            });
                        } else {
                            alert('Verifikasi Berhasil! Akun Anda telah aktif. Mengalihkan ke Halaman Users (Dashboard)...');
                            window.location.href = data.redirect_url || "{{ route('user.dashboard') }}";
                        }
                    } else {
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                title: 'Verifikasi Gagal',
                                text: data.msg || 'Kode verifikasi yang Anda masukkan tidak cocok!',
                                icon: 'error',
                                confirmButtonColor: '#2563eb'
                            });
                        } else {
                            alert(data.msg || 'Kode verifikasi yang Anda masukkan tidak cocok! Silakan periksa kembali.');
                        }
                    }
                },
                error: function() {
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                    alert('Terjadi kesalahan koneksi ke server saat memvalidasi kode. Silakan coba lagi.');
                }
            });
        });

        // ── Event: Batalkan Pendaftaran ─────────────────────────────
        getEl('btn-cancel-register').addEventListener('click', function(e) {
            e.preventDefault();

            var konfirmasi = confirm('Apakah Anda yakin ingin membatalkan pendaftaran?\n\nData akun Anda akan dihapus secara permanen dan Anda harus mendaftar ulang jika ingin menggunakan layanan ini.');
            if (!konfirmasi) return;

            var btn = this;
            btn.disabled = true;
            btn.innerHTML = '<i class="fa fa-spinner fa-spin" style="margin-right: 6px;"></i> Menghapus...';

            $.ajax({
                url: "{{ url('cancel_registration') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: getEl('id').value
                },
                dataType: "JSON",
                global: false,
                success: function(data) {
                    if (data.status) {
                        if (countdownTimer) clearInterval(countdownTimer);
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                title: 'Pendaftaran Dibatalkan',
                                text: data.msg || 'Data pendaftaran Anda telah dihapus. Anda akan diarahkan ke halaman utama.',
                                icon: 'info',
                                confirmButtonColor: '#2563eb'
                            }).then(function() {
                                window.location.href = "{{ route('login') }}";
                            });
                        } else {
                            alert(data.msg || 'Pendaftaran dibatalkan. Data Anda telah dihapus.');
                            window.location.href = "{{ route('login') }}";
                        }
                    } else {
                        btn.disabled = false;
                        btn.innerHTML = '<i class="fas fa-arrow-left"></i> <span>Batalkan Pendaftaran</span>';
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                title: 'Gagal',
                                text: data.msg || 'Tidak dapat membatalkan pendaftaran.',
                                icon: 'error',
                                confirmButtonColor: '#2563eb'
                            });
                        } else {
                            alert(data.msg || 'Tidak dapat membatalkan pendaftaran.');
                        }
                    }
                },
                error: function() {
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fas fa-arrow-left"></i> <span>Batalkan Pendaftaran</span>';
                    alert('Terjadi kesalahan koneksi. Silakan coba lagi.');
                }
            });
        });

    })();
</script>
@endif
