@extends('layouts.master')

@section('css')
@endsection

@section('title')
أنواع المستندات
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">أنواع المستندات</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item">
                    <div>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addDocsTypeModal" style="font-size: 18px; font-family:Amiri; line-height: 1.2;">
                            <i class="fa fa-plus"></i> - إضافة نوع جديد
                        </button>
                    </div>
                </li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')

<!-- عرض الأخطاء -->
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<!-- نهاية الأخطاء -->

<!-- نافذة إضافة نوع وثيقة -->
<div class="modal fade" id="addDocsTypeModal" tabindex="-1" role="dialog" aria-labelledby="addDocsTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDocsTypeModalLabel">إضافة نوع مستند</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('storeDocsType') }}" method="post">
                    @csrf
                    <input type="text" name="name" class="form-control" placeholder="الاسم">
                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary">إضافة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- جدول أنواع الوثائق -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0" style="text-align:center">
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($types as $type)
                            <tr>
                                <td>{{ $type->name }}</td>
                                <td>
                                    <!-- زر تعديل نوع الوثيقة -->
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $type->id }}">
                                        <i class="fa fa-edit"></i>
                                    </button>

                                    <!-- نافذة تعديل نوع الوثيقة -->
                                    <div class="modal fade" id="edit{{ $type->id }}" tabindex="-1" aria-labelledby="editDocsTypeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">تعديل نوع المستند</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('updateDocsType', $type->id) }}" method="post">
                                                        @csrf
                                                        <input type="text" name="name" class="form-control" value="{{ $type->name }}">
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

                                    <!-- زر حذف نوع الوثيقة -->
                                    @if($type->documnet->isEmpty())
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $type->id }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    @endif
                                    <!-- نافذة حذف نوع الوثيقة -->
                                    <div class="modal fade" id="delete{{ $type->id }}" tabindex="-1" aria-labelledby="deleteDocsTypeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">حذف نوع المستند</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('deleteDocsType', $type->id) }}" method="post">
                                                    @csrf
                                                    <h4 class="modal-body">
                                                        هل أنت متأكد من أنك تريد حذف هذا النوع؟
                                                    </h4>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                        <button type="submit" class="btn btn-primary">حذف</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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

@endsection

@section('js')
@endsection