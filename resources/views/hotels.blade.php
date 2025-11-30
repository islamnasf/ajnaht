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
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
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
            --section-padding: 80px 0; /* تحسين قراءة الـ Padding */
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

        /* --- Navbar (بقي كما هو) --- */
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
            text-transform: uppercase;
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
        /* --- START MODIFIED Hotels CSS (Simpler, Cleaner Look) --- */
        /* ----------------------------------- */
        .hotels-section {
            padding: var(--section-padding);
        }
        
        .hotel-item {
            display: flex;
            align-items: stretch;
            /* **تبسيط الفصل بين العناصر** */
            margin-bottom: 30px; 
            background-color: var(--card-bg);
            border-radius: 10px; /* إضافة حواف دائرية بسيطة */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08); /* ظل ناعم فقط */
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
            padding: 0;
        }
        
        /* **إلغاء التناوب في الخلفية لتوحيد المظهر** */
        .hotels-section .row .hotel-item:nth-child(odd),
        .hotels-section .row .hotel-item:nth-child(even) {
            background-color: var(--card-bg);
            border-right: 1px solid rgba(0, 0, 0, 0.05);
            border-left: 1px solid rgba(0, 0, 0, 0.05);
        }


        .hotel-item:hover {
            transform: translateY(-5px); /* رفع خفيف وجميل */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            border-color: var(--primary-red);
        }

        .hotel-item .hotel-image-col {
            padding: 0;
            display: flex;
        }
        
        /* **جعل الصورة تأخذ الحواف الدائرية بشكل صحيح** */
        .hotel-item:not(.reverse) .hotel-image {
             border-top-right-radius: 9px;
             border-bottom-right-radius: 9px;
        }
        .hotel-item.reverse .hotel-image {
             border-top-left-radius: 9px;
             border-bottom-left-radius: 9px;
        }
        

        .hotel-item .hotel-image {
            height: 300px; 
            min-height: 250px;
            width: 100%;
            object-fit: cover;
            transition: transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            filter: brightness(0.95);
        }

        .hotel-item:hover .hotel-image {
            transform: scale(1.02); /* زوم أقل وأكثر نعومة */
            filter: brightness(1);
        }

        .hotel-item .hotel-content {
            padding: 35px; /* تقليل الـ padding قليلاً */
            color: var(--dark-text);
            text-align: right;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .hotel-item .hotel-content .hotel-name {
            font-size: 2rem; /* تصغير حجم العنوان قليلاً */
            font-weight: 800;
            color: var(--dark-text); /* جعل العنوان بلون النص الأساسي */
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
            height: 3px;
            background: var(--primary-red); /* استخدام اللون الأساسي للفاصل */
        }

        /* === تنسيق تفاصيل الفندق الجديد === */
        .hotel-details {
            display: flex;
            flex-wrap: wrap;
            gap: 25px; /* تقليل التباعد بين التفاصيل */
            margin-bottom: 25px;
        }

        .hotel-details span {
            display: inline-flex;
            align-items: center;
            color: var(--dark-text); 
            font-weight: 600; /* جعل الخط أغمق قليلاً */
            font-size: 1rem;
            transition: color 0.3s;
        }

        .hotel-details i, .hotel-details .star-rating-icon {
            color: var(--primary-red);
            margin-left: 8px;
            font-size: 1.25rem;
        }
        
        /* تنسيق النجوم */
        .star-rating .bi-star-fill {
            color: var(--gold);
            margin-left: 2px !important;
            font-size: 1rem; /* تصغير حجم النجمة قليلاً */
        }
        
        .star-rating-label {
            color: var(--text-light); /* استخدام لون فاتح لتسمية التصنيف */
            font-weight: 500;
            margin-right: 8px;
        }
        
        /* نمط الـ Reverse */
        .hotel-item.reverse {
            flex-direction: row-reverse;
        }


        /* ----------------------------------- */
        /* --- End MODIFIED Hotels CSS --- */
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

        .footer-map iframe {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
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


        /* -------------------------------------- */
        /* --- Responsive Enhancements (Mobile) --- */
        /* -------------------------------------- */

        @media (max-width: 992px) {
            /* إعدادات الهيرو */

             body {
            margin:25px;
        }
            .hero {
                height: 45vh;
                min-height: 300px;
                align-items: flex-end;
            }

            .hero-title {
                font-size: 3rem;
            }

            /* تنسيق الفنادق: تصبح عمودية على اللوحي والموبايل */
            .hotel-item {
                flex-direction: column !important;
                margin-bottom: 30px;
                border-radius: 10px;
            }
            
            .hotels-section .row .hotel-item:nth-child(odd),
            .hotels-section .row .hotel-item:nth-child(even) {
                background-color: var(--card-bg); 
                border-right: 1px solid rgba(0, 0, 0, 0.05);
                border-left: 1px solid rgba(0, 0, 0, 0.05);
            }
            
            .hotel-item:hover {
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            }

             /* **إزالة الحواف الدائرية المنفصلة على الموبايل** */
            .hotel-item .hotel-image {
                border-radius: 0 !important;
            }


            .hotel-item .hotel-image {
                height: 250px;
            }

            .hotel-item .hotel-content {
                padding: 30px 0px;
            }
            
            /* **ترتيب التفاصيل على اللوحي عمودياً** */
            .hotel-details {
                flex-direction: column;
                gap: 10px; 
                margin-bottom: 20px;
            }
            
             /* **فصل بسيط بين عناصر التفاصيل على اللوحي** */
             .hotel-details span {
                padding-bottom: 5px; 
                border-bottom: 1px dashed rgba(0, 0, 0, 0.05);
                width: 100%;
                justify-content: flex-start;
            }
            .hotel-details span:last-child {
                border-bottom: none;
                padding-bottom: 0;
            }
        }

        @media (max-width: 768px) {
            .hero {
                height: 3vh;
                min-height: 200px;
            }

            .hero-title {
                font-size: 2.2rem;
            }
            
            .hotel-item {
                 /* **إضافة خط فاصل سفلي أو لا شيء، نكتفي بالظل حالياً لتقليل التعقيد** */
                margin-bottom: 25px;
            }
            
            .hotel-item .hotel-image {
                height: 200px;
            }
            
            .hotel-item .hotel-content .hotel-name {
                font-size: 1.7rem; 
                margin-bottom: 10px;
            }
            
             .hotel-item .hotel-content {
                padding: 20px 15px; 
            }
            
            /* **جعل التفاصيل أكثر إحكاماً على الهاتف** */
            .hotel-details {
                gap: 8px; 
                margin-bottom: 15px;
            }
            
            .hotel-details span {
                font-size: 0.95rem;
            }
            
        }

        /* -------------------------------------- */
        /* --- End Responsive Enhancements (Mobile) --- */
        /* -------------------------------------- */
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
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
                    <li class="nav-item"><a class="nav-link " href="{{ route('website') }}">الرئيسية</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('website') }}#about">القصة</a></li>

                    <li class="nav-item"><a class="nav-link active" href="route('hotels')">الفنادق</a></li>

                    <li class="nav-item"><a class="nav-link" href="{{ route('website') }}#contact">الموقع وتواصل</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{ route('website') }}#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-list-alt me-1"></i> أقسامنا
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i
                                        class="fas fa-book me-2 text-danger"></i> مقالات</a></li>
                        </ul>
                    </li>
                </ul>
                @php
                $user = auth()->user();
                @endphp

                <style>
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
                </style>

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


            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="container hero-content">
            <div class="row align-items-center text-center">
                <div class="col-lg-12 text-center" data-aos="fade-up" data-aos-duration="1000">
                    <h1 class="hero-title">
                        الفنادق <br>
                        <!-- <span> فنادقنا</span> -->
                    </h1>
                </div>
            </div>
        </div>
    </section>


    <section class="hotels-section py-5" id="hotels">
        <div class="container py-5">


            <div class="row g-5 justify-content-center">
                @foreach($hotels as $hotel)
                {{-- نمط التناوب: 'reverse' إذا كان رقم العنصر زوجياً (بدأنا من 0) --}}
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
                    <div class="row g-0 hotel-item {{ $loop->index % 2 != 0 ? 'reverse' : '' }}">

                        {{-- عمود الصورة --}}
                        <div class="col-lg-3 hotel-image-col">
                            @if($hotel->image)
                            <img src="{{ asset($hotel->image) }}" class="hotel-image" alt="{{ $hotel->name }}">
                            @else
                            {{-- إضافة +1 للـ Index لضمان صور متنوعة عند استخدام Unsplash --}}
                            <img src="https://source.unsplash.com/800x600/?luxury,hotel,room,{{ $loop->index + 1 }}"
                                class="hotel-image" alt="{{ $hotel->name }}">
                            @endif
                        </div>

                        {{-- عمود المحتوى --}}
                        <div class="col-lg-8 hotel-content">
                            <div>
                                <h3 class="hotel-name">{{ $hotel->name }}</h3>
                                
                                {{-- تم حذف الوصف لتقليل الارتفاع --}}
                                {{-- <p>{{ $hotel->description }}</p> --}}


                                <div class="hotel-details mb-4">
                                    <span><i class="fas fa-bed"></i> غرف وأجنحة: {{ $hotel->rooms }}</span>
                                    <span><i class="fas fa-couch"></i> عدد الأسرّة: {{ $hotel->beds }}</span>
                                    
                                    {{-- **تعديل: عرض التصنيف بالنجوم حسب العدد الفعلي** --}}
                                    <span>
                                        <i class="star-rating-icon bi-star-fill"></i> 
                                        <span class="star-rating-label">التصنيف:</span>
                                        <span class="star-rating">
                                            @php
                                                // نحول التقييم إلى عدد صحيح (مثلاً 4.7 تصبح 5، 4.1 تصبح 4)
                                                $rate = round($hotel->rate); 
                                            @endphp
                                            {{-- عرض عدد النجوم المساوي للتقييم --}}
                                            @for ($i = 0; $i < $rate; $i++)
                                                <i class="bi bi-star-fill"></i>
                                            @endfor
                                        </span>
                                    </span>
                                    {{-- **نهاية تعديل النجوم** --}}
                                </div>
                            </div>

                            <div class="d-flex justify-content-start">
                                <a href="#" class="btn btn-luxury mt-3">استكشف الغرف والاجنحة  المتاحة <i
                                        class="fas fa-chevron-left me-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>


@include('footer')

    
</body>

</html>