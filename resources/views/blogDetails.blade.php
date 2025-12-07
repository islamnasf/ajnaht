<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $blog->name ?? 'مقال' }} - Royal View</title>
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
.sidebar-widget{
                background-color: var(--primary-red);
                border-radius: 50px;

}
        body {
            font-family: "IBM Plex Sans Arabic", sans-serif;
            background-color: var(--light-bg);
            color: var(--dark-text);
            overflow-x: hidden;
            padding-top: 70px; /* إضافة padding لتعويض النافبار الثابت */
        }

        /* --- التحسينات العامة والنافبار (نفس الكود) --- */
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #e9ecef; }
        ::-webkit-scrollbar-thumb { background: var(--primary-red); border-radius: 5px; }
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

        /* --- تنسيقات صفحة تفاصيل المقال --- */
        .section-padding { padding: 80px 0 80px; position: relative; }

        /* Hero Section */
        .blog-hero {
            position: relative;
            height: 400px;
            overflow: hidden;
            border-radius: 20px;
            margin-bottom: 40px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .blog-hero img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0.7));
            display: flex;
            align-items: flex-end;
            padding: 40px;
        }

        .hero-content {
            color: white;
            max-width: 800px;
        }

        .blog-category {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            color: white;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .blog-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 15px;
            line-height: 1.3;
        }

        .blog-meta {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
        }

        .meta-item i {
            color: var(--primary-red);
        }

        /* Main Content */
        .blog-content-wrapper {
            background: #fff;
            border-radius: 20px;
            padding: 50px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
            margin-bottom: 40px;
        }

        .blog-content-text {
            font-size: 1.1rem;
            line-height: 1.9;
            color: #444;
        }

        .blog-content-text p {
            margin-bottom: 25px;
        }

        .blog-content-text h2 {
            color: var(--dark-text);
            font-weight: 700;
            margin: 40px 0 20px;
            font-size: 1.8rem;
            position: relative;
            padding-right: 15px;
        }

        .blog-content-text h2::before {
            content: '';
            position: absolute;
            right: 0;
            top: 5px;
            width: 5px;
            height: 80%;
            background: var(--primary-red);
            border-radius: 3px;
        }

        .blog-content-text blockquote {
            border-right: 4px solid var(--primary-red);
            padding: 20px 30px;
            margin: 30px 0;
            background: rgba(198, 132, 47, 0.05);
            border-radius: 10px;
            font-style: italic;
            font-size: 1.2rem;
            line-height: 1.8;
        }

        .blog-content-text img {
            max-width: 100%;
            height: auto;
            border-radius: 15px;
            margin: 30px 0;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        /* Share Section */
        .share-section {
            border-top: 1px solid #eee;
            padding-top: 30px;
            margin-top: 50px;
        }

        .share-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .share-btn {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1.2rem;
        }

        .share-btn:hover {
            transform: translateY(-3px);
            color: white;
        }

        .facebook { background: #3b5998; }
        .twitter { background: #1da1f2; }
        .whatsapp { background: #25d366; }
        .linkedin { background: #0077b5; }

        /* Related Articles */
        .related-articles {
            margin-top: 80px;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 40px;
            position: relative;
            padding-bottom: 15px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 100px;
            height: 4px;
            background: var(--primary-gradient);
            border-radius: 2px;
        }

        /* Blog Card Design (نفس تصميم الكروت) */
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

        .blog-card-content {
            padding: 30px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .blog-card-category {
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

        .blog-card-title {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .blog-card-title a {
            color: var(--dark-text);
            text-decoration: none;
            transition: 0.3s;
            background-image: linear-gradient(var(--primary-red), var(--primary-red));
            background-size: 0% 2px;
            background-repeat: no-repeat;
            background-position: right bottom;
            padding-bottom: 3px;
        }

        .blog-card-title a:hover {
            color: var(--primary-red);
            background-size: 100% 2px;
        }

        .blog-card-excerpt {
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

        /* Back Button */
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--dark-text);
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            color: var(--primary-red);
            transform: translateX(-5px);
        }

        /* Footer (نفس الكود) */
        .footer { background: #e9ecef; padding-top: 80px; padding-bottom: 30px; border-top: 5px solid var(--primary-red); color: var(--dark-text); }
        .social-circle { width: 45px; height: 45px; border-radius: 50%; border: 2px solid var(--primary-red); display: inline-flex; align-items: center; justify-content: center; color: var(--dark-text); margin: 0 5px; transition: 0.3s; text-decoration: none; }
        .social-circle:hover { background: var(--primary-red); color: #fff; box-shadow: 0 0 15px var(--primary-red); }

        /* Responsive */
        @media (max-width: 768px) {
            .blog-hero {
                height: 300px;
            }
            
            .blog-title {
                font-size: 1.8rem;
            }
            
            .blog-content-wrapper {
                padding: 30px 20px;
            }
            
            .blog-content-text {
                font-size: 1rem;
            }
            
            .blog-meta {
                gap: 10px;
            }
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
            <!-- زر العودة -->
            <a href="{{ route('blogs') }}" class="back-btn" data-aos="fade-right">
                <i class="fas fa-arrow-right"></i>
                العودة إلى المقالات
            </a>

            <!-- قسم المقال الرئيسي -->
            <div class="blog-hero" data-aos="fade-up">
                @if($blog->image)
                    <img src="{{ asset($blog->image) }}" alt="{{ $blog->name }}">
                @else
                    <img src="https://placehold.co/1200x400/f8f8f8/c6842f?text=Royal+View" alt="Default Image">
                @endif
                <div class="hero-overlay">
                    <div class="hero-content">
                        <span class="blog-category">
                            <i class="fas fa-hashtag me-1"></i> أخبار عامة
                        </span>
                        <h1 class="blog-title">{{ $blog->name }}</h1>
                        <div class="blog-meta">
                            <div class="meta-item">
                                <i class="far fa-calendar"></i>
                                <span>{{ $blog->created_at->translatedFormat('d F Y') }}</span>
                            </div>
                    
                           
                        </div>
                    </div>
                </div>
            </div>

            <!-- محتوى المقال -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-content-wrapper" data-aos="fade-up" data-aos-delay="100">
                        <div class="blog-content-text">
                            {!! $blog->contant !!}
                        </div>

                        <!-- أزرار المشاركة -->
                        <div class="share-section">
                            <h5 class="mb-3" style="font-weight: 700; color: var(--dark-text);">شارك المقال:</h5>
                            <div class="share-buttons">
                                <a href="#" class="share-btn facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="share-btn twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="share-btn whatsapp">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                                <a href="#" class="share-btn linkedin">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- جانب المقال -->
                    <div class="sidebar-widget text-center p-5 mb-4" data-aos="fade-left" data-aos-delay="200">
                        <div class="mb-4 text-white">
                            <i class="fas fa-concierge-bell fa-4x opacity-75"></i>
                        </div>
                        <h3 class="mb-3 text-white fw-bold">إقامة ملكية بانتظارك</h3>
                        <p class="mb-4 text-white opacity-75" style="line-height: 1.8;">لا تفوت فرصة الاستمتاع بأجواء من الرفاهية والهدوء. احجز غرفتك المميزة الآن بأفضل الأسعار.</p>
                        <a href="{{ route('hotels') }}" class="btn btn-light rounded-pill fw-bold w-100 py-3 shadow-sm text-uppercase" style="color: var(--primary-red); letter-spacing: 1px;">
                            احجز الآن
                        </a>
                    </div>

                    <!-- المقالات المشابهة -->
                    <div class="bg-white p-4 rounded-4 shadow-sm" data-aos="fade-left" data-aos-delay="300">
                        <h5 class="mb-4" style="font-weight: 700; color: var(--dark-text); border-right: 4px solid var(--primary-red); padding-right: 15px;">
                            <i class="fas fa-newspaper me-2 text-danger"></i> مقالات أخرى
                        </h5>
                        @if(isset($relatedBlogs) && count($relatedBlogs) > 0)
                            @foreach($relatedBlogs as $relatedBlog)
                            <div class="mb-3 pb-3 border-bottom">
                                <a href="{{ route('blog.show', $relatedBlog->id) }}" class="text-decoration-none">
                                    <div class="d-flex align-items-start gap-3">
                                        <div class="flex-shrink-0">
                                            @if($relatedBlog->image)
                                                <img src="{{ asset($relatedBlog->image) }}" alt="{{ $relatedBlog->name }}" class="rounded-3" width="80" height="80" style="object-fit: cover;">
                                            @else
                                                <img src="https://placehold.co/80x80/f8f8f8/c6842f?text=RV" alt="Default" class="rounded-3" width="80" height="80">
                                            @endif
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1" style="font-weight: 600; color: var(--dark-text); font-size: 0.95rem;">{{ Str::limit($relatedBlog->name, 50) }}</h6>
                                            <small class="text-muted">
                                                <i class="far fa-calendar me-1"></i> {{ $relatedBlog->created_at->format('Y-m-d') }}
                                            </small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        @else
                            <p class="text-muted text-center py-3">لا توجد مقالات أخرى حالياً</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- مقالات ذات صلة (أسفل) -->
            @if(isset($relatedBlogs) && count($relatedBlogs) > 0)
            <div class="related-articles" data-aos="fade-up">
                <h2 class="section-title">مقالات ذات صلة</h2>
                <div class="row g-4">
                    @foreach($relatedBlogs->take(3) as $relatedBlog)
                    <div class="col-md-4">
                        <article class="blog-card">
                            <div class="blog-img-wrapper">
                                <a href="{{ route('blog.show', $relatedBlog->id) }}">
                                    @if($relatedBlog->image)
                                        <img src="{{ asset($relatedBlog->image) }}" alt="{{ $relatedBlog->name }}">
                                    @else
                                        <img src="https://placehold.co/600x400/f8f8f8/c6842f?text=Royal+View" alt="Default Image">
                                    @endif
                                </a>
                                <div class="blog-date-badge">
                                    {{ $relatedBlog->created_at->format('d') }} <br>
                                    <span style="font-size: 0.7rem; font-weight: 400;">{{ $relatedBlog->created_at->format('M') }}</span>
                                </div>
                            </div>
                            
                            <div class="blog-card-content">
                                <div class="blog-card-category">
                                    <i class="fas fa-hashtag me-1"></i> أخبار عامة
                                </div>
                                
                                <h3 class="blog-card-title">
                                    <a href="{{ route('blog.show', $relatedBlog->id) }}">{{ Str::limit($relatedBlog->name, 70) }}</a>
                                </h3>
                                
                                <div class="blog-card-excerpt">
                                    {!! Str::limit(strip_tags($relatedBlog->contant), 100) !!}
                                </div>
                                
                                <a href="{{ route('blog.show', $relatedBlog->id) }}" class="read-more-btn">
                                    <span>قراءة المزيد</span>
                                    <div class="read-more-icon">
                                        <i class="fas fa-arrow-left"></i>
                                    </div>
                                </a>
                            </div>
                        </article>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </section>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
        
        // كود المشاركة على وسائل التواصل الاجتماعي
        document.addEventListener('DOMContentLoaded', function() {
            // مشاركة على فيسبوك
            document.querySelector('.share-btn.facebook').addEventListener('click', function(e) {
                e.preventDefault();
                const url = encodeURIComponent(window.location.href);
                const title = encodeURIComponent(document.title);
                window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank');
            });
            
            // مشاركة على تويتر
            document.querySelector('.share-btn.twitter').addEventListener('click', function(e) {
                e.preventDefault();
                const url = encodeURIComponent(window.location.href);
                const text = encodeURIComponent(document.title);
                window.open(`https://twitter.com/intent/tweet?url=${url}&text=${text}`, '_blank');
            });
            
            // مشاركة على واتساب
            document.querySelector('.share-btn.whatsapp').addEventListener('click', function(e) {
                e.preventDefault();
                const url = encodeURIComponent(window.location.href);
                const text = encodeURIComponent(document.title);
                window.open(`https://wa.me/?text=${text}%20${url}`, '_blank');
            });
            
            // مشاركة على لينكدإن
            document.querySelector('.share-btn.linkedin').addEventListener('click', function(e) {
                e.preventDefault();
                const url = encodeURIComponent(window.location.href);
                window.open(`https://www.linkedin.com/sharing/share-offsite/?url=${url}`, '_blank');
            });
        });
    </script>

</body>
</html>