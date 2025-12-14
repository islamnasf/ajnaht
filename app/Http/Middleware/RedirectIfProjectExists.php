<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Project;

class RedirectIfProjectExists
{
public function handle(Request $request, Closure $next)
{
    // منع اللوب
    if ($request->is('projectStatus')) {
        return $next($request);
    }

    $project = Project::orderBy('id')->first();

    if ($project && !is_null($project->status)) {
        return redirect()->route('projectStatus.show');
    }

    return $next($request);
}

}
