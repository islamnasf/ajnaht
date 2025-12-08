<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $hotels = Category::get();
        return view('/admin/hotelReservation', compact('hotels'));
    }
  public function showReservations($id)
{
    $hotel = Category::with('reservations')->findOrFail($id); 
    $reservations = $hotel->reservations->map(function($r) {
        return [
            'client' => $r->client,
            'guest' => $r->guest,
            'rooms' => (int) $r->rooms,
            'start' => $r->start,
            'end' => $r->end
        ];
    })->toArray();
    // جلب الفندق مع كل الحجوزات المرتبطة به

    return view('admin.reservation', compact('hotel','reservations'));
}


    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'client' => 'nullable|string',
            'status' => 'required|string',
            'guest' => 'nullable|string',
            'nationality' => 'nullable|string',
            'phone' => 'nullable|string',
                        'email' => 'nullable|string',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
            'rooms' => 'nullable|integer',
            'price' => 'nullable|numeric',
            'total' => 'nullable|numeric',
            'hotel_id' => 'required',
        ]);

        Reservation::create([
            'type' => $request->type,
            'client' => $request->client,
            'status' => $request->status,
            'guest' => $request->guest,
            'nationality' => $request->nationality,
            'phone' => $request->phone,
             'email' => $request->email,
            'start' => $request->start,
            'end' => $request->end,
            'rooms' => $request->rooms,
            'price' => $request->price,
            'total' => $request->total,
            'hotel_id' => $request->hotel_id,
        ]);
                    toastr()->success(' تم بنجاج');

        return redirect()->back();

    }



public function allReservations()
{
    $reservations = Reservation::with(['details', 'category', 'user'])
        ->orderBy('start', 'desc')
        ->get();

    return view('admin.userReservation', compact('reservations'));
}


public function cancelReservation($id)
{
    // البحث عن الحجز
    $reservation = Reservation::findOrFail($id);

    $reservation->status = 'cancelled'; // أو القيمة التي تستخدمها في قاعدة البيانات مثل 'cancelled'
    $reservation->save();
    return redirect()->back()->with('success', 'تم إلغاء الحجز بنجاح');
}
public function updateStatus(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status' => 'required|in:confirmed,cancelled,', // الفراغ هنا يمثل حالة 'غير مؤكد'
        ]);

        // إذا كانت الحالة المرسلة فارغة، قم بتعيين قيمة NULL
        $status = $request->status === '' ? null : $request->status;

        $reservation->status = $status;
        $reservation->save();

        return redirect()->back()->with('success', 'تم تعديل حالة الحجز بنجاح.');
    }

    // دالة لحذف الحجز بالكامل
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        
        return redirect()->back()->with('success', 'تم حذف الحجز بنجاح.');
    }

}
