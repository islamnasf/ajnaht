@extends('layouts.master')

{{-- تضمين ملفات الـ CSS الإضافية --}}
@section('css')
    {{-- Summernote CSS --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
    
    <style>
        /* تحسين عام: محاذاة رأسية لمنتصف الخلايا */
        .table td,
        .table th {
            vertical-align: middle;
            text-align: center;
        }

        /* تنسيق صور الخدمات في الجدول */
        .service-img {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        /* تنسيق صور الأقسام داخل المودالات */
        .section-detail-img {
            max-width: 100%;
            height: auto;
            max-height: 200px; /* تصغير الارتفاع قليلاً */
            object-fit: contain;
            border-radius: 8px;
            margin-bottom: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #eee;
        }

        /* تحسين قائمة الأقسام داخل المودال الرئيسي */
        .section-item {
            border-right: 4px solid #007bff; /* استخدام الشريط على اليمين للغة العربية */
            margin-bottom: 10px;
            transition: all 0.3s;
            padding: 15px;
            border-radius: 5px;
            background-color: #fcfcfc;
            border: 1px solid #e9ecef; /* إضافة إطار خفيف */
        }

        .section-item:hover {
            background-color: #f2f4f6;
            transform: translateX(5px); /* تأثير انزلاق بسيط لليمين */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        /* تحسين الأزرار ضمن مجموعات العمليات */
        .btn-action {
            margin: 0 2px;
            min-width: 38px;
            padding: 5px 8px;
        }

        /* الإصلاح الحاسم لـ Summernote ليعمل فوق المودال (الذي قد يكون فوق مودال آخر) */
        .note-editor.note-frame {
            z-index: 9999 !important;
        }
    </style>
@endsection

@section('title') إدارة الخدمات والأقسام @stop

{{-- ========================================================= --}}
{{-- رأس الصفحة وزر إضافة خدمة جديدة --}}
{{-- ========================================================= --}}
@section('page-header')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">✨ قائمة الخدمات والأقسام</h4>
            </div>
            <div class="col-sm-6 text-left">
                <button class="btn btn-primary shadow-sm" data-toggle="modal" data-target="#addServiceModal">
                    <i class="fa fa-plus-circle"></i> إضافة خدمة جديدة
                </button>
            </div>
        </div>
    </div>
@endsection

{{-- ========================================================= --}}
{{-- المحتوى الرئيسي للخدمات والرسائل --}}
{{-- ========================================================= --}}
@section('content')
    {{-- رسائل الأخطاء (Blade directives for session messages) --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h5 class="alert-heading">⚠️ تنبيه!</h5>
            <p>يرجى مراجعة الأخطاء التالية في الإدخالات:</p>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    
    {{-- جدول عرض الخدمات --}}
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100 shadow">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">الخدمات المتوفرة ({{ $services->count() }})</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover table-bordered p-0" style="width:100%">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>#</th>
                                    <th>اسم الخدمة</th>
                                    <th>الصورة</th>
                                    <th>عدد الأقسام</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($services as $service)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="font-weight-bold">{{ $service->name }}</td>
                                        <td>
                                            @if($service->image)
                                                <img src="{{ asset($service->image) }}" class="service-img" alt="{{ $service->name }}">
                                            @else
                                                <span class="text-muted small">لا توجد صورة</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-info" data-toggle="modal"
                                                data-target="#sectionsModal{{ $service->id }}">
                                                <i class="fa fa-list-alt"></i> عرض الأقسام ({{ $service->sections->count() }})
                                            </button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm btn-action" title="تعديل"
                                                data-toggle="modal" data-target="#editService{{ $service->id }}">
                                                <i class="fa fa-edit"></i>
                                            </button>

                                            <button type="button" class="btn btn-danger btn-sm btn-action" title="حذف"
                                                data-toggle="modal" data-target="#deleteService{{ $service->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ========================================================= --}}
    {{-- [مودالات الخدمات] إضافة، تعديل، حذف --}}
    {{-- ========================================================= --}}

    {{-- 1. مودال إضافة خدمة جديدة --}}
    <div class="modal fade" id="addServiceModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">➕ إضافة خدمة جديدة</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <form action="{{ route('services.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="font-weight-bold">اسم الخدمة <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="أدخل اسم الخدمة" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">صورة الخدمة (اختياري)</label>
                            <input type="file" name="image" class="form-control-file p-1 border rounded">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> حفظ الخدمة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- مودالات التعديل والحذف لكل خدمة (حلقة التكرار) --}}
    @foreach($services as $service)
        {{-- 2. مودال تعديل الخدمة --}}
        <div class="modal fade" id="editService{{ $service->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title">✏️ تعديل الخدمة: <span class="font-weight-bold">{{ $service->name }}</span></h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">×</button>
                    </div>
                    <form action="{{ route('services.update', $service->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="font-weight-bold">اسم الخدمة</label>
                                <input type="text" name="name" class="form-control" value="{{ $service->name }}" required>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">الصورة الحالية / تغيير الصورة</label>
                                <div class="row align-items-center">
                                    <div class="col-md-4 mb-2">
                                        @if($service->image)
                                            <img src="{{ asset($service->image) }}" class="img-thumbnail" style="max-height:80px; width: auto; border-radius:5px;">
                                        @else
                                            <span class="text-muted small">لا توجد صورة حالية</span>
                                        @endif
                                    </div>
                                    <div class="col-md-8">
                                        <input type="file" name="image" class="form-control-file border p-1 rounded">
                                        <small class="text-muted">اترك الحقل فارغاً إذا كنت لا تريد تغيير الصورة.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> حفظ التغييرات</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- 3. مودال حذف الخدمة --}}
        <div class="modal fade" id="deleteService{{ $service->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">🗑️ حذف الخدمة</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">×</button>
                    </div>
                    <form action="{{ route('services.delete', $service->id) }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="alert alert-warning text-center">
                                <i class="fa fa-exclamation-triangle fa-2x d-block mb-2"></i>
                                <p class="mb-1">هل أنت متأكد تماماً من حذف الخدمة: <strong>{{ $service->name }}</strong>؟</p>
                                <p class="text-danger small font-weight-bold">سيتم حذف جميع الأقسام التابعة لها ولا يمكن التراجع!</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                            <button type="submit" class="btn btn-danger">تأكيد الحذف</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    {{-- ========================================================= --}}
    {{-- [مودالات الأقسام] عرض/إضافة/تعديل/حذف --}}
    {{-- (مودالات متداخلة - يجب الاهتمام بـ JS لتشغيل Summernote والـ z-index) --}}
    {{-- ========================================================= --}}

    @foreach($services as $service)
        {{-- 1. مودال عرض وإدارة الأقسام (المودال الرئيسي) --}}
        <div class="modal fade sections-main-modal" id="sectionsModal{{ $service->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title"><i class="fa fa-th-list"></i> أقسام خدمة: <strong>{{ $service->name }}</strong></h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">×</button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-4 text-right">
                            <button class="btn btn-success" data-toggle="modal"
                                data-target="#addSectionModal{{ $service->id }}">
                                <i class="fa fa-plus"></i> إضافة قسم جديد
                            </button>
                        </div>

                        {{-- قائمة الأقسام --}}
                        @if($service->sections->count() > 0)
                            <div class="list-group">
                                @foreach($service->sections->sortBy('created_at') as $section)
                                    <div class="section-item d-flex justify-content-between align-items-center">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 font-weight-bold text-primary">{{ $section->title }}</h6>
                                            <small class="text-muted">{!! Str::limit(strip_tags($section->contant), 100) !!}</small>
                                        </div>
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-info btn-sm btn-action" title="عرض وتعديل" data-toggle="modal"
                                                data-target="#showEditSection{{ $section->id }}">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                            <button class="btn btn-danger btn-sm btn-action" title="حذف" data-toggle="modal"
                                                data-target="#deleteSection{{ $section->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-warning text-center">
                                <i class="fa fa-info-circle"></i> لا توجد أقسام مُضافة لهذه الخدمة بعد. استخدم زر **إضافة قسم جديد** بالأعلى.
                            </div>
                        @endif
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. مودال إضافة قسم (مودال فرعي) --}}
        <div class="modal fade" id="addSectionModal{{ $service->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document"> {{-- modal-xl للحصول على مساحة أكبر للمحرر --}}
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">➕ إضافة قسم جديد للخدمة: <span class="font-weight-bold">{{ $service->name }}</span></h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">×</button>
                    </div>
                    <form action="{{ route('sections.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="service_id" value="{{ $service->id }}">
                            <div class="form-group">
                                <label class="font-weight-bold">عنوان القسم <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" placeholder="عنوان القسم" value="{{ old('title') }}" required>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">صورة القسم (اختياري)</label>
                                <input type="file" name="image" class="form-control-file border p-1 rounded">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">المحتوى <span class="text-danger">*</span></label>
                                {{-- استخدام ID فريد لضمان تهيئة Summernote بشكل صحيح --}}
                                <textarea name="contant" class="form-control summernote" id="summernote-new-{{$service->id}}"
                                    required>{{ old('contant') }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> حفظ القسم</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    {{-- مودالات عرض/تعديل وحذف الأقسام (حلقة تكرار إضافية لتنظيم المودالات) --}}
    @foreach($services as $service)
        @foreach($service->sections as $section)
            {{-- 3. مودال عرض وتعديل القسم (مودال فرعي) --}}
            <div class="modal fade" id="showEditSection{{ $section->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-info text-white">
                            <h5 class="modal-title">📝 تفاصيل وتعديل القسم: <span class="font-weight-bold">{{ $section->title }}</span></h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">×</button>
                        </div>
                        <form action="{{ route('sections.update', $section->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <input type="hidden" name="service_id" value="{{ $service->id }}">

                                <div class="form-group">
                                    <label class="font-weight-bold">عنوان القسم</label>
                                    <input type="text" name="title" class="form-control" value="{{ $section->title }}" required>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">الصورة</label>
                                    <div class="row align-items-center border p-3 rounded">
                                        <div class="col-md-6 mb-3 text-center">
                                            <p class="mb-1 text-muted small">الصورة الحالية</p>
                                            @if($section->image)
                                                <img src="{{ asset($section->image) }}" class="section-detail-img">
                                            @else
                                                <span class="text-muted">لا توجد صورة حالية</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <label for="image-{{$section->id}}">تغيير الصورة</label>
                                            <input type="file" name="image" id="image-{{$section->id}}"
                                                class="form-control-file border p-1 rounded">
                                            <small class="text-muted">اترك الحقل فارغاً إذا لم تُرِد تغيير الصورة.</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">المحتوى</label>
                                    {{-- استخدام ID فريد لتهيئة Summernote --}}
                                    <textarea name="contant" class="form-control summernote"
                                        id="summernote-{{$section->id}}">{!! $section->contant !!}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> حفظ التغييرات</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- 4. مودال حذف القسم (مودال فرعي) --}}
            <div class="modal fade" id="deleteSection{{ $section->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title">🗑️ حذف القسم</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">×</button>
                        </div>
                        <form action="{{ route('sections.delete', $section->id) }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="alert alert-danger text-center">
                                    <i class="fa fa-times-circle fa-2x d-block mb-2"></i>
                                    <p class="mb-1">هل أنت متأكد من حذف القسم: <strong>{{ $section->title }}</strong>؟</p>
                                    <p class="small font-weight-bold">لا يمكن التراجع عن هذا الإجراء.</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                <button type="submit" class="btn btn-danger">تأكيد الحذف</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
@endsection

{{-- ========================================================= --}}
{{-- تضمين ملفات الـ JS وحلول Summernote والمودالات المتداخلة --}}
{{-- ========================================================= --}}
@section('js')
    {{-- مكتبات Summernote --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/lang/summernote-ar-AR.min.js"></script>

    <script>
        $(document).ready(function() {
            
            // *** 1. دالة تهيئة Summernote المُحسّنة (لضمان عمله داخل المودال) ***
            function initSummernote(selector) {
                // تدمير Summernote إذا كان مُهيأ مسبقاً لضمان بيئة نظيفة داخل المودال المتكرر
                if ($(selector).data('summernote')) {
                    $(selector).summernote('destroy'); 
                }

                $(selector).summernote({
                    placeholder: 'اكتب المحتوى التفصيلي هنا...',
                    tabsize: 2,
                    height: 250, // زيادة الارتفاع قليلاً
                    lang: 'ar-AR',
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ],
                    // مهم جداً لعمل Summernote داخل مودال
                    dialogsInBody: true,
                    dialogsFade: true,
                    callbacks: {
                        onInit: function() {
                            // ضبط Z-Index لأداة Summernote الرئيسية لتظهر فوق المودال
                            setTimeout(function() {
                                $(selector).closest('.note-editor').css('z-index', 9999);
                                // ضبط z-index لنوافذ الروابط والصور (محتويات المودالات الداخلية لـ Summernote)
                                $('.note-modal').css('z-index', 10000); 
                            }, 100);
                        }
                    }
                });
            }
            
            // *** 2. معالجة فتح وإغلاق المودالات (لتهيئة Summernote وتنظيفه) ***
            
            // عند فتح أي مودال
            $('.modal').on('shown.bs.modal', function() {
                var currentModal = $(this);
                // تهيئة Summernote داخل المودال المفتوح حالياً فقط
                currentModal.find('.summernote').each(function() {
                    initSummernote(this);
                });
            });

            // عند إغلاق أي مودال
            $('.modal').on('hidden.bs.modal', function() {
                var currentModal = $(this);
                // تدمير Summernote عند إغلاق المودال
                currentModal.find('.summernote').each(function() {
                    if ($(this).data('summernote')) {
                        $(this).summernote('destroy');
                    }
                });
            });

            // *** 3. حل مشكلة الـ z-index والـ backdrop للمودالات المتعددة (Stacked Modals) ***
            // لضمان عمل المودال الفرعي (مثل تعديل القسم) فوق المودال الأصلي (الأقسام)
            
            $(document).on('show.bs.modal', '.modal', function() {
                // زيادة Z-index لكل مودال يتم فتحه
                var zIndex = 1050 + (10 * $('.modal:visible').length);
                $(this).css('z-index', zIndex);
                
                setTimeout(function() {
                    // ضبط Z-index للـ backdrop ليكون أسفل المودال مباشرة
                    var lastBackdropIndex = 1040 + (10 * $('.modal:visible').length);
                    $('.modal-backdrop').not(':last').remove(); // إزالة الـ backdrops القديمة الزائدة
                    $('<div class="modal-backdrop fade show"></div>').css('z-index', lastBackdropIndex).appendTo('body');
                }, 10);
            });
            
            // معالجة التنظيف عند إغلاق المودالات
            $(document).on('hidden.bs.modal', '.modal', function() {
                $('.modal-backdrop').not(':last').remove(); // إزالة أي backdrops فائضة
                if ($('.modal:visible').length === 0) {
                    // إذا لم يعد هناك أي مودال مرئي، قم بالتنظيف النهائي
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove(); 
                } else {
                    // إذا كان هناك مودال متبقٍ، تأكد من وجود backdrop واحد فقط له
                    $('.modal-backdrop:last').css('z-index', 1040 + ($('.modal:visible').length - 1) * 10);
                }
            });

            // منع إغلاق مودال الأقسام (المودال الأم) عند النقر على أزرار فتح المودالات الفرعية
            $(document).on('click', '.sections-main-modal .btn-group button', function(e) {
                e.stopPropagation(); 
            });
        });
    </script>
@endsection