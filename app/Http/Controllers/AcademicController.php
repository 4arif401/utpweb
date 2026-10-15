<?php

namespace App\Http\Controllers;

use App\Models\Academic;
use Illuminate\Http\Request;

class AcademicController extends Controller
{
    public function index()
    {
        $academics = Academic::select([
            'id', 'slug', 'name', 'title', 'email', 'photo', 'institute', 'centre', 'department',
        ])->orderBy('name')->get();

        return view('academics.index', compact('academics'));
    }

    public function show(string $slug)
    {
        $academic = Academic::where('slug', $slug)
            ->with('publications')
            ->firstOrFail();

        return view('academics.show', compact('academic'));
    }
}
