<!DOCTYPE html>

<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>رويال فيو | {{ $hotel->name ?? 'تفاصيل الفندق' }}</title>
    <link rel="icon" type="image/png" href="{{ asset($data->logo ?? 'default-logo.png') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary-red: #c6842f; /* اللون الأساسي: تم الاحتفاظ به */
            --primary-gradient: linear-gradient(135deg, #c6842f 0%, #c6842f 100%);
            --gold: #D4AF37;
            --light-bg: #f5f5f5; /* لون خلفية أفتح قليلاً لمظهر أكثر احترافية */
            --dark-text: #1a1a1a; /* لون نص أدكن قليلاً لتحسين القراءة */
            --card-bg: #ffffff;
            --text-light: #6c757d;
            --secondary-color: #343a40; /* لون ثانوي للنصوص الفرعية */
        }

        body {
            font-family: "IBM Plex Sans Arabic", sans-serif;
            background-color: var(--light-bg);
            color: var(--dark-text);
            overflow-x: hidden;
            line-height: 1.6;
            padding-top: 80px; /* لترك مساحة للنافبار الثابت */
        }

        /* --- Scrollbar and Selection --- */
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #e9ecef; }
        ::-webkit-scrollbar-thumb { background: var(--primary-red); border-radius: 5px; }
        ::selection { background: var(--primary-red); color: #fff; }

        /* --- Navbar Styles --- */
        .navbar {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 15px 0;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            transition: all 0.4s ease;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            z-index: 1050;
        }

        .navbar-brand { font-weight: 800; color: var(--dark-text) !important; font-size: 1.7rem; letter-spacing: 0.5px; }

        .nav-link {
            color: var(--dark-text) !important;
            font-weight: 500;
            margin: 0 12px;
            padding: 8px 0;
            transition: color 0.3s;
        }

        .nav-link:hover, .nav-link.active { color: var(--primary-red) !important; }

        .nav-link::after {
            content: "";
            display: block;
            width: 0;
            height: 3px;
            background-color: var(--primary-red);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after, .nav-link.active::after { width: 100%; }

        /* --- Luxury Button --- */
        .btn-luxury {
            background: var(--primary-gradient);
            color: #fff;
            border: 1px solid var(--primary-red);
            padding: 10px 30px;
            border-radius: 30px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn-luxury::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0%;
            height: 100%;
            background: var(--light-bg);
            z-index: -1;
            transition: all 0.4s ease;
            transform: skewX(-30deg);
        }

        .btn-luxury:hover::before {
            width: 150%;
            left: -20%;
        }

        .btn-luxury:hover {
            color: var(--primary-red);
            border-color: var(--primary-red);
            box-shadow: 0 4px 15px rgba(198, 132, 47, 0.3);
        }

        /* User Dropdown Custom Styles */
        .user-dropdown { position: relative; display: inline-block; }
        .user-dropdown .menu {
            position: absolute;
            top: 100%;
            right: 0;
            background-color: var(--card-bg);
            border-radius: 8px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            min-width: 150px;
            padding: 10px;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
        .user-dropdown .menu.show { opacity: 1; visibility: visible; transform: translateY(0); }
        .user-dropdown .menu button {
            width: 100%;
            padding: 8px 15px;
            background: none;
            border: none;
            text-align: right;
            color: var(--dark-text);
            font-weight: 500;
            border-radius: 5px;
            transition: background-color 0.2s, color 0.2s;
        }
        .user-dropdown .menu button:hover { background-color: var(--primary-red); color: white; }

        /* --- Footer Styles (محتوى غير مطلوب في هذا التعديل) --- */
        .footer {
            background: #e9ecef;
            padding-top: 80px;
            padding-bottom: 30px;
            border-top: 5px solid var(--primary-red);
            color: var(--dark-text);
        }

        .footer h3, .footer h4 { color: var(--dark-text); font-weight: 700; }

        .social-circle {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: 2px solid var(--primary-red);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--dark-text);
            margin: 0 5px;
            transition: 0.3s;
            text-decoration: none;
        }

        .social-circle:hover {
            background: var(--primary-red);
            color: #fff;
            box-shadow: 0 0 15px var(--primary-red);
        }

        /* --- Hotel Details Custom Styles (Professional Refinement) --- */
        .hotel-details-section {
            padding-top: 50px;
            padding-bottom: 50px;
        }

        /* ******* تعديل الـ Hero Image لتكون مرنة وتظهر على اليسار ******* */
        .hotel-hero {
            position: relative;
            /* ارتفاع مرن ومناسب لعرض متجاور */
            height: 100%; /* اجعل ارتفاعها يملأ الحاوية (مهم لتناسق الأعمدة) */
            min-height: 450px; /* الحد الأدنى للارتفاع */
            max-height: 750px; /* الحد الأقصى للارتفاع */
            
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            /* تم إزالة الهامش العلوي (margin-top: 90px;) من هنا ليتم التعامل معه في الهيكل */
        }
        /* **************************************************** */

        .hotel-image-full {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .hotel-hero:hover .hotel-image-full {
             transform: scale(1.03);
        }

        .hotel-info-overlay {
            position: absolute;
            bottom: 0;
            right: 0;
            left: 0;
            padding: 30px;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.85) 0%, rgba(0, 0, 0, 0) 100%);
            color: white;
            z-index: 5;
        }

        .hotel-info-overlay h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 5px;
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        }

        .hotel-info-overlay .location {
            font-size: 1.1rem;
            margin-bottom: 10px;
        }

        .hotel-info-card {
            background-color: var(--card-bg);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 30px;
            border-top: 5px solid var(--primary-red);
            height: 100%;
            position: relative;
            z-index: 10;
        }

        .feature-box {
            background-color: var(--light-bg);
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            border: 1px solid #dee2e6;
            transition: all 0.3s;
        }

        .feature-box i {
            font-size: 2rem;
            color: var(--primary-red);
            margin-bottom: 10px;
        }

        .feature-box h5 {
            font-weight: 700;
            margin-bottom: 0;
            color: var(--secondary-color);
        }

        .rating .fa-star {
            color: var(--gold);
            font-size: 1.2rem;
        }

        /* Rooms and Prices Section */
        .rooms-prices {
            padding-top: 50px;
            padding-bottom: 50px;
        }

        .section-heading {
            color: var(--primary-red);
            font-weight: 700;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.05);
        }

        .price-card {
            background-color: var(--card-bg);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s, box-shadow 0.3s;
            border: 1px solid #e9ecef;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .price-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .price-card h4 {
            color: var(--primary-red);
            font-weight: 600;
        }

        .price-card .price-tag {
            font-size: 1.5rem;
            font-weight: 700;
            color: #28a745;
        }

        .price-card .availability {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--secondary-color);
            margin-bottom: 15px;
        }

        .price-card .btn-dark {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transition: 0.3s;
            margin-top: auto;
            font-weight: 600;
        }

        .price-card .btn-dark:hover {
            background-color: var(--primary-red);
            border-color: var(--primary-red);
        }

        /* Gallery Section */
        .gallery-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 10px;
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }

        .gallery-img:hover {
            transform: scale(0.98);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important;
            opacity: 0.8;
        }

        /* Lightbox Modal Custom Style */
        .modal-content {
            background-color: rgba(255, 255, 255, 0.1);
            border: none;
        }
        .modal-backdrop.show { opacity: 0.9; background-color: rgba(0, 0, 0, 0.9); }
        .lightbox-img {
            width: 100%;
            max-height: 90vh;
            object-fit: contain;
        }
        .modal-header .btn-close {
            filter: invert(1);
            opacity: 1;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 991.98px) {
            body { padding-top: 70px; } /* تعديل بسيط ليتناسب مع النافبار */

            .navbar-collapse {
                background-color: var(--card-bg);
                padding: 15px;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                margin-top: 10px;
            }
            .nav-link { margin: 5px 0; padding: 10px 15px; }
            .nav-link::after { width: 0 !important; }

            /* ******* تعديل ريسبونسيف للـ Hero Image ******* */
            .hotel-hero {
                height: 45vh; /* تقليل الارتفاع على الشاشات الصغيرة */
                min-height: 300px;
                margin-top: 20px; /* هامش علوي بسيط للفصل بعد النافبار في الجوال */
            }
            /* ********************************************* */

            .hotel-info-overlay h1 { font-size: 2.2rem; }

            .hotel-info-card {
                margin-top: 20px;
                padding: 20px;
                border-top: none;
                border-right: 5px solid var(--primary-red);
            }
        }

        @media (max-width: 767.98px) {
            .hotel-hero { height: 35vh; min-height: 250px; }
            .hotel-info-overlay h1 { font-size: 1.8rem; }
            .gallery-img { height: 180px; }
        }
    </style>

</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                @if($data->logo)
                <img src="{{ asset($data->logo) }}" width="150" alt="{{ $data->name ?? 'Royal View' }}" style="border-radius: 5px;">
                @else
                <i class="fas fa-crown text-primary-red"></i> {{ $data->name ?? 'Royal View' }}
                @endif
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('website') }}">الرئيسية</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('website') }}#about">القصة</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('hotels') }}">الفنادق</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">{{ $hotel->name ?? 'تفاصيل الفندق' }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('website') }}#contact">الموقع وتواصل</a></li>
                </ul>

                @php
                $user = auth()->user() ?? null;
                @endphp
                <div class="user-dropdown">
                    @guest
                    <a href="{{ route('login') }}" class="btn btn-luxury mt-3 mt-lg-0">
                        <i class="fa fa-user-plus me-1"></i> التسجيل الآن
                    </a>
                    @endguest

                    @auth
                    <button id="userBtn" class="btn btn-luxury mt-3 mt-lg-0">
                        <i class="fa fa-user me-1"></i> {{ auth()->user()->name }} ▾
                    </button>

                    <div id="userMenu" class="menu">
                        <form method="get" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"> تسجيل الخروج</button>
                        </form>
                    </div>
                    @endauth
                </div>

            </div>
        </div>
    </nav>
    <script>
        // كود JavaScript الخاص بالـUser Dropdown
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('userBtn');
            const menu = document.getElementById('userMenu');

            if (btn && menu) {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    menu.classList.toggle('show');
                });

                document.addEventListener('click', function() {
                    menu.classList.remove('show');
                });
            }

            // Lightbox functionality
            const galleryImages = document.querySelectorAll('.gallery-img');
            const modalElement = document.getElementById('imageModal');
            // تأكد من تهيئة Modal بعد إضافة Bootstrap JS
            if (modalElement) {
                 const modal = new bootstrap.Modal(modalElement);
                 const modalImage = document.getElementById('modalImage');

                galleryImages.forEach(img => {
                    img.addEventListener('click', () => {
                        modalImage.src = img.src;
                        modal.show();
                    });
                });
            }

        });
    </script>


    {{-- ***************************************************************** --}}
    {{-- ******* تم تعديل ترتيب الأعمدة هنا لعرض الصورة على اليسار ******** --}}
    {{-- ***************************************************************** --}}

    <div class="container hotel-details-section">

        <div class="row g-4 mb-5 pt-5 pt-lg-0">

            {{-- 1. العمود الأيمن (للمعلومات والحجز - يأخذ أولوية الظهور في RTL) --}}
            <div class="col-lg-5 order-lg-1">
                <div class="row g-4 h-100">

                    {{-- بطاقة المعلومات الرئيسية للفندق --}}
                    <div class="col-lg-12" data-aos="fade-right" data-aos-delay="200">
                        <div class="hotel-info-card">
                            <h3 class="fw-bolder mb-4 section-heading"><i class="fa fa-info-circle me-2"></i> نظرة عامة على الفندق</h3>

                            {{-- إضافة عدد الغرف والأسرة الكلي --}}
                            <div class="row g-3 mb-4 text-center">
                                <div class="col-6">
                                    <div class="feature-box">
                                        <i class="fa fa-hotel"></i>
                                        <h5 class="mb-1">{{ $hotel->rooms ?? 'N/A' }}</h5>
                                        <p class="text-muted mb-0">عدد الغرف الإجمالي</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="feature-box">
                                        <i class="fa fa-bed"></i>
                                        <h5 class="mb-1">{{ $hotel->beds ?? 'N/A' }}</h5>
                                        <p class="text-muted mb-0">عدد الأسرة الكلي</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- بطاقة الحجز والموقع --}}
                    <div class="col-lg-12" data-aos="fade-right" data-aos-delay="300">
                        <div class="hotel-info-card d-flex flex-column justify-content-center">
                            <h4 class="fw-bold mb-4 text-center section-heading">ابدأ إقامتك الفاخرة</h4>

                            {{-- زر الحجز الآن --}}
                            <a href="#" class="btn btn-luxury btn-lg mb-3 w-100">
                                <i class="fa fa-calendar-check me-2"></i> احجز إقامتك الآن
                            </a>

                            {{-- زر الموقع على الخريطة --}}
                            <a href="{{ $hotel->location }}" target="_blank" class="btn btn-outline-dark w-100" style="border-radius: 30px;">
                                <i class="fa fa-location-dot me-2"></i> عرض الموقع على الخريطة
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            {{-- 2. العمود الأيسر (صورة البطل - يظهر ثانياً في RTL) --}}
            <div class="col-lg-7 order-lg-2" data-aos="zoom-in" data-aos-delay="100">
                <div class="hotel-hero m-lg-0">
                    <img src="{{ asset($hotel->image) }}" class="hotel-image-full" alt="{{ $hotel->name }}">
                    <div class="hotel-info-overlay">
                        <h1 class="text-white">{{ $hotel->name }}</h1>
                        <p class="location text-light"><i class="fa fa-map-marker-alt me-2"></i> {{ $hotel->address }}</p>
                        <p class="rating mb-3">
                            @for($i=1; $i <= 5; $i++)
                                @if($i <= $hotel->rate)
                                    <i class="fa fa-star"></i>
                                     @endif
                            @endfor
                        </p>
                    </div>
                </div>
            </div>

        </div>


        <hr class="my-5">

        {{-- أسعار الغرف المتاحة --}}
        <div class="rooms-prices">
            <h2 class="fw-bold mb-5 text-center section-heading" data-aos="fade-up"><i class="fa fa-door-open me-2"></i> الغرف والأسعار المتاحة</h2>

            <div class="row g-4">
                @for($i=1; $i<=5; $i++)
                    @php
                        // بيانات وهمية للاختبار
                        $priceItem = $hotel->prices->where('name', $i)->first() ?? null;
                        $price = $priceItem->price ?? ($i * 500);
                        $roomAvailable = $priceItem->roomAvailable ?? (10 - $i);
                        $roomName = $i == 1 ? 'جناح ملكي ' : ($i == 2 ? 'غرفة مزدوجة ' : 'غرفة عائلية ' . $i . ' أسرّة');
                    @endphp

                    @if($roomAvailable > 0) {{-- عرض الغرف المتاحة فقط --}}
                    <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="{{ $i * 100 }}">
                        <div class="price-card">
                            <h4 class="mb-3">{{ $roomName }}</h4>

                            <p class="text-secondary flex-grow-1">
                                <i class="fa fa-tag me-1 text-success"></i> السعر لليلة الواحدة:
                                <br>
                                <span class="price-tag">{{ number_format($price, 0) }} ريال</span>
                            </p>

                            <p class="availability">
                                <i class="fa fa-door-open me-1 text-primary-red"></i> الغرف المتاحة:
                                <span class="fw-bold fs-5">{{ $roomAvailable }}</span>
                            </p>



                        </div>
                    </div>
                    @endif
                @endfor
            </div>
        </div>


        <hr class="my-5">

        {{-- معرض الصور --}}
        <h2 class="fw-bold mb-5 text-center section-heading" data-aos="fade-up"><i class="fa fa-images me-2"></i>   صور الفندق </h2>


        <div class="row g-3">
            @foreach($hotel->files as $file)
                <div class="col-lg-3 col-md-4 col-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    <img src="{{ asset($file->image) }}" class="gallery-img shadow-sm" alt="صورة رقم {{ $loop->iteration }}" data-bs-toggle="modal" data-bs-target="#imageModal">
                </div>
            @endforeach
        </div>

    </div>

    {{-- Lightbox Modal --}}
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header border-0">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center p-0">
            <img src="" id="modalImage" class="lightbox-img" alt="صورة مكبرة">
          </div>
        </div>
      </div>
    </div>
    {{-- نهاية Lightbox Modal --}}


    {{-- تضمين ملفات Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
        });
    </script>

    {{-- تم تضمين الفوتر في ملف خارجي، نحافظ على الأمر كما هو --}}
    @include('footer')

</body>

</html>