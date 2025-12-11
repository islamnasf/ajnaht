<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    {{-- $data متغير شامل يُمثل إعدادات الموقع --}}
    <link rel="icon" type="image/png" href="{{ asset($data->logo) }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- هنا نستخدم اسم الخدمة في عنوان الصفحة --}}
    <title>{{ $data->name ?? 'رويال فيو' }} | {{ $service->name ?? 'تفاصيل الخدمة' }}</title>

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
            --secondary-bg: #eeeeee;
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
            height: 45vh;
            min-height: 350px;
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
            background: url('{{ asset( $data->imageHeader ?? 'default-hero.jpg') }}') center/cover no-repeat;
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
            background: linear-gradient(to right, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.7));
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: #ffffff;
            font-size: 1.3rem;
            text-align: right;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 700;
            line-height: 1.1;
            text-transform: uppercase;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.6);
        }

        .hero-title span {
            color: var(--primary-red);
            -webkit-text-stroke: 0;
            text-shadow: none;
        }
        
        /* تنسيق قسم تفاصيل الخدمة */
        .service-details-section {
            padding: var(--section-padding);
            padding-top: 40px;
        }

        .service-details-section h2 {
            font-weight: 700;
            color: var(--dark-text); /* تم التغيير إلى اللون الداكن ليكون العنوان أكثر وضوحاً */
            margin-bottom: 30px;
            border-right: 5px solid var(--primary-red);
            padding-right: 15px;
        }

        /* تنسيق الحاوية الرئيسية لتفاصيل الخدمة */
        .service-content-container {
            background-color: var(--card-bg);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 50px;
            border-top: 5px solid var(--primary-red);
        }

        .service-main-image {
            width: 100%;
            height: auto;
            max-height: 350px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }


        /* تنسيق أقسام الخدمة (Service Sections) - تحسين العرض */
        .section-block {
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin-bottom: 40px;
            border: 1px solid rgba(0, 0, 0, 0.05); /* إضافة حدود خفيفة */
            transition: all 0.3s ease;
            background-color: var(--card-bg); /* تغيير الخلفية إلى الأبيض لجعلها بارزة داخل الحاوية */
        }
        
        /* تأثير عند التحويم */
        .section-block:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
            transform: translateY(-3px);
        }

        .section-block h3 {
            color: var(--primary-red); /* تغيير لون العنوان للتركيز عليه */
            font-weight: 700;
            margin-bottom: 20px;
            position: relative;
            padding-right: 10px;
        }
        
        .section-block h3 i {
            color: var(--gold);
            margin-left: 10px;
        }

        .section-block h3::after {
            content: '';
            position: absolute;
            right: 0;
            bottom: -5px;
            width: 70px;
            height: 3px;
            background-color: var(--gold);
        }


        .section-block p {
            line-height: 1.8;
            color: var(--dark-text); /* تغيير لون النص ليكون أكثر وضوحاً */
            font-size: 1.05rem;
            white-space: pre-wrap;
        }

        .section-image {
            width: 100%;
            height: 250px; 
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
            transition: transform 0.3s ease;
        }
        
        /* تأثير عند التحويم على الصورة داخل البلوك */
        .section-block:hover .section-image {
            transform: scale(1.02);
        }

        .no-sections {
            text-align: center;
            padding: 50px;
            border: 2px dashed #ccc;
            border-radius: 10px;
            color: var(--text-light);
            background-color: var(--secondary-bg); /* تغيير الخلفية لتمييزها */
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
                height: 35vh;
                min-height: 250px;
                align-items: flex-end;
            }

            .hero-title {
                font-size: 3rem;
            }
            /* تعديل مهم: لجعل الصورة تظهر دائماً فوق المحتوى في شاشات الجوال */
            .section-block .row > div:first-child { 
                order: -1;
            }
        }

        @media (max-width: 768px) {
            .hero {
                height: 30vh;
                min-height: 200px;
            }

            .hero-title {
                font-size: 2.5rem;
            }
            
            .service-details-section {
                padding: 40px 0;
            }

            .service-content-container {
                padding: 20px;
            }

            .section-block {
                padding: 20px;
            }
            
            /* إلغاء ترتيب العناصر في الجوال للحفاظ على الترتيب الطبيعي (صورة ثم نص) */
            .section-block .row > div {
                order: initial !important; 
            }
        }
    </style>
</head>

<body>
    {{-- جزء الـ Navbar (تم نقله بالكامل) --}}
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
                    {{-- تم تفعيل active على رابط الخدمات --}}
                    <li class="nav-item"><a class="nav-link active" href="#">{{ $service->name ?? 'تفاصيل الخدمة ' }}</a>
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
        <div class="hero-bg" >
        </div>
        <div class="hero-overlay"></div>
        <div class="container hero-content">
            {{-- عنوان الخدمة --}}
            <h1 class="hero-title"> <span class="d-block d-md-inline">{{ $service->name ?? 'الخدمة غير متوفرة' }}</span></h1>
            {{-- زر العودة للخدمات --}}
            <a href="{{ route('services') }}" class="btn btn-luxury mt-3">
                <i class="fas fa-chevron-right me-1"></i> العودة للخدمات
            </a>
        </div>
    </div>
    {{-- نهاية جزء الـ Hero --}}

    {{-- قسم تفاصيل الخدمة وأقسامها (التعديلات هنا) --}}
    <section class="service-details-section">
        <div class="container">
            <h2 class="text-right">  <i class="fas fa-magic text-warning me-2"></i> {{ $service->name ?? 'الخدمة' }}</h2>
            
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    
                    {{-- حاوية تفاصيل الخدمة الرئيسية --}}
                    <div class="service-content-container" data-aos="fade-up">
                        
                        {{-- صورة الخدمة الرئيسية --}}
                        <img src="{{ asset($service->image ?? 'default-service.jpg') }}" 
                            class="service-main-image"
                            alt="{{ $service->name ?? 'صورة الخدمة' }}">

                        
                        {{-- عرض أقسام الخدمة --}}
                        @if($service->sections->isNotEmpty())
                            @foreach($service->sections as $index => $section)
                                {{-- يتم التبديل بين ترتيب الصورة والنص لعرض أجمل --}}
                                @php
                                    $is_even = ($index + 1) % 2 == 0;
                                    $content_order = $is_even ? 'order-md-1' : 'order-md-2'; // تبديل الترتيب
                                    $image_order = $is_even ? 'order-md-2' : 'order-md-1'; // تبديل الترتيب
                                    $icon_class = $is_even ? 'fa-check-circle' : 'fa-star';
                                @endphp

                                <div class="section-block" data-aos="fade-up" data-aos-delay="100">
                                    <div class="row align-items-center">
                                        
                                        {{-- جزء المحتوى (الذي سيتم تبديل مكانه) --}}
                                        <div class="col-md-7 {{ $content_order }}">
                                            {{-- عنوان القسم --}}
                                            <h3><i class="fas {{ $icon_class }}"></i> {{ $section->title ?? 'قسم بدون عنوان' }}</h3>
                                            {{-- محتوى القسم --}}
                                            <p>
                                                {!! $section->contant ?? 'لا يوجد محتوى لهذا القسم.' !!}
                                            </p>
                                        </div>

                                        {{-- جزء الصورة (الذي سيتم تبديل مكانه) --}}
                                        <div class="col-md-5 {{ $image_order }}">
                                            <img src="{{ asset($section->image ?? 'default-section-image.jpg') }}" 
                                                class="section-image"
                                                alt="{{ $section->title ?? 'صورة القسم' }}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="no-sections" data-aos="fade-up">
                                <i class="fas fa-info-circle fa-2x mb-3"></i>
                                <h4>لا تتوفر أقسام مفصلة لهذه الخدمة حالياً.</h4>
                                <p>نحن نعمل على إضافة المزيد من المحتوى قريباً.</p>
                            </div>
                        @endif

                    </div>
                    {{-- نهاية حاوية تفاصيل الخدمة الرئيسية --}}

                </div>
            </div>
        </div>
    </section>
    {{-- نهاية قسم تفاصيل الخدمة --}}

    {{-- تضمين الـ Footer --}}
    @include('footer')

    {{-- تضمين ملفات الجافاسكريبت --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });
    </script>
</body>
</html>