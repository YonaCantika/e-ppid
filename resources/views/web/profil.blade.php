<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    .profile-page-section {
        background-color: #f8f9fa; /* Sangat muda */
        padding: 60px 0 80px 0;
        font-family: 'Inter', sans-serif;
        color: #334155;
    }

    .profile-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .section-title {
        text-align: center;
        color: #003366; /* Navy Korporat */
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 40px;
        position: relative;
        padding-bottom: 15px;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 4px;
        background-color: #003366;
        border-radius: 2px;
    }

    .intro-text {
        font-size: 18px;
        line-height: 1.8;
        text-align: justify;
        margin-bottom: 60px;
        background: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
    }

    .intro-text p {
        margin-bottom: 20px;
    }

    .visimisi-container {
        display: flex;
        gap: 30px;
        margin-bottom: 60px;
    }

    .visimisi-card {
        flex: 1;
        background-color: #ffffff;
        border-radius: 12px;
        padding: 40px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.04);
        border-top: 5px solid #003366;
        transition: transform 0.3s ease;
    }

    .visimisi-card:hover {
        transform: translateY(-5px);
    }

    .visimisi-card h3 {
        color: #003366;
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .visimisi-card h3 i {
        color: #0ea5e9;
    }

    .visimisi-card p {
        font-size: 16px;
        line-height: 1.8;
        margin-bottom: 0;
    }

    .visimisi-card ul {
        padding-left: 20px;
        margin-top: 15px;
    }

    .visimisi-card ul li {
        font-size: 16px;
        line-height: 1.8;
        margin-bottom: 10px;
    }

    .contact-info-card {
        background: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
    }

    .contact-info-card h4 {
        color: #003366;
        font-weight: 700;
        margin-bottom: 20px;
        font-size: 22px;
    }

    .contact-info-card p {
        font-size: 16px;
        line-height: 1.8;
    }

    @media (max-width: 768px) {
        .visimisi-container {
            flex-direction: column;
        }
        .intro-text, .visimisi-card, .contact-info-card {
            padding: 25px;
        }
    }
</style>

<div class="profile-page-section">
    <div class="profile-container">
        
        <h2 class="section-title">PROFIL e-PPID PT GARAM</h2>

        <div class="intro-text">
            <p>
                Portal e-PPID ini merupakan bagian dari layanan informasi publik yang dilaksanakan oleh PT Garam (Persero) sesuai dengan Undang-undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik. PT Garam (Persero) memberikan kesempatan kepada masyarakat untuk mengetahui tentang perusahaan melalui informasi yang kami sediakan maupun melalui permintaan informasi.
            </p>
            <p>
                Dukungan masyarakat sangat kami perlukan dalam pelaksanaan Keterbukaan Informasi Publik di lingkungan PT Garam (Persero). Segala bentuk masukan berkaitan dengan peningkatan layanan dan Keterbukaan Informasi Publik dapat disampaikan kepada PPID Korporat PT Garam (Persero).
            </p>
        </div>

        <h2 class="section-title" style="margin-top: 80px;">VISI & MISI PERUSAHAAN</h2>

        <div class="visimisi-container">
            <!-- Visi Card -->
            <div class="visimisi-card">
                <h3><i class="fas fa-eye"></i> Visi</h3>
                <p>
                    Mewujudkan kedaulatan garam nasional yang memberi nilai tambah bagi stakeholder dan menjadi perusahaan industri garam yang berkualitas dunia.
                </p>
            </div>

            <!-- Misi Card -->
            <div class="visimisi-card">
                <h3><i class="fas fa-bullseye"></i> Misi</h3>
                <ul>
                    <li>Meningkatkan produktivitas dan kualitas produksi garam bahan baku maupun garam olahan.</li>
                    <li>Berkomitmen menjaga pasokan produk secara berkesinambungan.</li>
                    <li>Menjamin kepuasan konsumen dan pemangku kepentingan (stakeholder).</li>
                    <li>Mendukung kemandirian sektor pangan nasional berbasis garam.</li>
                </ul>
            </div>
        </div>

        <div class="contact-info-card">
            <h4>Hubungi PPID PT Garam (Persero)</h4>
            <p>
                <strong>Alamat:</strong> Jl. Raya Kalianget No 93, Sumenep 69471 - Indonesia<br/>
                <strong>Telepon:</strong> (0328) 662416<br/>
                <strong>Email:</strong> sekretariat@ptgaram.com
            </p>
        </div>

    </div>
</div>
