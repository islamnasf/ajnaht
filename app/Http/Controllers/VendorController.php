<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller

{
    public function index()
    {
        $vendors = Vendor::get();
        $subcats = SubCategory::get();
        $cats = Category::get();
        return view('/admin/vendor', compact('vendors','cats','subcats'));
    }
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'wattsapp' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'address' => 'required',
            'sub_category_id' => 'required',
        ], [
            'name.required' => 'The name is required.',
            'sub_category_id.required' => 'The sub-category is required.',
            'description.required' => 'The description is required.',
            'wattsapp.required' => 'The WhatsApp number is required.',
            'phone.required' => 'The phone number is required.',
            'address.required' => 'The address is required.',
            'city.required' => 'The city is required.',
        ]);
    
        // Handle the image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            try {
                $imagePath = $request->file('image')->move('subCategories/0/images', $request->file('image')->getClientOriginalName());
            } catch (\Exception $e) {
                return back()->withInput()->withErrors(['image' => 'An error occurred while uploading the image.']);
            }
        }
    
        // Create the vendor
        try {
            $vendor = Vendor::create([
                'name' => $request->name,
                'description' => $request->description,
                'wattsapp' => $request->wattsapp,
                'phone' => $request->phone,
                'city' => $request->city,
                'address' => $request->address,
                'sub_category_id' => $request->sub_category_id,
                'image' => $imagePath,
            ]);
    
            toastr()->success('Data saved successfully');
        } catch (\Exception $e) {
            toastr()->error('There is a problem right now, please try again');
            return back()->withInput();
        }
    
        return back();
    }
    
    public function update(Request $request, int $sr)
{
    // Validate the request data
    $validatedData = $request->validate([
        'name' => 'required',
        'description' => 'required',
        'wattsapp' => 'required',
        'phone' => 'required',
        'city' => 'required',
        'address' => 'required',
    ], [
        'name.required' => 'The name is required.',
        'description.required' => 'The description is required.',
        'wattsapp.required' => 'The WhatsApp number is required.',
        'phone.required' => 'The phone number is required.',
        'address.required' => 'The address is required.',
        'city.required' => 'The city is required.',
    ]);

    // Find the vendor or fail
    $vendor = Vendor::findOrFail($sr);

    // Handle the image upload
    $imagePath = $vendor->image; // Keep existing image path by default
    if ($request->hasFile('image')) {
        try {
            $imagePath = $request->file('image')->move('subCategories/0/images', $request->file('image')->getClientOriginalName());
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['image' => 'An error occurred while uploading the image.']);
        }
    }

    // Update the vendor
    try {
        $vendor->update([
            'name' => $request->name,
            'description' => $request->description,
            'wattsapp' => $request->wattsapp,
            'phone' => $request->phone,
            'city' => $request->city,
            'address' => $request->address,
            'image' => $imagePath,
        ]);

        toastr()->success('Data updated successfully');
    } catch (\Exception $e) {
        toastr()->error('There is a problem right now, please try again');
        return back()->withInput();
    }

    return back();
}

    
 
    public function delete(Request $request, int $sr)
    {

        Vendor::findOrFail($sr)->delete();
        toastr()->success('Data deletes successfully');
        return back();
    }

}