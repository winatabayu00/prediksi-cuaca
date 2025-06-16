@extends('layouts.app-landing')

@push('css')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #e8f5e8 0%, #f0f8f0 100%);
            color: #333;
            line-height: 1.6;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #4CAF50 0%, #81C784 50%, #C8E6C9 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><circle cx="150" cy="150" r="3" fill="rgba(255,255,255,0.3)"/><circle cx="850" cy="200" r="2" fill="rgba(255,255,255,0.4)"/><circle cx="200" cy="800" r="2.5" fill="rgba(255,255,255,0.2)"/><circle cx="750" cy="750" r="4" fill="rgba(255,255,255,0.3)"/></svg>');
            animation: twinkle 4s infinite ease-in-out;
        }

        @keyframes twinkle {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 2rem;
            position: relative;
            z-index: 2;
        }

        .hero-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .hero-text h1 {
            font-size: 3.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
            animation: slideInLeft 1s ease-out;
        }

        .hero-text .subtitle {
            font-size: 1.4rem;
            color: rgba(255,255,255,0.95);
            margin-bottom: 2rem;
            font-weight: 500;
            animation: slideInLeft 1s ease-out 0.2s both;
        }

        .hero-text p {
            font-size: 1.1rem;
            color: rgba(255,255,255,0.85);
            margin-bottom: 2.5rem;
            animation: slideInLeft 1s ease-out 0.4s both;
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            animation: slideInLeft 1s ease-out 0.6s both;
        }

        /* Enhanced Button Styles - Matching first document */
        .btn {
            padding: 0.75rem 2rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            min-width: 120px;
            justify-content: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4CAF50, #66BB6A);
            color: white;
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(76, 175, 80, 0.4);
            color: white;
        }

        .btn-secondary {
            background: rgba(255,255,255,0.2);
            color: white;
            border: 2px solid rgba(255,255,255,0.4);
            backdrop-filter: blur(10px);
        }

        .btn-secondary:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-2px);
            color: white;
        }

        .btn-info {
            background: linear-gradient(135deg, #2196F3, #42A5F5);
            color: white;
            box-shadow: 0 4px 15px rgba(33, 150, 243, 0.3);
        }

        .btn-info:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(33, 150, 243, 0.4);
            color: white;
        }

        .hero-visual {
            animation: slideInRight 1s ease-out;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .weather-preview {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(20px);
            border-radius: 16px;
            padding: 2rem;
            border: 1px solid rgba(255,255,255,0.3);
            text-align: center;
            color: white;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .weather-preview h3 {
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .weather-status {
            font-size: 1.8rem;
            font-weight: bold;
            margin: 1rem 0;
            padding: 1rem;
            background: rgba(76, 175, 80, 0.3);
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.2);
        }

        .weather-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .detail-item {
            padding: 0.8rem;
            background: rgba(255,255,255,0.1);
            border-radius: 8px;
            font-size: 0.9rem;
        }

        .detail-item strong {
            display: block;
            font-size: 1.1rem;
            margin-top: 0.3rem;
        }

        /* Enhanced Card Styles - Matching first document */
        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            overflow: hidden;
            transition: all 0.3s ease;
            border: none;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            background: linear-gradient(135deg, #4CAF50, #66BB6A);
            color: white;
            padding: 1.5rem 2rem;
            border-bottom: none;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: white;
        }

        .card-body {
            padding: 2rem;
        }

        /* Main Features */
        .features {
            padding: 5rem 0;
            background: linear-gradient(135deg, #e8f5e8 0%, #f0f8f0 100%);
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            color: #2E7D32;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            text-align: center;
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 3rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border-left: 4px solid #4CAF50;
            border: none;
        }

        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .feature-card h3 {
            font-size: 1.4rem;
            color: #2E7D32;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .feature-card p {
            color: #666;
            line-height: 1.6;
        }

        /* How It Works */
        .how-it-works {
            padding: 5rem 0;
            background: white;
        }

        .steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .step {
            text-align: center;
            position: relative;
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border-left: 4px solid #4CAF50;
        }

        .step:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .step-number {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #4CAF50, #66BB6A);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
            margin: 0 auto 1rem;
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
        }

        .step h3 {
            color: #2E7D32;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .step p {
            color: #666;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, #2E7D32, #4CAF50);
            padding: 4rem 0;
            text-align: center;
            color: white;
        }

        .cta-section h2 {
            font-size: 2.2rem;
            margin-bottom: 1rem;
        }

        .cta-section p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        /* Footer */
        .footer {
            background: #1B5E20;
            color: white;
            padding: 2rem 0;
            text-align: center;
        }

        .footer p {
            opacity: 0.8;
        }

        /* Animation */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-content {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 2rem;
            }

            .hero-text h1 {
                font-size: 2.5rem;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                max-width: 300px;
            }

            .container {
                padding: 0 1rem;
            }

            .weather-details {
                grid-template-columns: 1fr;
            }

            .steps {
                grid-template-columns: 1fr;
            }

            .card-body {
                padding: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .hero-text h1 {
                font-size: 2rem;
            }

            .section-title {
                font-size: 2rem;
            }
        }
    </style>
@endpush

@section('app-content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>{{ env('APP_NAME') }}</h1>
                    <div class="subtitle">Kapan Waktu Terbaik Menanam Melon?</div>
                    <p>Dapatkan prediksi cuaca akurat untuk menentukan waktu tanam melon yang optimal. Cukup cek cuaca, lalu tentukan kapan harus menanam!</p>
                    <div class="cta-buttons">
                        <a href="{{ route('prediksi') }}" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                            Cek Cuaca Sekarang
                        </a>
                    </div>
                </div>
                <div class="hero-visual">
                    <div class="weather-preview fade-in">
                        <h3>
                            <i class="fas fa-seedling"></i>
                            Siap Menentukan Waktu Tanam Melon?
                        </h3>
                        <div class="weather-status">
                            Mulai gunakan {{ env('APP_NAME') }} sekarang dan dapatkan rekomendasi waktu tanam yang tepat
                        </div>
                        <a href="{{ route('penjadwalan') }}" class="btn btn-secondary">
                            <i class="fas fa-rocket"></i>
                            Mulai Sekarang
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <h2 class="section-title">Kenapa Pilih {{ env('APP_NAME') }}?</h2>
            <p class="section-subtitle">Platform sederhana untuk mengetahui waktu terbaik menanam melon berdasarkan kondisi cuaca</p>
            <div class="features-grid">
                <div class="feature-card fade-in">
                    <div class="feature-icon">🎯</div>
                    <h3>Prediksi Akurat</h3>
                    <p>Data cuaca real-time dan prediksi 7 hari ke depan untuk menentukan waktu tanam yang tepat</p>
                </div>
                <div class="feature-card fade-in">
                    <div class="feature-icon">⚡</div>
                    <h3>Cepat & Mudah</h3>
                    <p>Cukup masukkan lokasi Anda, langsung dapat rekomendasi kapan waktu terbaik untuk menanam</p>
                </div>
                <div class="feature-card fade-in">
                    <div class="feature-icon">📍</div>
                    <h3>Lokasi Spesifik</h3>
                    <p>Prediksi cuaca berdasarkan lokasi kebun atau lahan Anda dengan akurasi tinggi</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="how-it-works">
        <div class="container">
            <h2 class="section-title">Cara Menggunakan</h2>
            <p class="section-subtitle">Tiga langkah mudah untuk mengetahui waktu tanam melon yang optimal</p>
            <div class="steps">
                <div class="step fade-in">
                    <div class="step-number">1</div>
                    <h3>Masukkan Lokasi</h3>
                    <p>Tentukan lokasi kebun atau lahan tempat Anda akan menanam melon</p>
                </div>
                <div class="step fade-in">
                    <div class="step-number">2</div>
                    <h3>Lihat Prediksi Cuaca</h3>
                    <p>Sistem akan menampilkan kondisi cuaca saat ini dan prediksi beberapa hari ke depan</p>
                </div>
                <div class="step fade-in">
                    <div class="step-number">3</div>
                    <h3>Dapatkan Rekomendasi</h3>
                    <p>Terima rekomendasi kapan waktu terbaik untuk menanam melon berdasarkan cuaca</p>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('js')
    <script>
        // Simple scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Animate cards on scroll
        document.querySelectorAll('.feature-card, .step').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.6s ease';
            observer.observe(card);
        });

        // Weather status animation
        const weatherStatus = document.querySelector('.weather-status');
        if (weatherStatus) {
            setInterval(() => {
                weatherStatus.style.transform = 'scale(1.02)';
                setTimeout(() => {
                    weatherStatus.style.transform = 'scale(1)';
                }, 200);
            }, 3000);
        }

        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add smooth scrolling to results if they exist
        document.addEventListener('DOMContentLoaded', function() {
            const resultsSection = document.querySelector('.card.fade-in:last-child');
            if (resultsSection && window.location.search) {
                setTimeout(() => {
                    resultsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }, 500);
            }
        });
    </script>
@endpush
