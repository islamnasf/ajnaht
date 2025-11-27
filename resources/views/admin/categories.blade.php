@extends('layouts.master')
@section('css')

@section('title')
الفنادق
@stop
@endsection

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">الفنادق</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" style="font-size: 18px; font-family:Amiri;line-height: 1.2;">
                        <i class="fa fa-flag"></i> - إضافة فندق جديد
                    </button>
                </li>
            </ol>
        </div>
    </div>
</div>
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

<!-- Add Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة فندق</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{route('storeCategory')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <input type="text" name="name" class="form-control" placeholder="اسم الفندق">
                    <br>

                    <label class="ml-3">عدد الغرف</label>
                    <input type="text" name="rooms" class="form-control" placeholder="عدد الغرف">
                    <br>

                    <label class="ml-3">عدد الأسرة</label>
                    <input type="text" name="beds" class="form-control" placeholder="عدد الأسرة">
                    <br>

                    <label class="ml-3">العنوان</label>
                    <input type="text" name="address" class="form-control" placeholder="عنوان الفندق">
                    <br>
                       <label class="ml-3"> الموقع</label>
                    <input type="text" name="location" class="form-control" placeholder=" الموقع علي الخريطة ">
                    <br>

                    <label class="ml-3">التصنيف</label>
                    <input type="text" name="rate" class="form-control" placeholder="تقييم الفندق">
                    <br>

                    <label class="ml-3">الصورة (اختياري)</label>
                    <input type="file" name="image" class="form-control">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                <button type="submit" class="btn btn-primary">إضافة</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Table -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0" style="text-align:center">
                        <thead>
                            <tr>
                                <th>اسم الفندق</th>
                                <th>الصورة</th>
                                <th>عدد الغرف</th>
                                <th>عدد الأسرة</th>
                                <th>العنوان</th>
                                <th>التقييم</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>

                                <td>
                                    @if($category->image)
                                    <img src="{{ asset($category->image) }}" style="width:40px;height:40px">
                                    @endif
                                </td>

                                <td>{{ $category->rooms }}</td>
                                <td>{{ $category->beds }}</td>
                                <td>{{ $category->address }}</td>
                                <td>{{ $category->rate }}</td>

                                <td>

                                    <!-- Edit Button -->
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{$category->id}}">
                                        <i class="fa fa-edit"></i>
                                    </button>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="edit{{$category->id}}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title">تعديل فندق</h5>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <form action="{{ route('updateCategory',$category->id) }}" method="post" enctype="multipart/form-data">
                                                        @csrf

                                                        <label>اسم الفندق</label>
                                                        <input type="text" name="name" class="form-control" value="{{ $category->name }}">
                                                        <br>

                                                        <label>عدد الغرف</label>
                                                        <input type="text" name="rooms" class="form-control" value="{{ $category->rooms }}">
                                                        <br>

                                                        <label>عدد الأسرة</label>
                                                        <input type="text" name="beds" class="form-control" value="{{ $category->beds }}">
                                                        <br>

                                                        <label>العنوان</label>
                                                        <input type="text" name="address" class="form-control" value="{{ $category->address }}">
                                                        <br>
                                                          <label>الموقع</label>
                                                        <input type="text" name="location" class="form-control" value="{{ $category->location }}">
                                                        <br>

                                                        <label>التصنيف</label>
                                                        <input type="text" name="rate" class="form-control" value="{{ $category->rate }}">
                                                        <br>

                                                        <label>الصورة (اختياري)</label>
                                                        <input type="file" name="image" class="form-control">
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                    <button type="submit" class="btn btn-primary">تعديل</button>
                                                </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Button -->
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{$category->id}}">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="delete{{$category->id}}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title">حذف فندق</h5>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>

                                                <form action="{{route('deleteCategory',$category->id)}}" method="post">
                                                    @csrf
                                                    <h4 class="modal-body">
                                                        هل أنت متأكد أنك تريد حذف هذا الفندق؟
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
