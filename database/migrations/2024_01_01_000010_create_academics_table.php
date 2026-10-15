<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('academics', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('title')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('department')->nullable();
            $table->string('institute')->nullable();
            $table->string('centre')->nullable();
            $table->text('office_address')->nullable();
            $table->string('photo')->nullable();
            $table->text('biography')->nullable();
            $table->json('specializations')->nullable();
            $table->json('qualifications')->nullable();
            // Scopus metrics
            $table->string('scopus_author_id')->nullable();
            $table->integer('scopus_documents')->nullable();
            $table->integer('scopus_citations')->nullable();
            $table->integer('scopus_hindex')->nullable();
            $table->integer('scopus_coauthors')->nullable();
            // Google Scholar metrics
            $table->string('gscholar_profile')->nullable();
            $table->integer('gscholar_citations')->nullable();
            $table->integer('gscholar_hindex')->nullable();
            // ResearchGate metrics
            $table->string('researchgate_profile')->nullable();
            $table->integer('rg_publications')->nullable();
            $table->integer('rg_citations')->nullable();
            $table->integer('rg_hindex')->nullable();
            $table->integer('rg_reads')->nullable();
            // Additional info
            $table->json('research_projects')->nullable();
            $table->json('memberships')->nullable();
            $table->text('industrial_experience')->nullable();
            $table->json('university_activities')->nullable();
            $table->json('consultations')->nullable();
            $table->text('supervision_info')->nullable();
            $table->json('courses_teaching')->nullable();
            $table->json('grant_evaluations')->nullable();
            $table->json('other_links')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('academics');
    }
};
