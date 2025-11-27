@extends('layouts.master')

@section('title')
اعدادات الموقع
@endsection

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        .form-label {
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
        }
        .form-control {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 10px 15px;
            box-shadow: none;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }
        .section-header {
            border-bottom: 2px solid #f1f1f1;
            padding-bottom: 10px;
            margin-bottom: 20px;
            margin-top: 20px;
            color: #4e73df;
            font-weight: bold;
            font-size: 1.1rem;
        }
        .img-preview {
            border: 1px solid #ddd;
            padding: 5px;
            border-radius: 8px;
            background: #f9f9f9;
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-top: 10px;
        }
        .input-group-text {
            background-color: #f8f9fc;
            border-color: #ddd;
            border-radius: 0 8px 8px 0 !important; /* RTL adjustment */
        }
        /* RTL Adjustments for Input Group */
        .input-group > .form-control {
            border-radius: 8px 0 0 8px !important;
        }
    </style>
@endsection

@section('page-header')
<div class="page-title mt-3 mb-3">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="mb-0 font-weight-bold text-dark">
                <i class="fas fa-cogs mr-2 text-primary"></i> اعدادات الموقع
            </h4>
        </div>
    </div>
</div>
@endsection

@section('content')

@if ($errors->any())
<div class="alert alert-danger shadow-sm border-0" role="alert">
    <h6 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> يرجى الانتباه للأخطاء التالية:</h6>
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
    <strong><i class="fas fa-check-circle"></i> تم بنجاح!</strong> {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="card shadow-lg border-0 mb-5" style="border-radius: 15px;">
    <div class="card-header bg-white py-3">
        <h6 class="m-0 font-weight-bold text-primary">تعديل بيانات الموقع العامة</h6>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('siteData.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="section-header">
                <i class="fas fa-info-circle ml-2"></i> المعلومات الأساسية
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">اسم الموقع</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-globe"></i></span>
                        </div>
                        <input type="text" name="name" class="form-control" value="{{ $data->name }}" placeholder="أدخل اسم الموقع">
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">الوصف القصير (Meta Description)</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-align-right"></i></span>
                        </div>
                        <input type="text" name="description" class="form-control" value="{{ $data->description }}" placeholder="وصف مختصر للموقع">
                    </div>
                </div>
            </div>

            <div class="section-header">
                <i class="fas fa-images ml-2"></i> الصور والوسائط
            </div>
            <div class="row">
                <div class="col-md-4 mb-3 text-center">
                    <label class="form-label d-block">اللوجو (الشعار)</label>
                    <input type="file" name="logo" class="form-control-file mb-2">
                    @if($data->logo)
                        <img src="{{ asset($data->logo) }}" class="img-preview shadow-sm">
                    @else
                        <div class="text-muted small mt-2">لا يوجد شعار</div>
                    @endif
                </div>

                <div class="col-md-4 mb-3 text-center">
                    <label class="form-label d-block">صورة الهيدر (الغلاف)</label>
                    <input type="file" name="imageHeader" class="form-control-file mb-2">
                    @if($data->imageHeader)
                        <img src="{{ asset($data->imageHeader) }}" class="img-preview shadow-sm">
                    @endif
                </div>

                <div class="col-md-4 mb-3 text-center">
                    <label class="form-label d-block">صورة "من نحن"</label>
                    <input type="file" name="aboutImage" class="form-control-file mb-2">
                    @if($data->aboutImage)
                        <img src="{{ asset($data->aboutImage) }}" class="img-preview shadow-sm">
                    @endif
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12 mb-3">
                    <label class="form-label">النص الطويل (عن الموقع)</label>
                    <textarea id="editor" name="textarea" class="form-control">{{ $data->textarea }}</textarea>
                </div>
            </div>

            <div class="section-header">
                <i class="fas fa-address-card ml-2"></i> معلومات التواصل
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">البريد الإلكتروني</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" name="email" class="form-control" value="{{ $data->email }}" style="direction: ltr; text-align: right;">
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">العنوان</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                        </div>
                        <input type="text" name="address" class="form-control" value="{{ $data->address }}">
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">هاتف 1</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                        <input type="text" name="phone1" class="form-control" value="{{ $data->phone1 }}" style="direction: ltr; text-align: right;">
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">هاتف 2</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                        </div>
                        <input type="text" name="phone2" class="form-control" value="{{ $data->phone2 }}" style="direction: ltr; text-align: right;">
                    </div>
                </div>
                 <div class="col-md-12 mb-3">
                    <label class="form-label">رابط الخريطة (Google Map)</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-map-marked"></i></span>
                        </div>
                        <input type="text" name="location" class="form-control" value="{{ $data->location }}" placeholder="Embed Link or URL">
                    </div>
                </div>
            </div>

            <div class="section-header">
                <i class="fas fa-share-alt ml-2"></i> التواصل الاجتماعي
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">فيسبوك</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary text-white"><i class="fab fa-facebook-f"></i></span>
                        </div>
                        <input type="text" name="faceLink" class="form-control" value="{{ $data->faceLink }}">
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">انستجرام</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-danger text-white"><i class="fab fa-instagram"></i></span>
                        </div>
                        <input type="text" name="instaLink" class="form-control" value="{{ $data->instaLink }}">
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">واتساب</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-success text-white"><i class="fab fa-whatsapp"></i></span>
                        </div>
                        <input type="text" name="wattsLink" class="form-control" value="{{ $data->wattsLink }}">
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <button class="btn btn-primary btn-lg btn-block shadow-sm" style="border-radius: 10px;">
                <i class="fas fa-save ml-2"></i> حفظ التعديلات
            </button>

        </form>
    </div>
</div>

@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#editor').summernote({
                height: 250,
                lang: 'ar-AR', // يفضل إضافة ملف اللغة العربية لـ Summernote اذا كان متوفراً لديك
                placeholder: 'اكتب تفاصيل النص الطويل والمحتوى التعريفي هنا...',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
@endsection