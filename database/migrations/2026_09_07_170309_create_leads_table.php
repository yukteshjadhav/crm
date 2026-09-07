<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('f_name')->index();
            $table->string('m_name')->index()->nullable();
            $table->string('l_name')->index()->nullable();
            $table->string('mobile', 15)->unique();
            $table->string('alternate_mobile', 15)->nullable();
            $table->string('email')->unique();
            $table->string('alternate_email')->unique();
            
            $table->foreignId('source_id')->nullable()->constrained('sources')->nullOnDelete();
            $table->foreignId('assigned_counsellor_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('current_status_id')->nullable()->constrained('lead_statuses')->nullOnDelete();
            $table->foreignId('interested_course_id')->nullable()->constrained('courses')->nullOnDelete();
            $table->foreignId('interested_university_id')->nullable()->constrained('universities')->nullOnDelete();

            $table->timestamp('next_followup_date')->nullable();
            $table->text('remarks_summary')->nullable();
            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();

            $table->index('mobile');
            $table->index('assigned_counsellor_id');
            $table->index('current_status_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
