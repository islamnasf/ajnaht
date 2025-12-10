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
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">
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
            background-color: rgba(255, 255, 255, 0.95);
            padding: 15px 0;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            transition: all 0.4s ease;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            z-index: 1050;
        }

        .navbar-brand {
            font-weight: 800;
            color: var(--dark-text) !important;
            font-size: 1.7rem;
            letter-spacing: 0.5px;
        }

        .nav-link {
            color: var(--dark-text) !important;
            font-weight: 500;
            margin: 0 12px;
            padding: 8px 0;
            transition: color 0.3s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary-red) !important;
        }

        .nav-link::after {
            content: "";
            display: block;
            width: 0;
            height: 3px;
            background-color: var(--primary-red);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
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

        .user-dropdown .menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

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

        .user-dropdown .menu button:hover {
            background-color: var(--primary-red);
            color: white;
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

        .modal-backdrop.show {
            opacity: 0.9;
            background-color: rgba(0, 0, 0, 0.9);
        }

        .lightbox-img {
            width: 100%;
            max-height: 90vh;
            object-fit: contain;
        }

        .modal-header .btn-close {
            filter: invert(1);
            opacity: 1;
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

        /* تصحيح مشكلة القائمة في الجوال */
        .navbar-toggler {
            border: none;
            padding: 0.25rem 0.75rem;
            font-size: 1.25rem;
        }

        .navbar-toggler:focus {
            box-shadow: none;
            outline: none;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28198, 132, 47, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            width: 30px;
            height: 30px;
        }

        /* تحسين القائمة المنسدلة في الجوال */
        @media (max-width: 991.98px) {
            body {
                padding-top: 70px;
            }

            .navbar-collapse {
                background-color: white;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
                margin-top: 15px;
                border: 1px solid rgba(0, 0, 0, 0.1);
                position: absolute;
                top: 100%;
                right: 0;
                left: 0;
                z-index: 1000;
                max-height: calc(100vh - 100px);
                overflow-y: auto;
            }

            .navbar-nav {
                padding: 10px 0;
                margin-bottom: 15px;
            }

            .nav-item {
                margin: 5px 0;
            }

            .nav-link {
                padding: 12px 20px !important;
                border-radius: 8px;
                transition: all 0.3s;
                margin: 0;
                display: block;
            }

            .nav-link:hover,
            .nav-link.active {
                background-color: rgba(198, 132, 47, 0.1);
                padding-right: 25px !important;
            }

            .nav-link::after {
                display: none;
            }

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
            }

            .user-dropdown .menu {
                position: static;
                margin-top: 10px;
                box-shadow: none;
                background: transparent;
                opacity: 1;
                visibility: visible;
                transform: none;
                display: none;
                min-width: auto;
            }

            .user-dropdown .menu.show {
                display: block;
            }
        }

        @media (max-width: 767.98px) {
            .hotel-hero {
                height: 35vh;
                min-height: 250px;
            }

            .hotel-info-overlay h1 {
                font-size: 1.8rem;
            }

            .gallery-img {
                height: 180px;
            }

            .hotel-info-card {
                margin-top: 20px;
                padding: 20px;
                border-top: none;
                border-right: 5px solid var(--primary-red);
            }

            .navbar-collapse {
                padding: 15px;
                margin-top: 10px;
            }
        }
    </style>

</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('website') }}">
                @if($data->logo)
                    <img src="{{ asset($data->logo) }}" width="150" alt="{{ $data->name ?? 'Royal View' }}"
                        style="border-radius: 5px;">
                @else
                    <i class="fas fa-crown text-primary-red"></i> {{ $data->name ?? 'Royal View' }}
                @endif
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('website') }}">الرئيسية</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('website') }}#about">القصة</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('hotels') }}">الفنادق</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">{{ $hotel->name ?? 'تفاصيل الفندق' }}</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('website') }}#contact">الموقع وتواصل</a>
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

    <div class="container hotel-details-section">
        <div class="row g-4 mb-5 pt-5 pt-lg-0">

            {{-- 1. العمود الأيمن (صورة البطل) --}}
            <div class="col-lg-7 order-lg-1" data-aos="zoom-in" data-aos-delay="100">
                <div class="hotel-hero m-lg-0">
                    <img src="{{ asset($hotel->image) }}" class="hotel-image-full" alt="{{ $hotel->name }}">
                    <div class="hotel-info-overlay">
                        <h1 class="text-white">{{ $hotel->name }}</h1>
                        <p class="location text-light"><i class="fa fa-map-marker-alt me-2"></i> {{ $hotel->address }}
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
                            <h3 class="fw-bolder mb-4 section-heading"><i class="fa fa-info-circle me-2"></i> نظرة عامة
                                على الفندق</h3>
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
                    @php
                        $isAvailable = $hotel->prices->some(function ($price) {
                            return $price->periods->isNotEmpty();
                        });
                    @endphp
                    {{-- بطاقة الحجز --}}
                    <div class="col-lg-12" data-aos="fade-right" data-aos-delay="300">
                        <div class="hotel-info-card">
                            <h4 class="fw-bold mb-4 text-center section-heading">ابدأ إقامتك الفاخرة</h4>
                            @if($isAvailable)
                                <form action="{{ route('newReser') }}" method="GET" class="quick-reserve-form"
                                    id="quickReserveForm">
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
       <div class="rooms-prices py-5">
    <h2 class="fw-bold mb-5 text-center section-heading" data-aos="fade-up">
        <i class="fa fa-door-open me-2"></i> الغرف والأسعار المتاحة حسب التاريخ 
    </h2>

    <div class="row g-4">
        @foreach($hotel->prices as $priceItem)
            @php
                $roomName = $priceItem->name == 1 ? 'جناح ملكي' :
                            ($priceItem->name == 2 ? 'غرفة مزدوجة' : 'غرفة عائلية ' . $priceItem->name . ' أسرّة');
                $periods = $priceItem->periods->where('rooms_available', '>', 0);
            @endphp

            @if($periods->count() > 0)
                <div class="col-xl-3 col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="{{ $loop->iteration * 100 }}">
<div class="card shadow-sm border-0  rounded-4" style="min-height: 200px; ">
                        <div class="card-body d-flex flex-column">
                            <!-- اسم الغرفة -->
                            <h5 class="card-title mb-4 text-center ">{{ $roomName }}</h5>

                            <!-- عرض كل الفترات -->
                            @foreach($periods as $period)
                                <div class="mb-3 p-3 border rounded-3 bg-light">
                                    <p class="card-text text-secondary mb-2">
                                        <i class="fa fa-tag me-2 text-success"></i> السعر:
                                        <span class="fw-bold">{{ number_format($period->period_price, 0) }} ريال</span>
                                    </p>
                                    <p class="card-text mb-2">
                                        <i class="fa fa-door-open me-2 text-primary-red"></i> الغرف المتاحة:
                                        <span class="fw-bold">{{ $period->rooms_available }}</span>
                                    </p>
                                    <p class="card-text text-muted mb-0">
                                        <i class="fa fa-calendar-alt me-2"></i>
                                         {{ \Carbon\Carbon::parse($period->start)->format('d/m/Y') }}
                                        إلى {{ \Carbon\Carbon::parse($period->end)->format('d/m/Y') }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>




        <hr class="my-5">
        {{-- معرض الصور --}}
        <h2 class="fw-bold mb-5 text-center section-heading" data-aos="fade-up">
            <i class="fa fa-images me-2"></i> صور الفندق
        </h2>
        <div class="row g-3">
            @foreach($hotel->files as $file)
                <div class="col-lg-3 col-md-4 col-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    <img src="{{ asset($file->image) }}" class="gallery-img shadow-sm" alt="صورة رقم {{ $loop->iteration }}"
                        onclick="openImageModal('{{ asset($file->image) }}')">
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
    @include('footer')

    {{-- تضمين مكتبات JavaScript --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js"></script>

    <script>
        // تهيئة AOS
        AOS.init({
            duration: 1000,
            once: true,
        });

        // حل مشكلة القائمة في الجوال
        document.addEventListener('DOMContentLoaded', function () {
            // User Dropdown
            const userBtn = document.getElementById('userBtn');
            const userMenu = document.getElementById('userMenu');

            if (userBtn && userMenu) {
                userBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    userMenu.classList.toggle('show');
                });

                document.addEventListener('click', function () {
                    if (userMenu.classList.contains('show')) {
                        userMenu.classList.remove('show');
                    }
                });
            }

            // إغلاق القائمة عند النقر على رابط في الجوال
            const navLinks = document.querySelectorAll('.nav-link');
            const navbarToggler = document.querySelector('.navbar-toggler');
            const navbarCollapse = document.querySelector('.navbar-collapse');

            navLinks.forEach(link => {
                link.addEventListener('click', function () {
                    if (window.innerWidth < 992) {
                        // إغلاق القائمة باستخدام Bootstrap
                        const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                        bsCollapse.hide();

                        // إغلاق قائمة المستخدم إذا كانت مفتوحة
                        if (userMenu && userMenu.classList.contains('show')) {
                            userMenu.classList.remove('show');
                        }
                    }
                });
            });

            // تهيئة Date Range Picker
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
                }, function (start, end, label) {
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

            // التحقق من صحة النموذج قبل الإرسال
            $('#quickReserveForm').on('submit', function (e) {
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

        // إصلاح مشكلة Bootstrap مع القائمة في الجوال
        window.addEventListener('resize', function () {
            const navbarCollapse = document.querySelector('.navbar-collapse');
            if (window.innerWidth >= 992 && navbarCollapse.classList.contains('show')) {
                navbarCollapse.classList.remove('show');
            }
        });
    </script>

    {{-- تضمين الفوتر --}}

</body>

</html>