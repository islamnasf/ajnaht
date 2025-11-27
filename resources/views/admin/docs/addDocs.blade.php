@extends('layouts.master')

@section('title')
إضافة مستند
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">إضافة مستند</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item">المستندات</li>
                <li class="breadcrumb-item active">إضافة مستند</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('storeNewDocs')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name" class="font-weight-bold" style="font-size: 16px;">اسم المستند</label>
                        <input type="text" name="name" class="form-control form-control-lg" required>
                    </div>

                    <div class="form-group">
                        <label for="expire_at" class="font-weight-bold" style="font-size: 16px;">تاريخ الانتهاء</label>
                        <input type="date" name="expire_at" class="form-control form-control-lg" required>
                    </div>

                    <div class="form-group">
                        <label for="type_id" class="font-weight-bold" style="font-size: 16px;">نوع المستند</label>
                        <select name="type_id" class="form-control form-control-lg">
                            <option value="">اختر النوع</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="files" class="font-weight-bold" style="font-size: 16px;">تحميل الملفات</label>
                        <input type="file" name="files[]" class="form-control form-control-lg" multiple>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary btn-lg">إضافة المستند</button>
                    </div>
                    

                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
