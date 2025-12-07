@extends('layouts.master')

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
    
    <style>
        /* تحسين مظهر الجدول */
        .table td, .table th {
            vertical-align: middle;
        }
        /* تنسيق الصور داخل الجدول */
        .blog-img {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        /* إصلاح مشكلة قوائم Summernote داخل الـ Modal */
        .note-editor .note-toolbar {
            z-index: 50;
        }
        .note-popover .popover {
            z-index: 1060; /* للتأكد من ظهور القوائم فوق المودال */
        }
    </style>
@endsection

@section('title')
    المقالات
@stop

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">قائمة المقالات</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <button class="btn btn-primary shadow-sm" data-toggle="modal" data-target="#addModal">
                        <i class="fa fa-plus-circle"></i> إضافة مقال جديد
                    </button>
                </li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>تنـبيـه!</strong> يرجى مراجعة الأخطاء التالية:
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

<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover table-bordered p-0" style="text-align:center">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>العنوان</th>
                                <th>الصورة البارزة</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blogs as $index => $blog)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="font-weight-bold">{{ $blog->name }}</td>
                                <td>
                                    @if($blog->image)
                                        <img src="{{ asset($blog->image) }}" class="blog-img" alt="{{ $blog->name }}">
                                    @else
                                        <span class="text-muted">لا توجد صورة</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" title="تعديل" data-toggle="modal"
                                        data-target="#edit{{ $blog->id }}">
                                        <i class="fa fa-edit"></i>
                                    </button>

                                    <button type="button" class="btn btn-danger btn-sm" title="حذف" data-toggle="modal"
                                        data-target="#delete{{ $blog->id }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <div class="modal fade" id="edit{{ $blog->id }}" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">تعديل المقال: <span class="text-primary">{{ $blog->name }}</span></h5>
                                            <button type="button" class="close" data-dismiss="modal">×</button>
                                        </div>
                                        <form action="{{ route('blogs.update', $blog->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label class="font-weight-bold">عنوان المقال</label>
                                                    <input type="text" name="name" class="form-control" value="{{ $blog->name }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label class="font-weight-bold">الصورة الحالية</label>
                                                    @if($blog->image)
                                                        <div class="mb-2">
                                                            <img src="{{ asset($blog->image) }}" style="max-height: 100px; border-radius: 5px;">
                                                        </div>
                                                    @endif
                                                    <input type="file" name="image" class="form-control-file">
                                                    <small class="text-muted">اترك الحقل فارغاً إذا كنت لا تريد تغيير الصورة.</small>
                                                </div>

                                                <div class="form-group">
                                                    <label class="font-weight-bold">المحتوى</label>
                                                    <textarea name="contant" class="form-control summernote">{!! $blog->contant !!}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                <button type="submit" class="btn btn-success">حفظ التغييرات</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="delete{{ $blog->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-danger">حذف المقال</h5>
                                            <button type="button" class="close" data-dismiss="modal">×</button>
                                        </div>
                                        <form action="{{ route('blogs.delete', $blog->id) }}" method="post">
                                            @csrf
                                            <div class="modal-body">
                                                <p>هل أنت متأكد تماماً من حذف المقال بعنوان: <strong>{{ $blog->name }}</strong>؟</p>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة مقال جديد</h5>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <form action="{{ route('blogs.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold">عنوان المقال <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="أدخل عنوان المقال" required>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">الصورة البارزة</label>
                        <input type="file" name="image" class="form-control p-1">
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">المحتوى</label>
                        <textarea name="contant" class="form-control summernote"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/lang/summernote-ar-AR.min.js"></script>

<script>
    $(document).ready(function() {
        // تهيئة Summernote
        $('.summernote').summernote({
            placeholder: 'اكتب محتوى المقال هنا...',
            tabsize: 2,
            height: 250, // ارتفاع المحرر
            lang: 'ar-AR', // تفعيل اللغة العربية
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            // تحسينات إضافية للمودال
            dialogsInBody: true,
            dialogsFade: true,
        });
    });
</script>
@endsection