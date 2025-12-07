<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>مدونه ومقالات </title>
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
            --primary-gradient: linear-gradient(135deg, #c6842f 0%, #a86b20 100%);
            --gold: #D4AF37;
            --light-bg: #f9f9f9;
            --dark-text: #212529;
            --card-bg: #ffffff;
            --text-light: #6c757d;
        }

        body {
            font-family: "IBM Plex Sans Arabic", sans-serif;
            background-color: var(--light-bg);
            color: var(--dark-text);
            overflow-x: hidden;
            padding-top: 70px; /* إضافة padding لتعويض النافبار الثابت */
        }

        /* --- التحسينات العامة والنافبار (نفس الكود القديم) --- */
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #e9ecef; }
        ::webkit-scrollbar-thumb { background: var(--primary-red); border-radius: 5px; }
        ::selection { background: var(--primary-red); color: #fff; }

        .navbar {
            background-color: rgba(255, 255, 255, 0.85);
            padding: 10px 0;
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
        }

        .navbar-brand { font-weight: 900; color: var(--dark-text) !important; font-size: 1.8rem; letter-spacing: 1px; }
        .nav-link { color: var(--dark-text) !important; font-weight: 500; margin: 0 10px; position: relative; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { color: var(--primary-red) !important; }
        .nav-link::after { content: ''; position: absolute; width: 0; height: 2px; bottom: 0; right: 0; background-color: var(--primary-red); transition: width 0.3s; }
        .nav-link:hover::after { width: 100%; }
        
        .navbar-nav .dropdown-menu { border: none; border-radius: 10px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); padding: 0; }
        .navbar-nav .dropdown-item { padding: 10px 20px; font-weight: 500; }
        .navbar-nav .dropdown-item:hover { background-color: var(--primary-red); color: white; }

        .btn-luxury {
            background: var(--primary-gradient);
            color: #fff;
            border: none;
            padding: 10px 30px;
            border-radius: 30px;
            font-weight: 700;
            transition: all 0.4s ease;
            box-shadow: 0 4px 15px rgba(198, 132, 47, 0.3);
        }
        .btn-luxury:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(198, 132, 47, 0.4); color: #fff; }

        /* User Dropdown */
        .user-dropdown { position: relative; display: inline-block; }
        .user-dropdown .menu { display: none; position: absolute; right: 0; background: #fff; min-width: 150px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); border-radius: 8px; z-index: 999; }
        .user-dropdown .menu.show { display: block; }
        .user-dropdown .menu a, .user-dropdown .menu button { display: block; width: 100%; padding: 10px 15px; text-align: right; border: none; background: transparent; text-decoration: none; color: #333; }
        .user-dropdown .menu a:hover, .user-dropdown .menu button:hover { background: #f3f3f3; }

        /* --- تنسيقات قسم المقالات المحسنة --- */
        .section-padding { padding: 80px 0 80px; position: relative; }

        /* Blog Card Design */
        .blog-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(0,0,0,0.04);
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .blog-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(198, 132, 47, 0.15);
            border-color: rgba(198, 132, 47, 0.2);
        }

        .blog-img-wrapper {
            position: relative;
            height: 260px;
            overflow: hidden;
            border-bottom: 4px solid var(--primary-red);
        }

        .blog-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s ease;
        }

        .blog-card:hover .blog-img-wrapper img {
            transform: scale(1.1);
        }

        /* Date Badge Styling */
        .blog-date-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: rgba(255, 255, 255, 0.95);
            padding: 8px 18px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 800;
            color: var(--dark-text);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            backdrop-filter: blur(5px);
            border-right: 3px solid var(--primary-red);
        }

        .blog-content {
            padding: 30px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .blog-category {
            display: inline-block;
            background: rgba(198, 132, 47, 0.1);
            color: var(--primary-red);
            padding: 5px 12px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            margin-bottom: 15px;
            width: fit-content;
        }

        .blog-title {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .blog-title a {
            color: var(--dark-text);
            text-decoration: none;
            transition: 0.3s;
            background-image: linear-gradient(var(--primary-red), var(--primary-red));
            background-size: 0% 2px;
            background-repeat: no-repeat;
            background-position: right bottom;
            padding-bottom: 3px;
        }

        .blog-title a:hover {
            color: var(--primary-red);
            background-size: 100% 2px;
        }

        .blog-excerpt {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.7;
            margin-bottom: 25px;
            flex-grow: 1;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .read-more-btn {
            color: var(--dark-text);
            font-weight: 700;
            text-decoration: none;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            justify-content: space-between;
            transition: 0.3s;
            margin-top: auto;
            border-top: 1px solid #eee;
            padding-top: 20px;
            width: 100%;
        }

        .read-more-btn span {
            position: relative;
            z-index: 1;
            transition: 0.3s;
        }

        .read-more-icon {
            width: 35px;
            height: 35px;
            background: #f8f8f8;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-red);
            transition: 0.4s ease;
        }

        .read-more-btn:hover { color: var(--primary-red); }
        .read-more-btn:hover .read-more-icon {
            background: var(--primary-red);
            color: #fff;
            transform: translateX(-5px) rotate(45deg);
        }

        /* --- زر "عرض المزيد" --- */
        .load-more-container {
            margin-top: 3rem;
            text-align: center;
        }

        .btn-load-more {
            background: var(--primary-gradient);
            color: #fff;
            border: none;
            padding: 12px 40px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.4s ease;
            box-shadow: 0 8px 20px rgba(198, 132, 47, 0.25);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-load-more:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(198, 132, 47, 0.4);
            color: #fff;
        }

        .btn-load-more:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .btn-load-more i {
            transition: transform 0.3s ease;
        }

        .btn-load-more:hover i {
            transform: translateY(2px);
        }

        /* Loading Spinner for AJAX */
        #articles-loader {
            display: none;
            text-align: center;
            padding: 40px;
        }
        .spinner-luxury {
            width: 50px;
            height: 50px;
            border: 4px solid rgba(198, 132, 47, 0.2);
            border-left-color: var(--primary-red);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }
        @keyframes spin { 100% { transform: rotate(360deg); } }

        /* Sidebar Widget */
        .sidebar-widget {
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(198, 132, 47, 0.15);
            position: sticky;
            top: 100px;
            overflow: hidden;
            background: var(--primary-gradient);
        }
        
        /* Footer (نفس الكود) */
        .footer { background: #e9ecef; padding-top: 80px; padding-bottom: 30px; border-top: 5px solid var(--primary-red); color: var(--dark-text); }
        .social-circle { width: 45px; height: 45px; border-radius: 50%; border: 2px solid var(--primary-red); display: inline-flex; align-items: center; justify-content: center; color: var(--dark-text); margin: 0 5px; transition: 0.3s; text-decoration: none; }
        .social-circle:hover { background: var(--primary-red); color: #fff; box-shadow: 0 0 15px var(--primary-red); }

        /* Hidden articles */
        .blog-item.hidden {
            display: none !important;
        }

        /* Animation for showing new articles */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .blog-item.show-animation {
            animation: fadeInUp 0.6s ease forwards;
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('website') }}#contact">الموقع وتواصل</a></li>
                      <li class="nav-item">
                        <a class="nav-link active" href="{{ route('blogs') }}"
                            aria-expanded="false">
                            <i class="fas fa-list-alt me-1"></i> مقالات
                        </a>
                    </li>
                </ul>

                @php $user = auth()->user() ?? null; @endphp
                <div class="user-dropdown">
                    @guest
                    <a href="{{ route('login') }}" class="btn btn-luxury mt-3 mt-lg-0">التسجيل الآن</a>
                    @endguest

                    @auth
                    <button id="userBtn" class="btn btn-luxury mt-3 mt-lg-0">{{ auth()->user()->name }} ▾</button>
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
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('userBtn');
            const menu = document.getElementById('userMenu');
            if (btn && menu) {
                btn.addEventListener('click', (e) => { e.stopPropagation(); menu.classList.toggle('show'); });
                document.addEventListener('click', () => { menu.classList.remove('show'); });
            }
        });
    </script>

    <section class="section-padding">
        <div class="container">
            <div class="row justify-content-center mb-5" data-aos="fade-up">
                <div class="col-lg-8 text-center">
                    <h5 style="color: var(--primary-red); font-weight: 700; letter-spacing: 2px; text-transform: uppercase;">المدونة والأخبار</h5>
                    <h2 style="font-weight: 800; font-size: 2.5rem; margin-top: 10px;">أحدث المقالات والمعلومات</h2>
                    <div style="width: 80px; height: 4px; background: var(--primary-gradient); margin: 20px auto; border-radius: 2px;"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    
                    <div id="articles-loader">
                        <div class="spinner-luxury"></div>
                        <p class="mt-3 text-muted fw-bold">جاري تحميل المقالات...</p>
                    </div>

                    <div id="blog-list-container">
                        <div class="row g-4">
                            @php
                                $totalBlogs = count($blogs);
                                $itemsPerPage = 4;
                                $visibleCount = 0;
                            @endphp
                            
                            @forelse($blogs as $index => $blog)
                                @php
                                    $isVisible = $visibleCount < $itemsPerPage;
                                    $visibleCount++;
                                @endphp
                                <div class="col-md-6 blog-item {{ !$isVisible ? 'hidden' : '' }}" 
                                     data-index="{{ $index }}" 
                                     data-aos="fade-up" 
                                     data-aos-delay="{{ ($index % 2) * 100 }}">
                                    <article class="blog-card">
                                        <div class="blog-img-wrapper">
                                            <a href="{{ route('blog.show', $blog->id) }}">
                                                @if($blog->image)
                                                    <img src="{{ asset($blog->image) }}" alt="{{ $blog->name }}">
                                                @else
                                                    <img src="https://placehold.co/600x400/f8f8f8/c6842f?text=Royal+View" alt="Default Image">
                                                @endif
                                            </a>
                                            <div class="blog-date-badge">
                                                {{ $blog->created_at->format('d') }} <br>
                                                <span style="font-size: 0.7rem; font-weight: 400;">{{ $blog->created_at->format('M') }}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="blog-content">
                                            <div class="blog-category">
                                                <i class="fas fa-hashtag me-1"></i> أخبار عامة
                                            </div>
                                            
                                            <h3 class="blog-title">
                                                <a href="{{ route('blog.show', $blog->id) }}">{{ $blog->name }}</a>
                                            </h3>
                                            
                                            <div class="blog-excerpt">
                                                {!! Str::limit(strip_tags($blog->contant), 100) !!}
                                            </div>
                                            
                                            <a href="{{ route('blog.show', $blog->id) }}" class="read-more-btn">
                                                <span>قراءة المزيد</span>
                                                <div class="read-more-icon">
                                                    <i class="fas fa-arrow-left"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </article>
                                </div>
                            @empty
                            <div class="col-12 text-center py-5">
                                <div class="p-5 bg-white rounded-4 shadow-sm border">
                                    <i class="fas fa-search fa-3x text-muted mb-3 opacity-25"></i>
                                    <h4 class="text-muted fw-light">عذراً، لم يتم العثور على مقالات حالياً.</h4>
                                </div>
                            </div>
                            @endforelse
                        </div>

                        <!-- زر "عرض المزيد" -->
                        @if($totalBlogs > $itemsPerPage)
                        <div class="load-more-container" data-aos="fade-up">
                            <button id="loadMoreBtn" class="btn-load-more">
                                <i class="fas fa-arrow-down"></i>
                                عرض المزيد من المقالات
                                <span id="remainingCount">({{ $totalBlogs - $itemsPerPage }}+)</span>
                            </button>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-4 ps-lg-5">
                    <div class="sidebar-widget text-center p-5" data-aos="fade-left" data-aos-delay="200">
                        <div class="mb-4 text-white">
                            <i class="fas fa-concierge-bell fa-4x opacity-75"></i>
                        </div>
                        <h3 class="mb-3 text-white fw-bold">إقامة ملكية بانتظارك</h3>
                        <p class="mb-4 text-white opacity-75" style="line-height: 1.8;">لا تفوت فرصة الاستمتاع بأجواء من الرفاهية والهدوء. احجز غرفتك المميزة الآن بأفضل الأسعار.</p>
                        <a href="{{ route('hotels') }}" class="btn btn-light rounded-pill fw-bold w-100 py-3 shadow-sm text-uppercase" style="color: var(--primary-red); letter-spacing: 1px;">
                            احجز الآن
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // تهيئة المتغيرات
            const itemsPerPage = 4;
            let currentVisibleCount = itemsPerPage;
            const totalItems = {{ $totalBlogs }};
            const loadMoreBtn = $('#loadMoreBtn');
            
            // تحديث العداد
            function updateRemainingCount() {
                const remaining = totalItems - currentVisibleCount;
                if (remaining > 0) {
                    $('#remainingCount').text(`(${remaining}+)`);
                } else {
                    $('#remainingCount').text('');
                }
            }
            
            // تحديث حالة الزر
            function updateButtonState() {
                if (currentVisibleCount >= totalItems) {
                    loadMoreBtn.prop('disabled', true).html('<i class="fas fa-check"></i> تم عرض جميع المقالات');
                }
            }
            
            // عرض المزيد من المقالات
            function loadMoreArticles() {
                // إيجاد المقالات المخفية
                const hiddenItems = $('.blog-item.hidden');
                
                if (hiddenItems.length === 0) {
                    updateButtonState();
                    return;
                }
                
                // تحديد عدد العناصر التي سيتم عرضها (4 أو أقل إذا كان الباقي أقل)
                const itemsToShow = Math.min(itemsPerPage, hiddenItems.length);
                
                // عرض مؤشر التحميل
                loadMoreBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> جاري التحميل...');
                
                // محاكاة وقت التحميل (600 مللي ثانية)
                setTimeout(function() {
                    // عرض العناصر المحددة
                    for (let i = 0; i < itemsToShow; i++) {
                        const item = $(hiddenItems[i]);
                        setTimeout(function() {
                            item.removeClass('hidden').addClass('show-animation');
                        }, i * 100);
                    }
                    
                    // تحديث العداد
                    currentVisibleCount += itemsToShow;
                    
                    // تحديث حالة الزر
                    updateRemainingCount();
                    updateButtonState();
                    
                    // إعادة تمكين الزر إذا كان هناك المزيد من المقالات
                    if (hiddenItems.length > itemsToShow) {
                        loadMoreBtn.prop('disabled', false).html('<i class="fas fa-arrow-down"></i> عرض المزيد من المقالات <span id="remainingCount">(' + (totalItems - currentVisibleCount) + '+)</span>');
                    }
                    
                    // إعادة تشغيل AOS للعناصر الجديدة
                    AOS.refresh();
                    
                    // التمرير السلس للأسفل
                    if (itemsToShow > 0) {
                        $('html, body').animate({
                            scrollTop: $('.blog-item.hidden').first().prev().offset().top - 100
                        }, 500);
                    }
                }, 600);
            }
            
            // حدث النقر على زر "عرض المزيد"
            if (loadMoreBtn.length > 0) {
                loadMoreBtn.on('click', loadMoreArticles);
                updateRemainingCount();
                updateButtonState();
            }
            
            // التأكد من تحديث AOS عند تحميل عناصر جديدة
            $(document).on('DOMNodeInserted', '.show-animation', function() {
                AOS.refresh();
            });
        });
    </script>

</body>
</html>