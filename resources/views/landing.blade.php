<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $data->name ?? 'رويال فيو' }} | فخامة الإقامة</title>
    <link rel="icon" type="image/png" href="{{ asset($data->logo) }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary-red: #c6842f;
            --primary-gradient: linear-gradient(135deg, #c6842f 0%, #c6842f 100%);
            --gold: #D4AF37;
            --light-bg: #f8f8f8;
            --dark-text: #212529;
            --card-bg: #ffffff;
            --text-light: #495057;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: "IBM Plex Sans Arabic", sans-serif;
            background-color: var(--light-bg);
            color: var(--dark-text);
            overflow-x: hidden;
            padding-top: 40px;
            /* إضافة padding للتعامل مع الشريط الثابت */
        }

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

        /* تحسين الشريط العلوي */
        .top-bar {
            height: 40px;
            background-color: #c6842f;
            color: #ffffff;
            line-height: 40px;
            transition: transform 0.3s ease-in-out;
            z-index: 1040;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            direction: rtl;
            font-size: 0.9rem;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            display: flex !important;
            /* إجبار العرض على جميع الأحجام */
            align-items: center;
        }

        /* تعديل الـ navbar ليكون تحت الشريط العلوي */
        .navbar {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 5px 0;
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            transition: all 0.4s ease;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 50px 50px rgba(0, 0, 0, 0.05);
            position: fixed;
            top: 40px;
            /* تبدأ من بعد الشريط العلوي */
            left: 0;
            right: 0;
            z-index: 1030;
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

        /* Dropdown تحسينات */
        .navbar-nav .dropdown-menu {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            background-color: var(--card-bg);
            padding: 0;
        }

        .navbar-nav .dropdown-item {
            color: var(--dark-text);
            padding: 5px 10px;
            transition: background-color 0.2s, color 0.2s;
            font-weight: 500;
        }

        .navbar-nav .dropdown-item:hover,
        .navbar-nav .dropdown-item:active {
            background-color: var(--primary-red);
            color: white;
        }

        /* أزرار */
        .btn-luxury {
            background: var(--primary-gradient);
            color: #fff;
            border: 1px solid var(--primary-red);
            padding: 10px 30px;
            border-radius: 0;
            font-weight: 700;
            letter-spacing: 1px;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
            border-radius: 30px;
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

        /* Hero Section */
        .hero {
            position: relative;
            height: 60vh;
            min-height: 400px;
            display: flex;
            align-items: center;
            overflow: hidden;
            margin-top: 40px;
            /* تعويض عن ارتفاع الـ navbar */
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
            background: linear-gradient(to right, rgba(255, 255, 255, 0.1), rgba(0, 0, 0, 0.2));
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: #ffffff;
            font-size: 1.3rem;
            padding-bottom: 80px;
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

        /* Search Form */
        .search-form-container {
            position: relative;
            z-index: 10;
            margin-top: -30px;
        }

        .search-glass {
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
            transform: translateY(0);
            transition: transform 0.3s;
            color: var(--dark-text);
        }

        .search-glass h4 {
            color: var(--dark-text);
            font-weight: 700;
        }

        .search-glass:hover {
            transform: translateY(-5px);
            border-color: var(--primary-red);
        }

        .form-control-custom {
            background: rgba(255, 255, 255, 0.8);
            border: none;
            border-bottom: 2px solid var(--primary-red);
            color: var(--dark-text);
            border-radius: 0;
            padding: 15px;
            font-size: 1.05rem;
            width: 100%;
        }

        .form-control-custom:focus {
            background: rgba(255, 255, 255, 1);
            color: var(--dark-text);
            box-shadow: none;
            border-color: var(--gold);
        }

        .form-control-custom::placeholder {
            color: rgba(0, 0, 0, 0.5);
        }

        /* About Section */
        .about-section {
            padding: 100px 0;
            position: relative;
            background-color: var(--light-bg);
        }

        .about-img-box {
            position: relative;
            z-index: 1;
        }

        .about-img-box img {
            border-radius: 20px;
            filter: grayscale(40%);
            transition: 0.5s;
            width: 100%;
            height: auto;
        }

        .about-img-box:hover img {
            filter: grayscale(0%);
        }

        .about-bg-accent {
            position: absolute;
            top: -20px;
            right: -20px;
            width: 100%;
            height: 100%;
            border: 5px solid var(--primary-red);
            border-radius: 20px;
            z-index: -1;
            transition: 0.5s;
        }

        .about-img-box:hover .about-bg-accent {
            top: 20px;
            right: 20px;
        }

        /* Footer */
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

        .footer-map iframe {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            width: 100%;
            height: 300px;
        }

        .footer-map iframe:hover {
            transform: scale(1.01);
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

        .footer .text-muted {
            color: #6c757d !important;
        }

        /* User Dropdown */
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
            top: 100%;
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

        /* Carousel */
        #hotelCarousel .carousel-control-prev,
        #hotelCarousel .carousel-control-next {
            background-color: #ffffff;
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border: #c6842f 2px solid;
            width: 50px;
            height: 50px;
            top: 50%;
            transform: translateY(-50%);
            border-radius: 100%;
            opacity: 1;
            transition: opacity 0.2s ease;
        }

        #hotelCarousel .carousel-control-prev:hover,
        #hotelCarousel .carousel-control-next:hover {
            opacity: .9;
        }

        #hotelCarousel .carousel-control-prev-icon,
        #hotelCarousel .carousel-control-next-icon {
            filter: invert(100%);
        }

        /* Validation */
        .is-invalid {
            border-color: #dc3545 !important;
            box-shadow: 0 0 6px rgba(220, 53, 69, 0.3);
        }

        .error-message {
            color: #dc3545;
            font-size: 12px;
            margin-top: 4px;
            display: none;
        }

        /* =========================================== */
        /* Responsive Enhancements - تحسينات الاستجابة */
        /* =========================================== */

        /* Large devices (992px and up) */
        @media (min-width: 992px) {
            .top-bar .container {
                justify-content: center !important;
            }
        }

        /* Medium devices (tablets, 768px to 991px) */
        @media (max-width: 991px) {
            .hero {
                height: 50vh;
                min-height: 350px;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .search-form-container {
                margin-top: -20px;
            }

            .search-glass {
                padding: 20px;
            }

            .hero-content {
                padding-bottom: 40px;
            }

            .navbar-collapse {
                background-color: rgba(255, 255, 255, 0.98);
                padding: 20px;
                border-radius: 10px;
                margin-top: 10px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }

            .user-dropdown {
                margin-top: 10px;
                display: block;
                text-align: center;
            }
        }

        /* Small devices (phones, 576px to 767px) */
        @media (max-width: 767px) {
            body {
                padding-top: 35px;
                /* تقليل الـ padding للهواتف */
            }

            .top-bar {
                height: 35px;
                line-height: 35px;
                font-size: 0.8rem;
            }

            .navbar {
                top: 35px;
                /* تعديل حسب ارتفاع الشريط العلوي الجديد */
            }

            .hero {
                height: 40vh;
                min-height: 300px;
                margin-top: 35px;
                /* تعديل حسب ارتفاع الـ navbar الجديد */
            }

            .hero-title {
                font-size: 2rem;
            }

            .hero-content {
                padding-bottom: 30px;
            }

            .search-form-container {
                margin-top: -10px;
                padding: 0 15px;
            }

            .search-glass {
                padding: 15px;
                margin: 0;
            }

            .about-section {
                padding: 50px 0;
            }

            .about-bg-accent {
                display: none;
            }

            .navbar-brand img {
                width: 150px !important;
            }

            /* تحسين عرض الفورم على الموبايل */
            .search-glass .d-flex {
                flex-direction: column;
            }

            .search-glass .flex-fill {
                width: 100%;
                margin-bottom: 20px;
            }

            .search-glass .flex-fill:last-child {
                margin-bottom: 0;
            }

            /* تحسين الكاروسيل على الموبايل */
            #hotelCarousel .carousel-control-prev,
            #hotelCarousel .carousel-control-next {
                width: 40px;
                height: 40px;
            }

            .footer-map iframe {
                height: 250px;
            }
        }

        /* Extra small devices (phones, less than 576px) */
        @media (max-width: 575px) {
            body {
                padding-top: 30px;
            }

            .top-bar {
                height: 30px;
                line-height: 30px;
                font-size: 0.75rem;
                justify-content: center;
            }

            .navbar {
                top: 30px;
            }

            .hero {
                height: 35vh;
                min-height: 250px;
                margin-top: 30px;
                /* تعديل حسب ارتفاع الـ navbar الجديد */
            }

            .hero-title {
                font-size: 1.5rem;
            }

            .display-5 {
                font-size: 2rem;
            }

            .btn-luxury {
                padding: 8px 20px;
                font-size: 0.9rem;
            }

            /* إخفاء بعض العناصر على الهواتف الصغيرة */
            .top-bar span.me-3:nth-child(1),
            .top-bar span.me-3:nth-child(3) {
                display: none !important;
            }

            .top-bar .container {
                justify-content: center;
            }

            /* تحسين الـ form controls */
            .form-control-custom {
                padding: 10px;
                font-size: 0.95rem;
            }

            /* تحسين الكروت */
            .card {
                margin-bottom: 15px;
            }

            .card-img-top {
                height: 180px !important;
            }

            /* تحسين الهيدر */
            .navbar-brand {
                font-size: 1.3rem;
            }

            .navbar-brand img {
                width: 175px !important;
            }
        }

        /* تحسينات عامة للاستجابة */
        @media (max-width: 991px) {
            .container {
                padding-left: 15px;
                padding-right: 15px;
            }

            .row {
                margin-left: -10px;
                margin-right: -10px;
            }

            .col-lg-4,
            .col-md-6,
            .col-lg-6,
            .col-lg-12 {
                padding-left: 10px;
                padding-right: 10px;
            }
        }

        /* تحسينات للشاشات الصغيرة جداً */
        @media (max-width: 360px) {
            .hero-title {
                font-size: 1.3rem;
            }

            .hero-content {
                font-size: 1rem;
            }

            .btn-luxury {
                padding: 6px 15px;
                font-size: 0.85rem;
            }

            .navbar-toggler {
                padding: 0.25rem 0.5rem;
                font-size: 0.9rem;
            }
        }

        /* تحسينات للاتجاه RTL على جميع الأجهزة */
        [dir="rtl"] .carousel-control-prev {
            left: auto;
            right: 10px;
        }

        [dir="rtl"] .carousel-control-next {
            right: auto;
            left: 10px;
        }

        /* تحسينات لشاشات اللمس */
        @media (hover: none) and (pointer: coarse) {
            .btn-luxury:hover::before {
                width: 0;
            }

            .nav-link:hover::after {
                width: 0;
            }

            .search-glass:hover {
                transform: none;
            }

            .about-img-box:hover .about-bg-accent {
                top: -20px;
                right: -20px;
            }

            .about-img-box:hover img {
                filter: grayscale(40%);
            }
        }

        /* تحسين الأداء على الموبايل */
        @media (max-width: 767px) {
            .hero-bg {
                animation: none;
                /* إيقاف الأنيميشن على الموبايل لتحسين الأداء */
            }

            .search-glass {
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
            }
        }

        /* إصلاح مشكلة الـ overflow على الموبايل */
        @media (max-width: 767px) {

            html,
            body {
                max-width: 100%;
                overflow-x: hidden;
            }

            .container-fluid {
                padding-left: 0;
                padding-right: 0;
            }

            .container-fluid .container {
                padding-left: 15px;
                padding-right: 15px;
            }
        }
    </style>
</head>

<body>

    <div class="top-bar fixed-top d-md-flex" id="top-bar">
        <div class="container d-flex justify-content-center align-items-center">
            <span class="me-3 d-none d-md-inline">
                <i class="fas fa-phone-alt me-1"></i> {{ $data->phone1 ?? '+966 50 123 4567' }}
            </span>
            <span class="me-3">
                <i class="fas fa-phone-alt me-1"></i> {{ $data->phone2 ?? '+966 50 123 4567' }}
            </span>
            <span class="me-3 d-none d-md-inline">
                <i class="fas fa-envelope me-1"></i> {{ $data->email ?? 'info@royalview.com' }}
            </span>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container connav">
            <a class="navbar-brand" href="{{ route('website') }}">
                @if($data->logo)
                    <img src="{{ asset($data->logo) }}" width="190" style="border-radius: 5px;">
                @else
                    <i class="fas fa-crown text-danger"></i> {{ $data->name ?? 'Royal View' }}
                @endif
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('website') }}">الرئيسية</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">القصة</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('hotels') }}">الفنادق</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('services') }}">الخدمات</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">الموقع وتواصل</a></li>
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

    <section class="hero">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="container hero-content">
            <div class="row align-items-center text-center">
                <div class="col-lg-12 text-center" data-aos="fade-up" data-aos-duration="1000">
                    <!-- <h1 class="hero-title">
                    {{ $data->name ?? 'LUXURY' }} <br>
                    <span>ROMANCE HOTELS</span>
                </h1> -->
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid py-0 search-form-container">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-12 mx-auto" data-aos="fade-up" data-aos-delay="300" data-aos-duration="1000">
                    <div class="search-glass">
                        <div class="d-flex flex-column flex-lg-row gap-4">

                            <!-- فورم الحجز -->
                            <div class="flex-fill p-4 ">
                                <h5 class="mb-4 text-center">خطط لإقامتك القادمة</h5>

                                <form action="{{ route('newReser') }}" method="GET" id="reserveForm" novalidate>
                                    <div class="row gy-3">

                                        <div class="col-lg-3">
                                            <label class="small text-muted mb-1">وجهتك</label>
                                            <select class="form-control form-control-custom" name="destination"
                                                required>
                                                <option value="">اختر الوجهة</option>
                                                <option selected>مكة</option>
                                            </select>
                                            <div class="error-message">هذا الحقل مطلوب</div>
                                        </div>

                                        <div class="col-lg-3">
                                            <label class="small text-muted mb-1">اختر الفندق</label>
                                            <select class="form-control form-control-custom" name="hotel_id" required>
                                                <option value="">اختر الفندق</option>
                                                @foreach($allHotels as $hotel)
                                                    <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="error-message">هذا الحقل مطلوب</div>
                                        </div>

                                        <div class="col-lg-6">
                                            <label class="small text-muted mb-1">اختر الفترة</label>
                                            <input type="text" id="date_range" class="form-control form-control-custom"
                                                placeholder="اختر تاريخ الوصول والمغادرة" required>
                                            <input type="hidden" name="start" id="start_date">
                                            <input type="hidden" name="end" id="end_date">
                                            <div class="error-message">برجاء اختيار الفترة</div>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <button type="submit" class="btn btn-luxury w-100 py-3">احجز الآن</button>
                                        </div>

                                    </div>
                                </form>
                            </div>

                            <!-- فورم البحث -->
                            <div class="flex-fill p-4  ">
                                <h5 class="mb-4 text-center  ">بحث عن حجوزات سابقة</h5>

                                <form action="{{ route('searchOldReser') }}" method="GET" id="searchOldReservations"
                                    novalidate>
                                    <div class="row gy-3  ">

                                        <div class="col-lg-12">
                                            <label class="small text-muted mb-1">رقم الهاتف</label>
                                            <input type="text" name="phone" class="form-control form-control-custom"
                                                placeholder="أدخل رقم الهاتف للبحث" required>
                                            <div class="error-message">يرجى إدخال رقم الهاتف</div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-luxury w-100 py-3">بحث</button>
                                        </div>

                                    </div>
                                </form>
                            </div>

                        </div><!-- /d-flex -->
                    </div>

                </div>
            </div>
        </div>
    </div>

    <section class="about-section" id="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 ps-lg-5" data-aos="fade-left">
                    <!-- <h1 class="text-danger fw-bold text-uppercase mb-2">// من نحن</h1> -->
                    <!-- <h2 class="display-5 fw-bold mb-4" style="color: var(--dark-text);">قصة من <span
                        style="color: var(--primary-red);">الشغف</span>
                    والتميز</h2> -->
                    <div class="text-muted mb-4 lead" style="line-height: 1.8; color: var(--dark-text) !important;">
                        {!! $data->textarea ?? 'تأسس فندق رويال فيو على مبادئ الضيافة الفاخرة والاهتمام بالتفاصيل. نحن نعدك بتجربة لا مثيل لها، حيث كل زاوية مصممة لراحتك المطلقة. منذ الافتتاح، ونحن نسعى لتقديم أعلى معايير الخدمة العالمية، مما جعلنا الخيار الأول للمسافرين المميزين.' !!}
                    </div>

                    <!-- <div class="d-flex align-items-center mt-4">
                    <div class="border-start border-danger border-3 ps-3 ms-3">
                        <h5 class="mb-0 fw-bold" style="color: var(--dark-text);">أفضل موقع</h5>
                        <small class="text-muted">مباشرة أمام الحرم</small>
                    </div>
                    <div class="border-start border-danger border-3 ps-3">
                        <h5 class="mb-0 fw-bold" style="color: var(--dark-text);">واي فاي</h5>
                        <small class="text-muted">عالي السرعة مجاني</small>
                    </div>
                </div> -->
                </div>
                <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                    <div class="about-img-box tilt-element">
                        <div class="about-bg-accent"></div>
                        <img src="{{ asset($data->aboutImage ?? 'default-about.jpg') }}"
                            class="img-fluid w-100 shadow-lg" alt="About Us">
                    </div>
                </div>

            </div>
        </div>
    </section>

    <style>
        .section-title {
            color: var(--dark-text);
            font-size: 2.8rem;
            position: relative;
            padding-bottom: 15px;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            /* background-color: var(--primary-color); */
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        .card {
            border: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            /* background-color: var(--card-bg); */
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
        }

        .hotel-card-img {
            height: 300px !important;
            /* ارتفاع موحد لصور الفنادق */
            border-radius: 30px 30px 0 0 !important;
        }

        .service-card-img {
            height: 150px !important;
            /* ارتفاع موحد لصور الخدمات */
            border-radius: 120px 120px 0 0 !important;
        }

        .card-body {
            padding: 20px;
        }
    </style>

    <section class="hotels-section py-5 bg-light" id="featured-hotels">
        <div class="container">
            <h2 class="section-title fw-bold text-center mb-5">
                ✨ اكتشف فنادقنا المميزة
            </h2>

            <div id="hotelCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                <div class="carousel-inner">
                    {{-- تقسيم الفنادق إلى مجموعات من 4 لعرضها في كل شريحة (item) --}}
                    @php
                        // يُفترض أن متغير $hotels مُعرَّف ومملوء ببيانات الفنادق
                        $chunks = isset($hotels) ? $hotels->chunk(4) : collect([
                            collect([
                                (object) ['name' => 'فندق الفخامة', 'address' => 'مكة المكرمة', 'image' => 'https://source.unsplash.com/400x300/?luxury,hotel'],
                                (object) ['name' => 'فندق القمة', 'address' => 'الرياض', 'image' => 'https://source.unsplash.com/400x300/?hotel,view'],
                                (object) ['name' => 'فندق الهدوء', 'address' => 'جدة', 'image' => 'https://source.unsplash.com/400x300/?resort,pool'],
                                (object) ['name' => 'فندق النبلاء', 'address' => 'المدينة المنورة', 'image' => 'https://source.unsplash.com/400x300/?suite,bed']
                            ])
                        ]);
                        $isActive = true; // متغير لتحديد الشريحة النشطة الأولى
                    @endphp

                    @foreach($chunks as $chunk)
                        {{-- كل شريحة (carousel-item) ستحتوي على 4 فنادق كحد أقصى ----}}
                        <div class="carousel-item @if($isActive) active @php $isActive = false; @endphp @endif">
                            <div class="row g-4 justify-content-center">
                                @foreach($chunk as $hotel)
                                    <div class="col-lg-3 col-md-6 col-sm-10">
                                        <div class="card h-100 " style="border-radius: 35px;">
                                            <img src="{{ isset($hotel->image) ? asset($hotel->image) : 'https://source.unsplash.com/400x300/?hotel' }}"
                                                class="card-img-top hotel-card-img" alt="{{ $hotel->name }}"
                                                style="object-fit: cover; object-position: center;">

                                            <div class="card-body d-flex flex-column text-center">
                                                <h5 class="card-title fw-bold">{{ $hotel->name }}</h5>
                                                <p class="text-muted mb-3">
                                                    <i class="bi bi-geo-alt-fill" style="color: var(--primary-color);"></i>
                                                    {{ $hotel->address }}
                                                </p>

                                                <a href="{{ route('hotelDetails', $hotel->id ?? '1') }}"
                                                    class="btn btn-luxury mt-auto mx-auto" style="width: 80%;">عرض </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- أزرار التحكم (السابق/التالي) --}}
                @if($chunks->count() > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#hotelCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">السابق</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#hotelCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">التالي</span>
                    </button>
                @endif
            </div>
        </div>
    </section>
  <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">



    <div class="carousel-inner">
        
        @foreach($services as $index => $service)
            
            <div class="carousel-item @if($index === 0) active @endif" data-bs-interval="5000">
                <div class="container">
                    <div class="row align-items-center justify-content-center" style="min-height: 450px;">
                        
                        <div class="col-lg-5 col-md-6 text-start pe-lg-5">
                            <h2 class="fw-bold mb-4 display-6">{{ $service->name }}</h2>
                            

                            <a href="#" class="btn btn-luxury px-4 py-2 rounded-pill">
                                اعرف أكثر <i class="bi bi-arrow-left ms-2"></i>
                            </a>
                        </div>
                        
                        <div class="col-lg-5 col-md-6 ps-lg-5 mt-md-0 mt-4">
                            <div class="rounded-4 overflow-hidden shadow-lg">
                                <img src="{{ $service->image }}" class="d-block w-100"
                                    style="min-height:400px; object-fit: cover;" alt="{{ $service->name }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div> @endforeach
    </div> <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bg-dark bg-opacity-25 rounded-circle p-3" aria-hidden="true"></span>
        <span class="visually-hidden">السابق</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
        <span class="carousel-control-next-icon bg-dark bg-opacity-25 rounded-circle p-3" aria-hidden="true"></span>
        <span class="visually-hidden">التالي</span>
    </button>
        <div class="carousel-indicators position-static mt-4">
        @foreach($services as $index => $service)
            <button type="button" 
                data-bs-target="#carouselExampleDark" 
                data-bs-slide-to="{{ $index }}"
                class="@if($index === 0) active @endif bg-dark rounded-circle mx-1" 
                style="width: 10px; height: 10px;" 
                aria-current="@if($index === 0) true @endif"
                aria-label="شريحة {{ $index + 1 }}">
            </button>
        @endforeach
    </div>

</div>
    <style>
        #carouselExampleDark {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 20px;
            overflow: hidden;
            /* box-shadow: 0 10px 30px rgba(0,0,0,0.1); */
            margin: 2rem auto;
            max-width: 1400px;
        }

        .carousel-item {
            padding: 2rem;
        }




        .rounded-4 {
            border-radius: 1rem !important;
        }

        .shadow-lg {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: auto;
            opacity: 1;
        }

        .carousel-control-prev {
            left: 1rem;
        }

        .carousel-control-next {
            right: 1rem;
        }

        @media (max-width: 768px) {
            .carousel-item {
                padding: 1rem;
            }

            .row {
                text-align: center !important;
            }

            .text-start {
                text-align: center !important;
            }

            .pe-lg-5,
            .ps-lg-5 {
                padding-right: var(--bs-gutter-x, 0.75rem) !important;
                padding-left: var(--bs-gutter-x, 0.75rem) !important;
            }
        }
    </style>

    @include('footer')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        // إدارة الشريط العلوي
        document.addEventListener('DOMContentLoaded', function () {
            const topBar = document.getElementById('top-bar');
            const navbar = document.querySelector('.navbar');

            if (topBar && navbar) {
                // ضبط الـ top الأولي للـ navbar
                navbar.style.top = topBar.offsetHeight + 'px';

                // تحديث عند تغيير حجم النافذة
                window.addEventListener('resize', function () {
                    navbar.style.top = topBar.offsetHeight + 'px';
                });

                // إخفاء الشريط العلوي عند التمرير
                let lastScrollTop = 0;
                window.addEventListener('scroll', function () {
                    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                    if (scrollTop > lastScrollTop && scrollTop > 100) {
                        // التمرير للأسفل - إخفاء
                        topBar.style.transform = 'translateY(-100%)';
                        navbar.style.top = '0';
                    } else {
                        // التمرير للأعلى - إظهار
                        topBar.style.transform = 'translateY(0)';
                        navbar.style.top = topBar.offsetHeight + 'px';
                    }
                    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
                });
            }

            // إدارة القائمة المنسدلة للمستخدم
            const userBtn = document.getElementById('userBtn');
            const userMenu = document.getElementById('userMenu');

            if (userBtn && userMenu) {
                userBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    userMenu.classList.toggle('show');
                });

                document.addEventListener('click', function () {
                    userMenu.classList.remove('show');
                });
            }

            // Flatpickr لتحديد التاريخ
            if (document.getElementById('date_range')) {
                flatpickr("#date_range", {
                    mode: "range",
                    dateFormat: "Y-m-d",
                    minDate: "today",
                    locale: "ar",
                    onChange: function (selectedDates, dateStr, instance) {
                        if (selectedDates.length === 2) {
                            const start = instance.formatDate(selectedDates[0], "Y-m-d");
                            const end = instance.formatDate(selectedDates[1], "Y-m-d");

                            document.getElementById('start_date').value = start;
                            document.getElementById('end_date').value = end;
                        }
                    }
                });
            }

            // التحقق من صحة الفورم
            const formIds = ['reserveForm', 'searchOldReservations'];

            formIds.forEach(formId => {
                const form = document.getElementById(formId);
                if (!form) return;

                form.addEventListener('submit', function (e) {
                    let valid = true;
                    const requiredFields = form.querySelectorAll('.form-control-custom[required]');

                    requiredFields.forEach(field => {
                        const error = field.parentElement.querySelector('.error-message');

                        if (!field.value.trim()) {
                            valid = false;
                            field.classList.add('is-invalid');
                            if (error) error.style.display = 'block';
                        } else {
                            field.classList.remove('is-invalid');
                            if (error) error.style.display = 'none';
                        }
                    });

                    if (!valid) {
                        e.preventDefault();
                        // إضافة اهتزاز للفورم غير الصالح
                        form.classList.add('shake');
                        setTimeout(() => form.classList.remove('shake'), 500);
                    }
                });
            });

            // تأثير اهتزاز للفورم
            const style = document.createElement('style');
            style.textContent = `
            @keyframes shake {
                0%, 100% {transform: translateX(0);}
                10%, 30%, 50%, 70%, 90% {transform: translateX(-5px);}
                20%, 40%, 60%, 80% {transform: translateX(5px);}
            }
            .shake {
                animation: shake 0.5s ease-in-out;
            }
        `;
            document.head.appendChild(style);
        });
    </script>

</body>

</html>