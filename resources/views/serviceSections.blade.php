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
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap"
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

        /* تخصيص شريط التمرير */
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

        /* ================================================= */
        /* Navbar & Dropdown Styles */
        /* ================================================= */
        .navbar {
            background-color: rgba(255, 255, 255, 0.95); /* زيادة عتامة خفيفة */
            padding: 10px 0;
            backdrop-filter: blur(10px); /* تقليل التمويه قليلاً */
            -webkit-backdrop-filter: blur(10px);
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

        .nav-link:hover::after,
        .nav-link.active::after { /* تفعيل الخط أسفل الرابط النشط */
            width: 100%;
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

        /* ================================================= */
        /* Hero Section (Banner) */
        /* ================================================= */

        .hero {
            position: relative;
            height: 45vh;
            min-height: 300px;
            overflow: hidden; /* لمنع ظهور جزء الصورة المكبرة خارج الحدود */
            margin-top: 70px; /* لترك مساحة كافية للـ Navbar الثابت */
        }

        .hero-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%; /* استخدام 100% بدلاً من 95% ليغطي الـ Hero بالكامل */
            object-fit: cover;
            z-index: 0;
            animation: zoomBg 10s infinite alternate;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.65) 100%);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: #ffffff;
            text-align: center;
            padding: 0 15px;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 20px;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.8);
            animation: float 4s ease-in-out infinite; /* تأثير الطفو البطيء */
        }

        .hero-title span {
            color: var(--gold);
            text-shadow: none;
        }

        @keyframes zoomBg {
            0% { transform: scale(1); }
            100% { transform: scale(1.1); }
        }

        @keyframes float {
            0% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
            100% { transform: translateY(0); }
        }

        /* ================================================= */
        /* Service Sections (section-block) */
        /* ================================================= */
        .service-details-section {
            padding: 60px 0 80px 0;
        }

        .service-details-section h2 {
            display: none;
        }

        .service-content-container {
            padding: 0;
            border-radius: 0;
            box-shadow: none;
            margin-bottom: 0;
        }

        .section-block {
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            margin-bottom: 40px;
            border: none;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            background-color: var(--card-bg);
            position: relative;
            overflow: hidden;
            z-index: 1; /* لضمان ظهور المحتوى فوق شريط الـ ::before */
        }

        .section-block::before {
            content: '';
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 8px;
            background: var(--primary-red);
            transition: width 0.3s ease;
            z-index: -1; /* خلف المحتوى */
        }

        .section-block:hover::before {
            width: 100%;
            opacity: 0.05;
        }

        .section-block:hover {
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
            transform: translateY(-5px);
        }

        .section-block h3 {
            color: var(--dark-text);
            font-weight: 700;
            margin-bottom: 20px;
            position: relative;
        }

        .section-block h3 i {
            color: var(--primary-red);
            margin-left: 10px;
            min-width: 25px; /* لتنظيم محاذاة النص */
        }

        .section-block h3::after {
            content: '';
            position: absolute;
            right: 0;
            bottom: -5px;
            width: 50px;
            height: 3px;
            background-color: var(--primary-red);
            border-radius: 5px;
        }


        .section-block p {
            line-height: 1.8;
            color: var(--dark-text);
            font-size: 1.05rem;
            white-space: pre-wrap;
        }

        .section-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            margin-bottom: 0;
            transition: transform 0.4s ease-in-out;
        }

        .section-block:hover .section-image {
            transform: scale(1.03);
            opacity: 0.95;
        }

        /* نمط في حال عدم وجود أقسام (معتمد على المقترحات) */
        .no-sections {
            text-align: center;
            padding: 50px;
            border: 2px dashed var(--primary-red);
            border-radius: 10px;
            color: var(--primary-red);
            background-color: var(--card-bg);
            transition: all 0.3s;
        }

        .no-sections:hover {
            box-shadow: 0 5px 20px rgba(198, 132, 47, 0.2);
        }

        .no-sections h4 {
            color: var(--primary-red);
            font-weight: 600;
        }

        .no-sections p {
            color: var(--dark-text);
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
            min-width: 180px; /* زيادة العرض قليلاً */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border-radius: 8px;
            z-index: 1000; /* قيمة عالية لضمان الظهور فوق كل شيء */
            top: 100%;
            margin-top: 10px;
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
            font-weight: 500;
            transition: background 0.2s;
        }

        .user-dropdown .menu a:hover,
        .user-dropdown .menu button:hover {
            background: var(--secondary-bg);
            cursor: pointer;
        }

        /* ================================================= */
        /* Media Queries (Responsive) */
        /* ================================================= */

        @media (max-width: 992px) {
            .hero {
                height: 35vh;
                min-height: 250px;
                margin-top: 66px;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            /* في الأجهزة اللوحية (التبديل بين الأعمدة) */
            .section-block .row>div:first-child {
                order: initial !important; /* إلغاء ترتيب الجوال في هذه الشاشة */
            }

            .section-block .row>div:nth-child(2) {
                order: initial !important;
            }

            .section-block::before {
                width: 4px;
            }
        }

        @media (max-width: 768px) {
            .hero {
                height: 30vh;
                min-height: 200px;
            }

            .hero-title {
                font-size: 2rem;
            }

            .service-details-section {
                padding: 40px 0;
            }

            .section-block {
                padding: 20px;
                margin-bottom: 50px; /* زيادة المباعدة بين البلوكات في الجوال */
            }

            /* الجوال: الصورة تظهر أولاً دائماً فوق النص */
            .section-block .row>div {
                order: initial !important;
            }

            .section-image {
                height: 200px; /* تصغير ارتفاع الصورة قليلاً في الجوال */
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>
    {{-- جزء الـ Navbar --}}
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
                    <li class="nav-item"><a class="nav-link active"
                            href="#">{{ $service->name ?? 'تفاصيل الخدمة ' }}</a>
                    </li>
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
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                menu.classList.toggle('show');
            });

            document.addEventListener('click', function() {
                menu.classList.remove('show');
            });
        }
    </script>

    {{-- جزء الـ Hero الجديد (بشكل Banner كامل) --}}
    <div class="hero">
        <img src="{{ asset($service->image ?? 'default-hero.jpg') }}" alt="{{ $service->name ?? 'صورة خلفية الخدمة' }}"
            class="hero-image">

        <div class="hero-overlay"></div>
        <div class="container hero-content d-flex flex-column justify-content-center align-items-center h-100">
            {{-- عنوان الخدمة المركزي --}}
            <h1 class="hero-title" data-aos="fade-down" data-aos-delay="200">
                <i class="fas fa-gem me-2"></i> <span>{{ $service->name ?? 'تفاصيل الخدمة' }}</span>
            </h1>
            {{-- زر العودة للخدمات --}}
            <a href="{{ route('services') }}" class="btn btn-luxury mt-3" data-aos="zoom-in" data-aos-delay="400">
                <i class="fas fa-chevron-right me-1"></i> العودة للخدمات
            </a>
        </div>
    </div>
    {{-- نهاية جزء الـ Hero --}}

    {{-- قسم تفاصيل الخدمة وأقسامها (التعديلات هنا) --}}
    <section class="service-details-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">

                    <div class="service-content-container">

                        {{-- عرض أقسام الخدمة --}}
                        @if($service->sections->isNotEmpty())
                            @php
                                // قائمة أيقونات فخمة للتناوب
                                $icon_classes = ['fa-gem', 'fa-award', 'fa-crown', 'fa-fingerprint', 'fa-scroll', 'fa-leaf'];
                            @endphp
                            @foreach($service->sections as $index => $section)
                                @php
                                    $is_even = ($index + 1) % 2 == 0;
                                    // اختيار أيقونة بناءً على الفهرس
                                    $icon_class = $icon_classes[$index % count($icon_classes)];

                                    $content_cols = 'col-md-9';
                                    $image_cols = 'col-md-3';
                                    // التبديل في الترتيب الأفقي (لأجهزة سطح المكتب فقط)
                                    $content_order = $is_even ? 'order-md-1' : 'order-md-2';
                                    $image_order = $is_even ? 'order-md-2' : 'order-md-1';
                                @endphp

                                <div class="section-block" data-aos="fade-up" data-aos-delay="100">
                                    <div class="row align-items-center">

                                        {{-- جزء المحتوى --}}
                                        <div class="{{ $content_cols }} {{ $content_order }}">
                                            {{-- عنوان القسم --}}
                                            <h3><i class="fas {{ $icon_class }}"></i>
                                                {{ $section->title ?? 'قسم بدون عنوان' }}
                                            </h3>
                                            {{-- محتوى القسم --}}
                                            <p>
                                                {!! $section->contant ?? 'لا يوجد محتوى لهذا القسم.' !!}
                                            </p>
                                        </div>

                                        {{-- جزء الصورة --}}
                                        <div class="col-12 col-md-3 {{ $image_order }} text-center">
                                            <img src="{{ asset($section->image ?? 'default-section-image.jpg') }}"
                                                class="section-image" alt="{{ $section->title ?? 'صورة القسم' }}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="no-sections" data-aos="fade-up">
                                <i class="fas fa-info-circle fa-2x mb-3"></i>
                                <h4>لا تتوفر أقسام مفصلة لهذه الخدمة حالياً.</h4>
                                <p>نحن نعمل على إضافة المزيد من المحتوى قريباً، شكراً لتفهمكم.</p>
                            </div>
                        @endif

                    </div>
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