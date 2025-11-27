<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($vendor)
    {
        $products = Product::where('vendor_id',$vendor)->get();
        return view('/admin/product', compact('products','vendor'));
    }
    public function store(Request $request,$vendor)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required',
        ], [
            'name.required' => 'The name is required.',
            'price.required' => 'The price is required.',
        ]);
    
        // Handle the image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            try {
                $imagePath = $request->file('image')->move('vendors/0/images', $request->file('image')->getClientOriginalName());
            } catch (\Exception $e) {
                return back()->withInput()->withErrors(['image' => 'An error occurred while uploading the image.']);
            }
        }
            try {
            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'discount' => $request->discount,
                'vendor_id' => $vendor,
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
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'vendor_id' => 'required',
        ], [
            'name.required' => 'The name is required.',
            'vendor.required' => 'The vendor is required.',
            'price.required' => 'The price is required.',
        ]);
    
        // Find the vendor or fail
        $product = Product::findOrFail($sr);
    
        // Handle the image upload
        $imagePath = $product->image; // Keep existing image path by default
        if ($request->hasFile('image')) {
            try {
                $imagePath = $request->file('image')->move('vendors/0/images', $request->file('image')->getClientOriginalName());
            } catch (\Exception $e) {
                return back()->withInput()->withErrors(['image' => 'An error occurred while uploading the image.']);
            }
        }
    
        // Update the vendor
        try {
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'discount' => $request->discount,
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

        Product::findOrFail($sr)->delete();
        toastr()->success('Data deletes successfully');
        return back();
    }
}
