<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول </title>
    
    <link
        href="https://fonts.googleapis.com/css2?family=Amiri:wght@300;500;700;900&family=Display:wght@700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* === متغيرات الألوان من اللاندينج بيج === */
        :root {
            --primary-red: #7d1517;
            --primary-gradient: linear-gradient(135deg, #7d1517 0%, #4a0d0e 100%);
            --gold: #D4AF37;
            --light-bg: #f8f8f8; /* لون الخلفية الفاتح */
            --dark-text: #212529; /* النص الداكن */
            --card-bg: #ffffff; /* خلفية البطاقة البيضاء */
        }

        body {
            /* استخدام خط Amiri الفاخر */
            font-family: "Amiri", serif;
            background-color: var(--light-bg);
            margin: 0;
            padding: 0;
            color: var(--dark-text);
            direction: rtl; /* ضمان الاتجاه من اليمين لليسار للصفحة بالكامل */
        }

        .container {
            max-width: 450px; /* تصغير حجم الحاوية قليلاً */
            margin: 80px auto;
            padding: 30px;
            background-color: var(--card-bg);
            border-radius: 15px; /* زيادة انحناء الزوايا */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); /* ظل أكثر نعومة */
            border-top: 5px solid var(--primary-red); /* إضافة شريط علوي بلون العلامة التجارية */
        }

        h2 {
            font-weight: 700 !important;
            color: var(--primary-red) !important; /* لون العنوان */
            margin-bottom: 30px;
            font-size: 2rem;
        }
        
        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-size: 1.05rem;
            margin-bottom: 8px;
            color: var(--dark-text);
            font-weight: 500;
            text-align: right; 
        }

        .form-group input[type="phone"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            box-sizing: border-box;
            font-size: 1.1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
            text-align: right; /* محاذاة إدخال النص لليمين */
        }
        
        .form-group input:focus {
            border-color: var(--primary-red);
            box-shadow: 0 0 0 3px rgba(125, 21, 23, 0.1); /* ظل خفيف بلون العلامة التجارية */
            outline: none;
        }

        /* تنسيق زر الحفظ وتصحيح RTL */
        .form-group input[type="checkbox"] {
            margin-left: 8px; /* عكس الهامش ليناسب RTL */
            margin-right: 0;
            vertical-align: middle;
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

        /* === تصميم الزر الفاخر (btn-luxury) === */
        .btn-luxury {
            background: var(--primary-gradient);
            color: #fff;
            border: 1px solid var(--primary-red);
            padding: 12px 30px;
            border-radius: 5px; /* إبقاء الزر مستطيلاً قليلاً */
            font-weight: 700;
            letter-spacing: 0.5px;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
            width: 100%;
            font-size: 1.2rem;
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

        a {
            color: var(--primary-red);
            text-decoration: none;
            transition: color 0.3s;
        }

        a:hover {
            color: var(--gold);
        }

        @media only screen and (max-width: 600px) {
            .container {
                max-width: 100%;
                margin: 30px 15px;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 style="text-align: center;">
            <i class="fas fa-sign-in-alt" style="margin-left: 10px;"></i> تسجيل الدخول
        </h2>
        
        <div class="status" style="text-align: center;">
            </div>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="phone">رقم الهاتف </label>
                <input id="phone" type="phone" name="phone" value="{{ old('phone') }}" required autofocus autocomplete="username" placeholder="أدخل رقم هاتفك">
                @error('phone')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">كلمة السر </label>
                <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="أدخل كلمة السر">
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group d-flex justify-content-between align-items-center">
                <label for="remember_me" style="margin-bottom: 0;">
                    <input id="remember_me" type="checkbox" name="remember">
                    حفظ البيانات
                </label>
                
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" style="font-size: 0.95rem;">هل نسيت كلمة المرور؟</a>
                @endif
            </div>

            <div class="form-group mt-4">
                <button type="submit" class="btn-luxury"> تسجيل الدخول الآن</button>
            </div>
            
            <div style="text-align: center; margin-top: 20px; font-size: 0.95rem;">
                <a href="{{ route('register') }}" style="color: var(--dark-text);">ليس لديك حساب؟ <span style="color: var(--primary-red); font-weight: 500;">سجل الآن</span></a>
            </div>
            
        </form>
    </div>
</body>
</html>