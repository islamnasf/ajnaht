<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cloudflare Error - 502 Bad Gateway</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    <style>
        /* CSS Styling */
        :root {
            --primary: #f38020; /* لون Cloudflare البرتقالي */
            --secondary: #007bff;
            --dark: #2b303a;
            --gray: #6d7580;
            --light-gray: #f5f6f7;
            --border-color: #d8dee3;
            --background: #ffffff;
            --shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Tajawal', sans-serif;
            line-height: 1.6;
            color: var(--dark);
            background-color: var(--light-gray);
            direction: rtl;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .error-container {
            width: 100%;
            max-width: 900px;
            background-color: var(--background);
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow);
            border-radius: 8px;
            overflow: hidden;
        }

        /* الرأس - Header */
        header {
            background-color: var(--dark);
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
        }

        .logo i {
            color: var(--primary);
            margin-left: 10px;
        }

        .support-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .support-link:hover {
            color: #ffaa5e;
        }

        /* المحتوى الرئيسي - Main Content */
        .error-content {
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .error-code {
            font-size: 6rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 5px;
            line-height: 1;
        }

        .error-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 20px;
        }

        .description {
            font-size: 1.1rem;
            color: var(--gray);
            margin-bottom: 30px;
            max-width: 650px;
        }

        /* تفاصيل المشكلة */
        .problem-details {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-top: 30px;
            width: 100%;
            max-width: 700px;
            text-align: right;
            border-top: 1px solid var(--border-color);
            padding-top: 20px;
        }

        .detail-card {
            flex: 1;
            padding: 15px;
            background-color: var(--light-gray);
            border-radius: 6px;
            border-right: 3px solid var(--primary);
            text-align: right;
        }

        .detail-card h4 {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--dark);
        }

        .detail-card p {
            font-size: 0.9rem;
            color: var(--gray);
            word-wrap: break-word; /* لكسر الكلمات الطويلة */
        }

        /* المخطط الزمني للطلب (مثل Cloudflare) */
        .ray-id {
            margin-top: 20px;
            font-size: 0.9rem;
            color: var(--gray);
        }

        .diagram-box {
            background-color: #e3f2fd; /* لون أزرق فاتح للمخطط */
            padding: 20px;
            border-radius: 6px;
            margin-top: 30px;
            border: 1px dashed #90caf9;
        }

        .diagram-box h3 {
            font-size: 1.2rem;
            color: var(--secondary);
            margin-bottom: 15px;
        }

        .diagram-icon {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1rem;
            color: var(--dark);
        }

        .diagram-icon i {
            font-size: 2rem;
            color: var(--primary);
        }

        .arrow {
            color: var(--dark);
            font-size: 1.5rem;
        }
        
        /* التذييل */
        footer {
            padding: 20px 0;
            text-align: center;
            font-size: 0.9rem;
            color: var(--gray);
        }
        
        /* استجابة الشاشات الصغيرة */
        @media (max-width: 768px) {
            .error-code {
                font-size: 4rem;
            }
            .error-title {
                font-size: 1.8rem;
            }
            .problem-details {
                flex-direction: column;
            }
            header {
                flex-direction: column;
                gap: 10px;
            }
            .diagram-icon {
                flex-wrap: wrap;
                justify-content: center;
                gap: 15px;
            }
            .arrow {
                display: none; /* إخفاء الأسهم في عرض المكدس */
            }
            .diagram-icon div {
                min-width: 100px;
            }
        }

        /* رسوم متحركة */
        @keyframes pulse-icon {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.8; }
            100% { transform: scale(1); opacity: 1; }
        }

        .status-pulse {
            animation: pulse-icon 1.5s infinite;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <header>
            <div class="logo">
                <i class="fas fa-cloud"></i>
                Cloud Flare Simulation
            </div>
            <a href="#" class="support-link">مركز المساعدة</a>
        </header>

        <main class="error-content">
            <div class="error-code">502</div>
            <h1 class="error-title">خطأ: البوابة السيئة (Bad Gateway)</h1>
            
            <p class="description">
                تعذر على خادم الويب (Cloud Flare Simulation) إكمال طلبه. عادةً ما يحدث هذا عندما يتلقى خادم البوابة استجابة غير صالحة من خادم المنبع.
            </p>

            <div class="diagram-box">
                <h3>حالة الاتصال</h3>
                
                <div class="diagram-icon">
                    <div>
                        <i class="fas fa-user-circle"></i>
                        <p>أنت (المستخدم)</p>
                    </div>
                    <span class="arrow"><i class="fas fa-long-arrow-alt-left"></i></span>
                    <div>
                        <i class="fas fa-cloud status-pulse" style="color: var(--primary);"></i>
                        <p>Cloud Flare</p>
                    </div>
                    <span class="arrow"><i class="fas fa-times" style="color: red;"></i></span>
                    <div>
                        <i class="fas fa-server"></i>
                        <p>خادم المنبع</p>
                    </div>
                </div>
            </div>

            <div class="problem-details">
                <div class="detail-card">
                    <h4>كود الخطأ</h4>
                    <p>502</p>
                </div>
                <div class="detail-card">
                    <h4>معرف الطلب (Ray ID)</h4>
                    <p id="ray-id">CF-20251214-502BAD-12345</p>
                </div>
                <div class="detail-card">
                    <h4>الوقت</h4>
                    <p id="current-time"></p>
                </div>
            </div>
            
            <p class="ray-id">
                <i class="fas fa-bug"></i> فريقنا الفني على علم بالمشكلة. يرجى تزويدنا بـ **معرف الطلب (Ray ID)** إذا اتصلت بالدعم.
            </p>
        </main>
    </div>
    
    <footer>
        <p>قد تكون المشكلة مؤقتة. يرجى المحاولة بعد بضع دقائق. • <a href="#" style="color: var(--primary);">راجع مدونة الحالة</a></p>
    </footer>

    <script>
        // دالة تحديث الوقت الحالي
        function updateTime() {
            const now = new Date();
            const options = {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            };
            document.getElementById('current-time').textContent = now.toLocaleDateString('en-US', options) + ' UTC';
        }
        
        // توليد معرف طلب عشوائي (Ray ID)
        function generateRayID() {
            const datePart = new Date().toISOString().slice(0, 10).replace(/-/g, '');
            const randomPart = Math.random().toString(36).substring(2, 8).toUpperCase();
            return `CF-${datePart}-502BAD-${randomPart}`;
        }

        window.onload = function() {
            updateTime();
            setInterval(updateTime, 1000);
            document.getElementById('ray-id').textContent = generateRayID();
        }
    </script>
</body>
</html>