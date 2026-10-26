<?php

namespace App\Http\Controllers;

use App\Models\Academic;
use App\Models\Publication;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the UTP Pure Portal home page.
     */
    public function index()
    {
        $profilesCount = Academic::count();
        $publicationsCount = Publication::count();
        $departmentsCount = Academic::whereNotNull('department')->distinct('department')->count('department');

        // Featured scholars for discovery
        $featuredScholars = Academic::orderByDesc('scopus_citations')
            ->take(4)
            ->get();

        return view('home', compact(
            'profilesCount',
            'publicationsCount',
            'departmentsCount',
            'featuredScholars'
        ));
    }
}
