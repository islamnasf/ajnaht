<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>رويال فيو | إنشاء حجز جديد</title>
    <link rel="icon" type="image/png" href="{{ asset($data->logo ?? 'default-logo.png') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
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

        body {
  font-family: "IBM Plex Sans Arabic", sans-serif;
              background-color: var(--light-bg);
            color: var(--dark-text);
            overflow-x: hidden;
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

        /* لا تغيير على الأزرار لأنها تستخدم ألوان العلامة التجارية */
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
        
        /* تنسيق خاص لإضافة الـForm */
        .reservation-section {
            padding: 120px 0 80px; /* ترويسة علوية أكبر لتعويض الـHero */
            background-color: var(--light-bg);
            min-height: 80vh;
        }

        .reservation-card {
            background-color: var(--card-bg);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }
        
        .form-control-custom {
            /* نفس تنسيق الـForm في الصفحة الرئيسية */
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid #ced4da; /* إضافة حد خفيف */
            border-bottom: 2px solid var(--primary-red);
            color: var(--dark-text);
            border-radius: 5px;
            padding: 15px;
            font-size: 1.05rem;
        }

        .form-control-custom:focus {
            background: rgba(255, 255, 255, 1);
            color: var(--dark-text);
            box-shadow: none;
            border-color: var(--gold);
        }
        
        .form-label-custom {
            font-weight: 700;
            color: var(--dark-text);
            margin-bottom: 8px;
        }
        
        /* تلوين رسالة الخطأ */
        .text-danger {
            color: var(--primary-red) !important;
        }
        /* كود الـDropdown الخاص بالـUser */
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

        /* --- Footer Styles (كما هي) --- */
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('website') }}">الرئيسية</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('website') }}#about">القصة</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('hotels') }}">الفنادق</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">إنشاء حجز جديد</a></li> 
                    <li class="nav-item"><a class="nav-link" href="{{ route('website') }}#contact">الموقع وتواصل</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fas fa-list-alt me-1"></i> أقسامنا
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i
                                        class="fas fa-book me-2 text-danger"></i> مقالات</a></li>
                        </ul>
                    </li>
                </ul>
                
                @php
                $user = auth()->user() ?? null; // تعيين متغير $user
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
        // كود JavaScript الخاص بالـUser Dropdown
        document.addEventListener('DOMContentLoaded', () => {
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
        });
    </script>


    <section class="reservation-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="reservation-card" data-aos="fade-up" data-aos-duration="1000">
                        <h2 class="display-6 fw-bold text-center mb-5" style="color: var(--primary-red);">
                            <i class="fas fa-calendar-check me-2"></i> إنشاء حجز جديد
                        </h2>

                        <form method="POST" action="{{ route('reservations.store') }}">
                            @csrf <h4 class="mb-4 fw-bold border-bottom pb-2">بيانات الإقامة</h4>
                            <div class="row g-4 mb-4">
                                
                                <div class="col-md-6">
                                    <label for="hotel_id" class="form-label-custom">اختر الفندق <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-custom" id="hotel_id" name="hotel_id" required>
                                            <option value="{{ $hotel->id }}" {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>
                                                {{ $hotel->name }}
                                            </option>
                                    </select>
                                    @error('hotel_id')<div class="text-danger mt-1 small">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="room_type" class="form-label-custom">نوع الغرفة <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-custom" id="room_type" name="room_type" required>
                                        <option value="">-- يرجى الاختيار --</option>
                                        <option value="single" {{ old('room_type') == 'single' ? 'selected' : '' }}>غرفة فردية</option>
                                        <option value="double" {{ old('room_type') == 'double' ? 'selected' : '' }}>غرفة مزدوجة</option>
                                        <option value="suite" {{ old('room_type') == 'suite' ? 'selected' : '' }}>جناح فاخر</option>
                                    </select>
                                    @error('room_type')<div class="text-danger mt-1 small">{{ $message }}</div>@enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="check_in_date" class="form-label-custom">تاريخ الوصول <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control form-control-custom" id="check_in_date" name="check_in_date" value="{{ old('check_in_date') }}" required>
                                    @error('check_in_date')<div class="text-danger mt-1 small">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="check_out_date" class="form-label-custom">تاريخ المغادرة <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control form-control-custom" id="check_out_date" name="check_out_date" value="{{ old('check_out_date') }}" required>
                                    @error('check_out_date')<div class="text-danger mt-1 small">{{ $message }}</div>@enderror
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="rooms_count" class="form-label-custom">عدد الغرف <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control form-control-custom" id="rooms_count" name="rooms_count" min="1" value="{{ old('rooms_count', 1) }}" required>
                                    @error('rooms_count')<div class="text-danger mt-1 small">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="adults_count" class="form-label-custom">عدد البالغين <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control form-control-custom" id="adults_count" name="adults_count" min="1" value="{{ old('adults_count', 1) }}" required>
                                    @error('adults_count')<div class="text-danger mt-1 small">{{ $message }}</div>@enderror
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="children_count" class="form-label-custom">عدد الأطفال</label>
                                    <input type="number" class="form-control form-control-custom" id="children_count" name="children_count" min="0" value="{{ old('children_count', 0) }}">
                                    @error('children_count')<div class="text-danger mt-1 small">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            
                            <h4 class="mb-4 fw-bold border-bottom pb-2">بيانات العميل</h4>
                            <div class="row g-4">
                                
                                <div class="col-md-6">
                                    <label for="full_name" class="form-label-custom">الاسم الكامل <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-custom" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                                    @error('full_name')<div class="text-danger mt-1 small">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label-custom">البريد الإلكتروني <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control form-control-custom" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
                                    @error('email')<div class="text-danger mt-1 small">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="phone" class="form-label-custom">رقم الهاتف <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control form-control-custom" id="phone" name="phone" value="{{ old('phone') }}" required>
                                    @error('phone')<div class="text-danger mt-1 small">{{ $message }}</div>@enderror
                                </div>
                                
                            
                            </div>

                            <div class="col-12 mt-5">
                                <button type="submit" class="btn btn-luxury w-100 py-3">
                                    <i class="fas fa-concierge-bell me-2"></i> تأكيد الحجز
                                </button>
                            </div>

                        </form>
                        </div>
                </div>
            </div>
        </div>
    </section>
@include('footer')
</body>
</html>