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

        // التحقق من عدد الغرف
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

                // إظهار فرق السعر بالمقارنة مع السعر الأساسي
                const basePrice = {{ $price->price }};
                const difference = value - basePrice;

                if (difference !== 0) {
                    const percentage = ((difference / basePrice) * 100).toFixed(1);
                    const message = difference > 0
                        ? `زيادة بمقدار ${Math.abs(difference).toFixed(2)} ريال (${Math.abs(percentage)}%)`
                        : `تخفيض بمقدار ${Math.abs(difference).toFixed(2)} ريال (${Math.abs(percentage)}%)`;

                    // يمكن إضافة رسالة إعلامية هنا إذا أردت
                }
            }
        });

        // تأكيد الحذف
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

        // تعديل جميع نماذج الحذف
        document.addEventListener('DOMContentLoaded', function () {
            const deleteForms = document.querySelectorAll('form[onsubmit*="confirm"]');
            deleteForms.forEach(form => {
                form.onsubmit = function (e) {
                    e.preventDefault();
                    return confirmDelete(this);
                };
            });
        });
    </script>
@endpush