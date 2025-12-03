@extends('layouts.master')

@section('title')
الحجوزات
@stop

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">الحجوزات</h4>
        </div>
    </div>
</div>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0 text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>اسم العميل</th>
                                <th>الهاتف</th>
                                <th>البريد الإلكتروني</th>
                                <th>الفندق</th>
                                <th>تاريخ الوصول</th>
                                <th>تاريخ المغادرة</th>
                                <th>عدد الليالي</th>
                                <th>عدد الغرف</th>
                                <th>السعر الإجمالي</th>
                                <th>تفاصيل الغرف</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reservations as $index => $res)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $res->client }}</td>
                                <td>{{ $res->phone }}</td>
                                <td>{{ $res->email }}</td>
                                <td>{{ $res->category->name ?? '-' }}</td>
                                <td>{{ $res->start }}</td>
                                <td>{{ $res->end }}</td>
                                <td>{{ \Carbon\Carbon::parse($res->start)->diffInDays(\Carbon\Carbon::parse($res->end)) }}</td>
                                <td>{{ $res->rooms }}</td>
                                <td>{{ number_format($res->total,2) }} ريال</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailsModal{{$res->id}}">
                                        عرض التفاصيل
                                    </button>
                                </td>
                                <td>
                                    </td>
                            </tr>

                            {{-- Modal تفاصيل الغرف - التصميم المحسن --}}
                            <div class="modal fade" id="detailsModal{{$res->id}}" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel{{$res->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document"> {{-- تم تغيير الحجم إلى modal-lg --}}
                                    <div class="modal-content">
                                        <div class="modal-header bg-info text-white">
                                            <h5 class="modal-title" id="detailsModalLabel{{$res->id}}">تفاصيل الغرف - {{ $res->client }}</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                            @foreach($res->details as $detail)
                                                @php
                                                    $roomType = match($detail->type) {
                                                        "1" => 'كينج (سرير مزدوج كبير)',
                                                        "2" => '2 سرير (سريرين منفردين)',
                                                        "3" => '3 سرير (3 أسرة منفردة)',
                                                        "4" => '4 سرير (4 أسرة منفردة)',
                                                        "5" => '5 سرير (5 أسرة منفردة)',
                                                        default => $detail->type,
                                                    };
                                                    // اختيار لون مميز لكل بطاقة
                                                    $colorClass = match($detail->type % 5) {
                                                        0 => 'border-primary',
                                                        1 => 'border-success',
                                                        2 => 'border-info',
                                                        3 => 'border-warning',
                                                        4 => 'border-danger',
                                                        default => 'border-secondary',
                                                    };
                                                @endphp
                                                <div class="col-md-6 mb-3"> {{-- جعل كل تفصيلة في عمود لتنسيق أفضل --}}
                                                    <div class="card {{ $colorClass }} shadow-sm">
                                                        <div class="card-header bg-light">
                                                            <h6 class="mb-0 text-dark">نوع الغرفة: {{ $roomType }}</h6>
                                                        </div>
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <span class="text-muted">عدد الغرف المطلوبة:</span>
                                                                <span class="badge badge-info badge-pill">{{ $detail->count }}</span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <span class="text-muted">سعر الغرفة/الليلة:</span>
                                                                <span class="text-success font-weight-bold">{{ number_format($detail->price, 2) }} ريال</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endforeach
                                            </div>

                                            @if($res->details->isEmpty())
                                                <div class="alert alert-warning text-center" role="alert">
                                                    لا توجد تفاصيل غرف مسجلة لهذه الحجوزات.
                                                </div>
                                            @endif

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                        </div>
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
{{-- ملفات JS الخاصة بـ datatable و Bootstrap --}}
@endsection