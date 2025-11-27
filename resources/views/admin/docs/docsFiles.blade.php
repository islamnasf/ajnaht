@extends('layouts.master')

@section('title', 'ملفات المستند')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">ملفات المستند: {{ $document->name }}</h3>
    
    <!-- زر إضافة ملف جديد -->
    <button type="button" class="btn btn-info mb-3" data-toggle="modal" data-target="#addFileModal">
        <i class="fa fa-plus"></i> إضافة ملف جديد
    </button>
    
    @if($files->isEmpty())
        <div class="alert alert-warning">لا توجد ملفات لهذا المستند.</div>
    @else
    <div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0" style="text-align:center">
                        <thead>
                    <tr>
                        <th>#</th>
                        <th>عرض الملف</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($files as $index => $file)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <a href="{{ asset('storage/' . $file->file) }}" target="_blank" class="btn btn-sm btn-success">عرض</a>
                            </td>
                            <td>
                                <!-- زر حذف الملف -->
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteFile{{ $file->id }}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- نافذة تأكيد حذف الملف -->
                        <div class="modal fade" id="deleteFile{{ $file->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">حذف الملف</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('deleteDocsFile', $file->id) }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            هل أنت متأكد من أنك تريد حذف هذا الملف؟
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                            <button type="submit" class="btn btn-primary">حذف</button>
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

    @endif
    
</div>

<!-- نافذة إضافة ملف جديد -->
<div class="modal fade" id="addFileModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة ملف جديد</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('storeDocsFile', $document->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="files[]" class="form-control" multiple required>
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
@endsection
