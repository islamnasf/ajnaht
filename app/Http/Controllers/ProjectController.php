<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
 public function handleStatusOnly(Request $request,$status)
{
    $newStatus = $status;

    $record = Project::orderBy('id')->first();

    if ($record) {
        // Update
        $record->update([
            'status' => $newStatus
        ]);

        $created = false;
    } else {
        // Create
        Project::create([
            'status' => $newStatus
        ]);

        $created = true;
    }

    return response()->json([
        'message' => $created ? 'تم الإنشاء' : 'تم التحديث',
        'status'  => $newStatus
    ], $created ? 201 : 200);
}

    public function projectStatus(Request $request)
    {
        return view('components/status');
    }
}
