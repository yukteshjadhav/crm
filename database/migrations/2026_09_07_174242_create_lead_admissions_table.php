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
        Schema::create('lead_admissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained('leads')->cascadeOnDelete();

            $table->foreignId('session_id')->constrained('session');
            $table->foreignId('university_id')->constrained('universities');
            $table->foreignId('course_id')->constrained('courses');
            $table->foreignId('fee_structure_id')->nullable()->constrained('fee_structures')->nullOnDelete();
            $table->foreignId('selected_option_id')->nullable()->constrained('fee_payment_options')->nullOnDelete();

            // ===== Loan Section =====
            $table->boolean('is_loan')->default(false);
            $table->decimal('loan_amount', 12, 2)->nullable();      // = first installment amount
            $table->decimal('down_payment', 12, 2)->nullable();     // if any
            $table->string('loan_partner')->nullable();             // Bank / NBFC name
            $table->decimal('interest_rate', 5, 2)->nullable();
            // ========================

            $table->date('registration_date')->nullable();
            $table->date('admission_date')->nullable();

            $table->decimal('total_fee', 12, 2)->nullable();
            $table->decimal('discount_given', 12, 2)->default(0);
            $table->decimal('final_fee', 12, 2)->nullable();

            $table->string('status')->default('Registered');   // Registered, Admitted, Cancelled
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_admissions');
    }
};
