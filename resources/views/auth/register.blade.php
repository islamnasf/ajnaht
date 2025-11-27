<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل حساب جديد </title>
    
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
            max-width: 450px; /* حجم الحاوية */
            margin: 50px auto;
            padding: 30px;
            background-color: var(--card-bg);
            border-radius: 15px; /* زيادة انحناء الزوايا */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); /* ظل أكثر نعومة */
            border-top: 5px solid var(--primary-red); /* شريط علوي بلون العلامة التجارية */
        }

        h2 {
            font-weight: 700 !important;
            color: var(--primary-red) !important; /* لون العنوان */
            margin-bottom: 30px;
            font-size: 2rem;
            text-align: center;
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

        .form-group input[type="text"],
        .form-group input[type="email"],
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
            box-shadow: 0 0 0 3px rgba(125, 21, 23, 0.1);
            outline: none;
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
            border-radius: 5px; 
            font-weight: 700;
            letter-spacing: 0.5px;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
            /* width: 100%; */ /* نجعله يعتمد على المحتوى داخل الـ flex container */
            font-size: 1.2rem;
            cursor: pointer;
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

        /* تنسيق الأزرار وروابط "لديك حساب بالفعل؟" */
        .auth-actions {
            display: flex;
            align-items: center;
            justify-content: space-between; /* تعديل لـ RTL */
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        
        .auth-actions a {
            color: var(--dark-text); /* لون النص الأصغر */
            font-size: 0.95rem;
            padding-inline-start: 1rem; /* مسافة داخلية لليمين بدل اليسار */
        }
        
        .auth-actions .btn-luxury {
            /* HACK: تجاوز الـ ms-4 الموجود في الكود الأصلي لتطبيق مسافة من اليمين (في RTL) */
            margin-right: 1rem; 
            margin-left: 0 !important;
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
        <h2>
            <i class="fas fa-user-plus" style="margin-left: 10px;"></i> تسجيل حساب جديد
        </h2>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name">الاسم</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="الاسم كاملاً">
                </div>

            <div class="form-group">
                <label for="email">البريد الإلكتروني</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="example@domain.com">
                </div>
 <div class="form-group">
                <label for="phone">الجوال </label>
                <input id="phone" type="phone" name="phone" value="{{ old('phone') }}" required autocomplete="phone" placeholder="05679123456">
                </div>
            <div class="form-group">
                <label for="password">كلمة السر</label>
                <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="أدخل كلمة سر قوية">
                </div>

            <div class="form-group">
                <label for="password_confirmation">تأكيد كلمة السر</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="أعد إدخال كلمة السر">
                </div>

            <div class="auth-actions">
                <a href="{{ route('login') }}">
                    لديك حساب بالفعل؟ <span style="color: var(--primary-red); font-weight: 500;">سجل دخول</span>
                </a>

                <button type="submit" class="btn-luxury">
                    تسجيل الآن
                </button>
            </div>
        </form>
    </div>
</body>
</html>