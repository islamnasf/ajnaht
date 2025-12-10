<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="{{ asset($data->logo) }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $data->name ?? 'رويال فيو' }} | فنادقنا الفاخرة</title>

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

        /* --- Navbar & Buttons (بقي كما هو) --- */
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

        /* --- Dropdown Styles (بقي كما هو) --- */
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

        /* --- Hero Section (بقي كما هو) --- */
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


        /* ----------------------------------- */
        /* --- START Vertical Hotel Card CSS --- */
        /* ----------------------------------- */
        .hotels-section {
            padding: var(--section-padding);
        }

        /* حاوية البطاقة العمودية */
        .hotel-item {
            /* **تعديل 1: إزالة Flexbox للحصول على تخطيط عمودي (الطبيعي)** */
            display: block;
            background-color: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
            margin-bottom: 30px;
            /* للتصميم العمودي، البطاقة ستأخذ عرض العمود الذي توجد فيه (col-lg-4) */
            height: 100%; /* للتأكد من تساوي ارتفاع البطاقات في الصف */
        }

        .hotel-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            border-color: var(--primary-red);
        }

        .hotel-item .hotel-image-container {
            /* **تعديل 2: تخصيص عرض الصورة ليناسب التخطيط العمودي** */
            width: 100%;
            height: 250px; /* تحديد ارتفاع ثابت نسبيًا للصورة */
            position: relative;
            overflow: hidden;
            flex-shrink: 0; /* لم يعد ضروريًا، ولكنه يبقى كإجراء وقائي */
        }

        .hotel-item .hotel-image {
            height: 100%;
            width: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            filter: brightness(0.95);
            /* **تعديل 3: تطبيق الحواف الدائرية على الجزء العلوي فقط** */
            border-radius: 12px 12px 0 0;
        }

        .hotel-item:hover .hotel-image {
            transform: scale(1.08);
            filter: brightness(1);
        }

        .hotel-item .hotel-content {
            padding: 25px;
            color: var(--dark-text);
            text-align: right;
            /* **تعديل 4: إزالة تنسيقات Flexbox الخاصة بالهيكل الأفقي** */
            flex-grow: 1;
            display: flex; /* يبقى لترتيب الاسم والتفاصيل والأزرار عمودياً */
            flex-direction: column;
            justify-content: space-between;
        }

        .hotel-item .hotel-content .hotel-name {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--dark-text);
            margin-bottom: 15px;
            position: relative;
            padding-bottom: 10px;
        }

        .hotel-item .hotel-content .hotel-name::after {
            content: '';
            position: absolute;
            right: 0;
            bottom: 0;
            width: 50px;
            height: 4px;
            background: var(--primary-red);
            border-radius: 2px;
        }

        .hotel-details {
            display: flex;
            flex-direction: column; /* **تعديل 5: عرض التفاصيل بشكل عمودي** */
            flex-wrap: nowrap;
            gap: 10px; /* تقليل المسافة العمودية */
            margin-bottom: 20px;
            padding-top: 5px;
        }

        .hotel-details>span {
            display: inline-flex;
            align-items: center;
            color: var(--dark-text);
            font-weight: 500;
            font-size: 1rem;
            transition: color 0.3s;
        }

        .hotel-details i,
        .hotel-details .star-rating-icon {
            color: var(--primary-red);
            margin-left: 8px;
            font-size: 1.25rem;
        }

        /* تنسيق النجوم */
        .star-rating {
            display: inline-flex;
        }

        .star-rating .bi-star-fill {
            color: var(--gold);
            margin-left: 2px !important;
            font-size: 1rem;
        }

        .star-rating-label {
            color: var(--text-light);
            font-weight: 500;
            margin-right: 8px;
        }
        
        /* وصف الفندق في البطاقة العمودية */
        .hotel-item .hotel-content p.text-secondary {
            flex-grow: 1; /* للسماح للوصف بأخذ المساحة اللازمة */
            margin-bottom: 20px;
            line-height: 1.6;
            color: var(--text-light) !important;
        }

        /* --- Hide/Show Button Style --- */
        #load-more-container {
            margin-top: 50px;
        }

        /* ----------------------------------- */
        /* --- End Vertical Hotel Card CSS --- */
        /* ----------------------------------- */


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

        /* --- User Dropdown Style (للتسجيل) --- */
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

        /* -------------------------------------- */
        /* --- Responsive Enhancements (Mobile) --- */
        /* -------------------------------------- */

        @media (max-width: 992px) {
            body {
                margin: 0;
            }
            .hero-content .container {
                padding-bottom: 30px;
            }

            .hero {
                height: 45vh;
                min-height: 300px;
                align-items: flex-end;
            }

            .hero-title {
                font-size: 3rem;
            }

            /* في وضع العمودي، لا نحتاج لتعديلات كبيرة على التابلت والموبايل */
            .hotel-item .hotel-image-container {
                height: 220px; /* تعديل بسيط لارتفاع الصورة */
            }
            
            .hotel-item .hotel-content {
                padding: 20px;
            }

            .hotel-item .hotel-content .hotel-name {
                font-size: 1.6rem;
            }

            .hotel-details>span {
                font-size: 0.95rem;
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

            .hotel-item .hotel-image-container {
                height: 180px; /* ارتفاع أقل للموبايل */
            }

            .hotel-item .hotel-content {
                padding: 15px;
            }

            .hotel-item .hotel-content .hotel-name {
                font-size: 1.4rem;
            }
        }
        /* -------------------------------------- */
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
                    <li class="nav-item"><a class="nav-link active" href="{{route('hotels')}}">الفنادق</a></li>
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

    {{-- إضافة سكريبت القائمة المنسدلة للتوثيق --}}
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

    {{-- --- Hero Section --- --}}
    <div class="hero">
        <div class="hero-bg" style="background-image: url('{{ asset($data->imageHeader ?? 'default-hero.jpg') }}');">
        </div>
        <div class="hero-overlay"></div>
        <div class="container hero-content">
            <h1 class="hero-title"> <span class="d-block d-md-inline">الفنادق</span></h1>
        </div>
    </div>


    {{-- ------------------------------------------------ --}}
    {{-- --- Hotels Section (Vertical Card + Load More) --- --}}
    {{-- ------------------------------------------------ --}}
    <section class="hotels-section" id="hotels">
        <div class="container">
            {{-- **التعديل هنا: استخدام col-lg-4 لعرض 3 بطاقات في الصف الواحد (تخطيط عمودي)** --}}
            <div class="row g-4 justify-content-center">
                @foreach($hotels as $hotel)
                {{-- **تطبيق الترتيب العمودي وإخفاء الفنادق من العنصر السابع فصاعداً (index 6)** --}}
                <div class="col-lg-4 col-md-6 col-sm-10 hotel-wrapper" data-aos="fade-up" data-aos-delay="100"
                    @if($loop->index >= 6) style="display: none;" @endif
                    data-hotel-index="{{ $loop->index }}">

                    <div class="hotel-item">
                        {{-- حاوية الصورة --}}
                        <a href="{{ route('hotelDetails', $hotel->id)}}" class="d-block hotel-image-container">
                            @if($hotel->image)
                            <img src="{{ asset($hotel->image) }}" class="hotel-image" alt="{{ $hotel->name }}">
                            @else
                            {{-- استخدام صورة Placeholder عند الحاجة --}}
                            <img src="https://source.unsplash.com/600x400/?luxury,hotel,room,{{ $loop->index + 1 }}"
                                class="hotel-image" alt="{{ $hotel->name }}">
                            @endif
                        </a>

                        {{-- المحتوى والتفاصيل --}}
                        <div class="hotel-content">
                            <div>
                                <h3 class="hotel-name">{{ $hotel->name }}</h3>

                                <div class="hotel-details">
                                   
                                    <span><i class="fas fa-bed"></i> غرف وأجنحة: {{ $hotel->rooms }}</span>
                                    <span><i class="fas fa-couch"></i> عدد الأسرّة: {{ $hotel->beds }}</span>

                                    {{-- عرض التصنيف بالنجوم --}}
                                    <span>
                                        <i class="star-rating-icon bi-star-fill"></i>
                                        <span class="star-rating-label">التصنيف:</span>
                                        <span class="star-rating">
                                            @php
                                            $rate = round($hotel->rate);
                                            @endphp
                                            {{-- عرض عدد النجوم المساوي للتقييم --}}
                                            @for ($i = 0; $i < $rate; $i++)
                                                <i class="bi bi-star-fill"></i>
                                                @endfor
                                        </span>
                                    </span>
                                </div>

                            </div>

                            <div class="d-flex justify-content-start mt-3">
                                <a href="{{ route('hotelDetails', $hotel->id)}}" class="btn btn-luxury w-100">استكشف
                                    الغرف <i class="fas fa-chevron-left me-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- زر عرض المزيد (يظهر فقط إذا كان عدد الفنادق أكبر من 6) --}}
            @if(count($hotels) > 6)
            <div class="text-center mt-5" id="load-more-container">
                <button class="btn btn-luxury" id="load-more-btn">
                    عرض المزيد من الفنادق (<span id="hidden-count">{{ count($hotels) - 6 }}</span>)
                    <i class="fas fa-chevron-down me-1"></i>
                </button>
            </div>
            @endif
        </div>
    </section>

    {{-- تضمين الفوتر --}}
    @include('footer')

    {{-- ------------------------------------------------ --}}
    {{-- --- JavaScript for Load More Functionality --- --}}
    {{-- ------------------------------------------------ --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });

        document.addEventListener('DOMContentLoaded', function() {
            // تحديد جميع أغلفة الفنادق
            const hotelWrappers = document.querySelectorAll('.hotels-section .hotel-wrapper');
            // تحديد زر العرض والمحتوى المتعلق به
            const loadMoreBtn = document.getElementById('load-more-btn');
            const loadMoreContainer = document.getElementById('load-more-container');
            const hiddenCountSpan = document.getElementById('hidden-count');

            // عدد الفنادق التي يجب أن تكون مرئية افتراضيًا
            const visibleLimit = 6;

            // دالة لتنفيذ الرؤية الافتراضية
            function initializeVisibility() {
                if (hotelWrappers.length > visibleLimit) {
                    if (loadMoreContainer) {
                        loadMoreContainer.style.display = 'block';
                    }

                    // إخفاء الفنادق بدءاً من العنصر السابع (index 6)
                    for (let i = visibleLimit; i < hotelWrappers.length; i++) {
                        hotelWrappers[i].style.display = 'none';
                    }

                    // تحديث عداد الفنادق المخفية
                    if (hiddenCountSpan) {
                        hiddenCountSpan.textContent = hotelWrappers.length - visibleLimit;
                    }
                } else if (loadMoreContainer) {
                    // إخفاء الزر إذا لم يكن هناك فنادق إضافية
                    loadMoreContainer.style.display = 'none';
                }
            }

            // دالة لعرض جميع الفنادق المخفية
            function loadAllHiddenHotels() {
                for (let i = visibleLimit; i < hotelWrappers.length; i++) {
                    if (hotelWrappers[i]) {
                        // استخدام 'block' لجعله يظهر داخل نظام Grid
                        hotelWrappers[i].style.display = 'block';
                    }
                }

                // إخفاء زر "عرض المزيد" بعد عرض جميع الفنادق
                if (loadMoreContainer) {
                    loadMoreContainer.style.display = 'none';
                }

                // تحديث مكتبة AOS لتطبيق تأثير الظهور على العناصر الجديدة
                AOS.refresh();
            }

            // إعداد الرؤية عند تحميل الصفحة
            initializeVisibility();

            // إضافة مستمع الحدث للزر
            if (loadMoreBtn) {
                loadMoreBtn.addEventListener('click', loadAllHiddenHotels);
            }
        });
    </script>
</body>

</html>