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
    {{-- مكتبة Swiper للسلادير --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        :root {
            --primary-red: #c6842f;
            --primary-gradient: linear-gradient(135deg, #c6842f 0%, #a0661b 100%);
            --gold: #D4AF37;
            --light-bg: #f8f9fa;
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

        /* --- Navbar Styles (كما هي) --- */
        .navbar {
            background-color: rgba(255, 255, 255, 0.98);
            padding: 15px 0;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            z-index: 1050;
        }

        .navbar-brand {
            font-weight: 800;
            color: var(--dark-text) !important;
            font-size: 1.7rem;
        }

        .nav-link {
            color: var(--dark-text) !important;
            font-weight: 500;
            margin: 0 12px;
            transition: color 0.3s;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary-red) !important;
        }

        /* --- Luxury Button --- */
        .btn-luxury {
            background: var(--primary-gradient);
            color: #fff;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.4s ease;
            box-shadow: 0 4px 15px rgba(198, 132, 47, 0.3);
        }

        .btn-luxury:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(198, 132, 47, 0.4);
            color: #fff;
        }

        /* --- New Modern Hero Slider --- */
        .hero-section {
            position: relative;
            height: 80vh; /* ارتفاع السلايدر */
            min-height: 500px;
            max-height: 700px;
            width: 100%;
            overflow: hidden;
            margin-bottom: 30px;
        }

        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            position: relative;
            background-position: center;
            background-size: cover;
        }

        .swiper-slide::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.2) 60%, rgba(0,0,0,0.1) 100%);
            z-index: 1;
        }

        .hero-content {
            position: absolute;
            bottom: 60px;
            right: 8%;
            z-index: 2;
            color: white;
            max-width: 600px;
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease-out;
        }

        .swiper-slide-active .hero-content {
            opacity: 1;
            transform: translateY(0);
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 10px;
            text-shadow: 0 4px 10px rgba(0,0,0,0.5);
        }

        .hero-location {
            font-size: 1.2rem;
            margin-bottom: 15px;
            display: inline-block;
            background: rgba(255,255,255,0.2);
            padding: 5px 15px;
            border-radius: 30px;
            backdrop-filter: blur(5px);
        }

        .swiper-button-next, .swiper-button-prev {
            color: white;
            background: rgba(0,0,0,0.3);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            backdrop-filter: blur(5px);
            transition: 0.3s;
        }

        .swiper-button-next:hover, .swiper-button-prev:hover {
            background: var(--primary-red);
        }

        .swiper-button-next::after, .swiper-button-prev::after {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .swiper-pagination-bullet-active {
            background-color: var(--primary-red);
        }

        /* --- Modern Room Cards --- */
        .room-card-modern {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(0,0,0,0.05);
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: all 0.4s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .room-card-modern:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .room-header {
            background: var(--light-bg);
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        .room-header h5 {
            font-weight: 800;
            color: var(--secondary-color);
            margin: 0;
            font-size: 1.3rem;
        }

        .room-features {
            display: flex;
            justify-content: center;
            gap: 15px;
            padding: 15px 0;
            color: var(--text-light);
        }

        .room-feature-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 0.8rem;
        }
        .room-feature-item i {
            font-size: 1.1rem;
            margin-bottom: 5px;
            color: var(--primary-red);
        }

        .room-price-box {
            background: #fff;
            padding: 20px;
            border-top: 1px dashed #eee;
            margin-top: auto;
        }

        .price-display {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--primary-red);
        }

        .price-period {
            font-size: 0.85rem;
            color: #999;
        }

        /* --- Booking Form Card --- */
        .booking-card {
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            border-top: 4px solid var(--primary-red);
            position: sticky;
            top: 100px;
        }

        /* --- Gallery --- */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
        }

        .gallery-item {
            height: 250px;
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
            position: relative;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }
        
        .gallery-item::after {
            content: '\f00e';
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 2rem;
            opacity: 0;
            transition: opacity 0.3s;
            pointer-events: none;
            z-index: 2;
        }
        
        .gallery-item:hover::after {
            opacity: 1;
        }
        
        .gallery-item::before {
             content: '';
             position: absolute;
             top:0; left:0; right:0; bottom:0;
             background: rgba(0,0,0,0.3);
             opacity: 0;
             transition: opacity 0.3s;
             z-index: 1;
        }
        .gallery-item:hover::before { opacity: 1; }


        /* Footer Adjustment */
   /* --- Footer (بقي كما هو تقريباً) --- */
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


        /* Mobile Fixes */
        @media (max-width: 768px) {
            .hero-title { font-size: 2rem; }
            .hero-section { height: 60vh; }
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('website') }}">
                @if($data->logo)
                    <img src="{{ asset($data->logo) }}" width="150" alt="{{ $data->name ?? 'Royal View' }}" style="border-radius: 5px;">
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('hotels') }}">الفنادق</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('services') }}">الخدمات</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">{{ $hotel->name ?? 'تفاصيل الفندق' }}</a></li>
                </ul>

                <div class="user-dropdown">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-luxury mt-3 mt-lg-0">
                            <i class="fa fa-user-plus me-1"></i> دخول / تسجيل
                        </a>
                    @endguest

                    @auth
                        <button id="userBtn" class="btn btn-luxury mt-3 mt-lg-0">
                            <i class="fa fa-user me-1"></i> {{ auth()->user()->name }}
                        </button>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Hero Slider Section (New Design) --}}
    <div class="hero-section">
        <div class="swiper myHeroSwiper">
            <div class="swiper-wrapper">
                {{-- الصورة الرئيسية كأول سلايد --}}
                <div class="swiper-slide">
                    <img src="{{ asset($hotel->image) }}" style="width:100%; height:100%; object-fit:cover;" alt="{{ $hotel->name }}">
                    <div class="hero-content">
                        <span class="hero-location"><i class="fa fa-map-marker-alt me-1"></i> {{ $hotel->address }}</span>
                        <h1 class="hero-title">{{ $hotel->name }}</h1>
                        <div class="d-flex align-items-center gap-2">
                            <div class="text-warning fs-5">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $hotel->rate) <i class="fa fa-star"></i> @else <i class="far fa-star"></i> @endif
                                @endfor
                            </div>
                            <span class="text-white opacity-75">({{ $hotel->rate }} نجوم)</span>
                        </div>
                    </div>
                </div>
                {{-- بقية الصور --}}
                @foreach($hotel->files as $file)
                <div class="swiper-slide">
                    <img src="{{ asset($file->image) }}" style="width:100%; height:100%; object-fit:cover;" alt="صورة الفندق">
                    <div class="hero-content">
                        <span class="hero-location"><i class="fa fa-camera me-1"></i> اكتشف الفخامة</span>
                        <h1 class="hero-title">{{ $hotel->name }}</h1>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <div class="container py-4">
        <div class="row g-5">
            {{-- الجانب الأيمن: معلومات الفندق --}}
            <div class="col-lg-8">
                <div class="mb-5" data-aos="fade-up">
                    <h3 class="fw-bold mb-3" style="color: var(--primary-red);">
                        <i class="fa fa-hotel me-2"></i> عن الفندق
                    </h3>
                    <p class="lead text-muted">
                        استمتع بتجربة إقامة لا تُنسى في {{ $hotel->name }}. نحن نقدم لك مزيجاً من الراحة العصرية والضيافة الأصيلة. 
                        يتميز الفندق بموقعه الاستراتيجي وتجهيزاته الفاخرة لضمان راحتك القصوى.
                    </p>
                    
                    <div class="row g-4 mt-2 text-center">
                        <div class="col-md-3 col-6">
                            <div class="p-3 bg-white rounded-3 shadow-sm border">
                                <i class="fa fa-bed fa-2x text-secondary mb-2"></i>
                                <h5 class="fw-bold m-0">{{ $hotel->rooms ?? 'N/A' }}</h5>
                                <small class="text-muted">غرفة فاخرة</small>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="p-3 bg-white rounded-3 shadow-sm border">
                                <i class="fa fa-users fa-2x text-secondary mb-2"></i>
                                <h5 class="fw-bold m-0">{{ $hotel->beds ?? 'N/A' }}</h5>
                                <small class="text-muted">طاقة استيعابية</small>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="p-3 bg-white rounded-3 shadow-sm border">
                                <i class="fa fa-wifi fa-2x text-secondary mb-2"></i>
                                <h5 class="fw-bold m-0">مجاني</h5>
                                <small class="text-muted">واي فاي عالي السرعة</small>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="p-3 bg-white rounded-3 shadow-sm border">
                                <i class="fa fa-coffee fa-2x text-secondary mb-2"></i>
                                <h5 class="fw-bold m-0">متوفر</h5>
                                <small class="text-muted">ضيافة وكوفي</small>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-5">

                {{-- قسم الغرف والأسعار (بتصميم جديد) --}}
                <div id="rooms-section" class="py-2">
                    <h2 class="fw-bold mb-4 text-center section-heading" data-aos="fade-up">
                        <i class="fa fa-door-open me-2" style="color: var(--primary-red);"></i> الغرف والأسعار المتاحة
                    </h2>

                    <div class="row g-4">
                        @foreach($hotel->prices as $priceItem)
                            @php
                                $roomName = $priceItem->name == 1 ? ' سرير كبير ' :
                                            ($priceItem->name == 2 ? 'غرفة مزدوجة ديلوكس' : ' عائلي  (' . $priceItem->name . ' أسرّة)');
                                $periods = $priceItem->periods->where('rooms_available', '>', 0);
                            @endphp

                            @if($periods->count() > 0)
                                @foreach($periods as $period)
                                <div class="col-md-6" data-aos="zoom-in" data-aos-delay="100">
                                    <div class="room-card-modern">
                                        <div class="room-header">
                                            <h5>{{ $roomName }}</h5>
                                        </div>
                                        
                                        <div class="p-3">
                                            {{-- مميزات بصرية تجميلية للغرفة --}}
                                            <div class="room-features">
                                                <div class="room-feature-item">
                                                    <i class="fa fa-snowflake"></i> <span>تكييف</span>
                                                </div>
                                                <div class="room-feature-item">
                                                    <i class="fa fa-tv"></i> <span>تلفاز </span>
                                                </div>
                                                <div class="room-feature-item">
                                                    <i class="fa fa-shower"></i> <span>حمام خاص</span>
                                                </div>
                                                <div class="room-feature-item">
                                                    <i class="fa fa-concierge-bell"></i> <span>خدمة غرف</span>
                                                </div>
                                            </div>

                                            <div class="alert alert-light border text-center my-3 py-2">
                                                <i class="far fa-calendar-alt text-muted"></i>
                                                <span class="mx-1 fw-bold">{{ \Carbon\Carbon::parse($period->start)->format('Y/m/d') }}</span>
                                                <span class="text-muted">إلى</span>
                                                <span class="mx-1 fw-bold">{{ \Carbon\Carbon::parse($period->end)->format('Y/m/d') }}</span>
                                            </div>
                                            
                                            <div class="d-flex justify-content-between align-items-center bg-light p-2 rounded">
                                                <span class="text-muted small"><i class="fa fa-check-circle text-success"></i> متاح حالياً:</span>
                                                <span class="badge bg-success">{{ $period->rooms_available }} غرف</span>
                                            </div>
                                        </div>

                                        <div class="room-price-box">
                                            <div class="d-flex justify-content-between align-items-end">
                                                <div>
                                                    <span class="text-muted small d-block">سعر الليلة / الفترة</span>
                                                    <span class="price-display">{{ number_format($period->period_price, 0) }}</span> 
                                                    <span class="small text-muted">ريال</span>
                                                </div>
                                                <a href="#quickReserveForm" onclick="setDates('{{ \Carbon\Carbon::parse($period->start)->format('Y-m-d') }}', '{{ \Carbon\Carbon::parse($period->end)->format('Y-m-d') }}')" class="btn btn-luxury btn-sm rounded-pill px-4">
                                                    احجز الآن <i class="fa fa-arrow-left ms-1"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                </div>

                 <hr class="my-5">

                {{-- معرض الصور (Grid Layout) --}}
                <div class="py-2">
                    <h3 class="fw-bold mb-4" style="color: var(--primary-red);">
                        <i class="fa fa-images me-2"></i> معرض الصور
                    </h3>
                    <div class="gallery-grid">
                        @foreach($hotel->files as $file)
                            <div class="gallery-item" data-aos="fade-up" onclick="openImageModal('{{ asset($file->image) }}')">
                                <img src="{{ asset($file->image) }}" alt="Hotel Gallery">
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

            {{-- الجانب الأيسر: نموذج الحجز --}}
            <div class="col-lg-4">
                <div class="booking-card" data-aos="fade-left">
                    <h4 class="fw-bold mb-4 text-center">
                        <i class="fa fa-calendar-check text-primary-red"></i> تأكيد حجزك
                    </h4>
                    
                    @php
                        $isAvailable = $hotel->prices->some(function ($price) {
                            return $price->periods->isNotEmpty();
                        });
                    @endphp

                    @if($isAvailable)
                        <form action="{{ route('newReser') }}" method="GET" id="quickReserveForm">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold small text-muted">تاريخ الوصول والمغادرة</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="fa fa-calendar text-primary-red"></i></span>
                                    <input type="text" id="quickDateRange" class="form-control" placeholder="اختر التواريخ" required style="cursor: pointer;">
                                </div>
                                <div class="error-message text-danger small mt-1" id="dateError" style="display:none;"></div>
                                <input type="hidden" name="start" id="quickStartDate">
                                <input type="hidden" name="end" id="quickEndDate">
                            </div>

                            <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                            <input type="hidden" name="destination" value="مكة">

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-luxury btn-lg">
                                    متابعة الحجز
                                </button>
                            
                            </div>
                        </form>
                    @else
                        <div class="alert alert-warning text-center">
                            <i class="fa fa-exclamation-triangle fa-2x mb-2"></i><br>
                            لا توجد غرف متاحة للحجز المباشر حالياً. يرجى التواصل معنا.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Lightbox Modal --}}
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="" id="modalImage" class="img-fluid rounded shadow-lg" style="max-height: 85vh;">
                </div>
            </div>
        </div>
    </div>

    @include('footer')

    {{-- Scripts --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        // تهيئة AOS Animation
        AOS.init({ duration: 800, once: true });

        // تهيئة Swiper Slider
        var swiper = new Swiper(".myHeroSwiper", {
            spaceBetween: 0,
            effect: "fade",
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });

        // تهيئة Date Picker
        $(document).ready(function() {
            const today = moment();
            $('#quickDateRange').daterangepicker({
                "locale": { "format": "YYYY-MM-DD", "separator": " - ", "applyLabel": "تأكيد", "cancelLabel": "إلغاء", "fromLabel": "من", "toLabel": "إلى", "daysOfWeek": ["أحد", "إثنين", "ثلاثاء", "أربعاء", "خميس", "جمعة", "سبت"], "monthNames": ["يناير", "فبراير", "مارس", "أبريل", "مايو", "يونيو", "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"], "firstDay": 6 },
                "opens": "left",
                "minDate": today,
                "autoUpdateInput": false
            }, function(start, end) {
                $('#quickDateRange').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
                $('#quickStartDate').val(start.format('YYYY-MM-DD'));
                $('#quickEndDate').val(end.format('YYYY-MM-DD'));
            });
        });

        // Helper function for quick book buttons in rooms
        function setDates(start, end) {
            $('#quickStartDate').val(start);
            $('#quickEndDate').val(end);
            $('#quickDateRange').val(start + ' - ' + end);
            $('html, body').animate({
                scrollTop: $("#quickReserveForm").offset().top - 150
            }, 500);
        }

        // Image Modal
        function openImageModal(src) {
            document.getElementById('modalImage').src = src;
            new bootstrap.Modal(document.getElementById('imageModal')).show();
        }
    </script>

</body>
</html>