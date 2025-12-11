<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceSection;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /*------------------------------------
    | SERVICES
    -------------------------------------*/
    public function index()
    {
        $services = Service::with('sections')->get();
        return view('/admin/services', compact('services'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'image' => 'nullable|image',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->move(
                'categories/images',
                $request->file('image')->getClientOriginalName()
            );
        }

        Service::create([
            'name' => $validatedData['name'],
            'image' => $imagePath,
        ]);

        toastr()->success('تمت إضافة الخدمة بنجاح');
        return back();
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required',
            'image' => 'nullable|image',
        ]);

        $imagePath = $service->image;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->move(
                'categories/images',
                $request->file('image')->getClientOriginalName()
            );
        }

        $service->update([
            'name' => $validatedData['name'],
            'image' => $imagePath,
        ]);

        toastr()->success('تم تعديل الخدمة بنجاح');
        return back();
    }

    public function delete($id)
    {
        Service::findOrFail($id)->delete();
        toastr()->success('تم حذف الخدمة بنجاح');
        return back();
    }


    /*------------------------------------
    | SERVICE SECTIONS
    -------------------------------------*/
    // public function sections($service_id)
    // {
    //     $service = Service::with('sections')->findOrFail($service_id);
    //     return view('/admin/service_sections', compact('service'));
    // }

    public function storeSection(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'nullable|string',
            'contant' => 'nullable',
            'image' => 'nullable|image',
            'service_id' => 'required|exists:services,id',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->move(
                'categories/images',
                $request->file('image')->getClientOriginalName()
            );
        }

        ServiceSection::create([
            'title' => $validatedData['title'],
            'contant' => $validatedData['contant'],
            'service_id' => $validatedData['service_id'],
            'image' => $imagePath,
        ]);

        toastr()->success('تم إضافة القسم بنجاح');
        return back();
    }


    public function updateSection(Request $request, $id)
    {
        $section = ServiceSection::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'nullable|string',
            'contant' => 'nullable',
            'image' => 'nullable|image',
            'service_id' => 'required|exists:services,id',
        ]);

        $imagePath = $section->image;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->move(
                'categories/images',
                $request->file('image')->getClientOriginalName()
            );
        }

        $section->update([
            'title' => $validatedData['title'],
            'contant' => $validatedData['contant'],
            'service_id' => $validatedData['service_id'],
            'image' => $imagePath,
        ]);

        toastr()->success('تم تعديل القسم بنجاح');
        return back();
    }

    public function deleteSection($id)
    {
        ServiceSection::findOrFail($id)->delete();

        toastr()->success('تم حذف القسم بنجاح');
        return back();
    }
}
