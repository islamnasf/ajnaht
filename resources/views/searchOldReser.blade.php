<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>حجوزاتي -  ROMANCE HOTELS</title>
    {{-- لاحظ أن هذا المسار يحتاج إلى تعريف متغير $data في Laravel --}}
    <link rel="icon" type="image/png" href="{{ asset($data->logo ?? 'default-logo.png') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    

    <style>
        :root {
            --primary-red: #c6842f; /* اللون الرئيسي (تم الاحتفاظ به) */
            --primary-gradient: linear-gradient(135deg, #c6842f 0%, #d8963f 100%);
            --gold: #D4AF37;
            --light-bg: #f8f8f8;
            --dark-text: #212529;
            --card-bg: #ffffff;
            --text-light: #495057;
        }

        body {
            font-family: "IBM Plex Sans Arabic", sans-serif;
            background-color: var(--light-bg);
            color: var(--dark-text);
            overflow-x: hidden;
        }

        /* --- Scrollbar & Selection --- (الاحتفاظ بالكود الأصلي) */
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

        /* --- Navbar Styles --- (الاحتفاظ بالكود الأصلي) */
        .navbar {
            background-color: rgba(255, 255, 255, 0.75);
            padding: 10px 0;
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            transition: all 0.4s ease;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 50px 50px rgba(0, 0, 0, 0.05);
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
            padding: 10px 20px;
            transition: background-color 0.2s, color 0.2s;
            font-weight: 500;
        }

        .navbar-nav .dropdown-item:hover,
        .navbar-nav .dropdown-item:active {
            background-color: var(--primary-red);
            color: white;
        }

        /* --- Button Styles --- (الاحتفاظ بالكود الأصلي) */
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


        /* --- User Dropdown Styles --- (الاحتفاظ بالكود الأصلي) */
        .user-dropdown {
            position: relative;
        }

        .user-dropdown .menu {
            display: none;
            position: absolute;
            left: 0;
            /* Align right for RTL */
            right: auto;
            top: 100%;
            background-color: var(--card-bg);
            min-width: 160px;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
            z-index: 1000;
            border-radius: 8px;
            overflow: hidden;
            margin-top: 5px;
        }

        .user-dropdown .menu.show {
            display: block;
        }

        .user-dropdown .menu button {
            color: var(--dark-text);
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            border: none;
            background: none;
            width: 100%;
            text-align: right;
            transition: background-color 0.3s;
            font-weight: 500;
        }

        .user-dropdown .menu button:hover {
            background-color: var(--light-bg);
            color: var(--primary-red);
        }

        /* 🌟🌟🌟 تحسين أنماط الجدول للتجاوب والتناسق 🌟🌟🌟 */
        .custom-table-container {
            background: var(--card-bg); /* خلفية البطاقة */
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid #dee2e6;
        }
        
        /* Table Header Styling */
        .table thead {
            background-color: var(--primary-gradient); /* استخدام اللون الأساسي للهيدر */
        }
        
        .table thead th {
            font-weight: 700;
            border: none;
            padding: 15px;
            color: #212529; /* نص أبيض ليتناسب مع الخلفية الأساسية */
            white-space: nowrap;
        }

        /* Table Body Styling */
        .table td {
            vertical-align: middle;
            padding: 15px;
            border-bottom: 1px solid #e9ecef; /* خطوط فاصلة فاتحة */
            color: var(--dark-text);
            font-weight: 500;
            font-size: 0.95rem;
        }

        .table tbody tr:hover {
            background-color: #c6842f; /* لون خفيف عند التحويم */
            color: var(--dark-text);
        }
        
        .total-price-table {
            font-size: 1.1rem;
            font-weight: 700;
            color: #28a745; /* لون مميز للسعر (مثل الأخضر) */
        }
        
        .user-info-cell {
            font-weight: 600;
        }
        
        .text-primary-red {
            color: var(--primary-red);
        }

        /* التجاوب: إخفاء بعض الأعمدة على الشاشات الصغيرة لتحسين العرض */
        @media (max-width: 768px) {
            .table thead th:nth-child(3), /* تاريخ الوصول */
            .table tbody td:nth-child(3),
            .table thead th:nth-child(4), /* عدد الليالي والغرف */
            .table tbody td:nth-child(4) {
                display: none;
            }
        }
        /* 🌟🌟🌟 نهاية تحسين أنماط الجدول 🌟🌟🌟 */

        /* --- Modal Styles (Final) --- (الاحتفاظ بالكود الأصلي وتعديل بعض الألوان) */
        .modal-reservation-details {
            background-color: #f8f9fa; 
            padding: 20px;
            border-radius: 10px;
        }

        .modal-reservation-details h5 {
            color: var(--primary-red);
            border-bottom: 2px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        
        .modal-header.text-white {
            background-color: var(--primary-red) !important;
        }

        .modal-reservation-details .list-group-item {
            font-size: 1rem;
            padding: 10px 15px;
            border: none;
            border-bottom: 1px dotted #e9ecef;
        }
        
        .modal-reservation-details .list-group-item i {
            width: 25px;
            text-align: center;
            color: var(--primary-red);
        }
        
        .modal-footer button {
            transition: background-color 0.3s;
        }

        /* --- Empty State --- (الاحتفاظ بالكود الأصلي) */
        .empty-state {
            padding: 50px 20px;
            background-color: var(--card-bg);
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin-top: 50px;
        }
        
        /* --- Footer Styles --- (الاحتفاظ بالكود الأصلي) */
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
    </style>

</head>

<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                @if($data->logo ?? false)
                <img src="{{ asset($data->logo) }}" width="190" style="border-radius: 5px;">
                @else
                <i class="fas fa-crown text-primary-red"></i> {{ $data->name ?? 'Royal View' }}
                @endif
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('website') }}">الرئيسية</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('website') }}#about">القصة</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('hotels') }}">الفنادق</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">حجوزاتي</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('website') }}#contact">الموقع وتواصل</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fas fa-list-alt me-1"></i> أقسامنا
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i
                                        class="fas fa-book me-2 text-primary-red"></i> مقالات</a></li>
                        </ul>
                    </li>
                </ul>

                @php
                $user = auth()->user() ?? null;
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
                        {{-- يمكنك إضافة رابط لصفحة الملف الشخصي هنا --}}
                        <form method="get" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">تسجيل الخروج</button>
                        </form>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>


    {{-- Reservations Section (TABLE Layout) --}}
    <div class="container" style="padding-top: 120px; padding-bottom: 50px;">
        <h2 class="text-center mb-5" data-aos="fade-down">
            <i class="fas fa-table me-2" style="color: var(--primary-red);"></i> سجل الحجوزات
        </h2>

        {{-- مثال على متغيرات Laravel: يجب أن يكون $reservations موجوداً ومحمل بالبيانات --}}
        @if(empty($reservations) || (is_countable($reservations) && count($reservations) === 0))
        {{-- Empty State Message --}}
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="empty-state text-center" data-aos="zoom-in">
                    <i class="fas fa-bed fa-5x mb-3" style="color: #adb5bd;"></i>
                    <h4 class="mb-3">عفواً، لا توجد حجوزات مسجلة حاليًا.</h4>
                    <p class="text-muted mb-4">يمكنك البدء بإنشاء حجز جديد لاكتشاف فنادقنا الفاخرة.</p>
                    <a href="{{ route('hotels') }}" class="btn btn-luxury">
                        <i class="fas fa-plus me-1"></i> ابدأ حجزك الآن
                    </a>
                </div>
            </div>
        </div>
        @else
        {{-- Reservations Table Structure --}}
        <div class="custom-table-container" data-aos="fade-up">
            {{-- **ملاحظة:** تم استخدام .table-responsive-md لإظهار شريط التمرير الأفقي فقط على الشاشات الأصغر من المتوسط (md) --}}
            <div class="table-responsive-md">
                <table class="table mb-0 table-hover align-middle">
                    <thead>
                        <tr>
                             <th>رقم الحجز </th>
                            <th>النزيل </th>
                            <th>الفندق</th>
                            <th>الإجمالي</th>
                            <th>الحالة</th>
                            <th class="text-center">تفاصيل</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $index => $res)
                        @php
                        $duration = \Carbon\Carbon::parse($res->start)->diffInDays(\Carbon\Carbon::parse($res->end));
                        
                        // تحديد حالة الحجز واللون
                        $status = $res->status ?? 'غير مؤكد';
                        $statusText = match($status) {
                            'مؤكد' => 'مؤكد',
                            'cancelled' => 'ملغى',
                            default => 'غير مؤكد',
                        };
                        $statusClass = match($status) {
                            'مؤكد' => 'bg-success',
                            'cancelled' => 'bg-danger',
                            'غير مؤكد' => 'bg-warning text-dark',
                            default => 'bg-secondary',
                        };
                        @endphp
                        <tr>
                           {{-- النزيل والفئة --}}
                            <td class="user-info-cell">
                                <div class="d-flex align-items-center">
                                         # {{ $res->id }}  
                    
                                </div>
                            </td>
                            {{-- النزيل والفئة --}}
                            <td class="user-info-cell">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user-circle me-2 text-primary-red"></i>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $res->client }}</div>
                                  
                                    </div>
                                </div>
                            </td>

                           

                            {{-- المدة والغرف (مخفي على الجوال) --}}
                            <td class="d-md-table-cell">
                                                                        <div class="text-dark">{{ $res->category->name ?? 'غير محدد' }}</div>
    </td>

                            {{-- السعر الإجمالي --}}
                            <td class="total-price-table">
                                {{ number_format($res->total, 2) }} <small class="text-muted">ريال</small>
                            </td>

                            {{-- الحالة --}}
                            <td>
                                <span class="badge rounded-pill {{ $statusClass }} px-3 py-2">
                                    {{ $statusText }}
                                </span>
                            </td>

                            {{-- الإجراءات --}}
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-outline-secondary" 
                                        style="border-color: var(--primary-red); color: var(--primary-red);"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#detailsModal{{$res->id}}">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Modals Section (يتم وضعها خارج نطاق الجدول لضمان عرضها بشكل سليم) --}}
        
        @foreach($reservations as $index => $res)
        @php
        // إعادة تعريف المتغيرات للاستخدام داخل المودال
        $duration = \Carbon\Carbon::parse($res->start)->diffInDays(\Carbon\Carbon::parse($res->end));
        $status = $res->status ?? 'غير مؤكد';
        $statusText = match($status) {
            'مؤكد' => 'مؤكد',
            'cancelled' => 'ملغى',
            default => 'غير مؤكد',
        };
        $statusClass = match($status) {
            'مؤكد' => 'bg-success',
            'cancelled' => 'bg-danger',
            'غير مؤكد' => 'bg-warning text-dark',
            default => 'bg-secondary',
        };
        @endphp
        
        <div class="modal fade" id="detailsModal{{$res->id}}" tabindex="-1"
            aria-labelledby="detailsModalLabel{{$res->id}}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    {{-- استخدام primary-red للهيدر --}}
                    <div class="modal-header text-white" style="background-color: var(--primary-red) !important;">
                        <h5 class="modal-title" id="detailsModalLabel{{$res->id}}">تفاصيل الحجز رقم #{{ $index + 1 }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="reservationContent{{$res->id}}" class="modal-reservation-details">
                            <h4 class="text-center mb-4" style="color: var(--dark-text);">
                                <i class="fas fa-scroll me-2"></i> ملخص الحجز الكامل
                            </h4>
                            
                            {{-- 1. بيانات الحجز الأساسية --}}
                            <h5><i class="fas fa-id-card me-2"></i> بيانات العميل والحجز</h5>
                            <ul class="list-group list-group-flush mb-4">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span><i class="fas fa-user me-2"></i> النزيل:</span>
                                    <span class="fw-bold">{{ $res->client }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span><i class="fas fa-phone-alt me-2"></i> الهاتف:</span>
                                    <span>{{ $res->phone }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span><i class="fas fa-envelope me-2"></i> الإيميل:</span>
                                    <span>{{ $res->email }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span><i class="fas fa-calendar-alt me-2"></i> مدة الإقامة:</span>
                                    <span>من {{ $res->start }} إلى {{ $res->end }} (<span class="text-info">{{ $duration }}</span> ليالي)</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span><i class="fas fa-building me-2"></i>فئة الحجز:</span>
                                    <span class="fw-bold">{{ $res->category->name ?? 'غير محدد' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between bg-light">
                                    <span><i class="fas fa-info-circle me-2"></i> الحالة:</span>
                                    <span class="badge {{ $statusClass }} text-white p-2">{{ $statusText }}</span>
                                </li>
                            </ul>

                            @if(!empty($res->details) && count($res->details) > 0)
                            {{-- 2. تفاصيل الغرف المحجوزة --}}
                            <h5><i class="fas fa-bed me-2"></i> تفاصيل الغرف</h5>
                            <div class="row">
                                @foreach($res->details as $detail)
                                @php
                                $roomType = match($detail->type) {
                                    "1" => 'كينج (سرير مزدوج كبير)',
                                    "2" => '2 سرير (سريرين منفردين)',
                                    "3" => '3 سرير (3 أسرة منفردة)',
                                    "4" => '4 سرير (4 أسرة منفردة)',
                                    "5" => '5 سرير (5 أسرة منفردة)',
                                    default => $detail->type,
                                };
                                $colorClass = match($detail->type % 5) {
                                    0 => 'border-primary',
                                    1 => 'border-success',
                                    2 => 'border-info',
                                    3 => 'border-warning',
                                    4 => 'border-danger',
                                    default => 'border-secondary',
                                };
                                @endphp
                                <div class="col-md-6 mb-3">
                                    <div class="card shadow-sm border-2 {{ $colorClass }}">
                                        <div class="card-header bg-light">
                                            <h6 class="mb-0 text-dark fw-bold">نوع الغرف: {{ $roomType }}</h6>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                <span class="text-muted">عدد الغرف المطلوبة:</span>
                                                <span class="badge bg-info text-white">{{ $detail->count }}</span>
                                            </li>
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                <span class="text-muted">سعر الغرفة/الليلة:</span>
                                                <span class="text-success font-weight-bold">{{ number_format($detail->price, 2) }} ريال</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="alert alert-warning text-center" role="alert">
                                لا توجد تفاصيل غرف مسجلة لهذا الحجز.
                            </div>
                            @endif
                            
                            {{-- 3. الإجمالي النهائي --}}
                            <div class="text-center mt-4 p-3 border rounded" style="background-color: #fcece0;">
                                <p class="mb-1 text-muted">الإجمالي الكلي للحجز</p>
                                <h3 class="total-price text-success">{{ number_format($res->total,2) }} ريال</h3>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        {{-- End Modals Section --}}

        @endif
    </div>

    {{-- Footer Inclusion (افترض وجود ملف footer.blade.php) --}}
     @include('footer') 
    {{-- (تم حذف الكود المضمن للملخص والاحتفاظ بـ <script>) --}}


    {{-- Bootstrap JS (Required for Modals and Navbar Toggle) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    {{-- AOS JS --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800, // global duration for animations
            once: true // animations only happen once
        });

        // User Dropdown (Original Logic)
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('userBtn');
            const menu = document.getElementById('userMenu');

            if (btn && menu) {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    menu.classList.toggle('show');
                });

                document.addEventListener('click', function(e) {
                    if (!btn.contains(e.target) && !menu.contains(e.target)) {
                        menu.classList.remove('show');
                    }
                });
            }
        });

   
    </script>
</body>
</html>