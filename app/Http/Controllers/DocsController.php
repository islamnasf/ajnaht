<?php

namespace App\Http\Controllers;

use App\Models\DocsFile;
use App\Models\DocsType;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class DocsController extends Controller
{
    public function index()
    {
        return view('/admin/docs/docs');
    }

//docs types
    public function docsType()
    {
        $types = DocsType::get();
        return view('/admin/docs/docsType', compact('types'));   
     }

     public function storeDocsType(Request $request)
     {
         $validatedData = $request->validate([
             'name' => 'required|unique:docs_types,name',
         ], [
             'name.required' => 'حقل الاسم مطلوب.',
             'name.unique' => 'هذا الاسم مستخدم بالفعل، يرجى اختيار اسم آخر.',
         ]);
     
         $type = docsType::create([
             'name' => $validatedData['name'],
         ]);
     
         if ($type) {
             toastr()->success('تم حفظ البيانات بنجاح');
         } else {
             toastr()->error('يوجد مشكلة، حاول مرة أخرى.');
         }
     
         return back();
     }
     
     
  
     
     public function updateDocsType(Request $request, $id)
     {
         $validatedData = $request->validate([
             'name' => 'required|unique:docs_types,name,' . $id,
         ], [
             'name.required' => 'حقل الاسم مطلوب.',
             'name.unique' => 'هذا النوع مستخدم بالفعل.',
         ]);
     
         $type = docsType::findOrFail($id);
         $type->update([
             'name' => $validatedData['name'],
         ]);
     
         toastr()->success('تم تحديث البيانات بنجاح');
         return back();
     }
     
     
     public function deleteDocsType($id)
     {
         $type = docsType::findOrFail($id);
         $type->delete();
     
         toastr()->success('تم حذف البيانات بنجاح');
         return back();
     }
//add 
public function addDocs()
{
    $types = DocsType::get();
    return view('/admin/docs/addDocs', compact('types'));   
 }
 //
//store docs
public function storeNewDocs(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'expire_at' => 'required|date',
        'type_id' => 'required|exists:docs_types,id',
        'files.*' => 'nullable'
    ]);

    // حفظ المستند في جدول documents
    $document = Document::create([
        'name' => $request->name,
        'expire_at' => $request->expire_at,
        'type_id' => $request->type_id
    ]);

    // حفظ الملفات في جدول docs_files وإرجاع رابطها
    $uploadedFiles = [];

    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            $fileName = time() . '_' . $file->getClientOriginalName(); // اسم فريد للملف
            $destinationPath = public_path('storage/documents'); // مسار الحفظ داخل public
           
            // نقل الملف للمسار المحدد
            $file->move($destinationPath, $fileName);
    
            // حفظ المسار في قاعدة البيانات
            DocsFile::create([
                'file' => 'documents/' . $fileName, // حفظ المسار النسبي فقط
                'docs_id' => $document->id
            ]);
    
            $uploadedFiles[] = asset('storage/documents/' . $fileName); // توليد الرابط المباشر
        }
    }
    


    toastr()->success('تم حفظ البيانات بنجاح');
    return redirect()->back();
}
//
public function showAllDocs()
{
    $types = DocsType::get();
    $docs = Document::whereNull('archive')->get();
    return view('/admin/docs/allDocs', compact('docs','types'));   
 }
 //
 public function showExpiringDocs()
{
    $thresholdDate = now()->addDays(15)->format('Y-m-d'); // تاريخ اليوم + 15 يوم
    $docs = Document::where('expire_at', '<=', $thresholdDate)
                    ->whereNull('archive')
                    ->get();
                    $types = DocsType::get();

    return view('/admin/docs/allDocs', compact('docs','types'));   
}

 //
public function showAllArchiveDocs()
{
    $docs = Document::where('archive','archived')->get();
    return view('/admin/docs/allArchiveDocs', compact('docs'));   
 }

//files
public function showAllfiles($id)
{
    $files = DocsFile::where('docs_id',$id)->get();
    $document = Document::findOrFail($id);
    return view('/admin/docs/docsFiles', compact('files','document'));   
 }

 //archive 
 public function archiveDocs($id)
 {
     $docs = Document::findOrFail($id);
 
     $docs->archive = 'archived'; // Or any value you want to indicate archiving
     $docs->save(); // Save the changes
     toastr()->success('تم ارشيف المستند بنجاح');

     // Redirect back
     return redirect()->back();
 }
 //unarchive
 public function unarchiveDocs($id)
{
    $docs = Document::findOrFail($id);

    // Set the 'archive' field to null to unarchive the document
    $docs->archive = null;
    $docs->save(); // Save the changes

    toastr()->success('تم إلغاء أرشفة المستند بنجاح');

    // Redirect back
    return redirect()->back();
}

 

 
 //edit
 public function updateDocs($id, Request $request)
{
    $docs = Document::findOrFail($id);

    $docs->name = $request->input('name');
    $docs->expire_at = $request->input('expire_at');
    
    $docs->save();

    toastr()->success('تم تحديث المستند بنجاح');

    return redirect()->back();
}

//add & delete files
public function storeDocsFile(Request $request, $documentId)
{
    $request->validate([
        'files' => 'required|array',
        'files.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048', // Validate file types and size
    ]);

    $uploadedFiles = [];
    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            $fileName = time() . '_' . $file->getClientOriginalName(); // Unique file name
            $destinationPath = public_path('storage/documents'); // Path for saving the file

            // Move the file to the destination
            $file->move($destinationPath, $fileName);

            // Save file path in database
            DocsFile::create([
                'file' => 'documents/' . $fileName, // Store relative path
                'docs_id' => $documentId,
            ]);

            $uploadedFiles[] = asset('storage/documents/' . $fileName); // Generate direct URL
        }
    }
    toastr()->success('تم اضافة الملفات  بنجاح');

    return redirect()->back();
}

public function deleteDocsFile($id)
{
    $file = DocsFile::findOrFail($id);
    $filePath = public_path('storage/' . $file->file);

    if (file_exists($filePath)) {
        unlink($filePath); // Delete file from storage
    }

    $file->delete(); // Delete file record from database
    toastr()->success('تم حذف الملف بنجاح');

    return redirect()->back();

}



     



}
