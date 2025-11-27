@extends('layouts.master')

@section('title', 'إدارة الحجوزات - تصميم احترافي وفخم')

@section('css')
<style>
/* =================== التصميم الأساسي (RTL) - Professional Look =================== */
body {
    font-family: 'Cairo', sans-serif;
    background-color: #f0f2f5; 
}
.card { 
    border: 1px solid #dee2e6; 
    border-radius: 12px; 
    box-shadow: 0 6px 15px rgba(0,0,0,0.08); 
}
.card-header.bg-pro { 
    background: #0d47a1; 
    color: #ffffff;
    font-weight: 700;
    font-size: 1.2rem;
    border-radius: 12px 12px 0 0 !important;
    padding: 1rem 1.5rem;
}
.btn-primary-gradient{ 
    background: linear-gradient(45deg, #1976d2, #0d47a1); 
    color: #fff; 
    border: none; 
    font-weight: 600;
    box-shadow: 0 4px 10px rgba(25, 118, 210, 0.4);
    transition: all 0.3s ease;
}
.btn-primary-gradient:hover {
    box-shadow: 0 6px 15px rgba(25, 118, 210, 0.6);
}

/* =================== ستايلات دوائر التقدم (Progress Circles) =================== */
.progress-circle {
    position: relative;
    height: 60px; /* تصغير حجم الدائرة قليلاً */
    width: 60px;
    border-radius: 50%;
    background: conic-gradient(#1976d2 0%, #eee 0%);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 10px; /* إضافة هامش جانبي */
}
.progress-circle::before {
    content: "";
    position: absolute;
    height: 50px;
    width: 50px;
    background-color: #fff;
    border-radius: 50%;
}
.progress-value {
    position: relative;
    font-size: 14px;
    font-weight: 700;
    color: #0d47a1;
    z-index: 2;
}
/* دالة CSS لضبط قيمة التقدم */
.progress-circle.daily { background: conic-gradient(#0d47a1 calc(var(--daily-progress) * 1%), #eee 0%); }
.progress-circle.annual { background: conic-gradient(#388e3c calc(var(--annual-progress) * 1%), #eee 0%); }
.progress-circle.annual .progress-value { color: #388e3c; }


/* =================== ستايلات الجدول الشامل الاحترافي (RTL) =================== */
.gantt-table-container {
    max-height: 80vh; 
    overflow: auto;
    direction: rtl; 
    border-radius: 0 0 12px 12px;
}
.gantt-table {
    border-collapse: collapse;
    min-width: 100%;
    background-color: #ffffff;
    position: relative; 
}
.gantt-table th, .gantt-table td {
    border: 1px solid #eceff1; 
    padding: 2px 4px; 
    height: 45px; 
    text-align: center;
    font-size: 12px; 
    white-space: nowrap;
    position: relative;
    box-sizing: border-box;
    transition: background-color 0.2s;
}
.gantt-table tbody tr:nth-child(even) {
    background-color: #f7f7f7; 
}
.gantt-table tbody tr:hover {
    background-color: #e0f7fa !important; 
}

/* ------------------- الأعمدة الثابتة (البيانات التفصيلية) ------------------- */
.gantt-table .sticky-col {
    background-color: #fefefe; 
    color: #333;
    position: sticky; 
    z-index: 10;
    text-align: center; 
    font-size: 12px;
    border-left: 1px solid #ffb300; 
    vertical-align: middle;
    padding: 4px 6px; 
}
.gantt-table .text-right { text-align: right !important; }

/* رؤوس الأعمدة الثابتة */
.gantt-table thead .sticky-col {
    background-color: #0d47a1 !important;
    color: #ffffff !important;
    z-index: 30; 
    top: 0;
    font-size: 12px;
    font-weight: 600;
    padding: 6px;
}

/* تحديد موقع الأعمدة الثابتة الجديدة (8 أعمدة) */
.gantt-table .col-1 { min-width: 90px; right: 0; }        /* النزيل */
.gantt-table .col-2 { min-width: 90px; right: 90px; }     /* العميل */
.gantt-table .col-3 { min-width: 80px; right: 180px; }    /* وصول */
.gantt-table .col-4 { min-width: 80px; right: 260px; }    /* خروج */
.gantt-table .col-5 { min-width: 70px; right: 340px; }    /* سعر لليلة */
.gantt-table .col-6 { min-width: 70px; right: 410px; }    /* الإجمالي */
.gantt-table .col-7 { min-width: 50px; right: 480px; }    /* الغرف */
.gantt-table .col-8 { min-width: 70px; right: 530px; }    /* النوع */


/* ------------------- رؤوس الأيام والأشهر (ثابتة في الأعلى) ------------------- */
.gantt-table thead th.day-header {
    background-color: #37474f; 
    color: white;
    position: sticky; 
    top: 45px; 
    z-index: 20;
    font-size: 10px;
    height: 38px; 
    line-height: 1.2;
}
.gantt-table th.day-header .m-date-pri { /* ميلادي (Primary) */
    display: block;
    font-weight: 700;
    font-size: 11px; 
}
.gantt-table th.day-header .g-date-sec { /* هجري (Secondary) */
    font-size: 9px;
    opacity: 0.8;
}

/* صف الشهور */
.gantt-table thead tr:first-child th:not(.sticky-col) {
    background-color: #1976d2 !important; 
    position: sticky; 
    top: 0;
    z-index: 21;
}
.month-header-pri {
    font-size: 12px;
    font-weight: 700;
    display: block;
}
.month-header-sec {
    font-size: 10px;
    opacity: 0.9;
    font-weight: 400;
}

.gantt-table th.today-col, .gantt-table td.today-col {
    background-color: #ffc107 !important; 
    color: #333 !important;
    font-weight: 700;
}

/* ------------------- صف الغرف المتاحة (ثابت تحت الأيام) ------------------- */
.available-row th, .available-row td {
    top: 83px; /* 45px (شهور) + 38px (أيام) = 83px */
    position: sticky;
    z-index: 12;
    font-weight: 700;
    font-size: 13px;
}
.available-row th.sticky-col {
    background-color: #1976d2 !important; 
    color: white !important;
    z-index: 16;
    text-align: center !important; 
}
.available-row td {
    background-color: #e8f5e9; 
    color: #2e7d32; 
}
.available-row td.no-availability {
    background-color: #ffcdd2 !important; 
    color: #c62828 !important; 
    font-weight: 900;
}

/* ------------------- ستايلات عرض بيانات الحجز ------------------- */
.sticky-col .primary-text {
    font-weight: 700;
    font-size: 12px;
    display: block;
    line-height: 1.4;
}
.sticky-col .secondary-text {
    font-size: 11px;
    color: #78909c;
    display: block;
}
.sticky-col .date-text {
    font-size: 11px;
    font-weight: 600;
    color: #0d47a1;
}
.sticky-col .price-text {
    font-size: 11px;
    font-weight: 700;
    color: #00796b;
}

.reservation-cell {
    background-color: #5c6bc0; 
    color: white;
    font-weight: bold;
    font-size: 10px;
    cursor: pointer;
}
</style>
@endsection

@section('content')
<div class="container-fluid py-5" style="background-color: #f0f2f5;">

    {{-- صف العنوان وزر الإضافة وبطاقة الإشغال اليومي فقط --}}
    <div class="mb-4 d-flex justify-content-between align-items-center flex-wrap">
        
        {{-- العنوان --}}
        <h2 class="font-weight-bold text-dark mb-2 mb-md-0">
            <i class="fa fa-bed text-primary mr-2"></i> الفندق: **{{ $hotel->name }}**
        </h2>

        {{-- بطاقة الإشغال اليومي (الجديدة) --}}
        <div class="card shadow-sm p-2 d-flex flex-row align-items-center justify-content-center mx-3 flex-grow-1" style="max-width: 350px;">
            <div id="dailyOccupancyCircle" class="progress-circle daily" style="--daily-progress: 0;">
                <span class="progress-value">0%</span>
            </div>
            <div>
                <h6 class="font-weight-bold text-primary mb-0">الإشغال اليومي</h6>
                <p class="text-muted mt-0 mb-0" style="font-size: 12px;" id="dailyOccupancyInfo">تاريخ اليوم: {{ date('Y-m-d') }}</p>
            </div>
        </div>

        {{-- زر الإضافة --}}
        <button class="btn btn-primary-gradient btn-lg rounded-pill px-4" data-toggle="modal" data-target="#reservationModal">
            <i class="fa fa-plus-circle mr-2"></i> إضافة حجز جديد
        </button>
    </div>
    {{-- نهاية صف العنوان واليومي --}}


    <div class="row">
        
        <div class="col-12 mb-4">
            <div class="card shadow-lg">
                <div class="card-header bg-pro d-flex justify-content-between align-items-center">
                    <span class="font-weight-bold">
                        <i class="fa fa-calendar-o mr-2"></i> الجدول الشامل للحجوزات والتخصيص اليومي 🗓️
                    </span>
                    
                    {{-- قائمة تحديد السنة (عرض الميلادي فقط في القيمة) --}}
                    <div class="form-group mb-0 d-flex align-items-center">
                        <label for="ganttYearSelect" class="text-white font-weight-bold mr-2 mb-0">عرض سنة:</label>
                        <select id="ganttYearSelect" class="form-control form-control-sm rounded-pill" style="width: 150px;">
                            {{-- سيتم ملء الخيارات بواسطة JavaScript --}}
                        </select>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div id="ganttTableContainer" class="gantt-table-container">
                        {{-- سيتم توليد الجدول هنا بواسطة JavaScript --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal إضافة حجز (بدون تغيير) --}}
<div class="modal fade" id="reservationModal" tabindex="-1" role="dialog" aria-labelledby="reservationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content shadow-xl border-0 rounded-lg">

            <div class="modal-header rounded-top text-white" style="background: linear-gradient(145deg, #1976d2, #0d47a1);">
                <h5 class="modal-title font-weight-bold text-white" id="reservationModalLabel">
                    <i class="fa fa-pencil-square-o mr-2"></i> إضافة حجز جديد
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>

            <form id="reservationForm" class="p-4" method="POST" action="{{ route('reservations.store', ['hotel' => $hotel->id]) }}">
                @csrf
                <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                <div class="form-row">
                    {{-- حقول النموذج --}}
                    <div class="form-group col-md-6"><label class="font-weight-bold">نوع الحجز</label><select name="type" class="form-control form-control-lg rounded-pill input-fancy" required><option value="">اختر نوع الحجز</option><option value="فردي">فردي</option><option value="شركة">شركة</option><option value="بوكينج">بوكينج</option></select></div>
                    <div class="form-group col-md-6"><label class="font-weight-bold">الحالة</label><select name="status" class="form-control form-control-lg rounded-pill input-fancy" required><option value="">اختر الحالة</option><option value="مؤكد">مؤكد</option><option value="غير مؤكد">غير مؤكد</option><option value="ملغي">ملغي</option></select></div>
                    <div class="form-group col-md-6"><label class="font-weight-bold">العميل (الجهة)</label><input type="text" name="client" class="form-control form-control-lg rounded-pill input-fancy" required placeholder="اسم العميل أو الشركة"></div>
                    <div class="form-group col-md-6"><label class="font-weight-bold">النزيل (المقيم)</label><input type="text" name="guest" class="form-control form-control-lg rounded-pill input-fancy" required placeholder="اسم النزيل الأساسي"></div>
                    <div class="form-group col-md-4"><label class="font-weight-bold">الجنسية</label><input type="text" name="nationality" class="form-control form-control-lg rounded-pill input-fancy" required placeholder="جنسية النزيل"></div>
                    <div class="form-group col-md-4"><label class="font-weight-bold">الهاتف</label><input type="text" name="phone" class="form-control form-control-lg rounded-pill input-fancy" required placeholder="رقم الهاتف"></div>
                    <div class="form-group col-md-4"><label class="font-weight-bold">عدد الغرف</label><input type="number" min="1" name="rooms" id="rooms" class="form-control form-control-lg rounded-pill input-fancy" required value="1" placeholder="عدد الغرف المحجوزة"></div>
                    <div class="form-group col-md-3"><label class="font-weight-bold">تاريخ الوصول</label><input type="date" name="start" id="start" class="form-control form-control-lg rounded-pill input-fancy" required></div>
                    <div class="form-group col-md-3"><label class="font-weight-bold">تاريخ الخروج</label><input type="date" name="end" id="end" class="form-control form-control-lg rounded-pill input-fancy" required></div>
                    <div class="form-group col-md-2"><label class="font-weight-bold">الليالي</label><input type="number" min="0" name="nights" id="nights" class="form-control form-control-lg rounded-pill input-fancy" readonly required></div>
                    <div class="form-group col-md-2"><label class="font-weight-bold">السعر لليلة</label><input type="number" min="0" name="price" id="price" class="form-control form-control-lg rounded-pill input-fancy" required placeholder="0.00"></div>
                    <div class="form-group col-md-2"><label class="font-weight-bold">الإجمالي</label><input type="number" step="0.01" name="total" id="total" class="form-control form-control-lg rounded-pill input-fancy" readonly required placeholder="0.00"></div>
                </div>

                <div class="modal-footer border-0 pt-3">
                    <button type="button" class="btn btn-outline-secondary btn-lg rounded-pill px-4" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary-gradient btn-lg rounded-pill px-4 font-weight-bold">
                        <i class="fa fa-floppy-o mr-2"></i> حفظ الحجز
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
// ================== حساب الليالي والإجمالي (مُحسن) ==================
function calculateNights(){
    let start = document.getElementById("start").value;
    let end = document.getElementById("end").value;
    
    if(start && end){
        let s = new Date(start);
        let e = new Date(end);
        
        s.setHours(0, 0, 0, 0);
        e.setHours(0, 0, 0, 0);
        
        const oneDay = 1000 * 60 * 60 * 24;
        
        if (s >= e) {
            document.getElementById("nights").value = 0;
            document.getElementById("end").setCustomValidity("تاريخ المغادرة يجب أن يكون بعد تاريخ الوصول.");
        } else {
            const diffTime = e - s;
            const nights = diffTime / oneDay; 
            
            document.getElementById("nights").value = nights;
            document.getElementById("end").setCustomValidity("");
        }
        calculateTotal();
    }
}
function calculateTotal(){
    let price = parseFloat(document.getElementById("price").value)||0;
    let nights = parseFloat(document.getElementById("nights").value)||0;
    let rooms = parseFloat(document.getElementById("rooms").value)||1;
    document.getElementById("total").value = (price * nights * rooms).toFixed(2);
}

document.getElementById("start").addEventListener("change", calculateNights);
document.getElementById("end").addEventListener("change", calculateNights);
document.getElementById("price").addEventListener("input", calculateTotal);
document.getElementById("rooms").addEventListener("input", calculateTotal);
document.querySelectorAll('input[type="number"]').forEach(input=>{ 
    input.addEventListener('input',()=>{ 
        if(input.value < 0) input.value = 0; 
        if(input.name === 'rooms' || input.name === 'price') calculateTotal();
    }); 
});
document.addEventListener('DOMContentLoaded', calculateNights);


// ================== أدوات تحويل التاريخ (ميلادي إلى هجري) ==================

const hijriMonthNames = ["محرم", "صفر", "ربيع الأول", "ربيع الثاني", "جمادى الأولى", "جمادى الآخرة", "رجب", "شعبان", "رمضان", "شوال", "ذو القعدة", "ذو الحجة"];
const miliMonthNames = ["يناير", "فبراير", "مارس", "أبريل", "مايو", "يونيو", "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"];


/**
 * تحويل تاريخ ميلادي إلى هجري (مبني على Locale API)
 * @param {string} dateString - تاريخ ميلادي بصيغة YYYY-MM-DD
 * @returns {object} يحتوي على: day, monthName, year, shortDate (DD-MM-YYYY)
 */
function convertToHijri(dateString) {
    if (!dateString) return null;

    const date = new Date(dateString);

    // استخدام Intl.DateTimeFormat للحصول على التاريخ الهجري (تقويم أم القرى)
    const formatter = new Intl.DateTimeFormat('ar-SA-u-nu-latn', {
        day: 'numeric',
        month: 'numeric',
        year: 'numeric',
        calendar: 'islamic-umalqura'
    });
    
    // يخرج بالصيغة: DD/MM/YYYY هـ
    const formatted = formatter.format(date);
    const parts = formatted.replace(/\sهـ$/, '').split('/');
    
    const hDay = parts[0];
    const hMonthIndex = parseInt(parts[1], 10) - 1; 
    const hYear = parts[2];

    return {
        day: hDay,
        monthIndex: hMonthIndex,
        year: hYear,
        monthName: hijriMonthNames[hMonthIndex],
        // DD-MM-YYYY هـ
        shortDate: `${hDay}-${hMonthIndex + 1}-${hYear}` 
    };
}


// ================== توليد مخطط جانت الشامل (RTL) وحساب الإشغال ==================
const hotelRooms = {{ $hotel->rooms ?? 0 }};
let reservations = @json($hotel->reservations ?? []); // يجب أن تكون let ليتم فرزها
const todayDate = new Date().toISOString().slice(0, 10);

let currentGanttYear = new Date().getFullYear();


/**
 * دالة لحساب عدد الليالي بين تاريخين
 * @param {string} start - تاريخ الوصول
 * @param {string} end - تاريخ المغادرة
 * @returns {number} عدد الليالي
 */
function calculateNightsCount(start, end) {
    const s = new Date(start);
    const e = new Date(end);
    s.setHours(0, 0, 0, 0);
    e.setHours(0, 0, 0, 0);
    if (s >= e) return 0;
    const diffTime = e - s;
    return Math.ceil(diffTime / (1000 * 60 * 60 * 24));
}


/**
 * دالة لحساب الإشغال اليومي وعرضه في الدائرة
 */
function calculateDailyOccupancy() {
    if (hotelRooms === 0) {
        document.getElementById('dailyOccupancyCircle').style.setProperty('--daily-progress', 0);
        document.querySelector('#dailyOccupancyCircle .progress-value').textContent = '0%';
        document.getElementById('dailyOccupancyInfo').textContent = `لا توجد غرف متاحة لحساب الإشغال.`;
        return;
    }

    const todayDateObj = new Date(todayDate);
    let bookedRoomsToday = 0;

    reservations.forEach(r => {
        const start = new Date(r.start);
        const end = new Date(r.end);
        start.setHours(0, 0, 0, 0);
        end.setHours(0, 0, 0, 0);

        if (todayDateObj >= start && todayDateObj < end) {
            bookedRoomsToday += parseInt(r.rooms) || 0;
        }
    });

    const occupancyRate = Math.min(100, (bookedRoomsToday / hotelRooms) * 100);
    const remainingRooms = hotelRooms - bookedRoomsToday;
    const occupancyInt = Math.round(occupancyRate);

    document.getElementById('dailyOccupancyCircle').style.setProperty('--daily-progress', occupancyInt);
    document.querySelector('#dailyOccupancyCircle .progress-value').textContent = `${occupancyInt}%`;
    document.getElementById('dailyOccupancyInfo').textContent = `محجوز: ${bookedRoomsToday}. متبقي: ${remainingRooms}.`;
}


/**
 * دالة لحساب الإشغال السنوي (تبقى في الخلفية لاستكمال البيانات)
 */
function calculateAnnualOccupancy() {
    // هذه الدالة ستبقى لحساب نسبة الإشغال السنوي حتى لو لم يتم عرضها في واجهة المستخدم
    // يمكن استخدامها لاحقاً في لوحة تحكم أوسع
    const totalDaysInYear = (currentGanttYear % 400 === 0) || (currentGanttYear % 4 === 0 && currentGanttYear % 100 !== 0) ? 366 : 365;
    const totalRoomNightsAvailable = hotelRooms * totalDaysInYear;
    
    if (totalRoomNightsAvailable === 0) {
        return 0; // لا توجد غرف متاحة
    }

    let bookedNightsInYear = 0;

    reservations.forEach(r => {
        const arrivalYear = new Date(r.start).getFullYear();
        const departureYear = new Date(r.end).getFullYear();
        
        if (arrivalYear <= currentGanttYear && departureYear >= currentGanttYear) {
            const startOfYear = new Date(currentGanttYear, 0, 1);
            const endOfYear = new Date(currentGanttYear + 1, 0, 1); 

            const start = new Date(r.start);
            const end = new Date(r.end);
            
            const overlapStart = start > startOfYear ? start : startOfYear;
            const overlapEnd = end < endOfYear ? end : endOfYear;

            const nights = calculateNightsCount(overlapStart.toISOString().slice(0, 10), overlapEnd.toISOString().slice(0, 10));
            
            bookedNightsInYear += nights * (parseInt(r.rooms) || 0);
        }
    });

    const occupancyRate = (bookedNightsInYear / totalRoomNightsAvailable) * 100;
    return Math.round(occupancyRate);
}


function getGanttDates(year){
    const dates = [];
    const startDate = new Date(year, 0, 1);
    const endDate = new Date(year, 11, 31);
    
    let currentDate = startDate;
    while(currentDate <= endDate){
        dates.push(new Date(currentDate));
        currentDate.setDate(currentDate.getDate() + 1);
    }
    return dates;
}

function setupYearSelector() {
    const selector = document.getElementById('ganttYearSelect');
    selector.innerHTML = '';
    
    const currentYear = new Date().getFullYear();
    const minYear = currentYear - 2;
    const maxYear = currentYear + 3;

    for (let year = maxYear; year >= minYear; year--) {
        const option = document.createElement('option');
        
        const hijriYear = convertToHijri(`${year}-01-01`).year; 
        
        option.value = year;
        option.textContent = `${year} م (${hijriYear} هـ)`;
        
        if (year === currentYear) {
            option.selected = true;
            currentGanttYear = currentYear;
        }
        selector.appendChild(option);
    }
    
    selector.addEventListener('change', (e) => {
        currentGanttYear = parseInt(e.target.value);
        generateGanttTable();
        calculateAnnualOccupancy(); // إعادة حساب الإشغال السنوي عند تغيير السنة (حساب داخلي)
    });
}


function generateGanttTable(){
    // 1. ترتيب الحجوزات حسب تاريخ الوصول (الأقدم أولاً)
    reservations.sort((a, b) => new Date(a.start) - new Date(b.start));

    const days = getGanttDates(currentGanttYear);
    const labels = days.map(d => d.toISOString().slice(0, 10));

    // 2. حساب الغرف المحجوزة لكل يوم
    const dailyBookings = {};
    reservations.forEach(r => {
        const roomsCount = parseInt(r.rooms) || 0; 

        let start = labels.indexOf(r.start);
        let end = labels.indexOf(r.end);
        
        if(start === -1) start = (r.start < labels[0]) ? 0 : labels.length; 
        if(end === -1) end = (r.end > labels[labels.length - 1]) ? labels.length : 0;

        for(let i = Math.max(0, start); i < Math.min(labels.length, end); i++) {
            const dateStr = labels[i];
            dailyBookings[dateStr] = (dailyBookings[dateStr] || 0) + roomsCount;
        }
    });


    // 3. بناء صف الرؤوس (الأشهر والأيام)
    let html = '<table class="gantt-table"><thead>';
    
    const headerRow = [];
    days.forEach(day => {
        const dateStr = day.toISOString().slice(0, 10);
        const hijri = convertToHijri(dateStr);
        const isToday = dateStr === todayDate ? 'today-col' : '';
        headerRow.push({ dateStr, dayNum: day.getDate(), mMonth: day.getMonth(), mYear: day.getFullYear(), hijri, isToday });
    });

    // صف الأشهر (رأس الشهور الميلادية هي السائدة)
    let monthHeader = '<tr>';
    // Colspan = 8 للأعمدة الثابتة الجديدة
    monthHeader += '<th class="sticky-col col-1" colspan="8" style="text-align: center;">بيانات الحجوزات الثابتة</th>'; 

    let monthSpan = 0;
    let prevMiliMonth = -1;
    let prevMiliYear = '';
    let prevHijriMonthIndex = -1;
    let prevHijriYear = '';


    headerRow.forEach((h, index) => {
        const currentMiliMonth = h.mMonth;

        if (currentMiliMonth !== prevMiliMonth && prevMiliMonth !== -1) {
            const miliMonthName = miliMonthNames[prevMiliMonth];
            const hijriMonthName = hijriMonthNames[prevHijriMonthIndex];

            monthHeader += `<th colspan="${monthSpan}" style="background-color:#1976d2; color:white; border-bottom:none; font-size:11px;">
                <span class="month-header-pri">${miliMonthName} ${prevMiliYear} م</span>
                <span class="month-header-sec">(${hijriMonthName} ${prevHijriYear} هـ)</span>
            </th>`;
            monthSpan = 1;
        } else {
            monthSpan++;
        }
        prevMiliMonth = currentMiliMonth;
        prevMiliYear = h.mYear;
        prevHijriMonthIndex = h.hijri.monthIndex;
        prevHijriYear = h.hijri.year;
    });
    // لإضافة الشهر الأخير
    if (prevMiliMonth !== -1) {
        const miliMonthName = miliMonthNames[prevMiliMonth];
        const hijriMonthName = hijriMonthNames[prevHijriMonthIndex];

        monthHeader += `<th colspan="${monthSpan}" style="background-color:#1976d2; color:white; border-bottom:none; font-size:11px;">
            <span class="month-header-pri">${miliMonthName} ${prevMiliYear} م</span>
            <span class="month-header-sec">(${hijriMonthName} ${prevHijriYear} هـ)</span>
        </th>`;
    }
    monthHeader += '</tr>';
    html += monthHeader;


    // صف الأيام (المدمج: ميلادي/هجري)
    html += '<tr>';
    
    // رؤوس الأعمدة الثابتة المفصلة (8 أعمدة)
    html += '<th class="sticky-col col-1">النزيل</th>'; 
    html += '<th class="sticky-col col-2">العميل</th>'; 
    html += '<th class="sticky-col col-3">وصول</th>'; 
    html += '<th class="sticky-col col-4">خروج</th>'; 
    html += '<th class="sticky-col col-5">السعر لليلة</th>'; 
    html += '<th class="sticky-col col-6">الإجمالي</th>'; 
    html += '<th class="sticky-col col-7">الغرف</th>';
    html += '<th class="sticky-col col-8">النوع</th>'; 

    // رؤوس الأيام القابلة للتمرير (رقم اليوم الميلادي + الهجري)
    headerRow.forEach(h => {
        html += `<th class="day-header ${h.isToday}" title="م: ${h.dateStr}, هـ: ${h.hijri.shortDate}"> 
            <span class="m-date-pri">${h.dayNum}</span>
            <span class="g-date-sec">(${h.hijri.day})</span>
        </th>`;
    });
    html += '</tr>';


    // 4. صف الغرف المتاحة (ثابت تحت الأيام)
    html += '<tr class="available-row">';
    // تحديد عمود "المتاح" ليصبح العمود الثامن
    html += '<th class="sticky-col col-1"></th>'; 
    html += '<th class="sticky-col col-2"></th>'; 
    html += '<th class="sticky-col col-3"></th>';
    html += '<th class="sticky-col col-4"></th>';
    html += '<th class="sticky-col col-5"></th>';
    html += '<th class="sticky-col col-6"></th>';
    html += '<th class="sticky-col col-7"></th>';
    html += '<th class="sticky-col col-8"></th>'; 
    
    // خلايا الأيام للمتاح (العدد فقط)
    labels.forEach((dateStr, index) => {
        const bookedCount = dailyBookings[dateStr] || 0;
        const availableCount = hotelRooms - bookedCount;
        const isToday = dateStr === todayDate ? 'today-col' : '';
        
        let cellClass = '';
        if (availableCount < 0) {
            cellClass = 'no-availability';
        } else if (availableCount <= 2 && availableCount > 0) {
            cellClass = 'low-availability';
        }

        html += `<td class="${isToday} ${cellClass}" title="المتبقي: ${availableCount} غرف">${availableCount < 0 ? `+${Math.abs(availableCount)}` : availableCount}</td>`;
    });
    html += '</tr></thead><tbody>'; 

    // 5. بناء صفوف الحجوزات
    reservations.forEach((r) => {
        
        // تحويل السعر والإجمالي إلى عدد صحيح
        const priceInt = Math.round(parseFloat(r.price));
        const totalInt = Math.round(parseFloat(r.total));
        
        html += `<tr data-reservation-id="${r.id}">`;
        
        // --- الأعمدة الثابتة (بيانات الحجز التفصيلية) ---
        
        // العمود 1: النزيل
        html += `<td class="sticky-col col-1 text-right">
            <span class="primary-text">${r.guest}</span>
        </td>`;
        
        // العمود 2: العميل
        html += `<td class="sticky-col col-2 text-right">
            <span class="secondary-text">${r.client}</span>
        </td>`;

        // العمود 3: تاريخ الوصول (ميلادي)
        html += `<td class="sticky-col col-3">
            <span class="date-text">${r.start}</span>
        </td>`;
        
        // العمود 4: تاريخ الخروج (ميلادي)
        html += `<td class="sticky-col col-4">
            <span class="date-text" style="color: #c62828;">${r.end}</span>
        </td>`;
        
        // العمود 5: السعر لليلة (بدون علامة عشرية)
        html += `<td class="sticky-col col-5">
            <span class="price-text">${priceInt}</span>
        </td>`;
        
        // العمود 6: الإجمالي (بدون علامة عشرية)
        html += `<td class="sticky-col col-6">
            <span class="price-text" style="color: #004d40;">${totalInt}</span>
        </td>`;

        // العمود 7: عدد الغرف
        html += `<td class="sticky-col col-7">
            <span class="primary-text" style="color: #5c6bc0;">${r.rooms}</span>
        </td>`;
        
        // العمود 8: النوع
        html += `<td class="sticky-col col-8">
            <span class="secondary-text" style="color: #333;">${r.type}</span>
        </td>`;
        
        // --- خلايا مخطط جانت (الأيام القابلة للتمرير) ---
        labels.forEach((dateStr, index) => {
            const startIdx = labels.indexOf(r.start);
            const endIdx = labels.indexOf(r.end);
            const isReserved = index >= startIdx && index < endIdx;
            
            const isToday = dateStr === todayDate ? 'today-col' : '';

            if (isReserved) {
                html += `<td class="reservation-cell ${isToday}" title="محجوز: ${r.rooms} غرف للنزيل ${r.guest}">${r.rooms}</td>`;
            } else {
                html += `<td class="${isToday}"></td>`;
            }
        });
        html += '</tr>';
    });

    html += '</tbody></table>';

    document.getElementById('ganttTableContainer').innerHTML = html;
    
    // محاولة التمرير لليوم الحالي
    const todayCell = document.querySelector('.gantt-table th.today-col');
    if (todayCell) {
        const container = document.getElementById('ganttTableContainer');
        const offset = todayCell.offsetLeft;
        const containerWidth = container.clientWidth;
        container.scrollLeft = offset - (containerWidth / 2);
    }
}

// تهيئة محدد السنة وتوليد الجدول وحساب الإشغال عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', () => {
    calculateNights();
    setupYearSelector();
    generateGanttTable(); 
    calculateDailyOccupancy(); 
    calculateAnnualOccupancy(); // تبقى للحساب الداخلي
});

</script>
@endsection