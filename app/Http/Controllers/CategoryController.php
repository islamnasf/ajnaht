<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Period;
use Illuminate\Http\Request;
use App\Models\Price;
use App\Models\File;

use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('prices')->get();
        return view('/admin/categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'image' => 'image',
            'rooms' => 'nullable|string',
            'beds' => 'nullable|string',
            'address' => 'nullable|string',
            'location' => 'nullable|string',
            'rate' => 'nullable|string',
        ], [
            'name.required' => 'The name field is required.',
            'image.image' => 'The file must be an image.',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->move(
                'categories/images',
                $request->file('image')->getClientOriginalName()
            );
            if (!$imagePath) {
                return back()->withInput()->withErrors(['image' => 'An error occurred while uploading the image.']);
            }
        }

        $categry = Category::create([
            'name' => $validatedData['name'],
            'image' => $imagePath,
            'rooms' => $request->rooms,
            'beds' => $request->beds,
            'address' => $request->address,
                        'location' => $request->location,
            'rate' => $request->rate,
        ]);

        toastr()->success('Data saved successfully');
        return back();
    }

    public function update(Request $request, int $sr)
    {
        $validatedData = $request->validate([
            'name' => [
                'required',
                Rule::unique('categories')->ignore($sr),
                'max:100',
            ],
            'image' => 'image',
            'rooms' => 'nullable|string',
            'beds' => 'nullable|string',
            'address' => 'nullable|string',
            'location' => 'nullable|string',
            'rate' => 'nullable|string',
        ]);

        $categry = Category::findOrFail($sr);
        $imagePath = $categry->image;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->move(
                'categories/images',
                $request->file('image')->getClientOriginalName()
            );
            if (!$imagePath) {
                return back()->withInput()->withErrors(['image' => 'An error occurred while uploading the image.']);
            }
        }

        $categry->update([
            'name' => $validatedData['name'],
            'image' => $imagePath,
            'rooms' => $request->rooms,
            'beds' => $request->beds,
            'address' => $request->address,
                                    'location' => $request->location,

            'rate' => $request->rate,
        ]);

        toastr()->success('Data updated successfully');
        return back();
    }

    public function delete(Request $request, int $sr)
    {
        Category::findOrFail($sr)->delete();
        toastr()->success('Data Deleted successfully');
        return back();
    }


public function updatePrices(Request $request, $id)
{
    $category = Category::findOrFail($id);

    foreach ($request->prices as $beds => $data) {

        Price::updateOrCreate(
            [
                'category_id' => $id,
                'name'        => $beds
            ],
            [
                'price'         => $data['price'] ?? 0,
                'roomAvailable' => $data['roomAvailable'] ?? 0,
            ]
        );
    }

    return back()->with('success', 'تم تحديث البيانات بنجاح');
}

public function storeFiles(Request $request)
{
    $request->validate([
        'images.*' => 'required',
        'category_id' => 'nullable|exists:categories,id'
    ]);

    if ($request->hasFile('images')) {

        foreach ($request->file('images') as $image) {

            // اسم ملف فريد
            $fileName = time() . '_' . $image->getClientOriginalName();

            // رفع الصورة
            $path = $image->move(
                public_path('categories/images'),
                $fileName
            );

            // لو فشل الرفع
            if (!$path) {
                return back()->withErrors([
                    'images' => 'حدث خطأ أثناء رفع إحدى الصور.'
                ]);
            }

            // حفظ المسار في قاعدة البيانات
            File::create([
                'image' => 'categories/images/' . $fileName,
                'category_id' => $request->category_id
            ]);
        }
    }

    return back()->with('success', 'تم رفع الصور بنجاح');
}


public function deleteFile($id)
{
    $file = File::findOrFail($id);

    $file->delete();

    return back()->with('success', 'تم حذف الصورة بنجاح');
}


// عرض وإدارة فترات سعر محدد
public function showPeriods($categoryId, $priceId)
{
    $category = Category::findOrFail($categoryId);
    
    // تحميل السعر مع العلاقة بالـ Category
    $price = Price::with('hotel')
                ->where('category_id', $categoryId)
                ->where('name', $priceId) // إذا كان priceId هو اسم النوع (1,2,3,4,5)
                ->first();
    
    // إذا كان priceId هو ID وليس name
    // $price = Price::with('category')->findOrFail($priceId);
    
    if (!$price) {
        // إذا لم يوجد سعر، قم بإنشاء واحد جديد
        $price = Price::create([
            'category_id' => $categoryId,
            'name' => $priceId,
            'price' => 0,
            'roomAvailable' => 0
        ]);
    }
    
    // تحميل الفترات
    $price->load('periods');
    
    return view('admin.periods', compact('category', 'price'));
}
// حفظ فترة جديدة
// حفظ فترة جديدة
public function storePeriod(Request $request, $categoryId, $priceId)
{
    $request->validate([
        'start' => 'required|date',
        'end' => 'required|date|after_or_equal:start',
        'rooms_available' => 'required|integer|min:0',
        'period_price' => 'required|numeric|min:0', // سعر الفترة الجديد
    ]);
    
    // البحث عن السعر للتحقق من وجوده
    $price = Price::where('category_id', $categoryId)
                ->find($priceId);
    
    if (!$price) {
        return back()->with('error', 'السعر المطلوب غير موجود!');
    }
    
    // التحقق من عدم تداخل الفترات لنفس السعر
    $overlapping = Period::where('price_id', $priceId)
        ->where(function($query) use ($request) {
            $query->where(function($q) use ($request) {
                // الفترة الجديدة تبدأ أو تنتهي داخل فترة موجودة
                $q->where('start', '<=', $request->start)
                  ->where('end', '>=', $request->start);
            })->orWhere(function($q) use ($request) {
                $q->where('start', '<=', $request->end)
                  ->where('end', '>=', $request->end);
            })->orWhere(function($q) use ($request) {
                // الفترة الجديدة تحتوي على فترة موجودة
                $q->where('start', '>=', $request->start)
                  ->where('end', '<=', $request->end);
            });
        })->exists();
    
    if ($overlapping) {
        return back()->with('error', 'هذه الفترة تتداخل مع فترة موجودة مسبقاً!');
    }
    
    // التحقق من أن عدد الغرف لا يتجاوز الحد الأقصى
    if ($request->rooms_available > $price->roomAvailable) {
        return back()->with('error', 'عدد الغرف المتاحة يتجاوز الحد الأقصى (' . $price->roomAvailable . ')');
    }
    
    // إنشاء الفترة
    Period::create([
        'price_id' => $priceId,
        'start' => $request->start,
        'end' => $request->end,
        'rooms_available' => $request->rooms_available,
        'period_price' => $request->period_price, // حفظ سعر الفترة
    ]);
    
    return back()->with('success', 'تم إضافة الفترة بنجاح');
}

// حذف فترة
public function deletePeriod($periodId)
{
    $period = Period::findOrFail($periodId);
    $period->delete();
    
    return back()->with('success', 'تم حذف الفترة بنجاح');
}
}
