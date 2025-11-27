@extends('layouts.master')

@section('css')
@endsection

@section('title')
قائمة المستندات
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">قائمة المستندات</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item">
                <a href="{{ route('addDocument') }}" class="btn btn-info">
                        <i class="fa fa-plus"></i> إضافة مستند جديد
                </a>
                </li>
            </ol>
        </div>
    </div>
</div>
<a href="{{ route('showAllDocs') }}" class="btn btn-primary">جميع المستندات</a>
<a href="{{ route('showExpiringDocs') }}" class="btn btn-warning">مستندات علي وشك الانتهاء</a>
<!-- breadcrumb -->
@endsection

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- فلتر حسب النوع -->
<div class="row mb-3 ">
    <div class="col-md-4 " >
        <select id="documentTypeFilter" class="form-control m-2 p-1">
            <option value=""  >جميع الأنواع</option>
            @foreach($types as $type)
                <option value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<!-- جدول عرض المستندات -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0" style="text-align:center">
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>تاريخ الانتهاء</th>
                                <th>باقي الأيام</th>
                                <th>النوع</th>
                                <th>الملفات</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($docs as $document)
                            <tr data-type="{{ $document->type_id ?? '' }}">
                                <td>{{ $document->name }}</td>
                                <td>{{ $document->expire_at }}</td>
                                <td>
                                    @php
                                        $expiryDate = \Carbon\Carbon::parse($document->expire_at);
                                        $remainingDays = intval(now()->diffInDays($expiryDate, false));
                                    @endphp
                                    <span class="badge @if($remainingDays < 0) badge-danger @elseif($remainingDays <= 15) badge-warning @else badge-success @endif">
                                        {{ $remainingDays < 0 ? 'منتهي' : $remainingDays . ' ' }}
                                    </span>
                                </td>
                                <td>{{ $document->type->name ?? 'غير محدد' }}</td>
                                <td><a href="{{ route('showAllfiles', $document->id) }}" class="btn btn-sm btn-info">عرض الملفات</a></td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $document->id }}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    @if (Auth::check() && Auth::user()->role == 'مسؤول')
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $document->id }}">
                                        <i class="fa fa-archive"></i>
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            <!-- // -->
                            <div class="modal fade" id="edit{{ $document->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">تعديل المستند</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('updateDocs', $document->id) }}" method="post">
                                                @csrf
                                                <input type="text" name="name" class="form-control" value="{{ $document->name }}" required>
                                                <br>
                                                <input type="date" name="expire_at" class="form-control" value="{{ $document->expire_at }}" required>
                                                <br>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                    <button type="submit" class="btn btn-primary">تحديث</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="modal fade" id="delete{{ $document->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">استبعاد المستند</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('archiveDocs', $document->id) }}" method="post">
                                            @csrf
                                            <h4 class="modal-body">هل أنت متأكد من أنك تريد استبعاد هذا المستند؟</h4>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                <button type="submit" class="btn btn-danger">استبعاد</button>
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
<script>
    document.getElementById('documentTypeFilter').addEventListener('change', function() {
        var selectedType = this.value;
        var rows = document.querySelectorAll('#datatable tbody tr');
        
        rows.forEach(row => {
            if (selectedType === "" || row.getAttribute('data-type') === selectedType) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
</script>
@endsection
