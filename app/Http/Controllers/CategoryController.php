<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

}
