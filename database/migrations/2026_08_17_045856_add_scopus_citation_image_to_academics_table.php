<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('academics', function (Blueprint $table) {
            $table->string('scopus_citation_image')->nullable()->after('scopus_coauthors');
            $table->timestamp('scopus_citation_image_updated_at')->nullable()->after('scopus_citation_image');
        });
    }

    public function down(): void
    {
        Schema::table('academics', function (Blueprint $table) {
            $table->dropColumn(['scopus_citation_image', 'scopus_citation_image_updated_at']);
        });
    }
};

