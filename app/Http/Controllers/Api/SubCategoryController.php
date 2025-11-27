<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Vendor;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function showSubCategory($cat){
        return SubCategory::where('category_id',$cat)->get();

    }
    public function showVendors($sub){
        return Vendor::where('sub_category_id',$sub)->get();

    }
    public function showProducts($vendor){
        return Product::where('vendor_id',$vendor)->get();

    }
    public function showDiscountProducts($vendor){
        $products = Product::where('vendor_id', $vendor)
        ->whereNotNull('discount')
        ->get();
        return $products;
    }
    public function showNewProducts($vendor){
        $products = Product::where('vendor_id', $vendor)
                       ->orderBy('created_at', 'desc')
                       ->take(5)
                       ->get();

        return $products;
    }

}
