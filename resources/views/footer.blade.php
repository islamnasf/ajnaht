    <footer class="footer">
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
                <div class="col-lg-4 col-md-6">
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

                <div class="col-lg-4 col-md-6">
                    <h4 class="mb-4">معلومات التواصل</h4>
                    <ul class="list-unstyled text-muted">
                        <li class="mb-3"><i class="fas fa-map-marker-alt   me-2"></i>
                            {{ $data->address ?? 'مكة المكرمة، المملكة العربية السعودية' }}
                        </li>
                        <li class="mb-3"><i class="fas fa-phone   me-2"></i>
                            {{ $data->phone1 ?? '+966 50 123 4567' }}
                        </li>
                        <li class="mb-3"><i class="fas fa-phone   me-2"></i>
                            {{ $data->phone2 ?? '+966 50 123 4567' }}
                        </li>
                        <li class="mb-3"><i class="fas fa-envelope   me-2"></i>
                            {{ $data->email ?? 'info@royalview.com' }}
                        </li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h4 class="mb-4">روابط سريعة</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-muted text-decoration-none mb-2 d-block"><i class="fas fa-angle-left  me-2"></i> الأسئلة الشائعة</a></li>
                        <li><a href="#" class="text-muted text-decoration-none mb-2 d-block"><i class="fas fa-angle-left   me-2"></i> سياسة الخصوصية</a></li>
                        <li><a href="#" class="text-muted text-decoration-none mb-2 d-block"><i class="fas fa-angle-left   me-2"></i> الشروط والأحكام</a></li>
                        <li><a href="#about" class="text-muted text-decoration-none mb-2 d-block"><i class="fas fa-angle-left   me-2"></i> اكتشف قصتنا</a></li>
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
    
    <script>
        AOS.init({
            offset: 100,
            duration: 800,
            easing: 'ease-in-out',
            once: true,
        });
let lastScroll = 0;
const topBar = document.querySelector('.top-info-bar');

window.addEventListener('scroll', function () {
    const currentScroll = window.pageYOffset;

    if (currentScroll > lastScroll) {
        // down
        topBar.style.transform = "translateY(-100%)";
    } else {
        // up
        topBar.style.transform = "translateY(0)";
    }

    lastScroll = currentScroll;
});

        
        // إعداد الحد الأدنى لتاريخ الوصول وتاريخ المغادرة
        document.addEventListener('DOMContentLoaded', () => {
            const today = new Date().toISOString().split('T')[0];
            const checkInInput = document.getElementById('check_in_date');
            const checkOutInput = document.getElementById('check_out_date');

            if (checkInInput) {
                checkInInput.setAttribute('min', today);
                checkInInput.addEventListener('change', (e) => {
                    if (checkOutInput) {
                        checkOutInput.setAttribute('min', e.target.value);
                        // مسح تاريخ المغادرة إذا كان قبل تاريخ الوصول
                        if (checkOutInput.value && checkOutInput.value < e.target.value) {
                            checkOutInput.value = '';
                        }
                    }
                });
            }
        });
    </script>