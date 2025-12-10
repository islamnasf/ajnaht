@extends('layouts.master')

@section('title')
إدارة فترات السعر
@stop

@section('page-header')
    <div class="page-header bg-light border-bottom pb-3 mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-2">
                    <i class="fa fa-calendar-o text-primary mr-2"></i> إدارة فترات - {{ $price->hotel->name }}
                </h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('getCategory') }}"><i class="fa fa-home"></i>
                                الفنادق</a></li>
                        <li class="breadcrumb-item active text-muted" aria-current="page">فترات السعر</li>
                    </ol>
                </nav>
                <div class="d-flex flex-wrap align-items-center mt-2">
                    <div class="mr-3 mb-1">
                        <span class="badge badge-secondary badge-pill px-3">
                            <i class="fa fa-bed mr-1"></i>
                            {{ $price->name == 1 ? 'كينج' : $price->name . ' سرير' }}
                        </span>
                    </div>
                    <div class="mr-3 mb-1">
                        <span class="badge badge-success badge-pill px-3">
                            <i class="fa fa-tag mr-1"></i>
                            السعر: {{ number_format($price->price) }} ريال
                        </span>
                    </div>
                    <div class="mb-1">
                        <span class="badge badge-info badge-pill px-3">
                            <i class="fa fa-hotel mr-1"></i>
                            غرف: {{ $price->roomAvailable }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-md-right mt-3 mt-md-0">
                <a href="{{ route('getCategory') }}" class="btn btn-outline-secondary btn-lg">
                    <i class="fa fa-arrow-right ml-1"></i> العودة
                </a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="fa fa-check-circle fa-2x mr-3"></i>
                <div class="flex-grow-1">
                    <h5 class="alert-heading mb-1">تم بنجاح!</h5>
                    <p class="mb-0">{{ session('success') }}</p>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="fa fa-exclamation-circle fa-2x mr-3"></i>
                <div class="flex-grow-1">
                    <h5 class="alert-heading mb-1">خطأ!</h5>
                    <p class="mb-0">{{ session('error') }}</p>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif


    <div class="row">
        <div class="col-lg-12">
            {{-- بطاقة إضافة فترة جديدة --}}
            <div class="card card-primary border-primary mb-4 shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fa fa-plus-circle mr-2"></i> إضافة فترة جديدة
                    </h5>
                    <span class="badge badge-light badge-pill">
                        <i class="fa fa-calendar-plus-o mr-1"></i>
                    </span>
                </div>
                <div class="card-body">
                    <form action="{{ route('periods.store', [$category->id, $price->id]) }}" method="POST" id="periodForm">
                        @csrf
                        <div class="row">
                            {{-- تاريخ البداية --}}
                            <div class="col-md-6 col-lg-3 mb-3">
                                <label for="start" class="form-label font-weight-bold">
                                    <i class="fa fa-calendar-check-o text-primary mr-2"></i> تاريخ البداية
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light">
                                            <i class="fa fa-play text-success"></i>
                                        </span>
                                    </div>
                                    <input type="date" name="start" id="start"
                                        class="form-control @error('start') is-invalid @enderror" value="{{ old('start') }}"
                                        required min="{{ date('Y-m-d') }}">
                                    @error('start')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted mt-1">
                                    <i class="fa fa-info-circle mr-1"></i> تاريخ بداية الفترة
                                </small>
                            </div>

                            {{-- تاريخ النهاية --}}
                            <div class="col-md-6 col-lg-3 mb-3">
                                <label for="end" class="form-label font-weight-bold">
                                    <i class="fa fa-calendar-times-o text-primary mr-2"></i> تاريخ النهاية
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light">
                                            <i class="fa fa-stop text-danger"></i>
                                        </span>
                                    </div>
                                    <input type="date" name="end" id="end"
                                        class="form-control @error('end') is-invalid @enderror" value="{{ old('end') }}"
                                        required min="{{ date('Y-m-d') }}">
                                    @error('end')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted mt-1">
                                    <i class="fa fa-info-circle mr-1"></i> تاريخ نهاية الفترة
                                </small>
                            </div>

                            {{-- عدد الغرف --}}
                            <div class="col-md-6 col-lg-2 mb-3">
                                <label for="rooms_available" class="form-label font-weight-bold">
                                    <i class="fa fa-bed text-primary mr-2"></i> الغرف المتاحة
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light">
                                            <i class="fa fa-hotel"></i>
                                        </span>
                                    </div>
                                    <input type="number" name="rooms_available" id="rooms_available"
                                        class="form-control @error('rooms_available') is-invalid @enderror"
                                        value="{{ old('rooms_available') }}" required min="1"
                                        max="{{ $price->roomAvailable }}">
                                    @error('rooms_available')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted mt-1">
                                    <i class="fa fa-lock mr-1"></i> الحد الأقصى: {{ $price->roomAvailable }}
                                </small>
                            </div>

                            {{-- سعر الفترة --}}
                            <div class="col-md-6 col-lg-2 mb-3">
                                <label for="period_price" class="form-label font-weight-bold">
                                    <i class="fa fa-money text-primary mr-2"></i> سعر الفترة
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light">
                                            <i class="fa fa-dollar"></i>
                                        </span>
                                    </div>
                                    <input type="number" name="period_price" id="period_price"
                                        class="form-control @error('period_price') is-invalid @enderror"
                                        value="{{ old('period_price', $price->price) }}" required min="0" step="1">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-light">ريال</span>
                                    </div>
                                    @error('period_price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted mt-1">
                                    <i class="fa fa-info-circle mr-1"></i> السعر الأساسي: {{ number_format($price->price) }}
                                    ريال
                                </small>
                            </div>

                            {{-- زر الإضافة --}}
                            <div class="col-md-12 col-lg-2 mb-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary btn-block btn-lg shadow">
                                    <i class="fa fa-save mr-2"></i> حفظ
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- بطاقة عرض الفترات --}}
            <div class="card card-info border-info shadow-sm">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fa fa-list-alt mr-2"></i> الفترات المضافة
                    </h5>
                    <div>
                        <span class="badge badge-light badge-pill px-3 py-2">
                            <i class="fa fa-calendar-o mr-1"></i>
                            {{ $price->periods->count() }} فترة
                        </span>
                    </div>
                </div>

                @if($price->periods->count() > 0)
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" style="width: 60px">#</th>
                                        <th class="text-center" style="width: 250px">فترة الحجز</th>
                                        <th class="text-center" style="width: 100px">المدة</th>
                                        <th class="text-center" style="width: 120px">الغرف</th>
                                        <th class="text-center" style="width: 150px">سعر الفترة</th>
                                        <th class="text-center" style="width: 150px">تاريخ الإضافة</th>
                                        <th class="text-center" style="width: 80px">الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($price->periods->sortByDesc('created_at') as $period)
                                        <tr>
                                            {{-- الرقم التسلسلي --}}
                                            <td class="text-center align-middle">
                                                <span class="badge badge-secondary badge-pill px-3 py-2">
                                                    {{ $loop->iteration }}
                                                </span>
                                            </td>

                                            {{-- فترة الحجز - تصميم محسن --}}
                                            <td class="align-middle">
                                                <div class="card border-0 bg-transparent">
                                                    <div class="card-body p-2">
                                                        <div class="row align-items-center no-gutters">
                                                            {{-- تاريخ البداية --}}
                                                            <div class="col-5 text-center">
                                                                <div class="bg-success text-white rounded-lg p-2 mb-1">
                                                                    <div class="small font-weight-bold">
                                                                        <i class="fa fa-play mr-1"></i> البداية
                                                                    </div>
                                                                    <div class="h6 mb-0 font-weight-bold">
                                                                        {{ \Carbon\Carbon::parse($period->start)->format('Y-m-d') }}
                                                                    </div>
                                                                    <small class="opacity-75">
                                                                        {{ \Carbon\Carbon::parse($period->start)->locale('ar')->translatedFormat('l') }}
                                                                    </small>
                                                                </div>
                                                            </div>

                                                            {{-- السهم --}}
                                                            <div class="col-2 text-center">
                                                                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center"
                                                                    style="width: 40px; height: 40px;">
                                                                    <i class="fa fa-arrow-right text-muted"></i>
                                                                </div>
                                                            </div>

                                                            {{-- تاريخ النهاية --}}
                                                            <div class="col-5 text-center">
                                                                <div class="bg-danger text-white rounded-lg p-2 mb-1">
                                                                    <div class="small font-weight-bold">
                                                                        <i class="fa fa-stop mr-1"></i> النهاية
                                                                    </div>
                                                                    <div class="h6 mb-0 font-weight-bold">
                                                                        {{ \Carbon\Carbon::parse($period->end)->format('Y-m-d') }}
                                                                    </div>
                                                                    <small class="opacity-75">
                                                                        {{ \Carbon\Carbon::parse($period->end)->locale('ar')->translatedFormat('l') }}
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            {{-- المدة --}}
                                            <td class="text-center align-middle">
                                                @php
                                                    $start = \Carbon\Carbon::parse($period->start);
                                                    $end = \Carbon\Carbon::parse($period->end);
                                                    $days = $start->diffInDays($end) + 1;
                                                @endphp
                                                <div class="d-flex flex-column align-items-center">
                                                    <span class="badge badge-info badge-pill px-4 py-2 mb-1">
                                                        <i class="fa fa-clock-o mr-2"></i>
                                                        {{ $days }}
                                                    </span>
                                                    <small class="text-muted">يوم</small>
                                                </div>
                                            </td>

                                            {{-- عدد الغرف --}}
                                            <td class="text-center align-middle">
                                                <div class="d-flex flex-column align-items-center">
                                                    <span class="badge badge-success badge-pill px-4 py-2 mb-1">
                                                        <i class="fa fa-bed mr-2"></i>
                                                        {{ $period->rooms_available }}
                                                    </span>
                                                    <small class="text-muted">غرفة</small>
                                                </div>
                                            </td>

                                            {{-- سعر الفترة --}}
                                            <td class="text-center align-middle">
                                                <div class="d-flex flex-column align-items-center">
                                                    <span class="badge badge-warning badge-pill px-4 py-2 mb-1">
                                                        <i class="fa fa-money mr-2"></i>
                                                        {{ number_format($period->period_price) }}
                                                    </span>
                                                    <small class="text-muted">ريال</small>
                                                    @if($period->period_price != $price->price)
                                                        @php
                                                            $difference = $period->period_price - $price->price;
                                                            $percentage = ($difference / $price->price) * 100;
                                                        @endphp
                                                        <small
                                                            class="{{ $difference > 0 ? 'text-danger' : ($difference < 0 ? 'text-success' : 'text-info') }}">
                                                            @if($difference > 0)
                                                                <i class="fa fa-arrow-up mr-1"></i>
                                                                +{{ number_format(abs($difference)) }}
                                                            @elseif($difference < 0)
                                                                <i class="fa fa-arrow-down mr-1"></i>
                                                                -{{ number_format(abs($difference)) }}
                                                            @else
                                                                <i class="fa fa-equals mr-1"></i>
                                                                نفس السعر
                                                            @endif
                                                        </small>
                                                    @endif
                                                </div>
                                            </td>

                                            {{-- تاريخ الإضافة --}}
                                            <td class="text-center align-middle">
                                                <div class="d-flex flex-column align-items-center">
                                                    <span class="badge badge-secondary badge-pill px-3 py-1 mb-1">
                                                        <i class="fa fa-calendar mr-2"></i>
                                                        {{ $period->created_at->format('Y-m-d') }}
                                                    </span>
                                                    <small class="text-muted">
                                                        <i class="fa fa-clock-o mr-1"></i>
                                                        {{ $period->created_at->format('H:i') }}
                                                    </small>
                                                </div>
                                            </td>

                                            {{-- الإجراءات --}}
                                            <td class="text-center align-middle">
                                                <div class="btn-group" role="group">
                                                    <form action="{{ route('periods.delete', $period->id) }}" method="POST"
                                                        onsubmit="return confirm('هل أنت متأكد من حذف هذه الفترة؟');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm px-3"
                                                            title="حذف الفترة" data-toggle="tooltip">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- تذييل الجدول --}}
                    <div class="card-footer bg-light">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <small class="text-muted">
                                    <i class="fa fa-info-circle mr-1"></i>
                                    إجمالي {{ $price->periods->count() }} فترة
                                </small>
                            </div>
                            <div class="col-md-4 text-center">
                                @php
                                    $avgPrice = $price->periods->avg('period_price');
                                    $totalRooms = $price->periods->sum('rooms_available');
                                @endphp
                                <small class="text-muted">
                                    <i class="fa fa-bar-chart mr-1"></i>
                                    متوسط السعر: {{ $avgPrice ? number_format($avgPrice) : 0 }} ريال
                                </small>
                            </div>
                            <div class="col-md-4 text-right">
                                <small class="text-muted">
                                    <i class="fa fa-clock-o mr-1"></i>
                                    آخر تحديث: {{ now()->format('Y-m-d H:i') }}
                                </small>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- حالة عدم وجود فترات --}}
                    <div class="card-body">
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fa fa-calendar-times-o fa-5x text-muted opacity-50"></i>
                            </div>
                            <h4 class="text-muted mb-3">لا توجد فترات مضافة</h4>
                            <p class="text-muted mb-4">لم يتم إضافة أي فترات لهذا السعر بعد</p>
                            <div class="alert alert-info border-info w-75 mx-auto">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-lightbulb-o fa-2x mr-3"></i>
                                    <div>
                                        <p class="mb-0">ابدأ بإضافة فترة جديدة باستخدام النموذج أعلاه</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>


    {{-- شارت تايملاين للفترات --}}
    <div class="card card-warning border-warning shadow-sm mb-4">
        <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fa fa-timeline mr-2"></i> جدول الفترات السنوي
            </h5>
            <div class="d-flex align-items-center">
                <form method="GET" action="" class="form-inline mr-3" id="yearForm">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <label class="input-group-text bg-light border-0" for="yearSelect">
                                <i class="fa fa-calendar mr-1"></i>
                            </label>
                        </div>
                        <select class="form-control form-control-sm" id="yearSelect" name="year"
                            onchange="document.getElementById('yearForm').submit()">
                            @for($y = date('Y'); $y <= date('Y') + 5; $y++)
                                <option value="{{ $y }}" {{ $y == (request('year') ?: date('Y')) ? 'selected' : '' }}>
                                    {{ $y }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </form>
                <span class="badge badge-light badge-pill px-3 py-2">
                    <i class="fa fa-calendar-check mr-1"></i>
                    {{ request('year') ?: date('Y') }}
                </span>
            </div>
        </div>
        <div class="card-body">
            @php
                $selectedYear = request('year') ?: date('Y');
                $months = [];

                // إنشاء شهور السنة
                for ($i = 1; $i <= 12; $i++) {
                    $monthName = \Carbon\Carbon::create($selectedYear, $i, 1)->translatedFormat('F');
                    $months[$i] = [
                        'name' => $monthName,
                        'days' => [],
                        'periods' => []
                    ];
                }

                // تعبئة الأيام لكل شهر
                foreach ($price->periods as $period) {
                    $start = \Carbon\Carbon::parse($period->start);
                    $end = \Carbon\Carbon::parse($period->end);

                    // التحقق إذا كانت الفترة في السنة المحددة
                    if ($start->year == $selectedYear || $end->year == $selectedYear) {
                        $current = $start->copy();

                        while ($current->lte($end)) {
                            if ($current->year == $selectedYear) {
                                $month = $current->month;
                                $day = $current->day;

                                if (!isset($months[$month]['days'][$day])) {
                                    $months[$month]['days'][$day] = [];
                                }

                                $months[$month]['days'][$day][] = [
                                    'period' => $period,
                                    'is_start' => $current->eq($start),
                                    'is_end' => $current->eq($end)
                                ];

                                // إضافة الفترة إلى قائمة فترات الشهر
                                if (!in_array($period->id, array_column($months[$month]['periods'], 'id'))) {
                                    $months[$month]['periods'][] = [
                                        'id' => $period->id,
                                        'start' => $period->start,
                                        'end' => $period->end,
                                        'price' => $period->period_price
                                    ];
                                }
                            }
                            $current->addDay();
                        }
                    }
                }

                // حساب الإحصائيات
                $totalPeriods = $price->periods->where(function ($period) use ($selectedYear) {
                    $start = \Carbon\Carbon::parse($period->start);
                    $end = \Carbon\Carbon::parse($period->end);
                    return $start->year == $selectedYear || $end->year == $selectedYear;
                })->count();

                $monthsWithPeriods = collect($months)->filter(function ($month) {
                    return count($month['periods']) > 0;
                })->count();
            @endphp

            {{-- إحصائيات سريعة --}}
            <div class="row mb-4">
                <div class="col-md-12 col-6 mb-3">
                    <div class="card bg-light border-0 text-center shadow-sm">
                        <div class="card-body py-3">
                            <div class="text-warning mb-2">
                                <i class="fa fa-calendar-check-o fa-2x"></i>
                            </div>
                            <h4 class="mb-1">{{ $totalPeriods }}</h4>
                            <small class="text-muted">فترة نشطة</small>
                        </div>
                    </div>
                </div>


            </div>

            <div class="timeline-container mb-4">
                {{-- شريط الأشهر --}}
                <div class="months-bar mb-3">
                    <div class="row text-center">
                        @foreach($months as $monthNum => $month)
                            <div class="col month-col" style="position: relative;">
                                <div class="month-label {{ count($month['days']) > 0 ? 'has-periods' : '' }}"
                                    data-toggle="tooltip" title="{{ $month['name'] }} - {{ count($month['periods']) }} فترة"
                                    onclick="showMonthDetails({{ $monthNum }}, '{{ $month['name'] }}')">
                                    <span class="month-name">{{ mb_substr($month['name'], 0, 3) }}</span>
                                    @if(count($month['periods']) > 0)
                                        <span class="badge badge-danger badge-pill ml-1">{{ count($month['periods']) }}</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- شبكة الأيام --}}
                <div class="days-grid">
                    @for($day = 1; $day <= 31; $day++)
                        <div class="row day-row mb-2">
                            <div class="col-auto day-label">
                                <span class="badge badge-light badge-pill px-3 py-1">
                                    {{ $day }}
                                </span>
                            </div>
                            <div class="col">
                                <div class="row">
                                    @foreach($months as $monthNum => $month)
                                        @php
                                            $daysInMonth = \Carbon\Carbon::create($selectedYear, $monthNum, 1)->daysInMonth;
                                            $hasDay = $day <= $daysInMonth && isset($month['days'][$day]);
                                            $dayPeriods = $hasDay ? $month['days'][$day] : [];
                                            $isStart = $hasDay ? collect($dayPeriods)->contains('is_start', true) : false;
                                            $isEnd = $hasDay ? collect($dayPeriods)->contains('is_end', true) : false;

                                            // تحديد اللون بناءً على حالة الفترة
                                            $bgClass = '';
                                            $tooltip = '';

                                            if ($hasDay) {
                                                if ($isStart && $isEnd) {
                                                    $bgClass = 'bg-warning';
                                                    $tooltip = 'يوم واحد فقط';
                                                } elseif ($isStart) {
                                                    $bgClass = 'bg-success';
                                                    $tooltip = 'بداية فترة';
                                                } elseif ($isEnd) {
                                                    $bgClass = 'bg-danger';
                                                    $tooltip = 'نهاية فترة';
                                                } else {
                                                    $bgClass = 'bg-info';
                                                    $tooltip = 'يوم ضمن فترة';
                                                }

                                                // إضافة معلومات إضافية للتلميح
                                                $periodsInfo = [];
                                                foreach ($dayPeriods as $dayPeriod) {
                                                    $periodInfo = "فترة: " . \Carbon\Carbon::parse($dayPeriod['period']->start)->format('Y-m-d') .
                                                        " إلى " . \Carbon\Carbon::parse($dayPeriod['period']->end)->format('Y-m-d');
                                                    $periodsInfo[] = $periodInfo;
                                                }
                                                $tooltip .= "\n" . implode("\n", $periodsInfo);
                                            }
                                        @endphp

                                        <div class="col month-col text-center">
                                            @if($day <= $daysInMonth)
                                                <div class="day-cell {{ $bgClass }} {{ $hasDay ? 'has-period' : '' }}"
                                                    data-toggle="tooltip" title="{{ $tooltip }}"
                                                    style="height: 30px; border-radius: 4px; cursor: pointer;"
                                                    onclick="showDayDetails({{ $day }}, {{ $monthNum }})">
                                                    @if($hasDay)
                                                        @if($isStart)
                                                            <i class="fa fa-play text-white"></i>
                                                        @elseif($isEnd)
                                                            <i class="fa fa-stop text-white"></i>
                                                        @else
                                                            <div class="dot"></div>
                                                        @endif
                                                    @endif
                                                </div>
                                            @else
                                                <div class="day-cell disabled" style="height: 30px;"></div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            {{-- وسيلة إيضاح الألوان --}}
            <div class="legend mt-4">
                <h6 class="mb-3"><i class="fa fa-key mr-2"></i>وسيلة الإيضاح:</h6>
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <div class="d-flex align-items-center">
                            <div class="legend-color bg-success mr-2"
                                style="width: 20px; height: 20px; border-radius: 4px;"></div>
                            <span>بداية الفترة</span>
                        </div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <div class="d-flex align-items-center">
                            <div class="legend-color bg-danger mr-2" style="width: 20px; height: 20px; border-radius: 4px;">
                            </div>
                            <span>نهاية الفترة</span>
                        </div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <div class="d-flex align-items-center">
                            <div class="legend-color bg-info mr-2" style="width: 20px; height: 20px; border-radius: 4px;">
                            </div>
                            <span>يوم ضمن الفترة</span>
                        </div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <div class="d-flex align-items-center">
                            <div class="legend-color bg-warning mr-2"
                                style="width: 20px; height: 20px; border-radius: 4px;"></div>
                            <span>يوم واحد فقط</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('styles')
    <style>
        .page-header {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 0.375rem;
            margin: -1rem -1rem 2rem -1rem;
        }

        .card {
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .card-header {
            border-bottom: none;
            font-weight: 600;
        }

        .card-primary {
            border-width: 2px;
        }

        .card-info {
            border-width: 2px;
        }

        .table {
            font-size: 0.95rem;
        }

        .table thead th {
            border-top: none;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            padding: 1rem 0.75rem;
            background-color: #f8fafc;
        }

        .table tbody td {
            padding: 1rem 0.75rem;
            vertical-align: middle;
            border-top: 1px solid #f1f5f9;
        }

        .table tbody tr:hover {
            background-color: #f8fafc;
            transform: translateY(-1px);
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .badge-pill {
            border-radius: 50rem;
            padding: 0.5em 1em;
            font-weight: 500;
        }

        .badge-secondary {
            background-color: #6c757d;
        }

        .badge-primary {
            background-color: #007bff;
        }

        .badge-success {
            background-color: #28a745;
        }

        .badge-info {
            background-color: #17a2b8;
        }

        .badge-warning {
            background-color: #ffc107;
            color: #212529;
        }

        .badge-danger {
            background-color: #dc3545;
        }

        .btn-lg {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            border-radius: 0.5rem;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .rounded-lg {
            border-radius: 0.5rem;
        }

        .shadow-sm {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
        }

        .shadow {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-color: #ced4da;
        }

        .form-control {
            border-color: #ced4da;
            border-radius: 0.375rem;
        }

        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin-bottom: 0.5rem;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: "›";
            color: #6c757d;
        }

        .bg-success {
            background-color: #28a745 !important;
        }

        .bg-danger {
            background-color: #dc3545 !important;
        }

        .bg-light {
            background-color: #f8f9fa !important;
        }

        .alert {
            border-radius: 0.5rem;
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .alert-success {
            background-color: #d4edda;
            border-left: 4px solid #28a745;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-left: 4px solid #dc3545;
        }

        .alert-info {
            background-color: #d1ecf1;
            border-left: 4px solid #17a2b8;
        }

        /* أنماط شارت تايملاين */
        .timeline-container {
            background: #fff;
            border-radius: 10px;
            padding: 15px;
        }

        .months-bar {
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .month-col {
            padding: 0 2px;
        }

        .month-label {
            padding: 8px 5px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 1px solid transparent;
        }

        .month-label.has-periods {
            background: #fff3cd;
            color: #856404;
            border-color: #ffeaa7;
        }

        .month-label:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .month-name {
            display: inline-block;
            min-width: 30px;
        }

        .day-row {
            align-items: center;
            border-bottom: 1px solid #f8f9fa;
            padding: 3px 0;
            margin-bottom: 2px;
        }

        .day-row:hover {
            background-color: #f8fafc;
        }

        .day-label {
            min-width: 60px;
            text-align: center;
            padding-right: 10px;
        }

        .day-cell {
            transition: all 0.3s ease;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 1px;
            border: 1px solid transparent;
        }

        .day-cell.has-period {
            border-color: rgba(0, 0, 0, 0.1);
        }

        .day-cell.has-period:hover {
            transform: scale(1.1);
            z-index: 10;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .day-cell.disabled {
            background-color: #f8f9fa;
            border: 1px dashed #dee2e6;
        }

        .day-cell .dot {
            width: 8px;
            height: 8px;
            background-color: white;
            border-radius: 50%;
        }

        .legend-color {
            border: 1px solid #dee2e6;
        }

        /* تحسينات للشاشات الصغيرة */
        @media (max-width: 768px) {
            .page-header {
                margin: -1rem -0.75rem 1.5rem -0.75rem;
                padding: 1rem;
            }

            .table-responsive {
                border: none;
            }

            .card-body .row>div {
                margin-bottom: 1rem;
            }

            .btn-lg {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }

            .month-label {
                font-size: 0.7rem;
                padding: 5px 2px;
            }

            .month-name {
                min-width: 20px;
            }

            .day-cell {
                height: 20px !important;
                font-size: 10px;
            }

            .day-label {
                min-width: 40px;
                padding-right: 5px;
            }

            .day-label .badge {
                padding: 0.25em 0.5em;
                font-size: 0.7rem;
            }

            .legend .col-md-3 {
                margin-bottom: 10px;
            }
        }

        @media (max-width: 576px) {
            .days-grid {
                font-size: 10px;
            }

            .day-cell {
                height: 18px !important;
            }

            .month-label {
                font-size: 0.65rem;
                padding: 3px 1px;
            }
        }
    </style>
@endsection

@push('scripts')
    <script>
        // تفعيل أدوات التلميحات
        $(function () {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover',
                placement: 'top'
            });
        });

        // التحقق من صحة التواريخ
        document.getElementById('start').addEventListener('change', function () {
            const endDate = document.getElementById('end');
            if (endDate.value && endDate.value < this.value) {
                Swal.fire({
                    icon: 'warning',
                    title: 'تنبيه',
                    text: 'تاريخ النهاية يجب أن يكون بعد تاريخ البداية',
                    confirmButtonText: 'حسناً'
                });
                endDate.value = '';
            }
        });

        document.getElementById('end').addEventListener('change', function () {
            const startDate = document.getElementById('start');
            if (startDate.value && this.value < startDate.value) {
                Swal.fire({
                    icon: 'warning',
                    title: 'تنبيه',
                    text: 'تاريخ النهاية يجب أن يكون بعد تاريخ البداية',
                    confirmButtonText: 'حسناً'
                });
                this.value = '';
            }

            // حساب عدد الأيام إذا كانت التواريخ صحيحة
            if (startDate.value && this.value) {
                const start = new Date(startDate.value);
                const end = new Date(this.value);
                const diffTime = Math.abs(end - start);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;

                if (diffDays > 365) {
                    Swal.fire({
                        icon: 'info',
                        title: 'معلومة',
                        text: `مدة الفترة: ${diffDays} يوم`,
                        confirmButtonText: 'متابعة'
                    });
                }
            }
        });

        document.getElementById('rooms_available').addEventListener('blur', function () {
            const maxRooms = {{ $price->roomAvailable }};
            const enteredRooms = parseInt(this.value) || 0;

            if (enteredRooms > maxRooms) {
                Swal.fire({
                    icon: 'error',
                    title: 'خطأ',
                    text: `عدد الغرف المدخل (${enteredRooms}) يتجاوز الحد الأقصى (${maxRooms})`,
                    confirmButtonText: 'تصحيح'
                });
                this.value = maxRooms;
                this.focus();
            }

            if (enteredRooms < 1) {
                this.value = 1;
            }
        });

        // تنسيق السعر
        document.getElementById('period_price').addEventListener('blur', function () {
            let value = parseFloat(this.value);
            if (!isNaN(value) && value >= 0) {
                this.value = value.toFixed(2);
            }
        });

        function confirmDelete(form) {
            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "لن تتمكن من استعادة هذه الفترة بعد الحذف!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'نعم، احذف',
                cancelButtonText: 'إلغاء',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
            return false;
        }

        document.addEventListener('DOMContentLoaded', function () {
            const deleteForms = document.querySelectorAll('form[onsubmit*="confirm"]');
            deleteForms.forEach(form => {
                form.onsubmit = function (e) {
                    e.preventDefault();
                    return confirmDelete(this);
                };
            });
        });

        // دالة عرض تفاصيل اليوم
        function showDayDetails(day, month) {
            const months = {
                1: 'يناير', 2: 'فبراير', 3: 'مارس', 4: 'أبريل',
                5: 'مايو', 6: 'يونيو', 7: 'يوليو', 8: 'أغسطس',
                9: 'سبتمبر', 10: 'أكتوبر', 11: 'نوفمبر', 12: 'ديسمبر'
            };

            const monthName = months[month];
            const currentYear = {{ $selectedYear }};
            const dateStr = `${currentYear}-${month.toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;

            // البحث عن الفترات التي تحتوي على هذا اليوم
            const periods = [];

            @foreach($price->periods as $period)
                @php
                    $start = \Carbon\Carbon::parse($period->start);
                    $end = \Carbon\Carbon::parse($period->end);
                @endphp

                const start{{ $period->id }} = "{{ $period->start }}";
                const end{{ $period->id }} = "{{ $period->end }}";
                const periodDate{{ $period->id }} = new Date(dateStr);
                const startDate{{ $period->id }} = new Date(start{{ $period->id }});
                const endDate{{ $period->id }} = new Date(end{{ $period->id }});

                if (periodDate{{ $period->id }} >= startDate{{ $period->id }} &&
                    periodDate{{ $period->id }} <= endDate{{ $period->id }}) {

                    const isStart = periodDate{{ $period->id }}.getTime() === startDate{{ $period->id }}.getTime();
                    const isEnd = periodDate{{ $period->id }}.getTime() === endDate{{ $period->id }}.getTime();

                    periods.push({
                        id: {{ $period->id }},
                        start: start{{ $period->id }},
                        end: end{{ $period->id }},
                        price: {{ $period->period_price }},
                        rooms: {{ $period->rooms_available }},
                        isStart: isStart,
                        isEnd: isEnd,
                        days: {{ $start->diffInDays($end) + 1 }}
                            });
                }
            @endforeach

            // بناء محتوى المودال
            let content = '';

            if (periods.length > 0) {
                content += `
                        <div class="alert alert-info">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-calendar-check-o fa-2x mr-3"></i>
                                <div>
                                    <h5 class="mb-1">${day} ${monthName} ${currentYear}</h5>
                                    <p class="mb-0">هناك ${periods.length} فترة تشمل هذا اليوم</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                    `;

                periods.forEach((period, index) => {
                    const startDate = new Date(period.start);
                    const endDate = new Date(period.end);
                    const startFormatted = startDate.toLocaleDateString('ar-SA');
                    const endFormatted = endDate.toLocaleDateString('ar-SA');
                    const status = period.isStart ? 'بداية الفترة' :
                        period.isEnd ? 'نهاية الفترة' : 'يوم ضمن الفترة';
                    const statusClass = period.isStart ? 'success' :
                        period.isEnd ? 'danger' : 'info';

                    content += `
                            <div class="col-md-6 mb-3">
                                <div class="card border-${statusClass}">
                                    <div class="card-header bg-${statusClass} text-white d-flex justify-content-between">
                                        <span>الفترة ${index + 1}</span>
                                        <span class="badge badge-light">${status}</span>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-2">
                                            <i class="fa fa-calendar mr-2"></i>
                                            <strong>من:</strong> ${startFormatted}
                                        </div>
                                        <div class="mb-2">
                                            <i class="fa fa-calendar mr-2"></i>
                                            <strong>إلى:</strong> ${endFormatted}
                                        </div>
                                        <div class="mb-2">
                                            <i class="fa fa-clock-o mr-2"></i>
                                            <strong>المدة:</strong> ${period.days} يوم
                                        </div>
                                        <div class="mb-2">
                                            <i class="fa fa-money mr-2"></i>
                                            <strong>السعر:</strong> ${period.price.toLocaleString()} ريال
                                        </div>
                                        <div>
                                            <i class="fa fa-bed mr-2"></i>
                                            <strong>الغرف:</strong> ${period.rooms} غرفة
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                });

                content += '</div>';
            } else {
                content = `
                        <div class="text-center py-5">
                            <i class="fa fa-calendar-times-o fa-5x text-muted mb-4"></i>
                            <h4 class="text-muted">لا توجد فترات في هذا اليوم</h4>
                            <p class="text-muted">${day} ${monthName} ${currentYear}</p>
                            <p class="text-muted">لم يتم تحديد أي فترة تشمل هذا اليوم</p>
                        </div>
                    `;
            }

            document.getElementById('dayDetailsContent').innerHTML = content;
            $('#dayDetailsModal').modal('show');
        }

        // دالة عرض تفاصيل الشهر
        function showMonthDetails(month, monthName) {
            const currentYear = {{ $selectedYear }};

            // إنشاء قائمة الفترات في هذا الشهر
            const monthPeriods = [];

            @foreach($price->periods as $period)
                @php
                    $start = \Carbon\Carbon::parse($period->start);
                    $end = \Carbon\Carbon::parse($period->end);
                @endphp

                const start{{ $period->id }} = new Date("{{ $period->start }}");
                const end{{ $period->id }} = new Date("{{ $period->end }}");

                // التحقق إذا كانت الفترة في الشهر المحدد
                if ((start{{ $period->id }}.getFullYear() == currentYear && start{{ $period->id }}.getMonth() + 1 == month) ||
                    (end{{ $period->id }}.getFullYear() == currentYear && end{{ $period->id }}.getMonth() + 1 == month) ||
                    (start{{ $period->id }} <= new Date(currentYear, month, 0) && end{{ $period->id }} >= new Date(currentYear, month - 1, 1))) {

                    monthPeriods.push({
                        id: {{ $period->id }},
                        start: "{{ $period->start }}",
                        end: "{{ $period->end }}",
                        price: {{ $period->period_price }},
                        rooms: {{ $period->rooms_available }},
                        days: {{ $start->diffInDays($end) + 1 }}
                            });
                }
            @endforeach

            let content = '';

            if (monthPeriods.length > 0) {
                content += `
                        <div class="alert alert-warning">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-calendar-alt fa-2x mr-3"></i>
                                <div>
                                    <h5 class="mb-1">${monthName} ${currentYear}</h5>
                                    <p class="mb-0">عدد الفترات في هذا الشهر: ${monthPeriods.length}</p>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>من</th>
                                        <th>إلى</th>
                                        <th>المدة</th>
                                        <th>الغرف</th>
                                        <th>السعر</th>
                                    </tr>
                                </thead>
                                <tbody>
                    `;

                monthPeriods.forEach((period, index) => {
                    const startDate = new Date(period.start);
                    const endDate = new Date(period.end);
                    const startFormatted = startDate.toLocaleDateString('ar-SA');
                    const endFormatted = endDate.toLocaleDateString('ar-SA');

                    content += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${startFormatted}</td>
                                <td>${endFormatted}</td>
                                <td>${period.days} يوم</td>
                                <td>${period.rooms} غرفة</td>
                                <td>${period.price.toLocaleString()} ريال</td>
                            </tr>
                        `;
                });

                content += `
                                </tbody>
                            </table>
                        </div>
                    `;
            } else {
                content = `
                        <div class="text-center py-5">
                            <i class="fa fa-calendar-times-o fa-5x text-muted mb-4"></i>
                            <h4 class="text-muted">لا توجد فترات في هذا الشهر</h4>
                            <p class="text-muted">${monthName} ${currentYear}</p>
                            <p class="text-muted">لم يتم تحديد أي فترة في هذا الشهر</p>
                        </div>
                    `;
            }

            document.getElementById('dayDetailsContent').innerHTML = content;
            $('#dayDetailsModal').modal('show');
        }

        // تفعيل التلميحات للتايملاين
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover',
                placement: 'top',
                html: true
            });
        });
    </script>
@endpush