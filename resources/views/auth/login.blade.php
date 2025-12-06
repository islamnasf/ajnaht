<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول / تسجيل جديد</title>
    
    <link
        href="https://fonts.googleapis.com/css2?family=Amiri:wght@300;500;700;900&display=swap"
        rel="stylesheet">
    <link 
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap" 
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


    <style>
        /*
        ====================================
                 CSS كامل ومحدث
           تصميم Modern & Premium Form
        ====================================
        */

        /* === متغيرات الألوان الجديدة (تم الاحتفاظ بها) === */
        :root {
            --primary-red: #c6842f; /* اللون الأساسي (الذهبي/البرونزي) */
            --primary-gradient: linear-gradient(135deg, #d4af37 0%, #c6842f 100%); /* تم عكس التدرج لبروز الذهبي الفاتح أولاً */
            --gold: #D4AF37;
            --light-bg: #f5f5f5; /* لون خلفية أفتح وأكثر هدوءًا */
            --dark-text: #212529;
            --card-bg: #ffffff;
            --text-light: #6c757d; /* لون نص فاتح أكثر احترافية */
            --input-bg: #fcfcfc; /* لون خلفية حقل الإدخال */
            --border-color: #e0e0e0;
        }

        body {
            font-family: "IBM Plex Sans Arabic", sans-serif;
            background-color: var(--light-bg);
            margin: 0;
            padding-top: 80px;
            color: var(--dark-text);
            direction: rtl;
            overflow-x: hidden;
        }

        /* === تنسيقات شريط التنقل (Navbar) === */
        .navbar {
            background-color: rgba(255, 255, 255, 0.98); /* أكثر عتامة قليلاً */
            padding: 10px 0;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            transition: all 0.4s ease;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08); /* ظل أقوى قليلاً */
            z-index: 1030;
            position: fixed;
            top: 0;
            width: 100%;
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
            height: 3px;
            bottom: -5px;
            right: 0;
            background-color: var(--primary-red);
            transition: width 0.3s;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* تنسيقات Dropdown Menu */
        .navbar-nav .dropdown-menu {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            background-color: var(--card-bg);
            padding: 0;
        }

        .navbar-nav .dropdown-item {
            color: var(--dark-text);
            padding: 10px 20px;
            transition: background-color 0.2s, color 0.2s;
            font-weight: 500;
        }

        .navbar-nav .dropdown-item:hover {
            background-color: var(--primary-red);
            color: white;
        }

        /* === تنسيقات حاوية تسجيل الدخول/التسجيل (Container) - تحديث === */
        .auth-container {
            max-width: 550px;
            margin: 60px auto;
            background-color: transparent;
        }

        .auth-card {
            background-color: var(--card-bg);
            padding: 40px;
            border-radius: 24px; /* زوايا أكثر استدارة وفخامة */
            /* تغيير الظل: استخدام ظل متوهج ناعم بدلاً من الشريط العلوي الصلب */
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.07), 0 0 0 1px rgba(0, 0, 0, 0.05);
            border-top: none; /* إزالة الشريط الصلب */
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .auth-card:hover {
            /* زيادة الظل قليلاً عند التمرير */
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.1), 0 0 0 1px rgba(0, 0, 0, 0.08);
        }

        h2 {
            font-family: "IBM Plex Sans Arabic", sans-serif; /* أفضل للتناسق */
            font-weight: 800 !important; /* جعله أسمك */
            color: var(--primary-red) !important;
            margin-bottom: 35px;
            font-size: 2.3rem;
            text-align: center;
            border-bottom: none;
            padding-bottom: 0;
            letter-spacing: -0.5px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        /* تحسين تسمية الحقل (Label) */
        .form-group label {
            display: block;
            font-size: 1rem;
            margin-bottom: 6px; /* تقليل المسافة للتقرب من الحقل */
            color: var(--dark-text);
            font-weight: 500; /* أقل سمكاً (Modern Look) */
            text-align: right;
        }

        /* === حقول الإدخال (Inputs) - التحديث الأهم === */
        .form-group input {
            width: 100%;
            /* تباعد داخلي: قلل اليمين قليلاً ليكون النص أقرب للحافة قليلاً */
            padding: 14px 18px 14px 50px; /* تباعد أكبر لجهة اليسار للأيقونة */
            border-radius: 12px; /* زوايا أكثر استدارة قليلاً */
            border: 1px solid var(--border-color); /* إطار أرق (1px) لإحساس أكثر نظافة */
            background-color: var(--input-bg);
            box-sizing: border-box;
            font-size: 1.05rem;
            transition: border-color 0.3s, box-shadow 0.3s, background-color 0.3s;
            text-align: right;
            font-family: inherit;
            color: var(--dark-text);
        }

        .form-group input:focus {
            border-color: var(--primary-red);
            /* تغيير ظل الانتشار (box-shadow) ليكون أرق وأكثر دقة */
            box-shadow: 0 0 0 2px rgba(198, 132, 47, 0.4);
            outline: none;
            background-color: var(--card-bg); /* إضاءة الخلفية عند التركيز */
        }

        /* تنسيق الأيقونات داخل حقول الإدخال (تم تعديل الموضع) */
        .form-group .input-icon {
            position: absolute;
            left: 18px; /* وضع الأيقونة على اليسار */
            top: 50%; /* استخدام النسبة المئوية للتمركز الرأسي */
            transform: translateY(2px); /* تصحيح طفيف للوسط */
            color: var(--text-light);
            font-size: 1.2rem; /* أيقونة أكبر قليلاً */
            pointer-events: none;
            transition: color 0.3s;
        }

        .form-group input:focus ~ .input-icon { /* استخدام ~ بدلاً من + للسماح بوجود عناصر أخرى (مثل رسالة الخطأ) بينهما */
            color: var(--primary-red);
        }

        /* تنسيق زر "حفظ البيانات" (Checkbox) */
        .form-group input[type="checkbox"] {
            margin-left: 8px;
            margin-right: 0;
            vertical-align: middle;
            accent-color: var(--primary-red);
            width: auto;
            padding: 0;
            border-radius: 4px;
            border: 1px solid var(--text-light);
        }

        .form-group label[for="remember_me"] {
            display: inline;
            font-size: 1rem;
            color: var(--text-light);
            font-weight: 400;
        }

        .form-group .error {
            color: var(--primary-red);
            font-size: 1rem;
            display: block;
            margin-top: 5px;
            text-align: right;
        }

        /* === تنسيقات أزرار التبديل (Toggle) - تحديث جذري ومظهر أملس === */
        .toggle-buttons {
            display: flex;
            margin-bottom: 30px;
            border-radius: 12px;
            overflow: hidden;
            background-color: var(--border-color); /* خلفية أرق وأكثر نظافة */
            padding: 3px; /* تباعد داخلي أقل */
            box-shadow: none; /* إزالة الظل الداخلي */
        }

        .toggle-button {
            flex-grow: 1;
            padding: 12px 10px; /* تقليل الارتفاع قليلاً */
            border: none;
            background-color: transparent;
            color: var(--dark-text);
            font-size: 1.05rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            border-radius: 10px;
        }

        .toggle-button:hover:not(.active) {
            background-color: rgba(198, 132, 47, 0.1);
            color: var(--primary-red);
        }

        .toggle-button.active {
            background: var(--primary-gradient);
            color: white;
            /* ظل خارجي للزر النشط بتأثير أهدأ */
            box-shadow: 0 2px 10px rgba(198, 132, 47, 0.2);
        }

        /* تنسيقات الأزرار الفاخرة (تم تحسينها) */
        .btn-luxury {
            background: var(--primary-gradient);
            color: #fff;
            border: none;
            padding: 16px 30px; /* زيادة ارتفاع الزر قليلاً */
            border-radius: 35px;
            font-weight: 700;
            letter-spacing: 0.5px; /* تباعد أحرف أقل */
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
            width: 100%;
            font-size: 1.25rem; /* حجم خط أحدث */
            font-family: inherit;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            /* تحسين الظل ليعطي إحساساً بالتوهج اللطيف */
            box-shadow: 0 10px 30px rgba(198, 132, 47, 0.35);
        }

        .btn-luxury:hover {
            transform: translateY(-5px); /* رفع الزر أكثر لزيادة التفاعل */
            box-shadow: 0 15px 45px rgba(198, 132, 47, 0.6);
        }

        /* تأثير التمرير للزر الفاخر (تم تعديله) */
        .btn-luxury::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            z-index: -1;
            transition: transform 0.6s ease;
            transform: scaleX(0);
            transform-origin: left;
        }

        .btn-luxury:hover::before {
            transform: scaleX(1);
        }

        /* تنسيق الروابط داخل الفورم */
        .auth-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
        }

        .auth-actions a {
            color: var(--text-light);
            font-size: 1rem;
            text-decoration: none;
            transition: color 0.3s;
        }

        .auth-actions a:hover {
            color: var(--primary-red);
        }

        /* إخفاء النماذج بشكل مبدئي */
        #login-form, #register-form {
            display: none;
            /* إضافة تأثير حركة لظهور النماذج */
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* إظهار النموذج النشط */
        .form-active {
            display: block !important;
        }

        /* تنسيق أسفل النموذج في التسجيل */
        .register-bottom-link {
            text-align: center;
            margin-top: 20px;
            font-size: 0.95rem;
        }
        
        /* تعديل الموضع الرأسي للأيقونات في الهواتف */
        @media only screen and (max-width: 600px) {
            body {
                padding-top: 70px;
            }
            .auth-container {
                max-width: 100%;
                margin: 20px 10px;
            }
            .auth-card {
                padding: 25px; /* زيادة طفيفة */
                border-radius: 18px;
            }
            h2 {
                font-size: 1.8rem;
            }
            .toggle-buttons {
                padding: 3px;
                border-radius: 10px;
            }
            .toggle-button {
                padding: 10px 8px;
                font-size: 0.95rem;
            }
            .btn-luxury {
                font-size: 1.1rem;
                padding: 12px 20px;
            }
            .form-group input {
                padding: 12px 15px 12px 45px; /* تعديل مساحة الأيقونة */
                font-size: 1rem;
            }
            .form-group .input-icon {
                left: 12px;
                top: 50%;
                transform: translateY(2px);
                font-size: 1.1rem;
            }
            .form-group label {
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('website') }}">
                @if(isset($data->logo))
                <img src="{{ asset($data->logo) }}" width="190" style="border-radius: 5px;" alt="الشعار">
                @else
                <i class="fas fa-crown" style="color: var(--primary-red);"></i> {{ $data->name ?? 'Royal View' }}
                @endif
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('website') }}">الرئيسية</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('website') }}#about">القصة</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('hotels') }}">الفنادق</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">تسجيل الدخول </a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('website') }}#contact">الموقع وتواصل</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-list-alt me-1"></i> أقسامنا
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-book me-2" style="color: var(--primary-red);"></i> مقالات</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="auth-container">
        <div class="auth-card">
            
            <div class="toggle-buttons">
                <button type="button" class="toggle-button active" id="show-login-btn">
                    <i class="fas fa-sign-in-alt me-2"></i> تسجيل الدخول
                </button>
                <button type="button" class="toggle-button" id="show-register-btn">
                    <i class="fas fa-user-plus me-2"></i> تسجيل حساب جديد
                </button>
            </div>

            <div id="login-form" class="form-active">
                <h2>تسجيل الدخول</h2>
                
                <div class="status" style="text-align: center;">
                    {{-- مكان رسائل الحالة (مثل رسائل الجلسة) --}}
                </div>
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="phone">رقم الهاتف </label>
                        <input id="login_phone" type="phone" name="phone" value="{{ old('phone') }}" required autofocus autocomplete="username" placeholder="أدخل رقم هاتفك">
                        <i class="fas fa-mobile-alt input-icon"></i> 
                        {{-- الأخطاء يجب أن تكون منفصلة عن الحقل لتجنب التداخل مع الأيقونة --}}
                    </div>

                    <div class="form-group">
                        <label for="password">كلمة السر </label>
                        <input id="login_password" type="password" name="password" required autocomplete="current-password" placeholder="أدخل كلمة السر">
                        <i class="fas fa-lock input-icon"></i>
                    </div>

                    <div class="form-group d-flex justify-content-between align-items-center">
                        <label for="remember_me" style="margin-bottom: 0;">
                            <input id="remember_me" type="checkbox" name="remember">
                            حفظ البيانات
                        </label>
                     
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn-luxury"> تسجيل الدخول الآن</button>
                    </div>
                </form>
            </div>
            
            <div id="register-form">
                <h2>تسجيل حساب جديد</h2>
                
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">الاسم</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="الاسم كاملاً">
                        <i class="fas fa-user input-icon"></i>
                    </div>

                    <div class="form-group">
                        <label for="email">البريد الإلكتروني</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="example@domain.com">
                        <i class="fas fa-envelope input-icon"></i>
                    </div>

                    <div class="form-group">
                        <label for="phone">الجوال </label>
                        <input id="register_phone" type="phone" name="phone" value="{{ old('phone') }}" required autocomplete="phone" placeholder="05XXXXXXXX">
                        <i class="fas fa-mobile-alt input-icon"></i>
                    </div>

                    <div class="form-group">
                        <label for="password">كلمة السر</label>
                        <input id="register_password" type="password" name="password" required autocomplete="new-password" placeholder="أدخل كلمة سر قوية">
                        <i class="fas fa-key input-icon"></i>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">تأكيد كلمة السر</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="أعد إدخال كلمة السر">
                        <i class="fas fa-key input-icon"></i>
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn-luxury">
                            تسجيل الآن
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // كود التبديل بين نماذج تسجيل الدخول والتسجيل
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            const showLoginBtn = document.getElementById('show-login-btn');
            const showRegisterBtn = document.getElementById('show-register-btn');

            function showForm(formToShow, formToHide, btnToActivate, btnToDeactivate) {
                // إزالة فئة الحركة قبل إخفاء النموذج للتأكد من إمكانية تطبيقها عند الإظهار
                formToHide.classList.remove('form-active'); 
                
                // إضافة فئة الحركة إلى النموذج المراد إظهاره
                formToShow.classList.add('form-active');
                
                btnToActivate.classList.add('active');
                btnToDeactivate.classList.remove('active');
            }

            // إظهار نموذج تسجيل الدخول عند تحميل الصفحة افتراضيًا
            showForm(loginForm, registerForm, showLoginBtn, showRegisterBtn);
            
            showLoginBtn.addEventListener('click', () => {
                showForm(loginForm, registerForm, showLoginBtn, showRegisterBtn);
            });

            showRegisterBtn.addEventListener('click', () => {
                showForm(registerForm, loginForm, showRegisterBtn, showLoginBtn);
            });

            // تحديث JavaScript لـ Dropdown (تم إبقاء الكود الأصلي لكنه غير مستخدم في شريط التنقل الحالي)
            // (كود Bootstrap 5 يتعامل مع الـ dropdowns تلقائياً عبر data-bs-toggle)
        });
    </script>
</body>
</html>