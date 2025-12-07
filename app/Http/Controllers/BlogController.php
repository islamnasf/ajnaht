<?php

namespace App\Http\Controllers;

use App\Models\Plog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Plog::get();
        return view('/admin/plog', compact('blogs'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'image' => 'nullable|image',
            'contant' => 'nullable|string',
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
        }

        Plog::create([
            'name' => $validatedData['name'],
            'image' => $imagePath,
            'contant' => $request->contant,
        ]);

        toastr()->success('تمت الاضافة بنجاح');
        return back();
    }

    public function update(Request $request, $id)
    {
        $plog = Plog::findOrFail($id);

        // Validate
        $validatedData = $request->validate([
            'name' => 'required',
            'image' => 'nullable|image',
            'contant' => 'nullable|string',
        ]);

        // Handle Image
        $imagePath = $plog->image; // الصورة القديمة

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->move(
                'categories/images',
                $request->file('image')->getClientOriginalName()
            );
        }

        // Update
        $plog->update([
            'name' => $validatedData['name'],
            'image' => $imagePath,
            'contant' => $request->contant,
        ]);

        toastr()->success('تم التعديل بنجاح');
        return back();
    }

    public function delete(Request $request, int $sr)
    {
        Plog::findOrFail($sr)->delete();
        toastr()->success('Data Deleted successfully');
        return back();
    }
}
