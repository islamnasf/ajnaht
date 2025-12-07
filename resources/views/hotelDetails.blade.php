<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>رومانس | {{ $hotel->name ?? 'تفاصيل الفندق' }}</title>
    <link rel="icon" type="image/png" href="{{ asset($data->logo ?? 'default-logo.png') }}">

    {{-- مكتبات CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    {{-- مكتبة Date Range Picker CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.css">

    <style>
        :root {
            --primary-red: #c6842f;
            --primary-gradient: linear-gradient(135deg, #c6842f 0%, #c6842f 100%);
            --gold: #D4AF37;
            --light-bg: #f5f5f5;
            --dark-text: #1a1a1a;
            --card-bg: #ffffff;
            --text-light: #6c757d;
            --secondary-color: #343a40;
        }

        body {
            font-family: "IBM Plex Sans Arabic", sans-serif;
            background-color: var(--light-bg);
            color: var(--dark-text);
            overflow-x: hidden;
            line-height: 1.6;
            padding-top: 80px;
        }

        /* --- Scrollbar and Selection --- */
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

        /* --- Navbar Styles --- */
        .navbar {
            background-color: rgba(255, 255, 255, 0.98) !important;
            padding: 10px 0;
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            transition: all 0.4s ease;
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            z-index: 1030;
        }

        .navbar-brand {
            font-weight: 900;
            color: var(--dark-text) !important;
            font-size: 1.8rem;
            letter-spacing: 1px;
        }

        .navbar-brand img {
            max-height: 50px;
            width: auto;
        }

        .nav-link {
            color: var(--dark-text) !important;
            font-weight: 500;
            margin: 0 8px;
            padding: 8px 12px !important;
            position: relative;
            transition: 0.3s;
            border-radius: 6px;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary-red) !important;
            background-color: rgba(198, 132, 47, 0.1);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            right: 50%;
            transform: translateX(50%);
            background-color: var(--primary-red);
            transition: width 0.3s;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 80%;
        }

        /* تحسين زر القائمة في الجوال */
        .navbar-toggler {
            border: 2px solid var(--primary-red);
            padding: 6px 10px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 3px rgba(198, 132, 47, 0.2);
            outline: none;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(198, 132, 47, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            width: 24px;
            height: 24px;
            transition: transform 0.3s ease;
        }

        /* القائمة المنسدلة في الجوال - الحل النهائي */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                position: fixed !important;
                top: 70px !important;
                right: 15px !important;
                left: 15px !important;
                background-color: white !important;
                padding: 20px !important;
                border-radius: 12px !important;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
                border: 1px solid rgba(0, 0, 0, 0.1) !important;
                z-index: 1000 !important;
                max-height: calc(100vh - 100px) !important;
                overflow-y: auto !important;
                display: none !important;
                opacity: 0 !important;
                transform: translateY(-10px) !important;
                transition: all 0.3s ease-in-out !important;
            }

            .navbar-collapse.show {
                display: block !important;
                opacity: 1 !important;
                transform: translateY(0) !important;
            }

            .navbar-nav {
                width: 100%;
                margin-bottom: 15px;
            }

            .nav-item {
                margin: 8px 0;
                width: 100%;
            }

            .nav-link {
                padding: 12px 15px !important;
                margin: 0 !important;
                border-radius: 8px;
                text-align: right;
                font-size: 1rem;
                border-left: 3px solid transparent;
            }

            .nav-link:hover,
            .nav-link.active {
                background-color: rgba(198, 132, 47, 0.1);
                border-left: 3px solid var(--primary-red);
                padding-right: 20px !important;
            }

            .nav-link::after {
                display: none;
            }
        }

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
        .user-dropdown {
            position: relative;
            display: inline-block;
        }

        .user-dropdown .menu {
            position: absolute;
            top: 100%;
            right: 0;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            min-width: 160px;
            padding: 8px 0;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .user-dropdown .menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .user-dropdown .menu button {
            width: 100%;
            padding: 10px 20px;
            background: none;
            border: none;
            text-align: right;
            color: var(--dark-text);
            font-weight: 500;
            transition: all 0.2s;
            cursor: pointer;
        }

        .user-dropdown .menu button:hover {
            background-color: var(--primary-red);
            color: white;
        }

        @media (max-width: 991.98px) {
            .user-dropdown {
                margin-top: 15px;
                padding-top: 15px;
                border-top: 1px solid #eee;
                text-align: center;
                display: block;
                width: 100%;
            }

            .user-dropdown .btn-luxury {
                width: 100%;
                margin-top: 0;
                padding: 12px 20px;
            }

            .user-dropdown .menu {
                position: static !important;
                margin-top: 10px;
                box-shadow: none;
                background: transparent;
                opacity: 1;
                visibility: visible;
                transform: none;
                display: none;
                min-width: auto;
                width: 100%;
                border: none;
                padding: 0;
            }

            .user-dropdown .menu.show {
                display: block !important;
            }

            .user-dropdown .menu button {
                padding: 12px 20px;
                text-align: center;
                border: 1px solid #eee;
                border-radius: 8px;
                margin-top: 5px;
                width: 100%;
            }
        }

        /* --- Footer Styles --- */
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

        /* --- Hotel Details Custom Styles --- */
        .hotel-details-section {
            padding-top: 50px;
            padding-bottom: 50px;
        }

        /* ******* Hero Image ******* */
        .hotel-hero {
            position: relative;
            height: 100%;
            min-height: 450px;
            max-height: 750px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

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

        /* Gallery Section - تحسين تنسيق الصور */
        .gallery-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .gallery-item {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 250px;
            cursor: pointer;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .gallery-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .gallery-item:hover .gallery-img {
            transform: scale(1.05);
        }

        .gallery-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
            padding: 15px;
            color: white;
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }

        .gallery-item:hover .gallery-overlay {
            transform: translateY(0);
        }

        /* Lightbox Modal Custom Style */
        .modal-content {
            background-color: transparent;
            border: none;
        }

        .modal-backdrop.show {
            opacity: 0.95;
            background-color: rgba(0, 0, 0, 0.95);
        }

        .lightbox-img {
            width: 100%;
            max-height: 90vh;
            object-fit: contain;
            border-radius: 10px;
        }

        .modal-header .btn-close {
            filter: invert(1);
            opacity: 1;
            position: absolute;
            left: 15px;
            top: 15px;
            z-index: 10;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            padding: 10px;
        }

        /* Date Range Picker Styles */
        .daterangepicker {
            font-family: "IBM Plex Sans Arabic", sans-serif !important;
            direction: rtl !important;
            text-align: right !important;
        }

        .daterangepicker .calendar-table th, 
        .daterangepicker .calendar-table td {
            font-family: "IBM Plex Sans Arabic", sans-serif !important;
        }

        .daterangepicker .ranges li {
            text-align: right !important;
            padding: 8px 12px !important;
        }

        .daterangepicker .drp-calendar.left {
            float: right !important;
        }

        .daterangepicker .drp-calendar.right {
            float: left !important;
        }

        #quickDateRange {
            background-color: white;
            cursor: pointer;
            text-align: center;
            font-weight: 500;
            border: 1px solid #ced4da;
            border-radius: 8px;
            padding: 10px 15px;
            width: 100%;
        }

        #quickDateRange:focus {
            border-color: var(--primary-red);
            box-shadow: 0 0 0 0.25rem rgba(198, 132, 47, 0.25);
            outline: none;
        }

        /* Error Message */
        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 5px;
            display: none;
        }

        /* تحسينات الريسبونسيف */
        @media (max-width: 991.98px) {
            body {
                padding-top: 70px;
            }
            
            .hotel-hero {
                height: 45vh;
                min-height: 350px;
                margin-top: 15px;
            }

            .hotel-info-overlay h1 {
                font-size: 2.2rem;
            }

            .gallery-container {
                grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
                gap: 15px;
            }

            .gallery-item {
                height: 200px;
            }
        }

        @media (max-width: 767.98px) {
            .hotel-hero {
                height: 35vh;
                min-height: 280px;
            }

            .hotel-info-overlay h1 {
                font-size: 1.8rem;
            }

            .hotel-info-card {
                padding: 20px;
                margin-top: 15px;
            }

            .gallery-container {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .gallery-item {
                height: 180px;
            }

            .price-card {
                padding: 20px;
                margin-bottom: 15px;
            }
        }

        @media (max-width: 575.98px) {
            .gallery-container {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .gallery-item {
                height: 220px;
            }

            .hotel-hero {
                height: 30vh;
                min-height: 220px;
            }

            .navbar-brand img {
                max-width: 150px;
            }

            .navbar-collapse {
                right: 10px !important;
                left: 10px !important;
                padding: 15px !important;
            }
        }
    </style>

</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('website') }}">
                @if($data->logo)
                    <img src="{{ asset($data->logo) }}" width="190" alt="{{ $data->name ?? 'رومانس' }}" style="border-radius: 5px;">
                @else
                    <i class="fas fa-crown text-danger"></i> {{ $data->name ?? 'رومانس' }}
                @endif
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" 
                    aria-controls="mainNav" aria-expanded="false" aria-label="تبديل التنقل">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('website') ? 'active' : '' }}" href="{{ route('website') }}">الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('website') }}#about">القصة</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('hotels') ? 'active' : '' }}" href="{{ route('hotels') }}">الفنادق</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">{{ $hotel->name ?? 'تفاصيل الفندق' }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('website') }}#contact">الموقع وتواصل</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('blogs') ? 'active' : '' }}" href="{{ route('blogs') }}">
                            <i class="fas fa-list-alt me-1"></i> مقالات
                        </a>
                    </li>
                </ul>
                
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
                            <form method="GET" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit">
                                    <i class="fa fa-sign-out-alt me-1"></i> تسجيل الخروج
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="container hotel-details-section">
        <div class="row g-4 mb-5 pt-5 pt-lg-0">

            {{-- 1. العمود الأيمن (صورة البطل) --}}
            <div class="col-lg-7 order-lg-1" data-aos="zoom-in" data-aos-delay="100">
                <div class="hotel-hero m-lg-0">
                    <img src="{{ asset($hotel->image) }}" class="hotel-image-full" alt="{{ $hotel->name }}">
                    <div class="hotel-info-overlay">
                        <h1 class="text-white">{{ $hotel->name }}</h1>
                        <p class="location text-light">
                            <i class="fa fa-map-marker-alt me-2"></i> {{ $hotel->address }}
                        </p>
                        <p class="rating mb-3">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $hotel->rate)
                                    <i class="fa fa-star"></i>
                                @endif
                            @endfor
                        </p>
                    </div>
                </div>
            </div>

            {{-- 2. العمود الأيسر (للمعلومات والحجز) --}}
            <div class="col-lg-5 order-lg-2">
                <div class="row g-4 h-100">
                    <div class="col-lg-12" data-aos="fade-right" data-aos-delay="200">
                        <div class="hotel-info-card">
                            <h3 class="fw-bolder mb-4 section-heading">
                                <i class="fa fa-info-circle me-2"></i> نظرة عامة على الفندق
                            </h3>
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

                    {{-- بطاقة الحجز --}}
                    <div class="col-lg-12" data-aos="fade-right" data-aos-delay="300">
                        <div class="hotel-info-card">
                            <h4 class="fw-bold mb-4 text-center section-heading">ابدأ إقامتك الفاخرة</h4>

                            @if($hotel->prices->where('roomAvailable', '>', 0)->count() > 0)
                                <form action="{{ route('newReser') }}" method="GET" class="quick-reserve-form" id="quickReserveForm">
                                    @csrf
                                    
                                    <div class="row g-3 mb-3">
                                        <div class="col-12">
                                            <label class="small text-muted mb-1">الفترة</label>
                                            <input type="text" id="quickDateRange" class="form-control form-control-custom" 
                                                   placeholder="اختر تاريخ الوصول والمغادرة" required>
                                            <div class="error-message" id="dateError">برجاء اختيار الفترة</div>
                                            
                                            <input type="hidden" name="start" id="quickStartDate">
                                            <input type="hidden" name="end" id="quickEndDate">
                                        </div>
                                    </div>

                                    <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                                    <input type="hidden" name="destination" value="مكة">
                                    
                                    <button type="submit" class="btn btn-luxury btn-lg w-100">
                                        <i class="fa fa-calendar-check me-2"></i> احجز إقامتك الآن
                                    </button>
                                </form>
                            @else
                                <div class="alert alert-warning text-center mb-0 py-3">
                                    <i class="fa fa-bed me-2"></i> 
                                    <strong>نعتذر</strong><br>
                                    لا توجد غرف متاحة حالياً في هذا الفندق
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-5">

        {{-- أسعار الغرف المتاحة --}}
        <div class="rooms-prices">
            <h2 class="fw-bold mb-5 text-center section-heading" data-aos="fade-up">
                <i class="fa fa-door-open me-2"></i> الغرف والأسعار المتاحة
            </h2>

            <div class="row g-4">
                @for($i = 1; $i <= 5; $i++)
                    @php
                        $priceItem = $hotel->prices->where('name', $i)->first() ?? null;
                        $price = $priceItem->price ?? 0;
                        $roomAvailable = $priceItem->roomAvailable ?? 0;
                        $roomName = $i == 1 ? 'جناح ملكي' : ($i == 2 ? 'غرفة مزدوجة' : 'غرفة عائلية ' . $i . ' أسرّة');
                    @endphp

                    @if($roomAvailable > 0)
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

        {{-- معرض الصور - النسخة المحسنة --}}
        <h2 class="fw-bold mb-4 text-center section-heading" data-aos="fade-up">
            <i class="fa fa-images me-2"></i> صور الفندق
        </h2>

        <div class="gallery-container" data-aos="fade-up" data-aos-delay="100">
            @foreach($hotel->files as $file)
                <div class="gallery-item">
                    <img src="{{ asset($file->image) }}" class="gallery-img" 
                         alt="صورة الفندق {{ $loop->iteration }}" 
                         onclick="openImageModal('{{ asset($file->image) }}')">
                    <div class="gallery-overlay">
                        <p class="mb-0 text-white small">صورة {{ $loop->iteration }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Lightbox Modal --}}
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body text-center p-1">
                    <img src="" id="modalImage" class="lightbox-img" alt="صورة مكبرة">
                </div>
            </div>
        </div>
    </div>

    {{-- تضمين مكتبات JavaScript --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js"></script>

    <script>
        // تهيئة AOS
        AOS.init({
            duration: 1000,
            once: true,
        });

        // الحل النهائي لمشكلة النافبار في الجوال
        document.addEventListener('DOMContentLoaded', function() {
            // 1. User Dropdown
            const userBtn = document.getElementById('userBtn');
            const userMenu = document.getElementById('userMenu');
            
            if (userBtn && userMenu) {
                userBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    userMenu.classList.toggle('show');
                });

                // إغلاق قائمة المستخدم عند النقر خارجها
                document.addEventListener('click', function(e) {
                    if (!e.target.closest('.user-dropdown') && userMenu.classList.contains('show')) {
                        userMenu.classList.remove('show');
                    }
                });
            }

            // 2. إغلاق القائمة عند النقر على أي رابط في الجوال
            const navLinks = document.querySelectorAll('.nav-link');
            const navbarCollapse = document.querySelector('.navbar-collapse');
            const navbarToggler = document.querySelector('.navbar-toggler');
            
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 992 && navbarCollapse.classList.contains('show')) {
                        // استخدام Bootstrap لإغلاق القائمة
                        const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                        bsCollapse.hide();
                        
                        // إغلاق قائمة المستخدم إذا كانت مفتوحة
                        if (userMenu && userMenu.classList.contains('show')) {
                            userMenu.classList.remove('show');
                        }
                    }
                });
            });

            // 3. إغلاق القائمة عند النقر خارجها في الجوال
            document.addEventListener('click', function(e) {
                if (window.innerWidth < 992) {
                    const isClickInsideNavbar = e.target.closest('.navbar');
                    const isClickInsideCollapse = e.target.closest('.navbar-collapse');
                    const isNavbarToggler = e.target.closest('.navbar-toggler');
                    
                    if (!isClickInsideNavbar && !isNavbarToggler && navbarCollapse.classList.contains('show')) {
                        const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                        bsCollapse.hide();
                    }
                }
            });

            // 4. تهيئة Date Range Picker
            if ($('#quickDateRange').length) {
                const today = moment();
                const tomorrow = moment().add(1, 'days');
                const threeDaysLater = moment().add(3, 'days');
                
                $('#quickDateRange').daterangepicker({
                    "locale": {
                        "format": "YYYY-MM-DD",
                        "separator": " - ",
                        "applyLabel": "تأكيد",
                        "cancelLabel": "إلغاء",
                        "fromLabel": "من",
                        "toLabel": "إلى",
                        "customRangeLabel": "مخصص",
                        "weekLabel": "أسبوع",
                        "daysOfWeek": [
                            "أحد", "إثنين", "ثلاثاء", "أربعاء", "خميس", "جمعة", "سبت"
                        ],
                        "monthNames": [
                            "يناير", "فبراير", "مارس", "أبريل", "مايو", "يونيو",
                            "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"
                        ],
                        "firstDay": 6
                    },
                    "opens": "right",
                    "drops": "down",
                    "minDate": today,
                    "startDate": tomorrow,
                    "endDate": threeDaysLater,
                    "autoApply": true,
                    "alwaysShowCalendars": true
                }, function(start, end, label) {
                    $('#quickStartDate').val(start.format('YYYY-MM-DD'));
                    $('#quickEndDate').val(end.format('YYYY-MM-DD'));
                    $('#quickDateRange').val(start.format('YYYY/MM/DD') + ' - ' + end.format('YYYY/MM/DD'));
                    $('#dateError').hide();
                });

                // تعيين القيم الأولية
                $('#quickStartDate').val(tomorrow.format('YYYY-MM-DD'));
                $('#quickEndDate').val(threeDaysLater.format('YYYY-MM-DD'));
                $('#quickDateRange').val(
                    tomorrow.format('YYYY/MM/DD') + ' - ' + threeDaysLater.format('YYYY/MM/DD')
                );
            }

            // 5. التحقق من صحة النموذج قبل الإرسال
            $('#quickReserveForm').on('submit', function(e) {
                const start = $('#quickStartDate').val();
                const end = $('#quickEndDate').val();
                const dateError = $('#dateError');
                
                if (!start || !end) {
                    e.preventDefault();
                    dateError.text('برجاء اختيار تاريخ الوصول والمغادرة').show();
                    $('#quickDateRange').focus();
                    return false;
                }
                
                if (new Date(start) >= new Date(end)) {
                    e.preventDefault();
                    dateError.text('تاريخ المغادرة يجب أن يكون بعد تاريخ الوصول').show();
                    $('#quickDateRange').focus();
                    return false;
                }
                
                dateError.hide();
                return true;
            });
        });

        // دالة فتح صورة في المودال
        function openImageModal(imageSrc) {
            const modalImage = document.getElementById('modalImage');
            modalImage.src = imageSrc;
            
            const modal = new bootstrap.Modal(document.getElementById('imageModal'));
            modal.show();
        }

        // إصلاح مشكلة عند تغيير حجم النافذة
        window.addEventListener('resize', function() {
            const navbarCollapse = document.querySelector('.navbar-collapse');
            if (window.innerWidth >= 992 && navbarCollapse.classList.contains('show')) {
                navbarCollapse.classList.remove('show');
            }
        });
    </script>

    {{-- تضمين الفوتر --}}
    @include('footer')

</body>

</html>