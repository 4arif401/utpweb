<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Academic extends Model
{
    protected $fillable = [
        'slug', 'name', 'title', 'email', 'phone', 'department', 'institute', 'centre',
        'office_address', 'photo', 'biography',
        'specializations', 'qualifications',
        'awards', 'recognition',
        'scopus_author_id', 'scopus_documents', 'scopus_citations', 'scopus_hindex', 'scopus_coauthors',
        'gscholar_profile', 'gscholar_citations', 'gscholar_hindex',
        'researchgate_profile', 'rg_publications', 'rg_citations', 'rg_hindex', 'rg_reads',
        'research_projects', 'memberships', 'industrial_experience',
        'university_activities', 'consultations', 'consultation_complete',
        'intellectual_properties', 'supervision_info', 'supervision',
        'courses_teaching', 'grant_evaluations', 'other_links',
        'scopus_citation_image', 'scopus_citation_image_updated_at',
    ];

    protected $casts = [
        'specializations'        => 'array',
        'qualifications'         => 'array',
        'awards'                 => 'array',
        'recognition'            => 'array',
        'research_projects'      => 'array',
        'memberships'            => 'array',
        'university_activities'  => 'array',
        'consultations'          => 'array',
        'consultation_complete'  => 'array',
        'intellectual_properties'=> 'array',
        'supervision'            => 'array',
        'courses_teaching'       => 'array',
        'grant_evaluations'      => 'array',
        'other_links'            => 'array',
        'scopus_citation_image_updated_at' => 'datetime',
    ];

    public function publications(): HasMany
    {
        return $this->hasMany(Publication::class);
    }

    public static function generateSlug(string $name): string
    {
        $slug = Str::slug($name);
        $original = $slug;
        $i = 1;
        while (static::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $i++;
        }
        return $slug;
    }
}
