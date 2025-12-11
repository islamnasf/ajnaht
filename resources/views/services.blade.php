<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    {{-- $data متغير شامل يُمثل إعدادات الموقع --}}
    <link rel="icon" type="image/png" href="{{ asset($data->logo) }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $data->name ?? 'رويال فيو' }} | خدماتنا المميزة</title>

    {{-- تضمين ملفات Bootstrap و الخطوط --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">


    <style>
        :root {
            --primary-red: #c6842f;
            --primary-gradient: linear-gradient(135deg, #c6842f 0%, #c6842f 100%);
            --gold: #D4AF37;
            --light-bg: #f8f8f8;
            --dark-text: #2c3e50;
            --card-bg: #ffffff;
            --text-light: #7f8c8d;
            --section-padding: 80px 0;
        }

        body {
            font-family: "IBM Plex Sans Arabic", sans-serif;
            background-color: var(--light-bg);
            color: var(--dark-text);
            overflow-x: hidden;
        }

        /* تخصيص شريط التمرير (بقي كما هو) */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #e9ecef;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-red);
            border-radius: 5px;
        }

        ::selection {
            background: var(--primary-red);
            color: #fff;
        }

        .navbar {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 10px 0;
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            transition: all 0.4s ease;
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .navbar-brand {
            font-weight: 900;
            color: var(--dark-text) !important;
            font-size: 1.8rem;
            letter-spacing: 1px;
            text-shadow: none;
        }

        .nav-link {
            color: var(--dark-text) !important;
            font-weight: 500;
            margin: 0 10px;
            position: relative;
            transition: 0.3s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary-red) !important;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            right: 0;
            background-color: var(--primary-red);
            transition: width 0.3s;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Dropdown Styles */
        .navbar-nav .dropdown-menu {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            background-color: var(--card-bg);
            padding: 0;
        }

        .navbar-nav .dropdown-item {
            color: var(--dark-text);
            padding: 10px 0px;
            transition: background-color 0.2s, color 0.2s;
            font-weight: 500;
        }

        .navbar-nav .dropdown-item:hover,
        .navbar-nav .dropdown-item:active {
            background-color: var(--primary-red);
            color: white;
        }

        .btn-luxury {
            background: var(--primary-gradient);
            color: #fff;
            border: 1px solid var(--primary-red);
            padding: 10px 30px;
            border-radius: 30px;
            font-weight: 700;
            letter-spacing: 1px;
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
            transform: skewX(45deg);
        }

        .btn-luxury:hover::before {
            width: 150%;
            left: -20%;
        }

        .btn-luxury:hover {
            color: var(--primary-red);
            border-color: var(--primary-red);
        }

        .hero {
            position: relative;
            height: 35vh;
            min-height: 250px;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('{{ asset($data->imageHeader ?? 'default-hero.jpg') }}') center/cover no-repeat;
            z-index: -1;
            animation: zoomBg 10s infinite alternate;
        }

        @keyframes zoomBg {
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(1.1);
            }
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(255, 255, 255, 0.1), rgba(0, 0, 0, 0.3));
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: #ffffff;
            font-size: 1.3rem;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 500;
            line-height: 1.1;
            text-transform: uppercase;
        }

        .hero-title span {
            color: transparent;
            -webkit-text-stroke: 1.5px #ffffffe0;
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .services-section {
            padding: var(--section-padding);
        }

        /* تعديلات البطاقة لجعلها عمودية ومربعة */
        .service-item {
            display: block; /* لم تعد مرنة (Flex) */
            background-color: var(--card-bg);
            border-radius: 35px; /* شكل دائري/مربع أكثر وضوحاً */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
            margin-bottom: 30px;
            min-height: 0; /* لإلغاء الارتفاع الأدنى الأفقي */
            text-align: center; /* لمركزة المحتوى */
        }

        .service-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            border-color: var(--primary-red);
        }

        /* حاوية الصورة أصبحت تأخذ العرض بالكامل وارتفاع ثابت */
        .service-item .service-image-container {
            width: 100%;
            height: 300px; /* ارتفاع ثابت نسبيًا للحفاظ على الشكل المربع */
            position: relative;
            overflow: hidden;
            flex-shrink: 0;
        }

        .service-item .service-image {
            height: 100%;
            width: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            filter: brightness(0.95);
        }

        .service-item:hover .service-image {
            transform: scale(1.08);
            filter: brightness(1);
        }
        
        /* تعديلات حدود الصورة لتبدو مستديرة قليلاً في الأعلى */
        .service-item .service-image {
            border-radius: 15px 15px 0 0; 
        }

        /* محتوى الخدمة */
        .service-item .service-content {
            padding: 15px 20px;
            color: var(--dark-text);
            text-align: center; /* تعديل ليصبح المحتوى مركزًا */
            display: block;
        }

        .service-item .service-content .service-name {
            font-size: 1.3rem; /* حجم أصغر يناسب البطاقة الأصغر */
            font-weight: 700;
            color: var(--dark-text);
            margin-bottom: 15px;
            padding-bottom: 0; /* إزالة البادينج السفلي */
            position: static; /* إزالة الموقع المطلق */
        }

        /* إزالة خط التمييز تحت العنوان في التصميم الجديد */
        .service-item .service-content .service-name::after {
            content: none;
        }

        /* تم إزالة p.text-secondary لأنه غير مطلوب في التصميم الجديد القصير */
        /* .service-item .service-content p.text-secondary { display: none; } */

        .service-details {
            display: none; /* إزالة التفاصيل الإضافية */
        }

        .btn-luxury {
            padding: 8px 20px; /* تصغير الزر */
            font-size: 0.9rem;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        #load-more-container {
            margin-top: 50px;
        }

        .footer {
            background: #e9ecef;
            padding-top: 80px;
            padding-bottom: 30px;
            border-top: 5px solid var(--primary-red);
            color: var(--dark-text);
        }

        .footer h3,
        .footer h4 {
            color: var(--dark-text);
            font-weight: 700;
        }

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

        .user-dropdown {
            position: relative;
            display: inline-block;
        }

        .user-dropdown .menu {
            display: none;
            position: absolute;
            right: 0;
            background: #fff;
            min-width: 150px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border-radius: 8px;
            z-index: 999;
        }

        .user-dropdown .menu.show {
            display: block;
        }

        .user-dropdown .menu a,
        .user-dropdown .menu button {
            display: block;
            width: 100%;
            padding: 10px 15px;
            text-align: right;
            border: none;
            background: transparent;
            text-decoration: none;
            color: #333;
        }

        .user-dropdown .menu a:hover,
        .user-dropdown .menu button:hover {
            background: #f3f3f3;
            cursor: pointer;
        }

        @media (max-width: 992px) {
            .hero {
                height: 45vh;
                min-height: 300px;
                align-items: flex-end;
            }

            .hero-title {
                font-size: 3rem;
            }

            .service-item .service-image-container {
                height: 200px; /* حافظ على ارتفاع مناسب في الشاشات المتوسطة */
            }
        }

        @media (max-width: 768px) {
            .hero {
                height: 30vh;
                min-height: 200px;
            }

            .hero-title {
                font-size: 2.2rem;
            }

            .service-item .service-image-container {
                height: 150px; /* تصغير الارتفاع في الشاشات الصغيرة */
            }
            
            .service-item .service-content .service-name {
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('website') }}">
                @if($data->logo)
                <img src="{{ asset($data->logo) }}" width="190" style="border-radius: 5px;"
                    alt="{{ $data->name ?? 'Royal View' }}">
                @else
                <i class="fas fa-crown text-danger"></i> {{ $data->name ?? 'Royal View' }}
                @endif
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link " href="{{ route('website') }}">الرئيسية</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('website') }}#about">القصة</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('hotels') }}">الفنادق</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{route('services')}}">الخدمات</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('website') }}#contact">الموقع وتواصل</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('blogs') }}" aria-expanded="false">
                            <i class="fas fa-list-alt me-1"></i> مقالات
                        </a>
                    </li>
                </ul>
                @php
                $user = auth()->user();
                @endphp

                <div class="user-dropdown">
                    @guest
                    <a href="{{ route('login') }}" class="btn btn-luxury mt-3 mt-lg-0">
                        التسجيل الآن
                    </a>
                    @endguest

                    @auth
                    <button id="userBtn" class="btn btn-luxury mt-3 mt-lg-0">
                        {{ auth()->user()->name }} ▾
                    </button>

                    <div id="userMenu" class="menu">
                        <form method="GET" action="{{ route('logout') }}">
                            <button type="submit">تسجيل الخروج</button>
                        </form>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    <script>
        const btn = document.getElementById('userBtn');
        const menu = document.getElementById('userMenu');

        if (btn && menu) {
            btn.addEventListener('click', function (e) {
                e.stopPropagation();
                menu.classList.toggle('show');
            });

            document.addEventListener('click', function () {
                menu.classList.remove('show');
            });
        }
    </script>
    <div class="hero">
        <div class="hero-bg" style="background-image: url('{{ asset($data->imageHeader ?? 'default-hero.jpg') }}');">
        </div>
        <div class="hero-overlay"></div>
        <div class="container hero-content">
            <h1 class="hero-title"> <span class="d-block d-md-inline">خدماتنا</span></h1>
        </div>
    </div>
    <section class="services-section" id="services">
        <div class="container">
            <div class="row g-4 justify-content-center">
                @foreach($services as $service)
                {{-- تم التغيير هنا: أصبح col-lg-3 col-md-4 col-sm-6 لـ 4 أعمدة في الشاشات الكبيرة --}}
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 service-wrapper" data-aos="fade-up" data-aos-delay="100"
                    @if($loop->index >= 6) style="display: none;" @endif
                    data-service-index="{{ $loop->index }}">

                    <div class="service-item">
                        <a href="{{ route('serviceDetails', $service->id)}}" class="d-block service-image-container">
                            @if($service->image)
                            <img src="{{ asset($service->image) }}" class="service-image" alt="{{ $service->name }}">
                            @else
                            <img src="https://source.unsplash.com/600x400/?service,luxury,{{ $loop->index + 1 }}"
                                class="service-image" alt="{{ $service->name }}">
                            @endif
                        </a>
                        <div class="service-content">
                            <div>
                                <h3 class="service-name">{{ $service->name }}</h3>
                            </div>
                            <div class="d-flex justify-content-center mt-2"> {{-- تم التعديل لمركزة الزر --}}
                                <a href="{{ route('serviceDetails', $service->id)}}" class="btn btn-luxury w-auto">
                                    اكتشف الخدمة <i class="fas fa-chevron-left me-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @if(count($services) > 6)
            <div class="text-center mt-5" id="load-more-container">
                <button class="btn btn-luxury" id="load-more-btn">
                    عرض المزيد من الخدمات (<span id="hidden-count">{{ count($services) - 6 }}</span>)
                    <i class="fas fa-chevron-down me-1"></i>
                </button>
            </div>
            @endif
        </div>
    </section>

    @include('footer')

    <script>
        AOS.init({
            duration: 800,
            once: true
        });

        document.addEventListener('DOMContentLoaded', function() {
            const serviceWrappers = document.querySelectorAll('.services-section .service-wrapper');
            const loadMoreBtn = document.getElementById('load-more-btn');
            const loadMoreContainer = document.getElementById('load-more-container');
            const hiddenCountSpan = document.getElementById('hidden-count');
            const visibleLimit = 8; // يفضل زيادة الحد المرئي ليناسب تخطيط 4 أعمدة (مثل 4 أو 8)

            function initializeVisibility() {
                if (serviceWrappers.length > visibleLimit) {
                    if (loadMoreContainer) {
                        loadMoreContainer.style.display = 'block';
                    }
                    for (let i = visibleLimit; i < serviceWrappers.length; i++) {
                        serviceWrappers[i].style.display = 'none';
                    }
                    if (hiddenCountSpan) {
                        hiddenCountSpan.textContent = serviceWrappers.length - visibleLimit;
                    }
                } else if (loadMoreContainer) {
                    loadMoreContainer.style.display = 'none';
                }
            }
            
            // يتم تعديل هذه الدالة لتحميل جميع الخدمات المخفية دفعة واحدة.
            function loadAllHiddenServices() {
                for (let i = visibleLimit; i < serviceWrappers.length; i++) {
                    if (serviceWrappers[i]) {
                        serviceWrappers[i].style.display = 'block';
                    }
                }
                if (loadMoreContainer) {
                    loadMoreContainer.style.display = 'none';
                }
                AOS.refresh();
            }

            initializeVisibility();

            if (loadMoreBtn) {
                loadMoreBtn.addEventListener('click', loadAllHiddenServices);
            }
        });
    </script>
</body>
</html>