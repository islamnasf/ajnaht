@extends('layouts.master')

@section('css')
<style>
    /* عام */
    body {
        background-color: #f6f8fb; /* خلفية فاتحة ناعمة */
        color: #222;
    }

    /* عنوان الصفحة */
    .page-title h4 {
        font-weight: 700;
        color: #17324a;
    }

    /* البِريدكرامب */
    .breadcrumb .breadcrumb-item {
        color: #6b7a86;
    }

    /* Grid / Cards */
    .hotel-card {
        border: 0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 6px 18px rgba(20, 35, 50, 0.06);
        transition: transform 220ms ease, box-shadow 220ms ease;
        background: #fff;
    }

    .hotel-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(20, 35, 50, 0.09);
    }

    .hotel-card .card-img-top {
        height: 160px;
        object-fit: cover;
        display: block;
        width: 100%;
    }

    .hotel-card .card-body {
        padding: 12px 14px;
    }

    .hotel-title {
        font-size: 15px;
        font-weight: 600;
        margin: 0;
        color: #0f3b57;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .hotel-sub {
        font-size: 12px;
        color: #6b7884;
        margin-top: 6px;
    }

    /* link whole card */
    .hotel-link {
        text-decoration: none;
        color: inherit;
        display: block;
    }

    /* responsive spacing */
    @media (max-width: 768px) {
        .hotel-card .card-img-top {
            height: 140px;
        }
    }

</style>
@endsection

@section('title')
dashboard
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> الحجوزات </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"> لوحة التحكم </li>
                <li class="breadcrumb-item active"> الحجوزات </li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row mb-30">
    @foreach($hotels as $hotel)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <a href="{{ route('showReservations', $hotel->id) }}" class="hotel-link" >
                <div class="card hotel-card">
                    @if($hotel->image)
                        <img src="{{ asset($hotel->image) }}" class="card-img-top" alt="{{ $hotel->name }}">
                    @else
                        <img src="{{ asset('images/default-hotel.jpg') }}" class="card-img-top" alt="لا توجد صورة">
                    @endif

                    <div class="card-body text-center">
                        <h5 class="hotel-title">{{ $hotel->name }}</h5>
                        {{-- لو عايز وصف قصير تحطه هنا --}}
                        {{-- <p class="hotel-sub">مدينة — عدد النجوم</p> --}}
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>
<!-- row closed -->
@endsection

@section('js')
<script>
    // لو بتحب تضيف تأثير لافته عند الضغط — اختياري
    document.querySelectorAll('.hotel-link').forEach(function(el){
        el.addEventListener('click', function(){
            // يمكن إضافة تتبع أو تأثير هنا
        });
    });
</script>
@endsection
