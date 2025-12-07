<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>إنشاء حجز جديد</title>
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('website') }}">الرئيسية</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('website') }}#about">القصة</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('hotels') }}">الفنادق</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">إنشاء حجز جديد</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('website') }}#contact">الموقع وتواصل</a>
                    </li>
                   <li class="nav-item">
                        <a class="nav-link " href="{{ route('blogs') }}"
                            aria-expanded="false">
                            <i class="fas fa-list-alt me-1"></i> مقالات
                        </a>
                    </li>
                </ul>

                @php
                $user = auth()->user() ?? null; // تعيين متغير $user
                $has_available_rooms = false;
                if(isset($hotel->prices)) {
                foreach($hotel->prices as $room_info) {
                if(isset($room_info['roomAvailable']) && $room_info['roomAvailable'] > 0 && isset($room_info['price'])) {
                $has_available_rooms = true;
                break;
                }
                }
                }
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
                <div class="col-lg-12">
                    <div class="reservation-card" data-aos="fade-up" data-aos-duration="1000">
                        <h2 class="display-6 fw-bold text-center mb-5" style="color: var(--primary-red);">
                            <i class="fas fa-calendar-check me-2"></i> إنشاء حجز جديد
                        </h2>

                        @if(!$has_available_rooms)
                        <div class="alert alert-warning text-center p-5 border-warning border-3">
                            <h3 class="fw-bold text-danger mb-3"><i class="fas fa-exclamation-triangle me-2"></i> لا يمكن
                                الحجز حاليًا!</h3>
                            <p class="lead mb-0">نعتذر، لا يوجد غرف متاحة في فندق {{ $hotel->name ?? 'الفندق' }} في الوقت الحالي. يرجى مراجعة صفحة الفنادق واختيار فندق آخر.</p>
                        </div>
                        @else
                        <form method="get" action="{{ route('reservations.store.user') }}">
                            @csrf

                            <div class="alert alert-info text-center fw-bold mb-5 border-0 rounded-pill shadow-sm">
                                <i class="fas fa-hotel me-2"></i>
                                جاري الحجز في فندق: {{ $hotel->name ?? 'اسم الفندق غير متوفر' }}
                                <input type="hidden" name="hotel_id" value="{{ $hotel->id ?? '' }}">
                            </div>

                            <h4 class="mb-4 fw-bold border-bottom pb-2 " style="color: var(--primary-red);">
                                <i class="fas fa-user-circle me-2"></i> بيانات العميل
                            </h4>
                            <div class="row g-4 mb-5">

                                <div class="col-md-4">
                                    <label for="full_name" class="form-label-custom">الاسم الكامل <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-custom" id="full_name"
                                        name="full_name" value="{{ old('full_name', $user->name ?? '') }}" required>
                                    @error('full_name')<div class="text-danger mt-1 small">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="email" class="form-label-custom">البريد الإلكتروني <span
                                            class="text-danger">*</span></label>
                                    <input type="email" class="form-control form-control-custom" id="email"
                                        name="email" value="{{ old('email', $user->email ?? '') }}" required>
                                    @error('email')<div class="text-danger mt-1 small">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="phone" class="form-label-custom">رقم الهاتف <span
                                            class="text-danger">*</span></label>
                                    <input type="tel" class="form-control form-control-custom" id="phone" name="phone"
                                        value="{{ old('phone', $user->phone ?? '') }}" required>
                                    @error('phone')<div class="text-danger mt-1 small">{{ $message }}</div>@enderror
                                </div>

                            </div>

                            <h4 class="mb-4 fw-bold border-bottom pb-2 " style="color: var(--primary-red);">
                                <i class="fas fa-clock me-2"></i> تواريخ الإقامة
                            </h4>
                            <div class="row g-4 mb-5">

                                <div class="col-md-4">
                                    <label for="check_in_date" class="form-label-custom">تاريخ الوصول <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control form-control-custom" id="check_in_date"
                                        name="check_in_date" value="{{ $start }}" required>
                                    @error('check_in_date')<div class="text-danger mt-1 small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="check_out_date" class="form-label-custom">تاريخ المغادرة <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control form-control-custom" id="check_out_date"
                                        name="check_out_date" value="{{ $end }}" required>
                                    @error('check_out_date')<div class="text-danger mt-1 small">{{ $message }}</div>
                                    @enderror
                                </div>
                                @php
                                $startDate = \Carbon\Carbon::parse($start);
                                $endDate = \Carbon\Carbon::parse($end);
                                $defaultNights = $startDate->diffInDays($endDate);
                                if ($defaultNights == 0) $defaultNights = 1; // دايماً ليلة على الأقل
                                @endphp

                                <div class="col-md-4">
                                    <label for="number_of_nights" class="form-label-custom">عدد الليالي <span
                                            class="text-danger">*</span></label>
                                    <input type="number"
                                        class="form-control form-control-custom"
                                        id="number_of_nights"
                                        name="number_of_nights"
                                        value="{{ old('number_of_nights', $defaultNights) }}"
                                        min="1"
                                        required>

                                    @error('number_of_nights')<div class="text-danger mt-1 small">{{ $message }}</div>@enderror
                                </div>
                            </div>


                            <h4 class="fw-bold mb-4 border-bottom pb-2 " style="color: var(--primary-red);">
                                <i class="fas fa-bed me-2"></i> اختيار الغرف
                            </h4>
                            <div class="row g-4 mb-4 justify-content-center ">
                                @foreach( $hotel->prices as $beds => $room_info)
                                @if(isset($room_info['roomAvailable']) && $room_info['roomAvailable'] > 0 && isset($room_info['price']))
                                @php
                                $room_label = $room_info['label'] ?? (($beds == 0)
                                ? 'غرفة كينج (1 سرير)'
                                : "غرفة " . ($beds + 1) . " أسرة");
                                @endphp

                                <div class="col-lg-3 col-md-6 mb-3">
                                    <label class="form-label-custom fw-bold">{{ $room_label }}</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control form-control-custom rooms-input text-center"
                                            name="rooms[{{ $beds }}][count]" min="0" max="{{ $room_info['roomAvailable'] }}"
                                            data-price="{{ $room_info['price'] }}" placeholder="عدد الغرف"
                                            value="{{ old("rooms.$beds.count", 0) }}"
                                            style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                                        <span class="input-group-text small"
                                            style="background-color: #e9ecef; color: var(--text-light); border-color: #ced4da;">
                                            {{ $room_info['price'] }} / ليلة
                                        </span>
                                        <input type="hidden" name="rooms[{{ $beds }}][beds]" value="{{ $beds }}">
                                    </div>
                                    <small class="text-info d-block mt-1">المتاح: {{ $room_info['roomAvailable'] }}</small>
                                </div>
                                @endif
                                @endforeach
                            </div>

                            <div class="col-12 mt-5">
                                <div class="bg-light p-4 rounded border border-success border-3 text-center shadow-sm">
                                    <h4 class="mb-0 fw-bold">
                                        الإجمالي الكلي المتوقع: <span id="total_reservation_price"
                                            class="text-success display-6 fw-bolder">0.00</span> ريال/عملة
                                        <input type="hidden" name="total_price" id="hidden_total_price" value="0">
                                    </h4>
                                    <small class="text-muted d-block mt-1">يتم احتساب السعر بناءً على عدد الليالي والغرف
                                        المختارة.</small>
                                </div>
                            </div>

                            <div class="col-12 mt-5">
                                <button type="submit" class="btn btn-luxury w-100 py-3">
                                    <i class="fas fa-concierge-bell me-2"></i> تأكيد الحجز
                                </button>
                            </div>

                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>



    @include('footer')
</body>

</html>