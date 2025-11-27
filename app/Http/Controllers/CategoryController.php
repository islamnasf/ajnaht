<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
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
}
