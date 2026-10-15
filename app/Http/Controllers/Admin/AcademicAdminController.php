<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Academic;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AcademicAdminController extends Controller
{
    public function index()
    {
        $academics = Academic::withCount('publications')->orderBy('name')->get();
        return view('admin.academics.index', compact('academics'));
    }

    public function create()
    {
        return view('admin.academics.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'title'             => 'nullable|string|max:255',
            'email'             => 'nullable|email|max:255',
            'phone'             => 'nullable|string|max:50',
            'department'        => 'nullable|string|max:255',
            'institute'         => 'nullable|string|max:255',
            'centre'            => 'nullable|string|max:255',
            'office_address'    => 'nullable|string',
            'biography'         => 'nullable|string',
            'photo'             => 'nullable|image|max:2048',
            'scopus_author_id'  => 'nullable|string|max:50',
            'scopus_documents'  => 'nullable|integer',
            'scopus_citations'  => 'nullable|integer',
            'scopus_hindex'     => 'nullable|integer',
            'scopus_coauthors'  => 'nullable|integer',
            'gscholar_profile'  => 'nullable|string|max:255',
            'gscholar_citations'=> 'nullable|integer',
            'gscholar_hindex'   => 'nullable|integer',
            'researchgate_profile' => 'nullable|string|max:255',
            'rg_publications'   => 'nullable|integer',
            'rg_citations'      => 'nullable|integer',
            'rg_hindex'         => 'nullable|integer',
            'rg_reads'          => 'nullable|integer',
            'industrial_experience' => 'nullable|string',
            'supervision_info'  => 'nullable|string',
            // Structured sub-field arrays
            'consultation_complete.*.year'       => 'nullable|string|max:10',
            'consultation_complete.*.title'      => 'nullable|string|max:500',
            'consultation_complete.*.membership' => 'nullable|string|max:255',
            'consultation_complete.*.funder'     => 'nullable|string|max:255',
            'intellectual_properties.*.year'      => 'nullable|string|max:10',
            'intellectual_properties.*.reference_no' => 'nullable|string|max:100',
            'intellectual_properties.*.ip_type'   => 'nullable|string|max:100',
            'intellectual_properties.*.title'     => 'nullable|string|max:500',
            'intellectual_properties.*.status_ip' => 'nullable|string|max:100',
            'supervision.*.year'           => 'nullable|string|max:10',
            'supervision.*.student_name'   => 'nullable|string|max:255',
            'supervision.*.level'          => 'nullable|string|max:100',
            'supervision.*.title'          => 'nullable|string|max:500',
            'supervision.*.status'         => 'nullable|string|max:100',
            'supervision.*.repository_url' => 'nullable|string|max:500',
        ]);

        // Build other_links from form arrays
        $labels = $request->input('other_links_label', []);
        $urls   = $request->input('other_links_url', []);
        $otherLinks = [];
        foreach ($labels as $i => $label) {
            if (!empty($label) || !empty($urls[$i] ?? '')) {
                $otherLinks[] = ['label' => $label, 'url' => $urls[$i] ?? ''];
            }
        }
        $validated['other_links'] = $otherLinks ?: null;

        // Parse JSON array fields from the form
        $arrayFields = [
            'specializations', 'qualifications', 'awards', 'recognition',
            'research_projects', 'memberships', 'university_activities', 'consultations',
            'grant_evaluations',
        ];

        foreach ($arrayFields as $field) {
            $validated[$field] = $this->parseJsonField($request->input($field));
        }

        // Parse structured sub-field arrays
        $validated['courses_teaching']        = $this->parseStructuredRows($request->input('courses_teaching', []), ['year','course_code','course_name']);
        $validated['consultation_complete']   = $this->parseStructuredRows($request->input('consultation_complete', []), ['year','title','membership','funder']);
        $validated['intellectual_properties'] = $this->parseStructuredRows($request->input('intellectual_properties', []), ['year','reference_no','ip_type','title','status_ip']);
        $validated['supervision']             = $this->parseStructuredRows($request->input('supervision', []), ['year','student_name','level','title','status','repository_url']);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('academics', 'public');
        }

        // Handle Scopus citation trend image upload
        if ($request->hasFile('scopus_citation_image')) {
            $request->validate(['scopus_citation_image' => 'image|max:4096']);
            $validated['scopus_citation_image'] = $request->file('scopus_citation_image')->store('academics/scopus', 'public');
            $validated['scopus_citation_image_updated_at'] = now();
        }

        $validated['slug'] = Academic::generateSlug($validated['name']);

        $academic = Academic::create($validated);

        return redirect()->route('admin.academics.index')
            ->with('success', "Scholar '{$academic->name}' created successfully.");
    }

    public function edit(Academic $academic)
    {
        return view('admin.academics.edit', compact('academic'));
    }

    public function update(Request $request, Academic $academic)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'title'             => 'nullable|string|max:255',
            'email'             => 'nullable|email|max:255',
            'phone'             => 'nullable|string|max:50',
            'department'        => 'nullable|string|max:255',
            'institute'         => 'nullable|string|max:255',
            'centre'            => 'nullable|string|max:255',
            'office_address'    => 'nullable|string',
            'biography'         => 'nullable|string',
            'photo'             => 'nullable|image|max:2048',
            'scopus_author_id'  => 'nullable|string|max:50',
            'scopus_documents'  => 'nullable|integer',
            'scopus_citations'  => 'nullable|integer',
            'scopus_hindex'     => 'nullable|integer',
            'scopus_coauthors'  => 'nullable|integer',
            'gscholar_profile'  => 'nullable|string|max:255',
            'gscholar_citations'=> 'nullable|integer',
            'gscholar_hindex'   => 'nullable|integer',
            'researchgate_profile' => 'nullable|string|max:255',
            'rg_publications'   => 'nullable|integer',
            'rg_citations'      => 'nullable|integer',
            'rg_hindex'         => 'nullable|integer',
            'rg_reads'          => 'nullable|integer',
            'industrial_experience' => 'nullable|string',
            'supervision_info'  => 'nullable|string',
            // Structured sub-field arrays
            'consultation_complete.*.year'       => 'nullable|string|max:10',
            'consultation_complete.*.title'      => 'nullable|string|max:500',
            'consultation_complete.*.membership' => 'nullable|string|max:255',
            'consultation_complete.*.funder'     => 'nullable|string|max:255',
            'intellectual_properties.*.year'      => 'nullable|string|max:10',
            'intellectual_properties.*.reference_no' => 'nullable|string|max:100',
            'intellectual_properties.*.ip_type'   => 'nullable|string|max:100',
            'intellectual_properties.*.title'     => 'nullable|string|max:500',
            'intellectual_properties.*.status_ip' => 'nullable|string|max:100',
            'supervision.*.year'           => 'nullable|string|max:10',
            'supervision.*.student_name'   => 'nullable|string|max:255',
            'supervision.*.level'          => 'nullable|string|max:100',
            'supervision.*.title'          => 'nullable|string|max:500',
            'supervision.*.status'         => 'nullable|string|max:100',
            'supervision.*.repository_url' => 'nullable|string|max:500',
        ]);

        // Build other_links from form arrays
        $labels = $request->input('other_links_label', []);
        $urls   = $request->input('other_links_url', []);
        $otherLinks = [];
        foreach ($labels as $i => $label) {
            if (!empty($label) || !empty($urls[$i] ?? '')) {
                $otherLinks[] = ['label' => $label, 'url' => $urls[$i] ?? ''];
            }
        }
        $validated['other_links'] = $otherLinks ?: null;

        $arrayFields = [
            'specializations', 'qualifications', 'awards', 'recognition',
            'research_projects', 'memberships', 'university_activities', 'consultations',
            'grant_evaluations',
        ];

        foreach ($arrayFields as $field) {
            $validated[$field] = $this->parseJsonField($request->input($field));
        }

        // Parse structured sub-field arrays
        $validated['courses_teaching']        = $this->parseStructuredRows($request->input('courses_teaching', []), ['year','course_code','course_name']);
        $validated['consultation_complete']   = $this->parseStructuredRows($request->input('consultation_complete', []), ['year','title','membership','funder']);
        $validated['intellectual_properties'] = $this->parseStructuredRows($request->input('intellectual_properties', []), ['year','reference_no','ip_type','title','status_ip']);
        $validated['supervision']             = $this->parseStructuredRows($request->input('supervision', []), ['year','student_name','level','title','status','repository_url']);


        // Handle photo upload
        if ($request->hasFile('photo')) {
            if ($academic->photo) {
                Storage::disk('public')->delete($academic->photo);
            }
            $validated['photo'] = $request->file('photo')->store('academics', 'public');
        }

        // Handle Scopus citation trend image upload
        if ($request->hasFile('scopus_citation_image')) {
            $request->validate(['scopus_citation_image' => 'image|max:4096']);
            if ($academic->scopus_citation_image) {
                Storage::disk('public')->delete($academic->scopus_citation_image);
            }
            $validated['scopus_citation_image'] = $request->file('scopus_citation_image')->store('academics/scopus', 'public');
            $validated['scopus_citation_image_updated_at'] = now();
        }

        $academic->update($validated);

        return redirect()->route('admin.academics.index')
            ->with('success', "Scholar '{$academic->name}' updated successfully.");
    }

    public function destroy(Academic $academic)
    {
        if ($academic->photo) {
            Storage::disk('public')->delete($academic->photo);
        }
        $name = $academic->name;
        $academic->delete();

        return redirect()->route('admin.academics.index')
            ->with('success', "Scholar '{$name}' deleted successfully.");
    }

    // ─── Publications sub-resource ───────────────────────────────────────────

    public function storePublication(Request $request, Academic $academic)
    {
        $validated = $request->validate([
            'title'   => 'required|string',
            'authors' => 'nullable|string',
            'year'    => 'nullable|integer|min:1900|max:2099',
            'journal' => 'nullable|string|max:255',
            'volume'  => 'nullable|string|max:50',
            'pages'   => 'nullable|string|max:50',
            'url'     => 'nullable|url|max:500',
            'type'    => 'nullable|in:journal,conference,book',
        ]);

        $academic->publications()->create($validated);

        return redirect()->route('admin.academics.edit', $academic)
            ->with('success', 'Publication added successfully.');
    }

    public function destroyPublication(Academic $academic, Publication $publication)
    {
        $publication->delete();

        return redirect()->route('admin.academics.edit', $academic)
            ->with('success', 'Publication deleted.');
    }

    // ─── Helpers ──────────────────────────────────────────────────────────────

    private function parseJsonField(?string $value): ?array
    {
        if (empty($value)) return null;

        // Try JSON first
        $decoded = json_decode($value, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $decoded;
        }

        // Otherwise treat as newline-separated list
        $lines = array_filter(array_map('trim', explode("\n", $value)));
        return array_values($lines) ?: null;
    }

    private function parseStructuredRows(?array $rows, array $keys): ?array
    {
        if (empty($rows)) return null;

        $result = [];
        foreach ($rows as $row) {
            if (!is_array($row)) continue;
            // Skip completely empty rows
            $values = array_filter(array_map('trim', array_intersect_key($row, array_flip($keys))));
            if (empty($values)) continue;
            $entry = [];
            foreach ($keys as $key) {
                $entry[$key] = trim($row[$key] ?? '');
            }
            $result[] = $entry;
        }
        return $result ?: null;
    }
}
