<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Plog;
use App\Models\ReserDetail;
use App\Models\Reservation;
use App\Models\SiteData;
use Illuminate\Http\Request;

class SiteDataController extends Controller
{
    public function index()
    {
        $data = SiteData::first(); // عرض أول عنصر فقط

        return view('admin/siteData', compact('data'));
    }
    public function hotels()
    {
        $hotels = Category::all();

        $data = SiteData::first(); // عرض أول عنصر فقط

        return view('hotels', compact('data', 'hotels'));
    }

    public function updateSiteData(Request $request)
    {
        // Validate
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'textarea' => 'nullable|string',

            // الروابط
            'faceLink' => 'nullable|string',
            'instaLink' => 'nullable|string',
            'wattsLink' => 'nullable|string',

            // الاتصالات
            'phone1' => 'nullable|string|max:20',
            'phone2' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'location' => 'nullable|string',
            'address' => 'nullable|string|max:255',

            // الصور
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'imageHeader' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'aboutImage' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        // نجيب أول سجل
        $data = SiteData::first();

        if (!$data) {
            $data = new SiteData(); // لو مفيش عنصر اتوماتيك ينشئه
        }

        // Update النصوص
        $data->name = $validated['name'] ?? $data->name;
        $data->description = $validated['description'] ?? $data->description;
        $data->textarea = $validated['textarea'] ?? $data->textarea;

        $data->faceLink = $validated['faceLink'] ?? $data->faceLink;
        $data->instaLink = $validated['instaLink'] ?? $data->instaLink;
        $data->wattsLink = $validated['wattsLink'] ?? $data->wattsLink;

        $data->phone1 = $validated['phone1'] ?? $data->phone1;
        $data->phone2 = $validated['phone2'] ?? $data->phone2;
        $data->email = $validated['email'] ?? $data->email;
        $data->location = $validated['location'] ?? $data->location;
        $data->address = $validated['address'] ?? $data->address;

        // ==========================
        //  معالجة الصور
        // ==========================

        // LOGO
        if ($request->hasFile('logo')) {
            if ($data->logo && file_exists(public_path($data->logo))) {
                unlink(public_path($data->logo));
            }

            $fileName = 'logo_' . time() . '.' . $request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('uploads'), $fileName);
            $data->logo = 'uploads/' . $fileName;
        }

        // Image Header
        if ($request->hasFile('imageHeader')) {
            if ($data->imageHeader && file_exists(public_path($data->imageHeader))) {
                unlink(public_path($data->imageHeader));
            }

            $fileName = 'header_' . time() . '.' . $request->imageHeader->getClientOriginalExtension();
            $request->imageHeader->move(public_path('uploads'), $fileName);
            $data->imageHeader = 'uploads/' . $fileName;
        }

        // About Image
        if ($request->hasFile('aboutImage')) {
            if ($data->aboutImage && file_exists(public_path($data->aboutImage))) {
                unlink(public_path($data->aboutImage));
            }

            $fileName = 'about_' . time() . '.' . $request->aboutImage->getClientOriginalExtension();
            $request->aboutImage->move(public_path('uploads'), $fileName);
            $data->aboutImage = 'uploads/' . $fileName;
        }

        // Save
        $data->save();

        toastr()->success('تم تحديث بيانات الموقع بنجاح');
        return back();
    }

    public function landing()
    {
        // جلب أول 4 فنادق فقط
        $hotels = Category::get();
        // $allHotels = Category::with('prices')
        //     ->whereHas('prices', function ($q) {
        //         $q->where('roomAvailable', '>', 0);
        //     })
        //     ->get();

                $allHotels = Category::with(['prices.periods' => function($query) {
        $query->where('rooms_available', '>', 0)
              ->where('end', '>=', now());
    }])
    ->whereHas('prices.periods', function ($q) {
        $q->where('rooms_available', '>', 0)
          ->where('end', '>=', now());
    })
    ->get();
        $data = SiteData::first();

        return view('landing', compact('data', 'hotels', 'allHotels'));
    }
    public function newReser(Request $request)
    {
        $hotel = Category::where('id', $request->hotel_id)->with('prices')->first();
        $start = $request->start;
        $end = $request->end;
        $data = SiteData::first();



        // قم بتعريف متغيرات البداية والنهاية بناءً على طلب المستخدم أو قيمة افتراضية
// هذا مجرد مثال، يجب أن تحصل على $hotel_id, $start, $end من الـ Request أو الـ Route
$hotel_id = $request->hotel_id ?? 1; // مثال



$hotel = Category::with(['prices.periods' => function ($query) use ($start, $end) {
    // جلب الفترات التي تتداخل مع فترة الإقامة
    // أو التي تبدأ في نفس يوم الوصول على الأقل
    $query->where('rooms_available', '>', 0)
        ->where('start', '<=', $end) // الفترة تبدأ قبل أو في يوم المغادرة
        ->where('end', '>=', $start); // الفترة تنتهي بعد أو في يوم الوصول
}])
->where('id', $hotel_id) // جلب الفندق المحدد فقط
->firstOrFail();

// تجهيز الغرف المتاحة (سيتم استخدامها في View)
$available_rooms_data = [];
$has_available_rooms = false;

foreach ($hotel->prices as $price_entry) {
    foreach ($price_entry->periods as $period) {
        // تأكد من أن الفترة تغطي ليلة واحدة على الأقل
        if ($period->rooms_available > 0) {
            $available_rooms_data[] = [
                'beds' => $price_entry->beds, // عدد الأسرة (لتحديد نوع الغرفة)
                'price_id' => $price_entry->id, // Price ID
                'period_id' => $period->id,
                'room_label' => $price_entry->label ?? $price_entry->name ,
                'room_available' => $period->rooms_available,
                'period_price' => $period->period_price, // السعر الخاص بهذه الفترة
            ];
            $has_available_rooms = true;
        }
    }
}

return view('newReser', compact('data','hotel', 'start', 'end', 'available_rooms_data', 'has_available_rooms'));
    }



    public function hotelDetails($hotel)
    {
        // $hotel = Category::with(['prices.periods', 'files'])->findOrFail($hotel);
        $hotel = Category::with(['prices.periods' => function($query) {
    $query->where('rooms_available', '>', 0)
          ->where('end', '>=', now());
}])->find($hotel); // مثلا حسب الـ ID

        $data = SiteData::first();

        return view('hotelDetails', compact('data', 'hotel'));
    }
    //reservation 
public function storeReservation(Request $request)
{
    // Validate Request
    $request->validate([
        'full_name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'email' => 'required|email',
        'check_in_date' => 'required|date',
        'check_out_date' => 'required|date|after_or_equal:check_in_date',
        'number_of_nights' => 'required|integer|min:1',
        'rooms' => 'required|array',
        'hotel_id' => 'required|exists:categories,id',
        // يمكن إضافة تحقق إضافي لـ rooms للتأكد من وجود period_id و period_price
    ]);

    // حساب الإجمالي بطريقة آمنة باستخدام الأسعار المرسلة من الفورم (والتي تم جلبها من جدول Periods)
    $total_price = 0;
    $total_rooms_count = 0;
    $number_of_nights = (int) $request->number_of_nights;

    // Fetch hotel only for logging/checking purposes, not for price.
    // $hotel = Category::findOrFail($request->hotel_id); 
    // ^ لا نحتاجها لجلب السعر الآن

    $reservation_details = [];

    foreach ($request->rooms as $period_id => $room_data) {
        // تخطي أي غرفة مافيهاش count أو count = 0
        if (!isset($room_data['count']) || (int) $room_data['count'] <= 0) {
            continue;
        }

        $room_count = (int) $room_data['count'];
        $period_price = (float) $room_data['period_price']; // السعر من الفترة
        $beds_count = (int) $room_data['beds'];
        
        // التحقق من صحة السعر والفترة (أفضل ممارسة)
        // قم بالبحث في قاعدة البيانات عن Period المحدد للتأكد من صحة السعر والتوفر
        $period = \App\Models\Period::where('id', $period_id)
                                    ->where('period_price', $period_price) // تحقق من أن السعر الممرر مطابق للسعر الفعلي
                                    ->first();

        // في حال عدم وجود الفترة أو اختلاف السعر (تلاعب)، يجب التوقف أو جلب السعر الصحيح.
        if (!$period) {
            // يمكن رمي خطأ أو إعادة التوجيه برسالة خطأ إذا لم يتم العثور على الفترة/السعر المطابق
             return redirect()->back()->withErrors(['rooms' => 'خطأ في بيانات الغرف المحددة أو الأسعار. يرجى المحاولة مرة أخرى.']);
        }
        
        // حساب الإجمالي
        $total_price += $room_count * $period_price * $number_of_nights;
        $total_rooms_count += $room_count;

        // تجهيز تفاصيل الحجز
        $reservation_details[] = [
            'type' => $beds_count,
            'count' => $room_count,
            'price' => $period_price, // سعر الليلة الواحدة في هذه الفترة
            'period_id' => $period->id, // إضافة Period ID للحجز
        ];
    }
    
    // إذا لم يتم اختيار أي غرف
    if ($total_rooms_count === 0) {
        return redirect()->back()->withErrors(['rooms' => 'يجب اختيار غرفة واحدة على الأقل.']);
    }

    // إنشاء الحجز
    $reservation = Reservation::create([
        'client' => $request->full_name,
        'phone' => $request->phone,
        'email' => $request->email,
        'start' => $request->check_in_date,
        'end' => $request->check_out_date,
        'rooms' => $total_rooms_count,
        'price' => $total_price, // السعر الإجمالي
        'total' => $total_price, // (قد يكون هناك ضريبة لاحقاً، لكن هنا متساويان)
        'hotel_id' => $request->hotel_id,
        'user_id' => auth()->id(),
    ]);

    // إضافة تفاصيل الحجز (ReserDetail)
    foreach ($reservation_details as $detail) {
        ReserDetail::create([
            'type' => $detail['type'] , // لنوع الغرفة
            'count' => $detail['count'],
            'price' => $detail['price'],
            'reservation_id' => $reservation->id,
            // ❗ يمكنك تخزين period_id هنا لتسهيل عملية الخصم من التوفر لاحقاً (ملاحظة: الـ schema لديك لا يتضمن period_id في ReserDetail)
        ]);
        
        // ❗ ملاحظة هامة: يجب تحديث عدد الغرف المتاحة في جدول periods هنا
        // $period = \App\Models\Period::find($detail['period_id']);
        // $period->decrement('rooms_available', $detail['count']);
        
    }

    return redirect()->route('searchOldReser', [
        'phone' => $request->phone,
    ])->with('success', 'تم إنشاء الحجز بنجاح!');
}


    public function searchOldReser(Request $request)
    {
        $reservations = Reservation::where('phone', $request->phone)->with('details')->orderBy('id', 'desc')->get();
        $data = SiteData::first();
        return view('searchOldReser', compact('data', 'reservations'));
    }


    public function blogs(Request $request)
    {
        $blogs = Plog::get();
        $data = SiteData::first();
        return view('blogs', compact('data', 'blogs'));
    }
    public function showPlog($id)
    {
        $blog = Plog::findOrFail($id);
        $relatedBlogs = Plog::where('id', '!=', $id)
            ->latest()
            ->take(5)
            ->get();
        $data = SiteData::first();

        return view('blogDetails', compact('blog', 'relatedBlogs', 'data'));
    }
}
