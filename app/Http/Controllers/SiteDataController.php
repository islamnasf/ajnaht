<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        'name'        => 'nullable|string|max:255',
        'description' => 'nullable|string|max:255',
        'textarea'    => 'nullable|string',

        // الروابط
        'faceLink'  => 'nullable|string',
        'instaLink' => 'nullable|string',
        'wattsLink' => 'nullable|string',

        // الاتصالات
        'phone1'   => 'nullable|string|max:20',
        'phone2'   => 'nullable|string|max:20',
        'email'    => 'nullable|email',
        'location' => 'nullable|string',
        'address'  => 'nullable|string|max:255',

        // الصور
        'logo'        => 'nullable|image|mimes:jpg,jpeg,png,webp',
        'imageHeader' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        'aboutImage'  => 'nullable|image|mimes:jpg,jpeg,png,webp',
    ]);

    // نجيب أول سجل
    $data = SiteData::first();

    if (!$data) {
        $data = new SiteData(); // لو مفيش عنصر اتوماتيك ينشئه
    }

    // Update النصوص
    $data->name        = $validated['name']        ?? $data->name;
    $data->description = $validated['description'] ?? $data->description;
    $data->textarea    = $validated['textarea']    ?? $data->textarea;

    $data->faceLink  = $validated['faceLink']  ?? $data->faceLink;
    $data->instaLink = $validated['instaLink'] ?? $data->instaLink;
    $data->wattsLink = $validated['wattsLink'] ?? $data->wattsLink;

    $data->phone1   = $validated['phone1']   ?? $data->phone1;
    $data->phone2   = $validated['phone2']   ?? $data->phone2;
    $data->email    = $validated['email']    ?? $data->email;
    $data->location = $validated['location'] ?? $data->location;
    $data->address  = $validated['address']  ?? $data->address;

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
    $hotels = Category::take(4)->get();

    $data = SiteData::first();

    return view('landing', compact('data', 'hotels'));
}




}
