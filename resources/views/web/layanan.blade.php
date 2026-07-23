<section class="prosedur-section" style="padding: 60px 0px; background-color: #f1f5f9;">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-md-12 col-sm-12">
                <div class="prosedur-container">
                    <h2 class="prosedur-title">Prosedur & Alur Pengajuan Informasi Publik</h2>
                    <hr class="prosedur-divider" />
                    
                    <div class="row steps-row">
                        <!-- Step 1 -->
                        <div class="col-md-4 col-sm-12 step-col">
                            <div class="step-card">
                                <div class="step-header">
                                    <div class="step-badge">1</div>
                                    <h3 class="step-name">Pengajuan Keberatan/<br>Permohonan</h3>
                                </div>
                                <ul class="step-list">
                                    <li><i class="fas fa-check-circle"></i> Bertemu PPID PT Garam</li>
                                    <li><i class="fas fa-check-circle"></i> Email ke sekretariat@ptgaram.com</li>
                                    <li><i class="fas fa-check-circle"></i> Hubungi (0328) 662416</li>
                                    <li><i class="fas fa-check-circle"></i> Form online di e-ppid.ptgaram.com</li>
                                </ul>
                            </div>
                        </div>
                        
                        <!-- Step 2 -->
                        <div class="col-md-4 col-sm-12 step-col">
                            <div class="step-card">
                                <div class="step-header">
                                    <div class="step-badge">2</div>
                                    <h3 class="step-name">Melengkapi<br>Formulir</h3>
                                </div>
                                <ul class="step-list">
                                    <li><i class="fas fa-check-circle"></i> Lengkapi formulir di kantor PPID</li>
                                    <li><i class="fas fa-check-circle"></i> Kirim via email</li>
                                    <li><i class="fas fa-check-circle"></i> Aplikasi Website PPID</li>
                                </ul>
                            </div>
                        </div>
                        
                        <!-- Step 3 -->
                        <div class="col-md-4 col-sm-12 step-col">
                            <div class="step-card">
                                <div class="step-header">
                                    <div class="step-badge">3</div>
                                    <h3 class="step-name">Tanda Terima &<br>Tanggapan</h3>
                                </div>
                                <ul class="step-list">
                                    <li><i class="fas fa-check-circle"></i> Penerimaan tanda terima</li>
                                    <li><i class="fas fa-check-circle"></i> Tanggapan atasan PPID (maks 30 hari)</li>
                                    <li><i class="fas fa-check-circle"></i> Pengiriman tanggapan resmi</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="prosedur-footer text-center" style="margin-top: 40px;">
                        <a href="{{ asset('upload/pengajuan.jpg') }}" class="btn-subtle-view fancybox-trigger" title="Infografis Prosedur Pengajuan">
                            <i class="fas fa-eye"></i> Lihat Infografis Resmi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        // Inisialisasi Fancybox untuk pratinjau gambar dengan aman
        if($.fn.fancybox){
            $('.fancybox-trigger').fancybox({
                openEffect  : 'elastic',
                closeEffect : 'elastic',
                helpers : {
                    title : {
                        type : 'inside'
                    }
                }
            });
        }
    });
</script>

<style>
    .prosedur-container {
        background: #ffffff;
        border-radius: 16px;
        padding: 50px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.06);
    }
    .prosedur-title {
        font-size: 32px;
        font-weight: 800;
        color: #0f172a;
        text-align: center;
        margin-bottom: 20px;
    }
    .prosedur-divider {
        width: 80px;
        height: 5px;
        background: #2563eb;
        border: none;
        margin: 0 auto 50px;
        border-radius: 3px;
    }
    .steps-row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -15px;
    }
    .step-col {
        display: flex;
        margin-bottom: 20px;
    }
    .step-card {
        background: #F8F9FA;
        border-radius: 12px;
        padding: 30px;
        border: 1px solid #e2e8f0;
        width: 100%;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        display: flex;
        flex-direction: column;
    }
    .step-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.08);
        border-color: #cbd5e1;
        background: #ffffff;
    }
    .step-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 25px;
        border-bottom: 2px dashed #cbd5e1;
        padding-bottom: 15px;
    }
    .step-badge {
        flex-shrink: 0;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: linear-gradient(135deg, #1e3a8a, #2563eb);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: 700;
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3);
    }
    .step-name {
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
        line-height: 1.3;
    }
    .step-list {
        list-style: none;
        padding: 0;
        margin: 0;
        flex-grow: 1;
    }
    .step-list li {
        position: relative;
        padding-left: 28px;
        margin-bottom: 12px;
        font-size: 15px;
        color: #475569;
        font-weight: 500;
        line-height: 1.5;
    }
    .step-list li:last-child {
        margin-bottom: 0;
    }
    .step-list li i {
        position: absolute;
        left: 0;
        top: 3px;
        color: #10b981;
        font-size: 16px;
    }
    
    .btn-subtle-view {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background-color: #f8fafc;
        color: #475569;
        border: 1px solid #cbd5e1;
        padding: 10px 24px;
        border-radius: 30px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .btn-subtle-view:hover {
        background-color: #f1f5f9;
        color: #1e293b;
        border-color: #94a3b8;
        text-decoration: none;
    }
    
    @media (max-width: 991px) {
        .step-col {
            margin-bottom: 30px;
        }
        .step-col:last-child {
            margin-bottom: 0;
        }
    }
    @media (max-width: 768px) {
        .prosedur-container {
            padding: 30px 20px;
        }
        .prosedur-title {
            font-size: 24px;
        }
    }
</style>


