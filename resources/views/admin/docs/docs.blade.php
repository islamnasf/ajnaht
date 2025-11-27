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
            <h4 class="mb-0"> المستندات  </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item" class="default-color"> لحة التحكم </li>
                <li class="breadcrumb-item active">  المستندات </li>
            </ol>
        </div>
    </div>
</div>
<!-- <div class="row">
        <div class="col-sm-12">
        <img src="{{ URL::asset('assets/images/logo-dark.png') }}" alt="" style=" width:100%; margin-bottom: 20px; border-radius: 25px 0px 25px 0px; " >
        </div>
    </div> -->
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row mb-30 d-flex justify-content-center">
<a href="{{route('addDocument')}}" class="col-md-3 mb-3 text-dark text-decoration-none d-flex justify-content-center">
        <div class="card text-center d-flex align-items-center justify-content-center shadow-lg" 
             style="background-color: #2c3e50; border-radius: 20px; width: 220px; height: 160px;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center p-2">
                <i class="fa fa-plus fa-4x text-primary mb-3"></i>
                <h6 class="card-title text-light" style="font-size: 1.3rem;"> اضافة مستند</h6>
            </div>
        </div>
    </a>
    <a href="{{route('showAllDocs')}}" class="col-md-3 mb-3 text-dark text-decoration-none d-flex justify-content-center">
        <div class="card text-center d-flex align-items-center justify-content-center shadow-lg" 
             style="background-color: #2c3e50; border-radius: 20px; width: 220px; height: 160px;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center p-2">
                <i class="fa fa-folder fa-4x text-info mb-3"></i>
                <h6 class="card-title text-light" style="font-size: 1.3rem;">جميع المستندات</h6>
            </div>
        </div>
    </a>

    <a href="{{ route('getDocsType') }}" class="col-md-3 mb-3 text-dark text-decoration-none d-flex justify-content-center">
        <div class="card text-center d-flex align-items-center justify-content-center shadow-lg" 
             style="background-color: #2c3e50; border-radius: 20px; width: 220px; height: 160px;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center p-2">
                <i class="fa fa-th-list fa-4x text-light mb-3"></i>
                <h6 class="card-title text-light" style="font-size: 1.3rem;">أنواع المستندات</h6>
            </div>
        </div>
    </a>

    <a href="{{route('showAllArchiveDocs')}}" class="col-md-3 mb-3 text-dark text-decoration-none d-flex justify-content-center">
        <div class="card text-center d-flex align-items-center justify-content-center shadow-lg" 
             style="background-color: #2c3e50; border-radius: 20px; width: 220px; height: 160px;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center p-2">
                <i class="fa fa-archive fa-4x text-danger mb-3"></i>
                <h6 class="card-title text-light" style="font-size: 1.3rem;">أرشيف المستندات</h6>
            </div>
        </div>
    </a>
</div>



<!-- row closed -->
@endsection
@section('js')

@endsection 
