<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    .split-hero-section {
        background-color: #F8F9FA;
        padding: 80px 0;
        font-family: 'Inter', sans-serif;
    }

    .hero-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        display: flex;
        align-items: center;
        gap: 60px;
    }

    .hero-content {
        flex: 1;
        max-width: 550px;
    }

    .hero-content h1 {
        font-size: 42px;
        font-weight: 700;
        color: #003366;
        margin-bottom: 15px;
        line-height: 1.2;
    }

    .hero-content p.subtitle {
        font-size: 20px;
        font-weight: 600;
        color: #0ea5e9; /* Light blue accent */
        margin-bottom: 25px;
    }

    .hero-content p.description {
        font-size: 16px;
        line-height: 1.8;
        color: #475569;
        margin-bottom: 25px;
        text-align: justify;
    }
    
    .hero-content ul {
        list-style: none;
        padding-left: 0;
        margin-bottom: 35px;
    }
    
    .hero-content ul li {
        position: relative;
        padding-left: 30px;
        margin-bottom: 15px;
        font-size: 15px;
        color: #475569;
        line-height: 1.6;
    }
    
    .hero-content ul li::before {
        content: '\2713';
        position: absolute;
        left: 0;
        top: 0;
        color: #0ea5e9;
        font-weight: bold;
        font-size: 16px;
    }
    
    .hero-content ul li a {
        color: #334155;
        text-decoration: none;
        transition: color 0.2s ease;
    }
    
    .hero-content ul li a:hover {
        color: #003366;
        text-decoration: underline;
    }

    .btn-primary-action {
        display: inline-block;
        background-color: #003366;
        color: #ffffff;
        padding: 15px 35px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 8px;
        text-decoration: none;
        transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 51, 102, 0.2);
    }

    .btn-primary-action:hover, .btn-primary-action:focus {
        background-color: #002244;
        color: #ffffff;
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 51, 102, 0.3);
    }
    
    .hero-contact {
        margin-top: 40px;
        font-size: 14px;
        color: #64748b;
        border-top: 1px solid #e2e8f0;
        padding-top: 25px;
        line-height: 1.6;
    }

    .hero-contact strong {
        color: #1e293b;
        font-size: 15px;
    }

    .hero-image-wrapper {
        flex: 1;
        display: flex;
        justify-content: center;
    }

    .maklumat-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08), 0 4px 12px rgba(0, 0, 0, 0.04);
        padding: 25px;
        position: relative;
        overflow: hidden;
        border-top: 8px solid #003366; /* Navy blue accent */
        max-width: 600px;
        width: 100%;
        transition: transform 0.3s ease;
    }

    .maklumat-card:hover {
        transform: translateY(-5px);
    }

    .maklumat-image {
        width: 100%;
        height: auto;
        display: block;
        border-radius: 12px;
    }

    @media (max-width: 991px) {
        .hero-container {
            flex-direction: column;
            gap: 50px;
        }
        .hero-content {
            max-width: 100%;
            text-align: center;
        }
        .hero-content p.description {
            text-align: center;
        }
        .hero-content ul {
            text-align: left;
            display: inline-block;
        }
        .hero-contact {
            text-align: center;
        }
    }
</style>

<section class="split-hero-section">
    <div class="hero-container">
        <div class="hero-content">
            <h1>Keterbukaan Informasi Publik</h1>
            <p class="subtitle">Selamat Datang di Layanan e-PPID</p>
            <p class="description">
                Terima kasih telah mengunjungi layanan e-PPID PT Garam. Layanan ini merupakan sarana online bagi pemohon informasi publik sebagai salah satu wujud pelaksanaan keterbukaan informasi di PT Garam. Informasi yang kami sediakan meliputi:
            </p>
            <ul>
                <li><a href="#">Informasi yang wajib disediakan dan diumumkan secara berkala;</a></li>
                <li><a href="#">Informasi yang wajib disediakan dan diumumkan secara serta-merta;</a></li>
                <li><a href="#">Informasi yang wajib sedia setiap saat;</a></li>
            </ul>
            <a href="{{ url('daftar') }}" class="btn-primary-action">Ajukan Permohonan</a>
            
            <div class="hero-contact">
                <strong>PPID PT Garam</strong><br>
                Jl. Raya Kalianget No 93, Sumenep 69471 - Indonesia<br>
                Telp: (0328) 662416 | Email: sekretariat@ptgaram.com
            </div>
        </div>
        
        <div class="hero-image-wrapper">
            <div class="maklumat-card">
                <img class="maklumat-image" src="{{ asset('upload/26%2007%202021%20PBPIP%20E-PPID%20PT%20GARAM%20%28PERSERO%29%20PUTIH.jpg') }}" alt="Maklumat Pelayanan Informasi Publik PT Garam (Persero)">
            </div>
        </div>
    </div>
</section>
