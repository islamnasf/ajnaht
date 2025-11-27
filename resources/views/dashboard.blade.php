@extends('layouts.master')
@section('css')
@section('title')
dashboard
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> الرئيسية  </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item" class="default-color"> لحة التحكم </li>
                <li class="breadcrumb-item active">  الرئيسية </li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
        <div class="col-sm-12">
        <img src="{{ URL::asset('assets/images/logo-dark.png') }}" alt="" style=" width:100%; margin-bottom: 20px; border-radius: 25px 0px 25px 0px; " >
        </div>
    </div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row mb-30">
  
    <!-- <a href="{{ route('getDocs') }}" class="col-md-4 mb-4"  >
        <div class="card text-center bg-mauve">
            <div class="card-body" style="background-color: #2A132A;">
                <i class="fa fa-list-ul fa-3x mb-2 text-light "></i>
                <h5 class="card-title text-light font-size-lg"> المستندات </h5>
            </div>
        </div>
    </a> -->
    <!-- <a href="{{ route('getSubCategory') }}" class="col-md-4 mb-4" >
        <div class="card text-center bg-mauve">
            <div class="card-body" style="background-color: #2A132A;">
                <i class="fa fa-sitemap fa-3x mb-2 text-light "></i>
                <h5 class="card-title text-light font-size-lg">SubCategories </h5>
            </div>
        </div>
    </a> -->
     <!-- <a href="{{ route('getVendor') }}" class="col-md-4 mb-4"  >
        <div class="card text-center bg-mauve" >
            <div class="card-body" style="background-color: #2A132A;">
                <i class="ti-palette fa-3x mb-2 text-light "></i>
                <h5 class="card-title text-light font-size-lg">Vendor </h5>
            </div>
        </div>
    </a> -->
    <!-- <a href="{{ route('admin.users.index') }}" class="col-md-4 mb-4"  >
        <div class="card text-center bg-mauve" >
            <div class="card-body" style="background-color: #2A132A;">
                <i class="fa fa-user fa-3x mb-2 text-light "></i>
                <h5 class="card-title text-light font-size-lg">المستخدمين  </h5>
            </div>
        </div>
    </a> -->
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection 
