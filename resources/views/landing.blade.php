<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $data->name ?? 'رويال فيو' }} | فخامة الإقامة</title>
<link rel="icon" type="image/png" href="{{ asset($data->logo) }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=cairo:wght@300;500;700;900&family=Display:wght@700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary-red: #7d1517;
            /* لونك المفضل */
            --primary-gradient: linear-gradient(135deg, #7d1517 0%, #4a0d0e 100%);
            --gold: #D4AF37;
            /* ذهبي للفخامة */
            /* === التغيير الأساسي: خلفية فاتحة (كريمي فاتح) === */
            --light-bg: #f8f8f8;
            /* لون خلفية فاتح جداً */
            --dark-text: #212529;
            /* نص داكن للقراءة */
            --card-bg: #ffffff;
            /* خلفية بيضاء للبطاقات */
            --text-light: #495057;
            /* نص ثانوي داكن */
        }

        body {
            /* === استخدام خط Tajawal الأنيق والمحترف === */
            font-family: "cairo", sans-serif;
            /* استخدام الخلفية الفاتحة الجديدة */
            background-color: var(--light-bg);
            /* استخدام النص الداكن الجديد */
            color: var(--dark-text);
            overflow-x: hidden;
        }

        /* تخصيص شريط التمرير */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            /* خلفية الشريطة تصبح فاتحة */
            background: #e9ecef;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-red);
            border-radius: 5px;
        }

        /* تحديد النصوص */
        ::selection {
            background: var(--primary-red);
            color: #fff;
        }

        /* --- Navbar --- */
        .navbar {
            /* جعل النافبار أبيض بالكامل */
            background-color: rgba(255, 255, 255, 0.75);
            padding: 10px 0;
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);

            transition: all 0.4s ease;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            /* ظل خفيف للبروز */
            box-shadow: 0 50px 50px rgba(0, 0, 0, 0.05);
        }

        /* تأثير إضاءة اللوجو */
        .navbar-brand {
            font-weight: 900;
            /* جعل اللوجو نصاً داكناً */
            color: var(--dark-text) !important;
            font-size: 1.8rem;
            letter-spacing: 1px;
            /* إزالة الـ text-shadow أو تخفيفه */
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
            /* لا تغيير */
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

        /* تنسيق الـ Dropdown داخل النافبار */
        .navbar-nav .dropdown-menu {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            background-color: var(--card-bg);
            padding: 0;
        }

        .navbar-nav .dropdown-item {
            color: var(--dark-text);
            padding: 10px 20px;
            transition: background-color 0.2s, color 0.2s;
            font-weight: 500;
        }

        .navbar-nav .dropdown-item:hover,
        .navbar-nav .dropdown-item:active {
            background-color: var(--primary-red);
            color: white;
        }

        /* نهاية تنسيق الـ Dropdown */


        /* لا تغيير على الأزرار لأنها تستخدم ألوان العلامة التجارية */
        .btn-luxury {
            background: var(--primary-gradient);
            color: #fff;
            border: 1px solid var(--primary-red);
            padding: 10px 30px;
            border-radius: 0;
            font-weight: 700;
            text-transform: uppercase;
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
            /* البريق بلون الخلفية الفاتحة */
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

        /* --- Hero Section (Showcase) --- */
        .hero {
            position: relative;
            height: 100vh;
            min-height: 650px;
            display: flex;
            align-items: center;
            /* وضع المحتوى في منتصف الهيرو */
            overflow: hidden;
        }


        .hero-bg {
            /* لا تغيير: نحافظ على الصورة الخلفية كما هي */
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('{{ asset($data->imageHeader ?? ' default-hero.jpg') }}') center/cover no-repeat;
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
            /* تخفيف التظليل ليتناسب مع الخلفيات الفاتحة */
            background: linear-gradient(to right, rgba(255, 255, 255, 0.1), rgba(0, 0, 0, 0.2));
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            /* النص لا يزال أبيض ليتناقض مع صورة الخلفية الداكنة */
            color: #ffffff;
            font-size: 1.3rem;
            /* إضافة padding-bottom لدفعه للأعلى قليلاً */
            padding-bottom: 80px;
        }

        .hero-title {
            font-size: 3.5rem;
            /* زيادة حجم الخط قليلاً */
            font-weight: 500;
            line-height: 1.1;
            text-transform: uppercase;
        }

        .hero-title span {
            color: transparent;
            /* الحفاظ على تأثير الـ stroke الأبيض */
            -webkit-text-stroke: 1.5px #ffffffe0;
            /* تخفيف الـ stroke قليلاً ليتناسب مع اللون الأبيض */
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            /* إضافة ظل خفيف لتحسين الرؤية على الخلفية */
        }

        /* --- Glassmorphism Search Box (تم تفتيحه ليصبح مناسباً) --- */
        .search-form-container {
            position: relative;
            z-index: 10;
            /* رفع الفورم للأعلى بشكل فعال */
            margin-top: -30px;
        }

        .search-glass {
            /* زيادة الشفافية والـ blur لجعله أفتح */
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
            transform: translateY(0);
            transition: transform 0.3s;
            /* النص داخل الصندوق يصبح داكناً للوضوح على الخلفية الفاتحة */
            color: var(--dark-text);
        }

        .search-glass h4 {
            color: var(--dark-text);
            font-weight: 700;
            /* تثقيل الخط لعنوان الفورم */
        }

        .search-glass:hover {
            transform: translateY(-5px);
            border-color: var(--primary-red);
        }

        .form-control-custom {
            /* تفتيح لون خلفية الحقول */
            background: rgba(255, 255, 255, 0.8);
            border: none;
            border-bottom: 2px solid var(--primary-red);
            /* النص داخل الحقول داكن */
            color: var(--dark-text);
            border-radius: 0;
            padding: 15px;
            /* زيادة حجم الخط قليلاً في الحقول */
            font-size: 1.05rem;
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


        /* --- About Section --- */
        .about-section {
            padding: 100px 0;
            position: relative;
            /* استخدام الخلفية الفاتحة */
            background-color: var(--light-bg);
        }

        .about-img-box {
            position: relative;
            z-index: 1;
        }

        .about-img-box img {
            border-radius: 20px;
            /* تخفيف الـ grayscale قليلاً */
            filter: grayscale(40%);
            transition: 0.5s;
        }

        .about-img-box:hover img {
            filter: grayscale(0%);
        }

        /* إطار خلفي للصورة باللون الأحمر */
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

        /* --- Footer (دمج الموقع والمراسلة) --- */
        .footer {
            /* خلفية فاتحة جداً في التذييل */
            background: #e9ecef;
            padding-top: 80px;
            padding-bottom: 30px;
            border-top: 5px solid var(--primary-red);
            /* النص داخل التذييل داكن */
            color: var(--dark-text);
        }

        .footer h3,
        .footer h4 {
            color: var(--dark-text);
            font-weight: 700;
        }

        /* تنسيق الخريطة داخل التذييل */
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
            /* الأيقونات داكنة */
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
            .hero {
                /* ارتفاع متغير وأصغر على الأجهزة اللوحية */
                height: 70vh;
                min-height: 500px;
                /* تعديل محاذاة النص في الهيرو للأجهزة الأصغر */
                align-items: flex-end;
            }

            .hero-title {
                font-size: 3rem;
            }

            /* تعديل الـ margin-top لرفع الفورم على الأجهزة اللوحية */
            .search-form-container {
                margin-top: -20px;
            }

            .about-img-box {
                margin-bottom: 40px;
            }

            /* إخفاء حدود الإحصائيات (لم يتم إدراجها في الكود ولكن ترك التنسيق) */
            .stat-item {
                border-bottom: 4px solid var(--primary-red);
                border-right: none;
            }

            .row.g-0>div:last-child .stat-item {
                border-bottom: 4px solid var(--primary-red);
            }

            .row.g-0>div:nth-child(3n) .stat-item {
                border-right: none;
            }

        }

        @media (max-width: 768px) {
            .hero {
                /* ارتفاع متغير وأصغر على الهواتف */
                height: 60vh;
                min-height: 450px;
            }

            .hero-content {
                padding-top: 50px;
                /* زيادة padding-bottom لدفعه للأعلى قليلاً على الهواتف */
                padding-bottom: 60px;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            /* رفع الفورم بشكل أكبر على الهواتف */
            .search-form-container {
                margin-top: -10px;
                padding-top: 0;
            }

            .search-glass {
                padding: 20px;
                margin-top: 0;
            }

            /* إلغاء حدود الإحصائيات على الهواتف */
            .stat-item {
                border-right: none !important;
                border-bottom: 4px solid var(--primary-red);
            }

            .row.g-0>div:last-child .stat-item {
                border-bottom: none;
                /* إزالة الحد من آخر عنصر فقط */
            }

            .stat-item:hover {
                transform: translateY(-5px);
                /* تخفيف الحركة عند Hover على الهواتف */
            }

            .about-bg-accent {
                display: none;
            }

            .about-section .d-flex {
                flex-direction: column;
                align-items: flex-start !important;
            }

            .about-section .d-flex>div {
                margin-bottom: 15px;
                margin-right: 0 !important;
                margin-left: 0 !important;
                padding-right: 0 !important;
                padding-left: 15px !important;
                border-right: 3px solid var(--primary-red);
                border-left: none;
            }

            .footer-map {
                padding-bottom: 30px;
            }

            .footer .col-md-6:not(:last-child) {
                border-bottom: 1px dashed rgba(0, 0, 0, 0.1);
                padding-bottom: 25px !important;
                margin-bottom: 25px;
            }

        }

        /* -------------------------------------- */
        /* --- Responsive Enhancements (Mobile) --- */
        /* -------------------------------------- */

        /* تطبيق على الشاشات الصغيرة والمتوسطة (أقل من 992px) */
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                @if($data->logo)
                <img src="{{ asset($data->logo) }}" width="50" style="border-radius: 5px;">
                @else
                <i class="fas fa-crown text-danger"></i> {{ $data->name ?? 'Royal View' }}
                @endif
                <span> فنادق رومانس </span>

            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('website') }}">الرئيسية</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">القصة</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('hotels') }}">الفنادق</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">الموقع وتواصل</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fas fa-list-alt me-1"></i> أقسامنا
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i
                                        class="fas fa-book me-2 text-danger"></i> مقالات</a></li>
                            <!-- <li><a class="dropdown-item" href="#"><i
                                        class="fas fa-utensils me-2 text-danger"></i> المطاعم وتجارب الطعام</a></li>
                            <li><a class="dropdown-item" href="#"><i
                                        class="fas fa-spa me-2 text-danger"></i> المنتجع الصحي وخدمات السبا</a></li>
                            <li><a class="dropdown-item" href="#"><i
                                        class="fas fa-concierge-bell me-2 text-danger"></i> خدمات الكونسيرج الخاصة</a>
                            </li> -->
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
                        <!-- تسجيل الخروج GET -->
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
                        btn.addEventListener('click', function(e) {
                            e.stopPropagation();
                            menu.classList.toggle('show');
                        });

                        document.addEventListener('click', function() {
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
                        {{ $data->name ?? 'LUXURY' }} <br>
                        <span>ROMANCE HOTELS</span>
                    </h1>
                </div>
            </div>
        </div>
    </section>

  <div class="container-fluid py-0 search-form-container">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-12 mx-auto" data-aos="fade-up" data-aos-delay="300" data-aos-duration="1000">
                <div class="search-glass">
                    <h4 class="mb-4 text-center">خطط لإقامتك القادمة</h4>
                    <form>
                        <div class="row gy-3 gx-3 align-items-end">

                            <!-- اختيار الفندق -->
                          <div class="col-lg-3">
    <label class="small text-muted mb-1">اختر الفندق</label>

    <select class="form-control form-control-custom" name="hotel_id">
        <option value="">اختر الفندق</option>

        @foreach($hotels as $hotel)
            <option value="{{ $hotel->id }}">
                {{ $hotel->name }}
            </option>
        @endforeach

    </select>
</div>


                            <!-- تاريخ الوصول -->
                            <div class="col-lg-3">
                                <label class="small text-muted mb-1">الوصول</label>
                                <input type="date" class="form-control form-control-custom">
                            </div>

                            <!-- تاريخ المغادرة -->
                            <div class="col-lg-3">
                                <label class="small text-muted mb-1">المغادرة</label>
                                <input type="date" class="form-control form-control-custom">
                            </div>

                            <!-- عدد الغرف -->
                            <div class="col-lg-3">
                                <label class="small text-muted mb-1">عدد الغرف</label>
                                <input type="number" class="form-control form-control-custom" min="1" value="1">
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-luxury w-100 py-3">حجز</button>
                            </div>
                        </div>
                    </form>
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
                    <h2 class="display-5 fw-bold mb-4" style="color: var(--dark-text);">قصة من <span
                            style="color: var(--primary-red);">الشغف</span>
                        والتميز</h2>
                    <div class="text-muted mb-4 lead" style="line-height: 1.8; color: var(--dark-text) !important;">
                        {!! $data->textarea ?? 'تأسس فندق رويال فيو على مبادئ الضيافة الفاخرة والاهتمام بالتفاصيل. نحن نعدك بتجربة لا مثيل لها، حيث كل زاوية مصممة لراحتك المطلقة. منذ الافتتاح، ونحن نسعى لتقديم أعلى معايير الخدمة العالمية، مما جعلنا الخيار الأول للمسافرين المميزين.' !!}
                    </div>

                    <div class="d-flex align-items-center mt-4">
                        <div class="border-start border-danger border-3 ps-3 ms-3">
                            <h5 class="mb-0 fw-bold" style="color: var(--dark-text);">أفضل موقع</h5>
                            <small class="text-muted">مباشرة أمام الحرم</small>
                        </div>
                        <div class="border-start border-danger border-3 ps-3">
                            <h5 class="mb-0 fw-bold" style="color: var(--dark-text);">واي فاي</h5>
                            <small class="text-muted">عالي السرعة مجاني</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                    <div class="about-img-box tilt-element">
                        <div class="about-bg-accent"></div>
                        <img src="{{ asset($data->aboutImage ?? 'default-about.jpg') }}" class="img-fluid w-100 shadow-lg"
                            alt="About Us">
                    </div>
                </div>

            </div>
        </div>
    </section>


   <section class="hotels-section py-5" id="hotels">
    <div class="container">
        <h2 class="display-5 fw-bold text-center mb-5" style="color: var(--dark-text);">
            اكتشف فنادقنا المميزة
        </h2>

        <div class="row g-4">
            @foreach($hotels as $hotel)
            <div class="col-lg-3 col-md-6">
                <div class="card h-100 shadow-sm">
                    @if($hotel->image)
                        <img src="{{ asset($hotel->image) }}" class="card-img-top" alt="{{ $hotel->name }}"      style="width: 100%; height: 250px; object-fit: cover; object-position: center; border-radius: 8px;">

                        
                    @else
                        <img src="https://source.unsplash.com/400x300/?hotel" class="card-img-top" alt="{{ $hotel->name }}">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">{{ $hotel->name }}</h5>
                        <p class="text-muted mb-1"><i class="bi bi-geo-alt-fill"></i> {{ $hotel->address }}</p>
                        <p class="mb-1"><strong>عدد الغرف: {{ $hotel->rooms }}</strong></p>
                        <p class="mb-1"><strong>عدد الأسرة: {{ $hotel->beds }}</strong></p>
                        <p class="mb-2">⭐ {{ $hotel->rate }}</p>
                        <a href="#" class="btn btn-luxury mt-auto">عرض</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- زر عرض الكل أسفل العناصر -->
        <div class="text-center mt-4">
            <a href="{{ route('hotels') }}" class="btn btn-luxury btn-lg">
                عرض الكل
            </a>
        </div>
    </div>
</section>




    <footer class="footer" id="contact">
        <div class="container">
            <div class="row mb-5 footer-map">
                <div class="col-12 text-center mb-5" data-aos="fade-up">
                    <h2 class="display-5 fw-bold mb-2" style="color: var(--dark-text);">تفضل بزيارتنا </h2>
                </div>
                <div class="col-12" data-aos="fade-up" data-aos-delay="100">
                    <iframe
                        src="{{$data->location ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15334.821035210212!2d39.8166667!3d21.4225211!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15c21b21235b3f17%3A0x6b4a5d8f6f59b9c9!2z2KjYp9iz2YrYqSDYqtmE2Ykg2YjYutiv2YXYtNin2YUg2YjYstmK2LE!5e0!3m2!1sar!2ssa!4v1700742514457!5m2!1sar!2ssa'}}"
                        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
            <div class="row gy-5 pt-5 border-top border-secondary-subtle">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="0">
                    <h3 class="mb-4 fw-bold">{{ $data->name ?? 'Royal View' }}</h3>
                    <p class="text-muted">{{ $data->description ?? 'فندق رويال فيو، حيث الفخامة تلتقي بالتاريخ. إقامتك الملكية في قلب المدينة.' }}</p>
                    <div class="mt-4">
                        @if($data->faceLink) <a href="{{ $data->faceLink }}" class="social-circle"><i
                                class="fab fa-facebook-f"></i></a> @endif
                        @if($data->instaLink) <a href="{{ $data->instaLink }}" class="social-circle"><i
                                class="fab fa-instagram"></i></a> @endif
                        @if($data->wattsLink) <a href="{{ $data->wattsLink }}" class="social-circle"><i
                                class="fab fa-whatsapp"></i></a> @endif
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <h4 class="mb-4">معلومات التواصل</h4>
                    <ul class="list-unstyled text-muted">
                        <li class="mb-3"><i class="fas fa-map-marker-alt text-danger me-2"></i>
                            {{ $data->address ?? 'مكة المكرمة، المملكة العربية السعودية' }}
                        </li>
                        <li class="mb-3"><i class="fas fa-phone text-danger me-2"></i>
                            {{ $data->phone1 ?? '+966 50 123 4567' }}
                        </li>
                        <li class="mb-3"><i class="fas fa-phone text-danger me-2"></i>
                            {{ $data->phone2 ?? '+966 50 123 4567' }}
                        </li>
                        <li class="mb-3"><i class="fas fa-envelope text-danger me-2"></i>
                            {{ $data->email ?? 'info@royalview.com' }}
                        </li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12" data-aos="fade-up" data-aos-delay="400">
                    <h4 class="mb-4">روابط سريعة</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-muted text-decoration-none mb-2 d-block"><i class="fas fa-angle-left text-danger me-2"></i> الأسئلة الشائعة</a></li>
                        <li><a href="#" class="text-muted text-decoration-none mb-2 d-block"><i class="fas fa-angle-left text-danger me-2"></i> سياسة الخصوصية</a></li>
                        <li><a href="#" class="text-muted text-decoration-none mb-2 d-block"><i class="fas fa-angle-left text-danger me-2"></i> الشروط والأحكام</a></li>
                        <li><a href="#about" class="text-muted text-decoration-none mb-2 d-block"><i class="fas fa-angle-left text-danger me-2"></i> اكتشف قصتنا</a></li>
                    </ul>
                </div>

            </div>
            <hr class="border-secondary mt-5">
            <div class="text-center text-muted py-3">
                <small>
                    © {{ date('Y') }} {{ $data->name ?? 'Royal View' }}. جميع الحقوق محفوظة. تصميم:
                    <a href="https://wa.me/966560637609" target="_blank" style="text-decoration: none; color: inherit;">
                        Elegance
                    </a>
                </small>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.7.2/vanilla-tilt.min.js"></script>

    <script>
        // تهيئة مكتبة الأنيميشن
        AOS.init({
            offset: 100,
            duration: 800,
            easing: 'ease-in-out',
            once: true,
        });

        // تأثير 3D للصور والعناصر
        VanillaTilt.init(document.querySelectorAll(".tilt-element"), {
            max: 15,
            speed: 400,
            glare: true,
            "max-glare": 0.1,
            /* تم تخفيف الـ Glare ليتناسب مع الخلفية الفاتحة */
        });

        // تغيير النافبار عند السكرول (تم التعديل ليتناسب مع الوضع الفاتح)
        window.onscroll = function() {
            var navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                // عند النزول، اجعله أبيض بالكامل
                navbar.style.background = "rgba(255, 255, 255, 0.75)"; // زيادة العتامة قليلاً
                navbar.style.padding = "10px 0";
                navbar.style.boxShadow = "0 10px 30px rgba(0, 0, 0, 0.1)";
            } else {
                // في الأعلى، ابقيه شفافاً قليلاً فوق صورة الهيرو
                navbar.style.background = "rgba(255, 255, 255, 0.75)";
                navbar.style.padding = "20px 0";
                navbar.style.boxShadow = "none";
            }
        };
    </script>
</body>

</html>