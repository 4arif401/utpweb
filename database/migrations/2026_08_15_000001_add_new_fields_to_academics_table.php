<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('academics', function (Blueprint $table) {
            // Awards & Recognition — newline-separated lists stored as JSON arrays
            $table->json('awards')->nullable()->after('qualifications');
            $table->json('recognition')->nullable()->after('awards');

            // Consultation Complete — structured: [{year, title, membership, funder}]
            $table->json('consultation_complete')->nullable()->after('consultations');

            // Intellectual Properties — structured: [{year, reference_no, ip_type, title, status_ip}]
            $table->json('intellectual_properties')->nullable()->after('consultation_complete');

            // Supervision (structured) — [{year, student_name, level, title, status, repository_url}]
            $table->json('supervision')->nullable()->after('supervision_info');
        });
    }

    public function down(): void
    {
        Schema::table('academics', function (Blueprint $table) {
            $table->dropColumn([
                'awards',
                'recognition',
                'consultation_complete',
                'intellectual_properties',
                'supervision',
            ]);
        });
    }
};
