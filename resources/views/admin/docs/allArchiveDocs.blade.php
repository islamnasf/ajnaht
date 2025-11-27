@extends('layouts.master')

@section('css')
@endsection

@section('title')
قائمة المستندات المستيعده
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">قائمة المستندات المستبعده </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <!-- <li class="breadcrumb-item">
                    <a href="{{ route('addDocument') }}" class="btn btn-info">
                        <i class="fa fa-plus"></i> إضافة مستند جديد
                    </a>
                </li> -->
            </ol>
        </div>
    </div>
</div>
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
                                <th> باقي الايام</th>

                                <th>النوع</th>
                                <th>الملفات</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($docs as $document)
                            <tr>
                                <td>{{ $document->name }}</td>
                                <td>{{ $document->expire_at }}</td>
                                <td>
    @php
        $expiryDate = \Carbon\Carbon::parse($document->expire_at);
        $remainingDays = intval(now()->diffInDays($expiryDate, false)); // تحويل الرقم إلى عدد صحيح
    @endphp

    <span style="font-size:15px; padding: 8px;" class="badge 
        @if($remainingDays < 0) badge-danger 
        @elseif($remainingDays <= 15) badge-warning 
        @else badge-success 
        @endif">
        {{ $remainingDays < 0 ? 'منتهي' : $remainingDays . ' ' }}
    </span>
</td>
                                <td>{{ $document->type->name ?? 'غير محدد' }}</td>
                                <!-- <td>
                                    @foreach($document->files as $file)
                                        <a href="{{ asset('storage/' . $file->file) }}" target="_blank" class="btn btn-sm btn-success">عرض</a>
                                    @endforeach
                                </td> -->
                                <td><a href="{{ route('showAllfiles', $document->id) }}" target="_blank" class="btn btn-sm btn-info">عرض الملفات </a> </td>

                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $document->id }}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    @if (Auth::check() && Auth::user()->role == 'مسؤول')

                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#delete{{ $document->id }}">
                                        <i class="fa fa-undo"></i>
                                    </button>
                                    @endif


                                </td>
                            </tr>

                            <!-- نافذة تعديل المستند -->
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

                            <!-- المستند -->
                            <div class="modal fade" id="delete{{ $document->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">استعادة المستند</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('unarchiveDocs', $document->id) }}" method="post">
                                            @csrf
                                            <h4 class="modal-body">هل أنت متأكد من أنك تريد استعادة هذا المستند؟</h4>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                <button type="submit" class="btn btn-danger">استعادة</button>
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
@endsection