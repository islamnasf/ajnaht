@extends('layouts.master')

@section('css')
@endsection

@section('title')
المستخدمين
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">المستخدمين</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item">
                    <div>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addUserModal" style="font-size: 18px; font-family:Amiri; line-height: 1.2;">
                            <i class="fa fa-user-plus"></i> - إضافة مستخدم جديد
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

<!-- نافذة إضافة مستخدم -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">إضافة مستخدم</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.users.store') }}" method="post">
                    @csrf
                    <input type="text" name="name" class="form-control" placeholder="الاسم">
                    <br>
                    <input type="email" name="email" class="form-control" placeholder="البريد الإلكتروني">
                    <br>
                    <input type="text" name="phone" class="form-control" placeholder="رقم الهاتف">
                    <br>
                    <input type="password" name="password" class="form-control" placeholder="كلمة المرور">
                    <br>
                    <label style="font-size: 13px; font-weight: bold;" class="ml-3">الدور</label>
                    <select name="role" class="form-control">
                        <option value="مسؤول">مسؤول</option>
                        <option value="موظف">موظف</option>
                    </select>
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

<!-- جدول المستخدمين -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0" style="text-align:center">
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>البريد الإلكتروني</th>
                                <th>رقم الهاتف</th>
                                <th>الدور</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ ucfirst($user->role) }}</td>
                                <td>
                                    <!-- زر تعديل المستخدم -->
                                    @if (Auth::check() && Auth::user()->role == 'مسؤول')
                                    @if ($user->role == 'موظف') 

                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $user->id }}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    @endif

                                    @endif


                                    <!-- نافذة تعديل المستخدم -->
                                    <div class="modal fade" id="edit{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">تعديل المستخدم</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('updateusers', $user->id) }}" method="post">
                                                        @csrf
                                                        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                                                        <br>
                                                        <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                                                        <br>
                                                        <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">

                                                        <br>
                                                        <input type="password" name="password" class="form-control" placeholder="كلمة المرور" value="{{ $user->phone }}">
                                                        <br>
                                                        <label style="font-size: 13px; font-weight: bold;" class="ml-3">الدور</label>
                                                        <select name="role" class="form-control">
                                                            <option value="admin" {{ $user->role == 'مسؤول' ? 'selected' : '' }}>مسؤول</option>
                                                            <option value="employee" {{ $user->role == 'موظف' ? 'selected' : '' }}>موظف</option>
                                                        </select>
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

                                    <!-- زر حذف المستخدم -->
                                    @if (Auth::check() && Auth::user()->role == 'مسؤول')
                                    @if ($user->role == 'موظف') 

                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $user->id }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    @endif

                                    @endif

                                    <!-- نافذة حذف المستخدم -->
                                    <div class="modal fade" id="delete{{ $user->id }}" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">حذف المستخدم</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="post">
                                                    @csrf
                                                    <h4 class="modal-body">
                                                        هل أنت متأكد من أنك تريد حذف هذا المستخدم؟
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