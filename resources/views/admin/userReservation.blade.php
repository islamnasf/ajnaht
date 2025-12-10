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
                    {{-- إضافة ID للجدول لتسهيل الوصول إليه --}}
                    <table id="reservations-datatable" class="table table-striped table-bordered p-0 text-center">
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
                                <th>الحالة</th>
                                <th>تفاصيل الغرف</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reservations as $index => $res)
                            {{-- إضافة ID للصف لتسهيل الوصول إليه --}}
                            <tr id="reservation-row-{{ $res->id }}">
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
                                    @if(is_null($res->status) || $res->status == '')
                                        <span class="badge badge-warning text-dark">غير مؤكد</span>
                                    @elseif($res->status == 'cancelled')
                                        <span class="badge badge-danger">ملغي</span>
                                    @elseif($res->status == 'confirmed')
                                        <span class="badge badge-success">مؤكد</span>
                                    @else
                                        <span class="badge badge-secondary">{{ $res->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailsModal{{$res->id}}">
                                        عرض التفاصيل
                                    </button>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="operationsDropdown{{$res->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            العمليات
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="operationsDropdown{{$res->id}}">
                                            
                                            {{-- ⭐ الزر الجديد لتحميل PDF (تم تمرير معرف الصف أيضاً) ⭐ --}}
                                            <a class="dropdown-item text-success" href="#" onclick="generateReservationPdf({{$res->id}})">
                                                <i class="fa fa-file-pdf-o"></i> تحميل PDF
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            
                                            {{-- زر تعديل حالة الحجز (تأكيد/إلغاء) --}}
                                            <a class="dropdown-item text-primary" href="#" data-toggle="modal" data-target="#editStatusModal{{$res->id}}">
                                                <i class="fa fa-pencil-square-o"></i> تعديل الحالة
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            {{-- زر حذف الحجز --}}
                                            <a class="dropdown-item text-danger" href="#" data-toggle="modal" data-target="#deleteModal{{$res->id}}">
                                                <i class="fa fa-trash"></i> حذف الحجز
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            {{-- Modal تفاصيل الغرف (يجب أن يبقى هنا) --}}
                            <div class="modal fade" id="detailsModal{{$res->id}}" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel{{$res->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document"> 
                                    <div class="modal-content">
                                        <div class="modal-header bg-info text-white">
                                            <h5 class="modal-title" id="detailsModalLabel{{$res->id}}">تفاصيل الغرف - {{ $res->client }}</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" id="details-modal-body-{{$res->id}}">
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
                                                    $colorClass = match($detail->type % 5) {
                                                        0 => 'border-primary',
                                                        1 => 'border-success',
                                                        2 => 'border-info',
                                                        3 => 'border-warning',
                                                        4 => 'border-danger',
                                                        default => 'border-secondary',
                                                    };
                                                @endphp
                                                <div class="col-md-6 mb-3"> 
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

                            {{-- Modal تعديل حالة الحجز (تأكيد/إلغاء) --}}
                            {{-- ... (باقي كود الـ Modals الأخرى) ... --}}
                            <div class="modal fade" id="editStatusModal{{$res->id}}" tabindex="-1" role="dialog" aria-labelledby="editStatusModalLabel{{$res->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title" id="editStatusModalLabel{{$res->id}}">تعديل حالة الحجز - {{ $res->client }}</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        
                                        <form action="{{ route('reservations.update_status', $res->id) }}" method="POST"> 
                                            @csrf
                                            @method('PUT') 

                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="reservation_status">اختر حالة الحجز الجديدة:</label>
                                                    <select class="form-control" id="reservation_status" name="status" required>
                                                        <option value="confirmed" {{ $res->status == 'confirmed' ? 'selected' : '' }}>مؤكد</option>
                                                        <option value="cancelled" {{ $res->status == 'cancelled' ? 'selected' : '' }}>ملغي</option>
                                                        <option value="" {{ is_null($res->status) || $res->status == '' ? 'selected' : '' }}>غير مؤكد</option>
                                                    </select>
                                                </div>
                                                <p class="mt-3 text-info">
                                                    الحالة الحالية: 
                                                    @if(is_null($res->status) || $res->status == '')
                                                        <span class="badge badge-warning text-dark">غير مؤكد</span>
                                                    @elseif($res->status == 'cancelled')
                                                        <span class="badge badge-danger">ملغي</span>
                                                    @else
                                                        <span class="badge badge-success">مؤكد</span>
                                                    @endif
                                                </p>
                                            </div>
                                            
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                            {{-- Modal حذف الحجز (تعديل على Modal الإلغاء السابقة) --}}
                            <div class="modal fade" id="deleteModal{{$res->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{$res->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="deleteModalLabel{{$res->id}}">تأكيد حذف الحجز</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        
                                        <form action="{{ route('reservations.destroy', $res->id) }}" method="POST"> 
                                            @csrf
                                            @method('DELETE') {{-- استخدام DELETE للحذف --}}

                                            <div class="modal-body text-center">
                                                <div class="py-3">
                                                    <i class="fa fa-trash fa-4x text-danger mb-3"></i>
                                                    <h5 class="mb-3">هل أنت متأكد من رغبتك في حذف هذا الحجز بالكامل؟</h5>
                                                    <p class="text-muted">
                                                        العميل: <strong>{{ $res->client }}</strong><br>
                                                        التاريخ: {{ $res->start }}
                                                    </p>
                                                    <p class="text-danger font-weight-bold">لا يمكن التراجع عن عملية الحذف.</p>
                                                </div>
                                            </div>
                                            
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">تراجع</button>
                                                <button type="submit" class="btn btn-danger">نعم، تأكيد الحذف</button>
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

{{-- عنصر مخفي مؤقت لتوليد محتوى الـ PDF منه --}}
<div id="pdf-content-container" style="display: none; padding: 20px; direction: rtl; text-align: right; background-color: #fff;">
    {{-- سيتم ملء هذا المحتوى ديناميكيًا عبر JavaScript --}}
</div>

@endsection

@section('js')
{{-- 🚀 روابط مكتبات إنشاء PDF 🚀 --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
{{-- يجب التأكد من تضمين ملفات Bootstrap و jQuery الخاصة بك أيضاً --}}

<script>
    // تهيئة jsPDF للاستخدام في المتصفح
    const { jsPDF } = window.jspdf;

    /**
     * دالة لإنشاء وتحميل ملف PDF يتضمن تفاصيل الحجز وصفه من الجدول.
     * @param {number} reservationId معرّف الحجز
     */
    function generateReservationPdf(reservationId) {
        // IDs للعناصر
        const rowId = 'reservation-row-' + reservationId;
        const detailsModalBodyId = 'details-modal-body-' + reservationId;
        const pdfContainerId = 'pdf-content-container';

        const rowElement = document.getElementById(rowId);
        const detailsModalBody = document.getElementById(detailsModalBodyId);
        const pdfContainer = document.getElementById(pdfContainerId);

        if (!rowElement || !detailsModalBody || !pdfContainer) {
            console.error('Missing elements for PDF generation. Row, Modal Body, or Container not found.');
            alert('تعذر العثور على جميع البيانات لإنشاء ملف PDF.');
            return;
        }
        
        // 1. جمع البيانات وتحضير المحتوى
        
        // استخراج اسم العميل لاسم الملف
        const clientNameElement = rowElement.querySelector('td:nth-child(2)'); // td:nth-child(2) هو عمود اسم العميل
        const clientName = clientNameElement ? clientNameElement.textContent.trim() : 'Reservation';
        const filename = `حجز_${clientName}_رقم_${reservationId}.pdf`;

        // إنشاء نسخة من صف الحجز بتنسيق جدول مناسب للطباعة
        const rowData = Array.from(rowElement.cells).map(cell => cell.textContent.trim());
        const rowHeaders = Array.from(document.querySelector('#reservations-datatable thead tr').children).map(th => th.textContent.trim());

        // تصفية العناوين والبيانات لإزالة أعمدة "تفاصيل الغرف" و "العمليات" للحصول على جدول بيانات نظيف
        const excludedIndices = [rowHeaders.length - 1, rowHeaders.length - 2]; // آخر عمودين (العمليات وتفاصيل الغرف)
        const filteredHeaders = rowHeaders.filter((_, index) => !excludedIndices.includes(index));
        const filteredData = rowData.filter((_, index) => !excludedIndices.includes(index));

        let reservationTableHTML = `
            <h3 style="text-align: center; color: #333; margin-bottom: 20px; padding: 10px; border-bottom: 2px solid #eee;">
                سند حجز - رقم ${reservationId}
            </h3>
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px; font-size: 14px; text-align: right; direction: rtl;">
                <thead style="background-color: #007bff; color: white;">
                    <tr>
                        ${filteredHeaders.map(header => `<th style="border: 1px solid #ddd; padding: 12px; text-align: center;">${header}</th>`).join('')}
                    </tr>
                </thead>
                <tbody>
                    <tr style="background-color: #f8f9fa;">
                        ${filteredData.map(data => `<td style="border: 1px solid #ddd; padding: 12px; text-align: center;">${data}</td>`).join('')}
                    </tr>
                </tbody>
            </table>
            <h4 style="color: #333; margin-top: 20px; margin-bottom: 15px; border-right: 4px solid #17a2b8; padding-right: 10px;">
                تفاصيل الغرف المحجوزة
            </h4>
        `;

        // إضافة محتوى تفاصيل الغرف (يتم استنساخه من جسم المودال)
        reservationTableHTML += detailsModalBody.innerHTML;


        // 2. إدخال المحتوى في العنصر المخفي
        pdfContainer.innerHTML = reservationTableHTML;
        pdfContainer.style.display = 'block'; // أظهر العنصر المخفي لتصويره

        // 3. تصوير المحتوى وتحويله إلى PDF
        html2canvas(pdfContainer, { scale: 2, logging: false, useCORS: true }).then((canvas) => {
            const imgData = canvas.toDataURL('image/png');
            
            // تهيئة jsPDF
            const pdf = new jsPDF('p', 'mm', 'a4');
            const imgWidth = 200; 
            const pageHeight = 295;
            const imgHeight = canvas.height * imgWidth / canvas.width;
            let heightLeft = imgHeight;
            let position = 5;

            // إضافة الصورة إلى PDF
            pdf.addImage(imgData, 'PNG', 5, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;

            // التعامل مع الصفحات المتعددة
            while (heightLeft > -5) {
                pdf.addPage();
                // -imgHeight + pageHeight هو الموضع الذي يجب أن تبدأ منه الصورة في الصفحة الجديدة
                // يتم طرحه لأننا نتحدث عن أعلى الصفحة الجديدة
                position = (heightLeft - imgHeight) + pageHeight + 5; 
                pdf.addImage(imgData, 'PNG', 5, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
            }
            
            // 4. حفظ ملف PDF
            pdf.save(filename);

            // 5. إخفاء وإفراغ العنصر المؤقت
            pdfContainer.style.display = 'none';
            pdfContainer.innerHTML = '';

        }).catch(error => {
            console.error("Error generating PDF:", error);
            alert("حدث خطأ أثناء إنشاء ملف PDF.");
            pdfContainer.style.display = 'none';
            pdfContainer.innerHTML = '';
        });
        
    }
</script>
{{-- ملفات JS الخاصة بـ datatable و Bootstrap --}}
@endsection