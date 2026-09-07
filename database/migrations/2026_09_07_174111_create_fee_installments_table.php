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
        Schema::create('fee_installments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fee_payment_option_id')
                ->constrained('fee_payment_options')
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('sequence');     // 1, 2, 3...
            $table->string('label');                     // Semester 1, Year 1, Lumpsum
            $table->decimal('amount', 12, 2);

            $table->string('period_type')->nullable();   // semester | year | lumpsum
            $table->unsignedTinyInteger('period_number')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_installments');
    }
};
