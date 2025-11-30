@extends('layouts.master')

@section('css')
{{-- يُفترض أن ملفات CSS الخاصة بالـ datatable وخصائص Bootstrap مُضمنة في master layout --}}
@endsection

@section('title')
الفنادق
@stop

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">الفنادق</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-right float-sm-left">
                <li class="breadcrumb-item">
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addHotelModal">
                        <i class="fa fa-plus"></i> إضافة فندق جديد
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
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="modal fade" id="addHotelModal" tabindex="-1" role="dialog" aria-labelledby="addHotelModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="addHotelModalLabel">إضافة فندق جديد</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{route('storeCategory')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label for="name">اسم الفندق</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="أدخل اسم الفندق" required>
                    </div>

                    <div class="form-group">
                        <label for="rooms">عدد الغرف</label>
                        <input type="number" name="rooms" id="rooms" class="form-control" placeholder="أدخل عدد الغرف" required min="1">
                    </div>

                    <div class="form-group">
                        <label for="beds">عدد الأسرة</label>
                        <input type="number" name="beds" id="beds" class="form-control" placeholder="أدخل عدد الأسرة" required min="1">
                    </div>

                    <div class="form-group">
                        <label for="address">العنوان</label>
                        <input type="text" name="address" id="address" class="form-control" placeholder="أدخل عنوان الفندق" required>
                    </div>

                    <div class="form-group">
                        <label for="location">الموقع (رابط الخريطة)</label>
                        <input type="url" name="location" id="location" class="form-control" placeholder="رابط الموقع علي الخريطة">
                        <small class="form-text text-muted">يمكن أن يكون رابط Google Maps أو ما شابه.</small>
                    </div>

                    <div class="form-group">
                        <label for="rate">التصنيف (التقييم)</label>
                        <input type="number" name="rate" id="rate" class="form-control" placeholder="أدخل تقييم الفندق (مثل: 5)" min="1" max="5">
                    </div>

                    <div class="form-group">
                        <label for="image">الصورة (اختياري)</label>
                        <input type="file" name="image" id="image" class="form-control-file">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-info">حفظ وإضافة</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0 text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th>اسم الفندق</th>
                                <th>الصورة</th>
                                <th>الغرف</th>
                                <th>الأسرة</th>
                                <th>العنوان</th>
                                <th>التقييم</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td class="align-middle">{{ $category->name }}</td>

                                <td class="align-middle">
                                    @if($category->image)
                                    <img src="{{ asset($category->image) }}" alt="صورة الفندق" class="img-thumbnail" style="width:50px;height:50px;object-fit: cover;">
                                    @else
                                    -
                                    @endif
                                </td>

                                <td class="align-middle">{{ $category->rooms }}</td>
                                <td class="align-middle">{{ $category->beds }}</td>
                                <td class="align-middle">{{ $category->address }}</td>
                                <td class="align-middle">
                                    <span class="badge badge-warning p-2">{{ $category->rate }} <i class="fa fa-star"></i></span>
                                </td>

                                <td class="align-middle">
                                    <button type="button" class="btn btn-primary btn-sm mx-1" data-toggle="modal" data-target="#editHotelModal{{$category->id}}" title="تعديل">
                                        <i class="fa fa-pencil"></i>
                                    </button>

                                    <button type="button" class="btn btn-warning btn-sm mx-1" data-toggle="modal" data-target="#pricesModal{{$category->id}}" title="تحديث الأسعار">
                                        <i class="fa fa-dollar"></i>
                                    </button>
                                    <button type="button" class="btn btn-info btn-sm mx-1" data-toggle="modal" data-target="#files{{$category->id}}" title="تحديث الأسعار">
                                        <i class="fa fa-file"></i>
                                    </button>

                                    <button type="button" class="btn btn-danger btn-sm mx-1" data-toggle="modal" data-target="#deleteHotelModal{{$category->id}}" title="حذف">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                </td>
                            </tr>

                            <div class="modal fade" id="editHotelModal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="editHotelModalLabel{{$category->id}}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">

                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title" id="editHotelModalLabel{{$category->id}}">تعديل فندق: {{ $category->name }}</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="{{ route('updateCategory',$category->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label>اسم الفندق</label>
                                                    <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>عدد الغرف</label>
                                                    <input type="number" name="rooms" class="form-control" value="{{ old('rooms', $category->rooms) }}" required min="1">
                                                </div>

                                                <div class="form-group">
                                                    <label>عدد الأسرة</label>
                                                    <input type="number" name="beds" class="form-control" value="{{ old('beds', $category->beds) }}" required min="1">
                                                </div>

                                                <div class="form-group">
                                                    <label>العنوان</label>
                                                    <input type="text" name="address" class="form-control" value="{{ old('address', $category->address) }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>الموقع (رابط الخريطة)</label>
                                                    <input type="url" name="location" class="form-control" value="{{ old('location', $category->location) }}">
                                                </div>

                                                <div class="form-group">
                                                    <label>التصنيف (التقييم)</label>
                                                    <input type="number" name="rate" class="form-control" value="{{ old('rate', $category->rate) }}" min="1" max="5">
                                                </div>

                                                <div class="form-group">
                                                    <label>الصورة الحالية:</label>
                                                    @if($category->image)
                                                        <img src="{{ asset($category->image) }}" alt="صورة الفندق الحالية" class="img-thumbnail d-block mb-2" style="width:80px;height:80px;object-fit: cover;">
                                                    @else
                                                        <p class="text-muted">لا توجد صورة حالية.</p>
                                                    @endif
                                                    <label>الصورة الجديدة (اختياري)</label>
                                                    <input type="file" name="image" class="form-control-file">
                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
<div class="modal fade" id="pricesModal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="pricesModalLabel{{$category->id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">

            {{-- Header --}}
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title fw-bold  text-white" id="pricesModalLabel{{$category->id}}">
                    تحديث أسعار الفندق - {{ $category->name }}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('updatePrices', $category->id) }}" method="post">
                @csrf

                {{-- Body --}}
                <div class="modal-body bg-light">

                    <div class="alert alert-secondary text-center border" role="alert">
                        <i class="fa fa-info-circle"></i>
                        قم بإدخال سعر الغرفة وعدد الغرف المتاحة حسب عدد الأسرة من 1 إلى 5.
                    </div>

                    <div class="row">
                        @for($beds = 1; $beds <= 5; $beds++)
                            @php
                                $labelName     = ($beds == 1) ? 'كينج' : $beds . ' سرير';
                                $dbPriceName   = $beds;
                                $currentPrice  = $category->prices->where('name', $dbPriceName)->first()->price ?? '';
                                $roomAvailable = $category->prices->where('name', $dbPriceName)->first()->roomAvailable ?? '';
                            @endphp

                            <div class="col-md-6 mb-4">
                                <div class="p-3 rounded bg-white border shadow-sm">

                                    <h6 class="fw-bold mb-3 text-dark">
                                        غرفة {{ $labelName }}
                                    </h6>

                                    {{-- price --}}
                                    <div class="form-group mb-3">
                                        <label class="small text-muted">السعر</label>
                                        <input 
                                            type="number"
                                            name="prices[{{ $beds }}][price]"
                                            class="form-control border-dark"
                                            placeholder="أدخل السعر"
                                            value="{{ $currentPrice }}"
                                            min="0">
                                    </div>

                                    {{-- available --}}
                                    <div class="form-group mb-1">
                                        <label class="small text-muted">عدد الغرف المتاحة</label>
                                        <input 
                                            type="number"
                                            name="prices[{{ $beds }}][roomAvailable]"
                                            class="form-control border-dark"
                                            placeholder="عدد الغرف المتاحة"
                                            value="{{ $roomAvailable }}"
                                            min="0">
                                    </div>

                                </div>
                            </div>
                        @endfor
                    </div>

                </div>

                {{-- Footer --}}
                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-warning fw-bold">حفظ البيانات</button>
                </div>

            </form>

        </div>
    </div>
</div>




  <div class="modal fade" id="files{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="files{{$category->id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="files{{$category->id}}">إدارة ملفات فندق: {{ $category->name }}</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                
                {{-- Tabs Navigation --}}
                <ul class="nav nav-tabs" id="filesTab{{$category->id}}" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="upload-tab{{$category->id}}" data-toggle="tab" href="#upload{{$category->id}}" role="tab" aria-controls="upload{{$category->id}}" aria-selected="true">رفع صور جديدة</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="manage-tab{{$category->id}}" data-toggle="tab" href="#manage{{$category->id}}" role="tab" aria-controls="manage{{$category->id}}" aria-selected="false">الصور الحالية ({{ $category->files->count() ?? 0 }})</a>
                    </li>
                </ul>

                {{-- Tabs Content --}}
                <div class="tab-content pt-3" id="filesTabContent{{$category->id}}">
                    
                    {{-- Tab 1: Upload Files --}}
                    <div class="tab-pane fade show active" id="upload{{$category->id}}" role="tabpanel" aria-labelledby="upload-tab{{$category->id}}">
                        <form action="{{ route('files.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="category_id" value="{{ $category->id }}">

                            <div class="form-group">
                                <label>رفع الصور</label>
                                <input type="file" name="images[]" multiple class="form-control-file border p-1" required>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info">رفع الصور</button>
                            </div>
                        </form>
                    </div>

                    {{-- Tab 2: Manage Current Files --}}
                    <div class="tab-pane fade" id="manage{{$category->id}}" role="tabpanel" aria-labelledby="manage-tab{{$category->id}}">
                        
                        @if($category->files->count() > 0)
                            <div class="row">
                                @foreach($category->files as $file)
                                <div class="col-md-4 mb-4">
                                    <div class="card shadow-sm h-100">
                                        <img src="{{ asset($file->image) }}" class="card-img-top" alt="صورة فندق" style="height: 150px; object-fit: cover;">
                                        <div class="card-body p-2 text-center">
                                            {{-- زر الحذف --}}
                                            <form action="{{ route('deleteFile', $file->id) }}" method="post" onsubmit="return confirm('هل أنت متأكد من حذف هذه الصورة؟');">
                                                @csrf
                                                @method('DELETE') {{-- يُفترض استخدام DELETE لعمليات الحذف --}}
                                                <button type="submit" class="btn btn-danger btn-sm btn-block">
                                                    <i class="fa fa-trash"></i> حذف
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-warning text-center">
                                <i class="fa fa-exclamation-circle"></i> لا توجد صور حالية لهذا الفندق.
                            </div>
                        @endif

                    </div>

                </div>
            </div>
            
            <div class="modal-footer justify-content-between">
                {{-- زر الإغلاق لـ Modal بالكامل --}}
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق النافذة</button>
            </div>
            
        </div>
    </div>
</div>

                            <div class="modal fade" id="deleteHotelModal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteHotelModalLabel{{$category->id}}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="deleteHotelModalLabel{{$category->id}}">تأكيد حذف فندق</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="{{route('deleteCategory',$category->id)}}" method="post">
                                            @csrf
                                            
                                            <div class="modal-body">
                                                <h5 class="text-center text-danger">
                                                    <i class="fa fa-exclamation-triangle"></i> هل أنت متأكد أنك تريد حذف فندق: **{{ $category->name }}**؟
                                                </h5>
                                                <p class="text-center text-muted">لا يمكن التراجع عن هذا الإجراء.</p>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                <button type="submit" class="btn btn-danger">نعم، متأكد</button>
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

@endsection

@section('js')
{{-- يُفترض أن ملفات JS الخاصة بالـ datatable وخصائص Bootstrap مُضمنة في master layout --}}
@endsection